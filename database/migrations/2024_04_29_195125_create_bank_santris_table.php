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
        Schema::create('bank_santris', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_santri');
            $table->string('nama_bank');
            $table->string('sandi_bank');
            $table->string('nama_rekening');
            $table->string('nomor_rekening');
            $table->timestamps();
            $table->foreign('id_santri')->references('id')->on('santri');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_santris');
    }
};
