<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    // 1. Menampilkan semua daftar kamar
    public function index()
    {
        $rooms = Room::all();
        return view('rooms.index', compact('rooms'));
    }

    // 2. Menampilkan form tambah kamar
    public function create()
    {
        return view('rooms.create');
    }

    // 3. Menyimpan data kamar baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'room_number' => 'required|unique:rooms',
            'room_type' => 'required',
            'price_per_night' => 'required|numeric',
        ]);

        Room::create($request->all());

        return redirect()->route('rooms.index')->with('success', 'Kamar berhasil ditambahkan!');
    }

    // 4. Menghapus data kamar
    public function destroy(Room $room)
    {
        // Cek apakah kamar sedang di-booking/occupied
        if ($room->status === 'occupied') {
            return redirect()->route('rooms.index')->with('error', 'Kamar tidak bisa dihapus karena sedang terisi oleh tamu!');
        }

        $room->delete();
        return redirect()->route('rooms.index')->with('success', 'Kamar berhasil dihapus!');
    }
}