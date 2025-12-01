<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    <!-- Kolom Kiri -->
    <div class="space-y-4">
        @foreach([
            'nis' => 'NIS',
            'nisn' => 'NISN',
            'nama_lengkap' => 'Nama Lengkap',
            'kelas' => 'Kelas',
            'jurusan' => 'Jurusan'
        ] as $field => $label)
        <div>
            <label class="block text-gray-300 font-semibold">{{ $label }}</label>
            <input 
                type="text" 
                name="{{ $field }}" 
                class="w-full rounded-lg px-3 py-2 bg-gray-800 text-gray-200 border border-gray-600 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 outline-none transition" 
                value="{{ old($field, $siswa->$field ?? '') }}"
            >
            @error($field)
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        @endforeach

        <div>
            <label class="block text-gray-300 font-semibold">Jenis Kelamin</label>
            <select 
                name="jenis_kelamin" 
                class="w-full rounded-lg px-3 py-2 bg-gray-800 text-gray-200 border border-gray-600 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 outline-none transition"
            >
                <option value="L" {{ old('jenis_kelamin', $siswa->jenis_kelamin ?? '') == 'L' ? 'selected' : '' }}>Laki-Laki</option>
                <option value="P" {{ old('jenis_kelamin', $siswa->jenis_kelamin ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
            </select>
            @error('jenis_kelamin')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <!-- Kolom Kanan -->
    <div class="space-y-4">
        @foreach([
            'tanggal_lahir' => 'Tanggal Lahir',
            'alamat' => 'Alamat',
            'no_hp' => 'Nomor HP'
        ] as $field => $label)
        <div>
            <label class="block text-gray-300 font-semibold">{{ $label }}</label>
            @if($field == 'alamat')
                <textarea 
                    name="{{ $field }}" 
                    class="w-full rounded-lg px-3 py-2 bg-gray-800 text-gray-200 border border-gray-600 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 outline-none transition"
                >{{ old($field, $siswa->$field ?? '') }}</textarea>
            @elseif($field == 'tanggal_lahir')
                <input 
                    type="date" 
                    name="{{ $field }}" 
                    class="w-full rounded-lg px-3 py-2 bg-gray-800 text-gray-200 border border-gray-600 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 outline-none transition"
                    value="{{ old($field, $siswa->$field ?? '') }}"
                >
            @else
                <input 
                    type="text" 
                    name="{{ $field }}" 
                    class="w-full rounded-lg px-3 py-2 bg-gray-800 text-gray-200 border border-gray-600 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 outline-none transition"
                    value="{{ old($field, $siswa->$field ?? '') }}"
                >
            @endif
            @error($field)
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        @endforeach
    </div>
</div>
