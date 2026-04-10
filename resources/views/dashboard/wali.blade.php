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
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #0f172a, #1e293b, #0f172a);
        color: #e2e8f0;
    }

    .glass-card {
        background: rgba(15, 23, 42, 0.6);
        border: 1px solid rgba(34, 211, 238, 0.2);
        backdrop-filter: blur(16px);
        border-radius: 1.5rem;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4), 0 0 20px rgba(6, 182, 212, 0.1);
        animation: fadeIn 0.6s ease-out;
    }

    .glow-card {
      border-radius: 1.25rem;
      background: rgba(11, 24, 40, 0.7);
      border: 1px solid rgba(34, 211, 238, 0.1);
      box-shadow: 0 0 20px rgba(34, 211, 238, 0.1);
      transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .glow-card:hover {
      box-shadow: 0 0 30px rgba(34, 211, 238, 0.3);
      transform: translateY(-8px);
      border-color: rgba(34, 211, 238, 0.4);
    }

    .custom-table {
        width: 100%;
        border-spacing: 0 10px;
        border-collapse: separate;
    }

    .custom-table thead tr {
        background: linear-gradient(90deg, #0891b2, #0e7490);
        box-shadow: 0 4px 15px rgba(8, 145, 178, 0.3);
    }

    .custom-table th {
        padding: 1.25rem 1rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-size: 0.75rem;
        color: white;
    }

    .custom-table th:first-child { border-top-left-radius: 1rem; border-bottom-left-radius: 1rem; }
    .custom-table th:last-child { border-top-right-radius: 1rem; border-bottom-right-radius: 1rem; }

    .custom-table tbody tr {
        background: rgba(30, 41, 59, 0.4);
        transition: all 0.3s ease;
    }

    .custom-table tbody tr:hover {
        background: rgba(30, 41, 59, 0.7);
        transform: scale(1.002);
        box-shadow: 0 5px 15px rgba(6, 182, 212, 0.1);
    }

    .custom-table td {
        padding: 1.25rem 1rem;
        vertical-align: middle;
    }

    .custom-table td:first-child { border-top-left-radius: 1rem; border-bottom-left-radius: 1rem; }
    .custom-table td:last-child { border-top-right-radius: 1rem; border-bottom-right-radius: 1rem; }

    .status-pill {
        padding: 0.35rem 0.8rem;
        border-radius: 2rem;
        font-weight: 700;
        font-size: 0.7rem;
        display: inline-block;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .transition-smooth {
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .img-preview {
      cursor: pointer;
      transition: all 0.3s ease;
      border: 2px solid rgba(34, 211, 238, 0.2);
    }
    .img-preview:hover {
      transform: scale(1.1);
      border-color: #22d3ee;
      box-shadow: 0 0 15px rgba(34, 211, 238, 0.4);
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Modal Styles */
    .modal {
      display: none;
      position: fixed;
      z-index: 1000;
      padding-top: 50px;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0,0,0,0.9);
      backdrop-filter: blur(8px);
    }
    .modal-content {
      margin: auto;
      display: block;
      width: 80%;
      max-width: 700px;
      border: 4px solid #22d3ee;
      border-radius: 1rem;
    }
    .close-modal {
      position: absolute;
      top: 20px;
      right: 35px;
      color: #f1f1f1;
      font-size: 40px;
      cursor: pointer;
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
        
        <div class="p-6 glow-card text-white text-center shadow-xl transition-smooth" style="background-color:#0B1828;">
          <div class="text-5xl mb-4">🏢</div>
          <h2 class="text-xl font-semibold mb-2 text-cyan-200">JURUSAN</h2>
          <p class="text-white text-2xl font-bold">{{ auth()->user()->jurusan }}</p>
        </div>

        <a href="{{ route('siswa.index') }}" class="p-6 glow-card text-white text-center shadow-xl transition-smooth" style="background-color:#0B1828;">
          <div class="text-5xl mb-4">👥</div>
          <h2 class="text-xl font-semibold mb-2 text-cyan-200">DATA SISWA</h2>
          <p class="text-gray-200 text-sm">Daftar siswa di jurusan {{ auth()->user()->jurusan }}</p>
        </a>

        <a href="{{ route('chat.bk') }}" class="p-6 glow-card text-white text-center shadow-xl transition-smooth" style="background-color:#0B1828;">
          <div class="text-5xl mb-4">🤖</div>
          <h2 class="text-xl font-semibold mb-2 text-cyan-300">CHAT BK (AI)</h2>
          <p class="text-gray-200 text-sm">Asisten Konseling otomatis bertenaga AI</p>
        </a>

        <a href="{{ route('monitoring.index') }}" class="p-6 glow-card text-white text-center shadow-xl transition-smooth" style="background-color:#0B1828;">
          <div class="text-5xl mb-4">⚠️</div>
          <h2 class="text-xl font-semibold mb-2 text-yellow-400">PELANGGARAN</h2>
          <p class="text-gray-200 text-sm">Monitor poin & catatan pelanggaran siswa</p>
        </a>

      </div>

      <!-- Tabel Status Laporan -->
      <div class="glass-card mt-12 p-8">
        <h3 class="text-2xl font-extrabold text-white mb-8 flex items-center gap-3">
            <span class="p-2 bg-cyan-500/20 rounded-xl shadow-inner text-xl">📊</span>
            Status Laporan Absensi Siswa
        </h3>
        
        <div class="overflow-x-auto pb-2">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Identitas Siswa</th>
                        <th>Jadwal & Jenis</th>
                        <th>Status Verifikasi</th>
                        <th>Keterangan & Bukti</th>
                        <th class="text-center">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="text-gray-300">
                    @forelse($reports as $report)
                    <tr>
                        <td>
                            <div class="font-bold text-white text-lg">{{ $report->nama_siswa }}</div>
                            <div class="text-xs text-cyan-400 font-semibold uppercase tracking-wider mt-1">
                                Kelas: {{ $report->kelas }}
                            </div>
                        </td>
                        <td>
                            <div class="flex items-center gap-2 text-sm text-gray-200">
                                📅 {{ \Carbon\Carbon::parse($report->tanggal)->format('d M Y') }}
                            </div>
                            <div class="mt-2 text-xs">
                                @if($report->absen == 'Sakit')
                                    <span class="px-2 py-1 rounded-md bg-yellow-500/10 text-yellow-500 border border-yellow-500/20 font-bold">SAKIT</span>
                                @elseif($report->absen == 'Izin')
                                    <span class="px-2 py-1 rounded-md bg-blue-500/10 text-blue-500 border border-blue-500/20 font-bold">IZIN</span>
                                @else
                                    <span class="px-2 py-1 rounded-md bg-red-500/10 text-red-500 border border-red-500/20 font-bold">ALPHA</span>
                                @endif
                            </div>
                        </td>
                        <td>
                            <span class="status-pill
                                @if($report->status == 'pending_wali') bg-yellow-500/10 text-yellow-400 border border-yellow-500/20
                                @elseif($report->status == 'pending_admin') bg-blue-500/10 text-blue-400 border border-blue-500/20
                                @elseif($report->status == 'setuju') bg-green-500/10 text-green-400 border border-green-500/20
                                @else bg-red-500/10 text-red-400 border border-red-500/20
                                @endif">
                                {{ $report->status == 'pending_wali' ? '⏳ Butuh Persetujuan' : 
                                   ($report->status == 'pending_admin' ? '🛡️ Dikirim ke BK' : 
                                   ($report->status == 'setuju' ? '✅ Disetujui' : ucfirst($report->status))) }}
                            </span>
                        </td>
                        <td>
                            <div class="flex flex-col gap-3">
                                <p class="text-sm italic text-gray-400 max-w-xs">{{ $report->permasalahan ?? '-' }}</p>
                                @if($report->bukti)
                                    <div class="group relative inline-block">
                                        <img src="{{ asset('storage/' . $report->bukti) }}" 
                                             alt="Bukti" 
                                             class="w-14 h-14 object-cover rounded-xl border-2 border-cyan-500/30 img-preview"
                                             onclick="openImageModal(this.src)">
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="flex flex-wrap justify-center gap-2">
                                @if($report->status == 'pending_wali')
                                    <form action="{{ route('wali.absensi.setujui', $report->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-gradient-to-r from-green-600 to-green-500 hover:brightness-125 text-white text-[10px] font-bold py-1.5 px-3 rounded-lg transition-all shadow-lg shadow-green-900/20">
                                            SETUJUI
                                        </button>
                                    </form>
                                    <form action="{{ route('wali.absensi.tolak', $report->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-gradient-to-r from-red-600 to-red-500 hover:brightness-125 text-white text-[10px] font-bold py-1.5 px-3 rounded-lg transition-all shadow-lg shadow-red-900/20">
                                            TOLAK
                                        </button>
                                    </form>
                                @endif
                                
                                <form action="{{ route('wali.absensi.destroy', $report->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-slate-700 hover:bg-red-600 text-gray-300 hover:text-white transition-colors py-1.5 px-3 rounded-lg text-sm">
                                        🗑️
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-20 text-center">
                            <div class="text-5xl mb-4 opacity-10">📂</div>
                            <div class="text-gray-500 text-lg italic">Belum ada laporan absensi yang dikirimkan.</div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
      </div>

      <!-- Footer Sosmed -->
      <footer class="bg-[#0b1a2b]/80 backdrop-blur-lg text-gray-200 text-center py-8 mt-16 rounded-xl">
        <p class="mb-3 font-medium">
         Selamat datang di website Bimbingan Konseling SMK ANTARTIKA 1 SIDOARJO.
         Website ini disediakan sebagai media layanan informasi dan pendampingan bagi siswa dalam bidang akademik, pribadi dan sosial. 
         Melalui layanan Bimbingan Konseling, kami siap membantu siswa dalam mengembangkan potensi diri serta menyelesaikan permasalahan secara positif dan bertanggung jawab.
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

  <!-- Modal for Image Preview -->
  <div id="imageModal" class="modal" onclick="closeImageModal()">
    <span class="close-modal" onclick="closeImageModal()">&times;</span>
    <img class="modal-content" id="img01">
  </div>

  <script>
    function openImageModal(src) {
      document.getElementById("imageModal").style.display = "block";
      document.getElementById("img01").src = src;
    }

    function closeImageModal() {
      document.getElementById("imageModal").style.display = "none";
    }

    // Close on ESC key
    document.addEventListener('keydown', function(event) {
      if (event.key === "Escape") {
        closeImageModal();
      }
    });
  </script>

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
