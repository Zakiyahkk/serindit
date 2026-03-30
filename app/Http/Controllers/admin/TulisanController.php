<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tulisan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TulisanController extends Controller
{
    public function index()
    {
        // Tetap menggunakan paginate agar rapi
        $tulisans = Tulisan::latest()->paginate(10);
        return view('admin.tulisan.index', compact('tulisans'));
    }

    public function store(Request $request)
    {
        // Perbaikan validasi: 'kategori' harus string rule, bukan mengambil input langsung
        $request->validate([
            'judul' => 'required|max:255',
            'isi' => 'required',
            'kategori' => 'required', // Ini yang hamba perbaiki agar tidak error
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $gambar = null;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $namaFile = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/tulisan'), $namaFile);
            $gambar = $namaFile;
        }

        // Pastikan 'kategori' masuk ke dalam array create agar tersimpan
        Tulisan::create([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'isi' => $request->isi,
            'kategori' => $request->kategori, // Hamba tambahkan ini
            'gambar' => $gambar
        ]);

        return redirect()
            ->route('admin.tulisan.index')
            ->with('success','Tulisan berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $tulisan = Tulisan::findOrFail($id);

        // Perbaikan validasi pada update juga
        $request->validate([
            'judul' => 'required|max:255',
            'isi' => 'required',
            'kategori' => 'required', // Hamba perbaiki di sini juga
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $gambar = $tulisan->gambar;
        if ($request->hasFile('gambar')) {
            if ($gambar && file_exists(public_path('uploads/tulisan/'.$gambar))) {
                unlink(public_path('uploads/tulisan/'.$gambar));
            }
            $file = $request->file('gambar');
            $namaFile = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/tulisan'), $namaFile);
            $gambar = $namaFile;
        }

        // Masukkan 'kategori' ke dalam update agar tersimpan ke database
        $tulisan->update([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'isi' => $request->isi,
            'kategori' => $request->kategori, // Hamba tambahkan ini
            'gambar' => $gambar
        ]);

        return redirect()
            ->route('admin.tulisan.index')
            ->with('success','Tulisan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $tulisan = Tulisan::findOrFail($id);
        if ($tulisan->gambar && file_exists(public_path('uploads/tulisan/'.$tulisan->gambar))) {
            unlink(public_path('uploads/tulisan/'.$tulisan->gambar));
        }

        $tulisan->delete();

        return redirect()
            ->route('admin.tulisan.index')
            ->with('success','Tulisan berhasil dihapus');
    }
}