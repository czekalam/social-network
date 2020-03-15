<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>['web']], function() {
    Route::get('/', function () {
        return view('welcome');
    })->name('home');
    Route::get('/users',[
        'uses' => 'UserController@getUsers',
        'as' => 'users'
    ]);
    Route::post('/friendadd',[
        'uses' => 'FriendController@postAddFriend',
        'as' => 'friend.add'
    ]);
    Route::post('/signup',[
        'uses' => 'UserController@postSignUp',
        'as' => 'signup'
    ]);
    Route::post('/signin',[
        'uses' => 'UserController@postSignIn',
        'as' => 'signin'
    ]);
    Route::get('/logout',[
        'uses' => 'UserController@getLogout',
        'as' => 'logout'
    ]);
    Route::get('/account',[
        'uses' => 'UserController@getAccount',
        'as' => 'account'
    ]);
    Route::post('/updateaccount',[
        'uses' => 'UserController@postSaveAccount',
        'as' => 'account.save'
    ]);
    
    Route::get('/userimage/{filename}', [
        'uses' => 'UserController@getUserImage',
        'as' => 'account.image'
    ]);
    Route::get('/dashboard',[
        'uses' => 'PostController@getDashboard',
        'as' => 'dashboard',
        'middleware' => 'auth'
    ]);
    Route::post('/createpost', [
        'uses' => 'PostController@postCreatePost',
        'as' => 'post.create',
        'middleware' => 'auth'
    ]);
    Route::post('/updatepost', [
        'uses' => 'PostController@postUpdatePost',
        'as' => 'post.update',
        'middleware' => 'auth'
    ]);
    Route::get('/delete-post/{post_id}', [
        'uses' => 'PostController@getDeletePost',
        'as' => 'post.delete',
        'middleware' => 'auth'
    ]);
    Route::post('/like', [
        'uses' => 'PostController@postLikePost',
        'as' => 'like'
    ]);
    
    Route::get('/chat', [
        'uses' => 'ChatController@getIndex',
        'as' => 'chat.index',
        'middleware' => 'auth'
    ]);
    Route::post('/chat', [
        'uses' => 'ChatController@postCreateMessage',
        'as' => 'chat.add',
        'middleware' => 'auth'
    ]);
});