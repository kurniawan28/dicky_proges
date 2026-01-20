<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Pelanggaran Siswa</title>

<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

<style>
body {
  font-family: 'Poppins', sans-serif;
  background: linear-gradient(135deg, #0f172a, #1e293b);
  color: #e2e8f0;
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: flex-start;
  padding-top: 80px;
}
.card {
  background: rgba(15, 23, 42, 0.85);
  border: 1px solid rgba(255,255,255,0.1);
  backdrop-filter: blur(10px);
  border-radius: 1rem;
  box-shadow: 0 0 25px rgba(59,130,246,0.3);
  padding: 2rem;
  width: 90%;
  max-width: 800px;
}
.glow-btn {
  background: linear-gradient(90deg,#f59e0b,#d97706);
  transition: all 0.3s ease;
}
.glow-btn:hover {
  box-shadow: 0 0 15px #f59e0b;
  transform: translateY(-2px);
}
.back-btn {
  background: linear-gradient(90deg,#64748b,#475569);
  transition: all 0.3s ease;
}
.back-btn:hover {
  box-shadow: 0 0 15px #64748b;
  transform: translateY(-2px);
}
</style>
</head>

<body>

<nav class="fixed top-0 left-0 right-0 bg-slate-900/80 backdrop-blur-md border-b border-slate-700 p-4 flex justify-between items-center px-6 z-50">
  <a href="{{ route('dashboard') }}" class="text-xl font-semibold text-white flex items-center gap-2">
    🏫 Sistem BK Sekolah
  </a>
</nav>

<div class="card mt-10">
  <h1 class="text-3xl font-bold text-center mb-8 text-white">
    ✏️ Edit Pelanggaran
  </h1>

  <form action="{{ route('pelanggaran.update', $pelanggaran->id) }}" method="POST" class="grid grid-cols-1 gap-4">
    @csrf
    @method('PUT')

    <div>
        <label class="block mb-1 text-sm font-semibold">Nama Siswa</label>
        <select name="nama_siswa" required
          class="w-full p-3 rounded-lg bg-slate-800 text-gray-200 border border-slate-700 focus:outline-none focus:border-yellow-500">
          <option value="">-- Pilih Siswa --</option>
          @foreach($siswas as $siswa)
            <option value="{{ $siswa->name }}" {{ old('nama_siswa', $pelanggaran->nama_siswa) == $siswa->name ? 'selected' : '' }}>
                {{ $siswa->name }}
            </option>
          @endforeach
        </select>
    </div>

    <div>
        <label class="block mb-1 text-sm font-semibold">Kelas & Absen</label>
        <input type="text" name="kelas" value="{{ old('kelas', $pelanggaran->kelas) }}" required
          class="w-full p-3 rounded-lg bg-slate-800 text-gray-200 border border-slate-700 focus:outline-none focus:border-yellow-500">
    </div>

    <div>
        <label class="block mb-1 text-sm font-semibold">Jurusan</label>
        <input type="text" name="jurusan" value="{{ old('jurusan', $pelanggaran->jurusan) }}" required
          class="w-full p-3 rounded-lg bg-slate-800 text-gray-200 border border-slate-700 focus:outline-none focus:border-yellow-500">
    </div>

    <div>
        <label class="block mb-1 text-sm font-semibold">Jenis Pelanggaran</label>
        <input type="text" name="pelanggaran" value="{{ old('pelanggaran', $pelanggaran->pelanggaran) }}" required
          class="w-full p-3 rounded-lg bg-slate-800 text-gray-200 border border-slate-700 focus:outline-none focus:border-yellow-500">
    </div>

    <div>
        <label class="block mb-1 text-sm font-semibold">Poin</label>
        <select name="poin" required
          class="w-full p-3 rounded-lg bg-slate-800 text-gray-200 border border-slate-700 focus:outline-none focus:border-yellow-500">
          <option value="10" {{ $pelanggaran->poin == 10 ? 'selected' : '' }}>10 (Ringan)</option>
          <option value="50" {{ $pelanggaran->poin == 50 ? 'selected' : '' }}>50 (Sedang)</option>
          <option value="100" {{ $pelanggaran->poin == 100 ? 'selected' : '' }}>100 (Berat)</option>
        </select>
    </div>

    <div>
        <label class="block mb-1 text-sm font-semibold">Tanggal</label>
        <input type="date" name="tanggal" value="{{ old('tanggal', $pelanggaran->tanggal) }}" required
          class="w-full p-3 rounded-lg bg-slate-800 text-gray-200 border border-slate-700 focus:outline-none focus:border-yellow-500">
    </div>

    <div class="flex gap-4 mt-4">
        <a href="{{ route('monitoring.index') }}" class="back-btn text-white py-3 px-6 rounded-lg font-semibold text-center flex-1">
            Batal
        </a>
        <button type="submit" class="glow-btn text-white py-3 px-6 rounded-lg font-semibold flex-1">
            Simpan Perubahan
        </button>
    </div>
  </form>
</div>

</body>
</html>
