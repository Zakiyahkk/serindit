<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WartaBasaController extends Controller
{
    public function index()
    {
        $karyas = \App\Models\WartaBasa::where('is_published', true)
                                         ->orderBy('created_at', 'desc')
                                         ->paginate(12);
        return view('public.warta_basa.index', compact('karyas'));
    }

    public function show($slug)
    {
        $karya = \App\Models\WartaBasa::where('slug', $slug)
                                        ->where('is_published', true)
                                        ->firstOrFail();
                                        
        // Tambah view count
        $karya->increment('views');

        return view('public.warta_basa.show', compact('karya'));
    }
}
