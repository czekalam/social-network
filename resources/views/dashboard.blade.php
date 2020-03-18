@extends('layouts.master')
@section('content')

    @include('includes.info-box')
    @include('includes.message-block')
    <section class="row new-post">
        <div class="col-md-6 offset-md-3">
            <header><h3>Say something to your friends...</h3></header>
            <form action="{{ route('post.create')}}" method="post">
                @csrf
                <div class="form-group">
                    <textarea class="form-control" name="body" id="new-post" rows="5" placeholder="Your Post"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Create Post</button>
            </form>
        </div>
    </section>
    <section class="row posts">
        <div class="col-md-6 offset-md-3">
            <header><h3>What your friends say...</h3></header>
            @foreach($posts as $posts2)
              @foreach($posts2 as $post)
                <article data-postid="{{$post->id}}" class="post">
                      <p>{{$post->body}}</p>
                      <div class="info">
                          Posted by {{$post->user->first_name}} on {{$post->created_at}}
                      </div>
                      <div class="interaction">
                          <a class="like" href="#">Like</a>
                          <a class="like" href="#">Dislike</a>
                          @if(Auth::user() == $post->user)
                              <a data-toggle="modal" data-target="#{{"modal".$post->id}}" href="#">Edit</a>
                              <a href="{{ route('post.delete', ['post_id'=>$post->id])}}">Delete</a>
                          @endif
                      </div>
                  </article>
                  
                  <div class="modal fade" id="{{"modal".$post->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                  </div>
              @endforeach
            @endforeach
        </div>
    </section>
    <script>
      var urlLike = '{{route('like')}}';
      var token = '{{ Session::token() }}';
    </script>
@endsection