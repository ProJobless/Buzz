<?php

class Home extends CI_Controller
{
	//Our homepage
	function index()
	{
		//Just a plain echo for now
		$this->load->view('main/header');
		$this->load->view('main/home');
		$this->load->view('main/footer');
	}
}