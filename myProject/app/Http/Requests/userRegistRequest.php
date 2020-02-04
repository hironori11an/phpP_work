<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class userRegistRequest extends FormRequest
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
            'between'=>':attribute ４桁から８桁で入力してください',
            'alpha_dash_check'=>':attribute 半角英数字・「_」・「-」の組み合せで入力してください',
    ];
    }

    public function attributes()
    {
        $attributes = [];
        $attributes = array_merge(
            $attributes,
            [
                "name" => "",
                "password" => "",
            ]
        );
        return $attributes;
    }
}
