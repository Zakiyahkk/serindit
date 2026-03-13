<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SubmissionController extends Controller
{
    /**
     * Tampilkan form kirim naskah (publik, tanpa login)
     */
    public function create()
    {
        return view('public.naskah.kirim');
    }

    /**
     * Simpan kiriman naskah ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'        => 'required|string|max:150',
            'no_hp'       => 'required|string|max:20',
            'email'       => 'required|email|max:150',
            'file_naskah' => 'required|mimes:doc,docx|max:10240', // maks 10 MB
            'file_foto'   => 'nullable|mimes:zip|max:51200',       // maks 50 MB
            'catatan'     => 'nullable|string|max:1000',
        ], [
            'nama.required'         => 'Nama wajib diisi.',
            'no_hp.required'        => 'Nomor HP wajib diisi.',
            'email.required'        => 'Email wajib diisi.',
            'email.email'           => 'Format email tidak valid.',
            'file_naskah.required'  => 'File naskah (.doc/.docx) wajib diupload.',
            'file_naskah.mimes'     => 'File naskah harus berformat .doc atau .docx.',
            'file_naskah.max'       => 'File naskah maksimal 10 MB.',
            'file_foto.mimes'       => 'File foto harus berformat .zip.',
            'file_foto.max'         => 'File foto maksimal 50 MB.',
        ]);

        // Upload file naskah
        $naskahPath = null;
        if ($request->hasFile('file_naskah')) {
            $naskahPath = $request->file('file_naskah')->store('submissions/naskah', 'public');
        }

        // Upload file foto (zip)
        $fotoPath = null;
        if ($request->hasFile('file_foto')) {
            $fotoPath = $request->file('file_foto')->store('submissions/foto', 'public');
        }

        // Simpan ke database
        DB::table('submissions')->insert([
            'nama'        => $request->nama,
            'no_hp'       => $request->no_hp,
            'email'       => $request->email,
            'file_naskah' => $naskahPath,
            'file_foto'   => $fotoPath,
            'catatan'     => $request->catatan,
            'status'      => 'pending',
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        return redirect()->route('naskah.sukses')
            ->with('sukses_naskah', true)
            ->with('nama_pengirim', $request->nama);
    }

    /**
     * Halaman sukses setelah kirim naskah
     */
    public function sukses()
    {
        if (!session('sukses_naskah')) {
            return redirect()->route('naskah.create');
        }
        return view('public.naskah.sukses');
    }
}
