<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Assessment extends MY_Controller {	
	
	public function __construct(){
		parent::__construct();
		
    }
	
	public function index(){
		$this->load->view("etab/assessment");
		$this->load->view("class_list/face_view/face_view_orb_footer");
	}
	
	
	public function add(){
		//$this->load->view("etab/etab_terms_add_new");
		//$this->load->view("class_list/face_view/face_view_orb_footer");
	}
	
	public function edit(){
		//$this->load->view("etab/etab_terms_edit");
		//$this->load->view("class_list/face_view/face_view_orb_footer");
	}
	
	
}