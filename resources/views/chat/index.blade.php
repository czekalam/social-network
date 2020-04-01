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
            {{-- @foreach ($messages as $message)
                <div class="chat-box__row chat-box__row--{{($message->user1_id == Auth::user()->id)?'my':'sb'}}">
                    <div class="chat-box__message">{{ $message->content }}</div>
                </div>
            @endforeach --}}
        </div>
        <form id="message-form" action="#" method="post">
            @csrf
            <div class="form-group">
                <input type="hidden" name="receiver" value="{{$receiver}}"/>
                <textarea id="content" class="form-control" name="content" rows="5"></textarea>
            </div>
            <div id="form-submit" type="submit" class="btn btn-primary">Save changes</div>
        </form>
    </div>
    <script>
        var chatBox = document.getElementById("chat-box");
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            var messages_count=0;
            $("#content").keypress(function(e) {
                if(e.which == 10 || e.which == 13) {
                    e.preventDefault();
                    postMessage();
                }
            });
            setInterval(function(){
                getMessages();
            }, 500);
            $('#form-submit').click(function(event) {
                postMessage();
            });
            function getMessages() {
                $.ajax({
                    method: "GET",
                    url: "chat/data",
                    data: {"receiver": {{$receiver}}},
                    success: function(data) {
                        if(data.length>messages_count){
                            $('#chat-box').empty();
                            $.each( data, function( index, value ){
                                var $item = $('<div>').addClass("chat-box__row").append(
                                    $('<div>').addClass("chat-box__message").append(value.content)
                                )
                                if(value.user1_id=={{Auth::user()->id}}) {
                                    $item.addClass("chat-box__row--my");
                                }
                                else {
                                    $item.addClass("chat-box__row--sb");
                                }
                                $('#chat-box').append($item);
                                chatBox.scrollTop = chatBox.scrollHeight;
                            })
                            messages_count=data.length;
                        }
                    }
                });
            }
            function postMessage() {
                var data = $("#content").val();
                $.ajax({
                    method: "POST",
                    url: "chat",
                    data: {"content": data, "receiver": {{$receiver}}},
                    success: function(data) {
                        $('#chat-box').empty();
                        $('#content').val('');
                        $.each( data, function( index, value ){
                            var $item = $('<div>').addClass("chat-box__row").append(
                                $('<div>').addClass("chat-box__message").append(value.content)
                            )
                            if(value.user1_id=={{Auth::user()->id}}) {
                                $item.addClass("chat-box__row--my");
                            }
                            else {
                                $item.addClass("chat-box__row--sb");
                            }
                            $('#chat-box').append($item);
                            chatBox.scrollTop = chatBox.scrollHeight;
                        })
                    }
                });
            }
        });
        chatBox.scrollTop = chatBox.scrollHeight;
    </script>
@endsection