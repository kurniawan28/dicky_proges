<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Data Konseling</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    body { font-family: 'Poppins', sans-serif; }
    .logout-btn { background: linear-gradient(90deg, #ef4444, #dc2626); transition: all 0.3s ease; }
    .logout-btn:hover { box-shadow: 0 0 15px #ef4444; transform: translateY(-2px); }
  </style>
</head>

<body class="min-h-screen bg-[#0a192f] text-white flex flex-col">

<nav class="fixed top-0 left-0 right-0 bg-slate-900/80 backdrop-blur-md border-b border-slate-700 p-4 flex justify-between items-center px-6 z-50">
  <a href="{{ route('dashboard') }}" class="text-xl font-semibold flex items-center gap-2">
    🏫 Sistem BK Sekolah
  </a>
  <form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" class="logout-btn text-white font-semibold py-2 px-5 rounded-lg">
      Logout
    </button>
  </form>
</nav>

<!-- FORM -->
<main class="flex-1 flex items-center justify-center px-4 pt-24">
  <div class="w-full max-w-2xl bg-[#112240]/70 rounded-xl shadow-[0_0_20px_rgba(0,255,255,0.15)] p-8">

    <h2 class="text-center text-2xl font-semibold mb-6 text-cyan-300">
      ✏️ Form Tambah Konseling
    </h2>

    <form action="{{ route('konseling.store') }}" method="POST" class="space-y-5" id="konseling-form">
      @csrf

      <!-- Nama -->
      <div>
        <label class="block text-cyan-200 mb-2 font-medium">Nama Siswa</label>
        <input type="text"
               value="{{ auth()->user()->name }}"
               readonly
               class="w-full bg-[#0b1a2b]/70 border border-cyan-400/30 rounded-lg px-4 py-2 text-gray-400 cursor-not-allowed">
      </div>

      <!-- Kelas -->
      <div>
        <label class="block text-cyan-200 mb-2 font-medium">Kelas</label>
        <input type="text" name="kelas" required
               placeholder="Masukkan kelas siswa"
               class="w-full bg-[#0b1a2b]/70 border border-cyan-400/30 rounded-lg px-4 py-2 text-white focus:ring-2 focus:ring-cyan-400 focus:outline-none">
      </div>

      <!-- ABSEN -->
      <div>
        <label class="block text-cyan-200 mb-2 font-medium">Absen</label>
        <input type="number" name="absen" placeholder="Masukkan nomor absen (opsional)" min="1" max="999"
               class="w-full bg-[#0b1a2b]/70 border border-cyan-400/30 rounded-lg px-4 py-2 text-white focus:ring-2 focus:ring-cyan-400 focus:outline-none">
      </div>

      <!-- TANGGAL (TIDAK BISA MUNDUR) + JAM -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
          <label class="block text-cyan-200 mb-2 font-medium">Tanggal Konseling</label>
          <input type="date"
                 name="tanggal"
                 min="{{ now()->format('Y-m-d') }}"
                 required
                 class="w-full bg-[#0b1a2b]/70 border border-cyan-400/30 rounded-lg px-4 py-2 text-white focus:ring-2 focus:ring-cyan-400 focus:outline-none">
          <small class="text-gray-400">
            * Tidak bisa memilih tanggal sebelum hari ini
          </small>
        </div>

        <div>
          <label class="block text-cyan-200 mb-2 font-medium">Jam Mulai</label>
          <div class="grid grid-cols-2 gap-2">
            <select name="jam_mulai_hour" id="jam_mulai_hour" required class="bg-[#0b1a2b]/70 border border-cyan-400/30 rounded-lg px-3 py-2 text-white focus:ring-2 focus:ring-cyan-400 focus:outline-none">
              <option value="">Jam</option>
              <option value="07">07</option>
              <option value="08">08</option>
              <option value="09">09</option>
              <option value="10">10</option>
              <option value="11">11</option>
              <option value="12">12</option>
              <option value="13">13</option>
              <option value="14">14</option>
              <option value="15">15</option>
            </select>
            <input type="number" name="jam_mulai_minute" id="jam_mulai_minute" placeholder="MM" min="0" max="59" required class="bg-[#0b1a2b]/70 border border-cyan-400/30 rounded-lg px-3 py-2 text-white focus:ring-2 focus:ring-cyan-400 focus:outline-none">
          </div>
          <small class="text-gray-400">Jam : Menit</small>
        </div>

        <div>
          <label class="block text-cyan-200 mb-2 font-medium">Jam Selesai</label>
          <div class="grid grid-cols-2 gap-2">
            <select name="jam_selesai_hour" id="jam_selesai_hour" required class="bg-[#0b1a2b]/70 border border-cyan-400/30 rounded-lg px-3 py-2 text-white focus:ring-2 focus:ring-cyan-400 focus:outline-none">
              <option value="">Jam</option>
              <option value="07">07</option>
              <option value="08">08</option>
              <option value="09">09</option>
              <option value="10">10</option>
              <option value="11">11</option>
              <option value="12">12</option>
              <option value="13">13</option>
              <option value="14">14</option>
              <option value="15">15</option>
            </select>
            <input type="number" name="jam_selesai_minute" id="jam_selesai_minute" placeholder="MM" min="0" max="59" required class="bg-[#0b1a2b]/70 border border-cyan-400/30 rounded-lg px-3 py-2 text-white focus:ring-2 focus:ring-cyan-400 focus:outline-none">
          </div>
          <small class="text-gray-400">Jam : Menit</small>
        </div>
      </div>

      <!-- Permasalahan -->
      <div>
        <label class="block text-cyan-200 mb-2 font-medium">Permasalahan</label>
        <textarea name="permasalahan" rows="3" required
                  placeholder="Tuliskan permasalahan siswa..."
                  class="w-full bg-[#0b1a2b]/70 border border-cyan-400/30 rounded-lg px-4 py-2 text-white focus:ring-2 focus:ring-cyan-400 focus:outline-none"></textarea>
      </div>

      <!-- Guru BK -->
      <div>
        <label class="block text-cyan-200 mb-2 font-medium">Guru BK</label>
        <select name="guru_bk" required
                class="w-full bg-[#0b1a2b]/70 border border-cyan-400/30 rounded-lg px-4 py-2 text-white focus:ring-2 focus:ring-cyan-400 focus:outline-none">
          <option value="">Pilih Guru BK</option>
          <option value="Bu Prapti">Bu Prapti</option>
          <option value="Bu Eka">Bu Eka</option>
          <option value="Bu Pur">Bu Pur</option>
        </select>
      </div>

      <!-- Submit -->
      <button type="submit"
              class="w-full bg-gradient-to-r from-cyan-600 to-cyan-400 text-white font-semibold py-3 rounded-lg hover:scale-[1.02] hover:shadow-[0_0_15px_rgba(0,255,255,0.4)] transition">
        💾 Simpan Data
      </button>
    </form>

  </div>
</main>

<script>
document.getElementById('konseling-form').addEventListener('submit', function(e) {
  // Combine jam + menit into time format
  const jamMulaiHour = document.getElementById('jam_mulai_hour').value;
  const jamMulaiMinute = document.getElementById('jam_mulai_minute').value.padStart(2, '0');
  const jamSelesaiHour = document.getElementById('jam_selesai_hour').value;
  const jamSelesaiMinute = document.getElementById('jam_selesai_minute').value.padStart(2, '0');

  if (!jamMulaiHour || !jamMulaiMinute) {
    alert('Jam Mulai harus diisi!');
    e.preventDefault();
    return;
  }

  if (!jamSelesaiHour || !jamSelesaiMinute) {
    alert('Jam Selesai harus diisi!');
    e.preventDefault();
    return;
  }

  const jamMulai = `${jamMulaiHour}:${jamMulaiMinute}`;
  const jamSelesai = `${jamSelesaiHour}:${jamSelesaiMinute}`;

  if (jamMulai >= jamSelesai) {
    alert('Jam Selesai harus lebih besar dari Jam Mulai!');
    e.preventDefault();
    return;
  }

  // Create hidden inputs to send combined time
  const inputMulai = document.createElement('input');
  inputMulai.type = 'hidden';
  inputMulai.name = 'jam_mulai';
  inputMulai.value = jamMulai;

  const inputSelesai = document.createElement('input');
  inputSelesai.type = 'hidden';
  inputSelesai.name = 'jam_selesai';
  inputSelesai.value = jamSelesai;

  this.appendChild(inputMulai);
  this.appendChild(inputSelesai);
});
</script>
