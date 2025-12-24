<?php

use Illuminate\Support\Facades\Artisan;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';

// Créez l'application et initialisez le kernel
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

// Videz les caches
$kernel->call('cache:clear');
$kernel->call('route:clear');
$kernel->call('config:clear');
$kernel->call('view:clear');

echo "Caches Laravel vidés avec sccès.";
