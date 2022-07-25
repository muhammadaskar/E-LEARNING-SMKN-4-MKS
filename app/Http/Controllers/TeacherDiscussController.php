<?php

namespace App\Http\Controllers;

use App\Models\Discuss;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherDiscussController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $teacher = DB::table('teachers')->where('user_id', '=', $user->id)->first();

        $data = DB::table('discusses')
            ->join('teachers', 'discusses.teacher_id', '=', 'teachers.id')
            ->where('discusses.teacher_id', '=', $teacher->id)->select('discusses.id as id', 'discusses.topic as topic', 'discusses.created_at as created_at', 'teachers.id as teacher_id', 'discusses.due_date')->orderByDesc('discusses.created_at')->get();
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
        $user = $request->user();
        $teacher = DB::table('teachers')->where('user_id', '=', $user->id)->first();

        $request->validate([
            'topic' => 'required',
            'due_date' => 'required',
        ]);

        $d = new DateTime($request->due_date);
        $timezone = new DateTimeZone('Asia/Jakarta');
        $formattedTime = $d;

        $date = $formattedTime->setTimezone($timezone);

        $data = Discuss::create([
            'teacher_id' => $teacher->id,
            'topic' => $request->topic,
            'due_date' => $date
        ]);

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
        $status = null;
        $discuss = DB::table('discusses')
            ->join('teachers', 'discusses.teacher_id', '=', 'teachers.id')
            ->where('discusses.id', '=', $id)
            ->select('discusses.*', 'teachers.user_id as user_id')
            ->first();

        $comments = DB::table('comments')
            ->join('users', 'comments.user_id', '=', 'users.id')
            ->select('comments.id as id', 'comments.user_id as user_id', 'comments.comment as comment', 'users.name as name', 'comments.created_at as created_at', 'comments.updated_at as created_at')
            ->where('discuss_id', '=', $id)->get();

        $date = date('Y-m-d');
        $time = date('H:i:s');

        $d = new DateTime($discuss->due_date);
        $formattedTime = $d;
        $formattedTimee = $d;
        $formattedTime = $formattedTime->format('Y-m-d');
        $time_due_date = $formattedTimee->format('H:i:s');

        if ($date > $formattedTime) {
            $status = "closed";
        } else if ($date == $formattedTime && $time > $time_due_date) {
            $status = "closed";
        } else {
            $status = "opened";
        }

        return response()->json([
            'discuss' => $discuss,
            'comments' => $comments,
            'discuss_status' => $status,
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
        $user = $request->user();
        $teacher = DB::table('teachers')->where('user_id', '=', $user->id)->first();

        $d = new DateTime($request->due_date);
        $timezone = new DateTimeZone('Asia/Jakarta');
        $formattedTime = $d;

        $date = $formattedTime->setTimezone($timezone);

        $data = DB::table('discusses')
            ->where('id', '=', $request->id)
            ->update([
                'teacher_id' => $teacher->id,
                'topic' => $request->topic,
                'due_date' => $date
            ]);

        return response()->json($data);
        // return response()->json($request->due_date);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('comments')->where('discuss_id', '=', $id)->delete();
        DB::table('discusses')->where('id', '=', $id)->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'data berhasil dihapus'
        ]);
    }
}
