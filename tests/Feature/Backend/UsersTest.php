<?php

namespace Tests\Feature\Backend;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_be_created()
    {
        $this->admin();

        $data = [
            'name' => 'joe do',
            'email' => 'joedo@app.com',
            'password' => '123456'
        ];

        $this->json('POST', route('users.store'), $data);

        $this->assertDatabaseHas('users', ['name' => $data['name']]);
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

        $this->json('PATCH', route('users.update', $user), $data);

        $this->assertDatabaseMissing('users', ['name' => $user['name']]);

        $this->assertDatabaseHas('users', ['name' => $data['name']]);
    }

    /** @test */
    public function a_user_can_be_deleted()
    {
        $this->admin();

        $user = factory(User::class)->create();

        $this->json('DELETE', route('users.destroy', $user));

        $this->assertDatabaseMissing('users', ['name' => $user['name']]);
    }

    /** @test */
    public function get_user_by_the_id()
    {
        $this->admin();

        $user = factory(User::class)->create();

        $res = $this->json('GET', route('users.show', $user))->decodeResponseJson();

        $this->assertEquals($res['name'], $user['name']);
    }

    /** @test */
    public function user_has_a_profile_avatar()
    {
        $this->admin();

        $user = factory(User::class)->create();

        Storage::fake('public_uploads');

        $data = ['avatar' => UploadedFile::fake()->image('avatar.jpg')];

        $this->json('PATCH', route('users.update', $user), $data);

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

        $this->json('PATCH', route('users.update', $user), $data);

        Storage::disk('public_uploads')->assertExists('assets/'. $data['avatar']->getClientOriginalname());

        $this->assertNotEquals($user->fresh()->avatar, 'assets/user-avatar.jpg');
        $this->assertEquals($user->fresh()->avatar, 'assets/' . $data['avatar']->getClientOriginalName());

        $newData = [
            'avatar' => UploadedFile::fake()->image('newAvatar.jpg'),
        ];

        $this->json('PATCH', route('users.update', $user->fresh()), $newData);

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

         $this->json('PATCH', route('users.update', $user), $data);

         Storage::disk('public_uploads')->assertExists('assets/'. $data['avatar']->getClientOriginalname());

         $this->assertNotEquals($user->fresh()->avatar, 'assets/user-avatar.jpg');
         $this->assertEquals($user->fresh()->avatar, 'assets/' . $data['avatar']->getClientOriginalName());

         $this->json('PATCH', route('reset.avatar', $user));

         Storage::disk('public_uploads')->assertMissing('assets/'. $data['avatar']->getClientOriginalname());
         $this->assertEquals($user->fresh()->avatar, 'assets/user-avatar.jpg');
      }
}
