<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class School_post_change extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('sis/post_changes_model');
	}

	public function index()
	{		
		$this->data['academic_data'] = $this->post_changes_model->getAcademicSessionData($this->AcademicSessionFrom,$this->AcademicSessionTo);		
		$this->data['section'] = $this->post_changes_model->getSectionList();
		$this->data['house'] = $this->post_changes_model->getHouseList();
		$this->data['status'] = $this->post_changes_model->getStudentStatusList();
		$this->data['student_status'] = $this->post_changes_model->getStudentStatusList2016();
		

		$this->load->view('sis/post_changes/house_section_change_view');
		$this->load->view('sis/post_changes/post_changes_orb_footer');
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
	        $id = $this->post_changes_model->save($table_data, $pk);	        
	        //print_r($_POST);
	    } else {
	        header('HTTP 400 Bad Request', true, 400);
	        echo "This field is required!";
	    }
	}
}