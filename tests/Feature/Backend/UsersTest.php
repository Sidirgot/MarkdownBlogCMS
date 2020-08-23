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
    public function users_profile_can_be_updated()
    {
        $user = $this->admin();

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
        $user = $this->admin();

        Storage::fake('public');

        $data = [ 'avatar' => UploadedFile::fake()->image('avatar.jpg') ];

        $response = $this->json('patch', route('user.update', $user), $data)->decodeResponseJson();
        
        $this->assertNotNull($response['avatar']);
        Storage::disk('public')->assertExists($response['avatar']);
    }

    /** @test */
    public function a_user_can_update_his_profile_avatar()
    {
        $user = $this->admin();

        Storage::fake('public');

        $image = [ 'avatar' => UploadedFile::fake()->image('avatar.jpg') ];

        $response = $this->json('patch', route('user.update', $user), $image)->decodeResponseJson();

        $newImage = [ 'avatar' => UploadedFile::fake()->image('newAvatar.jpg') ];

        $this->json('patch', route('user.update', $user->fresh()), $newImage);

        $user_new = $user->fresh();

        Storage::disk('public')->assertExists($user_new->avatar);
        Storage::disk('public')->assertMissing($user->avatar);
    }

    /** @test */
    public function a_user_can_delete_his_profile_avatar()
    {
        $user = $this->admin();

        Storage::fake('public');

        $image = [ 'avatar' => UploadedFile::fake()->image('avatar.jpg') ];

        $this->json('patch', route('user.update', $user), $image)->decodeResponseJson();

        $response = $this->json('patch', route('reset.avatar', $user))->decodeResponseJson();

        Storage::disk('public')->assertMissing($user->avatar);
        $this->assertEquals($response['avatar'], null);
    }
}
