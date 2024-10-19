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
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // Nama siswa
            $table->string('kelas'); // Kelas siswa
            $table->string('email')->unique(); // Email sebagai username
            $table->string('password'); // Password (hash)
            $table->string('remember_token')->nullable(); // Token untuk remember me
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
