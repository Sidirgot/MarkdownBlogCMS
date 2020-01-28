<?php

Auth::routes();

Route::get('/', 'Frontend\MainController@index')->name('welcome');

// Post view
Route::get('/article/{post}', 'Frontend\MainController@post' )->name('post');

// Fetch each category based on the provided name
Route::get('/category/{category}', 'Frontend\MainController@category')->name('category');

// Fetch categories endpoing for the categories vue component
Route::get('/fetch/categories', 'Frontend\MainController@fetchCategories');

// New Subscriber.
Route::post('/subscriber/new', 'Frontend\SubscribersController@submit')->name('new.subscriber');

// Cancel Subscription.
Route::delete('/cancel/subscriber/{email}/{token}', 'Frontend\SubscribersController@cancel')
                                                              ->name('subscribers.cancel');

Route::prefix('manage')->middleware('auth')->group(function () {
     Route::get('/{any}', 'Backend\DashboardController@index')->where('any', '.*');
});





