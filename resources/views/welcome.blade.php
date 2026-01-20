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

    --container: 1280px;
    --side-gap: 56px;
    --nav-h: 96px;
}

/* RESET */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* LOCK VIEWPORT */
html, body {
    width: 100%;
    height: 100%;
    overflow: hidden;
}

/* BODY */
body {
    font-family: 'Inter', sans-serif;
    background: radial-gradient(circle at top, var(--bg-2), var(--bg-1));
    color: #fff;
}

/* CONTAINER */
.container {
    width: 100%;
    max-width: var(--container);
    margin: 0 auto;
    padding: 0 var(--side-gap);
}

/* ================= NAVBAR ================= */
nav {
    height: var(--nav-h);
    display: flex;
    align-items: center;
}

/* LOGO WRAP */
.logo-wrap {
    display: flex;
    align-items: center;
    gap: 18px;

    /* turunkan secara OPTIKAL, bukan struktural */
    transform: translateY(60px);
}

/* LOGO */
.logo-wrap img {
    width: 64px;
    height: 64px;
    border-radius: 50%;
    object-fit: cover;
    padding: 6px;
    background: var(--card);
    box-shadow:
        0 0 14px rgba(34,231,255,0.85),
        0 0 26px rgba(34,231,255,0.6);
}

/* TEKS LOGO */
.logo-wrap span {
    line-height: 1;        /* biar teks tidak "naik" */
    display: flex;
    align-items: center;
}


/* LOGO TEXT */
.logo-wrap span {
    font-family: 'Orbitron', sans-serif;
    font-size: 1.9rem;
    letter-spacing: 2px;
    color: var(--cyan);
    text-shadow: 0 0 18px rgba(34,231,255,0.85);
}

/* ================= HERO ================= */
.hero {
    height: calc(100vh - var(--nav-h));
    display: grid;
    grid-template-columns: 1.15fr 0.85fr;
    align-items: center;
    gap: 64px;
}

/* LEFT */
.hero-left span {
    display: inline-block;
    padding: 8px 22px;
    border-radius: 999px;
    border: 1px solid var(--border-glow);
    color: var(--cyan);
    font-size: 0.78rem;
    margin-bottom: 18px;
}

.hero-left h1 {
    font-size: 2.9rem;
    line-height: 1.15;
    font-weight: 800;
    margin-bottom: 18px;
}

.hero-left h1 strong {
    color: var(--cyan);
    text-shadow: 0 0 20px rgba(34,231,255,0.8);
}

.hero-left p {
    color: var(--text-soft);
    line-height: 1.75;
    margin-bottom: 30px;
    max-width: 92%;
}

.hero-btns {
    display: flex;
    gap: 16px;
}

/* BUTTONS */
.btn-main,
.btn-outline {
    padding: 13px 36px;
    border-radius: 14px;
    font-weight: 700;
    text-decoration: none;
    transition: 0.25s ease;
}

.btn-main {
    background: linear-gradient(90deg, var(--cyan), var(--blue));
    color: #000;
    box-shadow: 0 0 26px rgba(34,231,255,0.9);
}

.btn-main:hover {
    transform: translateY(-2px);
}

.btn-outline {
    border: 1px solid var(--border-glow);
    color: var(--cyan);
}

.btn-outline:hover {
    background: rgba(34,231,255,0.12);
}

/* ================= CARD ================= */
.hero-card {
    background: linear-gradient(180deg, #0e133a, #0a0e2a);
    border-radius: 26px;
    padding: 28px;
    border: 2px solid var(--border-glow);
    box-shadow:
        0 0 26px rgba(34,231,255,0.45),
        inset 0 0 28px rgba(34,231,255,0.15);
}

.card-item {
    padding: 16px 18px;
    border-radius: 16px;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(34,231,255,0.25);
}

.card-item:not(:last-child) {
    margin-bottom: 14px;
}

.card-item h3 {
    color: var(--cyan);
    font-size: 0.98rem;
    margin-bottom: 6px;
}

.card-item p {
    font-size: 0.9rem;
    line-height: 1.5;
    color: var(--text-soft);
}

/* ================= MOBILE ================= */
@media (max-width: 900px) {
    html, body {
        overflow: auto;
    }

    .hero {
        grid-template-columns: 1fr;
        height: auto;
        padding-bottom: 40px;
    }
}
</style>
</head>

<body>

<nav>
    <div class="container">
        <div class="logo-wrap">
            <img src="{{ asset('images/antrek1.png') }}" alt="Logo SMK Antartika 1 Sidoarjo">
            <span>BK APP</span>
        </div>
    </div>
</nav>

<section class="container hero">

    <!-- LEFT -->
    <div class="hero-left">
        <span>SMK ANTARTIKA 1 SIDOARJO</span>

        <h1>
            Sistem Bimbingan Konseling<br>
            <strong>Modern & Terintegrasi</strong>
        </h1>

        <p>
            BK App adalah sistem bimbingan konseling digital
            yang membantu siswa dan guru BK dalam proses
            pendampingan, pembinaan, dan penyelesaian
            permasalahan siswa secara profesional.
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
            <p>SMK Antartika 1 Sidoarjo berfokus pada pendidikan vokasi dan karakter.</p>
        </div>

        <div class="card-item">
            <h3>🧠 Bimbingan Konseling</h3>
            <p>Layanan pendampingan siswa dalam aspek pribadi, sosial, dan akademik.</p>
        </div>

        <div class="card-item">
            <h3>📌 Jenis Layanan</h3>
            <p>Konseling pribadi, sosial, belajar, dan perencanaan karier.</p>
        </div>

        <div class="card-item">
            <h3>🎯 Tujuan BK</h3>
            <p>Membentuk siswa disiplin, percaya diri, dan bertanggung jawab.</p>
        </div>

    </div>
</section>

</body>
</html>
