@extends('layouts.master')

@section('title')
    Users
@endsection
@section('page-class') users @endsection
@section('content')
    @include('includes.info-box')
    @include('includes.message-block')
    <div class="mc-box">
        <h3>Search somebody you know</h3>
        <div class="mc-user-search">
            <input class="mc-user-search-text" type="text" placeholder="Type here to search" name="friend_name"/>
        </div>
        <div uk-grid class="uk-child-width-1-4 uk-grid-match">
            @foreach($users as $user)
                @if($user->id!=Auth::user()->id)
                    <div>
                        <div uk-grid class="uk-grid-collapse uk-flex-column uk-card uk-card-default uk-card-body uk-margin">
                            <div class="uk-flex uk-flex-center uk-flex-middle uk-margin-small-bottom">
                                <img src="{{ route('account.image', ['user_id' => $user->id]) }}" class="mc-user-thumb">
                            </div>
                            <div class="uk-flex uk-flex-center uk-flex-middle">
                                <a class="mc-search-user mc-link-white" href="/account/{{$user->id}}">{{$user->first_name}}</a>
                            </div> 
                            @if(!$user->already_friended)
                                <div class="uk-flex uk-flex-around uk-flex-middle uk-margin-bottom">
                                    <form action="{{ route('friend.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" value={{$user->id}} name="friend_id"/>
                                        <button class="uk-button uk-block" type="submit">ADD FRIEND</button>
                                    </form>
                                </div>
                            @endif
                            <form action="{!! route('groups.user.add') !!}" method="POST">
                                @csrf
                                <input type="hidden" value={{$user->id}} name="user_id"/>
                                <select class="uk-select" name="group">
                                    <option selected="selected">Choose group</option>
                                    @foreach($groups as $group)
                                        <option value={{$group->id}}>{{$group->name}}</option>
                                    @endforeach
                                </select>
                                <button class="uk-button mc-no-margin" type="submit">ADD TO GROUP</button>
                            </form>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    <script> 
        $(".mc-user-search-text").keyup(function() {   
            $('.mc-search-user').parent().parent().show();   
            $('.mc-search-user').each(function() {
                if(!($(this).text()).includes($(".mc-user-search-text").val())) {
                    $(this).parent().parent().parent().hide();
                }
                else {
                    $(this).parent().parent().parent().show();
                }
            });
        });
    </script>
@endsection
