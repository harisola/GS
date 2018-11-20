<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Career extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('hcm/career_form_model');
		$this->load->model('hcm/career_form_uni_model');
		$this->load->model('hcm/career_form_emp_model');
		$this->load->model('hcm/career_form_proq_model');
	}

	public function index()
	{
	//$CI = &get_instance();
	///$CI->load->database();
	//echo $CI->db->hostname;		
	//var_dump($CI); exit;

		$this->form_validation->set_rules($this->career_form_model->validation);
		if($this->form_validation->run() == FALSE){
			$this->load->view('hcm/career/career_metronic362');
		}else{
			$this->add();
		}		
	}



	public function user_availability()
	{
		$NIC = trim($this->input->post('cnic'));

		$result = $this->career_form_model->getLastFormData3($NIC);
		
		

		if($result)
		{
			echo 'false';
		}else
		{
			echo 'true';
		}

	}
	

	public function user_availability2()
	{
		$NIC = $this->input->post('cell_number');

		$result = $this->career_form_model->getLastFormData2($NIC);
		//var_dump($result); exit;

		if($result)
		{
			echo 'false';
		}else
		{
			echo 'true';
		}

	}



	public function add()
	{		
		if(count($_POST))
		{
			/*******************************************************
			* IP Address
			* ******************************************************/
			if (!empty($_SERVER['HTTP_CLIENT_IP'])) 
			{
			    $ip = $_SERVER['HTTP_CLIENT_IP'];
			} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) 
			{
			    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			} else 
			{
			    $ip = $_SERVER['REMOTE_ADDR'];
			}


			if($this->career_form_model->CleanToSave($ip))
			{
				/*******************************************************
				* Classes to Teach
				* ******************************************************/
				$class_to_teach = "";
				if (strlen($this->input->post('early_years')) > 0) 
				{
					$class_to_teach = $class_to_teach .  $this->input->post('early_years');
				}
				if (strlen($this->input->post('I')) > 0 && strlen($class_to_teach) > 0) 
				{
					$class_to_teach = $class_to_teach . "," . $this->input->post('I');
				} else 
				{
					$class_to_teach = $class_to_teach .  $this->input->post('I');
				}
				if (strlen($this->input->post('II')) > 0 && strlen($class_to_teach) > 0) 
				{
					$class_to_teach = $class_to_teach . "," . $this->input->post('II');
				} else 
				{
					$class_to_teach = $class_to_teach .  $this->input->post('II');
				}
				if (strlen($this->input->post('III')) > 0 && strlen($class_to_teach) > 0) {$class_to_teach = $class_to_teach . "," . $this->input->post('III');} else {$class_to_teach = $class_to_teach .  $this->input->post('III');}
				if (strlen($this->input->post('IV')) > 0 && strlen($class_to_teach) > 0) {$class_to_teach = $class_to_teach . "," . $this->input->post('IV');} else {$class_to_teach = $class_to_teach .  $this->input->post('IV');}
				if (strlen($this->input->post('V')) > 0 && strlen($class_to_teach) > 0) {$class_to_teach = $class_to_teach . "," . $this->input->post('V');} else {$class_to_teach = $class_to_teach .  $this->input->post('V');}
				if (strlen($this->input->post('VI')) > 0 && strlen($class_to_teach) > 0) {$class_to_teach = $class_to_teach . "," . $this->input->post('VI');} else {$class_to_teach = $class_to_teach .  $this->input->post('VI');}
				if (strlen($this->input->post('VII')) > 0 && strlen($class_to_teach) > 0) {$class_to_teach = $class_to_teach . "," . $this->input->post('VII');} else {$class_to_teach = $class_to_teach .  $this->input->post('VII');}
				if (strlen($this->input->post('VIII')) > 0 && strlen($class_to_teach) > 0) {$class_to_teach = $class_to_teach . "," . $this->input->post('VIII');} else {$class_to_teach = $class_to_teach .  $this->input->post('VIII');}
				if (strlen($this->input->post('IX')) > 0 && strlen($class_to_teach) > 0) {$class_to_teach = $class_to_teach . "," . $this->input->post('IX');} else {$class_to_teach = $class_to_teach .  $this->input->post('IX');}
				if (strlen($this->input->post('X')) > 0 && strlen($class_to_teach) > 0) {$class_to_teach = $class_to_teach . "," . $this->input->post('X');} else {$class_to_teach = $class_to_teach .  $this->input->post('X');}
				if (strlen($this->input->post('XI')) > 0 && strlen($class_to_teach) > 0) {$class_to_teach = $class_to_teach . "," . $this->input->post('XI');} else {$class_to_teach = $class_to_teach .  $this->input->post('XI');}			
				if (strlen($this->input->post('A_Level')) > 0 && strlen($class_to_teach) > 0) {$class_to_teach = $class_to_teach . "," . $this->input->post('A_Level');} else {$class_to_teach = $class_to_teach .  $this->input->post('A_Level');}





				/*******************************************************
				* Previously Taught Subjects in Classes
				* ******************************************************/
				$taught_grade_1="";$taught_grade_2="";$taught_grade_3="";$taught_grade_4="";
				$taught_subject_1="";$taught_subject_2="";$taught_subject_3="";$taught_subject_4="";
				
				if(!empty($this->input->post('select_grade_1'))){$taught_grade_1 = implode(",", $this->input->post('select_grade_1'));}
				if(!empty($this->input->post('select_grade_2'))){$taught_grade_2 = implode(",", $this->input->post('select_grade_2'));}
				if(!empty($this->input->post('select_grade_3'))){$taught_grade_3 = implode(",", $this->input->post('select_grade_3'));}
				if(!empty($this->input->post('select_grade_4'))){$taught_grade_4 = implode(",", $this->input->post('select_grade_4'));}
				

				if(!empty($this->input->post('select_grade_subject_1'))){$taught_subject_1 = implode(",", $this->input->post('select_grade_subject_1'));}
				if(!empty($this->input->post('select_grade_subject_2'))){$taught_subject_2 = implode(",", $this->input->post('select_grade_subject_2'));}
				if(!empty($this->input->post('select_grade_subject_3'))){$taught_subject_3 = implode(",", $this->input->post('select_grade_subject_3'));}
				if(!empty($this->input->post('select_grade_subject_4'))){$taught_subject_4 = implode(",", $this->input->post('select_grade_subject_4'));}
				




				/*******************************************************
				* School Subjects (Metric / O Level)
				* ******************************************************/
				$school_subjects = "";
				$school_subjects = $school_subjects . $this->input->post('level_1_subject_1');
				$school_subjects = $school_subjects . "," . $this->input->post('level_1_subject_2');
				$school_subjects = $school_subjects . "," . $this->input->post('level_1_subject_3');
				$school_subjects = $school_subjects . "," . $this->input->post('level_1_subject_4');
				$school_subjects = $school_subjects . "," . $this->input->post('level_1_subject_5');
				$school_subjects = $school_subjects . "," . $this->input->post('level_1_subject_6');
				$school_subjects = $school_subjects . "," . $this->input->post('level_1_subject_7');
				$school_subjects = $school_subjects . "," . $this->input->post('level_1_subject_8');
				$school_subjects = $school_subjects . "," . $this->input->post('level_1_subject_9');
				$school_subjects = $school_subjects . "," . $this->input->post('level_1_subject_10');
				$school_subjects = $school_subjects . "," . $this->input->post('level_1_subject_11');
				$school_subjects = $school_subjects . "," . $this->input->post('level_1_subject_12');
				

				$school_grades = "";
				$school_grades = $school_grades . $this->input->post('level_1_subject_grade_1');
				$school_grades = $school_grades . "," . $this->input->post('level_1_subject_grade_2');
				$school_grades = $school_grades . "," . $this->input->post('level_1_subject_grade_3');
				$school_grades = $school_grades . "," . $this->input->post('level_1_subject_grade_4');
				$school_grades = $school_grades . "," . $this->input->post('level_1_subject_grade_5');
				$school_grades = $school_grades . "," . $this->input->post('level_1_subject_grade_6');
				$school_grades = $school_grades . "," . $this->input->post('level_1_subject_grade_7');
				$school_grades = $school_grades . "," . $this->input->post('level_1_subject_grade_8');
				$school_grades = $school_grades . "," . $this->input->post('level_1_subject_grade_9');
				$school_grades = $school_grades . "," . $this->input->post('level_1_subject_grade_10');
				$school_grades = $school_grades . "," . $this->input->post('level_1_subject_grade_11');
				$school_grades = $school_grades . "," . $this->input->post('level_1_subject_grade_12');






				/*******************************************************
				* College Subjects (Inter / A Level)
				* ******************************************************/
				$college_subjects = "";
				$college_subjects = $college_subjects . $this->input->post('level_2_subject_1');
				$college_subjects = $college_subjects . "," . $this->input->post('level_2_subject_2');
				$college_subjects = $college_subjects . "," . $this->input->post('level_2_subject_3');
				$college_subjects = $college_subjects . "," . $this->input->post('level_2_subject_4');
				$college_subjects = $college_subjects . "," . $this->input->post('level_2_subject_5');
				
				

				$college_grades = "";
				$college_grades = $college_grades . $this->input->post('level_2_subject_grade_1');
				$college_grades = $college_grades . "," . $this->input->post('level_2_subject_grade_2');
				$college_grades = $college_grades . "," . $this->input->post('level_2_subject_grade_3');
				$college_grades = $college_grades . "," . $this->input->post('level_2_subject_grade_4');
				$college_grades = $college_grades . "," . $this->input->post('level_2_subject_grade_5');
				
				






				/*******************************************************
				* Date of Birth
				* ******************************************************/
				$DOB = substr($this->input->post('dob'), 6, 4) . "-" . substr($this->input->post('dob'), 3, 2) . "-" . substr($this->input->post('dob'), 0, 2);



				/*******************************************************
				* USER ID --> NULL
				* ******************************************************/
				$this->load->library('session');
				$this->session->set_userdata(array('user_id' => '0'));



				/*******************************************************
				* GC ID
				* ******************************************************/
				$thisID = date('y-m');
				$GCID = $thisID . '/' . $this->career_form_model->generateGCID($thisID);



				/*******************************************************
				* Database values
				* ******************************************************/
				$data = array (						
					'name' => ucwords(strtolower($this->input->post('full_name'))),
					'email' => strtolower($this->input->post('email')),
					'ip' => $ip,
					'mobile_phone' => $this->input->post('cell_number'),
					'nic' => $this->input->post('cnic'),
					'gender' => $this->input->post('gender'),
					'position_applied' => ucwords(strtolower($this->input->post('position_applied'))),
					'seeking_position' => ucwords(strtolower($this->input->post('seeking_position'))),
					'class_to_teach' => $class_to_teach,
					'applied_before' => $this->input->post('applied_before'),
					'dob' => $DOB,
					'nationality' => $this->input->post('nationality'),
					'religion' => ucwords(strtolower($this->input->post('religion'))),
					'marital_status' => $this->input->post('marital_status'),
					'landline' => $this->input->post('landline'),
					'school_name' => $this->input->post('level_1_institute'),
					'school_subjects' => strtoupper($school_subjects),
					'school_grades' => strtoupper($school_grades),
					'school_result' => ucwords(strtolower($this->input->post('level_1_result'))),
					'school_year' => $this->input->post('level_1_year'),
					'college_name' => $this->input->post('level_2_institute'),
					'college_subjects' => strtoupper($college_subjects),
					'college_grades' => strtoupper($college_grades),
					'college_result' => ucwords(strtolower($this->input->post('level_2_result'))),
					'college_year' => $this->input->post('level_2_year'),
					'training_qualification' => $this->input->post('teaching_or_otherwise'),
					'additional_qualification' => $this->input->post('additional_qualification'),
					'it_word' => $this->input->post('it_word'),
					'it_excel' => $this->input->post('it_excel'),
					'it_powerpoint' => $this->input->post('it_powerpoint'),
					'it_erpsoftware' => $this->input->post('it_erp'),
					'it_graphics' => $this->input->post('it_graphics'),
					'it_email' => $this->input->post('it_email'),
					'it_internet' => $this->input->post('it_internet'),
					'it_other' => $this->input->post('it_other'),
					'currently_employed' => $this->input->post('currently_employed'),
					'notice_period' => $this->input->post('currently_employed_notice_period'),
					'current_salary' => $this->input->post('currently_employed_salary'),
					'expected_salary' => $this->input->post('expected_salary'),
					'current_timing' => $this->input->post('currently_employed_timings'),
					'when_can_join' => $this->input->post('when_can_join'),
					'home_address' => $this->input->post('home_address'),
					'school_level' => $this->input->post('school_level'),
					'college_level' => $this->input->post('college_level'),					
					'gc_id' => $GCID,
					'place_of_birth' => $this->input->post('birthPlace'),
					'teach_grade_1' => $taught_grade_1,
					'teach_grade_2' => $taught_grade_2,
					'teach_grade_3' => $taught_grade_3,
					'teach_grade_4' => $taught_grade_4,
					'teach_subject_1' => $taught_subject_1,
					'teach_subject_2' => $taught_subject_2,
					'teach_subject_3' => $taught_subject_3,
					'teach_subject_4' => $taught_subject_4
				);



				/*******************************************************
				* Saving Form and Getting Form No
				* ******************************************************/
				
				
				$form_id = 0;
				$form_id = (int)$this->career_form_model->save($data);




				/*******************************************************
				* Saving University Detail   -- Required
				* ******************************************************/
				$data_uni = array (
					'career_id' => $form_id,
					'name' => $this->input->post('level_3_institute_req'),
					'subjects' => ucwords(strtolower($this->input->post('level_3_subjects_req'))),
					'degree' => strtoupper($this->input->post('level_3_degree_req')),
					'grade' => ucwords(strtolower($this->input->post('level_3_grade_req'))),
					'year' => $this->input->post('level_3_year_req')
				);		

				$career_uni_no = 0;
				$career_uni_no = (int)$this->career_form_uni_model->save($data_uni);




				/*******************************************************
				* Saving University Detail   -- 2
				* ******************************************************/
				$university = $this->input->post('level_3_institute');
				$subjects = $this->input->post('level_3_subjects');
				$degree = $this->input->post('level_3_degree');
				$grade = $this->input->post('level_3_grade');
				$passing_year = $this->input->post('level_3_year');

				if($university[0] != ""){
					$data_uni_1 = array (
						'career_id' => $form_id,
						'name' => $university[0],
						'subjects' => ucwords(strtolower($subjects[0])),
						'degree' => strtoupper(($degree[0])),
						'grade' => ucwords(strtolower($grade[0])),
						'year' => $passing_year[0]
					);		

					$career_uni1_no = 0;
					$career_uni1_no = (int)$this->career_form_uni_model->save($data_uni_1);
				}




				/*******************************************************
				* Saving University Detail   -- 3
				* ******************************************************/
				if(isset($university[1]) && $university[1] != ""){
					$data_uni_2 = array (
						'career_id' => $form_id,
						'name' => $university[1],
						'subjects' => ucwords(strtolower($subjects[1])),
						'degree' => strtoupper(($degree[1])),
						'grade' => ucwords(strtolower($grade[1])),
						'year' => $passing_year[1]
					);		

					$career_uni2_no = 0;
					$career_uni2_no = (int)$this->career_form_uni_model->save($data_uni_2);
				}



				/*******************************************************
				* Saving University Detail   -- 4
				* ******************************************************/
				if(isset($university[2]) && $university[2] != ""){
					$data_uni_3 = array (
						'career_id' => $form_id,
						'name' => $university[2],
						'subjects' => ucwords(strtolower($subjects[2])),
						'degree' => strtoupper(($degree[2])),
						'grade' => ucwords(strtolower($grade[2])),
						'year' => $passing_year[2]
					);		

					$career_uni3_no = 0;
					$career_uni3_no = (int)$this->career_form_uni_model->save($data_uni_3);
				}






				/*******************************************************
				* Saving Employment Detail   -- 1
				* ******************************************************/
				$organization = $this->input->post('emp_institute');
				$designation = $this->input->post('emp_designation');
				$class_taught = $this->input->post('emp_classes');
				$subject_taught = $this->input->post('emp_subject');				
				$salary = $this->input->post('emp_salary');
				$year_from = $this->input->post('emp_year_from');
				$year_to = $this->input->post('emp_year_to');
				$reason_for_leaving = $this->input->post('emp_leaving_reason');

				$emp = 0;
				if($organization[0] != ""){
					$data_emp_0 = array (
						'career_id' => $form_id,
						'organization' => $organization[$emp],
						'designation' => $designation[$emp],
						'class_taught' => $class_taught[$emp],
						'subject_taught' => $subject_taught[$emp],
						'salary' => $salary[$emp],
						'year_from' => $year_from[$emp],
						'year_to' => $year_to[$emp],
						'reason_for_leaving' => ucwords(strtolower($reason_for_leaving[$emp]))
					);		

					$career_emp0_no = 0;
					$career_emp0_no = (int)$this->career_form_emp_model->save($data_emp_0);
				}

				$emp = 1;
				if(isset($organization[1]) && $organization[1] != ""){
					$data_emp_1 = array (
						'career_id' => $form_id,
						'organization' => $organization[$emp],
						'designation' => $designation[$emp],
						'class_taught' => $class_taught[$emp],
						'subject_taught' => $subject_taught[$emp],
						'salary' => $salary[$emp],
						'year_from' => $year_from[$emp],
						'year_to' => $year_to[$emp],
						'reason_for_leaving' => ucwords(strtolower($reason_for_leaving[$emp]))
					);

					$career_emp1_no = 0;
					$career_emp1_no = (int)$this->career_form_emp_model->save($data_emp_1);
				}

				$emp = 2;
				if(isset($organization[2]) && $organization[2] != ""){
					$data_emp_2 = array (
						'career_id' => $form_id,
						'organization' => $organization[$emp],
						'designation' => $designation[$emp],
						'class_taught' => $class_taught[$emp],
						'subject_taught' => $subject_taught[$emp],
						'salary' => $salary[$emp],
						'year_from' => $year_from[$emp],
						'year_to' => $year_to[$emp],
						'reason_for_leaving' => ucwords(strtolower($reason_for_leaving[$emp]))
					);

					$career_emp2_no = 0;
					$career_emp2_no = (int)$this->career_form_emp_model->save($data_emp_2);
				}

				$emp = 3;
				if(isset($organization[3]) && $organization[3] != ""){
					$data_emp_3 = array (
						'career_id' => $form_id,
						'organization' => $organization[$emp],
						'designation' => $designation[$emp],
						'class_taught' => $class_taught[$emp],
						'subject_taught' => $subject_taught[$emp],
						'salary' => $salary[$emp],
						'year_from' => $year_from[$emp],
						'year_to' => $year_to[$emp],
						'reason_for_leaving' => ucwords(strtolower($reason_for_leaving[$emp]))
					);

					$career_emp3_no = 0;
					$career_emp3_no = (int)$this->career_form_emp_model->save($data_emp_3);
				}

				$emp = 4;
				if(isset($organization[4]) && $organization[4] != ""){
					$data_emp_4 = array (
						'career_id' => $form_id,
						'organization' => $organization[$emp],
						'designation' => $designation[$emp],
						'class_taught' => $class_taught[$emp],
						'subject_taught' => $subject_taught[$emp],
						'salary' => $salary[$emp],
						'year_from' => $year_from[$emp],
						'year_to' => $year_to[$emp],
						'reason_for_leaving' => ucwords(strtolower($reason_for_leaving[$emp]))
					);

					$career_emp4_no = 0;
					$career_emp4_no = (int)$this->career_form_emp_model->save($data_emp_4);
				}





				/*******************************************************
				* Saving Professional Qualification Detail   -- 1
				* ******************************************************/
				$proq_name = $this->input->post('pro_name');
				$proq_institute = $this->input->post('pro_institute');
				$proq_year = $this->input->post('pro_year');
				$proq_detail = $this->input->post('pro_detail');

				$emp = 0;
				if($proq_name[0] != ""){
					$data_proq_0 = array (
						'career_id' => $form_id,
						'title' => $proq_name[$emp],
						'institute' => $proq_institute[$emp],
						'year_awarded' => $proq_year[$emp],
						'detail' => $proq_detail[$emp]
					);

					$career_proq_0 = 0;
					$career_proq_0 = (int)$this->career_form_proq_model->save($data_proq_0);
				}

				$emp = 1;
				if(isset($proq_name[1]) && $proq_name[1] != ""){
					$data_proq_1 = array (
						'career_id' => $form_id,
						'title' => $proq_name[$emp],
						'institute' => $proq_institute[$emp],
						'year_awarded' => $proq_year[$emp],
						'detail' => $proq_detail[$emp]
					);

					$career_proq_1 = 0;
					$career_proq_1 = (int)$this->career_form_proq_model->save($data_proq_1);
				}


				$emp = 2;
				if(isset($proq_name[2]) && $proq_name[2] != ""){
					$data_proq_1 = array (
						'career_id' => $form_id,
						'title' => $proq_name[$emp],
						'institute' => $proq_institute[$emp],
						'year_awarded' => $proq_year[$emp],
						'detail' => $proq_detail[$emp]
					);

					$career_proq_2 = 0;
					$career_proq_2 = (int)$this->career_form_proq_model->save($data_proq_2);
				}


				$emp = 3;
				if(isset($proq_name[3]) && $proq_name[3] != ""){
					$data_proq_3 = array (
						'career_id' => $form_id,
						'title' => $proq_name[$emp],
						'institute' => $proq_institute[$emp],
						'year_awarded' => $proq_year[$emp],
						'detail' => $proq_detail[$emp]
					);

					$career_proq_3 = 0;
					$career_proq_3 = (int)$this->career_form_proq_model->save($data_proq_3);
				}


				$emp = 4;
				if(isset($proq_name[4]) && $proq_name[4] != ""){
					$data_proq_4 = array (
						'career_id' => $form_id,
						'title' => $proq_name[$emp],
						'institute' => $proq_institute[$emp],
						'year_awarded' => $proq_year[$emp],
						'detail' => $proq_detail[$emp]
					);

					$career_proq_4 = 0;
					$career_proq_4 = (int)$this->career_form_proq_model->save($data_proq_4);
				}



				$this->person_name = ucwords(strtolower($this->input->post('full_name')));
				$this->gcid = $GCID;

				$thisMobileNo = str_replace("-", "", $this->input->post('cell_number'));
				$fireMessage = "Thank you for applying at careers.generations.gs, application # " . $this->gcid . ".";
				$fireMessage .= "You will be contacted if your application is shortlisted. Jazakallah al khair.";
				$fireMessage = urlencode($fireMessage);
				$this->fullURL = "https://sms4geeks.appspot.com/smsgateway?action=out&username=gs_01&password=commander&msisdn=" . $thisMobileNo . "&msg=" . $fireMessage;

				$this->load->view('hcm/career/career_form_received');
				$this->mesgg = $this->get_data($this->fullURL);
				/*echo '<br> Your Form # :' . $GCID;
				echo '<br><br>' . "Form submitted successfully!";*/
			}else{
				echo 'Please try after ' . $this->career_form_model->getRemainingTime($ip);
			}
		}	
	}	



	function get_data($url) {
		//$url = str_replace(" ","%20",$url);
		$ch = curl_init();
		$timeout = 10;
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}
}