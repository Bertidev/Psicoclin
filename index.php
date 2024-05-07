<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

if (file_exists($maintenance = __DIR__.'/projeto_app/laravel-app/storage/framework/maintenance.php')) {
    require $maintenance;
}

require __DIR__.'/projeto_app/laravel-app/vendor/autoload.php';

(require_once __DIR__.'/projeto_app/laravel-app/bootstrap/app.php')
    ->handleRequest(Request::capture());
