<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Attendance_staff_today extends MY_Controller {
	public function __construct(){
		parent::__construct();		
		
		$this->load->model('report/attendance_staff_today_model');
		$this->attendance['staff'] = array($this->attendance_staff_today_model->get());
	}


	public function index()
	{				
		$this->load->view('report/attendance/staff/staff_attendance_today_view');
		$this->load->view('report/attendance/staff/staff_attendance_footer_orb');
	}
}