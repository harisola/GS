<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Atd_history extends MY_Controller {
	public function __construct(){
		parent::__construct();
	}



	public function index()		
	{			
		$dateTo = date('Y-m-d');
		$workingDays = 4;
		$Grade = $this->ClassTeacherGrade; //'V'; //$this->ClassTeacherGrade;
		$Section = $this->ClassTeacherSection; //'E'; //$this->ClassTeacherSection;
		$this->load->model('student_attendance/std_atd_calendar_wise_model');
		$this->dateFrom = $this->std_atd_calendar_wise_model->getWorkingDayDate($Grade, $workingDays, $dateTo);
		$dateFrom = $this->dateFrom;
		$this->Student['attendance_dates'] = $this->std_atd_calendar_wise_model->getStudentAttendanceDates($dateFrom, $dateTo, $Grade, $Section, $workingDays);
		$this->Student['attendance_data_penalty'] = $this->std_atd_calendar_wise_model->getStudentsAttendanceFrom_Penalty($dateFrom, $dateTo, $Grade, $Section, $this->Student['attendance_dates']);
		$this->Student['attendance_data_absent'] = $this->std_atd_calendar_wise_model->getStudentsAttendanceFrom_Absent($dateFrom, $dateTo, $Grade, $Section, $this->Student['attendance_dates']);
		$this->AttendanceTotalDays = count($this->Student['attendance_dates']);
		$this->load->view('student_attendance/history_attendance_view_orb');
		$this->load->view('student_attendance/student_attendance_footer_orb');	
	}




	public function add()
	{
		if(count($_POST))
		{
			$GSID = $this->input->post('gs_id');
			$ActiveCaseCategory = $this->input->post('activecase_category');

			$this->load->model('student_attendance/activecase_model');
			$table_data = array(
				'gs_id' => $GSID,
				'category_id' => $ActiveCaseCategory
			);
			$this->activecase_model->save($table_data);
		}		
	}


	public function add2()
	{
		if(count($_POST))
		{
			$GSID = $this->input->post('gs_id');
			$ActiveCaseMessage = $this->input->post('comments');
			$ActiveCaseID = $this->input->post('activecase_id');

			$this->load->model('student_attendance/activecase_log_model');
			$table_data = array(
				'activecase_id' => $ActiveCaseID,
				'staff_id' => (int)$this->data['staff_registered_data'][0]->id,
				'comments' => $ActiveCaseMessage
			);
			//$this->activecase_log_model->save($table_data);
			
			$last_id = $this->activecase_log_model->save($table_data);
			
			// add notification here
			
			$this->load->model('student_attendance/notification_log', 'notify');
			$base_url = base_url();
			$url = $base_url."index/controller/method?gsid=".$GSID."&category_id=1";
			$url = $last_id;
			$register_by = (int)$this->data['staff_registered_data'][0]->id;
			$register_by = (int)$this->session->userdata('user_id'); 
			$table = "notify_meta_data";
			$notified = $this->notify->notify_to($GSID);
			if( !empty( $notified )){
				foreach( $notified AS $nt ){
					$notify_to = $nt["Notity_To"];
				$data = array("category_id"=>1, "message"=>$ActiveCaseMessage, "gs_id"=>$GSID, "notify_to"=>$notify_to, "log_id"=>$url, "created" => time(), "register_by" => $register_by );
					$this->notify->add_record($table,$data);
				}
				
				$category_id = 1;
				$activeCaseIDs = $this->notify->getActivecaseid( $register_by,$url,$GSID,$category_id );
				if( !empty( $activeCaseIDs )){
					foreach( $activeCaseIDs AS $log_id ){
						$logid = $log_id["id"];
						$this->notify->set_read($register_by,$logid);	
					}	
				}
			
			}
		}
	}


	public function add3()
	{
		if(count($_POST))
		{
			$GSID = $this->input->post('gs_id');
			$AbsentReason = $this->input->post('reason');
			$AbsentCase = $this->input->post('case');
			$AbsentDate = $this->input->post('absentdate');			

			$this->load->model('student_attendance/student_attendance_absent_solved_model');

			for($i=0; $i<count($AbsentDate); $i++) {
				if($AbsentCase[$i] > 0 && $AbsentReason[$i] == 0){
					$table_data = array(
						'gs_id' => $GSID,
						'date' => $AbsentDate[$i],
						'absent_case_id' => $AbsentCase[$i],
						'absent_reason_id' => 1
					);
					$this->student_attendance_absent_solved_model->save($table_data);
					
				}else if($AbsentCase[$i] > 0 && $AbsentReason[$i] > 0){
					$table_data = array(
						'gs_id' => $GSID,
						'date' => $AbsentDate[$i],
						'absent_case_id' => $AbsentCase[$i],
						'absent_reason_id' => $AbsentReason[$i]
					);
					$this->student_attendance_absent_solved_model->save($table_data);
				}				
			}			

			//print_r($_POST);
		}

		redirect('/student_attendance/atd_history');		
	}
}
