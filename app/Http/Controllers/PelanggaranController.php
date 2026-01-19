<?php

namespace App\Http\Controllers;

use App\Models\Pelanggaran;
use Illuminate\Http\Request;

use App\Services\SanctionService;

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
        return view('pelanggaran', compact('pelanggaran', 'isAdmin'));
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

        // Tentukan kategori dan sanksi otomatis berdasarkan poin
        $kategori = 'ringan';
        $sanksi = 'Aman';
        if ($request->poin >= 100) {
            $kategori = 'berat';
            $sanksi = 'Skorsing';
        } elseif ($request->poin >= 50) {
            $kategori = 'sedang';
            $sanksi = 'Peringatan 2';
        } else {
            $sanksi = 'Peringatan 1';
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

        return redirect()->back()->with('success', 'Pelanggaran berhasil ditambahkan');
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
            $sanksi = 'Skorsing';
        } elseif ($request->poin >= 50) {
            $kategori = 'sedang';
            $sanksi = 'Peringatan 2';
        } else {
            $sanksi = 'Peringatan 1';
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

        return redirect()->back()->with('success', 'Data pelanggaran berhasil diupdate!');
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
}
