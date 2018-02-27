<?php
namespace App\Traits;

use App\Friendships;

trait Friendable {

	public function add_friend($recipient_id)
	{	
		if($this->id === $recipient_id)
		{
			return 0;
		}
		if($this->is_friends_with($recipient_id) === 1)
		{
			return "Jullie zijn al vrienden";
		}
		if($this->has_pending_friend_request_sent_to($recipient_id) === 1)
		{
			return "Verzoek is al verstuurd";
		}
		if($this->has_pending_friend_request_from($recipient_id) === 1)
		{
			return $this->accept_friend($recipient_id);
		}
		$Friendship = Friendships::create([
			'sender_id' => $this->id,
			'recipient_id' => $recipient_id
		]);
		if($Friendship)
		{
			return 1;
		}
		return 0;          
	} 
	public function accept_friend($sender_id)
	{
		if($this->has_pending_friend_request_from($sender_id) === 0)
		{
			return 0;
		}
		$friendship = Friendships::where('sender_id', $sender_id)
						->where('recipient_id', $this->id)
						->first();
		if($friendship)
		{
			$friendship->update([
				'status' => 1
			]);
			return 1;
		}
		return 0;
	} 
	public function friends()
	{	
		$friends = array();
		
		$f1 = Friendships::where('status', 1)
					->where('sender_id', $this->id)
					->get();
		foreach($f1 as $friendship):
			array_push($friends, \App\User::find($friendship->recipient_id));
		endforeach;
		$friends2 = array();
		
		$f2 = Friendships::where('status', 1)
					->where('recipient_id', $this->id)
					->get();
		foreach($f2 as $friendship):
			array_push($friends2, \App\User::find($friendship->sender_id));
		endforeach;
		return array_merge($friends, $friends2);
		
	}
	public function pending_friend_requests()
	{
		$users = array();
		
		$friendships = Friendships::where('status', 0)
					->where('recipient_id', $this->id)
					->get();
		foreach($friendships as $friendship):
			array_push($users, \App\User::find($friendship->sender_id));
		endforeach;
		
		return $users;
	}
	public function friends_ids()
	{
		return collect($this->friends())->pluck('id')->toArray();
	}
	public function is_friends_with($user_id)
	{
		if(in_array($user_id, $this->friends_ids()))
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
	public function pending_friend_requests_ids()
	{
		return collect($this->pending_friend_requests())->pluck('id')->toArray();
	}
	public function pending_friend_requests_sent()
	{
		$users = array();
		$friendships = Friendships::where('status', 0)
						->where('sender_id', $this->id)
						->get();
		foreach($friendships as $friendship):
			array_push($users, \App\User::find($friendship->recipient_id));
		endforeach;
		return $users;
	}
	public function pending_friend_requests_sent_ids()
	{
		return collect($this->pending_friend_requests_sent())->pluck('id')->toArray();
	}
	public function has_pending_friend_request_from($user_id)
	{
		if(in_array($user_id, $this->pending_friend_requests_ids()))
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
	public function has_pending_friend_request_sent_to($user_id)
	{
		if(in_array($user_id, $this->pending_friend_requests_sent_ids()))
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}


}