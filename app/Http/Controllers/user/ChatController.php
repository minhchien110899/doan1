<?php

namespace App\Http\Controllers\user;

use App\Events\NewMessageEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Message;
use App\User;
class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth:web");
    }
    public function index(){
        return view('user.chat.chat_message');
    }

    public function getContacts(){
        $contacts = User::where('id','!=', Auth()->user()->id)->get();
        return response()->json($contacts);
    }

    public function getConversation($id){
        $conversation = Message::whereIn('from',[$id, Auth()->user()->id])->whereIn('to',[$id, Auth()->user()->id])->get();
        return response()->json($conversation); 
    }

    public function send(Request $request){
        $message = Message::create([
            'from' => Auth()->id(),
            'to' => $request->contact_id,
            'text' => $request->text
        ]);
        broadcast(new NewMessageEvent($message));
        return response()->json($message);
    }
}
