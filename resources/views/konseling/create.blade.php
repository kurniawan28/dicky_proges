<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Data Konseling</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
  .logout-btn { background: linear-gradient(90deg, #ef4444, #dc2626); transition: all 0.3s ease; }
  .logout-btn:hover { box-shadow: 0 0 15px #ef4444; transform: translateY(-2px); }
  .badge-merah { background-color: #ef4444; }
  @keyframes fadeIn { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }
    .popup-show { animation: fadeIn 0.3s ease forwards; }
  </style>

</head>
<body class="min-h-screen bg-[#0a192f] text-white flex flex-col">

 <nav class="fixed top-0 left-0 right-0 bg-slate-900/80 backdrop-blur-md border-b border-slate-700 p-4 flex justify-between items-center px-6 z-50">
  <a href="{{ route('dashboard') }}" class="text-xl font-semibold text-white flex items-center gap-2">
    🏫 Sistem BK Sekolah
  </a>
  <form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" class="logout-btn text-white font-semibold py-2 px-5 rounded-lg">logout</button>
  </form>
</nav>

  <!-- Form Container -->
  <main class="flex-1 flex items-center justify-center px-4">
    <div class="w-full max-w-2xl bg-[#112240]/70 rounded-xl shadow-[0_0_20px_rgba(0,255,255,0.15)] p-8 mt-10">
      <h2 class="text-center text-2xl font-semibold mb-6 text-cyan-300">
        ✏️ Form Tambah Konseling
      </h2>

      <form action="{{ route('konseling.store') }}" method="POST" class="space-y-5">
        @csrf

        <div>
          <label class="block text-cyan-200 mb-2 font-medium">Nama Siswa</label>
          <input type="text" name="nama_siswa" value="{{ auth()->user()->name }}" readonly
                 class="w-full bg-[#0b1a2b]/70 border border-cyan-400/30 rounded-lg px-4 py-2 text-gray-400 cursor-not-allowed focus:outline-none focus:ring-2 focus:ring-cyan-400 transition" required>
        </div>

        <div>
          <label class="block text-cyan-200 mb-2 font-medium">Kelas</label>
          <input type="text" name="kelas" placeholder="Masukan kelas siswa"
                 class="w-full bg-[#0b1a2b]/70 border border-cyan-400/30 rounded-lg px-4 py-2 text-white focus:outline-none focus:ring-2 focus:ring-cyan-400 transition" required>
        </div>

        <div>
          <label class="block text-cyan-200 mb-2 font-medium">Tanggal Konseling</label>
          <input type="date" name="tanggal"
                 class="w-full bg-[#0b1a2b]/70 border border-cyan-400/30 rounded-lg px-4 py-2 text-white focus:outline-none focus:ring-2 focus:ring-cyan-400 transition" required>
        </div>

        <div>
          <label class="block text-cyan-200 mb-2 font-medium">Permasalahan</label>
          <textarea name="permasalahan" rows="3" placeholder="Tuliskan permasalahan siswa..."
                    class="w-full bg-[#0b1a2b]/70 border border-cyan-400/30 rounded-lg px-4 py-2 text-white focus:outline-none focus:ring-2 focus:ring-cyan-400 transition" required></textarea>
        </div>

        <div>
          <label class="block text-cyan-200 mb-2 font-medium">Guru BK</label>
          <input type="text" name="guru_bk" placeholder="Masukkan nama guru BK"
                 class="w-full bg-[#0b1a2b]/70 border border-cyan-400/30 rounded-lg px-4 py-2 text-white focus:outline-none focus:ring-2 focus:ring-cyan-400 transition" required>
        </div>

        <div class="pt-4">
          <button type="submit"
                  class="w-full bg-gradient-to-r from-cyan-600 to-cyan-400 text-white font-semibold py-3 rounded-lg hover:scale-[1.02] hover:shadow-[0_0_15px_rgba(0,255,255,0.4)] transition">
            💾 Simpan Data
          </button>
        </div>
      </form>
    </div>
  </main>

</body>
</html>