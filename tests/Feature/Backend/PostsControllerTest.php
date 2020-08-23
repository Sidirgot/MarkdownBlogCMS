<?php

namespace Tests\Feature\Backend;

use App\Category;
use App\Post;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class PostsControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() :void
    {
        parent::setUp();

        $this->withoutExceptionHandling();
    }

    /** @test */
    public function create_a_post_with_an_image()
    {
        $this->admin();

        $category = factory(Category::class)->create();

        Storage::fake('public');

        $data = factory(Post::class)->raw([
                'category_id' => $category->id,
                'image' => UploadedFile::fake()->image('post.jpg')
        ]);

        $response = $this->json('post', route('posts.store'), $data)->decodeResponseJson();

        $this->assertDatabaseHas('posts', ['title' => $data['title']]);
        Storage::disk('public')->assertExists($response['image']);
    }

    /** @test */
    public function updated_post_data()
    {
        $this->admin();

        $post = $this->createPost();

        $data = ['title' => 'This is freaking awesome'];

        $response = $this->json('patch', route('posts.update', Post::first()), $data)
                         ->assertStatus(200)
                         ->decodeResponseJson();

        $this->assertEquals($data['title'], $response['title']);
        $this->assertDatabaseHas('posts', ['title' => $response['title']]);
        $this->assertDatabaseMissing('posts', ['title' => $post['title']]);
    }

    /** @test */
    public function a_post_can_be_deleted_along_with_its_featured_image()
    {
        $this->admin();

        Storage::fake('public');

        $post = $this->createPost();

        $response = $this->json('delete', route('posts.destroy', $post))->decodeResponseJson();

        $this->assertDatabaseMissing('posts', ['title' => $post['title']]);
        Storage::disk('public')->assertMissing($post->image);
        $this->assertEquals('deleted', $response);
    }

    /** @test */
    public function fetch_paginated_posts()
    {
        $this->admin();

        $post = $this->createPost();

        $response = $this->json('get', route('posts.index'))->decodeResponseJson();

        $this->assertEquals($response['total'], Post::count());
        $this->assertEquals($post->title, $response['data'][0]['title']);
    }

    /** @test */
    public function fetch_post_with_category()
    {
        $this->admin();

        $post = $this->createPost();

        $response = $this->json('get', route('posts.show', $post))->decodeResponseJson();

        $this->assertEquals($response['title'], $post->title);
        $this->assertEquals($response['category']['name'], $post->category->name);
    }
}
