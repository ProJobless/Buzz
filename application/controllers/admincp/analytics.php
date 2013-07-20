<?php

class Analytics extends CI_Controller
{
	function index()
	{
		//First check if the user has logged in or not
		if($this->session->userdata('logged_in') != 1)
		{
			//user hasn't logged in
			redirect('admincp/login/');
		}
		
		$this->load->model('admin_model', 'admin');
		$stats = $this->admin->get_stats();
		
		$data = array(
			'title' 	=> 'Analytics - Hype Ninja',
			'heading'	=> 'Analytics',
			'meta_description'	=> 'Campaign for Hype Ninja',
			'meta_keywords'		=> 'SEO, Social, Blah blah',
			'active'	=> 'analytics',
			'sidebar_active' => 'analytics',
			'side_sub'		=> '',
			'stats' => $stats
		);
		
		$this->load->view('admincp/header', $data);
		$this->load->view('admincp/sidebar');
		$this->load->view('admincp/all_analytics');
		$this->load->view('admincp/footer');
	}
}