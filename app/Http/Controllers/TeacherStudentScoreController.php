<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherStudentScoreController extends Controller
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
        //
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
        if ($request->nilai > 0 && $request->nilai <= 100) {
            $score = DB::table('student_assignments')
                ->where('id', '=', $request->id)
                ->update([
                    'nilai' => $request->nilai,
                ]);

            return response()->json([
                'success' => true,
                'message' => 'berhasil disimpan',
                'score' => $score
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'gagal disimpan',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $score = DB::table('student_assignments')
            ->where('id', '=', $id)
            ->update([
                'nilai' => 0,
            ]);

        return response()->json([
            'success' => true,
            'message' => 'berhasil dihapus',
            'score' => 0
        ]);
    }
}
