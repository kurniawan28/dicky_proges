<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register BK</title>
  <style>
    body {
      font-family: 'Arial', sans-serif;
      background: #0f172a;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .container {
      display: flex;
      background: #0f172a;
      border-radius: 20px;
      padding: 40px;
      box-shadow: 0 0 30px rgba(0, 255, 255, 0.6);
      width: 700px;
      max-width: 95%;
      justify-content: space-between;
      align-items: center;
    }
    .left {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .left img { max-width: 350px; }
    .right {
      flex: 1;
      color: #38bdf8;
      padding-left: 15px;
    }
    h1 { font-size: 2rem; margin-bottom: 5px; color: #38bdf8; }
    p { margin-bottom: 5px; color: #94a3b8; }
    input[type="text"], input[type="email"], input[type="password"] {
      width: 100%;
      height: 45px;
      padding: 10px 12px;
      margin-bottom: 15px;
      border-radius: 8px;
      border: none;
      outline: none;
      background: #1e293b;
      color: #f1f5f9;
      font-size: 14px;
      box-sizing: border-box;
      transition: 0.3s;
    }
    input::placeholder { color: #94a3b8; }
    input:focus {
      background: #0f172a;
      border: 1px solid #3b82f6;
      box-shadow: 0 0 8px rgba(59, 130, 246, 0.7);
    }
    .btn {
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 5px;
      background: linear-gradient(to right, #06b6d4, #3b82f6);
      color: white;
      font-weight: bold;
      cursor: pointer;
      box-shadow: 0 0 5px rgba(59, 130, 246, 0.7);
      transition: 0.3s;
    }
    .btn:hover {
      background: linear-gradient(to right, #3b82f6, #06b6d4);
    }
    .footer-text {
      text-align: center;
      margin-top: 20px;
      color: #94a3b8;
    }
    .footer-text a { color: #38bdf8; text-decoration: none; }
    .footer-text a:hover { text-decoration: underline; }
  </style>
</head>
<body>
  <div class="container">
    <div class="left">
      <img src="{{ asset('images/antrek1.png') }}" alt="Logo Sekolah" class="w-50 h-50 rounded-full shadow-xl">
    </div>
    <div class="right">
      <h1>Daftar Akun</h1>
      <p>Silakan isi data Anda untuk membuat akun baru</p>
      <form action="{{ route('register.submit') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Nama Lengkap" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
        <button type="submit" class="btn">Register</button>
      </form>
      <div class="footer-text">
        Sudah punya akun? <a href="{{ route('login') }}">Login</a>
      </div>
    </div>
  </div>
</body>
</html>
