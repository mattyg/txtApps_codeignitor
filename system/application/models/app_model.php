<?php
	class App_model extends Model
	{
		function __construct()
		{
			parent::Model();
			$this->load->database();
		}
		
		//get all apps
		function get_all($page=0)
		{
			$query = $this->db->get('apps',15,$page);
			return $query->result_array();
		}
		
		//get some apps
		function get_some($num)
		{
			$query = $this->db->get('apps',$num);
			return $query->result_array();
		}
		
		//get number of apps
		function get_num()
		{
			return $this->db->count_all('apps');
		}
		
		//remove an app
		function remove($name)
		{
			$query = $this->db->delete('apps', array('name' => $name));
		}
		
		//edit default command of an app
		function edit($name, $command)
		{
			$this->db->where('name',$name);
			$this->db->update('apps', array('defaultcommand' => $command));
			
		}
	}
?>