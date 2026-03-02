<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$request = Illuminate\Http\Request::create('/api/prediksi-kota', 'POST', ['lat' => -6.2, 'lon' => 106.8]);
// Bypassing CSRF token since we just call the controller directly if needed.
// Actually, hitting it through the kernel will trigger CSRF middleware and fail with 419.
// Let's just instantiate the controller and call the method directly.

$controller = $app->make(\App\Http\Controllers\MapController::class);
$response = $controller->prediksiKota($request);
echo $response->getContent();
