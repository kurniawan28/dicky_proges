<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pelanggaran Siswa</title>

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
  max-width: 1000px;
}
.glow-btn {
  background: linear-gradient(90deg,#f59e0b,#d97706);
  transition: all 0.3s ease;
}
.glow-btn:hover {
  box-shadow: 0 0 15px #f59e0b;
  transform: translateY(-2px);
}
.logout-btn {
  background: linear-gradient(90deg,#ef4444,#dc2626);
  transition: all 0.3s ease;
}
.logout-btn:hover {
  box-shadow: 0 0 15px #ef4444;
  transform: translateY(-2px);
}
</style>
</head>

<body>

<nav class="fixed top-0 left-0 right-0 bg-slate-900/80 backdrop-blur-md border-b border-slate-700 p-4 flex justify-between items-center px-6 z-50">
  <a href="{{ route('dashboard') }}" class="text-xl font-semibold text-white flex items-center gap-2">
    🏫 Sistem BK Sekolah
  </a>
  <form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" class="logout-btn text-white font-semibold py-2 px-5 rounded-lg">
      Logout
    </button>
  </form>
</nav>

<div class="card mt-10">
  <h1 class="text-3xl font-bold text-center mb-8 text-white">
    ⚠️ Pelanggaran Siswa
  </h1>

  {{-- FORM TAMBAH --}}
  @if(auth()->user()->role === 'GURU_BK' || auth()->user()->role === 'ADMIN')
  <form action="{{ route('pelanggaran.store') }}" method="POST"
        class="mb-8 grid grid-cols-1 md:grid-cols-6 gap-4">
    @csrf

    <input type="text" name="nama_siswa" placeholder="Nama Siswa" required
      class="p-3 rounded-lg bg-slate-800 text-gray-200 border border-slate-700">

    <input type="text" name="kelas" placeholder="Kelas dan absen" required
      class="p-3 rounded-lg bg-slate-800 text-gray-200 border border-slate-700">

    <input type="text" name="jurusan" placeholder="Jurusan" required
      class="p-3 rounded-lg bg-slate-800 text-gray-200 border border-slate-700">

    <input type="text" name="pelanggaran" placeholder="Jenis Pelanggaran" required
      class="p-3 rounded-lg bg-slate-800 text-gray-200 border border-slate-700">

    <select name="poin" required
      class="p-3 rounded-lg bg-slate-800 text-gray-200 border border-slate-700">
      <option value="">Pilih Poin</option>
      <option value="10">10 (Ringan)</option>
      <option value="50">50 (Sedang)</option>
      <option value="100">100 (Berat)</option>
    </select>

    <!-- 🔒 TANGGAL TIDAK BISA MUNDUR -->
    <input type="date" name="tanggal" required
      min="{{ date('Y-m-d') }}"
      class="p-3 rounded-lg bg-slate-800 text-gray-200 border border-slate-700">

    <button type="submit"
      class="col-span-1 md:col-span-6 glow-btn text-white py-3 rounded-lg font-semibold">
      Tambahkan Pelanggaran
    </button>
  </form>
  @endif

  <!-- SEARCH -->
  @if(auth()->user()->role !== 'SISWA')
  <div class="mb-4 flex justify-end">
    <input
      type="text"
      id="searchInput"
      placeholder="🔍 Cari nama..."
      class="w-full md:w-1/3 p-3 rounded-lg bg-slate-800 text-gray-200 border border-slate-700
             focus:outline-none focus:ring-2 focus:ring-yellow-500"
      onkeyup="searchTable()"
    >
  </div>
  @endif

  {{-- TABEL --}}
  <div class="overflow-x-auto">
    <table class="w-full border-collapse">
      <thead class="bg-yellow-600 text-white">
        <tr>
          <th class="py-3 px-4 text-left">Nama Siswa</th>
          <th class="py-3 px-4 text-left">Kelas</th>
          <th class="py-3 px-4 text-left">Jurusan</th>
          <th class="py-3 px-4 text-left">Pelanggaran</th>
          <th class="py-3 px-4 text-left">Sanksi</th>
          <th class="py-3 px-4 text-left">Poin</th>
          <th class="py-3 px-4 text-left">Tanggal</th>
          <th class="py-3 px-4 text-center">Aksi</th>
        </tr>
      </thead>

      <tbody id="tableBody" class="bg-slate-800 divide-y divide-slate-700 text-gray-300">
        @foreach($pelanggaran as $item)
        <tr class="hover:bg-slate-700 transition">
          <td class="py-3 px-4">{{ $item->nama_siswa }}</td>
          <td class="py-3 px-4">{{ $item->kelas }}</td>
          <td class="py-3 px-4">{{ $item->jurusan }}</td>
          <td class="py-3 px-4">{{ $item->pelanggaran }}</td>

          <td class="py-3 px-4">
            {{ $item->sanksi ?? '-' }}
          </td>

          <td class="py-3 px-4 font-bold">
            @if($item->poin == 10)
              <span class="bg-green-500 text-white px-3 py-1 rounded-full">{{ $item->poin }}</span>
            @elseif($item->poin == 50)
              <span class="bg-yellow-400 text-black px-3 py-1 rounded-full">{{ $item->poin }}</span>
            @elseif($item->poin == 100)
              <span class="bg-red-500 text-white px-3 py-1 rounded-full">{{ $item->poin }}</span>
            @else
              <span class="bg-gray-500 text-white px-3 py-1 rounded-full">{{ $item->poin }}</span>
            @endif
          </td>

          <td class="py-3 px-4">
            {{ \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d') }}
          </td>

          <td class="py-3 px-4 text-center">
            @if(auth()->user()->role === 'GURU_BK' || auth()->user()->role === 'ADMIN')
            <form action="{{ route('pelanggaran.destroy',$item->id) }}" method="POST" style="display:inline;">
              @csrf
              @method('DELETE')
              <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg">
                Hapus
              </button>
            </form>
            @else
              <span class="text-gray-500">-</span>
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<script>
function searchTable() {
  const input = document.getElementById("searchInput");
  if (!input) return; // search is hidden for some users (SISWA)
  const filter = input.value.toLowerCase();
  const rows = document.querySelectorAll("#tableBody tr");

  rows.forEach(row => {
    row.style.display = row.innerText.toLowerCase().includes(filter) ? "" : "none";
  });
}
</script>

</body>
</html>
