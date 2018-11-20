<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Academic_program extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}




	public function index()
	{

		$this->form_validation->set_rules($this->validation);

		if($this->form_validation->run() == FALSE){			
		}else{
			$this->add();
		}

		$this->load->model('organization/grade_model');
		$this->data['grade'] = $this->grade_model->get();
		$this->load->model('organization/academic_session_model');
		$this->data['academic_session'] = $this->academic_session_model->get_by(array('id >=' => 5));

		$this->load->model('sis/academic_program_model');
		$this->load->model('sis/academic_subject_model');
		$this->data['subject'] = $this->academic_subject_model->getAllSubjects();
		$this->data['program'] = $this->academic_program_model->getProgramDetail();

		$this->load->view('sis/academic_program/academic_program_view');
		$this->load->view('sis/academic_program/academic_program_orb_footer');
	}




	public $validation = array(		
		array('field' => 'grade_id', 'label' => 'Grade', 'rules' => 'trim|sanitize|required|numeric'),		
		array('field' => 'subject_id', 'label' => 'Subject', 'rules' => 'trim|sanitize|required|numeric'),		
		array('field' => 'academic_session_id', 'label' => 'Academic Session', 'rules' => 'trim|sanitize|required|numeric')
	);




	public function add()
	{
		if(count($_POST))
		{
			$this->load->model('sis/academic_program_model');		
			
			$grade_id = $this->input->post('grade_id');
			$subject_id = $this->input->post('subject_id');
			$academic_session_id = $this->input->post('academic_session_id');		
			
			$data = array(
				'grade_id' => $grade_id,
				'subject_id' => $subject_id,
				'academic_session_id' => $academic_session_id				
			);

			$new_domain = (int)$this->academic_program_model->save($data);
		}

		redirect('/sis/academic_program', 'refresh');
	}



	public function edit()
	{
		$pk = $_POST['pk'];
	    $name = $_POST['name'];
	    $value = $_POST['value'];
	    

	    
		$table_data = array(
			$name => $value
		);

		$this->load->model('sis/academic_program_model');
	    if(!empty($value)) {	        
	        $id = $this->academic_program_model->save($table_data, $pk);
	    } else {
	        header('HTTP 400 Bad Request', true, 400);
	        echo "This field is required!";
	    }
	}
}