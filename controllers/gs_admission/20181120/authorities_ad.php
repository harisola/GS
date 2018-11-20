<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Authorities_ad extends CI_Controller{
	
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
			
			$data["ConfirmAdmission"] = $this->AB->wait_list();
			$data["Not_Interested"] = $this->AB->on_hold();
			
			$data["All_Applications"] = $this->AB->allAppAdmin();
			
			
			//var_dump($data["Comments"]);
			//exit;
			
			$this->load->view('gs_admission/authorities_level_2/front_page',$data);
	        $this->load->view('gs_admission/authorities_level_2/footer');
	    }		
	}
	
	
}// Authorities_level_one