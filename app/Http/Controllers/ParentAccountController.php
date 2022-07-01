<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ParentAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $data = DB::table('users')
            ->join('parents', 'users.id', '=', 'parents.user_id')
            ->where('users.role', '=', 'parent')
            ->where('users.id', '=', $user->id)
            ->first();
        return response()->json([
            'user_id' => $data->user_id,
            'foto_url' => $data->foto ? URL::to($data->foto) : null,
            'name' => $data->name,
            'email' => $data->email,
            'nik' => $data->nik,
            'gender' => $data->gender,
            'address' => $data->address,
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
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'foto' => 'nullable|string',
            'gender' => 'required',
            'address' => 'required',
            'nik' => 'required',
            'user_id' => 'exists:users,id'
        ]);

        $user = User::find($request->user_id);
        $password = $user->password;

        if (isset($request->password)) {
            $request->validate([
                'password' => [
                    'confirmed',
                    Password::min(8)->mixedCase()->numbers()->symbols()
                ], [], [
                    'password' => 'kata sandi'
                ]
            ]);

            $password = bcrypt($request->password);
        }

        if (isset($data['foto'])) {
            $relativePath = $this->saveImage($data['foto']);
            $data['foto'] = $relativePath;


            DB::table('users')
                ->where('id', '=', $request->user_id)
                ->update([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => $password,
                    'role' => 'parent',
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
                    'password' => $password,
                    'role' => 'parent',
                    'gender' => $data['gender'],
                    'address' => $data['address'],
                ]);
        }


        $student = DB::table('parents')
            ->where('user_id', '=', $request->user_id)
            ->update([
                'user_id' => $request->user_id,
                'nik' => $data['nik'],
                'is_active' => true
            ]);

        return response()->json($student);
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
