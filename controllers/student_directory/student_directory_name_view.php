<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Student_directory_name_view extends MY_Controller {
	public function __construct(){
		parent::__construct();
	}

	public function index()
	{	
		$this->load->model('student_directory/student_directory_model');
		$this->StudentData = $this->student_directory_model->getAllStudentsData();
		
		$this->load->view('student_directory/student_directory_name_view_view');
		$this->load->view('student_directory/student_directory_name_view_orb_footer');
	}
}