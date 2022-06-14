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

        $student = DB::table('students')->where('id', '=', $parent->student_id)->first();

        $materis = DB::table('materis')
            ->join('student_materi_access_statuses as status', 'materis.id', '=', 'status.materi_id')
            ->where('status.student_id', '=', $student->id)
            ->get();

        return response()->json($materis);
    }
}
