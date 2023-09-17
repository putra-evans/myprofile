<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Facades\Storage;

class SertifikatController extends Controller
{
    public function index(Request $request)
    {

        $kategori = DB::table('ms_sertifikat')->orderBy('no_urut')->get();
        return view('sertifikat.list', [
            'kategori' => $kategori
        ]);
    }

    public function ambil_sertifikat($slug)
    {
        $data = DB::table('ta_sertifikat')
            ->select(
                'ta_sertifikat.slug as slug_sertifikat',
                'ta_sertifikat.id_sertifikat',
                'ta_sertifikat.nama_sertifikat',
                'ta_sertifikat.tahun_sertifikat',
                'ta_sertifikat.tentang_sertifikat',
                'ta_sertifikat.file',
                'ta_sertifikat.no_urut',
                'ms_sertifikat.slug',
                'ms_sertifikat.nama_kategori'
            )
            ->join('ms_sertifikat', 'ta_sertifikat.id_kategori', '=', 'ms_sertifikat.id_kategori')
            ->where('ms_sertifikat.slug', '=', $slug)
            ->orderBy('ta_sertifikat.id_sertifikat', 'DESC')
            ->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($item) {
                $btn = '<button type="button" data-slug="' . $item->slug_sertifikat . '" title="Edit data" class="btn btn-icon btn-warning waves-effect waves-light" id="BtnEdit"><i class="fa-solid fa-pencil"></i></button>
                    <button type="button" data-slug="' . $item->slug_sertifikat . '" title="Hapus data" class="btn btn-icon btn-danger waves-effect waves-light" id="BtnHapus"><span class="fa-regular fa-trash-can"></span></button>
                    ';
                return $btn;
            })
            ->addColumn('file', function ($item) {
                // $path = Storage
                $path = Storage::url('public/sertifikat/' . $item->file);
                $logo_pdf = Storage::url('public/sertifikat/pdf.svg');

                $file = '<img src="' . $logo_pdf . '" alt="user image" width="50%" class="rounded mx-auto d-block open-pdf" data-bs-toggle="modal" data-bs-target="#ModalPdf" data-pdfku="' . $path . '">';
                return $file;
            })
            ->rawColumns(['action', 'file'])
            ->make(true);
        return view('sertifikat.list', [
            // 'pemograman' => $pemograman
        ]);
    }
}
