<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Billing_confirmation extends CI_Controller{
	  public function __construct(){
        parent::__construct();
		$this->load->library('session');
    }
	
	
	public function index(){
		
		if($this->ion_auth->logged_in() == FALSE){
			redirect('welcome');
		}else{
			$this->load->model('gs_admission/billing_confirmation_model', 'BCM');
			
			$this->load->view('gs_files/header');
	        $this->load->view('gs_files/main-nav');
	        $this->load->view('gs_files/breadcrumb');
			
			$user_id = (int)$this->session->userdata("user_id");
			
			$data["billing_confirmation"]=$this->BCM->billing_confirmation($where=NULL);
			
			// var_dump( $data["billing_confirmation"] ); exit;
			
			$this->load->view('gs_admission/billing_confirmation/front_page',$data);
	        $this->load->view('gs_admission/billing_confirmation/footer');
		}
			
	}
	
	public function Search_Query(){
		$this->load->model('gs_admission/billing_confirmation_model', 'BCM');
		$grade_id = $this->input->post("gradename");
		$check=true;
		foreach( $grade_id as $g_id ){ 
			if($check){
				$where = " where grade_name = '".$g_id."' ";
				$check=false;
			}else{
				$where .= " OR grade_name = '".$g_id."' ";
			}
		}
		
		$data["billing_confirmation"]=$this->BCM->billing_confirmation($where);
		$this->load->view('gs_admission/billing_confirmation/front_page2',$data);
		
	}
	
	
	
}