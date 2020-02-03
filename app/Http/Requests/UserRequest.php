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

    /**
     * Update User Profile Information.
     *
     */
    public function updateProfile()
    {
        $attributes = $this->validated();

        if (array_key_exists('avatar', $attributes)) {
            $attributes['avatar'] = $this->uploadProfileImage();
        }

        $this->user->update($attributes);
    }

    /**
     * Handle the image upload process.
     *
     * @return string
     */
    protected function uploadProfileImage()
    {
        // if user has the default profile image
        if ($this->user->avatar === '/assets/user-avatar.jpg') {
            return $this->uploadImage($this->avatar, true);
        }
        // if user has a different image than the default 
        else if ($this->user->avatar != '/assets/user-avatar.jpg' ) {
            return $this->updateImage($this->user->avatar, $this->avatar, true);
        }
    }
}
