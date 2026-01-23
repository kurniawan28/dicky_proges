<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - Sistem Sekolah</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Font -->
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
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .glass-card {
            background: rgba(0, 0, 0, 0.35);
            backdrop-filter: blur(15px);
            border: 2px solid #0ff;
            box-shadow: 0 0 40px rgba(0, 255, 255, 0.6);
            border-radius: 2rem;
        }

        input:focus {
            outline: none;
            border-color: #0ff;
            box-shadow: 0 0 12px #0ff;
        }

        button {
            box-shadow: 0 0 10px #0ff, 0 0 20px #0ff;
            transition: 0.3s ease;
        }

        button:hover {
            transform: scale(1.05);
            box-shadow: 0 0 25px #0ff, 0 0 50px #0ff;
        }
    </style>
</head>

<body class="flex items-center justify-center px-4">

    <div class="w-full max-w-md glass-card p-10 text-white">

        <h2 class="text-3xl font-bold text-cyan-400 mb-2 text-center">
            Lupa Password
        </h2>
        <p class="text-cyan-200 mb-6 text-center text-sm">
            Masukkan email Anda untuk menerima kode OTP reset password.
        </p>

        <!-- Status Message -->
        @if (session('status'))
            <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4 text-center font-medium text-sm">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Email -->
            <div>
                <input type="email"
                       name="email"
                       value="{{ old('email') }}"
                       placeholder="Email"
                       class="w-full px-4 py-3 rounded-lg bg-black/30 border border-cyan-500 placeholder-cyan-300 text-white transition"
                       required autofocus>
                @error('email')
                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Button -->
            <button type="submit"
                    class="w-full py-3 rounded-xl font-semibold bg-gradient-to-r from-cyan-400 to-blue-500">
                Kirim Kode OTP
            </button>
        </form>

        <!-- Back to Login -->
        <p class="text-center text-cyan-300 text-sm mt-6">
            Sudah ingat password?
            <a href="{{ route('login') }}"
               class="text-cyan-400 font-medium hover:underline">
                Login
            </a>
        </p>

    </div>

</body>
</html>
