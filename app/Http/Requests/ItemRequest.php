<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
        //商品管理ページのフォームリクエスト処理
        return [
            //
            'name' => 'required|max:20',
            'price'=>'required|min:0',
            'stock'=>'required|min:0',
            'status'=>'boolean',
            'image' => [
                'file',
                'image',
                'mimes:jpeg,png',
                'dimensions:min_width=100,min_height=100,max_width=600,max_height=600',

            ]
        ];
    }
}
