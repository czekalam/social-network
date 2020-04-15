<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>@yield('title')</title>
        <link href="{{ URL::to('src/fontawesome/css/all.css')}}" rel="stylesheet">
        <script  src="https://code.jquery.com/jquery-3.4.1.min.js"  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="  crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.4.0/dist/css/uikit.min.css" />
        <script src="https://cdn.jsdelivr.net/npm/uikit@3.4.0/dist/js/uikit.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/uikit@3.4.0/dist/js/uikit-icons.min.js"></script>
        <script src="{{ URL::to('src/js/app.js')}}"></script>
        <link rel="stylesheet" href="{{ URL::to('src/css/app.css')}}" >
    </head>
    <body class="@yield('page-class')">
        @if(Auth::check())
            @include('includes.header')
        @endif
        <div class="uk-section uk-container">
            @yield('content')
        </div>
    </body>
</html>
