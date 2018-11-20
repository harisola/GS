<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Org_domain extends MY_Controller{

	public function index(){

		$this->load->model('roles/org_domain_model','ODM');
		$data['org_domain'] = $this->ODM->get_by('role_domain');



		$this->load->view('roles/org_domain_form',$data);
		//$this->load->view('roles/org_domain_table');
		$this->load->view('roles/org_domain_footer');
	}



} 
	
