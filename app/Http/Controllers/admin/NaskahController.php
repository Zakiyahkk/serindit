<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Naskah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NaskahController extends Controller
{
    /**
     * Tampilkan daftar naskah masuk (inbox).
     */
    public function index(Request $request)
    {
        $query = Naskah::query()->latest('tanggal_kirim');

        // Filter pencarian
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('judul', 'like', '%' . $request->search . '%')
                  ->orWhere('penulis', 'like', '%' . $request->search . '%');
            });
        }

        // Filter jenis
        if ($request->filled('jenis') && $request->jenis !== 'semua') {
            $query->where('jenis', $request->jenis);
        }

        // Filter status
        if ($request->filled('status') && $request->status !== 'semua') {
            $query->where('status', $request->status);
        }

        $naskah     = $query->paginate(10)->withQueryString();
        $totalMasuk = Naskah::count();
        $menunggu   = Naskah::menunggu()->count();
        $disetujui  = Naskah::disetujui()->count();
        $ditolak    = Naskah::ditolak()->count();

        return view('admin.naskah.index', compact(
            'naskah',
            'totalMasuk',
            'menunggu',
            'disetujui',
            'ditolak'
        ));
    }

    /**
     * Tampilkan detail naskah.
     */
    public function show(Naskah $naskah)
    {
        return view('admin.naskah.show', compact('naskah'));
    }

    /**
     * Setujui naskah.
     */
    public function setujui(Request $request, Naskah $naskah)
    {
        $naskah->update([
            'status'         => 'Disetujui',
            'tanggal_review' => now(),
            'catatan_admin'  => $request->catatan_admin,
        ]);

        return redirect()->route('admin.naskah.index')
            ->with('success', "Naskah \"{$naskah->judul}\" berhasil disetujui.");
    }

    /**
     * Tolak naskah.
     */
    public function tolak(Request $request, Naskah $naskah)
    {
        $request->validate([
            'catatan_penolakan' => 'required|string|max:1000',
        ], [
            'catatan_penolakan.required' => 'Catatan penolakan wajib diisi.',
        ]);

        $naskah->update([
            'status'            => 'Ditolak',
            'tanggal_review'    => now(),
            'catatan_penolakan' => $request->catatan_penolakan,
        ]);

        return redirect()->route('admin.naskah.index')
            ->with('success', "Naskah \"{$naskah->judul}\" telah ditolak.");
    }

    /**
     * Kembalikan status naskah ke Menunggu.
     */
    public function reset(Naskah $naskah)
    {
        $naskah->update([
            'status'            => 'Menunggu',
            'tanggal_review'    => null,
            'catatan_penolakan' => null,
            'catatan_admin'     => null,
        ]);

        return redirect()->route('admin.naskah.index')
            ->with('success', "Status naskah \"{$naskah->judul}\" dikembalikan ke Menunggu.");
    }

    /**
     * Hapus naskah.
     */
    public function destroy(Naskah $naskah)
    {
        $judul = $naskah->judul;

        if ($naskah->file_naskah) {
            Storage::disk('public')->delete($naskah->file_naskah);
        }

        $naskah->delete();

        return redirect()->route('admin.naskah.index')
            ->with('success', "Naskah \"{$judul}\" berhasil dihapus.");
    }
}