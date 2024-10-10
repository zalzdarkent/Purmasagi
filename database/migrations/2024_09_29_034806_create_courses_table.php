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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string("judul");
            $table->string("thumbnail")->nullable();
            $table->string("deskripsi");
            $table->timestamps();
        });
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->string("pertemuan");
            $table->string("deskripsi_konten");
            $table->string("video");
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
        Schema::dropIfExists('contents');
    }
};
