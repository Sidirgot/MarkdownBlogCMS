<?php

namespace App\Http\Requests;

use App\Traits\HandleImages;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    use HandleImages;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->isMethod('post')) {
            return [
                'name' => 'required|min:4',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:5'
            ];
        }

        if (request()->hasFile('avatar')) {
            return [
                'avatar' => 'required|file|image|max:2000'
            ];
        }

        return [
            'name' => 'sometimes|min:4',
            'email' => 'sometimes|email',
            'password' => 'sometimes|min:5'
        ];
    }
}
