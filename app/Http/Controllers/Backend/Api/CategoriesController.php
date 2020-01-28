<?php

namespace App\Http\Controllers\Backend\Api;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;

class CategoriesController extends Controller
{
    public function index()
    {
        return Category::withCount('posts')->latest()->get();
    }

    /**
     * Shows a category by its id
     *
     * @param App\Category
     */
    public function show(Category $category)
    {
        return $category;
    }

    /**
     * Creates a new category and saves it to the Database
     *
     * @param App\Http\Requsets\CategoryRequest
     */
    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->validated());

        return response()->json($category, 201);
    }

    /**
     * Update a Category from the Database
     *
     * @param App\Http\Requests\CategoryRequest
     * @param App\Category
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        return response()->json($category, 200);
    }

    /**
     * Deletes a Category record from the Database
     *
     * @param App\Category
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json('deleted', 200);
    }
}
