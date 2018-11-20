<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Authorities_po extends CI_Controller{
	
    public function __construct(){
        parent::__construct();
		$this->load->library('session');
    }
	
	
	public function index(){
		
		if($this->ion_auth->logged_in() == FALSE){
			redirect('welcome');
		}else{
			$this->load->model('gs_admission/authorities_model', 'AB');
			
			$this->load->view('gs_files/header');
	        $this->load->view('gs_files/main-nav');
	        $this->load->view('gs_files/breadcrumb');
			
			$user_id = (int)$this->session->userdata("user_id");
			$data["ConfirmAdmission"] = $this->AB->confirm_admission();
			//var_dump($data["ConfirmAdmission"] ); exit;
			$data["Not_Interested"] = $this->AB->not_interested();
			$data["Regret"] = $this->AB->regret();
			$data["All_Applications"] = $this->AB->all_applications();
			$data["RequestForGrade"] = $this->AB->requestForGrade();
			
			//var_dump($data["Comments"]);
			//exit;
			
			$this->load->view('gs_admission/authorities_level_1/front_page',$data);
	        $this->load->view('gs_admission/authorities_level_1/footer');
	    }		
	}
	
	
}// Authorities_level_one