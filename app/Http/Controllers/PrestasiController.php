<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrestasiController extends ControllerS
{
    public function index()
    {
        return view('prestasi.index'); // pastikan view ini ada
    }
}
