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
			
			///$where_type = array("assessment_category.status"=>1, "assessment_type.record_deleted" => 0 );
			//$data['mainCatSub'] = $this->mautocomplete->joinCategories($where_type);
			
			$data['mainCatSub'] = $this->mautocomplete->joinCategorie2();
			$this->load->view( "etab/catType/showShow",$data);
		}
		
		public function getFirstForm(){
			$select = "*";
			$tableName = "assessment_category";
			$where = array( 'status' => 1, "record_deleted" => 0);
			$data['categories'] = $this->mautocomplete->getAll($tableName,$select,$where );
			$this->load->view( "etab/catType/create3",$data);
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
	
	public function create(){
		
		$this->form_validation->set_rules('mainCategory', 'Category', 'required');
		$this->form_validation->set_rules('subCatTitle1', 'Category Name', 'required');
		//$this->form_validation->set_rules('subCatTitle2', 'Category Name', 'required');
		//$this->form_validation->set_rules('subCatTitle3', 'Category Name', 'required');
		//$this->form_validation->set_rules('subCatweightage', 'Category Weightage', 'required');
		//$this->form_validation->set_rules('subDName', 'Category Display Name', 'required');
		//$this->form_validation->set_rules('subSName', 'Category Short Name', 'required');
		
		
		if ($this->form_validation->run() == FALSE){
			echo 3;
		}else{
			
			$mainCategory=$this->input->post('mainCategory');
			$tableName = "assessment_type";
			
			
			/*$catWeightagesum = $this->mautocomplete->countWeightageCat( $mainCategory, $orgweightage );
			
			if( $catWeightagesum["success"] == 2  ){
				$weightage = $catWeightagesum["adjustTotal"];
			}else{
				$weightage = $orgweightage;
			}
			
			$data = array(
				"`ass_category_id`" => $mainCategory,
				"`name`" => $title,
			//	"`dname`" => $catDisplayName,
				//"`sname`" => $catShortName,
				//"`weightage`" => $weightage,
				//"`weightagename`" => $weightage."%",
				"`comments`" => $comments,
				"`created`" => time(),
				"`register_by`" => 1,
				"`modified`" => time(),
				"`modified_by`" => 1,
				"`record_deleted`" => 0
			);*/
			
			for($counter=1;$counter<=5;$counter++):
			
			$title		=	$this->input->post('subCatTitle'.$counter);
			$comments	=	$this->input->post('comments'.$counter);
			
			if( $title != ''){
				$data = array(
					"`ass_category_id`" => $mainCategory,
					"`name`" => $title,
					"`comments`" => $comments,
					"`created`" => time(),
					"`register_by`" => 1,
					"`modified`" => time(),
					"`modified_by`" => 1,
					"`record_deleted`" => 0
				);
				$this->mautocomplete->createCategory( $tableName, $data );
			}
			
			endfor;
			//print_r($catWeightagesum);
			//print_r( $data );
			//exit;
			/*if( $catWeightagesum["success"] == 1 || $catWeightagesum["success"] == 0 ){
				$this->mautocomplete->createCategory( $tableName, $data );
				echo 1;
			}elseif( $catWeightagesum["success"] == 2 ){ 
				$this->mautocomplete->createCategory( $tableName, $data );
				echo 2;
			}elseif( $catWeightagesum["success"] == 3 ){
				echo 3;
			} */
			
			//$this->mautocomplete->createCategory( $tableName, $data );
			echo 1;
			
		} 
		
	} // function create
	
	
	
	public function getSingleCat(){
		
		$ID =$this->uri->segment(4); 
		$where = array('assessment_type.id'=>$ID );
		$data['mainCatSub'] = $this->mautocomplete->joinCategories( $where );
		$select = "*";
		$tableName = "assessment_category";
		$where_where = array( 'status' => 1 );
		$data['categories'] = $this->mautocomplete->getAll($tableName,$select,$where_where );
		//print_r($data);
		$this->load->view( "etab/catType/create2", $data );
	}
	
	
	public function update(){
		
		
		$this->form_validation->set_rules('mainCategory', 'Category', 'required');
		$this->form_validation->set_rules('subCatTitle', 'Category Name', 'required');
		////$this->form_validation->set_rules('subCatweightage', 'Category Weightage', 'required');
		//$this->form_validation->set_rules('subDName', 'Category Display Name', 'required');
		//$this->form_validation->set_rules('subSName', 'Category Short Name', 'required');
		
		
		if ($this->form_validation->run() == FALSE){
			echo 3;
		}else{
			$weightage = 0;
			$ID = $this->input->post('screteID');
			//$screteWeightage = $this->input->post('screteWeightage');
			$mainCategory=$this->input->post('mainCategory');
			$title=$this->input->post('subCatTitle');
			//$orgweightage=$this->input->post('subCatweightage');
			//$catDisplayName=$this->input->post('subDName');
			//$catShortName=$this->input->post('subSName');
			$comments=$this->input->post('comments');
			//$ass_cat_comment=$this->input->post('ass_cat_comment');
			
			
			/*$catWeightagesum = $this->mautocomplete->getWeightage( $mainCategory, $orgweightage,$screteWeightage );
			
			if( $catWeightagesum["success"] == 2  || $catWeightagesum["success"] == 4 ){
				
				$weightage = $catWeightagesum["adjustTotal"];
			}else{
				$weightage = $orgweightage;
			}
			*/
			
			$data = array(
				"`ass_category_id`" => $mainCategory,
				"`name`" => $title,
				//"`dname`" => $catDisplayName,
				//"`sname`" => $catShortName,
				//"`weightage`" => $weightage,
				//"`weightagename`" => $weightage."%",
				"`comments`" => $comments,
				"`register_by`" => 1,
				"`modified`" => time(),
				"`modified_by`" => 1,
				"`record_deleted`" => 0
			);
			$tablename = "assessment_type";
			$where = array("id" => $ID );
			
			$this->mautocomplete->updateTable( $tablename, $data,$where );
				echo 1;
			/*if( $catWeightagesum["success"] == 1 || $catWeightagesum["success"] == 0 ){
				$this->mautocomplete->updateTable( $tablename, $data,$where );
				echo 1;
			}elseif( $catWeightagesum["success"] == 2 ){ 
				$this->mautocomplete->updateTable( $tablename, $data,$where );
				echo 2;
			}elseif( $catWeightagesum["success"] == 3 ){
				//Weightage Greater than 100%
				echo 3;
			}elseif( $catWeightagesum["success"] == 4 ){
				$succes = $this->mautocomplete->updateTable( $tablename, $data,$where );
				echo 1;
			}
			
			*/
			
			
			
		} 
		
		
		
		
	}// end update function
	
	
	public function removeCat(){
		$ID = $this->uri->segment(4); 
		
		//$tablename = "assessment_type";
		//$where =  array("id" => $ID );
		//$succes = $this->mautocomplete->deleteData( $tablename, $where );
		$data = array( "`record_deleted`" => 1 );
		$tablename = "assessment_type";
		$where = array("id" => $ID );
		echo $succes = $this->mautocomplete->updateTable( $tablename, $data,$where );
	}
	
	// Function for getting subcategories of main categories
	public function getSubCat()
	{
		$ID =$this->uri->segment(4); 
		
		$gradeID = $this->input->post('gradeID');
		$programID = $this->input->post('programID');
		$sessionID = $this->input->post('sessionID');
		
		//echo "<br />";
		$termsID = $this->input->post('termsID');
		
		
		$tablename2= "gradesubjectass";
		
		$where2 = array(
			"grade_id" => $gradeID,
			"subject_id" => $programID,
			"assessment_category_id" => $ID,
			"assessment_term_id" => $termsID,
			"academic_session_id" => $sessionID
		);
		$gsAssExists = $this->mautocomplete->getSumWeightage( $tablename2, $where2 );
		$exits = 0;
		
		
		
		
			$tablename = "assessment_type";
			$where = array('assessment_type.ass_category_id'=>$ID, "assessment_type.record_deleted"=>0 );
			//$data['mainCatSub'] = $this->mautocomplete->joinCategories( $where );
			$mainCatSub = $this->mautocomplete->joinCategories( $where );
			
			$where3 = array(
			"sessionID" => $sessionID,
			"gradeID" => $gradeID,
			"subjects" => $programID
			);
			
			//$data['getProgramID'] = $this->mautocomplete->getProgramID( $where3 );
			//$this->load->view( "etab/assForGrades/getSubCat2",$data);
			
			$getProgramID = $this->mautocomplete->getProgramID( $where3 );
			//var_dump( $getProgramID );
			//exit;
			
			$typeHTML = '';
			
			if( $gsAssExists == 0 ){
				$exits = 0;
				
				
			}else{
				$exits = 1;	
				//$typeHTML = $this->getType2();
			}
			$typeHTML = $this->getType( $getProgramID[0]["id"], $mainCatSub  );
		
			$response = array("typeHTML"=>$typeHTML, "exits" => $exits);
			echo json_encode($response);
			//var_dump( $mainCatSub );
		
		
		//print_r( $data );
		//$this->load->view( "etab/assForGrades/getSubCat2",$data);
	}
	
	
	
	public function getType( $programID=NULL, $mainCatSub=NULL ){
		
		$html = '';
		$html .= '<input type="hidden" value="'.$programID.'" name="programSetupID" />';
		$html .= '<table class="table table-striped table-hover margin-0px">';
		$html .= '<thead>';
		$html .= '<tr>';
		$html .= '<th style="text-align:center">Ignore</th>';
		$html .= '<th style="text-align:center">Sub Category</th>';
		$html .= '<th style="text-align:center">Weightage </th>';
		$html .= '</tr>';
		$html .= '</thead>';
		$html .= '<tbody>';
		if(!empty($mainCatSub) ){
		foreach( $mainCatSub as $cat ):
			$html .= '<tr class="subCatRow">';
				$html .= '<td style="text-align:center"> ';
					$html .= '<label for="checkboxes-2" class="checkbox-inline">';
						$html .= '<input class="checkBoxIngore" type="checkbox" value="'.$cat->id.'" id="checkboxes-'.$cat->id.'" name="ignore[]" checked />';
					$html .= '</label>';
				$html .= '</td>';
				$html .= '<td style="text-align:center">';
				$html .= ucwords( strtolower( $cat->name ) );
				$html .= '<input type="hidden" name="subCategory[]" value="'.$cat->id.'" />';
				$html .= '</td>';
				$html .= ' <td>';
					$html .= '<input type="hidden" value="" class="catWeighateHide" name="1" />';
					$html .= '<input type="hidden" value="0" class="blockIDs" />';
					$html .= '<input type="hidden" value="0" class="updateBlockIDs" id="updateBlockIDs"	 />';
					
					$html .= '<input type="hidden" name="assessmentID[]" value="no_data" />';
					$html .= '<label class="select">';
						$html .= '<select name="weightage[]" class="weighateges">';
							$html .= '<option value="0"> Weightage </option>';
							for($counter = 1; $counter <= 100; $counter+= 0.5){
								$html .= '<option value="'.$counter.'">'.$counter.'</option>';
							}
						$html .= '</select>';
					$html .= '<i></i> </label>';
				$html .= '</td>';
			$html .= '</tr>';
		endforeach;
		}else{ 
		$html .= '<tr>';
			$html .= '<td colspan="3">';
				$html .= 'No Record Found!';
				$html .= ' </td>';
			$html .= '</tr>';
		}
		$html .= '</tbody>';
		$html .= '</table>';
		return $html;
	}
	
	
	
	
	
	public function getType2(){
		
		$html = '';
		$html .= '<table class="table table-striped table-hover margin-0px">';
		$html .= '<thead>';
		$html .= '<tr>';
		$html .= '<th style="text-align:center">Ignore</th>';
		$html .= '<th style="text-align:center">Sub Category</th>';
		$html .= '<th style="text-align:center">Weightage </th>';
		$html .= '</tr>';
		$html .= '</thead>';
		$html .= '<tbody>';
	
		$html .= '<tr>';
			$html .= '<td colspan="3">';
				$html .= 'Under Marks Section';
				$html .= ' </td>';
			$html .= '</tr>';
		
		$html .= '</tbody>';
		$html .= '</table>';
		return $html;
	}
	
	
}