<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Profile;
use Illuminate\Support\Facades\Event;
use App\User;
use App\Friendships; 
use DB;
use App\notifications;



class GardenController extends Controller
{


public function check($id)
    {
        if(Auth::user()->is_friends_with($id) === 1)
        {
            return [ "status" => "friends" ];
        }
        
        if(Auth::user()->has_pending_friend_request_from($id))
        {
            return [ "status" => "pending" ];
        }
        if(Auth::user()->has_pending_friend_request_sent_to($id))
        {
            return [ "status" => "waiting" ];
        }
        return [ "status" => 0 ];
    }

    public function add_friend($id)
    {

        //notify users
        return Auth::user()->add_friend($id);

    }
    public function accept_friend($id)
    {
        //sending nots
       return Auth::user()->accept_friend($id);
   
        
    }


        public function requests() {
        $uid = Auth::user()->id;
        $FriendRequests = DB::table('friendships')
                        ->rightJoin('users', 'users.id', '=', 'friendships.sender_id')
                        ->where('status', '=', '0')
                        ->where('friendships.recipient_id', '=', $uid)->get();
        return view('/requests', compact('FriendRequests'));
    }


    public function accept($name, $id) {
        $uid = Auth::user()->id;
        $checkRequest = friendships::where('sender_id', $id)
                ->where('recipient_id', $uid)
                ->first();
        if ($checkRequest) {
            // echo "yes, update here";
            $updateFriendship = DB::table('friendships')
                    ->where('recipient_id', $uid)
                    ->where('sender_id', $id)
                    ->update(['status' => 1]);
            $notifications = new notifications;
            $notifications->note = 'heeft uw verzoek geaccepteerd';
            $notifications->user_hero = $id; // who is accepting my request
            $notifications->user_logged = Auth::user()->id; // me
            $notifications->status = '1'; // unread notifications
            $notifications->save();
            if ($notifications) {
                return back()->with('msg', 'U bent nu bevriend met ' . $name);
            }
        } else {
            return back()->with('msg', 'U ben nu bevriend');
        }
    }



    public function notifications($id) {
         $uid = Auth::user()->id;
        $notes = DB::table('notifications')
                ->leftJoin('users', 'users.id', 'notifications.user_logged')
                ->where('notifications.id', $id)
                ->where('user_hero', $uid)
                ->orderBy('notifications.created_at', 'desc')
                ->get();
        $updateNoti = DB::table('notifications')
                     ->where('notifications.id', $id)
                    ->update(['status' => 0]);
       return view('notifications', compact('notes'));
    }



        public function requestRemove($id) {
        DB::table('friendships')
                ->where('recipient_id', Auth::user()->id)
                ->where('sender_id', $id)
                ->delete();
        return back()->with('msg', 'Verzoek is verwijderd');
    }




    

    public function friends() {
        $uid = Auth::user()->id;
        $friends1 = DB::table('friendships')
                ->leftJoin('users', 'users.id', 'friendships.recipient_id') // who is not loggedin but send request to
                ->where('status', 1)
                ->where('sender_id', $uid) // who is loggedin
                ->get();
        //dd($friends1);
        $friends2 = DB::table('friendships')
                ->leftJoin('users', 'users.id', 'friendships.sender_id')
                ->where('status', 1)
                ->where('recipient_id', $uid)
                ->get();
        $friends = array_merge($friends1->toArray(), $friends2->toArray());
        return view('friends', compact('friends'));
    }

  

public function viewProfile($userId = null) {
        $user = null;

        if($userId != null) {
            $user = User::find($userId);
        } else {
            $user = User::find(Auth::user()->id);
        }

        return view('/profiles/profile', [
            'user' => $user
        ]);
    }


public function member(){


$users = User::orderBy('User', 'desc')->where('id', '!=', Auth::id())->paginate(20);


return view('pages.garden', compact('users'));
    }



    

}
