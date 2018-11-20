<?php 

class Assessment_grade extends MY_Controller{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		//Grade
		$this->load->model('category/category_grade');
		$data['grade'] = $this->category_grade->get();
		
		//Category
		$this->load->model('category/category_term');
		$data['category'] = $this->category_term->term('assessment_category');
		

		// $this->load->view('category/category_header',$data);
		$this->load->view('category/category_form',$data);

		
		//Model OF Getting the Table Data
		$this->load->model('category/category_term');
		$data['category_detail']=$this->category_term->get_table();
	
		$this->load->view('category/category_table',$data);
		$this->load->view('category/category_footer');
	}
}