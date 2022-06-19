<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ParentAssignmentController extends Controller
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
        if ($parent->student_id == null) {
            return response()->json([
                'keterangan' => $keterangan,
                'assignments' => []
            ]);
        } else {
            $keterangan = true;
            $student = DB::table('students')->where('id', '=', $parent->student_id)->first();

            $assignments = DB::table('assignments')
                ->join('student_assignments', 'assignments.id', '=', 'student_assignments.assignment_id')
                ->select('assignments.id as assignment_id', 'assignments.title', 'assignments.due_date', 'student_assignments.status', 'student_assignments.created_at')
                ->where('student_assignments.student_id', '=', $student->id)
                ->get();

            return response()->json([
                'keterangan' => $keterangan,
                'assignments' => $assignments
            ]);
        }
    }
}
