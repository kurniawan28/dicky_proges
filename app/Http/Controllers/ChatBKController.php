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

        $apiKey = config('services.groq.key');
        if (!$apiKey || $apiKey === 'gsk_your_key_here') {
             return response()->json([
                'message' => 'Maaf, fitur ini belum bisa digunakan karena Kunci API (API Key) belum dikonfigurasi. Mohon hubungi admin untuk menambahkan GROQ_API_KEY di file .env.'
            ], 500);
        }

        try {
            // Kirim request ke GROQ API
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->post(config('services.groq.base_url'), [
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
