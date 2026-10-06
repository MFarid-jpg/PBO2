@extends('layouts.app')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
    <!-- Header Tabel -->
    <div class="p-6 border-b border-slate-200 flex justify-between items-center bg-slate-50/50">
        <div>
            <h2 class="text-xl font-bold text-slate-800">Daftar Kamar</h2>
            <p class="text-sm text-slate-500 mt-1">Kelola informasi nomor, tipe, harga, dan status ketersediaan kamar.</p>
        </div>
        <a href="{{ route('rooms.create') }}" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-4 py-2.5 rounded-xl transition-all shadow-sm hover:shadow-indigo-100 transform hover:-translate-y-0.5">
            <i class="fa-solid fa-plus text-sm"></i>
            <span>Tambah Kamar</span>
        </a>
    </div>

    @if(session('success'))
    <div class="mx-6 mt-4 p-4 bg-emerald-50 border-l-4 border-emerald-500 rounded-r-xl shadow-sm flex items-center gap-3 text-emerald-800">
        <i class="fa-solid fa-circle-check text-lg"></i>
        <span class="text-sm font-medium">{{ session('success') }}</span>
    </div>
@endif

@if(session('error'))
    <div class="mx-6 mt-4 p-4 bg-rose-50 border-l-4 border-rose-500 rounded-r-xl shadow-sm flex items-center gap-3 text-rose-800">
        <i class="fa-solid fa-circle-exclamation text-lg"></i>
        <span class="text-sm font-medium">{{ session('error') }}</span>
    </div>
@endif

    <!-- Data Tabel -->
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-100 text-slate-600 uppercase text-xs font-semibold tracking-wider">
                    <th class="py-4 px-6">No. Kamar</th>
                    <th class="py-4 px-6">Tipe Kamar</th>
                    <th class="py-4 px-6">Harga per Malam</th>
                    <th class="py-4 px-6">Status</th>
                    <th class="py-4 px-6 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 text-sm text-slate-700">
                @forelse($rooms as $room)
                    <tr class="hover:bg-slate-50/80 transition-all">
                        <td class="py-4 px-6 font-semibold text-slate-900">{{ $room->room_number }}</td>
                        <td class="py-4 px-6">
                            <span class="bg-slate-100 text-slate-800 px-2.5 py-1 rounded-md text-xs font-medium border border-slate-200">
                                {{ $room->room_type }}
                            </span>
                        </td>
                        <td class="py-4 px-6 font-medium text-emerald-600">Rp {{ number_format($room->price_per_night, 0, ',', '.') }}</td>
                        <td class="py-4 px-6">
                            @if($room->status == 'available')
                                <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-700 px-2.5 py-1 rounded-full text-xs font-semibold border border-emerald-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    Tersedia
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 bg-amber-50 text-amber-700 px-2.5 py-1 rounded-full text-xs font-semibold border border-amber-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                    Terisi
                                </span>
                            @endif
                        </td>
                        <td class="py-4 px-6 text-center">
                            <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kamar ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-rose-50 hover:bg-rose-100 text-rose-600 border border-rose-200 transition-all" title="Hapus Kamar">
                                    <i class="fa-solid fa-trash text-xs"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-12 text-center text-slate-400">
                            <div class="flex flex-col items-center justify-center gap-3">
                                <i class="fa-solid fa-inbox text-4xl text-slate-300"></i>
                                <p class="font-medium">Belum ada data kamar tersedia.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection