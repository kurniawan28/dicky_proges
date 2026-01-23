<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lapor Absensi Siswa</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gradient-to-tr from-[#0f2027] via-[#203a43] to-[#2c5364] font-[Poppins] text-gray-200 min-h-screen">

  <div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-[#0b1a2b]/80 backdrop-blur-lg p-8 rounded-2xl shadow-2xl border border-cyan-500/30">
        
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-cyan-400">Lapor Absensi Siswa</h2>
            <a href="{{ route('dashboard.wali') }}" class="text-gray-400 hover:text-white transition">Kembali</a>
        </div>

        <form action="{{ route('wali.laporan.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Nama Siswa (Manual) -->
            <div>
                <label for="nama_siswa" class="block text-sm font-medium text-gray-300 mb-2">Nama Siswa</label>
                <input type="text" name="nama_siswa" id="nama_siswa" class="w-full bg-[#1e3a45] border border-cyan-500/30 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition" placeholder="Masukkan Nama Siswa" required>
                @error('nama_siswa')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tanggal -->
            <div>
                <label for="tanggal" class="block text-sm font-medium text-gray-300 mb-2">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" value="{{ date('Y-m-d') }}" class="w-full bg-[#1e3a45] border border-cyan-500/30 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition" required>
                @error('tanggal')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Jenis Absen -->
            <div>
                <label for="absen" class="block text-sm font-medium text-gray-300 mb-2">Jenis Absensi</label>
                <select name="absen" id="absen" class="w-full bg-[#1e3a45] border border-cyan-500/30 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition" required>
                    <option value="Sakit">Sakit</option>
                    <option value="Izin">Izin</option>
                    <option value="Alpha">Alpha</option>
                </select>
                @error('absen')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Keterangan -->
            <div>
                <label for="keterangan" class="block text-sm font-medium text-gray-300 mb-2">Keterangan (Opsional)</label>
                <textarea name="keterangan" id="keterangan" rows="3" class="w-full bg-[#1e3a45] border border-cyan-500/30 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition" placeholder="Contoh: Sakit demam, surat menyusul..."></textarea>
            </div>

            <button type="submit" class="w-full bg-cyan-600 hover:bg-cyan-500 text-white font-bold py-3 px-4 rounded-lg shadow-lg hover:shadow-cyan-500/50 transition duration-300">
                Kirim Laporan
            </button>
        </form>
    </div>
  </div>
</body>
</html>
