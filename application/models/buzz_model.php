<?php

class Buzz_model extends CI_Model
{
	//This wil return all the data related to the campaign, mainly meta!
	function getCampaignData()
	{
		//Id of the campaign
		$id = $this->uri->segment(4);
		$query = $this->db->get_where('campaigns', array('user_id' => $this->session->userdata('user_id'), 'id' => $id));
		
		//Now we parse the data
		$data = array();
		foreach($query->result() as $r)
		{
			$data[] = $r;
		}
		return $data;
	}
	//This will return the twitter posts related to campaign
	function getTwitterPosts($campaign_id)
	{
		$this->db->select('*')->from('tweets')->where('campaign_id',$campaign_id)->limit(100,0)->order_by('timestamp', 'desc');
		$query = $this->db->get();
		
		//Now we parse the data
		$data = array();
		foreach($query->result() as $r)
		{
			$data[] = $r;
		}
		return $data;
	}
	/*
		This deletes the campaign
	*/
	function delete_campaign()
	{
		$this->db->delete('campaigns', array('id' => $this->uri->segment(4), 'user_id' => $this->session->userdata('user_id')));
	}
	/*
		This will get the dafault twitter account for a particular campaign
	*/
	function get_default_twitter($campaign_id)
	{
		$query = $this->db->get_where('campaigns', array('id' => $campaign_id));
		
		$r;
		foreach($query->result() as $q)
		{
			$r = $q->twitter_default;
		}
		return $r;
	}
	/*
		Gets the list of all active campaigns
	*/
	function get_campaigns()
	{
		$query = $this->db->get_where('campaigns', array('user_id' => $this->session->userdata('user_id')));
		
		$r = array();
		
		foreach($query->result() as $q)
		{
			$r[] = $q;
		}
		
		return $r;			
	}
	/*
		This will first check if the user that is logged in + campaign match
	*/
	function get_campaign_settings()
	{
		$query = $this->db->get_where('campaigns', array('id' => $this->uri->segment(4), 'user_id' => $this->session->userdata('user_id')));
		
		if($query->num_rows() == 1)
		{
			$r = array();
			foreach($query->result() as $q)
			{
				$r[] = $q;
			}
			return $r;
		}
		else
		{
			return 0;
		}
	}
	/*
		This function fetches the blog posts scrapped from google earlier
	*/
	function getBlogPosts($id)
	{
		$this->db->select('*')->from('blog_search')->where('campaign_id',$id)->limit(100,0)->order_by('timestamp', 'desc');
		$query = $this->db->get();
		
		
		$data = array();
		foreach($query->result() as $r)
		{
			$data[] = $r;
		}
		return $data;
	}
	/*
		fetches all the twitter account for a user
		WARNING : THIS FUNCTION ONLY NEEDS TO BE CALLED FROM THE BUZZ PAGE CAUSE IT USES URI->SEGMENT(4)
	*/
	function get_twitter_accounts($cam_id)
	{
		$query = $this->db->get_where('campaigns', array('id' => $cam_id, 'user_id' => $this->session->userdata('user_id')));
		$t;
		foreach($query->result() as $q)
		{
			$t = $q->twitter_id;
		}
		$t = json_decode($t);
		
		$data = array();
		foreach($t as $r)
		{
			$query = $this->db->get_where('twitter_accounts', array('user_id' => $this->session->userdata('user_id'), 'id' => $r));
			foreach($query->result() as $r)
			{
				$data[] = $r;
			}
		}		
		return $data;
	}
	/*
		This creates a new camapign for the user
	*/
	function create_campaign()
	{
		$q = array();
		//I'll format the checkboxes data first
		if($this->input->post('twitter') != "")
		{
			foreach($this->input->post('twitter') as $r)
			{
				$q[] = $r;
			}
		}
		else
		{
			//Get all the user accounts and add it here
			$query = $this->db->get_where('twitter_accounts', array('user_id' => $this->session->userdata('user_id')));
			$q = array();
			foreach($query->result() as $r)
			{
				$q[] = $r->id;
			}
		}
		$data = array(
			'name' => $this->input->post('name'),
			'user_id' => $this->session->userdata('user_id'),
			'keywords' => $this->input->post('keywords'),
			'twitter_id' => json_encode($q),
		);
		$this->db->set($data);
		$this->db->insert('campaigns', $data);
	}
	/*
		This function formats the keywords and prevents any incorrect data to be entered
	*/
	function fix_keywords($keywords)
	{
		//echo '/,\w/';
		//return preg_replace("/,\w/", ", ", $keywords);
	}
	//Function just gets all the twitter accounts
	function just_twitter_account()
	{
		$query = $this->db->get_where('twitter_accounts', array('user_id' => $this->session->userdata('user_id')));
		$data = array();
		foreach($query->result() as $r)
		{
			$data[] = $r;
		}
		return $data;
	}
	/*
		This saves the campaign settings
	*/
	function save_data()
	{
		$q = array();
		//I'll format the checkboxes data first
		foreach($this->input->post('twitter') as $r)
		{
			$q[] = $r;
		}
		//Setting the data
		$data = array(
			'name' => $this->input->post('name'),
			'keywords' => $this->input->post('keywords'),
			'twitter_id' => json_encode($q),
		);
		$this->db->set($data);
		$this->db->where( array('id' => $this->input->post('id'), 'user_id' => $this->session->userdata('user_id')));
		$this->db->update('campaigns');
	}
	/* 
		This will parse the tweets and makes the keyword bold
	*/
	function parse_keywords($tweet, $keyword)
	{
		return str_ireplace($keyword, '<b style="color:#222222;">'.$keyword."</b>", $tweet);
	}
	//This will take in a timestamp and convert it into something like 10 seconds ago
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
		else if($time_diff < 2592000)
		{
			return ceil($time_diff/86400)." days ago";
		}
		else if($time_diff < 31104000)
		{
			return ceil($time_diff/2592000)." months ago";
		}
		else
		{
			return ceil($time_diff/31104000)." years ago";
		}
	}
}