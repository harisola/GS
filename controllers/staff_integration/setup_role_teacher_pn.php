<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Setup_role_teacher_pn extends MY_Controller {
	public function __construct(){
		parent::__construct();
	}


	public function index()		
	{
		$GradeName = 'PN';
		$this->load->model('staff/staff_registered_model');
		$this->data['staff'] = $this->staff_registered_model->get();

		$this->data['SubjectTeachers'] = array();
		$this->load->model('staff_integration/role_assign_program_model');		
		$this->data['subjects'] = $this->role_assign_program_model->getAllProgramsOf($GradeName);
		$this->data['YearTutor'] = $this->role_assign_program_model->getAllYearTutorsOf($GradeName);
		$this->data['ClassTeacher'] = $this->role_assign_program_model->getAllClassTeachersOf($GradeName);
		$this->data['LeadTeacher'] = $this->role_assign_program_model->getAllLeadTeachersOf($GradeName);
		$this->data['CoTeacher'] = $this->role_assign_program_model->getAllCoTeachersOf($GradeName);
		foreach ($this->data['subjects'] as $subject) {
			array_push($this->data['SubjectTeachers'], $this->role_assign_program_model->getAllSubjectTeachersOf($GradeName, $subject['subject_id']));
		}		
		$this->load->view('staff_integration/teacher/assign_teacher_pn_view');
		$this->load->view('staff_integration/teacher/assign_teacher_orb_footer');
	}

	public function printForm()
	{
		$now_date = date('d-M-Y');

		 //Set the Content Type
		header("Content-type: image/jpeg");
		// Create Image From Existing Template
	    $imgPath = 'Components/image/staff_integration/assign_teacher/1Subj10Sec.jpg';
	    $image = imagecreatefromjpeg($imgPath);
	    // Set Path to Font File
  		$font_path = 'Components/image/font/calibri.ttf';

  		
  		// Send Image to Browser
		imagejpeg($image);
		// Clear Memory
		imagedestroy($image);
	}


	// PN Teachers Info
	public function edit()
	{
		$pk = $_POST['pk'];
	    $name = $_POST['name'];
	    $value = $_POST['value'];
	    
		$table_data = array(
			$name => $value
		);
		
		$this->load->model('staff_integration/role_new_org_model');
	    if(!empty($value)) {	        
	        $id = $this->role_new_org_model->save($table_data, $pk);        
	        
	    } else {
	        header('HTTP 400 Bad Request', true, 400);
	        echo "This field is required!";
	    }
	}
}