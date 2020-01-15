<?php

namespace Tests\Unit\Backend;

use App\Category;
use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class SearchPostsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function search_can_find_a_post_with_a_given_term()
    {
        $this->admin();

        $category = factory(Category::class)->create();

        $post = factory(Post::class)->create([
            'title' => 'this is',
            'category_id' => $category->id,
            'author' => Auth()->user()->id,
            'image' => UploadedFile::fake()->image('post.jpg')
        ]);

        $term =  'this is';

        $foundpost = Post::searchTitleAndSlug($term);

        $this->assertEquals($post->id, $foundpost[0]->id);

        $this->assertEquals($post->title, $foundpost[0]->title);
    }
}
