<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Konseling;

class JadwalController extends Controller
{
    public function index()
    {
        $query = Konseling::orderBy('tanggal', 'asc');

        if (auth()->user()->role === 'SISWA') {
            $query->where('nama_siswa', auth()->user()->name);
        }

        $konseling = $query->get();

        if (auth()->user()->role === 'GURU_BK') {
            return view('dashboard.admin', compact('konseling'));
        }

        return view('jadwal-konseling', compact('konseling'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal'   => 'required|date',
            'jam'       => 'required',
        ]);

        Jadwal::create([
            'siswa_id'  => auth()->id(),
            'judul'     => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal'   => $request->tanggal,
            'jam'       => $request->jam,
            'status'    => 'Menunggu',
        ]);

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        Jadwal::findOrFail($id)->delete();

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus!');
    }

    public function updateStatus($id)
    {
        $konseling = Konseling::findOrFail($id);
        $konseling->status = 'ACC';
        $konseling->save();

        return redirect()->back()->with('success', 'Pengajuan telah di ACC!');
    }
}
