@extends('layouts.app')

@section('content')
<main class="min-h-screen pt-32 px-6 md:px-10 lg:px-20 space-y-16
             bg-cover bg-center relative"
      style="background-image: linear-gradient(to top, rgba(10,18,29,0.8), rgba(48, 63, 85, 0.52)), url('{{ asset('OIP.webp') }}');">

    <!-- Navbar Fixed -->
    <nav class="fixed top-0 left-0 right-0 h-20 bg-slate-900/80 backdrop-blur-md
                border-b border-slate-700 px-6 md:px-10 flex justify-between items-center z-50">
        
        <a href="{{ route('dashboard') }}" 
           class="text-2xl font-extrabold text-white flex items-center gap-2 hover:text-red-400 transition-all">
            🏫 Sistem BK Sekolah
        </a>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" 
                class="logout-btn text-white font-semibold py-2 px-6 rounded-lg
                       bg-gradient-to-r from-red-700 to-red-900
                       hover:shadow-red-600/50 hover:shadow-lg hover:scale-105 transition-all">
                Logout
            </button>
        </form>
    </nav>

    <!-- Judul Halaman -->
    <div class="text-center space-y-4 mt-6">
        <h2 class="text-4xl md:text-5xl font-extrabold text-red-400 tracking-tight drop-shadow-xl animate-pulse">
            📜 Visi & Misi SMK Antartika 1 Sidoarjo
        </h2>
        <p class="text-red-200 text-lg md:text-xl font-medium">
            Mewujudkan peserta didik yang ber-IMTAQ dan kompeten di bidang IPTEK
        </p>
    </div>

    <!-- Card Visi -->
    <section class="card max-w-3xl mx-auto p-8 md:p-10 hover:scale-105 hover:rotate-1 transition-transform">
        <h3 class="text-2xl md:text-3xl font-bold mb-4 text-red-300 flex items-center gap-3">
            ✨ Visi
        </h3>
        <p class="text-gray-200 text-lg md:text-xl leading-relaxed">
            Terwujudnya peserta didik SMK Antartika 1 Sidoarjo yang ber-IMTAQ dan 
            memiliki kompetensi di bidang IPTEK.
        </p>
    </section>

    <!-- Card Misi -->
    <section class="card max-w-3xl mx-auto p-8 md:p-10 hover:scale-105 hover:-rotate-1 transition-transform">
        <h3 class="text-2xl md:text-3xl font-bold mb-4 text-red-300 flex items-center gap-3">
            🎯 Misi
        </h3>
        <ul class="list-decimal list-inside text-gray-200 space-y-3 text-lg md:text-xl leading-relaxed">
            <li>Menyiapkan peserta didik yang beriman dan bertaqwa.</li>
            <li>Menyiapkan peserta didik unggul dalam IPTEK.</li>
            <li>Menyiapkan tenaga terampil yang berkompeten di dunia usaha dan dunia industri.</li>
            <li>Mengembangkan potensi sekolah di tingkat nasional dan internasional.</li>
        </ul>
    </section>

    <!-- Card 5S -->
    <section class="card max-w-3xl mx-auto p-8 md:p-10 hover:scale-105 hover:rotate-2 transition-transform">
        <h3 class="text-2xl md:text-3xl font-bold mb-4 text-red-300 flex items-center gap-3">
            🖐️ 5S
        </h3>
        <ul class="list-decimal list-inside text-gray-200 space-y-2 text-lg md:text-xl leading-relaxed">
            <li>Senyum</li>
            <li>Salam</li>
            <li>Sapa</li>
            <li>Sopan</li>
            <li>Santun</li>
        </ul>
    </section>

</main>

<!-- Styles -->
<style>
.card {
    background: rgba(20, 32, 44, 0.9);
    border-radius: 1.25rem;
    border: 1px solid rgba(255, 255, 255, 0.12);
    backdrop-filter: blur(18px);
    box-shadow: 0 0 35px rgba(255, 0, 100, 0.25);
    transition: all 0.4s ease;
}
.card:hover {
    box-shadow: 0 0 55px rgba(255, 0, 100, 0.45);
    transform: translateY(-6px) scale(1.03) rotate(1deg);
}
.logout-btn {
    transition: all 0.3s ease;
}
.logout-btn:hover {
    transform: translateY(-2px) scale(1.05);
}
</style>
@endsection
