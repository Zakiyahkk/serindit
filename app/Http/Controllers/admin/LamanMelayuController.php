<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LamanMelayu;
use Illuminate\Http\Request;

class LamanMelayuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $karyas = LamanMelayu::when($search, function($query, $search) {
            return $query->where('judul', 'like', "%{$search}%");
        })->orderBy('created_at', 'desc')->paginate(10);
        
        return view('admin.laman_melayu.index', compact('karyas', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.laman_melayu.create');
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
            $validated['foto'] = $request->file('foto')->store('laman-melayu', 'public');
        }

        LamanMelayu::create($validated);

        return redirect()->route('admin.laman-melayu.index')->with('success', 'Tulisan Laman Melayu berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(LamanMelayu $lamanMelayu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $lamanMelayu = LamanMelayu::findOrFail($id);
        return view('admin.laman_melayu.edit', compact('lamanMelayu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $lamanMelayu = LamanMelayu::findOrFail($id);

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
            if ($lamanMelayu->foto) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($lamanMelayu->foto);
            }
            $validated['foto'] = $request->file('foto')->store('laman-melayu', 'public');
        }

        $lamanMelayu->update($validated);

        return redirect()->route('admin.laman-melayu.index')->with('success', 'Tulisan Laman Melayu berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $lamanMelayu = LamanMelayu::findOrFail($id);
        if ($lamanMelayu->foto) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($lamanMelayu->foto);
        }
        $lamanMelayu->delete();

        return redirect()->route('admin.laman-melayu.index')->with('success', 'Tulisan Laman Melayu berhasil dihapus!');
    }
}
