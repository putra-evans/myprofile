<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileResource;
use App\Models\Pengalaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class PengalamanController extends Controller
{
    public function index()
    {
        // $posts = Pengalaman::latest()->paginate(5);
        $posts = Pengalaman::all()->sortBy('no_urut')->toArray();

        return new ProfileResource(true, 'List Data Pengalaman Kerja', $posts);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_perusahaan'       => 'required|string',
            'tanggal_masuk'         => 'required',
            'tanggal_keluar'        => 'required',
            'posisi'                => 'required',
            'tugas_wewenang'        => 'required',
            'file'                  => 'required|mimes:pdf|max:2048',
            'logo'                  => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'no_urut'               => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //upload logo
        $logo = $request->file('logo');
        $logo->storeAs('public/pengalamankerja', $logo->hashName());
        //upload file
        $file = $request->file('file');
        $file->storeAs('public/pengalamankerja', $file->hashName());


        $pdd = Pengalaman::create([
            'nama_perusahaan'   => $request->nama_perusahaan,
            'tanggal_masuk'     => $request->tanggal_masuk,
            'tanggal_keluar'    => $request->tanggal_keluar,
            'posisi'            => $request->posisi,
            'tugas_wewenang'    => $request->tugas_wewenang,
            'file'              => $file->hashName(),
            'logo'              => $logo->hashName(),
            'no_urut'           => $request->no_urut
        ]);
        return new ProfileResource(true, 'Data Pengalaman Kerja Berhasil Ditambahkan!', $pdd);
    }

    public function show(string $slug)
    {
        $pdd = Pengalaman::where('slug', $slug)->first();
        return new ProfileResource(true, 'Detail Data Pengalaman Kerja!', $pdd);
    }



    public function update(Request $request, string $slug)
    {
        $validator = Validator::make($request->all(), [
            'nama_perusahaan'       => 'required|string',
            'tanggal_masuk'         => 'required',
            'tanggal_keluar'        => 'required',
            'posisi'                => 'required',
            'tugas_wewenang'        => 'required',
            'no_urut'               => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //find post by slug
        $pengalaman_kerja = Pengalaman::where('slug', $slug)->first();
        if ($pengalaman_kerja == null) {
            return new ProfileResource(false, 'Data Tidak Ditemukan!', []);
        }

        //check if image is not empty
        if ($request->hasFile('logo')) {

            //upload image
            $logo = $request->file('logo');
            $logo->storeAs('public/pengalamankerja', $logo->hashName());
            //delete old image
            Storage::delete('public/pengalamankerja/' . basename($pengalaman_kerja->logo));

            //update post with new image
            $pengalaman_kerja->update([
                'nama_perusahaan'   => $request->nama_perusahaan,
                'tanggal_masuk'     => $request->tanggal_masuk,
                'tanggal_keluar'    => $request->tanggal_keluar,
                'posisi'            => $request->posisi,
                'tugas_wewenang'    => $request->tugas_wewenang,
                'logo'              => $logo->hashName(),
                'no_urut'           => $request->no_urut
            ]);
        }

        if ($request->hasFile('file')) {
            //upload image
            $file = $request->file('file');
            $file->storeAs('public/pengalamankerja', $file->hashName());
            //delete old image
            Storage::delete('public/pengalamankerja/' . basename($pengalaman_kerja->file));

            //update post with new image
            $pengalaman_kerja->update([
                'nama_perusahaan'   => $request->nama_perusahaan,
                'tanggal_masuk'     => $request->tanggal_masuk,
                'tanggal_keluar'    => $request->tanggal_keluar,
                'posisi'            => $request->posisi,
                'tugas_wewenang'    => $request->tugas_wewenang,
                'file'              => $file->hashName(),
                'no_urut'           => $request->no_urut
            ]);
        }

        //  update post without image
        $pengalaman_kerja->update([
            'nama_perusahaan'   => $request->nama_perusahaan,
            'tanggal_masuk'     => $request->tanggal_masuk,
            'tanggal_keluar'    => $request->tanggal_keluar,
            'posisi'            => $request->posisi,
            'tugas_wewenang'    => $request->tugas_wewenang,
            'no_urut'           => $request->no_urut
        ]);
        //return response
        return new ProfileResource(true, 'Data Pengalaman Kerja Berhasil Diubah!', $pengalaman_kerja);
    }

    public function destroy(string $slug)
    {
        //find post by ID
        $pdd = Pengalaman::where('slug', $slug)->first();
        if ($pdd == null) {
            return new ProfileResource(false, 'Data Tidak Ditemukan!', []);
        } else {
            //delete image
            Storage::delete('public/pengalamankerja/' . basename($pdd->file));
            Storage::delete('public/pengalamankerja/' . basename($pdd->logo));

            //delete post
            $pdd->delete();

            //return response
            return new ProfileResource(true, 'Data Pengalaman Kerja Berhasil Dihapus!', null);
        }
    }
}
