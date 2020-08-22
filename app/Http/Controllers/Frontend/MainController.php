<?php

namespace App\Http\Controllers\Frontend;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;

class MainController extends Controller
{
    /**
     * Serve the welcome page of the application.
     *
     */
    public function index()
    {
        $pinned = Post::published()->latest()->take(1)->first();
        dd($pinned);
        $posts = Post::published()->latest()->skip(1)->take(3)->get();

        return view('frontend.welcome')->withPinned($pinned)
                                       ->withPosts($posts);
    }

    /**
     * Fetch a category based on the specified name passed.
     *
     * @param string $name
     */
    public function category(string $name)
    {
        $category = Category::whereName($name)->first();

        $posts = $category->posts()->published()->get();

        return view('frontend.pages.category')->withPosts($posts)
                                              ->withCategory($category);
    }

    /**
     * Fetch all the categories.
     *
     * @return \App\Category
     */
    public function fetchCategories()
    {
        return response()->json(Category::all(), 200);
    }

    /**
     * Return the specified post via the slug.
     *
     * @param string $slug
     */
    public function post(string $slug)
    {
        $post = Post::whereSlug($slug)->first();

        return view('frontend.pages.article')->withPost($post);
    }

    public function search(string $term)
    {
        $posts = Post::searchTitleAndSlug($term)->get();

        return view('frontend.pages.search')->withPosts($posts);
    }
}
