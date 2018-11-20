<?php

class Assestment_term_update extends MY_Controller{
	public function __construct()
	{
		parent::__construct();
		
		
	}
	public function index()
	{
		$this->load->view('assestment/assestment_update');
	}
}