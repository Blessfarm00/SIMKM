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
        Schema::create('sunats', function (Blueprint $table) {
            $table->id();
            $table->string('kode_sunat', 10);
            $table->string('nama_pasien', 50);
            $table->string('alamat', 50);
            $table->foreignId('dokter_id');
            $table->integer('umur');
            $table->date('tanggal');
            $table->string('keterangan');
            $table->string('pengerjaan')->default('Menunggu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sunats');
    }
};
