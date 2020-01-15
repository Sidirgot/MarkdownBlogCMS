<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SocialMediaRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->isMethod('post')) {
            return [
                'personal_account_url' => 'required|url',
                'social_share_url' => 'sometimes|url',
                'social_name' => 'required|string',
                'social_icon' => 'sometimes|string',
                'sharable' => 'sometimes'
            ];
        }

        return [
            'personal_account_url' => 'sometimes|url',
            'social_share_url' => 'sometimes|url',
            'social_name' => 'sometimes|string',
            'social_icon' => 'sometimes|string',
            'sharable' => 'sometimes'
        ];
    }
}
