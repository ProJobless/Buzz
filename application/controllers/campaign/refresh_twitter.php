<?php

class Refresh_twitter extends CI_Controller
{
	function index()
	{
		//First check if the user has logged in
		
		
		//Now get his campaign and parse over the campaign keywords from twitter
		$campaign_id = 1; //$this->input->post('cam_id');
		
		//Loading the buzz model which we'll require later
		$this->load->model('buzz_model', 'buzz');
		
		//We'll now get the keywords related to the campaign
		$query = $this->db->get_where('campaigns', array('id' => $campaign_id, 'user_id'	=> 1));	//Just for the testing the userid is set to 1
		$keywords = array();
		foreach($query->result() as $r)
		{
			$keywords = $r->keywords;
		}
		$keywords = explode(", ", $keywords);
		print_r($keywords);
		//Now we get the searches from twitter
		
		// We will now load the library and configs
		
		$this->load->library('twitteroauth');
		$this->config->load('twitter');
		
		//First connect to twitter
		$connection = $this->twitteroauth->create($this->config->item('twitter_consumer_token'), $this->config->item('twitter_consumer_secret'), $this->config->item('twitter_access_token'), $this->config->item('twitter_access_secret'));
		
		foreach($keywords as $k)
		{
			echo "<pre>";
			$this->buzz->parse_twitter($connection->get('search/tweets', array('q' => $k, 'result_type'	=> 'recent', 'count' => 10)), $k);
			echo "</pre>";
		}
	}
}