<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            "ACHMAD DEVANI RIZQY PRATAMA SETIYAWAN",
            "AFRIZAL DANI FERDIANSYAH",
            "AHMAD ZAKY FAZA",
            "ANDHI LUKMAN SYAH TJAHJONO",
            "BRYAN ANDRIY SHEVCENKO",
            "CATHERINE ABIGAIL APRILLIA CANDYSE",
            "CHELSEA NAYLIXA AZKA",
            "DAFFA MAULANA WIJAYA",
            "DENICO TUESDY OESMAΝΑ",
            "DILAN ALAUDIN AMRU",
            "DIMAS SATRYA IRAWAN",
            "FADHIL SURYA BUANA",
            "FAIS FAISHAL HAKIM",
            "FARDAN HABIBI",
            "FAREL DWI NUGROHO",
            "FATCHUR ROCHMAN",
            "GALANG ARIVIANTO",
            "HANIFA MAULITA ZAHRA SAFFUDIN",
            "KENZA EREND PUTRA TAMA",
            "KHOFIFI AKBAR INDRATAΜΑ",
            "LUBNA AQIILA SALSABIL",
            "M. AZRIEL ANHAR",
            "MARCHELIN EKA FRIANTISA",
            "MAULANA RIDHO RAMADHAN",
            "MOCH. DICKY KURNIAWAN",
            "MOCHAMMAD ALIF RIZKY FADHILAH",
            "MOCHAMMAD FAJRI HARIANTO",
            "MOCHAMMAD VALLEN NUR RIZKI PRADANA",
            "MOH. WIJAYA ANDIKA SAPUTRA",
            "MUHAMAD FATHUL HADI",
            "MUHAMMAD FAIRUZ ZAIDAN",
            "MUHAMMAD IDRIS",
            "MUHAMMAD MIKAIL KAROMATULLAH",
            "NASRULLAH AL AMIN",
            "NOVAN WAHYU HIDAYAT",
            "NUR AVIVAH MAULUD DIAH",
            "QODAMA MAULANA YUSUF",
            "RASSYA RAJA ISLAMI NOVEANSYAH",
            "RAYHAN ALIF PRATAMA",
            "RENDI SATRIA NUGROHO WICAKSANA",
            "RESTU CANDRA NOVIANTO",
            "RONI KURNIASANDY",
            "SATRYA PRAMUDYA ANANDITA"
        ];

        foreach ($names as $name) {
            // Generate email slug from name
            $slug = Str::slug($name, '');
            $email = $slug . '@siswa.com';

            // Check if user exists
            if (!User::where('email', $email)->exists()) {
                User::create([
                    'name' => $name,
                    'email' => $email,
                    'password' => Hash::make('12345678'),
                    'role' => 'SISWA',
                ]);
            }
        }
    }
}
