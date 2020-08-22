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