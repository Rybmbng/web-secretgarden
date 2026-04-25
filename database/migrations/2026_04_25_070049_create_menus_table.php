<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
        $table->id();
        $table->string('resource')->unique(); // Contoh: 'App\Filament\Resources\UserResource'
        $table->string('label');              // Nama menu: 'Karyawan'
        $table->string('group')->nullable();  // Grup: 'Setting'
        $table->string('icon')->nullable();   // Ikon: 'heroicon-o-users'
        $table->integer('sort')->default(0);  // Urutan
        $table->boolean('is_visible')->default(true);
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
