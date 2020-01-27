<?php

namespace App\Http\Controllers\Frontend;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;

class MainController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $pinned = Post::published()->latest()->take(1)->first();
        $posts = Post::published()->latest()->skip(1)->take(3)->get();

        return view('frontend.welcome')->withCategories($categories)
                                       ->withPinned($pinned)
                                       ->withPosts($posts);
    }
}
