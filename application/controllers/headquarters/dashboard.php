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
		$tweet_ninja = $this->process_model->get_tweet_ninja(5);
		//$facebook_ninja = $this->process_model->get_facebook_ninja(5);
		$blog_ninja = $this->process_model->get_blog_ninja(5);
		//Some of the data will be retrieved via the model while some will be hard coded
		$data = array(
			'title' 	=> 'Hype Ninja',
			'meta_description'	=> 'Dashboard for Buzzzzzz',
			'meta_keywords'		=> 'SEO, Social, Blah blah',
			'heading'			=> 'Dashboard',
			'active'	=> 'dashboard',
			'sidebar'	=> 'dashboard',
			'news'		=> $news,
			'tweets_count'	=> $tweets_count,
			'tweet_ninja'	=> $tweet_ninja,
			//'facebook_ninja'	=> $facebook_ninja,
			'blog_ninja'		=> $blog_ninja,
		);
		
		$this->load->view('headquarters/header', $data);
		$this->load->view('headquarters/sidebar');
		$this->load->view('headquarters/dashboard');
	}		
}