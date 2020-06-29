<?php

namespace App\Http\Controllers;

use App\User;
use App\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller {
    public function getIndex(Request $request) {
        $groups=Group::all();
        return view('groups.index', ["groups"=>$groups]);
    }
    public function getSingle($id) {
        $group=Group::where("id",$id)->first();
        $users=[];
        foreach(json_decode($group->users) as $user) {
            array_push($users, User::where("id",$user[1])->first());
        }
        $posts= json_decode($group->posts);
        return view('groups.single',["posts"=>(object)$posts,"group"=>$group,"users"=>(object)$users]);
    }
    public function getDelete($id) {
        $group=Group::where("id",$id)->delete();
        return redirect()->back();
    }
    public function postAddGroup(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:30'
        ]);
        $group = new Group();
        $group->name = $request->name;
        $group->users = json_encode([["A",Auth::user()->id]]);
        $group->messages= json_encode([]);
        $group->posts= json_encode([]);
        $group->save();
        return redirect()->back();
    }
    public function postAddUser(Request $request) {
        $group=Group::where("id",$request->group)->first();
        $users = json_decode($group->users);
        array_push($users, ["N",$request->user_id]);
        $group->users = json_encode($users);
        $group->save();
        return redirect()->back();
    }
    public function getDeleteUser($group_id,$user_id) {
        $group=Group::where("id",$group_id)->first();
        $users = json_decode($group->users);
        
        foreach($users as $key => $value) {
            if($user_id==$value[1]) {
                unset($users[$key]);
            }
        }
        $group->users = json_encode($users);
        $group->save();
        return redirect()->back();
    }
    public function getChat($id) {
        $group = Group::where('id',$id)->first();
        return view('groups.chat', ["group"=>$group]);
    }
    public function postAddMessage(Request $request) {
        $group = Group::where('id',$request->group)->first();
        $messages = json_decode($group->messages);
        array_push($messages,[$request->content,Auth::user()->id]);
        $messages= $messages;
        $group->messages = json_encode($messages);
        $group->save();
        return redirect()->route('dashboard');
    }
    public function getMessages(Request $request) {
        $group = Group::where('id',$request->id)->first();
        $messages=$group->messages;
        return json_decode($messages);
    }
    public function postPost(Request $request) {
        $group = Group::where('id',$request->id)->first();
        $posts = json_decode($group->posts);
        $index=0;
        if(count($posts)>0) {
            $index=$posts[count($posts)-1][0]+1;
        }
        array_push($posts,[$index,$request->body,[],Auth::user()->first_name,date('Y-m-d H:i:s',time())]);
        $group->posts = json_encode($posts);
        $group->save();
        return redirect()->back();
    }
    public function postPostComment($id,$post_id, Request $request) {
        $group = Group::where('id',$id)->first();
        $posts = json_decode($group->posts);
        foreach ($posts as $key =>$post) {
            if($post[0]==$post_id) {
                array_push($posts[$key][2],[Auth::user()->first_name,$request->comment]);
            }
        }
        $group->posts = json_encode($posts);
        if($request->comment) {
            $group->save();
        }
        return redirect()->back();
    }
}