<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Reservation;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung statistik untuk card dashboard
        $totalRooms = Room::count();
        $availableRooms = Room::where('status', 'available')->count();
        $occupiedRooms = Room::where('status', 'occupied')->count();
        $totalReservations = Reservation::count();

        // Mengambil 5 reservasi terbaru untuk ditampilkan di riwayat
        $recentReservations = Reservation::with('room')->latest()->take(5)->get();

        return view('dashboard', compact(
            'totalRooms', 
            'availableRooms', 
            'occupiedRooms', 
            'totalReservations',
            'recentReservations'
        ));
    }
}