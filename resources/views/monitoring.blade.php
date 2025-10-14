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
      border: 1px solid rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      border-radius: 1rem;
      box-shadow: 0 0 25px rgba(59, 130, 246, 0.3);
      padding: 2rem;
      width: 90%;
      max-width: 1000px;
    }
    .glow-btn {
      background: linear-gradient(90deg, #f59e0b, #d97706);
      transition: all 0.3s ease;
    }
    .glow-btn:hover {
      box-shadow: 0 0 15px #f59e0b;
      transform: translateY(-2px);
    }
    .logout-btn {
      background: linear-gradient(90deg, #ef4444, #dc2626);
      transition: all 0.3s ease;
    }
    .logout-btn:hover {
      box-shadow: 0 0 15px #ef4444;
      transform: translateY(-2px);
    }
    .badge {
      padding: 2px 6px;
      border-radius: 8px;
      font-size: 0.75rem;
      font-weight: 600;
      color: white;
    }
    .badge-hijau { background-color: #10b981; }
    .badge-kuning { background-color: #f59e0b; }
    .badge-merah { background-color: #ef4444; }
    @keyframes fadeIn {
      from { opacity: 0; transform: scale(0.95); }
      to { opacity: 1; transform: scale(1); }
    }
    .popup-show {
      animation: fadeIn 0.3s ease forwards;
    }
  </style>
</head>
<body>

<nav class="fixed top-0 left-0 right-0 bg-slate-900/80 backdrop-blur-md border-b border-slate-700 p-4 flex justify-between items-center px-6 z-50">
  <h2 class="text-xl font-semibold text-white flex items-center gap-2">🏫 Sistem BK Sekolah</h2>
  <button id="logoutBtn" class="logout-btn text-white font-semibold py-2 px-5 rounded-lg">Keluar</button>
</nav>

<div class="card fade-in mt-10">
  <h1 class="text-3xl font-bold text-center mb-8 text-white flex justify-center items-center gap-2">
    ⚠️ Pelanggaran Siswa
  </h1>

  <!-- Form Tambah Pelanggaran -->
  <form id="pelanggaranForm" class="mb-8 grid grid-cols-1 md:grid-cols-5 gap-4">
    <input type="text" id="nama" placeholder="Nama Siswa" required class="p-3 rounded-lg bg-slate-800 text-gray-200 border border-slate-700 focus:ring-2 focus:ring-yellow-500 outline-none">
    <input type="text" id="kelas" placeholder="Kelas" required class="p-3 rounded-lg bg-slate-800 text-gray-200 border border-slate-700 focus:ring-2 focus:ring-yellow-500 outline-none">
    <input type="text" id="jurusan" placeholder="Jurusan" required class="p-3 rounded-lg bg-slate-800 text-gray-200 border border-slate-700 focus:ring-2 focus:ring-yellow-500 outline-none">
    <input type="text" id="pelanggaran" placeholder="Jenis Pelanggaran" required class="p-3 rounded-lg bg-slate-800 text-gray-200 border border-slate-700 focus:ring-2 focus:ring-yellow-500 outline-none">
    <input type="text" id="tanggal" placeholder="Tanggal (YYYY-MM-DD)" required class="p-3 rounded-lg bg-slate-800 text-gray-200 border border-slate-700 focus:ring-2 focus:ring-yellow-500 outline-none">
    <button type="submit" class="col-span-1 md:col-span-5 glow-btn text-white py-3 rounded-lg font-semibold">Tambahkan Pelanggaran</button>
  </form>

  <!-- Tabel Pelanggaran -->
  <div class="overflow-x-auto">
    <table class="w-full border-collapse">
      <thead class="bg-yellow-600 text-white">
        <tr>
          <th class="py-3 px-4 text-left">Nama Siswa</th>
          <th class="py-3 px-4 text-left">Kelas</th>
          <th class="py-3 px-4 text-left">Jurusan</th>
          <th class="py-3 px-4 text-left">Pelanggaran</th>
          <th class="py-3 px-4 text-left">Tanggal</th>
          <th class="py-3 px-4 text-center">Aksi</th>
        </tr>
      </thead>
      <tbody id="tabelPelanggaran" class="divide-y divide-slate-700 bg-slate-800 text-gray-300"></tbody>
    </table>
  </div>

  <!-- Statistik -->
  <div class="mt-8 bg-slate-900 p-4 rounded-lg">
    <h2 class="text-xl font-semibold text-white mb-4">📊 Jumlah Pelanggaran per Siswa</h2>
    <ul id="statistik" class="text-gray-300 list-disc list-inside"></ul>
  </div>
</div>

<div id="popupLogout" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
  <div class="bg-slate-800 border border-slate-700 rounded-xl shadow-2xl p-6 w-80 text-center popup-show">
    <h2 class="text-xl font-semibold text-white mb-3">Konfirmasi Keluar</h2>
    <p class="text-gray-300 mb-6">Apakah kamu yakin ingin keluar dari sistem?</p>
    <div class="flex justify-center gap-3">
      <button id="btnBatal" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition">Batal</button>
      <button id="btnKeluar" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition">Keluar</button>
    </div>
  </div>
</div>

<script>
const form = document.getElementById('pelanggaranForm');
const tabel = document.getElementById('tabelPelanggaran');
const statistikList = document.getElementById('statistik');

const dataPelanggaran = [];

form.addEventListener('submit', (e) => {
  e.preventDefault();

  const nama = document.getElementById('nama').value.trim();
  const kelas = document.getElementById('kelas').value.trim();
  const jurusan = document.getElementById('jurusan').value.trim();
  const pelanggaran = document.getElementById('pelanggaran').value.trim();
  const tanggal = document.getElementById('tanggal').value.trim();

  if (nama && kelas && jurusan && pelanggaran && tanggal) {
    const item = { nama, kelas, jurusan, pelanggaran, tanggal };
    dataPelanggaran.push(item);

    const row = document.createElement('tr');
    row.classList.add('hover:bg-slate-700', 'transition');
    row.innerHTML = `
      <td class="py-3 px-4">${nama}</td>
      <td class="py-3 px-4">${kelas}</td>
      <td class="py-3 px-4">${jurusan}</td>
      <td class="py-3 px-4">${pelanggaran}</td>
      <td class="py-3 px-4">${tanggal}</td>
      <td class="py-3 px-4 text-center">
        <button onclick="hapusBaris(this)" class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded-lg transition">Hapus</button>
      </td>
    `;
    tabel.appendChild(row);

    updateStatistik();
    form.reset();
  }
});

function hapusBaris(button) {
  const row = button.closest('tr');
  const nama = row.children[0].textContent;
  const tanggal = row.children[4].textContent;

  const index = dataPelanggaran.findIndex(item => item.nama === nama && item.tanggal === tanggal);
  if(index > -1) dataPelanggaran.splice(index, 1);

  row.remove();
  updateStatistik();
}

function updateStatistik() {
  const count = {};
  dataPelanggaran.forEach(item => {
    count[item.nama] = (count[item.nama] || 0) + 1;
  });
  statistikList.innerHTML = '';
  for(const [nama, jumlah] of Object.entries(count)){
    const li = document.createElement('li');
    li.textContent = `${nama}: ${jumlah} pelanggaran`;
    statistikList.appendChild(li);
  }
}

// Logout popup
const logoutBtn = document.getElementById('logoutBtn');
const popupLogout = document.getElementById('popupLogout');
const btnBatal = document.getElementById('btnBatal');
const btnKeluar = document.getElementById('btnKeluar');

logoutBtn.addEventListener('click', () => {
  popupLogout.classList.remove('hidden');
  popupLogout.classList.add('flex');
});
btnBatal.addEventListener('click', () => popupLogout.classList.add('hidden'));
btnKeluar.addEventListener('click', () => window.location.href = "login.html");
</script>
</body>
</html>

