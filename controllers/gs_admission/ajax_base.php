<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ajax_base extends CI_Controller{
    public function __construct(){
        parent::__construct();
		$this->load->library('session');
    }



    public function insertAtPosition($string, $insert, $position) {
    	return substr_replace($string, $insert, $position, 0);
    	
	}

	/*
	 * -------------------------------------------------------------------------------
	 * 	Function used to find local number from all numbers using country code and number and return string
	 * -------------------------------------------------------------------------------
	 */	
	public function findLocalNumber( $phone_code, $phone_number ){
		
		$phone_numbers = array();
		$user_phone_number = '';
		$flag = 0;
		for( $i=0; $i < count($phone_code); $i++){

			if (strpos($phone_code[$i], '92') !== false && $flag != 1) {
				$flag = 1;
			    $user_phone_number = '0' .str_replace('-','',$phone_number[$i]);
			} else {
				array_push( $phone_numbers, $phone_code[$i] . '-' .$phone_number[$i]);
			}
			
		}

		$data['phone_numbers'] = implode(",", $phone_numbers);
		$data['local_number'] =  $user_phone_number;
		return $data;

	}

	/*
	 * -----------------------------------------------------------------------------------
	 * 	Function used to merge all numbers using country code and number and return string
	 * -----------------------------------------------------------------------------------
	 */
	public function mergeStudentMobile ( $phone_code, $phone_number ){
		
		$phone_numbers = array();
		for( $i=0; $i < count($phone_code); $i++){
			
			array_push( $phone_numbers, $phone_code[$i] . '-' .str_replace('-','',$phone_number[$i]));
		}

		$data['phone_numbers'] = implode(",", $phone_numbers);
		return $data;
	}

	/*
	 * ------------------------------------------------------
	 * 	Function for get Issuance Form Data and save in table
	 * ------------------------------------------------------ 
	 */
		public function get_data(){

					//var_dump($f_no);
			 // var_dump($this->input->post());
			/*var_dump($fatherNumberData);
			 die();*/

			$fatherNumberData  = $this->findLocalNumber($this->input->post("father_mobile_code"), $this->input->post("father_mobile_phone") );
		
			$motherNumberData  = $this->findLocalNumber($this->input->post("mother_mobile_code"), $this->input->post("mother_mobile_phone") );
			$studentNumberData = $this->mergeStudentMobile($this->input->post("student_mobile_code"), $this->input->post("student_mobile_phone") );
			$autoSubmissionDate = true;
			$this->load->model('gs_admission/ajax_base_model', 'AB');

			$f_nic = $this->input->post("f_nic");
			$gf_id = $this->input->post("gf_id");
			$gt_id = $this->input->post("gt_id");
			$token_no = $this->input->post("token_no");
			$official_name = $this->input->post("official_name");
			$call_name = $this->input->post("call_name");
			$date_of_birth = $this->input->post("date_of_birth");
			$gender = $this->input->post("gender");
			$single_parent = $this->input->post("single_parent");
			$father_name = $this->input->post("father_name");
			$father_name = $this->input->post("father_name");
			$father_name = $this->input->post("father_name");
			if(!empty($fatherNumberData['local_number'])){
				$father_mobile = $this->insertAtPosition($fatherNumberData['local_number'], '-', 4);
				
			} else {
				$father_mobile = '';
			}

			$father_mobile_other = $fatherNumberData['phone_numbers'];
			$father_nic = $this->input->post("father_nic");
			$father_email = $this->input->post("father_email");
			$mother_name = $this->input->post("mother_name");
			if(!empty($motherNumberData['local_number'])){
				$mother_mobile = $this->insertAtPosition($motherNumberData['local_number'], '-', 4);
				
			} else {
				$mother_mobile = '';
			}
			
			
			//$this->input->post("mother_mobile");
			$mother_mobile_other = $motherNumberData['phone_numbers'];
			$mother_nic = $this->input->post("mother_nic");
			$mother_email = $this->input->post("mother_email");
			$admission_grade = $this->input->post("admission_grade");
			$campus1 = $this->input->post("campus");
			$comments = $this->input->post("comments");
			$photo_submitted = $this->input->post("photo_submitted");
			$birth_certificate_o = $this->input->post("birth_certificate_o");
			$birth_certificate_c = $this->input->post("birth_certificate_c");
			$alevel_supplement = $this->input->post("alevel_supplement");
			$session = $this->input->post("academic_session");
			//var_dump($this->input->post("birth_certificate_o"));

			
			$grade_name = $this->input->post("admission_grade");
			$grade_id = $this->input->post("admission_grade_id");
			$single_parent = $this->input->post("single_parent");
			$primary_contact = $this->input->post("primary_contact");
			
			$FormAction = $this->input->post("FormAction");
			$Form_ID = $this->input->post("Form_ID");
			$Fmly_Reg_ID = $this->input->post("Fmly_Reg_ID");
			$family_exists = $this->input->post("family_exists");
			$student_email =  $this->input->post("student_email");
			$student_mobile =  $studentNumberData['phone_numbers'];
			$student_nic =  $this->input->post("student_nic");
			$old_gs_id =  $this->input->post("old_gs_id");	
			$batch_id =  $this->input->post("batch");
			$Referal_code =  $this->input->post("Referal_code");


			if($batch_id!=""){
				$assistment_date=explode('|',$batch_id)[1];
			    $batch_id=explode('|',$batch_id)[0];
			}

			$slot_id =  $this->input->post("slots");	

			if($grade_id<6){
				$session=13;
			}else{
				$session=14;
			}
			if($grade_id==17){
				$session=13;
			}

			if( $this->input->post("late_issuance") != NULL ){
				$late_issuance = TRUE;
			}else{
				$late_issuance = FALSE;
			}
			
			if( $alevel_supplement == false ){
				$alevel_supplement=0;
			}else{
				$alevel_supplement=1;
			}

			if( $photo_submitted == false ){
				$photo_submitted=0;
			}else{
				$photo_submitted=1;
			}
			
			if( $birth_certificate_o == false ){
				$birth_certificate_o=0;
				
			}else{
				$birth_certificate_o=1;
			}
			if( $birth_certificate_c == false ){
				$birth_certificate_c=0;
			}else{
				$birth_certificate_c=1;
			}
			
			if( $single_parent == false ){
				$single_parent=0;
			}else{
				$single_parent=1;
			}
			
		

			
			if( $this->input->post("requestGrade") != NULL ){
				$request_for_grade = $this->input->post("requestGrade");
				$request_grade=1;
			}else{
				$request_for_grade=0;
				$request_grade=0;
			}
							
							
			// check if form is new or old new for insertion old for updation.
			if( $FormAction == 0 && $Form_ID == 0 && $Fmly_Reg_ID == 0 ){
				
					// insertion
					  // check regrated applicant
						if( $alreadyForm = $this->AB->getAlreadySubmittedFormNo($f_nic,$official_name,$date_of_birth,$session) ){
							$form_no_db = $alreadyForm["form_no"];
							$form_applicant_wise = 1;
							$ad_form_id = 0;
						}else{
							$form_applicant_wise=0;
							$form_no_db=0;
						}
						
						
						if( $form_applicant_wise == 0 ){

							if( $gf_id == '' && $f_nic != '' ){
								if( $family_exists == 0 ){
									$gid = $this->AB->set_family_id();
									$gf_id = $gid["new_gfid"];	
								}else{
									$gf_id = $family_exists;
								}
								
								
								
							}else{
								$gf_id2 = str_replace("-","",$gf_id);
								$gf_id = (int)$gf_id2;
							}
							
							
							$f_no = $this->AB->getFormNo();
							//$fsd = $this->AB->form_submission_date();
							
							$getSubmissionAssessmentDate = $this->AB->creatAssessmentdate($grade_id,'');


							/*
							if($late_issuance){
								$for_submission_date = date ( 'Y-m-d' , strtotime ( '2 weekdays' ) );
							}else if($grade_id <= 14 || $grade_id == 17){
								$fsd = $this->AB->form_submission_date();
								$for_submission_date = $fsd["submission_date"];								
							}else if($grade_id == 15 || $grade_id == 16){
								$for_submission_date = date('Y-m-d',strtotime('5 weekdays'));
							}
							*/

							if(!empty($getSubmissionAssessmentDate)){
								$batch_id = $getSubmissionAssessmentDate['form_batch_id'];
								$slot_id = $getSubmissionAssessmentDate['slot_id'];
								$for_submission_date = $getSubmissionAssessmentDate['batch_date'];
								$form_assessment_date = $getSubmissionAssessmentDate['batch_date'];
							}else{
								$batch_id = 1;
								$slot_id = 0;
								$for_submission_date = '0000-00-00';
								$form_assessment_date = '2001-01-01';
							}

							

					
							$data = array(
								"form_no" => $f_no,
								"token_no"=>$token_no,
								"gf_id"=>$gf_id,
								"official_name"=>$official_name,
								"call_name"=>$call_name,
								"dob"=>$date_of_birth,
								"form_batch_id" => $batch_id,
								'batch_slot_id' => $slot_id,
								"gender"=>$gender,
								"is_photo_submitted"=>$photo_submitted,
								"is_birthcrt_o"=>$birth_certificate_o,
								"is_birthcrt_c"=>$birth_certificate_c,
								"is_alevel_supplement"=>$alevel_supplement,
								"grade_id"=>$grade_id,
								"grade_name" => $grade_name,
								"academic_session_id"=>$session,
								"form_status_id" =>1,
								"form_submission_date" => $for_submission_date,
								"form_assessment_date" => $form_assessment_date,
								"campus" => $campus1,
								"comments" => $comments,
								"request_for_grade"=>$request_for_grade,
								"request_grade"=>$request_grade,
								"student_email" => $student_email,
								"student_nic" => $student_nic,
								"student_mobile" => $student_mobile,	
								"gt_id" => $gt_id,					
								"old_gs_id" => $old_gs_id,			
								"created"=>time(),
								"register_by" =>$this->session->userdata("user_id"),
							    "referal_code" =>$this->input->post("Referal_code"),

							);
						
							
							$ad_form_id = $this->AB->set("admission_form",$data);
							
							if( $gfid = $this->AB->getFamilyInfo( $gf_id ) ){ 
								$family_id = $gfid["id"];
								$insert_family_info = 0;
							}else{
								$insert_family_info = 1;
							}
							
							
							$data2 = array(
								"gf_id" =>$gf_id,
								"single_parent" => $single_parent,
								"primary_contact" => $primary_contact,
								"father_name"=>$father_name,
								"father_mobile"=>$father_mobile,
								"father_mobile_other" => $father_mobile_other,								
								"father_nic"=>$father_nic,
								"mother_name"=>$mother_name,
								"mother_mobile"=>$mother_mobile,
								"mother_mobile_other" => $mother_mobile_other,								
								"mother_nic"=>$mother_nic,
								"father_email"=>$father_email,
								"mother_email"=>$mother_email,
								"created" =>time(),
								"register_by" =>$this->session->userdata("user_id"),


							);

							
							if( $insert_family_info == 1 ){
								$fr = $this->AB->set("family_registration",$data2);
							}else{
								$where = array( "id" => $family_id );
								$tablenamefr = "family_registration";
								$this->AB->update_function($tablenamefr,$data2,$where);	
							}

							
							//	//insert new and old batch log in log_form_batch zzk
							$data_log_form_batch = array(
								"admission_form_id" =>$ad_form_id,
								"old_form_batch" =>0,
								"new_form_batch" =>$batch_id,
								"created" =>time(),
								"register_by" =>$this->session->userdata("user_id"),
								"modified"=>time(),
								"modified_by" =>$this->session->userdata("user_id"),
							);

							$batch_log = $this->AB->set("log_form_batch",$data_log_form_batch);
							//print_r($batch_log);
							//echo 'console.log($f_no)';
							
							
						
						}
						//$data3 = array("form_id" => 1, "data_exists" => 1 );
						$data3 = array("form_id" => $ad_form_id, "data_exists" => $form_no_db );
			
			// end insertion 
				
			}else{ // updation
					


					$data = array(
							"token_no"=>$token_no,
							"official_name"=>$official_name,
							"call_name"=>$call_name,
							"dob"=>$date_of_birth,
							"gender"=>$gender,
							"is_photo_submitted"=>$photo_submitted,
							"is_birthcrt_o"=>$birth_certificate_o,
							"is_birthcrt_c"=>$birth_certificate_c,
							"is_alevel_supplement"=>$alevel_supplement,
							"grade_id"=>$grade_id,
							"grade_name" => $grade_name,
							"campus" => $campus1,
							"comments" => $comments,
							"request_for_grade"=>$request_for_grade,
							"request_grade"=>$request_grade,
							"student_email" => $student_email,
							"student_nic" => $student_nic,
							"student_mobile" => $student_mobile,
							"gt_id" => $gt_id,
							"modified"=>time(),
							"modified_by" =>$this->session->userdata("user_id"),
							"referal_code" =>$this->input->post("Referal_code"),


						);
						$where = array( "id" => $Form_ID );
						$table_name = "admission_form";
						$ad_form_id = $this->AB->update_function($table_name,$data,$where);
						if($batch_id!="" && $slot_id!=""){
				             $this->AB->slot_update($Form_ID,$batch_id,$slot_id,$assistment_date);
			             }
						
						// if($batch_id != '' && $slot_id != ''){
							
						// 	$where_batch = array(
						// 		'id'=> $batch_id
						// 	);

						// 	$batch_detail = $this->AB->get_by_all('atif_gs_admission._form_batch','',$where_batch,'');
						// 	$for_submission_date = $batch_detail[0]->date;
						// 	$form_assessment_date = $batch_detail[0]->date;

						// }	
						
							
							$data2 = array(
							"single_parent" => $single_parent,
							"primary_contact" => $primary_contact,
							"father_name"=>$father_name,
							"father_mobile"=>$father_mobile,
							"father_mobile_other" => $father_mobile_other,
							"father_nic"=>$f_nic,
							"mother_name"=>$mother_name,
							"mother_mobile"=>$mother_mobile,
							"mother_mobile_other" => $mother_mobile_other,
							"mother_nic"=>$mother_nic,
							"father_email"=>$father_email,
							"mother_email"=>$mother_email,
							"modified" =>time(),
							"modified_by" =>$this->session->userdata("user_id")
							);

							$where2 = array("id"=> $Fmly_Reg_ID);
							
							$table_name = "family_registration";
							$fr = $this->AB->update_function( $table_name, $data2, $where2 );
							//$ad_form_id = 1;
							//$fr = 1;
							$data3 = array("form_id" => $Form_ID, "family_id" => $fr );
				
			} // End Updation
			
			
			// Updates  Slots of admission

			if($slot_id != 0){
				$this->getAndUpdateSlots($slot_id,$batch_id);
			}
			//ISS for Issuance
			//zk
			if($ad_form_id == 0 )
			{
				#$f = $this->AB->get_form_no($Form_ID);
				#$f_no= $f["Form_no"];
				$Form_ID = $Form_ID;

			}else {
				$Form_ID = $ad_form_id;				
			}
		
			if($comments != ''){
				
				$Reason ='ISS';
				$comment_logs = $this->add_reasion($Form_ID, $Reason,$comments);
				 // var_dump(+"comment_logs"+$comment_logs);
				 // die();
			}

			echo  json_encode( $data3 );
		}
		
	/* ----End get_data function ---------*/
	
	

	/*
	 * -----------------------------------------------------------------------
	 *  Get Family information by entering gf_id while issuance admission form
	 * ------------------------------------------------------------------------
	*/
	public function getDataByGfId(){
		$this->load->model('gs_admission/ajax_base_model', 'AB');
		
		$gf_id = $this->input->post("gf_id");
		$f_nic = $this->input->post("f_nic");
		
		if( $gf_id != '' && $f_nic == ''){
			$str = (int)str_replace('-','',$gf_id);
			$results = $this->AB->getFamilyDataByGfId( $str, $f_nic=NULL );	
		}else{
			$results = $this->AB->getFamilyDataByGfId( $str=NULL,$f_nic );	
		}
		
		
		//array( "r" =>$results )
		echo json_encode ( $results );
		
	}
	/* ----End getDataByGfId function ---------*/	

	public function getDataByMNic(){
		$this->load->model('gs_admission/ajax_base_model', 'AB');
		

		$m_nic = $this->input->post("m_nic");
		
		if($m_nic != ''){
			
			$results = $this->AB->getFamilyDataByMNic($m_nic);	
			echo json_encode ( $results );
		}
		
		
	}	
	
	public function getDataByFNic(){
		$this->load->model('gs_admission/ajax_base_model', 'AB');
		

		$f_nic = $this->input->post("f_nic");
		
		if($f_nic != ''){
			
			$results = $this->AB->getFamilyDataByMNic($f_nic);	
			echo json_encode ( $results );
		}
		
		
	}	
	/*
	 * ---------------------------------------------------------------
	 *  Get And Edit Applicant Details And Assigned Batch Grade Wise
	 * ---------------------------------------------------------------
	 */
		public function applicantDetailsEdit(){
			$this->load->model('gs_admission/ajax_base_model', 'AB');
			$data_id = $this->input->post("data_id");
			$data["data_id"] =  $this->AB->list_of_admission_form($data_id);
			// print_r($data['data_id']);
			// die;
			$grade_id=$data["data_id"]['Grade_id'];
			$data["batch"] =  $this->AB->getBatchDataByGradeId($grade_id);
			$this->load->view('gs_admission/issuance/applicantDetailsEdit',$data);
		}
	 /* ---------------------------------------------------------------- */
	 

	 /*
	 * ---------------------------------------------------------------
	 *  Get And Edit Applicant Details And Assigned Batch Grade Wise
	 * ---------------------------------------------------------------
	 */
		public function getSlots(){
			$this->load->model('gs_admission/ajax_base_model', 'AB');
			$batch_id = $this->input->get("batch_id");
			$data["slot"] =  $this->AB->getSlotDataByGradeId($batch_id);
			$this->load->view('gs_admission/issuance/slots',$data);
		}
	 /* ---------------------------------------------------------------- */
	 
	 
	 
	 
	 /*
	 * ----------------------------------------------
	 *  -Get Admission Grade by date of birth wise-
	 * ----------------------------------------------
	 */
		public function admissionGrade(){
			$this->load->model('gs_admission/ajax_base_model', 'AB');
			$dob = $this->input->post("dob");
			$f_nic = $this->input->post("f_nic");
			$official_name = $this->input->post("official_name");
			$gender = $this->input->post("gender");
			$session = $this->input->post("academic_session");
			
			
			
			//$this->AB->getAlreadySubmittedForm($official_name,$dob,$father_nic);
			$alreadyForm=array();
			$alreadyForm = $this->AB->getAlreadySubmittedFormNo($f_nic,$official_name,$dob,$session);
			if(  !empty( $alreadyForm  ) ){
				$form_no_db = $alreadyForm["form_no"];
			}else{
				$form_no_db=0;
			}
			
			$results = $this->AB->getAdmissionGrade( $dob );
			$data = array( "dob" => $results, "form_no"=>$form_no_db );
			echo json_encode ( $data );
		}
	 /* -------------------------------- */
	 
	 
	 /*
	 * ----------------------------------------------
	 *  -Get Admission Grade by date of birth wise-
	 * ----------------------------------------------
	 */
		public function refreshFormData(){
			$data["campus"] = $this->input->post("campus");
			$this->load->view('gs_admission/issuance/IssueAdmissionForm2',$data);
		}
	 /* -------------------------------- */
	 
	 
	 
	  /*
	 * ----------------------------------------------
	 *  -Get Admission Grade by date of birth wise-
	 * ----------------------------------------------
	 */
		public function reloadTableData(){
		$this->load->model('gs_admission/ajax_base_model', 'AB');
	 	$data["formlist"] = $this->AB->list_of_admission_form();
		$user_id = $this->session->userdata("user_id");
		$data["myttl"] = $this->AB->getUserUploadedForm($user_id);
		$data["ttl"] = $this->AB->getUserUploadedForm($user_id=NULL);
		$this->load->view('gs_admission/issuance/form_list',$data);
		}
	 /* -------------------------------- */
	 
	 
	/*
	 * ----------------------------------------------
	 *  -Get Admission Grade by date of birth wise-
	 * ----------------------------------------------
	 */
	 
	public function reloadFormList(){
		$this->load->model('gs_admission/ajax_base_model', 'AB');
	 	$user_id = $this->session->userdata("user_id");
		$myttl = $this->AB->getUserUploadedForm($user_id);
		$ttl = $this->AB->getUserUploadedForm($user_id=NULL);
		$myttl = $myttl["mytotal"];
		$ttl = $ttl["totalForm"];
		$data = array("ml"=>$myttl, "gt"=>$ttl );
		echo json_encode($data);
	}
	/* -------------------------------- */
	

	/*///////////////////////////////////////////////////////////////////////////////////////////////////////////
			FORM  SUBMISSION START FROM HERE
	//////////////////////////////////////////////////////////////////////////////////////////////////////////*/ 
	
	/*
	 * ----------------------------------------
	 *  Get Applicant Date Through Form Numer
	 * -----------------------------------------
	 */
		public function submissionDetailsEdit(){
			$this->load->model('gs_admission/ajax_base_model', 'AB');
			$form_no = (int)$this->input->post("form_no");
			//$form_data = $this->AB->list_of_admission_form($form_no);
			$data["data_id"] = $this->AB->list_of_admission_form($form_no);
			echo json_encode($data["data_id"]);
			//$this->load->view('gs_admission/submission/form_only',$data);
			
		}
	 /* -------------------------------- */
	 
	 
	
	/*
	 * ---------------------------------
	 *  Get And Edit SUBMISSION Details
	 * ---------------------------------
	 */
		public function submissionDetailsEdit2(){
			$this->load->model('gs_admission/ajax_base_model', 'AB');
			$data_id = $this->input->post("data_id");
			$details = $this->AB->list_of_admission_form3($data_id);

			$data["data_id"] = $details;
			

			$grade_id = (int)$details["Grade_id"];
			$Batch_id = (int)$details["Batch_id"];
			
			$data["formBatchDetails"] = $this->AB->getGradeFormBatch($grade_id);

			
			$data["school_lists"] = $this->AB->school_id();
			$data["grade_lists"] = $this->AB->grade_id();
			
			
			$this->load->model('gs_admission/submission_model', 'SM');
			$data["slotInfo"] = $this->SM->getSlots($Batch_id,$data_id);

			$this->load->view('gs_admission/submission/form_only',$data);
		}

	 /* -------------------------------- */
	 
	 
	 /*
	 *
	 *------------------------------------
	 *  Get Next Batch Allocated
	 *------------------------------------
	 */

	 public function get_next_batch(){
	 		
	 	$this->load->model('gs_admission/ajax_base_model', 'AB');
		$data_id = $this->input->post("data_id");
		$details = $this->AB->list_of_admission_form3($data_id);
		$data["data_id"] = $details;

		$grade_id = (int)$details["Grade_id"];
		$batch_id = (int)$details["Batch_id"];
		$formBatchDetails = $this->AB->getGradeFormBatch($grade_id);

		if(!empty($formBatchDetails)){
			echo json_encode($formBatchDetails);
		}else{
			echo json_encode(0);
		}


	 }

	 
	 /*
	 * ---------------------------------
	 *  Get And Edit SUBMISSION Details
	 * ---------------------------------
	 */
	 
		public function form_submission(){
			// var_dump($this->input->post());
			// exit;

			// var_dump($fatherNumberData);
			//  die();
			$this->load->model('gs_admission/ajax_base_model', 'AB');
			$fatherNumberData  = $this->findLocalNumber($this->input->post("father_mobile_code"), $this->input->post("father_mobile_phone") );
			$motherNumberData  = $this->findLocalNumber($this->input->post("mother_mobile_code"), $this->input->post("mother_mobile_phone") );
			$studentNumberData = $this->mergeStudentMobile($this->input->post("student_mobile_code"), $this->input->post("student_mobile_phone") );
			$flag = false;
			$form_no = $this->input->post("form_no");
			$form_id = (int)$this->input->post("form_id");

			
			$Fmly_Reg_ID = $this->input->post("Fmly_Reg_ID");
			$referal_code = $this->input->post('Referal_code');
			
			$previous_grade = (int)$this->input->post("previous_grade");
			$official_name = $this->input->post("official_name");
			$call_name = $this->input->post("call_name");
			$date_of_birth = $this->input->post("date_of_birth");
			$student_email =  $this->input->post("student_email");
			$student_mobile =  $studentNumberData['phone_numbers'];
			$student_nic =  $this->input->post("student_nic");

			$grade_name = $this->input->post("admission_grade");
			$grade_id = $this->input->post("admission_grade_id");
			
			$gender = $this->input->post("gender");
			$father_name = $this->input->post("father_name");
			//$father_mobile = $this->input->post("father_mobile");

			if(!empty($fatherNumberData['local_number'])){
				$father_mobile = $this->insertAtPosition($fatherNumberData['local_number'], '-', 4);
				
			} else {
				$father_mobile = '';
			}

			if(!empty($fatherNumberData['local_number'])){
				$father_mobile_other = $fatherNumberData['phone_numbers'];
				
			} else {
				$father_mobile_other = '';
			}			
			
			$father_nic = $this->input->post("father_nic");
			$father_email = $this->input->post("father_email");
			$mother_name = $this->input->post("mother_name");
			//$mother_mobile = $this->input->post("mother_mobile");
			if(!empty($motherNumberData['local_number'])){
				$mother_mobile = $this->insertAtPosition($motherNumberData['local_number'], '-', 4);
				
			} else {
				$mother_mobile = '';
			}

			if(!empty($motherNumberData['local_number'])){
				$mother_mobile_other = $motherNumberData['phone_numbers'];
				
			} else {
				$mother_mobile_other = '';
			}			
			
			$mother_nic = $this->input->post("mother_nic");
			$mother_email = $this->input->post("mother_email");
			
			
			$batch_name 	 = (int)$this->input->post("batch_name");
			$submissionStage = (int)$this->input->post("submissionStage");
			
			//$Current_Batch_Time_Slot_id_Change = (int)$this->input->post("Current_Batch_Time_Slot_id_Change");

			if($this->input->post('Current_Batch_id')){
				$current_batch_id = $this->input->post('Current_Batch_id');
			}else{
				$current_batch_id = 0;
			}

			if($this->input->post('Current_Time_Slot_id')){
				$current_slot_id = $this->input->post('Current_Time_Slot_id');
			}else{
				$current_slot_id = 0;
			}

			if($this->input->post('submission_time')){
				$submission_time = $this->input->post('submission_time');
			}else{
				$submission_time = 0;
			}

			$reAllocateBatch = $this->input->post("reAllocateBatch");
			$reAllocateSlot = $this->input->post("reAllocateSlot");
			
			// Condition for Updation the Form

			$flagSlot = 0; 
			if($current_batch_id == $batch_name && $submission_time ==  $current_slot_id){
				$reAllocateBatch = '';
				$reAllocateSlot = '';
			}else{
				$flagSlot = 1;
				$reAllocateBatch = $batch_name;
				$reAllocateSlot = $submission_time;
			}

			if($submissionStage == 1 && $this->input->post("reAllocateBatch") != '' && $this->input->post("reAllocateSlot") != ''){
				$reAllocateBatch  = $this->input->post("reAllocateBatch");
				$reAllocateSlot = $this->input->post("reAllocateSlot");
				$flagSlot = 0;
			}else{
				$reAllocateBatch = '';
				$reAllocateSlot = '';
			}

			if($flagSlot == 1){
				$reAllocateBatch = $batch_name;
				$reAllocateSlot = $submission_time;
			}

			// var_dump($reAllocateBatch);
			// var_dump($reAllocateSlot);
			// exit;
			
			$comments = $this->input->post("comments");
			$ps = $this->input->post("ps");
			$bco = $this->input->post("bco");
			$bcc = $this->input->post("bcc");
			$as = $this->input->post("alevel_supplement");
			
			
			if( $ps == false ){ $photo_submitted=0; }else{ $photo_submitted=1; }
			if( $bco == false ){ $birth_certificate_o=0; }else{ $birth_certificate_o=1; }
			if( $bcc == false ){ $birth_certificate_c=0; }else{ $birth_certificate_c=1; }
			if( $as == false ){ $alevel_supplement=0; }else{ $alevel_supplement=1; }
			
			if( $this->input->post("other_school") != NULL ){
				$previous_school_name = $this->input->post("other_school");	
				$data = array( "name" => $previous_school_name, "created"=>time(), "register_by" =>$this->session->userdata("user_id") );
				$previous_school = $this->AB->set("_school",$data);
			}else{
				$previous_school = (int)$this->input->post("previous_school");
			}
						
						
			if(!empty($this->input->post("discussion_date")) && !empty($this->input->post("discussion_time"))){

				$flag = true;
				$form_discussion_date = $this->input->post("discussion_date");
				$form_discussion_time = $this->input->post("discussion_time");
				$alevelCheckList = $this->input->post("alevelCheckList");
			}
			
			/*
			$ad = $this->AB->creatAssessmentdate($grade_id, $batch_name);
			
			
			if( !empty( $ad ) ){
				
				$slot_id = $ad["slot_id"];
				$sno = $ad["sno"];
				$time_start = $ad["time_start"];
				$form_batch_id = $ad["form_batch_id"];
				$batch_id = $ad["batch_id"];
				$batch_date = $ad["batch_date"]; //form_assessment_date
				$toBeInform = 0; // zero means assissment date is aviable
				
			}else{
				
				// this is for TO BE INFORM condition
				$slot_id =0;
				$sno = 0;
				$time_start = "2001-01-01";
				$form_batch_id = $ad["form_batch_id"];
				$batch_id = $ad["batch_id"];
				$batch_date = "2001-01-01"; //form_assessment_date
				$toBeInform = 1;
			}
			
			$form_batch_slots = "_form_batch_slots";
			// this is for changing slot time
			
			if( $toBeInform == 0 && $Current_Batch_Time_Slot_id_Change == 0 ){
				if( !empty( $aSID = $this->AB->getFormSlot($form_id)  ) ){
					if( $this->input->post("batch_name") != NULL ){
						$batch_id = $this->input->post("batch_name");	
					}
					if( $this->input->post("submission_time") != NULL ){
						$slot_id = $this->input->post("submission_time");
						// Create new Assessment Date
						$ad = $this->AB->creatAssessmentdateStage($grade_id,$batch_id,$slot_id);
						$batch_date = $ad["batch_date"]; // new form_assessment_date
					}
					$aSlotID = $aSID["aSlotID"];
					$data1 = array(
						"admission_form_id"=>0,
						"modified" =>time(),
						"modified_by" =>$this->session->userdata("user_id")
					);
					$where1 = array("id"=> $aSlotID);
					$fbs = $this->AB->update_function( $form_batch_slots, $data1, $where1 );
						
				}else{
					 $fbs = 0;
				}
			
			}else{
				 $fbs = 0;
			}

			*/


			if($reAllocateBatch == '' && $reAllocateSlot == '' ){
				$toBeInform = 1;
				
				$admission_detail =  $this->admission_detail($form_id);
				$slot_id = $admission_detail[0]->batch_slot_id;

				if($slot_id == 0 ){
					
					$form_status_stage_id = 12;
					$form_submission_date = '0000-00-00';
					$form_assessment_date = '2001-01-01';

				}else{
		
					$form_status_stage_id = 2;
					$form_submission_date = $admission_detail[0]->form_submission_date;
					$form_assessment_date = $admission_detail[0]->form_assessment_date;
				}
			}else{
				$toBeInform = 0;
				$batch_id = $reAllocateBatch;
				$slot_id = $reAllocateSlot;
				$ad = $this->AB->creatAssessmentdateStage($grade_id,$batch_id,$slot_id);
				$batch_date = $ad["batch_date"]; // new submission_data and new_assessment_date


				// GET SLOT DETAIL BY ADMISSION FORM ID

				$applicant_detail =  $this->admission_detail($form_id);
				$applicant_previous_slot = $applicant_detail[0]->batch_slot_id;
				if($applicant_previous_slot == 0){
					$revised_slot_process = 0;
				}else{
					$revised_slot_process = 1;
				}

			}
			

		
			if( $toBeInform == 0 ){
				
				$data = array(
						"form_batch_id" => $batch_id, 
						"batch_slot_id" => $slot_id,
						"is_photo_submitted"=>$photo_submitted,
						"is_birthcrt_o"=>$birth_certificate_o,
						"is_birthcrt_c"=>$birth_certificate_c,
						"is_alevel_supplement"=>$alevel_supplement,
						"form_status_id" => 2,
						"form_status_stage_id" => 2,
						"previous_school_id" => $previous_school,
						"previous_grade" => $previous_grade,
						"form_submission_date"=>$batch_date,
						"form_assessment_date"=>$batch_date,
						"referal_code" => $referal_code,
						"comments" => $comments,
						"student_email" => $student_email,
						"student_nic" => $student_nic,
						"student_mobile" => $student_mobile,
						"modified"=>time(),
						"modified_by" =>$this->session->userdata("user_id")
					);
			}else{
				
				$data = array(
						"is_photo_submitted"=>$photo_submitted,
						"is_birthcrt_o"=>$birth_certificate_o,
						"is_birthcrt_c"=>$birth_certificate_c,
						"is_alevel_supplement"=>$alevel_supplement,
						"student_email" => $student_email,
						"student_nic" => $student_nic,
						"student_mobile" => $student_mobile,						
						"form_status_id" => 2,
						"form_status_stage_id" => $form_status_stage_id,
						"previous_school_id" => $previous_school,
						"previous_grade" => $previous_grade,
						"form_submission_date"=>$form_submission_date,
						"form_assessment_date"=>$form_assessment_date,
						"referal_code"=> $referal_code,
						"comments" => $comments,
						"modified"=>time(),
						"modified_by" =>$this->session->userdata("user_id")
					);
				
			}
			if($flag){
				$data['form_discussion_date'] =  $form_discussion_date;
				$data['form_discussion_time'] =  $form_discussion_time;
				$data['form_assessment_date'] =  $form_discussion_date;
				$data['alevel_checklist'] =  implode( ',' , $alevelCheckList);
				


			}

			$where = array( "id" => $form_id );
			$admission_form = "admission_form";
			// Re open comment
		   	$ad_form_id = $this->AB->update_function($admission_form,$data,$where);
			
			// if(!empty($father_mobile)){
			// 	$father_mobile = str_replace("+92","0",  $father_mobile);
			// 	$father_mobile = substr_replace($father_mobile, '-', 4, 0);			
			// } 

			// if(!empty($mother_mobile)){
			// 	$mother_mobile = str_replace("+92","0",  $mother_mobile);
			// 	$mother_mobile = substr_replace($mother_mobile, '-', 4, 0);
			// }



					$data2 = array(
							"father_name"=>$father_name,
							"father_mobile"=>$father_mobile,
							"father_mobile_other" => $father_mobile_other,
							"father_nic"=>$father_nic,
							"mother_name"=>$mother_name,
							"mother_mobile"=>$mother_mobile,
							"mother_mobile_other" => $mother_mobile_other,
							"mother_nic"=>$mother_nic,
							"father_email"=>$father_email,
							"mother_email"=>$mother_email,
							"modified" =>time(),
							"modified_by" =>$this->session->userdata("user_id")
							);
					$where2 = array("id"=> $Fmly_Reg_ID);
					$family_registration = "family_registration";
					// Reopen comment
					$fr = $this->AB->update_function( $family_registration, $data2, $where2 );
							
					$data3 = array(
							"admission_form_id"=> $form_id,
							"modified" =>time(),
							"modified_by" =>$this->session->userdata("user_id")
					);
				 //$where3 = array("id"=> $slot_id);
				

				
				// if form in to be inform condition than not assigned slot	
				if( $toBeInform == 0 ){

					// Revised Slot Process
					if($revised_slot_process == 1){

						$where_admission_id = array(
						'admission_form_id' => $form_id,
						);
						$admission_slot = $this->AB->get_last_record($form_id);
						$admission_slot = $admission_slot[0]['id'];

						// Update Revised Slot ID

						$where_admission_slot = array(
							'id' => $admission_slot
						);

						$data_slot_update = array(
							'revised_batch_slot_id' => $slot_id
						);

						$update_flag = 0;

						$update_flag = $this->AB->update_function( '_form_batch_slots', $data_slot_update, $where_admission_slot);

						// Update Slot ID

						$where_admission_slot = array(
							'id' => $slot_id
						);

						$data_admission_id = array(
							'admission_form_id' => $form_id
						);

						$update_flag = $this->AB->update_function( '_form_batch_slots', $data_admission_id, $where_admission_slot);
					}else{

						$where_admission_id = array(
							'id' => $slot_id
						);

						$data_slot_update = array(
							'admission_form_id' => $form_id
						);

						$update = $this->AB->update_function( '_form_batch_slots', $data_slot_update, $where_admission_id);
					}
					
					// var_dump($admission_slot);
					// exit;
				}else{
					//$fbs2 =0;
				}
							
				
				$bat = $this->AB->get_form_batch_title($form_id);
				if( !empty($bat) )
				{
					$bt = $bat["Batch_Title"];
				}else
				{
					$bt='';
				}

				if( $grade_id == 1 || $grade_id == 2 )
				{
					$Gid=1;
				}elseif( $grade_id == 15 || $grade_id == 16 )
				{
					$Gid=2;
				}
				else 
				{
					$Gid=0;
				}
				
				$data4 = array("form_id" => $form_id, "bt"=>$bt, 'Gid' => $Gid );
				
				// //Sub for Submission
				//zk
				if($comments != ''){
					$Reason ='SUB';
					$comment_logs = $this->add_reasion($form_id,$Reason,$comments);
				}
				//$data4 = array("form_id" => $data, "family_id" => $data2,"slot"=>$data3,"ad"=>$ad);
				
				//$data4 = array("form_id" => $data, "family_id" => $data2,"slot"=>$data3,"ad"=>$ad);
				echo json_encode($data4);
			
		}
	 /* -------------------------------- */
	 /*
	 * --------------------------------------
	 * END  Get And Edit SUBMISSION Details |
	 * --------------------------------------
	 */
	 
	

	/*
	 * ----------------------------------------------
	 *  Refresh Submission Form
	 * ----------------------------------------------
	 */
		public function refreshFormSubmission(){
			$this->load->model('gs_admission/ajax_base_model', 'AB');
			$data["school_lists"] = $this->AB->school_id();
			$data["grade_lists"] = $this->AB->grade_id();
			$this->load->view('gs_admission/submission/empty_form',$data);
		}
	 /* -------------------------------- */	
	 
	 
	 
	 /*
	 * ----------------------------------------------
	 *  Reload Submission Table
	 * ----------------------------------------------
	 */
		public function reloadSubmissionTable(){
			$this->load->model('gs_admission/ajax_base_model', 'AB');
			$data["formlist"] = $this->AB->list_of_admission_form2();
			$this->load->view('gs_admission/submission/right_side_table',$data);
		}
	 /* -------------------------------- */	
	 
	 
	 
	 
	 
	 // Start Of Saqib Created Methods
	 
	 public function get_Unit_Report_pdf(){

        $gradeID = $this->input->post('grade');
        $sectionID = $this->input->post('section');
        $academic_id = $this->input->post('academic');
        $gradeName = $this->input->post('grade_name');
        $sectionName = $this->input->post('section_name');


        $html = '';



        $html .= '
        <style>
            .unit_report_pdf_iframe {
                position: relative;
                padding-bottom: 65.25%;
                padding-top: 30px;
                height: 0;
                overflow: auto; 
                -webkit-overflow-scrolling:touch; //<<--- THIS IS THE KEY 
                border: solid black 1px;
                } 
                .unit_report_pdf_iframe iframe {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
            }
        </style>';



        $pdf_link = '/etab_reports/formative_unit_report_ajax/generate_unit_report?
        gradeID=' . $gradeID .
        '&sectionID=' . $sectionID .
        '&gradeName=' . $gradeName .
        '&sectionName=' . $sectionName;


        $html .= '

            <div class="powerwidget purple" id="datatable-filter-column" data-widget-editbutton="false" role="widget" style="">
              <header role="heading">
                <i class="fa fa-tasks"></i> Report : '.$gradeName.'-'.$sectionName.'
                <div class="powerwidget-ctrls" role="menu">
                  <h3>
                    <span class="glyphicon glyphicon-remove close_setup_4 pull-right cursor" style="top: -11px;"></span>
                  </h3>
                </div>
                <span class="powerwidget-loader"></span>
              </header>

              <div class="inner-spacer" role="content">
                <div id="staff_edit_table_wrapper" class="dataTables_wrapper form-inline" role="grid">';

                
        $html .=    '<div class="unit_report_pdf_iframe"> 
                        <iframe src="'.site_url().$pdf_link.'" frameBorder="0"> </iframe> 
                    </div>';

        $html .= '
              </div>
            </div>
        </div>';



        echo $html;
    }

    public function print_admission_form(){

        $FormNo = $this->input->GET('FormNo');


        $this->load->model('admission/admission_form_issuance_model');
        $data['form_issuance'] = $this->admission_form_issuance_model->getFormIssuanceData($FormNo);



        $FormNo = $data['form_issuance'][0]->form_no; 
        //$AdmissionSession = '2018-19';
        $AdmissionSession = '2019';
        $SubmissionDate = $data['form_issuance'][0]->form_submission_date;
        $SubmissionTime = $data['form_issuance'][0]->form_submission_time;
        $Gender = $data['form_issuance'][0]->gender;
        $Is_Siblings = $data['form_issuance'][0]->siblings;
        $Is_Late = $data['form_issuance'][0]->is_late;
        $ApplicantName = $data['form_issuance'][0]->official_name;
        $DOB = $data['form_issuance'][0]->dob;
        $Grade = $data['form_issuance'][0]->grade_name;
        $OLDGSID = $data['form_issuance'][0]->old_gs_id;
        $GTID = $data['form_issuance'][0]->gt_id;
        $GFID = $data['form_issuance'][0]->gf_id;
        $FatherName = $data['form_issuance'][0]->father_name;
        $FatherMobile = $data['form_issuance'][0]->father_mobile;
        $FatherNIC = $data['form_issuance'][0]->father_nic;
        $FatherEmail = $data['form_issuance'][0]->father_email;
        $MotherName = $data['form_issuance'][0]->mother_name;
        $MotherMobile = $data['form_issuance'][0]->mother_mobile;
        $MotherNIC = $data['form_issuance'][0]->mother_nic;
        $MotherEmail = $data['form_issuance'][0]->mother_email;
        $referal_code = $data['form_issuance'][0]->referal_code;
        $referal_code = $data['form_issuance'][0]->referal_code;
        $batch_detail = $data['form_issuance'][0]->batch_category;

        /* */
        //$BatchCategory = $data['form_submission'][0]->batch_category;
        //$Batch = $data['form_issuance'][0]->batch;
        //$Process = $data['form_issuance'][0]->process;
        //$DateTime = $data['form_issuance'][0]->date_time;
        /* */

        if($referal_code == ''){
        	$referal_code = '-';
        }

        if ($OLDGSID != '' && $OLDGSID != 0){
        	 $OLDGSID = 'GS-ID: '.$OLDGSID;
        }else {
        	$OLDGSID = '';
        }

        if ($GTID != '' && $GTID != 0){
        	$GTID = 'GT-ID: '.$GTID;
        }else {
        	$GTID = '';
        }


        // Overall Font Size
		$font_size = 10;
		$font_name = 'Arial';
		$gender_mark_size = 26;
		$now_date = date('d-M-Y');


		require_once('components/pdf/fpdf/fpdf.php');
		require_once('components/pdf/fpdi/fpdi.php');

		
		// initiate FPDI
		$pdf = new FPDI();

		// get the page count
		$pageCount = $pdf->setSourceFile('components/pdf/admission/AdmissionForm(1819).pdf');
		// Border On
		$bo = 0;
		// iterate through all pages
		for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
		    // import a page
		    $templateId = $pdf->importPage($pageNo);
		    // get the size of the imported page
		    $size = $pdf->getTemplateSize($templateId);

		    // create a page (landscape or portrait depending on the imported page size)
		    if ($size['w'] > $size['h']) {
		        $pdf->AddPage('L', array($size['w'], $size['h']));
		    } else {
		        $pdf->AddPage('P', array($size['w'], $size['h']));
		    }		    

		    // use the imported page
	    	$pdf->useTemplate($templateId);

	    	if ($templateId == 1){
	    		//echo ($batch_detail);
	    		$str = explode('@',$batch_detail);
	    		// Submission Date
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',8);
			    $pdf->SetXY(90.5, 19);
			    //$pdf->Cell(35, 5, $Batch, $bo, 2, 'C', 0);
			    if(sizeof($str) > 1){
			    	$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',7);
				    $pdf->SetXY(82, 18.5);
				    $pdf->Cell(0, 3, $str[0], $bo, 0, 'C');
			    	/* */
			    	//$pdf->Cell(0, 3, $str[0], $bo, 0, 'C');
			    	$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',7);
				    $pdf->SetXY(83, 19);
				    $pdf->Cell(0, 8, $str[1], $bo, 0,'C' );
			    	//$pdf->Cell(0, 8, $str[1], $bo, 0,'L' );
			    	$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',7);
				    $pdf->SetXY(82, 20.5);
				    $pdf->Cell(0, 12, $str[2], $bo, 0, 'C');
			    	//$pdf->Cell(10, 12, $str[2], $bo, 0, 'C');
			    	//$pdf->SetFont($font_name);
				    //$pdf->SetFont($font_name,'',8);
				    //$pdf->SetXY(82, 21);
				    //$pdf->Cell(0, 12, $str[3], $bo, 0, 'C');
			    	//$pdf->Cell(10, 12, $str[2], $bo, 0, 'C');




			    }else{
			    	$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'B',16);
				    $pdf->SetXY(117, 21);
				    //$pdf->Cell(26.5, 5, $AdmissionSession, $bo, 0, 'C', 0);
			    	$pdf->Cell(50, 6, $str[0], $bo, 2, 'C', 0); 		
			    }
			    //$pdf->Cell(35, 5, $SubmissionTime, $bo, 0, 'C', 0);

			    // Session
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',11);
			    $pdf->SetXY(19, 32.8);
			    $pdf->Cell(28, 5, $AdmissionSession, $bo, 0, 'C', 0);
	    		
	    		// Form #
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',12);
			    $pdf->SetXY(10, 45.5);
			    $pdf->Cell(26.5, 5, $FormNo, $bo, 0, 'C', 0);

			    // Gender Small
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',26);
			    $pdf->SetXY(189.2, 23.8);
			    $pdf->SetTextColor(255,255,255);
			    $pdf->Cell(14, -2, substr($Gender,-strlen($Gender),1), $bo, 0, 'C', 0);
			    

			    // IS Siblings
			    if($Is_Siblings == 'yes'){
		    		$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',10);
				    $pdf->SetXY(163.5, 17.2);
			    	$pdf->SetFillColor(0,0,0);
			    	$pdf->SetTextColor(255,255,255);
			    	//$pdf->Cell(41, 7, 'GF-ID: '.$GFID, $bo, 0, 'C', 1);
			    	$pdf->Cell(28, 7, 'GF-ID: '.$GFID, $bo, 0, 'C', 1);
				}

				// IS Late Issuance
			    if($Is_Late == 'Late Issuance'){
		    		$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'B',8);
				    $pdf->SetXY(163.4, 61.1);
			    	$pdf->SetFillColor(0,0,0);
			    	$pdf->SetTextColor(255,255,255);
			    	$pdf->Cell(26.5, 5, $Is_Late, $bo, 0, 'C', 1);
				}
				
				// Old GS-id & GT-ID

	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',11);
			    $pdf->SetXY(163.5, 75);
		    	$pdf->SetTextColor(0,0,0);
		    	$pdf->Cell(41, 5.5, $GTID, $bo, 2, 'C', 0);
		    	$pdf->Cell(41, 5.5, $OLDGSID, $bo, 0, 'C', 0);

				// Official Name
				$pdf->SetTextColor(0,0,0);
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',11);
			    $pdf->SetXY(7.8, 96);
			    $pdf->Cell(95, 7, $ApplicantName, $bo, 0, 'C', 0);

			    // Gender
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',11);
			    $pdf->SetXY(110, 96);
			    $pdf->Cell(46.5, 7, $Gender, $bo, 0, 'C', 0);

			    // Date of Birth
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',11);
			    $pdf->SetXY(7.8, 112.5);
			    $pdf->Cell(95, 7, $DOB, $bo, 0, 'C', 0);

			    // Grade
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',11);
			    $pdf->SetXY(42, 45.5);
			    $pdf->Cell(26.5, 5, $Grade, $bo, 0, 'C', 0);

			    // ReferralCode
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',11);
			    $pdf->SetXY(74, 45.5);
			    $pdf->Cell(26.5, 5, $referal_code, $bo, 0, 'C', 0);

			    // FatherName
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',11);
			    $pdf->SetXY(7.8, 164.5);
			    $pdf->Cell(95, 7, $FatherName, $bo, 0, 'C', 0);

			    // FatherNIC
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',11);
			    $pdf->SetXY(7.8, 178.5);
			    $pdf->Cell(95, 7, $FatherNIC, $bo, 0, 'C', 0);

			    // Father Mobile
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',11);
			    $pdf->SetXY(7.8, 252);
			    $pdf->Cell(95, 8, $FatherMobile, $bo, 2, 'C', 0);
			    $pdf->Cell(95, 7, $FatherEmail, $bo, 0, 'C', 0);

			    // MotherName
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',11);
			    $pdf->SetXY(110, 164.5);
			    $pdf->Cell(95, 7, $MotherName, $bo, 0, 'C', 0);

			    // MotherNIC
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',11);
			    $pdf->SetXY(110, 178.5);
			    $pdf->Cell(95, 7, $MotherNIC, $bo, 0, 'C', 0);

			    // Mother Mobile
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',11);
			    $pdf->SetXY(110, 252);
			    $pdf->Cell(95, 8, $MotherMobile, $bo, 2, 'C', 0);
			    $pdf->Cell(95, 7, $MotherEmail, $bo, 0, 'C', 0);

			    /*// Request No.
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',10);
			    $pdf->SetXY(184.5, 24);
			    $pdf->Cell(12.5, 5, str_pad($req_id, 3, "0", STR_PAD_LEFT), $bo, 0, 'C', 0);*/
			}
		}

		// Output the new PDF
		$pdf->Output('xyz' . '.pdf', 'I');
		//$pdf->Output();
    }	
	// End Saqib Created Methods
	
	/*
	 * -------------------------------------------------------
	 *  Show FIF 
	 * -------------------------------------------------------
	 */
	public function show_fif(){
		$this->load->model('gs_admission/ajax_base_model', 'AB');
		$gf_id = $this->input->post('gf_id');
		$fifHtml = $this->show_fif_html($gf_id);
		$return = array("fH"=>$fifHtml);
		echo json_encode($return);
	}
	
	public function show_fif_html($gf_id){
		$this->load->model('gs_admission/ajax_base_model', 'AB');
		$fIfno = $this->AB->getfif($gf_id);
		
		$fPhotoExists2=false;
		$father_photo='';
		$mother_photo='';
		if( !empty( $fIfno )){
			foreach( $fIfno as $s ){
				$father_photo2 = "assets/photos/sis/150x150/father/".$s["photo_id"].".png";
				$mother_photo2 = "assets/photos/sis/150x150/mother/".$s["photo_id"].".png";
				if( $fPhotoExists2 === false){
					if( file_exists($father_photo2) ){
						$father_photo = base_url().$father_photo2;
						$mother_photo = base_url().$mother_photo2;
						$fPhotoExists2=true;	
					}
				}else{}
			}
		}
		
		$html = '';
		$html .= '<ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#ParentInformation">Parents</a></li>
                                <li><a data-toggle="tab" href="#Siblinginformation">Siblings</a></li>
                             </ul><!-- nav-tabs -->
							 <div class="tab-content" id="">';
							 
		$html .= '<div id="ParentInformation" class="tab-pane fade in active">';
			$html .= '<div class="col-md-6 text-center">';
				$html .= '<img src='.$father_photo.' /><br /><br /><h4>'.$fIfno[0]['father_name'].'</h4>';
				//$html .= print_r( $fIfno );
			$html .= '</div>';
			$html .= '<div class="col-md-6 text-center">';
				$html .= '<img src='.$mother_photo.' /><br /><br /><h4>'.$fIfno[0]['mother_name'].'</h4>';
			$html .= '</div>';
		$html .= '</div><!-- ParentInformation -->';
		
		$fPhotoExists=false;
		$father_photo1='';
		$html .= '<div id="Siblinginformation" class="tab-pane fade">';
		if( !empty( $fIfno )){
		foreach( $fIfno as $s ){
			
		$father_photo2 = "assets/photos/sis/150x150/father/".$s["photo_id"].".png";
			if( $fPhotoExists === false){
				if( file_exists($father_photo2) ){
					$father_photo1 = base_url().$father_photo2;
					$fPhotoExists=true;	
				}
			}else{}
			
			
			$html .= '<div class="col-md-6 childInfo">';
					  $html .= '<div class="col-md-6 SiblingPic">';
						$html .= '<img src="http://10.10.10.63/gs/assets/photos/sis/150x150/student/'.$s["photo_id"].'.png" /><br />';
						$html .= '<span class="houseInfo text-center">';
							$html .= '<span class="iqbal">'.$s["house_name"].'</span>';
							$html .= '</span><!-- houseInfo --><br />';
					 $html .= '</div><!-- SiblingPic -->';
			 
				$html .= '<div class="col-md-6 SiblingInfo text-center">';
						$html .= '<h4>'.$s["official_name"].'</h4>';
						$html .= '<span class="otherInfo">';
						$html .= '<small>'.$s["gf_id"].' | '.$s["gs_id"].'</small>';
						$html .= '</span><!-- otherInfo --><br />';
						$html .= '<span class="gradeInfo">';
						$html .= '<small>'.$s["grade_name"].'-'.$s["section_name"].'</small>';
						$html .= '</span><!-- gradeInfo --><br />';
						$html .= '<span class="dateJoin">';
						$html .= '<small>'.$s["DOB"].'</small>';
						$html .= '</span><!-- dateJoin --><br />';
						if(empty($s["std_status_code"])){
							$html .= '<input type="hidden" value="'.$s["official_name"].'" id="'.$s["gs_id"].'_official_name">';
							$html .= '<input type="hidden" value="'.$s["call_name"].'" id="'.$s["gs_id"].'_call_name">';
							$html .= '<input type="hidden" value="'.$s["gender"].'" id="'.$s["gs_id"].'_gender">';
							$html .= '<button style="margin: 10px; line-height: 13px; font-size:  11px;" class="btn btn-primary" onclick="setStudentData(&#39;'.$s["gs_id"].'&#39;)" >Re-admission</button>';

						}
						$html .= '<span class="activeStatus">';
						$html .= '<small><strong>'.$s["std_status_code"].'</strong></small>';	
						
						
						$html .= '</span><!-- activeStatus -->';
						
					$html .= '</div><!-- SiblingInfo -->';
			$html .= '</div><!-- col-md-6 -->';
		
				
		}
	}else{
		
	}
		 $html .= '</div><!-- Siblinginformation -->';
		 $html .= '</div>';
		   
			return  $html;
			//echo $html;
			
	}
	// END fif
	

	public function getAndUpdateSlots($slot_id,$batch_id){

		$where = array(
			'form_batch_id' => $batch_id,
			'batch_slot_id' => $slot_id
		);


		$admission_data = $this->AB->get_by_all('atif_gs_admission.admission_form','',$where);

		$admission_form_id = $admission_data[0]->id;

		$where_slot =  array(
			'form_batch_id' => $batch_id,
			'id' => $slot_id
		);

		$data = array(
			'admission_form_id' => $admission_form_id
		);

		$this->AB->update_data('atif_gs_admission._form_batch_slots',$where_slot,$data);
	}

		//zk create function for comments and foam id  to add comments to table 
		// Add logs[Reasion] from log atif_gs_admission.log_form_comments table
	public function add_reasion($admission_form_id, $reason, $comments)
	{		
		 $where_reasion =  array(
		 	'admission_form_id' => $admission_form_id,
		 );
 		

		$data = array(
			'admission_form_id' => $admission_form_id,
			'reason' => $reason,
			'comments' => $comments,
			"created"=>time(),
			"register_by" =>$this->session->userdata("user_id"),
			"modified"=>time(),
			"modified_by" =>$this->session->userdata("user_id"),
		);
		$this->AB->set("log_form_comments",$data);
		//$this->AB->update_data('atif_gs_admission.log_form_comments',$where_reasion,$data);
		
	}

	// GET ADMISSION DETAIL FORM
	public function admission_detail($form_id){
		$where = array(
			'id' => $form_id
		);
		$admission_form_detail = $this->AB->get_by_all('atif_gs_admission.admission_form','',$where,'');
		return $admission_form_detail;
	}

}