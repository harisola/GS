<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Atd_today extends MY_Controller {
	public function __construct(){
		parent::__construct();
	}


	public function index()		
	{	
		$Grade = $this->ClassTeacherGrade; //'V'; //$this->ClassTeacherGrade;
		$Section = $this->ClassTeacherSection; //'E'; //$this->ClassTeacherSection;
		
		
		
		$this->load->model('student_attendance/std_atd_model');
		$this->Student['absent'] = $this->std_atd_model->getAbsentStudentsData($Grade, $Section);
		//$this->Student['present'] = $this->std_atd_model->get_by(array('grade_name' => $Grade, 'section_name' => $Section, "std_status_category"=>'Student','time >' => '00:00:00'));
		$this->Student['present'] = $this->std_atd_model->get_by(array('grade_name' => $Grade, 'section_name' => $Section, 'time >' => '00:00:00'));
		$this->Student['absent_fence'] = $this->std_atd_model->getAbsentFenceStudentsData($Grade, $Section);
		$this->load->view('student_attendance/current_attendance_view_orb');
		$this->load->view('student_attendance/student_attendance_footer_orb');	
	}




	// Absent to Present
	public function add()
	{
		if(count($_POST))
		{
			$rowCount = count($_POST["userspresent"]);
			
			for($i=0; $i<$rowCount; $i++) {				
				
				$this->load->model('student_attendance/std_atd_mark_model');
				$data = array(
				
					'gr_no' => $_POST["userspresentID"][$i],
					'gs_id' => $_POST["userspresent"][$i],
					'date' => date("Y-m-d"),
					'time' => '07:30:00',
					'location_id' => 9,
					'ip4' => ''					
				);
				$id = $this->std_atd_mark_model->save($data);


				$this->load->model('student_attendance/std_atd_change_model');
				$data = array(
					'gs_id' => $_POST["userspresent"][$i],
					'date' => date("Y-m-d"),
					'previous_status' => 2,
					'new_status' => 1
				);
				$id = $this->std_atd_change_model->save($data);
			}			
		}
		redirect('/student_attendance/atd_today');
	}





	// Present to Absent
	public function add2()
	{
		if(count($_POST))
		{
			$rowCount = count($_POST["usersabsent"]);
			for($i=0; $i<$rowCount; $i++) {				
				
				$this->load->model('student_attendance/std_atd_mark_model');
				$id = $_POST["usersabsent"][$i];
				$GSID = $this->std_atd_mark_model->getGSID($id);

				$data = array(					
					'date' => date("Y-m-d"),
					'time' => NULL,
					'location_id' => 9,
					'ip4' => ''					
				);
				$id = $this->std_atd_mark_model->save($data, $id);


				$this->load->model('student_attendance/std_atd_change_model');				
				$data = array(
					'gs_id' => $GSID,
					'date' => date("Y-m-d"),
					'previous_status' => 1,
					'new_status' => 2
				);
				$id = $this->std_atd_change_model->save($data);
			}			
		}
		redirect('/student_attendance/atd_today');
	}


	// Teacher Verification Complete
	public function add3()
	{
		$this->load->model('student_attendance/std_atd_verification_model');

		/*******************************************************
		* IP Address
		* ******************************************************/
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		    $ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
		    $ip = $_SERVER['REMOTE_ADDR'];
		}


		$data = array(
			'user_id' => (int)$this->session->userdata['user_id'],
			'date' => date("Y-m-d"),
			'ip4' => $ip
		);

		$id = $this->std_atd_verification_model->save($data);
		
		redirect('/student_attendance/atd_today');
	}
}
