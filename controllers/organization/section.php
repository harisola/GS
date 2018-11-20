<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Netcarver\Textile;

class Section extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('organization/section_model');
		$this->data['section'] = $this->section_model->get();	
	}

	public function index()
	{
		if($this->data['can_user_add'] == 1)
		{
			$this->load->view('organization/section/section_add_new_orb');
		}
		if($this->data['can_user_edit'] == 1)
		{			
			$this->load->view('organization/section/section_view_existing_orb', $this->data['section']);
		}
		$this->load->view('menus/menu_orb_footer');	
	}

	public function add()
	{		
		if(count($_POST))
		{			
			/**
			 * Insert user and branch to branch_user
			**/	
			$this->form_validation->set_rules($this->section_model->validation);

			if($this->form_validation->run() == TRUE)
			{		
				$data = array(
					'register_by' => (int)$this->session->userdata('user_id'),
					'name' => $this->input->post('section_name'),
					'dname' => $this->input->post('section_display_name'),
					'gender' => $this->input->post('gender')
				);
				
				$id = (int)$this->section_model->save($data);			
				redirect('organization/section');
			}else{
				$this->load->view('organization/section/section_add_new_orb');
				$this->load->view('organization/section/section_view_existing_orb');
			}
		}else{
			redirect('organization/section');
		}
	}

	public function edit()
	{
		$pk = $_POST['pk'];
	    $name = $_POST['name'];
	    $value = $_POST['value'];
	    
    	/*
	     Check submitted value
	    */
	    $table_data = array(
	    	$name => $value
    	);

	    if(!empty($value)) {	        
	        $id = $this->section_model->save($table_data, $pk);	        
	        //print_r($_POST);
	    } else {
	        header('HTTP 400 Bad Request', true, 400);
	        echo "This field is required!";
	    }
	}
}