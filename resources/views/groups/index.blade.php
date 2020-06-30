@extends('layouts.master')

@section('title')
    Groups
@endsection
@section('page-class') groups @endsection
@section('content')
@include('includes.info-box')
@include('includes.message-block')
    <div class="mc-box">
        <h2>Group list</h2>
        <ul>
            @foreach($groups as $group)
                <li>
                    <span>
                        @php
                            foreach(json_decode($group->users) as $user) {
                                if($user[1]==Auth::user()->id) {
                                    if($user[0] == "A") {
                                        echo "A";
                                    }
                                }
                            }
                        @endphp
                    </span>
                    <a href="{!! route('groups.single', ['id' => $group->id]) !!}">{{$group->name}}</a>
                </li>
            @endforeach
        </ul>
        <h3>Create new group</h3>
        <form action="{{ route('groups.add') }}" method="POST">
            @csrf
            <input class="uk-input" name="name" placeholder="Group name"/>
            <button class="uk-button">Add group</button>
        </form>
    </div>
@endsection