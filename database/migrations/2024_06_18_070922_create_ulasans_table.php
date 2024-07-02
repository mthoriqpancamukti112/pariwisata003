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
        Schema::create('ulasans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reservasi_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('id_tempat');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('reservasi_id')->references('id')->on('reservasis')->onDelete('cascade');
            $table->foreign('id_tempat')->references('id')->on('kuliners')->onDelete('cascade');
            $table->text('komentar');
            $table->integer('rating');
            $table->date('tgl_ulasan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ulasans');
    }
};