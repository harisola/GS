<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Report_vehicle_in extends MY_Controller {
	public function __construct(){
		parent::__construct();		
		
		$this->dateRangeFrom = "";
		$this->dateRangeTo = "";


		$this->load->model('vehicle/attendance_vehicle_today_model');
		$this->attendance['staff'] = array($this->attendance_vehicle_today_model->get());
	}


	public function index()
	{			
		if(count($_POST))
		{
			$dateRange = $this->input->post('e1');
			$dateRange = json_decode($dateRange, true);
			$this->dateRangeFrom = $dateRange["start"];
			$this->dateRangeTo = $dateRange["end"];
		}	
		
		$this->load->view('report/vehicle/staff_attendance_vehicle_today_view');
		$this->load->view('report/vehicle/staff_attendance_footer_orb');
	}
}