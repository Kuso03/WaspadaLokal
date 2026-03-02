<!DOCTYPE html>
<html lang="id" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WaspadaLokal</title>
    <meta name="description" content="WaspadaLokal - Sistem Peringatan Dini Real-time dan Deteksi Risiko Berbasis AI.">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png?v=2026') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png?v=2026">
    <link rel="shortcut icon" href="{{ asset('favicon.ico?v=2026') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png?v=2026') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest?v=2026') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Leaflet CSS & JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body
    class="bg-slate-50 text-slate-900 dark:bg-slate-900 dark:text-slate-50 min-h-screen transition-colors duration-300 antialiased selection:bg-blue-300 dark:selection:bg-blue-700 overflow-x-hidden">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12 w-full">

        <!-- Navigation Bar -->
        <nav class="flex flex-wrap justify-center gap-3 md:gap-4 mb-10 w-full">
            <a href="/"
                class="min-w-[44px] min-h-[44px] px-6 py-2.5 flex items-center justify-center rounded-full font-medium transition-all duration-200 active:scale-95 bg-blue-600 text-white shadow-lg shadow-blue-500/30 text-sm md:text-base">Deteksi
                Saya</a>
            <a href="/peta-pantauan"
                class="min-w-[44px] min-h-[44px] px-6 py-2.5 flex items-center justify-center rounded-full font-medium transition-all duration-200 active:scale-95 bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 shadow-sm border border-slate-200 dark:border-slate-700 text-sm md:text-base">Peta
                Nasional</a>
            <a href="/pusat-peringatan"
                class="min-w-[44px] min-h-[44px] px-6 py-2.5 flex items-center justify-center rounded-full font-medium transition-all duration-200 active:scale-95 bg-white dark:bg-slate-800 text-rose-600 dark:text-rose-400 hover:bg-rose-50 dark:hover:bg-slate-700 shadow-sm border border-slate-200 dark:border-slate-700 text-sm md:text-base border-rose-200 dark:border-rose-900/50">
                <span class="w-2.5 h-2.5 rounded-full bg-rose-500 animate-[pulse-fast_1s_infinite] mr-2"></span>
                Info BMKG
            </a>
            <a href="/panduan"
                class="min-w-[44px] min-h-[44px] px-6 py-2.5 flex items-center justify-center rounded-full font-medium transition-all duration-200 active:scale-95 bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 shadow-sm border border-slate-200 dark:border-slate-700 text-sm md:text-base">Panduan
                Keselamatan</a>
        </nav>

        <!-- Header -->
        <header class="text-center mb-12">
            <h1
                class="text-4xl md:text-5xl lg:text-6xl font-extrabold tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600 dark:from-blue-400 dark:to-indigo-400 mb-6 inline-block">
                WaspadaLokal
            </h1>
            <p class="text-slate-500 dark:text-slate-400 text-lg md:text-xl max-w-2xl mx-auto">
                Ketahui status risiko cuaca di sekitar Anda secara real-time dengan teknologi AI.
            </p>

            <button id="btn-detect"
                class="mt-8 relative group overflow-hidden rounded-2xl bg-blue-600 px-8 py-4 text-white shadow-[0_0_40px_-10px_rgba(37,99,235,0.5)] transition-all hover:scale-105 hover:shadow-[0_0_60px_-15px_rgba(37,99,235,0.6)] active:scale-95">
                <div
                    class="absolute inset-0 bg-gradient-to-r from-blue-600 to-indigo-600 opacity-100 transition-opacity group-hover:opacity-80">
                </div>
                <div class="relative flex items-center gap-3 font-semibold text-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                        stroke="currentColor" class="w-6 h-6 animate-pulse">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                    </svg>
                    Deteksi Risiko Lokasi Saya
                </div>
            </button>
        </header>

        <!-- Skeleton Loaders (replaces basic spinner) -->
        <div id="loading" class="hidden flex-col gap-6 lg:gap-8 opacity-0 transition-opacity duration-500 mb-12">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8">
                <!-- Left Skeleton Column -->
                <div class="lg:col-span-5 flex flex-col gap-6">
                    <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 sm:p-8 border border-transparent shadow-sm">
                        <div class="h-8 bg-slate-200 dark:bg-slate-700 rounded-full w-3/4 mb-6 animate-pulse"></div>
                        <div class="space-y-4">
                            <div
                                class="h-14 bg-slate-200 dark:bg-slate-700 rounded-2xl w-full animate-pulse opacity-80">
                            </div>
                            <div
                                class="h-14 bg-slate-200 dark:bg-slate-700 rounded-2xl w-full animate-pulse opacity-60">
                            </div>
                            <div
                                class="h-14 bg-slate-200 dark:bg-slate-700 rounded-2xl w-full animate-pulse opacity-40">
                            </div>
                        </div>
                    </div>
                    <div
                        class="h-40 bg-slate-200 dark:bg-slate-800 rounded-[1.3rem] border border-transparent drop-shadow-md animate-pulse">
                    </div>
                    <div class="h-48 bg-slate-200 dark:bg-slate-800 rounded-3xl animate-pulse delay-100"></div>
                </div>
                <!-- Right Skeleton Column -->
                <div class="lg:col-span-7 flex flex-col gap-6 h-[45rem] lg:h-auto overflow-hidden">
                    <div class="h-full min-h-[300px] w-full bg-slate-200 dark:bg-slate-800 rounded-3xl animate-pulse">
                    </div>
                    <div class="h-64 w-full bg-slate-200 dark:bg-slate-800 rounded-3xl animate-pulse"></div>
                </div>
            </div>
            <div class="flex flex-col items-center mt-4">
                <div
                    class="w-10 h-10 border-4 border-slate-200 dark:border-slate-800 border-t-blue-600 rounded-full animate-spin">
                </div>
                <p class="mt-4 text-slate-500 dark:text-slate-400 font-medium animate-pulse text-sm">Menghubungkan ke
                    API Cuaca...</p>
            </div>
        </div>

        <!-- Main Dashboard Content (Grid Layout) -->
        <div id="results" class="hidden opacity-0 transition-opacity duration-700 ease-in-out">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8">

                <!-- LEFT COLUMN: Weather, AI Status, Checklist -->
                <div class="lg:col-span-5 flex flex-col gap-6">

                    <!-- Location & Basic Weather -->
                    <div
                        class="bg-white dark:bg-slate-800 rounded-3xl p-6 sm:p-8 shadow-xl shadow-slate-200/50 dark:shadow-none border border-slate-100 dark:border-slate-700">
                        <h2 class="text-2xl font-bold mb-2 flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-7 h-7 text-blue-500 shrink-0">
                                <path fill-rule="evenodd"
                                    d="M11.54 22.351l.07.04.028.016a.76.76 0 00.723 0l.028-.015.071-.041a16.975 16.975 0 001.144-.742 19.58 19.58 0 002.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 00-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 002.682 2.282 16.975 16.975 0 001.145.742zM12 13.5a3 3 0 100-6 3 3 0 000 6z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span id="city-name" class="truncate" title="Nama Kota">--</span>
                        </h2>
                        <div
                            class="mb-6 flex items-center gap-2 text-xs font-semibold text-slate-500 dark:text-slate-400 bg-slate-100 dark:bg-slate-700/50 w-fit px-3 py-1 rounded-full border border-slate-200 dark:border-slate-600">
                            <svg class="w-3.5 h-3.5 text-blue-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Data terakhir diperbarui: <span id="timestamp-val">--</span>
                        </div>

                        <div class="space-y-4">
                            <div
                                class="flex items-center justify-between p-4 rounded-2xl bg-slate-50 dark:bg-slate-700/50 border border-slate-100 dark:border-slate-700">
                                <span class="text-slate-500 dark:text-slate-400 font-medium">Suhu</span>
                                <span class="text-xl font-bold" id="temp-val">-- °C</span>
                            </div>
                            <div
                                class="flex items-center justify-between p-4 rounded-2xl bg-slate-50 dark:bg-slate-700/50 border border-slate-100 dark:border-slate-700">
                                <span class="text-slate-500 dark:text-slate-400 font-medium">Kelembapan</span>
                                <span class="text-xl font-bold text-blue-600 dark:text-blue-400" id="humid-val">--
                                    %</span>
                            </div>
                            <div
                                class="flex items-center justify-between p-4 rounded-2xl bg-slate-50 dark:bg-slate-700/50 border border-slate-100 dark:border-slate-700">
                                <span class="text-slate-500 dark:text-slate-400 font-medium">Curah Hujan (1j)</span>
                                <span class="text-xl font-bold text-indigo-600 dark:text-indigo-400" id="rain-val">--
                                    mm</span>
                            </div>
                        </div>
                    </div>

                    <!-- AI Status Card -->
                    <div id="status-card"
                        class="relative overflow-hidden rounded-3xl p-1.5 transition-all duration-500 border-2">
                        <div class="absolute inset-0 opacity-20 dark:opacity-40 transition-colors duration-500"
                            id="status-bg"></div>
                        <div
                            class="relative h-full bg-white/90 dark:bg-slate-800/90 backdrop-blur-xl rounded-[1.3rem] p-6 sm:p-8 flex items-center justify-between gap-4 shadow-2xl">
                            <div>
                                <h3
                                    class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-2">
                                    Status Risiko</h3>
                                <div id="status-text" class="text-3xl sm:text-4xl font-black tracking-tight mb-2">--
                                </div>
                                <p class="text-sm text-slate-600 dark:text-slate-300 leading-snug" id="status-desc">
                                    Menganalisis hasil AI...</p>
                            </div>
                            <div id="status-icon-container"
                                class="w-16 h-16 sm:w-20 sm:h-20 shrink-0 rounded-full flex items-center justify-center shadow-xl border-4 border-white dark:border-slate-800 transition-colors duration-500 bg-slate-100 dark:bg-slate-700">
                            </div>
                        </div>
                    </div>

                    <!-- Safety Action Checklist -->
                    <div
                        class="bg-white dark:bg-slate-800 rounded-3xl p-6 sm:p-8 shadow-xl shadow-slate-200/50 dark:shadow-none border border-slate-100 dark:border-slate-700 flex flex-col flex-1">
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                </path>
                            </svg>
                            Tindakan Keselamatan
                        </h3>
                        <div id="checklist-container" class="space-y-3 flex-1">
                            <div class="text-sm text-slate-500 dark:text-slate-400 italic">Menunggu hasil diagnosis
                                AI...</div>
                        </div>
                    </div>
                </div>

                <!-- RIGHT COLUMN: Map & Chart -->
                <div class="lg:col-span-7 flex flex-col gap-6 h-[45rem] lg:h-auto overflow-hidden">

                    <!-- Interactive Map Container -->
                    <div
                        class="bg-white dark:bg-slate-800 shadow-xl shadow-slate-200/50 dark:shadow-none border border-slate-100 dark:border-slate-700 rounded-3xl p-2 flex-1 relative overflow-hidden group min-h-[300px]">
                        <div id="map" class="w-full h-full rounded-[1.2rem] z-10"></div>
                        <div
                            class="absolute inset-0 pointer-events-none rounded-3xl ring-1 ring-inset ring-black/10 dark:ring-white/10 z-20">
                        </div>
                    </div>

                    <!-- Historical Chart Card -->
                    <div
                        class="bg-white dark:bg-slate-800 rounded-3xl p-6 shadow-xl shadow-slate-200/50 dark:shadow-none border border-slate-100 dark:border-slate-700 h-64 shrink-0">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-sm font-bold text-slate-900 dark:text-white uppercase tracking-widest">
                                Riwayat Suhu & Hujan (24 Jam)</h3>
                        </div>
                        <div class="relative w-full h-[85%]">
                            <canvas id="weatherChart"></canvas>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Geolocation Error Modal -->
    <div id="geo-modal"
        class="fixed inset-0 z-[1000] flex items-center justify-center p-4 opacity-0 pointer-events-none transition-all duration-300">
        <div class="absolute inset-0 bg-slate-900/80 backdrop-blur-sm" id="btn-backdrop-close"></div>
        <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 md:p-8 max-w-sm w-full relative z-10 shadow-2xl border border-slate-200 dark:border-slate-700 transform scale-95 transition-transform duration-300"
            id="geo-modal-content">
            <div
                class="w-14 h-14 rounded-full bg-yellow-100 dark:bg-yellow-500/20 flex items-center justify-center mx-auto mb-4 border-4 border-white dark:border-slate-800 shadow-md">
                <svg class="w-7 h-7 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                    </path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-center text-slate-900 dark:text-white mb-2">Akses Lokasi Dibutuhkan</h3>
            <p class="text-slate-500 dark:text-slate-400 text-center text-sm mb-6 leading-relaxed">Mohon izinkan akses
                GPS pada browser Anda agar kami bisa memberikan peringatan dini cuaca secara akurat.</p>
            <div class="flex flex-col gap-3">
                <button id="btn-retry-geo"
                    class="w-full py-3 px-4 bg-blue-600 hover:bg-blue-700 active:scale-95 text-white rounded-xl font-semibold transition-all shadow-lg shadow-blue-500/30">Coba
                    Lagi</button>
                <button id="btn-close-geo"
                    class="w-full py-3 px-4 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 active:scale-95 text-slate-700 dark:text-slate-300 rounded-xl font-semibold transition-all">Tutup</button>
            </div>
        </div>
    </div>

    <!-- Application Logic -->
    <script>
        // DOM Elements
        const btnDetect = document.getElementById('btn-detect');
        const loadingSection = document.getElementById('loading');
        const resultsSection = document.getElementById('results');

        const cityName = document.getElementById('city-name');
        const tempVal = document.getElementById('temp-val');
        const humidVal = document.getElementById('humid-val');
        const rainVal = document.getElementById('rain-val');

        const statusCard = document.getElementById('status-card');
        const statusBg = document.getElementById('status-bg');
        const statusIconContainer = document.getElementById('status-icon-container');
        const statusText = document.getElementById('status-text');
        const statusDesc = document.getElementById('status-desc');
        const checklistContainer = document.getElementById('checklist-container');
        const timestampVal = document.getElementById('timestamp-val');

        const geoModal = document.getElementById('geo-modal');
        const geoModalContent = document.getElementById('geo-modal-content');
        const btnRetryGeo = document.getElementById('btn-retry-geo');
        const btnCloseGeo = document.getElementById('btn-close-geo');
        const btnBackdropClose = document.getElementById('btn-backdrop-close');

        // State Variables
        let mapInstance = null;
        let mapCircle = null;
        let mapMarker = null;
        let chartInstance = null;

        // Constants for UI Statuses
        const statuses = {
            'Aman': {
                hex: '#10b981',
                cardColor: 'border-emerald-500',
                bgColor: 'bg-emerald-500',
                textColor: 'text-emerald-500 dark:text-emerald-400',
                desc: 'Kondisi cuaca di lokasi Anda saat ini terpantau aman.',
                icon: `<svg class="w-10 h-10 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>`,
                checklist: [
                    "Lanjutkan aktivitas seperti biasa.",
                    "Tetap pantau informasi cuaca ringan jika bepergian jauh.",
                    "Periksa persediaan air dan kondisi rumah harian."
                ]
            },
            'Waspada': {
                hex: '#f59e0b',
                cardColor: 'border-amber-500',
                bgColor: 'bg-amber-500',
                textColor: 'text-amber-500 dark:text-amber-400',
                desc: 'Ada perubahan anomali cuaca. Potensi risiko menengah.',
                icon: `<svg class="w-10 h-10 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>`,
                checklist: [
                    "Siapkan Tas Siaga Bencana darurat.",
                    "Periksa dan bersihkan saluran air/drainase.",
                    "Amankan dokumen penting di tempat kedap air.",
                    "Pantau terus informasi dari BMKG/Otoritas lokal."
                ]
            },
            'Bahaya': {
                hex: '#f43f5e',
                cardColor: 'border-rose-500',
                bgColor: 'bg-rose-500',
                textColor: 'text-rose-500 dark:text-rose-400',
                desc: 'Peringatan Ekstrem! Segera bertindak untuk keselamatan.',
                icon: `<svg class="w-10 h-10 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>`,
                checklist: [
                    "Evakuasi ke tempat yang lebih tinggi/aman segera.",
                    "Matikan aliran listrik dan gas di rumah.",
                    "Jangan menerobos genangan air hujan beras/banjir.",
                    "Hubungi layanan darurat lokal jika terjebak."
                ]
            },
            'Error': {
                hex: '#64748b',
                cardColor: 'border-slate-500',
                bgColor: 'bg-slate-500',
                textColor: 'text-slate-500 dark:text-slate-400',
                desc: 'Connection Error: Gagal menghubungi server atau API penyedia data.',
                icon: `<svg class="w-10 h-10 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M18.364 5.636a9 9 0 010 12.728m0 0l-2.829-2.829m2.829 2.829L21 21M15.536 8.464a5 5 0 010 7.072m0 0l-2.829-2.829m-4.243-2.829a4.978 4.978 0 01-1.414-2.83m-1.414 5.658a9 9 0 01-2.167-9.238m7.824 2.163a1.5 1.5 0 013.112 0m-3.112 0l1.157 1.157 3.414 3.414"></path></svg>`,
                checklist: [
                    "Periksa koneksi internet Anda.",
                    "Cobalah muat ulang halaman beberapa saat lagi.",
                    "Jika masalah berlanjut, hubungi administrator."
                ]
            }
        };

        // Initialize Map & Chart
        function initMap(lat, lon, statusKey) {
            const sInfo = statuses[statusKey];
            const coord = [lat, lon];

            if (!mapInstance) {
                mapInstance = L.map('map', { zoomControl: false }).setView(coord, 14);

                L.control.zoom({ position: 'bottomright' }).addTo(mapInstance);

                // Menggunakan standard colorful tiles (tanpa filter dark-map)
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '© OpenStreetMap'
                }).addTo(mapInstance);
            } else {
                mapInstance.setView(coord, 14);
            }

            // Remove previous marker/circle
            if (mapMarker) mapInstance.removeLayer(mapMarker);
            if (mapCircle) mapInstance.removeLayer(mapCircle);

            // Add marker
            const markerHtml = `<div class="w-4 h-4 rounded-full bg-blue-600 border-2 border-white shadow-[0_0_10px_rgba(37,99,235,1)]"></div>`;
            const customIcon = L.divIcon({ className: '', html: markerHtml, iconSize: [16, 16], iconAnchor: [8, 8] });
            mapMarker = L.marker(coord, { icon: customIcon }).addTo(mapInstance);

            // Add Danger Radius Circle
            let radius = statusKey === 'Bahaya' ? 2000 : (statusKey === 'Waspada' ? 1000 : 500);
            mapCircle = L.circle(coord, {
                color: sInfo.hex,
                fillColor: sInfo.hex,
                fillOpacity: 0.15,
                weight: 2,
                dashArray: '5, 5',
                radius: radius
            }).addTo(mapInstance);

            setTimeout(() => { mapInstance.invalidateSize(); }, 400);
        }

        async function initChart(lat, lon) {
            try {
                // Fetch Historical Open-Meteo Data (with explicit timezone)
                const res = await fetch(`https://api.open-meteo.com/v1/forecast?latitude=${lat}&longitude=${lon}&hourly=temperature_2m,rain&past_days=1&timezone=Asia%2FJakarta`);
                if (!res.ok) throw new Error("Gagal mengambil data riwayat");

                const data = await res.json();

                const times = data.hourly.time;
                const temps = data.hourly.temperature_2m;
                const rains = data.hourly.rain;

                const sliceN = -24;
                const recentTimes = times.slice(sliceN).map(t => new Date(t).getHours() + ':00 WIB');
                const recentTemps = temps.slice(sliceN);
                const recentRains = rains.slice(sliceN);

                const ctx = document.getElementById('weatherChart').getContext('2d');

                const isDark = document.documentElement.classList.contains('dark');
                const gridColor = isDark ? 'rgba(255, 255, 255, 0.05)' : 'rgba(0, 0, 0, 0.05)';
                const textColor = isDark ? '#9ca3af' : '#64748b';

                if (chartInstance) chartInstance.destroy();

                chartInstance = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: recentTimes,
                        datasets: [
                            {
                                label: 'Suhu (°C)',
                                data: recentTemps,
                                borderColor: '#3b82f6',
                                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                                tension: 0.4,
                                fill: true,
                                yAxisID: 'y'
                            },
                            {
                                label: 'Hujan (mm)',
                                data: recentRains,
                                borderColor: '#8b5cf6',
                                backgroundColor: 'rgba(139, 92, 246, 0.3)',
                                type: 'bar',
                                yAxisID: 'y1',
                                borderRadius: 4
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        interaction: { mode: 'index', intersect: false },
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top',
                                align: 'end',
                                labels: { color: textColor, boxWidth: 12, font: { family: 'Inter' } }
                            }
                        },
                        scales: {
                            x: {
                                grid: { display: false },
                                ticks: { color: textColor, maxTicksLimit: 8, font: { family: 'Inter' } }
                            },
                            y: {
                                type: 'linear', display: true, position: 'left',
                                grid: { color: gridColor },
                                ticks: { color: textColor, font: { family: 'Inter' } }
                            },
                            y1: {
                                type: 'linear', display: true, position: 'right',
                                grid: { drawOnChartArea: false },
                                ticks: { color: textColor, font: { family: 'Inter' } },
                                min: 0,
                                // Berikan sedikit ruang lebih agar batang hujan tidak "mentok" ke atas jika nilainya kecil
                                suggestedMax: Math.max(...recentRains) > 0 ? Math.max(...recentRains) * 1.5 : 10
                            }
                        }
                    }
                });
            } catch (err) {
                console.error("Chart Error:", err);
            }
        }

        function populateChecklist(statusKey) {
            const checklist = statuses[statusKey].checklist;
            const colorClass = statuses[statusKey].textColor;

            checklistContainer.innerHTML = '';
            checklist.forEach((item, index) => {
                const delay = index * 100;
                const div = document.createElement('div');
                div.className = `flex items-start gap-3 p-3 rounded-2xl bg-slate-50 dark:bg-slate-700/50 border border-slate-100 dark:border-slate-700 animate-[fadeIn_0.5s_ease-out_forwards] opacity-0`;
                div.style.animationDelay = `${delay}ms`;
                div.innerHTML = `
                    <div class="mt-0.5 w-5 h-5 shrink-0 rounded-full flex items-center justify-center bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-600 shadow-sm ${colorClass}">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <p class="text-sm font-medium text-slate-700 dark:text-slate-300 leading-relaxed">${item}</p>
                `;
                checklistContainer.appendChild(div);
            });
        }

        // Geo Modal Logic
        function showGeoModal() {
            geoModal.classList.remove('opacity-0', 'pointer-events-none');
            geoModal.classList.add('opacity-100', 'pointer-events-auto');
            geoModalContent.classList.remove('scale-95');
            geoModalContent.classList.add('scale-100');
        }

        function hideGeoModal() {
            geoModal.classList.remove('opacity-100', 'pointer-events-auto');
            geoModal.classList.add('opacity-0', 'pointer-events-none');
            geoModalContent.classList.remove('scale-100');
            geoModalContent.classList.add('scale-95');
        }

        btnRetryGeo.addEventListener('click', () => {
            hideGeoModal();
            setTimeout(() => { btnDetect.click(); }, 300);
        });

        btnCloseGeo.addEventListener('click', hideGeoModal);
        btnBackdropClose.addEventListener('click', hideGeoModal);

        // Main Interaction
        btnDetect.addEventListener('click', () => {
            if (!navigator.geolocation) {
                return;
            }

            // Fungsi untuk mengambil lokasi dan trigger UI Fetch
            const requestLocation = () => {
                // Set loading state
                btnDetect.disabled = true;
                btnDetect.classList.add('opacity-70', 'cursor-not-allowed', 'scale-95');

                resultsSection.classList.remove('opacity-100');
                resultsSection.classList.add('opacity-0');
                setTimeout(() => {
                    resultsSection.classList.add('hidden');

                    loadingSection.classList.remove('hidden', 'opacity-0');
                    loadingSection.classList.add('flex', 'w-full');

                    setTimeout(() => loadingSection.classList.add('opacity-100'), 50);
                }, 300);

                // Fetch lat dan lon
                navigator.geolocation.getCurrentPosition(
                    position => {
                        const lat = position.coords.latitude;
                        const lon = position.coords.longitude;
                        fetchData(lat, lon);
                    },
                    error => {
                        console.warn("Geolocation API Error:", error.message);
                        resetUI();

                        // Silently reset loading state and pop modal instead of freezing
                        loadingSection.classList.remove('opacity-100');
                        loadingSection.classList.add('opacity-0');
                        setTimeout(() => {
                            loadingSection.classList.add('hidden');
                            loadingSection.classList.remove('flex', 'w-full');
                            showGeoModal();
                        }, 300);
                    },
                    { enableHighAccuracy: true, timeout: 15000, maximumAge: Infinity }
                );
            };

            // 🔍 CEK STATUS PERMISSION DULU
            if (navigator.permissions) {
                navigator.permissions.query({ name: 'geolocation' }).then(result => {
                    console.log("Permission status:", result.state);

                    if (result.state === 'denied') {
                        showGeoModal(); // Muncul modal dulu jika denied
                        return;
                    }

                    requestLocation(); // Panggil fetch jika prompt/granted
                });
            } else {
                requestLocation(); // Fallback untuk browser lawas
            }
        });

        // Backend call
        async function fetchData(lat, lon) {
            try {
                const response = await fetch('/cek-cuaca', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ lat, lon })
                });

                if (!response.ok) {
                    const errData = await response.json();
                    throw new Error(errData.error || 'Kesalahan server aplikasi web');
                }

                const data = await response.json();

                let statusStr = "Aman";
                const rawString = JSON.stringify(data.prediksi || data.raw_ml || {}).toLowerCase();

                if (rawString.includes('bahaya')) statusStr = 'Bahaya';
                else if (rawString.includes('waspada')) statusStr = 'Waspada';
                else if (rawString.includes('aman')) statusStr = 'Aman';

                updateResults(data, statusStr, lat, lon);

            } catch (error) {
                console.error('Fetch Error:', error);

                // Set explicit error state mapped values rather than alerts
                const errorData = {
                    lokasi: 'Network/Connection Error',
                    suhu: '--',
                    kelembapan: '--',
                    curah_hujan: '--',
                    timestamp: 'Gagal Memuat'
                };
                updateResults(errorData, 'Error', lat, lon);
            }
        }

        // Update UI
        function updateResults(data, statusKey, lat, lon) {
            cityName.textContent = data.lokasi || "Lokasi Anda";
            tempVal.textContent = data.suhu !== '--' ? `${data.suhu} °C` : '-- °C';
            humidVal.textContent = data.kelembapan !== '--' ? `${data.kelembapan} %` : '-- %';
            rainVal.textContent = data.curah_hujan !== '--' ? `${data.curah_hujan} mm` : '-- mm';
            timestampVal.textContent = data.timestamp || new Date().getHours() + ":" + String(new Date().getMinutes()).padStart(2, '0') + " WIB";

            const sInfo = statuses[statusKey] || statuses['Aman'];

            // Status Card UI
            statusCard.className = `relative overflow-hidden rounded-3xl p-1.5 transition-all duration-700 border-2 ${sInfo.cardColor} shadow-2xl`;
            statusBg.className = `absolute inset-0 opacity-20 dark:opacity-40 transition-colors duration-700 ${sInfo.bgColor}`;

            statusIconContainer.innerHTML = sInfo.icon;
            statusIconContainer.className = `w-16 h-16 sm:w-20 sm:h-20 shrink-0 rounded-full flex items-center justify-center shadow-xl border-4 border-white dark:border-slate-800 transition-colors duration-700 bg-slate-100 dark:bg-slate-700 ${sInfo.textColor}`;

            statusText.textContent = statusKey;
            statusText.className = `text-3xl sm:text-4xl font-black tracking-tight mb-2 transition-colors duration-700 ${sInfo.textColor}`;

            statusDesc.textContent = sInfo.desc;

            // Populate Action List
            populateChecklist(statusKey);

            // Map & Chart Init
            initMap(lat, lon, statusKey);
            initChart(lat, lon);

            // Hide loading, show results
            loadingSection.classList.remove('opacity-100');
            loadingSection.classList.add('opacity-0');

            setTimeout(() => {
                loadingSection.classList.add('hidden');
                loadingSection.classList.remove('flex', 'w-full'); // Reset flex container

                resultsSection.classList.remove('hidden', 'opacity-0');
                resetUI();
                setTimeout(() => {
                    resultsSection.classList.add('opacity-100');
                }, 50);
            }, 300);
        }

        function resetUI() {
            btnDetect.disabled = false;
            btnDetect.classList.remove('opacity-70', 'cursor-not-allowed', 'scale-95');
        }

        const style = document.createElement('style');
        style.textContent = `
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(10px); }
                to { opacity: 1; transform: translateY(0); }
            }
        `;
        document.head.appendChild(style);

    </script>
</body>

</html>