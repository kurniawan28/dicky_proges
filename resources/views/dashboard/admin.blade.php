<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard BK Sekolah</title>
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
        <h1 class="text-2xl font-bold tracking-tight text-cyan-400">BK APP</h1>
        <p class="text-sm text-cyan-300">Bimbingan Konseling SMK antartika 1 sidoarjo</p>
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

    <!-- Sidebar -->
    <aside class="w-64 bg-[#0b1a2b]/70 backdrop-blur-lg shadow-xl p-6 sticky top-0 h-screen rounded-tr-2xl rounded-br-2xl">
      <nav class="space-y-3">
  <a href="{{ route('dashboard.admin') }}" 
     class="block py-3 px-5 rounded-xl bg-[#1e3a45]/80 border border-[#3fc1c9]/20 hover:border-[#3fc1c9] hover:shadow-[0_0_15px_rgba(63,193,201,0.5)] hover:scale-[1.03] transition-all duration-300 text-[#3fc1c9] font-semibold">
     <span class="ml-1">🏠 Dashboard</span>
  </a>

  <a href="{{ route('monitoring.index') }}" 
     class="block py-3 px-5 rounded-xl bg-[#1e3a45]/80 border border-[#4de0ff]/20 hover:border-[#4de0ff] hover:shadow-[0_0_15px_rgba(77,224,255,0.5)] hover:scale-[1.03] transition-all duration-300 text-[#4de0ff] font-semibold">
     <span class="ml-1">📖 Pelanggaran Siswa</span>
  </a>

  <a href="{{ route('prestasi.index') }}" 
     class="block py-3 px-5 rounded-xl bg-[#1e3a45]/80 border border-[#ffe066]/20 hover:border-[#ffe066] hover:shadow-[0_0_15px_rgba(255,224,102,0.5)] hover:scale-[1.03] transition-all duration-300 text-[#ffe066] font-semibold">
     <span class="ml-1">🎖️ Prestasi Siswa</span>
  </a>

  <a href="{{ route('konseling.index') }}" 
     class="block py-3 px-5 rounded-xl bg-[#1e3a45]/80 border border-[#b388eb]/20 hover:border-[#b388eb] hover:shadow-[0_0_15px_rgba(179,136,235,0.5)] hover:scale-[1.03] transition-all duration-300 text-[#b388eb] font-semibold">
     <span class="ml-1">💬 Daftar Konseling</span>
  </a>

  <a href="{{ route('statistik.index') }}" 
     class="block py-3 px-5 rounded-xl bg-[#1e3a45]/80 border border-[#cccccc]/20 hover:border-[#cccccc] hover:shadow-[0_0_15px_rgba(204,204,204,0.5)] hover:scale-[1.03] transition-all duration-300 text-[#cccccc] font-semibold">
     <span class="ml-1">📊 Statistik Siswa</span>
  </a>

<a href="/chat-bk" 
   class="block py-3 px-5 rounded-xl bg-[#1e3a45]/80 border border-[#3fc1c9]/20 
   hover:border-[#3fc1c9] hover:shadow-[0_0_15px_rgba(63,193,201,0.5)] 
   hover:scale-[1.03] transition-all duration-300 text-cyan-300 font-semibold">
   <span class="ml-1">🤖 Chat BK (AI)</span>
</a>

  <a href="{{ route('visi-misi') }}" 
   class="block py-3 px-5 rounded-xl bg-[#1e3a45]/80 border border-[#ff6b6b]/20 
   hover:border-[#ff6b6b] hover:shadow-[0_0_15px_rgba(255,107,107,0.5)] 
   hover:scale-[1.03] transition-all duration-300 text-[#ff6b6b] font-semibold">
   <span class="ml-1">📜 Visi & Misi</span>

   <a href="{{ route('siswa.index') }}" 
   class="block py-3 px-5 rounded-xl bg-[#1e3a45]/80 border border-[#00ffcc]/20 
   hover:border-[#00ffcc] hover:shadow-[0_0_15px_rgba(0,255,204,0.5)] 
   hover:scale-[1.03] transition-all duration-300 text-[#00ffcc] font-semibold">
   <span class="ml-1">👨‍🎓 Data Siswa</span>
</a>

</a>

</nav>

    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-10">
      <h2 class="text-3xl font-bold text-cyan-400 mb-4">Halo, {{ auth()->user()->name }} </h2>
      <p class="text-cyan-200 mb-10">Selamat datang di sistem Bimbingan Konseling sekolah smk antartika 1 sidoarjo.</p>

      <!-- Grid Menu (Cards) -->
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
  <a href="{{ route('monitoring.index') }}" class="p-6 glow-card text-white text-center shadow-xl transition-smooth" style="background-color:#0B1828;">
    <div class="text-5xl mb-4"></div>
    <h2 class="text-xl font-semibold mb-2 text-cyan-200">PELANGGARAN SISWA</h2>
    <p class="text-gray-200 text-sm">data pelanggaran siswa secara keseluruhan</p>
  </a>

  <a href="{{ route('prestasi.index') }}" class="p-6 glow-card text-white text-center shadow-xl transition-smooth" style="background-color:#0B1828;">
    <div class="text-5xl mb-4"></div>
    <h2 class="text-xl font-semibold mb-2 text-yellow-300">PRESTASI SISWA</h2>
    <p class="text-gray-200 text-sm">daftar prestasi siswa</p>
  </a>

  <a href="{{ route('konseling.index') }}" class="p-6 glow-card text-white text-center shadow-xl transition-smooth" style="background-color:#0B1828;">
    <div class="text-5xl mb-4"></div>
    <h2 class="text-xl font-semibold mb-2 text-purple-300">DAFTAR KONSELING SISWA</h2>
    <p class="text-gray-200 text-sm">Lihat pengajuan konseling siswa</p>
  </a>

  <a href="{{ route('statistik.index') }}" class="p-6 glow-card text-white text-center shadow-xl transition-smooth" style="background-color:#0B1828;">
    <div class="text-5xl mb-4"></div>
    <h2 class="text-xl font-semibold mb-2 text-gray-300">STATISIK SISWA</h2>
    <p class="text-gray-200 text-sm">grafik & statistik siswa</p>
  </a>

  <a href="{{ route('chat.bk') }}" 
   class="p-6 glow-card text-white text-center shadow-xl transition-smooth" 
   style="background-color:#0B1828;">
    <div class="text-5xl mb-4"></div>
    <h2 class="text-xl font-semibold mb-2 text-cyan-300">CHAT BK (AI)</h2>
    <p class="text-gray-200 text-sm">Asisten Konseling otomatis bertenaga AI</p>
  </a>

  <a href="{{ route('visi-misi') }}" class="p-6 glow-card text-white text-center shadow-xl transition-smooth" style="background-color:#0B1828;">
    <div class="text-5xl mb-4"></div>
    <h2 class="text-xl font-semibold mb-2 text-gray-300">Visi & Misi</h2>
    <p class="text-gray-200 text-sm">📜 Visi & Misi</p>
  </a>

<a href="{{ route('siswa.index') }}" class="p-6 glow-card text-white text-center shadow-xl transition-smooth" style="background-color:#0B1828;">
    <div class="text-5xl mb-4"></div>
    <h2 class="text-xl font-semibold mb-2 text-gray-300">👨‍🎓 Data Siswa</h2>
    <p class="text-gray-200 text-sm">Data Siswa</p>
  </a> 

</div>

    </main>
  </div>
</body>
</html>

