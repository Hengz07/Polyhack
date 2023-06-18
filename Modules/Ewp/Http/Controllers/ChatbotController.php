<?php

namespace Modules\Ewp\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Ewp\Entities\{Reports, Schedules, Answers, Assign, Lookups, Chat};
use Modules\Site\Entities\{Profile, User};
use Illuminate\Support\Facades\DB;

class ChatbotController extends Controller
{
    public function chat()
    {
        return view('ewp::chat.chatbot');
    }
}

?>