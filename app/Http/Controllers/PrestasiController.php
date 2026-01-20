<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use Illuminate\Http\Request;

use App\Models\User;

class PrestasiController extends Controller
{
    public function index()
    {
        $query = Prestasi::query();

        // if (auth()->user()->role === 'SISWA') {
        //     $query->where('nama_siswa', auth()->user()->name);
        // }

        $prestasi = $query->get();
        
        // Daftar siswa valid sesuai request user
        $validNames = [
            "ACHMAD DEVANI RIZQY PRATAMA SETIYAWAN", "AFRIZAL DANI FERDIANSYAH", "AHMAD ZAKY FAZA", "ANDHI LUKMAN SYAH TJAHJONO",
            "BRYAN ANDRIY SHEVCENKO", "CATHERINE ABIGAIL APRILLIA CANDYSE", "CHELSEA NAYLIXA AZKA", "DAFFA MAULANA WIJAYA",
            "DENICO TUESDY OESMAΝΑ", "DILAN ALAUDIN AMRU", "DIMAS SATRYA IRAWAN", "FADHIL SURYA BUANA", "FAIS FAISHAL HAKIM",
            "FARDAN HABIBI", "FAREL DWI NUGROHO", "FATCHUR ROCHMAN", "GALANG ARIVIANTO", "HANIFA MAULITA ZAHRA SAFFUDIN",
            "KENZA EREND PUTRA TAMA", "KHOFIFI AKBAR INDRATAΜΑ", "LUBNA AQIILA SALSABIL", "M. AZRIEL ANHAR",
            "MARCHELIN EKA FRIANTISA", "MAULANA RIDHO RAMADHAN", "MOCH. DICKY KURNIAWAN", "MOCHAMMAD ALIF RIZKY FADHILAH",
            "MOCHAMMAD FAJRI HARIANTO", "MOCHAMMAD VALLEN NUR RIZKI PRADANA", "MOH. WIJAYA ANDIKA SAPUTRA",
            "MUHAMAD FATHUL HADI", "MUHAMMAD FAIRUZ ZAIDAN", "MUHAMMAD IDRIS", "MUHAMMAD MIKAIL KAROMATULLAH",
            "NASRULLAH AL AMIN", "NOVAN WAHYU HIDAYAT", "NUR AVIVAH MAULUD DIAH", "QODAMA MAULANA YUSUF",
            "RASSYA RAJA ISLAMI NOVEANSYAH", "RAYHAN ALIF PRATAMA", "RENDI SATRIA NUGROHO WICAKSANA",
            "RESTU CANDRA NOVIANTO", "RONI KURNIASANDY", "SATRYA PRAMUDYA ANANDITA"
        ];

        // Ambil user dengan role SISWA dan namanya ada di daftar valid
        $siswas = User::where('role', 'SISWA')
                      ->whereIn('name', $validNames)
                      ->orderBy('name')
                      ->get();

        return view('prestasi', compact('prestasi', 'siswas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_siswa' => 'required|string',
            'kelas' => 'required|string',
            'jurusan' => 'required|string',
            'prestasi' => 'required|string',
            'tingkat' => 'required|string',
            'tahun' => 'required|date|after_or_equal:' . date('Y-m-d'),
            'bukti' => 'nullable|image|max:5120',
        ]);

        $data = $validated;

        if ($request->hasFile('bukti')) {
            $file = $request->file('bukti');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('uploads/prestasi', $filename, 'public');
            $data['bukti'] = $filename;
        }

        Prestasi::create($data);
        return redirect()->back()->with('success', 'Prestasi berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $prestasi = Prestasi::findOrFail($id);

        $minYearDate = date('Y') . '-01-01';

        $validator = \Validator::make($request->all(), [
            'nama_siswa' => 'required|string',
            'kelas' => 'required|string',
            'jurusan' => 'required|string',
            'prestasi' => 'required|string',
            'tingkat' => 'required|string',
            'tahun' => 'required|date',
            'bukti' => 'nullable|image|max:5120',
        ]);

        // Custom rule: disallow changing to a date before the start of the current year,
        // but allow saving if the existing stored date is already before that (so legacy records don't fail just by opening the modal).
        $validator->after(function ($validator) use ($request, $minYearDate, $prestasi) {
            $inputTahun = $request->input('tahun');
            if ($inputTahun && strtotime($inputTahun) < strtotime($minYearDate) && $inputTahun !== $prestasi->tahun) {
                $validator->errors()->add('tahun', 'Tanggal tidak boleh mundur ke tahun sebelumnya.');
            }
        });

        $validated = $validator->validate();

        $data = $validated;

        if ($request->hasFile('bukti')) {
            // Delete old file if exists
            if ($prestasi->bukti && \Storage::disk('public')->exists('uploads/prestasi/' . $prestasi->bukti)) {
                \Storage::disk('public')->delete('uploads/prestasi/' . $prestasi->bukti);
            }

            $file = $request->file('bukti');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('uploads/prestasi', $filename, 'public');
            $data['bukti'] = $filename;
        }

        $prestasi->update($data);
        return redirect()->back()->with('success', 'Prestasi berhasil diupdate!');
    }

    public function destroy($id)
    {
        $prestasi = Prestasi::findOrFail($id);
        
        if ($prestasi->bukti && \Storage::disk('public')->exists('uploads/prestasi/' . $prestasi->bukti)) {
            \Storage::disk('public')->delete('uploads/prestasi/' . $prestasi->bukti);
        }

        $prestasi->delete();
        return redirect()->back()->with('success', 'Prestasi berhasil dihapus!');
    }
}
