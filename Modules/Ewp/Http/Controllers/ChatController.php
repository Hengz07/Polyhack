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
    public function index()
    {
        $user = User::role([5])->get();

        $mainuser = Auth::user();
        $mainuserId = $mainuser->id; // Extract the user ID

        $conversations = Chat::where('sender_userid', $mainuserId)->get();

        return view('ewp::chat.index', compact('user', 'conversations'));
    }


    // public function sendMessage(Request $request)
    // {
    //     $user = Auth::user();
    //     $chat = new Chat();
    //     $chat->sender_userid = $user->id;
    //     $chat->receiver_userid = $request->input('receiver_userid');
    //     $chat->chat = json_encode(['message' => $request->input('message'), 'sender' => $user->id]);
    //     $chat->save();

    //     return redirect()->back();
    // }

    // public function getConversation(Request $request)
    // {
    //     $user = Auth::user();
    //     $receiver_userid = $request->input('receiver_userid');
    //     $conversations = Chat::where(function ($query) use ($user, $receiver_userid) {
    //         $query->where('sender_userid', $user->id)
    //             ->where('receiver_userid', $receiver_userid);
    //     })->orWhere(function ($query) use ($user, $receiver_userid) {
    //         $query->where('sender_userid', $receiver_userid)
    //             ->where('receiver_userid', $user->id);
    //     })->orderBy('created_at', 'asc')
    //     ->get();

    //     return response()->json($conversations);
    // }
}

?>