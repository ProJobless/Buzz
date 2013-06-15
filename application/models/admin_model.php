<?php

class Admin_model extends CI_Model
{
	/*
		This function logs in a user
		If the username and password is matched, it returns success. else it returns false.
	*/
	function login()
	{
		//get the username
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));
		
		$query = $this->db->get_where('administrators', array('username' => $username, 'password' => $password));
		
		if($query->num_rows == 1)
		{
			//If we find a record in db we will loop over the data
			foreach($query->result() as $q)
			{
				//Now we'll set the cookies
				$data = array(
					'id' => $q->id,
					'username' => $q->username,
					'logged_in' => 1,
				);
				$this->session->set_userdata($data);
			}
			return 1;
		}
		return 0;
	}
	/*
		Gets the list of users depending upon the pagination
	*/
	function get_users($per_page)
	{
		$query = $this->db->get('users', $per_page , $this->uri->segment(4));
		$data = array();
		
		foreach($query->result() as $q)
		{
			$data[] = $q;
		}
		return $data;
	}	
	/*
		Bans the users
	*/
	function ban_user()
	{
		$data = array(
			'banned' => 1
		);
		
		$this->db->where('id', $this->uri->segment(4));
		$this->db->update('users', $data);
	}	
	/*
		Un ban the user
	*/
	function unban_user()
	{
		$data = array(
			'banned' => 0
		);
		
		$this->db->where('id', $this->uri->segment(4));
		$this->db->update('users', $data);
		return 1;
	}
}