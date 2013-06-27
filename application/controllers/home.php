<?php

class Home extends CI_Controller
{
	//Our homepage
	function index()
	{
		
		$this->load->view('main/header');
		$this->load->view('main/home');
		$this->load->view('main/footer');
	}
}