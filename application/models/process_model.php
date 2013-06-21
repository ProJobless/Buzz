<?php 

class Process_model extends CI_Model
{
	/*
		This function creates a new twitter auth
		@param : response array from twitter
		[oauth_token]
		[oauth_token_secret]
		[user_id]
		[screen_name]
	*/
	function add_twitter($response)
	{
		//First we check if the user already exists
		$query = $this->db->get_where('twitter_accounts', array('twitter_u_id' => $response['user_id']));
		
		if($query->num_rows() == 0)
		{
			//No match found
			//We will create a new record in the table
			$data = array(
				'user_id'		=> $this->session->userdata('user_id'),
				'twitter_u_id'	=> $response['user_id'],
				'twitter_screen_name'	=> $response['screen_name'],
				'oauth_token'	=> $response['oauth_token'],
				'oauth_secret'	=> $response['oauth_token_secret'],
				'enabled'	=> 1,
			);
			$this->db->set($data);
			$this->db->insert('twitter_accounts', $data);
		}
		else
		{
			//We found a match
			//Now we will check if the user is the same as who requested the oAuth earlier or is a new user.
			$query = $this->db->get_where('twitter_accounts', array('user_id' => $this->session->userdata('user_id'), 'twitter_u_id' => $response['user_id']));
			if($query->num_rows() > 0)
			{
				//We have people already who have already registered with the same twitter account
				
				//We will in this case, email other users on Hypeninja that there has been another person accessing their twitter account
				
				//We will change the twitter token and secret for all the users with the same user id
				$data = array(
					'oauth_token'	=> $response['oauth_token'],
					'oauth_secret'	=> $response['oauth_secret']
				);
				$this->db->where('twitter_u_id', $response['user_id']);
				$this->db->update('twitter_accounts', $data);
			} // No need for else as we already updated the tokens
		}
	}
	/*
		fetches the latest new from the news table
	*/
	function get_news()
	{
		$this->db->order_by("timestamp", "desc");
		$query = $this->db->get('news');
		$data = array();
		foreach($query->result() as $r)
		{
			$data[] = $r;
		}
		return $data;
	}
	/*
		gets the tweets count for the user who has signed in
	*/
	function get_tweets_count()
	{
		$user_id = $this->session->userdata('user_id');
		$query = $this->db->get_where('users', array('id' => $user_id));
		$t;
		foreach($query->result() as $q)
		{
			$t = $q->tweet_count;
		}
		return $t;
	}
	/*
		Function to get the support tickets.
	*/
	function get_support_tickets()
	{
		$query = $this->db->get_where('tickets', array('user_id' => $this->session->userdata('user_id')));
		
		$data = array();
		
		foreach($query->result() as $r)
		{
			$data[] = $r;
		}
		return $data;	
	}
	/*
		This deletes the tiket which is active and has a status of 0
	*/
	function close_ticket()
	{
		$data = array(
			'status'	=> 0,
		);
		//Setting the where clause to match user_id, active ticket
		$where = array(
			'user_id'	=> $this->session->userdata('user_id'),
			'status'	=> 1,
			'id'		=> $this->uri->segment(4),
		);
		$this->db->where($where);
		$this->db->update('tickets', $data);
	}
	/*
		Gets the ticket by ID to get rendered on the twitter thing
	*/
	function get_ticket_by_id()
	{
		$query = $this->db->get_where('tickets', array('user_id' => $this->session->userdata('user_id'), 'id' => $this->uri->segment(4)));
		
		$data = array();
		
		foreach($query->result() as $r)
		{
			$data['ticket'] = $r; 
		}
		$data['chat'] = $this->get_ticket_replies_by_id($data['ticket']->id);
		
		//Sort and find the unique admin, so we are passing as less info as possible
		$admins = array();
		foreach($data['chat'] as $d)
		{
			if($d->admin_id != 0)
			{
				$admins[] = $d->admin_id;
			}
		}
		
		$data['admins'] = $this->get_admin_by_id(array_unique($admins));
		
		//Now finally get the user details before we dispatch
		$data['user'] = $this->get_user_details_by_id($data['ticket']->user_id);

		return $data;	
	}
	/*
		Gets the details for a specified user
	*/
	function get_user_details_by_id($user_id)
	{
		$query = $this->db->get_where('users', array('id' => $user_id));
		
		$data = array();
		
		foreach($query->result() as $r)
		{
			$data[] = $r; 
		}
		return $data;
	}
	/*
		Gets all the replies to a ticket 
	*/
	function get_ticket_replies_by_id($id)
	{
		$this->db->order_by('timestamp', 'asc');
		$query = $this->db->get_where('ticket_replies', array('ticket_id' => $id));
		
		$data = array();
		
		foreach($query->result() as $r)
		{
			$data[] = $r; 
		}
		return $data;
	}
	/*
		This function gets the admin data for a particular admin
	*/
	function get_admin_by_id($i)
	{
		$data = array();
		foreach($i as $id)
		{
			$query = $this->db->get_where('administrators', array('id' => $id));
		
			foreach($query->result() as $r)
			{
				$data[$r->id] = $r; 
			}
		}
		return $data;
	}
	
	/*
		This function ads the reply to the ticket
	*/
	function add_reply_to_ticket()
	{
		//First the most IMPORTANT STEP to check the ticket id and user_id match
		$query = $this->db->get_where('tickets', array('id' => $this->uri->segment(4), 'user_id' => $this->session->userdata('user_id')));
		
		if($query->num_rows() == 1)
		{
			$data = array(
				'body'		=> $this->input->post('ticket_reply'),
				'timestamp'	=> date('Y-m-d H:i:s', time()),
				'ticket_id'	=> $this->uri->segment(4),
				'user_id'	=> $this->session->userdata('user_id'),
				'admin_id'	=> 0,
			);
			$this->db->set($data);
			$this->db->insert('ticket_replies', $data);	
			
			//Now update the time in the other table
			$data = array(
				'last_update_time' => date('Y-m-d H:i:s', time()),
				'status'		=> 1,
			);
			$this->db->where('id', $this->uri->segment(4));
			$this->db->update('tickets', $data);
		}		
	}
	/*
		Creates a new ticket
	*/
	function create_ticket()
	{
		$data = array(
			'subject'		=> $this->input->post('subject'),
			'body'			=> $this->input->post('ticket_message'),
			'create_time'	=> date('Y-m-d H:i:s', time()),
			'last_update_time' => date('Y-m-d H:i:s', time()),
			'status'		=> 1,
			'user_id'		=> $this->session->userdata('user_id'),
		);
		$this->db->set($data);
		$this->db->insert('tickets', $data);
	}
	/*
		Gets the history for a particular user
	*/
	function get_twitter_history($per_page)
	{
		$this->db->where(array('user_id' => $this->session->userdata('user_id'), 'campaign_id' => $this->uri->segment(4)));
		$this->db->order_by('id', 'desc');
		$query = $this->db->get('twitter_replies', $per_page , $this->uri->segment(5));
		$data = array();
		
		foreach($query->result() as $q)
		{
			$data[] = $q;
		}
		return $data;
	}
	/*
		Fixes the time for support tickets
	*/
	function fix_time($timestamp)
	{
		$time_now = time();
		$time_diff = $time_now - $timestamp;
		
		//Check if the time is just in seconds
		if($time_diff < 60)
		{
			return $time_diff.' seconds ago';
		}
		else if($time_diff < 3600)
		{
			return ceil($time_diff/60)." minutes ago";
		}
		else if($time_diff < 86400)
		{
			return ceil($time_diff/3600)." hours ago";
		}
		else if($time_diff < 432000)
		{
			return ceil($time_diff/86400)." days ago";
		}
		else
		{
			return date('M j, Y H:i:s', $timestamp);
		}
	}
}