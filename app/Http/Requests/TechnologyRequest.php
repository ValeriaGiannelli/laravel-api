<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TechnologyRequest extends FormRequest
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
            'name' => 'required|unique:technologies,name|min:3|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'=>'Il campo è obbligatorio',
            'name.min'=>'Il campo deve avere minimo :min caratteri',
            'name.max'=>'Il campo deve avere massimo :max caratteri',
            'name.unique'=>'Il campo è già presente nella lista',
        ];
    }
}
