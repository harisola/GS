<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Admission_frontoffice_followup extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
	}


	public function index(){


		if($this->ion_auth->logged_in() == FALSE){
			redirect('welcome');
		}else{
			$this->load->model('gs_admission/frontoffice_followup_model', 'fof');
			
		    $this->load->view('gs_files/header');
		    $this->load->view('gs_files/main-nav');
		    $this->load->view('gs_files/breadcrumb');
			$user_id = (int)$this->session->userdata("user_id");
			//echo $current_data = date("Y-m-d",time()); exit;
			$current_data="";
			
			//  Followup Form List
			$data['followUpLists'] = $this->fof->getFollowupFormsFrontOffice($current_data);
			
			// Communication Form List
			$data['CommunicationLists'] = $this->fof->getFOFormsInCommunicationStage($current_data);
			
			
			// All Applicant Form List
			$data['AllApplicantLists'] = $this->fof->getFOFormsInAllApplicantStage($current_data);

			$data['get_offer_user_expire'] = $this->fof->get_offer_user_expire();	

			$data['get_followup_hold'] = $this->fof->get_followup_hold();	


			
			
			
			//var_dump( $data['followUpLists'] ); exit;
			
			$this->load->view('gs_admission/fo_followup/fo_followup_view',$data);
			$this->load->view('gs_admission/fo_followup/fo_followup_footer');		
		}
	}
}