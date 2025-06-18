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
        Schema::table('absensi', function (Blueprint $table) {
            $table->string('foto_absensi')->nullable()->after('keterangan');
            $table->decimal('latitude', 10, 8)->nullable()->after('foto_absensi');
            $table->decimal('longitude', 11, 8)->nullable()->after('latitude');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('absensi', function (Blueprint $table) {
            $table->dropColumn('foto_absensi');
            $table->dropColumn('latitude');
            $table->dropColumn('longitude');
        });
    }
};
