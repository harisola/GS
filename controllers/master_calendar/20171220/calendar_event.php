<?php
class Calendar_event extends CI_Controller{
	public function __construct(){ parent::__construct(); }
	
	
	public function index(){
		$this->load->view('gs_files/header');
	    $this->load->view('gs_files/main-nav');
	    $this->load->view('gs_files/breadcrumb');
		$data["Category_Events"] = $this->Category_Event();
		$this->load->view('master_calendar/event_category/index',$data);
		$this->load->view('master_calendar/event_category/footer_new');
	}
	
	
	public function Category_Event(){
		$this->load->model("master_calendar/master_calender","MC");
		$return = $this->MC->Get_All_Event();
		return $return;
	}
	
	
}