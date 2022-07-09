<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ParentDashboardController extends Controller
{
    public function index(Request $request)
    {

        $user = $request->user();
        $parent = DB::table('parents')->where('user_id', '=', $user->id)->first();

        if ($parent->student_id == null) {
            return response()->json([
                'status' => false,
                'materi' => 0,
                'tugas' => 0,
                'tugas_selesai' => 0,
                'tugas_belum' => 0,
                'diskusi' => 0,
            ]);
        } else {
            $materi = DB::table('materis')->get()->count();
            $tugas = DB::table('assignments')->get();

            $diskusi = DB::table('discusses')->get()->count();

            $tugasSelesai = DB::table('student_assignments')->where('student_id', '=', $parent->student_id)
                ->where('status', '!=', 'belum_dikumpulkan')
                ->get()
                ->count();

            $tugasBelum = DB::table('student_assignments')->where('student_id', '=', $parent->student_id)
                ->where('status', '=', 'belum_dikumpulkan')
                ->get();

            $tugasTelat = DB::table('student_assignments')->where('student_id', '=', $parent->student_id)
                ->where('status', '=', 'telat')
                ->get();

            $tugas = $tugas->count();
            $tugasBelum =  $tugasBelum->count();
            $tugasTelat =  $tugasTelat->count();

            if ($tugasBelum == 0 && $tugas > 0 && $tugasSelesai == 0) {
                $tugasBelum = $tugas;
            } else if ($tugasBelum == 0 && $tugas > 0 && $tugasSelesai > 0) {
                $tugasBelum = $tugas - $tugasSelesai;
            }

            return response()->json([
                'status' => true,
                'materi' => $materi,
                'tugas' => $tugas,
                'tugas_selesai' => $tugasSelesai,
                'tugas_belum' => $tugasBelum,
                'tugas_telat' => $tugasTelat,
                'diskusi' => $diskusi,
            ]);
        }
    }
}
