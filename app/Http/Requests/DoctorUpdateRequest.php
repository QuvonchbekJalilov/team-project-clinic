<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorUpdateRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return auth()->user()->role == 'admin';
    }

    
    public function rules(): array
    {
        return [
            'first_name_uz' => 'required',
            'first_name_ru' => 'required',
            'last_name_uz' => 'required',
            'last_name_ru' => 'required',
            'email' => 'required',
            'telegram_url' => 'nullable',
            'instagram_url' => 'nullable',
            'cost' => 'required',
            'experience' => 'required',
            'image' => 'nullable',
            'service_id' => 'required'
        ];
    }
}
