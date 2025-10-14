<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrestasiController extends ControllerS
{
    public function index()
    {
        return view('monitoring.index'); // pastikan view ini ada
    }
}
