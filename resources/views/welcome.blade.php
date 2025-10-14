<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Selamat Datang - BK</title>
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&display=swap" rel="stylesheet">
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: 'Orbitron', sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background: linear-gradient(270deg, #0f0c29, #302b63, #24243e);
        background-size: 600% 600%;
        animation: gradientBG 20s ease infinite;
    }

    @keyframes gradientBG {
        0% {background-position:0% 50%;}
        50% {background-position:100% 50%;}
        100% {background-position:0% 50%;}
    }

    .card {
        background: rgba(0,0,0,0.3);
        border: 4px solid rgba(0, 255, 255, 0.6);
        backdrop-filter: blur(20px);
        padding: 3rem 2rem;
        border-radius: 2rem;
        max-width: 450px;
        width: 90%;
        text-align: center;
        box-shadow: 0 0 40px rgba(0,255,255,0.3);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 0 60px rgba(0,255,255,0.5);
    }

    .icon {
        width: 100px;
        margin-bottom: 1rem;
        animation: spinGlow 4s linear infinite;
    }

    @keyframes spinGlow {
        0% { transform: rotate(0deg); filter: drop-shadow(0 0 10px #00fff7);}
        50% { transform: rotate(0deg); filter: drop-shadow(0 0 20px #00bcd4);}
        100% { transform: rotate(0deg); filter: drop-shadow(0 0 10px #00fff7);}
    }

    h1 {
        font-size: 2rem;
        color: #00fff7;
        text-shadow: 0 0 10px #00fff7, 0 0 20px #00fff7;
        margin-bottom: 0.5rem;
    }

    p {
        color: #a0f0ff;
        margin-bottom: 2rem;
    }

    .btn {
        padding: 0.8rem 2rem;
        margin: 0.5rem;
        border-radius: 1rem;
        font-weight: 500;
        text-decoration: none;
        color: #fff;
        display: inline-block;
        transition: 0.3s ease;
        box-shadow: 0 0 10px rgba(0,255,255,0.5);
        border: 1px solid rgba(0,255,255,0.7);
    }

    .btn-login {
        background: linear-gradient(45deg, #00fff7, #00bcd4);
    }

    .btn-login:hover {
        box-shadow: 0 0 20px #00fff7, 0 0 40px #00bcd4;
        transform: scale(1.1);
    }

    .btn-register {
        background: linear-gradient(45deg, #ff00ff, #ff007f);
        box-shadow: 0 0 10px rgba(255,0,255,0.5);
        border: 1px solid rgba(255,0,255,0.7);
    }

    .btn-register:hover {
        box-shadow: 0 0 20px #ff00ff, 0 0 40px #ff007f;
        transform: scale(1.1);
    }

    .footer {
        margin-top: 1.5rem;
        font-size: 0.8rem;
        color: #0ff;
    }

    @media(max-width:480px){
        h1{font-size:1.5rem;}
        .card{padding:2rem;}
        .icon{width:80px;}
    }
</style>
</head>
<body>

<div class="card">
    <!-- Icon futuristik baru -->
    <img src="https://cdn-icons-png.flaticon.com/512/906/906334.png" alt="BK Icon" class="icon">
    <h1>Selamat Datang di BK App</h1>
    <p>Pantau pelanggaran dan perkembangan siswa dengan mudah dan cepat</p>
    <div>
        <a href="{{ route('login') }}" class="btn btn-login">Login</a>
        <a href="{{ route('register') }}" class="btn btn-register">Register</a>
    </div>
    <div class="footer">© 2025 BK App. Semua hak cipta dilindungi.</div>
</div>

</body>
</html>
