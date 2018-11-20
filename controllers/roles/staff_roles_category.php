<?php

defined('BASEPATH') or exit('No direct data access allowed');

class Staff_roles_category extends MY_Controller{

	public function index(){

		//======================//
		//    Load Model       //
		//====================// 
		$this->load->model('roles/staff_roles_category_model','ODM');
		$data['org_domain'] = $this->ODM->get_by('role_category');

		//=================//
		// 	Load View      //
		//=================//

		$this->load->view('roles/staff_roles_category_form',$data);
		$this->load->view('roles/staff_roles_category_footer');

	}
}