<?php

namespace Tests\Feature\Backend;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function get_auth_user_info()
    {
        $user = $this->admin();

        $response = $this->json('get', route('auth.user', $user))->decodeResponseJson();

        $this->assertEquals($response['name'], $user->name);
        $this->assertEquals($response['email'], $user->email);
    }

    /** @test */
    public function a_users_data_can_be_updated()
    {
        $this->admin();

        $user = factory(User::class)->create();

        $data = [
            'name' => 'johndoe',
            'password' => '123456'
        ];

        $response = $this->json('patch', route('user.update', $user), $data)->decodeResponseJson();

        $this->assertDatabaseMissing('users', ['name' => $user['name']]);
        $this->assertDatabaseHas('users', ['name' => $data['name']]);
        $this->assertEquals($data['name'], $response['name']);
    }

    /** @test */
    public function user_has_a_profile_avatar()
    {
        $this->admin();

        $user = factory(User::class)->create();

        Storage::fake('public_uploads');

        $data = ['avatar' => UploadedFile::fake()->image('avatar.jpg')];

        $this->json('patch', route('user.update', $user), $data);

        Storage::disk('public_uploads')->assertExists('assets/'. $data['avatar']->getClientOriginalname());

        $this->assertNotEquals($user->fresh()->avatar, 'assets/user-avatar.jpg');
        $this->assertEquals($user->fresh()->avatar, 'assets/' . $data['avatar']->getClientOriginalName());
    }

     /** @test */
     public function a_user_can_update_his_profile_avatar()
     {
        $this->admin();

        $user = factory(User::class)->create();

        Storage::fake('public_uploads');

        $data = [
            'avatar' => UploadedFile::fake()->image('avatar.jpg'),
        ];

        $this->json('patch', route('user.update', $user), $data);

        Storage::disk('public_uploads')->assertExists('assets/'. $data['avatar']->getClientOriginalname());

        $this->assertNotEquals($user->fresh()->avatar, 'assets/user-avatar.jpg');
        $this->assertEquals($user->fresh()->avatar, 'assets/' . $data['avatar']->getClientOriginalName());

        $newData = [
            'avatar' => UploadedFile::fake()->image('newAvatar.jpg'),
        ];

        $this->json('patch', route('user.update', $user->fresh()), $newData);

        Storage::disk('public_uploads')->assertExists('assets/'. $newData['avatar']->getClientOriginalname());
        Storage::disk('public_uploads')->assertMissing('assets/'. $data['avatar']->getClientOriginalname());
     }

      /** @test */
      public function a_user_can_delete_his_profile_avatar()
      {
         $this->admin();

         $user = factory(User::class)->create();

         Storage::fake('public_uploads');

         $data = [
             'avatar' => UploadedFile::fake()->image('avatar.jpg'),
         ];

         $this->json('patch', route('user.update', $user), $data);

         Storage::disk('public_uploads')->assertExists('assets/'. $data['avatar']->getClientOriginalname());

         $this->assertNotEquals($user->fresh()->avatar, 'assets/user-avatar.jpg');
         $this->assertEquals($user->fresh()->avatar, 'assets/' . $data['avatar']->getClientOriginalName());

         $this->json('patch', route('reset.avatar', $user));

         Storage::disk('public_uploads')->assertMissing('assets/'. $data['avatar']->getClientOriginalname());
         $this->assertEquals($user->fresh()->avatar, 'assets/user-avatar.jpg');
      }
}
