<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Frontoffice_communication extends CI_Controller{
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
		$comments = $this->input->post("comments");
		
		
		$lastID = $this->addLogs($form_id, $FOStatus, $comments );
		
		if( $FOStatus == 'Ext' ){
			$stage_id=10; // 5 For Followup
			$this->changeStage($form_id, $stage_id );
		}elseif(  $FOStatus == 'NI' ){
			$stage_id=7; // 7 For Not Interested
			$this->changeStage($form_id, $stage_id );
		}elseif(  $FOStatus == 'CMM' ){
			$stage_id=1; // 7 For Communite
			$this->changeStage($form_id, $stage_id );
		}else{
			$stage_id=11; // 11 For No Response
			$this->changeStage($form_id, $stage_id );
		}
		
		$return = array( "Log_id"=>$lastID );
		echo json_encode(  $return );
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
	 * ----------------------------------------------------
	    Change Form Stage 
	 * ----------------------------------------------------
	*/
	public function changeStage($form_id, $stage_id){
		$this->load->model('gs_admission/frontoffice_followup_model', 'ff');
		
		// set revised_batch_slot_id to newly given slot id through already given slot id
		$table = "admission_form";
		
		
		// set revised_batch_slot_id to newly given slot id through already given slot id
		$table = "admission_form";
		
		if( $this->ff->get_requested_form($form_id) ){
			
			$data1 = array(
				"form_status_stage_id"=>$stage_id,
				"request_grade"=>0,
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
	
	
}// frontoffice_followup class