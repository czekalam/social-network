@extends('layouts.master')

@section('title')
    Hi!
@endsection

@section('content')
    this is chat
    @foreach ($messages as $message)
        {{ $message->user1_id }}
        {{ $message->user2_id }}
        {{ $message->content }}
    @endforeach
    <form action="{{ route('chat.add')}}" method="post">
        @csrf
          <div class="form-group">
              <textarea class="form-control" name="content" rows="5"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Save changes</button>
      </form>
@endsection