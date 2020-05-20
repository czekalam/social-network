@extends('layouts.master')

@section('title')
    Group Single
@endsection
@section('page-class') group @endsection
@section('content')

    {{-- 
        need:
            posts in that group
        routes:
            delete users in that group
    --}}

    <div>
        <h2>{{$group->name}}</h2>
        <a href="{!! route('groups.delete', ['id' => $group->id]) !!}">delete group</a>
    </div>
    
    <h3>Users</h3>
    @foreach($users as $user)
        {{ $user->first_name }} <a href="{!! route('groups.user.delete', ['group_id'=>$group->id,'user_id' => $user->id]) !!}">delete user</a>
    @endforeach

    <a href="{!! route('groups.chat', ['id' => $group->id]) !!}">chat</a>

    <h3>Posts</h3>
    post1
    post2
    post3
@endsection