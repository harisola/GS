<?php

class Subject_group extends MY_Controller{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->view();
	}

	public function view()
	{
		//MOdel Load for Selecting data from Table

		$this->load->model('program_group/subject_group_model','sjm');
		$data['table_data']= $this->sjm->get_by('subject_selection_group');

		//MOdel Load for Selecting data from Table

		$this->load->view('program_group/subject_group_table',$data);
		$this->load->view('program_group/subject_group_footer');

	}

}