@extends('layouts.master')

@section('title')
    Hi!
@endsection

@section('content')
    <style>
        html {
            height: 100%;
        }
        body {
            height: 100%;
            position: relative;
            background:
            linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),url("{{ URL::to('src/images/home-bg.jpg')}}");
        }
        header {
            position: absolute;
            width: 100%;
        }
        .container {
            padding-top:40px;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .mc-home-box-wrapper {
            width: 100%;
        }
        .mc-home-box.col-md-6 {
            max-width: 48%;
        }
        .mc-home-box {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 20px #000;
            padding: 50px;
            margin: 1%;
        }
    </style>
    @include('includes.message-block')
    <div class="row mc-home-box-wrapper">
        <div class="col-md-6 mc-home-box">
            <h3>Sign Up</h3>
            <form action="{{ route('signup') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">Your Email</label>
                    <input class="form-control" type="email" name="email" id="email">
                </div>
                <div class="form-group">
                    <label for="first_name">Your First Name</label>
                    <input class="form-control" type="text" name="first_name" id="first_name">
                </div>
                <div class="form-group">
                    <label for="password">Your Password</label>
                    <input class="form-control" type="password" name="password" id="password">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="col-md-6 mc-home-box">
            <h3>Sign In</h3>
            <form action="{{ route('signin') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">Your Email</label>
                    <input class="form-control" type="email" name="email" id="email">
                </div>
                <div class="form-group">
                    <label for="password">Your Password</label>
                    <input class="form-control" type="password" name="password" id="password">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection