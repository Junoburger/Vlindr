<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;
use DB;
use App\Profile;



class MessagesController extends Controller
{




 public function index()
 {

return view('messages');

}


public  function sendMessage(Request $request){
    $conID = $request->conID;
    $message = $request->message;
    $checkUserId = DB::table('messages')->where('conversation_id', $conID)->get();
    if($checkUserId[0]->user_sender== Auth::user()->id){
      // fetch user_to
      $fetch_userReceiver = DB::table('messages')->where('conversation_id', $conID)
      ->get();
        $userReceiver = $fetch_userReceiver[0]->user_receiver;
    }else{
    // fetch user_to
    $fetch_userReceiver = DB::table('messages')->where('conversation_id', $conID)
    ->get();
      $userReceiver = $fetch_userReceiver[0]->user_receiver;
    }
    // now send message
           $sendM = DB::table('messages')->insert([
             'user_receiver' => $userReceiver,
             'user_sender' => Auth::user()->id,
             'message' => $message,
             'status' => 1,
             'conversation_id' => $conID
           ]);
           if($sendM){
             $userMessage = DB::table('messages')
             ->join('users', 'users.id','messages.user_sender')
             ->where('messages.conversation_id', $conID)->get();
             return $userMessage;
           }
       }



       public function newMessage(){
 $uid = Auth::user()->id;
 $friends1 = DB::table('friendships')
         ->leftJoin('users', 'users.id', 'friendships.recipient_id') // who is not loggedin but send request to
         ->where('status', 1)
         ->where('sender_id', $uid) // who is loggedin
         ->get();
 $friends2 = DB::table('friendships')
         ->leftJoin('users', 'users.id', 'friendships.sender_id')
         ->where('status', 1)
         ->where('recipient_id', $uid)
         ->get();
 $friends = array_merge($friends1->toArray(), $friends2->toArray());
 return view('newMessage', compact('friends', $friends));
}
public function sendNewMessage(Request $request){
  $message = $request->message;
  $friend_id = $request->friend_id;

  $myID = Auth::user()->id;

  //check conversation already started
  $checkCon1 = DB::table('conversations')->where('user_a', $myID)->where('user_b', $friend_id)->get();// if logged in user started the conversation

  $checkCon2 = DB::table('conversations')->where('user_b', $myID)->where('user_a', $friend_id)->get(); // if loggend in user received the message first

$allCons = array_merge($checkCon1->toArray(), $checkCon2->toArray());

if(count($allCons)!=0){
  // older conversation
  $conID_old = $allCons[0]->id;
  // insert data into messages table
  $MessageSent = DB::table('messages')->insert([

    'user_sender' => $myID,
    'user_receiver' => $friend_id,
    'message' => $message,
    'conversation_id' => $conID_old,
    'status' => 1
  ]);


}else{
  // new conversation
$conID_new = DB::table('conversations')->insertGetId([
  'user_a' => $myID,
  'user_b' => $friend_id
]);
echo $conID_new;


  $MessageSent = DB::table('messages')->insert([

    'user_sender' => $myID,
    'user_receiver' => $friend_id,
    'message' => $message,
    'conversation_id' => $conID_new,
    'status' => 1
  ]);


}
}


}
