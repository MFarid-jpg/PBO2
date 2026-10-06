<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    // Izinkan kolom-kolom ini untuk diisi langsung via form
    protected $fillable = ['room_number', 'room_type', 'price_per_night', 'status'];
}