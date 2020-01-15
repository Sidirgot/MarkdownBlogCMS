<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->isMethod('post')) {
            return $this->createRules();
        }

        if ($this->isMethod('patch')) {
            return $this->updateRules();
        }
    }

    /**
     * Rules to be used when creating a post.
     *
     * @return void
     */
    protected function createRules()
    {
        return [
                'title' => 'required|string',
                'slug' =>  'sometimes|string',
                'content' => 'required',
                'status' => 'sometimes|boolean',
                'image' => 'required|file|image|max:5000',
                'published' => 'sometimes|date',
                'category_id' => 'required',
            ];
    }

    /**
     * Rules to be used when updating a post.
     *
     * @return void
     */
    protected function updateRules()
    {
        return [
            'title' => 'sometimes|string',
            'slug' =>  'sometimes|string',
            'content' => 'sometimes',
            'status' => 'sometimes|boolean',
            'image' => 'sometimes|string',
            'published' => 'sometimes|date',
            'category_id' => 'sometimes',
        ];
    }
}
