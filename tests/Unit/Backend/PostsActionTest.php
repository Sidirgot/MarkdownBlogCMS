<?php

namespace Tests\Unit\Backend;

use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use League\CommonMark\CommonMarkConverter;
use Tests\TestCase;

class PostsActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_post_can_be_published()
    {
        $this->admin();

        $post = $this->createPost();

        $this->assertEquals(false, $post->status);

        $post->publish();

        $this->assertEquals(true, $post->fresh()->status);
        $this->assertNotNull($post->fresh()->published);
    }

    /** @test */
    public function a_post_can_be_unpubished()
    {
        $this->admin();

        $post = $this->createPost();

        $post->publish();

        $this->assertEquals(true, $post->fresh()->status);
        $this->assertNotNull($post->fresh()->published);

        $post->unpublish();

        $this->assertEquals(false, $post->fresh()->status);
        $this->assertNull($post->fresh()->published);
    }

    /** @test */
    public function parsed_field_on_the_post_json_response_has_markdown_parsed_content()
    {
        $post1 = $this->createPost();

        $markdown = new CommonMarkConverter();
        $parsedContent = $markdown->convertToHtml($post1->content);

        $post2 = Post::first()->toArray();

        $this->assertArrayHasKey('parsed', $post2);
        $this->assertEquals($post2['parsed'], $parsedContent);
    }
}
