<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\APengaturanController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TulisanController;
use App\Http\Controllers\Admin\NaskahController;
use App\Http\Middleware\AdminAuth;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\BookListController;
use App\Http\Controllers\Web\HelpController;

// --- PUBLIC ROUTES ---
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tulisan/{slug}', [TulisanController::class, 'show'])->name('tulisan.show');
Route::get('/koleksi', [BookListController::class, 'index'])->name('book.list');
Route::get('/bantuan', [HelpController::class, 'index'])->name('help');

// Kanal Naskah (Publik — tanpa login)
Route::get('/kirim-naskah', [\App\Http\Controllers\Web\SubmissionController::class, 'create'])->name('naskah.create');
Route::post('/kirim-naskah', [\App\Http\Controllers\Web\SubmissionController::class, 'store'])->name('naskah.store');
Route::get('/kirim-naskah/sukses', [\App\Http\Controllers\Web\SubmissionController::class, 'sukses'])->name('naskah.sukses');

use App\Http\Controllers\Web\JejakPenaController;
use App\Http\Controllers\Web\PantunSyairController;

// Static routes — Jejak Pena
Route::get('/puisi', [JejakPenaController::class, 'puisiIndex'])->name('static.puisi');
Route::get('/puisi/{slug}', [JejakPenaController::class, 'puisiShow'])->name('puisi.show');
Route::get('/cerpen', [JejakPenaController::class, 'cerpenIndex'])->name('static.cerpen');
Route::get('/cerpen/{slug}', [JejakPenaController::class, 'cerpenShow'])->name('cerpen.show');

// Laman Melayu Publik
Route::get('/laman-melayu', [\App\Http\Controllers\Web\LamanMelayuController::class, 'index'])->name('laman_melayu.index');
Route::get('/laman-melayu/{slug}', [\App\Http\Controllers\Web\LamanMelayuController::class, 'show'])->name('laman_melayu.show');

// Warta Basa Publik
Route::get('/warta-basa', [\App\Http\Controllers\Web\WartaBasaController::class, 'index'])->name('warta_basa.index');
Route::get('/warta-basa/{slug}', [\App\Http\Controllers\Web\WartaBasaController::class, 'show'])->name('warta_basa.show');

Route::view('/panduan-penulisan', 'public.static.panduan_penulisan')->name('static.panduan_penulisan');
Route::view('/kontak', 'public.static.kontak')->name('static.kontak');

// Pantun & Syair
Route::get('/pantun-syair', [PantunSyairController::class, 'index'])->name('pantun_syair.index');
Route::get('/pantun/{slug}', [PantunSyairController::class, 'showPantun'])->name('pantun.show');
Route::get('/syair/{slug}', [PantunSyairController::class, 'showSyair'])->name('syair.show');

Route::get('/buku/{id}', [BookListController::class, 'show'])->name('book.show');
Route::post('/buku/{id}/like', [\App\Http\Controllers\Web\BookListController::class, 'toggleLike'])->name('book.like');
Route::get('/baca/{slug}', function ($slug) {
    $book = \App\Models\Book::where('slug', $slug)->orWhere('id', $slug)->firstOrFail();
    
    // Increment reads count
    $stat = $book->stat()->firstOrCreate(['book_id' => $book->id]);
    $stat->increment('reads_count');

    // Get pages
    $pagesPath = storage_path('app/public/books/' . $book->id . '/pages');
    $pages = [];
    if (file_exists($pagesPath)) {
        $files = \Illuminate\Support\Facades\File::files($pagesPath);
        // Sort naturally: page-1.jpg, page-2.jpg, ..., page-10.jpg
        usort($files, function($a, $b) {
            return strnatcmp($a->getFilename(), $b->getFilename());
        });

        foreach ($files as $file) {
            $pages[] = asset('storage/books/' . $book->id . '/pages/' . $file->getFilename());
        }
    }

    return view('public.flipbook', compact('book', 'pages'));
})->name('book.read');

// Manual Trigger for PDF Conversion (Debugging/Maintenance)
Route::get('/admin/books/{id}/process', function($id) {
    if (!auth()->check()) abort(403);
    $book = \App\Models\Book::findOrFail($id);
    \App\Jobs\ProcessBookPages::dispatchSync($book);
    return "Proses konversi selesai untuk buku: " . $book->title;
})->name('admin.books.process');


/*
|--------------------------------------------------------------------------
| AUTH ADMIN
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])
    ->name('admin.login');

Route::post('/admin/login', [AdminAuthController::class, 'login'])
    ->name('admin.login.submit');

Route::post('/admin/logout', [AdminAuthController::class, 'logout'])
    ->name('admin.logout');

/*
|--------------------------------------------------------------------------
| ADMIN (WAJIB LOGIN)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->middleware(AdminAuth::class)
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('admin.dashboard.index');
        })->name('admin.dashboard');

        // ===== BUKU =====
        Route::resource('books', \App\Http\Controllers\Admin\BookController::class)->names([
            'index'   => 'admin.books.index',
            'create'  => 'admin.books.create',
            'store'   => 'admin.books.store',
            'show'    => 'admin.books.show',
            'edit'    => 'admin.books.edit',
            'update'  => 'admin.books.update',
            'destroy' => 'admin.books.destroy',
        ]);

         // ===== TULISAN =====
        Route::resource('tulisan', TulisanController::class)->names([
            'index'   => 'admin.tulisan.index',
            'create'  => 'admin.tulisan.create',
            'store'   => 'admin.tulisan.store',
            'show'    => 'admin.tulisan.show',
            'edit'    => 'admin.tulisan.edit',
            'update'  => 'admin.tulisan.update',
            'destroy' => 'admin.tulisan.destroy',
        ])->except(['show']);

        // ===== NASKAH =====
        Route::prefix('naskah')->name('admin.naskah.')->controller(\App\Http\Controllers\Admin\NaskahController::class)->group(function () {
            Route::get('/',                  'index')   ->name('index');
            Route::get('/{naskah}',          'show')    ->name('show');
            Route::post('/{naskah}/setujui', 'setujui') ->name('setujui');
            Route::post('/{naskah}/tolak',   'tolak')   ->name('tolak');
            Route::post('/{naskah}/reset',   'reset')   ->name('reset');
            Route::delete('/{naskah}',       'destroy') ->name('destroy');  
            });

        // ===== KATEGORI =====
        Route::resource('categories', CategoryController::class)->names([
            'index'   => 'admin.categories.index',
            'store'   => 'admin.categories.store',
            'update'  => 'admin.categories.update',
            'destroy' => 'admin.categories.destroy',
        ])->only(['index', 'store', 'update', 'destroy']);

        // ===== PENGATURAN =====
        Route::get('/pengaturan', [APengaturanController::class, 'index'])
            ->name('admin.pengaturan');

        Route::post('/pengaturan', [APengaturanController::class, 'store'])
            ->name('admin.pengaturan.store');

        Route::post('/pengaturan/update', [APengaturanController::class, 'update'])
            ->name('admin.pengaturan.update');

        Route::post('/pengaturan/delete', [APengaturanController::class, 'destroy'])
            ->name('admin.pengaturan.destroy');

        // ===== KIRIMAN NASKAH =====
        Route::get('/submissions', [\App\Http\Controllers\Admin\SubmissionController::class, 'index'])
            ->name('admin.submissions.index');
        Route::get('/submissions/{id}', [\App\Http\Controllers\Admin\SubmissionController::class, 'show'])
            ->name('admin.submissions.show');
        Route::patch('/submissions/{id}/status', [\App\Http\Controllers\Admin\SubmissionController::class, 'updateStatus'])
            ->name('admin.submissions.updateStatus');
        Route::delete('/submissions/{id}', [\App\Http\Controllers\Admin\SubmissionController::class, 'destroy'])
            ->name('admin.submissions.destroy');

        // ===== KARYA SASTRA (Jejak Pena) =====
        Route::get('/karya-sastra', [\App\Http\Controllers\Admin\KaryaSastraController::class, 'index'])->name('admin.karya-sastra.index');
        Route::get('/karya-sastra/create', [\App\Http\Controllers\Admin\KaryaSastraController::class, 'create'])->name('admin.karya-sastra.create');
        Route::post('/karya-sastra', [\App\Http\Controllers\Admin\KaryaSastraController::class, 'store'])->name('admin.karya-sastra.store');
        Route::get('/karya-sastra/{karyaSastra}/edit', [\App\Http\Controllers\Admin\KaryaSastraController::class, 'edit'])->name('admin.karya-sastra.edit');
        Route::put('/karya-sastra/{karyaSastra}', [\App\Http\Controllers\Admin\KaryaSastraController::class, 'update'])->name('admin.karya-sastra.update');
        // ===== Laman Melayu =====
        Route::resource('laman-melayu', \App\Http\Controllers\Admin\LamanMelayuController::class)->names([
            'index'   => 'admin.laman-melayu.index',
            'create'  => 'admin.laman-melayu.create',
            'store'   => 'admin.laman-melayu.store',
            'edit'    => 'admin.laman-melayu.edit',
            'update'  => 'admin.laman-melayu.update',
            'destroy' => 'admin.laman-melayu.destroy',
        ]);

        // ===== Warta Basa =====
        Route::resource('warta-basa', \App\Http\Controllers\Admin\WartaBasaController::class)->names([
            'index'   => 'admin.warta-basa.index',
            'create'  => 'admin.warta-basa.create',
            'store'   => 'admin.warta-basa.store',
            'edit'    => 'admin.warta-basa.edit',
            'update'  => 'admin.warta-basa.update',
            'destroy' => 'admin.warta-basa.destroy',
        ]);

    });

/*
|--------------------------------------------------------------------------
| MAINTENANCE ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/maintenance', function () {
    $log = [];
    
    // 1. Clear Caches
    try {
        \Illuminate\Support\Facades\Artisan::call('view:clear');
        \Illuminate\Support\Facades\Artisan::call('cache:clear');
        \Illuminate\Support\Facades\Artisan::call('config:clear');
        \Illuminate\Support\Facades\Artisan::call('route:clear');
        $log[] = "✅ Cache Cleared (View, Config, Route)";
    } catch (\Exception $e) {
        $log[] = "❌ Cache Clear Error: " . $e->getMessage();
    }

    // 2. Path Debugging
    $basePath = base_path();
    $publicPath = public_path();
    $storagePath = storage_path('app/public');
    
    $log[] = "----------------------------------";
    $log[] = "<b>Base Path:</b> " . $basePath;
    $log[] = "<b>Public Path (Laravel):</b> " . $publicPath;
    $log[] = "<b>Storage Target Path:</b> " . $storagePath;
    $log[] = "----------------------------------";

    // 3. STORAGE LINK ATTEMPT
    $linksAttempted = [];
    
    // Path 1: Default Laravel Public Path
    $linksAttempted[] = $publicPath . '/storage';
    
    // Path 2: Deteksi cPanel umum (naik satu level ke public_html)
    // Jika app ada di /home/user/sembari, maka public mungkin di /home/user/public_html
    $cpanelPublic = realpath($basePath . '/../public_html');
    if ($cpanelPublic) {
        $linksAttempted[] = $cpanelPublic . '/storage';
        $linksAttempted[] = $cpanelPublic . '/sembari/storage'; // Jika subfolder
    }
    
    // Path 3: Deteksi jika app ada di subfolder public_html
    $cpanelSub = realpath($basePath . '/../../public_html');
    if ($cpanelSub) {
        $linksAttempted[] = $cpanelSub . '/storage';
    }

    $linkSuccess = false;
    foreach ($linksAttempted as $linkPath) {
        if (file_exists($linkPath)) {
            if (is_link($linkPath)) {
                $target = readlink($linkPath);
                $log[] = "ℹ️ Link ditemukan di: <b>$linkPath</b><br>&nbsp;&nbsp;&nbsp;Mengarah ke: $target";
                if ($target === $storagePath) {
                    $log[] = "✅ <span style='color:green'>LINK INI BENAR!</span>";
                    $linkSuccess = true;
                } else {
                    $log[] = "⚠️ <span style='color:orange'>Link salah sasaran!</span>";
                }
            } else {
                $log[] = "⚠️ <b>$linkPath</b> ada tapi BUKAN LINK (Folder/File Asli). Hapus manual via File Manager!";
            }
        } else {
            // Coba buat link
            try {
                // Pastikan folder induk ada
                $parentDir = dirname($linkPath);
                if (!file_exists($parentDir)) {
                     $log[] = "❌ Gagal buat link di <b>$linkPath</b>: Folder induk ($parentDir) tidak ditemukan.";
                     continue;
                }

                symlink($storagePath, $linkPath);
                $log[] = "✅ <span style='color:green'>BERHASIL membuat link baru di:</span> <b>$linkPath</b>";
                $linkSuccess = true;
            } catch (\Exception $e) {
                $log[] = "❌ Gagal membuat link di <b>$linkPath</b>: " . $e->getMessage();
            }
        }
    }

    // Output
    $output = implode("<br><br>", $log);
    
    $statusIcon = $linkSuccess ? '✅' : '⚠️';
    $statusMsg = $linkSuccess ? 'Storage Link Berhasil Dibuat/Ditemukan' : 'Periksa Log di Bawah';

    return '<div style="font-family:sans-serif; padding:50px; background:#f8fafc; color:#1e293b; min-height:100vh; display:flex; flex-direction:column; align-items:center;">
                <div style="background:white; padding:40px; border-radius:16px; box-shadow:0 10px 25px rgba(0,0,0,0.1); max-width:800px; width:100%;">
                    <div style="text-align:center; margin-bottom:20px;">
                        <span style="font-size:40px;">'.$statusIcon.'</span>
                        <h2 style="color:#6366f1; margin:10px 0;">'.$statusMsg.'</h2>
                    </div>
                    
                    <div style="background:#1e293b; color:#a5b4fc; padding:20px; border-radius:8px; font-family:monospace; font-size:13px; line-height:1.6; word-break:break-all;">
                        ' . $output . '
                    </div>
                    
                    <div style="margin-top:20px; text-align:center; font-size:13px; color:#64748b;">
                        Tips: Jika link sudah benar tapi gambar tetap 404, pastikan permission folder <b>storage/app/public</b> adalah 755 atau 777.
                    </div>

                    <div style="text-align:center; margin-top:30px;">
                        <a href="'.url('/').'" style="text-decoration:none; background:#6366f1; color:white; padding:12px 24px; border-radius:8px; font-weight:600;">Kembali ke Home</a>
                    </div>
                </div>
            </div>';
});
