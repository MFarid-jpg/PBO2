<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    // 1. Menampilkan semua data reservasi
    public function index()
    {
        // Mengambil data reservasi beserta data kamarnya
        $reservations = Reservation::with('room')->latest()->get();
        return view('reservations.index', compact('reservations'));
    }

    // 2. Menampilkan form tambah reservasi
    public function create()
    {
        // Hanya mengambil kamar yang statusnya 'available'
        $rooms = Room::where('status', 'available')->get();
        return view('reservations.create', compact('rooms'));
    }

    // 3. Menyimpan data reservasi baru
    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'customer_name' => 'required|string|max:255',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
        ]);

        // 1. Ambil data kamar untuk mendapatkan harga per malam
        $room = Room::findOrFail($request->room_id);

        // 2. Hitung jumlah hari menginap
        $checkIn = new \DateTime($request->check_in);
        $checkOut = new \DateTime($request->check_out);
        $duration = $checkIn->diff($checkOut)->days;
        
        // Antisipasi jika check-in dan check-out di hari yang sama, hitung 1 malam
        if ($duration == 0) {
            $duration = 1;
        }

        // 3. Hitung total harga
        $totalPrice = $duration * $room->price_per_night;

        // 4. Gabungkan data inputan dengan total_price yang sudah dihitung
        $data = $request->all();
        $data['total_price'] = $totalPrice;

        // 5. Simpan data reservasi ke database
        Reservation::create($data);

        // 6. Update status kamar menjadi 'occupied' (terisi)
        $room->update(['status' => 'occupied']);

        return redirect()->route('reservations.index')->with('success', 'Reservasi berhasil dibuat!');
    }

    // 4. Menghapus data reservasi (Checkout)
    public function destroy(Reservation $reservation)
    {
        // Kembalikan status kamar menjadi 'available' sebelum reservasi dihapus
        $room = Room::find($reservation->room_id);
        if ($room) {
            $room->update(['status' => 'available']);
        }

        $reservation->delete();

        return redirect()->route('reservations.index')->with('success', 'Reservasi telah diselesaikan (Checkout)!');
    }
}