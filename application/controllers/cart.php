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
		$product_id = $this->uri->segment(3);
		
		$data = array(
			'plan_data' => $this->process_model->get_pack_by_id($product_id),
			'user_id'	=> $this->process_model->get_user_id_by_email($this->session->userdata('email')),
		);
		
		$this->load->view('cart/header', $data);
		$this->load->view('cart/payment');
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
		
		$data = array(
			'plan_data' => $this->process_model->get_pack_by_id($product_id),
		);
		
		//Now build the register form
		$this->load->view('cart/header', $data);
		$this->load->view('cart/register');
		$this->load->view('cart/footer');
	}
	/*
		Registers a user into the site as well as handles the affiliate things
	*/
	function r2()
	{
		//Get the referral data from the SESSION
		if($this->session->userdata('referrer'))
		{
			$referer = $this->session->userdata('referrer');
		}
		
		$this->load->library('form_validation');
		
		//Rules for registration
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|matches[password_confirm]');
		$this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'trim|required');
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');		
		
		// Validate the form data
		if($this->form_validation->run() == FALSE)
		{
			// Form validation failed :/
			$this->session->set_flashdata('key', "Hi");
			redirect('cart/r'."/".$this->uri->segment(3));
		}
		else
		{
			//Register the user and take him to the payment page
			$this->process_model->save_member();
			
			//Now set the username to session
			$this->session->set_userdata(array('email' => $this->input->post('email')));
			
			//Redirect to payment page
			redirect('cart/c'."/".$this->uri->segment(3));
		}
	}
}

?>