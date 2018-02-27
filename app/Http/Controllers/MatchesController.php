<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Profile;
use Illuminate\Support\Facades\Event;
use App\User;
use App\Matches;

use DB;


class MatchesController extends Controller
{




 public function check($id){

                    if (Auth::user()->matches_with($id) === 1)


                    {
                        return [ "status" => "match" ];
                    }


                    if(Auth::user()->has_pending_like_request_from($id))

                        {
                    return [ "status" => "pending" ];

                            }


                            if(Auth::user()->has_pending_like_request_sent_to($id))

                        {
                    return [ "status" => "waiting" ];

                            }
           return [ "status" => 0 ];
    }





      public function like_user($id)
    {

        //notify users
        return Auth::user()->like_user($id);

    }
    public function mutual_like($id)
    {
        //sending nots
       return Auth::user()->mutual_like($id);


    }

    public function matches() {
        $uid = Auth::user()->id;
        $match1 = DB::table('matches')
                ->leftJoin('users', 'users.id', 'matches.liked_id') // who is not loggedin but send request to
                ->where('match_status', 1)
                ->where('liker_id', $uid) // who is loggedin
                ->get();
        //dd($friends1);
        $match2 = DB::table('matches')
                ->leftJoin('users', 'users.id', 'matches.liker_id')
                ->where('match_status', 1)
                ->where('liked_id', $uid)
                ->get();
        $matches = array_merge($match1->toArray(), $match2->toArray());
        return view('matches', compact('matches'));
    }






}
