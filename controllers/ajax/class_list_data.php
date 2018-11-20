<?php 
Class Class_list_data extends CI_Controller{
	public function __construct(){
		parent::__construct();		
	}

	function index(){		
	}

	function getsuboptions_of_grade($grade_id){
		$this->load->model('class_list/class_list_sr_view_model');
		$suboptions = $this->class_list_sr_view_model->get_all_sections_of($grade_id);

		header('Content-Type: application/x-json; charset=utf-8');
      	echo json_encode($suboptions);
	}
}