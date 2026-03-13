<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SubmissionController extends Controller
{
    /**
     * Daftar semua kiriman naskah
     */
    public function index(Request $request)
    {
        $search = $request->get('search', '');
        $status = $request->get('status', '');

        $query = DB::table('submissions')->orderBy('created_at', 'desc');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('no_hp', 'like', "%{$search}%");
            });
        }

        if ($status) {
            $query->where('status', $status);
        }

        $submissions = $query->paginate(15)->withQueryString();
        $totalAll    = DB::table('submissions')->count();
        $totalPending   = DB::table('submissions')->where('status', 'pending')->count();
        $totalDiterima  = DB::table('submissions')->where('status', 'diterima')->count();
        $totalDitolak   = DB::table('submissions')->where('status', 'ditolak')->count();

        return view('admin.submissions.index', compact(
            'submissions', 'totalAll', 'totalPending', 'totalDiterima', 'totalDitolak',
            'search', 'status'
        ));
    }

    /**
     * Detail kiriman naskah
     */
    public function show($id)
    {
        $submission = DB::table('submissions')->find($id);
        if (!$submission) {
            return redirect()->route('admin.submissions.index')->with('error', 'Kiriman tidak ditemukan.');
        }
        return view('admin.submissions.show', compact('submission'));
    }

    /**
     * Update status kiriman (pending / diterima / ditolak)
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:pending,diterima,ditolak']);

        DB::table('submissions')->where('id', $id)->update([
            'status'     => $request->status,
            'updated_at' => now(),
        ]);

        $labels = ['pending' => 'Pending', 'diterima' => 'Diterima', 'ditolak' => 'Ditolak'];
        return redirect()->route('admin.submissions.show', $id)
            ->with('success', "Status kiriman diubah ke \"{$labels[$request->status]}\".");
    }

    /**
     * Hapus kiriman naskah
     */
    public function destroy($id)
    {
        $submission = DB::table('submissions')->find($id);
        if ($submission) {
            if ($submission->file_naskah) Storage::disk('public')->delete($submission->file_naskah);
            if ($submission->file_foto)  Storage::disk('public')->delete($submission->file_foto);
            DB::table('submissions')->delete($id);
        }
        return redirect()->route('admin.submissions.index')
            ->with('success', 'Kiriman naskah berhasil dihapus.');
    }
}
