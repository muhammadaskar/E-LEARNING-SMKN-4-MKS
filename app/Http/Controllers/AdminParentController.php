<?php

namespace App\Http\Controllers;

use App\Models\AdminParent;
use App\Http\Requests\StoreAdminParentRequest;
use App\Http\Requests\UpdateAdminParentRequest;
use App\Http\Resources\AdminParentResource;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class AdminParentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('users')
            ->join('parents', 'users.id', '=', 'parents.user_id')
            // ->join('students', 'parents.student_id', '=', 'students.id')
            // ->join('users as users_students', 'students.user_id', '=', 'users_students.id')
            ->select('users.id as user_parent_id', 'users.name as parent_name', 'users.email as parent_email', 'users.gender as parent_gender', 'parents.*')
            ->where('users.role', '=', 'parent')
            ->get();

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAdminParentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminParentRequest $request)
    {
        $data = $request->validated();

        if (isset($data['foto'])) {
            $relativePath = $this->saveImage($data['foto']);
            $data['foto'] = $relativePath;
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['nik']),
            'role' => 'parent',
            'foto' => $data['foto'],
            'gender' => $data['gender'],
            'address' => $data['address'],
        ]);

        $student = AdminParent::create([
            'user_id' => $user->id,
            'student_id' => $data['student_id'],
            'nik' => $data['nik'],
            'is_active' => true
        ]);

        return new AdminParentResource($student);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdminParent  $adminParent
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    {
        $data = DB::table('users')
            ->join('parents', 'users.id', '=', 'parents.user_id')
            ->where('users.role', '=', 'parent')
            ->where('users.id', '=', $user_id)
            ->first();

        return response()->json([
            'user_parent_id' => $data->user_id,
            'foto_url' => $data->foto ? URL::to($data->foto) : null,
            'name' => $data->name,
            'email' => $data->email,
            'nik' => $data->nik,
            'gender' => $data->gender,
            'address' => $data->address,
            'student_id' => $data->student_id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdminParentRequest  $request
     * @param  \App\Models\AdminParent  $adminParent
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminParentRequest $request)
    {
        $data = $request->validated();

        if (isset($data['foto'])) {
            $relativePath = $this->saveImage($data['foto']);
            $data['foto'] = $relativePath;

            DB::table('users')
                ->where('id', '=', $request->user_parent_id)
                ->update([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'role' => 'parent',
                    'foto' => $data['foto'],
                    'gender' => $data['gender'],
                    'address' => $data['address'],
                ]);
        } else {
            DB::table('users')
                ->where('id', '=', $request->user_parent_id)
                ->update([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'role' => 'parent',
                    'gender' => $data['gender'],
                    'address' => $data['address'],
                ]);
        }


        $parents = DB::table('parents')
            ->where('user_id', '=', $request->user_parent_id)
            ->update([
                'user_id' => $request->user_parent_id,
                'student_id' => $data['student_id'],
                'nik' => $data['nik'],
                'is_active' => true
            ]);

        return response()->json($parents);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdminParent  $adminParent
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id)
    {
        DB::table('users')->where('id', '=', $user_id)->delete();
        DB::table('parents')->where('user_id', '=', $user_id)->delete();
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

        $dir = 'assets/images/parent/';
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
