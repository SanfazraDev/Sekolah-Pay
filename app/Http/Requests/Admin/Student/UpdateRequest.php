<?php

namespace App\Http\Requests\Admin\Student;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'nisn' => ['required', 'numeric', 'unique:students,nisn,' . $this->student->id],
            'email' => ['required', 'email', 'max:50', 'unique:students,email,' . $this->student->id],
            'phone' => ['nullable', 'string', 'max:20'],
            'classroom_id' => ['required', 'exists:classrooms,id', 'numeric'],
            // Password is optional for update
            'password' => ['nullable', 'string', 'min:8'],
        ];
    }
}
