<?php

class Buzz_model extends CI_Model
{
	function getCampaignData()
	{
		//Id of the campaign
		$id = $this->uri->segment(4);
		$query = $this->db->get_where('campaigns', array('user_id' => 1, 'id' => $id));
		
		//Now we parse the data
		$data = array();
		foreach($query->result() as $r)
		{
			$data[] = $r;
		}
		return $data;
	}
	function parse_twitter($content, $keyword)
	{
		foreach($content as $c)
		{
			foreach($c as $q)
			{
				$data = array(
					'tweet'		=> $q->text,
					'timestamp'	=> strtotime($q->created_at),
					'keyword'	=> $keyword,
					'profile_image'	=> $q->					
				);
			}
		}
	}
}