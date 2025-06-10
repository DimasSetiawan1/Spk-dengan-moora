<?php

use App\Console\Commands\AutoBackUpCommand;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


Artisan::command("backup:run")->dailyAt("02:00")->onSuccess(function () {
    Log::info('Backup completed successfully.');
})->onFailure(function () {
    Log::error('Backup failed.');
});
