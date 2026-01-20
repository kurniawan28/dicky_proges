<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>🏅 Prestasi Siswa</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
<style>
body { font-family: 'Poppins', sans-serif; background: linear-gradient(135deg, #0f172a, #1e293b); color: #e2e8f0; min-height: 100vh; display: flex; flex-direction: column; align-items: center; justify-content: flex-start; padding-top: 80px; }
.card { background: rgba(15, 23, 42, 0.85); border: 1px solid rgba(255,255,255,0.1); backdrop-filter: blur(10px); border-radius: 1rem; box-shadow: 0 0 25px rgba(59,130,246,0.3); padding: 2rem; width: 90%; max-width: 1000px; }
.glow-btn { background: linear-gradient(90deg,#3b82f6,#2563eb); transition: all 0.3s ease; }
.glow-btn:hover { box-shadow: 0 0 15px #3b82f6; transform: translateY(-2px); }
.logout-btn { background: linear-gradient(90deg,#ef4444,#dc2626); transition: all 0.3s ease; }
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
  <h1 class="text-3xl font-bold text-center mb-8 text-white flex justify-center items-center gap-2">
    🏅 Prestasi Siswa
  </h1>

  {{-- Form Tambah Prestasi (Admin Only) --}}
  @if(auth()->user()->role === 'ADMIN')
  <form action="{{ route('prestasi.store') }}" method="POST" enctype="multipart/form-data" class="mb-8 grid grid-cols-1 md:grid-cols-6 gap-4">
      @csrf
      <input type="text" name="nama_siswa" placeholder="Nama Siswa" required class="p-3 rounded-lg bg-slate-800 text-gray-200 border border-slate-700 focus:ring-2 focus:ring-blue-500 outline-none">
      <input type="text" name="kelas" placeholder="Kelas dan absen" required class="p-3 rounded-lg bg-slate-800 text-gray-200 border border-slate-700 focus:ring-2 focus:ring-blue-500 outline-none">
      <input type="text" name="jurusan" placeholder="Jurusan" required class="p-3 rounded-lg bg-slate-800 text-gray-200 border border-slate-700 focus:ring-2 focus:ring-blue-500 outline-none">
      <input type="text" name="prestasi" placeholder="Jenis Prestasi" required class="p-3 rounded-lg bg-slate-800 text-gray-200 border border-slate-700 focus:ring-2 focus:ring-blue-500 outline-none">

      <select name="tingkat" required class="p-3 rounded-lg bg-slate-800 text-gray-200 border border-slate-700 focus:ring-2 focus:ring-blue-500 outline-none">
        <option value="Kabupaten/Kota">Kabupaten/Kota</option>
        <option value="Provinsi">Provinsi</option>
        <option value="Nasional">Nasional</option>
        <option value="Internasional">Internasional</option>
      </select>

      <!-- INPUT DATE (TIDAK BISA MUNDUR) -->
      <input type="date" name="tahun" required
      min="{{ date('Y-m-d') }}"
      class="p-3 rounded-lg bg-slate-800 text-gray-200 border border-slate-700 focus:ring-2 focus:ring-blue-500 outline-none">

      <div class="col-span-1 md:col-span-6">
          <label class="block text-sm font-medium text-gray-300 mb-1">Bukti (Foto/Gambar)</label>
          <input type="file" name="bukti" accept="image/*" onchange="previewImage(this, 'preview_add')" class="block w-full text-sm text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700 cursor-pointer bg-slate-800 border border-slate-700 rounded-lg">
          <img id="preview_add" class="mt-2 hidden w-32 h-32 object-cover rounded-lg border border-slate-600">
      </div>

      <button type="submit" class="col-span-1 md:col-span-6 glow-btn text-white py-3 rounded-lg font-semibold">
        Tambahkan Prestasi
      </button>
  </form>
  @endif

  <!-- SEARCH BAR -->
  @if(auth()->user()->role !== 'SISWA')
  <div class="mb-4 flex justify-end">
    <input
      type="text"
      id="searchInput"
      placeholder="🔍 Cari nama..."
      class="w-full md:w-1/3 p-3 rounded-lg bg-slate-800 text-gray-200 border border-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
      onkeyup="searchTable()"
    >
  </div>
  @endif

  {{-- Tabel Prestasi --}}
  <div class="overflow-x-auto">
    <table class="w-full border-collapse">
      <thead class="bg-blue-600 text-white">
        <tr>
          <th class="py-3 px-4 text-left">Nama Siswa</th>
          <th class="py-3 px-4 text-left">Kelas dan absen</th>
          <th class="py-3 px-4 text-left">Jurusan</th>
          <th class="py-3 px-4 text-left">Prestasi</th>
          <th class="py-3 px-4 text-left">Tingkat</th>
          <th class="py-3 px-4 text-left">Tanggal</th>
          <th class="py-3 px-4 text-left">Bukti</th>
          @if(auth()->user()->role === 'ADMIN')
            <th class="py-3 px-4 text-center">Aksi</th>
          @endif
        </tr>
      </thead>

      <tbody id="tableBody" class="divide-y divide-slate-700 bg-slate-800 text-gray-300">
        @foreach($prestasi as $item)
        <tr class="hover:bg-slate-700 transition">
          <td class="py-3 px-4">{{ $item->nama_siswa }}</td>
          <td class="py-3 px-4">{{ $item->kelas }}</td>
          <td class="py-3 px-4">{{ $item->jurusan }}</td>
          <td class="py-3 px-4">{{ $item->prestasi }}</td>
          <td class="py-3 px-4">{{ $item->tingkat }}</td>
          <td class="py-3 px-4">{{ $item->tahun }}</td>
          <td class="py-3 px-4">
            @if($item->bukti)
              <img src="{{ Storage::url('uploads/prestasi/' . $item->bukti) }}" class="w-24 h-24 object-cover rounded-lg border border-slate-600 hover:scale-105 transition cursor-pointer" onclick="openImageModal('{{ Storage::url('uploads/prestasi/' . $item->bukti) }}')" alt="Bukti Prestasi">
            @else
              <span class="text-gray-500">-</span>
            @endif
          </td>
          @if(auth()->user()->role === 'ADMIN')
            <td class="py-3 px-4 text-center">
              <button type="button"
              onclick="openEditModal({{ $item->id }}, '{{ $item->nama_siswa }}', '{{ $item->kelas }}', '{{ $item->jurusan }}', '{{ $item->prestasi }}', '{{ $item->tingkat }}', '{{ $item->tahun }}', '{{ $item->bukti }}')"
              class="text-blue-500 mr-2">Edit</button>

              <form action="{{ route('prestasi.destroy', $item->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg transition">
                  Hapus
                </button>
              </form>
            </td>
          @endif
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<script>
function searchTable() {
  const input = document.getElementById("searchInput");
  if (!input) return; // search hidden for some roles (SISWA)
  const filter = input.value.toLowerCase();
  document.querySelectorAll("#tableBody tr").forEach(row => {
    row.style.display = row.innerText.toLowerCase().includes(filter) ? "" : "none";
  });
}

function previewImage(input, previewId) {
  const reader = new FileReader();
  reader.onload = e => {
    const img = document.getElementById(previewId);
    img.src = e.target.result;
    img.classList.remove("hidden");
  };
  if (input.files && input.files[0]) reader.readAsDataURL(input.files[0]);
}
</script>

<!-- Image Modal -->
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50 hidden">
  <div class="relative max-w-3xl w-full p-4">
    <button onclick="closeImageModal()" class="absolute top-2 right-2 text-white bg-red-500 hover:bg-red-600 rounded-full px-3 py-1">Tutup</button>
    <img id="imageModalImg" src="" class="w-full h-auto rounded-lg shadow-lg object-contain">
  </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50 hidden">
  <div class="bg-slate-900 p-6 rounded-lg w-full max-w-2xl border border-slate-700">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-xl font-semibold">Edit Prestasi</h2>
      <button onclick="closeEditModal()" class="text-gray-300 hover:text-white">✕</button>
    </div>

    <form id="editForm" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-4">
      @csrf
      <input type="hidden" name="_method" value="PUT">
      <input type="hidden" id="editId" name="id">

      <input type="text" id="editNama" name="nama_siswa" placeholder="Nama Siswa" required class="p-3 rounded-lg bg-slate-800 text-gray-200 border border-slate-700">
      <input type="text" id="editKelas" name="kelas" placeholder="Kelas dan absen" required class="p-3 rounded-lg bg-slate-800 text-gray-200 border border-slate-700">
      <input type="text" id="editJurusan" name="jurusan" placeholder="Jurusan" required class="p-3 rounded-lg bg-slate-800 text-gray-200 border border-slate-700">
      <input type="text" id="editPrestasi" name="prestasi" placeholder="Jenis Prestasi" required class="p-3 rounded-lg bg-slate-800 text-gray-200 border border-slate-700">

      <select id="editTingkat" name="tingkat" required class="p-3 rounded-lg bg-slate-800 text-gray-200 border border-slate-700">
        <option value="Kabupaten/Kota">Kabupaten/Kota</option>
        <option value="Provinsi">Provinsi</option>
        <option value="Nasional">Nasional</option>
        <option value="Internasional">Internasional</option>
      </select>

      <input type="date" id="editTahun" name="tahun" required min="{{ date('Y') }}-01-01" class="p-3 rounded-lg bg-slate-800 text-gray-200 border border-slate-700">

      <div class="col-span-1 md:col-span-2">
        <label class="block text-sm font-medium text-gray-300 mb-1">Bukti (Foto/Gambar)</label>
        <input type="file" name="bukti" accept="image/*" onchange="previewImage(this, 'preview_edit')" class="block w-full text-sm text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700 cursor-pointer bg-slate-800 border border-slate-700 rounded-lg">
        <img id="preview_edit" class="mt-2 hidden w-48 h-48 object-contain rounded-lg border border-slate-600">
      </div>

      <div class="col-span-1 md:col-span-2 flex justify-end gap-2">
        <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-gray-600 text-white rounded-lg">Batal</button>
        <button type="submit" class="px-4 py-2 glow-btn text-white rounded-lg">Simpan</button>
      </div>
    </form>
  </div>
</div>

<script>
function openImageModal(src) {
  const modal = document.getElementById('imageModal');
  document.getElementById('imageModalImg').src = src;
  modal.classList.remove('hidden');
}
function closeImageModal() {
  const modal = document.getElementById('imageModal');
  modal.classList.add('hidden');
  document.getElementById('imageModalImg').src = '';
}

function openEditModal(id, nama, kelas, jurusan, prestasi, tingkat, tahun, bukti) {
  const modal = document.getElementById('editModal');
  document.getElementById('editId').value = id;
  document.getElementById('editNama').value = nama;
  document.getElementById('editKelas').value = kelas;
  document.getElementById('editJurusan').value = jurusan;
  document.getElementById('editPrestasi').value = prestasi;
  document.getElementById('editTingkat').value = tingkat;
  document.getElementById('editTahun').value = tahun;
  const editForm = document.getElementById('editForm');
  editForm.action = '/prestasi/' + id;
  const preview = document.getElementById('preview_edit');
  if (bukti && bukti !== '') {
    preview.src = '{{ asset('storage/uploads/prestasi') }}/' + bukti;
    preview.classList.remove('hidden');
  } else {
    preview.src = '';
    preview.classList.add('hidden');
  }
  modal.classList.remove('hidden');
}
function closeEditModal() {
  document.getElementById('editModal').classList.add('hidden');
}
</script>

</body>
</html>
