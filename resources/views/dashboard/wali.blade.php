<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Wali Kelas</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
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
        <p class="text-sm text-cyan-300">Wali Kelas Dashboard</p>
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
      <h2 class="text-3xl font-bold text-cyan-400 mb-4">Halo, {{ auth()->user()->name }} </h2>
      <p class="text-cyan-200 mb-10">Selamat datang di sistem manajemen kelas.</p>

      <!-- Grid Menu (Cards) -->
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
        
        <a href="{{ route('wali.laporan.create') }}" class="p-6 glow-card text-white text-center shadow-xl transition-smooth" style="background-color:#0B1828;">
          <div class="text-5xl mb-4">📝</div>
          <h2 class="text-xl font-semibold mb-2 text-cyan-200">LAPOR ABSENSI</h2>
          <p class="text-gray-200 text-sm">Laporkan siswa sakit/izin/alpha</p>
        </a>

        <a href="{{ route('siswa.index') }}" class="p-6 glow-card text-white text-center shadow-xl transition-smooth" style="background-color:#0B1828;">
          <div class="text-5xl mb-4">👥</div>
          <h2 class="text-xl font-semibold mb-2 text-cyan-200">DATA SISWA</h2>
          <p class="text-gray-200 text-sm">Daftar lengkap siswa SMK Antartika 1 Sidoarjo</p>
        </a>

      </div>

      <!-- Tabel Status Laporan -->
      <div class="mt-12">
        <h3 class="text-2xl font-bold text-cyan-400 mb-6 flex items-center gap-2">
            📊 Status Laporan Absensi
        </h3>
        
        <div class="overflow-x-auto bg-[#0b1a2b]/80 backdrop-blur-lg rounded-2xl shadow-2xl border border-cyan-500/20 p-6">
            <table class="w-full text-left text-gray-300">
                <thead class="bg-[#1e3a45] text-cyan-300 uppercase font-semibold text-sm">
                    <tr>
                        <th class="px-6 py-4 rounded-tl-lg">Nama Siswa</th>
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4">Jenis</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 rounded-tr-lg">Keterangan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700/50">
                    @forelse($reports as $report)
                    <tr class="hover:bg-[#152e3b] transition duration-200">
                        <td class="px-6 py-4 font-medium">{{ $report->nama_siswa }}</td>
                        <td class="px-6 py-4 text-sm">{{ \Carbon\Carbon::parse($report->tanggal)->format('d M Y') }}</td>
                        <td class="px-6 py-4">
                            @if($report->absen == 'Sakit')
                                <span class="px-2 py-1 rounded-md text-xs font-bold bg-yellow-500/20 text-yellow-500 border border-yellow-500/30">Sakit</span>
                            @elseif($report->absen == 'Izin')
                                <span class="px-2 py-1 rounded-md text-xs font-bold bg-blue-500/20 text-blue-500 border border-blue-500/30">Izin</span>
                            @else
                                <span class="px-2 py-1 rounded-md text-xs font-bold bg-red-500/20 text-red-500 border border-red-500/30">Alpha</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($report->status == 'pending')
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-gray-500/20 text-gray-400 border border-gray-500/30">Menunggu</span>
                            @elseif($report->status == 'setuju')
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-green-500/20 text-green-500 border border-green-500/30">Dicatat</span>
                            @else
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-red-500/20 text-red-500 border border-red-500/30">Ditolak</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-xs text-gray-400 italic">
                            {{ $report->permasalahan ?? '-' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500 italic">
                            Belum ada laporan yang dikirimkan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
      </div>

      <!-- Footer -->
       <footer class="bg-[#0b1a2b]/80 backdrop-blur-lg text-gray-200 text-center py-8 mt-16 rounded-xl">
        <p class="mt-3 text-gray-400 text-sm">© {{ date('Y') }} SMK Antartika 1 Sidoarjo</p>
      </footer>

    </main>
  </div>

  @if(session('success'))
  <script>
    Swal.fire({
      title: 'Berhasil!',
      text: "{{ session('success') }}",
      icon: 'success',
      confirmButtonText: 'OK',
      confirmButtonColor: '#3085d6',
      background: '#0f2027', 
      color: '#fff'
    });
  </script>
  @endif

</body>
</html>
