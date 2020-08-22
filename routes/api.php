<?php

Route::middleware('auth:api')->group(function() {
    Route::get('/user', 'Backend\Api\UsersController@authUser')->name('auth.user');
    Route::patch('/user/{user}', 'Backend\Api\UsersController@update')->name('user.update');
    Route::patch('/reset/avatar/{user}', 'Backend\Api\UsersController@resetAvatar')->name('reset.avatar');

    // Categories
    Route::resource('/categories', 'Backend\Api\CategoriesController');

    // Posts
    Route::resource('/posts', 'Backend\Api\Posts\PostsController');
    Route::get('/post/formData', 'Backend\Api\Posts\SearchController@formData');
    Route::get('/post/search', 'Backend\Api\Posts\SearchController@search');

    Route::patch('/action/{status}/{post}', 'Backend\Api\Posts\PostActionController@status')
                                                                      ->name('post.status');
    // Markdown Images
    Route::get('/markdown/images', 'Backend\Api\Markdown\MarkdownController@index')->name('markdown.images');
    Route::post('/markdown/upload', 'Backend\Api\Markdown\MarkdownController@upload')->name('markdown.upload');
    Route::post('/markdown/delete', 'Backend\Api\Markdown\MarkdownController@destroy')->name('markdown.destroy');

    // Social media acounts
    Route::resource('/socialMedia', 'Backend\Api\SocialMediaController');

    // Subscribers
    Route::resource('/subscribers', 'Backend\Api\SubscribersController');

    // Settings
    Route::resource('/settings', 'Backend\Api\SettingsController');
});

