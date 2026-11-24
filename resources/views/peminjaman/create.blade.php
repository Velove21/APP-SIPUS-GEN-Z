@extends('layouts.app')

@section('title', 'Tambah Peminjaman — SIPUS')

@section('content')
    <div class="max-w-xl mx-auto">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-slate-900">Form Peminjaman Buku</h1>
            <p class="text-sm text-slate-500 mt-0.5">Catat peminjaman baru dan kurangi stok buku secara otomatis.</p>
        </div>

        <form action="{{ route('peminjaman.store') }}" method="POST" class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Anggota</label>
                <select name="anggota_id" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm bg-white focus:border-indigo-500 focus:outline-none">
                    <option value="">-- Pilih Anggota --</option>
                    @foreach ($anggota as $a)
                        <option value="{{ $a->id }}" {{ old('anggota_id') == $a->id ? 'selected' : '' }}>
                            {{ $a->nis }} - {{ $a->nama }} ({{ $a->kelas }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Buku</label>
                <select name="buku_id" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm bg-white focus:border-indigo-500 focus:outline-none">
                    <option value="">-- Pilih Buku --</option>
                    @foreach ($buku as $b)
                        <option value="{{ $b->id }}" {{ old('buku_id') == $b->id ? 'selected' : '' }}>
                            {{ $b->kode_buku }} - {{ $b->judul }} (Stok: {{ $b->stok }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Tanggal Pinjam</label>
                <input type="date" name="tanggal_pinjam" value="{{ old('tanggal_pinjam', date('Y-m-d')) }}"
                       class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none">
            </div>

            <div class="pt-2 flex items-center gap-3">
                <button type="submit"
                        class="px-4 py-2 rounded-lg bg-indigo-600 text-white text-sm font-medium hover:bg-indigo-700 transition">
                    Simpan Peminjaman
                </button>
                <a href="{{ route('peminjaman.index') }}"
                   class="px-4 py-2 rounded-lg border border-slate-300 text-slate-700 text-sm font-medium hover:bg-slate-50 transition">
                    Kembali
                </a>
            </div>
        </form>
    </div>
@endsection