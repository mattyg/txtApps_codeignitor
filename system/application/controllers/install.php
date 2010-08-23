<?php
	class Install extends Controller 
	{
		function __construct()
		{
			parent::Controller();
		}
		function index()
		{
			//adds empty table structures to users database//
			
			$this->db->query("CREATE TABLE `apps` (
			  `id` int(10) NOT NULL AUTO_INCREMENT,
			  `name` varchar(80) NOT NULL,
			  `version` varchar(10) NOT NULL,
			  `description` varchar(500) NOT NULL,
			  `category` varchar(100) NOT NULL,
			  `url` varchar(80) NOT NULL,
			  `defaultcommand` varchar(50) NOT NULL,
			  `privateid` int(10) NOT NULL DEFAULT '0',
			  PRIMARY KEY (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1");

			$this->db->query("CREATE TABLE `commands` (
			  `id` int(10) NOT NULL AUTO_INCREMENT,
			  `userid` int(10) NOT NULL,
			  `appid` int(10) NOT NULL,
			  `command` varchar(50) NOT NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1");

			$this->db->query("CREATE TABLE `users` (
			  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
			  `user_email` varchar(255) NOT NULL DEFAULT '',
			  `user_pass` varchar(60) NOT NULL DEFAULT '',
			  `user_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
			  `user_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
			  `user_last_login` datetime DEFAULT NULL,
			  `cellnumber` int(11) NOT NULL,
			  `class` smallint(1) NOT NULL DEFAULT '1',
			  PRIMARY KEY (`user_id`),
			  UNIQUE KEY `user_email` (`user_email`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");			
			//create new user with admin privledges //
			
				//load login page
			$data['title'] = "Create Admin User";
			$data['morecss'] = "<link rel='stylesheet' type='text/css' href='/css/form.css' />";
			$data['pagehead'] = "Create Admin";
			$data['userclass'] = "<input type='hidden' name='userclass' value='3' />";
			//$this->messages->add("tables 'users', 'apps', and 'commands' have been created in the database.",'sucess');
			$this->load->view('register', $data);
		}
		
		//function to make admin user
		function deputize() {
			//get post data
			$user_email = $this->input->post('user_email');
			$user_pass = $this->input->post('user_pass');
			$userclass = $this->input->post('class');
			//remove - and ( and ) from cellnumber 
			$cellnumber = str_replace('-','',$this->input->post('cellnumber'));
			$cellnumber = str_replace('(','',$cellnumber);
			$cellnumber = str_replace(')','',$cellnumber);
			$cellnumber = str_replace(' ','',$cellnumber);

			//validate form info
			
			if($user_email && $user_pass && $cellnumber && $userclass==3)
			{
				$this->simpleloginsecure->create($user_email,$user_pass);
				$this->simpleloginsecure->login($user_email,$user_pass);
				
				
				$this->load->model('User_model');
				
				$this->User_model->add($user_email, $cellnumber,3);
				echo '<h3>Install Sucessful. <h2>Please delete the file install.php from system/application/controllers/ (it is a security risk)</h2></h3>';
			}
			//if form info is invalid
			else
			{
				$this->messages->add('Please fill out all fields correctly.', 'warning');
				$data['title'] = "Create Admin User";
				$data['morecss'] = "<link rel='stylesheet' type='text/css' href='/css/form.css' />";
				$data['pagehead'] = "Create Admin";
				$data['userclass'] = "<input type='hidden' value='3' />";
				$this->load->view('register', $data);
			}
		}
	}
?>