<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use App\Http\Controllers\MapController;

class TestPrediksi extends Command
{
    protected $signature = 'test:prediksi';
    protected $description = 'Test prediksi endpoint';

    public function handle()
    {
        $request = Request::create('/api/prediksi-kota', 'POST', ['lat' => -6.2, 'lon' => 106.8]);
        // Bypassing validate by mocking or just letting it run if it works within artisian
        // Actually Request::create() creates a Symfony request. We need to create an Illuminate Request.
        // But Request is Illuminate\Http\Request.
        // It failed previously because the Request was not bound to the container properly maybe?

        $response = app()->handle($request);
        $this->info($response->status());
        $this->info($response->getContent());
    }
}
