<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class AssGrade extends CI_Controller{
	
	 function __construct() {
		parent::__construct();
		//$this->load->model('autocomplete/mautocomplete');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
	}
	
	public function edit(){
		$this->load->model('autocomplete/mautocomplete');
		$select = "*";
		$tableName = "assessment_category";
		$where = array( 'status' => 1 );
		$data['categories'] = $this->mautocomplete->getAll($tableName,$select,$where );
		$this->load->model('autocomplete/anotherdb_model');
		$data['grades'] = $this->anotherdb_model->getSomething();
		$this->load->view("etab/assForGrades/ass_create2",$data );
	}
	
	public function edit2(){
	
	$categoryID = $this->input->post('categoryID');
	$grade_id = $this->input->post('grade_id');
	$sub_ID = $this->input->post('sub_ID');
	$sessionID = $this->input->post('sessionID');
	$termID = $this->input->post('termID');
	$this->load->model('autocomplete/mautocomplete');
	$select = "*";
	$tableName = "gradesubjectass";
	$where = array( 'grade_id' => $grade_id,'subject_id' => $sub_ID,'assessment_category_id' => $categoryID,'assessment_term_id' => $termID,'academic_session_id' => $sessionID, );
	$data['assessment'] = $this->mautocomplete->getAll($tableName,$select,$where );
	
	
	$where2 = array( 'ass_category_id' => $categoryID,"record_deleted"=>0 );
	$select2 = "id,name";
	$tableName2 = "assessment_type";
	$data['assessmentType'] = $this->mautocomplete->getAll($tableName2, $select2, $where2 );
	
	$where3 = array( 'grds.grade_id' => $grade_id,'grds.subject_id' => $sub_ID,'grds.assessment_category_id' => $categoryID,'grds.assessment_term_id' => $termID,'grds.academic_session_id' => $sessionID, );
	$data['assessmentType2'] = $this->mautocomplete->joinAssTypeAssessment($where3);
	
	
	
	
		$this->load->model('autocomplete/mautocomplete');
		$select = "*";
		$tableName = "assessment_category";
		$where = array( 'status' => 1 );
		$data['categories'] = $this->mautocomplete->getAll($tableName,$select,$where );
		$this->load->model('autocomplete/anotherdb_model');
		$data['grades'] = $this->anotherdb_model->getSomething();
		
		$where2 = array('grade_id' => $grade_id );
		$this->load->model('autocomplete/grade_section/atif_grade');
		$data['subjects'] = $this->atif_grade->getAllProgramsOfGrade( $grade_id );
		//print_r( $data['subjects'] );
		$this->load->view("etab/assForGrades/ass_create2",$data );
		
	}
	
	public function getAssessment(){
		
		$session = $this->input->post('as');
		$sessionTerm = $this->input->post('ast');
		$grdName = $this->input->post('grdn');
		$grdSub = $this->input->post('grdSub');
		$mCat = $this->input->post('mcat');
		
		$tableC = 'gradesubjectass';
		
		$this->load->model('autocomplete/mautocomplete');
		$select = "id,name";
		$tableName = "assessment_category";
		//$where = array( 'id' =>  $mCat );
		$where = array( 'status' => 1 );
		
		$categories = $this->mautocomplete->getAll($tableName,$select,$where );
		$data['categories'] = $categories;
		
		
		$select = "id,name";
		$tableName = "assessment_type";
		$where = array( 'ass_category_id' =>  $mCat,"record_deleted"=>0 );
		$data['categoryTypes'] = $this->mautocomplete->getAll($tableName,$select,$where );
		
		
		$select = "a.name,a.id,b.weightage";
		
		$ddname = true;
		foreach( $categories AS $cat ){
			
			if( $ddname ){
				
			$where2 = array(
			'b.grade_id' => $grdName,
			'b.subject_id' => $grdSub,
			//'b.assessment_category_id' => $mCat,
			'b.assessment_category_id' => $cat->id,
			'b.assessment_term_id' => $sessionTerm,
			'b.academic_session_id' => $session,
			'b.weightage > ' => 0,
			'b.record_deleted' => 0
			);
			
			$data['formmative'] = $this->mautocomplete->getAssessment( $select, $where2 );
			$ddname = false;
			
			}else{
			
			$where2 = array(
			'b.grade_id' => $grdName,
			'b.subject_id' => $grdSub,
			//'b.assessment_category_id' => $mCat,
			'b.assessment_category_id' => $cat->id,
			'b.assessment_term_id' => $sessionTerm,
			'b.academic_session_id' => $session,
			'b.weightage > ' => 0,
			'b.record_deleted' => 0
			);
			$data['summative'] = $this->mautocomplete->getAssessment( $select, $where2 );
			}
			
			
		}
	
		
		
		
		/*$where4 = array(
			'b.grade_id' => $grdName,
			'b.subject_id' => $grdSub,
			'b.assessment_category_id' => 17,
			'b.assessment_term_id' => $sessionTerm,
			'b.academic_session_id' => $session,
			'b.weightage > ' => 0,
			'b.record_deleted' => 0
		);
		
		$data['summative'] = $this->mautocomplete->getAssessment( $select, $where4 ); */
		
		$where3 = array( 'id' => $grdSub);
		$data["subject"] = $this->mautocomplete->getSubject2( $where3 );
		
		
		$this->load->model('autocomplete/anotherdb_model');
		$select = "id,name";
		$tableName = "_grade";
		$where = array( 'id' =>  $grdName );
		$data['grade'] = $this->anotherdb_model->getGrade( $select, $where );
		
		
		
		$data["session"] =  $session;
		$data["sessionTerm"] = $sessionTerm;
		
		
		$data["editingData"] = array("session"=> $session, "term" => $sessionTerm, "grade" => $grdName, "subject" => $grdSub, "category" => $mCat );
		
	
		
		//print_r($data);
		$this->load->view("etab/assForGrades/ass_display_cat_type2",$data);
	}
	
	
	
	public function createAssessment(){
		
		$this->form_validation->set_rules('academicSession', 'academicSession', 'required');
		$this->form_validation->set_rules('academicSessionTerm', 'academicSessionTerm', 'required');
		$this->form_validation->set_rules('gradeName', 'gradeName', 'required');
		$this->form_validation->set_rules('gradeSubject', 'gradeSubject', 'required');
		$this->form_validation->set_rules('mainCategory', 'mainCategory', 'required');
		//$this->form_validation->set_rules('subCategory[]', 'mainCategory', 'required');
		//$this->form_validation->set_rules('weightage[]', 'mainCategory', 'required');
		
		
		
		$this->load->model('etab/teacher_side/teacher_side_model', 'ETM');
		$login_user_id = $this->session->userdata("user_id"); //118 GAA
		$reg_user = $this->ETM->getStaffID( $login_user_id );
		$reg_user_id = $reg_user['id'];
		
		$this->load->model('autocomplete/assGradeModel');
			
		if ($this->form_validation->run() == FALSE){
			echo 3;
		}else{
			
			$createUpdate = $this->input->post('createUpdate');
			$session = $this->input->post('academicSession');
			$term = $this->input->post('academicSessionTerm');
			$grade = $this->input->post('gradeName');
			$subject = $this->input->post('gradeSubject');
			$category = $this->input->post('mainCategory');
			$subCat = $this->input->post('subCategory');
			$orgweightage = $this->input->post('weightage');
			$ignore = $this->input->post('ignore');
			$programSetupID = $this->input->post('programSetupID');
			
			
			$table = "`gradesubjectass`";
			
			$where = array(
				"program_id"=>$programSetupID,
				"assessment_category_id" => $category,
				"assessment_term_id" => $term,
				"academic_session_id" => $session,
			);
		$counter=0;
		$select = "id";
		$de = $this->assGradeModel->getAll($table,$select,$where );
		
		if( !empty( $de ) ){
			//$data = array("record_deleted"=>1);
			//$this->assGradeModel->updateTable( $table, $data, $where );
		}
		//$this->mautocomplete->getSumWeightage( $table,$where );
		//if( $createUpdate == 'create' ){
		if( empty( $de ) ){	
			
		foreach( $orgweightage as $weighate ):
			$data = array(
			"program_id"=>$programSetupID,
				"grade_id" => $grade,
				"subject_id" => $subject,
				"assessment_category_id" => $category,
				"assessment_type_id" => $subCat[$counter],
				"assessment_term_id" => $term,
				"academic_session_id" => $session,
				"weightage" => $weighate,
				"created" => time(),
				"register_by" => $reg_user_id,
				"modified" => time(),
				"modified_by" => time()
			);
			if( $weighate > 0 ){
				$this->assGradeModel->insert( $table, $data );
			}
			$counter++;
		endforeach; 
			echo 1; 
		}else{
			echo 2;
		}
		
		}	
		
	}
	
	
	public function editAssessment(){
		
		$this->load->model('etab/teacher_side/teacher_side_model', 'TS');
		
		$session	= $this->input->post("session");
		$term		= $this->input->post("term");
		$grade 		= $this->input->post("grade");
		$subject 	= $this->input->post("subject");
		$category 	= $this->input->post("category");
		
		$db = "assessment";
		
		if( $data["alreadyID"] = $this->TS->leftJoin2($category, $grade, $subject, $term, $session) ){
		}else{
			$data["alreadyID"] = NULL;
		}
		//echo $this->TS->leftJoin2($category, $grade, $subject, $term, $session);
		//exit;
	
		$db2 = "default";
		$select2 = "id,name";
		$tableName2 = "`_grade`";
		$where2 = array( 'id' =>  $grade );
		$data['grade2'] = $this->TS->getSingleRow( $db2,  $tableName2, $select2, $where2 );
		
		
		$select2 = "id,name";
		$tableName2 = "`_academic_session`";
		$where2 = array( 'id' =>  $session );
		$data['session2'] = $this->TS->getSingleRow( $db2,  $tableName2, $select2, $where2 );
		
		$db2 = "subject";
		
		$select3 = "id";
		$tableName3 = "programmesetup";
		$where3 = array( 'sessionID' =>  $session,"gradeID" => $grade,"subjects"=>$subject,"record_deleted"=>0 );
		$data['programID'] = $this->TS->getSingleRow( $db2,  $tableName3, $select3, $where3 );
		
		$select2 = "id,dname";
		$tableName2 = "subject";
		$where2 = array( 'id' =>  $subject );
		$data['subject2'] = $this->TS->getSingleRow( $db2,  $tableName2, $select2, $where2 );
		
		
		
		
		$select2 = "id,dname";
		$tableName2 = "assessment_category";
		$where2 = array( 'id' =>  $category, "status" => 1 );
		$data['category2'] = $this->TS->getSingleRow( $db,  $tableName2, $select2, $where2 );
		$data["term"] = $term;
		
		
		
		$table = "assessment_type";
		$select = "id AS type_ID, name AS Type_Name";
		$where = array("ass_category_id"=>$category, "record_deleted" => 0);
		
		if($data['listOfTypes'] = $this->TS->getAll($db,$table,$select,$where)){
		}else{ $data["listOfTypes"] = NULL; }
		
		$this->load->view("etab/assForGrades/ass_create3", $data);
		
	}
	
	// updatation in database
	public function overWriteAssessment(){
		$this->load->model('etab/teacher_side/teacher_side_model', 'ETM');
		$login_user_id = $this->session->userdata("user_id"); //118 GAA
		$reg_user = $this->ETM->getStaffID( $login_user_id );
		$reg_user_id = $reg_user['id'];
		
		$createUpdate = $this->input->post('createUpdate');
		$session = $this->input->post('session_id');
		$term = $this->input->post('term_id');
		$grade = $this->input->post('grade_id');
		$subject = $this->input->post('subject_id');
		$category = $this->input->post('category_id');
		$subCat = $this->input->post('subCategory');
			
		$orgweightage = $this->input->post('weightage'); // weightage number
			
		$programSetupID = $this->input->post('program_id'); // program id
		$idforupdation = $this->input->post('idforupdation'); // This is id for table `gradesubjectass`
		
		
		$programID = $this->input->post('programID'); // program id
			
		$blockidforupdation = $this->input->post('blockidforupdation'); 
		// if this id equals to 1 than updation value must be not 0
		// if this id equals to 2 than must updation with any value
		// if this id equals to 0 insert new assessment  
		//var_dump($_POST);
			
		$this->load->model('autocomplete/assGradeModel','AGM');
		$table = "`gradesubjectass`";	
			
		
			
			for($i=0; $i<sizeOf($orgweightage); $i++){
				
			
				
					if( $blockidforupdation[$i] == 0 ){ 	$operation = 1; }else{ $operation = 0; }
					
					if( $operation == 0 ){
						
							// "Updation only ".$idforupdation[$i];
						
							
							$data = array("weightage" => $orgweightage[$i],"modified" => time(),"modified_by" => $reg_user_id );
							$where = array("id" => $idforupdation[$i] );
							$this->AGM->updateTable( $table, $data, $where );
							$return =1;
				
					}else{
						
						if( $orgweightage[$i] > 0 ){
							
							// "New Insert";
							

							$data = array(
							"program_id"=>$programID,
							"grade_id" => $grade,
							"subject_id" => $subject,
							"assessment_category_id" => $category,
							"assessment_type_id" => $subCat[$i],
							"assessment_term_id" => $term,
							"academic_session_id" => $session,
							"weightage" => $orgweightage[$i],
							"created" => time(),
							"register_by" => $reg_user_id
							);
							$this->AGM->insert( $table, $data );
							

							$return =1;
							
						}
					}
						
				echo $return;
					
					
					
					//$i++;
			}// end loop
	}// function 
	
	
}


?>