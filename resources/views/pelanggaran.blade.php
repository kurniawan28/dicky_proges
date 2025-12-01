<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pelanggaran Siswa</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

<style>
body { font-family: 'Poppins', sans-serif; background: linear-gradient(135deg, #0f172a, #1e293b); color: #e2e8f0; min-height: 100vh; display: flex; flex-direction: column; align-items: center; justify-content: flex-start; padding-top: 80px; }
.card { background: rgba(15, 23, 42, 0.85); border: 1px solid rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); border-radius: 1rem; box-shadow: 0 0 25px rgba(59, 130, 246, 0.3); padding: 2rem; width: 90%; max-width: 1000px; }
.glow-btn { background: linear-gradient(90deg, #f59e0b, #d97706); transition: all 0.3s ease; }
.glow-btn:hover { box-shadow: 0 0 15px #f59e0b; transform: translateY(-2px); }
.logout-btn { background: linear-gradient(90deg, #ef4444, #dc2626); transition: all 0.3s ease; }
.logout-btn:hover { box-shadow: 0 0 15px #ef4444; transform: translateY(-2px); }
</style>
</head>
<body>

<nav class="fixed top-0 left-0 right-0 bg-slate-900/80 backdrop-blur-md border-b border-slate-700 p-4 flex justify-between items-center px-6 z-50">
  <a href="{{ route('dashboard') }}" class="text-xl font-semibold text-white flex items-center gap-2">🏫 Sistem BK Sekolah</a>
  <form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" class="logout-btn text-white font-semibold py-2 px-5 rounded-lg">Logout</button>
  </form>
</nav>

<div class="card fade-in mt-10">
  <h1 class="text-3xl font-bold text-center mb-8 text-white flex justify-center items-center gap-2">⚠️ Pelanggaran Siswa</h1>

  {{-- FORM TAMBAH --}}
  @if(auth()->user()->role === 'GURU_BK')
  <form action="{{ route('pelanggaran.store') }}" method="POST" class="mb-8 grid grid-cols-1 md:grid-cols-6 gap-4">
    @csrf
    <input type="text" name="nama_siswa" placeholder="Nama Siswa" required class="p-3 rounded-lg bg-slate-800 text-gray-200 border border-slate-700">
    <input type="text" name="kelas" placeholder="Kelas" required class="p-3 rounded-lg bg-slate-800 text-gray-200 border border-slate-700">
    <input type="text" name="jurusan" placeholder="Jurusan" required class="p-3 rounded-lg bg-slate-800 text-gray-200 border border-slate-700">
    <input type="text" name="pelanggaran" placeholder="Jenis Pelanggaran" required class="p-3 rounded-lg bg-slate-800 text-gray-200 border border-slate-700">

    <select name="kategori" required class="p-3 rounded-lg bg-slate-800 text-gray-200 border border-slate-700">
        <option value="">Pilih Kategori</option>
        <option value="ringan">Ringan</option>
        <option value="sedang">Sedang</option>
        <option value="berat">Berat</option>
    </select>

    <input type="date" name="tanggal" required class="p-3 rounded-lg bg-slate-800 text-gray-200 border border-slate-700">

    <button type="submit" class="col-span-1 md:col-span-6 glow-btn text-white py-3 rounded-lg font-semibold">
        Tambahkan Pelanggaran
    </button>
  </form>
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
          <th class="py-3 px-4 text-left">Kategori</th>
          <th class="py-3 px-4 text-left">Tanggal</th>
          <th class="py-3 px-4 text-center">Aksi</th>
        </tr>
      </thead>

      <tbody class="divide-y divide-slate-700 bg-slate-800 text-gray-300">
        @foreach($pelanggaran as $item)
        <tr class="hover:bg-slate-700 transition">
          <td class="py-3 px-4">{{ $item->nama_siswa }}</td>
          <td class="py-3 px-4">{{ $item->kelas }}</td>
          <td class="py-3 px-4">{{ $item->jurusan }}</td>
          <td class="py-3 px-4">{{ $item->pelanggaran }}</td>

          {{-- KATEGORI WARNA --}}
          <td class="py-3 px-4">
            @if($item->kategori == 'ringan')
              <span class="px-2 py-1 bg-green-600 text-white rounded">Ringan</span>
            @elseif($item->kategori == 'sedang')
              <span class="px-2 py-1 bg-yellow-500 text-black rounded">Sedang</span>
            @else
              <span class="px-2 py-1 bg-red-600 text-white rounded">Berat</span>
            @endif
          </td>

          <td class="py-3 px-4">{{ \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d') }}</td>

          <td class="py-3 px-4 text-center">
            @if(auth()->user()->role === 'GURU_BK')
                <button type="button"
                    class="text-yellow-500 mr-2 edit-btn"
                    data-id="{{ $item->id }}"
                    data-nama="{{ $item->nama_siswa }}"
                    data-kelas="{{ $item->kelas }}"
                    data-jurusan="{{ $item->jurusan }}"
                    data-pelanggaran="{{ $item->pelanggaran }}"
                    data-kategori="{{ $item->kategori }}"
                    data-tanggal="{{ \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d') }}">
                    Edit
                </button>

                <form action="{{ route('pelanggaran.destroy', $item->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg transition">Hapus</button>
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

{{-- MODAL EDIT --}}
@if(auth()->user()->role === 'GURU_BK')
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
  <div class="bg-slate-800 p-6 rounded-lg w-full max-w-md">
    <h2 class="text-xl font-bold mb-4 text-white">Edit Pelanggaran</h2>

    <form id="editForm" method="POST">
      @csrf
      @method('PUT')

      <label class="text-white mb-1">Nama Siswa</label>
      <input type="text" name="nama_siswa" id="edit_nama_siswa" class="w-full p-2 mb-2 rounded bg-slate-700 text-white" required>

      <label class="text-white mb-1">Kelas</label>
      <input type="text" name="kelas" id="edit_kelas" class="w-full p-2 mb-2 rounded bg-slate-700 text-white" required>

      <label class="text-white mb-1">Jurusan</label>
      <input type="text" name="jurusan" id="edit_jurusan" class="w-full p-2 mb-2 rounded bg-slate-700 text-white" required>

      <label class="text-white mb-1">Pelanggaran</label>
      <input type="text" name="pelanggaran" id="edit_pelanggaran" class="w-full p-2 mb-2 rounded bg-slate-700 text-white" required>

      <label class="text-white mb-1">Kategori</label>
      <select name="kategori" id="edit_kategori" class="w-full p-2 mb-2 rounded bg-slate-700 text-white" required>
          <option value="ringan">Ringan</option>
          <option value="sedang">Sedang</option>
          <option value="berat">Berat</option>
      </select>

      <label class="text-white mb-1">Tanggal</label>
      <input type="date" name="tanggal" id="edit_tanggal" class="w-full p-2 mb-4 rounded bg-slate-700 text-white" required>

      <div class="flex justify-end gap-2">
        <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-gray-500 rounded text-white">Batal</button>
        <button type="submit" class="px-4 py-2 bg-yellow-500 rounded text-black">Update</button>
      </div>
    </form>
  </div>
</div>

<script>
document.querySelectorAll('.edit-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const pelanggaran = {
            id: this.dataset.id,
            nama_siswa: this.dataset.nama,
            kelas: this.dataset.kelas,
            jurusan: this.dataset.jurusan,
            pelanggaran: this.dataset.pelanggaran,
            kategori: this.dataset.kategori,
            tanggal: this.dataset.tanggal
        };

        const form = document.getElementById('editForm');
        form.action = '/pelanggaran/' + pelanggaran.id;
        document.getElementById('edit_nama_siswa').value = pelanggaran.nama_siswa;
        document.getElementById('edit_kelas').value = pelanggaran.kelas;
        document.getElementById('edit_jurusan').value = pelanggaran.jurusan;
        document.getElementById('edit_pelanggaran').value = pelanggaran.pelanggaran;
        document.getElementById('edit_kategori').value = pelanggaran.kategori;
        document.getElementById('edit_tanggal').value = pelanggaran.tanggal;

        document.getElementById('editModal').classList.remove('hidden');
    });
});

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
}
</script>
@endif

</body>
</html>
