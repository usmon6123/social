<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionStoreRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {

        return [
            'title' => 'required',
            'category' => 'required',
            'text' => 'required',
            'tags' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'title' => 'Iltimos Sarlavhani kiriting',
            'category' => 'Iltimos kategoriya tanlang',
            'text' => 'Iltimos savolingizni yozing',
            'tags'=>'iltimos etiket kiriting'
        ];
    }
}
