<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentRequest extends FormRequest
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
        $validation =
        [
            'document_category_id' => ['required'],
            'doc_number' => ['required'],
            'title' => ['required'],
            'description' => ['required'],
            'file_document' => ['required', 'mimes:pdf', 'max:2048'],
            'enable_download' => ['nullable','boolean'],
        ];

        if ($this->isMethod('post')) {
            $validation['file_document'] = ['required', 'mimes:pdf', 'max:2048'];
        }

        if (!$this->isMethod('post')) {
            $validation['file_document'] = ['nullable', 'mimes:pdf', 'max:2048'];
            $validation['file_supporting_doc.*'] = ['nullable', 'mimes:pdf', 'max:2048'];
        }

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
            'description.required' => 'description cannot be empty',
            'file_document.required' => 'file cannot be empty',
            'file_document.max' => 'file must be under 2mb',
            'file_document.mimes' => 'file must be PDF only',
        ];
    }
}
