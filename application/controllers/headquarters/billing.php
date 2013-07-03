<?php

class Billing extends CI_Controller
{
	function index()
	{
		if($this->session->userdata('l') != 1)
		{
			//User has logged in
			redirect('login/login');
		}
		
		$tweets_count = $this->process_model->get_tweets_count();
		
		//Get the Invoices
		$invoices = $this->process_model->get_invoices();		
		$data = array(
			'title' 	=> 'Billing',
			'meta_description'	=> 'Billing for Hype Ninja',
			'meta_keywords'		=> 'SEO, Social, Blah blah',
			'heading'			=> 'Billing',
			'active'	=> 'billing',
			'sidebar'	=> 'billing',
			'tweets_count'	=> $tweets_count,
			'invoices'		=> $invoices,
		);
		
		$this->load->view('headquarters/header', $data);
		$this->load->view('headquarters/sidebar');
		$this->load->view('headquarters/billing');
	}
	function view_invoice()
	{
		if($this->session->userdata('l') != 1)
		{
			//User has logged in
			redirect('login/login');
		}
		
		$tweets_count = $this->process_model->get_tweets_count();
		
		//Get the Invoice by ID, uses the URL
		$invoice = $this->process_model->get_invoice_by_id();	
			
		$data = array(
			'title' 	=> 'Billing',
			'meta_description'	=> 'Billing for Hype Ninja',
			'meta_keywords'		=> 'SEO, Social, Blah blah',
			'heading'			=> 'Billing',
			'active'	=> 'billing',
			'sidebar'	=> 'billing',
			'tweets_count'	=> $tweets_count,
			'invoice'		=> $invoice,
		);
		
		$this->load->view('headquarters/header', $data);
		$this->load->view('headquarters/sidebar');
		$this->load->view('headquarters/view_invoice');
	}
}
