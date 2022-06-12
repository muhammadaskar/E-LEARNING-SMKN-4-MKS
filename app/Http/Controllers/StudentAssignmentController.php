<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\StudentAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use DateTime;
use DateTimeZone;

class StudentAssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('assignments')->orderByDesc('created_at')->get();
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fileName = null;
        $status = null;

        $request->validate([
            'file' => 'required',
        ]);

        $user = $request->user();
        $student = DB::table('students')->where('user_id', '=', $user->id)->first();

        $assignment = Assignment::find($request->assignment_id);

        $studentAssignment = DB::table('student_assignments')
            ->where('student_id', '=', $student->id)
            ->where('assignment_id', '=', $assignment->id)
            ->first();

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $dir = 'assets/file/tugas/';
            $filename = time() . '-' . $file->getClientOriginalName();
            $file = $file->move(public_path($dir), $filename);
            $fileName = $dir . $filename;
        }

        $date = date('Y-m-d');
        $time = date('H:i:s');

        $d = new DateTime($assignment->due_date);
        $formattedTime = $d;
        $formattedTimee = $d;
        $formattedTime = $formattedTime->format('Y-m-d');
        $time_due_date = $formattedTimee->format('H:i:s');

        if ($date > $formattedTime) {
            $status = "telat";
        } else {
            if ($time > $time_due_date) {
                $status = "telat";
            } else {
                $status = "tepat_waktu";
            }
        }

        if ($request->student_assignment_id == "null") {
            $studentAssignments = StudentAssignment::create([
                'student_id' => $student->id,
                'assignment_id' => $request->assignment_id,
                'file' => $filename,
                'nilai' => 0,
                'status' => $status,
            ]);
        } else {
            $studentAssignments = DB::table('student_assignments')
                ->where('id', '=', $request->student_assignment_id)
                ->update([
                    'student_id' => $student->id,
                    'assignment_id' => $request->assignment_id,
                    'file' => $studentAssignment->file,
                    'nilai' => 0,
                    'status' => $status,
                ]);
        }


        return response()->json([
            'success' => true,
            'message' => 'tugas siswa berhasil dikirim',
            'data' => $studentAssignments
        ]);

        // return response()->json([
        //     'now' => $date . " " . $time,
        //     'deadline' => $formattedTime . " " . $time_due_date
        // ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $user = $request->user();
        $student = DB::table('students')->where('user_id', '=', $user->id)->first();

        $assignment = Assignment::find($id);
        $studentAssignment = DB::table('student_assignments')
            ->where('student_id', '=', $student->id)
            ->where('assignment_id', '=', $id)->first();

        if ($studentAssignment == null) {
            return response()->json([
                'assignment_id' => $id,
                'student_assignment_id' => null,
                'title' => $assignment->title,
                'slug' => $assignment->slug,
                'description' => $assignment->description,
                'due_date' => $assignment->due_date,
                'status_pengerjaan' => 'belum_dikumpulkan'
            ]);
        }

        return response()->json([
            'assignment_id' => $id,
            'student_assignment_id' => $studentAssignment->id,
            'title' => $assignment->title,
            'slug' => $assignment->slug,
            'description' => $assignment->description,
            'due_date' => $assignment->due_date,
            'file' => $studentAssignment->file,
            'status_pengerjaan' => $studentAssignment->status,
            'submited_at' => $studentAssignment->created_at,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        return response()->json([
            'data' => $request->all()
        ]);
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
