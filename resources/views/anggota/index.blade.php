@extends('layouts.app')

@section('title', 'Data Anggota — SIPUS')

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Data Anggota</h1>
            <p class="text-sm text-slate-500 mt-0.5">Daftar siswa/anggota terdaftar di perpustakaan.</p>
        </div>
        <a href="{{ route('anggota.create') }}"
           class="inline-flex items-center justify-center px-4 py-2 rounded-lg bg-indigo-600 text-white text-sm font-medium hover:bg-indigo-700 transition shadow-sm">
            + Tambah Anggota
        </a>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead class="bg-slate-50 text-slate-500 border-b border-slate-200 text-xs uppercase tracking-wider">
                    <tr>
                        <th class="py-3 px-4 font-semibold">No</th>
                        <th class="py-3 px-4 font-semibold">NIS</th>
                        <th class="py-3 px-4 font-semibold">Nama</th>
                        <th class="py-3 px-4 font-semibold">Kelas</th>
                        <th class="py-3 px-4 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($anggota as $item)
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="py-3 px-4 text-slate-500">{{ $loop->iteration }}</td>
                            <td class="py-3 px-4 font-mono text-xs text-slate-600">{{ $item->nis }}</td>
                            <td class="py-3 px-4 font-medium text-slate-900">{{ $item->nama }}</td>
                            <td class="py-3 px-4 text-slate-600">{{ $item->kelas }}</td>
                            <td class="py-3 px-4 text-right space-x-2 whitespace-nowrap">
                                <a href="{{ route('anggota.edit', $item->id) }}"
                                   class="inline-flex items-center px-2.5 py-1 rounded-md border border-slate-300 text-xs font-medium text-slate-700 hover:bg-slate-100 transition">
                                    Edit
                                </a>
                                <form action="{{ route('anggota.destroy', $item->id) }}" method="POST" class="inline"
                                      onsubmit="return confirm('Yakin hapus data anggota ini?')">
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
                            <td colspan="5" class="py-8 px-4 text-center text-slate-400">Belum ada data anggota.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection