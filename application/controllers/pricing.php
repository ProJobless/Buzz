<?php

class Pricing extends CI_Controller
{
	function index()
	{		
		$this->load->library('email');
		$this->email->set_newline("\r\n");
		
		$this->email->from('aayushranaut96@gmail.com', 'Hype Ninja');
		$this->email->to('aayush.ranaut@gmail.com');		
		$this->email->subject('This is an email test');		
		$this->email->message('It is working. Great!');
		
		if($this->email->send())
		{
			echo 'Your email was sent, fool.';
		}		
	}
}