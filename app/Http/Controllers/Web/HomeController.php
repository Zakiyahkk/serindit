<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Book;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Buku Terbaru
        $terbaru = Book::with(['stat'])
            ->latest()
            ->take(4)
            ->get();

        // 2. Buku Terpopuler
        $terpopuler = Book::select('books.*')
            ->leftJoin('book_stats', 'books.id', '=', 'book_stats.book_id')
            ->orderByDesc('book_stats.views_count')
            ->take(8)
            ->get();

        // 3. Kategori beserta jumlah buku
        $kategori = Category::withCount('books')->get();

        // 4. Statistik
        $stats = [
            'buku'     => DB::table('books')->count(),
            'pembaca'  => DB::table('book_stats')->sum('reads_count'),
            'kategori' => DB::table('categories')->count(),
        ];

        return view('public.home.home', compact(
            'terbaru',
            'terpopuler',
            'kategori',
            'stats'
        ));
    }
}
