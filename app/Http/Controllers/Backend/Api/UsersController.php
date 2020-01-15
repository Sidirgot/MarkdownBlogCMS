<?php

namespace App\Http\Controllers\Backend\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Traits\HandleImages;
use App\User;

class UsersController extends Controller
{
    use HandleImages;

    /**
     * Return the current authenticated user.
     *
     * @param \App\User
     */
    public function authUser()
    {
        return response()->json(auth()->user(), 200);
    }

    /**
     * Update a user's data
     *
     * @param \App\Http\Requests\UserRequest $request
     * @param \App\User $user
     */
    public function update(UserRequest $request, User $user)
    {
        $user->update($request->validated());

        return response()->json($user->fresh(), 201);
    }

    /**
     * Deletes the user image from the disk
     * And Resets the Users Avatar to the default
     *
     */
    public function resetAvatar(User $user)
    {
        $this->deleteImage($user->avatar);

        $user->resetAvatar();

        return response()->json(['reseted' => true]);
    }
}
