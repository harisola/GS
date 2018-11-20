<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Assessment_category_type extends MY_Controller {	
	
	public function __construct(){
		parent::__construct();
		$this->load->model('autocomplete/mautocomplete');
	}
	
	public function index(){
		
		$select = "*";
		$tableName = "assessment_category";
		$where = array( 'status' => 1);
		$data['categories'] = $this->mautocomplete->getAll($tableName,$select,$where );
		$data['mainCatSub'] = $this->mautocomplete->joinCategorie2();
		
		
		$this->load->view( "etab/catType/create", $data );
		$this->load->view( "etab/catType/show", $data );
		$this->load->view( "etab/catType/footer" );
		
	}
	
	
	public function add(){
		$this->load->view("etab/assement_category_type");
		$this->load->view("etab/footer");
	}
	
	public function edit(){
		$this->load->view("etab/assement_cat_edit");
		$this->load->view("class_list/face_view/face_view_orb_footer");
	}
	
	
	
	
}