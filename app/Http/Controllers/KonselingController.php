<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Konseling;

class KonselingController extends Controller
{
    // Form ajukan konseling (siswa)
    public function create() {
        return view('konseling.create');
    }

    // Simpan konseling (siswa)
    public function store(Request $request) {
        $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'kelas' => 'required|string|max:50',
            'tanggal' => 'required|date',
            'permasalahan' => 'required|string',
            'guru_bk' => 'required|string|max:255',
        ]);

        Konseling::create([
            'nama_siswa'    => auth()->user()->name,
            'kelas'         => $request->kelas,
            'tanggal'       => $request->tanggal,
            'permasalahan'  => $request->permasalahan,
            'guru_bk'       => $request->guru_bk,
            'status'        => 'pending',
        ]);

        return redirect()->route('dashboard.user')->with('success', 'Konseling berhasil diajukan!');
    }

    // Daftar konseling (admin)
    public function index() {
        $user = auth()->user();
        
        // 1. Ambil data dengan query dasar
        $query = \App\Models\Konseling::orderBy('created_at', 'desc');

        // 2. Terapkan filter berdasarkan role
        if ($user->role === 'SISWA') {
            $query->where('nama_siswa', $user->name); 
        }
        
        // 3. Eksekusi query dan ambil hasilnya
        $konselings = $query->get();

        // 4. Kirim data ke view
        return view('jadwal-konseling', [
            'konseling' => $konselings
        ]);
    }

    // [BARU] Menampilkan form edit (GURU_BK Only)
    public function edit($id) {
        $konseling = Konseling::findOrFail($id);
        return view('konseling.edit', compact('konseling')); 
    }

    // [BARU] Menyimpan hasil edit (GURU_BK Only)
    public function update(Request $request, $id) {
        $validated = $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'kelas' => 'required|string|max:50',
            'tanggal' => 'required|date',
            'permasalahan' => 'required|string',
            'guru_bk' => 'required|string|max:255',
        ]);

        $konseling = Konseling::findOrFail($id);
        $konseling->update($validated);

        return redirect()->route('konseling.index')->with('success', 'Data konseling berhasil diperbarui!');
    }

    // [BARU] Menghapus data konseling (GURU_BK Only)
    public function destroy($id) {
        $konseling = Konseling::findOrFail($id);
        $konseling->delete();

        return redirect()->route('konseling.index')->with('success', 'Data konseling berhasil dihapus!');
    }

    // Update status konseling (admin)
    // KonselingController.php

// Update status konseling (admin)
public function updateStatus($id)
{
    $konseling = Konseling::findOrFail($id);

    // Set status langsung ke "ACC"
    $konseling->status = 'ACC';
    $konseling->save();

    return redirect()->back()->with('success', 'Pengajuan konseling telah di ACC!');
}

}