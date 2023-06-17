<?php

namespace Modules\Ewp\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Ewp\Entities\{Reports, Schedules, Answers, Assign, Lookups, Chat};
use Modules\Site\Entities\{Profile, User};
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{

    public function chat($receiver_id)
    {
        $authen = auth()->user();

        if($authen->hasRole([5])){
            // Retrieve the authenticated user
            $sender_id = auth()->id();

            // Find the existing chat session between the sender and receiver
            $chat = Chat::where('receiver_userid', $sender_id)
                ->where('sender_userid', $receiver_id)
                ->where('status', null)
                ->first();
        }else{
            // Retrieve the authenticated user
            $sender_id = auth()->id();

            // Find the existing chat session between the sender and receiver
            $chat = Chat::where('sender_userid', $sender_id)
                ->where('receiver_userid', $receiver_id)
                ->where('status', null)
                ->first();

            // If no existing chat session, create a new one
            if (!$chat) {
                $chat = new Chat();
                $chat->sender_userid = $sender_id;
                $chat->receiver_userid = $receiver_id;
                $chat->chat = null;
                $chat->status = null;
                $chat->save();
            }
        }

        return redirect()->route('auth', ['receiver_id' => $receiver_id]);
    }

    public function auth($receiver_id){

        $authen = auth()->user();

        if ($authen->hasRole([5])) {
            // Retrieve the authenticated user
            $sender_id = auth()->id();

            // Find the existing chat session between the sender and receiver
            $chat = Chat::where('receiver_userid', $sender_id)
                ->where('sender_userid', $receiver_id)
                ->where('status', null)
                ->first();
        } else {
            // Retrieve the authenticated user
            $sender_id = auth()->id();

            // Find the existing chat session between the sender and receiver
            $chat = Chat::where('sender_userid', $sender_id)
                ->where('receiver_userid', $receiver_id)
                ->where('status', null)
                ->first();
        }

        return redirect()->route('conversation', ['uuid' => $chat->uuid]);
    }

    public function conversation($uuid)
    {
        $authen = auth()->user();

        $chat = Chat::where('uuid', $uuid)->where('status', null)->first();

        if(!$chat){
            return redirect()->route('ewp.dashboards.index')->with('toast_success', 'Chat Session Ended');
        }

        if ($authen->hasRole([5])) {
            // Retrieve the authenticated user
            $sender_id = auth()->id();

            $receiver_id = $chat->sender_userid;

            // Find the receiver user
            $receiver = User::findOrFail($receiver_id);

            $status = $chat->chat;
            foreach ($status as $key => $chatData) {
                if (strpos($key, 'sender') === 0) {
                    $status[$key]['status'] = 'read';
                }
            }

            // Update the chat session in the database
            $chat->chat = $status;
            $chat->save();

            // Retrieve the conversations from the chat session
            $conversations = $chat->chat;
            $uuid = $chat->uuid;
        } else {
            // Retrieve the authenticated user
            $sender_id = auth()->id();

            $receiver_id = $chat->receiver_userid;

            // Find the receiver user
            $receiver = User::findOrFail($receiver_id);

            $status = $chat->chat;
            if($status != null){
                foreach ($status as $key => $chatData) {
                    if (strpos($key, 'receiver') === 0) {
                        $status[$key]['status'] = 'read';
                    }
                }

                // Update the chat session in the database
                $chat->chat = $status;
                $chat->save();
            }

            // Retrieve the conversations from the chat session
            $conversations = $chat->chat;
            $uuid = $chat->uuid;
        }

        return view('ewp::chat.index', compact('receiver', 'receiver_id', 'conversations', 'uuid'));
    }

    public function send(Request $request, $uuid)
    {
        $authen = auth()->user();

        $chat = Chat::where('uuid', $uuid)->where('status', null)->first();

        if ($authen->hasRole([5])) {

            // Retrieve the chat data as an array
            $chatData = $chat->chat;

            // Determine the number of existing senders
            $senderCount = count($chatData);

            // Increment the sender value by one
            $sender = 'receiver' . ($senderCount + 1);

            $message = [
                'message' => $request->message,
                'timestamp' => now()->format('H:i'),
                'status' => null,
            ];

            // Add the new message under the incremented sender
            $chatData[$sender] = $message;

            // Update the chat data in the model
            $chat->chat = $chatData;
            $chat->save();
        }else{

            // Retrieve the chat data as an array
            $chatData = $chat->chat;

            if($chatData == null){
                // Increment the sender value by one
                $sender = 'sender' . (1);
            }else{
                // Determine the number of existing senders
                $senderCount = count($chatData);

                // Increment the sender value by one
                $sender = 'sender' . ($senderCount + 1);
            }

            $message = [
                'message' => $request->message,
                'timestamp' => now()->format('H:i'),
                'status' => null,
            ];

            // Add the new message under the incremented sender
            $chatData[$sender] = $message;

            // Update the chat data in the model
            $chat->chat = $chatData;
            $chat->save();
        }

        return redirect()->route('conversation', ['uuid' => $uuid])->with('toast_success', 'Message sent successfully');
    }

    public function update($uuid)
    {

        $chat = Chat::where('uuid', $uuid)->first();
        
        $session = 'Ended';

        $chat->status = $session;
        $chat->save();

        return redirect()->route('ewp.dashboards.index')->with('toast_success', 'Chat Session Ended');
    }

}

?>