<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use Illuminate\Http\Request;

class PrestasiController extends Controller
{
    public function index()
    {
        $query = Prestasi::query();

        if (auth()->user()->role === 'SISWA') {
            $query->where('nama_siswa', auth()->user()->name);
        }

        $prestasi = $query->get();
        return view('prestasi', compact('prestasi'));
    }

    public function store(Request $request)
    {
        Prestasi::create($request->all());
        return redirect()->back()->with('success', 'Prestasi berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $prestasi = Prestasi::findOrFail($id);
        $prestasi->update($request->all());
        return redirect()->back()->with('success', 'Prestasi berhasil diupdate!');
    }

    public function destroy($id)
    {
        $prestasi = Prestasi::findOrFail($id);
        $prestasi->delete();
        return redirect()->back()->with('success', 'Prestasi berhasil dihapus!');
    }
}
