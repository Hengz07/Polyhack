<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Traits\HomeTrait;
use App\Mail\MailMeetingCancellation;
use Illuminate\Support\Facades\Mail;
use Spatie\GoogleCalendar\Event;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (!auth()->guest()) {
            
            return view('home');
        }
        return view('welcome');
    } ## END function index()
} ## END class HomeController
