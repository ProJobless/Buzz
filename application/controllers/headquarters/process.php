<?php 

class Process extends CI_Controller
{
	//URL Would be something like this
	//http://hypeninja.com/headquarters/process/twitter/reply/{$twitter_user_id}/
	function twitter()
	{
		//User already logged in check
		
		//First we check if the username is specified
		// if(!$this->uri->segment(5))
// 		{
// 			//we don't have the user_id
// 			echo "You don't have a twitter account linked.";
// 		}
		
		//We will process the reply here
		if($this->uri->segment(4) == "reply")
		{
			//Get the tweet id and tweeter _screen name
			$tweet_id = $this->input->post('t_id');
			
			$tweeter_screen_name = $this->input->post('t_n_s');
			$tweet = $this->input->post('reply_tweet');
			
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
			    'in_reply_to_status_id' => $tweet_id
			);
			$result = $connection->post('statuses/update', $data);
			print_r($result);
			echo "success";
		} 
	}
	/*
		Add twitter to users account
		This is called second
	*/
	function add_twitter()
	{
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
		// if(isset($this->session->userdata('logged_in') != 1))
// 		{
			$this->config->load('twitter');	
			//First load the twitter lib
			$params = array('key' => $this->config->item('twitter_consumer_token'), 'secret'=>$this->config->item('twitter_consumer_secret'));
			$this->load->library('twitter_oauth', $params);
		
			$response = $this->twitter_oauth->get_access_token($this->input->get('oauth_token'), false, $this->input->get('oauth_verifier'));
		
			$this->load->model('process_model', 'process');
			//We will now call the model to insert the data into database
			$this->process->add_twitter($response);
			redirect('headquarters/settings/twitter_accounts');
		// }
// 		else
// 		{
// 			echo "Please login to continue";
// 		}
		
	}
	/*
		
	*/
}