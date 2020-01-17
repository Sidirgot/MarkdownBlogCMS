<?php

namespace App\Observers;

use App\Traits\HandleImages;
use App\User;

class UserObserver
{
    use HandleImages;

    /**
     * Handle the User "updating" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function updating(User $user)
    {
        if ($user->getOriginal('avatar') === 'assets/user-avatar.jpg' && $user['avatar'] instanceof \Illuminate\Http\UploadedFile) {
            $user['avatar'] = $this->uploadImage($user['avatar'], true);
        }

        if ($user->getOriginal('avatar') != 'assets/user-avatar.jpg' && $user['avatar'] instanceof \Illuminate\Http\UploadedFile) {
            $user['avatar'] = $this->updateImage($user->getOriginal('avatar'), $user['avatar'], true);
        }
    }
}
