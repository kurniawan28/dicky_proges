<!-- resources/views/layouts/sidebar.blade.php -->

<aside class="w-64 bg-[#0b1a2b]/80 backdrop-blur-lg shadow-xl p-6 sticky top-0 h-screen rounded-tr-2xl rounded-br-2xl">
    <div class="flex flex-col space-y-6">
        <!-- Logo -->
        <div class="flex items-center space-x-3">
            <img src="{{ asset('images/antrek1.png') }}" alt="Logo Sekolah" class="w-12 h-12 rounded-full shadow-md">
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-cyan-400">BK APP</h1>
                <p class="text-sm text-cyan-300">Bimbingan Konseling</p>
            </div>
        </div>

        <!-- Menu Navigation -->
        <nav class="flex flex-col space-y-3 mt-6">
            <a href="{{ route('dashboard.user') }}"
               class="block py-3 px-5 rounded-xl bg-[#1e3a45]/80 border border-[#3fc1c9]/20 hover:border-[#3fc1c9] hover:shadow-[0_0_15px_rgba(63,193,201,0.5)] hover:scale-[1.03] transition-all duration-300 text-[#3fc1c9] font-semibold">
               🏠 Dashboard
            </a>

            <a href="{{ route('prestasi.index') }}"
               class="block py-3 px-5 rounded-xl bg-[#1e3a45]/80 border border-[#ffe066]/20 hover:border-[#ffe066] hover:shadow-[0_0_15px_rgba(255,224,102,0.5)] hover:scale-[1.03] transition-all duration-300 text-[#ffe066] font-semibold">
               🎖️ Prestasi Siswa
            </a>

            <a href="{{ route('absensi.index') }}"
               class="block py-3 px-5 rounded-xl bg-[#1e3a45]/80 border border-[#ff9f43]/20 hover:border-[#ff9f43] hover:shadow-[0_0_15px_rgba(255,159,67,0.5)] hover:scale-[1.03] transition-all duration-300 text-[#ff9f43] font-semibold">
               📅 Data Absensi
            </a>

            <a href="{{ route('jadwal.index') }}"
               class="block py-3 px-5 rounded-xl bg-[#1e3a45]/80 border border-[#b388eb]/20 hover:border-[#b388eb] hover:shadow-[0_0_15px_rgba(179,136,235,0.5)] hover:scale-[1.03] transition-all duration-300 text-[#b388eb] font-semibold">
               💬 Daftar Konseling
            </a>

            <a href="{{ route('konseling.create') }}"
               class="block py-3 px-5 rounded-xl bg-[#1e3a45]/80 border border-[#73a9ff]/20 hover:border-[#73a9ff] hover:shadow-[0_0_15px_rgba(115,169,255,0.5)] hover:scale-[1.03] transition-all duration-300 text-[#73a9ff] font-semibold">
               ➕ Ajukan Konseling
            </a>

            <a href="{{ route('chat.bk') }}"
               class="block py-3 px-5 rounded-xl bg-[#1e3a45]/80 border border-[#3fc1c9]/20 hover:border-[#3fc1c9] hover:shadow-[0_0_15px_rgba(63,193,201,0.5)] hover:scale-[1.03] transition-all duration-300 text-cyan-300 font-semibold">
               🤖 Chat BK (AI)
            </a>

            <a href="{{ route('visi-misi') }}"
               class="block py-3 px-5 rounded-xl bg-[#1e3a45]/80 border border-[#ff6b6b]/20 hover:border-[#ff6b6b] hover:shadow-[0_0_15px_rgba(255,107,107,0.5)] hover:scale-[1.03] transition-all duration-300 text-[#ff6b6b] font-semibold">
               📜 Visi & Misi
            </a>
        </nav>
    </div>
</aside>
