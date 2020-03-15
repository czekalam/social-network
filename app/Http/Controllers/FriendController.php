<?php

namespace App\Http\Controllers;

use App\Friend;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller {
    public function getFriends(Request $request) {
        $friends = Friend::where('user2',Auth::user()->id)->get();
        foreach($friends as $friend) {
            $users = User::where('id',$friend->user1)->get();
        }
        $friends = Friend::where('user1',Auth::user()->id)->get();
        foreach($friends as $friend) {
            $users = User::where('id',$friend->user2)->get(); 
        }
        $friends=$users;
        return view('friends', ["friends" => $friends]);
    }
    public function postAddFriend(Request $request) {
        $friend = new Friend();
        $friend->user1=Auth::user()->id;
        $friend->user2=$request['friend_id'];
        $friend->accepted = false;
        if( count(Friend::where('user2',$request['friend_id'] )->where('user1',Auth::user()->id )->get())==0 ){
            $friend->save();
        }
        return redirect()->back();
    }
    public function postAcceptFriend(Request $request) {
        $friendship = Friend::where('friend_id', $friend_id)->first();
        $friend->accepted = true;
        $friend->update();
        return redirect()->back();
    }
    public function postDeleteFriend(Request $request) {
        $friend = Friend::where('friend_id', $friend_id)->first();
        if(Auth::user() != $friend->user) {
            return redirect()->back();
        }
        $friend->delete();
        return redirect()->route('dashboard')->with(['message' => 'Friend deleted!']);
    }
}