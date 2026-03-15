<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KaryaSastra;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KaryaSastraController extends Controller
{
    public function index(Request $request)
    {
        $tipe   = $request->query('tipe', '');
        $search = $request->query('search', '');

        $query = KaryaSastra::orderBy('tipe')->orderBy('sort_order')->orderBy('id');

        if ($tipe)   $query->where('tipe', $tipe);
        if ($search) $query->where('judul', 'like', "%$search%");

        $karyas  = $query->paginate(15)->withQueryString();
        $counts  = KaryaSastra::selectRaw('tipe, count(*) as total')->groupBy('tipe')->pluck('total','tipe');
        $totalAll = KaryaSastra::count();

        return view('admin.karya_sastra.index', compact('karyas','tipe','search','counts','totalAll'));
    }

    public function create(Request $request)
    {
        $tipe = $request->query('tipe', 'puisi');
        return view('admin.karya_sastra.create', compact('tipe'));
    }

    public function store(Request $request)
    {
        $tipe = $request->input('tipe');

        $validated = $request->validate([
            'tipe'        => 'required|in:puisi,cerpen,pantun,syair',
            'judul'       => 'required|string|max:255',
            'penulis'     => 'required|string|max:255',
            'deskripsi'   => 'nullable|string',
            'jenis'       => 'nullable|string|max:100',
            'tema'        => 'nullable|string|max:100',
            'durasi_baca' => 'nullable|string|max:50',
            'makna'       => 'nullable|string',
            'is_published'=> 'nullable|boolean',
            'sort_order'  => 'nullable|integer',
        ]);

        $konten   = $this->parseKonten($tipe, $request);
        $metadata = $this->parseMetadata($tipe, $request);

        KaryaSastra::create([
            ...$validated,
            'slug'         => Str::slug($validated['judul']),
            'konten'       => $konten,
            'metadata'     => $metadata,
            'is_published' => $request->boolean('is_published', true),
            'sort_order'   => $validated['sort_order'] ?? 0,
        ]);

        return redirect()->route('admin.karya-sastra.index', ['tipe' => $tipe])
                         ->with('success', 'Karya berhasil ditambahkan!');
    }

    public function edit(KaryaSastra $karyaSastra)
    {
        return view('admin.karya_sastra.edit', ['karya' => $karyaSastra]);
    }

    public function update(Request $request, KaryaSastra $karyaSastra)
    {
        $tipe = $karyaSastra->tipe;

        $validated = $request->validate([
            'judul'       => 'required|string|max:255',
            'penulis'     => 'required|string|max:255',
            'deskripsi'   => 'nullable|string',
            'jenis'       => 'nullable|string|max:100',
            'tema'        => 'nullable|string|max:100',
            'durasi_baca' => 'nullable|string|max:50',
            'makna'       => 'nullable|string',
            'sort_order'  => 'nullable|integer',
        ]);

        $konten   = $this->parseKonten($tipe, $request);
        $metadata = $this->parseMetadata($tipe, $request);

        $karyaSastra->update([
            ...$validated,
            'slug'         => Str::slug($validated['judul']),
            'konten'       => $konten,
            'metadata'     => $metadata,
            'is_published' => $request->boolean('is_published', true),
            'sort_order'   => $validated['sort_order'] ?? 0,
        ]);

        return redirect()->route('admin.karya-sastra.index', ['tipe' => $tipe])
                         ->with('success', 'Karya berhasil diperbarui!');
    }

    public function destroy(KaryaSastra $karyaSastra)
    {
        $tipe = $karyaSastra->tipe;
        $karyaSastra->delete();
        return redirect()->route('admin.karya-sastra.index', ['tipe' => $tipe])
                         ->with('success', 'Karya berhasil dihapus.');
    }

    // ══════════════════════════════════════════
    //  Helpers — parsing form input ke JSON
    // ══════════════════════════════════════════

    private function parseKonten(string $tipe, Request $request): array
    {
        if ($tipe === 'puisi') {
            // konten[0] = "Baris 1\nBaris 2" (satu bait, enter = baris baru)
            $bait_raw = $request->input('bait', []);
            return array_map(fn($b) => array_values(array_filter(explode("\n", str_replace("\r", "", $b)))), $bait_raw);
        }

        if ($tipe === 'cerpen') {
            // konten = textarea besar, double-newline = paragraf baru
            $text = $request->input('teks_cerpen', '');
            return array_values(array_filter(array_map('trim', preg_split('/\n{2,}/', $text))));
        }

        if ($tipe === 'pantun') {
            // 4 input: baris_1, baris_2, baris_3, baris_4
            return [
                $request->input('baris_1', ''),
                $request->input('baris_2', ''),
                $request->input('baris_3', ''),
                $request->input('baris_4', ''),
            ];
        }

        if ($tipe === 'syair') {
            // bait_syair[0] = "Baris 1\nBaris 2\nBaris 3\nBaris 4"
            $bait_raw = $request->input('bait_syair', []);
            return array_map(fn($b) => array_values(array_filter(explode("\n", str_replace("\r", "", $b)))), $bait_raw);
        }

        return [];
    }

    private function parseMetadata(string $tipe, Request $request): array
    {
        if ($tipe === 'puisi') {
            $majas = array_values(array_filter(array_map('trim', explode(',', $request->input('majas', '')))));
            return ['majas' => $majas];
        }

        if ($tipe === 'cerpen') {
            $tema = array_values(array_filter(array_map('trim', explode(',', $request->input('tema_tags', '')))));
            return ['tema' => $tema];
        }

        return [];
    }
}
