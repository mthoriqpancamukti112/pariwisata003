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
        Schema::create('kapasitas_mejas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kuliner_id');
            $table->foreign('kuliner_id')->references('id')->on('kuliners')->onUpdate('cascade')->onDelete('cascade');
            $table->string('nama_meja', 100);
            $table->string('jumlah', 100);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
            $table->enum('status', ['Tersedia', 'Full']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kapasitas_mejas');
    }
};
