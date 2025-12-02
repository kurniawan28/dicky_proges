<?php

namespace App\Http\Controllers;

use App\Models\Pelanggaran;
use Illuminate\Http\Request;

class PelanggaranController extends Controller
{
    // Tampilkan semua data pelanggaran
    public function index()
    {
        $user = auth()->user();
        
        // Jika SISWA, hanya tampilkan pelanggaran miliknya
        if ($user->role === 'SISWA') {
            $pelanggaran = Pelanggaran::where('nama_siswa', $user->name)->get();
        } else {
            // Jika GURU_BK atau KEPALA_SEKOLAH, tampilkan semua
            $pelanggaran = Pelanggaran::all();
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
            'kategori' => 'required|in:ringan,sedang,berat',
            'tanggal' => 'required|date',
        ]);

        Pelanggaran::create([
            'nama_siswa' => $request->nama_siswa,
            'kelas' => $request->kelas,
            'jurusan' => $request->jurusan,
            'pelanggaran' => $request->pelanggaran,
            'kategori' => $request->kategori,
            'tanggal' => $request->tanggal,
        ]);

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
            'kategori' => 'required|in:ringan,sedang,berat',
            'tanggal' => 'required|date',
        ]);

        $pelanggaran = Pelanggaran::findOrFail($id);

        $pelanggaran->update([
            'nama_siswa' => $request->nama_siswa,
            'kelas' => $request->kelas,
            'jurusan' => $request->jurusan,
            'pelanggaran' => $request->pelanggaran,
            'kategori' => $request->kategori,
            'tanggal' => $request->tanggal,
        ]);

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
        $pelanggaran->delete();

        return redirect()->back()->with('success', 'Data pelanggaran berhasil dihapus!');
    }
}
