<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Staff_edit extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('staff/staff_registered_model');
		$this->load->model('staff/staff_title_model');
		$this->load->model('staff/staff_status_model');
		$this->staff_data['staff_title'] = array($this->staff_title_model->get());
		$this->staff_data['staff_status'] = array($this->staff_status_model->get());
	}

	public function index()
	{
		if($this->data['can_user_edit'] == 1){
			$this->staff_data['staff_data'] = array($this->staff_registered_model->get_StaffList_Status());
			$this->load->view('hcm/staff/staff_edit_orb', $this->staff_data['staff_data']);
		}

		$this->load->view('hcm/staff/staff_edit_orb_footer');
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
	        $id = $this->staff_registered_model->save($table_data, $pk);	        
	        //print_r($_POST);
	    } else {
	        header('HTTP 400 Bad Request', true, 400);
	        echo "This field is required!";
	    }
	}

}