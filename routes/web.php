<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>['web']], function() {
    Route::get('/', function () {
        return view('welcome');
    })->name('home');



    Route::get('/scissors', function () {
        return view('games.scissors');
    })->name('scissors');

    Route::get('/bird', function () {
        return view('games.bird');
    })->name('bird');



    Route::get('/users',[
        'uses' => 'UserController@getUsers',
        'as' => 'users',
        'middleware' => 'auth'
    ]);
    Route::get('/friends',[
        'uses' => 'FriendController@getFriends',
        'as' => 'friends',
        'middleware' => 'auth'
    ]);
    Route::post('/friendadd',[
        'uses' => 'FriendController@postAddFriend',
        'as' => 'friend.add',
        'middleware' => 'auth'
    ]);
    Route::post('/friendconfirm',[
        'uses' => 'FriendController@postConfirmFriend',
        'as' => 'friend.confirm',
        'middleware' => 'auth'
    ]);
    Route::post('/frienddelete',[
        'uses' => 'FriendController@postDeleteFriend',
        'as' => 'friend.delete',
        'middleware' => 'auth'
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
        'as' => 'logout',
        'middleware' => 'auth'
    ]);
    Route::get('/account',[
        'uses' => 'UserController@getAccount',
        'as' => 'account',
        'middleware' => 'auth'
    ]);
    Route::post('/updateaccount',[
        'uses' => 'UserController@postSaveAccount',
        'as' => 'account.save',
        'middleware' => 'auth'
    ]);
    
    Route::get('/userimage/{filename}', [
        'uses' => 'UserController@getUserImage',
        'as' => 'account.image',
        'middleware' => 'auth'
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
        'as' => 'like',
        'middleware' => 'auth'
    ]);
    Route::get('/chat', [
        'uses' => 'ChatController@getIndex',
        'as' => 'chat.index',
        'middleware' => 'auth'
    ]);
    Route::get('/chat/data', [
        'uses' => 'ChatController@getMessages',
        'as' => 'chat.messages',
        'middleware' => 'auth'
    ]);
    Route::post('/chat', [
        'uses' => 'ChatController@postCreateMessage',
        'as' => 'chat.add',
        'middleware' => 'auth'
    ]);
});