<?php 

class Org_chart extends MY_Controller{
	
	public function index(){

		$this->load->model('roles/org_chart_model','ocm');
		$data['all_roles'] = $this->ocm->get_by();

		// var_dump($data['all_roles']);
		// exit;

	
		// exit;
		
		// $data['role'] = $this->role_new_org_model->get();


		// $this->load->model('roles/org_chart_model','ocm');
		// $data['check'] = $this->ocm->get_org_role();

		// var_dump($data['check']);
		// exit;



		$this->load->view('roles/org_chart_view',$data);
		// $this->load->view('roles/org_chart_footer');

	}
}