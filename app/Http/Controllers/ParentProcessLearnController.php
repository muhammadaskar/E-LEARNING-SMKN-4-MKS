<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ParentProcessLearnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $parent = DB::table('parents')->where('user_id', '=', $user->id)->first();

        $keterangan = false;
        // tambahkan keterangan jika student id null
        if ($parent->student_id == null) {
            return response()->json([
                'keterangan' => $keterangan,
                'materis' => [],
            ]);
        } else {
            $keterangan = true;
            $student = DB::table('students')->where('id', '=', $parent->student_id)->first();

            $materis = DB::table('materis')
                ->join('student_materi_access_statuses as status', 'materis.id', '=', 'status.materi_id')
                ->where('status.student_id', '=', $student->id)
                ->get();
            return response()->json([
                'keterangan' => $keterangan,
                'materis' => $materis,
            ]);
        }
    }
}
