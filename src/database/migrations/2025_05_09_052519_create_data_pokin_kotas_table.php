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
        Schema::create('data_pokin_kotas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kondisi');
            $table->json('indikator');
            $table->smallInteger('parentId')->nullable();
            $table->smallInteger('misi')->nullable();
            $table->string('tahun')->nullable();
            $table->string('color')->nullable();
            $table->string('color_indikator')->nullable();
            $table->string('text_color')->nullable();
            $table->string('text_color_indikator')->nullable();
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_pokin_kotas');
    }
};
