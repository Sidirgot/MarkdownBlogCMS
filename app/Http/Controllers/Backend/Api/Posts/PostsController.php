<?php

namespace App\Http\Controllers\Backend\Api\Posts;

use App\Post;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;

class PostsController extends Controller
{
    public function index()
    {
        return Post::latest()->paginate(20);
    }

    /**
     * Show's a Post by its ID and load's it's category
     *
     * @param \App\Post $post
     */
    public function show(Post $post)
    {
        return $post->load('category');
    }

    /**
     * Add a new Post to the Database
     *
     * @param \App\Http\Requests\PostRequest $request
     */
    public function store(PostRequest $request)
    {
        $post = auth()->user()->post()->create($request->validated());

        return response()->json($post->load('category'), 201);
    }

    /**
     * Update the given resource.
     *
     * @param \App\Http\Requests\PostRequest $request
     * @param \App\Post $post
     */
    public function update(PostRequest $request, Post $post)
    {
        $post->update($request->validated());

        return response()->json($post->load('category'), 200);
    }

    /**
     * Delete the given resource from the Database.
     *
     * @param \App\Post $post
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json('deleted');
    }
}
