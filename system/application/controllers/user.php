<?php
	class User extends Controller
	{
		function __construct()
		{
			parent::Controller();
			$this->load->model('User_model');			
		}
		
		//login page
		function login()
		{
			//if user is not logged in
			if($this->session->userdata('logged_in') == FALSE)
			{
				//if email and pass are not in post data, then load login page
				if(!$this->input->post('user_email') && !$this->input->post('user_pass'))
				{
					$data['title'] = 'Login';
					$data['morecss'] = "<link rel='stylesheet' type='text/css' href='/css/form.css' />";
					$data['pagehead'] = "Login";
					$this->load->view('login',$data);
				}
				//email and pass are in post data, so try login
				else
				{
					//if login successsful
					if($this->simpleloginsecure->login($this->input->post('user_email'),$this->input->post('user_pass')))
					{
						redirect('/');
					}
					
					//if login unsucessful
					else
					{
						$this->messages->add('Login failed: email or password incorrect.','warning');
						$data['title'] = 'Login';
						$data['morecss'] = "<link rel='stylesheet' type='text/css' href='/css/form.css' />";
						$data['pagehead'] = "Login";
						$this->load->view('login', $data);
					}
				}
			}
			else
			{
				$this->messages->add('You are already logged in.','warning');
				redirect('/');
			}
		}
		
		function logout()
		{
			//if user is logged in, then logout
			if($this->session->userdata('logged_in') == TRUE)
			{				
				$this->simpleloginsecure->logout();	
				redirect('/');
			}
			//else if user is not logged in
			else
			{
				$this->messages->add('You are already logged out.','warning');
				redirect('/');
			}
		}
		
		function join()
		{		
			//if email is not in post data, then load login page
			if(!$this->input->post('user_email'))
			{
				$data['title'] = "Join";
				$data['morecss'] = "<link rel='stylesheet' type='text/css' href='/css/form.css' />";
				$data['pagehead'] = "Join txtApps";
				$data['userclass'] = '';
				$this->load->view('register', $data);
			}
			//if email is in post data, validate form information
			else
			{
				//get post data
				$user_email = $this->input->post('user_email');
				$user_pass = $this->input->post('user_pass');
				//remove - and ( and ) from cellnumber 
				$cellnumber = str_replace('-','',$this->input->post('cellnumber'));
				$cellnumber = str_replace('(','',$cellnumber);
				$cellnumber = str_replace(')','',$cellnumber);
				$cellnumber = str_replace(' ','',$cellnumber);

				//validate form info
				
				if($user_email && $user_pass && $cellnumber)
				{
					$this->simpleloginsecure->create($user_email,$user_pass);
					$this->simpleloginsecure->login($user_email,$user_pass);
					
					$this->User_model->add($user_email, $cellnumber,1);
					redirect('/');
				}
				//if form info is invalid
				else
				{
					$this->messages->add('Please fill out all fields correctly.', 'warning');
					$data['title'] = "Join";
					$data['morecss'] = "<link rel='stylesheet' type='text/css' href='/css/form.css' />";
					$data['pagehead'] = "Join txtApps";
					$data['userclass'] = '';
					$this->load->view('register', $data);
				}
			}
		}
	}
?>