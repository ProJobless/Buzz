<?php

class Manager extends CI_Controller
{
	function index()
	{
		if($this->session->userdata('l') != 1)
		{
			//User has logged in
			redirect('login/login');
		}
		//just gets and displays all the active campaigns out there
		$this->load->model('buzz_model', 'buzz');
		
		$campaign_data = $this->buzz->get_campaigns();
		$tweets_count = $this->process_model->get_tweets_count();
		
		$data = array(
			'title' 	=> 'Manage Campaign - Hype Ninja',
			'heading'	=> 'Manage Campaigns',
			'meta_description'	=> 'Campaign for Hype Ninja',
			'meta_keywords'		=> 'SEO, Social, Blah blah',
			'active'	=> 'campaign',
			'campaign_data' => $campaign_data,
			'tweets_count'	=> $tweets_count,
		);
		$this->load->view('headquarters/header', $data);
		$this->load->view('headquarters/sidebar');
		$this->load->view('headquarters/campaigns');
	}
	
	/*
		Here we display settings related to a particular campaign
	*/
	function edit()
	{
		if($this->session->userdata('l') != 1)
		{
			//User has logged in
			redirect('login/login');
		}
		//just gets and displays all the active campaigns out there
		$this->load->model('buzz_model', 'buzz');
		$campaign_settings = $this->buzz->get_campaign_settings();
		$twitter_accounts = $this->buzz->just_twitter_account();
		$tweets_count = $this->process_model->get_tweets_count();
		
		$data = array(
			'title' 	=> 'Edit Campaign - Hype Ninja',
			'heading'	=> 'Edit Campaign',
			'meta_description'	=> 'Campaign for Hype Ninja',
			'meta_keywords'		=> 'SEO, Social, Blah blah',
			'active'	=> 'campaign',
			'campaign_settings' => $campaign_settings,
			'twitter_accounts'	=> $twitter_accounts,
			'tweets_count'	=> $tweets_count,
		);
		$this->load->view('headquarters/header', $data);
		$this->load->view('headquarters/sidebar');
		$this->load->view('headquarters/edit_campaign');
	}
	/*
		This add a new campaign
	*/
	function add_campaign()
	{
		if($this->session->userdata('l') != 1)
		{
			//User has logged in
			redirect('login/login');
		}
		$this->load->model('buzz_model', 'buzz');
		$campaign_settings = $this->buzz->get_campaign_settings();
		$twitter_accounts = $this->buzz->just_twitter_account();
		$tweets_count = $this->process_model->get_tweets_count();
		
		$data = array(
			'title' 	=> 'Add Campaign - Hype Ninja',
			'heading'	=> 'Add Campaign',
			'meta_description'	=> 'Campaign for Hype Ninja',
			'meta_keywords'		=> 'SEO, Social, Blah blah',
			'active'	=> 'campaign',
			'twitter_accounts'	=> $twitter_accounts,
			'tweets_count'	=> $tweets_count,
		);
		$this->load->view('headquarters/header', $data);
		$this->load->view('headquarters/sidebar');
		$this->load->view('headquarters/add_campaign');
	}
	/*
		This will create a campaign for the above settings
	*/
	function create_campaign()
	{
		if($this->session->userdata('l') != 1)
		{
			//User has logged in
			redirect('login/login');
		}
		$this->load->model('buzz_model', 'buzz');
		
		//Now we will ask the model to create a campaign after validation
		
		$this->buzz->create_campaign();
		
		redirect('campaign/manager');		
	}
	/*
		This deletes a campaign
	*/
	function delete()
	{
		if($this->session->userdata('l') != 1)
		{
			//User has logged in
			redirect('login/login');
		}
		$this->load->model('buzz_model', 'buzz');
		$this->buzz->delete_campaign();
		
		redirect('campaign/manager');
	}
	/*
		This saves the settings for a particular campaign
	*/
	function save()
	{
		if($this->session->userdata('l') != 1)
		{
			//User has logged in
			redirect('login/login');
		}
		$this->load->model('buzz_model', 'buzz');
		$this->buzz->save_data();
		redirect('campaign/manager');
	}
}