<?php

namespace Tests\Feature\Backend;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostActionControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() :void
    {
        parent::setUp();

        $this->withoutExceptionHandling();
    }

    /** @test */
    public function paginated_posts_that_have_been_published()
    {
        $this->admin();

        $post = $this->createPost();

        $post->publish();

        $response = $this->json('get', route('published.posts'))->decodeResponseJson();

        $this->assertTrue($response['data'][0]['status']);
        $this->assertEquals($post->title, $response['data'][0]['title']);
    }

    /** @test */
    public function paginated_posts_that_are_saved_as_drafts()
    {
        $this->admin();

        $post = $this->createPost();

        $post->publish();

        $this->assertTrue($post->status);

        $response = $this->json('get', route('draft.posts'))->decodeResponseJson();

        $this->assertEmpty($response['data']);
        $this->assertEquals(0, $response['total']);
    }

    /** @test */
    public function a_post_can_be_published()
    {
        $this->admin();

        $post = $this->createPost();

        $response = $this->json('patch', route('post.status', ['status' => 'publish', $post]))
                         ->assertStatus(200)
                         ->decodeResponseJson();

        $this->assertEquals($post->title, $response['title']);
        $this->assertTrue($response['status']);
        $this->assertNotNull($response['published']);
    }
}