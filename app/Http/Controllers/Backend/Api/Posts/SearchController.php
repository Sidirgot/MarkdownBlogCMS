<?php

namespace App\Http\Controllers\Backend\Api\Posts;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPostSearchRequest;
use App\Post;

class SearchController extends Controller
{
    /**
     * Get search form data.
     *
     * @return void
     */
    public function formData()
    {
        $categories = Category::all();

        return response()->json($categories);
    }

    /**
     * Search for a post based on the provided term.
     *
     * @param string $term
     * @return void
     */
    public function search(AdminPostSearchRequest $request)
    {
        $attributes = $request->validated();

        $query = Post::query();

        $query->when(isset($attributes['term']), function($que) use($attributes) {
            return $que->searchTitleAndSlug($attributes['term']);
        });

        $query->when(isset($attributes['status']), function($que) use($attributes) {
            return $que->where('status', $attributes['status']);
        });

        $query->when(isset($attributes['category']), function($que) use($attributes) {
            return $que->whereHas('category', function($cat) use($attributes) {
                $cat->where('name', $attributes['category']);
            });
        });

        $posts = $query->latest()->paginate(10)->appends(request()->query());

        return response()->json($posts);
    }
}
