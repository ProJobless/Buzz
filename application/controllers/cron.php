<?php

class Cron extends CI_Controller
{
	/*
		Function will post the scheduled tweets
		Frequency : 1 minute
	*/
	function scheduled_tweets()
	{
		//Post the scheduled tweet
		$time = time() + 59;
		$this->db->from('scheduled_tweets')->where('scheduled_time <=', $time)->order_by('scheduled_time', 'asc');
		
		$query = $this->db->get();
		
		foreach($query->result() as $r)
		{
			post_twitter($r->tweet,$r->reply_id); //Will add a helper later
			
			// Now add the record in the DB
			 
		}
	}
	
	/*
		Function will update the stats every day for admin panel!
		Frequency : 24 hours
	*/
	function update_admin_stats()
	{
		
	}
	/*
		Function will generate invoice for clients to pay 10 days in advance
		Frequency : 24 hours
	*/
	function generate_invoices()
	{
		
	}
	/*
		Function will send emails depending upon priority
		Frequency : 5 minutes
	*/
	function send_emails()
	{
		
	}
}
?>