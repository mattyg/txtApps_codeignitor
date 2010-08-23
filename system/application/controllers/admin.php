<?php
	class Admin extends Controller 
	{
		function __construct()
		{
			parent::Controller();
			$this->load->model('User_model');			
			if(!$this->session->userdata('logged_in') || $this->User_model->get_class($this->session->userdata('user_email')) != 3)
			{
				$this->messages->add('You cannot access this page.','warning');
				redirect('/');
			}
		}
		
		//main admin page
		function index()
		{
			$this->load->model('App_model');
			$this->load->model('User_model');
			
			$data['title'] = 'Admin';
			$data['pagehead'] = 'Admin Controls';
			$data['morecss'] = "<link rel='stylesheet' type='text/css' href='/css/data.css' />";
			$data['apps'] = $this->App_model->get_some(15);
			$data['users'] = $this->User_model->get_some(15);

			$this->load->view('adminmain',$data);
		}
		
		//main apps page AND functions for apps/add, apps/remove, apps/edit
		function apps($function='', $page=NULL)
		{
			$this->load->model('App_model');
			//main apps page
			if($function == '' || $function == 'main')
			{
				$data['title'] = 'Admin Apps';
				$data['pagehead'] = 'Admin: apps';
				$data['morecss'] = "<link rel='stylesheet' type='text/css' href='/css/data.css' />";
				if($page != NULL)
				{
					$data['apps'] = $this->App_model->get_all($page);
				}
				else
				{
					$data['apps'] = $this->App_model->get_all();
				}
				
				$this->load->library('pagination');
				$config['base_url'] = site_url('admin/apps/main/');
				$config['total_rows'] = $this->App_model->get_num();
				$config['per_page'] = 15;
				$config['num_links'] = 2;
				$config['uri_segment'] = 4;
				$this->pagination->initialize($config);
				
				$this->load->view('adminapps',$data);
			}
			//add app
			else if($function == 'add')
			{
				//add an app
			}
			//remove app
			else if($function == 'remove')
			{
				$name = $this->input->post('name');
				if($name)
				{
					$this->App_model->remove($name);
					$this->messages->add('app removed sucessfully','success');
					redirect('admin/apps');
				}
				else
				{
					redirect('admin/apps');
				}
			}
			//edit app
			else if($function == 'edit')
			{
				$defaultcommand = $this->input->post('defaultcommand');
				$name = $this->input->post('name');
				if($defaultcommand)
				{
					$this->App_model->edit($name, $defaultcommand);
					$this->messages->add('default command changed sucessfully','success');
					redirect('admin/apps');
				}
				else
				{
					redirect('admin/apps');
				}
			}
			//404 for everything else
			else
			{
				show_404();
			}
		}
		
		//main users page AND functions for users/add, users/remove, users/edit
		function users($function='', $page=NULL)
		{
			
			//main users page
			if($function == '' || $function == 'main')
			{
				$data['title'] = 'Admin Users';
				$data['pagehead'] = 'Admin: users';
				$data['morecss'] = "<link rel='stylesheet' type='text/css' href='/css/data.css' />";
				if($page != NULL)
				{
					$data['users'] = $this->User_model->get_all($page);
				}
				else
				{
					$data['users'] = $this->User_model->get_all();
				}
				
				$this->load->library('pagination');
				$config['base_url'] = site_url('admin/users/main/');
				$config['total_rows'] = $this->User_model->get_num();
				$config['per_page'] = 15;
				$config['num_links'] = 2;
				$config['uri_segment'] = 4;
				$this->pagination->initialize($config);
				
				$this->load->view('adminusers',$data);
			}
			
			
			//remove user
			else if($function == 'remove')
			{
				$email = $this->input->post('user_email');
				if($email)
				{
					$this->User_model->remove($email);
					$this->messages->add('user removed sucessfully','success');
					redirect('admin/users');
				}
				else
				{
					redirect('admin/users');
				}
			}
			
			//edit user CLASS
			else if($function == 'edit')
			{
				$class = $this->input->post('class');
				$email = $this->input->post('user_email');
				if($class)
				{
					$this->User_model->edit($email, $class);
					$this->messages->add('user class changed sucessfully','success');
					redirect('admin/users');
				}
				else
				{
					redirect('admin/users');
				}
			}
			
			//404 for everything else
			else
			{
				show_404();
			}
		}
	}
?>