<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Ms_PemogramanController extends Controller
{
    public function index()
    {
        return view('pemograman.list');
    }
}
