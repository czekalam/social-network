@extends('layouts.master')

@section('title')
    Friends
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
        .mc-user-textbox p{
            margin:0;
        }
        .mc-user-textbox{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .mc-box {
            background: #fff;
            border-radius: 10px;
            padding: 50px;
            margin-bottom:20px;
        }
    </style>
    <div class="col-md-6 offset-md-3 mc-box">
        <p>Waiting for acceptance</p>
        @foreach($waiting_invite_users as $friend)
            @if(count($friend)>0)
                <div class="mc-user-box">
                    <img style="width:50px;height:50px;" src="{{ route('account.image', ['user_id' => $friend[0]->id]) }}" alt="" class="mc-user-thumb img-responsive">
                    <div class="mc-user-textbox">
                        <p>Name:<a href="/account/{{$friend[0]->id}}">{{$friend[0]->first_name}}</a></p>
                    </div>
                </div>
            @endif
        @endforeach
        <p>Waiting for approvement</p>
        @foreach($invited_friends as $friend)
            @if(count($friend)>0)
                <div class="mc-user-box">
                    <img style="width:50px;height:50px;" src="{{ route('account.image', ['user_id' => $friend[0]->id]) }}" alt="" class="mc-user-thumb img-responsive">
                    <p>Name:<a href="/account/{{$friend[0]->id}}">{{$friend[0]->first_name}}</a></p>
                    <form action="{{ route('friend.confirm') }}" method="POST">
                        @csrf
                        <input type="hidden" value={{$friend[0]->id}} name="friend_id"/>
                        <input type="submit" value="Confirm friend"><br/>
                    </form>
                </div>
            @endif
        @endforeach
        <p>Your friends</p>
        @foreach($friends as $friend)
            @if(count($friend)>0)
                <div class="mc-user-box">
                    <img style="width:50px;height:50px;" src="{{ route('account.image', ['user_id' => $friend[0]->id]) }}" alt="" class="mc-user-thumb img-responsive">
                    <p>Name:<a href="/account/{{$friend[0]->id}}">{{$friend[0]->first_name}}</a></p>
                    <form action="{{ route('chat.index') }}" method="GET">
                        @csrf
                        <input type="hidden" value={{$friend[0]->id}} name="friend_id"/>
                        <input type="submit" value="Chat with friend"><br/>
                    </form>
                    <form action="{{ route('friend.delete') }}" method="POST">
                        @csrf
                        <input type="hidden" value={{$friend[0]->id}} name="friend_id"/>
                        <input type="submit" value="Delete friend"><br/>
                    </form>
                </div>
            @endif
        @endforeach
    </div>
@endsection