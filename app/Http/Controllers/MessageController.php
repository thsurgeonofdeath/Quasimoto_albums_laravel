<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Review;
use App\Models\User;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class MessageController extends Controller
{
     //contact admin
     public function contactAdmin(){
        return view('users.contact');
      }

      // Store message in database
      public function storeMessage(Request $request, User $user){


        $messageLength = Str::length($request->message);
        if($messageLength > 150){
          return back()->with('message','Operation failed, Message Too Long!!!');
        }

        $formFields = $request->validate([
            'message'         =>  'required'
        ]);
        $formFields['user_id'] = $user->id;

        Message::create($formFields);

        return redirect('/')->with('message','Your message was sent successfully!');
      }

      public function inbox(){
        $messages = DB::table('messages')->get();
        return view('users.inbox',[
          'messages'  =>  $messages,
        ]);
      }

      public function deleteMessage(Message $message){
        $message->delete();
        return redirect()->back();
      }
}
