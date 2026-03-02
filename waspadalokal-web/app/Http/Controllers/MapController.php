<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Pool;

class MapController extends Controller
{
    public function index()
    {
        if (!env('OPENWEATHER_API_KEY')) {
            return view('api-error');
        }

        $cities = \App\Models\City::all();
        return view('peta', compact('cities'));
    }

    public function prediksiKota(Request $request)
    {
        // Validasi input koordinat dari request frontend
        $request->validate([
            'lat' => 'required|numeric',
            'lon' => 'required|numeric',
        ]);

        $lat = $request->lat;
        $lon = $request->lon;

        $apiKey = env('OPENWEATHER_API_KEY');

        // Step A1: Request data cuaca dari OpenWeather API dengan retry mechanism (max 3 kali)
        $weatherData = null;
        $weatherSuccess = false;
        $maxRetries = 3;

        for ($i = 0; $i < $maxRetries; $i++) {
            try {
                $weatherResponse = Http::timeout(3)->get("https://api.openweathermap.org/data/2.5/weather", [
                    'lat' => $lat,
                    'lon' => $lon,
                    'appid' => $apiKey,
                    'units' => 'metric'
                ]);

                if ($weatherResponse->successful()) {
                    $tempData = $weatherResponse->json();
                    if (isset($tempData['main']['temp']) && isset($tempData['main']['humidity'])) {
                        $weatherData = $tempData;
                        $weatherSuccess = true;
                        break;
                    }
                }
            } catch (\Exception $e) {
                // Jangan crash jika timeout
            }
            usleep(200000); // 200 ms
        }

        if (!$weatherSuccess || !$weatherData) {
            // Fallback graceful agar tidak 500, return defaults
            $suhu = 0;
            $kelembapan = 0;
            $curah_hujan = 0;
        } else {
            // Step B: Ekstrak nilai
            $suhu = $weatherData['main']['temp'];
            $kelembapan = $weatherData['main']['humidity'];
            $curah_hujan = $weatherData['rain']['1h'] ?? 0;
        }

        // Step A2: Request Reverse Geocoding dari BigDataCloud API
        try {
            $geocodeResponse = Http::timeout(3)->get("https://api.bigdatacloud.net/data/reverse-geocode-client", [
                'latitude' => $lat,
                'longitude' => $lon,
                'localityLanguage' => 'id'
            ]);

            if ($geocodeResponse->successful()) {
                $geoData = $geocodeResponse->json();
                $nama_lokasi = $geoData['locality'] ?? ($geoData['city'] ?? ($geoData['principalSubdivision'] ?? ($weatherData['name'] ?? 'Lokasi Tidak Diketahui')));
            } else {
                $nama_lokasi = $weatherData['name'] ?? 'Lokasi Pantai/Laut';
            }
        } catch (\Exception $e) {
            $nama_lokasi = $weatherData['name'] ?? 'Titik Koordinat';
        }

        // Step C: Post 3 parameter ke AI API Local Python
        $aiApiUrl = rtrim(env('AI_API_URL', 'http://127.0.0.1:8000'), '/') . '/prediksi';

        try {
            $aiResponse = Http::timeout(5)->post($aiApiUrl, [
                'suhu' => (float) $suhu,
                'kelembapan' => (float) $kelembapan,
                'curah_hujan' => (float) $curah_hujan
            ]);

            $mlData = $aiResponse->json();
            $prediksi = $mlData['prediksi'] ?? ($mlData['status'] ?? 'Aman');
        } catch (\Exception $e) {
            $prediksi = 'Aman';
            $mlData = null;
        }

        // Step D: Open-Meteo 24-Hour Forecast
        $hourlyForecasts = [];
        try {
            $omResponse = Http::timeout(3)->get("https://api.open-meteo.com/v1/forecast", [
                'latitude' => $lat,
                'longitude' => $lon,
                'hourly' => 'temperature_2m,relative_humidity_2m,rain,weathercode',
                'timezone' => 'auto',
                'forecast_days' => 2
            ]);

            if ($omResponse->successful()) {
                $omData = $omResponse->json();
                $hourly = $omData['hourly'];
                $times = $hourly['time'];
                $timezone = $omData['timezone'] ?? 'UTC';

                // Temukan index waktu sekarang di zona waktu lokasi tersebut
                $startIndex = 0;
                $nowTimestamp = now()->setTimezone($timezone)->timestamp;

                foreach ($times as $index => $timeStr) {
                    // Parsing waktu dari format "YYYY-MM-DDTHH:MM" dengan timezone setempat
                    if (strtotime($timeStr) >= $nowTimestamp - 3600) {
                        $startIndex = $index;
                        break;
                    }
                }

                // Ambil 24 jam ke depan
                for ($i = $startIndex; $i < $startIndex + 24; $i++) {
                    if (!isset($times[$i]))
                        break;

                    $hourlyForecasts[] = [
                        'time' => $times[$i], // e.g., "2023-10-31T14:00"
                        'temp' => $hourly['temperature_2m'][$i],
                        'humidity' => $hourly['relative_humidity_2m'][$i],
                        'rain' => $hourly['rain'][$i],
                        'weathercode' => $hourly['weathercode'][$i],
                        'status' => 'Aman' // Default sebelum di-override AI
                    ];
                }

                // Request AI secara paralel (Concurrent) agar tidak lambat
                try {
                    $aiResponses = Http::pool(function (Pool $pool) use ($hourlyForecasts, $aiApiUrl) {
                        $requests = [];
                        foreach ($hourlyForecasts as $idx => $f) {
                            $requests[] = $pool->as("req_{$idx}")->timeout(5)->post($aiApiUrl, [
                                'suhu' => (float) $f['temp'],
                                'kelembapan' => (float) $f['humidity'],
                                'curah_hujan' => (float) $f['rain']
                            ]);
                        }
                        return $requests;
                    });

                    // Cocokkan hasil AI dengan array per jam
                    foreach ($hourlyForecasts as $idx => &$f) {
                        $res = $aiResponses["req_{$idx}"] ?? null;
                        if ($res && $res->ok()) {
                            $mlDataHourly = $res->json();
                            $f['status'] = $mlDataHourly['prediksi'] ?? ($mlDataHourly['status'] ?? 'Aman');
                        }
                    }
                } catch (\Exception $e) {
                    // Biarkan status default jika AI gagal dipanggil
                }
            }
        } catch (\Exception $e) {
            // Jika Open-Meteo gagal, biarkan chart kosong tapi tetap return 200
        }

        // Step E: Return response berformat JSON gabungan ke Frontend
        return response()->json([
            'lokasi' => $nama_lokasi,
            'suhu' => $suhu,
            'kelembapan' => $kelembapan,
            'curah_hujan' => $curah_hujan,
            'prediksi' => $prediksi,
            'raw_ml' => $mlData,
            'lat' => $lat,
            'lon' => $lon,
            'hourly_forecast' => $hourlyForecasts // Data ramalan 24 Jam
        ]);
    }
}

