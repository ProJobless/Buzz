<?php
	
class Email_model extends CI_Model
{
	/*
		Process the Variables used in email
	
		Variables Allowed List
		1. 	{$username} 			= Username of the user
		2. 	{$email}				= Email of the user
		3. 	{$first_name}			= First name of user
		4. 	{$last_name}			= Last name of the user
		5. 	{$plan_id} 				= Plan ID
		6. 	{$company}				= Company of the user
		7. 	{$invoice_id}			= Invoice ID
		8. 	{$ticket_id} 			= Ticket ID
		9.  {$ticket_body}			= Body of the opened ticket
		10. {$ticket_reply_id} 		= Reply ID
		11. {$ticket_reply}			= Reply to the ticket by Admin
		12. 
	*/
	function process_email_variables($body, $var)
	{
		preg_match_all('/{\$([^}]*)}/', $body, $q);
		
		//Filter duplicated items in the array
		$q = array_unique($q[1]);
		$user_details = array();$ticket_details = array();$ticket_reply_details = array();$plan_details = array();
		//Loop through the vars provided and get the related data
		foreach($var as $k=>$v)
		{
			switch($k)
			{
				case "user_id":
				$user_details = $this->get_user_details_by_id($v);
				break;
				
				case "ticket_id":
				$ticket_details = $this->get_ticket_details_by_id($v);
				break;
				
				case "ticket_reply_id":
				$ticket_reply_details = $this->get_reply_details_by_id($v);
				break;
				
				case 'plan_id':
				$plan_details = $this->get_plan_by_id($v);
				break;
			}
		}
		
		foreach($q as $r)
		{
			switch($r)
			{
				case 'username':
				$this->replace_var($user_details->username, 'username');
				break;
				
				case 'email':
				$this->replace_var($user_details->email, 'email');
				break;
				
				case "first_name":
				$this->replace_var($user_details->first_name, 'first_name');
				break;
				
				case "last_name":
				$this->replace_var($user_details->last_name, 'last_name');
				break;
				
				case "plan_id":
					//Get the plan Details
					$this->get_plan_by_id($var['plan_id']);
				
				case "company":
				$this->replace_var($user_details->company, 'company');
				break;
				
				case "invoice_id":
				
				case "ticket_id":
				
				case "ticket_reply_id":
				
			}
		}
	}
	
	/*
		Gets the User deatils by ID
		@params : $userid => User ID of the user whose details are needed to be scrapped
	*/
	function get_user_details_by_id($user_id)
	{
		//Make sure that the ID is an integer
		$user_id = intval($user_id);
		$query = $this->db->get_where('users', array('id' => $user_id));
		return $this->parse_db_into_array($query->result());
	}
	
	/*
		Gets the ticket details by ID
		@params :
			$ticket_id 	: ID of the ticket whose details needs to be extracted
			$user_id 	: User id of the person related to the ticket
	*/
	function get_ticket_details_by_id($ticket_id)
	{
		$ticket_id = intval($ticket_id);
		$query = $this->db->get_where('tickets', array('id' => $ticket_id);
		return $this->parse_db_from_array($query->result());
	}
	
	/*
		Gets the reply details by ID
		@params:
			$reply_id => The id of reply whose details need to be extracted
	*/
	function get_reply_details_by_id($reply_id)
	{
		$reply_id = intval($reply_id);
		$query = $this->db->get_where('ticket_replies', array('id' => $reply_id));
		return $this->parse_db_into_array($query->result());
	}
	
	/*
		Gets the plaan details by ID
		@params:
			$plan_id : ID of the plan
	*/	
	function get_plan_by_id($plan_id)
	{
		
	}
	/*
		A helper function which parses the CI active record returned data into an array and then returns it
		@params:
			$result => A query result usually sent by doing $query->result();
	*/
	function parse_db_into_array($result)
	{
		$d = array();
		foreach($result as $r)
		{
			$d[] = $r;
		}
		return $d;
	}	
}