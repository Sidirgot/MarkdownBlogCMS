<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubscribersRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (request()->has('valid')) {
            abort(404, 'You Are Not Authorized');
        }

        return [
            'email' => 'required|email|unique:subscribers',
        ];
    }
}
