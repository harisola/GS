<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Confirm_tpa extends MY_Controller {
	public function __construct(){
		parent::__construct();		
	}


	public function index()
	{
		$this->load->model('report/confirm_tpa_model');


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

		$this->GradeSection = $grade_section;

		$this->load->view('report/confirm_tpa/confirm_tpa_view');
		$this->load->view('report/confirm_tpa/confirm_tpa_footer');
	}
}