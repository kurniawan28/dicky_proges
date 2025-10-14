<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pelanggaran Siswa</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #0f172a, #1e293b);
      color: #e2e8f0;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
      padding: 30px;
    }

    .card {
      background: rgba(15, 23, 42, 0.85);
      border-radius: 1rem;
      padding: 2rem;
      box-shadow: 0 0 25px rgba(59, 130, 246, 0.3);
      width: 90%;
      max-width: 700px;
      position: relative;
    }

    h1 {
      font-size: 1.8rem;
      font-weight: 600;
      margin-bottom: 20px;
    }

    canvas {
      margin-top: 20px;
    }

    /* Tombol keluar */
    .logout-btn {
      position: absolute;
      top: 1rem;
      right: 1rem;
      background: linear-gradient(90deg, #ef4444, #dc2626);
      color: white;
      font-weight: 600;
      padding: 0.5rem 1rem;
      border: none;
      border-radius: 0.5rem;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .logout-btn:hover {
      box-shadow: 0 0 12px #ef4444;
      transform: translateY(-2px);
    }

    /* Popup logout */
    #popupLogout {
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.6);
      display: none;
      align-items: center;
      justify-content: center;
      z-index: 100;
    }

    .popup-content {
      background: #1e293b;
      border: 1px solid #334155;
      border-radius: 1rem;
      padding: 2rem;
      width: 300px;
      text-align: center;
      color: white;
      animation: fadeIn 0.3s ease forwards;
    }

    .popup-buttons {
      display: flex;
      justify-content: center;
      gap: 1rem;
      margin-top: 1.5rem;
    }

    .popup-btn {
      padding: 0.5rem 1rem;
      border-radius: 0.5rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s;
    }

    .btn-batal {
      background: #64748b;
    }

    .btn-batal:hover {
      background: #475569;
    }

    .btn-keluar {
      background: #dc2626;
    }

    .btn-keluar:hover {
      background: #b91c1c;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: scale(0.95); }
      to { opacity: 1; transform: scale(1); }
    }
  </style>
</head>
<body>

  <div class="card">
    <button id="logoutBtn" class="logout-btn">Keluar</button>

    <h1>📊 Statistik Pelanggaran Siswa</h1>
    <p class="text-gray-300 mb-4">Data kategori pelanggaran berdasarkan tingkat keseriusan:</p>

    <canvas id="pelanggaranChart" width="400" height="400"></canvas>

    <div class="mt-6 text-left text-sm text-gray-300">
      <p>🟢 <b>Hijau</b> – Pelanggaran ringan (contoh: lupa atribut, datang terlambat)</p>
      <p>🟡 <b>Kuning</b> – Pelanggaran sedang (contoh: membolos, berdebat dengan guru)</p>
      <p>🔴 <b>Merah</b> – Pelanggaran berat (contoh: berkelahi, membawa barang terlarang)</p>
    </div>
  </div>

  <!-- Popup Konfirmasi Logout -->
  <div id="popupLogout">
    <div class="popup-content">
      <h2 class="text-lg font-semibold mb-2">Konfirmasi Keluar</h2>
      <p class="text-gray-300 text-sm mb-4">Apakah kamu yakin ingin keluar ke dashboard?</p>
      <div class="popup-buttons">
        <button id="btnBatal" class="popup-btn btn-batal">Batal</button>
        <button id="btnKeluar" class="popup-btn btn-keluar">Keluar</button>
      </div>
    </div>
  </div>

  <script>
    // Chart.js Data
    const ctx = document.getElementById('pelanggaranChart').getContext('2d');
    const pelanggaranChart = new Chart(ctx, {
      type: 'pie',
      data: {
        labels: ['Pelanggaran Ringan', 'Pelanggaran Sedang', 'Pelanggaran Berat'],
        datasets: [{
          label: 'Jumlah Pelanggaran',
          data: [45, 25, 15],
          backgroundColor: ['#22c55e', '#eab308', '#ef4444'],
          borderColor: '#0f172a',
          borderWidth: 2
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'right',
            labels: { color: '#e2e8f0', font: { size: 14 } }
          },
          title: {
            display: true,
            text: 'Analisis Tingkat Pelanggaran Siswa',
            color: '#ffffff',
            font: { size: 18, weight: '600' }
          }
        }
      }
    });

    // Tombol logout
    const logoutBtn = document.getElementById('logoutBtn');
    const popupLogout = document.getElementById('popupLogout');
    const btnBatal = document.getElementById('btnBatal');
    const btnKeluar = document.getElementById('btnKeluar');

    logoutBtn.addEventListener('click', () => {
      popupLogout.style.display = 'flex';
    });

    btnBatal.addEventListener('click', () => {
      popupLogout.style.display = 'none';
    });

    btnKeluar.addEventListener('click', () => {
      popupLogout.style.display = 'none';
      // 🔁 Ganti sesuai sistem kamu:
      // Kalau pakai HTML biasa:
      window.location.href = "dashboard.html";

      // Kalau pakai Laravel Blade:
      // window.location.href = "{{ route('dashboard') }}";
    });
  </script>

</body>
</html>
