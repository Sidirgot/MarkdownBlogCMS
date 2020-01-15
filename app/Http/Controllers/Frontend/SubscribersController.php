<?php

namespace App\Http\Controllers\Frontend;

use App\Subscriber;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubscribersRequest;
use Illuminate\Support\Str;

class SubscribersController extends Controller
{
    /**
     * Add a guest user to the subscriber newsletter.
     *
     *  @param App\Http\Requests\SubscribersRequest
     */
    public function submit(SubscribersRequest $request)
    {
        $validated = $request->validated();

        Subscriber::create([
            'email' => $validated['email'],
            'token' =>  Str::limit(md5($validated['email'] . Str::random()), 30, '')
        ]);

        return response()->json('created', 201);
    }

    /**
     * Delete a subscribers email from the subscription newsletter.
     *
     * @param App\User email
     * @param App\User hashed token
     */
    public function cancel($email, $token)
    {

        $subscriber = Subscriber::whereEmail($email)->first();

        if ($subscriber->token === $token) {
            $subscriber->delete();
        }

        return response()->json(['Deleted' => true]);
    }
}
