<?php
	
class Login extends CI_Controller
{
	function index()
	{
		if($this->session->userdata('l') == 1)
		{
			//User has logged in
			redirect('headquarters/dashboard');
		}
		$data = array(
			'meta_description' 	=> 'Login page for Hype Ninja',
			'meta_keywords'		=> 'login, hype ninja, marketing, promotion, social networks',
			'title'				=> 'Client Login - Hype Ninja',
			'error'				=> "",
		);
			
		$this->load->view('login/login', $data);
	}
	function submit()
	{
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));
		
		$query = $this->db->get_where('users', array('username' => $username, 'password' => $password));
		if($query->num_rows() == 1)
		{
			foreach($query->result() as $q)
			{
				$id = $q->id;
				$username = $q->username;
			}
			$data = array(
				'user_id'=> $id,
				'u'		=> $username,
				'l'		=> 1,
			);
			$this->session->set_userdata($data);
			redirect('headquarters/dashboard');
		}
		else
		{
			$data = array(
				'meta_description' 	=> 'Login page for Hype Ninja',
				'meta_keywords'		=> 'login, hype ninja, marketing, promotion, social networks',
				'title'				=> 'Client Login - Hype Ninja',
				'error'				=> "Incorrect Username/Password!",
			);
			
			$this->load->view('login/login', $data);
		}
	}
	//Logs out the user
	function logout()
	{
		//Destroys the session
		$this->session->sess_destroy();
		redirect('/');
	}
}