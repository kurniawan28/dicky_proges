<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi BK</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Tambahkan CSS kustom untuk warna latar belakang yang spesifik */
        .bg-navy-dark {
            background-color: #1A2138; /* Warna Biru Navy Gelap */
        }
    </style>
</head>
<body class="bg-navy-dark min-h-screen"> 

    <div class="flex">

        {{-- @include('layouts.sidebar') --}} 

        <main class="w-full"> 
            @yield('content')
        </main>

    </div>

</body>
</html>