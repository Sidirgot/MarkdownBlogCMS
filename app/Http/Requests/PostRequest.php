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
                'title' => 'required|string|unique:posts',
                'slug' =>  'sometimes|string|unique:posts',
                'content' => 'required',
                'status' => 'sometimes|boolean',
                'image' => 'required|file|image|max:2000',
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
            'title' => 'sometimes|string|unique:posts,title,'. $this->post->id,
            'slug' =>  'sometimes|string|unique:posts,slug,'. $this->post->slug,
            'content' => 'sometimes',
            'status' => 'sometimes|boolean',
            'image' => 'sometimes|string',
            'published' => 'sometimes|date',
            'category_id' => 'sometimes',
        ];
    }
}
