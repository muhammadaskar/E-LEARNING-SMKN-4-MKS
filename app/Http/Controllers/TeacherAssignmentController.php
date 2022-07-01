<?php

namespace App\Http\Controllers;

use App\Mail\Assignment as MailAssignment;
use App\Models\Assignment;
use App\Models\StudentAssignment;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
// email : muhammadaskar.dev
// pass : *Askar123deV*

class TeacherAssignmentController extends Controller
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

        $request->validate([
            'title' => 'required|unique:assignments,title',
            'description' => 'required',
            'due_date' => 'required'
        ], [
            //message
        ], [
            'title' => 'judul tugas',
            'description' => 'deskripsi',
            'due_date' => 'tenggang waktu',
        ]);



        $d = new DateTime($request->due_date);
        $timezone = new DateTimeZone('Asia/Jakarta');
        $formattedTime = $d;

        $date = $formattedTime->setTimezone($timezone);

        $data = Assignment::create([
            'title' => $request->title,
            'slug' =>  \Illuminate\Support\Str::slug($request->title, '-'),
            'description' => $request->description,
            'due_date' => $date
        ]);

        $students = DB::table('students')->get();

        $users = DB::table('users')
            ->where('role', '=', 'student')
            ->get();

        $d = new DateTime($request->due_date);
        $formattedTime = $d;
        $formattedTimee = $d;
        $tanggal = $formattedTime->format('Y-m-d');
        $waktu = $formattedTimee->format('H:i');

        foreach ($users as $user) {
            $mailData = [
                'name' => $user->name,
                'due_date' => Carbon::parse($tanggal)->isoFormat('dddd, D MMMM Y'),
                'time' => $waktu
            ];

            Mail::to($user->email)->send(new MailAssignment($mailData));
        }

        foreach ($students as $std) {
            StudentAssignment::create([
                'student_id' => $std->id,
                'assignment_id' => $data->id,
                'file' => 'kosong',
                'nilai' => 0,
                'status' => 'belum_dikumpulkan',
            ]);
        }
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $assignment = Assignment::find($id);

        $studentAssignments = DB::table('student_assignments')
            ->join('students', 'student_assignments.student_id', '=', 'students.id')
            ->join('users', 'students.user_id', '=', 'users.id')
            ->select('users.name', 'student_assignments.id as id', 'student_assignments.status', 'student_assignments.created_at')
            ->where('assignment_id', '=', $id)->get();


        return response()->json([
            'assignment' => $assignment,
            'student_assignments' => $studentAssignments
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
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'due_date' => 'required'
        ], [
            //message
        ], [
            'title' => 'judul',
            'description' => 'deskripsi',
            'due_date' => 'tenggang waktu',
        ]);

        $d = new DateTime($request->due_date);
        $timezone = new DateTimeZone('Asia/Jakarta');
        $formattedTime = $d;
        // $formattedTime = $formattedTime->format('d-m-Y H:i:s');
        $date = $formattedTime->setTimezone($timezone);

        $data = DB::table('assignments')
            ->where('id', '=', $request->id)
            ->update([
                'title' => $request->title,
                'slug' =>  \Illuminate\Support\Str::slug($request->title, '-'),
                'description' => $request->description,
                'due_date' => $date
            ]);
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('student_assignments')->where('assignment_id', '=', $id)->delete();
        DB::table('assignments')->where('id', '=', $id)->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'data berhasil dihapus'
        ]);
    }
}
