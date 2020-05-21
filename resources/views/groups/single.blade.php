@extends('layouts.master')

@section('title')
    Group Single
@endsection
@section('page-class') group @endsection
@section('content')
    <div class="mc-box">
        <div>
            <h2>{{$group->name}}</h2>
            <a class="uk-button" href="{!! route('groups.delete', ['id' => $group->id]) !!}">delete group</a>
        </div>
        
        <h3>Users</h3>
        <ul>
            @foreach($users as $user)
                <li>
                    {{ $user->first_name }} <a href="{!! route('groups.user.delete', ['group_id'=>$group->id,'user_id' => $user->id]) !!}">delete user</a>
                </li>
            @endforeach
        </ul>
        <a class="uk-button" href="{!! route('groups.chat', ['id' => $group->id]) !!}">chat</a>

        <h3>Posts</h3>
        <ul>
            {{-- @foreach($users as $user)
                <li>
                    {{ $user->first_name }} <a href="{!! route('groups.user.delete', ['group_id'=>$group->id,'user_id' => $user->id]) !!}">delete user</a>
                </li>
            @endforeach --}}
        </ul>
    </div>
@endsection