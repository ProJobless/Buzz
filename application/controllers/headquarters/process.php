<?php 

class Process extends CI_Controller
{
	//URL Would be something like this
	//http://hypeninja.com/headquarters/process/twitter/reply/{$twitter_tweet_id}/
	function twitter()
	{
		//User already logged in check
		if($this->session->userdata('l') != 1)
		{
			//User has logged in
			redirect('login/login');
		}
		
		//We will process the reply here
		if($this->uri->segment(4) == "reply")
		{
			$tweet_id = $this->uri->segment(5);
		
			$tweeter_screen_name = $this->input->post('t_n_s');
			$tweet = $this->input->post('reply_tweet');
					
			if($this->input->post('s_t') == "")
			{
				//Get the tweet id and tweeter _screen name
				
			
				//Checking if the reply has the username otherwise it won't be a genuine reply
				if (stripos($tweet, $tweeter_screen_name) !== false) {
					//True, so do nothing and continue
				}
				else
				{
					$tweet = $tweeter_screen_name." ".$tweet;
				}
							
				$this->config->load('twitter');	
				//First load the twitter lib
				$this->load->library('twitteroauth');
			
				//Now we get the user details from the database
				$query = $this->db->get_where('twitter_accounts', array('id' => $this->input->post('t_u_i'), 'user_id' => $this->session->userdata('user_id')));
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
				//We now have the oauth tokens and oauth secret
				//Now we connect
				$connection = $this->twitteroauth->create($this->config->item('twitter_consumer_token'), $this->config->item('twitter_consumer_secret'), $r['oauth_token'], $r['oauth_secret']);
			
				$content = $connection->get('account/verify_credentials');
			
				$data = array(
				    'status' => $tweet,
				    'in_reply_to_status_id' => $this->uri->segment(5),
				);
				$result = $connection->post('statuses/update', $data);
			
				//Now we add a tweet count to the user_profile
			
				$qu = $this->db->get_where('users', array('id'=>$this->session->userdata('user_id')));
				foreach($qu->result() as $q)
				{
					$count = $q->tweet_count + 1;
					$data = array(
						'tweet_count' => $count,
					);
					$this->db->where('id' , $q->id);
					$this->db->update('users', $data);
				}
			
				//Now add the tweet to the twitter_replies so that we can keep a history!
				$data = array(
					'tweet'		=> $tweet,
					'reply_id'	=> $this->uri->segment(5),
					'scheduled'	=> 0,
					'user_id'	=> $this->session->userdata('user_id'),
					'campaign_id'	=> $this->input->post('c_id'),
					'twitter_account' 	=> $this->input->post('t_u_i'),
					'timestamp'	=> time()
				);
			
				$this->db->set($data);
				$this->db->insert('twitter_replies');

				echo "success";
			}
			else
			{
				//The tweet is to be scheduled
				// First insert it into the twitter_replies table so that 
				// we have a history of tweets
				
				$data = array(
					'tweet'		=> $tweet,
					'reply_id'	=> $this->uri->segment(5),
					'scheduled'	=> 1,
					'user_id'	=> $this->session->userdata('user_id'),
					'campaign_id'	=> $this->input->post('c_id'),
					'twitter_account' 	=> $this->input->post('t_u_i'),
					'timestamp'	=> time()
				);
			
				$this->db->set($data);
				$this->db->insert('twitter_replies');
				
				//Insert it in the scheduled table and tweet later
				$data = array(
					'tweet'		=> $tweet,
					'reply_id'	=> $this->uri->segment(5),
					'scheduled_time' => strtotime($this->input->post('s_t')),
					'user_id'	=> $this->session->userdata('user_id'),
					'twitter_account' 	=> $this->input->post('t_u_i'),
				);
			
				$this->db->set($data);
				$this->db->insert('scheduled_twitter');
				echo "scheduled";
			}
			
		}
		else if($this->uri->segment(4) == "retweet")
		{
			//We will be retweeting for the user here!
			$tweet_id = $this->uri->segment(5);
			
			$this->config->load('twitter');	
			//First load the twitter lib
			$this->load->library('twitteroauth');
		
			//Now we get the user details from the database
			$query = $this->db->get_where('twitter_accounts', array('id' => $this->input->post('t_u_i'), 'user_id' => $this->session->userdata('user_id')));
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
			//We now have the oauth tokens and oauth secret
			//Now we connect
			$connection = $this->twitteroauth->create($this->config->item('twitter_consumer_token'), $this->config->item('twitter_consumer_secret'), $r['oauth_token'], $r['oauth_secret']);
		
			$content = $connection->get('account/verify_credentials');
			
			$result = $connection->post('statuses/retweet/'.$tweet_id);
			
			echo "retweeted";
		}
	}
	/*
		Add twitter to users account
		This is called second
	*/
	function add_twitter()
	{
		if($this->session->userdata('l') != 1)
		{
			//User has logged in
			redirect('login/login');
		}
		$this->config->load('twitter');	
		//First load the twitter lib
		$params = array('key' => $this->config->item('twitter_consumer_token'), 'secret'=>$this->config->item('twitter_consumer_secret'));
		$this->load->library('twitter_oauth', $params);
		
		$response = $this->twitter_oauth->get_request_token(site_url("headquarters/process/twitter_auth"));

		$this->session->set_userdata('token_secret', $response['token_secret']);
		redirect($response['redirect']);
	}
	/*
		We get the Oauth Token as _GET and we then save them for the user
		We call this function 1. FIRST
	*/
	function twitter_auth()
	{
		if($this->session->userdata('l') == 1)
		{
			$this->config->load('twitter');	
			//First load the twitter lib
			$params = array('key' => $this->config->item('twitter_consumer_token'), 'secret'=>$this->config->item('twitter_consumer_secret'));
			$this->load->library('twitter_oauth', $params);
		
			$response = $this->twitter_oauth->get_access_token($this->input->get('oauth_token'), false, $this->input->get('oauth_verifier'));
		
			
			//We will now call the model to insert the data into database
			$this->process_model->add_twitter($response);
			redirect('headquarters/settings/twitter_accounts');
		}
 		else
 		{
 			echo "Please login to continue";
 		}
		
	}
	/*
		Functio nprocess the IPN request of the paypal
	*/
	function ipn()
	{
		 $this->load->library('PayPal_IPN');
         if ($this->paypal_ipn->validateIPN())
         {
             // Succeeded, now let's extract the order
             $this->paypal_ipn->extractOrder();

             $this->paypal_ipn->saveOrder();

             if ($this->paypal_ipn->orderStatus == PayPal_IPN::PAID)
             {
				 //Now we will check if the user has paid the same amount as promised or detect some injection in the prices ;)
				 $gross = 0;
				 foreach($this->paypal_ipn->orderItems as $o)
				 {
					 $gross += $o['mc_gross'];
				 }
				 //Get the json from the custom IPN thingy
				 $custom = json_decode($this->paypal_ipn->order['custom']);
				 
				 //get the user id
				 $user_id = $custom->u;
				 
				 //Get the invoice ID
				 $invoice = $custom->i;
				 
				 //match the pack and the pricing
				 foreach($this->db->get('packs')->result() as $r)
				 {
					 if($gross == $r->price)
					 {
						 //We found our guy!
						 //Now create the user
						 $data = array(
							 'plan_id'	=> $r->id,
						 );
						 $this->db->where('id', $user_id);
						 $this->db->update('users', $data);
						 
						 //Now create a paid invoice for the same guy!
						 if($invoice == 0)
						 {
							 //User is a new guy!
							 //Create a new invioce for him
							 $this->process_model->create_invoice($user_id, $r->id, $gross, 1);
						 }
						 //Also mail the user!
						 
					 }
				 }
             }
			 else
			 {
				 echo "Not paid";
			 }
         }
		 else
		 {
			 echo "Not validated";
		 }
	}
	
	/*
		The first function to be called to login a person into facebook
	*/
	
	function login_facebook()
	{
		$this->load->library('facebook');
		$params = array(
			'scope' => 'publish_stream, manage_pages',
			'redirect_uri'	=> base_url()."headquarters/process/get_token",
			'response_type' => 'code'
		);
		redirect($this->facebook->getLoginUrl($params), 'location');
	}	
	/*
		Function Gets a token and calls a function which inserts it into the database
	*/
	function get_token()
	{
		
		$this->load->library('facebook');
		
		$token_url = "https://graph.facebook.com/oauth/access_token?client_id=486874411404149&redirect_uri=".urlencode(base_url()."headquarters/process/get_token")."&client_secret=962a4c9ba88c839658fad286adce5acb&code=".$_GET['code'];
 
	  	$response = file_get_contents($token_url);
    	$params = null;
    	parse_str($response, $params); //parse name value pair
 
    	print_r($params);
	}
	function get_token2()
	{
		parse_str($_SERVER['QUERY_STRING'], $_REQUEST);
		$this->process_model->insert_facebook_access_token($_GET['access_token']);
	}
}