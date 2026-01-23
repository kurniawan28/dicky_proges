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
            max-width: 1200px;
            animation: fadeIn 0.4s ease;
        }

        .glow-btn {
            background: linear-gradient(90deg, #0ea5e9, #0284c7);
            transition: all 0.3s ease;
        }

        .glow-btn:hover {
            box-shadow: 0 0 15px #0ea5e9;
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

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }
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

    <div class="card mt-10">

        {{-- JUDUL --}}
        <h1 class="text-3xl font-bold text-center mb-8 text-white flex justify-center items-center gap-2">
            📋 Data Konseling Siswa
        </h1>

        {{-- TOMBOL AJUKAN KONSELING --}}
        @if(auth()->user()->role === 'SISWA')
            <div class="mb-8">
                <a href="{{ route('konseling.create') }}" class="glow-btn text-white py-3 px-6 rounded-lg font-semibold inline-block">
                    + Ajukan Konseling
                </a>
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full border-collapse">

                {{-- HEADER TABEL --}}
                <thead class="bg-cyan-600 text-white">
                    <tr>
                        <th class="py-3 px-4 text-left">Nama Siswa</th>
                        <th class="py-3 px-4 text-left">Kelas</th>
                        <th class="py-3 px-4 text-left">Absen</th>
                        <th class="py-3 px-4 text-left">Tanggal Konseling</th>
                        <th class="py-3 px-4 text-left">Jam</th>
                        @if(auth()->user()->role !== 'SISWA')
                            <th class="py-3 px-4 text-left">Permasalahan</th>
                        @endif
                        <th class="py-3 px-4 text-left">Guru BK</th>
                        <th class="py-3 px-4 text-center">Status</th>
                        @if(auth()->user()->role !== 'SISWA')
                            <th class="py-3 px-4 text-center">Aksi</th>
                        @endif
                    </tr>
                </thead>

                {{-- BODY TABEL --}}
                <tbody class="divide-y divide-slate-700 bg-slate-800 text-gray-300">
                    @php $hasData = false; @endphp
                    @foreach($konseling as $item)
                        @php $hasData = true; @endphp
                        <tr class="hover:bg-slate-700 transition">
                            <td class="py-3 px-4">{{ $item->nama_siswa }}</td>
                            <td class="py-3 px-4">{{ $item->kelas }}</td>
                            <td class="py-3 px-4">{{ $item->absen ?? '-' }}</td>
                            <td class="py-3 px-4">{{ $item->tanggal }}</td>
                            <td class="py-3 px-4">{{ $item->jam_mulai ? \Carbon\Carbon::parse($item->jam_mulai)->format('H:i') : '-' }} - {{ $item->jam_selesai ? \Carbon\Carbon::parse($item->jam_selesai)->format('H:i') : '-' }}</td>
                            @if(auth()->user()->role !== 'SISWA')
                                <td class="py-3 px-4">{{ $item->permasalahan }}</td>
                            @endif
                            <td class="py-3 px-4">{{ $item->guru_bk }}</td>

                            {{-- STATUS + ALASAN PENOLAKAN --}}
                            <td class="py-3 px-4 text-center">
                                <span class="px-3 py-1 text-sm font-semibold rounded-full
                                    @if($item->status == 'pending') bg-yellow-600 text-yellow-100
                                    @elseif($item->status == 'setuju') bg-green-600 text-white
                                    @elseif($item->status == 'selesai') bg-green-600 text-white
                                    @elseif($item->status == 'tolak') bg-red-600 text-red-100
                                    @else bg-gray-600 text-gray-100
                                    @endif">
                                    {{ ucfirst($item->status) }}
                                </span>

                                @if($item->alasan_penolakan)
                                    <div class="mt-2 text-sm text-red-800 bg-red-100 rounded-lg px-3 py-2 inline-block max-w-xs break-words shadow-sm">
                                        <strong>Alasan:</strong> {{ $item->alasan_penolakan }}
                                    </div>
                                @endif
                            </td>

                            {{-- AKSI --}}
                            @if(auth()->user()->role !== 'SISWA')
                                <td class="py-3 px-4 text-center flex gap-2 justify-center flex-wrap">

                                    {{-- Setuju --}}
                                    @if($item->status == 'pending')
                                        <form action="{{ route('konseling.updateStatus', $item->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Setuju ajuan konseling ini?');">
                                            @csrf
                                            <button type="submit"
                                                    class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded-lg">
                                                ✅ Setuju
                                            </button>
                                        </form>

                                        {{-- TOLAK --}}
                                        <button onclick="openTolakModal({{ $item->id }})"
                                                class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-lg">
                                            ❌ Tolak
                                        </button>
                                    @endif

                                    {{-- HAPUS --}}
                                    <form action="{{ route('konseling.destroy', $item->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Hapus data ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg">
                                            🗑️ Hapus
                                        </button>
                                    </form>

                                </td>
                            @endif

                        </tr>
                    @endforeach

                    {{-- EMPTY STATE --}}
                    @if(!$hasData)
                        <tr>
                            <td colspan="{{ auth()->user()->role === 'SISWA' ? 7 : 9 }}"
                                class="py-8 text-center text-lg text-gray-400">
                                {{ auth()->user()->role === 'SISWA'
                                    ? 'Anda belum mengajukan data konseling.'
                                    : 'Tidak ada data konseling yang tersedia.' }}
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
</script>

</body>
</html>
