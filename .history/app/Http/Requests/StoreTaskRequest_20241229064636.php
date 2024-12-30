<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
            'title'=>'required|min:3|string',
            'description'=>'nullable|string|min:5|max:255',
            'priority'=>'required|integer',
            'user_id'=>'required|exists:users,id',
        ];
    }

    public function messages(): array
    {
        return [
            'title.string'=>'title must be string',
            'description.min'=>'description must be more than five characters',
            'priority.integer'=>'priority must be an  integer',
        ];
    }
}
