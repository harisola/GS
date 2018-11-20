<?php


class Gen_Attendance extends CI_Controller {
	public function __construct(){
		parent::__construct();		
	}


	public function index()		
	{

		$this->data = array();
		$this->data['can_user_add'] = 0;
		$this->data['can_user_view'] = 0;
		$this->data['can_user_edit'] = 0;
		$this->data['can_user_delete'] = 0;
		$this->data['can_user_approve'] = 0;
		$this->data['can_user_print'] = 0;
		$this->data['can_user_export'] = 0;
		$this->data['page_header_big_words'] = '';
		$this->data['page_header_small_words'] = '';
		$this->data['current_url'] = '';

		$this->data['breadcrumb'] = '';
		$this->data['breadcrumb_last'] = '';
		$this->AcademicSessionFrom = 9;
		$this->AcademicSessionTo = 10;
		$this->TermID = 1;
		$this->load->model('access_rights_model');
		$access_rights = $this->access_rights_model->get_rights();
		$sizeOfAccessRights = sizeof($access_rights);

		$this->skip_breadcrumb[] = 'student_attendance/atd_today';
		$this->skip_breadcrumb[] = 'student_attendance/atd_history';
		$this->skip_breadcrumb[] = 'student_attendance/active_cases';
		// ***************************************************************



		/***** If from server 50 login the user *****/
		
		/********************************************/

		// Check authentication
			$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
			$this->output->set_header("Pragma: no-cache");

			$data['page_title'] = "Generation's School";
			$data['brand'] = "GS";
			$data['org_font'] = 'Cooper Black';
			$data['org_font_color'] = '#993838 !important';
			$data['title_background_color_add'] = 'dark-red';
			$data['title_background_color_view'] = 'dark-blue';
			$data['class_list_color_view'] = 'marine';
			$data['online_applicant_color_view'] = 'marine';
			$this->data['is_template'] = 'orb';
			$this->data['applicant_form_path'] = 'assets/hcm/applicant_form/latest/';
			$this->data['applicant_form_path2'] = 'assets/hcm/online_applicant_form/latest/';
			$this->data['student_150_photo_path'] = 'assets/photos/sis/150x150/student/';
			$this->data['stdf_150_photo_path'] = 'assets/photos/sis/150x150/father/';
			$this->data['stdm_150_photo_path'] = 'assets/photos/sis/150x150/mother/';
			$this->data['staff_150_photo_path'] ='assets/photos/hcm/150x150/staff/';
			$this->data['student_500_photo_path'] = 'assets/photos/sis/500x500/student/';
			$this->data['stdf_500_photo_path'] = 'assets/photos/sis/500x500/father/';
			$this->data['stdm_500_photo_path'] = 'assets/photos/sis/500x500/mother/';
			$this->data['staff_500_photo_path'] ='assets/photos/hcm/500x500/staff/';
			$this->data['photo_file'] = '.png';
			$this->data['attendance_session_date'] = '2017-08-01';

			// array of allowed pages for the user
			//dump($data);

			


			$this->load->model('staff/staff_registered_model');
			$this->data['staff_registered_data'] = $this->staff_registered_model->get_by(array('user_id' => (int)$this->session->userdata('user_id')));


			/**********************************************************************
			* Starting Roles
			* Class Teacher Access Defined
			* *********************************************************************/
			$this->CoTeacher = false;
			$this->ClassTeacher = false;			
			$this->ClassTeacherGrade = "";
			$this->ClassTeacherSection = "";
			// Checking Roles - for - Class Teacher
			$this->db_staff_integration = $this->load->database('role',TRUE);
			$this->load->model('staff_integration/role_reporting_model');
			$this->data['class_teacher_role'] = $this->role_reporting_model->getClassTeacherRole($this->data['staff_registered_data'][0]->id);
			$this->data['co_teacher_role'] = $this->role_reporting_model->getCoTeacherRole($this->data['staff_registered_data'][0]->id);


	
			$this->db_atif = $this->load->database('default',TRUE);
			$this->load->model('class_list/class_list_access_model');
			$user_id2 = (int)$this->session->userdata('user_id');
			$this->load->view('menus/menu_orb_header', $data);
			$this->load->view('threshold/tapin/gen_attendance_view');
		    $this->load->view('threshold/tapin/gen_attendance_footer');
		
	}
		
}
?>