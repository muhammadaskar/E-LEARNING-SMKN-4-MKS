<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentDashboardController extends Controller
{
    public function index(Request $request)
    {

        $user = $request->user();
        $student = DB::table('students')->where('user_id', '=', $user->id)->first();

        $materi = DB::table('materis')->get()->count();
        $tugas = DB::table('assignments')->get();

        $diskusi = DB::table('discusses')->get()->count();

        $tugasSelesai = DB::table('student_assignments')->where('student_id', '=', $student->id)
            ->where('status', '!=', 'belum_dikumpulkan')
            ->get()
            ->count();

        $tugasBelum = DB::table('student_assignments')->where('student_id', '=', $student->id)
            ->where('status', '=', 'belum_dikumpulkan')
            ->get();

        $tugas = $tugas->count();
        $tugasBelum =  $tugasBelum->count();

        if ($tugasBelum == 0 && $tugas > 0 && $tugasSelesai == 0) {
            $tugasBelum = $tugas;
        } else if ($tugasBelum == 0 && $tugas > 0 && $tugasSelesai > 0) {
            $tugasBelum = $tugas - $tugasSelesai;
        }

        return response()->json([
            'materi' => $materi,
            'tugas' => $tugas,
            'tugas_selesai' => $tugasSelesai,
            'tugas_belum' => $tugasBelum,
            'diskusi' => $diskusi,
        ]);
    }
}
