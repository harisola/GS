<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Atd_today extends MY_Controller {
	public function __construct(){
		parent::__construct();
	}

	public function index()
	{		
		if(count($_POST))
		{
			$this->GSID = $this->input->post('gs_id');
			$this->load->model('sis/fif_student_info_model');
			$this->studentPicGRNO = $this->fif_student_info_model->getStudentGRNO($this->GSID);
			$this->load->view('student_attendance_admin/student_attendance_admin_view');
		}else{
			$this->load->model('staff_integration/role_new_org_model');
			//$this->data['staff_registered_data'][0]->id;
			$LocationData = $this->role_new_org_model->getLocationID($this->data['staff_registered_data'][0]->id);
			$LocationID = $LocationData[0]['id'];

			$this->db_attendance_students = $this->load->database('default',TRUE);
			$this->load->model('report/report_atdstudents_today_model');
			$this->attendance['students'] = $this->report_atdstudents_today_model->getStudentsAttendanceOfLocation($LocationID);
			$this->load->view('student_attendance_admin/student_attendance_admin_view');
			$this->load->view('student_attendance_admin/student_attendance_admin_view_all');
		}		
		$this->load->view('student_attendance_admin/student_attendance_admin_footer_orb');
	}

	public function add()
	{
		if(count($_POST))
		{			
			$this->load->model('staff_integration/role_new_org_model');
			$this->data['staff_registered_data'][0]->id;
			$LocationData = $this->role_new_org_model->getLocationID($this->data['staff_registered_data'][0]->id);
			$LocationID = $LocationData[0]['id'];			

			$this->db_student_attendance = $this->load->database('attendance_students',TRUE);			
			$this->load->model('student_attendance/std_atd_mark_model');
			$data = array(
				'gs_id' => $this->input->post('attendance_gsid'),
				'date' => date("Y-m-d"),
				'time' => '07:29:00',
				'location_id' => $LocationID,
				'ip4' => ''					
			);
			$id = $this->std_atd_mark_model->save($data);


			$this->load->model('student_attendance/std_atd_change_model');
			$data = array(
				'gs_id' => $this->input->post('attendance_gsid'),
				'date' => date("Y-m-d"),
				'previous_status' => 2,
				'new_status' => 1
			);
			$id = $this->std_atd_change_model->save($data);
		
			redirect('/student_attendance_admin/atd_today');
		}
	}
}