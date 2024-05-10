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
        Schema::create('tagihan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_santri');
            $table->enum('jenis_tagihan', ['catering', 'syahriyyah']);
            $table->integer('nominal');
            $table->date('tgl_tagihan');
            $table->enum('status', ['belum lunas', 'lunas', 'angsur']);
            $table->string('tahun_ajaran');
            $table->string('semester')->nullable();
            $table->string('bulan')->nullable();
            $table->foreign('id_santri')->references('id')->on('santri');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihans');
    }
};
