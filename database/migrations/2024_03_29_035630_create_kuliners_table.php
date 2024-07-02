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
        Schema::create('kuliners', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('tempat_kuliner', 100);
            $table->unsignedBigInteger('id_kategori');
            $table->foreign('id_kategori')->references('id')->on('kategoris')->onUpdate('cascade')->onDelete('cascade');
            $table->text('deskripsi');
            $table->text('lokasi');
            $table->string('jam_operasional', 100);
            $table->text('fasilitas');
            $table->string('kontak', 100);
            $table->text('galeri');
            $table->date('tgl_upload');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kuliners');
    }
};
