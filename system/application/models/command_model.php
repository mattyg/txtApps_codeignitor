<?php
	class Command_model extends Model
	{
		function __construct()
		{
			parent::Model();
			$this->load->database();
		}
		
		//get all commands for a user
		function get_all($email,$page=NULL)
		{
			//get all default commands
			$query = $this->db->get('apps',15,$page);
			$defaults = $query->result_array();
			
			//get user id from email
			$this->db->where('user_email',$email);
			$query = $this->db->get('users');
			$array = $query->result_array();
			$id = $array[0]['user_id'];
			
			//get commands for this user
			$query = $this->db->get('commands',array('userid' => $id));
			$commands = $query->result_array();
			
			$counter=0;
			foreach($defaults as $default)
			{
				foreach($commands as $command)
				if($default['id'] == $command['appid'])
				{
					$defaults[$counter]['defaultcommand'] = $command['command'];
				}
				$counter++;
			}
			return $defaults;
		}
		
		//get some commands for a user
		function get_some($email, $num)
		{
			//get all default commands
			$query = $this->db->get('apps',$num);
			$defaults = $query->result_array();
			
			//get user id from email
			$this->db->where('user_email',$email);
			$query = $this->db->get('users');
			$array = $query->result_array();
			$id = $array[0]['user_id'];
			
			//get commands for this user
			$query = $this->db->get('commands',array('userid' => $id));
			$commands = $query->result_array();
			
			$counter=0;
			foreach($defaults as $default)
			{
				foreach($commands as $command)
				if($default['id'] == $command['appid'])
				{
					$defaults[$counter]['defaultcommand'] = $command['command'];
				}
				$counter++;
			}
			return $defaults;
		}
		//add a custom command for a user
		function add($email,$appid,$command)
		{
			//get user id from email
			$this->db->where('user_email',$email);
			$query = $this->db->get('users');
			$array = $query->result_array();
			$userid = $array[0]['user_id'];
			
			//check if custom command already exists, if so modify command
			$this->db->where('userid',$userid);
			$this->db->where('appid',$appid);
			$query = $this->db->get('commands');
			$res = $query->result_array();
			if(!empty($res))
			{
				$this->db->where('userid',$userid);
				$this->db->where('appid',$appid);
				$this->db->update('commands',array('command' => $command));
			}
			//else add command
			else
			{
				$this->db->insert('commands',array('userid' => $userid, 'appid' => $appid, 'command' => $command));
			}
		}
	}
?>