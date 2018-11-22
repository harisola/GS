<?php 

class Admission_compelete_check extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$user_id =  (int)$this->session->userdata('user_id'); 
	}








	public function index(){
		if($this->ion_auth->logged_in() == FALSE){
			redirect('welcome');
		}else{
			$this->load->view('gs_files/header');
	        $this->load->view('gs_files/main-nav');
	        $this->load->view('gs_files/breadcrumb');

	        $this->load->model('admission/admission_compelete_check_model','accm');
	        $data['pegmo_list'] =  $this->accm->get_pejmo_class_list();
	        $data['aLevel_list'] =  $this->accm->get_aLevel_class_list();


	        $this->load->view('gs_admission/admission_compelete_check/admission_compelete_check_view',$data);
	        $this->load->view('gs_admission/admission_compelete_check/admission_compelete_check_footer');
	    }
	}








	public function getComments(){
		$form_id = $this->input->post('form_id');
		$this->load->model('admission/admission_compelete_check_model','accm');
		$comment = $this->accm->get_log($form_id);
		echo json_encode($comment);
	}

	public function getApplicantData(){
		$this->load->model('admission/admission_compelete_check_model','accm');
		$form_id = $this->input->post('form_id');
		$applicant_data = $this->accm->get_form_check($form_id);
		echo json_encode($applicant_data);
	}

	// GET A-LEVEL CHECKLIST
	public function getApplicantDataAlevel(){

		$this->load->model('admission/admission_compelete_check_model','accm');
		$form_id = $this->input->post('form_id');
		$applicant_data = $this->accm->get_form_check_aLevel($form_id);
		echo json_encode($applicant_data);

	}

	public function updateCheckList(){
		
		$this->load->model('admission/admission_compelete_check_model','accm');
		$data = array();
		$form_id = $this->input->post('form_id');
		$checkList = $this->input->post('formCheckList');
		$data = array();
		for($i = 0 ; $i < sizeof($checkList) ; $i++){
			if($checkList[$i] == 'compeleteFifFormSubmited'){
				array_push($data, ['completed_fif_form' => 1] );
			}
			if($checkList[$i] == 'signedHandbookSubmited'){
				array_push($data, ['signed_hand_book' => 1] );
			}
		}

		for($j = 0 ; $j < sizeof($data) ; $j++){
			
			$where = array(
				'admission_form_id' => $form_id
			);

			$this->accm->update_data('atif_gs_admission.admission_form_offer',$where,$data[$j]);
		}






		/***** Check and register student *****/
		if($this->accm->ShouldRegisterStudent_FormID($form_id)){
			$dataFB = $this->accm->getStudentFeeBillData($form_id);
			if(isset($dataFB)){
				$FeeBillID = $dataFB[0]['gb_id'];
				$ReceivedDate = $dataFB[0]['received_date'];
				$ReceivedBranch = $dataFB[0]['received_branch'];
				$FormNo = $dataFB[0]['form_no'];
				$this->RegisterThisStudent($FeeBillID, $ReceivedDate, $ReceivedBranch,$FormNo);
			}
		}
	}

		// FOR A LEVEL COMPLETE CHECKS
	public function updateCheckListAlevel(){
		$this->load->model('admission/admission_compelete_check_model','accm');
		$data = array();
		$form_id = $this->input->post('form_id');
		$checkList = $this->input->post('formCheckList');
		$data = array();
		for($i = 0 ; $i < sizeof($checkList) ; $i++){
			if($checkList[$i] == 'compeleteFifFormSubmited'){
				array_push($data, ['completed_fif_form' => 1] );
			}
			if($checkList[$i] == 'signedHandbookSubmited'){
				array_push($data, ['signed_hand_book' => 1] );
			}
		}

		for($j = 0 ; $j < sizeof($data) ; $j++){
			
			$where = array(
				'admission_form_id' => $form_id
			);

			$this->accm->update_data('atif_gs_admission.admission_form_offer',$where,$data[$j]);
		}


		$AlevelCheckList = implode(',', $this->input->post("AlevelChecks")) ;



		$where = array(
			'id' => $form_id
		);

		$data = array(
			'alevel_checklist' => $AlevelCheckList
		);

	
		$updateDate = $this->accm->update_data('atif_gs_admission.admission_form',$where,$data);

		/***** Check and register student *****/
		

		if($this->accm->ShouldRegisterStudent_FormID($form_id)){
			$dataFB = $this->accm->getStudentFeeBillData($form_id);
			if(isset($dataFB)){
				$FeeBillID = $dataFB[0]['gb_id'];
				$ReceivedDate = $dataFB[0]['received_date'];
				$ReceivedBranch = $dataFB[0]['received_branch'];
				$FormNo = $dataFB[0]['form_no'];
				$this->RegisterThisStudent($FeeBillID, $ReceivedDate, $ReceivedBranch,$FormNo);
			}
		}

	}






















	public function RegisterThisStudent($FeeBillID, $ReceivedDate, $ReceivedBranch,$FormNo){
			$this->load->model('front_office/family_registered_model');
			if(strlen($FormNo) == 4){
				$FormNo = substr($FeeBillID, 5, 4);
			}else{
				$FormNo = substr($FeeBillID, 4, 5);
			}
			$AdmissionInfo = $this->family_registered_model->getAdmissionFeeInfo($FormNo);

			$Grade_OfAdmission = $AdmissionInfo[0]['grade_name'];
			$GradeIDofAdmission = $AdmissionInfo[0]['grade_id'];
			$NIC = $AdmissionInfo[0]['father_nic'];
			$FatherName = $AdmissionInfo[0]['father_name'];
			$OfficialName = $AdmissionInfo[0]['official_name'];
			$AbridgedName = $AdmissionInfo[0]['abridged_name'];
			$CallName = $AdmissionInfo[0]['call_name'];
			$Gender = $AdmissionInfo[0]['gender'];
			$DOB = $AdmissionInfo[0]['dob'];
			$DOJ = $AdmissionInfo[0]['joining_date'];
			$AdmissionFee = $AdmissionInfo[0]['admission_fee'];
			$SecurityDeposit = $AdmissionInfo[0]['security_deposit'];
			$ComputerSubscription = 0;
			




			$isNewFamily = true;
			$GFID = "";
			$GSID = "";
			$StudentID = "";
			$academicSessionID = 0;	
			$gradeOfAdmission = $GradeIDofAdmission;
			$sessionOfAdmission = 2018;
			$admissionReqNum = 0;
			$client_ip = "";
			$YearOfAdmission = 2018;
			$OnlyYear = 18;


			/*******************************************************
			* IP Address
			* ******************************************************/
			if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			    $client_ip = $_SERVER['HTTP_CLIENT_IP'];
			} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			    $client_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			} else {
			    $client_ip = $_SERVER['REMOTE_ADDR'];
			}


			/**********************************************************************************
			* GF ID
			* Checking if Family already exists, if not then Generate a new GF-ID
			* *********************************************************************************/
			$GFID = $this->family_registered_model->get_GFID($NIC);

			if($GFID != ""){
				$GFID = $this->makeGFID($GFID);
				$isNewFamily = false;
			}else{
				$GFID = $this->family_registered_model->generate_GFID($sessionOfAdmission);
				$GFID = $this->makeGFID($GFID);
			}
			$GFID = $this->makeGFID_Num($GFID);
			/*********************************************************************** E N D ***/





			/**********************************************************************************
			* GS ID
			* Generating new student GS-ID
			* *********************************************************************************/
			$this->load->model('front_office/student_registered_model');
			$GSID = $this->student_registered_model->generate_GSID($sessionOfAdmission);
			$alreadyRegisteredStd = $this->student_registered_model->isOldStudent($OfficialName, $DOB);
			/*********************************************************************** E N D ***/







			/**********************************************************************************
			* Family Record
			* Saving Family Information
			* *********************************************************************************/



			$FInfo = $this->family_registered_model->get_family_registration($NIC);

			$father_mobile = $FInfo["father_mobile"];
			$father_mobile_other = $FInfo["father_mobile_other"];
			$mother_name = $FInfo["mother_name"];
			$mother_mobile = $FInfo["mother_mobile"];
			$mother_nic = $FInfo["mother_nic"];
			$mother_mobile_other = $FInfo["mother_mobile_other"];
			$home_address = $FInfo["home_address"];
			$home_phone = $FInfo["home_phone"];
			$home_apartment_no = $FInfo["home_apartment_no"];
			$home_street_name = $FInfo["home_street_name"];
			$home_building_name = $FInfo["home_building_name"];
			$home_plot_no = $FInfo["home_plot_no"];
			$home_region = $FInfo["home_region"];
			$home_block = $FInfo["home_subregion"];
			$father_qualification = $FInfo["father_qualification"];
			$father_occupation = $FInfo["father_occupation"];
			$father_designation = $FInfo["father_designation"];
			$father_department = $FInfo["father_department"];
			$father_company = $FInfo["father_company"];
			$father_office_location = $FInfo["father_office_location"];
			$father_work_phone = $FInfo["father_work_phone"];
			$father_email = $FInfo["father_email"];
			$mother_qualification = $FInfo["mother_qualification"];
			$mother_occupation = $FInfo["mother_occupation"];
			$mother_designation = $FInfo["mother_designation"];
			$mother_department = $FInfo["mother_department"];
			$mother_company = $FInfo["mother_company"];
			$mother_office_location = $FInfo["mother_office_location"];
			$mother_work_phone = $FInfo["mother_work_phone"];
			$mother_email = $FInfo["mother_email"];
			$single_parent = $FInfo["single_parent"];
			$primary_contact = $FInfo["primary_contact"];


			if($isNewFamily){
				$data = array(
				'nic' => $NIC,
				'gf_id' => $GFID,
				'name' => $FatherName,
				'mobile_phone'=> $father_mobile,
				'email' => $father_email,
				'parent_type' => 1,
				'marital_status' => 'Married',
				'speciality' => $father_designation,
				'profession' => $father_occupation
				);
				$this->family_registered_model->save($data);

				$data = array(
					'nic' => $mother_nic,
					'gf_id' => $GFID,
					'name' => $mother_name,
					'mobile_phone'=> $mother_mobile,
					'email' => $mother_email,
					'parent_type' => 2,
					'marital_status' => 'Married',
					'speciality' => $mother_designation,
					'profession' => $mother_occupation
				);
				$this->family_registered_model->save($data);
			}



			/**********************************************************************************
			* Student Information
			* Saving New Student Information
			* *********************************************************************************/
			$this->load->model('front_office/student_registered_model');
			$data = array(
				'official_name' => ucwords(strtolower($OfficialName)),
				'abridged_name' => ucwords(strtolower($AbridgedName)),
				'call_name' => ucwords(strtolower($CallName)),
				'gender' => $Gender,
				'dob' => $DOB,
				'year_of_admission' => $YearOfAdmission,
				'grade_of_admission' => $Grade_OfAdmission,
				'gr_no' => $OnlyYear . $FormNo,
				'gs_id' => $GSID,
				'gf_id' => $GFID,
				'rfid_dec' => $GSID,
				'rfid_hex' => $GSID
			);
			$GRNoExists = $this->student_registered_model->GRNo_Exists($OnlyYear . $FormNo);
			if(!$GRNoExists){
				if($alreadyRegisteredStd == 0){
					$StudentID = $this->student_registered_model->save($data);
				}else{
					$StudentID = $alreadyRegisteredStd;
				}
			}else{
				$StudentID = $this->student_registered_model->getStudentID($OnlyYear . $FormNo);
			}
			/*********************************************************************** E N D ***/






			/**********************************************************************************
			* New Admission Information
			* Recording New Student Registration Information
			* *********************************************************************************/
			$this->load->model('front_office/req_admission_model');			
			$data = array(
				'form_no' => $FormNo,
				'gr_no' => $OnlyYear.$FormNo,
				'student_id' => $StudentID,
				'student_name' => ucwords(strtolower($OfficialName)),
				'abridged_name' => ucwords(strtolower($AbridgedName)),
				'call_name' => ucwords(strtolower($CallName)),
				'gender' => $Gender,
				'dob' => $DOB,
				'father_name' => ucwords(strtolower($FatherName)),
				'father_nic' => $NIC,
				'grade_id' => $GradeIDofAdmission,
				'doj' => $DOJ,
				'req_date' => date("Y-m-d"),
				'undertaking' => 0,
				'file_created' => 0,
				'register_entry' => 0,
				'admission_fee' => $AdmissionFee,
				'security_deposit' => $SecurityDeposit,
				'computer_subscription' => $ComputerSubscription,
				'ip' => $client_ip
			);
			if(!$GRNoExists){
				$admissionReqNum = $this->req_admission_model->save($data);
			}
			/*********************************************************************** E N D ***/






			/**********************************************************************************
			* New Admission Academic Record
			* Recording New Student to Academic Session
			* *********************************************************************************/			
			if($sessionOfAdmission == "2018"){
				if(($gradeOfAdmission > 0 and $gradeOfAdmission <= 5) OR ($gradeOfAdmission == 17)){
					$academicSessionID = 11;
				}else 
					$academicSessionID = 12;
				}		
			
			$this->load->model('front_office/student_academic_record_model');
			$data = array(
				'student_id' => $StudentID,
				'grade_id' => $gradeOfAdmission,
				'section_id' => 21,
				'house_id' => 1,
				'status_id' => 3,
				'rfid_dec_no' => $GSID,
				'rfid_hex_no' => $GSID,
				'academic_session_id' => $academicSessionID
			);
			if(!$GRNoExists){
				$this->student_academic_record_model->save($data);
			}
			/*********************************************************************** E N D ***/







			/**********************************************************************************
			* New Admission Family Work Information
			* Recording New Student Family Work Detail
			* *********************************************************************************/
			if($isNewFamily){
				$this->load->model('front_office/student_family_work_detail_model');
				$data = array(
					'gf_id' => $GFID,
					'organization' =>$father_company,
					'department'=>$father_department ,
					'designation'=>$father_designation,
					'phone'=>$father_work_phone,
					'address'=>$father_office_location,
					'parent_type'=> 1
				);
				$this->student_family_work_detail_model->save($data);

				
				$data = array(
					'gf_id' => $GFID,
					'organization' =>$mother_company,
					'department'=>$mother_department ,
					'designation'=>$mother_designation,
					'phone'=>$mother_work_phone,
					'address'=>$mother_office_location,
					'parent_type' => 2
				);

				$this->student_family_work_detail_model->save($data);
			}
			/*********************************************************************** E N D ***/






			/**********************************************************************************
			* New Admission Family Home Contact
			* Recording New Student Family Home Contact Detail
			* *********************************************************************************/
			if($isNewFamily){
				$this->load->model('front_office/student_contact_info_model');
				$data = array(
					'gf_id' => $GFID,
					'phone' => $AdmissionInfo[0]['home_phone'],
					'apartment_no' => $AdmissionInfo[0]['home_apartment_no'],
					'building_name' => $AdmissionInfo[0]['home_building_name'],
					'plot_no' => $AdmissionInfo[0]['home_plot_no'],
					'street_name' => $AdmissionInfo[0]['home_street_name'],
					'sub_region' => $AdmissionInfo[0]['home_subregion'],
					'region' => $AdmissionInfo[0]['home_region'],
					'city' => 'Karachi',
					'primary_sms' => 'Father',
					'primary_phone' => 'Father',
					'primary_email' => 'Father'			
				);
				$this->student_contact_info_model->save($data);
			}
			/*********************************************************************** E N D ***/





			/**********************************************************************************
			* New Admission Family Emergency Contact
			* Recording New Student Family Emergency Contact Detail
			* *********************************************************************************/
			if($isNewFamily){
				$this->load->model('front_office/student_family_ec_model');
				$data = array(
					'gf_id' => $GFID,
					'type' => 3
				);
				$this->student_family_ec_model->save($data);
			}
			/*********************************************************************** E N D ***/





			/**********************************************************************************
			* New Admission Family Qualification Information
			* Recording New Student Family Qualification Detail
			* *********************************************************************************/
			if($isNewFamily){
				$this->load->model('front_office/student_family_qualification_model');
				$data = array(
					'gf_id' => $GFID,
					'level'=>$father_qualification,
					'parent_type' => 1
				);
				$this->student_family_qualification_model->save($data);
				$data = array(
					'gf_id' => $GFID,
					'parent_type' => 1
				);
				$this->student_family_qualification_model->save($data);


				$data = array(
					'gf_id' => $GFID,
					'level'=>$mother_qualification,
					'parent_type' => 2
				);
				$this->student_family_qualification_model->save($data);
				$data = array(
					'gf_id' => $GFID,
					'parent_type' => 2
				);
				$this->student_family_qualification_model->save($data);
			}

			/*********************************************************************** E N D ***/




			/**********************************************************************************
			* New Admission Card Request
			* Recording New Student New Card Printing Request
			* *********************************************************************************/
			$this->load->model('front_office/req_duplicatecard_model');
			$data = array(
				'student_id' => $StudentID,
				'req_date' => date("Y-m-d"),
				'new_adm' => 1,
				'ip' => $client_ip
			);
			if(!$GRNoExists){
				$this->req_duplicatecard_model->save($data);
			}
			/*********************************************************************** E N D ***/



			$this->load->model('front_office/Family_registered_model');
			$this->Family_registered_model->updateStudentID_ofFeeBill($FeeBillID, $StudentID);
			$ReceivedDate = date("D, d M Y", strtotime($ReceivedDate));
			$now = date('Y-m-d H:i:s');
			$this->Family_registered_model->update_admission_form_comments($FormNo, 'Admission fee received', 'Paid admission bill on '.$ReceivedDate.' in '.$ReceivedBranch, human_to_unix($now), 1);
	}




	public function makeGFID($ID){
		$makeGFID = "";

		if($ID <= 999){
			$makeGFID = "00" . "-" . str_pad(str_pad($ID, -3), 3, "0", STR_PAD_LEFT);
		}else if($ID <= 9999){
			$makeGFID = "0" . substr($ID, 0, 1) . "-" . substr($ID, -3);
		}else{
			$makeGFID = substr($ID, 0, 2) . "-" . substr($ID, -3);
		}

		return $makeGFID;
	}

	public function makeGFID_Num($ID){
		$makeGFID_Num = "";
		$makeGFID_Num = str_replace("-", "", $ID);

		return $makeGFID_Num;
	}

}