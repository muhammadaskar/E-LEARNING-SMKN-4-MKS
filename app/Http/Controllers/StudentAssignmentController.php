<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\StudentAssignment;
use Carbon\Carbon;
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
        // $data = DB::table('assignments')->orderByDesc('created_at')->get();

        $data = Assignment::orderByDesc('created_at')->get()->all();

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
        } else if ($date == $formattedTime && $time > $time_due_date) {
            $status = "telat";
        } else {
            $status = "tepat_waktu";
        }


        $stdAssignment = DB::table('student_assignments')
            ->where('student_id', '=', $student->id)
            ->where('assignment_id', '=', $assignment->id)
            ->where('status', '=', 'belum_dikumpulkan')
            ->first();

        if ($request->status_pengerjaan == "belum_dikumpulkan") {
            if ($stdAssignment == null) {
                $studentAssignments = StudentAssignment::create([
                    'student_id' => $student->id,
                    'assignment_id' => $request->assignment_id,
                    'file' => $fileName,
                    'nilai' => 0,
                    'status' => $status,
                ]);
            } else {
                $studentAssignments = DB::table('student_assignments')
                    ->where('id', '=', $stdAssignment->id)
                    ->update([
                        'student_id' => $student->id,
                        'assignment_id' => $request->assignment_id,
                        'file' => $fileName,
                        'nilai' => 0,
                        'status' => $status,
                    ]);
            }
        } else {
            $studentAssignments = DB::table('student_assignments')
                ->where('id', '=', $studentAssignment->id)
                ->update([
                    'student_id' => $student->id,
                    'assignment_id' => $request->assignment_id,
                    'file' => $fileName,
                    'nilai' => 0,
                    'status' => $status,
                ]);
        }


        return response()->json([
            'success' => true,
            'message' => 'tugas siswa berhasil dikirim',
            'data' => $studentAssignments
        ]);
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

        $d = new DateTime($assignment->due_date);
        $formattedTime = $d;
        $formattedTimee = $d;
        $formattedTime = $formattedTime->format('Y-m-d');
        $time_due_date = $formattedTimee->format('H:i');

        if ($studentAssignment == null) {
            return response()->json([
                'assignment_id' => $id,
                'student_assignment_id' => null,
                'title' => $assignment->title,
                'slug' => $assignment->slug,
                'description' => $assignment->description,
                'due_date' => Carbon::parse($assignment->due_date)->isoFormat('dddd, D MMMM Y') . " " . $time_due_date,
                'status_pengerjaan' => 'belum_dikumpulkan'
            ]);
        }

        return response()->json([
            'assignment_id' => $id,
            'student_assignment_id' => $studentAssignment->id,
            'title' => $assignment->title,
            'slug' => $assignment->slug,
            'description' => $assignment->description,
            'due_date' => Carbon::parse($assignment->due_date)->isoFormat('dddd, D MMMM Y') . " " . $time_due_date,
            'file' => $studentAssignment->file,
            'status_pengerjaan' => $studentAssignment->status,
            'submited_at' => $studentAssignment->created_at,
        ]);
    }
}
