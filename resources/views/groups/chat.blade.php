@extends('layouts.master')

@section('title')
    Groups
@endsection

@section('page-class') groups chat @endsection

@section('content')
    <div class="mc-box">
        <h1>Chat of {{ $group->name }}</h1>
        <div id="chat-box" class="chat-box">
        </div>
        <form id="message-form" action="#" method="post">
            @csrf
            <div>
                <input type="hidden" name="author" value="{{Auth::user()->id}}"/>
                <textarea class="uk-textarea" id="content" name="content" rows="5"></textarea>
            </div>
        </form>
    </div>

    <script>
        $("#message-form").click(function(e) {
            e.preventDefault();
        });
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
                    url: "/groups/"+{{$group->id}}+"/chat/data",
                    data: {"id":{{$group->id}}},
                    success: function(data) {
                        $('#chat-box').empty();
                        $.each( data, function( index, value ){
                            var $item = $('<div>').addClass("chat-box__row").append(
                                $('<div>').addClass("chat-box__message").append(value[0])
                            ).append(
                                $('<img>').attr("src",'/userimage/'+value[1]).addClass("mc-chat-img")
                            );
                            if(value[1]=={{Auth::user()->id}}) {
                                $item.addClass("chat-box__row--my");
                            }
                            else {
                                $item.addClass("chat-box__row--sb");
                            }
                            $('#chat-box').append($item);
                        });
                    }
                });
            }
            function postMessage() {
                var data = $("#content").val();
                $.ajax({
                    method: "POST",
                    url: "/groups/"+{{$group->id}}+"/chat/message/add",
                    data: {"content": data, "group": {{ $group->id }}},
                    success: function(data) {
                        $('#chat-box').empty();
                        $('#content').val('');
                    }
                });
            }
        });
        chatBox.scrollTop = chatBox.scrollHeight;
    </script>
@endsection