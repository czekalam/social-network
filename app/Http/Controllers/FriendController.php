<?php

namespace App\Http\Controllers;

use App\Friend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller {
    public function getIndex(Request $request) {
        $friends = Friend::all();
        return view('friend.index', ["friends" => $friends]);
    }
    public function postAddFriend(Request $request) {
        $this->validate($request, [
            'friend_id' => 'required'
        ]);
        $friend = new Friend();
        $friend->user1=Auth::user()->id;
        $friend->user2=$request['friend_id'];
        $friend->accepted = false;
        $friend->save();
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