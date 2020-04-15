@extends('layouts.master')

@section('title')
    Hi!
@endsection

@section('page-class') chat @endsection

@section('content')
    <div class="chat">
        <h1>Chat</h1>
        <div id="chat-box" class="chat-box">
        </div>
        <form id="message-form" action="#" method="post">
            @csrf
            <div>
                <input type="hidden" name="receiver" value="{{$receiver}}"/>
                <textarea id="content" name="content" rows="5"></textarea>
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