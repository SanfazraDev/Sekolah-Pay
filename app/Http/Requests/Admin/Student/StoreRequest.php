<?php

namespace App\Http\Requests\Admin\Student;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'nisn' => ['required', 'numeric', 'unique:students,nisn'],
            'email' => ['required', 'email', 'max:50', 'unique:students,nisn'],
            'phone' => ['nullable', 'string', 'max:20'],
            'classroom_id' => ['required', 'exists:classrooms,id', 'numeric'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }
}
