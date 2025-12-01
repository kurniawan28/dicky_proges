@extends('layouts.app')

@section('content')
<div class="p-10 bg-gradient-to-tr from-[#0f2027] via-[#203a43] to-[#2c5364] min-h-screen text-gray-200">

    <h2 class="text-3xl font-bold text-cyan-400 mb-6">Edit Data Siswa</h2>

    <form action="{{ route('siswa.update', $siswa->id) }}" method="POST" enctype="multipart/form-data" class="bg-[#0B1828] p-6 rounded-lg shadow-lg max-w-4xl">
        @csrf
        @method('PUT')
        @include('siswa.form')

        <div class="mt-6 flex justify-end gap-2">
            <a href="{{ route('siswa.index') }}" class="cancel-btn text-white px-6 py-2 rounded-lg shadow-md transition-all">
                Batal
            </a>
            <button type="submit" class="update-btn text-white px-6 py-2 rounded-lg shadow-md transition-all">
                Update
            </button>
        </div>
    </form>
</div>

{{-- Neon/Glow Styles --}}
<style>
    /* Tombol Update kuning neon */
    .update-btn {
        background: linear-gradient(90deg, #facc15, #eab308);
        transition: all 0.3s ease;
    }

    .update-btn:hover {
        box-shadow: 0 0 15px #facc15;
        transform: translateY(-2px);
    }

    /* Tombol Batal abu-abu */
    .cancel-btn {
        background: linear-gradient(90deg, #6b7280, #4b5563);
        transition: all 0.3s ease;
    }

    .cancel-btn:hover {
        box-shadow: 0 0 15px #6b7280;
        transform: translateY(-2px);
    }
</style>
@endsection
