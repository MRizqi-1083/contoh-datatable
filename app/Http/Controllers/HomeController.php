<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        return view('pages.home');
    }

    public function pertama()
    {
        return view('pages.tabel1');
    }

    public function kedua()
    {
        return view('pages.tabel2');
    }

    public function ketiga()
    {
        return view('pages.tabel3');
    }
}
