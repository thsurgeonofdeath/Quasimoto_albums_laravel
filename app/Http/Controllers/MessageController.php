<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class MessageController extends Controller
{
     //contact admin
     public function contactAdmin(){
        return view('users.contact');
      }

      // Store message in database
      public function storeMessage(Request $request, User $user){

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
}
