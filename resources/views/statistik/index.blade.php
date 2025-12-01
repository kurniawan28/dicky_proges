<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Statistik Pelanggaran Siswa</title>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<style>
body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #0f172a, #1e293b);
    color: #e2e8f0;
    min-height: 100vh;
    padding: 30px;
    display: flex;
    justify-content: center;
    align-items: flex-start;
}
.card {
    background: rgba(15,23,42,0.85);
    border-radius: 1rem;
    padding: 2rem;
    box-shadow: 0 0 25px rgba(59,130,246,0.3);
    width: 90%;
    max-width: 700px;
}
canvas { margin-top: 20px; }
</style>
</head>
<body>

<style>
body { font-family: 'Poppins', sans-serif; background: linear-gradient(135deg, #0f172a, #1e293b); color: #e2e8f0; min-height: 100vh; display: flex; flex-direction: column; align-items: center; justify-content: flex-start; padding-top: 80px; }
.card { background: rgba(15, 23, 42, 0.85); border: 1px solid rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); border-radius: 1rem; box-shadow: 0 0 25px rgba(59, 130, 246, 0.3); padding: 2rem; width: 90%; max-width: 650px; }
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

<div class="card mt-24">
    <h1 class="text-3xl font-bold text-white text-center mb-4">📊 Statistik Pelanggaran Siswa</h1>
    <p class="text-gray-300 text-center mb-6">Analisis kategori pelanggaran berdasarkan tingkat keseriusan</p>

    <canvas id="pelanggaranChart" width="400" height="400"></canvas>

    <div class="mt-6 text-left text-sm text-gray-300">
        <p>🟢 <b>Hijau</b> – Pelanggaran ringan</p>
        <p>🟡 <b>Kuning</b> – Pelanggaran sedang</p>
        <p>🔴 <b>Merah</b> – Pelanggaran berat</p>
    </div>
</div>

<script>
    // Ambil data dari backend, aman jika $pelanggaran tidak ada
    const dataRingan = {{ $pelanggaran->where('kategori','ringan')->count() ?? 0 }};
    const dataSedang  = {{ $pelanggaran->where('kategori','sedang')->count() ?? 0 }};
    const dataBerat   = {{ $pelanggaran->where('kategori','berat')->count() ?? 0 }};

    const ctx = document.getElementById('pelanggaranChart').getContext('2d');
    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Ringan', 'Sedang', 'Berat'],
            datasets: [{
                label: 'Jumlah Pelanggaran',
                data: [dataRingan, dataSedang, dataBerat],
                backgroundColor: ['#22c55e','#eab308','#ef4444'],
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
                    text: 'Tingkat Pelanggaran Siswa',
                    color: '#ffffff',
                    font: { size: 18, weight: '600' }
                }
            }
        }
    });
</script>

</body>
</html>
