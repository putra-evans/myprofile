<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class ProjekController extends Controller
{
    public function index(Request $request)
    {

        $pemograman = DB::table('ms_pemograman')->orderBy('no_urut')->get();
        return view('projek.list', [
            'pemograman' => $pemograman
        ]);
    }

    public function ambil_projek($slug)
    {
        $data_projek = DB::table('ta_projek')
            ->select(
                'ta_projek.slug as slug_projek',
                'ta_projek.id_projek',
                'ta_projek.nama_projek',
                'ta_projek.tahun_pembuatan',
                'ta_projek.tentang_projek',
                'ta_projek.file',
                'ta_projek.no_urut',
                'ms_pemograman.slug',
                'ms_pemograman.nama_bahasa'
            )
            ->join('ms_pemograman', 'ta_projek.id_bhs_pemograman', '=', 'ms_pemograman.id_bhs_pemograman')
            ->where('ms_pemograman.slug', '=', $slug)
            ->orderBy('ta_projek.id_projek', 'DESC')
            ->get();

        return DataTables::of($data_projek)
            ->addIndexColumn()
            ->addColumn('action', function ($item) {
                $btn = '<button type="button" data-slug="' . $item->slug_projek . '" title="Edit data" class="btn btn-icon btn-warning waves-effect waves-light" id="BtnEdit"><i class="fa-solid fa-pencil"></i></button>
                    <button type="button" data-slug="' . $item->slug_projek . '" title="Hapus data" class="btn btn-icon btn-danger waves-effect waves-light" id="BtnHapus"><span class="fa-regular fa-trash-can"></span></button>
                    ';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        return view('projek.list', [
            // 'pemograman' => $pemograman
        ]);
    }
}
