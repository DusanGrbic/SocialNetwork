<?php

Route::get('/', [
    'uses' => 'HomeController@index',
    'as' => 'home'
]);

/** Guest Middleware */
Route::group([ 'middleware' => 'guest' ], function () {
    /** Auth */
    Route::get('/signup', [
        'uses' => 'AuthController@get_signup',
        'as' => 'auth.signup'
    ]);

    Route::post('/signup', [
        'uses' => 'AuthController@post_signup'
    ]);

    Route::get('/signin', [
        'uses' => 'AuthController@get_signin',
        'as' => 'auth.signin'
    ]);

    Route::post('/signin', [
        'uses' => 'AuthController@post_signin'
    ]);
});


/** Auth Middleware */
Route::group([ 'middleware' => 'auth' ], function () {
    /** Auth */
    Route::get('/logout', [
        'uses' => 'AuthController@get_logout',
        'as' => 'auth.logout'
    ]);
    
    
    /** Search */
    Route::get('/search', [
        'uses' => 'SearchController@get_results',
        'as' => 'search.results'
    ]);
    
    
    /** Profile */
    Route::get('/user/{username}', [
        'uses' => 'ProfileController@get_index',
        'as' => 'profile.index'
    ]);
    
    Route::get('/profile/edit', [
        'uses' => 'ProfileController@get_edit',
        'as' => 'profile.edit'
    ]);
    
    Route::post('/profile/edit', [
        'uses' => 'ProfileController@post_edit',
    ]);
    
    
    /** Friends */
    Route::get('/friends', [
        'uses' => 'FriendController@get_index',
        'as' => 'friends.index'
    ]);
    
    Route::get('/friends/{username}/add', [
        'uses' => 'FriendController@get_add',
        'as' => 'friends.add'
    ]);
    
    Route::get('/friends/{username}/accept', [
        'uses' => 'FriendController@get_accept',
        'as' => 'friends.accept'
    ]);
    
    Route::post('friends/{id}/delete', [
        'uses' => 'FriendController@post_delete',
        'as' => 'friends.delete'
    ]);
    
    
    /** Timeline */
    Route::get('/timeline', [
        'uses' => 'TimelineController@get_index',
        'as' => 'timeline.index'
    ]);
    
    
    /** Statuses */
    Route::post('/status', [
        'uses' => 'StatusController@post_status',
        'as' => 'status.post'
    ]);
    
    Route::post('/status/{status_id}/reply', [
        'uses' => 'StatusController@post_reply',
        'as' => 'status.reply'
    ]);
    
    Route::get('/status/{status_id}/like', [
        'uses' => 'StatusController@get_like',
        'as' => 'status.like'
    ]);
});
