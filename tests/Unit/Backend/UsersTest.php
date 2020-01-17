<?php

namespace Tests\Unit\Backend;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UsersTest extends TestCase
{
    use RefreshDatabase;

     /** @test */
     public function reset_profile_avatar_to_default()
     {
         $this->admin();

         $user = factory(User::class)->create();
         $user->avatar = 'assets/avatar.jpg';

         $user->resetAvatar();

         $this->assertEquals($user->fresh()->avatar, 'assets/user-avatar.jpg');
     }
}
