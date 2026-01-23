<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Kiri -->
    <div class="space-y-4">

        <!-- No Absen (hanya angka) -->
        <div>
            <label class="block text-gray-300 font-semibold">No Absen</label>
            <input 
                type="text"
                name="no_absen"
                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                value="{{ old('no_absen', $siswa->no_absen ?? '') }}"
                class="w-full rounded-lg px-3 py-2 bg-gray-800 text-gray-200 
                       border border-gray-600 focus:border-cyan-500 
                       focus:ring-1 focus:ring-cyan-500 outline-none transition">
            @error('no_absen')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- NIS -->
        <div>
            <label class="block text-gray-300 font-semibold">NIS</label>
            <input 
                type="text"
                name="nis"
                maxlength="10"
                oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10)"
                value="{{ old('nis', $siswa->nis ?? '') }}"
                class="w-full rounded-lg px-3 py-2 bg-gray-800 text-gray-200 
                       border border-gray-600 focus:border-cyan-500 
                       focus:ring-1 focus:ring-cyan-500 outline-none transition">
            @error('nis')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Nama Lengkap -->
        <div>
            <label class="block text-gray-300 font-semibold">Nama Lengkap</label>
            <input type="text" name="nama_lengkap" 
                value="{{ old('nama_lengkap', $siswa->nama_lengkap ?? '') }}"
                class="w-full rounded-lg px-3 py-2 bg-gray-800 text-gray-200 
                       border border-gray-600 focus:border-cyan-500 
                       focus:ring-1 focus:ring-cyan-500 outline-none transition">
            @error('nama_lengkap')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Jenis Kelamin -->
        <div>
            <label class="block text-gray-300 font-semibold">Jenis Kelamin</label>
            <select name="jenis_kelamin"
                class="w-full rounded-lg px-3 py-2 bg-gray-800 text-gray-200 
                       border border-gray-600 focus:border-cyan-500 
                       focus:ring-1 focus:ring-cyan-500 outline-none transition">
                <option value="L" {{ old('jenis_kelamin', $siswa->jenis_kelamin ?? '') == 'L' ? 'selected' : '' }}>Laki-Laki</option>
                <option value="P" {{ old('jenis_kelamin', $siswa->jenis_kelamin ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
            </select>
            @error('jenis_kelamin')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Kelas -->
        <div>
            <label class="block text-gray-300 font-semibold">Kelas</label>
            <input type="text" name="kelas"
                value="{{ old('kelas', $siswa->kelas ?? '') }}"
                class="w-full rounded-lg px-3 py-2 bg-gray-800 text-gray-200 
                       border border-gray-600 focus:border-cyan-500 
                       focus:ring-1 focus:ring-cyan-500 outline-none transition">
            @error('kelas')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Jurusan -->
        <div>
            <label class="block text-gray-300 font-semibold">Jurusan</label>
            <input type="text" name="jurusan"
                value="{{ old('jurusan', $siswa->jurusan ?? '') }}"
                class="w-full rounded-lg px-3 py-2 bg-gray-800 text-gray-200 
                       border border-gray-600 focus:border-cyan-500 
                       focus:ring-1 focus:ring-cyan-500 outline-none transition">
            @error('jurusan')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>
    </div>

    <!-- Kanan -->
    <div class="space-y-4">

        <!-- Tanggal Lahir -->
        <div>
            <label class="block text-gray-300 font-semibold">Tanggal Lahir</label>
            <input type="text" name="tanggal_lahir"
                placeholder="YYYY-MM-DD (Contoh: 2006-05-20)"
                value="{{ old('tanggal_lahir', $siswa->tanggal_lahir ?? '') }}"
                class="w-full rounded-lg px-3 py-2 bg-gray-800 text-gray-200 
                       border border-gray-600 focus:border-cyan-500 
                       focus:ring-1 focus:ring-cyan-500 outline-none transition">
            @error('tanggal_lahir')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Alamat -->
        <div>
            <label class="block text-gray-300 font-semibold">Alamat</label>
            <textarea name="alamat"
                class="w-full rounded-lg px-3 py-2 bg-gray-800 text-gray-200 
                       border border-gray-600 focus:border-cyan-500 
                       focus:ring-1 focus:ring-cyan-500 outline-none transition">{{ old('alamat', $siswa->alamat ?? '') }}</textarea>
            @error('alamat')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Nomor HP (angka + + - spasi) -->
        <div>
            <label class="block text-gray-300 font-semibold">No HP</label>
            <input 
                type="text"
                name="no_hp"
                maxlength="15"
                oninput="this.value = this.value.replace(/[^0-9+\-\s]/g, '').slice(0, 15)"
                value="{{ old('no_hp', $siswa->no_hp ?? '') }}"
                class="w-full rounded-lg px-3 py-2 bg-gray-800 text-gray-200 
                       border border-gray-600 focus:border-cyan-500 
                       focus:ring-1 focus:ring-cyan-500 outline-none transition">
            @error('no_hp')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

    </div>
</div>
