<?php 

class Packs extends CI_Controller
{
	/*
		Redirects to the list of packages
	*/
	function index()
	{
		redirect('admincp/packs/lists/');
	}
	
	function lists()
	{
		if($this->session->userdata('logged_in') != 1)
		{
			redirect('admincp/login');
		}
		$this->load->model('admin_model', 'admin');
		
		//get all the packs
		$packs = $this->admin->get_all_packs();
		
		$data = array(
			'title' 	=> 'Packs - Hype Ninja',
			'heading'	=> 'Packs',
			'meta_description'	=> 'Campaign for Hype Ninja',
			'meta_keywords'		=> 'SEO, Social, Blah blah',
			'active'	=> 'packs',
			'sidebar_active' => 'packs',
			'side_sub'		=> '',
			'packs'		=> $packs
		);
		
		$this->load->view('admincp/header', $data);
		$this->load->view('admincp/sidebar');
		$this->load->view('admincp/list_packs');
		$this->load->view('admincp/footer');
	}
	/*
		Allows us to edit a pack
	*/
	function edit_pack()
	{
		if($this->session->userdata('logged_in') != 1)
		{
			redirect('admincp/login');
		}
		echo "Will get back to this later";
	}
}