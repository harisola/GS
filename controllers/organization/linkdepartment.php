<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Netcarver\Textile;

class Linkdepartment extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('organization/users_in_branch_model');
		$this->load->model('organization/branch_model');		
		$this->load->model('organization/department_model');
		$this->load->model('organization/link_department_model');
		$this->load->model('organization/departments_in_branch_model');

		// Getting all the user groups		
		$this->data['branch_id'] = $this->users_in_branch_model->get_by(array('user_id' => (int)$this->session->userdata('user_id')));
		$this->data['branch'] = $this->branch_model->get_by(array('id' => (int)$this->data['branch_id'][0]->branch_id));
		$this->data['departments'] = array($this->department_model->get());		
		$this->data['branch_department'] = array($this->link_department_model->get_by(array('branch_id' => (int)$this->data['branch_id'][0]->branch_id)));
	}

	public function index()
	{
		if($this->data['can_user_add'] == 1)
		{
			$this->load->view('organization/link/link_branch_department_add_orb');
		}

		if($this->data['can_user_view'] == 1)
		{
			$this->data['branch_departments'] = array($this->departments_in_branch_model->get_by(array('branch_id' => (int)$this->data['branch_id'][0]->branch_id)));
			$this->load->view('organization/link/link_branch_department_view_orb', $this->data['branch_departments']);
		}
		$this->load->view('menus/menu_orb_footer');	
	}

	public function add()
	{
		if(count($_POST))
		{			
			/**
			 * Link department with branch/campus
			**/						
			$data = array(
				'register_by' => (int)$this->session->userdata('user_id'),
				'branch_id' => (int)$this->data['branch_id'][0]->branch_id,
				'department_id' => $this->input->post('department')
			);
			
			$id = (int)$this->link_department_model->save($data);			
			redirect('organization/linkdepartment');			
		}else{
			redirect('organization/linkdepartment');
		}
	}
}