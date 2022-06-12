<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|string|unique:users,email',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)->mixedCase()->numbers()->symbols()
            ],
            'gender' => 'required',
            'address' => 'required',
            'nik' => 'required',
        ]);

        /** @var \App\Models\User $user */
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => 'admin',
            'gender' => $data['gender'],
            'address' => $data['address']
        ]);

        $token = $user->createToken('main')->plainTextToken;


        Admin::create([
            'user_id' => $user->id,
            'nik' => $data['nik']
        ]);

        return response([
            'userId' => $user->id,
            'user' => $user,
            'token' => $token,
            'role' => $user->role
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email|string|exists:users,email',
            'password' => [
                'required'
            ],
            'remember' => 'boolean'
        ]);

        $remember = $credentials['remember'] ?? false;
        unset($credentials['remember']);

        if (!Auth::attempt($credentials, $remember)) {
            return response([
                'error' => 'Kredensial yang diberikan tidak benar'
            ], 422);
        }

        $user = Auth::user();
        $token = $user->createToken('main')->plainTextToken;


        // return response([

        // ]);
        return response([
            'user' => $user,
            'token' => $token,
            'role' => $user->role
        ]);
    }

    public function logout()
    {
        $user = Auth::user();
        $user->currentAccessToken()->delete();

        return response([
            'success' => true
        ]);
    }
}
