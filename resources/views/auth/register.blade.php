<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Sistem Sekolah</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font -->
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
            background: rgba(0,0,0,0.35);
            backdrop-filter: blur(15px);
            border: 2px solid #0ff;
            box-shadow: 0 0 40px rgba(0,255,255,0.6);
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

    <div class="flex flex-col md:flex-row w-full max-w-4xl glass-card overflow-hidden">

        <!-- Logo (SAMA DENGAN LOGIN) -->
        <div class="w-full md:w-1/2 flex items-center justify-center bg-black/40 p-10">
            <img src="{{ asset('images/antrek1.png') }}"
                 alt="Logo Sekolah"
                 class="w-60 md:w-72 object-contain rounded-xl shadow-2xl">
        </div>

        <!-- Form Register -->
        <div class="w-full md:w-1/2 p-10 flex flex-col justify-center text-white">

            <h2 class="text-4xl font-bold text-cyan-400 mb-2">
                Daftar Akun
            </h2>
            <p class="text-cyan-200 mb-6">
                Isi data berikut untuk membuat akun baru
            </p>

            <form action="{{ route('register.submit') }}" method="POST" class="space-y-5">
                @csrf

                <input type="text"
                       name="name"
                       placeholder="Nama Lengkap"
                       class="w-full px-4 py-3 rounded-lg bg-black/30 border border-cyan-500 placeholder-cyan-300 text-white transition"
                       required autocomplete="off">

                <input type="email"
                       name="email"
                       placeholder="Email"
                       class="w-full px-4 py-3 rounded-lg bg-black/30 border border-cyan-500 placeholder-cyan-300 text-white transition"
                       required autocomplete="off">

                <input type="password"
                       name="password"
                       placeholder="Password"
                       class="w-full px-4 py-3 rounded-lg bg-black/30 border border-cyan-500 placeholder-cyan-300 text-white transition"
                       required autocomplete="off">

                <input type="password"
                       name="password_confirmation"
                       placeholder="Konfirmasi Password"
                       class="w-full px-4 py-3 rounded-lg bg-black/30 border border-cyan-500 placeholder-cyan-300 text-white transition"
                       required autocomplete="off">

                <button type="submit"
                        class="w-full py-3 rounded-xl font-semibold bg-gradient-to-r from-cyan-400 to-blue-500">
                    Register
                </button>
            </form>

            <p class="text-center text-cyan-300 text-sm mt-6">
                Sudah punya akun?
                <a href="{{ route('login') }}"
                   class="text-cyan-400 font-medium hover:underline">
                    Login
                </a>
            </p>

        </div>
    </div>

</body>
</html>
