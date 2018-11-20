<?php 
class Sg_subject extends My_Controller{

	public function index()
	{
		$this->load->model('grade_section/atif_grade');
		$data['grade'] = $this->atif_grade->get();

		$this->load->view('grade_section/select_grade_header',$data);
		$this->load->view('grade_section/select_grade_footer');
	} 
}