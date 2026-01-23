<?php

namespace App\Services;

use App\Models\Siswa;
use App\Models\Pelanggaran;

class SanctionService
{
    /**
     * Update total points and sanction category for a student.
     *
     * @param string $namaSiswa
     * @return void
     */
    public function updateSiswaSanction($namaSiswa)
    {
        // Find student by name (assuming name is unique or we take the first one)
        // Ideally we should use ID, but the current system uses name in Pelanggaran
        $siswa = Siswa::where('nama_lengkap', $namaSiswa)->first();

        if (!$siswa) {
            return;
        }

        // Calculate total points from Pelanggaran table
        $totalPoin = Pelanggaran::where('nama_siswa', $namaSiswa)->sum('poin');

        // Batasi poin maksimal 100
        if ($totalPoin > 100) {
            $totalPoin = 100;
        }

        // Determine category
        $kategori = $this->determineCategory($totalPoin);

        // Update Siswa record
        $siswa->update([
            'total_poin' => $totalPoin,
            'kategori_sanksi' => $kategori,
        ]);
    }

    /**
     * Determine sanction category based on points.
     *
     * @param int $points
     * @return string
     */
    private function determineCategory($points)
    {
        if ($points >= 80) {
            return 'Skorsing';
        } elseif ($points >= 60) {
            return 'Peringatan 3';
        } elseif ($points >= 40) {
            return 'Peringatan 2';
        } elseif ($points >= 20) {
            return 'Peringatan 1';
        } else {
            return 'Aman';
        }
    }
}
