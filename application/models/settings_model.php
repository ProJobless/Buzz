<?php

class Settings_Model extends CI_Model
{
	/*
		This gets all the settings for a particular user who has registered.
	*/
	function get_settings()
	{
		$query = $this->db->get_where('settings', array('id' => $this->session->userdata('user_id')));
		$data = array();
		foreach($query->result() as $r)
		{
			$data[] = $r;
		}
		return $data;
	}
	/*
		fetches all the twitter account for a user
	*/
	function get_twitter_accounts()
	{
		$query = $this->db->get_where('twitter_accounts', array('user_id' => $this->session->userdata('user_id')));
		$data = array();
		foreach($query->result() as $r)
		{
			$data[] = $r;
		}
		return $data;
	}
	/*
		This will delete the twitter account of a particular user passed in param
	*/	
	function delete_twitter()
	{
		$query = $this->db->get_where('twitter_accounts', array('id' => $this->uri->segment(5), 'user_id' => $this->session->userdata('user_id')));
		$i_count = $query->num_rows();
		if($i_count > 0)
		{
			//$this->db->delete('twitter_accounts', array('id' => $this->uri->segment(5), 'user_id' => $this->session->userdata('user_id')));
			$query = $this->db->get_where('twitter_accounts', array('id' => $this->uri->segment(5), 'user_id' => $this->session->userdata('user_id')));
			if($query->num_rows() <= $i_count)
			{
				//Now we need to remove that account from the campaign
				$qu = $this->db->get_where('campaigns', array('user_id' => $this->session->userdata('user_id')));
				foreach($qu->result() as $t)
				{
					if(strpos($t->twitter_id, ','.$this->uri->segment(5)) !== false)
					{
						//Found match ,{$id}
						echo "1";
						$new = str_replace(',"'.$this->uri->segment(5).'"', "", $t->twitter_id);
						$data = array(
							'twitter_id' => $new
						);
						echo $new;
						$this->db->where('id', $t->id);
						$this->db->update('campaigns',$data);
					}
					else if(strpos($t->twitter_id, $this->uri->segment(5).'",') !== false)
					{
						echo "2";
						//Found match {$id},
						$new = str_replace('"'.$this->uri->segment(5).'",', "", $t->twitter_id);
						$data = array(
							'twitter_id' => $new
						);
						echo $new;
						$this->db->where('id', $t->id);
						$this->db->update('campaigns',$data);
					}
					else if(strpos($t->twitter_id, '["'.$this->uri->segment(5).'"]') !== false)
					{
						echo "3";
						//Found match : [{$id}]
						$new = str_replace('["'.$this->uri->segment(5).'"]', "", $t->twitter_id);
						$data = array(
							'twitter_id' => $new
						);
						echo $new;
						$this->db->where('id', $t->id);
						$this->db->update('campaigns',$data);
					}
					echo "Yes";
				}					
				//Success
				echo "deleted";
			}
			else
			{
				//Some error occured
				echo "error";
			}
		}
		else
		{
			//Did not find any specified accounts
			echo "error";
		}
	}
}