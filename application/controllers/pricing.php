<?php

class Pricing extends CI_Controller
{
	function index()
	{
		
		$this->load->view('main/header');
		$this->load->view('main/signup');
		$this->load->view('main/footer');
		
	}
}