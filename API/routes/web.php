<?php

use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'status' => true,
        'message' => 'School Template API',
        'version' => '1.0.0',
        'environment' => app()->environment(),
        'maintenance_mode' => app()->isDownForMaintenance(),
    ]);
});

Route::get('/img', [ImageController::class, 'resize']);

Route::get('/h2c-proxy', function (\Illuminate\Http\Request $request) {
    $url = $request->query('url');
    abort_unless(filter_var($url, FILTER_VALIDATE_URL), 400);

    $client = new \GuzzleHttp\Client(['verify' => false, 'timeout' => 10]);
    $res = $client->get($url);

    $ctype = $res->getHeaderLine('Content-Type') ?: 'image/png';
    return response($res->getBody(), 200, [
        'Content-Type' => $ctype,
        'Cache-Control' => 'no-cache',
        'Access-Control-Allow-Origin' => '*',
    ]);
});
