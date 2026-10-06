<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = ['room_id', 'customer_name', 'check_in', 'check_out', 'total_price'];
    // Relasi balik ke model Room
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}