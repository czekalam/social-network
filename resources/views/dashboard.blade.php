@extends('layouts.master')

@section('page-class') dashboard @endsection

@section('content')
    @include('includes.info-box')
    @include('includes.message-block')
    <section class="">
        <div class="mc-box">
            <header><h3>Say something to your friends...</h3></header>
            <form action="{{ route('post.create')}}" method="post">
                @csrf
                <div class="">
                    <textarea class="" name="body" id="new-post" rows="5" placeholder="Your Post"></textarea>
                </div>
                <button type="submit" class="">Create Post</button>
            </form>
        </div>
    </section>
    <section class="">
        <div class="mc-box">
            <h3>What your friends say...</h3>
            @foreach($posts as $posts2)
              @foreach($posts2 as $post)
                <article data-postid="{{$post->id}}" class="post">
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
                          @else
                            <a class="like" href="#">Like</a>
                          @endif
                          @if($like == 0)
                            <a class="dislike like" href="#">Disliked</a>
                          @else
                            <a class="dislike like" href="#">Dislike</a>
                          @endif
                          
                          @if(Auth::user() == $post->user)
                              <a data-toggle="modal" data-target="#{{"modal".$post->id}}" href="#">Edit</a>
                              <a href="{{ route('post.delete', ['post_id'=>$post->id])}}">Delete</a>
                          @endif
                      </div>
                      <div class="">
                        Comments
                        @foreach($post->comments as $comment)
                          <div class="">
                            <p>{{$comment->content}}</p>
                            <p>Commented by{{$comment->user->first_name}}</p>
                          </div>
                        @endforeach
                        <form action="{{'/post/'.$post->id.'/comments'}}" method="post">
                          @csrf
                            <div class="">
                                <input name="post_id" type="hidden" value="{{$post->id}}"/>
                                <textarea class="" name="comment" id="comment-body" rows="5"></textarea>
                            </div>
                            <button type="submit" class="">Save changes</button>
                        </form>
                      </div>
                  </article>
                  
                  {{-- <div class="ml faodade" id="{{"modal".$post->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form action="{{ route('post.update')}}" method="post">
                            @csrf
                              <div class="form-group">
                                  <label for="body">Edit the Post</label>
                                  <input name="post_id" type="hidden" value="{{$post->id}}"/>
                                  <textarea class="form-control" name="body" id="post-body" rows="5">{{$post->body}}</textarea>
                              </div>
                              <button type="submit" class="btn btn-primary">Save changes</button>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div> --}}
              @endforeach
            @endforeach
        </div>
    </section>
    <script>
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