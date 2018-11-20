<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admission_bill_mis extends CI_Controller{
    public function __construct(){
        parent::__construct();
		$this->load->library('session');
    }
	
	public function index(){
		if($this->ion_auth->logged_in() == FALSE){
			redirect('welcome');
		}else{
			$this->load->model('gs_admission/billing_confirmation_model', 'AB');
			
			$this->load->view('gs_files/header');
			$this->load->view('gs_files/main-nav');
			$this->load->view('gs_files/breadcrumb');
			
			$user_id = (int)$this->session->userdata("user_id");
			
			$from = 10;
			$to = 11;
			$data["MIS_list"] = $this->AB->bill_mis($from, $to );

			
			$this->load->view('gs_admission/billing_mis/main_page',$data);
			$this->load->view('gs_admission/billing_mis/footer');
		}
	}
	
	
	public function search_date_range(){
		$this->load->model('gs_admission/billing_confirmation_model', 'AB');
		
		$from_date = $this->input->post("from_date");
		$to_date = $this->input->post("to_date");
		
		
		
		$from = 10;
		$to = 11;
		
		if( $from_date == $to_date ){
			$time = strtotime($to_date);
			$to_date = $time + 86400;
			$to_date = date("Y-m-d",$to_date);
		}
		
		$data["from_date"]=$from_date;
		$data["to_date"]=$to_date;
		
		$data["MIS_list"] = $this->AB->bill_mis($from, $to, $from_date, $to_date );
		
		
		//$return_date = array("from_date"=>$from_date, "to_date"=>$to_date);
		
		
		$this->load->view('gs_admission/billing_mis/main_pages',$data);
		//echo json_encode( $return_date );
	}
}	
	
