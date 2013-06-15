<?php

class Refresh_twitter extends CI_Controller
{
	function index()
	{
		//First check if the user has logged in
		if($this->session->userdata('l') != 1)
		{
			//User has logged in
			redirect('login/login');
		}
		
		//Now get his campaign and parse over the campaign keywords from twitter
		$campaign_id = $this->uri->segment(4);
		
		//Loading the buzz model which we'll require later
		$this->load->model('buzz_model', 'buzz');
		
		//We'll now get the keywords related to the campaign
		$query = $this->db->get_where('campaigns', array('id' => $campaign_id, 'user_id' => $this->session->userdata('user_id')));
		$keywords = "";
		
		foreach($query->result() as $r)
		{
			$keywords = $r->keywords;
		}
		$keywords = explode(", ", $keywords);
		
		//Now we get the searches from twitter
		
		// We will now load the library and configs
		
		$this->load->library('twitteroauth');
		$this->config->load('twitter');
		
		//Now we get the user deatils from the database
		$query = $this->db->get_where('twitter_accounts', array('id' => 1));
		$r = array();
		if($query->num_rows() > 0)
		{
			//We found a match and we do yay!
			foreach($query->result() as $c)
			{
				$r['oauth_secret'] = $c->oauth_secret;
				$r['oauth_token'] = $c->oauth_token;
			}
		}
		else
		{
			echo "Please add twitter to your profile!";
		}
		
		//First connect to twitter
		$connection = $this->twitteroauth->create($this->config->item('twitter_consumer_token'), $this->config->item('twitter_consumer_secret'), $r['oauth_token'], $r['oauth_secret']);
		
		for($i = 0; $i<count($keywords); $i++)
		{
			//This will pick out the essentials and fill in the DB
			$this->buzz->parse_twitter($connection->get('search/tweets', array('q' => $keywords[$i], 'result_type'	=> 'recent', 'count' => 50, 'lang' => 'en')), $keywords[$i],$campaign_id);
			
		}
		echo "refreshed";
	}
}