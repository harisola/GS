<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Org_department extends MY_Controller{

	public function index(){


		$this->load->model('roles/org_department_model','ODM');
		// $data['org_domain'] = $this->ODM->get_by('role_type');

		// Inner Join 
		$select = 'rt.id,rt.name,rt.dname,rt.sname,rt.code,rd.name as domain_name,rt.color_hex,rt.position';
		$table_one = 'role_type as rt';
		$table_two = 'role_domain as rd';
		$on = 'rt.domainID = rd.id';
		$data['org_domain'] = $this->ODM->inn_join($table_one,$table_two,$on,$select);

		$data['org_domain_table'] = $this->ODM->get_by('role_domain');
		// var_dump($data['inner_join']);
		// exit;




		$this->load->view('roles/org_department_form',$data);
		//$this->load->view('roles/org_domain_table');
		$this->load->view('roles/org_department_footer');
	}

}