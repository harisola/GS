<?php 

class Assessment_category_grade extends MY_Controller{

	public function __construct(){
		parent::__construct();
	}

	public function index(){

		$this->load->model('category/assessment_category_grade_mymodel','acgmm');
		$data['grade'] = $this->acgmm->get();

		$this->load->model('category/assessment_category_grade_model','acgm');
		$data['category_grade']=$this->acgm->get_join();


		$data['category'] = $this->acgm->get('atif_assessment.assessment_category');
		

		$this->load->view('category/assessment_category_grade_view',$data);
		$this->load->view('category/Assessment_category_grade_footer');
	}
}