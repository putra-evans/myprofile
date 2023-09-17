<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileResource;
use App\Models\Pemograman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class Ms_PemogramanController extends Controller
{
    public function index()
    {
        $posts = Pemograman::all()->sortBy("no_urut")->toArray();
        return new ProfileResource(true, 'List Data Bahasa Pemograman', $posts);
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
            'nama_bahasa'       => 'required|string',
            'tentang_bahasa'    => 'required|string',
            'no_urut'           => 'required',
            'foto'              => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //upload image
        $foto = $request->file('foto');
        $foto->storeAs('public/pemograman', $foto->hashName());


        $pemograman = Pemograman::create([
            'nama_bahasa'       => $request->nama_bahasa,
            'tentang_bahasa'    => $request->tentang_bahasa,
            'no_urut'           => $request->no_urut,
            'foto'              => $foto->hashName(),
        ]);
        return new ProfileResource(true, 'Data Pemograman Berhasil Ditambahkan!', $pemograman);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $pemograman = Pemograman::where('slug', $slug)->first();
        return new ProfileResource(true, 'Detail Data Pemograman!', $pemograman);
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
            'nama_bahasa'       => 'required|string',
            'tentang_bahasa'    => 'required|string',
            'no_urut'           => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //find post by ID
        $pemograman = Pemograman::where('slug', $slug)->first();
        if ($pemograman == null) {
            return new ProfileResource(false, 'Data Tidak Ditemukan!', []);
        }
        //check if image is not empty
        if ($request->hasFile('foto')) {
            //upload image
            $foto = $request->file('foto');
            $foto->storeAs('public/pemograman', $foto->hashName());
            //delete old image
            Storage::delete('public/pemograman/' . basename($pemograman->foto));

            //update post with new image
            $pemograman->update([
                'nama_bahasa'      => $request->nama_bahasa,
                'tentang_bahasa'    => $request->tentang_bahasa,
                'no_urut'      => $request->no_urut,
                'foto'              => $foto->hashName(),
            ]);
        } else {
            //update post without image
            $pemograman->update([
                'nama_bahasa'       => $request->nama_bahasa,
                'tentang_bahasa'    => $request->tentang_bahasa,
                'no_urut'           => $request->no_urut,
            ]);
        }

        //return response
        return new ProfileResource(true, 'Data Pemograman Berhasil Diubah!', $pemograman);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        //find post by ID
        $pemograman = Pemograman::where('slug', $slug)->first();
        if ($pemograman == null) {
            return new ProfileResource(false, 'Data Tidak Ditemukan!', []);
        } else {
            //delete image
            Storage::delete('public/pemograman/' . basename($pemograman->foto));

            //delete post
            $pemograman->delete();

            //return response
            return new ProfileResource(true, 'Data Profile Berhasil Dihapus!', null);
        }
    }
}
