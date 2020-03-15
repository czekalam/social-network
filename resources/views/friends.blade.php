@extends('layouts.master')

@section('title')
    Friends
@endsection

@section('content')
    Your friends
    @foreach($friends as $friend)
        Name:{{$friend->first_name}}
        <form action="{{ route('chat') }}" method="POST">
            @csrf
            <input type="hidden" value={{$friend->id}} name="friend_id"/>
            <input type="submit" value="Chat with friend"><br/>
        </form>
    @endforeach
@endsection