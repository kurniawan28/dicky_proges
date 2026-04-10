<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Konseling Siswa</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0f172a, #1e293b, #0f172a);
            color: #e2e8f0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            padding-top: 80px;
        }

        .glass-card {
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(34, 211, 238, 0.2);
            backdrop-filter: blur(16px);
            border-radius: 1.5rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4), 0 0 20px rgba(6, 182, 212, 0.1);
            padding: 2.5rem;
            width: 95%;
            max-width: 1280px;
            animation: slideUp 0.6s cubic-bezier(0.2, 0.8, 0.2, 1);
        }

        .custom-table {
            width: 100%;
            border-spacing: 0 10px;
            border-collapse: separate;
        }

        .custom-table thead tr {
            background: linear-gradient(90deg, #0891b2, #0e7490);
            box-shadow: 0 4px 15px rgba(8, 145, 178, 0.3);
        }

        .custom-table th {
            padding: 1.25rem 1rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-size: 0.8rem;
        }

        .custom-table th:first-child { border-top-left-radius: 1rem; border-bottom-left-radius: 1rem; }
        .custom-table th:last-child { border-top-right-radius: 1rem; border-bottom-right-radius: 1rem; }

        .custom-table tbody tr {
            background: rgba(30, 41, 59, 0.5);
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .custom-table tbody tr:hover {
            background: rgba(30, 41, 59, 0.8);
            transform: scale(1.005);
            box-shadow: 0 5px 20px rgba(6, 182, 211, 0.15);
        }

        .custom-table td {
            padding: 1.25rem 1rem;
            vertical-align: middle;
        }

        .custom-table td:first-child { border-top-left-radius: 1rem; border-bottom-left-radius: 1rem; }
        .custom-table td:last-child { border-top-right-radius: 1rem; border-bottom-right-radius: 1rem; }

        .status-pill {
            padding: 0.4rem 1rem;
            border-radius: 2rem;
            font-weight: 600;
            font-size: 0.75rem;
            display: inline-block;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
            text-transform: uppercase;
            letter-spacing: 0.02em;
        }

        .action-btn {
            @apply flex items-center justify-center gap-1.5 px-3 py-1.5 rounded-lg text-sm font-semibold transition-all duration-300;
        }

        .btn-glow {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .btn-glow:hover {
            filter: brightness(1.2);
            box-shadow: 0 0 20px rgba(6, 182, 212, 0.4);
            transform: translateY(-2px);
        }

        .result-box {
            background: rgba(15, 23, 42, 0.6);
            border-left: 4px solid #0891b2;
            padding: 0.75rem;
            border-radius: 0.5rem;
            font-size: 0.85rem;
            line-height: 1.5;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #0f172a; }
        ::-webkit-scrollbar-thumb { background: #334155; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #475569; }
    </style>
</head>
<body>

    {{-- NAVBAR --}}
    <nav class="fixed top-0 left-0 right-0 bg-slate-900/80 backdrop-blur-md border-b border-slate-700 p-4 flex justify-between items-center px-6 z-50">
        <a href="{{ route('dashboard') }}" class="text-xl font-semibold text-white flex items-center gap-2">
            📘 dashboard
        </a>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn text-white font-semibold py-2 px-5 rounded-lg">Logout</button>
        </form>
    </nav>

    <div class="glass-card mt-10">

        {{-- JUDUL --}}
        <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-6">
            <h1 class="text-3xl font-extrabold text-white flex items-center gap-3">
                <span class="p-3 bg-cyan-500/20 rounded-2xl shadow-inner">📋</span>
                Data Konseling Siswa
            </h1>
            
            @if(auth()->user()->role === 'SISWA')
                <a href="{{ route('konseling.create') }}" class="btn-glow flex items-center gap-2 bg-gradient-to-r from-cyan-500 to-cyan-600 text-white py-3 px-8 rounded-xl font-bold transition shadow-lg shadow-cyan-500/20">
                    <span class="text-xl">+</span> Ajukan Konseling
                </a>
            @endif
        </div>

        <div class="overflow-x-auto pb-4">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Identitas Siswa</th>
                        <th>Jadwal</th>
                        @if(auth()->user()->role !== 'SISWA')
                            <th>Permasalahan</th>
                        @endif
                        <th>Guru BK</th>
                        <th class="text-center">Status</th>
                        <th>Hasil Akhir</th>
                        @if(auth()->user()->role !== 'SISWA')
                            <th class="text-center">Tindakan</th>
                        @endif
                    </tr>
                </thead>

                <tbody class="text-gray-300">
                    @php $hasData = false; @endphp
                    @foreach($konseling as $item)
                        @php $hasData = true; @endphp
                        <tr>
                            <td>
                                <div class="font-bold text-white text-lg">{{ $item->nama_siswa }}</div>
                                <div class="text-xs text-cyan-400 font-semibold uppercase tracking-wider mt-1">
                                    {{ $item->kelas }} • Absen: {{ $item->absen ?? '-' }}
                                </div>
                            </td>
                            <td>
                                <div class="flex items-center gap-2 text-sm text-gray-200">
                                    <span>📅</span> {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                                </div>
                                <div class="flex items-center gap-2 text-xs text-cyan-300 mt-1">
                                    <span>⏰</span> {{ $item->jam_mulai ? \Carbon\Carbon::parse($item->jam_mulai)->format('H:i') : '-' }} - {{ $item->jam_selesai ? \Carbon\Carbon::parse($item->jam_selesai)->format('H:i') : '-' }}
                                </div>
                            </td>
                            @if(auth()->user()->role !== 'SISWA')
                                <td class="max-w-xs text-sm italic text-gray-400">{{ $item->permasalahan }}</td>
                            @endif
                            <td>
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-full bg-cyan-500/10 flex items-center justify-center border border-cyan-500/30 text-cyan-400 text-xs font-bold">BK</div>
                                    <span class="text-sm font-medium">{{ $item->guru_bk }}</span>
                                </div>
                            </td>

                            <td class="text-center">
                                <span class="status-pill
                                    @if($item->status == 'pending') bg-yellow-500/20 text-yellow-400 border border-yellow-500/30
                                    @elseif($item->status == 'setuju' || $item->status == 'selesai') bg-green-500/20 text-green-400 border border-green-500/30
                                    @elseif($item->status == 'tolak') bg-red-500/20 text-red-400 border border-red-500/30
                                    @else bg-gray-500/20 text-gray-400 border border-gray-500/30
                                    @endif">
                                    {{ $item->status == 'pending' ? '⏳ Menunggu' : ($item->status == 'setuju' ? '✅ Disetujui' : ucfirst($item->status)) }}
                                </span>

                                @if($item->alasan_penolakan)
                                    <div class="mt-2 text-[10px] text-red-300 bg-red-500/10 rounded-lg px-2 py-1 border border-red-500/20">
                                        {{ $item->alasan_penolakan }}
                                    </div>
                                @endif
                            </td>

                            <td>
                                @if($item->hasil_konseling)
                                    <div class="result-box text-cyan-50">
                                        {{ $item->hasil_konseling }}
                                    </div>
                                @else
                                    <span class="text-gray-600 italic text-xs flex items-center gap-1.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-gray-600"></span>
                                        Belum ada catatan
                                    </span>
                                @endif
                            </td>

                            @if(auth()->user()->role !== 'SISWA')
                                <td>
                                    <div class="flex gap-2 justify-center">
                                        @if($item->status == 'pending')
                                            <form action="{{ route('konseling.updateStatus', $item->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="action-btn bg-green-600 hover:bg-green-500 text-white btn-glow" title="Setujui">
                                                    ACC
                                                </button>
                                            </form>
                                            <button onclick="openTolakModal({{ $item->id }})" class="action-btn bg-red-600 hover:bg-red-500 text-white btn-glow" title="Tolak">
                                                TOLAK
                                            </button>
                                        @endif

                                        @if($item->status == 'setuju')
                                            <button onclick="openHasilModal({{ $item->id }}, '{{ addslashes($item->hasil_konseling) }}')" class="action-btn bg-cyan-600 hover:bg-cyan-500 text-white btn-glow">
                                                HASIL
                                            </button>
                                        @endif

                                        <form action="{{ route('konseling.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn bg-slate-700 hover:bg-red-600 text-gray-300 hover:text-white transition-colors" title="Hapus">
                                                🗑️
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @endforeach

                    @if(!$hasData)
                        <tr>
                            <td colspan="{{ auth()->user()->role === 'SISWA' ? 5 : 7 }}" class="py-16 text-center">
                                <div class="text-5xl mb-4 opacity-20">📂</div>
                                <div class="text-gray-500 text-lg italic">
                                    {{ auth()->user()->role === 'SISWA' ? 'Anda belum memiliki riwayat konseling.' : 'Database konseling masih kosong.' }}
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

{{-- SWEETALERT TOLAK --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function openTolakModal(id) {
    Swal.fire({
        title: 'Alasan Penolakan',
        input: 'textarea',
        inputPlaceholder: 'Masukkan alasan penolakan...',
        showCancelButton: true,
        confirmButtonText: 'Tolak',
        cancelButtonText: 'Batal',
        inputValidator: (value) => {
            if (!value) {
                return 'Alasan penolakan tidak boleh kosong!'
            }
        }
    }).then((result) => {
        if (result.isConfirmed) {
            let form = document.createElement('form');
            form.method = 'POST';
            form.action = `/konseling/${id}/tolak`;

            let csrf = document.createElement('input');
            csrf.type = 'hidden';
            csrf.name = '_token';
            csrf.value = '{{ csrf_token() }}';

            let alasan = document.createElement('input');
            alasan.type = 'hidden';
            alasan.name = 'alasan_penolakan';
            alasan.value = result.value;

            form.appendChild(csrf);
            form.appendChild(alasan);
            document.body.appendChild(form);

            form.submit();
        }
    });
}

function openHasilModal(id, currentResult) {
    Swal.fire({
        title: 'Catatan Hasil Konseling',
        input: 'textarea',
        inputValue: currentResult,
        inputPlaceholder: 'Tuliskan hasil akhir/penyelesaian di sini...',
        showCancelButton: true,
        confirmButtonText: 'Simpan Catatan',
        cancelButtonText: 'Batal',
        inputValidator: (value) => {
            if (!value) {
                return 'Catatan tidak boleh kosong!'
            }
        }
    }).then((result) => {
        if (result.isConfirmed) {
            let form = document.createElement('form');
            form.method = 'POST';
            form.action = `/konseling/${id}/hasil`;

            let csrf = document.createElement('input');
            csrf.type = 'hidden';
            csrf.name = '_token';
            csrf.value = '{{ csrf_token() }}';

            let hasil = document.createElement('input');
            hasil.type = 'hidden';
            hasil.name = 'hasil_konseling';
            hasil.value = result.value;

            form.appendChild(csrf);
            form.appendChild(hasil);
            document.body.appendChild(form);

            form.submit();
        }
    });
}
</script>

</body>
</html>
