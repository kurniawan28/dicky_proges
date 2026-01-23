@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-2xl mb-4">Daftar Konseling Siswa</h2>

    @if(session('success'))
        <div class="bg-green-500 text-white p-2 mb-4">{{ session('success') }}</div>
    @endif

    <table class="w-full table-auto border">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="px-4 py-2">Nama Siswa</th>
                <th class="px-4 py-2">Kelas</th>
                <th class="px-4 py-2">Tanggal</th>
                <th class="px-4 py-2">Absensi</th>
                <th class="px-4 py-2">Permasalahan/Keterangan</th>
                <th class="px-4 py-2">Guru BK</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($konselings as $k)
            <tr class="border-b">
                <td class="px-4 py-2">{{ $k->nama_siswa }}</td>
                <td class="px-4 py-2">{{ $k->kelas }}</td>
                <td class="px-4 py-2">{{ $k->tanggal }}</td>
                <td class="px-4 py-2">
                    @if($k->absen)
                        <span class="bg-yellow-200 text-yellow-800 px-2 py-1 rounded text-xs font-bold">{{ $k->absen }}</span>
                    @else
                        -
                    @endif
                </td>
                <td class="px-4 py-2">{{ $k->permasalahan }}</td>
                <td class="px-4 py-2">{{ $k->guru_bk }}</td>
                <td class="px-4 py-2">
                    @if($k->status == 'pending')
                        <span class="bg-gray-200 text-gray-800 px-2 py-1 rounded text-xs">Menunggu Konfirmasi</span>
                    @elseif($k->status == 'setuju')
                        <span class="bg-green-200 text-green-800 px-2 py-1 rounded text-xs">Dicatat/Disetujui</span>
                    @else
                        <span class="bg-red-200 text-red-800 px-2 py-1 rounded text-xs">Ditolak</span>
                    @endif
                </td>
                <td class="px-4 py-2">
                    @if($k->status == 'pending')
                    <form action="{{ route('konseling.updateStatus', $k->id) }}" method="POST" class="flex gap-2">
                        @csrf
                        <input type="hidden" name="status" value="setuju">
                        <button class="bg-green-500 text-white px-2 py-1 rounded">Setuju</button>
                    </form>
                    <form action="{{ route('konseling.updateStatus', $k->id) }}" method="POST" class="flex gap-2">
                        @csrf
                        <input type="hidden" name="status" value="tolak">
                        <button class="bg-red-500 text-white px-2 py-1 rounded">Tolak</button>
                    </form>
                    @else
                        <span>{{ ucfirst($k->status) }}</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
