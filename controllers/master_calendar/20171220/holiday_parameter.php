<?php
class Holiday_parameter extends CI_Controller{
	public function __construct(){ parent::__construct(); }
	public function index(){
		$this->load->view('gs_files/header');
	    $this->load->view('gs_files/main-nav');
	    $this->load->view('gs_files/breadcrumb');
		$data['Events'] = $this->Category_Event();
		$this->load->view('master_calendar/holiday_parameter/super_profile/holiday_parameter',$data);
		$this->load->view('master_calendar/holiday_parameter/super_profile/footer');
	}
	// Get All Event Category Table Records
	public function Category_Event(){
		$this->load->model("master_calendar/master_calender","MC");
		$return = $this->MC->Get_All_Event('Holiday');
		return $return;
	}
}