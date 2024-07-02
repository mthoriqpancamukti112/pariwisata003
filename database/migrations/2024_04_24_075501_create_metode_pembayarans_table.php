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
        Schema::create('metode_pembayarans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kuliner_id');
            $table->foreign('kuliner_id')->references('id')->on('kuliners')->onDelete('cascade');
            $table->string('nama_metode');
            $table->string('nomor');
            $table->string('nama', 100);
            $table->decimal('biaya', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metode_pembayarans');
    }
};
