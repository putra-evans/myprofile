<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileResource;
use App\Models\Projek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ProjekController extends Controller
{
    public function index(Request $request)
    {

        $bhs_program = DB::table('ms_pemograman')
            ->orderBy('no_urut', 'asc')
            ->get();


        $projek = DB::table('ta_projek')
            ->orderBy('ta_projek.no_urut', 'asc')
            ->get();


        $array_projek = [];
        foreach ($projek as $key => $pecah) {
            $path = Storage::url('public/projek/' . $pecah->file);
            $array_projek[$pecah->id_bhs_pemograman][] = array(

                'id_projek ' => $pecah->id_projek,
                'nama_projek' => $pecah->nama_projek,
                'tahun_pembuatan' => $pecah->tahun_pembuatan,
                'tentang_projek' => $pecah->tentang_projek,
                'file' => $path,
                'no_urut' => $pecah->no_urut,
            );
        }



        $array_bhs = [];
        foreach ($bhs_program as $key => $value) {
            $path = Storage::url('public/pemograman/' . $value->foto);
            $array_bhs[$key] = array(

                'id_bhs_pemograman '    => $value->id_bhs_pemograman,
                'slug_bahasa'           => $value->slug,
                'nama_bahasa'           => $value->nama_bahasa,
                'tentang_bahasa'        => $value->tentang_bahasa,
                'foto_bahasa'           => $path,
                'no_urut_bahasa'        => $value->no_urut,
                'projek'                => isset($array_projek[$value->id_bhs_pemograman]) ? $array_projek[$value->id_bhs_pemograman] : [],
            );
        }



        return new ProfileResource(true, 'List Data Bahasa Pemograman', $array_bhs);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_bhs_pemograman'     => 'required|string',
            'nama_projek'           => 'required|string',
            'file'                  => 'required',
            'tahun_pembuatan'       => 'required',
            'tentang_projek'        => 'required',
            'no_urut'               => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //upload image
        $file = $request->file('file');
        $file->storeAs('public/projek', $file->hashName());


        $projek = Projek::create([
            'id_bhs_pemograman'         => $request->id_bhs_pemograman,
            'nama_projek'               => $request->nama_projek,
            'tahun_pembuatan'           => $request->tahun_pembuatan,
            'tentang_projek'            => $request->tentang_projek,
            'file'                      => $file->hashName(),
            'no_urut'                   => $request->no_urut,
        ]);
        return new ProfileResource(true, 'Data Projek Berhasil Ditambahkan!', $projek);
    }

    public function show(string $slug)
    {
        $pemograman = Projek::where('slug', $slug)->first();
        return new ProfileResource(true, 'Detail Data Pemograman!', $pemograman);
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
        $projek = Projek::where('slug', $slug)->first();
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
        $projek = Projek::where('slug', $slug)->first();
        if ($projek == null) {
            return new ProfileResource(false, 'Data Tidak Ditemukan!', []);
        } else {
            //delete image
            Storage::delete('public/projek/' . basename($projek->file));

            //delete post
            $projek->delete();

            //return response
            return new ProfileResource(true, 'Data Projek Berhasil Dihapus!', null);
        }
    }
}
