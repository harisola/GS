<?php 

class Weekly_sheet extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$user_id =  (int)$this->session->userdata('user_id');
	}

	public function index(){

		if($this->ion_auth->logged_in() == FALSE){
			redirect('welcome');
		}else{

			$this->load->model('tif_a/weekly_time_sheet_model','wm');
			$data['get_weeks'] = $this->wm->get_weeks();
			$data['staff_profile_detail'] = $this->wm->staff_profile_desc();
			$data['staff'] = $this->wm->get_staff();
			$data['profile_detail'] = $this->wm->get('atif_gs_events.tt_profile','','');




			$this->load->view('gs_files/header');
	        $this->load->view('gs_files/main-nav');
	        $this->load->view('gs_files/breadcrumb_weekly_sheet');

			$this->load->view('tif_a/weekly_time_sheet/weekly_sheet_view',$data);
			$this->load->view('tif_a/weekly_time_sheet/weekly_sheet_footer');
		}

	}
}