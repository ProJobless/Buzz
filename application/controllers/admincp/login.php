<?php

class Login extends CI_Controller
{
	//Our admin login page
	function index()
	{
		//Check if the user is already logged in and if he is then redirect him
		if($this->session->userdata('logged_in') == 1)
		{
			redirect('admincp/dashboard');
		}
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
	function login_submit()
	{
		//First I will validate the login
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
		}
		else
		{
			$this->load->model('admin_model', 'admin');
			$data = $this->admin->login();
			if($data == 1)
			{
				redirect('admincp/dashboard');
			}
			else
			{
				echo "Fail dude!";
			}
		}
	}
}