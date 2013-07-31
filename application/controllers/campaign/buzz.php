<?php 
/*
	This page will display all the buzzing around and user can come here and comment, blah blah
*/
class Buzz extends CI_Controller
{
	function twitter()
	{
		if($this->session->userdata('l') != 1)
		{
			//User has logged in
			redirect('login/login');
		}
		//Loading the model to get data and stuff
		$this->load->model('buzz_model', 'buzz');
		//Get the data for the current campaign selected in URL
		$campaign_data = $this->buzz->getCampaignData();
		
		$tweets = $this->buzz->getTwitterPosts($campaign_data[0]->id);
		$this->session->set_userdata(array('user_id' => 1)); //Will be later put inside Login
		$twitter_accounts = $this->buzz->get_twitter_accounts($campaign_data[0]->id);
		$tweets_count = $this->process_model->get_tweets_count();
		//Formatting data to be sent to the views
		$data = array(
			'title' 	=> 'Manage Campaign',
			'heading'	=> $campaign_data[0]->name,
			'meta_description'	=> 'Campaign for Hype Ninja',
			'meta_keywords'		=> 'SEO, Social, Blah blah',
			'active'	=> 'dashboard',
			'campaign_data'	=> $campaign_data,
			'tweets'	=> $tweets,
			'twitter_accounts'	=> $twitter_accounts,
			'tweets_count'	=> $tweets_count,
			'sidebar'	=> 'campaign',
		);
		$this->load->view('headquarters/header', $data);
		$this->load->view('headquarters/sidebar');
		$this->load->view('headquarters/buzz');
		
	}
	/*
		function lists the blogs from google search also known as Blog Ninja
	*/
	function blog()
	{
		if($this->session->userdata('l') != 1)
		{
			//User has logged in
			redirect('login/login');
		}
		//Loading the model to get data and stuff
		$this->load->model('buzz_model', 'buzz');
		//Get the data for the current campaign selected in URL
		$campaign_data = $this->buzz->getCampaignData();
		
		$blog_posts = $this->buzz->getBlogPosts($campaign_data[0]->id);
		$this->session->set_userdata(array('user_id' => 1)); //Will be later put inside Login
		$twitter_accounts = $this->buzz->get_twitter_accounts($campaign_data[0]->id);
		$tweets_count = $this->process_model->get_tweets_count();
		//Formatting data to be sent to the views
		$data = array(
			'title' 	=> 'Manage Campaign',
			'heading'	=> $campaign_data[0]->name,
			'meta_description'	=> 'Campaign for Hype Ninja',
			'meta_keywords'		=> 'SEO, Social, Blah blah',
			'active'	=> 'dashboard',
			'campaign_data'	=> $campaign_data,
			'blog_posts'	=> $blog_posts,
			'twitter_accounts'	=> $twitter_accounts,
			'tweets_count'	=> $tweets_count,
			'sidebar'	=> 'campaign',
		);
		$this->load->view('headquarters/header', $data);
		$this->load->view('headquarters/sidebar');
		$this->load->view('headquarters/blog_ninja');
	}
	function facebook()
	{
		if($this->session->userdata('l') != 1)
		{
			//User has logged in
			redirect('login/login');
		}
		parse_str($_SERVER['QUERY_STRING'], $_REQUEST);
		
		$this->load->library('facebook');		
		
		$user = $this->facebook->getUser();
				
		if ($user) {
			try {
				$data['user_profile'] = $this->facebook->api('/me/statuses');
			} catch (FacebookApiException $e) {
				$user = null;
			}
		}
		
		if ($user) {
			$data['logout_url'] = $this->facebook->getLogoutUrl();
		} else {
			$data['login_url'] = $this->facebook->getLoginUrl();
		}		
		
		$this->load->view('face',$data);
	}
}