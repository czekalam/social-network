@extends('layouts.master')

@section('title')
    Users
@endsection

@section('content')
    <style>
        .mc-user-thumb {
            width:50px;
            height:50px;
            margin-right: 20px;
            border-radius: 50%;
        }
        .mc-user-box {
            display:flex;
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }
        .mc-user-box:last-child {
            border-bottom: none;
        }
        .mc-user-textbox {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .mc-user-textbox p{
            margin: 0;
        }
        .mc-box {
            background: #fff;
            border-radius: 10px;
            padding: 50px;
            margin-bottom:20px;
        }
        .mc-user-search {
            border:1px solid #ccc;
            border-radius: 10px;
            padding-left: 7px;
            padding-right: 7px;
            margin-bottom:40px;
        }
        .mc-user-search-text {
            border:none;
            outline: none;
            width:76%;
        }
        .mc-user-search-btn {
            border: none;
            outline: none;
            background: #fff;
            border-left: 1px solid #ccc;
            width:23%;
        }
    </style>
    <div class="col-md-6 offset-md-3 mc-box">
        <p>Search somebody you know</p>
        <form class="mc-user-search" action="" method="POST">
            @csrf
            <input class="mc-user-search-text" type="text" name="friend_name"/>
            <input class="mc-user-search-btn" type="submit" value="Search friend"><br/>
        </form>
        @foreach($users as $user)
            <div class="mc-user-box">
                <img class="mc-user-thumb" src="https://picsum.photos/id/237/200/300">
                <div class="mc-user-textbox">
                    <p>Name:{{$user->first_name}}</p>
                </div>
                @if(!$user->already_friended)
                    <form action="{{ route('friend.add') }}" method="POST">
                        @csrf
                        <input type="hidden" value={{$user->id}} name="friend_id"/>
                        <input type="submit" value="Add friend"><br/>
                    </form>
                @endif
            </div>
        @endforeach
    </div>
@endsection