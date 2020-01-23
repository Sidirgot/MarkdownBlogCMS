<?php

namespace App\Http\Controllers\Backend\Api\Posts;

use App\Http\Controllers\Controller;
use App\Post;

class SearchController extends Controller
{
    /**
     * Search for a post based on the provided term.
     *
     * @param string $term
     * @return void
     */
    public function search($term)
    {
        $results =  Post::searchTitleAndSlug($term)->paginate(20);

        return response()->json($results, 200);
    }
}
