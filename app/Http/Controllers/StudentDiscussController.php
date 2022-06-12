<?php

namespace App\Http\Controllers;

use App\Models\Comment;
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
        $discuss = DB::table('discusses')
            ->where('discusses.id', '=', $id)
            ->first();

        $comments = DB::table('comments')->where('discuss_id', '=', $id)->get();

        $user = $request->user();
        $student = DB::table('students')->where('user_id', '=', $user->id)->first();


        return response()->json([
            'discuss' => $discuss,
            'comments' => $comments,
            'student_user_id' => $student->user_id,
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
        DB::table('comments')->where('id', '=', $id)->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'data berhasil dihapus'
        ]);
    }
}
