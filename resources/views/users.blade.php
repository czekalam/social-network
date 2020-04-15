@extends('layouts.master')

@section('title')
    Users
@endsection
@section('page-class') users @endsection
@section('content')
    <div class="mc-box">
        <h3>Search somebody you know</h3>
        <div class="mc-user-search">
            <input class="mc-user-search-text" type="text" name="friend_name"/>
        </div>
        <div uk-grid class="uk-child-width-1-4">
            @foreach($users as $user)
                <div u-grid class="uk-grid-collapse uk-flex-column uk-card uk-card-default uk-card-body uk-margin">
                    <div class="uk-flex uk-flex-center uk-flex-middle uk-margin-small-bottom">
                        <img src="{{ route('account.image', ['user_id' => $user->id]) }}" class="mc-user-thumb">
                    </div>
                    <div class="uk-flex uk-flex-center uk-flex-middle uk-margin-bottom">
                        <a class="mc-search-user" href="/account/{{$user->id}}">{{$user->first_name}}</a>
                    </div> 
                    @if(!$user->already_friended)
                        <div class="uk-flex uk-flex-around uk-flex-middle">
                            <form action="{{ route('friend.add') }}" method="POST">
                                @csrf
                                <input type="hidden" value={{$user->id}} name="friend_id"/>
                                <button class="uk-button" type="submit"><i class="fas fa-user-friends"></i></button>
                            </form>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
    <script> 
        $(".mc-user-search-text").keyup(function() {   
            $('.mc-search-user').parent().parent().show();   
            $('.mc-search-user').each(function() {
                if(!($(this).text()).includes($(".mc-user-search-text").val())) {
                    $(this).parent().parent().hide();
                }
                else {
                    $(this).parent().parent().show();
                }
            });
        });
    </script>
@endsection
