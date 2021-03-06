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

		$given_batch_id = $this->input->post('form_batch_id');
		$given_slot_id = $this->input->post("given_slot_id");

		$currentStage = $this->input->post("currentStage");
		$comments = $this->input->post("comments");

		$currentStaged = $this->input->post('currentStaged');

		
		$lastID = $this->addLogs($form_id, $FOStatus, $comments );
		
		if( $FOStatus == 'Ext' ){
			$stage_id=10; // 5 For Followup
			$this->changeStage($form_id, $stage_id );
		}elseif(  $FOStatus == 'NI' ){
			$stage_id=7; // 7 For Not Interested
			$this->changeStage($form_id, $stage_id );
		}elseif(  $FOStatus == 'FHD' ){
			$stage_id=20; // 7 For Not Interested
			#$this->changeStage($form_id, $stage_id );
			
			$followup_date = $this->input->post("submission_ext");
			$this->make_followup_hold($form_id, $followup_date, $stage_id);
			
		}elseif(  $FOStatus == 'RFHD' ){
			$stage_id=3; // 7 For Not Interested
			#$this->changeStage($form_id, $stage_id );
			
			$followup_date = '0000-00-00';
			$this->make_followup_hold($form_id, $followup_date, $stage_id);
			
		}
		elseif(  $FOStatus == 'CMM' ){
			$stage_id=1; // 7 For Communite
			$this->changeStage($form_id, $stage_id );
		}elseif($FOStatus == 'EXTENSION' && $currentStaged == 'Submission'){
			// IF Extension
			$stage_id=10;
			$this->UpdateBatch($form_id,$given_batch_id,$given_slot_id);
			
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


	public function make_followup_hold($form_id, $followup_date,$stage_id)
	{
		$this->load->model('gs_admission/frontoffice_followup_model', 'ff');
		$table = "admission_form";
		$data = array(
				"form_status_stage_id"=>$stage_id,
				"followup_hold_date" => $followup_date,
				"modified" =>time(),
				"modified_by" =>$this->session->userdata("user_id")
			);	
		$where = array("id"=> $form_id);
		$this->ff->update_function( $table, $data, $where);
	}

	// Update Batch Slots
	public function UpdateBatch($form_id,$given_batch_id,$given_slot_id){

		
		$this->load->model('gs_admission/frontoffice_followup_model', 'ff');
		$admission_data = $this->ff->get_admission_data($form_id);
		$form_previous_batch_id = $admission_data[0]['form_batch_id'];
		$form_previous_slot_id = $admission_data[0]['batch_slot_id'];

		$where  = array(
			'form_batch_id' => $form_previous_batch_id,
			'id' => $form_previous_slot_id
		);

		
		$data = array(
			'revised_batch_slot_id' => $given_slot_id
		);

		$flag_update = $this->ff->update_function('atif_gs_admission._form_batch_slots',$data,$where);

		//admission slot update 

		$where = array(
			'form_batch_id'=>$given_batch_id,
			'id' => $given_slot_id
		);

		$data = array(
			'admission_form_id' => $form_id
		);

		$flag_update_admission = $this->ff->update_function('atif_gs_admission._form_batch_slots',$data,$where);

		// Admission form update

		$where = array(
			'id' => $form_id
		);

		$data = array(
			'form_batch_id' => $given_batch_id,
			'batch_slot_id' => $given_slot_id
		);

		$flag_update_admission = $this->ff->update_function('atif_gs_admission.admission_form',$data,$where);

	}
	
	
}// frontoffice_followup class