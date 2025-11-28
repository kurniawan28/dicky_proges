<div class="w-64 bg-gray-800 text-white min-h-screen p-4">

    <h2 class="text-xl font-bold mb-4">MENU</h2>

    <ul class="space-y-2">

        <!-- Dashboard -->
        <li>
            <a href="{{ route('dashboard') }}"
               class="block p-2 hover:bg-gray-700 rounded">
                🏠 Dashboard
            </a>
        </li>

        <!-- Prestasi -->
        <li>
            <a href="{{ route('prestasi.index') }}"
               class="block p-2 hover:bg-gray-700 rounded">
                🏆 Prestasi
            </a>
        </li>

        <!-- Pelanggaran -->
        <li>
            <a href="{{ route('pelanggaran.index') }}"
               class="block p-2 hover:bg-gray-700 rounded">
                ⚠️ Pelanggaran
            </a>
        </li>

        <!-- Konseling -->
        <li>
            <a href="{{ route('konseling.index') }}"
               class="block p-2 hover:bg-gray-700 rounded">
                📘 Konseling
            </a>
        </li>

        <!-- Jadwal Konseling -->
        <li>
            <a href="{{ route('jadwal.index') }}"
               class="block p-2 hover:bg-gray-700 rounded">
                📅 Jadwal Konseling
            </a>
        </li>

        <!-- ABSENSI SISWA -->
        <li>
            <a href="{{ route('absensi.index') }}"
               class="block p-2 hover:bg-gray-700 rounded">
                📋 Absensi Siswa
            </a>
        </li>

    </ul>
</div>
