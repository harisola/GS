<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Print_option_group_ajax extends CI_Controller {	

	public function __construct(){
		parent::__construct();
	}
	// get Op
	public function get_option(){

		$grade_id = $this->input->post('grade_id');
		$academic_session_id = $this->input->post('academic_session_id');
		$term_id = $this->input->post('term');

		$this->load->model('etab/print_option_group','pog');
		$data['program'] = $this->pog->get_program($grade_id,$academic_session_id);
		$data['classList'] = $this->pog->get_classlist($grade_id,$academic_session_id);
		$data['group'] = $this->pog->get_group($grade_id,$academic_session_id);
		$data['option_group'] = $this->pog->get_option_group($grade_id,$term_id,$academic_session_id);
		echo json_encode($data);
		
	}


}	