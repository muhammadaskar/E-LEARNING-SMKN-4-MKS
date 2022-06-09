<?php

namespace App\Http\Controllers;

use App\Models\StudentEvaluationQuestionAnswer;
use App\Models\StudentMateriAccessStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentMateriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('materis')->orderByDesc('created_at')->get();
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
        $student = DB::table('students')->where('user_id', '=', $user->id)->first();

        $answer = StudentEvaluationQuestionAnswer::create(
            [
                'evaluation_id' => $request->id,
                'student_id' => $student->id,
                'answer1' => $request->answer_1,
                'answer2' => $request->answer_2,
                'answer3' => $request->answer_3,
            ]
        );

        $status = StudentMateriAccessStatus::create([
            'materi_id' => $request->materi_id,
            'student_id' => $student->id,
            'status_pengerjaan' => 'selesai'
        ]);



        return response()->json([
            'status' => 201,
            'success' => true,
            'data' => [$answer, $status]
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

        $statusAccessMateri = DB::table('student_materi_access_statuses')
            ->where('materi_id', '=', $id)
            ->where('student_id', '=', $student->id)
            ->first();

        $materi = DB::table('materis')
            ->join('evaluation_questions', 'materis.id', '=', 'evaluation_questions.materi_id')
            ->select('materis.*', 'evaluation_questions.*', 'evaluation_questions.id as evaluation_questions_id')
            ->where('materis.id', '=', $id)
            ->first();

        if ($statusAccessMateri == null) {
            return response()->json([
                'id' => $materi->evaluation_questions_id,
                'materi_id' => $id,
                'title' => $materi->title,
                'slug' =>  $materi->slug,
                'file' => $materi->file,
                'link' => $materi->link,
                'description' => $materi->description,
                'question1' => $materi->question1,
                'question2' => $materi->question2,
                'question3' => $materi->question3,
                'jawaban_a_pertanyaan_1' => $materi->jawaban_a_pertanyaan_1,
                'jawaban_b_pertanyaan_1' => $materi->jawaban_b_pertanyaan_1,
                'jawaban_c_pertanyaan_1' => $materi->jawaban_c_pertanyaan_1,
                'jawaban_d_pertanyaan_1' => $materi->jawaban_d_pertanyaan_1,
                'jawaban_a_pertanyaan_2' => $materi->jawaban_a_pertanyaan_2,
                'jawaban_b_pertanyaan_2' => $materi->jawaban_b_pertanyaan_2,
                'jawaban_c_pertanyaan_2' => $materi->jawaban_c_pertanyaan_2,
                'jawaban_d_pertanyaan_2' => $materi->jawaban_d_pertanyaan_2,
                'jawaban_a_pertanyaan_3' => $materi->jawaban_a_pertanyaan_3,
                'jawaban_b_pertanyaan_3' => $materi->jawaban_b_pertanyaan_3,
                'jawaban_c_pertanyaan_3' => $materi->jawaban_c_pertanyaan_3,
                'jawaban_d_pertanyaan_3' => $materi->jawaban_d_pertanyaan_3,
                'status_pengerjaan' => 'belum_selesai',
                'created_at' => $materi->created_at
            ]);
        }

        return response()->json([
            'id' => $materi->evaluation_questions_id,
            'materi_id' => $id,
            'title' => $materi->title,
            'slug' =>  $materi->slug,
            'file' => $materi->file,
            'link' => $materi->link,
            'description' => $materi->description,
            'question1' => $materi->question1,
            'question2' => $materi->question2,
            'question3' => $materi->question3,
            'jawaban_a_pertanyaan_1' => $materi->jawaban_a_pertanyaan_1,
            'jawaban_b_pertanyaan_1' => $materi->jawaban_b_pertanyaan_1,
            'jawaban_c_pertanyaan_1' => $materi->jawaban_c_pertanyaan_1,
            'jawaban_d_pertanyaan_1' => $materi->jawaban_d_pertanyaan_1,
            'jawaban_a_pertanyaan_2' => $materi->jawaban_a_pertanyaan_2,
            'jawaban_b_pertanyaan_2' => $materi->jawaban_b_pertanyaan_2,
            'jawaban_c_pertanyaan_2' => $materi->jawaban_c_pertanyaan_2,
            'jawaban_d_pertanyaan_2' => $materi->jawaban_d_pertanyaan_2,
            'jawaban_a_pertanyaan_3' => $materi->jawaban_a_pertanyaan_3,
            'jawaban_b_pertanyaan_3' => $materi->jawaban_b_pertanyaan_3,
            'jawaban_c_pertanyaan_3' => $materi->jawaban_c_pertanyaan_3,
            'jawaban_d_pertanyaan_3' => $materi->jawaban_d_pertanyaan_3,
            'status_pengerjaan' => $statusAccessMateri->status_pengerjaan,
            'created_at' => $materi->created_at
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
