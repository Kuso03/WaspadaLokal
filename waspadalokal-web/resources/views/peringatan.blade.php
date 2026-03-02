<!DOCTYPE html>
<html lang="id" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pusat Peringatan | WaspadaLokal</title>
    <meta name="description" content="WaspadaLokal - Sistem Peringatan Dini Real-time dan Deteksi Risiko Berbasis AI.">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png?v=2026') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png?v=2026') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico?v=2026') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png?v=2026') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest?v=2026') }}">

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
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    animation: {
                        'marquee': 'marquee 25s linear infinite',
                        'pulse-fast': 'pulse 1.5s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    },
                    keyframes: {
                        marquee: {
                            '0%': { transform: 'translateY(100%)' },
                            '100%': { transform: 'translateY(-100%)' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

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
    </style>
</head>

<body
    class="bg-slate-50 text-slate-900 dark:bg-slate-900 dark:text-slate-50 min-h-screen transition-colors duration-300 antialiased selection:bg-blue-300 dark:selection:bg-blue-700 flex flex-col overflow-x-hidden">

    <div class="max-w-7xl mx-auto px-4 py-8 sm:py-12 w-full flex-grow flex flex-col">

        <!-- Navigation Bar -->
        <nav class="flex flex-wrap justify-center gap-3 md:gap-4 mb-10 shrink-0 w-full">
            <a href="/"
                class="min-h-[44px] min-w-[44px] px-6 py-2.5 flex items-center justify-center rounded-full font-medium transition-all duration-200 active:scale-95 bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 shadow-sm border border-slate-200 dark:border-slate-700 text-sm md:text-base">Deteksi
                Saya</a>
            <a href="/peta-pantauan"
                class="min-h-[44px] min-w-[44px] px-6 py-2.5 flex items-center justify-center rounded-full font-medium transition-all duration-200 active:scale-95 bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 shadow-sm border border-slate-200 dark:border-slate-700 text-sm md:text-base">Peta
                Nasional</a>
            <a href="/pusat-peringatan"
                class="min-h-[44px] min-w-[44px] px-6 py-2.5 flex items-center justify-center rounded-full font-medium transition-all duration-200 active:scale-95 bg-rose-600 text-white shadow-lg shadow-rose-500/30 flex items-center gap-2 text-sm md:text-base">
                <span class="w-2.5 h-2.5 rounded-full bg-white animate-[pulse-fast_1s_infinite]"></span>
                Info BMKG
            </a>
            <a href="/panduan"
                class="min-h-[44px] min-w-[44px] px-6 py-2.5 flex items-center justify-center rounded-full font-medium transition-all duration-200 active:scale-95 bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 shadow-sm border border-slate-200 dark:border-slate-700 text-sm md:text-base">Panduan
                Keselamatan</a>
        </nav>

        <!-- Main Content -->
        <main class="flex-grow w-full py-4">
            <div
                class="mx-2 sm:mx-4 md:mx-0 mb-8 md:mb-10 flex flex-col md:flex-row items-center justify-between gap-4 md:gap-6 bg-rose-950/40 md:bg-transparent rounded-2xl md:rounded-none p-5 md:p-0 border border-rose-500/20 md:border-transparent shadow-lg shadow-rose-900/10 md:shadow-none">
                <div class="flex items-start gap-4 w-full md:w-auto">
                    <!-- Floated Icon Left -->
                    <div
                        class="shrink-0 md:mt-0 mt-1 md:bg-transparent bg-rose-500/20 p-2.5 md:p-0 rounded-xl border border-rose-500/30 md:border-none shadow-inner md:shadow-none">
                        <svg class="w-7 h-7 md:w-10 md:h-10 text-rose-500 animate-pulse drop-shadow-md" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                            </path>
                        </svg>
                    </div>
                    <!-- Stacked Text -->
                    <div class="flex-1 text-left">
                        <h1
                            class="text-xl md:text-5xl font-black text-white tracking-tight leading-tight mb-1 md:mb-2 text-shadow-sm">
                            Pusat Peringatan BMKG
                        </h1>
                        <p class="text-slate-300 md:text-slate-400 text-[0.8rem] md:text-lg max-w-2xl leading-relaxed">
                            Dashboard pantauan bencana dan peringatan dini cuaca langsung dari Data Terbuka BMKG.</p>
                    </div>
                </div>

                <button onclick="window.location.reload();"
                    class="w-full md:w-auto mt-2 md:mt-0 shrink-0 flex items-center justify-center gap-2 min-h-[44px] min-w-[44px] px-6 py-2.5 md:bg-slate-800 bg-rose-600 hover:bg-rose-700 md:hover:bg-slate-700 border border-rose-500/50 md:border-slate-700 rounded-xl md:rounded-full text-white md:text-slate-300 md:hover:text-white transition-all duration-200 active:scale-95 shadow-md shadow-rose-500/20 md:shadow-none group font-semibold text-sm">
                    <svg class="w-4 h-4 md:w-5 md:h-5 group-hover:rotate-180 transition-transform duration-500"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                        </path>
                    </svg>
                    Perbarui Data
                </button>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Earthquake Section (Left, takes 2 cols on lg) -->
                <div class="lg:col-span-2 flex flex-col gap-6">
                    <!-- Section Header -->
                    <div class="flex items-center gap-3 mb-2">
                        <div
                            class="w-10 h-10 rounded-lg bg-orange-500/20 text-orange-400 border border-orange-500/30 flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-white">Gempa Bumi Terkini M ≥ 5.0</h2>
                    </div>

                    @if($gempaData)
                        @php
                            $potensiLower = strtolower($gempaData['Potensi'] ?? '');
                            $tsunami = strpos($potensiLower, 'tsunami') !== false && strpos($potensiLower, 'tidak') === false;
                            $cardStyle = $tsunami ? 'bg-gradient-to-br from-rose-950/80 to-slate-900 border-rose-500/50 shadow-[0_0_40px_-10px_rgba(225,29,72,0.4)]' : 'bg-slate-800/60 backdrop-blur-xl border-slate-700 shadow-xl';
                            $headerStyle = $tsunami ? 'bg-rose-500 text-white' : 'bg-orange-500/10 text-orange-400 border-b border-orange-500/20';
                        @endphp

                        <div
                            class="rounded-3xl border {{ $cardStyle }} overflow-hidden flex flex-col md:flex-row w-full transition-all duration-300 group">

                            <!-- Map Image -->
                            <div
                                class="w-full md:w-5/12 relative overflow-hidden shrink-0 border-b md:border-b-0 md:border-r border-slate-700">
                                @if(isset($gempaData['Shakemap']))
                                    <img src="https://data.bmkg.go.id/DataMKG/TEWS/{{ $gempaData['Shakemap'] }}"
                                        alt="Shakemap Gempa BMKG"
                                        class="w-full h-full object-cover min-h-[300px] md:min-h-full group-hover:scale-105 transition-transform duration-700 opacity-90">
                                @else
                                    <div
                                        class="w-full h-full min-h-[300px] flex items-center justify-center bg-slate-800 text-slate-500">
                                        Peta tidak tersedia</div>
                                @endif
                                <div class="absolute top-4 left-4">
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider backdrop-blur-md {{ $tsunami ? 'bg-rose-600/90 text-white shadow-lg animate-pulse' : 'bg-slate-900/80 text-orange-400 border border-orange-500/30' }}">
                                        @if($tsunami) POTENSI TSUNAMI! @else TIDAK BERPOTENSI TSUNAMI @endif
                                    </span>
                                </div>
                            </div>

                            <!-- Details -->
                            <div class="p-6 lg:p-8 flex-1 flex flex-col justify-center">
                                <p class="text-sm font-semibold text-slate-400 mb-1 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $gempaData['Tanggal'] }} | {{ $gempaData['Jam'] }}
                                </p>
                                <h3 class="text-2xl lg:text-3xl font-black text-white mb-6 leading-tight">
                                    {{ $gempaData['Wilayah'] }}
                                </h3>

                                <div class="grid grid-cols-2 gap-4 mb-6">
                                    <div class="bg-slate-900/50 rounded-2xl p-4 border border-slate-700/50">
                                        <p class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1">Magnitudo
                                        </p>
                                        <p class="text-3xl font-black text-orange-400">{{ $gempaData['Magnitude'] }}</p>
                                    </div>
                                    <div class="bg-slate-900/50 rounded-2xl p-4 border border-slate-700/50">
                                        <p class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1">Kedalaman
                                        </p>
                                        <p class="text-3xl font-black text-blue-400">{{ $gempaData['Kedalaman'] }}</p>
                                    </div>
                                    <div
                                        class="col-span-2 bg-slate-900/50 rounded-2xl p-4 border border-slate-700/50 flex items-center justify-between">
                                        <div>
                                            <p class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1">
                                                Koordinat
                                            </p>
                                            <p class="text-lg font-bold text-slate-300">{{ $gempaData['Coordinates'] }}</p>
                                        </div>
                                        <a href="https://maps.google.com/?q={{ str_replace(',', ',', $gempaData['Coordinates']) }}"
                                            target="_blank"
                                            class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center text-slate-400 hover:text-white hover:bg-slate-700 transition border border-slate-600">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                </path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>

                                <div
                                    class="p-4 rounded-xl {{ $tsunami ? 'bg-rose-500/20 border border-rose-500/50 text-rose-300' : 'bg-slate-800/80 border border-slate-700 text-slate-400' }} flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                    <div class="flex items-start gap-3">
                                        <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <div>
                                            <p
                                                class="text-xs font-bold uppercase tracking-wider mb-1 {{ $tsunami ? 'text-rose-400' : 'text-slate-500' }}">
                                                Info Tambahan BMKG</p>
                                            <p class="text-sm font-medium">
                                                @if(empty($gempaData['Dirasakan']) || trim($gempaData['Dirasakan']) === '-')
                                                    Tidak ada laporan dirasakan saat ini. Detail lebih lanjut dapat dilihat pada
                                                    web resmi BMKG.
                                                @else
                                                    Wilayah Dirasakan: {{ $gempaData['Dirasakan'] }}
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <a href="https://warning.bmkg.go.id/" target="_blank"
                                        class="shrink-0 text-xs font-bold px-4 py-2 rounded-full border transition-all duration-200 active:scale-95 flex items-center justify-center gap-1 {{ $tsunami ? 'bg-rose-600 border-rose-500 text-white hover:bg-rose-700 shadow-lg shadow-rose-500/30' : 'bg-slate-700 border-slate-600 text-white hover:bg-slate-600' }}">
                                        Cek Detail Resmi
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                            </path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @else
                        <div
                            class="h-64 rounded-3xl bg-slate-800/40 border border-slate-700 border-dashed flex flex-col items-center justify-center text-center p-6">
                            <svg class="w-12 h-12 text-slate-600 mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                            <p class="text-slate-400 text-lg font-medium">Gagal memuat data Gempa Terkini.</p>
                            <p class="text-slate-500 text-sm mt-1">Silakan "Perbarui Data" atau server BMKG mungkin sedang
                                tidak
                                responsif.</p>
                        </div>
                    @endif

                    <!-- Quick Earthquake Safety Guide (Fills remaining height) -->
                    <div
                        class="bg-slate-800/60 backdrop-blur-xl border border-slate-700 rounded-3xl p-6 lg:p-8 flex-1 flex flex-col justify-center">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-lg bg-indigo-500/20 text-indigo-400 border border-indigo-500/30 flex items-center justify-center shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-white">Panduan Darurat Gempa</h3>
                                    <p class="text-sm text-slate-400">3 Langkah krusial saat terjadi guncangan</p>
                                </div>
                            </div>
                            <a href="/panduan"
                                class="hidden sm:flex text-sm font-medium text-indigo-400 hover:text-indigo-300 items-center gap-1 transition-colors bg-indigo-500/10 px-3 py-1.5 rounded-full border border-indigo-500/20">
                                Info Lengkap
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- Step 1 -->
                            <div
                                class="bg-slate-900/50 rounded-2xl p-5 border border-slate-700/50 flex flex-col items-center text-center hover:bg-slate-800 transition-colors group">
                                <div
                                    class="w-14 h-14 bg-slate-800 rounded-full flex items-center justify-center mb-4 border border-slate-600 group-hover:border-indigo-500/50 transition-colors">
                                    <span class="text-2xl">⬇️</span>
                                </div>
                                <h4 class="text-slate-200 font-bold mb-2">Merunduk</h4>
                                <p class="text-xs text-slate-400 leading-relaxed">Jatuhkan tubuh Anda sebelum gempa
                                    menjatuhkan Anda.</p>
                            </div>
                            <!-- Step 2 -->
                            <div
                                class="bg-slate-900/50 rounded-2xl p-5 border border-slate-700/50 flex flex-col items-center text-center hover:bg-slate-800 transition-colors group">
                                <div
                                    class="w-14 h-14 bg-slate-800 rounded-full flex items-center justify-center mb-4 border border-slate-600 group-hover:border-indigo-500/50 transition-colors">
                                    <span class="text-2xl">🛡️</span>
                                </div>
                                <h4 class="text-slate-200 font-bold mb-2">Lindungi</h4>
                                <p class="text-xs text-slate-400 leading-relaxed">Sembunyi di bawah meja kuat & lindungi
                                    area leher/kepala.</p>
                            </div>
                            <!-- Step 3 -->
                            <div
                                class="bg-slate-900/50 rounded-2xl p-5 border border-slate-700/50 flex flex-col items-center text-center hover:bg-slate-800 transition-colors group">
                                <div
                                    class="w-14 h-14 bg-slate-800 rounded-full flex items-center justify-center mb-4 border border-slate-600 group-hover:border-indigo-500/50 transition-colors">
                                    <span class="text-2xl">✊</span>
                                </div>
                                <h4 class="text-slate-200 font-bold mb-2">Bertahan (Hold On)</h4>
                                <p class="text-xs text-slate-400 leading-relaxed">Berpegangan erat pada pijakan aman
                                    hingga guncangan mereda.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Weather Warning Section (Right, 1 col) -->
                <div class="flex flex-col gap-6 h-full">
                    <!-- Section Header -->
                    <div class="flex items-center gap-3 mb-2">
                        <div
                            class="w-10 h-10 rounded-lg bg-orange-500/20 text-orange-400 border border-orange-500/30 flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z">
                                </path>
                            </svg>
                        </div>
                        <div class="flex flex-col">
                            <h2 class="text-2xl font-bold text-white leading-tight">Official Alerts</h2>
                            <span class="text-xs text-slate-400 font-medium tracking-wide">Peringatan Dini Cuaca
                                Terkini</span>
                        </div>
                    </div>

                    <div
                        class="bg-slate-800/60 backdrop-blur-xl border border-orange-500/30 rounded-3xl overflow-hidden flex flex-col shadow-xl flex-grow h-[600px] lg:h-[700px] relative">

                        <div
                            class="p-5 border-b border-orange-500/30 bg-orange-950/40 flex items-center justify-between shrink-0">
                            <div class="flex items-center gap-2">
                                <span class="text-sm font-bold text-orange-400 uppercase tracking-widest">Feed Nowcast
                                    BMKG</span>
                                <div
                                    class="px-2 py-0.5 rounded text-[0.6rem] font-bold bg-green-500/20 text-green-400 border border-green-500/30 flex items-center gap-1 uppercase tracking-wider">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Verified Source
                                </div>
                            </div>
                            <span class="flex h-3 w-3 relative">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-orange-500"></span>
                            </span>
                        </div>

                        <!-- Scrolling Container -->
                        <div class="flex-grow overflow-y-auto px-5 custom-scrollbar relative">
                            <div class="space-y-4 py-4">
                                @if(count($weatherWarnings) > 0)
                                    @foreach($weatherWarnings as $warn)
                                        <a href="{{ $warn['link'] }}" target="_blank"
                                            class="block p-4 rounded-2xl {{ $warn['is_high_priority'] ? 'bg-gradient-to-br from-orange-900/60 to-slate-900/80 border-orange-500/50 shadow-[0_0_15px_rgba(249,115,22,0.15)]' : 'bg-slate-900/50 border-slate-700/80' }} border hover:bg-slate-800/80 transition-all hover:scale-[1.02] group cursor-pointer relative overflow-hidden">
                                            @if($warn['is_high_priority'])
                                                <div
                                                    class="absolute top-0 right-0 px-3 py-1 bg-rose-500 text-white text-[0.65rem] font-bold uppercase tracking-wider rounded-bl-lg shadow-sm">
                                                    High Priority (Area Anda)</div>
                                            @endif
                                            <div
                                                class="flex items-center gap-2 mb-2 {{ $warn['is_high_priority'] ? 'mt-4' : '' }}">
                                                <svg class="w-5 h-5 {{ $warn['is_high_priority'] ? 'text-rose-400' : 'text-orange-400' }} shrink-0"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                                    </path>
                                                </svg>
                                                <h4
                                                    class="text-sm font-bold {{ $warn['is_high_priority'] ? 'text-white' : 'text-slate-200' }} group-hover:text-orange-300 transition-colors line-clamp-2 pr-2 leading-snug">
                                                    {{ $warn['province'] ?? 'Peringatan Dini Cuaca' }}
                                                </h4>
                                            </div>
                                            <p
                                                class="text-sm {{ $warn['is_high_priority'] ? 'text-slate-300 font-medium' : 'text-slate-400' }} leading-relaxed line-clamp-3 break-words whitespace-normal">
                                                {{ $warn['warning'] }}
                                            </p>
                                            <div
                                                class="mt-3 text-xs text-orange-400/80 font-medium flex items-center gap-1 group-hover:text-orange-400 transition-colors">
                                                Baca selengkapnya di situs BMKG <svg
                                                    class="w-3 h-3 group-hover:translate-x-1 transition-transform" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                                </svg>
                                            </div>
                                        </a>
                                    @endforeach
                                @else
                                    <div
                                        class="p-6 text-center text-slate-500 flex flex-col items-center justify-center gap-3">
                                        <svg class="w-10 h-10 opacity-50" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <p class="font-medium">Tidak ada peringatan dini yang tercatat saat ini. Langit
                                            cerah!
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Credit Footer in panel -->
                        <div class="p-3 bg-slate-900 border-t border-slate-800 shrink-0 text-center">
                            <p class="text-[0.65rem] text-slate-500 font-medium uppercase tracking-wider">Sumber Data:
                                BMKG
                                (Badan Meteorologi, Klimatologi, dan Geofisika)</p>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <!-- Footer -->
    <footer class="mt-auto border-t border-slate-800 bg-slate-900/50 backdrop-blur-md">
        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex flex-col md:flex-row items-center justify-between text-slate-500 text-sm">
            <p>&copy; 2026 WaspadaLokal. Data sourced publicly from BMKG Data Terbuka.</p>
            <div class="flex items-center gap-4 mt-4 md:mt-0">
                <a href="#" class="hover:text-white transition">Privacy</a>
                <a href="#" class="hover:text-white transition">Terms</a>
            </div>
        </div>
    </footer>

</body>

</html>