<?php
class Ateeb_Controller extends CI_Controller{

	public function __construct(){
		parent::__construct();

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
		if($this->input->get("codeUID") && $this->input->get("codeANA") && $this->ion_auth->logged_in() == FALSE){
			if($this->input->get("codeANA") == 'XZ3WTJc8nvFgYqxK'){
				$this->ion_auth->logout();
				$this->ion_auth->login_UserID($this->input->get("codeUID"), '');
				$params   = $_SERVER['QUERY_STRING'];
				redirect(current_url(). '?' . $params);
			}
		}
		/********************************************/

		// Check authentication
		if($this->ion_auth->logged_in() == FALSE){
			redirect('welcome');
		}else{
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

			if(uri_string() == 'dashboard/dashboard')
			{
				$no_redirect[] = 'dashboard/dashboard';
				$this->data['current_url'] = 'dashboard/dashboard';
				$this->data['can_user_view'] = 1;
			}else
			if(uri_string() == 'profile/profile_view') {
				$no_redirect[] = 'profile/profile_view';
				$this->data['current_url'] = '/profile/profile_view';
				$this->data['can_user_add'] = 1;
				$this->data['can_user_view'] = 1;
				$this->data['can_user_edit'] = 1;
				$this->data['can_user_delete'] = 0;
				$this->data['can_user_approve'] = 1;
				$this->data['can_user_print'] = 1;
				$this->data['can_user_export'] = 1;
				$this->data['page_header_big_words'] = 'Profile';
				$this->data['page_header_small_words'] = 'View';				
				$this->data['breadcrumb'] = 'View/Profile/';
				$this->data['breadcrumb'] = explode("/", $this->data['breadcrumb']);
				$this->data['breadcrumb'] = array_reverse($this->data['breadcrumb']);
				Unset($this->data['breadcrumb'][0]);
			}else
			if(uri_string() == 'profile/settings') {
				$no_redirect[] = 'profile/settings';
				$this->data['current_url'] = '/profile/settings';
				$this->data['can_user_add'] = 1;
				$this->data['can_user_view'] = 1;
				$this->data['can_user_edit'] = 1;
				$this->data['can_user_delete'] = 0;
				$this->data['can_user_approve'] = 1;
				$this->data['can_user_print'] = 1;
				$this->data['can_user_export'] = 1;
				$this->data['page_header_big_words'] = 'Settings';
				$this->data['page_header_small_words'] = 'Profile';				
				$this->data['breadcrumb'] = 'Profile/Settings/';
				$this->data['breadcrumb'] = explode("/", $this->data['breadcrumb']);
				$this->data['breadcrumb'] = array_reverse($this->data['breadcrumb']);
				Unset($this->data['breadcrumb'][0]);

				$no_redirect[] = 'profile/settings/edit';
				$no_redirect[] = 'profile/settings/edit2';
			}



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
			if(count($this->data['class_teacher_role']) > 0){
				$this->ClassTeacher = true;
				$this->ClassTeacherGrade = $this->data['class_teacher_role'][0]['grade_name'];
				$this->ClassTeacherSection = $this->data['class_teacher_role'][0]['section_name'];

				$access_rights[$sizeOfAccessRights]['id'] = '21';
				$access_rights[$sizeOfAccessRights]['title'] = 'Students';				
				$access_rights[$sizeOfAccessRights]['url'] = '';				
				$access_rights[$sizeOfAccessRights]['position'] = '10';				
				$access_rights[$sizeOfAccessRights]['parent'] = '0';
				$access_rights[$sizeOfAccessRights]['is_parent'] = '1';				
				$access_rights[$sizeOfAccessRights]['page_header_big_words'] = '';
				$access_rights[$sizeOfAccessRights]['page_header_small_words'] = '';
				$access_rights[$sizeOfAccessRights]['link'] = '';
				$access_rights[$sizeOfAccessRights]['page'] = '0';
				$access_rights[$sizeOfAccessRights]['module'] = '';
				$access_rights[$sizeOfAccessRights]['uri'] = '';
				$access_rights[$sizeOfAccessRights]['dyn_group'] = '1';
				$access_rights[$sizeOfAccessRights]['target'] = '';
				$access_rights[$sizeOfAccessRights]['show'] = '1';
				$access_rights[$sizeOfAccessRights]['font_class'] = '';
				$access_rights[$sizeOfAccessRights]['font_icon'] = '';
				$access_rights[$sizeOfAccessRights]['can_create'] = '1';
				$access_rights[$sizeOfAccessRights]['can_read'] = '1';
				$access_rights[$sizeOfAccessRights]['can_update'] = '1';
				$access_rights[$sizeOfAccessRights]['can_delete'] = '0';
				$access_rights[$sizeOfAccessRights]['can_approve'] = '1';
				$access_rights[$sizeOfAccessRights]['can_print'] = '1';
				$access_rights[$sizeOfAccessRights]['can_export'] = '1';
				$sizeOfAccessRights++;
				$access_rights[$sizeOfAccessRights]['id'] = '73';
				$access_rights[$sizeOfAccessRights]['title'] = 'Attendance';				
				$access_rights[$sizeOfAccessRights]['url'] = '';				
				$access_rights[$sizeOfAccessRights]['position'] = '10';				
				$access_rights[$sizeOfAccessRights]['parent'] = '21';
				$access_rights[$sizeOfAccessRights]['is_parent'] = '1';				
				$access_rights[$sizeOfAccessRights]['page_header_big_words'] = '';
				$access_rights[$sizeOfAccessRights]['page_header_small_words'] = '';
				$access_rights[$sizeOfAccessRights]['link'] = '';
				$access_rights[$sizeOfAccessRights]['page'] = '0';
				$access_rights[$sizeOfAccessRights]['module'] = '';
				$access_rights[$sizeOfAccessRights]['uri'] = '';
				$access_rights[$sizeOfAccessRights]['dyn_group'] = '1';
				$access_rights[$sizeOfAccessRights]['target'] = '';
				$access_rights[$sizeOfAccessRights]['show'] = '1';
				$access_rights[$sizeOfAccessRights]['font_class'] = '';
				$access_rights[$sizeOfAccessRights]['font_icon'] = '';
				$access_rights[$sizeOfAccessRights]['can_create'] = '1';
				$access_rights[$sizeOfAccessRights]['can_read'] = '1';
				$access_rights[$sizeOfAccessRights]['can_update'] = '1';
				$access_rights[$sizeOfAccessRights]['can_delete'] = '0';
				$access_rights[$sizeOfAccessRights]['can_approve'] = '1';
				$access_rights[$sizeOfAccessRights]['can_print'] = '1';
				$access_rights[$sizeOfAccessRights]['can_export'] = '1';				
				$sizeOfAccessRights++;
				$access_rights[$sizeOfAccessRights]['id'] = '74';
				$access_rights[$sizeOfAccessRights]['title'] = 'Today';				
				$access_rights[$sizeOfAccessRights]['url'] = 'student_attendance/atd_today';				
				$access_rights[$sizeOfAccessRights]['position'] = '10';				
				$access_rights[$sizeOfAccessRights]['parent'] = '73';
				$access_rights[$sizeOfAccessRights]['is_parent'] = '0';				
				$access_rights[$sizeOfAccessRights]['page_header_big_words'] = 'Attendance';
				$access_rights[$sizeOfAccessRights]['page_header_small_words'] = 'Students';
				$access_rights[$sizeOfAccessRights]['link'] = '';
				$access_rights[$sizeOfAccessRights]['page'] = '0';
				$access_rights[$sizeOfAccessRights]['module'] = '';
				$access_rights[$sizeOfAccessRights]['uri'] = '';
				$access_rights[$sizeOfAccessRights]['dyn_group'] = '1';
				$access_rights[$sizeOfAccessRights]['target'] = '';
				$access_rights[$sizeOfAccessRights]['show'] = '1';
				$access_rights[$sizeOfAccessRights]['font_class'] = '';
				$access_rights[$sizeOfAccessRights]['font_icon'] = '';
				$access_rights[$sizeOfAccessRights]['can_create'] = '1';
				$access_rights[$sizeOfAccessRights]['can_read'] = '1';
				$access_rights[$sizeOfAccessRights]['can_update'] = '1';
				$access_rights[$sizeOfAccessRights]['can_delete'] = '0';
				$access_rights[$sizeOfAccessRights]['can_approve'] = '1';
				$access_rights[$sizeOfAccessRights]['can_print'] = '1';
				$access_rights[$sizeOfAccessRights]['can_export'] = '1';				
				$sizeOfAccessRights++;
				$access_rights[$sizeOfAccessRights]['id'] = '75';
				$access_rights[$sizeOfAccessRights]['title'] = 'History';				
				$access_rights[$sizeOfAccessRights]['url'] = 'student_attendance/atd_history';
				$access_rights[$sizeOfAccessRights]['position'] = '20';				
				$access_rights[$sizeOfAccessRights]['parent'] = '73';
				$access_rights[$sizeOfAccessRights]['is_parent'] = '0';				
				$access_rights[$sizeOfAccessRights]['page_header_big_words'] = 'History';
				$access_rights[$sizeOfAccessRights]['page_header_small_words'] = 'Attendance';
				$access_rights[$sizeOfAccessRights]['link'] = '';
				$access_rights[$sizeOfAccessRights]['page'] = '0';
				$access_rights[$sizeOfAccessRights]['module'] = '';
				$access_rights[$sizeOfAccessRights]['uri'] = '';
				$access_rights[$sizeOfAccessRights]['dyn_group'] = '1';
				$access_rights[$sizeOfAccessRights]['target'] = '';
				$access_rights[$sizeOfAccessRights]['show'] = '1';
				$access_rights[$sizeOfAccessRights]['font_class'] = '';
				$access_rights[$sizeOfAccessRights]['font_icon'] = '';
				$access_rights[$sizeOfAccessRights]['can_create'] = '1';
				$access_rights[$sizeOfAccessRights]['can_read'] = '1';
				$access_rights[$sizeOfAccessRights]['can_update'] = '1';
				$access_rights[$sizeOfAccessRights]['can_delete'] = '0';
				$access_rights[$sizeOfAccessRights]['can_approve'] = '1';
				$access_rights[$sizeOfAccessRights]['can_print'] = '1';
				$access_rights[$sizeOfAccessRights]['can_export'] = '1';				
				$sizeOfAccessRights++;
				$access_rights[$sizeOfAccessRights]['id'] = '76';
				$access_rights[$sizeOfAccessRights]['title'] = 'Active Cases';				
				$access_rights[$sizeOfAccessRights]['url'] = 'student_attendance/active_cases';
				$access_rights[$sizeOfAccessRights]['position'] = '30';
				$access_rights[$sizeOfAccessRights]['parent'] = '73';
				$access_rights[$sizeOfAccessRights]['is_parent'] = '0';				
				$access_rights[$sizeOfAccessRights]['page_header_big_words'] = 'Active Cases';
				$access_rights[$sizeOfAccessRights]['page_header_small_words'] = 'Students';
				$access_rights[$sizeOfAccessRights]['link'] = '';
				$access_rights[$sizeOfAccessRights]['page'] = '0';
				$access_rights[$sizeOfAccessRights]['module'] = '';
				$access_rights[$sizeOfAccessRights]['uri'] = '';
				$access_rights[$sizeOfAccessRights]['dyn_group'] = '1';
				$access_rights[$sizeOfAccessRights]['target'] = '';
				$access_rights[$sizeOfAccessRights]['show'] = '1';
				$access_rights[$sizeOfAccessRights]['font_class'] = '';
				$access_rights[$sizeOfAccessRights]['font_icon'] = '';
				$access_rights[$sizeOfAccessRights]['can_create'] = '1';
				$access_rights[$sizeOfAccessRights]['can_read'] = '1';
				$access_rights[$sizeOfAccessRights]['can_update'] = '1';
				$access_rights[$sizeOfAccessRights]['can_delete'] = '0';
				$access_rights[$sizeOfAccessRights]['can_approve'] = '1';
				$access_rights[$sizeOfAccessRights]['can_print'] = '1';
				$access_rights[$sizeOfAccessRights]['can_export'] = '1';
			}

			if(count($this->data['co_teacher_role']) > 0){
				$this->CoTeacher = true;
				$this->ClassTeacherGrade = $this->data['co_teacher_role'][0]['grade_name'];
				$this->ClassTeacherSection = $this->data['co_teacher_role'][0]['section_name'];

				$access_rights[$sizeOfAccessRights]['id'] = '21';
				$access_rights[$sizeOfAccessRights]['title'] = 'Students';				
				$access_rights[$sizeOfAccessRights]['url'] = '';				
				$access_rights[$sizeOfAccessRights]['position'] = '10';				
				$access_rights[$sizeOfAccessRights]['parent'] = '0';
				$access_rights[$sizeOfAccessRights]['is_parent'] = '1';				
				$access_rights[$sizeOfAccessRights]['page_header_big_words'] = '';
				$access_rights[$sizeOfAccessRights]['page_header_small_words'] = '';
				$access_rights[$sizeOfAccessRights]['link'] = '';
				$access_rights[$sizeOfAccessRights]['page'] = '0';
				$access_rights[$sizeOfAccessRights]['module'] = '';
				$access_rights[$sizeOfAccessRights]['uri'] = '';
				$access_rights[$sizeOfAccessRights]['dyn_group'] = '1';
				$access_rights[$sizeOfAccessRights]['target'] = '';
				$access_rights[$sizeOfAccessRights]['show'] = '1';
				$access_rights[$sizeOfAccessRights]['font_class'] = '';
				$access_rights[$sizeOfAccessRights]['font_icon'] = '';
				$access_rights[$sizeOfAccessRights]['can_create'] = '1';
				$access_rights[$sizeOfAccessRights]['can_read'] = '1';
				$access_rights[$sizeOfAccessRights]['can_update'] = '1';
				$access_rights[$sizeOfAccessRights]['can_delete'] = '0';
				$access_rights[$sizeOfAccessRights]['can_approve'] = '1';
				$access_rights[$sizeOfAccessRights]['can_print'] = '1';
				$access_rights[$sizeOfAccessRights]['can_export'] = '1';
				$sizeOfAccessRights++;
				$access_rights[$sizeOfAccessRights]['id'] = '73';
				$access_rights[$sizeOfAccessRights]['title'] = 'Attendance';				
				$access_rights[$sizeOfAccessRights]['url'] = '';				
				$access_rights[$sizeOfAccessRights]['position'] = '10';				
				$access_rights[$sizeOfAccessRights]['parent'] = '21';
				$access_rights[$sizeOfAccessRights]['is_parent'] = '1';				
				$access_rights[$sizeOfAccessRights]['page_header_big_words'] = '';
				$access_rights[$sizeOfAccessRights]['page_header_small_words'] = '';
				$access_rights[$sizeOfAccessRights]['link'] = '';
				$access_rights[$sizeOfAccessRights]['page'] = '0';
				$access_rights[$sizeOfAccessRights]['module'] = '';
				$access_rights[$sizeOfAccessRights]['uri'] = '';
				$access_rights[$sizeOfAccessRights]['dyn_group'] = '1';
				$access_rights[$sizeOfAccessRights]['target'] = '';
				$access_rights[$sizeOfAccessRights]['show'] = '1';
				$access_rights[$sizeOfAccessRights]['font_class'] = '';
				$access_rights[$sizeOfAccessRights]['font_icon'] = '';
				$access_rights[$sizeOfAccessRights]['can_create'] = '1';
				$access_rights[$sizeOfAccessRights]['can_read'] = '1';
				$access_rights[$sizeOfAccessRights]['can_update'] = '1';
				$access_rights[$sizeOfAccessRights]['can_delete'] = '0';
				$access_rights[$sizeOfAccessRights]['can_approve'] = '1';
				$access_rights[$sizeOfAccessRights]['can_print'] = '1';
				$access_rights[$sizeOfAccessRights]['can_export'] = '1';				
				$sizeOfAccessRights++;
				$access_rights[$sizeOfAccessRights]['id'] = '74';
				$access_rights[$sizeOfAccessRights]['title'] = 'Today';				
				$access_rights[$sizeOfAccessRights]['url'] = 'student_attendance/atd_today';				
				$access_rights[$sizeOfAccessRights]['position'] = '10';				
				$access_rights[$sizeOfAccessRights]['parent'] = '73';
				$access_rights[$sizeOfAccessRights]['is_parent'] = '0';				
				$access_rights[$sizeOfAccessRights]['page_header_big_words'] = 'Attendance';
				$access_rights[$sizeOfAccessRights]['page_header_small_words'] = 'Students';
				$access_rights[$sizeOfAccessRights]['link'] = '';
				$access_rights[$sizeOfAccessRights]['page'] = '0';
				$access_rights[$sizeOfAccessRights]['module'] = '';
				$access_rights[$sizeOfAccessRights]['uri'] = '';
				$access_rights[$sizeOfAccessRights]['dyn_group'] = '1';
				$access_rights[$sizeOfAccessRights]['target'] = '';
				$access_rights[$sizeOfAccessRights]['show'] = '1';
				$access_rights[$sizeOfAccessRights]['font_class'] = '';
				$access_rights[$sizeOfAccessRights]['font_icon'] = '';
				$access_rights[$sizeOfAccessRights]['can_create'] = '1';
				$access_rights[$sizeOfAccessRights]['can_read'] = '1';
				$access_rights[$sizeOfAccessRights]['can_update'] = '1';
				$access_rights[$sizeOfAccessRights]['can_delete'] = '0';
				$access_rights[$sizeOfAccessRights]['can_approve'] = '1';
				$access_rights[$sizeOfAccessRights]['can_print'] = '1';
				$access_rights[$sizeOfAccessRights]['can_export'] = '1';				
				$sizeOfAccessRights++;
				$access_rights[$sizeOfAccessRights]['id'] = '75';
				$access_rights[$sizeOfAccessRights]['title'] = 'History';				
				$access_rights[$sizeOfAccessRights]['url'] = 'student_attendance/atd_history';
				$access_rights[$sizeOfAccessRights]['position'] = '20';				
				$access_rights[$sizeOfAccessRights]['parent'] = '73';
				$access_rights[$sizeOfAccessRights]['is_parent'] = '0';				
				$access_rights[$sizeOfAccessRights]['page_header_big_words'] = 'History';
				$access_rights[$sizeOfAccessRights]['page_header_small_words'] = 'Attendance';
				$access_rights[$sizeOfAccessRights]['link'] = '';
				$access_rights[$sizeOfAccessRights]['page'] = '0';
				$access_rights[$sizeOfAccessRights]['module'] = '';
				$access_rights[$sizeOfAccessRights]['uri'] = '';
				$access_rights[$sizeOfAccessRights]['dyn_group'] = '1';
				$access_rights[$sizeOfAccessRights]['target'] = '';
				$access_rights[$sizeOfAccessRights]['show'] = '1';
				$access_rights[$sizeOfAccessRights]['font_class'] = '';
				$access_rights[$sizeOfAccessRights]['font_icon'] = '';
				$access_rights[$sizeOfAccessRights]['can_create'] = '1';
				$access_rights[$sizeOfAccessRights]['can_read'] = '1';
				$access_rights[$sizeOfAccessRights]['can_update'] = '1';
				$access_rights[$sizeOfAccessRights]['can_delete'] = '0';
				$access_rights[$sizeOfAccessRights]['can_approve'] = '1';
				$access_rights[$sizeOfAccessRights]['can_print'] = '1';
				$access_rights[$sizeOfAccessRights]['can_export'] = '1';				
				$sizeOfAccessRights++;
				$access_rights[$sizeOfAccessRights]['id'] = '76';
				$access_rights[$sizeOfAccessRights]['title'] = 'Active Cases';				
				$access_rights[$sizeOfAccessRights]['url'] = 'student_attendance/active_cases';
				$access_rights[$sizeOfAccessRights]['position'] = '30';
				$access_rights[$sizeOfAccessRights]['parent'] = '73';
				$access_rights[$sizeOfAccessRights]['is_parent'] = '0';				
				$access_rights[$sizeOfAccessRights]['page_header_big_words'] = 'Active Cases';
				$access_rights[$sizeOfAccessRights]['page_header_small_words'] = 'Students';
				$access_rights[$sizeOfAccessRights]['link'] = '';
				$access_rights[$sizeOfAccessRights]['page'] = '0';
				$access_rights[$sizeOfAccessRights]['module'] = '';
				$access_rights[$sizeOfAccessRights]['uri'] = '';
				$access_rights[$sizeOfAccessRights]['dyn_group'] = '1';
				$access_rights[$sizeOfAccessRights]['target'] = '';
				$access_rights[$sizeOfAccessRights]['show'] = '1';
				$access_rights[$sizeOfAccessRights]['font_class'] = '';
				$access_rights[$sizeOfAccessRights]['font_icon'] = '';
				$access_rights[$sizeOfAccessRights]['can_create'] = '1';
				$access_rights[$sizeOfAccessRights]['can_read'] = '1';
				$access_rights[$sizeOfAccessRights]['can_update'] = '1';
				$access_rights[$sizeOfAccessRights]['can_delete'] = '0';
				$access_rights[$sizeOfAccessRights]['can_approve'] = '1';
				$access_rights[$sizeOfAccessRights]['can_print'] = '1';
				$access_rights[$sizeOfAccessRights]['can_export'] = '1';
			}
			$this->db_atif = $this->load->database('default',TRUE);
						
			if($this->CoTeacher || $this->ClassTeacher) {
				$this->load->model('student_attendance/std_atd_model');
				$this->data['studentTPA'] = $this->std_atd_model->getStudentTPA($this->ClassTeacherGrade, $this->ClassTeacherSection);
			}
			/*********************************************************** R O L E **/



			foreach ($access_rights as $access) {
				if ($access['url'] != '' && $access['show'] == 1){

					$no_redirect[] = $access['url'];
					if ($access['can_create'] == 1) {
						$no_redirect[] = $access['url'] . '/add';
						$no_redirect[] = $access['url'] . '/add2';
						$no_redirect[] = $access['url'] . '/add3';
						$no_redirect[] = $access['url'] . '/add4';
						$no_redirect[] = $access['url'] . '/add5';
					}

					if ($access['can_read'] == 1) {
						$no_redirect[] = $access['url'] . '/view';
						$no_redirect[] = $access['url'] . '/view2';
						$no_redirect[] = $access['url'] . '/view3';
					}

					if ($access['can_update'] == 1) {
						$no_redirect[] = $access['url'] . '/edit';
						$no_redirect[] = $access['url'] . '/edit2';
						$no_redirect[] = $access['url'] . '/edit3';
						$no_redirect[] = $access['url'] . '/edit4';
						$no_redirect[] = $access['url'] . '/edit5';
						$no_redirect[] = $access['url'] . '/edit6';
						$no_redirect[] = $access['url'] . '/edit7';
						$no_redirect[] = $access['url'] . '/edit8';
						$no_redirect[] = $access['url'] . '/edit9';
					}

					if ($access['can_delete'] == 1) {
						$no_redirect[] = $access['url'] . '/delete';
					}

					if ($access['can_approve'] == 1) {
						$no_redirect[] = $access['url'] . '/approve';
					}

					if ($access['can_print'] == 1) {
						$no_redirect[] = $access['url'] . '/printForm';
						$no_redirect[] = $access['url'] . '/printForm2';
					}

					if ($access['can_export'] == 1) {
						$no_redirect[] = $access['url'] . '/export';
					}

					if(uri_string()==$access['url'])
					{
						$this->data['can_user_add'] = $access['can_create'];
						$this->data['can_user_view'] = $access['can_read'];
						$this->data['can_user_edit'] = $access['can_update'];
						$this->data['can_user_delete'] = $access['can_delete'];
						$this->data['can_user_approve'] = $access['can_approve'];
						$this->data['can_user_print'] = $access['can_print'];
						$this->data['can_user_export'] = $access['can_export'];

						$this->data['page_header_big_words'] = $access['page_header_big_words'];
						$this->data['page_header_small_words'] = $access['page_header_small_words'];

						$this->data['current_url'] = '/' . $access['url'];
						$parent_id = $access['parent'];
						$has_parent = true;
						$this->data['breadcrumb_last'] = $access['title'];


						/* breadcrumb code */
						while ($has_parent){
							foreach ($access_rights as $access) {
								if ($parent_id == $access['id'] && $parent_id > 0) {
									$this->data['breadcrumb'] .=  $access['title'] . "/";
									$parent_id = $access['parent'];
								}else{
									$has_parent = false;
								}
							}
						}						
						
						$this->data['breadcrumb'] = explode("/", $this->data['breadcrumb']);
						$this->data['breadcrumb'] = array_reverse($this->data['breadcrumb']);
						Unset($this->data['breadcrumb'][0]);
					}
				}
			}

			if(in_array('class_list/name_view', $no_redirect) || in_array('class_list/face_view', $no_redirect)){
				$this->class_list_allowed = true;
			}else{
				$this->class_list_allowed = false;
			}

			
			$this->load->model('class_list/class_list_access_model');
			$user_id2 = (int)$this->session->userdata('user_id');
			if(  $StaffID = $this->class_list_access_model->get_user_group( $user_id2  ) ){
					$result = $StaffID["result"];
					if( $result == 1 ){
						$this->data['StaffID']= $result;
					}else{
						//$this->data['StaffID']= array("StaffID"=>$result );
						$this->data['StaffID']= 0;
					}
				}else{
					//$this->data['StaffID']= array("StaffID"=>0 );
					$this->data['StaffID']= 0;
				}
				
				$this->data['frontOfficerid'] =$this->class_list_access_model->getFrontOfficersID( $user_id2 );
				
				
			if($this->class_list_allowed){
				// Branch data, Academic Session data, Registered Staff Data
				$this->load->model('organization/branch_model');
				$this->load->model('organization/users_in_branch_model');
				$this->load->model('organization/academic_session_model');				

				// Getting all the user groups
				$this->data['branch_data'] = $this->users_in_branch_model->get_by(array('user_id' => (int)$this->session->userdata('user_id')));
				$this->data['academic_session_data'] = $this->academic_session_model->get_by(array('branch_id' => $this->data['branch_data'][0]->id, 'is_active' => 1, 'is_lock' => 0));				
				$this->data['active_academic_session_data'] = $this->academic_session_model->get_by(array('is_active' => 1, 'is_lock' => 0));

				// Loading class list model
				//$this->load->model('class_list/class_list_access_model');
				// Getting necessary class access information
				$this->load->model('class_list/class_list_sr_view_model');

				$active_academic_session = "";
				foreach ($this->data['active_academic_session_data'] as $active_session) {
					$active_academic_session .= "academic_session_id = " . $active_session->id . " or ";
				}
				$this->active_academic_session = trim($active_academic_session, " or ");
				$this->staff_id = "staff_id = " . $this->data['staff_registered_data'][0]->id;
				$this->data['allowed_classes'] = $this->class_list_access_model->get_allowed_class($this->active_academic_session, $this->staff_id);
				// ***************************************************************
			}


			if (in_array(uri_string(), $no_redirect)){
				// Menu theme is orb
				$this->load->view('menus/menu_orb_header', $data);
			}else{				
				redirect('dashboard/dashboard');				
			}
		}
	}
}