<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Setup_role_new extends MY_Controller {
	public function __construct(){
		parent::__construct();
	}


	public function index()		
	{
		$this->load->model('staff/staff_registered_model');
		$this->data['staff'] = $this->staff_registered_model->get();

		$this->load->model('staff_integration/role_network_model');

		$this->form_validation->set_rules($this->validation);

		if($this->form_validation->run() == FALSE){
			
		}else{
			$this->add();
		}

		$this->load->model('organization/wing_model');
		$this->data['wing'] = $this->wing_model->get();
		$this->load->model('organization/grade_model');
		$this->data['grade'] = $this->grade_model->get();
		$this->load->model('organization/section_model');
		$this->data['section'] = $this->section_model->get();
		$this->load->model('organization/academic_session_model');
		$this->data['academic_session'] = $this->academic_session_model->get_by(array('id >=' => 5));


		$this->load->model('staff_integration/role_new_org_model');
		$this->load->model('staff_integration/role_domain_model');
		$this->load->model('staff_integration/role_type_model');		
		$this->load->model('sis/academic_subject_model');
		$this->data['domain'] = $this->role_domain_model->get();
		$this->data['type'] = $this->role_type_model->get();
		$this->data['subject'] = $this->academic_subject_model->getAllSubjects();
		$this->data['role'] = $this->role_new_org_model->get();
		$this->data['all_roles'] = $this->role_new_org_model->getAllSchoolRoles();

		$this->load->view('staff_integration/role_new_org_view');
		$this->load->view('staff_integration/role_domain_orb_footer');
	}


	public $validation = array(
		array('field' => 'domain_id', 'label' => 'Domain', 'rules' => 'trim|sanitize|required|numeric'),
		array('field' => 'type_id', 'label' => 'Role Type', 'rules' => 'trim|sanitize|required|numeric'),
		array('field' => 'wing_id', 'label' => 'Wing', 'rules' => 'trim|sanitize|required|numeric'),
		array('field' => 'grade_id', 'label' => 'Grade', 'rules' => 'trim|sanitize|required|numeric'),
		array('field' => 'section_id', 'label' => 'Section', 'rules' => 'trim|sanitize|required|numeric'),
		array('field' => 'subject_id', 'label' => 'Subject', 'rules' => 'trim|sanitize|required|numeric'),
		array('field' => 'role_id', 'label' => 'Report To', 'rules' => 'trim|sanitize|required|numeric'),
		array('field' => 'academic_session_id', 'label' => 'Academic Session', 'rules' => 'trim|sanitize|required|numeric')
	);



	public function add()
	{
		if(count($_POST))
		{
			$this->load->model('staff_integration/role_new_org_model');			
			
			$DomainID = $this->input->post('domain_id');
			$TypeID = $this->input->post('type_id');
			$WingID = $this->input->post('wing_id');
			$GradeID = $this->input->post('grade_id');
			$SectionID = $this->input->post('section_id');
			$SubjectID = $this->input->post('subject_id');
			$ReportTO = $this->input->post('role_id');
			$AcademicSessionID = $this->input->post('academic_session_id');			

			$GRID = $this->role_new_org_model->makeGRID($DomainID, $TypeID);
			
			$data = array(
				'domain_id' => $DomainID,
				'type_id' => $TypeID,
				'gr_id' => $GRID,
				'wing_id' => $WingID,
				'grade_id' => $GradeID,
				'section_id' => $SectionID,
				'subject_id' => $SubjectID,
				'academic_session_id' => $AcademicSessionID,
				'report_to' => $ReportTO
			);

			$new_domain = (int)$this->role_new_org_model->save($data);
		}

		redirect('/staff_integration/setup_role_new', 'refresh');
	}



	public function add2()
	{
		if(count($_POST))
		{
			if($this->input->post('report_to') > 0) {
				$this->load->model('staff_integration/role_reporting_secondary_model');			
				
				$RoleID = $this->input->post('role_id');
				$ReportID = $this->input->post('report_id');
				$ReportTO = $this->input->post('report_to');

				$data = array(
					'role_id' => $RoleID,
					'report_id' => $ReportID,
					'report_to' => $ReportTO				
				);

				$secondaryReporting = (int)$this->role_reporting_secondary_model->save($data);		
			}
		}

		redirect('/staff_integration/setup_role_new', 'refresh');
	}



	public function edit()
	{
		$pk = $_POST['pk'];
	    $name = $_POST['name'];
	    $value = $_POST['value'];
	    

	    
		$table_data = array(
			$name => $value
		);

		$this->load->model('staff_integration/role_new_org_model');	
		if($value == 0){
			$id = $this->role_new_org_model->save($table_data, $pk);
		}else {
		    if(!empty($value)) {	        
		        $id = $this->role_new_org_model->save($table_data, $pk);
		    } else {
		        header('HTTP 400 Bad Request', true, 400);
		        echo "This field is required!";
		    }
		}
	}

}