<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
                'name' => 'required|string|unique:categories',
            ];
        }

        return [
            'name' => 'sometimes|string|unique:categories,name,'.$this->category->id,
        ];
    }
}
