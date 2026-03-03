<!DOCTYPE html>
<html lang="id" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kebijakan Privasi & Ketentuan Layanan | WaspadaLokal</title>
    <meta name="description" content="Kebijakan Privasi dan Ketentuan Layanan Aplikasi WaspadaLokal.">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png?v=2026') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png?v=2026') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico?v=2026') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                }
            }
        }
    </script>
</head>

<body
    class="bg-slate-50 text-slate-900 dark:bg-slate-900 dark:text-slate-50 min-h-screen transition-colors duration-300 antialiased selection:bg-blue-300 dark:selection:bg-blue-700 flex flex-col pt-6 md:pt-10">

    <div class="max-w-4xl mx-auto px-4 sm:px-6 w-full flex-grow flex flex-col">

        <!-- Top Navigation / Back Button -->
        <nav class="mb-10 w-full flex items-center">
            <a href="/"
                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full font-medium transition-all duration-200 active:scale-95 bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 shadow-sm border border-slate-200 dark:border-slate-700 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Kembali ke Beranda
            </a>
        </nav>

        <!-- Main Content -->
        <main class="flex-grow w-full pb-16">
            <header class="mb-12">
                <h1
                    class="text-3xl md:text-5xl font-black text-slate-900 dark:text-white tracking-tight mb-4 leading-tight">
                    Kebijakan Privasi &<br>Ketentuan Layanan
                </h1>
                <p class="text-slate-500 dark:text-slate-400 text-lg">
                    Transparansi penggunaan data dan layanan WaspadaLokal. Terakhir diperbarui: Maret 2026.
                </p>
            </header>

            <div class="space-y-10">

                <!-- Section: Privacy Policy -->
                <section
                    class="bg-white dark:bg-slate-800/60 backdrop-blur-xl border border-slate-200 dark:border-slate-700 rounded-3xl p-6 md:p-8 shadow-xl shadow-slate-200/50 dark:shadow-none">
                    <div class="flex items-center gap-3 mb-6">
                        <div
                            class="w-12 h-12 rounded-xl bg-blue-500/10 text-blue-500 dark:bg-blue-500/20 dark:text-blue-400 flex items-center justify-center border border-blue-500/20">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                </path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold dark:text-white">Kebijakan Privasi (Privacy Policy)</h2>
                    </div>

                    <div class="space-y-6 text-slate-600 dark:text-slate-300 leading-relaxed">

                        <div>
                            <h3 class="text-lg font-bold text-slate-800 dark:text-slate-200 mb-2">1. Penggunaan Akses
                                Geolokasi (GPS)</h3>
                            <p>WaspadaLokal membutuhkan akses ke lokasi perangkat Anda (Geolokasi) semata-mata untuk
                                <strong>mendeteksi koordinat terkini</strong> secara presisi. Data koordinat ini
                                digunakan untuk mengambil data cuaca lokal dan menganalisis status tingkat risiko (Aman,
                                Waspada, atau Bahaya) di sekitar Anda. Kami <strong>tidak menyimpan lintasan pergerakan
                                    Anda</strong> maupun melacak Anda di latar belakang.</p>
                        </div>

                        <div>
                            <h3 class="text-lg font-bold text-slate-800 dark:text-slate-200 mb-2">2. Manajemen &
                                Penyimpanan Data</h3>
                            <p>Keamanan privasi Anda adalah prioritas utama. WaspadaLokal <strong>tidak menyimpan data
                                    pribadi maupun data lokasi Anda secara permanen</strong> di dalam database kami.
                                Titik lokasi yang Anda berikan hanya dikirim secara aman (HTTPS) ke layanan API cuaca
                                pihak ketiga dan ke model Deep Learning AI kami, dan akan langsung dihapus setelah
                                perhitungan prediksi risiko selesai dilakukan (On-the-fly processing).</p>
                        </div>

                        <div>
                            <h3 class="text-lg font-bold text-slate-800 dark:text-slate-200 mb-2">3. Cookies &
                                Identifikasi Perangkat</h3>
                            <p>Kami menggunakan session bawaan framework dan token pengamanan dasar (CSRF token) demi
                                alasan keamanan selama kunjungan, namun tidak mengumpulkan jejak (tracking) identifikasi
                                yang menghubungkan riwayat navigasi Anda ke identifikasi nyata di dunia luar tanpa
                                sepengetahuan Anda.</p>
                        </div>

                    </div>
                </section>

                <!-- Section: Terms of Service -->
                <section
                    class="bg-white dark:bg-slate-800/60 backdrop-blur-xl border border-slate-200 dark:border-slate-700 rounded-3xl p-6 md:p-8 shadow-xl shadow-slate-200/50 dark:shadow-none">
                    <div class="flex items-center gap-3 mb-6">
                        <div
                            class="w-12 h-12 rounded-xl bg-indigo-500/10 text-indigo-500 dark:bg-indigo-500/20 dark:text-indigo-400 flex items-center justify-center border border-indigo-500/20">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H14">
                                </path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold dark:text-white">Ketentuan Layanan (Terms of Service)</h2>
                    </div>

                    <div class="space-y-6 text-slate-600 dark:text-slate-300 leading-relaxed">

                        <div>
                            <h3 class="text-lg font-bold text-slate-800 dark:text-slate-200 mb-2">1. Sumber Data Pihak
                                Ketiga</h3>
                            <p>Prediksi risiko dan data di dalam WaspadaLokal digabungkan dari pihak eksternal, yaitu:
                            </p>
                            <ul class="list-disc list-inside mt-2 ml-2 space-y-1">
                                <li><strong>OpenWeather API:</strong> Untuk mengambil parameter meteorologi real-time
                                    (Suhu, Kelembapan, dan Hujan).</li>
                                <li><strong>BMKG (Badan Meteorologi, Klimatologi, dan Geofisika):</strong> Untuk feeds
                                    peringatan dini cuaca nasional dan peringatan Gempa Bumi terkini.</li>
                            </ul>
                        </div>

                        <div>
                            <h3 class="text-lg font-bold text-slate-800 dark:text-slate-200 mb-2">2. Batasan Tanggung
                                Jawab Output AI</h3>
                            <p>WaspadaLokal adalah alat bantu deteksi mandiri yang ditenagai oleh model AI (*Deep
                                Learning*). Meskipun dilatih berdasarkan data historis yang komprehensif, prediksi
                                risiko cuaca (Aman, Waspada, Bahaya) maupun rekomendasi yang dihasilkan berupa perkiraan
                                statistik dan <strong>bukan jaminan kepastian mutlak atau himbauan evakuasi
                                    resmi</strong> negara. Segala keputusan yang diambil terkait keselamatan jiwa dan
                                properti merupakan tanggung jawab mandiri pengguna. Harap selalu merujuk pada arahan
                                otoritas hukum / Badan Penanggulangan Bencana setempat (BPBD) dalam kondisi darurat
                                nyata.</p>
                        </div>

                        <div>
                            <h3 class="text-lg font-bold text-slate-800 dark:text-slate-200 mb-2">3. Lisensi Layanan
                            </h3>
                            <p>Aplikasi ini bersifat open-source dan tidak komersial. Dilarang melakukan eksploitasi
                                beban trafik tidak wajar (Spam API / DDOS) ke layanan endpoint WaspadaLokal yang dapat
                                mengganggu performa server deteksi risiko pengguna lain.</p>
                        </div>

                    </div>
                </section>

            </div>
        </main>

        <!-- Footer -->
        <footer class="border-t border-slate-200 dark:border-slate-800 py-6 mt-auto">
            <div class="text-slate-500 dark:text-slate-500 text-sm text-center">
                <p>&copy; 2026 WaspadaLokal.</p>
                <p class="mt-1">Dibuat untuk Dicoding IDCamp Challenge.</p>
            </div>
        </footer>

    </div>
</body>

</html>