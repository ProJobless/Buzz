<?php 
/*
	This page will display all the buzzing around and user can come here and comment, blah blah
*/
class Buzz extends CI_Controller
{
	function index()
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
			'title' 	=> 'Manage Campaign - Buzzzzzz',
			'heading'	=> $campaign_data[0]->name,
			'meta_description'	=> 'Campaign for Buzzzzzz',
			'meta_keywords'		=> 'SEO, Social, Blah blah',
			'active'	=> 'dashboard',
			'campaign_data'	=> $campaign_data,
			'tweets'	=> $tweets,
			'twitter_accounts'	=> $twitter_accounts,
			'tweets_count'	=> $tweets_count,
		);
		$this->load->view('headquarters/header', $data);
		$this->load->view('headquarters/sidebar');
		$this->load->view('headquarters/buzz');
		
	}
}