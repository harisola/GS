<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Atd_today extends MY_Controller {
	public function __construct(){
		parent::__construct();
	}

	public function index()
	{			
		$this_class = $this->input->get(NULL, TRUE);
		$grade_section = "";

		if($this_class == false)
		{
			$this_class_access = true;
			// setting where statement for class list			
			foreach ($this->data['allowed_classes'] as $classes) {			
				if($classes['all_sections_allowed'] == 1)
				{
					$grade_section .= "grade_id = " . $classes['grade_id'] . " or ";
				}else{
					$grade_section .= "(grade_id = " . $classes['grade_id'] . " and section_id = " . $classes['section_id'] . ") or ";
				}
			}
			$grade_section = trim($grade_section, " or ");
		}else{
			$grade_pos = strrpos($this_class['class'], "-");
			$grade = substr($this_class['class'], 0, $grade_pos);
			$section = substr($this_class['class'], ($grade_pos+1), strlen($this_class['class']));

			// bounding to allowed classes
			$this_class_access = false;
			foreach ($this->data['allowed_classes'] as $classes) {
				if($this_class_access == false && $classes['grade_dname'] == $grade && ($classes['section_dname'] == $section || $classes['all_sections_allowed'] == 1)){
					$grade_section = "grade_dname = '" . $grade . "' and section_dname = '" . $section . "'";					
					$this_class_access = true;
				}
			}			
		}

		if($this_class_access == true)
		{
			// Getting all the allowed classes data
			$this->load->model('class_list/class_list_sr_view_model');
			$this->data['class_list_data'] = $this->class_list_sr_view_model->get_all_classes_attendance($grade_section, $this->active_academic_session, "no");
		}else{
			redirect('student_attendance_oa/atd_today');
		}
		

		if($this_class == false)
		{
			$this->load->view('student_attendance_oa/atd_today_view', $this->data['class_list_data']);
			// Loading footer
			$this->load->view('student_attendance_oa/student_attendance_oa_footer_orb');
		}else{			
			$this->load->view('student_attendance_oa/atd_today_view', $this->data['class_list_data']);
			// Loading footer in the end
			$this->load->view('student_attendance_oa/student_attendance_oa_footer_orb');	
		}					
	}



	// Absent to Present
	public function edit2()
	{
		if(count($_POST))
		{
			$pk = $_POST['pk'];
		    $name = $_POST['name'];
		    $value = $_POST['value'];
			
			$id = $pk;
			$this->load->model('class_list/class_list_sr_view_model');
			$GSID = $this->class_list_sr_view_model->getGSID_AbsentStudent($id);

			$this->load->model('student_attendance/std_atd_mark_model');
			$data = array(
				'gs_id' => $GSID,
				'date' => date("Y-m-d"),
				'time' => '07:30:00',
				'location_id' => 10,
				'ip4' => ''					
			);
			if(!empty($value)) {
	        	$id = $this->std_atd_mark_model->save($data);
		    } else {
		        header('HTTP 400 Bad Request', true, 400);
		        echo "This field is required!";
		    }		


			$this->load->model('student_attendance/std_atd_change_model');
			$data = array(
				'gs_id' => $GSID,
				'date' => date("Y-m-d"),
				'previous_status' => 2,
				'new_status' => 1
			);
			if(!empty($value)) {
	        	$id = $this->std_atd_change_model->save($data);
		    } else {
		        header('HTTP 400 Bad Request', true, 400);
		        echo "This field is required!";
		    }			
		}
	}


	// Present to Absent
	public function edit()
	{
		if(count($_POST))
		{	
			$pk = $_POST['pk'];
		    $name = $_POST['name'];
		    $value = $_POST['value'];

			$this->load->model('student_attendance/std_atd_mark_model');
			$id = $pk;
			$GSID = $this->std_atd_mark_model->getGSID($id);

			$data = array(					
				'date' => date("Y-m-d"),
				'time' => NULL,
				'location_id' => 10,
				'ip4' => ''					
			);			
			if(!empty($value)) {
	        	$id = $this->std_atd_mark_model->save($data, $id);
		    } else {
		        header('HTTP 400 Bad Request', true, 400);
		        echo "This field is required!";
		    }


			$this->load->model('student_attendance/std_atd_change_model');				
			$data = array(
				'gs_id' => $GSID,
				'date' => date("Y-m-d"),
				'previous_status' => 1,
				'new_status' => 2
			);			
			if(!empty($value)) {
	        	$id = $this->std_atd_change_model->save($data);
		    } else {
		        header('HTTP 400 Bad Request', true, 400);
		        echo "This field is required!";
		    }			
		}
	}



	// Confirm TPA of Section Office Assistant
	public function add3()
	{
		$this->load->model('student_attendance/std_atd_verification_other_model');
		$grade_section_data = explode(",", $_POST['selected_grade_section']);
		$selected_grade = $grade_section_data[0];
		$selected_section = $grade_section_data[1];

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
			'grade_id' => (int)$selected_grade,
			'section_id' => (int)$selected_section,
			'date' => date("Y-m-d"),
			'ip4' => $ip
		);

		$id = $this->std_atd_verification_other_model->save($data);		
	}
}