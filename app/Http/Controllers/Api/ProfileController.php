<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ProfileResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $posts = Profile::latest()->paginate(5);

        //Descending
        $posts = Profile::all()->sortBy("id_profile");
        // $posts = DB::table('tbl_profile')
        //     ->orderBy('id_profile', 'desc')
        //     ->get();
        // return response()->json([
        //     'status'  => 200,
        //     'message' => 'succes',
        //     'data' => $posts,
        // ], 200);
        return new ProfileResource(true, 'List Data Profile', $posts);
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
            'nama_lengkap'      => 'required|string',
            'nama_panggilan'    => 'required|string',
            'tempat_lahir'      => 'required',
            'tanggal_lahir'     => 'required',
            'foto'              => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email'             => 'required|email',
            'no_hp'             => 'required',
            'status'            => 'required',
            'profil_singkat'    => 'required',
            'pekerjaan'         => 'required',
            'alamat_sekarang'   => 'required',
            'kota_asal'         => 'required',
            'provinsi_asal'     => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //upload image
        $foto = $request->file('foto');
        $foto->storeAs('public/img', $foto->hashName());


        $profile = Profile::create([
            'nama_lengkap'      => $request->nama_lengkap,
            'nama_panggilan'    => $request->nama_panggilan,
            'tempat_lahir'      => $request->tempat_lahir,
            'tanggal_lahir'     => $request->tanggal_lahir,
            'foto'              => $foto->hashName(),
            'email'             => $request->email,
            'no_hp'             => $request->no_hp,
            'status'            => $request->status,
            'profil_singkat'    => $request->profil_singkat,
            'pekerjaan'         => $request->pekerjaan,
            'alamat_sekarang'   => $request->alamat_sekarang,
            'kota_asal'         => $request->kota_asal,
            'provinsi_asal'     => $request->provinsi_asal,
        ]);
        return new ProfileResource(true, 'Data Profile Berhasil Ditambahkan!', $profile);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $profile = Profile::where('slug', $slug)->first();
        return new ProfileResource(true, 'Detail Data Profile!', $profile);
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
            'nama_lengkap'      => 'required|string',
            'nama_panggilan'    => 'required|string',
            'tempat_lahir'      => 'required',
            'tanggal_lahir'     => 'required',
            'email'             => 'required|email',
            'no_hp'             => 'required',
            'status'            => 'required',
            'profil_singkat'    => 'required',
            'pekerjaan'         => 'required',
            'alamat_sekarang'   => 'required',
            'kota_asal'         => 'required',
            'provinsi_asal'     => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //find post by ID
        // $post = Profile::find($id);
        $profile = Profile::where('slug', $slug)->first();
        if ($profile == null) {
            return new ProfileResource(false, 'Data Tidak Ditemukan!', []);
        }
        //check if image is not empty
        if ($request->hasFile('foto')) {

            //upload image
            $foto = $request->file('foto');
            $foto->storeAs('public/img', $foto->hashName());
            //delete old image
            Storage::delete('public/img/' . basename($profile->foto));

            //update post with new image
            $profile->update([
                'nama_lengkap'      => $request->nama_lengkap,
                'nama_panggilan'    => $request->nama_panggilan,
                'tempat_lahir'      => $request->tempat_lahir,
                'tanggal_lahir'     => $request->tanggal_lahir,
                'foto'              => $foto->hashName(),
                'email'             => $request->email,
                'no_hp'             => $request->no_hp,
                'status'            => $request->status,
                'profil_singkat'    => $request->profil_singkat,
                'pekerjaan'         => $request->pekerjaan,
                'alamat_sekarang'   => $request->alamat_sekarang,
                'kota_asal'         => $request->kota_asal,
                'provinsi_asal'     => $request->provinsi_asal,
            ]);
        } else {

            //update post without image
            $profile->update([
                'nama_lengkap'      => $request->nama_lengkap,
                'nama_panggilan'    => $request->nama_panggilan,
                'tempat_lahir'      => $request->tempat_lahir,
                'tanggal_lahir'     => $request->tanggal_lahir,
                'email'             => $request->email,
                'no_hp'             => $request->no_hp,
                'status'            => $request->status,
                'profil_singkat'    => $request->profil_singkat,
                'pekerjaan'         => $request->pekerjaan,
                'alamat_sekarang'   => $request->alamat_sekarang,
                'kota_asal'         => $request->kota_asal,
                'provinsi_asal'     => $request->provinsi_asal,
            ]);
        }

        //return response
        return new ProfileResource(true, 'Data Profile Berhasil Diubah!', $profile);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        //find post by ID
        $profile = Profile::where('slug', $slug)->first();
        if ($profile == null) {
            return new ProfileResource(false, 'Data Tidak Ditemukan!', []);
        } else {
            //delete image
            Storage::delete('public/img/' . basename($profile->foto));

            //delete post
            $profile->delete();

            //return response
            return new ProfileResource(true, 'Data Profile Berhasil Dihapus!', null);
        }
    }
}
