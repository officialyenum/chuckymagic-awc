<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'username' => [
                'required',
                'max:255',
                Rule::unique('posts', 'title')->ignore($this->user->id),
            ],
            'description' => 'required|max:255',
            'avatar' => 'image|mimes:jpg,jpeg,png|max:5120|size:5120',
            'header_image' => 'image|mimes:jpg,jpeg,png|max:5120|size:5120',
            'location' => 'required',
            'education' => 'required',
            'bio' => 'required',
            'job_id' => 'required'
        ];
    }
}
