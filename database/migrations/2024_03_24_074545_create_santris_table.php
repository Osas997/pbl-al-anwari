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
        Schema::create('santri', function (Blueprint $table) {
            $table->id();
            $table->string('nama_santri');
            $table->string('nis');
            $table->string('password');
            $table->string('no_nik');
            $table->string('no_kk');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->string('alamat');
            $table->string('nama_ayah');
            $table->string('nama_ibu');
            $table->enum('status', ['Aktif', 'Lulus', 'Tidak Lulus']);

            $table->unsignedBigInteger('id_syahriyyah');
            $table->foreign('id_syahriyyah')->references('id')->on('syahriyyah');

            $table->unsignedBigInteger('id_catering');
            $table->foreign('id_catering')->references('id')->on('catering');

            $table->unsignedBigInteger('id_angkatan');
            $table->foreign('id_angkatan')->references('id')->on('angkatan');

            $table->unsignedBigInteger('id_diniyyah');
            $table->foreign('id_diniyyah')->references('id')->on('diniyyah');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('santris');
    }
};
