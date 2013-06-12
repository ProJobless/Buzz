<?php

class Manager extends CI_Controller
{
	function index()
	{
		//just gets and displays all the active campaigns out there
		$this->load->model('buzz_model', 'buzz');
		
		$campaign_data = $this->buzz->get_campaigns();
		
		$data = array(
			'title' 	=> 'Manage Campaign - Hype Ninja',
			'heading'	=> 'Manage Campaigns',
			'meta_description'	=> 'Campaign for Hype Ninja',
			'meta_keywords'		=> 'SEO, Social, Blah blah',
			'active'	=> 'campaign',
			'campaign_data' => $campaign_data,
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
		//just gets and displays all the active campaigns out there
		$this->load->model('buzz_model', 'buzz');
		$campaign_settings = $this->buzz->get_campaign_settings();
		$twitter_accounts = $this->buzz->get_twitter_accounts($this->uri->segment(4));
		$data = array(
			'title' 	=> 'Edit Campaign - Hype Ninja',
			'heading'	=> 'Edit Campaign',
			'meta_description'	=> 'Campaign for Hype Ninja',
			'meta_keywords'		=> 'SEO, Social, Blah blah',
			'active'	=> 'campaign',
			'campaign_settings' => $campaign_settings,
			'twitter_accounts'	=> $twitter_accounts
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
		$this->load->model('buzz_model', 'buzz');
		$campaign_settings = $this->buzz->get_campaign_settings();
		
		$data = array(
			'title' 	=> 'Edit Campaign - Hype Ninja',
			'heading'	=> 'Edit Campaign',
			'meta_description'	=> 'Campaign for Hype Ninja',
			'meta_keywords'		=> 'SEO, Social, Blah blah',
			'active'	=> 'campaign',
		);
		$this->load->view('headquarters/header', $data);
		$this->load->view('headquarters/sidebar');
		$this->load->view('headquarters/edit_campaign');
	}
	/*
		This saves the settings for a particular campaign
	*/
	function save()
	{
		$this->load->model('buzz_model', 'buzz');
		$this->buzz->save_data();
		redirect('campaign/manager');
	}
}