@extends('layouts.master')

@section('title')
    Welcome
@endsection

@section('page-class') welcome @endsection

@section('content')
    @include('includes.message-block')
    <video autoplay muted loop id="myVideo">
        <source src="{{ URL::to('src/images/video.mp4')}}" type="video/mp4">
    </video>
    <div uk-grid class="mc-home-box-wrapper uk-child-width-1-2">
        <div class="mc-home-box">
            <h3>Sign Up</h3>
            <form action="{{ route('signup') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="uk-form-label" for="email">Your Email</label>
                    <input class="uk-input" type="email" name="email" id="email">
                </div>
                <div class="form-group">
                    <label for="first_name">Your First Name</label>
                    <input class="uk-input" type="text" name="first_name" id="first_name">
                </div>
                <div class="form-group">
                    <label class="uk-form-label" for="password">Your Password</label>
                    <input class="uk-input" type="password" name="password" id="password">
                </div>
                <button type="submit" class="uk-button uk-button-primary">Submit</button>
            </form>
        </div>
        <div class="mc-home-box">
            <h3>Sign In</h3>
            <form action="{{ route('signin') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="uk-form-label" for="email">Your Email</label>
                    <input class="uk-input" type="email" name="email" id="email">
                </div>
                <div class="form-group">
                    <label class="uk-form-label" for="password">Your Password</label>
                    <input class="uk-input" type="password" name="password" id="password">
                </div>
                <button type="submit" class="uk-button uk-button-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection