@extends('front.layouts.master')

@section('title', 'Messenger')

@push('style')
    <style>
        .chat-online {
            color: #34ce57
        }

        .chat-offline {
            color: #e4606d
        }

        .chat-messages {
            display: flex;
            flex-direction: column;
            /*max-height: 800px;*/
            max-height: 70vh;
            overflow-y: scroll
        }

        .chat-message-left,
        .chat-message-right {
            /*display: flex;*/
            /*flex-shrink: 0;*/
            min-width: 80%;
        }

        .chat-message-left {
            margin-right: auto;
        }

        .chat-message-right {
            flex-direction: row-reverse;
            margin-left: auto
        }
        .py-3 {
            padding-top: 1rem!important;
            padding-bottom: 1rem!important;
        }
        .px-4 {
            padding-right: 1.5rem!important;
            padding-left: 1.5rem!important;
        }
        .flex-grow-0 {
            flex-grow: 0!important;
        }
        .border-top {
            border-top: 1px solid #dee2e6!important;
        }
        .chat-room,.conversation {
            min-height: 70vh;
        }
        .chat-messages {
            min-height: 55vh;
        }
        #overlay {
            position: sticky;
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            width: 100%;
        }
        #overlay .meimg{
            width: 150px;
            height: 150px;
            object-fit: cover;
            margin-top: 25%;
            margin-left: 40%;
        }
        .chatter-signle.active {
            background: #040F2E;
        }
        .chatter-signle.active span {
            color: #fff!important;
        }
    </style>
@endpush

@section('content')
    <div class="mt-xl-43"></div>
    <div class="container-xxl justify-content-md-start py-34">

        <div class="card chat-room">
            <div class="row g-0">
                {{-- All Customers --}}
                <div class="col-12 col-lg-5 col-xl-3 border-end">
                    <div class="px-4">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <input type="text" class="form-control my-3" placeholder="Search ..." onkeyup="searchPlayer(this)">
                            </div>
                        </div>
                    </div>
                    <div class="chat-list">
                        @include('front.messenger.partials.chatter',[$users])
                    </div>
                </div>

                <div class="col-12 col-lg-7 col-xl-9 conversation" id="conversation">
                    <div class="waiting-screen text-center">
                        <img src="{{asset('assets/img/chat-waiting.png')}}" alt="Start Chatting" width="60%">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-xl-43"></div>
@endsection

@push('script')
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script type="text/javascript">
        let openChatUserId = '';
        var notification_sound_route = '{!! asset('notification_sound/notify-1.wav') !!}';
        var PaidPng = '{!! asset('messanger/Paid.png') !!}';
        Pusher.logToConsole = true;
        var pusher = new Pusher('{{config('broadcasting.connections.pusher.key')}}', {
            cluster: 'ap2'
        });
        var channel = pusher.subscribe('receiver-channel');
        channel.bind('receiver-event', function(data) {
            data = JSON.parse(data);
            $('<audio id="chatAudio"><source src="' + notification_sound_route + '" type="audio/ogg"></audio>').appendTo('body');
            $('#chatAudio')[0].play();
            $(`.chatter--innernotify${data.sender_id}`).css("display", "flex");
            $(`.chatter--innernotify${data.sender_id}`).text(parseFloat($(`.chatter--innernotify${data.sender_id}`).text()) + parseFloat(1));
            if ($(`.data--chatting-open${data.sender_id}`).html() && $(`.data--chatting-open${data.sender_id}`).html() !== undefined) {
                let newMes = `
                    <div class="chat-message-left pb-4">
                        <div class="flex-shrink-1 bg-light rounded border  border-1 border-info py-2 px-3 ml-3">
                            <div class="font-weight-bold mb-1">${data?.receiver_name}</div>
                            ${data?.message}
                        </div>
                    </div>
                `;
                $('#conversation .chat-messages').append(newMes);
                setTimeout(function(){
                    var objDiv = document.getElementById("chat-messages");
                    objDiv.scrollTop = objDiv.scrollHeight;
                }, 500);
            }
            showAllUsers();
        });

        $(function () {
            if ('{{$newCustomerId}}') {
                $('.chatter-signle.chatter-signle{{$newCustomerId}}').click();
            }
        });
        
        function showAllUsers() {
            axios.get('{{route('get.chat.users')}}').then(function (res) {
                if (res.data) {
                    $('.chat-room .chat-list').html(res.data);
                    if (openChatUserId) {
                        $(`.chatter-signle.chatter-signle${openChatUserId}`).click();
                    }
                }
            });
        }

        function alertShowUp(message,icon,timer=5000) {
            Swal.fire({
                title: message,
                icon: icon,
                showConfirmButton: false,
                position: 'top-right',
                timer: timer
            });
            return false;
        }

        function showMessage(input,messageUrl,id) {
            openChatUserId = id;
            $('.conversation').html('<div id="overlay"><img class="meimg" src="{{asset('assets/img/loader.gif')}}" /></div>');
            document.getElementById("overlay").style.display = "block";
            $('#scroll--chat').find('.chat').removeClass('active');
            $('.chatter-signle').removeClass('active');

            $(input).addClass('active');
            $(input).find('.chatter--innernotify').css("display", "none");
            $(input).find('.chatter--innernotify').text("0");

            axios.get(messageUrl).then(function (res) {
                document.getElementById("overlay").style.display = "none";
                $('.conversation').html(res.data);
                setTimeout(function(){
                    var objDiv = document.getElementById("chat-messages");
                    objDiv.scrollTop = objDiv.scrollHeight;
                }, 500);
            });
            return false;
        }

        function sendMessage(data) {
            axios.post($('#send').val(), {message:data}).then(function (response){
                if (response.data.status == 'success') {
                    $('#chat_message').val('');
                    let newMes = `
                        <div class="chat-message-right mb-4">
                            <div class="flex-shrink-1 bg-light rounded border  border-1 border-danger py-2 px-3 mr-3">
                                <div class="font-weight-bold mb-1">You</div>
                                ${data}
                            </div>
                        </div>
                `;
                    $('#conversation .chat-messages').append(newMes);
                    setTimeout(function(){
                        var objDiv = document.getElementById("chat-messages");
                        objDiv.scrollTop = objDiv.scrollHeight;
                    }, 500);
                } else if (response.data.status == 'limit') {
                    Swal.fire({
                        icon: 'warning',
                        title: response.data.msg,
                        type: 'info',
                        html:'<a target="_blank" href="{{route('packages')}}"><img src="'+PaidPng+'" alt="Smiley face" ></a><br>&nbsp;',
                        showCloseButton: false,
                        showCancelButton: true,
                        focusConfirm: false,
                        confirmButtonColor: '#040F2E',
                        confirmButtonText: 'Upgrade',
                        cancelButtonColor: '#040F2E'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location = "{{route('packages')}}";
                        }
                    });
                } else {
                    alertShowUp(response.data.msg,response.data.status,5000);
                }
            }).catch(function (error) {
                if (error.response.status==422) {
                    $.each(error.response.data.errors, function (k, v) {
                        if (k=='message') {
                            $(':input[name="chat_message"]').addClass("has-error");
                            $(':input[name="chat_message"]').parent().after("<span class='text-danger'>" + v[0] + "</span>");
                        }
                    });
                }
            });
            return;
        }

        function searchPlayer(input){
            var lookup = $(input).val().toLowerCase();
            $(".all--players").each(function() {
                console.log($(this).find(".player--name").text());
                if ($(this).find(".player--name").text().toLowerCase().includes(lookup)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }
    </script>

@endpush