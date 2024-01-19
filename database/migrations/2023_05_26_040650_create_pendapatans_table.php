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
        Schema::create('pendapatans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pendapatan');
            $table->date('tanggal');
            $table->foreignId('kode_rekam_medis')->nullable();
            $table->foreignId('resep_id')->nullable();
            $table->string('harga_obat')->nullable();
            $table->string('pelayanan');
            $table->integer('harga');
            $table->string('spesialisasi')->nullable();
            $table->integer('harga_spesialisasi');
            $table->foreignId('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendapatans');
    }
};
