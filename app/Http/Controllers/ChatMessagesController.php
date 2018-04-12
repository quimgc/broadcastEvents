<?php

namespace App\Http\Controllers;

use App\Events\ChatMessage;
use Illuminate\Http\Request;

class ChatMessagesController extends Controller
{
    public function store(Request $request)
    {
        event(new ChatMessage($request->body));
    }
}
