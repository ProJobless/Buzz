<?php

class Buzz_model extends CI_Model
{
	function getCampaignData()
	{
		//Id of the campaign
		$id = $this->uri->segment(4);
		$query = $this->db->get_where('campaigns', array('user_id' => 1, 'id' => $id));
		
		//Now we parse the data
		$data = array();
		foreach($query->result() as $r)
		{
			$data[] = $r;
		}
		return $data;
	}
	function parse_twitter($content, $keyword)
	{
		foreach($content as $c)
		{
			for($j = 0; $j < count($c); $j++)
			{
				$tweet			= $c[$j]->text;
				$timestamp		= strtotime($c[$j]->created_at);
				$keyword		= $keyword;
				$profile_image	= $c[$j]->user->profile_image_url;
				$tweeter_name	= $c[$j]->user->name;
				$tweet_url		= 'http://twitter.com/'.$c[$j]->user->screen_name."/"."status/".$c[$j]->id;
				$campaign_id	= 1;
				
				$data = array(
					'tweet'			=> $tweet,
					'timestamp'		=> $timestamp,	
					'keyword'		=> $keyword,
					'profile_image'	=> $profile_image,	
					'tweeter_name'	=> $tweeter_name,	
					'tweet_url'		=> $tweet_url,		
					'campaign_id'	=> $campaign_id,	
				);
				$this->db->set($data);
				$this->db->insert('tweets', $data);
			}
		}
	}
}