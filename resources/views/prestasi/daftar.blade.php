@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Prestasi</h1>

    {{-- Pesan sukses kalau ada --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Siswa</th>
                <th>Prestasi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($prestasi as $p)
                <tr>
                    <td>{{ $p['id'] }}</td>
                    <td>{{ $p['nama'] }}</td>
                    <td>{{ $p['prestasi'] }}</td>
                    <td>
                        <a href="{{ route('prestasi.show', $p['id']) }}" class="btn btn-info btn-sm">Detail</a>
                        <a href="{{ route('prestasi.edit', $p['id']) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('prestasi.destroy', $p['id']) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection