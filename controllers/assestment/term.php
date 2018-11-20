<?php

class Term extends MY_Controller{
	function __construct()
	{
		parent::__construct();
		$this->load->model('assestment/assessment_term');

	}
	public function index()
	{	
	
		$this->viewit();
			
	}

	public function viewit()
	{
		$data_select['query']=$this->assessment_term->select('assessment_term');
		$this->load->view('assestment/assestment_term');
		$this->load->view('assestment/assestment_table',$data_select);
		$this->load->view('assestment/assestment_footer');
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
	        $id = $this->assessment_term->save($table_data, $pk);	        
	        //print_r($_POST);
	    } else {
	        header('HTTP 400 Bad Request', true, 400);
	        echo "This field is required!";
	    }
	}


	
}