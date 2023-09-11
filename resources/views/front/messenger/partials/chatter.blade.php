@php
    $loginChatUserId = auth()->guard('customer')->id();
    $usedCustomerIds = [];
@endphp
@foreach($users as $user)
    @if($user->sender_id != $loginChatUserId && !empty($user->getSenderCustomer))
        @php array_push($usedCustomerIds,$user->sender_id) @endphp
        <div onclick="showMessage(this,'{{route('get-messages',$user->getSenderCustomer->id)}}','{{$user->getSenderCustomer->id}}');" class="all--players noti chatter-signle chatter-signle{{$user->getSenderCustomer->id}}" role="button" style="padding: 10px;">
            <div class="col-md-10">
                <img src="{{$user->getSenderCustomer->imageFullPath}}" class="rounded-circle mr-1 position-relative" alt="{{$user->getSenderCustomer->full_name}}" width="40" height="40">
                <span class="player--name position-absolute" style="margin-left: 10px;">
                {{$user->getSenderCustomer->full_name}}<br>
                <span style="font-size: 12px;color: #757575;">{{(strlen($user->message) > 30) ? substr($user->message, 0, 30).'...' : $user->message}}</span>
            </span>
            </div>
            <div class="col-md-2 ">
                <span class="badge bg-noti chatter--innernotify chatter--innernotify{{$user->getSenderCustomer->id}}" style="width:20%;display: {{($user->getSenderCustomer->un_seen_messages_count!=0) ? 'flex' : 'none'}};">
                    {{($user->getSenderCustomer->un_seen_messages_count!=0) ? $user->getSenderCustomer->un_seen_messages_count : '0'}}
                </span>
            </div>
        </div>
    @endif
    @if($user->receiver_id != $loginChatUserId && !empty($user->getReceiverCustomer) && !in_array($user->receiver_id,$usedCustomerIds))
        @php array_push($usedCustomerIds,$user->receiver_id) @endphp
        <div onclick="showMessage(this,'{{route('get-messages',$user->getReceiverCustomer->id)}}','{{$user->getReceiverCustomer->id}}');" class="all--players noti chatter-signle chatter-signle{{$user->getReceiverCustomer->id}}" role="button" style="padding: 10px;">
            <div class="col-md-10">
                <img src="{{$user->getReceiverCustomer->imageFullPath}}" class="rounded-circle mr-1 position-relative" alt="{{$user->getReceiverCustomer->full_name}}" width="40" height="40">
                <span class="player--name position-absolute" style="margin-left: 10px;">
                {{$user->getReceiverCustomer->full_name}}<br>
                <span style="font-size: 12px;color: #757575;">{{(strlen($user->message) > 30) ? substr($user->message, 0, 30).'...' : $user->message}}</span>
            </span>
            </div>
            <div class="col-md-2 ">
                <span class="badge bg-noti chatter--innernotify chatter--innernotify{{$user->getReceiverCustomer->id}}" style="width:20%;display: {{($user->getReceiverCustomer->un_seen_messages_count!=0) ? 'flex' : 'none'}};">
                    {{($user->getReceiverCustomer->un_seen_messages_count!=0) ? $user->getReceiverCustomer->un_seen_messages_count : '0'}}
                </span>
            </div>
        </div>
    @endif
@endforeach
@if(!empty($newCustomerRow) && $newCustomerRow->id != $loginChatUserId && !in_array($newCustomerRow->id,$usedCustomerIds))
    <div onclick="showMessage(this,'{{route('get-messages',$newCustomerRow->id)}}','{{$newCustomerRow->id}}');" class="all--players noti chatter-signle chatter-signle{{$newCustomerRow->id}}" role="button" style="padding: 10px;">
        <div class="col-md-10">
            <img src="{{$newCustomerRow->imageFullPath}}" class="rounded-circle mr-1 position-relative" alt="{{$newCustomerRow->full_name}}" width="40" height="40">
            <span class="player--name position-absolute" style="margin-left: 10px;">
                {{$newCustomerRow->full_name}}
            </span>
        </div>
        <div class="col-md-2 ">
                <span class="badge bg-noti chatter--innernotify chatter--innernotify{{$newCustomerRow->id}}" style="width:20%;display: {{($newCustomerRow->un_seen_messages_count!=0) ? 'flex' : 'none'}};">
                    {{($newCustomerRow->un_seen_messages_count!=0) ? $newCustomerRow->un_seen_messages_count : '0'}}
                </span>
        </div>
    </div>
@endif