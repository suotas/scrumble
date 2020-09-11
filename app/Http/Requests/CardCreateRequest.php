<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CardCreateRequest extends FormRequest
{
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
     * @return array
     */
    public function rules()
    {
        return [
            'card_name' => ['required', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'card_name.required' => 'カード名を入力してください。',
            'card_name.max' => 'カード名は255字以内で入力してください。',
        ];
    }
}
