<?php

namespace App\Http\Controllers;

use App\Models\AdminStudent;
use App\Http\Requests\StoreAdminStudentRequest;
use App\Http\Requests\UpdateAdminStudentRequest;
use App\Http\Resources\AdminStudentResource;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class AdminStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('users')
            ->join('students', 'users.id', '=', 'students.user_id')
            ->where('users.role', '=', 'student')
            ->get();
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAdminStudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminStudentRequest $request)
    {
        $data = $request->validated();

        if (isset($data['foto'])) {
            $relativePath = $this->saveImage($data['foto']);
            $data['foto'] = $relativePath;
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['nis']),
            'role' => 'student',
            'foto' => $data['foto'],
            'gender' => $data['gender'],
            'address' => $data['address'],
        ]);

        $student = AdminStudent::create([
            'user_id' => $user->id,
            'nis' => $data['nis'],
            'is_active' => true
        ]);

        return new AdminStudentResource($student);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdminStudent  $adminStudent
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    {
        $data = DB::table('users')
            ->join('students', 'users.id', '=', 'students.user_id')
            ->where('users.role', '=', 'student')
            ->where('users.id', '=', $user_id)
            ->first();

        return response()->json([
            'user_id' => $data->user_id,
            'foto_url' => $data->foto ? URL::to($data->foto) : null,
            'name' => $data->name,
            'email' => $data->email,
            'nis' => $data->nis,
            'gender' => $data->gender,
            'address' => $data->address,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdminStudentRequest  $request
     * @param  \App\Models\AdminStudent  $adminStudent
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminStudentRequest $request)
    {
        $data = $request->validated();

        if (isset($data['foto'])) {
            $relativePath = $this->saveImage($data['foto']);
            $data['foto'] = $relativePath;

            DB::table('users')
                ->where('id', '=', $request->user_id)
                ->update([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => bcrypt($data['nis']),
                    'role' => 'student',
                    'foto' => $data['foto'],
                    'gender' => $data['gender'],
                    'address' => $data['address'],
                ]);
        } else {
            DB::table('users')
                ->where('id', '=', $request->user_id)
                ->update([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => bcrypt($data['nis']),
                    'role' => 'student',
                    'gender' => $data['gender'],
                    'address' => $data['address'],
                ]);
        }


        $student = DB::table('students')
            ->where('user_id', '=', $request->user_id)
            ->update([
                'user_id' => $request->user_id,
                'nis' => $data['nis'],
                'is_active' => true
            ]);

        return response()->json($student);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdminStudent  $adminStudent
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id)
    {
        DB::table('users')->where('id', '=', $user_id)->delete();
        DB::table('students')->where('user_id', '=', $user_id)->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'data berhasil dihapus'
        ]);
    }

    private function saveImage($image)
    {
        // Check if image is valid base64 string
        if (preg_match('/^data:image\/(\w+);base64,/', $image, $type)) {
            // Take out the base64 encoded text without mime type
            $image = substr($image, strpos($image, ',') + 1);
            // Get file extension
            $type = strtolower($type[1]); // jpg, png, gif

            // Check if file is an image
            if (!in_array($type, ['jpg', 'jpeg', 'gif', 'png'])) {
                throw new \Exception('invalid image type');
            }
            $image = str_replace(' ', '+', $image);
            $image = base64_decode($image);

            if ($image === false) {
                throw new \Exception('base64_decode failed');
            }
        } else {
            throw new \Exception('did not match data URI with image data');
        }

        $dir = 'assets/images/student/';
        $file = Str::random() . '.' . $type;
        $absolutePath = public_path($dir);
        $relativePath = $dir . $file;
        if (!File::exists($absolutePath)) {
            File::makeDirectory($absolutePath, 0755, true);
        }
        file_put_contents($relativePath, $image);

        return $relativePath;
    }
}
