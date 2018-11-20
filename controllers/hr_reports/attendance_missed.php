<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Attendance_missed extends MY_Controller {

	public function __construct(){
		parent::__construct();					
	}

	public function index()
	{
		$this->load->model('report/attendance_staff_today_model');
		$this->attendance['staff'] = array($this->attendance_staff_today_model->getStaffAttendance_Missed());


		
		$this->load->view('hr_reports/attendance_missed_view');
		$this->load->view('hr_reports/attendance_missed_footer');
	}
}
