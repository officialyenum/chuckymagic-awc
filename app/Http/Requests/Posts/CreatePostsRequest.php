<?php

namespace App\Http\Requests\Posts;

use Facade\FlareClient\Http\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\Console\Input\Input;

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
            'title' => 'required|max:255|unique:posts,title',
            'description' => 'required|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:5120',
            'content' => 'required',
            'category' => 'required'
        ];

    }
}
