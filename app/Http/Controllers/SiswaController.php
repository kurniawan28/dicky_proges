<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        if ($user->isAdmin() || $user->isGuruBK()) {
            $siswas = Siswa::latest()->get();
        } elseif ($user->role === 'WALI_KELAS') {
            // Ambil nama kelas yang menjadi tanggung jawab wali ini
            $namaKelas = \Illuminate\Support\Facades\DB::table('kelas')
                ->where('id', $user->kelas_id)
                ->value('nama_kelas');

            // Query yang lebih fleksibel:
            // Tampilkan jika nama kelas cocok EXAK atau jika Jurusan cocok (antisipasi typo di kolom kelas pd data lama)
            $siswas = Siswa::where(function($query) use ($namaKelas, $user) {
                if ($namaKelas) {
                    $query->where('kelas', $namaKelas);
                }
                $query->orWhere('jurusan', $user->jurusan);
            })->latest()->get();
        } else {
            $siswas = collect();
        }

        return view('siswa.index', compact('siswas'));
    }

    public function create()
    {
        $kelasList = \Illuminate\Support\Facades\DB::table('kelas')->get();
        return view('siswa.create', compact('kelasList'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        
        // Aturan validasi dasar
        $rules = [
            'no_absen' => 'required|string|max:10|unique:siswas',
            'nis' => 'required|string|max:20|unique:siswas',
            'nisn' => 'nullable|string|max:20',
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:20',
            'foto' => 'nullable|image|max:2048',
        ];

        // Jika Admin/BK atau Wali Kelas, field kelas/jurusan wajib diisi
        if ($user->isAdmin() || $user->isGuruBK() || $user->role === 'WALI_KELAS') {
            $rules['kelas'] = 'required|string|max:50';
            $rules['jurusan'] = 'required|string|max:50';
        }

        $validated = $request->validate($rules);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('fotosiswa', 'public');
        }

        Siswa::create($validated);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function edit(Siswa $siswa)
    {
        $kelasList = \Illuminate\Support\Facades\DB::table('kelas')->get();
        return view('siswa.edit', compact('siswa', 'kelasList'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $user = auth()->user();
        
        $rules = [
            'no_absen' => 'required|string|max:10|unique:siswas,no_absen,' . $siswa->id,
            'nis' => 'required|string|max:20|unique:siswas,nis,' . $siswa->id,
            'nisn' => 'nullable|string|max:20',
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:20',
            'foto' => 'nullable|image|max:2048',
        ];

        if ($user->isAdmin() || $user->isGuruBK() || $user->role === 'WALI_KELAS') {
            $rules['kelas'] = 'required|string|max:50';
            $rules['jurusan'] = 'required|string|max:50';
        }

        $validated = $request->validate($rules);

        if ($request->hasFile('foto')) {
            if ($siswa->foto && Storage::disk('public')->exists($siswa->foto)) {
                Storage::disk('public')->delete($siswa->foto);
            }
            $validated['foto'] = $request->file('foto')->store('fotosiswa', 'public');
        }

        $siswa->update($validated);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diupdate.');
    }

    public function destroy(Siswa $siswa)
    {
        if ($siswa->foto && Storage::disk('public')->exists($siswa->foto)) {
            Storage::disk('public')->delete($siswa->foto);
        }

        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus.');
    }
}
