<?php

namespace App\Http\Controllers;

use App\Models\AdminTeacher;
use App\Http\Requests\StoreAdminTeacherRequest;
use App\Http\Requests\UpdateAdminTeacherRequest;
use App\Http\Resources\AdminTeacherResource;
use App\Models\User;
use Illuminate\Http\Request;

class AdminTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'ini adalah admin teacher';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAdminTeacherRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminTeacherRequest $request)
    {
        $data = $request->validated();

        if (isset($data['foto'])) {
            $relativePath = $this->saveImage($data['foto']);
            $data['foto'] = $relativePath;
        } else {
            $data['foto'] = 'default.png';
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['nip']),
            'role' => 'teacher',
            'foto' => $data['foto'],
        ]);

        $teacher = AdminTeacher::create([
            'user_id' => $user->id,
            'nip' => $data['nip'],
            'is_active' => true
        ]);

        return new AdminTeacherResource($teacher);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdminTeacher  $adminTeacher
     * @return \Illuminate\Http\Response
     */
    public function show(AdminTeacher $adminTeacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdminTeacherRequest  $request
     * @param  \App\Models\AdminTeacher  $adminTeacher
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminTeacherRequest $request, AdminTeacher $adminTeacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdminTeacher  $adminTeacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdminTeacher $adminTeacher)
    {
        //
    }
}
