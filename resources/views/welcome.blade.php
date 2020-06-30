<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Welcome</title>
        <link href="https://fonts.googleapis.com/css2?family=Kalam:wght@700&display=swap" rel="stylesheet">
        <link href="{{ URL::to('src/fontawesome/css/all.css')}}" rel="stylesheet">
        <script  src="https://code.jquery.com/jquery-3.4.1.min.js"  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="  crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.4.0/dist/css/uikit.min.css" />
        <script src="https://cdn.jsdelivr.net/npm/uikit@3.4.0/dist/js/uikit.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/uikit@3.4.0/dist/js/uikit-icons.min.js"></script>
        <script src="{{ URL::to('src/js/app.js')}}"></script>
        <link rel="stylesheet" href="{{ URL::to('src/css/app.css')}}" >
    </head>
    <body class="welcome">
        <div class="uk-section uk-container">
            <video autoplay muted loop id="myVideo">
                <source src="{{ URL::to('src/images/video.mp4')}}" type="video/mp4">
            </video>
            <div uk-grid class="uk-grid-collapse mc-home-box-wrapper uk-child-width-1-2">
                <div class="uk-width-1-1 mc-home-box">
                    <h1>Welcome in Social Space</h1>
                    <p>Sign in or Create an account to enjoy Social Space.</p>
                </div>
                <div class="uk-width-1-1 uk-margin-small-left uk-margin-small-right">
                    @include('includes.info-box')
                    @include('includes.message-block')
                </div>
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
        </div>
    </body>
</html>