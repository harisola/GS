<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Authorities_po2 extends CI_Controller{
	
    public function __construct(){
        parent::__construct();
		$this->load->library('session');
    }
	
	
	public function getCommentsType(){
		
		$this->load->model('gs_admission/authorities_model', 'AB');
		
		$stage = $this->input->post("formStage");
		$form_id = $this->input->post("form_id");
		
		if($stage == "confirmAdmission"){
			$this->confirmAdmissionComments($form_id,$stage);
		}elseif( $stage == "notInterestd"){
			$this->notInterestedComments($form_id,$stage);
		}elseif( $stage == "regret"){
			$this->regretComments($form_id,$stage);
		}elseif( $stage == "RequestForGrade"){
			$this->requestForGrade($form_id,$stage);
		}else{
			$this->allAppComments($form_id,$stage);
		}
		
	}
	
	public function confirmAdmissionComments($form_id,$stage){
		$this->load->model('gs_admission/frontoffice_followup_model', 'ff');
		$fInfo = $this->ff->getFormInfo($form_id);
		$data["student_name"] = $fInfo["official_name"];
		$data["stage"] = "Confirm Admission";
		$data["type"] = "confirm_admission";
		$data["form_id"] = $form_id;
		$this->load->model('gs_admission/comment_log', 'CL');
		$data["formHistory"] = $this->CL->get_log($form_id);
		
		$this->load->view('gs_admission/authorities_level_1/comments',$data);
	}
	
	public function notInterestedComments($form_id,$stage){
		$this->load->model('gs_admission/frontoffice_followup_model', 'ff');
		$fInfo = $this->ff->getFormInfo($form_id);
		$data["student_name"] = $fInfo["official_name"];
		$data["stage"] = "Not Interested";
		$data["type"] = "not_interested";
		$data["form_id"] = $form_id;
		$this->load->model('gs_admission/comment_log', 'CL');
		$data["formHistory"] = $this->CL->get_log($form_id);
		
		$this->load->view('gs_admission/authorities_level_1/comments',$data);
	}
	
	public function regretComments($form_id,$stage){
		$this->load->model('gs_admission/frontoffice_followup_model', 'ff');
		$fInfo = $this->ff->getFormInfo($form_id);
		$data["student_name"] = $fInfo["official_name"];
		$data["stage"] = "Regret";
		$data["type"] = "regret";
		$data["form_id"] = $form_id;
		$this->load->model('gs_admission/comment_log', 'CL');
		$data["formHistory"] = $this->CL->get_log($form_id);
		$this->load->view('gs_admission/authorities_level_1/comments',$data);
	}
	
	public function allAppComments($form_id,$stage){
		$this->load->model('gs_admission/frontoffice_followup_model', 'ff');
		$fInfo = $this->ff->getFormInfo($form_id);
		$data["student_name"] = $fInfo["official_name"];
		$data["stage"] = "All Applications";
		$data["type"] = "all_applications";
		$data["form_id"] = $form_id;
		$this->load->model('gs_admission/comment_log', 'CL');
		$data["formHistory"] = $this->CL->get_log($form_id);
		$this->load->view('gs_admission/authorities_level_1/comments',$data);
	
	}
	
	public function requestForGrade($form_id,$stage){
		$this->load->model('gs_admission/frontoffice_followup_model', 'ff');
		$fInfo = $this->ff->getFormInfo($form_id);
		$data["student_name"] = $fInfo["official_name"];
		
		$data["admission_in_grade_age"] = $fInfo["grade_id"];
		$data["request_for_grade"] = $fInfo["request_for_grade"];
		
		
		$data["stage"] = "Reqest For Grade";
		$data["type"] = "RequestForGrade";
		$data["form_id"] = $form_id;
		$this->load->model('gs_admission/comment_log', 'CL');
		$data["formHistory"] = $this->CL->get_log($form_id);
		$this->load->view('gs_admission/authorities_level_1/comments',$data);
	
	}
	
	
	// Get Form Data and update admission form table
	public function getFormData(){


		$this->load->model('gs_admission/authorities_model', 'AB');
		$this->load->model('gs_admission/comment_log', 'CL');
		//$reviveApplication = $this->input->post("reviveApplication");
				
		if( $this->input->post("reviveApplication") != NULL ){
					$reviveApplication = $this->input->post("reviveApplication");
				}else{
					$reviveApplication = 0;
				}
				
				$stageType = $this->input->post("stageType");
				$form_id = $this->input->post("form_id");
				
				$reason='';
				if( $stageType == "RequestForGrade"){
					$admission_in_grade_age = $this->input->post("admission_in_grade_age");
					$request_for_grade = $this->input->post("request_for_grade");
					$reason='RFG';
				}else{
					$admission_in_grade_age = 0;
					$request_for_grade = 0;
					$reason='RIV';
				}
		
		
		if( $this->input->post("revive_txt_comments") != NULL ){
			$txt_comments = $this->input->post("revive_txt_comments");
			$log = array("admission_form_id"=>$form_id, "reason" => "RIV", "comments" => $txt_comments, "created"=>time(),"register_by" =>$this->session->userdata("user_id"));
			$table_log ="log_form_comments";
			$this->CL->insert_log($table_log,$log);
		}

		if( $this->input->post("txt_comments") != NULL ){
			$txt_comments = $this->input->post("txt_comments");
			$log = array("admission_form_id"=>$form_id, "reason" => "RIV", "comments" => $txt_comments, "created"=>time(),"register_by" =>$this->session->userdata("user_id"));
			$table_log ="log_form_comments";
			$this->CL->insert_log($table_log,$log);
		}
		
		//$set_data = array("form_status_stage_id"=>14, "modified"=>time(),"modified_by" =>$this->session->userdata("user_id"));
		$table ="admission_form";
		
			if($stageType != "RequestForGrade"){
			$set_data = array("form_status_stage_id"=>14, "modified"=>time(),"modified_by" =>$this->session->userdata("user_id"));
		}else{
			
			$decision_performed = $this->input->post("decision_performed");
			$array = array( 1=>"PN",2=>"N",3=>"KG",4=>"I",5=>"II",6=>"III",7=>"IV",8=>"V",9=>"VI",10=>"VII",11=>"VIII",12=>"IX",13=>"X",14=>"XI",15=>"A1",16=>"A2" );
			$grade_name = $array[$request_for_grade];
			if((int)$decision_performed == 1 ){ // if form approve for new grade 
			
				if( $this->AB->check_form_submitted( $form_id ) ){ // check if not submitted not submitted will come here ....
					// if form not submitted yet
				$set_data = array( 
				"grade_id"=> $request_for_grade, 
				"grade_name"=> $grade_name,
				"form_status_stage_id" => 2,
				"request_grade"=>2, 
				"modified"=>time(),
				"modified_by" =>$this->session->userdata("user_id") );
				$toBeInform = 1;
				}else{
				$form_batch_slots = "_form_batch_slots";
				
				// give new batch accordingly to grade id
				  $ad = $this->AB->creatAssessmentdate2($request_for_grade);
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
					
				if( !empty( $aSID = $this->AB->getFormSlot2($form_id)  ) ){
					$aSlotID = $aSID["aSlotID"];
					$data1 = array(
						"admission_form_id"=>0,
						"modified" =>time(),
						"modified_by" =>$this->session->userdata("user_id")
					);
					$where1 = array("id"=> $aSlotID);
					$fbs = $this->AB->update_function( $form_batch_slots, $data1, $where1 );
						
				}
				if( $toBeInform == 0 ){
					// new grade approve with new form batch accordingly grade
					// "request_grade"=>2, for communication to parents
					$set_data = array( 
							"form_batch_id" => $batch_id, 
							"batch_slot_id" => $slot_id,
							"grade_id"=> $request_for_grade, 
							"grade_name"=> $grade_name, 
							"form_status_stage_id" => 2,
							"form_assessment_date"=>$batch_date,
							"request_grade"=>2,
							"modified"=>time(),
							"modified_by" =>$this->session->userdata("user_id") 
							);	

							$data3 = array(
								"admission_form_id"=> $form_id,
								"modified" =>time(),
								"modified_by" =>$this->session->userdata("user_id")
							);
							$where3 = array("id"=> $slot_id);

							// if form in to be inform condition than not assigned slot	
							
							$this->AB->update_function( $form_batch_slots, $data3, $where3 );
												
					}else{
							// new grade approve tib
							$set_data = array( 
									"grade_id"=> $request_for_grade, 
									"grade_name"=> $grade_name, 
									"form_status_stage_id" => 2,
									"form_assessment_date"=>$batch_date,
									"request_grade"=>2, 
									"modified"=>time(),
									"modified_by" =>$this->session->userdata("user_id") 
									);
							
						}
							
				
						
				}
				
				
			}else{
				$set_data = array( "request_grade"=>2, "modified"=>time(),"modified_by" =>$this->session->userdata("user_id"));	
			}
			
			
			
		}
		
		
		
		
		
		
		
		
		
		
		
		$where = array("id"=>$form_id);
		$this->AB->update_function($table, $set_data, $where);
		
		
		$data = array("rve"=>$reviveApplication,"cm"=> $txt_comments,"stg"=>$stageType,"fid"=>$form_id);
		echo json_encode($data);
	}
	
	
	public function reloadTableData(){
		$this->load->model('gs_admission/authorities_model', 'AB');
		
		$data["ConfirmAdmission"] = $this->AB->confirm_admission();
		$data["Not_Interested"] = $this->AB->not_interested();
		$data["Regret"] = $this->AB->regret();
		$data["All_Applications"] = $this->AB->all_applications();
		$data["RequestForGrade"] = $this->AB->requestForGrade();
		$this->load->view('gs_admission/authorities_level_1/right_side_table',$data);
	}
	
}// Authorities_level_one
