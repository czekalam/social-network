<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller {
    public function postAddComment(Request $request) {
        $comment = new Comment();
        $comment->user_id=Auth::user()->id;
        $comment->post_id=$request['post_id'];
        $comment->content = $request['comment'];
        $comment->save();
        return redirect()->back();
    }
}