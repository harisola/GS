<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Frontoffice_followup extends CI_Controller{
    public function __construct(){
        parent::__construct();
		$this->load->library('session');
    }
	
	
	public function add_comments(){
		
		$this->load->model('gs_admission/frontoffice_followup_model', 'ff');
		$form_stage = $this->input->post("form_stage");
		$form_id = $this->input->post("form_id");
		$FOStatus = $this->input->post("FOStatus");
		$given_slot_id = $this->input->post("given_slot_id");
		$currentStage = $this->input->post("currentStage");
		$comments = $this->input->post("followupComments");
		
		$batch_id =  '';
		$time_slot = '';
		
		if( $currentStage == 'Submission' &&  $FOStatus == 'Ext' ){
			
			if( $this->input->post("submission_ext") != NULL ){
				$submission_ext = $this->input->post("submission_ext");	
			}
			
			// Extend Form Submission Date
			$this->extends_submission_date( $form_id, $submission_ext );

			$comments =  $comments." Extended Submission Date to ".date("D j, M Y",strtotime($submission_ext));
			
			$stage_id=10; // 5 For Followup
			$stage='Submission';
			$this->changeStage($form_id, $stage_id,$batch_id=NULL, $time_slot=NULL,$stage );
			
			
		}elseif( $currentStage == 'Assessment' &&  $FOStatus == 'Ext' ){
			
			if( $this->input->post("batch_id") != NULL ){
				$batch_id = $this->input->post("batch_id");	
				$ass = $this->ff->getFormBatchByBatchId($batch_id);
				$assessment_date = $ass["assessmentDate"];
				
			}
			
			if( $this->input->post("time_slot") != NULL ){
				$time_slot = $this->input->post("time_slot");
				
			}
			
			
				// update slot time given slot
				$this->update_form_slot( $form_id, $given_slot_id, $batch_id, $time_slot );
				
				// Give new assesment date
				$this->extends_assessment_date( $form_id, $assessment_date, $given_slot_id );
				$stage_id=10; // 5 For Followup
				$stage='Assessment';
				$this->changeStage($form_id, $stage_id,$batch_id, $time_slot,$stage );
			
			
		}elseif( $currentStage == 'Fee Bill' &&  $FOStatus == 'Ext' ){
			
			if( $this->input->post("submission_ext") != NULL ){
				$submission_ext = $this->input->post("submission_ext");	
			}else{
				$submission_ext='';
			}
			
			$form_no = $this->input->post("form_no");	
			
			// Extend Fee Bill Submission Due Date
			$this->ff->extend_fee_bill_due_date( $form_no, $submission_ext );
			$stage_id=10; // 5 For Followup
			$stage='Fee_Bill';
			$this->changeStage($form_id, $stage_id,$batch_id=NULL, $time_slot=NULL,$stage );

			$stage_id=2; // 5 For Followup
			$stage='communication';
			$this->changeStage($form_id, $stage_id,$batch_id=NULL, $time_slot=NULL,$stage );
			
		}else if($currentStage == 'Discussion' &&  $FOStatus == 'Ext'){

			$form_no = $this->input->post("form_no");

			if( $this->input->post("submission_ext") != NULL ){
				$submission_ext = $this->input->post("submission_ext");	
			}else{
				$submission_ext='';
			}

			$this->ff->update_discussion_date($form_no,$submission_ext);

			$stage_id=10; // Extension
			$stage='Discussion';
			$this->changeStage($form_id, $stage_id,$batch_id=NULL, $time_slot=NULL,$stage );

		}else if($currentStage == 'Offer' && $FOStatus == 'Ext'){

			$form_no = $this->input->post("form_no");


			if( $this->input->post("submission_ext") != NULL ){
				$submission_ext = $this->input->post("submission_ext");	
			}else{
				$submission_ext='';
			}
			
			$comments =  $comments." Offer  Date Extend  to ".date("D j, M Y",strtotime($submission_ext));

			$this->ff->update_offer_date($form_no,$submission_ext);

			$stage_id=10; // Extension
			$stage='Offer';
			$this->changeStage($form_id, $stage_id,$batch_id=NULL, $time_slot=NULL,$stage );

		}else{
			
			if(  $FOStatus == 'NI' ){
				$stage_id=7; // 7 For Not Interested
				$stage='Not_Interested';
			}else if(  $FOStatus == 'NR' ){
				$stage_id=11; // 11 For No Response
				$stage='No_Response';
			}else{
				$stage_id=2; // 2  For No Communication
				$stage='communication';
			}
			$this->changeStage($form_id, $stage_id,$batch_id=NULL, $time_slot=NULL,$stage);

		}
		// add comments
		$lastID = $this->addLogs($form_id, $FOStatus, $comments );
		
		$return = array( "Log_id"=>$lastID );
		echo json_encode(  $return );
	}
	
	
	public function getCommentsType(){
		$formStage = $this->input->post("formStage");
		$form_id = $this->input->post("form_id");
		
		$currentStage = $this->input->post("currentStage");
		
		if( $formStage == 'followup' ){
			$this->followupComments( $form_id,$currentStage );
		}elseif( $formStage == 'followuphold' ){
			$this->communicationComments($form_id,$currentStage );
		}elseif( $formStage == 'communication' ){
			$this->communicationComments($form_id,$currentStage );
		}else{
			$this->allApplicationComments($form_id,$currentStage);
		}
		
	}
	
	/*
	 * --------------------------------------------------
		Get Form Follow Up Commenst Right Side Screen
	 * -------------------------------------------------- 
	*/
	public function followupComments( $form_id,$currentStage ){
		$this->load->model('gs_admission/frontoffice_followup_model', 'ff');
		$this->load->model('gs_admission/submission_model', 'SM');
		$this->load->model('gs_admission/comment_log', 'CL');
		
		
		$gSlot = $this->ff->giveSlot( $form_id );
		$data["form_id"]=$form_id;
		$data["give_slot_id"] = $gSlot["id"];
		
		$form_batch_id = $gSlot["form_batch_id"];
		$data['form_batch_id'] = $form_batch_id;
		
		
		$fInfo = $this->ff->getFormInfo($form_id);
		$grade_id = $fInfo["grade_id"];
		$data['form_no'] = $fInfo["form_no"];
		$data["student_name"] = $fInfo["official_name"];
		$data["formInfo"] = $fInfo;
		
		$data["fComt"] = $this->ff->getFormComments($form_id);
		
		$data["currentStage"] =$currentStage;


		$data["batch"] = $this->ff->getBatchInfo($grade_id);
		
		
		//$data['formHistory'] = $this->ff->getFormHistoryLogs($form_id);
		$data["formHistory"] = $this->CL->get_log($form_id);
		
		
		
		//var_dump($formHistory); exit;
		//$data["formHistory"]
		///$data["Logs"] = $this->ff->getFormCommentsLogs($form_id);
		if( $form_batch_id != '' ){
			$data["timeSlots"] = $this->SM->getSlots($form_batch_id,$form_id);	
		}
		
		
		$this->load->view('gs_admission/fo_followup/fo_followup_comments',$data);
	}
	
	/*
	 * --------------------------------------------------
		Get Form Communication Commenst Right Side Screen
	 * -------------------------------------------------- 
	*/
	
	public function communicationComments( $form_id,$currentStage ){
		$this->load->model('gs_admission/frontoffice_followup_model', 'ff');
		$this->load->model('gs_admission/comment_log', 'CL');
		
		$gSlot = $this->ff->giveSlot( $form_id );
		$data["form_id"]=$form_id;
		$data["give_slot_id"] = $gSlot["id"];
		$data['form_batch_id'] = $gSlot["form_batch_id"];
		$fInfo = $this->ff->getFormInfo($form_id);
		$grade_id = $fInfo["grade_id"];
		$data["student_name"] = $fInfo["official_name"];
		$data["formInfo"] = $fInfo;
		$data["fComt"] = $this->ff->getFormComments($form_id);
		$data["currentStage"] =$currentStage;
		$data["batch"] = $this->ff->getBatchInfo($grade_id);
		
		//$data['formHistory'] = $this->ff->getFormHistoryLogs($form_id);
		$data["formHistory"] = $this->CL->get_log($form_id);
		
		$this->load->view('gs_admission/fo_followup/fo_communication_comments',$data);
	}
	
	
	/*
	 * --------------------------------------------------
		Get Form allApplicationComments Commenst Right Side Screen
	 * -------------------------------------------------- 
	*/
	public function allApplicationComments($form_id,$currentStage){
		$this->load->model('gs_admission/frontoffice_followup_model', 'ff');
		$this->load->model('gs_admission/comment_log', 'CL');
		$gSlot = $this->ff->giveSlot( $form_id );
		$data["form_id"]=$form_id;
		$data["give_slot_id"] = $gSlot["id"];
		$data['form_batch_id'] = $gSlot["form_batch_id"];
		$fInfo = $this->ff->getFormInfo($form_id);
		$grade_id = $fInfo["grade_id"];
		$data["student_name"] = $fInfo["official_name"];
		$data["formInfo"] = $fInfo;
		$data["fComt"] = $this->ff->getFormComments($form_id);
		$data["currentStage"] =$currentStage;
		$data["batch"] = $this->ff->getBatchInfo($grade_id);

		
		//$data['formHistory'] = $this->ff->getFormHistoryLogs($form_id);
		$data["formHistory"] = $this->CL->get_log($form_id);

		
		$this->load->view('gs_admission/fo_followup/fo_allApp_comments',$data);
	}
	
	
	/*
	 * --------------------------------------------------
		Add Form Comment
	 * -------------------------------------------------- 
	*/
	public function addLogs($form_id, $FOStatus, $comments ){
		$this->load->model('gs_admission/frontoffice_followup_model', 'ff');
		$log_comments = array(
			"admission_form_id" => $form_id, 
			"reason" => $FOStatus,
			"comments"=>$comments, 
			"created"=>time(), 
			"register_by" => $this->session->userdata("user_id"),
			"modified" => $this->session->userdata("user_id")
			);
		$table = "log_form_comments";
		$lastID = $this->ff->insertData($table,$log_comments);
		return $lastID;
	}
	
	
	
	/*
	 * --------------------------------------------------
		Update Form Slot 
		on Follow Up Screen
	 * -------------------------------------------------- 
	*/
	public function update_form_slot( $form_id, $given_slot,$batch_id,$slot_id ){
		$this->load->model('gs_admission/frontoffice_followup_model', 'ff');
		$form_batch_slots = "_form_batch_slots";
		
		// first get current time slot id batch and time wise
		//$sId = $this->ff->getAvailableSlotBatch_Slot_Wise($batch_id, $slot_id);
		//$newSlotId = $sId["id"];
		
		
		// give new time slot for applicant form
		$data = array(
			"admission_form_id"=>$form_id,
			"modified" =>time(),
			"modified_by" =>$this->session->userdata("user_id")
		);
		$where = array("id"=> $slot_id);
		$this->ff->update_function( $form_batch_slots, $data, $where );
		
		
		// set revised_batch_slot_id to newly given slot id through already given slot id
		$data1 = array(
			"revised_batch_slot_id"=>$slot_id,
			"modified" =>time(),
			"modified_by" =>$this->session->userdata("user_id")
		);
		$where1 = array("id"=> $given_slot);
		$this->ff->update_function( $form_batch_slots, $data1, $where1 );
	}
	
	/*
	 * --------------------------------------------------
		Get Batch Slot Time
	 * -------------------------------------------------- 
	*/
	public function batchSlot(){
		$this->load->model('gs_admission/frontoffice_followup_model', 'ff');
		$batch_id = $this->input->post("batch_id");
		$options = $this->ff->getBatchSlot($batch_id);
		// id , time_start
		$html = '';
		$html .= '<option value="">Time Slot *</option>';
		foreach( $options as $opt ){
			$html .= '<option value='.$opt["id"].'>'.$opt["time_start"].'</option>';
		}
		$return = array( "op" => $html );
		echo json_encode( $return );
	}
	
	/*
	 * ----------------------------------------------------
	    Change Form Stage 
	 * ----------------------------------------------------
	*/
	public function changeStage($form_id, $stage_id, $batch_id=NULL, $time_slot=NULL,$stage){
		$this->load->model('gs_admission/frontoffice_followup_model', 'ff');
		
		// set revised_batch_slot_id to newly given slot id through already given slot id
		$table = "admission_form";
		
		if( $stage_id == 10 && $stage== 'Assessment' ){
			$data1 = array(
				"form_batch_id" => $batch_id, 
				"batch_slot_id" => $time_slot,
				"form_status_stage_id"=>$stage_id,
				"modified" =>time(),
				"modified_by" =>$this->session->userdata("user_id")
			);
		}elseif( $stage_id == 10 && $stage== 'Fee_Bill' ){

			$data1 = array(
				"form_status_stage_id"=>$stage_id,
				"modified" =>time(),
				"modified_by" =>$this->session->userdata("user_id")
			);


		}else{
			$data1 = array(
			"form_status_stage_id"=>$stage_id,
			"modified" =>time(),
			"modified_by" =>$this->session->userdata("user_id")
		);
		}
		
		$where1 = array("id"=> $form_id);
		$this->ff->update_function( $table, $data1, $where1 );
		
	}
	
	
	public function reloadTableData(){
		$this->load->model('gs_admission/frontoffice_followup_model', 'fof');
		$user_id = (int)$this->session->userdata("user_id");
		$current_data="";
		//  Followup Form List
		$data['followUpLists'] = $this->fof->getFollowupFormsFrontOffice($current_data);
		// Communication Form List
		$data['CommunicationLists'] = $this->fof->getFOFormsInCommunicationStage($current_data);
		// All Applicant Form List
		$data['AllApplicantLists'] = $this->fof->getFOFormsInAllApplicantStage($current_data);
		$data['get_followup_hold'] = $this->fof->get_followup_hold();	


		//var_dump( $data['followUpLists'] ); exit;
		$this->load->view('gs_admission/fo_followup/left_side_table_data',$data);
	}
	
	function extends_submission_date( $form_id, $submission_ext ){
		
		$this->load->model('gs_admission/frontoffice_followup_model', 'ff');
		$table = "admission_form";
		$data = array(
			"form_submission_date"=>$submission_ext,
			"modified" =>time(),
			"modified_by" =>$this->session->userdata("user_id")
		);
		$where = array("id"=> $form_id);
		$this->ff->update_function( $table, $data, $where );
		
	}
	
	
	function extends_assessment_date( $form_id, $new_assessment_date, $aSlotID ){
		
		$this->load->model('gs_admission/frontoffice_followup_model', 'ff');
		
		$table = "admission_form";
		
		$data = array(
			"form_assessment_date"=>$new_assessment_date,
			"modified" =>time(),
			"modified_by" =>$this->session->userdata("user_id")
		);
		$where = array("id"=> $form_id);
		$this->ff->update_function( $table, $data, $where );
		
	}
	
}// frontoffice_followup class