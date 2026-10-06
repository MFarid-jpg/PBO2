@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Ucapan Selamat Datang -->
    <div class="bg-gradient-to-r from-indigo-600 to-violet-600 rounded-2xl p-6 text-white shadow-sm">
        <h2 class="text-2xl font-bold">Selamat Datang di StayEase, Admin!</h2>
        <p class="text-indigo-100 text-sm mt-1">Berikut adalah ringkasan performa dan operasional hotel hari ini.</p>
    </div>

    <!-- Grid Kartu Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
        <!-- Card 1: Total Kamar -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-xl font-bold">
                <i class="fa-solid fa-hotel"></i>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Kamar</p>
                <h3 class="text-2xl font-bold text-slate-800 mt-0.5">{{ $totalRooms }}</h3>
            </div>
        </div>

        <!-- Card 2: Kamar Tersedia -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl font-bold">
                <i class="fa-solid fa-door-open"></i>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Tersedia</p>
                <h3 class="text-2xl font-bold text-emerald-600 mt-0.5">{{ $availableRooms }}</h3>
            </div>
        </div>

        <!-- Card 3: Kamar Terisi -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl font-bold">
                <i class="fa-solid fa-bed"></i>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Terisi (Occupied)</p>
                <h3 class="text-2xl font-bold text-amber-600 mt-0.5">{{ $occupiedRooms }}</h3>
            </div>
        </div>

        <!-- Card 4: Total Reservasi -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center text-xl font-bold">
                <i class="fa-solid fa-calendar-check"></i>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Booking</p>
                <h3 class="text-2xl font-bold text-slate-800 mt-0.5">{{ $totalReservations }}</h3>
            </div>
        </div>
    </div>

    <!-- Riwayat Aktivitas Terbaru -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-5 border-b border-slate-200 bg-slate-50/50">
            <h3 class="font-bold text-slate-800">Aktivitas Reservasi Terbaru</h3>
            <p class="text-xs text-slate-500 mt-0.5">Daftar 5 transaksi pemesanan kamar terakhir.</p>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-100 text-slate-600 uppercase text-xs font-semibold tracking-wider">
                        <th class="py-3.5 px-6">Nama Tamu</th>
                        <th class="py-3.5 px-6">No. Kamar</th>
                        <th class="py-3.5 px-6">Durasi Menginap</th>
                        <th class="py-3.5 px-6">Total Pembayaran</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 text-sm text-slate-700">
                    @forelse($recentReservations as $res)
                        <tr class="hover:bg-slate-50/50 transition-all">
                            <td class="py-4 px-6 font-semibold text-slate-900">{{ $res->customer_name }}</td>
                            <td class="py-4 px-6 font-medium text-indigo-600">Kamar {{ $res->room->room_number ?? 'N/A' }}</td>
                            <td class="py-4 px-6 text-xs text-slate-500">
                                {{ date('d M', strtotime($res->check_in)) }} s/d {{ date('d M Y', strtotime($res->check_out)) }}
                            </td>
                            <td class="py-4 px-6 font-semibold text-slate-800">Rp {{ number_format($res->total_price, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-8 text-center text-slate-400 text-xs">Belum ada riwayat reservasi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection