<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Netcarver\Textile;

class Linkwing extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('organization/users_in_branch_model');
		$this->load->model('organization/branch_model');		
		$this->load->model('organization/wing_model');
		$this->load->model('organization/link_wing_model');
		$this->load->model('organization/wings_in_branch_model');

		// Getting all the user groups		
		$this->data['branch_id'] = $this->users_in_branch_model->get_by(array('user_id' => (int)$this->session->userdata('user_id')));
		$this->data['branch'] = $this->branch_model->get_by(array('id' => (int)$this->data['branch_id'][0]->branch_id));
		$this->data['wings'] = array($this->wing_model->get());		
		$this->data['branch_wing'] = array($this->link_wing_model->get_by(array('branch_id' => (int)$this->data['branch_id'][0]->branch_id)));
	}

	public function index()
	{
		if($this->data['can_user_add'] == 1)
		{
			$this->load->view('organization/link/link_branch_wing_add_orb');
		}

		if($this->data['can_user_view'] == 1)
		{
			$this->data['branch_wings'] = array($this->wings_in_branch_model->get_by(array('branch_id' => (int)$this->data['branch_id'][0]->branch_id)));
			$this->load->view('organization/link/link_branch_wing_view_orb', $this->data['branch_wings']);
		}
		$this->load->view('menus/menu_orb_footer');	
	}

	public function add()
	{
		if(count($_POST))
		{			
			/**
			 * Link wing with branch/campus
			**/						
			$data = array(
				'register_by' => (int)$this->session->userdata('user_id'),
				'branch_id' => (int)$this->data['branch_id'][0]->branch_id,
				'wing_id' => $this->input->post('wing')
			);
			
			$id = (int)$this->link_wing_model->save($data);			
			redirect('organization/linkwing');			
		}else{
			redirect('organization/linkwing');
		}
	}
}