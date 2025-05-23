<?php

namespace App\Http\Controllers;

use App\Models\DataPokinKota;
use App\Models\PokinKota;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data = DataPokinKota::where('misi', 1)->get();
        return view('home', ['data' => $data]);
    }

    public function pokin_kota()
    {
        $data = DataPokinKota::where('misi', 1)->get();
        return view('home', ['data' => $data]);
    }
}
