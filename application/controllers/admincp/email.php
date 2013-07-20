<?php

class Email extends CI_Controller
{	
	function index()
	{
		redirect('admincp/email/lists');
	}
	/*
		Displays a list of emails
	*/
	function lists()
	{
		if($this->session->userdata('logged_in') != 1)
		{
			redirect('admincp/login');
		}
		$this->load->model('admin_model', 'admin');
		
		//Get all email templates
		$email_templates = $this->admin->get_email_templates();
			
		$data = array(
			'title' 	=> 'Email - Hype Ninja',
			'heading'	=> 'Email',
			'meta_description'	=> 'Hype Ninja',
			'meta_keywords'		=> 'SEO, Social, Blah blah',
			'active'	=> 'email',
			'sidebar_active' => 'email',
			'side_sub'		=> '',
			'email_templates' => $email_templates,
			
		);
		
		$this->load->view('admincp/header', $data);
		$this->load->view('admincp/sidebar');
		$this->load->view('admincp/list_email');
		$this->load->view('admincp/footer');
	}
	/*
		Add Email template
	*/
	function add_template()
	{
		if($this->session->userdata('logged_in') != 1)
		{
			redirect('admincp/login');
		}
		$this->load->model('admin_model', 'admin');
			
		$data = array(
			'title' 	=> 'Add Email Template - Hype Ninja',
			'heading'	=> 'Add Email Template',
			'meta_description'	=> 'Hype Ninja',
			'meta_keywords'		=> 'SEO, Social, Blah blah',
			'active'	=> 'email',
			'sidebar_active' => 'email',
			'side_sub'		=> '',			
		);
		
		$this->load->view('admincp/header', $data);
		$this->load->view('admincp/sidebar');
		$this->load->view('admincp/add_email_template');
		$this->load->view('admincp/footer');
	}
	/*
		Creates an HTML parsed Email Template
	*/
	function create_template()
	{
		if($this->session->userdata('logged_in') != 1)
		{
			redirect('admincp/login');
		}
		$this->load->model('admin_model', 'admin');
		
		$this->admin->create_email_template();
		redirect('admincp/email');
	}
	/*
		Edits and views the Email
	*/
	function edit_email()
	{
		if($this->session->userdata('logged_in') != 1)
		{
			redirect('admincp/login');
		}
		
		$this->load->model('admin_model', 'admin');
		$email_data = $this->admin->get_email_by_id($this->uri->segment(4));
		
		$data = array(
			'title' 	=> 'Edit Email Template - Hype Ninja',
			'heading'	=> 'Edit Email Template',
			'meta_description'	=> 'Hype Ninja',
			'meta_keywords'		=> 'SEO, Social, Blah blah',
			'active'	=> 'email',
			'sidebar_active' => 'email',
			'side_sub'		=> '',
			'email_data' 	=> $email_data,		
		);
		
		$this->load->view('admincp/header', $data);
		$this->load->view('admincp/sidebar');
		$this->load->view('admincp/edit_email');
		$this->load->view('admincp/footer');
	}
	/*
		Saves the edited template
	*/
	function save_edited_template()
	{
		if($this->session->userdata('logged_in') != 1)
		{
			redirect('admincp/login');
		}
		
		$this->load->model('admin_model', 'admin');
		
		$email_data = $this->admin->save_email_by_id($this->input->post('id'));
		
		redirect('admincp/email');
	}
	function send_m()
	{
		$this->process_model->send_mail_immediately(1,1);
	}
}