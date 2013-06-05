<?php 
/*
	This page will display all the buzzing around and user can come here and comment, blah blah
*/
class Buzz extends CI_Controller
{
	function index()
	{
		//Loading the model to get data and stuff
		$this->load->model('buzz_model', 'buzz');
		//Get the data for the current campaign selected in URL
		$campaign_data = $this->buzz->getCampaignData();
		//Loading the twitter Oauth Library
		
		//Formatting data to be sent to the views
		$data = array(
			'title' 	=> 'Manage Campaign - Buzzzzzz',
			'heading'	=> $campaign_data[0]->name,
			'meta_description'	=> 'Campaign for Buzzzzzz',
			'meta_keywords'		=> 'SEO, Social, Blah blah',
			'active'	=> 'dashboard',
			'campaign_data'	=> $campaign_data
		);
		$this->load->view('headquarters/header', $data);
		$this->load->view('headquarters/sidebar');
		$this->load->view('headquarters/buzz');
		
	}
}