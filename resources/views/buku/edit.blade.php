@extends('layouts.app')

@section('title', 'Edit Buku — SIPUS')

@section('content')
    <div class="max-w-xl mx-auto">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-slate-900">Edit Data Buku</h1>
            <p class="text-sm text-slate-500 mt-0.5">Perbarui informasi atau stok buku.</p>
        </div>

        <form action="{{ route('buku.update', $buku->id) }}" method="POST" class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Kode Buku</label>
                <input type="text" name="kode_buku" value="{{ old('kode_buku', $buku->kode_buku) }}"
                       class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Judul Buku</label>
                <input type="text" name="judul" value="{{ old('judul', $buku->judul) }}"
                       class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Penulis</label>
                <input type="text" name="penulis" value="{{ old('penulis', $buku->penulis) }}"
                       class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Stok</label>
                <input type="number" name="stok" min="0" value="{{ old('stok', $buku->stok) }}"
                       class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none">
            </div>

            <div class="pt-2 flex items-center gap-3">
                <button type="submit"
                        class="px-4 py-2 rounded-lg bg-indigo-600 text-white text-sm font-medium hover:bg-indigo-700 transition">
                    Perbarui Buku
                </button>
                <a href="{{ route('buku.index') }}"
                   class="px-4 py-2 rounded-lg border border-slate-300 text-slate-700 text-sm font-medium hover:bg-slate-50 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection