<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Sekolah</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&display=swap" rel="stylesheet">
    <!-- Google ReCAPTCHA -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

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

    <div class="flex flex-col md:flex-row w-full max-w-4xl glass-card overflow-hidden">

        <!-- Logo Section -->
        <div class="w-full md:w-1/2 flex items-center justify-center bg-black/40 p-10">
            <img src="{{ asset('images/antrek1.png') }}"
                 alt="Logo Sekolah"
                 class="w-60 md:w-72 object-contain rounded-xl shadow-2xl">
        </div>

        <!-- Form Section -->
        <div class="w-full md:w-1/2 p-10 flex flex-col justify-center text-white">

            <h2 class="text-4xl font-bold text-cyan-400 mb-2">
                Selamat Datang
            </h2>
            <p class="text-cyan-200 mb-6">
                Silakan login sesuai peran Anda
            </p>

            <!-- Error Session -->
            @if(session('error'))
                <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4 text-center font-medium">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Success Session -->
            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4 text-center font-medium">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('login.submit') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Email -->
                <div>
                    <input type="email"
                           name="email"
                           value="{{ old('email') }}"
                           placeholder="Email"
                           class="w-full px-4 py-3 rounded-lg bg-black/30 border border-cyan-500 placeholder-cyan-300 text-white transition"
                           autocomplete="off">
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <input type="password"
                           name="password"
                           placeholder="Password"
                           class="w-full px-4 py-3 rounded-lg bg-black/30 border border-cyan-500 placeholder-cyan-300 text-white transition"
                           autocomplete="off">
                    <div class="flex justify-end mt-1">
                        <a href="{{ route('password.request') }}" class="text-cyan-400 text-xs hover:underline">
                            Lupa password?
                        </a>
                    </div>
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- ReCAPTCHA -->
                <div class="flex justify-center my-4">
                    <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                    @error('g-recaptcha-response')
                        <span class="text-red-500 text-sm block text-center mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Button -->
                <button type="submit"
                        class="w-full py-3 rounded-xl font-semibold bg-gradient-to-r from-cyan-400 to-blue-500">
                    Masuk
                </button>
            </form>

            <!-- Register -->
            <p class="text-center text-cyan-300 text-sm mt-6">
                Belum punya akun?
                <a href="{{ route('register') }}"
                   class="text-cyan-400 font-medium hover:underline">
                    Daftar
                </a>
            </p>

        </div>
    </div>

</body>
</html>
