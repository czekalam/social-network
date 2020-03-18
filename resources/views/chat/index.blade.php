@extends('layouts.master')

@section('title')
    Hi!
@endsection

@section('content')
    <div class="chat">
        <h1>Chat</h1>
            <style>
                .chat-box {
                    border:1px solid #000;
                    height: 50vh;
                    overflow-y: scroll;
                }
                .chat-box__message {
                    border-radius:5px;
                    background:#00f;
                    margin: 10px;
                    padding: 5px;
                    color:#fff;
                }
                .chat-box__row--my {
                    justify-content: flex-end;
                }
                .chat-box__row--my .chat-box__message{
                    background:#55f;
                }
                .chat-box__row {
                    display: flex;
                }
            </style>
        <div id="chat-box" class="chat-box">
            @foreach ($messages as $message)
                <div class="chat-box__row chat-box__row--{{($message->user1_id == Auth::user()->id)?'my':'sb'}}">
                    <div class="chat-box__message">{{ $message->content }}</div>
                </div>
            @endforeach
        </div>
        <form action="{{ route('chat.add')}}" method="post">
            @csrf
            <div class="form-group">
                <input type="hidden" name="receiver" value="{{$receiver}}"/>
                <textarea class="form-control" name="content" rows="5"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
    </div>
    <script>
        var chatBox = document.getElementById("chat-box");
        chatBox.scrollTop = chatBox.scrollHeight;
    </script>
@endsection