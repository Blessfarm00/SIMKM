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
        Schema::create('peralatan_medis', function (Blueprint $table) {
            $table->id();
            $table->string('kode_alat');
            $table->string('nama_alat');
            $table->string('gambar_alat');
            $table->integer('jumlah_alat');
            $table->string('keterangan');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peralatan_medis');
    }
};
