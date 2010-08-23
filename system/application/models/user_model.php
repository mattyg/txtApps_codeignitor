<?php
	class User_model extends Model
	{
		function __construct()
		{
			parent::Model();
			$this->load->database();
		}
		
		//get all users
		function get_all($page=0)
		{
			//$query = $this->db->query("SELECT * FROM users");
			$query = $this->db->get('users',15,$page);
			return $query->result_array();
		}
		
		//get number of users
		function get_num()
		{
			return $this->db->count_all('users');
		}
		
		//get some users
		function get_some($num)
		{
			$query = $this->db->get('users',$num);
			return $query->result_array();
		}
		
		//remove a user
		function remove($email)
		{
			$this->db->delete('users', array('user_email' => $email));
		}
		
		//edit user CLASS
		function edit($email, $class)
		{
			$this->db->where('user_email',$email);
			$this->db->update('users',array('class' => $class));
		}
	
		//edit user CELL NUMBER
		function edit_cell($email, $cellnumber)
		{
			$this->db->where('user_email',$email);
			$this->db->update('users', array('cellnumber' => $cellnumber));
			
		}
		
		//get user cell number
		function get_cell($email)
		{
			$this->db->where('user_email',$email);
			$result = $this->db->get('users');
			$a = $result->result_array();
			return $a[0]['cellnumber'];
		}
		
		//add a user (AFTER it has been created by SimpleLoginSecure)
		function add($email,$cellnumber,$class=1)
		{
			$query = $this->db->query("UPDATE users SET cellnumber=\"$cellnumber\", class=\"$class\" WHERE user_email=\"$email\"");
			return $query;
		}
		
		//get user class of user with email $email
		function get_class($email)
		{
			$query = $this->db->query("SELECT class FROM users WHERE user_email=\"$email\"");
			foreach($query->result() as $q)
			{
				return $q->class;
			}
		}
		
		function get_id($email)
		{
			$query = $this->db->get('users',array('user_email' => $email));
			foreach($query->result() as $q)
			{
				return $q->id;
			}
		}
	}
?>