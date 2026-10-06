@extends('layouts.app')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
    <!-- Header Tabel -->
    <div class="p-6 border-b border-slate-200 flex justify-between items-center bg-slate-50/50">
        <div>
            <h2 class="text-xl font-bold text-slate-800">Daftar Reservasi Kamar</h2>
            <p class="text-sm text-slate-500 mt-1">Pantau tamu yang sedang menginap dan jadwal check-in/check-out.</p>
        </div>
        <a href="{{ route('reservations.create') }}" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-4 py-2.5 rounded-xl transition-all shadow-sm hover:shadow-indigo-100 transform hover:-translate-y-0.5">
            <i class="fa-solid fa-calendar-plus text-sm"></i>
            <span>Buat Reservasi</span>
        </a>
    </div>

    @if(session('success'))
    <div class="mx-6 mt-4 p-4 bg-emerald-50 border-l-4 border-emerald-500 rounded-r-xl shadow-sm flex items-center gap-3 text-emerald-800">
        <i class="fa-solid fa-circle-check text-lg"></i>
        <span class="text-sm font-medium">{{ session('success') }}</span>
    </div>
@endif

    <!-- Data Tabel -->
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-100 text-slate-600 uppercase text-xs font-semibold tracking-wider">
                    <th class="py-4 px-6">Nama Tamu</th>
                    <th class="py-4 px-6">No. Kamar</th>
                    <th class="py-4 px-6">Tipe Kamar</th>
                    <th class="py-4 px-6">Check In</th>
                    <th class="py-4 px-6">Check Out</th>
                    <th class="py-4 px-6">Total Harga</th>
                    <th class="py-4 px-6 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 text-sm text-slate-700">
                @forelse($reservations as $res)
                    <tr class="hover:bg-slate-50/80 transition-all">
                        <td class="py-4 px-6 font-semibold text-slate-900">{{ $res->customer_name }}</td>
                        <td class="py-4 px-6 font-medium text-indigo-600">
                            <i class="fa-solid fa-door-open text-xs mr-1 text-slate-400"></i> {{ $res->room->room_number ?? 'N/A' }}
                        </td>
                        <td class="py-4 px-6">
                            <span class="bg-slate-100 text-slate-800 px-2.5 py-1 rounded-md text-xs font-medium border border-slate-200">
                                {{ $res->room->room_type ?? 'N/A' }}
                            </span>
                        </td>
                        <td class="py-4 px-6 text-slate-600">
                            <i class="fa-regular fa-calendar text-xs mr-1 text-emerald-500"></i> {{ date('d M Y', strtotime($res->check_in)) }}
                        </td>
                        <td class="py-4 px-6 text-slate-600">
                            <i class="fa-regular fa-calendar text-xs mr-1 text-rose-500"></i> {{ date('d M Y', strtotime($res->check_out)) }}
                        </td>
                      <td class="py-4 px-6 font-semibold text-slate-900">
                        Rp {{ number_format($res->total_price, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm font-medium">
                        <form action="{{ route('reservations.destroy', $res->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin tamu {{ $res->customer_name }} ingin checkout?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold rounded-lg shadow-sm transition-colors">
                                <i class="fa-solid fa-circle-check"></i>
                                Checkout
                            </button>
                        </form>
                    </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-12 text-center text-slate-400">
                            <div class="flex flex-col items-center justify-center gap-3">
                                <i class="fa-solid fa-calendar-xmark text-4xl text-slate-300"></i>
                                <p class="font-medium">Belum ada aktivitas reservasi saat ini.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection