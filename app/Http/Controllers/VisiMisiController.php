<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VisiMisiController extends Controller
{
    // Constructor untuk middleware
    public function __construct()
    {
        $this->middleware('auth'); // semua user login bisa akses
    }

    // Method menampilkan halaman Visi & Misi
    public function index()
    {
        return view('visi-misi'); // arahkan ke blade visi-misi/index.blade.php
    }
}
