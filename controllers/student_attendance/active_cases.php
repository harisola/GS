<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Active_cases extends MY_Controller {
	public function __construct(){
		parent::__construct();
	}


	public function index()		
	{	
		$dateTo = date('Y-m-d');
		$workingDays = 1;
		$Grade = $this->ClassTeacherGrade; //'V'; //$this->ClassTeacherGrade;
		$Section = $this->ClassTeacherSection; //'E'; //$this->ClassTeacherSection;
		$this->load->model('student_attendance/std_atd_calendar_wise_model');
		$this->dateFrom = $this->std_atd_calendar_wise_model->getWorkingDayDate($Grade, $workingDays, $dateTo);
		$dateFrom = $this->dateFrom;
		$this->Student['attendance_dates'] = $this->std_atd_calendar_wise_model->getStudentAttendanceDates($dateFrom, $dateTo, $Grade, $Section, $workingDays);
		$this->Student['attendance_data'] = $this->std_atd_calendar_wise_model->getStudentsAttendanceFrom_Penalty($dateFrom, $dateTo, $Grade, $Section, $this->Student['attendance_dates']);
		//$this->Student['attendance_data'] = null;
		$this->AttendanceTotalDays = count($this->Student['attendance_dates']);
		$this->load->view('student_attendance/activecases_attendance_view_orb');
		$this->load->view('student_attendance/student_attendance_footer_orb');
	}
}
