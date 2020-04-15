@extends('layouts.master')

@section('title')
    Friends
@endsection

@section('page-class') friends @endsection

@section('content')
    <div uk-grid class="uk-child-width-1-3 mc-box">
        <div>
            <h3 class="uk-text-center">Waiting for acceptance</h3>
            @foreach($waiting_invite_users as $friend)
                @if(count($friend)>0)
                    <div u-grid class="uk-grid-collapse uk-flex-column uk-card uk-card-default uk-card-body uk-margin">
                        <div class="uk-flex uk-flex-center uk-flex-middle uk-margin-small-bottom">
                            <img src="{{ route('account.image', ['user_id' => $friend[0]->id]) }}" class="mc-user-thumb">
                        </div>
                        <div class="uk-flex uk-flex-center uk-flex-middle">
                            <a href="/account/{{$friend[0]->id}}">{{$friend[0]->first_name}}</a>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <div>
            <h3 class="uk-text-center">Waiting for approvement</h3>
            @foreach($invited_friends as $friend)
                @if(count($friend)>0)
                    <div u-grid class="uk-grid-collapse uk-flex-column uk-card uk-card-default uk-card-body uk-margin">
                        <div>
                            <img src="{{ route('account.image', ['user_id' => $friend[0]->id]) }}" class="mc-user-thumb">
                        </div>
                        <div>
                            <p>Name:<a href="/account/{{$friend[0]->id}}">{{$friend[0]->first_name}}</a></p>
                        </div>
                        <div>
                            <form action="{{ route('friend.confirm') }}" method="POST">
                                @csrf
                                <input type="hidden" value={{$friend[0]->id}} name="friend_id"/>
                                <input type="submit" value="Confirm friend"><br/>
                            </form>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <div>
            <h3 class="uk-text-center">Your friends</h3>
            @foreach($friends as $friend)
                @if(count($friend)>0)
                    <div u-grid class="uk-grid-collapse uk-flex-column uk-card uk-card-default uk-card-body uk-margin">
                        <div class="uk-flex uk-flex-center uk-flex-middle uk-margin-small-bottom">
                            <img src="{{ route('account.image', ['user_id' => $friend[0]->id]) }}" class="mc-user-thumb">
                        </div>
                        <div class="uk-flex uk-flex-center uk-flex-middle uk-margin-bottom">
                            <a href="/account/{{$friend[0]->id}}">{{$friend[0]->first_name}}</a>
                        </div>
                        <div class="uk-flex uk-flex-around uk-flex-middle">
                            <form action="{{ route('chat.index') }}" method="GET">
                                @csrf
                                <input type="hidden" value={{$friend[0]->id}} name="friend_id"/>
                                <button class="uk-button" type="submit"><i class="fas fa-envelope"></i></button>
                            </form>
                            <form action="{{ route('friend.delete') }}" method="POST">
                                @csrf
                                <input type="hidden" value={{$friend[0]->id}} name="friend_id"/>
                                <button class="uk-button" type="submit"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection