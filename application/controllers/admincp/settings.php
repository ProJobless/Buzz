<?php 

class Settings extends CI_Controller
{
	function index()
	{
		if($this->session->userdata('logged_in') != 1)
		{
			redirect('admincp/login');
		}
		$this->load->model('admin_model', 'admin');
		
		$settings = $this->admin->load_settings($this->session->userdata('id'));
		
		$data = array(
			'title' 			=> 'Settings - Hype Ninja',
			'heading'			=> 'Settings',
			'meta_description'	=> 'Campaign for Hype Ninja',
			'meta_keywords'		=> 'SEO, Social, Blah blah',
			'active'			=> 'settings',
			'sidebar_active'	=> 'settings',
			'side_sub'			=> '',
			's'					=> $settings
		);
		
		$this->load->view('admincp/header', $data);
		$this->load->view('admincp/sidebar');
		$this->load->view('admincp/settings');
		$this->load->view('admincp/footer');
	}
	/*
		Uploads the profile picture
	*/
	function upload_pic()
	{
		if($this->session->userdata('logged_in') != 1)
		{
			redirect('admincp/login');
		}
		$this->load->model('admin_model', 'admin');
		
		//Load the Upload library
		$config['upload_path'] = './images/p/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '1024';
		$config['max_width'] = '1024';
		$config['max_height'] = '768';
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload', $config);
		
		$this->admin->upload_profile_pic();
		
		redirect('admincp/settings');
	}
}