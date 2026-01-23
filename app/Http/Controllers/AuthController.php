<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\User;

class AuthController extends Controller
{
    // 🟦 Tampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // 🟦 Proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'g-recaptcha-response' => ['required']
        ], [
            'g-recaptcha-response.required' => 'Silakan centang verifikasi "Saya bukan robot" (ReCAPTCHA).'
        ]);

        // Verify Checkbox ReCAPTCHA
        $recaptchaSecret = env('RECAPTCHA_SECRET_KEY');
        $recaptchaResponse = $request->input('g-recaptcha-response');
        
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = [
            'secret' => $recaptchaSecret,
            'response' => $recaptchaResponse
        ];
        
        $options = [
            'http' => [
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            ]
        ];
        
        $context  = stream_context_create($options);
        $verify = file_get_contents($url, false, $context);
        $captchaSuccess = json_decode($verify);
        
        if (!$captchaSuccess->success) {
             return back()->withErrors(['g-recaptcha-response' => 'Verifikasi ReCAPTCHA gagal. Silakan coba lagi.']);
        }

        // Hapus field recaptcha sebelum attempt login (karena tidak ada di tabel user)
        unset($credentials['g-recaptcha-response']);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.'
        ])->onlyInput('email');
    }

    // 🟦 Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    // 🟦 Tampilkan form register
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    

    // 🟦 Proses register (langsung login)
    // 🟦 Proses register (langsung login)
public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email'=> 'required|email|unique:users,email',
        'password'=> 'required|string|min:6|confirmed'
    ]);

    // Default role = SISWA
    $user = User::create([
        'name'=> $request->name,
        'email'=> $request->email,
        'role'=> 'SISWA',  // jangan beri pilihan admin di register publik
        'password'=> Hash::make($request->password)
    ]);

    // 🔥 Langsung login setelah register
    Auth::login($user);

    // 🔁 Redirect ke dashboard sesuai role
    return redirect()->route('dashboard')->with('success', 'Akun berhasil dibuat dan Anda sudah login!');
}

    // 🟦 Tampilkan form lupa password
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    // 🟦 Proses kirim OTP ke email
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $email = $request->email;
        $otp = rand(100000, 999999);

        // Simpan OTP ke tabel password_reset_tokens
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $email],
            [
                'token' => $otp, // Kita simpan OTP di kolom token
                'created_at' => now()
            ]
        );

        // Kirim email OTP
        Mail::send([], [], function ($message) use ($email, $otp) {
            $message->to($email)
                ->subject('Kode OTP Reset Password')
                ->html("<h3>Kode OTP Anda adalah: <b>$otp</b></h3><p>Kode ini berlaku untuk 60 menit.</p>");
        });

        return redirect()->route('password.otp.form', ['email' => $email])
            ->with('status', 'Kode OTP telah dikirim ke email Anda.');
    }

    // 🟦 Tampilkan form verifikasi OTP & password baru
    public function showVerifyOtpForm(Request $request)
    {
        return view('auth.verify-otp', ['email' => $request->email]);
    }

    // 🟦 Proses verifikasi OTP & update password
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|numeric',
            'password' => 'required|min:6|confirmed',
        ]);

        $record = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->otp)
            ->first();

        if (!$record || now()->subMinutes(60)->gt($record->created_at)) {
            return back()->withErrors(['otp' => 'Kode OTP salah atau sudah kadaluarsa.']);
        }

        // Update password user
        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        // Hapus token setelah digunakan
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('success', 'Password berhasil direset. Silakan login kembali.');
    }
}
