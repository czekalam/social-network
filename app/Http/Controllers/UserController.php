<?php
namespace App\Http\Controllers;
use App\User;
use App\Friend;
use App\Group;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller {
    public function getUsers() {
        $users = User::all();
        foreach($users as $user) {
            $user->already_friended = 0;
            if(Friend::where('user1', Auth::user()->id)->where('user2',$user->id)->first()) {
                $user->already_friended = 1;
            }
        }
        $groups = Group::all();
        $users_groups = [];
        foreach($groups as $group) {
            foreach(json_decode($group->users) as $user) {
                if($user[1]==Auth::user()->id) {
                    if($user[0] == "A") {
                        array_push($users_groups, $group);
                    }
                }
            }
        }
        return view('users',['users'=>$users,'groups'=>$users_groups]);
    }
    public function postSignUp(Request $request) {
        $request->validate([
            'email' => 'required|email|unique:users',
            'first_name' => 'required|max:120',
            'password' => 'required|min:4'
        ]);

        $email = $request['email'];
        $first_name = $request['first_name'];
        $password = bcrypt($request['password']);

        $user = new User();
        $user->email = $email;
        $user->first_name = $first_name;
        $user->password = $password;
        $user->save();
        
        Auth::login($user);
        return redirect()->route('dashboard');
    }
    public function postSignIn(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        if(Auth::attempt(['email'=>$request['email'], 'password'=>$request['password']])) {
            return redirect()->route('dashboard');
        }
        $message = "Wrong data";
        return redirect()->back()->with(['message' => $message]);
    }
    public function getLogout()    {
        Auth::logout();
        return redirect()->route('home');
    }
    public function getAccount($id=-1) {
        $isFriend=0;
        if($id>-1) {
            $user = User::where('id', $id)->first();
            $friends = Friend::where('accepted',1)->where('user2',$user->id)->orWhere('user1',$user->id)->where('accepted',1)->get();
            foreach ($friends as $friend) {
                if($friend->id == Auth::user()->id) {
                    $isFriend = 1;
                }
            }
            return view('account', ['user'=>$user,"isFriend"=>$isFriend]);
        }
        else {
            return view('account', ['user'=>Auth::user(), "isFriend"=>1]);
        }
    }
    public function postSaveAccount(Request $request)    {
        $this->validate($request, [
           'first_name' => 'required|max:30'
        ]);
        $user = Auth::user();
        $old_name = $user->first_name;
        $user->first_name = $request['first_name'];
        $user->about_me = $request['about_me'];
        $user->update();
        $file = $request->file('image');
        if($file) {
            $filename = $user->id.'.jpg';
            Storage::disk('local')->put($filename, File::get($file));
        }
        return redirect()->route('account');
    }
    public function getUserImage(Request $request){
        $file = Storage::disk('local')->get('default.jpg');
        if(Storage::disk('local')->has($request->user_id.'.jpg')) {
            $file = Storage::disk('local')->get($request->user_id.'.jpg');
        }
        return new Response($file, 200);
    }
}