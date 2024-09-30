<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'title'=>'required|min:5|max:100',
            'start_date'=>'required|date',
            'end_date'=>'required',
            'img_path'=>'image|mimes:png,jpg|max:5120'
        ];
    }

    public function messages()
    {
        return [
            'title.required'=>'Il titolo è un campo obbligatorio',
            'title.min'=>'Il titolo deve contenere come minimo :min caratteri',
            'title.min'=>'Il titolo deve contenere al massimo :max caratteri',
            'start_date.required'=>'La data è un campo obbligatorio',
            'start_date.date'=>'La data deve essere del formato YYYY-mm-dd',
            'end_date.required'=>'La data è un campo obbligatorio',
            'img_path.image'=>'Il file deve essere un\'immagine',
            'img_path.mimes'=>'Il file deve essere un formato :values',
            'img_path.max'=>'Il file non può superare i :max KB',
        ];
    }
}
