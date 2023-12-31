<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'user_name' =>'required:'.config('length.min_string').'|max:'.config('length.max_username'),
            'email' => 'required|email:'.config('length.max_email'),
            'password' => 'required|min:'.config('length.min_string').'|confirmed',
            'avatar'=> [
                'required',
                // 'mimes:jpeg,png',
                // 'mimetypes:image/jpeg,image/png',
            ],
        ];
    }
}
