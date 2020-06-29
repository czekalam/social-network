@extends('layouts.master')

@section('title')
    Account
@endsection

@section('page-class') account @endsection

@section('content')
    <div class="mc-box">
        @if($user==Auth::user())
            <div class="uk-margin-large-bottom">
                <h3>Your Account</h3>
                <form action="{{ route('account.save') }}" method="post" enctype="multipart/form-data">
                    <div class="">
                        <label class="mc-label-white" for="first_name">First Name</label>
                        <input type="text" name="first_name" class="uk-input uk-margin-bottom" value="{{ $user->first_name }}" id="first_name">
                        <label class="mc-label-white" for="about_me">About me</label>
                        <textarea class="uk-textarea uk-margin-bottom" name="about_me">About me</textarea>
                    </div>
                    <div class="">
                        <label class="mc-label-white" for="image">Image</label>
                        <input class="mc-account-file" type="file" name="image" class="" id="image">
                    </div>
                    <button type="submit" class="uk-button">Save Account</button>
                    <input type="hidden" value="{{ Session::token() }}" name="_token">
                </form>
            </div>
        @else
            <div>
                @if (Storage::disk('local')->has($user->id . '.jpg'))
                <div class="mc-account-img">
                    <img src="{{ route('account.image', ['user_id' => $user->id]) }}">
                </div>
                @endif
                <h3>{{$user->first_name}}</h3>
                <p class="mc-label-white mc-featured-box">{{$user->about_me}}</p>
            </div>
        @endif
        <div>
            @if(count($user->posts))
                <h3>User posts</h3>
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
                                  <p>Commented by {{$comment->user->first_name}}</p>
                                </div>
                              @endforeach
                            </div>
                            <form class="uk-margin-top" action="{{'/post/'.$post->id.'/comments'}}" method="post">
                              @csrf
                                <div class="">
                                    <input name="post_id" type="hidden" value="{{$post->id}}"/>
                                    <textarea class="uk-textarea" name="comment" id="comment-body" rows="5"></textarea>
                                </div>
                                <button type="submit" class="uk-button uk-margin-remove-top">Send comment</button>
                            </form>
                          </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <script>
        $(".mc-comments").hide();
        $(".mc-toggle-comments").click(function() {
          $(this).parent().find(".mc-comments").toggle();
        });
    </script>
@endsection