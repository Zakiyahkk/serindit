<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{

    /**
     * Display list of books
     */
    public function index(Request $request)
    {
        $search  = $request->input('search', '');
        $kategori = $request->input('kategori', '');
        $sort     = $request->input('sort', 'terbaru');

        $query = DB::table('books')
            ->select('books.*')
            ->leftJoin('book_stats', 'books.id', '=', 'book_stats.book_id');

        // SEARCH
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('books.title', 'like', "%{$search}%")
                  ->orWhere('books.issn', 'like', "%{$search}%");
            });
        }

        // FILTER KATEGORI
        if ($kategori) {
            $query->whereExists(function ($q) use ($kategori) {
                $q->select(DB::raw(1))
                  ->from('book_categories')
                  ->whereColumn('book_categories.book_id', 'books.id')
                  ->where('category_id', $kategori);
            });
        }

        // SORT
        match ($sort) {
            'az'        => $query->orderBy('books.title', 'asc'),
            'za'        => $query->orderBy('books.title', 'desc'),
            'terpopuler'=> $query->orderByRaw('COALESCE(book_stats.views_count, 0) DESC'),
            default     => $query->orderBy('books.created_at', 'desc'),
        };

        $books      = $query->paginate(12)->withQueryString();
        $categories = DB::table('categories')->orderBy('name')->get();
        $totalAll   = DB::table('books')->count();

        return view('admin.books.index', compact(
            'books',
            'categories',
            'totalAll',
            'search',
            'kategori',
            'sort'
        ));
    }


    /**
     * Show create form
     */
    public function create()
    {
        $categories = DB::table('categories')->orderBy('name')->get();
        $bookTypes  = DB::table('book_types')->orderBy('name')->get();

        return view('admin.books.create', compact(
            'categories',
            'bookTypes'
        ));
    }


    /**
     * Store new book
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',

            'volume' => 'nullable|string|max:50',
            'nomor' => 'nullable|string|max:50',
            'terbitan' => 'nullable|string|max:100',
            'issn' => 'nullable|string|max:50',

            'description' => 'nullable',

            'cover_image' => 'nullable|image|max:2048',
            'pdf_file' => 'nullable|mimes:pdf|max:51200',

            'categories' => 'nullable|array',
            'book_types' => 'nullable|array',

            'table_of_contents' => 'nullable|json',
            'page_offset' => 'nullable|integer|min:0',
        ]);

        $slug = Str::slug($request->title);

        // COVER
        $coverImagePath = null;
        if ($request->hasFile('cover_image')) {
            $coverImagePath = $request->file('cover_image')->store('covers', 'public');
        }

        // PDF
        $pdfFilePath = null;
        if ($request->hasFile('pdf_file')) {
            $pdfFilePath = $request->file('pdf_file')->store('books', 'public');
        }

        // INSERT BOOK
        $bookId = DB::table('books')->insertGetId([
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,

            'volume' => $request->volume,
            'nomor' => $request->nomor,
            'terbitan' => $request->terbitan,
            'issn' => $request->issn,

            'pdf_file' => $pdfFilePath,
            'cover_image' => $coverImagePath,

            'table_of_contents' => $request->table_of_contents,
            'page_offset' => $request->page_offset ?? 0,

            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // INSERT STATS
        DB::table('book_stats')->insert([
            'book_id' => $bookId,
            'views_count' => 0,
            'likes_count' => 0,
            'reads_count' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ATTACH CATEGORIES
        if ($request->has('categories')) {
            foreach ($request->categories as $categoryId) {
                DB::table('book_categories')->insert([
                    'book_id' => $bookId,
                    'category_id' => $categoryId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // ATTACH BOOK TYPES
        if ($request->has('book_types')) {
            foreach ($request->book_types as $typeId) {
                DB::table('book_book_type')->insert([
                    'book_id' => $bookId,
                    'book_type_id' => $typeId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // PROCESS PDF
        if ($pdfFilePath) {
            $book = \App\Models\Book::find($bookId);
            \App\Jobs\ProcessBookPages::dispatch($book);
        }

        return redirect()->route('admin.books.index')
            ->with('success', 'Majalah berhasil ditambahkan!');
    }


    /**
     * Show book detail
     */
    public function show($id)
    {
        $book = DB::table('books')->where('id', $id)->first();

        if (!$book) {
            abort(404);
        }

        $categories = DB::table('book_categories')
            ->join('categories', 'book_categories.category_id', '=', 'categories.id')
            ->where('book_categories.book_id', $id)
            ->select('categories.name')
            ->get();

        $bookTypes = DB::table('book_book_type')
            ->join('book_types', 'book_book_type.book_type_id', '=', 'book_types.id')
            ->where('book_book_type.book_id', $id)
            ->select('book_types.name')
            ->get();

        return view('admin.books.show', compact(
            'book',
            'categories',
            'bookTypes'
        ));
    }


    /**
     * Show edit form
     */
    public function edit($id)
    {
        $book = DB::table('books')->where('id', $id)->first();

        if (!$book) {
            abort(404);
        }

        $categories = DB::table('categories')->orderBy('name')->get();
        $bookTypes  = DB::table('book_types')->orderBy('name')->get();

        $selectedCategories = DB::table('book_categories')
            ->where('book_id', $id)
            ->pluck('category_id')
            ->toArray();

        $selectedBookTypes = DB::table('book_book_type')
            ->where('book_id', $id)
            ->pluck('book_type_id')
            ->toArray();

        return view('admin.books.edit', compact(
            'book',
            'categories',
            'bookTypes',
            'selectedCategories',
            'selectedBookTypes'
        ));
    }


    /**
     * Update book
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',

            'volume' => 'nullable|string|max:50',
            'nomor' => 'nullable|string|max:50',
            'terbitan' => 'nullable|string|max:100',
            'issn' => 'nullable|string|max:50',

            'description' => 'nullable',

            'cover_image' => 'nullable|image|max:2048',
            'pdf_file' => 'nullable|mimes:pdf|max:51200',

            'categories' => 'nullable|array',
            'book_types' => 'nullable|array',

            'table_of_contents' => 'nullable|json',
            'page_offset' => 'nullable|integer|min:0',
        ]);

        $slug = Str::slug($request->title);

        $book = DB::table('books')->where('id', $id)->first();

        $coverImagePath = $book->cover_image;
        $pdfFilePath    = $book->pdf_file;

        // COVER
        if ($request->hasFile('cover_image')) {

            if ($book->cover_image && Storage::disk('public')->exists($book->cover_image)) {
                Storage::disk('public')->delete($book->cover_image);
            }

            $coverImagePath = $request->file('cover_image')->store('covers', 'public');
        }

        // PDF
        if ($request->hasFile('pdf_file')) {

            if ($book->pdf_file && Storage::disk('public')->exists($book->pdf_file)) {
                Storage::disk('public')->delete($book->pdf_file);
            }

            $pagesDir = 'books/' . $id;
            if (Storage::disk('public')->exists($pagesDir)) {
                Storage::disk('public')->deleteDirectory($pagesDir);
            }

            $pdfFilePath = $request->file('pdf_file')->store('books', 'public');
        }

        // UPDATE
        DB::table('books')->where('id', $id)->update([
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,

            'volume' => $request->volume,
            'nomor' => $request->nomor,
            'terbitan' => $request->terbitan,
            'issn' => $request->issn,

            'pdf_file' => $pdfFilePath,
            'cover_image' => $coverImagePath,

            'table_of_contents' => $request->table_of_contents,
            'page_offset' => $request->page_offset ?? 0,

            'updated_at' => now(),
        ]);

        // UPDATE CATEGORIES
        DB::table('book_categories')->where('book_id', $id)->delete();

        if ($request->has('categories')) {
            foreach ($request->categories as $categoryId) {
                DB::table('book_categories')->insert([
                    'book_id' => $id,
                    'category_id' => $categoryId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // UPDATE TYPES
        DB::table('book_book_type')->where('book_id', $id)->delete();

        if ($request->has('book_types')) {
            foreach ($request->book_types as $typeId) {
                DB::table('book_book_type')->insert([
                    'book_id' => $id,
                    'book_type_id' => $typeId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // PROCESS PDF
        if ($request->hasFile('pdf_file')) {
            $book = \App\Models\Book::find($id);
            \App\Jobs\ProcessBookPages::dispatch($book);
        }

        return redirect()->route('admin.books.index')
            ->with('success', 'Majalah berhasil diperbarui!');
    }


    /**
     * Delete book
     */
    public function destroy($id)
    {
        $book = DB::table('books')->where('id', $id)->first();

        if ($book) {

            if ($book->cover_image && Storage::disk('public')->exists($book->cover_image)) {
                Storage::disk('public')->delete($book->cover_image);
            }

            if ($book->pdf_file && Storage::disk('public')->exists($book->pdf_file)) {
                Storage::disk('public')->delete($book->pdf_file);
            }

            $pagesDir = 'books/' . $id;

            if (Storage::disk('public')->exists($pagesDir)) {
                Storage::disk('public')->deleteDirectory($pagesDir);
            }

            DB::table('books')->where('id', $id)->delete();
        }

        return redirect()->route('admin.books.index')
            ->with('success', 'Majalah berhasil dihapus!');
    }

}
