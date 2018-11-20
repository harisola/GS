<?php
class Update_weekly2 extends CI_Controller{
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		$From_date = $this->input->post("From_date"); 
		$To_date = $this->input->post("To_Date");
		$From_date = date("Y-m-d",strtotime($From_date));
		$To_date = date("Y-m-d",strtotime($To_date));
		$this->load->model("master_calendar/master_calender","MC");
		$this->MC->Update_Weekly_TimeSheet($From_date, $To_date);
	}
}