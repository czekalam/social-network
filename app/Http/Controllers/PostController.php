<?php

namespace App\Http\Controllers;

use App\Post;
use App\Like;
use App\Friend;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller {
    public function getDashboard() {
        $posts=[]; 
        $users=[];
        $friends =Friend::where('user2',Auth::user()->id)->where('user1', '!=' , Auth::user()->id)->get();
        $friends2 =Friend::where('user1',Auth::user()->id)->where('user2', '!=' , Auth::user()->id)->get();
        $friendList=[];
        foreach($friends as $friend) {
            if($friend->accepted>0) {
                if(User::where('id',$friend->user1)->first()) {
                    array_push($posts,User::where('id',$friend->user1)->first()->posts()->get());
                }
            }
        }
        foreach($friends2 as $friend) {
            if($friend->accepted>0) {
                if(User::where('id',$friend->user2)->first()) {
                    array_push($posts,User::where('id',$friend->user2)->first()->posts()->get());
                }
            }
        }
        return view('dashboard', ["posts" => $posts]);
    }
    public function postCreatePost(Request $request) {
        $this->validate($request, [
            'body' => 'required|max:1000'
        ]);
        $post = new Post();
        $post->body = $request['body'];
        $message = 'There was an error';
        if($request->user()->posts()->save($post)) {
            $message = "Post successfully created!";
        }
        return redirect()->route('dashboard')->with(['message' => $message]);
    }
    public function postUpdatePost(Request $request) {
        $this->validate($request, [
            'body' => 'required|max:1000'
        ]);
        $post = Post::where('id', $request->post_id)->first();
        $post->body = $request['body'];
        $message = 'There was an error';
        if(Auth::user() != $post->user) {
            return redirect()->back();
        }
        $message = "Post successfully updated!";
        $post->update();
        return redirect()->route('dashboard')->with(['message' => $message]);
    }
    public function getDeletePost($post_id) {
        $post = Post::where('id', $post_id)->first();
        if(Auth::user() != $post->user) {
            return redirect()->back();
        }
        $post->delete();
        return redirect()->route('dashboard')->with(['message' => 'Successfully deleted!']);
    }
    public function postLikePost(Request $request) {
        $post_id = $request['post_id'];
        $is_like = $request['isLike'] === 'true';
        $update = false;
        $post = Post::find($post_id);
        if(!$post) {
            return null;
        }
        $user = Auth::user();
        $like = $user->likes()->where('post_id',$post_id)->first();
        if($like) {
            $already_like = $like->like;
            $update = true;
            if($already_like == $is_like) {
                $like->delete();
                return null;
            }
        }
        else {
            $like = new Like();
        }
        $like->like = $is_like;
        $like->user_id = $user->id;
        $like->post_id = $post->id;
        if($update) {
            $like->update();
        }
        else {
            $like->save();
        }
        return null;
    }
}