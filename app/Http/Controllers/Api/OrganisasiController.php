<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Organisasi;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ProfileResource;
use Illuminate\Support\Facades\Storage;


class OrganisasiController extends Controller
{
    public function index()
    {
        // $posts = Organisasi::latest()->paginate(5);
        $posts = Organisasi::all()->sortByDesc('no_urut')->toArray();

        return new ProfileResource(true, 'List Data Organisasi', $posts);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_organisasi'       => 'required|string',
            'tentang_organisasi'   => 'required',
            'tingkat_organisasi'   => 'required',
            'jabatan'              => 'required',
            'tentang_jabatan'      => 'required',
            'tanggal_masuk'        => 'required',
            'tanggal_keluar'       => 'required',
            'logo'                  => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'no_urut'            => 'required',
            'kota'                  => 'required',
            'provinsi'              => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //upload image
        $logo = $request->file('logo');
        $logo->storeAs('public/organisasi', $logo->hashName());


        $organisasi = Organisasi::create([
            'nama_organisasi'        => $request->nama_organisasi,
            'tentang_organisasi'    => $request->tentang_organisasi,
            'tingkat_organisasi'    => $request->tingkat_organisasi,
            'jabatan'               => $request->jabatan,
            'tentang_jabatan'       => $request->tentang_jabatan,
            'tanggal_masuk'     => $request->tanggal_masuk,
            'tanggal_keluar'    => $request->tanggal_keluar,
            'logo'              => $logo->hashName(),
            'no_urut'              => $request->no_urut,
            'kota'              => $request->kota,
            'provinsi'              => $request->provinsi,
        ]);
        return new ProfileResource(true, 'Data Organisasi Berhasil Ditambahkan!', $organisasi);
    }
    public function show(string $slug)
    {
        $organisasi = Organisasi::where('slug', $slug)->first();
        return new ProfileResource(true, 'Detail Data Organisasi!', $organisasi);
    }


    public function update(Request $request, string $slug)
    {
        $validator = Validator::make($request->all(), [
            'nama_organisasi'       => 'required|string',
            'tentang_organisasi'   => 'required',
            'tingkat_organisasi'   => 'required',
            'jabatan'              => 'required',
            'tentang_jabatan'      => 'required',
            'tanggal_masuk'        => 'required',
            'tanggal_keluar'       => 'required',
            'no_urut'       => 'required',
            'kota'                  => 'required',
            'provinsi'              => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //find post by slug
        $organisasi = Organisasi::where('slug', $slug)->first();
        if ($organisasi == null) {
            return new ProfileResource(false, 'Data Tidak Ditemukan!', []);
        }

        //check if image is not empty
        if ($request->hasFile('logo')) {

            //upload image
            $logo = $request->file('logo');
            $logo->storeAs('public/organisasi', $logo->hashName());
            //delete old image
            Storage::delete('public/organisasi/' . basename($organisasi->logo));

            //update post with new image
            $organisasi->update([
                'nama_organisasi'        => $request->nama_organisasi,
                'tentang_organisasi'    => $request->tentang_organisasi,
                'tingkat_organisasi'    => $request->tingkat_organisasi,
                'jabatan'               => $request->jabatan,
                'tentang_jabatan'       => $request->tentang_jabatan,
                'tanggal_masuk'     => $request->tanggal_masuk,
                'tanggal_keluar'    => $request->tanggal_keluar,
                'logo'              => $logo->hashName(),
                'no_urut'              => $request->no_urut,
                'kota'              => $request->kota,
                'provinsi'              => $request->provinsi,

            ]);
        } else {
            //update post without image
            $organisasi->update([
                'nama_organisasi'        => $request->nama_organisasi,
                'tentang_organisasi'    => $request->tentang_organisasi,
                'tingkat_organisasi'    => $request->tingkat_organisasi,
                'jabatan'               => $request->jabatan,
                'tentang_jabatan'       => $request->tentang_jabatan,
                'tanggal_masuk'     => $request->tanggal_masuk,
                'tanggal_keluar'    => $request->tanggal_keluar,
                'no_urut'              => $request->no_urut,
                'kota'              => $request->kota,
                'provinsi'              => $request->provinsi,

            ]);
        }

        //return response
        return new ProfileResource(true, 'Data Organisasi Berhasil Diubah!', $organisasi);
    }
    public function destroy(string $slug)
    {
        //find post by ID
        $organisasi = Organisasi::where('slug', $slug)->first();

        if ($organisasi == null) {
            return new ProfileResource(false, 'Data Tidak Ditemukan!', []);
        } else {

            //delete image
            Storage::delete('public/organisasi/' . basename($organisasi->logo));

            //delete post
            $organisasi->delete();

            //return response
            return new ProfileResource(true, 'Data Organisasi Berhasil Dihapus!', null);
        }
    }
}
