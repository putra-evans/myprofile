<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pendidikan;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ProfileResource;
use Illuminate\Support\Facades\Storage;

class PendidikanController extends Controller
{
    public function index()
    {
        // $posts = Pendidikan::latest()->paginate(5);
        $posts = Pendidikan::all()->sortBy('no_urut')->toArray();

        return new ProfileResource(true, 'List Data Pendidikan', $posts);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_pendidikan'       => 'required|string',
            'tanggal_masuk'         => 'required',
            'tanggal_keluar'        => 'required',
            'alamat_pendidikan'     => 'required',
            'logo'             => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'kota'                  => 'required',
            'provinsi'              => 'required',
            'nilai'                 => 'required',
            'jurusan'               => 'required',
            'no_urut'               => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //upload image
        $logo = $request->file('logo');
        $logo->storeAs('public/pendidikan', $logo->hashName());


        $pdd = Pendidikan::create([
            'nama_pendidikan'   => $request->nama_pendidikan,
            'tanggal_masuk'     => $request->tanggal_masuk,
            'tanggal_keluar'    => $request->tanggal_keluar,
            'alamat_pendidikan' => $request->alamat_pendidikan,
            'logo'              => $logo->hashName(),
            'kota'              => $request->kota,
            'provinsi'          => $request->provinsi,
            'nilai'             => $request->nilai,
            'jurusan'           => $request->jurusan,
            'no_urut'           => $request->no_urut
        ]);
        return new ProfileResource(true, 'Data Pendidikan Berhasil Ditambahkan!', $pdd);
    }



    public function show(string $slug)
    {
        $pdd = Pendidikan::where('slug', $slug)->first();
        return new ProfileResource(true, 'Detail Data Pendidikan!', $pdd);
    }


    public function update(Request $request, string $slug)
    {
        $validator = Validator::make($request->all(), [
            'nama_pendidikan'       => 'required|string',
            'tanggal_masuk'         => 'required',
            'tanggal_keluar'        => 'required',
            'alamat_pendidikan'     => 'required',
            'kota'                  => 'required',
            'provinsi'              => 'required',
            'nilai'                 => 'required',
            'jurusan'               => 'required',
            'no_urut'               => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //find post by slug
        $pendidikan = Pendidikan::where('slug', $slug)->first();
        if ($pendidikan == null) {
            return new ProfileResource(false, 'Data Tidak Ditemukan!', []);
        }

        //check if image is not empty
        if ($request->hasFile('logo')) {

            //upload image
            $logo = $request->file('logo');
            $logo->storeAs('public/pendidikan', $logo->hashName());
            //delete old image
            Storage::delete('public/pendidikan/' . basename($pendidikan->logo));

            //update post with new image
            $pendidikan->update([
                'nama_pendidikan'   => $request->nama_pendidikan,
                'tanggal_masuk'     => $request->tanggal_masuk,
                'tanggal_keluar'    => $request->tanggal_keluar,
                'alamat_pendidikan' => $request->alamat_pendidikan,
                'logo'              => $logo->hashName(),
                'kota'              => $request->kota,
                'provinsi'          => $request->provinsi,
                'nilai'             => $request->nilai,
                'jurusan'           => $request->jurusan,
                'no_urut'           => $request->no_urut
            ]);
        } else {

            //update post without image
            $pendidikan->update([
                'nama_pendidikan'   => $request->nama_pendidikan,
                'tanggal_masuk'     => $request->tanggal_masuk,
                'tanggal_keluar'    => $request->tanggal_keluar,
                'alamat_pendidikan' => $request->alamat_pendidikan,
                'kota'              => $request->kota,
                'provinsi'          => $request->provinsi,
                'nilai'             => $request->nilai,
                'jurusan'           => $request->jurusan,
                'no_urut'           => $request->no_urut
            ]);
        }

        //return response
        return new ProfileResource(true, 'Data Pendidikan Berhasil Diubah!', $pendidikan);
    }



    public function destroy(string $slug)
    {
        //find post by ID
        $pdd = Pendidikan::where('slug', $slug)->first();
        if ($pdd == null) {
            return new ProfileResource(false, 'Data Tidak Ditemukan!', []);
        } else {
            //delete image
            Storage::delete('public/pendidikan/' . basename($pdd->logo));

            //delete post
            $pdd->delete();

            //return response
            return new ProfileResource(true, 'Data Pendidikan Berhasil Dihapus!', null);
        }
    }
}
