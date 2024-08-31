<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'teacher_name' => 'required|string',
            'marital_status' => 'required|string',
            'qualification' => 'required|string',
            'gender' => 'required|in:male,female,other',
            'd_o_b' => 'required|date',
            'c_address' => 'nullable|string',
            'p_address' => 'nullable|string',
            'religion' => 'nullable|string',
            'mobile_number' => 'required|unique:teacher_modals|string',
            'd_o_j' => 'required|date',
            'profile_pic' => 'nullable|image|max:5120|mimes:jpeg,png,jpg,gif',
            'experience' => 'nullable|string',
            'note' => 'nullable|string',
            'blood_group' => 'nullable|string',
            'status' => 'nullable|boolean',
        ];
    }
}
