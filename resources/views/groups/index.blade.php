@extends('layouts.master')

@section('title')
    Groups
@endsection
@section('page-class') groups @endsection
@section('content')
    <h2>Group list</h2>
    @foreach($groups as $group)
        @php
            foreach(json_decode($group->users) as $user) {
                if($user[1]==Auth::user()->id) {
                    if($user[0] == "A") {
                        echo "A";
                    }
                }
            }
        @endphp
        <a href="{!! route('groups.single', ['id' => $group->id]) !!}">{{$group->name}}</a>
    @endforeach


    <form action="{{ route('groups.add') }}" method="POST">
        @csrf
        <input name="name" placeholder="Group name"/>
        <button>Add group</button>
    </form>

@endsection