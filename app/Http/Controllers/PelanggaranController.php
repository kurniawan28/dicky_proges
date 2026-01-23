<?php

namespace App\Http\Controllers;

use App\Models\Pelanggaran;
use Illuminate\Http\Request;

use App\Services\SanctionService;

use App\Models\User;

class PelanggaranController extends Controller
{
    protected $sanctionService;

    public function __construct(SanctionService $sanctionService)
    {
        $this->sanctionService = $sanctionService;
    }

    // Tampilkan semua data pelanggaran
    public function index()
    {
        $user = auth()->user();
        
        // Jika SISWA, hanya tampilkan pelanggaran miliknya
        if ($user->role === 'SISWA') {
            $pelanggaran = Pelanggaran::where('nama_siswa', $user->name)->with('siswa')->get();
        } else {
            // Jika GURU_BK atau KEPALA_SEKOLAH, tampilkan semua
            $pelanggaran = Pelanggaran::with('siswa')->get();
        }

        $isAdmin = $user->role === 'GURU_BK' || $user->role === 'ADMIN'; 

        // Ambil daftar siswa yang memiliki pelanggaran (distinct) untuk dropdown reset
        $siswaMelanggar = [];
        if ($isAdmin) {
            $siswaMelanggar = Pelanggaran::select('nama_siswa')->distinct()->pluck('nama_siswa');
        }

        // Cek peringatan untuk siswa jika poin >= 100
        $studentWarning = null;
        if ($user->role === 'SISWA') {
             // Hitung poin langsung dari tabel pelanggaran agar akurat
             $totalPoinSiswa = Pelanggaran::where('nama_siswa', $user->name)->sum('poin');
             
             if ($totalPoinSiswa >= 100) {
                 $studentWarning = "Peringatan dari Guru BK: Poin pelanggaranmu sudah mencapai batas (100). Segera temui Guru BK di ruangannya untuk penyelesaian masalah.";
             }
        }

        return view('pelanggaran', compact('pelanggaran', 'isAdmin', 'siswaMelanggar', 'studentWarning'));
    }

    // Tambah pelanggaran baru (Admin Only)
    public function store(Request $request)
    {
        $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'kelas' => 'required|string|max:50',
            'jurusan' => 'required|string|max:50',
            'pelanggaran' => 'required|string|max:255',
            'poin' => 'required|integer',
            'tanggal' => 'required|date',
        ]);

        // Cek apakah poin siswa sudah mencapai 100
        $currentPoints = Pelanggaran::where('nama_siswa', $request->nama_siswa)->sum('poin');
        if ($currentPoints >= 100) {
            return redirect()->back()->with('error', 'GAGAL: Poin siswa ini sudah mencapai batas maksimum (100). Silakan RESET poin terlebih dahulu jika ingin menambah pelanggaran baru.');
        }

        // Tentukan kategori dan sanksi otomatis berdasarkan poin
        $kategori = 'ringan';
        $sanksi = 'Aman';
        if ($request->poin >= 100) {
            $kategori = 'berat';
            $sanksi = 'peringatan 3';
        } elseif ($request->poin >= 50) {
            $kategori = 'sedang';
            $sanksi = 'peringatan 2';
        } else {
            $sanksi = 'peringatan 1';
        }

        Pelanggaran::create([
            'nama_siswa' => $request->nama_siswa,
            'kelas' => $request->kelas,
            'jurusan' => $request->jurusan,
            'pelanggaran' => $request->pelanggaran,
            'kategori' => $kategori,
            'poin' => $request->poin,
            'tanggal' => $request->tanggal,
            'sanksi' => $sanksi,
        ]);

        // Update sanksi siswa
        $this->sanctionService->updateSiswaSanction($request->nama_siswa);

        // Cek jika poin mencapai batas 100
        $siswa = \App\Models\Siswa::where('nama_lengkap', $request->nama_siswa)->first();
        if ($siswa && $siswa->total_poin >= 100) {
            return redirect()->back()->with('success', 'Pelanggaran berhasil ditambahkan')->with('points_limit_reached', 'Siswa mencapai batas poin 100! Segera temui Guru BK untuk konseling dan penyelesaian masalah.');
        }

        return redirect()->back()->with('success', 'Pelanggaran berhasil ditambahkan');
    }

    // Form Edit Pelanggaran
    public function edit($id)
    {
        $pelanggaran = Pelanggaran::findOrFail($id);
        
        return view('pelanggaran.edit', compact('pelanggaran'));
    }

    // Update pelanggaran (Admin Only)
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'kelas' => 'required|string|max:50',
            'jurusan' => 'required|string|max:50',
            'pelanggaran' => 'required|string|max:255',
            'poin' => 'required|integer',
            'tanggal' => 'required|date',
        ]);

        $pelanggaran = Pelanggaran::findOrFail($id);
        $oldNamaSiswa = $pelanggaran->nama_siswa;

        // Tentukan kategori dan sanksi otomatis berdasarkan poin
        $kategori = 'ringan';
        $sanksi = 'Aman';
        if ($request->poin >= 100) {
            $kategori = 'berat';
            $sanksi = 'peringatan 3';
        } elseif ($request->poin >= 50) {
            $kategori = 'sedang';
            $sanksi = 'peringatan 2';
        } else {
            $sanksi = 'peringatan 1';
        }

        $pelanggaran->update([
            'nama_siswa' => $request->nama_siswa,
            'kelas' => $request->kelas,
            'jurusan' => $request->jurusan,
            'pelanggaran' => $request->pelanggaran,
            'kategori' => $kategori,
            'poin' => $request->poin,
            'tanggal' => $request->tanggal,
            'sanksi' => $sanksi,
        ]);

        // Update sanksi siswa (handle name change case too)
        $this->sanctionService->updateSiswaSanction($request->nama_siswa);
        if ($oldNamaSiswa !== $request->nama_siswa) {
            $this->sanctionService->updateSiswaSanction($oldNamaSiswa);
        }

        // Cek jika poin mencapai batas 100
        $siswa = \App\Models\Siswa::where('nama_lengkap', $request->nama_siswa)->first();
        if ($siswa && $siswa->total_poin >= 100) {
           return redirect()->route('monitoring.index')->with('success', 'Data pelanggaran berhasil diupdate!')->with('points_limit_reached', 'Siswa mencapai batas poin 100! Segera temui Guru BK.');
        }

        return redirect()->route('monitoring.index')->with('success', 'Data pelanggaran berhasil diupdate!');
    }

    // Hapus pelanggaran (Admin Only)
    public function destroy($id)
    {
        $user = auth()->user();
        if ($user->role !== 'GURU_BK' && $user->role !== 'ADMIN') {
            abort(403, 'Anda tidak memiliki akses!');
        }

        $pelanggaran = Pelanggaran::findOrFail($id);
        $namaSiswa = $pelanggaran->nama_siswa;
        $pelanggaran->delete();

        // Update sanksi siswa
        $this->sanctionService->updateSiswaSanction($namaSiswa);

        return redirect()->back()->with('success', 'Data pelanggaran berhasil dihapus!');
    }

    // Reset poin siswa (Hapus semua pelanggaran)
    public function reset(Request $request)
    {
        $request->validate([
            'nama_siswa' => 'required|string|max:255',
        ]);

        $user = auth()->user();
        if ($user->role !== 'GURU_BK' && $user->role !== 'ADMIN') {
            abort(403, 'Anda tidak memiliki akses!');
        }

        // Hapus semua data pelanggaran siswa tersebut
        Pelanggaran::where('nama_siswa', $request->nama_siswa)->delete();

        // Update (reset) data di tabel siswa via service (akan jadi 0)
        $this->sanctionService->updateSiswaSanction($request->nama_siswa);

        return redirect()->back()->with('success', 'Poin siswa ' . $request->nama_siswa . ' berhasil direset menjadi 0.');
    }
}
