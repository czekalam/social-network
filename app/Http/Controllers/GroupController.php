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
        return view('groups.single',["group"=>$group,"users"=>(object)$users]);
    }
    public function getDelete($id) {
        $group=Group::where("id",$id)->delete();
        return redirect()->route('dashboard');
    }
    public function postAddGroup(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:100'
        ]);
        $group = new Group();
        $group->name = $request->name;
        $group->users = json_encode([["A",Auth::user()->id]]);
        $group->messages= json_encode([]);
        $group->save();
        return redirect()->route('dashboard');
    }
    public function postAddUser(Request $request) {
        $group=Group::where("id",$request->group)->first();
        $users = json_decode($group->users);
        array_push($users, ["N",$request->user_id]);
        $group->users = json_encode($users);
        $group->save();
        return redirect()->route('dashboard');
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
        return redirect()->route('dashboard');
    }
    public function getChat($id) {
        $group = Group::where('id',$id)->first();
        return view('groups.chat', ["group"=>$group]);
    }
    public function postAddMessage(Request $request) {
        $group = Group::where('id',$request->group)->first();
        $messages = json_decode($group->messages);
        array_push($messages,[$request->content,1]);
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
}