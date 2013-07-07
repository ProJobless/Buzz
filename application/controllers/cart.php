<?php

class Cart extends CI_Controller
{
	/*
		A short function to minimize the size of the URL
		Displays the cart and a link to the payment page on paypal
	*/
	function c()
	{	
		//Gets the data from the database with the related pack ID		
		$pack_data = $this->process_model->get_pack_by_id($this->uri->segment(3));
		
		$this->load->view('cart/header');
		
		$this->load->view('cart/footer');
	}
	/*
		Provides registration details for the user
	*/
	function r()
	{
		//Get the referral data from the SESSION
		if($this->session->userdata('referrer'))
		{
			$referer = $this->session->userdata('referrer');
		}
		
		$product_id = $this->uri->segment(3);
		
		
		
		//Now build the register form
		$this->load->view('cart/header');
		$this->load->view('cart/register');
		$this->load->view('cart/footer');
	}
}

?>