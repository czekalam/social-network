@extends('layouts.master')

@section('title')
    Account
@endsection

@section('page-class') account @endsection

@section('content')
    <div class="mc-box">
        <div class="">
            <h3>Your Account</h3>
            <form action="{{ route('account.save') }}" method="post" enctype="multipart/form-data">
                <div class="">
                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" class="uk-input" value="{{ $user->first_name }}" id="first_name">
                    <textarea class="uk-textarea" name="about_me">About me</textarea>
                </div>
                <div class="">
                    <label for="image">Image</label>
                    <input class="mc-account-file" type="file" name="image" class="" id="image">
                </div>
                <button type="submit" class="uk-button">Save Account</button>
                <input type="hidden" value="{{ Session::token() }}" name="_token">
            </form>
        </div>
        <div>
            <h3>{{$user->first_name}}</h3>
            <p>{{$user->about_me}}</p>
            @if (Storage::disk('local')->has($user->id . '.jpg'))
                <div class="">
                    <img src="{{ route('account.image', ['user_id' => $user->id]) }}">
                </div>
            @endif
            @if($user->posts)
                @foreach($user->posts as $post)
                    <div class="mc-margin">
                        <p>{{$post->body}}</p>
                        <p>{{$post->created_at}}</p>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection