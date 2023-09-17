<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileResource;
use App\Models\Sertifikat as ModelsSertifikat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class Sertifikat extends Controller
{
    public function index(Request $request)
    {

        $kategori = DB::table('ms_sertifikat')
            ->orderBy('no_urut', 'desc')
            ->get();


        $sertifikat = DB::table('ta_sertifikat')
            ->orderBy('ta_sertifikat.no_urut', 'desc')
            ->get();


        $array_sertifikat = [];
        foreach ($sertifikat as $key => $pecah) {
            $array_sertifikat[$pecah->id_kategori][] = array(
                'id_sertifikat ' => $pecah->id_sertifikat,
                'nama_sertifikat' => $pecah->nama_sertifikat,
                'tahun_sertifikat' => $pecah->tahun_sertifikat,
                'tentang_sertifikat' => $pecah->tentang_sertifikat,
                'file' => $pecah->file_projek,
                'no_urut' => $pecah->no_urut,
            );
        }



        $array_kategori = [];
        foreach ($kategori as $key => $value) {
            $array_kategori[$key] = array(
                'id_kategori '          => $value->id_kategori,
                'slug_kategori'         => $value->slug,
                'nama_kategori'         => $value->nama_kategori,
                'keterangan_kategori'   => $value->keterangan_kategori,
                'no_urut_kategori'      => $value->no_urut,
                'sertifikat'            => isset($array_sertifikat[$value->id_kategori]) ? $array_sertifikat[$value->id_kategori] : [],
            );
        }

        return new ProfileResource(true, 'List Data Sertifikat', $array_kategori);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_kategori'           => 'required|string',
            'nama_sertifikat'       => 'required|string',
            'file'                  => 'required',
            'tahun_sertifikat'      => 'required',
            'tentang_sertifikat'    => 'required',
            'no_urut'               => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //upload image
        $file = $request->file('file');
        $file->storeAs('public/sertifikat', $file->hashName());


        $sertifikat = ModelsSertifikat::create([
            'id_kategori'         => $request->id_kategori,
            'nama_sertifikat'     => $request->nama_sertifikat,
            'tahun_sertifikat'    => $request->tahun_sertifikat,
            'tentang_sertifikat'  => $request->tentang_sertifikat,
            'file_projek'         => $file->hashName(),
            'no_urut'             => $request->no_urut,
        ]);
        return new ProfileResource(true, 'Data Sertifikat Berhasil Ditambahkan!', $sertifikat);
    }

    public function show(string $slug)
    {
        $sertifikat = ModelsSertifikat::where('slug', $slug)->first();
        return new ProfileResource(true, 'Detail Data Sertifikat!', $sertifikat);
    }


    public function update(Request $request, string $slug)
    {
        $validator = Validator::make($request->all(), [
            'id_bhs_pemograman'     => 'required|string',
            'nama_projek'           => 'required|string',
            'tahun_pembuatan'       => 'required',
            'tentang_projek'        => 'required',
            'no_urut'               => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //find post by ID
        $projek = ModelsSertifikat::where('slug', $slug)->first();
        if ($projek == null) {
            return new ProfileResource(false, 'Data Tidak Ditemukan!', []);
        }
        //check if image is not empty
        if ($request->hasFile('file')) {
            //upload image
            $file = $request->file('file');
            $file->storeAs('public/projek', $file->hashName());
            //delete old image
            Storage::delete('public/projek/' . basename($projek->file));

            //update post with new image
            $projek->update([
                'id_bhs_pemograman'         => $request->id_bhs_pemograman,
                'nama_projek'               => $request->nama_projek,
                'tahun_pembuatan'           => $request->tahun_pembuatan,
                'tentang_projek'            => $request->tentang_projek,
                'file'                      => $file->hashName(),
                'no_urut'                   => $request->no_urut,
            ]);
        } else {
            //update post without image
            $projek->update([
                'id_bhs_pemograman'         => $request->id_bhs_pemograman,
                'nama_projek'               => $request->nama_projek,
                'tahun_pembuatan'           => $request->tahun_pembuatan,
                'tentang_projek'            => $request->tentang_projek,
                'no_urut'                   => $request->no_urut,
            ]);
        }

        //return response
        return new ProfileResource(true, 'Data Pemograman Berhasil Diubah!', $projek);
    }



    public function destroy(string $slug)
    {
        //find post by ID
        $sertifikat = ModelsSertifikat::where('slug', $slug)->first();
        if ($sertifikat == null) {
            return new ProfileResource(false, 'Data Tidak Ditemukan!', []);
        } else {
            //delete image
            Storage::delete('public/sertifikat/' . basename($sertifikat->file_projek));

            //delete post
            $sertifikat->delete();

            //return response
            return new ProfileResource(true, 'Data Sertifikat Berhasil Dihapus!', null);
        }
    }
}
