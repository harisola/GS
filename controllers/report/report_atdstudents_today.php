<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Report_atdstudents_today extends MY_Controller {
	public function __construct(){
		parent::__construct();		
		
		$this->load->model('report/report_atdstudents_today_model');
		$this->attendance['students'] = array($this->report_atdstudents_today_model->getStudentsAttendance_IN());
	}


	public function index()
	{				
		$this->load->view('report/attendance/students/report_atdstudents_today_view');
		$this->load->view('report/attendance/students/students_attendance_footer_orb');
	}
}