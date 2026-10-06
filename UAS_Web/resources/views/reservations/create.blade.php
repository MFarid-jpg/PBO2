@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
    <div class="p-6 border-b border-slate-200 bg-slate-50/50 flex items-center gap-3">
        <a href="{{ route('reservations.index') }}" class="w-9 h-9 rounded-xl flex items-center justify-center border border-slate-200 text-slate-600 hover:bg-slate-100 transition-all">
            <i class="fa-solid fa-arrow-left text-sm"></i>
        </a>
        <div>
            <h2 class="text-xl font-bold text-slate-800">Buat Reservasi Baru</h2>
            <p class="text-sm text-slate-500 mt-0.5">Daftarkan tamu baru yang ingin melakukan booking kamar.</p>
        </div>
    </div>

    <!-- Menampilkan pesan error validasi global jika ada -->
    @if ($errors->any())
        <div class="p-4 mx-6 mt-6 bg-rose-50 border-l-4 border-rose-500 rounded-r-xl shadow-sm">
            <div class="flex items-center gap-2 text-rose-800 font-semibold mb-1">
                <i class="fa-solid fa-circle-exclamation"></i>
                <span>Gagal Menyimpan Data:</span>
            </div>
            <ul class="list-disc list-inside text-xs text-rose-600 space-y-0.5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('reservations.store') }}" method="POST" class="p-6 space-y-5">
        @csrf
        
        <!-- Input Nama Tamu -->
        <div>
            <label for="customer_name" class="block text-sm font-semibold text-slate-700 mb-2">Nama Tamu</label>
            <input type="text" name="customer_name" id="customer_name" placeholder="Masukkan nama lengkap tamu" value="{{ old('customer_name') }}" required
                class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all outline-none text-sm">
        </div>

        <!-- Pilihan Kamar Dinamis -->
        <div>
            <label for="room_id" class="block text-sm font-semibold text-slate-700 mb-2">Pilih Kamar yang Tersedia</label>
            <select name="room_id" id="room_id" required
                class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all outline-none text-sm bg-white">
                <option value="" disabled selected>-- Pilih Kamar --</option>
                @forelse($rooms as $room)
                    <option value="{{ $room->id }}" {{ old('room_id') == $room->id ? 'selected' : '' }}>
                        Kamar {{ $room->room_number }} ({{ $room->room_type }}) - Rp {{ number_format($room->price_per_night, 0, ',', '.') }}/malam
                    </option>
                @empty
                    <option value="" disabled>Tidak ada kamar yang berstatus tersedia. Silakan tambah kamar dulu.</option>
                @endforelse
            </select>
        </div>

        <!-- Tanggal Check-In dan Check-Out -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="check_in" class="block text-sm font-semibold text-slate-700 mb-2">Tanggal Check-In</label>
                <input type="date" name="check_in" id="check_in" value="{{ old('check_in') }}" required
                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all outline-none text-sm text-slate-600">
            </div>
            <div>
                <label for="check_out" class="block text-sm font-semibold text-slate-700 mb-2">Tanggal Check-Out</label>
                <input type="date" name="check_out" id="check_out" value="{{ old('check_out') }}" required
                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all outline-none text-sm text-slate-600">
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
            <a href="{{ route('reservations.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 hover:bg-slate-50 text-slate-700 font-medium text-sm transition-all">Batal</a>
            <button type="submit" class="px-5 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-medium text-sm transition-all shadow-sm">Konfirmasi Reservasi</button>
        </div>
    </form>
</div>
@endsection