@extends('layouts.app')

@section('content')
<div class="bg-gradient-to-tr from-[#0f172a] via-[#1e293b] to-[#0f172a] min-h-screen">

    {{-- NAVBAR --}}
    <nav class="fixed top-0 left-0 right-0 bg-slate-900/80 backdrop-blur-md border-b border-slate-700 p-4 flex justify-between items-center px-6 z-50 h-20">
        <a href="{{ route('dashboard') }}" class="text-xl font-semibold text-white flex items-center gap-2">
            🏫 Sistem BK Sekolah
        </a>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn text-white font-semibold py-2 px-5 rounded-lg">Logout</button>
        </form>
    </nav>

    {{-- Konten utama --}}
    <div class="flex justify-center p-6 pt-28"> {{-- pt-28 = 112px untuk memberi ruang navbar --}}
        <div class="w-full max-w-6xl card">

            {{-- Header --}}
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-bold text-white flex items-center gap-2">
                    📘 Data Siswa
                </h2>
                <a href="{{ route('siswa.create') }}" 
                   class="glow-btn text-white py-2 px-4 rounded-lg font-semibold inline-block">
                    + Tambah Siswa
                </a>
            </div>

            {{-- Success Message --}}
            @if(session('success'))
                <div class="mb-4 p-3 rounded bg-green-600 text-white shadow-neon">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Tabel --}}
            <div class="overflow-x-auto rounded-lg">
                <table class="w-full border-collapse">
                    <thead class="bg-cyan-600 text-white">
                        <tr>
                            <th class="py-3 px-4 text-left">NIS</th>
                            <th class="py-3 px-4 text-left">Nama</th>
                            <th class="py-3 px-4 text-left">Kelas</th>
                            <th class="py-3 px-4 text-left">JK</th>
                            <th class="py-3 px-4 text-left">No HP</th>
                            <th class="py-3 px-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700 bg-slate-800 text-gray-300">
                        @forelse($siswas as $s)
                            <tr class="hover:bg-slate-700">
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
                                    <a href="{{ route('siswa.edit', $s->id) }}" 
                                       class="bg-yellow-500 text-white px-3 py-1 rounded-md text-sm">
                                        Edit
                                    </a>
                                    <form action="{{ route('siswa.destroy', $s->id) }}" method="POST" onsubmit="return confirm('Hapus data?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded-md text-sm">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-8 text-center text-gray-400">
                                    Belum ada data siswa.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $siswas->links() }}
            </div>

        </div>
    </div>
</div>

{{-- Neon/Glow Styles --}}
<style>
    .card {
        background: rgba(15, 23, 42, 0.85);
        border: 1px solid rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 1rem;
        box-shadow: 0 0 25px rgba(59, 130, 246, 0.3);
        padding: 2rem;
        animation: fadeIn 0.4s ease;
    }

    /* Tombol Tambah Siswa biru */
    .glow-btn {
        background: linear-gradient(90deg, #0ea5e9, #0284c7);
        transition: all 0.3s ease;
    }

    .glow-btn:hover {
        box-shadow: 0 0 15px #0ea5e9;
        transform: translateY(-2px);
    }

    /* Tombol Logout merah neon */
    .logout-btn {
        background: linear-gradient(90deg, #f87171, #b91c1c);
        transition: all 0.3s ease;
    }

    .logout-btn:hover {
        box-shadow: 0 0 15px #f87171;
        transform: translateY(-2px);
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to   { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
