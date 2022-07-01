<?php

namespace App\Http\Controllers;

use App\Models\AdminTeacher;
use App\Http\Requests\StoreAdminTeacherRequest;
use App\Http\Requests\UpdateAdminTeacherRequest;
use App\Http\Resources\AdminTeacherResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class AdminTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('users')
            ->join('teachers', 'users.id', '=', 'teachers.user_id')
            ->where('users.role', '=', 'teacher')
            ->get();
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAdminTeacherRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'foto' => 'nullable|string',
            'gender' => 'required',
            'address' => 'required',
            'nip' => 'required|unique:teachers,nip',
            'user_id' => 'exists:users,id'
        ], [], [
            'nip' => 'data guru'
        ]);

        if (isset($data['foto'])) {
            $relativePath = $this->saveImage($data['foto']);
            $data['foto'] = $relativePath;
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['nip']),
            'role' => 'teacher',
            'foto' => $data['foto'],
            'gender' => $data['gender'],
            'address' => $data['address'],
        ]);

        $teacher = AdminTeacher::create([
            'user_id' => $user->id,
            'nip' => $data['nip'],
            'is_active' => true
        ]);

        return response()->json([
            'success' => true
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdminTeacher  $adminTeacher
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = DB::table('users')
            ->join('teachers', 'users.id', '=', 'teachers.user_id')
            ->where('users.role', '=', 'teacher')
            ->where('users.id', '=', $id)
            ->first();

        return response()->json([
            'user_id' => $data->user_id,
            'foto_url' => $data->foto ? URL::to($data->foto) : null,
            'name' => $data->name,
            'email' => $data->email,
            'nip' => $data->nip,
            'gender' => $data->gender,
            'address' => $data->address,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdminTeacherRequest  $request
     * @param  \App\Models\AdminTeacher  $adminTeacher
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminTeacherRequest $request)
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
                    'password' => bcrypt($data['nip']),
                    'role' => 'teacher',
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
                    'password' => bcrypt($data['nip']),
                    'role' => 'teacher',
                    'gender' => $data['gender'],
                    'address' => $data['address'],
                ]);
        }


        $teacher = DB::table('teachers')
            ->where('user_id', '=', $request->user_id)
            ->update([
                'user_id' => $request->user_id,
                'nip' => $data['nip'],
                'is_active' => true
            ]);

        return response()->json($teacher);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdminTeacher  $adminTeacher
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id)
    {
        DB::table('teachers')->where('user_id', '=', $user_id)->delete();
        DB::table('users')->where('id', '=', $user_id)->delete();
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

        $dir = 'assets/images/teacher/';
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
