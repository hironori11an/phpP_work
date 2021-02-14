<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class loginKanriRequest extends FormRequest
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
            'name' => 'between:4,8|alpha_dash_check',
            'password' => 'between:4,8|alpha_dash_check',
        ];
    }

    public function messages()
    {
        return [
            'name.between' => config('const.validation.USERID_LIMIT_CHARACTER_NUMBER'),
            'name.alpha_dash_check' => config('const.validation.PASSWORD_AVAILABLE_CHARACTER'),
            'password.between' => config('const.validation.PASSWORD_LIMIT_CHARACTER_NUMBER'),
            'password.alpha_dash_check' => config('const.validation.PASSWORD_AVAILABLE_CHARACTER'),

        ];
    }
}
