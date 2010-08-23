<?php
	class My extends Controller 
	{
		function __construct()
		{
			parent::Controller();
			$this->load->model('User_model');			
			if(!$this->session->userdata('logged_in'))
			{
				$this->messages->add('You cannot access this page.','warning');
				redirect('/');
			}
		}
		
		//main my page
		function index()
		{
			$this->load->model('Command_model');
			
			$data['title'] = 'My Options';
			$data['pagehead'] = 'My Options';
			$data['morecss'] = "<link rel='stylesheet' type='text/css' href='/css/data.css' />";
			$email = $this->session->userdata('user_email');
			$data['cellnumber'] = $this->User_model->get_cell($email);
			
			$data['apps'] = $this->Command_model->get_some($email,15);
			$this->load->view('mymain',$data);
		}
		
		//my apps
		function apps($function='',$page=NULL)
		{
			$this->load->model('Command_model');
			$this->load->model('App_model');
			
			//my apps
			if($function == '' || $function == 'main')
			{
				$data['title'] = 'My Apps';
				$data['pagehead'] = 'My Apps';
				$data['morecss'] = "<link rel='stylesheet' type='text/css' href='/css/data.css' />";
				
				$email = $this->session->userdata('user_email');
				if($page != NULL)
				{
					$data['apps'] = $this->Command_model->get_all($email,$page);
				}
				else
				{
					$data['apps'] = $this->Command_model->get_all($email,$page);
				}
				$this->load->library('pagination');
				$config['base_url'] = site_url('my/apps/main/');
				$config['total_rows'] = $this->App_model->get_num();
				$config['per_page'] = 15;
				$config['num_links'] = 2;
				$config['uri_segment'] = 4;
				$this->pagination->initialize($config);
				
				$this->load->view('myapps',$data);
			}
			//edit my app COMMAND
			else if($function == 'edit')
			{
				$appid = $this->input->post('id');
				$command = $this->input->post('command');
				$email = $this->session->userdata('user_email');
				
				if($command)
				{
					$this->Command_model->add($email,$appid,$command);
					$this->messages->add('Command changed successfully','success');
					redirect('my/apps');
				}
				else
				{
					redirect('my/apps');
				}
			}
			else
			{
				show_404();
			}
		}
		
		//my info
		function info($function='')
		{
			$this->load->model('User_model');
			
			//show my info
			if($function == '' || $function == 'main')
			{
				$data['title'] = 'My Info';
				$data['pagehead'] = 'My Info';
				$data['morecss'] = "<link rel='stylesheet' type='text/css' href='/css/form.css' />";
				
				$email = $this->session->userdata('user_email');
				$data['cellnumber'] = $this->User_model->get_cell($email);
				
				$this->load->view('myinfo',$data);
			}
			//edit my info
			else if($function == 'edit')
			{
				$cellnumber = $this->input->post('cellnumber');
				$email = $this->session->userdata('user_email');
				
				if($cellnumber)
				{
					$this->User_model->edit_cell($email,$cellnumber);
					$this->messages->add('Cell number changed successfully','success');
					redirect('my/info');
				}
				else
				{
					redirect('my/info');
				}
			}
			else
			{
				show_404();
			}
		}
	}
?>