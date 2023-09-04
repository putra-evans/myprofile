<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjekController extends Controller
{
    public function index()
    {
        $pemograman = DB::table('ms_pemograman')->orderBy('no_urut')->get();
        return view('projek.list', compact('pemograman'));
    }
}
