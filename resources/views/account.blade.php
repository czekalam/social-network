@extends('layouts.master')

@section('title')
    Account
@endsection

@section('content')
    <style>
        .mc-box {
            background: #fff;
            border-radius: 10px;
            padding: 50px;
            margin-bottom:20px;
        }
        .mc-account-input {
            border:none;
            border:1px solid #ccc;
            border-radius: 10px;
            outline: none;
            padding-left: 7px;
            padding-right: 7px;
            width: 100%;
            margin:5px 0;
        }
        .mc-account-file {
            border:0;
            width:100%;
        }
    </style>
    <div class="col-md-6 offset-md-3 mc-box">
        <section class="row new-post">
            <div class="col-md-12">
                <header><h3>Your Account</h3></header>
                <form action="{{ route('account.save') }}" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" name="first_name" class="form-control mc-account-input" value="{{ $user->first_name }}" id="first_name">
                        <textarea class="mc-account-input" name="about_me">About me</textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">Image (only .jpg)</label>
                        <input class="mc-account-file" type="file" name="image" class="form-control" id="image">
                    </div>
                    <button type="submit" class="btn btn-primary">Save Account</button>
                    <input type="hidden" value="{{ Session::token() }}" name="_token">
                </form>
            </div>
        </section>
        @if (Storage::disk('local')->has($user->first_name . '-' . $user->id . '.jpg'))
            <section class="row new-post">
                <div class="col-md-6 col-md-offset-3">
                    <img src="{{ route('account.image', ['filename' => $user->first_name . '-' . $user->id . '.jpg']) }}" alt="" class="img-responsive">
                </div>
            </section>
        @endif
    </div>
@endsection