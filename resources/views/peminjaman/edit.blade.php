@extends('layouts.app')

@section('title', 'Edit Peminjaman — SIPUS')

@section('content')
    <div class="max-w-xl mx-auto">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-slate-900">Edit Data Peminjaman</h1>
            <p class="text-sm text-slate-500 mt-0.5">Koreksi data transaksi dengan penyesuaian stok otomatis.</p>
        </div>

        <form action="{{ route('peminjaman.update', $peminjaman->id) }}" method="POST" class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Anggota</label>
                <select name="anggota_id" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm bg-white focus:border-indigo-500 focus:outline-none">
                    @foreach ($anggota as $a)
                        <option value="{{ $a->id }}" {{ old('anggota_id', $peminjaman->anggota_id) == $a->id ? 'selected' : '' }}>
                            {{ $a->nis }} - {{ $a->nama }} ({{ $a->kelas }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Buku</label>
                <select name="buku_id" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm bg-white focus:border-indigo-500 focus:outline-none">
                    @foreach ($buku as $b)
                        <option value="{{ $b->id }}" {{ old('buku_id', $peminjaman->buku_id) == $b->id ? 'selected' : '' }}>
                            {{ $b->kode_buku }} - {{ $b->judul }} (Stok: {{ $b->stok }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Tanggal Pinjam</label>
                    <input type="date" name="tanggal_pinjam" value="{{ old('tanggal_pinjam', $peminjaman->tanggal_pinjam) }}"
                           class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Tanggal Kembali</label>
                    <input type="date" name="tanggal_kembali" value="{{ old('tanggal_kembali', $peminjaman->tanggal_kembali) }}"
                           class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Status</label>
                <select name="status" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm bg-white focus:border-indigo-500 focus:outline-none">
                    <option value="dipinjam" {{ old('status', $peminjaman->status) == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                    <option value="kembali" {{ old('status', $peminjaman->status) == 'kembali' ? 'selected' : '' }}>Kembali</option>
                </select>
            </div>

            <div class="pt-2 flex items-center gap-3">
                <button type="submit"
                        class="px-4 py-2 rounded-lg bg-indigo-600 text-white text-sm font-medium hover:bg-indigo-700 transition">
                    Perbarui Peminjaman
                </button>
                <a href="{{ route('peminjaman.index') }}"
                   class="px-4 py-2 rounded-lg border border-slate-300 text-slate-700 text-sm font-medium hover:bg-slate-50 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection