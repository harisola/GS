<?php
class Autocomplete extends CI_Controller{
	
    function __construct() {
		parent::__construct();
		
		$this->load->model('autocomplete/mautocomplete');
		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
	}
        
	public function createCategory(){
		
		$this->form_validation->set_rules('ass_cat_title', 'Category Title', 'required');
		$this->form_validation->set_rules('catDisplayName', 'Category Display Name', 'required');
		$this->form_validation->set_rules('catShortName', 'Category Short Name', 'required');
		$this->form_validation->set_rules('ass_cat_weightage', 'Category Weightage', 'required');
		
		if ($this->form_validation->run() == FALSE){
			echo 3;
			//$this->load->view('myform');
		}else{
			
			$title=$this->input->post('ass_cat_title');
			//echo "<br />";
			$catDisplayName=$this->input->post('catDisplayName');
			//echo "<br />";
			$catShortName=$this->input->post('catShortName');
			//	echo "<br />";
			$ass_cat_weightage=$this->input->post('ass_cat_weightage');
			//echo "<br />";
			$ass_cat_comment=$this->input->post('ass_cat_comment');
			//echo "<br />";
			$data = array(
				"`name`" => $title,
				"`dname`" => $catDisplayName,
				"`sname`" => $catShortName,
				"`weightage`" => $ass_cat_weightage,
				"`weightagename`" => $ass_cat_weightage."%",
				"`comments`" => $ass_cat_comment,
				"`created`" => time(),
				"`register_by`" => 1,
				"`modified`" => time(),
				"`modified_by`" => 1,
				"`record_deleted`" => 0
			);
			$data_data = array(
				"name" => $title,
				"dname" => $catDisplayName,
				"sname" => $catShortName,
				"weightage" => $ass_cat_weightage,
				"weightagename" => $ass_cat_weightage."%",
				"comments" => $ass_cat_comment
				
			);
			$tablename = "`assessment_category`";
			$succes = $this->mautocomplete->createCategory( $tablename, $data );
			if( $succes ){
				echo $succes;
				//echo $output = json_encode( $data_data );
				//return $output;
			}else
				echo 0;
			
			
			//$this->load->view('formsuccess');
		}
	}
	
	// ------------------------------------------------------------------
	// 			Function update Category like Formative, Summative, ASP
	// ------------------------------------------------------------------
	
	public function updateCategory(){
		$this->form_validation->set_rules('screteID', 'Secrete ID Missing', 'required');
		$this->form_validation->set_rules('ass_cat_title', 'Category Title', 'required');
		$this->form_validation->set_rules('catDisplayName', 'Category Display Name', 'required');
		$this->form_validation->set_rules('catShortName', 'Category Short Name', 'required');
		$this->form_validation->set_rules('ass_cat_weightage', 'Category Weightage', 'required');
		if ($this->form_validation->run() == FALSE){
			echo 3;
		}else{
			
			$ID = $this->input->post('screteID');
			$title=$this->input->post('ass_cat_title');
			$catDisplayName=$this->input->post('catDisplayName');
			$catShortName=$this->input->post('catShortName');
			$ass_cat_weightage=$this->input->post('ass_cat_weightage');
			$ass_cat_comment=$this->input->post('ass_cat_comment');
			
			$data = array(
				"`name`" => $title,
				"`dname`" => $catDisplayName,
				"`sname`" => $catShortName,
				"`weightage`" => $ass_cat_weightage,
				"`weightagename`" => $ass_cat_weightage."%",
				"`comments`" => $ass_cat_comment,
				"`created`" => time(),
				"`register_by`" => 1,
				"`modified`" => time(),
				"`modified_by`" => 1,
				"`record_deleted`" => 0
			);
			$tablename="assessment_category";
			$where = array("id" => $ID );
			
			$succes = $this->mautocomplete->updateTable( $tablename, $data,$where );
			if( $succes ){
				echo $succes;
			}else
				echo 0;
		}
	}
	
	// ------------------------------------------------------------------
	public function getCreatedCategories(){
		$data["categories"] = $this->mautocomplete->getdta();  
		$this->load->view("etab/ass_display_cat2", $data );
	}
	
	// ------------------------------------------------------------------
	public function getCreatedCategories2(){
		
		$data['totalWeightage'] = $this->mautocomplete->countSum(); 
		
		$this->load->view("etab/ass_create_cat3",$data );
	}
	
	
	public function getSingleCat(){
		$ID =$this->uri->segment(4); 
		$select = "*";
		$tableName = "assessment_category";
		$where = array('id'=>$ID , 'status' => 1 );
		//$category = $this->mautocomplete->getAll($tableName,$select,$where  ); 
		$data["singleCat"] = $this->mautocomplete->getRow($tableName,$select,$where  ); 
		$data['totalWeightage'] = $this->mautocomplete->countSum(); 
		$this->load->view("etab/ass_create_cat2",$data);
	}
	
	public function removeCat(){
		$ID = $this->uri->segment(4); 
		$tablename = "assessment_category";
		$data =   array( "`sname`" => $ID,"`status`" => 0 );
		$where =  array("id" => $ID );
		$succes = $this->mautocomplete->updateTable( $tablename, $data, $where );
	}
	public function countWeighate(){
		$this->load->model('autocomplete/mautocomplete','MA');
		$weightage = $this->input->post('checkUsername');
		echo $totalWeightage = $this->MA->countSum();
		
	}
}
?>