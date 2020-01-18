<?php

Route::middleware('auth:api')->group(function() {
    Route::get('/user', 'Backend\Api\UsersController@authUser')->name('auth.user');
    Route::patch('/user/{user}', 'Backend\Api\UsersController@update')->name('user.update');
    Route::patch('/users/reset/{user}/avatar', 'Backend\Api\UsersController@resetAvatar')->name('reset.avatar');

    // Categories
    Route::resource('/categories', 'Backend\Api\CategoriesController');

    // Posts
    Route::resource('/posts', 'Backend\Api\Posts\PostsController');

    // Post Actions
    Route::get('/published/posts', 'Backend\Api\Posts\PostActionController@published')
                                                                      ->name('published.posts');
    Route::get('/drafts/posts', 'Backend\Api\Posts\PostActionController@drafts')
                                                                      ->name('draft.posts');
    Route::patch('/action/{status}/{post}', 'Backend\Api\Posts\PostActionController@status')
                                                                      ->name('post.status');
    // Markdown Images
    Route::get('/post/markdown/images', 'Backend\Api\Markdown\MarkdownController@index')->name('markdown.images');
    Route::post('/post/markdown/upload', 'Backend\Api\Markdown\MarkdownController@upload')->name('markdown.upload');
    Route::post('/post/markdown/image', 'Backend\Api\Markdown\MarkdownController@destroy')->name('markdown.destroy');

    // Search for a post
    Route::get('/search/{term}', 'Backend\Api\Posts\SearchController@search')->name('search.title');

    // Social media acounts
    Route::resource('/socialMedia', 'Backend\Api\SocialMediaController');

    // Subscribers
    Route::resource('/subscribers', 'Backend\Api\SubscribersController');
});

