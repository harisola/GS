<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Defined_process extends MY_Controller {
	public function __construct(){
		parent::__construct();	
	}

	public function index()
	{
		$this->load->model('process_defined/process_model');
		$this->data['process'] = $this->process_model->get();

		$this->data['css_buttons'] = $this->load->view('css_beautiful/buttons2');
		$this->load->view('process_defined/setup/process_setup_form_orb');
		$this->load->view('process_defined/setup/process_setup_footer_orb');	
	}



	// Process edit by x-ediable
	public function edit()
	{
		$pk = $_POST['pk'];
	    $name = $_POST['name'];
	    $value = $_POST['value'];
	    
		$table_data = array(
			$name => $value
		);
		
		$this->load->model('process_defined/process_model');
	    if(!empty($value)) {	        
	        $id = $this->process_model->save($table_data, $pk);        
	        
	    } else {
	        header('HTTP 400 Bad Request', true, 400);
	        echo "This field is required!";
	    }
	}



	// Process edit by x-ediable
	public function edit2()
	{
		$pk = $_POST['pk'];
	    $name = $_POST['name'];
	    $value = $_POST['value'];
	    
		$table_data = array(
			$name => $value
		);
		
		$this->load->model('process_defined/procedure_task_model');
	    if(!empty($value)) {	        
	        $id = $this->procedure_task_model->save($table_data, $pk);        
	        
	    } else {
	        header('HTTP 400 Bad Request', true, 400);
	        echo "This field is required!";
	    }
	}
}