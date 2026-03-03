<!DOCTYPE html>
<html lang="id" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panduan Mitigasi | WaspadaLokal</title>
    <meta name="description" content="WaspadaLokal - Sistem Peringatan Dini Real-time dan Deteksi Risiko Berbasis AI.">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png?v=2026') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png?v=2026') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico?v=2026') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png?v=2026') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest?v=2026') }}">
    <meta name="dicoding:email" content="dhafidwahyukusumo@gmail.com">
    <!-- Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    animation: {
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    }
                }
            }
        }
    </script>
    <!-- Alpine.js for smooth interactive components -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body {
            background-color: #0f172a;
            background-image:
                radial-gradient(at 40% 20%, hsla(228, 100%, 74%, 0.1) 0px, transparent 50%),
                radial-gradient(at 80% 0%, hsla(189, 100%, 56%, 0.05) 0px, transparent 50%),
                radial-gradient(at 0% 50%, hsla(355, 100%, 93%, 0.05) 0px, transparent 50%);
            min-height: 100vh;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body
    class="bg-slate-50 text-slate-900 dark:bg-slate-900 dark:text-slate-50 min-h-screen transition-colors duration-300 antialiased selection:bg-blue-300 dark:selection:bg-blue-700 flex flex-col">

    <div class="max-w-7xl mx-auto px-4 py-8 sm:py-12 w-full flex-grow flex flex-col">

        <!-- Navigation Bar -->
        <nav class="flex flex-wrap justify-center gap-3 md:gap-4 mb-10 shrink-0">
            <a href="/"
                class="px-5 md:px-6 py-2 rounded-full font-medium transition-colors bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 shadow-sm border border-slate-200 dark:border-slate-700 text-sm md:text-base">Deteksi
                Saya</a>
            <a href="/peta-pantauan"
                class="px-5 md:px-6 py-2 rounded-full font-medium transition-colors bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 shadow-sm border border-slate-200 dark:border-slate-700 text-sm md:text-base">Peta
                Nasional</a>
            <a href="/pusat-peringatan"
                class="px-5 md:px-6 py-2 rounded-full font-medium transition-colors bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 shadow-sm border border-slate-200 dark:border-slate-700 flex items-center gap-2 text-sm md:text-base border-rose-200 dark:border-rose-900/50">
                <span class="w-2 h-2 rounded-full bg-rose-500 animate-pulse"></span>
                Info BMKG
            </a>
            <a href="/panduan"
                class="px-5 md:px-6 py-2 rounded-full font-medium transition-colors bg-indigo-600 text-white shadow-lg shadow-indigo-500/30 text-sm md:text-base">Panduan
                Keselamatan</a>
        </nav>

        <!-- Main Content -->
        <main class="flex-grow max-w-4xl mx-auto w-full py-4">
            <!-- Header -->
            <div class="mb-10 text-center">
                <div
                    class="inline-flex items-center justify-center p-3 bg-indigo-500/10 rounded-2xl mb-4 border border-indigo-500/20">
                    <svg class="w-8 h-8 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                        </path>
                    </svg>
                </div>
                <h1 class="text-3xl md:text-5xl font-black text-white tracking-tight mb-4">
                    Panduan Keselamatan
                </h1>
                <p class="text-slate-400 text-lg max-w-2xl mx-auto">
                    Langkah-langkah yang harus Anda ambil berdasarkan tingkat risiko bencana di lokasi Anda. Tetap
                    tenang
                    dan ikuti prosedur dengan saksama.
                </p>
            </div>

            <!-- Accordion Section -->
            <div x-data="{ activeAccordion: 'aman' }" class="space-y-6 mb-16">

                <!-- STATUS AMAN -->
                <div class="bg-slate-800/60 backdrop-blur-xl border border-emerald-500/30 rounded-3xl overflow-hidden transition-all duration-300 shadow-xl"
                    :class="activeAccordion === 'aman' ? 'ring-2 ring-emerald-500/50 shadow-[0_0_30px_-5px_rgba(16,185,129,0.3)]' : 'hover:border-emerald-500/50'">
                    <button @click="activeAccordion = activeAccordion === 'aman' ? '' : 'aman'"
                        class="w-full flex items-center justify-between p-6 md:p-8 text-left focus:outline-none group">
                        <div class="flex items-center gap-5">
                            <div
                                class="w-14 h-14 rounded-2xl bg-emerald-500/20 flex items-center justify-center text-emerald-400 border border-emerald-500/20 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-black text-white tracking-wide">STATUS AMAN</h3>
                                <p
                                    class="text-emerald-400 text-sm md:text-base font-semibold uppercase tracking-wider mt-1">
                                    Persiapan & Pencegahan</p>
                            </div>
                        </div>
                        <div
                            class="w-10 h-10 rounded-full bg-slate-900/50 flex items-center justify-center border border-slate-700">
                            <svg class="w-6 h-6 text-slate-400 transform transition-transform duration-500"
                                :class="activeAccordion === 'aman' ? 'rotate-180 text-emerald-400' : ''" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </div>
                    </button>
                    <div x-show="activeAccordion === 'aman'" x-collapse x-cloak>
                        <div class="p-6 md:p-8 pt-0 border-t border-emerald-500/20 bg-emerald-950/10">
                            <div class="grid gap-4 mt-6">
                                <div
                                    class="flex items-start gap-4 p-4 rounded-2xl bg-slate-900/50 border border-slate-700/50 hover:border-emerald-500/30 transition-colors">
                                    <div
                                        class="w-10 h-10 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center shrink-0 border border-emerald-500/20">
                                        <span class="text-lg font-black">1</span>
                                    </div>
                                    <div class="pt-2">
                                        <p class="text-slate-300 font-medium text-lg">Cek saluran air di sekitar rumah
                                            secara rutin.</p>
                                        <p class="text-slate-500 text-sm mt-1">Pastikan selokan dan drainase tidak
                                            tersumbat
                                            sampah untuk mencegah genangan air atau banjir lokal.</p>
                                    </div>
                                </div>
                                <div
                                    class="flex items-start gap-4 p-4 rounded-2xl bg-slate-900/50 border border-slate-700/50 hover:border-emerald-500/30 transition-colors">
                                    <div
                                        class="w-10 h-10 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center shrink-0 border border-emerald-500/20">
                                        <span class="text-lg font-black">2</span>
                                    </div>
                                    <div class="pt-2">
                                        <p class="text-slate-300 font-medium text-lg">Siapkan Tas Siaga Bencana.</p>
                                        <p class="text-slate-500 text-sm mt-1">Isi dengan P3K, Senter, Baterai cadangan,
                                            Air
                                            minum botol, Makanan ringan, dan kelengkapan Dokumen Penting dalam plastik
                                            kedap
                                            air.</p>
                                    </div>
                                </div>
                                <div
                                    class="flex items-start gap-4 p-4 rounded-2xl bg-slate-900/50 border border-slate-700/50 hover:border-emerald-500/30 transition-colors">
                                    <div
                                        class="w-10 h-10 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center shrink-0 border border-emerald-500/20">
                                        <span class="text-lg font-black">3</span>
                                    </div>
                                    <div class="pt-2">
                                        <p class="text-slate-300 font-medium text-lg">Pantau update cuaca harian di
                                            aplikasi
                                            WaspadaLokal.</p>
                                        <p class="text-slate-500 text-sm mt-1">Selalu waspada dan jadikan cek cuaca
                                            sebagai
                                            habit harian Anda beserta keluarga.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- STATUS WASPADA -->
                <div class="bg-slate-800/60 backdrop-blur-xl border border-amber-500/30 rounded-3xl overflow-hidden transition-all duration-300 shadow-xl"
                    :class="activeAccordion === 'waspada' ? 'ring-2 ring-amber-500/50 shadow-[0_0_30px_-5px_rgba(245,158,11,0.3)]' : 'hover:border-amber-500/50'">
                    <button @click="activeAccordion = activeAccordion === 'waspada' ? '' : 'waspada'"
                        class="w-full flex items-center justify-between p-6 md:p-8 text-left focus:outline-none group">
                        <div class="flex items-center gap-5">
                            <div
                                class="w-14 h-14 rounded-2xl bg-amber-500/20 flex items-center justify-center text-amber-400 border border-amber-500/20 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-black text-white tracking-wide">STATUS WASPADA</h3>
                                <p
                                    class="text-amber-400 text-sm md:text-base font-semibold uppercase tracking-wider mt-1">
                                    Kewaspadaan Tinggi</p>
                            </div>
                        </div>
                        <div
                            class="w-10 h-10 rounded-full bg-slate-900/50 flex items-center justify-center border border-slate-700">
                            <svg class="w-6 h-6 text-slate-400 transform transition-transform duration-500"
                                :class="activeAccordion === 'waspada' ? 'rotate-180 text-amber-400' : ''" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </div>
                    </button>
                    <div x-show="activeAccordion === 'waspada'" x-collapse x-cloak>
                        <div class="p-6 md:p-8 pt-0 border-t border-amber-500/20 bg-amber-950/10">
                            <div class="grid gap-4 mt-6">
                                <div
                                    class="flex items-start gap-4 p-4 rounded-2xl bg-slate-900/50 border border-slate-700/50 hover:border-amber-500/30 transition-colors">
                                    <div
                                        class="w-10 h-10 rounded-full bg-amber-500/20 text-amber-400 flex items-center justify-center shrink-0 border border-amber-500/20">
                                        <span class="text-lg font-black">1</span>
                                    </div>
                                    <div class="pt-2">
                                        <p class="text-slate-300 font-medium text-lg">Amankan barang berharga ke tempat
                                            yang
                                            lebih tinggi.</p>
                                        <p class="text-slate-500 text-sm mt-1">Pindahkan elektronik, dokumen penting,
                                            dan
                                            furnitur ringan ke lantai dua tingkat atau letakkan di atas lemari.</p>
                                    </div>
                                </div>
                                <div
                                    class="flex items-start gap-4 p-4 rounded-2xl bg-slate-900/50 border border-slate-700/50 hover:border-amber-500/30 transition-colors">
                                    <div
                                        class="w-10 h-10 rounded-full bg-amber-500/20 text-amber-400 flex items-center justify-center shrink-0 border border-amber-500/20">
                                        <span class="text-lg font-black">2</span>
                                    </div>
                                    <div class="pt-2">
                                        <p class="text-slate-300 font-medium text-lg">Pastikan baterai HP dan Powerbank
                                            terisi penuh.</p>
                                        <p class="text-slate-500 text-sm mt-1">Siapkan sumber daya portabel karena
                                            kemungkinan pemadaman listrik darurat oleh pihak PLN saat situasi memburuk.
                                        </p>
                                    </div>
                                </div>
                                <div
                                    class="flex items-start gap-4 p-4 rounded-2xl bg-slate-900/50 border border-slate-700/50 hover:border-amber-500/30 transition-colors">
                                    <div
                                        class="w-10 h-10 rounded-full bg-amber-500/20 text-amber-400 flex items-center justify-center shrink-0 border border-amber-500/20">
                                        <span class="text-lg font-black">3</span>
                                    </div>
                                    <div class="pt-2">
                                        <p class="text-slate-300 font-medium text-lg">Komunikasikan rencana evakuasi
                                            dengan
                                            anggota keluarga.</p>
                                        <p class="text-slate-500 text-sm mt-1">Tentukan titik kumpul yang disepakati
                                            bila
                                            harus meninggalkan rumah, serta pastikan kendaraan dalam keadaan prima.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- STATUS BAHAYA -->
                <div class="bg-slate-800/60 backdrop-blur-xl border border-rose-500/30 rounded-3xl overflow-hidden transition-all duration-300 shadow-xl"
                    :class="activeAccordion === 'bahaya' ? 'ring-2 ring-rose-500/50 shadow-[0_0_30px_-5px_rgba(225,29,72,0.3)]' : 'hover:border-rose-500/50'">
                    <button @click="activeAccordion = activeAccordion === 'bahaya' ? '' : 'bahaya'"
                        class="w-full flex items-center justify-between p-6 md:p-8 text-left focus:outline-none group">
                        <div class="flex items-center gap-5">
                            <div
                                class="w-14 h-14 rounded-2xl bg-rose-500/20 flex items-center justify-center text-rose-500 border border-rose-500/20 group-hover:scale-110 transition-transform duration-300">
                                <!-- Bolt slash icon -->
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 3l18 18M13 7.14V3l-5.63 9M11 16.86V21l5.63-9"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-black text-white tracking-wide">STATUS BAHAYA</h3>
                                <p
                                    class="text-rose-400 text-sm md:text-base font-semibold uppercase tracking-wider mt-1">
                                    Tindakan Darurat & Evakuasi</p>
                            </div>
                        </div>
                        <div
                            class="w-10 h-10 rounded-full bg-slate-900/50 flex items-center justify-center border border-slate-700">
                            <svg class="w-6 h-6 text-slate-400 transform transition-transform duration-500"
                                :class="activeAccordion === 'bahaya' ? 'rotate-180 text-rose-500' : ''" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </div>
                    </button>
                    <div x-show="activeAccordion === 'bahaya'" x-collapse x-cloak>
                        <div class="p-6 md:p-8 pt-0 border-t border-rose-500/20 bg-rose-950/10">
                            <div class="grid gap-4 mt-6">
                                <div
                                    class="flex items-start gap-4 p-4 rounded-2xl bg-rose-500/5 border border-rose-500/30 hover:bg-rose-500/10 transition-colors">
                                    <div
                                        class="w-10 h-10 rounded-full bg-rose-500/20 text-rose-400 flex items-center justify-center shrink-0 border border-rose-500/20">
                                        <span class="text-lg font-black">1</span>
                                    </div>
                                    <div class="pt-2">
                                        <p class="text-white font-medium text-lg">Matikan aliran listrik dan gas segera.
                                        </p>
                                        <p class="text-rose-200/70 text-sm mt-1">Langkah krusial untuk mencegah
                                            kebakaran
                                            akibat korsleting atau ledakan saat wilayah Anda sudah terendam/terdampak
                                            parah.
                                        </p>
                                    </div>
                                </div>
                                <div
                                    class="flex items-start gap-4 p-4 rounded-2xl bg-rose-500/5 border border-rose-500/30 hover:bg-rose-500/10 transition-colors">
                                    <div
                                        class="w-10 h-10 rounded-full bg-rose-500/20 text-rose-400 flex items-center justify-center shrink-0 border border-rose-500/20">
                                        <span class="text-lg font-black">2</span>
                                    </div>
                                    <div class="pt-2">
                                        <p class="text-white font-medium text-lg">Evakuasi ke tempat yang lebih tinggi
                                            atau
                                            posko pengungsian terdekat.</p>
                                        <p class="text-rose-200/70 text-sm mt-1">Jangan menunggu! Tinggalkan rumah Anda
                                            dengan membawa Tas Siaga Bencana dan utamakan keselamatan nyawa di atas
                                            harta
                                            benda.</p>
                                    </div>
                                </div>
                                <div
                                    class="flex items-start gap-4 p-4 rounded-2xl bg-rose-500/5 border border-rose-500/30 hover:bg-rose-500/10 transition-colors">
                                    <div
                                        class="w-10 h-10 rounded-full bg-rose-500/20 text-rose-400 flex items-center justify-center shrink-0 border border-rose-500/20">
                                        <span class="text-lg font-black">3</span>
                                    </div>
                                    <div class="pt-2">
                                        <p class="text-white font-medium text-lg">Ikuti instruksi resmi dari petugas
                                            BPBD/SAR melalui radio atau pengumuman lokal.</p>
                                        <p class="text-rose-200/70 text-sm mt-1">Hanya percayai sumber informasi resmi
                                            dari
                                            otoritas setempat, dan hindari rute evakuasi yang dibatasi.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Emergency Calls Section -->
            <div class="pt-8 border-t border-slate-800">
                <h2
                    class="text-2xl font-bold text-white mb-6 text-center md:text-left flex items-center justify-center md:justify-start gap-3">
                    <svg class="w-6 h-6 text-rose-500 animate-pulse-slow" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                        </path>
                    </svg>
                    Panggilan Darurat Cepat
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                    <!-- 112 -->
                    <a href="tel:112"
                        class="flex flex-col items-center justify-center p-6 bg-slate-800/80 hover:bg-slate-700/80 border border-slate-700 hover:border-slate-500 rounded-3xl transition-all duration-300 group shadow-lg">
                        <div
                            class="w-16 h-16 rounded-2xl bg-slate-700/50 text-slate-300 flex items-center justify-center mb-4 group-hover:-translate-y-2 group-hover:bg-indigo-500 group-hover:text-white group-hover:shadow-[0_10px_20px_-10px_rgba(99,102,241,0.6)] transition-all duration-300">
                            <!-- Phone icon -->
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                </path>
                            </svg>
                        </div>
                        <span class="text-3xl font-black text-white tracking-wider mb-1">112</span>
                        <span class="text-sm font-medium text-slate-400 text-center uppercase tracking-wide">Pusat
                            Panggilan<br>Darurat Nasional</span>
                    </a>

                    <!-- 115 Basarnas -->
                    <a href="tel:115"
                        class="flex flex-col items-center justify-center p-6 bg-slate-800/80 hover:bg-slate-700/80 border border-slate-700 hover:border-slate-500 rounded-3xl transition-all duration-300 group shadow-lg">
                        <div
                            class="w-16 h-16 rounded-2xl bg-slate-700/50 text-slate-300 flex items-center justify-center mb-4 group-hover:-translate-y-2 group-hover:bg-orange-500 group-hover:text-white group-hover:shadow-[0_10px_20px_-10px_rgba(249,115,22,0.6)] transition-all duration-300">
                            <!-- Lifebuoy icon -->
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z">
                                </path>
                            </svg>
                        </div>
                        <span class="text-3xl font-black text-white tracking-wider mb-1">115</span>
                        <span
                            class="text-sm font-medium text-slate-400 text-center uppercase tracking-wide">BASARNAS<br>(Pencarian
                            & Pertolongan)</span>
                    </a>

                    <!-- 119 Ambulans -->
                    <a href="tel:119"
                        class="flex flex-col items-center justify-center p-6 bg-slate-800/80 hover:bg-rose-900/40 border border-slate-700 hover:border-rose-500/50 rounded-3xl transition-all duration-300 group shadow-lg">
                        <div
                            class="w-16 h-16 rounded-2xl bg-rose-500/20 text-rose-500 flex items-center justify-center mb-4 group-hover:-translate-y-2 group-hover:bg-rose-500 group-hover:text-white group-hover:shadow-[0_10px_20px_-10px_rgba(225,29,72,0.6)] transition-all duration-300">
                            <!-- Plus icon (Medical) -->
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4">
                                </path>
                            </svg>
                        </div>
                        <span
                            class="text-3xl font-black text-rose-400 group-hover:text-white tracking-wider mb-1 transition-colors">119</span>
                        <span
                            class="text-sm font-medium text-rose-300/70 group-hover:text-rose-200 text-center uppercase tracking-wide transition-colors">Ambulans<br>(Kemenkes
                            RI)</span>
                    </a>

                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="mt-auto border-t border-slate-800 bg-slate-900/50 backdrop-blur-md">
            <div
                class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex flex-col md:flex-row items-center justify-between text-slate-500 text-sm">
                <p>&copy; 2026 WaspadaLokal. Panduan Keselamatan Bencana.</p>
                <div class="flex items-center gap-4 mt-4 md:mt-0">
                    <a href="#" class="hover:text-white transition">Privacy</a>
                    <a href="#" class="hover:text-white transition">Terms</a>
                </div>
            </div>
        </footer>

    </div>
</body>

</html>