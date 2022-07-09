<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $guru = DB::table('teachers')->get()->count();
        $siswa = DB::table('students')->get()->count();
        $orang_tua = DB::table('parents')
            ->where('student_id', '!=', '0')
            ->get()->count();

        return response()->json([
            'guru' => $guru,
            'siswa' => $siswa,
            'orang_tua' => $orang_tua,
        ]);
    }
}
