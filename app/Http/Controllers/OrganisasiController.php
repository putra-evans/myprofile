<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrganisasiController extends Controller
{
    public function index()
    {
        return view('organisasi.list');
    }
}
