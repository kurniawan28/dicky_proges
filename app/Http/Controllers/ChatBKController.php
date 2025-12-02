<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatBKController extends Controller
{
    public function index()
    {
        $role = auth()->user()->role ?? 'SISWA';
        return view('chatbk.index', compact('role'));
    }

    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        try {
            // Kirim request ke GROQ API
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('GROQ_API_KEY'),
                'Content-Type' => 'application/json',
            ])->post(env('GROQ_BASE_URL'), [
                'model' => 'llama-3.1-8b-instant',
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => "Kamu adalah AI Bimbingan Konseling yang ramah, sopan, dan membantu siswa.

Pesan siswa:
{$request->message}"
                    ]
                ]
            ]);

            $data = $response->json();

            // Ambil balasan AI
            $aiReply = $data['choices'][0]['message']['content'] ?? 'AI tidak merespon.';

            return response()->json([
                'message' => $aiReply
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
