<?php 
/*
	AdminCP version of support
*/
class Support extends CI_Controller
{
	function index()
	{
		if($this->session->userdata('logged_in') != 1)
		{
			redirect('admincp/login');
		}
		$this->load->model('admin_model', 'admin');
		
		$total_active = $this->admin->count_active_tickets();
		$active_tickets = $this->admin->get_active_tickets();
		
		$data = array(
			'title' 	=> 'Support - Hype Ninja',
			'heading'	=> 'Support',
			'meta_description'	=> 'Campaign for Hype Ninja',
			'meta_keywords'		=> 'SEO, Social, Blah blah',
			'active'	=> 'support',
			'sidebar_active' => 'support',
			'side_sub'		=> '',
			'total'			=> $total_active,
			'tickets'		=> $active_tickets,
			
		);
		
		$this->load->view('admincp/header', $data);
		$this->load->view('admincp/sidebar');
		$this->load->view('admincp/list_tickets');
		$this->load->view('admincp/footer');
	}
	
	/*
		this helps in viewing the ticket in acp
	*/
	function view_ticket()
	{
		if($this->session->userdata('logged_in') != 1)
		{
			redirect('admincp/login');
		}
		$this->load->model('admin_model', 'admin');
		$ticket_data = $this->admin->get_ticket_by_id();
		$data = array(
			'title' 	=> 'Support - Hype Ninja',
			'heading'	=> 'Support',
			'meta_description'	=> 'Campaign for Hype Ninja',
			'meta_keywords'		=> 'SEO, Social, Blah blah',
			'active'	=> 'support',
			'sidebar_active' => 'support',
			'side_sub'		=> '',
			'ticket_data'	=> $ticket_data	
		);
		
		$this->load->view('admincp/header', $data);
		$this->load->view('admincp/sidebar');
		$this->load->view('admincp/view_ticket');
		$this->load->view('admincp/footer');
	}
	/*
		Adds reply to the support ticket
	*/
	function add_reply()
	{
		if($this->session->userdata('logged_in') != 1)
		{
			//User has logged in
			redirect('login/login');
		}
		$this->admin_model->add_reply_to_ticket();
		
		redirect('admincp/support/view_ticket/'.$this->uri->segment(4));
	}
}