<?php

class Dashboard extends CI_Controller
{
	function index()
	{
		if($this->session->userdata('l') != 1)
		{
			//User has logged in
			redirect('login/login');
		}
				
		$news = $this->process_model->get_news();
		$tweets_count = $this->process_model->get_tweets_count();
		//Some of the data will be retrieved via the model while some will be hard coded
		$data = array(
			'title' 	=> 'Hype Ninja',
			'meta_description'	=> 'Dashboard for Buzzzzzz',
			'meta_keywords'		=> 'SEO, Social, Blah blah',
			'heading'			=> 'Dashboard',
			'active'	=> 'dashboard',
			'news'		=> $news,
			'tweets_count'	=> $tweets_count,
		);
		
		$this->load->view('headquarters/header', $data);
		$this->load->view('headquarters/sidebar');
		$this->load->view('headquarters/dashboard');
	}		
}