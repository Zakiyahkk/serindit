<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\KaryaSastra;

class JejakPenaController extends Controller
{
    // ══ PUISI ══════════════════════════════
    public function puisiIndex()
    {
        $puisis = KaryaSastra::published()->ofType('puisi')->get();
        return view('public.static.puisi.index', compact('puisis'));
    }

    public function puisiShow($slug)
    {
        $puisi = KaryaSastra::published()->ofType('puisi')->where('slug', $slug)->firstOrFail();
        $related = KaryaSastra::published()->ofType('puisi')->where('id', '!=', $puisi->id)->take(3)->get();
        return view('public.static.puisi.show', compact('puisi', 'related'));
    }

    // ══ CERPEN ═════════════════════════════
    public function cerpenIndex()
    {
        $cerpens = KaryaSastra::published()->ofType('cerpen')->get();
        return view('public.static.cerpen.index', compact('cerpens'));
    }

    public function cerpenShow($slug)
    {
        $cerpen = KaryaSastra::published()->ofType('cerpen')->where('slug', $slug)->firstOrFail();
        $related = KaryaSastra::published()->ofType('cerpen')->where('id', '!=', $cerpen->id)->take(3)->get();
        return view('public.static.cerpen.show', compact('cerpen', 'related'));
    }
}
