<?php

class Category_grade extends MY_Controller{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->model('assestment/assesment_grade_model');
		$data_view['grade'] = $this->assesment_grade_model->academic_grade();
		

		$this->load->model('assestment/assesment_category_model');
		$data_view['category'] = $this->assesment_category_model->name_select_term('assessment_category');
		
		$this->add();

		$this->load->model('assestment/assesment_category_grade_model');
		$data_view['value'] = $this->assesment_category_grade_model->name_select_term('category_grade');
		$this->load->view('assestment/category_header',$data_view);
		$this->load->view('assestment/category_view');
		$this->load->view('assestment/category_footer');
	}

	public function add()
	{
		
		if(count($_POST))
		{
			$this->load->model('assestment/assesment_category_grade_model');
			$GradeID = $this->input->post('grade_id');
			$CategoryID = $this->input->post('assessment_category_id');
			$Weightage = $this->input->post('weightage');
						
			$data = array(
				'grade_id' => $GradeID,
				'assessment_category_id' => $CategoryID,
				'weightage' => $Weightage,				
			);

			$NewTerm = $this->assesment_category_grade_model->save($data);
		}
	}
	public function edit()
	{
		$pk = $_POST['pk'];
	    $name = $_POST['name'];
	    $value = $_POST['value'];
	    

	    
		$table_data = array(
			$name => $value
		);

		//var_dump($table_data);
		/*
		Check submitted value
		*/
	    if(!empty($value)) {	        
	        $id = $this->getid_term_academic->save($table_data, $pk);	        
	        //print_r($_POST);
	    } else {
	        header('HTTP 400 Bad Request', true, 400);
	        echo "This field is required!";
	    }
	}
}
