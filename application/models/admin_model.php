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
	get the satst sfor the person 
	*/	
	function get_stats()
	{
		$this->db->order_by('id', 'desc');
		$query = $this->db->get('admin_stats', 5);
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
	
	/*
		This function gets all the packs
	*/
	function get_all_packs()
	{
		$query = $this->db->get('packs');
		$data = array();
		foreach($query->result() as $r)
		{
			$data[] = $r;
		}
		return $data;
	}
	
	/*
		Counts all the active support ticket
	*/
	function count_active_tickets()
	{
		return $this->db->get_where('tickets', array('status' => 1))->num_rows();
	}
	/*
		Gets all the active tickets
	*/
	function get_active_tickets()
	{
		$this->db->order_by('last_update_time', 'desc');
		$query = $this->db->get_where('tickets', array('status' => 1));
		
		$data = array();
		
		foreach($query->result() as $r)
		{
			$data[] = $r;
		}
		return $data;
	}
	/*
		Gets the username for a particular ID
	*/
	function get_username_by_id($id)
	{
		$query = $this->db->get_where('users', array('id' => $id));
		
		$data = array();
		
		foreach($query->result() as $r)
		{
			$data[] = $r;
		}
		return $data[0]->username;
	}
	function get_ticket_by_id()
	{
		$query = $this->db->get_where('tickets', array('id' => $this->uri->segment(4)));
		
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
		Adds reply to the ticket from admin area
	*/
	function add_reply_to_ticket()
	{
		//Set the data for the replying to the ticket
		$data = array(
			'body'		=> $this->input->post('ticket_reply'),
			'timestamp'	=> date('Y-m-d H:i:s', time()),
			'ticket_id'	=> $this->uri->segment(4),
			'user_id'	=> 0,
			'admin_id'	=> $this->session->userdata('id'),
		);
		$this->db->set($data);
		$this->db->insert('ticket_replies', $data);	
		
		//Now update the time in the other table
		$data = array(
			'last_update_time' => date('Y-m-d H:i:s', time()),
			'status'		=> 1,
		);
		
		$this->db->update('tickets', $data);
	}
}