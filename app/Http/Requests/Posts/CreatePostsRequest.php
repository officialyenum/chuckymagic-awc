<?php

namespace App\Http\Requests\Posts;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostsRequest extends FormRequest
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
            'title' => 'required|unique:posts',
            'description' => 'required|max:200',
            'image' => 'required|image|mimes:jpg,jpeg,png|size:2048',
            'content' => 'required',
            'category' => 'required'
        ];
    }
}
