@php $uniqueProfileSlug = $customerRow->gender_name.'-proposal-'.(!empty($customerRow->getCitySlug)?$customerRow->getCitySlug->slug:'NA').'-'.(!empty($customerRow->getCountrySlug)?$customerRow->getCountrySlug->slug:'NA').'-'.$customerRow->faker_id; @endphp
<div class="py-2 px-4 border-bottom">
    <div class="d-flex align-items-center py-1">
        <div class="position-relative">
            <a href="{{route('search.by.slug',[$uniqueProfileSlug])}}" target="_blank"><img src="{{$receiverImage}}" class="rounded-circle mr-1" alt="{{$receiverName}}" width="40" height="40"></a>
        </div>
        <div class="flex-grow-1 pl-3">
            <strong><a href="{{route('search.by.slug',[$uniqueProfileSlug])}}" target="_blank">{{$receiverName}}</a></strong>
        </div>
    </div>
</div>
<input type="hidden" id="send" value="{{route('send-message',$receiverId)}}" >

<div class="position-relative">
    <div class="chat-messages data--chatting-open{{$receiverId}} p-4" id="chat-messages">
        @foreach($messages as $message)
            @if($message->sender_id == $authUserId)
                <div class="chat-message-right mb-4">
                    <div class="flex-shrink-1 bg-light rounded border border-1 border-danger py-2 px-3 mr-3">
                        <div class="font-weight-600 mb-1">You <span class="float-end" style="color: #757575;">{{date('d M Y, h:i A',strtotime($message->created_at))}}</span> </div>
                        <p class="m-0 text-break">{{$message->message}}</p>
                    </div>
                </div>
            @else
                <div class="chat-message-left pb-4">
                    <div class="flex-shrink-1 bg-light rounded border border-1 border-info py-2 px-3 ml-3">
                        <div class="font-weight-600 mb-1">{{$receiverName}} <span class="float-end" style="color: #757575;">{{date('d M Y, h:i A',strtotime($message->created_at))}}</span> </div>
                        <p class="m-0 text-break fs">{{$message->message}}</p>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>

<div class="flex-grow-0 py-3 px-4 border-top">
    <div class="input-group mb-3">
        <input type="text" class="form-control chat_message" name="chat_message" id="chat_message" placeholder="Type your message here...">
        <span id="send_message" class="input-group-text bg-primary" role="button">
            <i class="fa fa-send text-white" aria-hidden="true"></i>
        </span>
    </div>
</div>

<script>
    $(function (){
        $('#chat_message').on('keyup', function (e) {
            $(':input').removeClass('has-error');
            $('.text-danger').remove();
            if (e.key === 'Enter') {
                if (e.target.value.trim()) {
                    sendMessage(e.target.value.trim());
                    // e.target.value='';
                }
            }
            return false;
        });
        $('#send_message').on('click', function (e) {
            if ($('#chat_message').val().trim()) {
                sendMessage($('#chat_message').val().trim());
                // $('#chat_message').val('');
            }
            return false;
        });
    });
</script>
