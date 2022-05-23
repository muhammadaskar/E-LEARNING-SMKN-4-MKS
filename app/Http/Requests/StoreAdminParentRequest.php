<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdminParentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required',
            'foto' => 'nullable|string',
            'gender' => 'required',
            'address' => 'required',
            'nik' => 'required',
            'user_id' => 'exists:users,id',
            'student_id' => 'required'
        ];
    }
}
