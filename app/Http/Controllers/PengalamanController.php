<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Facades\Storage;

class PengalamanController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data_bahasa = DB::table('tbl_pengalaman_kerja')
                ->orderBy('tbl_pengalaman_kerja.id_pengalaman', 'DESC')
                ->get();

            return DataTables::of($data_bahasa)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    $btn = '<button type="button" data-slug="' . $item->slug  . '" title="Edit data" class="btn btn-icon btn-warning waves-effect waves-light BtnEdit" ><i class="fa-solid fa-pencil"></i></button>
                <button type="button" data-slug="' . $item->slug  . '" title="Hapus data" class="btn btn-icon btn-danger waves-effect waves-light" id="BtnHapus"><span class="fa-regular fa-trash-can"></span></button>
                <button type="button" title="Detail data" data-slug="' . $item->slug  . '" class="btn btn-icon btn-primary waves-effect waves-light" id="BtnDetail"><span class="fa-solid fa-circle-info"></span></button>
                ';
                    return $btn;
                })
                ->addColumn('file', function ($item) {
                    // $path = Storage
                    $path = Storage::url('public/pengalamankerja/' . $item->file);
                    $logo_pdf = Storage::url('public/pengalamankerja/pdf.svg');

                    $file = '<img src="' . $logo_pdf . '" alt="user image" width="50%" class="rounded mx-auto d-block open-pdf" data-bs-toggle="modal" data-bs-target="#ModalPdf" data-pdfku="' . $path . '">';
                    return $file;
                })
                ->addColumn('logo', function ($item) {
                    // $path = Storage
                    $path = Storage::url('public/pengalamankerja/' . $item->logo);

                    $logo = '<img src="' . $path . '" alt="user image" width="50%" class="rounded mx-auto d-block open-img" data-bs-toggle="modal" data-bs-target="#ModalFoto" data-imgku="' . $path . '">';
                    return $logo;
                })
                ->rawColumns(['action', 'file', 'logo'])
                ->make(true);
        }
        return view('pengalaman.list');
    }
}
