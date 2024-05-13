<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceUpdateRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return auth()->user()->role == 'admin';
    }

    
    public function rules(): array
    {
        return [
            'title_uz' => 'required',
            'title_ru' => 'required',
            'description_uz' => 'required',
            'description_ru' => 'required',
            'image' => 'nullable',
        ];
    }
}
