<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupportingDocumentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $validation =
        [
            'file_name' => ['required'],
            'file_supporting_doc' => ['required', 'mimes:pdf', 'max:2048'],
            'enable_download' => ['nullable','boolean'],
        ];

        return $validation;
    }


        /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'title cannot be empty',
            'file_document.required' => 'file cannot be empty',
            'file_document.max' => 'file must be under 2mb',
            'file_document.mimes' => 'file must be PDF only',
        ];
    }
}
