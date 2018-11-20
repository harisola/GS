<?php 

class Admission_setup extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$user_id =  (int)$this->session->userdata('user_id'); 
		$this->user_id = $user_id;

	}
	public function index(){

		if($this->ion_auth->logged_in() == FALSE){
			redirect('welcome');
		}else{
			$this->load->model('gs_admission/ajax_base_model', 'AB');
			if( $this->input->post() ){
					$grade = $this->input->post('grade');
					$issuance_date = $this->input->post('issuance_date');
					$now = date('Y-m-d H:i:s');
					$created = human_to_unix($now);
					$register_by = (int)$this->session->userdata['user_id'];
					$modified = human_to_unix($now);
					$modified_by = (int)$this->session->userdata['user_id'];					
					$data = array(
						'grade_id' => $grade,
						'date' => $issuance_date,
						'created' => $created,
						'register_by' => $register_by,
						'modified' => $modified,
						'modified_by' => $modified_by,
						'record_deleted' => 0
					);
					$this->AB->set('_form_issuance_schedule', $data);
			}
			$data['issuance_data'] = $this->AB->get_admission_setup_data();
			$data['submission_data'] = $this->AB->get_admission_setup_submission_data();
			$this->load->view('gs_files/header');
	        $this->load->view('gs_files/main-nav');
	        $this->load->view('gs_files/breadcrumb');

			$this->load->view('gs_admission/admission_setup/admission_setup_view',$data);
			$this->load->view('gs_admission/admission_setup/admission_setup_footer');
		}
	}

	public function formSubmissionSetup(){
		if( $this->input->post() ){
			$this->load->model('gs_admission/ajax_base_model', 'AB');

			$date = $this->input->post('date');
			$start_time = $this->input->post('start_time');
			$end_time = $this->input->post('end_time');
			$no_of_forms_submission = $this->input->post('no_of_forms_submission');
			$now = date('Y-m-d H:i:s');
			$created = human_to_unix($now);
			$register_by = (int)$this->session->userdata['user_id'];
			$modified = human_to_unix($now);
			$modified_by = (int)$this->session->userdata['user_id'];					
			$data = array(
				'date' => $date,
				'time_start' => $start_time,
				'time_end' => $end_time,
				'no_of_forms_submission' => $no_of_forms_submission,
				'duration_per_slot' => 15,
				'no_of_slots' => 10,
				'forms_submit_per_slot' => 10,
				'created' => $created,
				'register_by' => $register_by,
				'modified' => $modified,
				'modified_by' => $modified_by,
				'record_deleted' => 0
			);
			$this->AB->set('_form_submission_schedule', $data);
			redirect('gs_admission/admission_setup/index');
		}
	}
}