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
}