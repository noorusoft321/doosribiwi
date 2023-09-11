<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Http\Requests\YourRequest;
use App\Models\Customer;
use App\Models\CustomerChatting;
use App\Models\CustomerChattingFriend;
use Illuminate\Support\Facades\Auth;

class MessengerController extends Controller {

    public function index($customerUserName='') {
        $this->makeChatList();
        $newCustomerId='';
        $newCustomerRow = null;
        if (!empty($customerUserName)) {
            $newCustomerRow = Customer::where('name',$customerUserName)->first();
            if(!empty($newCustomerRow)) {
                $newCustomerId = $newCustomerRow->id;
            }
        }
        $users = $this->getAllChatList();
        return view('front.messenger.index', compact('users','newCustomerId','newCustomerRow'));
    }

    public function makeChatList()
    {
        $sender_id = Auth::guard('customer')->id();
        $hasList = CustomerChattingFriend::where('deleted',0)->where("sender_id", $sender_id)
            ->orWhere("receiver_id", $sender_id)->count();
        if ($hasList==0) {
            $customerChatting = CustomerChatting::where('deleted',0)->where("sender_id", $sender_id)
                ->orWhere("receiver_id", $sender_id)
                ->groupBy(['sender_id','receiver_id'])->get();
            if (count($customerChatting) > 0) {
                foreach ($customerChatting as $chat) {
                    $chatterAvailable = CustomerChattingFriend::where('deleted',0)->
                    where([
                        ['sender_id',$chat->sender_id],
                        ['receiver_id',$chat->receiver_id]
                    ])->orWhere([
                        ['receiver_id',$chat->sender_id],
                        ['sender_id',$chat->receiver_id]
                    ])->first();

                    if (!empty($chatterAvailable)) {
                        $lastMessageRow = CustomerChatting::where('deleted',0)
                            ->where([
                                ['receiver_id','=',$chatterAvailable->receiver_id],
                                ['sender_id','=',$chatterAvailable->sender_id]
                            ])->orWhere([
                                ['sender_id','=',$chatterAvailable->receiver_id],
                                ['receiver_id','=',$chatterAvailable->sender_id]
                            ])->orderBy('id','desc')->first();
                        if (!empty($lastMessageRow)) {
                            $chatterAvailable->update([
                                'message' => $lastMessageRow->message
                            ]);
                        }
                    } else {
                        CustomerChattingFriend::create([
                            'sender_id'   => $chat->sender_id,
                            'receiver_id' => $chat->receiver_id,
                            'message'     => $chat->message
                        ]);
                    }
                }
            }
        }
        return;
    }

    public function getChatUsers()
    {
        $users = $this->getAllChatList();
        $newCustomerRow = null;
        return view('front.messenger.partials.chatter', compact('users','newCustomerRow'))->render();
    }

    public function getAllChatList()
    {
        $sender_id = Auth::guard('customer')->id();
        return CustomerChattingFriend::with([
            'getReceiverCustomer','getSenderCustomer'
        ])->where('sender_id',$sender_id)
            ->orWhere('receiver_id',$sender_id)
            ->orderBy('updated_at', 'desc')->get();
    }

    public function getMessage($receiverId) {
        $authUserId = Auth::guard('customer')->id();
        CustomerChatting::where([
            ['sender_id','=',$receiverId],
            ['receiver_id','=',$authUserId],
            ['message_status','=',1]
        ])->update(['message_status'=>2]);

        $customerRow = Customer::with([
            'getCitySlug',
            'getCountrySlug'
        ])->findOrFail($receiverId);
        $receiverName = $customerRow->full_name;
        $receiverImage = $customerRow->imageFullPath;

        $messages = CustomerChatting::where([
            ['sender_id','=',$receiverId],
            ['receiver_id','=',$authUserId]
        ])->orWhere([
            ['receiver_id','=',$receiverId],
            ['sender_id','=',$authUserId]
        ])->get();

        return view('front.messenger.partials.messages', compact('messages','receiverName','receiverId','receiverImage','authUserId','customerRow'))->render();
    }

    public function sendMessage(YourRequest $request, $receiverId) {
        $sender_id = Auth::guard('customer')->id();
        $limitResponse = checkMessageLimit($sender_id);
        if (!empty($limitResponse)) {
            $request = $request->all();
            $request['receiver_id'] = $receiverId;
            $request['sender_id'] = $sender_id;
            $customerChattingFriend = CustomerChattingFriend::where([
                ['receiver_id','=',$receiverId],
                ['sender_id','=',$sender_id]
            ])->orWhere([
                ['receiver_id','=',$sender_id],
                ['sender_id','=',$receiverId]
            ])->first();

            if (empty($customerChattingFriend)) {
                CustomerChattingFriend::create($request);
            } else {
                $customerChattingFriend->update(['message' => $request['message']]);
            }
            $messageSuccess = CustomerChatting::create($request);
            if (!empty($messageSuccess)) {
                $receiverRow = Customer::findOrFail($sender_id);
                $request['receiver_name'] = $receiverRow->first_name.' '.$receiverRow->last_name;
                fireDoctorMessage($request);
                return response()->json(['status'=>'success'],200);
            } else {
                return response()->json(['status'=>'warning','msg' => 'Message has not been sent.'],200);
            }
        } else {
            return response()->json(['status'=>'limit','msg' => "Your monthly message limit ended. Please contact support to increase your limit."],200);
        }
    }

}
