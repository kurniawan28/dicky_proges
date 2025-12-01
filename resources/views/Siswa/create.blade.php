@extends('layouts.app')

@section('content')
<div class="flex justify-center p-6 bg-gradient-to-tr from-[#0f172a] via-[#1e293b] to-[#0f172a] min-h-screen">

    <div class="w-full max-w-4xl card">

        {{-- Judul --}}
        <h2 class="text-3xl font-bold text-white mb-6 flex items-center gap-2">
            📘 Tambah Data Siswa
        </h2>

        {{-- Form --}}
        <form action="{{ route('siswa.store') }}" method="POST" enctype="multipart/form-data" class="bg-[#0B1828] p-6 rounded-lg shadow-lg">
            @csrf
            @include('siswa.form')

            <div class="mt-6 flex justify-end gap-2">
                <a href="{{ route('siswa.index') }}" 
                   class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg shadow-md transition-all">
                    Batal
                </a>

                <button type="submit" class="glow-btn text-white px-6 py-2 rounded-lg font-semibold">
                    Simpan
                </button>
            </div>
        </form>

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

    .glow-btn {
        background: linear-gradient(90deg, #0ea5e9, #0284c7);
        transition: all 0.3s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to   { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
