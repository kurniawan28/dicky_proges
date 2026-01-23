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
        $reports = Konseling::where('user_id', Auth::id())
                    ->orderBy('created_at', 'desc')
                    ->get();
                    
        return view('dashboard.wali', compact('reports'));
    }

    public function createLaporan()
    {
        // Ambil data siswa yg ada di kelas si wali kelas (Opsional: filter by class if relation exists)
        // Untuk sekarang ambil semua siswa dulu atau filter nanti
        // Asumsi: Kita bisa ambil list siswa. Kalau di User model ada 'kelas_id', kita filter based on that.
        // Tapi User model Wali Kelas mungkin punya 'kelas_id' juga?
        
        $user = Auth::user();
        $kelasId = $user->kelas_id;
        
        // Cek apakah Wali Kelas punya kelas
        if($kelasId) {
            $siswa = User::where('role', 'SISWA')->where('kelas_id', $kelasId)->get();
        } else {
             // Fallback kalo belum set kelas, tampilkan semua siswa (atau kosong)
            $siswa = User::where('role', 'SISWA')->get();
        }

        return view('wali.laporan', compact('siswa'));
    }

    public function storeLaporan(Request $request)
    {
        $request->validate([
            'nama_siswa' => 'required|string',
            'tanggal' => 'required|date',
            'absen' => 'required|in:Sakit,Izin,Alpha',
            'keterangan' => 'nullable|string'
        ]);

        // Simpan ke tabel konselings
        Konseling::create([
            'user_id' => Auth::id(),
            'nama_siswa' => $request->nama_siswa,
            'kelas' => '-', // Bisa diisi manual atau ambil dari user login jika Wali Kelas punya kelas linked
            'tanggal' => $request->tanggal,
            'permasalahan' => $request->keterangan ?? 'Laporan Absensi (' . $request->absen . ')',
            'guru_bk' => '-', 
            'status' => 'pending',
            'absen' => $request->absen
        ]);

        return redirect()->route('dashboard.wali')->with('success', 'Laporan absensi berhasil dikirim!');
    }

}
