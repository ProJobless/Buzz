<?php 

class Dashboard extends CI_Controller
{
	function index()
	{
		//First check if the user has logged in or not
		if($this->session->userdata('logged_in') != 1)
		{
			//user hasn't logged in
			redirect('admincp/login/');
		}
			
		//Load the admin model
		$this->load->model('admin_model', 'admin');
		
		$data = array(
			'title' 	=> 'DashBoard - Hype Ninja',
			'heading'	=> 'AdminCP - Hype Ninja',
			'meta_description'	=> 'Campaign for Hype Ninja',
			'meta_keywords'		=> 'SEO, Social, Blah blah',
			'active'	=> 'dashboard',
			'sidebar_active' => 'dashboard',
			'side_sub'		=> '',
		);
		
		$this->load->view('admincp/header', $data);
		$this->load->view('admincp/sidebar');
		$this->load->view('admincp/footer');
	}
}