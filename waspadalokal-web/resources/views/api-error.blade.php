<!DOCTYPE html>
<html lang="id" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Belum Siap | WaspadaLokal</title>
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
</head>

<body class="bg-slate-900 flex items-center justify-center min-h-screen">
    <div class="text-center p-8 bg-slate-800 rounded-3xl border border-slate-700 max-w-lg shadow-2xl">
        <div class="w-16 h-16 bg-rose-500/20 text-rose-500 rounded-2xl flex items-center justify-center mx-auto mb-6">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                </path>
            </svg>
        </div>
        <h1 class="text-2xl font-bold text-white mb-2">Sistem Sedang Dalam Persiapan</h1>
        <p class="text-slate-400">Konfigurasi API belum lengkap. Mohon hubungi admin untuk memasukkan
            OPENWEATHER_API_KEY di environment.</p>
    </div>
</body>

</html>