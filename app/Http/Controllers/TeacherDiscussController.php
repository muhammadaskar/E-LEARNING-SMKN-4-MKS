<?php

namespace App\Http\Controllers;

use App\Models\Discuss;
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
            ->where('discusses.teacher_id', '=', $teacher->id)->select('discusses.id as id', 'discusses.topic as topic', 'discusses.created_at as created_at', 'teachers.id as teacher_id')->orderByDesc('discusses.created_at')->get();
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

        $data = Discuss::create([
            'teacher_id' => $teacher->id,
            'topic' => $request->text
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
            ->join('teachers', 'discusses.teacher_id', '=', 'teachers.id')
            ->where('discusses.id', '=', $id)
            ->first();

        $comments = DB::table('comments')->where('discuss_id', '=', $id)->get();
        return response()->json([
            'discuss' => $discuss,
            'comments' => $comments,
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

        $data = DB::table('discusses')
            ->where('id', '=', $request->id)
            ->update([
                'teacher_id' => $teacher->id,
                'topic' => $request->topic
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
        DB::table('comments')->where('discuss_id', '=', $id)->delete();
        DB::table('discusses')->where('id', '=', $id)->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'data berhasil dihapus'
        ]);
    }
}
