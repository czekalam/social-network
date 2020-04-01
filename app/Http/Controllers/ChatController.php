<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Message;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ChatController extends Controller {
    public function getIndex(Request $request) {
        $messages=Message::where('user1_id',$request->friend_id)->where('user2_id',Auth::user()->id)->orwhere('user2_id',$request->friend_id)->where('user1_id',Auth::user()->id)->orderBy('created_at', 'asc')->get();
        return view('chat.index', ["receiver"=>$request->friend_id,"messages" => $messages]);
    }
    public function getMessages(Request $request) {
        $messages=Message::where('user1_id',$request->receiver)->where('user2_id',Auth::user()->id)->orwhere('user2_id',$request->receiver)->where('user1_id',Auth::user()->id)->orderBy('created_at', 'asc')->get();
        return $messages;
    }
    public function postCreateMessage(Request $request) {
        $this->validate($request, [
            'content' => 'required|max:100'
        ]);
        $message = new Message();
        $message->user1_id=Auth::user()->id;
        $message->user2_id=$request->receiver;
        $message->content = $request['content'];
        $message->save();
        return (new ChatController)->getMessages($request);
    }
}