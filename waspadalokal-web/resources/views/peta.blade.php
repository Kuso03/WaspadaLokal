<!DOCTYPE html>
<html lang="id" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peta Pantauan | WaspadaLokal</title>
    <meta name="description" content="WaspadaLokal - Sistem Peringatan Dini Real-time dan Deteksi Risiko Berbasis AI.">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png?v=2026') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png?v=2026') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico?v=2026') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png?v=2026') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest?v=2026') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="dicoding:email" content="dhafidwahyukusumo@gmail.com">

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
                    fontFamily: { sans: ['Inter', 'sans-serif'] }
                }
            }
        }
    </script>

    <!-- Leaflet & Geocoder CSS/JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        /* Hide Scrollbar helper */
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Map Styles */
        #map {
            width: 100vw;
            height: 100vh;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 0;
            background: #0f172a;
        }

        /* UI Layer to allow interaction while overlaying map */
        .ui-layer {
            position: relative;
            z-index: 10;
            pointer-events: none;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 1rem;
        }

        .pointer-events-auto {
            pointer-events: auto;
        }

        /* Custom Scrollbar for Checklist */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 8px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 8px;
        }

        /* Pulse Marker Animation */
        .pulse-marker {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            border: 3px solid white;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(0.85);
                box-shadow: 0 0 0 0 var(--pulse-color);
            }

            70% {
                transform: scale(1.1);
                box-shadow: 0 0 0 15px transparent;
            }

            100% {
                transform: scale(0.85);
                box-shadow: 0 0 0 0 transparent;
            }
        }

        .pulse-fast {
            animation: pulse-fast 1s infinite;
        }

        @keyframes pulse-fast {
            0% {
                transform: scale(0.9);
                box-shadow: 0 0 0 0 var(--pulse-color);
            }

            50% {
                transform: scale(1.2);
                box-shadow: 0 0 0 20px transparent;
            }

            100% {
                transform: scale(0.9);
                box-shadow: 0 0 0 0 transparent;
            }
        }

        /* Tooltip Styling */
        .custom-tooltip {
            background-color: rgba(15, 23, 42, 0.9) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: white !important;
            border-radius: 8px !important;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.5) !important;
            font-family: 'Inter', sans-serif;
        }

        .custom-tooltip::before {
            border-top-color: rgba(15, 23, 42, 0.9) !important;
        }

        /* Override Leaflet controls styling for Dark Mode & Premium UI */
        .leaflet-bar {
            border: none !important;
            box-shadow: 0 10px 40px -10px rgba(0, 0, 0, 0.8) !important;
            border-radius: 12px !important;
            overflow: hidden;
        }

        .leaflet-bar a {
            background-color: rgba(30, 41, 59, 0.9) !important;
            color: #cbd5e1 !important;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05) !important;
            transition: all 0.3s ease;
        }

        /* Mobile specific adjustments to avoid Top Navigation Overlap */
        @media (max-width: 1024px) {
            .leaflet-top.leaflet-right {
                top: 120px !important;
                /* Push Geocoder below navigation */
            }
        }

        .leaflet-bar a:hover {
            background-color: rgba(51, 65, 85, 0.9) !important;
            color: white !important;
        }

        /* Geocoder Search Bar */
        .leaflet-control-geocoder {
            border-radius: 16px !important;
            box-shadow: 0 10px 40px -10px rgba(0, 0, 0, 0.8) !important;
            background: rgba(15, 23, 42, 0.85) !important;
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            transition: all 0.3s ease !important;
        }

        .leaflet-control-geocoder-icon {
            background-color: transparent !important;
            border-radius: 16px 0 0 16px;
            filter: invert(1);
            opacity: 0.7;
            width: 44px !important;
            height: 44px !important;
        }

        .leaflet-control-geocoder-icon:hover {
            opacity: 1;
        }

        .leaflet-control-geocoder-expanded {
            padding: 6px 8px;
        }

        .leaflet-control-geocoder-form input {
            background-color: transparent !important;
            color: white !important;
            border: none !important;
            font-family: 'Inter', sans-serif;
            font-size: 16px;
            padding: 0;
            width: 0;
            height: 44px;
            opacity: 0;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .leaflet-control-geocoder-expanded .leaflet-control-geocoder-form input {
            width: 280px;
            max-width: calc(100vw - 85px);
            padding: 12px 16px 12px 0;
            opacity: 1;
            cursor: text;
        }

        .leaflet-control-geocoder-form input:focus {
            outline: none !important;
        }

        .leaflet-control-geocoder-form input::placeholder {
            color: #64748b;
        }

        /* Geocoder Autocomplete Dropdown */
        .leaflet-control-geocoder-alternatives {
            background-color: rgba(15, 23, 42, 0.95) !important;
            backdrop-filter: blur(16px);
            color: #cbd5e1 !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            border-radius: 12px !important;
            margin-top: 8px !important;
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.8) !important;
            overflow: hidden !important;
            padding: 0;
            min-width: 100% !important;
            width: 320px !important;
            max-width: calc(100vw - 32px) !important;
        }

        .leaflet-control-geocoder-alternatives li {
            padding: 10px 16px !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05) !important;
            transition: background-color 0.2s ease;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            white-space: normal !important;
            word-wrap: break-word !important;
            line-height: 1.4;
        }

        .leaflet-control-geocoder-alternatives li a {
            color: #cbd5e1 !important;
            text-decoration: none !important;
            display: block !important;
            white-space: normal !important;
            word-break: break-word;
        }

        .leaflet-control-geocoder-alternatives li:last-child {
            border-bottom: none !important;
        }

        .leaflet-control-geocoder-alternatives li:hover,
        .leaflet-control-geocoder-selected {
            background-color: rgba(59, 130, 246, 0.2) !important;
            cursor: pointer;
        }

        .leaflet-control-geocoder-alternatives li:hover a,
        .leaflet-control-geocoder-selected a {
            color: white !important;
        }
    </style>
</head>

<body class="bg-slate-900 text-slate-50 antialiased selection:bg-blue-700 overflow-hidden w-full h-screen">

    <!-- Leaflet Map Container -->
    <div id="map"></div>

    <!-- Floating UI Layer -->
    <div class="ui-layer">

        <!-- Responsive Navigation Bar (Bottom Tabs on Mobile, Top Pill on Desktop) -->
        <div
            class="fixed bottom-0 left-0 w-full md:w-auto md:absolute md:top-6 md:left-1/2 md:-translate-x-1/2 md:bottom-auto pointer-events-auto z-[1000] pb-2 md:pb-0 px-2 sm:px-0 transition-transform duration-300 shadow-[0_-10px_20px_rgba(0,0,0,0.5)] md:shadow-none">
            <nav
                class="flex justify-around md:justify-center gap-1 sm:gap-2 md:gap-4 bg-slate-900/95 md:bg-slate-900/85 backdrop-blur-xl p-2 sm:p-2.5 rounded-2xl md:rounded-full border border-slate-700/80 md:shadow-[0_10px_40px_-10px_rgba(0,0,0,0.8)] w-full max-w-md mx-auto md:max-w-none">

                <a href="/"
                    class="flex flex-col md:flex-row items-center justify-center min-h-[44px] px-2 md:px-6 py-1.5 md:py-2 rounded-xl md:rounded-full font-medium transition-all duration-200 active:scale-95 text-slate-400 hover:text-white hover:bg-slate-800 text-[10px] md:text-base border border-transparent flex-1 md:flex-none">
                    <svg class="w-5 h-5 mb-1 md:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span class="md:hidden">Deteksi</span>
                    <span class="hidden md:inline">Deteksi Saya</span>
                </a>

                <a href="/peta-pantauan"
                    class="flex flex-col md:flex-row items-center justify-center min-h-[44px] px-2 md:px-6 py-1.5 md:py-2 rounded-xl md:rounded-full font-medium transition-all duration-200 active:scale-95 bg-blue-600/20 md:bg-blue-600 text-blue-400 md:text-white md:shadow-lg md:shadow-blue-500/30 text-[10px] md:text-base border border-blue-500/30 md:border-blue-500 flex-1 md:flex-none">
                    <svg class="w-5 h-5 mb-1 md:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7">
                        </path>
                    </svg>
                    <span class="md:hidden">Peta</span>
                    <span class="hidden md:inline">Peta Nasional</span>
                </a>

                <a href="/pusat-peringatan"
                    class="flex flex-col md:flex-row items-center justify-center min-h-[44px] px-2 md:px-6 py-1.5 md:py-2 rounded-xl md:rounded-full font-medium transition-all duration-200 active:scale-95 text-rose-400 hover:text-rose-300 hover:bg-slate-800 text-[10px] md:text-base border border-transparent flex-1 md:flex-none focus:outline-none">
                    <div class="relative md:hidden mb-1 flex justify-center w-full">
                        <svg class="w-5 h-5 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                            </path>
                        </svg>
                        <span
                            class="absolute top-0 right-1/2 -mr-3 w-2 h-2 rounded-full bg-rose-500 animate-[pulse-fast_1s_infinite]"></span>
                    </div>
                    <span
                        class="hidden md:inline-block w-2.5 h-2.5 rounded-full bg-rose-500 animate-[pulse-fast_1s_infinite] mr-2"></span>
                    <span class="md:hidden">BMKG</span>
                    <span class="hidden md:inline">Info BMKG</span>
                </a>

                <a href="/panduan"
                    class="flex flex-col md:flex-row items-center justify-center min-h-[44px] px-2 md:px-6 py-1.5 md:py-2 rounded-xl md:rounded-full font-medium transition-all duration-200 active:scale-95 text-slate-400 hover:text-white hover:bg-slate-800 text-[10px] md:text-base border border-transparent flex-1 md:flex-none">
                    <svg class="w-5 h-5 mb-1 md:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                        </path>
                    </svg>
                    Panduan
                </a>

            </nav>
        </div>

        <!-- Absolute Center Loading Overlay -->
        <div id="loading"
            class="fixed inset-0 bg-slate-900/60 backdrop-blur-md pointer-events-auto flex flex-col items-center justify-center z-[2000] transition-opacity duration-500 opacity-0 hidden">
            <div
                class="w-16 h-16 border-4 border-slate-700 border-t-blue-500 rounded-full animate-spin mb-6 shadow-[0_0_30px_rgba(59,130,246,0.6)]">
            </div>
            <p class="text-white font-semibold text-lg sm:text-xl tracking-wide drop-shadow-md">Menganalisis Titik
                Lokasi...</p>
            <p class="text-slate-400 text-sm mt-2">Menghubungkan ke satelit AI</p>
        </div>

        <!-- Custom Error Toast -->
        <div id="error-toast"
            class="fixed top-4 left-1/2 -translate-x-1/2 z-[3000] transition-all duration-500 -translate-y-[150%] opacity-0 pointer-events-none w-[90%] max-w-sm">
            <div
                class="bg-rose-950/90 backdrop-blur-lg border border-rose-500/50 rounded-2xl p-4 shadow-[0_10px_40px_-10px_rgba(225,29,72,0.8)] flex items-start gap-3">
                <div
                    class="mt-0.5 w-8 h-8 rounded-full bg-rose-500/20 text-rose-400 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                        </path>
                    </svg>
                </div>
                <div class="flex-1">
                    <h4 class="text-white font-bold text-sm mb-1">Koneksi Gagal</h4>
                    <p id="error-toast-msg" class="text-rose-200 text-xs leading-relaxed">Gagal mengambil data prediksi.
                        Silakan coba titik lain atau periksa koneksi Anda.</p>
                </div>
            </div>
        </div>

        <!-- Map Legend -->
        <div id="map-legend" onclick="this.classList.toggle('!w-[160px]'); this.classList.toggle('!h-[136px]');"
            class="absolute top-[80px] right-2 lg:bottom-8 lg:top-auto lg:right-auto lg:left-8 z-[100] bg-slate-900/90 backdrop-blur-md border border-slate-700/80 rounded-2xl shadow-[0_10px_40px_-10px_rgba(0,0,0,0.8)] pointer-events-auto transition-all duration-300 opacity-100 overflow-hidden w-[44px] h-[44px] lg:!w-auto lg:!h-auto lg:p-4 group cursor-pointer flex flex-col items-center justify-start lg:items-start lg:justify-start">

            <!-- Mobile Collapsed Icon -->
            <div
                class="lg:hidden w-[44px] h-[44px] shrink-0 text-slate-400 group-hover:text-white flex items-center justify-center transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>

            <!-- Expanding Content -->
            <div
                class="w-full opacity-0 group-hover:opacity-100 lg:group-hover:opacity-100 lg:opacity-100 transition-opacity duration-300 px-3 lg:px-0">
                <h4
                    class="text-[0.65rem] lg:text-xs font-bold text-slate-400 uppercase tracking-widest mb-2 lg:mb-3 whitespace-nowrap mt-2 lg:mt-0 text-center lg:text-left">
                    Legenda Radius AI
                </h4>
                <div class="flex flex-col gap-1.5 lg:gap-2.5 text-[0.7rem] lg:text-sm whitespace-nowrap">
                    <div class="flex items-center gap-2 lg:gap-3">
                        <div
                            class="w-2.5 h-2.5 lg:w-3 lg:h-3 rounded-full bg-emerald-500 shadow-[0_0_10px_rgba(16,185,129,0.8)]">
                        </div>
                        <span class="text-slate-300 font-medium">Status Aman</span>
                    </div>
                    <div class="flex items-center gap-2 lg:gap-3">
                        <div
                            class="w-2.5 h-2.5 lg:w-3 lg:h-3 rounded-full bg-amber-500 shadow-[0_0_10px_rgba(245,158,11,0.8)]">
                        </div>
                        <span class="text-slate-300 font-medium">Status Waspada</span>
                    </div>
                    <div class="flex items-center gap-2 lg:gap-3">
                        <div
                            class="w-2.5 h-2.5 lg:w-3 lg:h-3 rounded-full bg-rose-500 shadow-[0_0_10px_rgba(244,63,94,0.8)] animate-[pulse_1s_infinite]">
                        </div>
                        <span class="text-slate-300 font-bold text-rose-400">Status Bahaya</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Panels Container -->
        <div id="panels-container"
            class="w-full mt-auto flex flex-row lg:flex-col pointer-events-none gap-4 relative lg:static h-full items-end lg:items-stretch lg:justify-end pb-[120px] lg:pb-0 px-4 lg:px-0 z-[1050] overflow-x-auto overflow-y-hidden pt-4 lg:overflow-visible snap-x snap-mandatory hide-scrollbar">

            <!-- Left Side: Result Panel -->
            <div class="w-[85vw] sm:w-[85vw] max-w-sm sm:max-w-md lg:w-auto mx-auto lg:mx-0 lg:absolute lg:bottom-8 lg:left-8 pointer-events-auto transition-all duration-700 translate-y-[150%] lg:translate-y-0 lg:-translate-x-[150%] opacity-0 shrink-0 snap-center flex-none"
                id="result-panel">
                <div
                    class="bg-slate-900/85 backdrop-blur-2xl rounded-[1.5rem] lg:rounded-[2rem] p-5 lg:p-7 border border-slate-700 shadow-[0_20px_60px_-15px_rgba(0,0,0,0.8)] relative overflow-hidden group">


                    <!-- Inner dynamic status background -->
                    <div id="panel-bg"
                        class="absolute inset-0 opacity-10 transition-colors duration-700 pointer-events-none"></div>

                    <div class="relative z-10">
                        <!-- Close Button -->
                        <button id="btn-close"
                            class="absolute top-2 right-2 min-w-[44px] min-h-[44px] p-2 flex items-center justify-center text-slate-400 hover:text-white hover:bg-slate-800 active:scale-90 transition-all rounded-full focus:outline-none z-20">
                            <svg class="w-5 h-5 lg:w-6 lg:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>

                        <!-- Location Title -->
                        <h2
                            class="text-xl lg:text-2xl font-bold mb-5 flex items-center gap-3 pr-10 text-white leading-tight">
                            <svg class="w-7 h-7 text-blue-400 shrink-0 drop-shadow-md" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                            </svg>
                            <span id="city-name" class="truncate" title="Nama Lokasi">--</span>
                        </h2>

                        <!-- Weather Info Grid -->
                        <div class="grid grid-cols-3 gap-3 lg:gap-4 mb-6">
                            <div
                                class="bg-slate-800/80 rounded-2xl p-3 text-center border border-slate-700 shadow-inner">
                                <p
                                    class="text-[0.65rem] lg:text-xs text-slate-400 font-medium uppercase tracking-wider mb-1">
                                    Suhu</p>
                                <p class="font-bold text-white text-lg lg:text-xl" id="temp-val">--°</p>
                            </div>
                            <div
                                class="bg-slate-800/80 rounded-2xl p-3 text-center border border-slate-700 shadow-inner">
                                <p
                                    class="text-[0.65rem] lg:text-xs text-slate-400 font-medium uppercase tracking-wider mb-1">
                                    Lembap</p>
                                <p class="font-bold text-blue-400 text-lg lg:text-xl" id="humid-val">--%</p>
                            </div>
                            <div
                                class="bg-slate-800/80 rounded-2xl p-3 text-center border border-slate-700 shadow-inner">
                                <p
                                    class="text-[0.65rem] lg:text-xs text-slate-400 font-medium uppercase tracking-wider mb-1">
                                    Hujan(1j)</p>
                                <p class="font-bold text-indigo-400 text-lg lg:text-xl" id="rain-val">-- mm</p>
                            </div>
                        </div>

                        <!-- AI Status Indicator -->
                        <div id="status-container"
                            class="flex items-center gap-4 lg:gap-5 p-4 lg:p-5 rounded-2xl border mb-5 transition-all duration-700 bg-slate-800/50 shadow-lg">
                            <div id="status-icon-wrapper"
                                class="w-14 h-14 lg:w-16 lg:h-16 rounded-full flex items-center justify-center shrink-0 shadow-inner transition-colors duration-700">
                                <!-- Icon injected via JS -->
                            </div>
                            <div>
                                <p class="text-xs text-slate-400 font-bold uppercase tracking-[0.2em] mb-1">Status AI
                                </p>
                                <p id="status-text"
                                    class="text-2xl lg:text-3xl font-black tracking-tight leading-none text-white">--
                                </p>
                            </div>
                        </div>

                        <!-- Checklist -->
                        <div>
                            <p
                                class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-3 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                    </path>
                                </svg>
                                Tindakan
                            </p>
                            <div id="checklist-container"
                                class="space-y-2.5 max-h-36 lg:max-h-48 overflow-y-auto pr-3 custom-scrollbar text-sm font-medium">
                                <div class="text-slate-500 italic">Menunggu data...</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Right Side: 24-Hour Forecast Panel -->
            <div class="w-[85vw] sm:w-[85vw] max-w-sm sm:max-w-md lg:w-96 lg:max-w-full mx-auto lg:mx-0 lg:absolute lg:top-[5.5rem] lg:right-8 lg:bottom-8 pointer-events-auto transition-all duration-700 translate-y-[150%] lg:translate-y-0 lg:translate-x-[150%] opacity-0 shrink-0 flex flex-col justify-end lg:justify-start mt-4 lg:mt-0 snap-center flex-none"
                id="forecast-panel">
                <div
                    class="bg-slate-900/85 backdrop-blur-2xl rounded-[1.5rem] lg:rounded-[2rem] p-4 lg:p-6 border border-slate-700 shadow-[0_20px_60px_-15px_rgba(0,0,0,0.8)] flex flex-col h-full lg:overflow-hidden relative group">
                    <!-- Close Button for Forecast Panel -->
                    <button id="btn-close-forecast"
                        class="absolute top-2 right-2 min-w-[44px] min-h-[44px] p-2 flex items-center justify-center text-slate-400 hover:text-white hover:bg-slate-800 active:scale-90 transition-all rounded-full focus:outline-none z-20">
                        <svg class="w-5 h-5 lg:w-6 lg:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                    <h3 class="text-base lg:text-lg font-bold text-white mb-3 lg:mb-4 flex items-center gap-2 shrink-0">
                        <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Prakiraan 24 Jam
                    </h3>

                    <div class="flex-1 flex flex-col gap-3 lg:gap-4 overflow-hidden">
                        <!-- Chart Container (Swipeable on Mobile) -->
                        <div
                            class="h-32 lg:h-48 w-full relative shrink-0 overflow-x-auto overflow-y-hidden custom-scrollbar pb-2">
                            <div class="min-w-[500px] lg:min-w-0 h-full w-full relative">
                                <canvas id="forecastChart"></canvas>
                            </div>
                        </div>

                        <!-- Hourly Cards -->
                        <div id="hourly-container"
                            class="flex flex-row flex-nowrap lg:flex-col overflow-x-auto lg:overflow-x-hidden lg:overflow-y-auto gap-2 lg:gap-3 pb-2 lg:pb-0 lg:pr-2 custom-scrollbar snap-x lg:snap-y shrink-0 lg:shrink lg:flex-1">
                            <!-- Injected via JS -->
                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- End Panels Container -->
    </div>

    <!-- Application Logic -->
    <script>
        // Data Statuses
        const statuses = {
            'Aman': {
                hex: '#10b981',
                cardBorder: 'border-emerald-500/30',
                iconBg: 'bg-emerald-500/20 text-emerald-400',
                textColor: 'text-emerald-400',
                icon: `<svg class="w-7 h-7 lg:w-8 lg:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>`,
                checklist: [
                    "Lanjutkan aktivitas seperti biasa.",
                    "Cuaca terpantau cerah atau sangat ringan.",
                    "Periksa info cuaca harian jika akan bepergian."
                ]
            },
            'Waspada': {
                hex: '#f59e0b',
                cardBorder: 'border-amber-500/40',
                iconBg: 'bg-amber-500/20 text-amber-400',
                textColor: 'text-amber-400',
                icon: `<svg class="w-7 h-7 lg:w-8 lg:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>`,
                checklist: [
                    "Siapkan Tas Siaga Bencana.",
                    "Periksa drainase sekitar agar tidak tersumbat.",
                    "Pantau terus informasi otoritas terkait.",
                    "Hati-hati beraktivitas di luar ruangan."
                ]
            },
            'Bahaya': {
                hex: '#f43f5e',
                cardBorder: 'border-rose-500/60 shadow-[0_0_20px_rgba(244,63,94,0.3)]',
                iconBg: 'bg-rose-500/20 text-rose-400',
                textColor: 'text-rose-400',
                icon: `<svg class="w-7 h-7 lg:w-8 lg:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>`,
                checklist: [
                    "WASPADA TINGKAT TINGGI!",
                    "Evakuasi segera ke tempat yang lebih aman.",
                    "Matikan seluruh aliran listrik/gas.",
                    "Jauhi bantaran sungai atau area rawan longsor."
                ]
            }
        };

        // Initialize Map
        // Fokus awal: Titik tengah Indonesia
        const map = L.map('map', {
            zoomControl: false,
            minZoom: 4
        }).setView([-2.5489, 118.0149], 5);

        // Posisikan zoom control ke kanan bawah atau atas
        L.control.zoom({ position: 'bottomright' }).addTo(map);

        // CartoDB Dark Matter Tiles for Premium Dark Mode Vibe
        L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>'
        }).addTo(map);

        // Leaflet Geocoder Control
        const geocoder = L.Control.geocoder({
            defaultMarkGeocode: false,
            position: 'topright',
            placeholder: 'Cari Kota/Daerah...',
            errorMessage: 'Lokasi tidak ditemukan.'
        }).addTo(map);

        geocoder.on('markgeocode', function (e) {
            const latlng = e.geocode.center;
            map.flyTo(latlng, 12, { duration: 1.5 });
            fetchPrediction(latlng.lat, latlng.lng);
        });

        // DOM Elements
        const loadingOverlay = document.getElementById('loading');
        const errorToast = document.getElementById('error-toast');
        const errorToastMsg = document.getElementById('error-toast-msg');
        const panelsContainer = document.getElementById('panels-container');
        const resultPanel = document.getElementById('result-panel');
        const btnClose = document.getElementById('btn-close');
        const btnCloseForecast = document.getElementById('btn-close-forecast');
        const mapLegend = document.getElementById('map-legend');

        // Form elements
        const cityName = document.getElementById('city-name');
        const tempVal = document.getElementById('temp-val');
        const humidVal = document.getElementById('humid-val');
        const rainVal = document.getElementById('rain-val');
        const panelBg = document.getElementById('panel-bg');

        const statusContainer = document.getElementById('status-container');
        const statusIconWrapper = document.getElementById('status-icon-wrapper');
        const statusText = document.getElementById('status-text');
        const checklistContainer = document.getElementById('checklist-container');

        // Layers tracking
        let activeMarker = null;
        let activeCircle = null;
        const liveMarkersGroup = L.layerGroup().addTo(map);
        const cityDataCache = {};

        // Live Risk Markers Data from Database
        const majorCities = @json($cities);

        // Initialize Live Markers sequentially on load to prevent blocking PHP server
        async function initLiveMarkers() {
            for (const city of majorCities) {
                try {
                    const response = await fetch('/api/prediksi-kota', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ lat: city.lat, lon: city.lon })
                    });
                    if (response.ok) {
                        const data = await response.json();
                        // Save to cache for instant loading when clicked
                        cityDataCache[city.name] = data;
                        renderLiveMarker(city, data);
                    }
                } catch (e) {
                    console.error("Failed to fetch live data for", city.name);
                }

                // Add a tiny delay between requests to ensure manual clicks are prioritized by the browser queue
                await new Promise(resolve => setTimeout(resolve, 50));
            }
        }

        function renderLiveMarker(city, data) {
            let statusKey = 'Aman';
            const mlStr = JSON.stringify(data.prediksi || data.raw_ml || {}).toLowerCase();
            if (mlStr.includes('bahaya')) statusKey = 'Bahaya';
            else if (mlStr.includes('waspada')) statusKey = 'Waspada';

            const info = statuses[statusKey];
            const animationClass = statusKey === 'Bahaya' ? 'pulse-fast' : 'pulse-marker';

            const iconHtml = `<div class="${animationClass} bg-slate-800" style="--pulse-color: ${info.hex}99; border-color: ${info.hex}; width: 20px; height: 20px; border-width: 2px;">
                              <div class="w-full h-full rounded-full" style="background: ${info.hex};"></div>
                              </div>`;

            const customIcon = L.divIcon({
                className: 'custom-pulse',
                html: iconHtml,
                iconSize: [20, 20],
                iconAnchor: [10, 10]
            });

            const marker = L.marker([city.lat, city.lon], { icon: customIcon });

            marker.bindTooltip(`<b>${city.name}</b><br/><span style="color:${info.hex}">${statusKey}</span>`, {
                direction: 'top',
                offset: [0, -10],
                className: 'custom-tooltip text-center'
            });

            marker.on('click', () => {
                map.flyTo([city.lat, city.lon], 11, { duration: 1.0 });

                // Clear manual temporary marker if exists
                if (activeMarker) map.removeLayer(activeMarker);
                if (activeCircle) map.removeLayer(activeCircle);

                // Show panels instantly from memory and hide legend
                mapLegend.classList.remove('opacity-100', 'pointer-events-auto');
                mapLegend.classList.add('opacity-0', 'pointer-events-none');

                resultPanel.classList.remove('translate-y-0', 'lg:-translate-x-0', 'opacity-100');
                resultPanel.classList.add('translate-y-[150%]', 'lg:-translate-x-[150%]', 'opacity-0');
                forecastPanel.classList.remove('translate-y-0', 'lg:translate-x-0', 'opacity-100');
                forecastPanel.classList.add('translate-y-[150%]', 'lg:translate-x-[150%]', 'opacity-0');

                // Small delay to allow fade out before data swap
                setTimeout(() => {
                    renderPanel(data, statusKey);
                    if (data.hourly_forecast) {
                        renderHourlyForecast(data.hourly_forecast);
                    }
                }, 150);
            });

            liveMarkersGroup.addLayer(marker);
        }

        // Trigger initialization
        initLiveMarkers();

        // Map Click Event
        map.on('click', function (e) {
            map.flyTo(e.latlng, map.getZoom(), { duration: 0.5 });
            fetchPrediction(e.latlng.lat, e.latlng.lng);
        });

        const forecastPanel = document.getElementById('forecast-panel');

        // Close Panel Event
        btnClose.addEventListener('click', () => {
            mapLegend.classList.remove('opacity-0', 'pointer-events-none');
            mapLegend.classList.add('opacity-100', 'pointer-events-auto');

            resultPanel.classList.remove('translate-y-0', 'lg:-translate-x-0', 'opacity-100');
            resultPanel.classList.add('translate-y-[150%]', 'lg:-translate-x-[150%]', 'opacity-0');

            forecastPanel.classList.remove('translate-y-0', 'translate-x-0', 'lg:translate-x-0', 'opacity-100');
            forecastPanel.classList.add('translate-y-[150%]', 'translate-x-[150%]', 'lg:translate-x-[150%]', 'opacity-0');

            if (activeMarker) map.removeLayer(activeMarker);
            if (activeCircle) map.removeLayer(activeCircle);
        });

        btnCloseForecast.addEventListener('click', () => {
            mapLegend.classList.remove('opacity-0', 'pointer-events-none');
            mapLegend.classList.add('opacity-100', 'pointer-events-auto');

            resultPanel.classList.remove('translate-y-0', 'lg:-translate-x-0', 'opacity-100');
            resultPanel.classList.add('translate-y-[150%]', 'lg:-translate-x-[150%]', 'opacity-0');

            forecastPanel.classList.remove('translate-y-0', 'lg:translate-x-0', 'opacity-100');
            forecastPanel.classList.add('translate-y-[150%]', 'lg:translate-x-[150%]', 'opacity-0');

            if (activeMarker) map.removeLayer(activeMarker);
            if (activeCircle) map.removeLayer(activeCircle);
        });

        // Main Fetch Logic
        async function fetchPrediction(lat, lon) {
            // Show Loading Overlay
            loadingOverlay.classList.remove('hidden');
            setTimeout(() => loadingOverlay.classList.remove('opacity-0'), 10);

            // Reset Horizontal Scroll on Mobile Carousel to the start (General Info)
            if (panelsContainer) {
                panelsContainer.scrollLeft = 0;
            }

            // Hide legend and Panels Temporarily
            mapLegend.classList.remove('opacity-100', 'pointer-events-auto');
            mapLegend.classList.add('opacity-0', 'pointer-events-none');

            resultPanel.classList.remove('translate-y-0', 'lg:-translate-x-0', 'opacity-100');
            resultPanel.classList.add('translate-y-[150%]', 'lg:-translate-x-[150%]', 'opacity-0');

            forecastPanel.classList.remove('translate-y-0', 'lg:translate-x-0', 'opacity-100');
            forecastPanel.classList.add('translate-y-[150%]', 'lg:translate-x-[150%]', 'opacity-0');

            try {
                const response = await fetch('/api/prediksi-kota', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ lat, lon })
                });

                if (!response.ok) throw new Error('Network response was not ok');
                const data = await response.json();

                // Parsing Status from ML Output
                let statusKey = 'Aman';
                const mlStr = JSON.stringify(data.prediksi || data.raw_ml || {}).toLowerCase();
                if (mlStr.includes('bahaya')) statusKey = 'Bahaya';
                else if (mlStr.includes('waspada')) statusKey = 'Waspada';

                // Render Map UI
                renderMapPulse(lat, lon, statuses[statusKey]);

                // Render Result Panel UI
                renderPanel(data, statusKey);

                // Render Hourly Forecast UI
                if (data.hourly_forecast) {
                    renderHourlyForecast(data.hourly_forecast);
                }

            } catch (error) {
                console.error('API Error:', error);
                showErrorToast('Gagal merespons server. Silakan coba pilih titik lain atau cek koneksi internet Anda.');
            } finally {
                // Hide Loading Overlay
                loadingOverlay.classList.add('opacity-0');
                setTimeout(() => loadingOverlay.classList.add('hidden'), 500);
            }
        }

        let toastTimeout;
        function showErrorToast(message) {
            errorToastMsg.textContent = message;
            errorToast.classList.remove('-translate-y-[150%]', 'opacity-0');
            errorToast.classList.add('translate-y-0', 'opacity-100');

            clearTimeout(toastTimeout);
            toastTimeout = setTimeout(() => {
                errorToast.classList.remove('translate-y-0', 'opacity-100');
                errorToast.classList.add('-translate-y-[150%]', 'opacity-0');
            }, 4000);
        }

        function renderMapPulse(lat, lon, info) {
            const coord = [lat, lon];

            if (activeMarker) map.removeLayer(activeMarker);
            if (activeCircle) map.removeLayer(activeCircle);

            // Dynamic Pulse Marker
            const iconHtml = `<div class="pulse-marker bg-slate-800" style="--pulse-color: ${info.hex}99; border-color: ${info.hex};">
                              <div class="w-full h-full rounded-full" style="background: ${info.hex};"></div>
                              </div>`;

            const customIcon = L.divIcon({
                className: 'custom-pulse',
                html: iconHtml,
                iconSize: [24, 24],
                iconAnchor: [12, 12]
            });

            activeMarker = L.marker(coord, { icon: customIcon }).addTo(map);

            // Radius Circle
            let radius = info.hex === '#f43f5e' ? 5000 : (info.hex === '#f59e0b' ? 2500 : 1000); // Larger radius on danger
            activeCircle = L.circle(coord, {
                color: info.hex,
                fillColor: info.hex,
                fillOpacity: 0.1,
                weight: 1,
                dashArray: '3, 6',
                radius: radius
            }).addTo(map);
        }

        function renderPanel(data, statusKey) {
            const info = statuses[statusKey];

            // Values
            cityName.textContent = data.lokasi || "Titik Koordinat";
            tempVal.textContent = `${data.suhu}°C`;
            humidVal.textContent = `${data.kelembapan}%`;
            rainVal.textContent = `${data.curah_hujan} mm`;

            // Dynamic Styling
            panelBg.style.backgroundColor = info.hex;
            statusContainer.className = `flex items-center gap-4 lg:gap-5 p-4 lg:p-5 rounded-2xl border mb-5 transition-all duration-700 ${info.cardBorder} bg-slate-800/60 shadow-lg`;

            statusIconWrapper.className = `w-14 h-14 lg:w-16 lg:h-16 rounded-full flex items-center justify-center shrink-0 shadow-inner transition-colors duration-700 ${info.iconBg}`;
            statusIconWrapper.innerHTML = info.icon;

            statusText.textContent = statusKey;
            statusText.className = `text-2xl lg:text-3xl font-black tracking-tight leading-none ${info.textColor}`;

            // Checklist
            checklistContainer.innerHTML = '';
            info.checklist.forEach((item, i) => {
                const div = document.createElement('div');
                div.className = "flex items-start gap-3 p-2.5 rounded-xl bg-slate-800/40 border border-slate-700/50 text-slate-300";
                div.innerHTML = `
                    <div class="mt-0.5 w-4 h-4 rounded-full flex items-center justify-center shrink-0 ${info.iconBg}">
                        <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <span>${item}</span>
                `;
                checklistContainer.appendChild(div);
            });

            // Slide Up Panel Delay for Smoothness
            setTimeout(() => {
                if (panelsContainer) panelsContainer.scrollLeft = 0; // Guard for browser ignoring un-rendered scroll resets
                resultPanel.classList.remove('translate-y-[150%]', 'lg:-translate-x-[150%]', 'opacity-0');
                resultPanel.classList.add('translate-y-0', 'lg:-translate-x-0', 'opacity-100');
            }, 300);
        }

        let forecastChartInstance = null;

        function getWeatherIcon(code) {
            // WMO Weather interpretation codes (Open-Meteo standard)
            if (code === 0) return '☀️'; // Clear sky
            if (code === 1 || code === 2 || code === 3) return '⛅'; // Mainly clear, partly cloudy, and overcast
            if (code === 45 || code === 48) return '🌫️'; // Fog and depositing rime fog
            if (code >= 51 && code <= 57) return '🌦️'; // Drizzle
            if ((code >= 61 && code <= 67) || (code >= 80 && code <= 82)) return '🌧️'; // Rain and Rain showers
            if ((code >= 71 && code <= 77) || code === 85 || code === 86) return '❄️'; // Snow fall, snow grains, and snow showers
            if (code >= 95 && code <= 99) return '⛈️'; // Thunderstorm
            return '☁️'; // Default fallback
        }

        function renderHourlyForecast(hourlyData) {
            const hourlyContainer = document.getElementById('hourly-container');
            hourlyContainer.innerHTML = '';

            const labels = [];
            const tempData = [];
            const rainData = [];

            hourlyData.forEach((hour) => {
                // Parse time
                const date = new Date(hour.time);
                labels.push(hour.time.split('T')[1].substring(0, 5));
                tempData.push(hour.temp);
                rainData.push(hour.rain);

                const info = statuses[hour.status] || statuses['Aman'];

                const card = document.createElement('div');
                card.className = "shrink-0 snap-start w-[5rem] min-w-[5rem] lg:w-full flex flex-col lg:flex-row items-center lg:items-center justify-between bg-slate-800/60 border border-slate-700/50 rounded-2xl p-2 lg:p-3 lg:px-4 text-center lg:text-left transition-colors shadow-sm gap-1 lg:gap-4 mt-1 lg:mt-0";
                card.innerHTML = `
                    <p class="text-[0.65rem] lg:text-sm text-slate-400 font-medium mb-1 lg:mb-0 w-full lg:w-12 text-center lg:text-left shrink-0">${hour.time.split('T')[1].substring(0, 5)}</p>
                    <div class="text-xl lg:text-2xl mb-1 lg:mb-0 flex items-center justify-center shrink-0 w-8">${getWeatherIcon(hour.weathercode)}</div>
                    <div class="flex flex-col lg:flex-row items-center justify-center lg:justify-start lg:flex-1 gap-0.5 lg:gap-3 w-full">
                        <p class="text-sm lg:text-base text-white font-bold w-full lg:w-14 text-center lg:text-left">${hour.temp}°</p>
                        <p class="text-[0.6rem] lg:text-xs text-indigo-400 font-medium whitespace-nowrap">${hour.rain}mm</p>
                    </div>
                    <div class="w-full lg:w-2 h-1 lg:h-8 mt-1.5 lg:mt-0 rounded-full shrink-0" style="background-color: ${info.hex}"></div>
                `;
                hourlyContainer.appendChild(card);
            });

            // Slide Up Forecast Panel
            setTimeout(() => {
                forecastPanel.classList.remove('translate-y-[150%]', 'lg:translate-x-[150%]', 'opacity-0');
                forecastPanel.classList.add('translate-y-0', 'lg:translate-x-0', 'opacity-100');

                // Reflow Chart.js after CSS transition completes
                setTimeout(() => {
                    if (forecastChartInstance) forecastChartInstance.resize();
                }, 750);
            }, 400);

            // Render Chart.js
            const ctx = document.getElementById('forecastChart').getContext('2d');

            if (forecastChartInstance) {
                forecastChartInstance.destroy();
            }

            forecastChartInstance = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Hujan (mm)',
                            data: rainData,
                            borderColor: '#818cf8',
                            backgroundColor: 'rgba(129, 140, 248, 0.2)',
                            fill: true,
                            tension: 0.4,
                            yAxisID: 'y1'
                        },
                        {
                            label: 'Suhu (°C)',
                            data: tempData,
                            borderColor: '#fbbf24',
                            backgroundColor: 'rgba(251, 191, 36, 0.0)',
                            fill: false,
                            tension: 0.4,
                            yAxisID: 'y'
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        mode: 'index',
                        intersect: false,
                    },
                    plugins: {
                        legend: {
                            labels: { color: '#cbd5e1', font: { family: 'Inter', size: 10 } },
                            position: 'top',
                            align: 'end'
                        }
                    },
                    scales: {
                        x: {
                            ticks: { color: '#64748b', font: { size: 9 }, maxTicksLimit: 12 },
                            grid: { color: 'rgba(255,255,255,0.05)' }
                        },
                        y: {
                            type: 'linear',
                            display: true,
                            position: 'left',
                            ticks: { color: '#fbbf24', font: { size: 10 } },
                            grid: { color: 'rgba(255,255,255,0.05)' },
                            title: { display: true, text: 'Suhu', color: '#fbbf24', font: { size: 10 } }
                        },
                        y1: {
                            type: 'linear',
                            display: true,
                            position: 'right',
                            ticks: { color: '#818cf8', font: { size: 10 } },
                            grid: { drawOnChartArea: false },
                            title: { display: true, text: 'Hujan', color: '#818cf8', font: { size: 10 } }
                        }
                    }
                }
            });
        }

    </script>
</body>

</html>