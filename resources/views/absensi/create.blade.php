<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lapor Absensi - Siswa</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gradient-to-tr from-[#0f2027] via-[#203a43] to-[#2c5364] font-[Poppins] text-gray-200 min-h-screen">

  <div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-[#0b1a2b]/80 backdrop-blur-lg p-8 rounded-2xl shadow-2xl border border-cyan-500/30">
        
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-cyan-400">Lapor Absensi Mandiri</h2>
            <a href="{{ route('dashboard.user') }}" class="text-gray-400 hover:text-white transition">Kembali</a>
        </div>

        <form action="{{ route('absensi.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Informasi Siswa (Readonly) -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-1">Nama</label>
                    <div class="bg-[#152e3b] px-4 py-3 rounded-lg text-gray-300 border border-cyan-900/50">
                        {{ auth()->user()->name }}
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-1">Jurusan</label>
                    <div class="bg-[#152e3b] px-4 py-3 rounded-lg text-gray-300 border border-cyan-900/50">
                        {{ auth()->user()->jurusan ?? '-' }}
                    </div>
                </div>
            </div>

            <!-- Detail Kelas -->
            <div>
                <label for="kelas" class="block text-sm font-medium text-gray-300 mb-2">Detail Kelas (Contoh: XII RPL 1)</label>
                <input type="text" name="kelas" id="kelas" placeholder="Masukkan kelas Anda..." class="w-full bg-[#1e3a45] border border-cyan-500/30 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition" required>
                @error('kelas')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tanggal -->
            <div>
                <label for="tanggal" class="block text-sm font-medium text-gray-300 mb-2">Tanggal Ketidakhadiran</label>
                <input type="date" name="tanggal" id="tanggal" value="{{ date('Y-m-d') }}" class="w-full bg-[#1e3a45] border border-cyan-500/30 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition" required>
                @error('tanggal')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Jenis Absen -->
            <div>
                <label for="absen" class="block text-sm font-medium text-gray-300 mb-2">Alasan</label>
                <select name="absen" id="absen" class="w-full bg-[#1e3a45] border border-cyan-500/30 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition" required onchange="toggleBukti(this.value)">
                    <option value="" disabled selected>Pilih Alasan...</option>
                    <option value="Sakit">Sakit</option>
                    <option value="Izin">Izin</option>
                    <option value="Alpha">Alpha</option>
                </select>
                @error('absen')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Upload Bukti (Hidden by default) -->
            <div id="bukti_container" class="hidden">
                <label for="bukti" class="block text-sm font-medium text-gray-300 mb-2">Foto Surat Izin / Bukti</label>
                <input type="file" name="bukti" id="bukti" class="w-full bg-[#1e3a45] border border-cyan-500/30 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition">
                <p class="text-xs text-cyan-400/60 mt-2">*WAJIB melampirkan foto surat izin jika Sakit atau Izin.</p>
                @error('bukti')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <script>
                function toggleBukti(val) {
                    const container = document.getElementById('bukti_container');
                    if (val === 'Sakit' || val === 'Izin') {
                        container.classList.remove('hidden');
                    } else {
                        container.classList.add('hidden');
                    }
                }
            </script>

            <!-- Keterangan -->
            <div>
                <label for="keterangan" class="block text-sm font-medium text-gray-300 mb-2">Keterangan Tambahan</label>
                <textarea name="keterangan" id="keterangan" rows="3" class="w-full bg-[#1e3a45] border border-cyan-500/30 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition" placeholder="Jelaskan alasan detail (misal: sakit demam, ada urusan keluarga mendesak)..."></textarea>
            </div>

            <button type="submit" class="w-full bg-cyan-600 hover:bg-cyan-500 text-white font-bold py-3 px-4 rounded-lg shadow-lg hover:shadow-cyan-500/50 transition duration-300">
                Kirim Laporan Ke Wali Kelas
            </button>
        </form>
    </div>
  </div>
</body>
</html>
