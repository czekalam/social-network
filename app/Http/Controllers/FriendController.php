<?php

namespace App\Http\Controllers;

use App\Friend;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller {
    public function getFriends(Request $request) {
        $users=[];
        $invited_users=[];
        $waiting_invite_users=[];
        $friends = Friend::where('accepted',1)->where('user2',Auth::user()->id)->orWhere('user1',Auth::user()->id)->where('accepted',1)->get();
        $invited_friends = Friend::where('accepted',0)->where('user2',Auth::user()->id)->orWhere('user1',Auth::user()->id)->where('accepted',0)->get();
        foreach($friends as $friend) {
            if($friend->user1==Auth::user()->id){
                array_push($users, User::where('id',$friend->user2)->get());
            }
            else {
                array_push($users, User::where('id',$friend->user1)->get());
            }
        }
        foreach($invited_friends as $friend) {
            if($friend->user1==Auth::user()->id){
                array_push($waiting_invite_users, User::where('id',$friend->user2)->get());
            }
            else {
                array_push($invited_users, User::where('id',$friend->user1)->get());
            }
        }
        return view('friends', ["waiting_invite_users"=>$waiting_invite_users,"invited_friends"=>$invited_users,"friends" => $users]);
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
    public function postConfirmFriend(Request $request) {
        $friend = Friend::where('user2', $request->friend_id)->first();
        $friend->accepted = 1;
        $friend->update();
        return redirect()->back();
    }
    public function postDeleteFriend(Request $request) {
        $friend = Friend::where('user1', $request->friend_id)->where('user2',Auth::user()->id)->first();
        if($friend==null) {
            $friend = Friend::where('user2', $request->friend_id)->where('user1',Auth::user()->id)->first();
        }
        $friend->delete();
        return redirect()->route('dashboard')->with(['message' => 'Friend deleted!']);
    }
}