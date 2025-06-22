<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PokinKota;
use Illuminate\Http\Request;
use App\Models\DataPokinKota;
use App\Models\DataPokinPerangkatDaerah;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function pokin()
    {
        return view('pokin', ['data' => []]);
    }

    public function getMisi()
    {
        $misi = PokinKota::get();
        return response()->json($misi);
    }

    public function getPerangkatdaerah()
    {
        $perangkatdaerah = User::whereHas('roles', function ($query) {
            $query->where('name', '=', 'panel_user');
        })->get();
        return response()->json($perangkatdaerah);
    }

    public function getData(Request $request)
    {
        $tipe = $request->input('tipe');
        $id = $request->input('id');

        if ($tipe == 'kota') {
            $data = DataPokinKota::where('misi', $id)->get();
        } else {
            $data = DataPokinPerangkatDaerah::where('user_id', $id)->get();
        }

        return response()->json(['data' => $data]);
    }
}
