<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LamanMelayuController extends Controller
{
    public function index()
    {
        $karyas = \App\Models\LamanMelayu::where('is_published', true)
                                         ->orderBy('created_at', 'desc')
                                         ->paginate(12);
        return view('public.laman_melayu.index', compact('karyas'));
    }

    public function show($slug)
    {
        $karya = \App\Models\LamanMelayu::where('slug', $slug)
                                        ->where('is_published', true)
                                        ->firstOrFail();
                                        
        // Tambah view count
        $karya->increment('views');

        return view('public.laman_melayu.show', compact('karya'));
    }
}
