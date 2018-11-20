<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Report_vehicle_out extends MY_Controller {
	public function __construct(){
		parent::__construct();		
		
		$this->load->model('vehicle/attendance_vehicle_today_model');
		$this->attendance['staff'] = array($this->attendance_vehicle_today_model->get());
	}


	public function index()
	{				
		$this->load->view('report/vehicle/staff_attendance_vehicle_out_view');
		$this->load->view('report/vehicle/staff_attendance_footer_orb');
	}
}