<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OnboardClientRequest extends FormRequest
{
    protected $stopOnFirstFailure=true;
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "date_profiled" => ['required','date_format:Y-m-d'],
            "primary_legal_counsel" => ['required','integer','exists:legal_counsels,id'],
            "date_of_birth" => ['required','date_format:Y-m-d'],
            "email" => ['required','email','unique:clients,email'],
            "case_detail" => ['required','string','min:20'],
            "lastname" => ['required','string','min:2'],
            "firstname" => ['required','string','min:2'],
            "profile_image" => 'nullable|mimes:png,jpg,jpeg|max:2048'
        ];
    }
}
