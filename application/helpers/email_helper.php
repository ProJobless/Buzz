<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
	Sends the email immediately
*/

function send_now($template_id, $user_id, $vars)
{
	$ci =& get_instance();
	$email_template = $ci->process_model->get_email_template_by_id($template_id);
	
	$ci->load->library('email');
	$ci->load->model('email_model');
	$ci->email->set_newline("\r\n");
	
	$ci->email->from('aayushranaut96@gmail.com', 'Hype Ninja');
	$ci->email->to($ci->process_model->email_by_id($user_id));		
	$ci->email->subject($email_template->subject);		
	$ci->email->message($ci->email_model->process_email_variables($email_template->body, $vars));
	if($ci->email->send())
	{
		//Success
	}
}

/*
	Queues the mail in the database so we can send it later depending on priority
	@params 
		$template_id -> ID of the Email template
		$user_id -> User ID
		$priority -> 1 to 10 depending on urgency
*/
function queue_mail($template_id, $user_id, $priority)
{
	$ci =& get_instance();
	$data = array(
		'template_id'	=> $template_id,
		'user_id'		=> $user_id,
		'priority'		=> $priority
	);
	$ci->db->set($data);
	$ci->db->insert('email_queue');
}