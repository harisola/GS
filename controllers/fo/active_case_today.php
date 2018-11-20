<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Active_case_today extends MY_Controller {
	public function __construct(){
		parent::__construct();		
	}


	public function index()
	{	
		$grade_section = "";
		foreach ($this->data['allowed_classes'] as $classes) {
			if($classes['grade_id'] >= 6){
				if($classes['all_sections_allowed'] == 1)
				{
					$grade_section .= "grade_id = " . $classes['grade_id'] . " or ";
				}else{
					$grade_section .= "(grade_id = " . $classes['grade_id'] . " and section_id = " . $classes['section_id'] . ") or ";
				}
			}
		}
		$grade_section = "(" . trim($grade_section, " or ") . ")";


		$dateTo = date('Y-m-d');
		$workingDays = 1;
		$this->load->model('student_attendance/std_atd_calendar_wise_model');
		$dateFrom = $this->std_atd_calendar_wise_model->getAllWorkingDayDate($workingDays, $dateTo);
		$this->Student['attendance_dates'] = $this->std_atd_calendar_wise_model->getAllStudentAttendanceDates($dateFrom, $dateTo, $workingDays);
		$this->Student['attendance_data'] = $this->std_atd_calendar_wise_model->getAllStudentsAttendanceFrom_Penalty($dateFrom, $dateTo, $this->Student['attendance_dates'], $grade_section);
		$this->AttendanceTotalDays = count($this->Student['attendance_dates']);

		$this->load->view('frontoffice/active_case_today_view');
		$this->load->view('frontoffice/active_case_footer_orb');
	}


	public function edit()
	{
		$pk = $_POST['pk'];
	    $name = $_POST['name'];
	    $value = $_POST['value'];
	    
		$table_data = array(
			$name => $value
		);
		
		$this->load->model('student_attendance/activecase_model');
	    if(!empty($value)) {	        
	        $id = $this->activecase_model->save($table_data, $pk);        
	        
	    } else {
	        header('HTTP 400 Bad Request', true, 400);
	        echo "This field is required!";
	    }
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
			$this->activecase_log_model->save($table_data);
		}
	}
}