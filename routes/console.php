<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('logs:clear', function() {
    $logStoragePath = storage_path('logs/laravel.log');

    File::put($logStoragePath, '');

    $this->comment('Log data has been cleared!');
})->describe('Clear log data');