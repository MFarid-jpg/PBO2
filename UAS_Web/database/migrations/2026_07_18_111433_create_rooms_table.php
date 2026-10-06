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
    Schema::create('rooms', function (Blueprint $table) {
        $table->id();
        $table->string('room_number')->unique(); // Nomor kamar (misal: A101)
        $table->string('room_type');           // Tipe (misal: Deluxe, Suite)
        $table->integer('price_per_night');    // Harga per malam
        $table->enum('status', ['available', 'occupied'])->default('available'); // Status kamar
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
