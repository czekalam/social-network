@extends('layouts.master')

@section('title')
    Account
@endsection

@section('page-class') account @endsection

@section('content')
    <div class="mc-box">
        @if($user==Auth::user())
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
        @else
            <div>
                <h3>{{$user->first_name}}</h3>
                <p>{{$user->about_me}}</p>
                @if (Storage::disk('local')->has($user->id . '.jpg'))
                    <div class="">
                        <img src="{{ route('account.image', ['user_id' => $user->id]) }}">
                    </div>
                @endif
            </div>
        @endif
        <div>
            @if($user->posts)
                @foreach($user->posts as $post)
                    <div class="uk-card uk-card-default uk-card-body uk-margin">
                        <div class="mc-margin">
                            <p>{{$post->body}}</p>
                            <p>{{$post->created_at}}</p>
                        </div>
                        <div class="">
                            <button class="mc-toggle-comments uk-button">Comments</button>
                            <div class="mc-comments">
                              @foreach($post->comments as $comment)
                                <div class="uk-card uk-card-default uk-card-body uk-margin">
                                  <p>{{$comment->content}}</p>
                                  <p>Commented by{{$comment->user->first_name}}</p>
                                </div>
                              @endforeach
                            </div>
                            <form action="{{'/post/'.$post->id.'/comments'}}" method="post">
                              @csrf
                                <div class="">
                                    <input name="post_id" type="hidden" value="{{$post->id}}"/>
                                    <textarea class="uk-textarea" name="comment" id="comment-body" rows="5"></textarea>
                                </div>
                                <button type="submit" class="uk-button">Save changes</button>
                            </form>
                          </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection