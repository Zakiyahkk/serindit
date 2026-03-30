<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WartaBasa;
use Illuminate\Http\Request;

class WartaBasaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $karyas = WartaBasa::when($search, function($query, $search) {
            return $query->where('judul', 'like', "%{$search}%");
        })->orderBy('created_at', 'desc')->paginate(10);
        
        return view('admin.warta_basa.index', compact('karyas', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.warta_basa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'konten' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_published' => 'nullable|boolean',
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['judul']);
        $validated['is_published'] = $request->has('is_published');

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('warta-basa', 'public');
        }

        WartaBasa::create($validated);

        return redirect()->route('admin.warta-basa.index')->with('success', 'Berita Warta Basa berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(WartaBasa $wartaBasa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $wartaBasa = WartaBasa::findOrFail($id);
        return view('admin.warta_basa.edit', compact('wartaBasa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $wartaBasa = WartaBasa::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'konten' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_published' => 'nullable|boolean',
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['judul']);
        $validated['is_published'] = $request->has('is_published');

        if ($request->hasFile('foto')) {
            if ($wartaBasa->foto) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($wartaBasa->foto);
            }
            $validated['foto'] = $request->file('foto')->store('warta-basa', 'public');
        }

        $wartaBasa->update($validated);

        return redirect()->route('admin.warta-basa.index')->with('success', 'Berita Warta Basa berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $wartaBasa = WartaBasa::findOrFail($id);
        if ($wartaBasa->foto) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($wartaBasa->foto);
        }
        $wartaBasa->delete();

        return redirect()->route('admin.warta-basa.index')->with('success', 'Berita Warta Basa berhasil dihapus!');
    }
}
