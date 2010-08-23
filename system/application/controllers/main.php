<?php
	class Main extends Controller
	{
		function __construct()
		{
			parent::Controller();
		}
		function index()
		{
			$data['title'] = 'Main';
			$this->load->view('main',$data);
		}
	}
?>