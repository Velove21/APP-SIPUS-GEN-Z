@extends('layouts.app')

@section('title', 'Tambah Anggota — SIPUS')

@section('content')
    <div class="max-w-xl mx-auto">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-slate-900">Tambah Anggota Baru</h1>
            <p class="text-sm text-slate-500 mt-0.5">Daftarkan anggota perpustakaan baru.</p>
        </div>

        <form action="{{ route('anggota.store') }}" method="POST" class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">NIS</label>
                <input type="text" name="nis" value="{{ old('nis') }}"
                       class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Nama Lengkap</label>
                <input type="text" name="nama" value="{{ old('nama') }}"
                       class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Kelas</label>
                <input type="text" name="kelas" value="{{ old('kelas') }}"
                       class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none">
            </div>

            <div class="pt-2 flex items-center gap-3">
                <button type="submit"
                        class="px-4 py-2 rounded-lg bg-indigo-600 text-white text-sm font-medium hover:bg-indigo-700 transition">
                    Simpan Anggota
                </button>
                <a href="{{ route('anggota.index') }}"
                   class="px-4 py-2 rounded-lg border border-slate-300 text-slate-700 text-sm font-medium hover:bg-slate-50 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection