<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Peminjaman;

class DashboardController extends Controller
{
    public function index()
    {
        $totalJudulBuku = Buku::count();
        $totalStokBuku = Buku::sum('stok');
        $totalAnggota = Anggota::count();
        $peminjamanAktif = Peminjaman::where('status', 'dipinjam')->count();
        $sudahKembali = Peminjaman::where('status', 'kembali')->count();

        $riwayatPeminjaman = Peminjaman::with(['buku', 'anggota'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalJudulBuku',
            'totalStokBuku',
            'totalAnggota',
            'peminjamanAktif',
            'sudahKembali',
            'riwayatPeminjaman'
        ));
    }
}