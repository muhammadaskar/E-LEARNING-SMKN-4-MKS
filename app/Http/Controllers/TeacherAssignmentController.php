<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
            'title' => 'judul',
            'description' => 'deskripsi',
            'due_date' => 'tenggang waktu',
        ]);



        $d = new DateTime($request->due_date);
        $timezone = new DateTimeZone('Asia/Jakarta');
        $formattedTime = $d;
        // $formattedTime = $formattedTime->format('d-m-Y H:i:s');
        $date = $formattedTime->setTimezone($timezone);

        $data = Assignment::create([
            'title' => $request->title,
            'slug' =>  \Illuminate\Support\Str::slug($request->title, '-'),
            'description' => $request->description,
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
        $data = Assignment::find($id);
        return response()->json($data);
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
            'title' => 'required|unique:assignments,title',
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
        DB::table('assignments')->where('id', '=', $id)->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'data berhasil dihapus'
        ]);
    }
}
