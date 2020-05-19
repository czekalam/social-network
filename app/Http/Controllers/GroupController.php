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
    public function getDeleteUser(Request $request) {
        dd($request);
    }
    public function getChat($id) {
        $group = Group::where('id',$id)->first();
        // foreach(json_decode($group->users) as $user) { 
        //     echo $user;
        // }
        return view('groups.chat', ["group"=>$group]);
    }
    public function postAddMessage(Request $request) {
        dd($request);
    }
    public function getMessages(Request $request) {
        dd($request);
    }
}