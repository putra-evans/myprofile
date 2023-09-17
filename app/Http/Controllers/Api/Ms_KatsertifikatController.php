<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileResource;
use App\Models\Ms_sertifikat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Ms_KatsertifikatController extends Controller
{
    public function index()
    {
        $posts = Ms_sertifikat::all()->sortByDesc("no_urut")->toArray();
        return new ProfileResource(true, 'List Data Kategori Sertifikat', $posts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kategori'         => 'required|string',
            'ket_kategori'          => 'required|string',
            'no_urut'               => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


        $kategori = Ms_sertifikat::create([
            'nama_kategori'             => $request->nama_kategori,
            'keterangan_kategori'       => $request->ket_kategori,
            'no_urut'                   => $request->no_urut,
        ]);
        return new ProfileResource(true, 'Data Kategori Berhasil Ditambahkan!', $kategori);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $kategori = Ms_sertifikat::where('slug', $slug)->first();
        return new ProfileResource(true, 'Detail Data Kategori!', $kategori);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        $validator = Validator::make($request->all(), [
            'nama_kategori'         => 'required|string',
            'ket_kategori'          => 'required|string',
            'no_urut'               => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //find post by ID
        $kategori = Ms_sertifikat::where('slug', $slug)->first();
        if ($kategori == null) {
            return new ProfileResource(false, 'Data Tidak Ditemukan!', []);
        }

        $kategori->update([
            'nama_kategori'             => $request->nama_kategori,
            'keterangan_kategori'       => $request->ket_kategori,
            'no_urut'                   => $request->no_urut,
        ]);


        //return response
        return new ProfileResource(true, 'Data Kategori Berhasil Diubah!', $kategori);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        //find post by ID
        $kat = Ms_sertifikat::where('slug', $slug)->first();
        if ($kat == null) {
            return new ProfileResource(false, 'Data Tidak Ditemukan!', []);
        } else {
            //delete post
            $kat->delete();

            //return response
            return new ProfileResource(true, 'Data Kategori Berhasil Dihapus!', null);
        }
    }
}
