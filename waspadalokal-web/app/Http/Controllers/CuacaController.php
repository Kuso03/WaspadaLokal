<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CuacaController extends Controller
{
    public function cekLokasi(Request $request)
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
            $weatherResponse = Http::timeout(5)->get("https://api.openweathermap.org/data/2.5/weather", [
                'lat' => $lat,
                'lon' => $lon,
                'appid' => $apiKey,
                'units' => 'metric'
            ]);

            if ($weatherResponse->successful()) {
                $tempData = $weatherResponse->json();
                // Validasi bahwa data penting (suhu dan kelembapan) tidak null
                if (isset($tempData['main']['temp']) && isset($tempData['main']['humidity'])) {
                    $weatherData = $tempData;
                    $weatherSuccess = true;
                    break;
                }
            }
            // Jeda sejenak sebelum mencoba lagi (opsional)
            usleep(200000); // 200 ms
        }

        if (!$weatherSuccess || !$weatherData) {
            return response()->json(['error' => 'Gagal mengambil data cuaca aktual dari OpenWeather API (Connection Error)'], 503);
        }

        // Step A2: Request Reverse Geocoding dari BigDataCloud API untuk lokasi lebih akurat (seperti nama kota kecil)
        $geocodeResponse = Http::get("https://api.bigdatacloud.net/data/reverse-geocode-client", [
            'latitude' => $lat,
            'longitude' => $lon,
            'localityLanguage' => 'id'
        ]);

        $nama_lokasi = 'Lokasi Tidak Diketahui';
        if ($geocodeResponse->successful()) {
            $geoData = $geocodeResponse->json();
            // Prioritaskan locality, lalu city, lalu principal subdivision
            $nama_lokasi = $geoData['locality'] ?? ($geoData['city'] ?? ($geoData['principalSubdivision'] ?? $weatherData['name'] ?? 'Lokasi Tidak Diketahui'));

            // Simpan provinsi ke session untuk Info BMKG
            $provinsi = $geoData['principalSubdivision'] ?? null;
            if ($provinsi) {
                // Menghilangkan kata 'Province' jika ada, dsb untuk matching BMKG
                $provinsi = str_ireplace(' Province', '', $provinsi);
                session(['user_province' => $provinsi]);
                session(['user_city' => $nama_lokasi]); // Opsional, simpan kota juga
            }
        } else {
            $nama_lokasi = $weatherData['name'] ?? 'Lokasi Tidak Diketahui';
        }

        // Step B: Ekstrak nilai suhu, kelembapan, dan curah hujan
        // OpenWeather kadang tidak mengembalikan key 'rain' jika tidak hujan (valid=0)
        $suhu = $weatherData['main']['temp']; // sudah terjamin ada karena pengecekan null di retry loop
        $kelembapan = $weatherData['main']['humidity'];
        $curah_hujan = $weatherData['rain']['1h'] ?? 0;

        // Step C: Post 3 parameter ke AI API Local Python
        $aiApiUrl = rtrim(env('AI_API_URL', 'http://127.0.0.1:8000'), '/') . '/prediksi';
        $mlData = null;

        try {
            $aiResponse = Http::timeout(5)->post($aiApiUrl, [
                'suhu' => (float) $suhu,
                'kelembapan' => (float) $kelembapan,
                'curah_hujan' => (float) $curah_hujan
            ]);

            if ($aiResponse->successful()) {
                $mlData = $aiResponse->json();
                // Ekstrak prediksi dari format API Python
                $prediksi = $mlData['prediksi'] ?? ($mlData['status'] ?? 'Unknown');
                if ($prediksi === 'Unknown') {
                    return response()->json(['error' => 'Model AI tidak mengembalikan status yang valid.'], 502);
                }
            } else {
                return response()->json(['error' => 'API Python mengembalikan error (Status: ' . $aiResponse->status() . ')'], 502);
            }

        } catch (\Exception $e) {
            return response()->json(['error' => 'Tidak dapat menghubungi Python AI API (Connection Error)'], 503);
        }

        // Step D: Return response berformat JSON gabungan ke Frontend dengan Timestamp
        return response()->json([
            'lokasi' => $nama_lokasi,
            'suhu' => $suhu,
            'kelembapan' => $kelembapan,
            'curah_hujan' => $curah_hujan,
            'prediksi' => $prediksi,
            'raw_ml' => $mlData,
            'lat' => $lat,
            'lon' => $lon,
            'timestamp' => now()->timezone('Asia/Jakarta')->format('H:i') . ' WIB'
        ]);
    }
}