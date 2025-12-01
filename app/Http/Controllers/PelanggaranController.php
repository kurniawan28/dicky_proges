<?php

namespace App\Http\Controllers;

use App\Models\Pelanggaran;
use Illuminate\Http\Request;

class PelanggaranController extends Controller
{
    // Tampilkan semua data pelanggaran
    public function index()
    {
        $pelanggaran = Pelanggaran::all();
        $isAdmin = auth()->user()->role === 'GURU_BK'; // cek role admin
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
        if (auth()->user()->role !== 'GURU_BK') {
            abort(403, 'Anda tidak memiliki akses!');
        }

        $pelanggaran = Pelanggaran::findOrFail($id);
        $pelanggaran->delete();

        return redirect()->back()->with('success', 'Data pelanggaran berhasil dihapus!');
    }
}
