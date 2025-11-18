<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Check If The Application Is Under Maintenance
|--------------------------------------------------------------------------
*/

if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
*/

require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
*/

$app = require_once __DIR__.'/../bootstrap/app.php';

// --- TAMBAHAN KHUSUS VERCEL (Paste di sini) ---
$app->useStoragePath('/tmp/storage');

if (!is_dir('/tmp/storage')) {
    mkdir('/tmp/storage');
    mkdir('/tmp/storage/app');
    mkdir('/tmp/storage/framework');
    mkdir('/tmp/storage/framework/cache');
    mkdir('/tmp/storage/framework/sessions');
    mkdir('/tmp/storage/framework/views');
    mkdir('/tmp/storage/logs');
}
// ---------------------------------------------

$kernel = $app->make(Kernel::class);

$response = $kernel->handle(
    $request = Request::capture()
)->send();

$kernel->terminate($request, $response);