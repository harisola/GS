<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Authorities_ad2 extends CI_Controller{
	
    public function __construct(){
        parent::__construct();
		$this->load->library('session');
    }
	
	
	public function getCommentsType(){
		
		$this->load->model('gs_admission/authorities_model', 'AB');
		
		$stage = $this->input->post("formStage");
		$form_id = $this->input->post("form_id");
		
		if($stage == "waitList"){
			$this->confirmAdmissionComments($form_id,$stage);
		}elseif( $stage == "onHold"){
			$this->regretComments($form_id,$stage);
		}else{
			$this->allAppComments($form_id,$stage);
		}
		
	}
	
	public function confirmAdmissionComments($form_id,$stage){
		$this->load->model('gs_admission/frontoffice_followup_model', 'ff');
		$fInfo = $this->ff->getFormInfo($form_id);
		$data["student_name"] = $fInfo["official_name"];
		$data["stage"] = "Wait List";
		$data["type"] = "waitList";
		$data["form_id"] = $form_id;
		$this->load->model('gs_admission/comment_log', 'CL');
		$data["formHistory"] = $this->CL->get_log($form_id);
		
		$this->load->view('gs_admission/authorities_level_2/comments',$data);
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
		
		$this->load->view('gs_admission/authorities_level_2/comments',$data);
	}
	
	public function regretComments($form_id,$stage){
		$this->load->model('gs_admission/frontoffice_followup_model', 'ff');
		$fInfo = $this->ff->getFormInfo($form_id);
		$data["student_name"] = $fInfo["official_name"];
		$data["stage"] = "On Hold";
		$data["type"] = "onHold";
		$data["form_id"] = $form_id;
		$this->load->model('gs_admission/comment_log', 'CL');
		$data["formHistory"] = $this->CL->get_log($form_id);
		$this->load->view('gs_admission/authorities_level_2/comments',$data);
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
		$this->load->view('gs_admission/authorities_level_2/comments',$data);
	
	}
	
	// Get Form Data and update admission form table
	public function getFormData(){
		$this->load->model('gs_admission/authorities_model', 'AB');
		$this->load->model('gs_admission/comment_log', 'CL');
		
		$reviveApplication = $this->input->post("reviveApplication");
		$txt_comments = $this->input->post("txt_comments");
		$stageType = $this->input->post("stageType");
		$form_id = $this->input->post("form_id");
		
		
		if( $this->input->post("txt_comments") != NULL ){
			$txt_comments = $this->input->post("txt_comments");
			$log = array("admission_form_id"=>$form_id, "reason" => "RIV", "comments" => $txt_comments, "created"=>time(),"register_by" =>$this->session->userdata("user_id"));
			$table_log ="log_form_comments";
			$this->CL->insert_log($table_log,$log);
			
		}
		
		$set_data = array("form_status_stage_id"=>14, "modified"=>time(),"modified_by" =>$this->session->userdata("user_id"));
		$table ="admission_form";
		$where = array("id"=>$form_id);
		$this->AB->update_function($table, $set_data, $where);
		
		
		$data = array("rve"=>$reviveApplication,"cm"=> $txt_comments,"stg"=>$stageType,"fid"=>$form_id);
		echo json_encode($data);
	}
	
	
	public function reloadTableData(){
		$this->load->model('gs_admission/authorities_model', 'AB');
		$data["ConfirmAdmission"] = $this->AB->wait_list();
		$data["Not_Interested"]   = $this->AB->on_hold();
		$data["All_Applications"] = $this->AB->allAppAdmin();
		var_dump($data);
		exit;
		$this->load->view('gs_admission/authorities_level_2/right_side_table',$data);
	}	
	
}// Authorities_level_one
