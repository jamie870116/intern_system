<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class userRequest extends FormRequest
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
        'u_name'=>'required',
        'u_tel'=>'required',
        'account'=>'required',
        'password' => 'required|max:20|min:6'
        ];
    }

    public function messages(){
        return [
        'required'=>'此欄位不可為空白',
        'max'=>'字數請介於6~20位元',
        'min'=>'字數請介於6~20位元'
        ];
    }
}
