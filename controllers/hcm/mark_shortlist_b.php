<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Mark_shortlist_b extends MY_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->model('hcm/career_form_model');
		$this->load->model('hcm/career_form_uni_model');
		$this->load->model('hcm/career_form_emp_model');
	}

	public function index()
	{
		// if user has rights to edit the applicant data
		if($this->data['can_user_view'] == 1 && $this->data['can_user_edit'] == 1 && $this->data['can_user_delete'] == 0){

			$this->online['applicant_data'] = array($this->career_form_model->get_by(array('shortlist_a' => 1, 'shortlist_b' => 0)));		
			$this->load->view('hcm/career/career_stage1_shortlist_b');
		}

		// Loading footer in the end		
		$this->load->view('hcm/career/career_view_forms_footer');
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
	        $id = $this->career_form_model->save($table_data, $pk);	        

	        if($value != 1){
	        	$table_data = array('applicant_status_alive' => 0);
	        	$id = $this->career_form_model->save($table_data, $pk);
	        }else{
	        	$table_data = array('applicant_status_alive' => 1);
	        	$id = $this->career_form_model->save($table_data, $pk);
	        }
	        //print_r($_POST);
	    } else {
	        header('HTTP 400 Bad Request', true, 400);
	        echo "This field is required!";
	    }
	}
}
