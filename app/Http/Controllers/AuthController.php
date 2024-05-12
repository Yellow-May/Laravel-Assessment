<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelpers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate([
            "email" => 'required|email|exists:users',
            "password" => 'required'
        ]);

        $user = User::where('email', $data['email'])->first();

        if (empty($user) || !Hash::check($data['password'], $user->password)) {
            return response(['message' => 'Invalid Credentials'], 401);
        }

        $token = $user->createToken("sactum")->plainTextToken;

        $user = [
            "id" => $user->id,
            "email" => $user->email,
            "name" => $user->name,
        ];

        return AppHelpers::api_response([
            "user" => $user,
            "token" => $token
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response(['message' => 'Logged out']);
    }
}
