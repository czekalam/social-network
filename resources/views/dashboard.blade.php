@extends('layouts.master')

@section('page-class') dashboard @endsection

@section('content')
    @include('includes.info-box')
    @include('includes.message-block')
    <section class="">
        <div class="mc-box">
            <h3>Say something to your friends...</h3>
            <form action="{{ route('post.create')}}" method="post">
                @csrf
                <div class="">
                    <textarea class="uk-textarea" name="body" id="new-post" rows="5" placeholder="Your Post"></textarea>
                </div>
                <button type="submit" class="uk-button">Create Post</button>
            </form>
        </div>
    </section>
    <section class="">
        <div class="mc-box">
            <h3>What your friends say...</h3>
            @foreach($posts as $posts2)
              @foreach($posts2 as $post)
                <div data-postid={{$post->id}} class="uk-card uk-card-default uk-card-body uk-margin">
                      <p>{{$post->body}}</p>
                      <div class="">
                          Posted by {{$post->user->first_name}} on {{$post->created_at}}
                      </div>
                      <div class="">
                          @php
                              $like="";
                              if($post->likes()->where("user_id", Auth::user()->id)->first()){
                                $like = $post->likes()->where("user_id", Auth::user()->id)->first()->like;
                              }
                          @endphp
                          @if($like == 1)
                            <a class="like" href="#">Liked</a>
                            <a class="dislike like" href="#">Dislike</a>
                          @elseif($like == "0")
                            <a class="like" href="#">Like</a>
                            <a class="dislike like" href="#">Disliked</a>
                          @else
                            <a class="like" href="#">Like</a>
                            <a class="dislike like" href="#">Dislike</a>
                          @endif
                          
                          @if(Auth::user() == $post->user)
                              <a data-toggle="modal" data-target="#{{"modal".$post->id}}" href="#">Edit</a>
                              <a href="{{ route('post.delete', ['post_id'=>$post->id])}}">Delete</a>
                          @endif
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
            @endforeach
        </div>
    </section>
    <script>
      $(".mc-comments").hide();
      $(".mc-toggle-comments").click(function() {
        $(this).parent().find(".mc-comments").toggle();
      });

      var urlLike = '{{route('like')}}';
      var token = '{{ Session::token() }}';
      var data = "asxosixoaj";
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $( document ).ready(function() {
        $(".like").click(function(event) {
          event.preventDefault();
          var $like = $(this);
          if (!$(this).hasClass("dislike")) {
            jQuery.ajax({
              method: "POST",
              url: urlLike,
              data: {"post_id": $(this).parent().parent().data().postid, "isLike": true},
            }).done(function(data,status,xhr) {
              $like.text("Liked");
              $like.siblings().text("Dislike");
            });
          }
          else {
            jQuery.ajax({
              method: "POST",
              url: urlLike,
              data: {"post_id": $(this).parent().parent().data().postid, "isLike": false},
            }).done(function(data,status,xhr) {
              $like.text("Disliked");
              $like.siblings().text("Like");
            });
          }
        });
      });
    </script>
@endsection