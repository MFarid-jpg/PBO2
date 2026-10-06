@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
    <div class="p-6 border-b border-slate-200 bg-slate-50/50 flex items-center gap-3">
        <a href="{{ route('rooms.index') }}" class="w-9 h-9 rounded-xl flex items-center justify-center border border-slate-200 text-slate-600 hover:bg-slate-100 transition-all">
            <i class="fa-solid fa-arrow-left text-sm"></i>
        </a>
        <div>
            <h2 class="text-xl font-bold text-slate-800">Tambah Kamar Baru</h2>
            <p class="text-sm text-slate-500 mt-0.5">Masukkan detail kamar untuk menambah inventaris hotel.</p>
        </div>
    </div>

    <form action="{{ route('rooms.store') }}" method="POST" class="p-6 space-y-5">
        @csrf
        
        <div>
            <label for="room_number" class="block text-sm font-semibold text-slate-700 mb-2">Nomor Kamar</label>
            <input type="text" name="room_number" id="room_number" placeholder="Contoh: A101, B205" value="{{ old('room_number') }}" required
                class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all outline-none text-sm @error('room_number') border-rose-400 focus:ring-rose-100 @enderror">
            @error('room_number')
                <p class="text-xs text-rose-500 mt-1 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="room_type" class="block text-sm font-semibold text-slate-700 mb-2">Tipe Kamar</label>
            <select name="room_type" id="room_type" required
                class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all outline-none text-sm bg-white">
                <option value="Standard">Standard Room</option>
                <option value="Deluxe">Deluxe Room</option>
                <option value="Suite">Suite Room</option>
                <option value="Presidential">Presidential Room</option>
            </select>
        </div>

        <div>
            <label for="price_per_night" class="block text-sm font-semibold text-slate-700 mb-2">Harga per Malam (Rp)</label>
            <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm font-medium">Rp</span>
                <input type="number" name="price_per_night" id="price_per_night" placeholder="500000" value="{{ old('price_per_night') }}" required
                    class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all outline-none text-sm">
            </div>
        </div>

        <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
            <a href="{{ route('rooms.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 hover:bg-slate-50 text-slate-700 font-medium text-sm transition-all">Batal</a>
            <button type="submit" class="px-5 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-medium text-sm transition-all shadow-sm">Simpan Kamar</button>
        </div>
    </form>
</div>
@endsection