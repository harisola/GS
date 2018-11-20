<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admission_form_submission extends CI_Controller{
  public function __construct(){
	parent::__construct();
	$this->load->library('session');
  }
	public function index(){

		if($this->ion_auth->logged_in() == FALSE){
			redirect('welcome');
		}else{
			
			$this->load->model('gs_admission/ajax_base_model', 'AB');
		    $this->load->view('gs_files/header');
	        $this->load->view('gs_files/main-nav');
	        $this->load->view('gs_files/breadcrumb');
			$user_id = (int)$this->session->userdata("user_id");
			$data["formlist"] = $this->AB->list_of_admission_form2();
			
			
			$data["school_lists"] = $this->AB->school_id();
			$data["grade_lists"] = $this->AB->grade_id();
			
			//$data["ad"] = $this->AB->creatAssessmentdate();
			//var_dump( $data["formlist"] ); exit;
			
			$this->load->view('gs_admission/submission/SubmitAdmissionForm',$data);
			$this->load->view('gs_admission/submission/submission_form_footer');
		}
	}
}