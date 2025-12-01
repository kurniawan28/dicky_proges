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

            $response = Http::withToken(env('OPENAI_API_KEY'))
                ->post('https://api.openai.com/v1/responses', [
                    'model' => 'gpt-4o-mini',
                    'input' => "
                        Kamu adalah AI Bimbingan Konseling yang ramah, sopan, dan membantu siswa.

                        Pesan siswa:
                        {$request->message}
                    ",
                ]);

            $aiReply = $response->json()['output_text'] ?? 'AI tidak merespon.';

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
