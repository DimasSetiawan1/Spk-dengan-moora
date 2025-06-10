<?php

use App\Console\Commands\AutoBackUpCommand;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


Schedule::command("custom:backup-run", function () {
    try {
        Log::info("Starting backup command...");

        Artisan::command('backup:run');

        $output = Artisan::output();

        Log::info("Backup command completed successfully.");
        $this->info($output);
    } catch (\Exception $e) {
        Log::error("Backup command failed: " . $e->getMessage());
        $this->error("Backup command failed: " . $e->getMessage());
    }
})->purpose('Run the backup command');
