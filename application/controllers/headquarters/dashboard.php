<?php

class Dashboard extends CI_Controller
{
	function index()
	{
		//Some of the data will be retrieved via the model while some will be hard coded
		$data = array(
			'title' 	=> 'Buzzzzzz',
			'meta_description'	=> 'Dashboard for Buzzzzzz',
			'meta_keywords'		=> 'SEO, Social, Blah blah',
			'active'	=> 'dashboard'
		);
		
		$this->load->view('headquarters/header', $data);
		$this->load->view('headquarters/sidebar');
	}		
}