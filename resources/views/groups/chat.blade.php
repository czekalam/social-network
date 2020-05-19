@extends('layouts.master')

@section('title')
    Groups
@endsection

@section('page-class') groups @endsection

@section('content')
    <div class="mc-box">
        <h1>Czat</h1>
        <h1>{{ $group->name }}</h1>
        <div id="chat-box" class="chat-box">
        </div>
        <form id="message-form" action="#" method="post">
            @csrf
            <div>
                <input type="hidden" name="author" value="{{Auth::user()->id}}"/>
                <textarea class="uk-textarea" id="content" name="content" rows="5"></textarea>
            </div>
            <button id="form-submit" type="submit" class="uk-button">Send</button>
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
            WsetInterval(function(){
                getMessages();
            }, 500);
            $('#form-submit').click(function(event) {
                postMessage();
            });
            function getMessages() {
                $.ajax({
                    method: "GET",
                    url: "/groups/{id}/chat",
                    data: {"author": {{Auth::user()->id}}},
                    success: function(data) {
                        dd(data);
                    }
                });
            }
            function postMessage() {
                var data = $("#content").val();
                $.ajax({
                    method: "POST",
                    url: "/groups/chat/{id}/add",
                    data: {"content": data, "author": {{Auth::user()->id}}},
                    success: function(data) {
                        $('#chat-box').empty();
                        $('#content').val('');
                        $.each( data, function( index, value ){
                            dd();
                        })
                    }
                });
            }
        });
        chatBox.scrollTop = chatBox.scrollHeight;
    </script>
@endsection