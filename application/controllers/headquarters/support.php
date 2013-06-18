<?php 

class Support extends CI_Controller
{
	function index()
	{
		if($this->session->userdata('l') != 1)
		{
			//User has logged in
			redirect('login/login');
		}
		
		$tickets = $this->process_model->get_support_tickets();
		
		$tweets_count = $this->process_model->get_tweets_count();
		//Formatting data to be sent to the views
		$data = array(
			'title' 	=> 'Support',
			'heading'	=> 'Support',
			'meta_description'	=> 'Support Settings for Hype Ninja',
			'meta_keywords'		=> 'SEO, Social, Blah blah',
			'active'	=> 'support',
			'sidebar'	=> 'support',
			'tickets'		=> $tickets,
			'tweets_count'	=> $tweets_count,			
		);
		$this->load->view('headquarters/header', $data);
		$this->load->view('headquarters/sidebar');
		$this->load->view('headquarters/support');
	}
	/*
		Deletes the support ticket, but it's only available to active tickets
	*/
	function close()
	{
		if($this->session->userdata('l') != 1)
		{
			//User has logged in
			redirect('login/login');
		}
		//Deletes the ticket which is active and is in the URI segment
		$this->process_model->close_ticket();
		redirect('headquarters/support');
	}
	/*
		Views the ticket
	*/
	function view()
	{
		if($this->session->userdata('l') != 1)
		{
			//User has logged in
			redirect('login/login');
		}
		
		$tweets_count = $this->process_model->get_tweets_count();
		
		//This gets the data of a particular ticket from the url
		$ticket_data = $this->process_model->get_ticket_by_id();
		//Formatting data to be sent to the views
		$data = array(
			'title' 	=> 'Support',
			'heading'	=> 'Support',
			'meta_description'	=> 'Support Settings for Hype Ninja',
			'meta_keywords'		=> 'SEO, Social, Blah blah',
			'active'	=> 'support',
			'sidebar'	=> 'support',
			'ticket_data' => $ticket_data,
			'tweets_count'	=> $tweets_count,			
		);
		$this->load->view('headquarters/header', $data);
		$this->load->view('headquarters/sidebar');
		$this->load->view('headquarters/view_ticket');
	}
	
	/*
		Adds a reply to the ticket of the user
	*/
	function add_reply()
	{
		$this->process_model->add_reply_to_ticket();
		
		redirect('headquarters/support/view'.$this->uri->segment(4));
	}
}