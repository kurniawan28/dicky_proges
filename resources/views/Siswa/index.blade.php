@extends('layouts.app')

@section('content')
<style>
    body { 
        font-family: 'Poppins', sans-serif; 
        background: linear-gradient(135deg, #0f172a, #1e293b); 
        color: #e2e8f0; 
        min-height: 100vh; 
        padding-top: 100px; 
    }

    .card { 
        background: rgba(15, 23, 42, 0.85); 
        border: 1px solid rgba(255, 255, 255, 0.1); 
        backdrop-filter: blur(10px); 
        border-radius: 1rem; 
        box-shadow: 0 0 25px rgba(59, 130, 246, 0.3); 
        padding: 2rem; 
        width: 100%;
        max-width: 1400px;
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
</style>

<nav class="fixed top-0 left-0 right-0 bg-slate-900/80 backdrop-blur-md border-b border-slate-700 p-4 flex justify-between items-center px-6 z-50 h-20">
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

<div class="flex justify-center p-6 pt-28 w-full">
    <div class="card">

        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6">
            <h2 class="text-3xl font-bold text-white flex items-center gap-2">
                📘 Data Siswa
            </h2>

            <div class="flex gap-3 w-full md:w-auto">
                <input 
                    type="text" 
                    id="searchInput"
                    placeholder="🔍 Cari nama / NIS..."
                    class="w-full md:w-72 p-3 rounded-lg bg-slate-800 text-gray-200 border border-slate-700 focus:ring-2 focus:ring-cyan-500 outline-none"
                >

                <a href="{{ route('siswa.create') }}" class="glow-btn text-white py-2 px-4 rounded-lg font-semibold whitespace-nowrap">
                    + Tambah Siswa
                </a>
            </div>
        </div>

        {{-- SUCCESS --}}
        @if(session('success'))
            <div class="mb-4 p-3 rounded bg-green-600 text-white shadow-neon">
                {{ session('success') }}
            </div>
        @endif

        {{-- TABEL --}}
        <div class="overflow-x-auto rounded-lg">
            <table class="w-full border-collapse" id="siswaTable">
                <thead class="bg-cyan-600 text-white">
                    <tr>
                        <th class="py-3 px-4 text-left">No Absen</th>
                        <th class="py-3 px-4 text-left">NIS</th>
                        <th class="py-3 px-4 text-left">Nama</th>
                        <th class="py-3 px-4 text-left">Kelas</th>
                        <th class="py-3 px-4 text-left">JK</th>
                        <th class="py-3 px-4 text-left">No HP</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-700 bg-slate-800 text-gray-300">
                    @foreach($siswas as $s)
                    <tr class="hover:bg-slate-700 transition siswa-row">
                        <td class="py-3 px-4">{{ $s->no_absen ?? '-' }}</td>
                        <td class="py-3 px-4">{{ $s->nis }}</td>
                        <td class="py-3 px-4">{{ $s->nama_lengkap }}</td>
                        <td class="py-3 px-4">{{ $s->kelas }} - {{ $s->jurusan }}</td>
                        <td class="py-3 px-4">
                            <span class="{{ $s->jenis_kelamin == 'L' ? 'bg-blue-500' : 'bg-pink-500' }} text-white px-2 py-1 rounded-full text-xs">
                                {{ $s->jenis_kelamin }}
                            </span>
                        </td>
                        <td class="py-3 px-4">{{ $s->no_hp ?? '-' }}</td>
                        <td class="py-3 px-4 flex justify-center gap-2">
                            <a href="{{ route('siswa.edit', $s->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded-md text-sm">
                                Edit
                            </a>
                            <form action="{{ route('siswa.destroy', $s->id) }}" method="POST" onsubmit="return confirm('Hapus data siswa ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded-md text-sm">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                    <tr id="noDataRow" class="hidden">
                        <td colspan="7" class="py-10 text-center text-gray-400">
                            ❌ Data tidak ditemukan
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</div>

{{-- 🔥 SEARCH REALTIME SCRIPT --}}
<script>
document.getElementById('searchInput').addEventListener('keyup', function () {
    const keyword = this.value.toLowerCase();
    const rows = document.querySelectorAll('.siswa-row');
    let found = false;

    rows.forEach(row => {
        const text = row.innerText.toLowerCase();
        if (text.includes(keyword)) {
            row.style.display = '';
            found = true;
        } else {
            row.style.display = 'none';
        }
    });

    document.getElementById('noDataRow').classList.toggle('hidden', found);
});
</script>

@endsection
