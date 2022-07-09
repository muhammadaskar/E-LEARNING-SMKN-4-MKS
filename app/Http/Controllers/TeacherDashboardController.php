<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherDashboardController extends Controller
{
    public function index()
    {
        $siswa = DB::table('students')->get()->count();
        $materi = DB::table('materis')->get()->count();
        $tugas = DB::table('assignments')->get()->count();
        $diskusi = DB::table('discusses')->get()->count();

        // $data = array($materi, $tugas, $diskusi);

        return response()->json([
            'siswa' => $siswa,
            'materi' => $materi,
            'tugas' => $tugas,
            'diskusi' => $diskusi,
        ]);
    }
}
