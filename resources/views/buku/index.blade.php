@extends('layouts.app')

@section('title', 'Data Buku — SIPUS')

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Data Buku</h1>
            <p class="text-sm text-slate-500 mt-0.5">Kelola katalog dan stok buku perpustakaan.</p>
        </div>
        <a href="{{ route('buku.create') }}"
           class="inline-flex items-center justify-center px-4 py-2 rounded-lg bg-indigo-600 text-white text-sm font-medium hover:bg-indigo-700 transition shadow-sm">
            + Tambah Buku
        </a>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead class="bg-slate-50 text-slate-500 border-b border-slate-200 text-xs uppercase tracking-wider">
                    <tr>
                        <th class="py-3 px-4 font-semibold">No</th>
                        <th class="py-3 px-4 font-semibold">Kode</th>
                        <th class="py-3 px-4 font-semibold">Judul</th>
                        <th class="py-3 px-4 font-semibold">Penulis</th>
                        <th class="py-3 px-4 font-semibold">Stok</th>
                        <th class="py-3 px-4 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($buku as $item)
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="py-3 px-4 text-slate-500">{{ $loop->iteration }}</td>
                            <td class="py-3 px-4 font-mono text-xs text-slate-600">{{ $item->kode_buku ?? '-' }}</td>
                            <td class="py-3 px-4 font-medium text-slate-900">{{ $item->judul }}</td>
                            <td class="py-3 px-4 text-slate-600">{{ $item->penulis ?? '-' }}</td>
                            <td class="py-3 px-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $item->stok > 0 ? 'bg-indigo-50 text-indigo-700' : 'bg-rose-100 text-rose-700' }}">
                                    {{ $item->stok }}
                                </span>
                            </td>
                            <td class="py-3 px-4 text-right space-x-2 whitespace-nowrap">
                                <a href="{{ route('buku.edit', $item->id) }}"
                                   class="inline-flex items-center px-2.5 py-1 rounded-md border border-slate-300 text-xs font-medium text-slate-700 hover:bg-slate-100 transition">
                                    Edit
                                </a>
                                <form action="{{ route('buku.destroy', $item->id) }}" method="POST" class="inline"
                                      onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
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
                            <td colspan="6" class="py-8 px-4 text-center text-slate-400">Belum ada data buku.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection