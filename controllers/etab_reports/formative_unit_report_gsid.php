<?php

class Formative_unit_report_gsid extends MY_Controller{

	public function __construct(){
		parent::__construct();
	}

	public function index()
	{			
		$this_class = $this->input->get(NULL, TRUE);
		$grade_section = "";

		$this->GradeName = "";
		$this->SectionName = "";
		$this->AllSections = "";



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

			$this->GradeName = $grade;			
			$this->SectionName = $section;
			$this->AllSections = $this->class_list_sr_view_model->get_all_sections_of_grade($grade);



			// bounding to allowed classes
			$this_class_access = false;
			foreach ($this->data['allowed_classes'] as $classes) {
				if($this_class_access == false && $classes['grade_dname'] == $grade && ($classes['section_dname'] == $section || $classes['all_sections_allowed'] == 1)){
					/*var_dump($classes['grade_dname'] . "   " . $classes['section_dname']);*/
					$grade_section = "grade_dname = '" . $grade . "' and section_dname = '" . $section . "'";					
					$this_class_access = true;
				}
			}			
		}

		if($this_class_access == true)
		{
			// Getting all the allowed classes data
			$this->data['class_list_data'] = $this->class_list_sr_view_model->get_all_classes($grade_section, $this->active_academic_session, "no");
		}else{
			redirect('class_list/name_view');
		}
		

		$this->data['gradeSection'] =  $this->class_list_sr_view_model->get_all_grade_section($this->session->userdata['user_id']);
		
		$this->load->view('etab_reports/formative_unit_report_gsid_view');
		$this->load->view('etab_reports/formative_unit_report_gsid_footer');	

	}
}