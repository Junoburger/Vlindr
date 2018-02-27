<?php
namespace App\Traits;

use App\Matches;

trait Matchable {

	public function like_user($liked_id)
	{	
		if($this->id === $liked_id)
		{
			return 0;
		}
		if($this->matches_with($liked_id) === 1)
		{
			return "Jullie zijn al een match!";
		}
		if($this->has_pending_like_request_sent_to($liked_id) === 1)
		{
			return "U vind deze persoon al leuk.";
		}
		if($this->has_pending_like_request_from($liked_id) === 1)
		{
			return $this->like_user($liked_id);
		}
		$match = Matches::create([
			'liker_id' => $this->id,
			'liked_id' => $liked_id
		]);
		if($match)
		{
			return 1;
		}
		return 0;          
	} 
public function mutual_like($liker_id)
	{
		if($this->has_pending_like_request_from($liker_id) === 0)
		{
			return 0;
		}
		$match = Matches::where('liker_id', $liker_id)
						->where('liked_id', $this->id)
						->first();
		if($match)
		{
			$match->update([
				'match_status' => 1
			]);
			return 1;
		}
		return 0;
	} 

	public function matches()
	{	
		$matches = array();
		
		$m1 = Matches::where('match_status', 1)
					->where('liker_id', $this->id)
					->get();
		foreach($m1 as $match):
			array_push($matches, \App\User::find($match->liked_id));
		endforeach;
		$matches2 = array();
		
		$m2 = Matches::where('match_status', 1)
					->where('liked_id', $this->id)
					->get();
		foreach($m2 as $match):
			array_push($matches2, \App\User::find($match->liker_id));
		endforeach;
		return array_merge($matches, $matches2);
		
	}

	public function pending_like_requests()
	{
		$users = array();
		
		$matches = Matches::where('match_status', 0)
					->where('liked_id', $this->id)
					->get();
		foreach($matches as $match):
			array_push($users, \App\User::find($match->liker_id));
		endforeach;
		
		return $users;
	}

		public function matches_ids()
	{
		return collect($this->matches())->pluck('id')->toArray();
	}

public function matches_with($user_id)
	{
		if(in_array($user_id, $this->matches_ids()))
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}

public function pending_like_requests_ids()
	{
		return collect($this->pending_like_requests())->pluck('id')->toArray();
	}

		public function pending_like_requests_sent()
	{
		$users = array();
		$matches = Matches::where('match_status', 0)
						->where('liker_id', $this->id)
						->get();
		foreach($matches as $match):
			array_push($users, \App\User::find($match->liked_id));
		endforeach;
		return $users;
	}


public function pending_like_requests_sent_ids()
	{
		return collect($this->pending_like_requests_sent())->pluck('id')->toArray();
	}

public function has_pending_like_request_from($user_id)
	{
		if(in_array($user_id, $this->pending_like_requests_ids()))
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
public function has_pending_like_request_sent_to($user_id)
	{
		if(in_array($user_id, $this->pending_like_requests_sent_ids()))
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}



}