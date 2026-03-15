<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\KaryaSastra;

class PantunSyairController extends Controller
{
    public function index()
    {
        $pantuns = KaryaSastra::published()->ofType('pantun')->get();
        $syairs  = KaryaSastra::published()->ofType('syair')->get();
        return view('public.static.pantun_syair.index', compact('pantuns', 'syairs'));
    }

    public function showPantun($slug)
    {
        $pantun  = KaryaSastra::published()->ofType('pantun')->where('slug', $slug)->firstOrFail();
        $related = KaryaSastra::published()->ofType('pantun')->where('id', '!=', $pantun->id)->take(4)->get();
        return view('public.static.pantun_syair.pantun', compact('pantun', 'related'));
    }

    public function showSyair($slug)
    {
        $syair   = KaryaSastra::published()->ofType('syair')->where('slug', $slug)->firstOrFail();
        $related = KaryaSastra::published()->ofType('syair')->where('id', '!=', $syair->id)->take(4)->get();
        return view('public.static.pantun_syair.syair', compact('syair', 'related'));
    }
}
