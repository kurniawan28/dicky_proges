<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    /* Glow effect untuk card */
    .glow-card {
      border-radius: 1rem;
      box-shadow: 0 0 15px  rgba(255, 255, 255, 0.3), 0 0 30px rgba(0, 255, 255, 0.6);
      backdrop-filter: blur(12px);
    }
    .glow-card:hover {
      box-shadow: 0 0 20px rgba(0, 119, 255, 0.5), 0 0 40px rgba(0, 255, 255, 0.31);
      transform: translateY(-5px) scale(1.02);
    }
    .transition-smooth {
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
  </style>
</head>
<body class="bg-gradient-to-tr from-[#0f2027] via-[#203a43] to-[#2c5364] font-[Poppins] text-gray-200">

  <!-- Header -->
  <header class="bg-[#0b1a2b] text-white shadow-lg py-4 px-8 flex justify-between items-center sticky top-0 z-50">
    <div class="flex items-center space-x-3">
      <img src="{{ asset('images/antrek1.png') }}" alt="Logo Sekolah" class="w-12 h-12 rounded-full shadow-xl">
      <div>
        <h1 class="text-2xl font-bold tracking-tight text-cyan-400">BK APP - ADMIN</h1>
        <p class="text-sm text-cyan-300">Bimbingan Konseling SMK Antartika 1 Sidoarjo</p>
      </div>
    </div>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="flex items-center gap-2 bg-red-600 hover:bg-red-700 px-5 py-2 rounded-full font-semibold shadow-md transition-smooth">
         Logout
      </button>
    </form>
  </header>

  <div class="flex min-h-screen">


    <!-- Main Content -->
    <main class="flex-1 p-10">
      <h2 class="text-3xl font-bold text-cyan-400 mb-4">Halo, {{ auth()->user()->name }} 👋</h2>
      <p class="text-cyan-200 mb-2">Selamat datang di sistem Bimbingan Konseling SMK Antartika 1 Sidoarjo.</p>
      <p class="text-sm text-gray-400 mb-10">Dashboard admin - Monitoring & Laporan</p>

      <!-- Grid Menu (Cards) -->
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
  <a href="{{ route('monitoring.index') }}" class="p-6 glow-card text-white text-center shadow-xl transition-smooth" style="background-color:#0B1828;">
    <div class="text-5xl mb-4"></div>
    <h2 class="text-xl font-semibold mb-2 text-cyan-200">PELANGGARAN SISWA</h2>
    <p class="text-gray-200 text-sm">Data pelanggaran siswa secara keseluruhan</p>
  </a>

  <a href="{{ route('prestasi.index') }}" class="p-6 glow-card text-white text-center shadow-xl transition-smooth" style="background-color:#0B1828;">
    <div class="text-5xl mb-4"></div>
    <h2 class="text-xl font-semibold mb-2 text-yellow-300">PRESTASI SISWA</h2>
    <p class="text-gray-200 text-sm">Daftar prestasi siswa</p>
  </a>

  <a href="{{ route('konseling.index') }}" class="p-6 glow-card text-white text-center shadow-xl transition-smooth" style="background-color:#0B1828;">
    <div class="text-5xl mb-4"></div>
    <h2 class="text-xl font-semibold mb-2 text-purple-300">JADWAL KONSELING</h2>
    <p class="text-gray-200 text-sm">Lihat pengajuan konseling siswa</p>
  </a>

  <a href="{{ route('chat.bk') }}" 
   class="p-6 glow-card text-white text-center shadow-xl transition-smooth" 
   style="background-color:#0B1828;">
    <div class="text-5xl mb-4"></div>
    <h2 class="text-xl font-semibold mb-2 text-cyan-300">CHAT BK (AI)</h2>
    <p class="text-gray-200 text-sm">Asisten Konseling AI</p>
  </a>

  <a href="{{ route('visi-misi') }}" class="p-6 glow-card text-white text-center shadow-xl transition-smooth" style="background-color:#0B1828;">
    <div class="text-5xl mb-4"></div>
    <h2 class="text-xl font-semibold mb-2 text-gray-300">Visi & Misi</h2>
    <p class="text-gray-200 text-sm">📜 Visi & Misi Sekolah</p>
  </a>

 <a href="{{ route('statistik.index') }}" 
   class="p-6 glow-card text-white text-center shadow-xl transition-smooth"
   style="background-color:#0B1828;">
    <div class="text-5xl mb-4"></div>
    <h2 class="text-xl font-semibold mb-2 text-green-300">
        STATISTIK PELANGGARAN
    </h2>
    <p class="text-gray-200 text-sm">
        Analisis pelanggaran siswa berdasarkan kategori
    </p>
</a>

<a href="{{ route('siswa.index') }}" 
   class="p-6 glow-card text-white text-center shadow-xl transition-smooth"
   style="background-color:#0B1828;">
    <div class="text-5xl mb-4"></div>
    <h2 class="text-xl font-semibold mb-2 text-green-300">
        DATA SISWA
    </h2>
    <p class="text-gray-200 text-sm">
        Daftar lengkap siswa SMK Antartika 1 Sidoarjo
    </p>
</a>


</div>
     <!-- Footer Sosmed -->
      <footer class="bg-[#0b1a2b]/80 backdrop-blur-lg text-gray-200 text-center py-8 mt-16 rounded-xl">

        <p class="mb-3 font-medium">
          Selamat datang di website SMK ANTARTIKA 1 SIDOARJO. Semoga informasi ini bermanfaat bagi siswa, orang tua, dan guru.
        </p>
        <p class="mb-3 font-medium">Mencetak generasi unggul dan berakhlak mulia.</p>

        <!-- Sosmed -->
        <div class="flex justify-center gap-6 mt-4">

          <a href="https://www.instagram.com/smkantartika1sda/" target="_blank"
             class="flex items-center gap-2 text-pink-400 hover:text-pink-300 transition text-lg">
            📸 Instagram
          </a>

          <a href="https://www.tiktok.com/@smkantartika1sda?is_from_webapp=1&sender_device=pc" target="_blank"
             class="flex items-center gap-2 text-white hover:text-gray-300 transition text-lg">
            🎵 TikTok
          </a>

        </div>

        <p class="mt-3 text-gray-400 text-sm">© {{ date('Y') }} SMK Antartika 1 Sidoarjo</p>

      </footer>

    </main>
  </div>
</body>
</html>
