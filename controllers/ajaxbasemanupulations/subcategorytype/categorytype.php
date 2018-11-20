<?php
class Categorytype extends CI_Controller{
	
	/*
		* This controller functionality is to manage sub category
		* like pratical, quiz, assignment, class work.
	*/
	
    function __construct() {
		parent::__construct();
		$this->load->model('autocomplete/mautocomplete');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
	}
	
	/*
		===================================================
			Get Sub Category
			Like Quiz,Class Work, Pratical
		===================================================
	*/
		public function get(){
			$table = "";
			$columns = "*";
			//$data["categories"] = $this->mautocomplete->getAll( $table,$columns );
			$data['mainCatSub'] = $this->mautocomplete->joinCategories();
			$this->load->view( "etab/catType/showShow",$data);
		}
	/*
		==============  End Function ======================
	*/
	
		
	/*
		====================================================
		 Create sub category ( practical, assignment, quiz), 
		 of main category like Formative, Summative, ASP
		==================================================== 
	*/
	
	public function createKashif(){
		
		echo 1;
		/*$this->form_validation->set_rules('mainCategory', 'Category', 'required');
		$this->form_validation->set_rules('subCatTitle', 'Category Name', 'required');
		$this->form_validation->set_rules('subCatweightage', 'Category Weightage', 'required');
		$this->form_validation->set_rules('subDName', 'Category Display Name', 'required');
		$this->form_validation->set_rules('subSName', 'Category Short Name', 'required');
		
		
		if ($this->form_validation->run() == FALSE){
			echo 3;
		}else{
			
			$mainCategory=$this->input->post(mainCategory);
			$title=$this->input->post('subCatTitle');
			$weightage=$this->input->post('subCatweightage');
			$catDisplayName=$this->input->post('subDName');
			$catShortName=$this->input->post('subSName');
			$comments=$this->input->post('comments');
			$ass_cat_comment=$this->input->post('ass_cat_comment');
			$data = array(
				"`ass_category_id`" => $mainCategory,
				"`name`" => $title,
				"`dname`" => $catDisplayName,
				"`sname`" => $catShortName,
				"`weightage`" => $weightage,
				"`weightagename`" => $weightage."%",
				"`comments`" => $comments,
				"`created`" => time(),
				"`register_by`" => 1,
				"`modified`" => time(),
				"`modified_by`" => 1,
				"`record_deleted`" => 0
			);
			$tableName = "assessment_type";
			$succes = $this->mautocomplete->createCategory( $tableName, $data );
			//if( $succes ){ echo $succes; }else echo 0;
			
		} */
		
	} // function create
	
	
	
	
	
}