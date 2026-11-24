@extends('layouts.app')

@section('title', 'Peminjaman Buku — SIPUS')

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Data Peminjaman</h1>
            <p class="text-sm text-slate-500 mt-0.5">Kelola transaksi peminjaman dan pengembalian buku.</p>
        </div>
        <a href="{{ route('peminjaman.create') }}"
           class="inline-flex items-center justify-center px-4 py-2 rounded-lg bg-indigo-600 text-white text-sm font-medium hover:bg-indigo-700 transition shadow-sm">
            + Tambah Peminjaman
        </a>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
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
                        <th class="py-3 px-4 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($peminjaman as $item)
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
                            <td class="py-3 px-4 text-right space-x-1.5 whitespace-nowrap">
                                @if ($item->status === 'dipinjam')
                                    <form action="{{ route('peminjaman.kembalikan', $item->id) }}" method="POST" class="inline"
                                          onsubmit="return confirm('Konfirmasi pengembalian buku ini?')">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                                class="inline-flex items-center px-2.5 py-1 rounded-md bg-emerald-600 text-white text-xs font-medium hover:bg-emerald-700 transition">
                                            Kembalikan
                                        </button>
                                    </form>
                                @endif

                                <a href="{{ route('peminjaman.edit', $item->id) }}"
                                   class="inline-flex items-center px-2.5 py-1 rounded-md border border-slate-300 text-xs font-medium text-slate-700 hover:bg-slate-100 transition">
                                    Edit
                                </a>

                                <form action="{{ route('peminjaman.destroy', $item->id) }}" method="POST" class="inline"
                                      onsubmit="return confirm('Yakin hapus transaksi peminjaman ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center px-2.5 py-1 rounded-md bg-rose-50 text-xs font-medium text-rose-700 hover:bg-rose-100 transition">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-8 px-4 text-center text-slate-400">Belum ada data peminjaman.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection