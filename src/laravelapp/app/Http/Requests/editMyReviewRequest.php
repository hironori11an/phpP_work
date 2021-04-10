<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class editMyReviewRequest extends FormRequest
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
            'review_niy' => 'required',
            'photo' => 'mimes:jpeg,png,jpg,gif|max:2048'

        ];
    }
    public function messages()
    {
        return [
            'required'=>':attribute は必須項目です',
            'mimes'=>':attributeファイルには jpeg,png,jpg,gif のうちいずれかの形式にしてください',
            'max'=>':attributeファイルのサイズは 2048KB 以内にしてください',
    ];
    }
    public function attributes()
    {
        $attributes = [];
        $attributes = array_merge(
            $attributes,
            [
                "title" => "タイトル",
                "chysh" => "著者",
                "review_niy" => "レビュー",
                "photo" => "画像",
            ]
        );
        return $attributes;
    }
}
