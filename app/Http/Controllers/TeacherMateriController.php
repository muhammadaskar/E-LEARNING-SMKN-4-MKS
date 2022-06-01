<?php

namespace App\Http\Controllers;

use App\Models\TeacherMateri;
use App\Http\Requests\StoreTeacherMateriRequest;
use App\Http\Requests\UpdateTeacherMateriRequest;
use App\Http\Resources\TeacherMateriResource;
use App\Models\EvaluationQuestion;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TeacherMateriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('materis')->get();
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTeacherMateriRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'file' => 'required|mimes:pdf,docx,pptx',
            'link' => 'required',
            'description' => 'required',
            'question1' => 'required',
            'question2' => 'required',
            'question3' => 'required',
            'jawaban_a_pertanyaan_1' => 'required',
            'jawaban_b_pertanyaan_1' => 'required',
            'jawaban_c_pertanyaan_1' => 'required',
            'jawaban_d_pertanyaan_1' => 'required',
            'jawaban_benar_pertanyaan_1' => 'required',
            'jawaban_a_pertanyaan_2' => 'required',
            'jawaban_b_pertanyaan_2' => 'required',
            'jawaban_c_pertanyaan_2' => 'required',
            'jawaban_d_pertanyaan_2' => 'required',
            'jawaban_benar_pertanyaan_2' => 'required',
            'jawaban_a_pertanyaan_3' => 'required',
            'jawaban_b_pertanyaan_3' => 'required',
            'jawaban_c_pertanyaan_3' => 'required',
            'jawaban_d_pertanyaan_3' => 'required',
            'jawaban_benar_pertanyaan_3' => 'required',
        ]);

        $fileName = null;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $dir = 'assets/file/materi/';
            $filename = time() . '-' . $file->getClientOriginalName();
            $file = $file->move(public_path($dir), $filename);
            $fileName = $dir . $filename;
        }

        $materi = TeacherMateri::create([
            'title' => $request->title,
            'slug' =>  \Illuminate\Support\Str::slug($request->title, '-'),
            'file' => $fileName,
            'link' => $request->link,
            'description' => $request->description,
        ]);


        EvaluationQuestion::create([
            'materi_id' => $materi->id,
            'question1' => $request->question1,
            'question2' => $request->question2,
            'question3' => $request->question3,
            'jawaban_a_pertanyaan_1' => $request->jawaban_a_pertanyaan_1,
            'jawaban_b_pertanyaan_1' => $request->jawaban_b_pertanyaan_1,
            'jawaban_c_pertanyaan_1' => $request->jawaban_c_pertanyaan_1,
            'jawaban_d_pertanyaan_1' => $request->jawaban_d_pertanyaan_1,
            'jawaban_benar_pertanyaan_1' => $request->jawaban_benar_pertanyaan_1,
            'jawaban_a_pertanyaan_2' => $request->jawaban_a_pertanyaan_2,
            'jawaban_b_pertanyaan_2' => $request->jawaban_b_pertanyaan_2,
            'jawaban_c_pertanyaan_2' => $request->jawaban_c_pertanyaan_2,
            'jawaban_d_pertanyaan_2' => $request->jawaban_d_pertanyaan_2,
            'jawaban_benar_pertanyaan_2' => $request->jawaban_benar_pertanyaan_2,
            'jawaban_a_pertanyaan_3' => $request->jawaban_a_pertanyaan_3,
            'jawaban_b_pertanyaan_3' => $request->jawaban_b_pertanyaan_3,
            'jawaban_c_pertanyaan_3' => $request->jawaban_c_pertanyaan_3,
            'jawaban_d_pertanyaan_3' => $request->jawaban_d_pertanyaan_3,
            'jawaban_benar_pertanyaan_3' => $request->jawaban_benar_pertanyaan_3
        ]);

        return new TeacherMateriResource($materi);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TeacherMateri  $teacherMateri
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = DB::table('materis')
            ->join('evaluation_questions', 'materis.id', '=', 'evaluation_questions.materi_id')
            ->where('materis.id', '=', $id)
            ->first();
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTeacherMateriRequest  $request
     * @param  \App\Models\TeacherMateri  $teacherMateri
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'file' => 'required|mimes:pdf,docx,pptx',
            'link' => 'required',
            'description' => 'required',
            'question1' => 'required',
            'question2' => 'required',
            'question3' => 'required',
            'jawaban_a_pertanyaan_1' => 'required',
            'jawaban_b_pertanyaan_1' => 'required',
            'jawaban_c_pertanyaan_1' => 'required',
            'jawaban_d_pertanyaan_1' => 'required',
            'jawaban_benar_pertanyaan_1' => 'required',
            'jawaban_a_pertanyaan_2' => 'required',
            'jawaban_b_pertanyaan_2' => 'required',
            'jawaban_c_pertanyaan_2' => 'required',
            'jawaban_d_pertanyaan_2' => 'required',
            'jawaban_benar_pertanyaan_2' => 'required',
            'jawaban_a_pertanyaan_3' => 'required',
            'jawaban_b_pertanyaan_3' => 'required',
            'jawaban_c_pertanyaan_3' => 'required',
            'jawaban_d_pertanyaan_3' => 'required',
            'jawaban_benar_pertanyaan_3' => 'required',
        ]);

        $fileName = null;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $dir = 'assets/file/materi/';
            $filename = time() . '-' . $file->getClientOriginalName();
            $file = $file->move(public_path($dir), $filename);
            $fileName = $dir . $filename;

            DB::table('materis')
                ->where('id', '=', $request->materi_id)
                ->update([
                    'title' => $request->title,
                    'slug' =>  \Illuminate\Support\Str::slug($request->title, '-'),
                    'file' => $fileName,
                    'link' => $request->link,
                    'description' => $request->description,
                ]);
        } else {
            DB::table('materis')
                ->where('id', '=', $request->materi_id)
                ->update([
                    'title' => $request->title,
                    'slug' =>  \Illuminate\Support\Str::slug($request->title, '-'),
                    'link' => $request->link,
                    'description' => $request->description,
                ]);
        }


        DB::table('evaluation_questions')
            ->where('materi_id', '=', $request->materi_id)
            ->update([
                'materi_id' => $request->materi_id,
                'question1' => $request->question1,
                'question2' => $request->question2,
                'question3' => $request->question3,
                'jawaban_a_pertanyaan_1' => $request->jawaban_a_pertanyaan_1,
                'jawaban_b_pertanyaan_1' => $request->jawaban_b_pertanyaan_1,
                'jawaban_c_pertanyaan_1' => $request->jawaban_c_pertanyaan_1,
                'jawaban_d_pertanyaan_1' => $request->jawaban_d_pertanyaan_1,
                'jawaban_benar_pertanyaan_1' => $request->jawaban_benar_pertanyaan_1,
                'jawaban_a_pertanyaan_2' => $request->jawaban_a_pertanyaan_2,
                'jawaban_b_pertanyaan_2' => $request->jawaban_b_pertanyaan_2,
                'jawaban_c_pertanyaan_2' => $request->jawaban_c_pertanyaan_2,
                'jawaban_d_pertanyaan_2' => $request->jawaban_d_pertanyaan_2,
                'jawaban_benar_pertanyaan_2' => $request->jawaban_benar_pertanyaan_2,
                'jawaban_a_pertanyaan_3' => $request->jawaban_a_pertanyaan_3,
                'jawaban_b_pertanyaan_3' => $request->jawaban_b_pertanyaan_3,
                'jawaban_c_pertanyaan_3' => $request->jawaban_c_pertanyaan_3,
                'jawaban_d_pertanyaan_3' => $request->jawaban_d_pertanyaan_3,
                'jawaban_benar_pertanyaan_3' => $request->jawaban_benar_pertanyaan_3
            ]);

        return response()->json([
            'success' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TeacherMateri  $teacherMateri
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('materis')->where('id', '=', $id)->delete();
        DB::table('evaluation_questions')->where('materi_id', '=', $id)->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'data berhasil dihapus'
        ]);
    }
}
