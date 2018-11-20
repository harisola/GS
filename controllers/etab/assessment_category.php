<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Assessment_category extends MY_Controller {	

	public function __construct(){
		parent::__construct();
		
	}
	
	public function index(){
		$this->load->model('autocomplete/mautocomplete');
		$data["categories"] = $this->mautocomplete->getdta(); 
		$data['totalWeightage'] = $this->mautocomplete->countSum(); 
		
	
		
		//var_dump($sum);
		//exit;
		$this->load->view("etab/ass_create_cat",$data);
		$this->load->view("etab/ass_display_cat",$data);
		$this->load->view("etab/footer");
	}
	
	
	public function add(){
		$this->load->view("etab/assement_category");
		$this->load->view("etab/footer");
	}
	
	public function edit(){
		$this->load->view("etab/assement_cat_edit");
		$this->load->view("class_list/face_view/face_view_orb_footer");
	}
	
	
	
	
}