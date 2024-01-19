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
        Schema::create('perawatan_lukas', function (Blueprint $table) {

            $table->id();
            $table->string('kode_perawatan', 10);
            $table->string('nama_pasien', 50);
            $table->string('alamat', 50);
            $table->foreignId('dokter_id');
            $table->string('jenis_luka');
            $table->string('status');
            $table->string('pengerjaan')->default('Proccess');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perawatan_lukas');
    }
};
