<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Konseling;

class KonselingController extends Controller
{
    // Form ajukan konseling (siswa)
    public function create()
    {
        return view('konseling.create');
    }

    // Simpan konseling (siswa)
    public function store(Request $request)
    {
        $request->validate([
            'kelas' => 'required|string|max:50',
            'absen' => 'nullable|numeric|digits_between:1,3',
            'tanggal' => 'required|date|after_or_equal:today',
            'jam_mulai' => 'required|date_format:H:i|after_or_equal:07:00|before_or_equal:15:00',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai|after_or_equal:07:00|before_or_equal:15:00',
            'permasalahan' => 'required|string',
            'guru_bk' => 'required|string|max:255',
        ]);

        Konseling::create([
            'nama_siswa'   => auth()->user()->name,
            'kelas'        => $request->kelas,
            'absen'        => $request->absen,
            'tanggal'      => $request->tanggal,
            'jam_mulai'    => $request->jam_mulai,
            'jam_selesai'  => $request->jam_selesai,
            'permasalahan' => $request->permasalahan,
            'guru_bk'      => $request->guru_bk,
            'status'       => 'pending',
        ]);

        return redirect()->route('dashboard.user')
            ->with('success', 'Konseling berhasil diajukan!');
    }

    // Daftar konseling
    public function index()
    {
        $user = auth()->user();

        $query = Konseling::orderBy('created_at', 'desc');

        if ($user->role === 'SISWA') {
            $query->where('nama_siswa', $user->name);
        }

        $konseling = $query->get();

        return view('jadwal-konseling', compact('konseling'));
    }

    // Edit (Guru BK)
    public function edit($id)
    {
        $konseling = Konseling::findOrFail($id);
        return view('konseling.edit', compact('konseling'));
    }

    // Update (Guru BK)
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'kelas' => 'required|string|max:50',
            'absen' => 'nullable|numeric|digits_between:1,3',
            'tanggal' => 'required|date|after_or_equal:today',
            'jam_mulai' => 'required|date_format:H:i|after_or_equal:07:00|before_or_equal:15:00',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai|after_or_equal:07:00|before_or_equal:15:00',
            'permasalahan' => 'required|string',
            'guru_bk' => 'required|string|max:255',
        ]);

        $konseling = Konseling::findOrFail($id);
        $konseling->update($validated);

        return redirect()->route('konseling.index')
            ->with('success', 'Data konseling berhasil diperbarui!');
    }

    // Hapus
    public function destroy($id)
    {
        Konseling::findOrFail($id)->delete();

        return redirect()->route('konseling.index')
            ->with('success', 'Data konseling berhasil dihapus!');
    }

    // Update status
    public function updateStatus($id)
    {
        $konseling = Konseling::findOrFail($id);
        $konseling->status = 'setuju';
        $konseling->save();

        return redirect()->back()
            ->with('success', 'Pengajuan konseling telah disetujui!');
    }
}
