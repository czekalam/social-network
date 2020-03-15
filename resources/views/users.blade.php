@extends('layouts.master')

@section('title')
    Users
@endsection

@section('content')
    Search somebody you know
    <form action="" method="POST">
        @csrf
        <input type="text" name="friend_name"/>
        <input type="submit" value="Search friend"><br/>
    </form>
    @foreach($users as $user)
        Name:{{$user->first_name}}
        <form action="{{ route('friend.add') }}" method="POST">
            @csrf
            <input type="hidden" value={{$user->id}} name="friend_id"/>
            <input type="submit" value="Add friend"><br/>
        </form>
    @endforeach
@endsection