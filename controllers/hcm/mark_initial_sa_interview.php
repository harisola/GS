<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Mark_initial_sa_interview extends MY_Controller {

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

			//$this->online['applicant_data'] = array($this->career_form_model->get_by(array('from_unixtime(created) >=' => '2016-01-01', 'mobile_phone !=' => '', 'name !=' => '')));
			$this->online['applicant_data'] = array($this->career_form_model->getDataFor_Handedover('2014-01-01'));
			
			$this->load->view('hcm/career/career_stage1_initial_sa_interview');
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

	        	$now = date('Y-m-d H:i:s');	        	
	        	$table_data = array('handedover_datetime' => human_to_unix($now));
	        	$id = $this->career_form_model->save($table_data, $pk);
	        }
	        //print_r($_POST);
	    } else {
	        header('HTTP 400 Bad Request', true, 400);
	        echo "This field is required!";
	    }
	}
}
