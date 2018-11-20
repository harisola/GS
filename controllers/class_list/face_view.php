<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Face_view extends MY_Controller {
	public function __construct(){
		parent::__construct();	
	}

	public function index()
	{			
		// setting where statement for class list
		$grade_section = "";
		foreach ($this->data['allowed_classes'] as $classes) {			
			if($classes['all_sections_allowed'] == 1)
			{
				$grade_section .= "grade_id = " . $classes['grade_id'] . " or ";
			}else{
				$grade_section .= "(grade_id = " . $classes['grade_id'] . " and section_id = " . $classes['section_id'] . ") or ";
			}
		}
		$grade_section = trim($grade_section, " or ");

		// Getting all the allowed classes data
		$this->data['class_list_data'] = $this->class_list_sr_view_model->get_all_classes($grade_section, $this->active_academic_session, "no");
		

		$this->load->view('class_list/face_view/face_view_faculty_orb', $this->data['class_list_data']);
		// Loading footer in the end
		$this->load->view('class_list/face_view/face_view_orb_footer');		
	}
}