@extends('layouts.app')

@section('title', 'Dashboard — SIPUS')

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Dashboard Perpustakaan</h1>
            <p class="text-sm text-slate-500 mt-0.5">Ringkasan koleksi buku, anggota aktif, dan transaksi peminjaman.</p>
        </div>
        <div class="flex flex-wrap items-center gap-2">
            <a href="{{ route('peminjaman.create') }}"
               class="inline-flex items-center px-4 py-2 rounded-lg bg-indigo-600 text-white text-sm font-medium hover:bg-indigo-700 transition shadow-sm">
                + Pinjam Buku
            </a>
            <a href="{{ route('buku.create') }}"
               class="inline-flex items-center px-3.5 py-2 rounded-lg bg-white border border-slate-300 text-slate-700 text-sm font-medium hover:bg-slate-50 transition">
                + Buku
            </a>
            <a href="{{ route('anggota.create') }}"
               class="inline-flex items-center px-3.5 py-2 rounded-lg bg-white border border-slate-300 text-slate-700 text-sm font-medium hover:bg-slate-50 transition">
                + Anggota
            </a>
        </div>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4 mb-8">
        <div class="bg-white rounded-xl border border-slate-200 p-4 shadow-sm">
            <p class="text-xs font-medium uppercase tracking-wider text-slate-400">Judul Buku</p>
            <p class="text-2xl font-bold text-slate-900 mt-1">{{ $totalJudulBuku }}</p>
        </div>
        <div class="bg-white rounded-xl border border-slate-200 p-4 shadow-sm">
            <p class="text-xs font-medium uppercase tracking-wider text-slate-400">Total Stok</p>
            <p class="text-2xl font-bold text-indigo-600 mt-1">{{ $totalStokBuku }}</p>
        </div>
        <div class="bg-white rounded-xl border border-slate-200 p-4 shadow-sm">
            <p class="text-xs font-medium uppercase tracking-wider text-slate-400">Total Anggota</p>
            <p class="text-2xl font-bold text-slate-900 mt-1">{{ $totalAnggota }}</p>
        </div>
        <div class="bg-white rounded-xl border border-slate-200 p-4 shadow-sm">
            <p class="text-xs font-medium uppercase tracking-wider text-slate-400">Sedang Dipinjam</p>
            <p class="text-2xl font-bold text-amber-600 mt-1">{{ $peminjamanAktif }}</p>
        </div>
        <div class="bg-white rounded-xl border border-slate-200 p-4 shadow-sm col-span-2 sm:col-span-1">
            <p class="text-xs font-medium uppercase tracking-wider text-slate-400">Sudah Kembali</p>
            <p class="text-2xl font-bold text-emerald-600 mt-1">{{ $sudahKembali }}</p>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="px-5 py-4 border-b border-slate-200 flex items-center justify-between">
            <h2 class="font-semibold text-slate-900">Riwayat Peminjaman Terbaru</h2>
            <a href="{{ route('peminjaman.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-700">
                Lihat semua →
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead class="bg-slate-50 text-slate-500 border-b border-slate-200 text-xs uppercase tracking-wider">
                    <tr>
                        <th class="py-3 px-4 font-semibold">No</th>
                        <th class="py-3 px-4 font-semibold">Anggota</th>
                        <th class="py-3 px-4 font-semibold">Buku</th>
                        <th class="py-3 px-4 font-semibold">Tgl Pinjam</th>
                        <th class="py-3 px-4 font-semibold">Tgl Kembali</th>
                        <th class="py-3 px-4 font-semibold">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($riwayatPeminjaman as $item)
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="py-3 px-4 text-slate-500">{{ $loop->iteration }}</td>
                            <td class="py-3 px-4 font-medium text-slate-900">{{ $item->anggota->nama ?? '-' }}</td>
                            <td class="py-3 px-4 text-slate-700">{{ $item->buku->judul ?? '-' }}</td>
                            <td class="py-3 px-4 text-slate-600">{{ $item->tanggal_pinjam }}</td>
                            <td class="py-3 px-4 text-slate-600">{{ $item->tanggal_kembali ?? '-' }}</td>
                            <td class="py-3 px-4">
                                @if ($item->status === 'dipinjam')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                        Dipinjam
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                        Kembali
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 px-4 text-center text-slate-400">Belum ada transaksi peminjaman.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection