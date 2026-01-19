<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>BK App | SMK Antartika 1 Sidoarjo</title>

<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;600;700&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
:root {
    --bg-1: #0b0f2b;
    --bg-2: #1a1f4d;
    --card: #0f1335;
    --cyan: #22e7ff;
    --blue: #3b82f6;
    --text-soft: #c7d2fe;
    --border-glow: rgba(34,231,255,0.45);
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    min-height: 100vh;
    font-family: 'Inter', sans-serif;
    background: radial-gradient(circle at top, var(--bg-2), var(--bg-1));
    color: #fff;
}

/* ================= NAVBAR ================= */
nav {
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.logo-wrap {
    display: flex;
    align-items: center;
    gap: 14px;
}

.logo-wrap img {
    width: 75px;
    height: 75px;
    object-fit: cover;        /* biar isi penuh lingkaran */
    border-radius: 50%;       /* bikin BULAT */
    background: #0f1335;      /* aman kalau PNG transparan */
    padding: 4px;
    box-shadow:
        0 0 12px rgba(34,231,255,0.9),
        0 0 25px rgba(34,231,255,0.6);
}


.logo-wrap span {
    font-family: 'Orbitron', sans-serif;
    font-size: 1.9rem;
    letter-spacing: 2px;
    color: var(--cyan);
    text-shadow: 0 0 18px rgba(34,231,255,0.9);
}

/* ================= HERO ================= */
.hero {
    min-height: calc(100vh - 80px);
    display: grid;
    grid-template-columns: 1.1fr 0.9fr;
    gap: 80px;
    padding: 80px;
    align-items: center;
}

/* LEFT */
.hero-left span {
    display: inline-block;
    padding: 8px 22px;
    border-radius: 999px;
    border: 1px solid var(--border-glow);
    color: var(--cyan);
    font-size: 0.8rem;
    margin-bottom: 22px;
    box-shadow: 0 0 15px rgba(34,231,255,0.4);
}

.hero-left h1 {
    font-size: 3.1rem;
    line-height: 1.2;
    font-weight: 800;
    margin-bottom: 22px;
}

.hero-left h1 strong {
    color: var(--cyan);
    text-shadow: 0 0 20px rgba(34,231,255,0.8);
}

.hero-left p {
    color: var(--text-soft);
    line-height: 1.9;
    margin-bottom: 38px;
}

.hero-btns {
    display: flex;
    gap: 18px;
}

.btn-main {
    padding: 14px 38px;
    border-radius: 14px;
    background: linear-gradient(90deg, var(--cyan), var(--blue));
    color: #000;
    font-weight: 700;
    text-decoration: none;
    box-shadow: 0 0 28px rgba(34,231,255,0.9);
    transition: 0.3s;
}

.btn-main:hover {
    transform: translateY(-2px) scale(1.05);
    box-shadow: 0 0 45px rgba(34,231,255,1);
}

.btn-outline {
    padding: 14px 38px;
    border-radius: 14px;
    border: 1px solid var(--border-glow);
    color: var(--cyan);
    text-decoration: none;
    font-weight: 600;
    transition: 0.3s;
}

.btn-outline:hover {
    background: rgba(34,231,255,0.12);
    box-shadow: 0 0 30px rgba(34,231,255,0.6);
}

/* ================= CARD ================= */
.hero-card {
    background: linear-gradient(180deg, #0e133a, #0a0e2a);
    border-radius: 30px;
    padding: 40px;
    border: 2px solid var(--border-glow);
    box-shadow:
        0 0 30px rgba(34,231,255,0.45),
        inset 0 0 35px rgba(34,231,255,0.15);
}

.card-item {
    background: rgba(255,255,255,0.05);
    padding: 22px;
    border-radius: 18px;
    margin-bottom: 18px;
    border: 1px solid rgba(34,231,255,0.25);
}

.card-item h3 {
    color: var(--cyan);
    margin-bottom: 8px;
    font-size: 1.05rem;
}

.card-item p {
    font-size: 0.95rem;
    color: var(--text-soft);
    line-height: 1.6;
}

/* ================= RESPONSIVE ================= */
@media(max-width: 900px) {
    .hero {
        grid-template-columns: 1fr;
        padding: 40px 26px;
    }

    .hero-left h1 {
        font-size: 2.3rem;
    }
}
</style>
</head>

<body>

<nav>
    <div class="logo-wrap">
        <img src="{{ asset('images/antrek1.png') }}" alt="Logo SMK Antartika 1 Sidoarjo">
        <span>BK APP</span>
    </div>
</nav>

<section class="hero">

    <!-- LEFT -->
    <div class="hero-left">
        <span>SMK ANTARTIKA 1 SIDOARJO</span>

        <h1>
            Sistem Bimbingan Konseling <br>
            <strong>Modern & Terintegrasi</strong>
        </h1>

        <p>
            BK App adalah sistem bimbingan konseling digital
            yang dirancang untuk membantu siswa, guru BK,
            dan pihak sekolah dalam memantau, membimbing,
            serta menyelesaikan permasalahan siswa secara
            profesional, aman, dan terstruktur.
        </p>

        <div class="hero-btns">
            <a href="{{ route('login') }}" class="btn-main">Login</a>
            <a href="{{ route('register') }}" class="btn-outline">Daftar</a>
        </div>
    </div>

    <!-- RIGHT -->
    <div class="hero-card">

        <div class="card-item">
            <h3>🏫 Tentang Sekolah</h3>
            <p>
                SMK Antartika 1 Sidoarjo merupakan sekolah
                menengah kejuruan yang berfokus pada
                pendidikan vokasi, pembinaan karakter,
                dan kesiapan kerja di dunia industri.
            </p>
        </div>

        <div class="card-item">
            <h3>🧠 Apa Itu Bimbingan Konseling?</h3>
            <p>
                Bimbingan dan Konseling (BK) adalah layanan
                pendampingan siswa untuk membantu memahami
                diri, mengembangkan potensi, serta mengatasi
                masalah pribadi, sosial, dan akademik.
            </p>
        </div>

        <div class="card-item">
            <h3>📌 Jenis Layanan Konseling</h3>
            <p>
                Layanan BK meliputi konseling pribadi,
                sosial, belajar, dan karier guna membantu
                siswa berkembang secara mental, akademik,
                dan perencanaan masa depan.
            </p>
        </div>

        <div class="card-item">
            <h3>🎯 Tujuan Layanan BK</h3>
            <p>
                Membentuk siswa yang disiplin, bertanggung jawab,
                percaya diri, dan mampu mengambil keputusan
                yang tepat dalam kehidupan sekolah maupun masa depan.
            </p>
        </div>

    </div>
</section>

</body>
</html>
