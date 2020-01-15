<?php

Auth::routes();

Route::get('/', 'Frontend\MainController@index')->name('welcome');

// New Newsletter Subscriber.
Route::post('/new/subscriber', 'Frontend\SubscribersController@submit')->name('new.subscriber');

// Cancel Newsletter Subscription.
Route::delete('/cancel/subscriber/{email}/{token}', 'Frontend\SubscribersController@cancel')
                                                              ->name('subscribers.cancel');
Route::prefix('manage')->middleware('auth')->group(function () {
     Route::get('/{any}', 'Backend\DashboardController@index')->where('any', '.*');
});





