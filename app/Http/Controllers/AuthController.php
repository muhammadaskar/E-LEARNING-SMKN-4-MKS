<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\AdminParent;
use App\Models\AdminStudent;
use App\Models\AdminTeacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        if ($request->role == "teacher") {
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
                'nip' => ['required', 'unique:teachers,nip|min:18|max:18'],
            ], [], [
                'nip' => 'data guru'
            ]);
            /** @var \App\Models\User $user */
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'role' => 'teacher',
                'gender' => $data['gender'],
                'address' => $data['address']
            ]);

            AdminTeacher::create([
                'user_id' => $user->id,
                'nip' => $data['nip'],
            ]);
        }
        if ($request->role == "student") {
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
                'nis' => 'required|unique:students,nis',
            ], [], [
                'nis' => 'data siswa'
            ]);
            /** @var \App\Models\User $user */
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'role' => 'student',
                'gender' => $data['gender'],
                'address' => $data['address']
            ]);

            AdminStudent::create([
                'user_id' => $user->id,
                'nis' => $data['nis'],
            ]);
        }
        if ($request->role == "parent") {
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
                'nik' => 'required|unique:parents,nik',
            ], [], [
                'nik' => 'data orang tua'
            ]);
            /** @var \App\Models\User $user */
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'role' => 'parent',
                'gender' => $data['gender'],
                'address' => $data['address']
            ]);

            AdminParent::create([
                'user_id' => $user->id,
                'nik' => $data['nik'],
            ]);
        }


        $token = $user->createToken('main')->plainTextToken;



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
            'email' => 'required|email|string',
            'password' => [
                'required'
            ],
            'remember' => 'boolean'
        ], [], [
            'password' => 'kata sandi'
        ]);

        $remember = $credentials['remember'] ?? false;
        unset($credentials['remember']);

        if (!Auth::attempt($credentials, $remember)) {
            return response([
                'error' => 'email atau kata sandi tidak sesuai'
            ], 422);
        }

        $user = Auth::user();
        $token = $user->createToken('main')->plainTextToken;

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
