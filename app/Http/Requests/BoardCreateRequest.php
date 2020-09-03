<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Support\Facades\Log;

class BoardCreateRequest extends FormRequest
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
            'board_name'   => ['required','max:255'],
        ];
    }

    public function messages(){
        return [
            'board_name.required'  => 'ボード名を入力してください。',
            'board_name.max'       => 'ボード名は255字以内で入力してください。',
        ];
    }
}
