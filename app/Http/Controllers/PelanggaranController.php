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
        $isAdmin = auth()->user()->role === 'GURU_BK'; // cek role sesuai DB
        return view('pelanggaran', compact('pelanggaran', 'isAdmin'));
    }

    // Tambah pelanggaran baru (Admin Only)
    public function store(Request $request)
    {
        if(auth()->user()->role !== 'GURU_BK'){
            abort(403, 'Anda tidak memiliki akses!');
        }

        $validated = $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'kelas' => 'required|string|max:50',
            'jurusan' => 'required|string|max:50',
            'pelanggaran' => 'required|string|max:255',
            'tanggal' => 'required|date',
        ]);

        Pelanggaran::create($validated);

        return redirect()->back()->with('success', 'Data pelanggaran berhasil ditambahkan!');
    }

    // Update pelanggaran (Admin Only)
    public function update(Request $request, $id)
    {
        if(auth()->user()->role !== 'GURU_BK'){
            abort(403, 'Anda tidak memiliki akses!');
        }

        $validated = $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'kelas' => 'required|string|max:50',
            'jurusan' => 'required|string|max:50',
            'pelanggaran' => 'required|string|max:255',
            'tanggal' => 'required|date',
        ]);

        $item = Pelanggaran::findOrFail($id);
        $item->update($validated);

        return redirect()->back()->with('success', 'Data pelanggaran berhasil diupdate!');
    }

    // Hapus pelanggaran (Admin Only)
    public function destroy($id)
    {
        if(auth()->user()->role !== 'GURU_BK'){
            abort(403, 'Anda tidak memiliki akses!');
        }

        $item = Pelanggaran::findOrFail($id);
        $item->delete();

        return redirect()->back()->with('success', 'Data pelanggaran berhasil dihapus!');
    }
}
