<?php

namespace App\Http\Controllers\Backend\Api\Posts;

use App\Http\Controllers\Controller;
use App\Post;
use App\Traits\HandleImages;

class PostActionController extends Controller
{
    use HandleImages;

    /**
     * Return all the Published post
     *
     */
    public function published()
    {
        return Post::published()->paginate(20);
    }

    /**
     * Return all saved posts
     *
     */
    public function drafts()
    {
        return Post::drafts()->paginate(20);
    }

    /**
     * Change the status of a post.
     *
     * @param string $status
     * @param App\Post $post
     */
    public function status($status, Post $post)
    {
        $status == "publish" ? $post->publish() : $post->unpublish();

        return response()->json($post->load('category'), 200);
    }
}
