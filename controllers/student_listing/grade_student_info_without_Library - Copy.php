<?php
class Grade_student_info extends CI_Controller{
	
	private $table_view;
	private $yellow_header;
	private $Ten_Days_Students,$Sixty_Days;
	
	
    public function __construct(){
		
        parent::__construct();
		$this->load->library('session');
		
		
		
		
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
		$this->AcademicSessionFrom = 7;
		$this->AcademicSessionTo = 8;
		$this->TermID = 1;
		$this->load->model('access_rights_model');
		$access_rights = $this->access_rights_model->get_rights();
		$sizeOfAccessRights = sizeof($access_rights);

		$this->skip_breadcrumb[] = 'student_attendance/atd_today';
		$this->skip_breadcrumb[] = 'student_attendance/atd_history';
		$this->skip_breadcrumb[] = 'student_attendance/active_cases';
		// ***************************************************************

		// Check authentication
		if($this->ion_auth->logged_in() == FALSE){
			redirect('welcome');
		}else{
			$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
			$this->output->set_header("Pragma: no-cache");

			$this->data['page_title'] = "Generation's School";
			$this->data['brand'] = "GS";
			$this->data['org_font'] = 'Cooper Black';
			$this->data['org_font_color'] = '#993838 !important';
			$this->data['title_background_color_add'] = 'dark-red';
			$this->data['title_background_color_view'] = 'dark-blue';
			$this->data['class_list_color_view'] = 'marine';
			$this->data['online_applicant_color_view'] = 'marine';
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
			$this->data['attendance_session_date'] = '2015-08-01';

			// array of allowed pages for the user
			//dump($data);

			if(uri_string() == 'dashboard/dashboard')
			{
				$no_redirect[] = 'dashboard/dashboard';
				$this->data['current_url'] = 'dashboard/dashboard';
				$this->data['can_user_view'] = 1;
			}else
			if(uri_string() == 'profile/profile_view') {
				
			}else
			if(uri_string() == 'profile/settings') {
				
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
			$this->data['StaffID']= 0;
			$this->data['frontOfficerid'] = NULL;
				
				
		


			if (in_array(uri_string(), $no_redirect)){
				// Menu theme is orb
				//$this->load->view('menus/menu_orb_header', $data);
			}else{				
				redirect('dashboard/dashboard');				
			}
		}
    }
	
	
	//Main Controller Method
	
	public function index(){
		if($this->ion_auth->logged_in() == FALSE){
			redirect('welcome');
		}else{
			
		  	$this->load->model('student_listing/student_info_model', 'SI');
			$this->load->view('student_listing_header/header');
	        //$this->load->view('gs_files/main-nav');
	        //$this->load->view('gs_files/breadcrumb');
			
			
			$student_id = 3375;
			
			
			if(isset( $_GET["grade_id"] ) ){
				$grade_id=  $_GET["grade_id"];
			}else{
				$grade_id=10;
			}
			
			if(isset( $_GET["section_id"] ) ){
				$section_id=  $_GET["section_id"];
			}else{
				$section_id=6;
			}
			
			if(isset( $_GET["Grade_name"] ) ){
				$data['Grade_name']=  $_GET["Grade_name"];
				$data['Grade_id']=  $grade_id;
			}else{
				$data['Grade_name']='VII';
				$data['Grade_id']=  $grade_id;
			}
			if(isset( $_GET["secName"] ) ){
				$data['Sectoion_name']=  $_GET["secName"];
				$data['Section_id']=  $section_id;
			}else{
				$data['Sectoion_name']='W';
				$data['Section_id']=  $section_id;
			}
			
			
			
			
			
			// Get Grade Section Student List
			//$grade_section_student = $this->get_table_list( $grade_id, $section_id );
			//var_dump( $grade_section_student ); exit;
			
			$this->load->library('MasterPagStudents_lib','','MPS');
			$data["table_view"] = $this->MPS->get_table_list( $grade_id, $section_id );
			
			$data["Ten_Days_Students"]= round($this->MPS->Ten_Days_Students,1); 
			$data["Sixty_Days"]=round($this->MPS->Sixty_Days,1); 
			
			
		
			
			
			$aca = $this->SI->get_academic($grade_id,$section_id);
			$academic =  $aca["Academic"];
			$data["Current_Academic"]=$academic;
			$Current_Term = $this->SI->get_term($academic);
			$data["Current_Term"]=$Current_Term["Term"];
			
			
			
			
			
			$student_profile = $this->SI->get_student_profile($student_id);
			$data['student_profile'] = $student_profile;
			
			$gf_id = $student_profile["gf_id"];
			$data['parent_info'] = $this->SI->get_parents_info($gf_id);
			$data['work_detail'] = $this->SI->student_family_work_detail($gf_id);
			//$data["table_view"] = $this->table_view;
			
			
			$getGradeSectionTotal = $this->SI->getGradeSectionTotal($grade_id,$section_id);
			
			$grade_teacher = $this->SI->get_grade_co_Teacher($grade_id, $section_id);
			
				// Grade Section Yellow Header?
			$header_count = $this->SI->count_students($grade_id, $section_id );
			//var_dump(  $grade_teacher ); exit;
			if(  !empty( $header_count ) ){
				$data['header_count'] = $header_count;
			}else{
				$data['header_count'] = NULL;
			}
			if(  !empty( $grade_teacher ) ){
				$data['grade_teacher'] = $grade_teacher;
			}else{
				$data['grade_teacher'] = NULL;
			}
			
			if(  !empty( $getGradeSectionTotal ) ){
				$data['getGradeSectionTotal'] = $getGradeSectionTotal;
			}else{
				$data['getGradeSectionTotal'] = NULL;
			}
			
		
			
			$this->load->view('student_listing/landing_page/index',$data );
	        $this->load->view('student_listing/landing_page/footer');
		}	
	}
	
	/*
	public function get_table_list($grade_id, $section_id){
		$this->load->model('student_listing/student_info_model', 'SI');
		//$grade_section_student = $this->SI->get_grade_section_students($grade_id,$section_id);
		//$grade_section_student = $this->SI->masterlist($grade_id,$section_id,$gs_id=NULL);
		$grade_section_student = $this->SI->getStudent($grade_id,$section_id,$GS_ID=NULL);
		//var_dump( $Grade_Section_Student ); exit;
		$p_verf = $this->SI->present_verfication($grade_id,$section_id);
		
		
		
		//var_dump( $grade_section_student ); exit;
		
		$Student10Days=0;
		$Student60Days=0;
		
		$count_student = 1;
		$this->table_view = '';
		if( !empty($grade_section_student) ){
			
			$TotalStudents = count( $grade_section_student );
			foreach( $grade_section_student as $student){
				$Student_Id = $student["Student_Id"];
				$this->table_view .= '<tr class="" id="studentID_'.$Student_Id.'">';
				
	            $this->table_view .= '<td class="text-center">'.$count_student.'</td>'; // Counter TD
				
				// Class Td
				$this->table_view .= '<td class="text-center">';
				$Grade_Name = $student["Grade_Name"];
				$Section_Name= $student["Section_Name"];
				$AnOther ="S"; // Status Code 1
				
				
		
			
				$AnOther2 = $student["Statud_Code"]; // Status Code 2
				
				//$roll_no = $student["GS_ID"];
				$roll_no = $student["Roll_no"];
				
				$Status_Color = $student["Status_Color"]; // Status Code 2
				
				$this->table_view .= $this->class_td($Grade_Name, $Section_Name, $AnOther,$AnOther2,$roll_no,$Status_Color);
	            $this->table_view .= '</td>';
				
				// Name TD
				$Call_name = $student["Abridged_Name"];
				$AnOtherName = "F_Name";
				$GS_ID = $student["GS_ID"];
				$O_Name = $student["O_Name"];
				$A_Name = $student["Abridged_Name"];
				$C_Name = $student["C_Name"];
			
				$this->table_view .= '<td>';
				$this->table_view .=  $this->name_td($O_Name,$A_Name,$C_Name,$AnOtherName,$GS_ID,$Student_Id);
				$this->table_view .= '</td>';
				// Attendance TD
				$this->table_view .= '<td class="text-center">';
				$attendance_varification=12;
				//$Att10Days= $student["last10Days"];
				$Att10Days = $student["total_pf"];
				$Att60Days = $student["total_ps"];
				$Student10Days += $student["total_pf"];
				$Student60Days += $student["total_ps"];
				
				$T10Days = $student["total_wdf"];
				$T60Days = $student["total_wds"];
				if( $student["Case_ID"] == '' ){
					if( !empty( $p_verf ) ){ 
						$attendance_varification=1;	
					}else{ $attendance_varification=0; }
				}else{
					if( $student["Case_ID"] == 'Unauthorized Absent' ){
						$attendance_varification=2;	
					}elseif( $student["Case_ID"] == 'Authorized Absent' ){
						$attendance_varification=3;	
					}else{
						$attendance_varification=4;	
						//$student["Case_ID"] == 'Uninformed'	
					}
					
				}
						
					
					
					
		
		
				$this->table_view .= $this->Attendance_td($attendance_varification,$Att10Days,$Att60Days );
				$this->table_view .= '</td>';
				
				//  Profile TD
				
				$P_Academic = $student["P_Academic"];
				$P_Social 	= $student["P_Social"];
				$P_Parental = $student["P_Parental"];
				$P_Accounts = $student["P_Accounts"];
				$P_Support  = $student["P_Support"];
				$P_Conduct  = $student["P_Conduct"];
				$this->table_view .= '<td class="text-center">';
					$this->table_view .= $this->profile_td($P_Academic,$P_Social,$P_Parental,$P_Accounts,$P_Support,$P_Conduct);
                $this->table_view .= '</td>';
				
				// Budges TD
				$this->table_view .= '<td class="text-center">';
				$budges_type=1;
					$this->table_view .= $this->budges_td($budges_type);
				$this->table_view .= '</td>';
				
				
				$Case_ID  = $student["Case_ID"];
				if( $Case_ID == '' ){
					$grayBell=0;
				}else{
					$grayBell=1;
				}
	            $this->table_view .= '<td class="text-center">';
					$this->table_view .= $this->ringBell($grayBell,$GS_ID);
				$this->table_view .= '</td>';
				
				$this->table_view .= '</tr>';
				
				$count_student++;
			} // end foreach
			
			// 10 Days Formula
			$this->Ten_Days_Students = 0;
			$TenDaysDividedBy = ($TotalStudents*$T10Days);
			$TenDaysDividedResult = ($Student10Days/$TenDaysDividedBy);
			$this->Ten_Days_Students = ($TenDaysDividedResult*10);
			
			// 60 Days Formula
			$SixtyDaysDividedBy = ($TotalStudents * $T60Days);
			$SixtyDaysDividedResult = ($Student60Days / $SixtyDaysDividedBy);
			$this->Sixty_Days =0;
			$this->Sixty_Days = ($SixtyDaysDividedResult*10);
			
			return $this->table_view;
			
		}else{
			return FALSE;
		}
		
	}
	
	// Class TD
	public function class_td($Grade_Name=NULL, $Section_Name=NULL, $AnOther=NULL, $AnOther2=NULL,$roll_no=NULL,$Status_Color=NULL){
		$td = '';
		$td .= '<span class="class_Name BoySta">';
		$td .= '<span data-toggle="tooltip" data-placement="top" data-original-title="Roll No: '.$roll_no.'" data-pin-nopin="true">';
		$td .= $Grade_Name.'-'.$Section_Name; // class name
		$td .= '</span>';
		//style="background:#'.$Status_Color.'" 
		$td .= '<span class="StuStatus" data-toggle="tooltip" data-placement="top" data-original-title="Roll No: '.$AnOther2.'" data-pin-nopin="true">';
		$td .= $AnOther;  // section name
		$td .= '</span>';
		$td .= '</span>';
		return $td;
	}
	
	
	// Name Td
	public function name_td($O_Name=NULL,$A_Name=NULL,$C_Name=NULL,$AnOtherName=NULL,$GS_ID=NULL,$Student_Id=NULL){
		
		$td = '';
		$td .= '<a href="#" id="std_'.$Student_Id.'_gsid_'.$GS_ID.'" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: '.$GS_ID.'" data-pin-nopin="true" class="anchorCol">';
		
		$EO_Name = explode(' ',$A_Name);
		foreach( $EO_Name as $on ){
			if($on == $C_Name){
				$td .= '<strong>'; 
				$td .= $on; 
				$td .= ' </strong> ';
				
			}else{
				$str = $on;
				$strpos = strpos( $str , $C_Name );
				$strlen = strlen($C_Name);
				$strlen2 = strlen($str);
				if( $strpos !== false ){
					$name = substr($str,$strpos,$strlen);
					$strong_name = "<strong>".$name."</strong>";
					$frist_part = substr( $str,0, $strpos );
					$name3 = substr( $str, $strpos );
					$second_part = str_replace($name, ' ', $name3);
					$final_Call_Name = $frist_part.$strong_name. $second_part;
					$td .= $final_Call_Name.' ';
				}else{
					$td .= ' '.$on.' ';
				}
		  }
		}
		
		//$td .= ' ' .$AnOtherName;
		
		$td .= '</a>';
		return $td;
	}
	
	
	public function Attendance_td($attendance_varification=NULL,$Att10Days=NULL,$Att60Days=NULL ){
		$td = '';
	
			
			if( $attendance_varification == 1){ 
				//Presence Verified
				$AttBox = "PV";
				$data_original_title ="Presence Verified";
			}elseif( $attendance_varification ==2){
				
				//Absent Unauthorized	
				$AttBox = "AU";
				$data_original_title ="Absent Unauthorized";
			}elseif( $attendance_varification ==3){
				//Absent Authorized	
				$AttBox = "AA";
				$data_original_title ="Absent Authorized";
			}elseif( $attendance_varification ==4){
				//Absence Verification Pending
				$AttBox = "AP";
				$data_original_title ="Absence Verification Pending";
			}elseif( $attendance_varification ==5){
				//Tap in Awaited
				$AttBox = "TA";
				$data_original_title ="Tap in Awaited";
			}elseif( $attendance_varification ==6){
				//Not Expected Today
				$AttBox = "NE";
				$data_original_title ="Not Expected Today";
			}else{
				//Presence Pending Verification
				$AttBox = "PP";
				$data_original_title ="Presence Pending Verification";
			}
		$td .= '<span class="AttBox '.$AttBox.'" style="min-width:60px;">';
		$td .= '<span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="'.$data_original_title.'" data-pin-nopin="true">';
		$td .= $AttBox;
		$td .= '</span>';
		$td .= '<span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">';
		$td .= $Att10Days;
		$td .= '</span>';
		$td .= '<span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">';
		$td .= $Att60Days;
		$td .= '</span>';
		$td .= '</span>';
		
		return $td;
								
	} // end
	
	
		

                                
                                
                  
	public function profile_td($P_Academic,$P_Social,$P_Parental,$P_Accounts,$P_Support,$P_Conduct){
		$td = '';
		
		$Profile='';
		if( $P_Academic != NULL){
			if($P_Academic == 'A' || $P_Academic == 'A+' || $P_Academic == 'A-'){
				$Profile='ProfileA';
			}elseif( $P_Academic == 'B' || $P_Academic == 'B+' || $P_Academic == 'B-' ){
				$Profile='ProfileB';
			}elseif( $P_Academic == 'C'){
				$Profile='ProfileC';
			}elseif( $P_Academic == 'D'){
				$Profile='ProfileD';
			}
		
		}else{ $Profile='ProfileGray'; $P_Academic = '-'; }
		
		$td .= '<span class="'.$Profile.' Academic" data-toggle="tooltip" data-placement="top" data-original-title="Academic" data-pin-nopin="true">';
		$td .= $P_Academic;
		$td .= '</span>&nbsp;';
		
        
		$Profile='';
		if( $P_Parental != NULL ){
			if($P_Parental == 'A' || $P_Parental == 'A+' || $P_Parental == 'A-'){
				$Profile='ProfileA';
			}elseif( $P_Parental == 'B' || $P_Parental == 'B+' || $P_Parental == 'B-' ){
				$Profile='ProfileB';
			}elseif( $P_Parental == 'C'){
				$Profile='ProfileC';
			}elseif( $P_Parental == 'D'){
				$Profile='ProfileD';
			}
		
		}else{ $Profile='ProfileGray'; $P_Parental = '-'; }
		
		$td .= '<span class="'.$Profile.' Parental" data-toggle="tooltip" data-placement="top" data-original-title="Parental" data-pin-nopin="true">';
		$td .= $P_Parental;
		$td .= '</span>&nbsp;';
		
		
		$Profile='';
		if( $P_Social != NULL ){
			if($P_Social == 'A' || $P_Social == 'A+' || $P_Social == 'A-'){
				$Profile='ProfileA';
			}elseif( $P_Social == 'B' || $P_Social == 'B+' || $P_Social == 'B-' ){
				$Profile='ProfileB';
			}elseif( $P_Social == 'C'){
				$Profile='ProfileC';
			}elseif( $P_Social == 'D'){
				$Profile='ProfileD';
			}
		
		}else{ $Profile='ProfileGray'; $P_Social = '-'; }
		
		$td .= '<span class="'.$Profile.'  Social" data-toggle="tooltip" data-placement="top" data-original-title="Social" data-pin-nopin="true">';
		$td .= $P_Social;
		$td .= '</span>&nbsp;';
		
		
		
		$Profile='';
		if( $P_Accounts != NULL ){
			if($P_Accounts == 'A' || $P_Accounts == 'A+' || $P_Accounts == 'A-'){
				$Profile='ProfileA';
			}elseif( $P_Accounts == 'B' || $P_Accounts == 'B+' || $P_Accounts == 'B-' ){
				$Profile='ProfileB';
			}elseif( $P_Accounts == 'C'){
				$Profile='ProfileC';
			}elseif( $P_Accounts == 'D'){
				$Profile='ProfileD';
			}
		
		}else{ $Profile='ProfileGray'; $P_Accounts = '-'; }
		
		$td .= '<span class="'.$Profile.'  Account" data-toggle="tooltip" data-placement="top" data-original-title="Accounts" data-pin-nopin="true">';
		$td .= $P_Accounts; 
		$td .= '</span><br />';
		return $td;
	}
	
	
	public function budges_td( $budges_type=NULL ){
		$td = '';
		
		if( $budges_type != NULL ){
			
			if($budges_type==1){
				$td .= '<span class="ProfileB text-center">G</span>&nbsp;';
				$td .= '<span class="ProfileC text-center">M</span>&nbsp;';
				$td .= '<span class="ProfileD text-center">A</span>&nbsp;';
				$td .= '<span class="ProfileGray text-center">.</span>';	
			}elseif($budges_type==2){
				$td .= '<span class="ProfileB text-center">G</span>&nbsp;';
				$td .= '<span class="ProfileC text-center">Q</span>&nbsp;';
				$td .= '<span class="ProfileD text-center">A</span>&nbsp;';
			}elseif($budges_type==3){
				$td .= '<span class="ProfileB text-center">Z</span>&nbsp;';
				$td .= '<span class="ProfileC text-center">O</span>&nbsp;';
			}elseif($budges_type==4){
				$td .= '<span class="Badge text-center" style="background:#369;">I</span>&nbsp;';
				$td .= '<span class="Badge text-center" style="background:#666;">T</span>&nbsp;';
				$td .= ' <span class="Badge text-center" style="background:#F00;">L</span>&nbsp;';
			}elseif($budges_type==5){
				$td .= '<span class="Badge text-center" style="background:#06F">M</span>&nbsp;';
			}elseif($budges_type==6){
				$td .= '';
			}else{
				$td .= '<span class="ProfileB text-center">B</span>&nbsp;';
				$td .= '<span class="ProfileC text-center">C</span>&nbsp;';
				$td .= '<span class="ProfileD text-center">D</span>&nbsp;';
				$td .= '<span class="ProfileGray text-center">.</span>&nbsp;';
			}
		
		
		}else{
			$td = '';
		}
		
		
		return $td;
	}
	
	
	public function ringBell($bell_type=NULL,$GS_ID=NULL){
		$bell_Image = '';
		if( $bell_type != NULL ){
			
			if($bell_type==1){
				$bell_Image .= '<a data-toggle="modal" class="items-image show_student_activecase" data-id='.$GS_ID.' href="#">';
				$bell_Image .= '<img src="'.base_url().'components/student_listing/images/redBell.jpg" width="15" />';	
			$bell_Image .= '</a>';	
			}else{
				$bell_Image .= '<img src="'.base_url().'components/student_listing/images/grayBell.jpg" width="15" />';	
			}	
			
		}else{
			//$bell_Image = '';
			$bell_Image .= '<img src="'.base_url().'components/student_listing/images/grayBell.jpg" width="15" />';	
		}
		
		return $bell_Image;
	}*/
	
}