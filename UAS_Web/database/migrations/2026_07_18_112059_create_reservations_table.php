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
    Schema::create('reservations', function (Blueprint $table) {
        $table->id();
        // Menghubungkan ke tabel rooms. Jika kamar dihapus, reservasi ikut terhapus.
        $table->foreignId('room_id')->constrained()->onDelete('cascade'); 
        $table->string('customer_name');     // Nama tamu
        $table->date('check_in');            // Tanggal masuk
        $table->date('check_out');           // Tanggal keluar
        $table->integer('total_price');      // Total bayar
        $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
