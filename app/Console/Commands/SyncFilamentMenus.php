<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use App\Models\Menu;

class SyncFilamentMenus extends Command
{
    protected $signature = 'menu:sync';
    protected $description = 'Scan folder Filament Resources dan simpan ke database';

    public function handle()
    {
        $path = app_path('Filament/Resources');
        $files = File::files($path);

        foreach ($files as $file) {
            $className = $file->getBasename('.php');
            $fqcn = "App\\Filament\\Resources\\" . $className;

            if (class_exists($fqcn) && is_subclass_of($fqcn, \Filament\Resources\Resource::class)) {
                
                Menu::firstOrCreate(
                    ['resource' => $fqcn],
                    [
                        'label' => $className, 
                        'is_visible' => true,
                        'sort' => 0,
                    ]
                );
            }
        }

        $this->info('Selesai! Semua Resource sudah terdaftar di tabel Menus.');
    }
}