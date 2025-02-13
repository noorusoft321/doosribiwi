<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerBlock;
use App\Models\CustomerChatting;
use App\Models\CustomerChattingFriend;

class MessengerController extends Controller {

    public function index($newCustomerId = '') {
        $currentCustomerId = auth()->id();

        // Fetch customer chat list
        $customerListCollection = CustomerChattingFriend::select(
            'id', 'sender_id', 'receiver_id', 'message', 'updated_at'
        )
            ->where('sender_id', $currentCustomerId)
            ->orWhere('receiver_id', $currentCustomerId)
            ->orderBy('updated_at', 'desc');

        $totalRecord = $customerListCollection->count();
        $customerList = $customerListCollection->get();

        // Map the customer data
        $customerList->map(function ($item) use ($currentCustomerId) {
            $otherCustomerId = ($currentCustomerId == $item->sender_id) ? $item->receiver_id : $item->sender_id;
            $item->customer = Customer::select('id', 'first_name', 'last_name', 'image', 'profile_pic_client_status', 'profile_pic_status')
                ->where('id', $otherCustomerId)
                ->first();

            $item->customer->makeHidden([
                'first_name', 'last_name', 'image', 'profile_pic_client_status', 'profile_pic_status',
                'faker_id', 'verification_status', 'age', 'gender_name', 'assign_user_name',
                'assign_lead_user_name', 'match_assign_user_name', 'match_assign_lead_user_name'
            ]);

            return $item;
        });

        $customerList->makeHidden(['id', 'faker_id', 'sender_id', 'receiver_id']);

        // ✅ Check if $newCustomerId is provided and does not already exist in collection
        if (!empty($newCustomerId)) {
            $customerExists = $customerList->contains(function ($item) use ($newCustomerId) {
                return $item->customer->id == $newCustomerId;
            });

            if (!$customerExists) {
                $newCustomer = Customer::select('id', 'first_name', 'last_name', 'image', 'profile_pic_client_status', 'profile_pic_status')
                    ->where('id', $newCustomerId)
                    ->first();

                if ($newCustomer) {
                    $newCustomerItem = (object) [
                        'message' => null,
                        'updated_at' => now(),
                        'customer' => $newCustomer
                    ];

                    // Hide unnecessary fields
                    $newCustomerItem->customer->makeHidden([
                        'first_name', 'last_name', 'image', 'profile_pic_client_status', 'profile_pic_status',
                        'faker_id', 'verification_status', 'age', 'gender_name', 'assign_user_name',
                        'assign_lead_user_name', 'match_assign_user_name', 'match_assign_lead_user_name'
                    ]);

                    $customerList->prepend($newCustomerItem);
                    $totalRecord++; // Increase count only if new customer was added
                }
            }
        }

        // Unread messages count
        $unreadMessageCount = CustomerChatting::where('receiver_id', $currentCustomerId)
            ->where('message_status', 1)
            ->where('deleted', 0)
            ->count();

        return response()->json([
            'success' => true,
            'message' => 'Messenger friends have been fetched successfully.',
            'data' => [
                'customerChatList' => $customerList,
                'totalCustomerChatList' => $totalRecord,
                'unreadMessageCount' => $unreadMessageCount
            ]
        ], 200);
    }

    public function getMessage($receiverId) {
        $authUserId = auth()->id();
        CustomerChatting::where([
            ['sender_id','=',$receiverId],
            ['receiver_id','=',$authUserId],
            ['message_status','=',1]
        ])->update(['message_status'=>2]);

        $receiverRow = Customer::select(
            'id',
            'first_name',
            'last_name',
            'name',
            'image',
            'profile_pic_client_status',
            'profile_pic_status',
            'agent_mobile'
        )->findOrFail($receiverId);

        $receiverRow->isMyBlock = !! CustomerBlock::where([
            'blockTo' => $receiverId,
            'blockBy' => $authUserId
        ])->count();

        $receiverRow->makeHidden([
            'name',
            'first_name',
            'last_name',
            'image',
            'profile_pic_client_status',
            'profile_pic_status',
            'faker_id',
            'un_seen_messages_count',
            'assign_user_name',
            'assign_lead_user_name',
            'match_assign_user_name',
            'match_assign_lead_user_name',
            'verification_status',
            'age',
            'gender_name'
        ]);

        $messages = CustomerChatting::select('id','sender_id','receiver_id','message','message_status','created_at')->where([
            ['sender_id','=',$receiverId],
            ['receiver_id','=',$authUserId]
        ])->orWhere([
            ['receiver_id','=',$receiverId],
            ['sender_id','=',$authUserId]
        ])->get();

        $messages->makeHidden([
            'faker_id'
        ]);

        return response()->json([
            'success'  => true,
            'message' => 'Messages has been fetched successfully.',
            'data'    => [
                'messages' => $messages,
                'receiver' => $receiverRow
            ]
        ], 200);
    }

    public function sendMessage() {
        $request = request()->all();
        $receiverId = $request['receiver_id'];
        $sender_id = auth()->id();
        $limitResponse = checkMessageLimit($sender_id,false,$receiverId);
        if (!empty($limitResponse)) {
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

            $request['message_status'] = 1;
            $messageSuccess = CustomerChatting::create($request);
            if (!empty($messageSuccess)) {
                $senderRow = Customer::findOrFail($sender_id);
                $request['receiver_name'] = $senderRow->full_name;
                $request['receiver_image'] = $senderRow->imageFullPath;

                /* For web notifications */
                fireDoctorMessage($request);

                $messageSuccess->makeHidden([
                    'faker_id',
                    'updated_at'
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Message has been sent successfully.',
                    'data'    => $messageSuccess,
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Message has not been sent.',
                    'errors'  => []
                ], 200);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Your messages limit has been completed, please upgrade your package.',
                'errors'  => []
            ], 200);
        }
    }

}
