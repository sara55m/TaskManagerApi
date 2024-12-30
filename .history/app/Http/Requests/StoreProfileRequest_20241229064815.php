<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProfileRequest extends FormRequest
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
            'phone'=>'required|string|size:11',
            'address'=>'nullable|string|min:5|max:100',
            'date_of_birth'=>'nullable|date',
            'bio'=>'nullable|string|min:10|max:255',
            'user_id'=>'required|exists:users,id',
        ];
    }
}
