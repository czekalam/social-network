@extends('layouts.master')

@section('title')
    Friends
@endsection

@section('content')
    Your friends
    @foreach($waiting_invite_users as $friend)
        @if(count($friend)>0)
            Name:{{$friend[0]->first_name}}
            Waiting for approvement
        @endif
    @endforeach
    @foreach($invited_friends as $friend)
        @if(count($friend)>0)
            Name:{{$friend[0]->first_name}}
            <form action="{{ route('friend.confirm') }}" method="POST">
                @csrf
                <input type="hidden" value={{$friend[0]->id}} name="friend_id"/>
                <input type="submit" value="Confirm friend"><br/>
            </form>
        @endif
    @endforeach
    @foreach($friends as $friend)
        @if(count($friend)>0)
            Name:{{$friend[0]->first_name}}
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
        @endif
    @endforeach
@endsection