<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::with(['buku', 'anggota'])->latest()->get();
        return view('peminjaman.index', compact('peminjaman'));
    }

    public function create()
    {
        $buku = Buku::where('stok', '>', 0)->get();
        $anggota = Anggota::all();
        return view('peminjaman.create', compact('buku', 'anggota'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:buku,id',
            'anggota_id' => 'required|exists:anggota,id',
            'tanggal_pinjam' => 'required|date',
        ]);

        $buku = Buku::findOrFail($request->buku_id);

        if ($buku->stok < 1) {
            return back()->withErrors(['buku_id' => 'Stok buku habis!'])->withInput();
        }

        DB::transaction(function () use ($request, $buku) {
            Peminjaman::create([
                'buku_id' => $request->buku_id,
                'anggota_id' => $request->anggota_id,
                'tanggal_pinjam' => $request->tanggal_pinjam,
                'status' => 'dipinjam',
            ]);

            $buku->decrement('stok');
        });

        return redirect()->route('peminjaman.index')
                         ->with('success', 'Transaksi peminjaman berhasil dicatat.');
    }

    public function edit(Peminjaman $peminjaman)
    {
        $buku = Buku::all();
        $anggota = Anggota::all();
        return view('peminjaman.edit', compact('peminjaman', 'buku', 'anggota'));
    }

    public function update(Request $request, Peminjaman $peminjaman)
    {
        $request->validate([
            'buku_id' => 'required|exists:buku,id',
            'anggota_id' => 'required|exists:anggota,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'nullable|date|after_or_equal:tanggal_pinjam',
            'status' => 'required|in:dipinjam,kembali',
        ]);

        try {
            DB::transaction(function () use ($request, $peminjaman) {
                $bukuLamaId = $peminjaman->buku_id;
                $statusLama = $peminjaman->status;
                $bukuBaruId = (int) $request->buku_id;
                $statusBaru = $request->status;

                if ($statusLama === 'dipinjam') {
                    Buku::where('id', $bukuLamaId)->increment('stok');
                }

                if ($statusBaru === 'dipinjam') {
                    $bukuBaru = Buku::lockForUpdate()->findOrFail($bukuBaruId);

                    if ($bukuBaru->stok < 1) {
                        throw new \RuntimeException('Stok buku yang dipilih tidak mencukupi!');
                    }

                    $bukuBaru->decrement('stok');
                }

                $peminjaman->update([
                    'buku_id' => $bukuBaruId,
                    'anggota_id' => $request->anggota_id,
                    'tanggal_pinjam' => $request->tanggal_pinjam,
                    'tanggal_kembali' => $request->tanggal_kembali,
                    'status' => $statusBaru,
                ]);
            });
        } catch (\RuntimeException $e) {
            return back()->withErrors(['buku_id' => $e->getMessage()])->withInput();
        }

        return redirect()->route('peminjaman.index')
                         ->with('success', 'Data peminjaman berhasil diperbarui.');
    }

    public function destroy(Peminjaman $peminjaman)
    {
        DB::transaction(function () use ($peminjaman) {
            if ($peminjaman->status === 'dipinjam') {
                Buku::where('id', $peminjaman->buku_id)->increment('stok');
            }

            $peminjaman->delete();
        });

        return redirect()->route('peminjaman.index')
                         ->with('success', 'Data peminjaman berhasil dihapus.');
    }

    public function kembalikan(Peminjaman $peminjaman)
    {
        if ($peminjaman->status === 'kembali') {
            return redirect()->route('peminjaman.index')
                            ->with('success', 'Buku ini sudah dikembalikan sebelumnya.');
        }

        DB::transaction(function () use ($peminjaman) {
            $peminjaman->update([
                'status' => 'kembali',
                'tanggal_kembali' => now()->toDateString(),
            ]);

            Buku::where('id', $peminjaman->buku_id)->increment('stok');
        });

        return redirect()->route('peminjaman.index')
                        ->with('success', 'Buku berhasil dikembalikan dan stok sudah diperbarui.');
    }
}