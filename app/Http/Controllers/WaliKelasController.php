<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Konseling;
use App\Models\Siswa; // Asumsi ada model Siswa
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class WaliKelasController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Ambil laporan absensi (absen tidak null) 
        // yang Jurusan siswanya sama dengan Jurusan Wali Kelas
        $reports = Konseling::whereNotNull('absen')
                    ->whereHas('user', function($query) use ($user) {
                        $query->where('jurusan', $user->jurusan);
                    })
                    ->orderBy('created_at', 'desc')
                    ->get();
                    
        return view('dashboard.wali', compact('reports'));
    }

    public function setujuiWali($id)
    {
        $report = Konseling::findOrFail($id);
        
        // Cek apakah wali kelas berhak (jurusan sama)
        if ($report->user->jurusan !== Auth::user()->jurusan) {
            abort(403);
        }

        $report->update(['status' => 'pending_admin']);

        return redirect()->route('dashboard.wali')->with('success', 'Laporan berhasil diteruskan ke Admin!');
    }

    public function tolakWali($id)
    {
        $report = Konseling::findOrFail($id);
        
        if ($report->user->jurusan !== Auth::user()->jurusan) {
            abort(403);
        }

        $report->update(['status' => 'ditolak']);

        return redirect()->route('dashboard.wali')->with('success', 'Laporan berhasil ditolak.');
    }

    public function destroy($id)
    {
        $report = Konseling::findOrFail($id);
        
        // Pastikan wali kelas hanya bisa menghapus laporan dari jurusannya sendiri
        if ($report->user->jurusan !== Auth::user()->jurusan) {
            abort(403);
        }

        $report->delete();

        return redirect()->route('dashboard.wali')->with('success', 'Laporan berhasil dihapus.');
    }
}
