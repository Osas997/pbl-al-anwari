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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tagihan');
            $table->unsignedBigInteger('id_admin')->nullable(true);
            $table->enum('metode_pembayaran', ['transfer', 'tunai']);
            $table->integer('jumlah_bayar');
            $table->datetime('tanggal_bayar');
            $table->enum('status', ['dikonfirmasi', 'pending'])->nullable();
            $table->foreign('id_tagihan')->references('id')->on('tagihan');
            $table->foreign('id_admin')->references('id')->on('admin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
