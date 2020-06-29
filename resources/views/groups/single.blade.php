@extends('layouts.master')

@section('title')
    Group Single
@endsection
@section('page-class') group @endsection
@section('content')
    <div class="mc-box">
        <div>
            <h2>{{$group->name}}</h2>
            <a class="uk-button" href="{!! route('groups.delete', ['id' => $group->id]) !!}">delete group</a>
        </div>
        
        <h3>Users</h3>
        <ul>
            @foreach($users as $user)
                <li class="mc-label-white">
                    {{ $user->first_name }} <a href="{!! route('groups.user.delete', ['group_id'=>$group->id,'user_id' => $user->id]) !!}">delete user</a>
                </li>
            @endforeach
        </ul>
        <a class="uk-button" href="{!! route('groups.chat', ['id' => $group->id]) !!}">chat</a>

        <h3>Say something to your group...</h3>
        <form action="{{ route('groups.post.add',['id'=> $group->id])}}" method="post">
            @csrf
            <div class="">
                <textarea class="uk-textarea" name="body" id="new-post" rows="5" placeholder="Your Post"></textarea>
            </div>
            <button type="submit" class="uk-button">Create Post</button>
        </form>
        @if($posts)
            <h3>Posts</h3>
        @endif
        @foreach($posts as $post)
            <div class="uk-card uk-card-default uk-card-body uk-margin">
                <p>{{$post[1]}}</p>
                <p>Posted by {{$post[3]}} on {{$post[4]}}</p>
                <button class="mc-toggle-comments uk-button">Comments</button>
                <div class="mc-comments">
                    @foreach($post[2] as $comment)
                        <div class="uk-card uk-card-default uk-card-body uk-margin">
                            <p>{{$comment[1]}}</p>
                            <p>Commented by {{$comment[0]}}</p>
                        </div>
                    @endforeach
                </div>
                <form class="uk-margin-top" action="{{ route('groups.post.comment.add',['id'=> $group->id,'post_id'=> $post[0]])}}" method="post">
                    @csrf
                    <textarea class="uk-textarea" name="comment" id="comment-body" rows="5"></textarea>
                    <button type="submit" class="uk-button uk-margin-remove-top">Send comment</button>
                </form>
            </div>
        @endforeach
    </div>
    <script>
        $(".mc-comments").hide();
        $(".mc-toggle-comments").click(function() {
          $(this).parent().find(".mc-comments").toggle();
        });
    </script>
@endsection