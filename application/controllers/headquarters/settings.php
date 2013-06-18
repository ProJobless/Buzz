<?php

/*
	Main settings where people can see their invoices, assign people to their campaigns, add more funds,
*/
class Settings extends CI_Controller
{
	function index()
	{
		if($this->session->userdata('l') != 1)
		{
			//User has logged in
			redirect('login/login');
		}
		//Loading the model to get data and stuff
		$this->load->model('settings_model', 'settings');
		//Get the settings for a particular user
		$settings = $this->settings->get_settings();
		$tweets_count = $this->process_model->get_tweets_count();
		//Formatting data to be sent to the views
		$data = array(
			'title' 	=> 'Settings',
			'heading'	=> 'Settings',
			'meta_description'	=> 'Campaign for Buzzzzzz',
			'meta_keywords'		=> 'SEO, Social, Blah blah',
			'active'	=> 'settings',
			'sidebar'	=> 'settings',
			's'			=> $settings,
			'tweets_count'	=> $tweets_count,			
		);
		$this->load->view('headquarters/header', $data);
		$this->load->view('headquarters/sidebar');
		$this->load->view('headquarters/settings');
	}
	/*
		This will fetch the twitter accounts for a particular user
	*/
	function twitter_accounts()
	{
		if($this->session->userdata('l') != 1)
		{
			//User has logged in
			redirect('login/login');
		}
		//Loading the model to get data and stuff
		$this->load->model('settings_model', 'settings');
		if($this->uri->segment(4) == 'delete')
		{
			//We user wants to delete one of his profiles
			$this->settings->delete_twitter();
		}
		else
		{
			//Get the twitter accounts authorized by the user
			$t_accounts = $this->settings->get_twitter_accounts();
			$tweets_count = $this->process_model->get_tweets_count();
			//Formatting data to be sent to the views
			$data = array(
				'title' 	=> 'Settings - Hype Ninja',
				'heading'	=> 'Settings',
				'meta_description'	=> 'Campaign for Buzzzzzz',
				'meta_keywords'		=> 'SEO, Social, Blah blah',
				'active'	=> 'settings',
				'sidebar'	=> 'settings',
				't_accounts'=> $t_accounts,
				'tweets_count'	=> $tweets_count,
			);
			$this->load->view('headquarters/header', $data);
			$this->load->view('headquarters/sidebar');
			$this->load->view('headquarters/twitter_settings');
		}
	}
}
?>