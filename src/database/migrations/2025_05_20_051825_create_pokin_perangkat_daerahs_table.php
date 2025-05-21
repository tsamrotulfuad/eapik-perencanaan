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
        Schema::create('pokin_perangkat_daerahs', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('keterangan')->nullable();
            $table->smallInteger('misi')->nullable();
            $table->unsignedBigInteger('kondisi_id')->nullable();
            $table->string('tahun');
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();

            $table->foreign('kondisi_id')->references('id')->on('data_pokin_kotas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pokin_perangkat_daerahs');
    }
};
