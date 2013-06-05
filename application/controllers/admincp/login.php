<?php

class Login extends CI_Controller
{
	//Our admin login page
	function index()
	{
		//Check if the user is already logged in and if he is then redirect him

		//Else continue
		//Some of the data will be retrieved via the model while some will be hard coded
		$data = array(
			'title' 	=> 'Buzzzzzz',
			'meta_description'	=> 'Admin Control Panel for Buzzzzzz',
			'meta_keywords'		=> 'SEO, Social, Blah blah',
		);
		$this->load->view('admincp/header', $data);
		$this->load->view('admincp/login');
		$this->load->view('admincp/footer');
	}

}