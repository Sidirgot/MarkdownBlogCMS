<?php

namespace Tests\Feature\Backend;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SearchPostsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function search_the_posts_title_and_slug_with_a_given_term()
    {
        $this->admin();

        $post = $this->createPost();

        $term = $post->title;

        $response = $this->json('get', route('search.title', $term))->decodeResponseJson();

        $this->assertCount(1 , $response['data']);
        $this->assertEquals($post->title, $response['data'][0]['title']);
    }
}
