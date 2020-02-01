<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class reviewRequest extends FormRequest
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

    // //FormRequestのメソッドをオーバライド
    // protected function validationData(Request $request)
    // {
    //     // $request->merge(['user_name' => '2000']);
    //     return ($this->all());
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_name' => 'required',
            'genre' => 'required',
            'title' => 'required',
            'chysh' => 'required',
            'hyk' => 'required',
            'review_niy' => 'required'

        ];
    }
    // public function messages()
    // {
    //     return [
    //         'required'=>'必須項目です',
    // ];
    // }
}
