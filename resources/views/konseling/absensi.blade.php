@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 max-w-7xl">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0f172a, #1e293b, #0f172a);
        }

        .glass-card {
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(34, 211, 238, 0.2);
            backdrop-filter: blur(16px);
            border-radius: 1.5rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4);
            animation: fadeIn 0.6s ease-out;
        }

        .custom-table {
            width: 100%;
            border-spacing: 0 10px;
            border-collapse: separate;
        }

        .custom-table thead tr {
            background: linear-gradient(90deg, #0891b2, #0e7490);
        }

        .custom-table th {
            padding: 1.25rem 1rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-size: 0.75rem;
            color: white;
        }

        .custom-table th:first-child { border-top-left-radius: 1rem; border-bottom-left-radius: 1rem; }
        .custom-table th:last-child { border-top-right-radius: 1rem; border-bottom-right-radius: 1rem; }

        .custom-table tbody tr {
            background: rgba(30, 41, 59, 0.4);
            transition: all 0.3s ease;
        }

        .custom-table tbody tr:hover {
            background: rgba(30, 41, 59, 0.7);
            transform: scale(1.002);
        }

        .custom-table td {
            padding: 1.25rem 1rem;
            vertical-align: middle;
        }

        .custom-table td:first-child { border-top-left-radius: 1rem; border-bottom-left-radius: 1rem; }
        .custom-table td:last-child { border-top-right-radius: 1rem; border-bottom-right-radius: 1rem; }

        .status-pill {
            padding: 0.35rem 0.8rem;
            border-radius: 2rem;
            font-weight: 700;
            font-size: 0.7rem;
            display: inline-block;
            text-transform: uppercase;
        }

        .action-btn {
            @apply px-3 py-1.5 rounded-lg text-xs font-bold transition-all duration-300 shadow-lg;
        }

        .img-preview {
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid rgba(34, 211, 238, 0.2);
        }
        .img-preview:hover {
            transform: scale(1.1);
            border-color: #22d3ee;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            padding-top: 50px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.9);
            backdrop-filter: blur(8px);
        }
        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
            border: 4px solid #22d3ee;
            border-radius: 1rem;
        }
        .close-modal {
            position: absolute;
            top: 20px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            cursor: pointer;
        }
    </style>

    <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-6">
        <h2 class="text-3xl font-extrabold text-white flex items-center gap-3">
            <span class="p-3 bg-cyan-500/20 rounded-2xl shadow-inner">📅</span>
            Laporan Absensi Siswa
        </h2>
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2 bg-slate-800 hover:bg-slate-700 text-white px-6 py-2.5 rounded-xl font-semibold border border-slate-700 transition">
            ⬅ Kembali
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-500/20 border border-green-500/30 text-green-400 p-4 mb-6 rounded-xl animate-pulse">
            {{ session('success') }}
        </div>
    @endif

    <div class="glass-card p-8">
        <div class="overflow-x-auto">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Identitas Siswa</th>
                        <th>Waktu & Jenis</th>
                        <th>Keterangan & Bukti</th>
                        <th>Status Verifikasi</th>
                        <th class="text-center">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="text-gray-300">
                    @forelse($dataAbsensi as $k)
                    <tr>
                        <td>
                            <div class="font-bold text-white text-lg">{{ $k->nama_siswa }}</div>
                            <div class="text-xs text-cyan-400 font-semibold uppercase tracking-wider mt-1">
                                Kelas: {{ $k->kelas }}
                            </div>
                        </td>
                        <td>
                            <div class="text-sm text-gray-200">📅 {{ $k->tanggal }}</div>
                            <div class="mt-2">
                                @if($k->absen == 'Sakit')
                                    <span class="px-2 py-1 rounded-md bg-yellow-500/10 text-yellow-500 border border-yellow-500/20 font-bold text-[10px]">SAKIT</span>
                                @elseif($k->absen == 'Izin')
                                    <span class="px-2 py-1 rounded-md bg-blue-500/10 text-blue-500 border border-blue-500/20 font-bold text-[10px]">IZIN</span>
                                @else
                                    <span class="px-2 py-1 rounded-md bg-red-500/10 text-red-500 border border-red-500/20 font-bold text-[10px]">ALPHA</span>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="flex flex-col gap-3">
                                <p class="text-xs italic text-gray-400 max-w-xs">{{ $k->permasalahan ?? '-' }}</p>
                                @if($k->bukti)
                                    <div class="group relative inline-block">
                                        <img src="{{ asset('storage/' . $k->bukti) }}" 
                                             alt="Bukti" 
                                             class="w-14 h-14 object-cover rounded-xl border-2 border-cyan-500/30 img-preview"
                                             onclick="openImageModal(this.src)">
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td>
                            <span class="status-pill
                                @if($k->status == 'pending_admin') bg-blue-500/10 text-blue-400 border border-blue-500/20
                                @elseif($k->status == 'setuju') bg-green-500/10 text-green-400 border border-green-500/20
                                @else bg-red-500/10 text-red-400 border border-red-500/20
                                @endif">
                                {{ $k->status == 'pending_admin' ? '⏳ Menunggu Admin' : 
                                   ($k->status == 'setuju' ? '✅ Disetujui' : ucfirst($k->status)) }}
                            </span>
                        </td>
                        <td>
                            <div class="flex flex-wrap justify-center gap-2">
                                @if($k->status == 'pending_admin')
                                    <form action="{{ route('konseling.updateStatus', $k->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="status" value="setuju">
                                        <button class="bg-gradient-to-r from-green-600 to-green-500 hover:brightness-125 text-white py-1.5 px-3 rounded-lg text-[10px] font-bold shadow-lg shadow-green-900/20 transition">
                                            SETUJUI
                                        </button>
                                    </form>
                                    <form action="{{ route('konseling.updateStatus', $k->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="status" value="tolak">
                                        <button class="bg-gradient-to-r from-red-600 to-red-500 hover:brightness-125 text-white py-1.5 px-3 rounded-lg text-[10px] font-bold shadow-lg shadow-red-900/20 transition">
                                            TOLAK
                                        </button>
                                    </form>
                                @else
                                    <span class="bg-slate-700 text-gray-400 px-3 py-1 rounded-lg text-[10px] font-bold border border-slate-600">SELESAI</span>
                                @endif

                                <form action="{{ route('konseling.destroy', $k->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-slate-700 hover:bg-red-600 text-gray-300 hover:text-white transition-colors py-1.5 px-3 rounded-lg text-sm">
                                        🗑️
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-20 text-center">
                            <div class="text-5xl mb-4 opacity-10">📂</div>
                            <div class="text-gray-500 text-lg italic">Belum ada data absensi yang masuk.</div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal for Image Preview -->
<div id="imageModal" class="modal" onclick="closeImageModal()">
    <span class="close-modal" onclick="closeImageModal()">&times;</span>
    <img class="modal-content" id="img01">
</div>

<script>
    function openImageModal(src) {
        document.getElementById("imageModal").style.display = "block";
        document.getElementById("img01").src = src;
    }

    function closeImageModal() {
        document.getElementById("imageModal").style.display = "none";
    }

    // Close on ESC key
    document.addEventListener('keydown', function(event) {
        if (event.key === "Escape") {
            closeImageModal();
        }
    });
</script>
@endsection
