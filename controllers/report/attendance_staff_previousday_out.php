<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Attendance_staff_previousday_out extends MY_Controller {
	public function __construct(){
		parent::__construct();		
		
		$this->load->model('report/Attendance_staff_previousday_model');
		$this->attendance['staff'] = array($this->Attendance_staff_previousday_model->getStaffOutAttendance());
	}


	public function index()
	{				
		$this->load->view('report/attendance/staff/staff_attendance_previousday_out_view');
		$this->load->view('report/attendance/staff/staff_attendance_footer_orb');
	}
}