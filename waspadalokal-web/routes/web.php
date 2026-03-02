<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CuacaController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\BmkgController;

Route::get('/', function () {
    if (!env('OPENWEATHER_API_KEY')) {
        return view('api-error');
    }
    return view('welcome');
});

Route::post('/cek-cuaca', [CuacaController::class, 'cekLokasi']);

Route::get('/peta-pantauan', [MapController::class, 'index']);
Route::post('/api/prediksi-kota', [MapController::class, 'prediksiKota']);

Route::get('/pusat-peringatan', [BmkgController::class, 'index']);

Route::get('/panduan', function () {
    return view('panduan');
});
