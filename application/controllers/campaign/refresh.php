<?php

class Refresh extends CI_Controller
{
	/*
		Refreshes the list of tweets from twitter
	*/
	function twitter()
	{
		//First check if the user has logged in
		if($this->session->userdata('l') != 1)
		{
			//User has logged in
			redirect('login/login');
		}
		
		$this->load->model('refresh_model', 'refresh');
		
		//Call the refresh tweets fuction in the model to update the list of tweets
		if($this->refresh->refresh_twitter($this->uri->segment(4)) == 1)
		echo "refreshed";
	}
	/*
		Refreshes the list blogs from google
	*/
	function blog()
	{
		//First check if the user has logged in
		if($this->session->userdata('l') != 1)
		{
			//User has logged in
			redirect('login/login');
		}
		$this->load->model('refresh_model', 'refresh');
		
		if($this->refresh->refresh_blog($this->uri->segment(4)) == 0)
		{
			echo "failed";
		}
		else
		{
			echo "refreshed";
		}
	}
}