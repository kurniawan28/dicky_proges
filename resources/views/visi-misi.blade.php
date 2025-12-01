@extends('layouts.app')

@section('content')
<main class="flex-1 pt-32 px-6 md:px-10 lg:px-20 space-y-10 bg-gradient-to-tr from-[#0a121d] via-[#151f2b] to-[#1f2a39] min-h-screen">

   <!-- Navbar Fixed -->
<nav class="fixed top-0 left-0 right-0 h-20 bg-slate-900/80 backdrop-blur-md border-b border-slate-700 p-4 flex justify-between items-center px-6 z-50">
    <a href="{{ route('dashboard') }}" class="text-xl font-semibold text-white flex items-center gap-2">
        🏫 Sistem BK Sekolah
    </a>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="logout-btn text-white font-semibold py-2 px-5 rounded-lg bg-gradient-to-r from-red-700 to-red-900 hover:shadow-lg hover:scale-105 transition-all">
            Logout
        </button>
    </form>
</nav>

<!-- Konten utama -->
<main class="flex-1 px-6 md:px-10 lg:px-20 space-y-10 min-h-screen mt-24">

    <!-- Judul Halaman -->
    <div class="text-center space-y-2">
        <h2 class="text-4xl md:text-5xl font-bold text-red-400 tracking-tight">
            📜 Visi & Misi SMK Antartika 1 Sidoarjo
        </h2>
        <p class="text-red-200 text-lg md:text-xl">
            Mewujudkan peserta didik yang ber-IMTAQ dan kompeten di bidang IPTEK
        </p>
    </div>

    <!-- Card Visi -->
    <section class="card max-w-3xl mx-auto p-6 md:p-8 bg-[#14202c]/80 rounded-2xl shadow-xl hover:shadow-2xl transition-all">
        <h3 class="text-2xl font-bold mb-4 text-red-300 flex items-center gap-2">
            ✨ Visi
        </h3>
        <p class="text-gray-200 text-lg leading-relaxed">
            Terwujudnya peserta didik SMK Antartika 1 Sidoarjo yang ber-IMTAQ dan memiliki kompetensi di bidang IPTEK.
        </p>
    </section>

    <!-- Card Misi -->
    <section class="card max-w-3xl mx-auto p-6 md:p-8 bg-[#14202c]/80 rounded-2xl shadow-xl hover:shadow-2xl transition-all">
        <h3 class="text-2xl font-bold mb-4 text-red-300 flex items-center gap-2">
            🎯 Misi
        </h3>
        <ul class="list-decimal list-inside text-gray-200 space-y-2 text-lg leading-relaxed">
            <li>Menyiapkan peserta didik yang beriman dan bertaqwa.</li>
            <li>Menyiapkan peserta didik unggul dalam IPTEK.</li>
            <li>Menyiapkan tenaga terampil yang berkompeten di dunia usaha dan dunia industri.</li>
            <li>Mengembangkan potensi sekolah di tingkat nasional dan internasional.</li>
        </ul>
    </section>

</main>

<!-- Styles -->
<style>
.card {
    background: rgba(20, 32, 44, 0.85); /* lebih gelap */
    border-radius: 1rem;
    border: 1px solid rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(12px);
    box-shadow: 0 0 30px rgba(63, 193, 201, 0.25);
    transition: all 0.4s ease;
}
.card:hover {
    box-shadow: 0 0 45px rgba(63, 193, 201, 0.6);
    transform: translateY(-3px) scale(1.02);
}
.logout-btn {
    transition: all 0.3s ease;
}
.logout-btn:hover {
    transform: translateY(-2px) scale(1.05);
}
</style>
@endsection
