<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Assign_teacher extends MY_Controller{

	function __construct(){
		parent::__construct();
	}

	public function index(){



		$where = array(
		'is_active' => 1,
		);

		$this->load->model('roles/teacher/assign_teacher_mymodel','atm');

		// Get Academic And Grade

		$data['academic']=$this->atm->get_by_academic('_academic_session',$where);

		$data['grade']=$this->atm->get_by_academic('_grade');


		$this->load->view('roles/teacher/assign_teacher_view',$data);
		$this->load->view('roles/teacher/assign_teacher_footer');
	}
}