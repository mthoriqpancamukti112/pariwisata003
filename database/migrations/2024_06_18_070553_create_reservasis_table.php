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
        Schema::create('reservasis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tempat');
            $table->foreign('id_tempat')->references('id')->on('kuliners')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
            $table->unsignedBigInteger('id_meja');
            $table->foreign('id_meja')->references('id')->on('kapasitas_mejas')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('id_metode_pembayaran');
            $table->foreign('id_metode_pembayaran')->references('id')->on('metode_pembayarans')->onUpdate('cascade')->onDelete('cascade');
            $table->string('nama_pengunjung', 100);
            $table->string('no_hp');
            $table->string('email');
            $table->dateTime('tgl_pesan');
            $table->integer('jumlah_orang');
            $table->string('status', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservasis');
    }
};