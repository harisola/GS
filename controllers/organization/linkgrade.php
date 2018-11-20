<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Netcarver\Textile;

class Linkgrade extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('organization/wing_model');
		$this->load->model('organization/grade_model');
		$this->data['wings'] = $this->wing_model->get();
		$this->data['grades'] = $this->grade_model->get();

		$this->load->model('organization/users_in_branch_model');
		$this->load->model('organization/branch_model');
		$this->data['branch_id'] = $this->users_in_branch_model->get_by(array('user_id' => (int)$this->session->userdata('user_id')));
		$this->data['branch'] = $this->branch_model->get_by(array('id' => (int)$this->data['branch_id'][0]->branch_id));

		$this->load->model('organization/Link_wing_grade_model');

		$this->load->model('organization/branch_wing_grade_model');
		$this->data['branch_wing_grade'] = $this->branch_wing_grade_model->get_by(array('branch_id' => (int)$this->data['branch_id'][0]->branch_id));
	}

	public function index()
	{
		if($this->data['can_user_add'] == 1)
		{
			$this->load->view('organization/link/link_wing_grade_add_orb');
		}
		if($this->data['can_user_view'] == 1)
		{			
			$this->load->view('organization/link/link_wing_grade_view_orb');
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
			$data = array(
				'register_by' => (int)$this->session->userdata('user_id'),
				'branch_id' => (int)$this->data['branch_id'][0]->branch_id,
				'wing_id' => (int)($this->input->post('wing')),
				'grade_id' => $this->input->post('grade')
			);
			
			$id = (int)$this->Link_wing_grade_model->save($data);			
			redirect('organization/linkgrade');
		}else{
			redirect('organization/linkgrade');
		}
	}
}