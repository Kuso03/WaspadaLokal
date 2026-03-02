<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BmkgController extends Controller
{
    public function index()
    {
        // 1. Fetch Earthquake Data (Gempa Terkini > Mag 5.0)
        $gempaData = null;
        try {
            $earthquakeRes = Http::timeout(5)->get('https://data.bmkg.go.id/DataMKG/TEWS/autogempa.json');
            if ($earthquakeRes->successful()) {
                $gempaData = $earthquakeRes->json()['Infogempa']['gempa'] ?? null;
            } else {
                $gempaData = ['error' => true];
            }
        } catch (\Exception $e) {
            $gempaData = ['error' => true];
        }

        // 2. Fetch Weather Warnings from OFFICIAL BMKG CAP RSS (Oct 2025 update)
        $weatherWarnings = [];
        try {
            $weatherRes = Http::timeout(5)->get('https://www.bmkg.go.id/alerts/nowcast/id');
            if ($weatherRes->successful()) {
                $xml = simplexml_load_string($weatherRes->body(), 'SimpleXMLElement', LIBXML_NOCDATA);
                if ($xml !== false && isset($xml->channel->item)) {
                    foreach ($xml->channel->item as $item) {
                        $title = (string) $item->title;
                        $description = (string) $item->description;
                        $link = (string) $item->link;

                        // Check for high priority dynamically
                        $isHighPriority = false;
                        $userProvince = session('user_province');
                        $userCity = session('user_city');

                        if ($userProvince && stripos($description, $userProvince) !== false) {
                            $isHighPriority = true;
                        }
                        if ($userCity && stripos($description, $userCity) !== false) {
                            $isHighPriority = true;
                        }

                        // Fallback jika tidak ada session (belum deteksi)
                        if (!$userProvince && !$userCity && (stripos($description, 'Jawa Tengah') !== false || stripos($description, 'Sukoharjo') !== false)) {
                            $isHighPriority = true;
                        }

                        $weatherWarnings[] = [
                            'province' => $title,
                            'warning' => strip_tags(html_entity_decode($description)),
                            'link' => $link,
                            'is_high_priority' => $isHighPriority
                        ];
                    }
                }
            }
        } catch (\Exception $e) {
            // Error connecting to BMKG RSS
        }

        // Sort warnings so High Priority appears at the top
        usort($weatherWarnings, function ($a, $b) {
            return $b['is_high_priority'] <=> $a['is_high_priority'];
        });

        // Ensure at least one structure if we failed to parse perfectly 
        $apiError = false;
        if (empty($weatherWarnings)) {
            $apiError = true;
            $weatherWarnings[] = [
                'province' => 'Sistem Peringatan Dini',
                'warning' => 'Gagal mengambil data dari server BMKG. Mohon periksa koneksi Anda.',
                'link' => 'https://www.bmkg.go.id',
                'is_high_priority' => false,
                'error' => true
            ];
        }

        return view('peringatan', compact('gempaData', 'weatherWarnings', 'apiError'));
    }
}
