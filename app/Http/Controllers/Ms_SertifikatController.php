<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Facades\Storage;

class Ms_SertifikatController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data_kategori = DB::table('ms_sertifikat')
                ->orderBy('ms_sertifikat.id_kategori', 'DESC')
                ->get();

            return DataTables::of($data_kategori)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    $btn = '<button type="button" data-slug="' . $item->slug  . '" title="Edit data" class="btn btn-icon btn-warning waves-effect waves-light BtnEdit" ><i class="fa-solid fa-pencil"></i></button>
                <button type="button" data-slug="' . $item->slug  . '" title="Hapus data" class="btn btn-icon btn-danger waves-effect waves-light" id="BtnHapus"><span class="fa-regular fa-trash-can"></span></button>
                ';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('kat_sertifikat.list');
    }
}
