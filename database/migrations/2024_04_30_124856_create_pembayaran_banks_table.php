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
        Schema::create('pembayaran_bank', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pembayaran');
            $table->unsignedBigInteger('id_bank_pondok');
            $table->unsignedBigInteger('id_bank_santri');
            $table->string('bukti_transfer');
            $table->foreign('id_pembayaran')->references('id')->on('pembayaran');
            $table->foreign('id_bank_santri')->references('id')->on('bank_santri');
            $table->foreign('id_bank_pondok')->references('id')->on('bank_pondok');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran_banks');
    }
};
