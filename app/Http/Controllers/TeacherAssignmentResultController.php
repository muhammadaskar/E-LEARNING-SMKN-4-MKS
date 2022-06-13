<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class TeacherAssignmentResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $studentAssignment = DB::table('student_assignments')
            ->join('students', 'student_assignments.student_id', '=', 'students.id')
            ->join('users', 'students.user_id', '=', 'users.id')
            ->select('student_assignments.id', 'student_assignments.assignment_id', 'student_assignments.file', 'student_assignments.created_at', 'users.name', 'student_assignments.status', 'student_assignments.nilai', 'users.foto')
            ->where('student_assignments.id', '=', $id)->first();

        $assignment = DB::table('assignments')
            ->where('id', '=', $studentAssignment->assignment_id)
            ->first();

        return response()->json([
            'title' => $assignment->title,
            'description' => $assignment->description,
            'due_date' => $assignment->due_date,
            'id' => $studentAssignment->id,
            'assignment_id' => $studentAssignment->assignment_id,
            'name' => $studentAssignment->name,
            'foto' => URL::to($studentAssignment->foto),
            'file' => URL::to($studentAssignment->file),
            'status_pengerjaan' => $studentAssignment->status,
            'nilai' => $studentAssignment->nilai,
            'created_at' => $studentAssignment->created_at,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
