<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Sistem Sekolah</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Orbitron', sans-serif;
      background: linear-gradient(270deg, #0f0c29, #302b63, #24243e);
      background-size: 600% 600%;
      animation: gradientBG 20s ease infinite;
      min-height: 100vh;
    }
    @keyframes gradientBG {
      0% {background-position:0% 50%;}
      50% {background-position:100% 50%;}
      100% {background-position:0% 50%;}
    }
    .glass-card {
      background: rgba(0,0,0,0.3);
      backdrop-filter: blur(15px);
      border: 2px solid #0ff;
      box-shadow: 0 0 40px #0ff;
      border-radius: 2rem;
    }
    input:focus, select:focus {
      outline: none;
      border-color: #0ff;
      box-shadow: 0 0 10px #0ff;
    }
    button {
      box-shadow: 0 0 10px #0ff, 0 0 20px #0ff;
      transition: 0.3s;
    }
    button:hover {
      transform: scale(1.05);
      box-shadow: 0 0 20px #0ff, 0 0 40px #0ff;
    }
  </style>
</head>
<body class="flex items-center justify-center">

  <div class="flex flex-col md:flex-row w-full max-w-4xl glass-card overflow-hidden">

    <!-- Bagian Logo (Kiri) -->
    <div class="w-full md:w-1/2 flex items-center justify-center bg-black bg-opacity-40 p-10">
     <img src="{{ asset('images/antrek1.png') }}"
     alt="Logo Sekolah"
     class="w-60 h-auto md:w-72 object-contain rounded-lg shadow-xl">

    </div>

    <!-- Bagian Form (Kanan) -->
    <div class="w-full md:w-1/2 p-10 flex flex-col justify-center text-white">
      <h2 class="text-4xl font-bold mb-2 text-cyan-400">Selamat Datang</h2>
      <p class="text-cyan-200 mb-6">Masukkan data login sesuai peran Anda di sistem</p>

      <!-- Error session -->
      @if(session('error'))
      <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-center font-medium">
        {{ session('error') }}
      </div>
      @endif

      <form action="{{ route('login.submit') }}" method="POST" class="space-y-5">
        @csrf

        
        <!-- Input Email -->
        <div class="relative">
          <input type="email" name="email" value="{{ old('email') }}" placeholder="Email"
            class="w-full rounded-lg px-4 py-3 bg-black bg-opacity-30 border border-cyan-500 placeholder-cyan-300 text-white transition">
          @error('email')
          <span class="text-red-500 text-sm">{{ $message }}</span>
          @enderror
        </div>

        <!-- Input Password -->
        <div class="relative">
          <input type="password" name="password" placeholder="Password"
            class="w-full rounded-lg px-4 py-3 bg-black bg-opacity-30 border border-cyan-500 placeholder-cyan-300 text-white transition">
          @error('password')
          <span class="text-red-500 text-sm">{{ $message }}</span>
          @enderror
        </div>

        <!-- Tombol Login -->
        <button type="submit"
          class="w-full py-3 rounded-xl font-semibold bg-gradient-to-r from-cyan-400 to-blue-500 text-white">
          Masuk
        </button>
      </form>

      <!-- Link Register -->
      <p class="text-center text-cyan-300 text-sm mt-6">
        Belum punya akun?
        <a href="{{ route('register') }}" class="text-cyan-400 font-medium hover:underline">Daftar</a>
      </p>

    </div>
   </div>
</body>
</html>
