<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentDiscussController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('discusses')->orderByDesc('created_at')->get();
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
            'comment' => 'required|min:3'
        ], [], [
            'comment' => 'komentar'
        ]);

        $user = $request->user();

        $data = Comment::create([
            'user_id' => $user->id,
            'discuss_id' => $request->discuss_id,
            'comment' => $request->comment
        ]);

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $status = null;
        $discuss = DB::table('discusses')
            ->where('discusses.id', '=', $id)
            ->first();

        $comments = DB::table('comments')
            ->join('users', 'comments.user_id', '=', 'users.id')
            ->select('comments.id as id', 'comments.user_id as user_id', 'comments.comment as comment', 'users.name as name', 'comments.created_at as created_at', 'comments.updated_at as created_at')
            ->where('discuss_id', '=', $id)->get();

        $user = $request->user();
        $student = DB::table('students')->where('user_id', '=', $user->id)->first();

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
            'student_user_id' => $student->user_id,
            'discuss_status' => $status,
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
        DB::table('comments')->where('id', '=', $id)->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'data berhasil dihapus'
        ]);
    }
}
