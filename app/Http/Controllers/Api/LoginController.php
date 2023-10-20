<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                return response()->json([
                    'code' => 200,
                    'message' => 'Login Berhasil',
                    'data' => $user
                ]);
            } else {

                return response()->json([
                    'code' => 422,
                    'message' => 'Password mismatch'
                ]);
            }
        } else {
            return response()->json([
                'code' => 422,
                'message' => 'User does not exist'
            ]);
        }
    }
}
