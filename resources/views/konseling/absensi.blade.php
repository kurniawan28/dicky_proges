@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-cyan-400">Data Absensi Siswa</h2>
        <a href="{{ route('dashboard') }}" class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-lg shadow-md transition duration-300">
            ⬅ Kembali ke Dashboard
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-500 text-white p-2 mb-4 rounded">{{ session('success') }}</div>
    @endif

    <div class="overflow-x-auto bg-[#0b1a2b]/80 backdrop-blur-lg rounded-xl shadow-xl p-6">
        <table class="w-full text-left text-gray-300">
            <thead class="bg-[#1e3a45] text-cyan-300 uppercase font-semibold text-sm">
                <tr>
                    <th class="px-6 py-4 rounded-tl-lg">Nama Siswa</th>
                    <th class="px-6 py-4">Tanggal</th>
                    <th class="px-6 py-4">Jenis Absen</th>
                    <th class="px-6 py-4">Keterangan</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 rounded-tr-lg">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700/50">
                @forelse($dataAbsensi as $k)
                <tr class="hover:bg-[#152e3b] transition duration-200">
                    <td class="px-6 py-4 font-medium">{{ $k->nama_siswa }}</td>
                    <td class="px-6 py-4">{{ $k->tanggal }}</td>
                    <td class="px-6 py-4">
                        @if($k->absen == 'Sakit')
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-yellow-500/20 text-yellow-500 border border-yellow-500/30">Sakit</span>
                        @elseif($k->absen == 'Izin')
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-500/20 text-blue-500 border border-blue-500/30">Izin</span>
                        @else
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-red-500/20 text-red-500 border border-red-500/30">Alpha</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">{{ $k->permasalahan }}</td>
                    <td class="px-6 py-4">
                        @if($k->status == 'pending')
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-gray-500/20 text-gray-400 border border-gray-500/30">Menunggu</span>
                        @elseif($k->status == 'setuju')
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-green-500/20 text-green-500 border border-green-500/30">Dicatat</span>
                        @else
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-red-500/20 text-red-500 border border-red-500/30">Ditolak</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex gap-2">
                            @if($k->status == 'pending')
                                <form action="{{ route('konseling.updateStatus', $k->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="setuju">
                                    <button class="bg-green-600 hover:bg-green-500 text-white px-3 py-1 rounded-md text-sm transition" title="Setujui/Catat">
                                        ✅
                                    </button>
                                </form>
                                <form action="{{ route('konseling.updateStatus', $k->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="tolak">
                                    <button class="bg-red-600 hover:bg-red-500 text-white px-3 py-1 rounded-md text-sm transition" title="Tolak">
                                        ❌
                                    </button>
                                </form>
                            @else
                                <span class="bg-gray-700 text-gray-400 px-3 py-1 rounded-md text-sm">Selesai</span>
                            @endif

                            <form action="{{ route('konseling.destroy', $k->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-500 text-white px-3 py-1 rounded-md text-sm transition" title="Hapus">
                                    🗑️
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-400">Belum ada data absensi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
