<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('secretgarden', function () {
    $this->info('--- Memulai Proses Secret Garden ---');

    $this->info('1. Generating permissions with Filament Shield...');
    Artisan::call('shield:generate --all');
    
    $this->info('2. Scanning Resources to Menu Management...');
    Artisan::call('menu:sync'); 
    
    $this->info('3. Resetting all cache...');
    Artisan::call('permission:cache-reset');
    Artisan::call('filament:clear-cached-components');
    Artisan::call('optimize:clear');
    
    $this->info('--- Proses Secret Garden Selesai ---');
})->purpose('Generate shield, sync menu, dan reset cache secara menyeluruh');