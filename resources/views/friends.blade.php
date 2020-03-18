@extends('layouts.master')

@section('title')
    Friends
@endsection

@section('content')
    Your friends
    @foreach($friends as $friend)
        @if(count($friend)>0)
            Name:{{$friend[0]->first_name}}
            <form action="{{ route('chat.index') }}" method="GET">
                @csrf
                <input type="hidden" value={{$friend[0]->id}} name="friend_id"/>
                <input type="submit" value="Chat with friend"><br/>
            </form>
        @endif
    @endforeach
@endsection