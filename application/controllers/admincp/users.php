<?php 

class Users extends CI_Controller
{
	function index()
	{
		if($this->session->userdata('logged_in') != 1)
		{
			redirect('admincp/login');
		}
		redirect('admincp/users/lists');
	}
	/*
		It lists all the users
	*/
	function lists()
	{
		if($this->session->userdata('logged_in') != 1)
		{
			redirect('admincp/login');
		}
		//load the admin model
		$this->load->model('admin_model', 'admin');
		
		//Begin pagination code
		$this->load->library('pagination');

		$config['base_url'] = site_url('admincp/users/list')."/";
		$config['total_rows'] = $this->db->get('users')->num_rows();
		$config['per_page'] = 20;
		$config['num_links'] = 10;

		$this->pagination->initialize($config);
		//Get the users depending on the page
		$users = $this->admin->get_users($config['per_page']);
		
		
		$data = array(
			'title' 	=> 'Users - Hype Ninja',
			'heading'	=> 'Users',
			'meta_description'	=> 'Campaign for Hype Ninja',
			'meta_keywords'		=> 'SEO, Social, Blah blah',
			'active'	=> 'users',
			'sidebar_active' => 'users',
			'side_sub'		=> 'list',
			'users' 	=> $users,
			'total'		=> $config['total_rows'],				
		);
		
		$this->load->view('admincp/header', $data);
		$this->load->view('admincp/sidebar');
		$this->load->view('admincp/list_users');
	}
	/*
		Edits user details
	*/
	function edit_user()
	{
		echo "Will get back to here in some time";
	}
	/*
		Bans the user
	*/
	function ban_user()
	{
		if($this->session->userdata('logged_in') != 1)
		{
			redirect('admincp/login');
		}
		//load the admin model
		$this->load->model('admin_model', 'admin');
		$data = $this->admin->ban_user();
		//Mail the user
		
		redirect('admincp/users/lists');
	}
	/*
		Unbans the user
	*/
	function unban_user()
	{
		if($this->session->userdata('logged_in') != 1)
		{
			redirect('admincp/login');
		}
		//load the admin model
		$this->load->model('admin_model', 'admin');
		$data = $this->admin->unban_user();
		//Mail the user
		
		redirect('admincp/users/lists');
	}
}