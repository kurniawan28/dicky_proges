<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggaran;

class StatistikController extends Controller
{
    public function index()
    {
        // Ambil semua data pelanggaran
        $pelanggaran = Pelanggaran::all();

        // Kirim ke Blade
        return view('statistik.index', compact('pelanggaran'));
    }
}

