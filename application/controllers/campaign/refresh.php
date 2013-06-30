<?php

class Refresh extends CI_Controller
{
	/*
		Refreshes the list of keyword from twitter
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
		
		$this->refresh->refresh_twitter($this->uri->segment(4));
		
		echo "refreshed";
	}
	
	function blog()
	{
		//First check if the user has logged in
		if($this->session->userdata('l') != 1)
		{
			//User has logged in
			redirect('login/login');
		}
		$this->load->model('refresh_model', 'refresh');
		
		$this->refresh->refresh_blog($this->uri->segment(4));
	}
}