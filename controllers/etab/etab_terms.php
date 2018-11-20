<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Etab_terms extends MY_Controller {
	
	public function __construct(){
		parent::__construct();
		
    }
	
	public function index(){
		
		/*$action = $this->input->get();
		if( !empty($action)){
			$this->load->view("etab/etab_terms_add_new");
			$this->load->view("class_list/face_view/face_view_orb_footer");
		}else
			*/
		//$this->load->view("etab/etab_terms");
		//$this->load->view("class_list/face_view/face_view_orb_footer");
		

		$this->load->model('etab/academic/academic_model','AM');
		if( $this->AM->get() ){
			$data['acLists'] = $this->AM->get();
		}else{
			$data['acLists'] = NULL;
		} 
		//var_dump( $data );
		//exit;
		$this->load->view("etab/terms/ass_create_cat",$data);
		$this->load->view("etab/terms/ass_display_cat");
		$this->load->view("etab/terms/footer");
		
		
	}
	
	
	public function add(){
		$this->load->view("etab/etab_terms_add_new");
			$this->load->view("class_list/face_view/face_view_orb_footer");
	}
	
	public function edit(){
		$this->load->view("etab/etab_terms_edit");
			$this->load->view("class_list/face_view/face_view_orb_footer");
	}
	
	
}