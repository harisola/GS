<?php

class Admission_post_result_verification extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$user_id =  (int)$this->session->userdata('user_id'); 
		$this->user_id = $user_id;
	}

	public function index(){
		if($this->ion_auth->logged_in() == FALSE){
		redirect('welcome');
		}else{
			$this->load->view('gs_files/header');
	        $this->load->view('gs_files/main-nav');
	        $this->load->view('gs_files/breadcrumb');

	        $this->load->model('admission/offer_model','am');
			$data['regular_admission'] =  $this->am->get_a_level_regular_admission();
			$data['early_admission'] = $this->am->get_a_level_early_admission();



	        $this->load->view('gs_admission/admission_post_result_verification/admission_post_result_verification_view',$data);
	        $this->load->view('gs_admission/admission_post_result_verification/admission_post_result_verification_footer');

	    }
	}

	public function getCommentsType(){
		$formStage = $this->input->post("formStage");
		$form_id = $this->input->post("form_id");
		
		$currentStage = $this->input->post("currentStage");
		
		if( $formStage == 'followup' ){
			$this->followupComments( $form_id,$currentStage );
		}elseif( $formStage == 'communication' ){
			$this->communicationComments($form_id,$currentStage );
		}else{
			$this->allApplicationComments($form_id,$currentStage);
		}
		
	}
	public function updateOfferLetter(){

		$this->load->model('admission/offer_model','am');

		$form_no = $this->input->post("form_no");
		$formCheckList =  $this->input->post("offerLetter") ;

		$where = array(
			'admission_form_id' => $form_no
		);

		$data = array(
			'signed_offer_letter' => $formCheckList
		);
	
		return $updateDate = $this->am->update_data('atif_gs_admission.admission_form_offer',$where,$data);
	}	
	public function updateCheckList(){

		$this->load->model('admission/offer_model','am');

		$form_no = $this->input->post("form_no");
		$formCheckList = implode(',', $this->input->post("formCheckList")) ;

		$where = array(
			'id' => $form_no
		);

		$data = array(
			'alevel_checklist' => $formCheckList
		);
	
		return $updateDate = $this->am->update_data('atif_gs_admission.admission_form',$where,$data);
		
	
		
	}

		public function followupComments( $form_id,$currentStage ){
			$this->load->model('gs_admission/frontoffice_followup_model', 'ff');
			$this->load->model('gs_admission/submission_model', 'SM');
			$this->load->model('gs_admission/comment_log', 'CL');
			
			$data["form_id"]=$form_id;

			
			
			$fInfo = $this->ff->getFormInfo($form_id);
			$grade_id = $fInfo["grade_id"];
			$data['form_no'] = $fInfo["form_no"];
			$data["student_name"] = $fInfo["official_name"];
			$data["formInfo"] = $fInfo;
			
			$data["fComt"] = $this->ff->getFormComments($form_id);

			$data["currentStage"] =$currentStage;
			
			$data["batch"] = $this->ff->getBatchInfo($grade_id);
			
			$data["formHistory"] = $this->CL->get_log($form_id);
		
			$this->load->view('gs_admission/admission_post_result_verification/fo_comments',$data);
		}

		// public function add_comments(){



		// 	$this->load->model('admission/offer_model', 'ofm');
		// 	$form_stage = $this->input->post("form_stage");
		// 	$form_id = $this->input->post("form_id");
		// 	$FOStatus = $this->input->post("FOStatus");
		// 	$comments = $this->input->post("followupComments");



		// 	//FOR REGRT
		// 	if($FOStatus == 'RGT'){
		// 		$stage_id = 6;
		// 		$FOStatus = "Regert";
		// 		$data = array(
		// 			'form_status_stage_id' => $stage_id
		// 		);
		// 		$where = array(
		// 			'id' => $form_id
		// 		);
		// 		$updateDate =  $this->ofm->update_data('atif_gs_admission.admission_form',$where,$data);
		// 	}

		// 	// FOR OFFER APPROVE

		// 	if($FOStatus == 'OFFR'){
		// 		$FOStatus = "Early Admission Offer Approve";
		// 		$data = array(
		// 			'post_result_verification_approval' => 1
		// 		);
		// 		$where = array(
		// 			'admission_form_id' => $form_id
		// 		);
		// 		$updateDate =  $this->ofm->update_data('atif_gs_admission.admission_form_offer',$where,$data);

		// 		$comments = $comments . " Early Admission Approve on ".date("D j, M Y");
		// 	}

		// 	// add comments
		// 	$lastID = $this->addLogs($form_id, $FOStatus, $comments );
			



		// 	return $lastID;
		// }

		public function add_comments(){

			$this->load->model('admission/offer_model', 'ofm');
			$form_stage = $this->input->post("form_stage");
			$form_id = $this->input->post("form_id");
			$FOStatus = $this->input->post("FOStatus");
			$comments = $this->input->post("followupComments");
			$form_discussion_criteria = $this->input->post("form_discussion_criteria");



			//FOR REGRT
			if($FOStatus == 'RGT'){
				$stage_id = 6;
				$FOStatus = "Regert";
				$data = array(
					'form_status_stage_id' => $stage_id
				);
				$where = array(
					'id' => $form_id
				);
				$updateDate =  $this->ofm->update_data('atif_gs_admission.admission_form',$where,$data);
			}

			// FOR OFFER APPROVE

			if($FOStatus == 'OFFR'){
				if($form_discussion_criteria == 'EAO'){
					$FOStatus = "Early Admission Offer Approve";
					$comments = $comments . " Early Admission Approve on ".date("D j, M Y");

				}else{
					$FOStatus = "Regular  Admission Offer Approve";
					$comments = $comments . " Regular Admission Approve on ".date("D j, M Y");
				}

				$data = array(
					'post_result_verification_approval' => 1
				);
				$where = array(
					'admission_form_id' => $form_id
				);


				$flag = $this->ofm->get_by_all('atif_gs_admission.admission_form_offer','',$where);
				if(!$flag){
					$data = array(
						'admission_form_id' => $form_id,
						'post_result_verification_approval' => 1,
						"created"=>time(), 
						"register_by" => $this->session->userdata("user_id"),
						"modified" => $this->session->userdata("user_id"),
						"modified_by" => $this->session->userdata("user_id")
					);
					$this->ofm->insert_data('atif_gs_admission.admission_form_offer',$data);
				}else{
					
				$updateDate =  $this->ofm->update_data('atif_gs_admission.admission_form_offer',$where,$data);
				}


				
			}

			// add comments
			$lastID = $this->addLogs($form_id, $FOStatus, $comments );
			



			return $lastID;
		}

		public function reloadTableData(){

			$this->load->model('admission/offer_model','am');
			$data['regular_admission'] =  $this->am->get_a_level_regular_admission();
			$data['early_admission'] = $this->am->get_a_level_early_admission();

		    $this->load->view('gs_admission/admission_post_result_verification/admission_post_result_verification_left_view_panel',$data);
		}

	/*
	 * --------------------------------------------------
		Add Form Comment
	 * -------------------------------------------------- 
	*/
	public function addLogs($form_id, $FOStatus, $comments ){
		$this->load->model('admission/offer_model', 'ofm');
		$log_comments = array(
			"admission_form_id" => $form_id, 
			"reason" => $FOStatus,
			"comments"=>$comments, 
			"created"=>time(), 
			"register_by" => $this->session->userdata("user_id"),
			"modified" => $this->session->userdata("user_id")
		);
		$table = "atif_gs_admission.log_form_comments";
		$lastID = $this->ofm->insert_data($table,$log_comments);
		return $lastID;
	}

	// GET ALL A-LEVEL CHECKLIST

	public function get_all_checklist(){
		$form_id = $this->input->post('form_id');
		$this->load->model('admission/offer_model', 'ofm');
		$aLevel =  $this->ofm->get_CheckList($form_id);
		echo json_encode($aLevel);

	}
}