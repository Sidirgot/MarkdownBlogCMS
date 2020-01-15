<?php

namespace Tests;

use App\Category;
use App\Post;
use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Laravel\Passport\Passport;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function admin()
    {
        $user =  User::create([
            'name' => 'superadministrator',
            'email' => 'super@app.com',
            'password' => 'password'
        ]);

        return Passport::actingAs($user);
    }

    public function createPost()
    {
        $user = User::whereEmail('super@app.com')->first();

        $category = factory(Category::class)->create();

        Storage::fake('public_uploads');

        $post = $user->post()->create(factory(Post::class)->raw([
            'category_id' => $category->id,
            'image' => UploadedFile::fake()->image('post.jpg')
        ]));

        return $post;
    }
}
