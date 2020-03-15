<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Message;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ChatController extends Controller {
    public function getIndex(Request $request) {
        $messages = Message::all();
        return view('chat.index', ["messages" => $messages]);
    }
    public function postCreateMessage(Request $request) {
        $this->validate($request, [
            'content' => 'required|max:100'
        ]);
        $message = new Message();
        $message->user1_id=Auth::user()->id;
        $message->user2_id=1;
        $message->content = $request['content'];
        $message->save();

        return redirect()->back();
    }
}