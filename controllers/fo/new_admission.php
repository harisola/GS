<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class New_admission extends MY_Controller {
	public function __construct(){
		parent::__construct();				
		
	}


	public function index()
	{	
		$this->form_validation->set_rules($this->validation_new_admission);
		
		$this->form_no = "";
		$this->gr_no = "";
		$this->gender = "";
		$this->official_name = "";
		$this->abridged_name = "";
		$this->call_name = "";
		$this->dob = "";

		$this->father_name = "";
		$this->father_nic = "";

		$this->grade_of_admission = "";
		$this->session_of_admission ="";
		$this->doj = "";
		$this->undertaking = "";

		$this->admission_fee = "";
		$this->security_deposit = "";
		$this->computer_subscription = "";


		if($this->form_validation->run() == FALSE){
			if(count($_POST))
			{
				$this->form_no = $this->input->post('form_no');
				$this->gr_no = '16'.$this->input->post('form_no');
				$this->gender = $this->input->post('gender');
				$this->official_name = $this->input->post('official_name');
				$this->abridged_name = $this->input->post('abridged_name');
				$this->call_name = $this->input->post('call_name');
				$this->dob = $this->input->post('student_dob');

				$this->father_name = $this->input->post('father_name');
				$this->father_nic = $this->input->post('nic');

				$this->grade_of_admission = $this->input->post('gradeofadmission');
				$this->session_of_admission = $this->input->post('sessionofadmission');
				$this->doj = $this->input->post('studentdoj');
				$this->undertaking = $this->input->post('undertaking');

				$this->admission_fee = $this->input->post('admission_fee');
				$this->security_deposit = $this->input->post('security_deposit');
				$this->computer_subscription = $this->input->post('computer_subscription');
			}


			$this->load->view('frontoffice/new_admission_view.php');
			$this->load->model('front_office/req_admission_model');
			$this->data['AdmissionData'] = $this->req_admission_model->getAllAdmissionData();
			$this->load->view('frontoffice/new_admission_info.php');
			$this->load->view('frontoffice/frontoffice_footer_orb.php');
					
		} else {
			$this->add();
		}
	}



	public $validation_new_admission = array(
		array('field' => 'form_no', 'label' => 'Form #', 'rules' => 'trim|sanitize|required|is_unique[req_admission.form_no]'),
		array('field' => 'gender', 'label' => 'Gender', 'rules' => 'trim|sanitize|required'),
		array('field' => 'official_name', 'label' => 'Student Official Name', 'rules' => 'trim|sanitize|required'),
		array('field' => 'abridged_name', 'label' => 'Student Abridged Name', 'rules' => 'trim|sanitize|max_length[18]'),
		array('field' => 'call_name', 'label' => 'Student Call Name', 'rules' => 'trim|sanitize|required|max_length[9]'),

		array('field' => 'student_dob', 'label' => 'Student Date of Birth', 'rules' => 'trim|sanitize|required'),	

		array('field' => 'nic', 'label' => 'Father NIC', 'rules' => 'trim|sanitize|required|min_length[15]|max_length[15]'),
		array('field' => 'father_name', 'label' => 'Father Name', 'rules' => 'trim|sanitize|required'),

		array('field' => 'gradeofadmission', 'label' => 'Grade of Admission', 'rules' => 'trim|sanitize|required'),
		array('field' => 'sessionofadmission', 'label' => 'Session of Admission', 'rules' => 'trim|sanitize|required'),
		array('field' => 'studentdoj', 'label' => 'Student Date of Joining', 'rules' => 'trim|sanitize|required'),
		array('field' => 'undertaking', 'label' => 'Undertaking', 'rules' => 'trim|sanitize|required'),

		array('field' => 'red_file', 'label' => 'Red File Created?', 'rules' => 'trim|sanitize|required'),
		array('field' => 'register_entry', 'label' => 'GS Register Entry?', 'rules' => 'trim|sanitize|required'),

		array('field' => 'admission_fee', 'label' => 'Student Admission Fee', 'rules' => 'trim|sanitize|required|max_length[5]'),
		array('field' => 'security_deposit', 'label' => 'Student Security Deposit', 'rules' => 'trim|sanitize|max_length[5]'),
		array('field' => 'computer_subscription', 'label' => 'Student Computer Subscription', 'rules' => 'trim|sanitize|max_length[4]')		
	);



	public function add()
	{
		if(count($_POST))
		{
			$isNewFamily = true;
			$GFID = "";
			$GSID = "";
			$StudentID = "";
			$academicSessionID = 0;	
			$gradeOfAdmission = $this->input->post('gradeofadmission');		
			$sessionOfAdmission = $this->input->post('sessionofadmission');
			$sessionYear = 17;
			$admissionReqNum = 0;
			$client_ip = "";


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
			$this->load->model('front_office/family_registered_model');
			$GFID = $this->family_registered_model->get_GFID($this->input->post('nic'));

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
			/*********************************************************************** E N D ***/

			/*var_dump($GFID);
			var_dump(intval($this->makeGFID_Num($GFID)));

			var_dump($GSID);*/





			/**********************************************************************************
			* Family Record
			* Saving Family Information
			* *********************************************************************************/
			if($isNewFamily){
				$data = array(
				'nic' => $this->input->post('nic'),
				'gf_id' => $GFID,
				'name' => $this->input->post('father_name'),
				'parent_type' => 1,
				'marital_status' => 'Married'
				);
				$this->family_registered_model->save($data);

				$data = array(
					'nic' => "",
					'gf_id' => $GFID,
					'name' => "",
					'parent_type' => 2,
					'marital_status' => 'Married'
				);
				$this->family_registered_model->save($data);
			}



			/**********************************************************************************
			* Student Information
			* Saving New Student Information
			* *********************************************************************************/
			$this->load->model('front_office/student_registered_model');
			$data = array(
				'official_name' => ucwords(strtolower($this->input->post('official_name'))),
				'abridged_name' => ucwords(strtolower($this->input->post('abridged_name'))),
				'call_name' => ucwords(strtolower($this->input->post('call_name'))),
				'gender' => $this->input->post('gender'),
				'dob' => $this->input->post('student_dob'),
				'year_of_admission' => $sessionOfAdmission,
				'grade_of_admission' => $this->input->post('gradeofadmission'),
				'gr_no' => $sessionYear. $this->input->post('form_no'),
				'gs_id' => $GSID,
				'gf_id' => $GFID,
				'rfid_dec' => $GSID,
				'rfid_hex' => $GSID
			);
			$StudentID = $this->student_registered_model->save($data);
			/*********************************************************************** E N D ***/






			/**********************************************************************************
			* New Admission Information
			* Recording New Student Registration Information
			* *********************************************************************************/
			$this->load->model('front_office/req_admission_model');			
			$data = array(
				'form_no' => $this->input->post('form_no'),
				'gr_no' => $sessionYear.$this->input->post('form_no'),
				'student_id' => $StudentID,
				'student_name' => ucwords(strtolower($this->input->post('official_name'))),
				'abridged_name' => ucwords(strtolower($this->input->post('abridged_name'))),
				'call_name' => ucwords(strtolower($this->input->post('call_name'))),
				'gender' => $this->input->post('gender'),
				'dob' => $this->input->post('student_dob'),
				'father_name' => ucwords(strtolower($this->input->post('father_name'))),
				'father_nic' => $this->input->post('nic'),
				'grade_id' => $this->input->post('gradeofadmission'),
				'doj' => $this->input->post('studentdoj'),
				'req_date' => date("Y-m-d"),
				'undertaking' => $this->input->post('undertaking'),
				'file_created' => $this->input->post('red_file'),
				'register_entry' => $this->input->post('register_entry'),
				'admission_fee' => $this->input->post('admission_fee'),
				'security_deposit' => $this->input->post('security_deposit'),
				'computer_subscription' => $this->input->post('computer_subscription'),
				'ip' => $client_ip
			);
			$admissionReqNum = $this->req_admission_model->save($data);
			/*********************************************************************** E N D ***/






			/**********************************************************************************
			* New Admission Academic Record
			* Recording New Student to Academic Session
			* *********************************************************************************/			
			if($sessionOfAdmission == "2016"){
				if($gradeOfAdmission > 0 and $gradeOfAdmission <= 5){
					$academicSessionID = 7;
				}else 
					$academicSessionID = 8;	
			}else if($sessionOfAdmission == "2017"){
				if($gradeOfAdmission > 0 and $gradeOfAdmission <= 5){
					$academicSessionID = 9;
				}else 
					$academicSessionID = 10;
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
			$this->student_academic_record_model->save($data);
			/*********************************************************************** E N D ***/







			/**********************************************************************************
			* New Admission Family Work Information
			* Recording New Student Family Work Detail
			* *********************************************************************************/
			$this->load->model('front_office/student_family_work_detail_model');
			$data = array(
				'gf_id' => $GFID,
				'parent_type' => 1
			);
			$this->student_family_work_detail_model->save($data);

			$data = array(
				'gf_id' => $GFID,
				'parent_type' => 2
			);
			$this->student_family_work_detail_model->save($data);
			/*********************************************************************** E N D ***/







			/**********************************************************************************
			* New Admission Family Home Contact
			* Recording New Student Family Home Contact Detail
			* *********************************************************************************/
			$this->load->model('front_office/student_contact_info_model');
			$data = array(
				'gf_id' => $GFID				
			);
			$this->student_contact_info_model->save($data);			
			/*********************************************************************** E N D ***/





			/**********************************************************************************
			* New Admission Family Emergency Contact
			* Recording New Student Family Emergency Contact Detail
			* *********************************************************************************/
			$this->load->model('front_office/student_family_ec_model');
			$data = array(
				'gf_id' => $GFID,
				'type' => 3
			);
			$this->student_family_ec_model->save($data);			
			/*********************************************************************** E N D ***/





			/**********************************************************************************
			* New Admission Family Qualification Information
			* Recording New Student Family Qualification Detail
			* *********************************************************************************/
			$this->load->model('front_office/student_family_qualification_model');
			$data = array(
				'gf_id' => $GFID,
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
				'parent_type' => 2
			);
			$this->student_family_qualification_model->save($data);
			$data = array(
				'gf_id' => $GFID,
				'parent_type' => 2
			);
			$this->student_family_qualification_model->save($data);
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
			$this->req_duplicatecard_model->save($data);			
			/*********************************************************************** E N D ***/
			
			
			$this->printForm($admissionReqNum);
			redirect('/fo/new_admission');
		}
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


	public function printForm($ReqAdmissionID)
	{		
		$ReqAdmissionID = $ReqAdmissionID;
		$this->load->model('front_office/req_admission_model');
		$data['NewAdmission'] = $this->req_admission_model->getNewAdmissionData($ReqAdmissionID);

		$req_id = $data['NewAdmission'][0]['id'];
		$GSID = $data['NewAdmission'][0]['gs_id'];
		$GRNO = $data['NewAdmission'][0]['gr_no'];
		$AdmissionFormNo = $data['NewAdmission'][0]['form_no'];
		$gender = $data['NewAdmission'][0]['gender'];
		$dob = date_create($data['NewAdmission'][0]['dob']);
		$dob = date_format($dob, 'd-M-Y');
		$undertaking = $data['NewAdmission'][0]['undertaking'];
		$AbridgedName = $data['NewAdmission'][0]['abridged_name'];
		$GFID = $this->makeGFID($data['NewAdmission'][0]['gf_id']);
		$FatherNic = $data['NewAdmission'][0]['father_nic'];
		$FatherName = $data['NewAdmission'][0]['father_name'];
		$OfficialName = $data['NewAdmission'][0]['student_name'];
		$CallName = $data['NewAdmission'][0]['call_name'];
		$GOA = $data['NewAdmission'][0]['grade_name'];
		$SOA = $data['NewAdmission'][0]['academic_session_name'];
		$doj = date_create($data['NewAdmission'][0]['doj']);
		$doj = date_format($doj, 'd-M-Y');
		$admissionfee = $data['NewAdmission'][0]['admission_fee'];
		$securitydeposit = $data['NewAdmission'][0]['security_deposit'];
		$computersubscription = $data['NewAdmission'][0]['computer_subscription'];


		$this->makePDF($req_id, $GSID, $GRNO, $AdmissionFormNo, $gender, $dob, $undertaking, $GFID, $FatherName, $FatherNic, $OfficialName, $AbridgedName, $CallName, $GOA, $SOA, $doj, $admissionfee, $securitydeposit, $computersubscription);	
	}



	public function printForm2()
	{		
		$ReqAdmissionID = $this->input->post('new_admission_id');
		$this->load->model('front_office/req_admission_model');
		$data['NewAdmission'] = $this->req_admission_model->getNewAdmissionData($ReqAdmissionID);

		$req_id = $data['NewAdmission'][0]['id'];
		$GSID = $data['NewAdmission'][0]['gs_id'];
		$GRNO = $data['NewAdmission'][0]['gr_no'];
		$AdmissionFormNo = $data['NewAdmission'][0]['form_no'];
		$gender = $data['NewAdmission'][0]['gender'];
		$dob = date_create($data['NewAdmission'][0]['dob']);
		$dob = date_format($dob, 'd-M-Y');
		$undertaking = $data['NewAdmission'][0]['undertaking'];
		$AbridgedName = $data['NewAdmission'][0]['abridged_name'];
		$GFID = $this->makeGFID($data['NewAdmission'][0]['gf_id']);
		$FatherNic = $data['NewAdmission'][0]['father_nic'];
		$FatherName = $data['NewAdmission'][0]['father_name'];
		$OfficialName = $data['NewAdmission'][0]['student_name'];
		$CallName = $data['NewAdmission'][0]['call_name'];
		$GOA = $data['NewAdmission'][0]['grade_name'];
		$SOA = $data['NewAdmission'][0]['academic_session_name'];
		$doj = date_create($data['NewAdmission'][0]['doj']);
		$doj = date_format($doj, 'd-M-Y');
		$admissionfee = $data['NewAdmission'][0]['admission_fee'];
		$securitydeposit = $data['NewAdmission'][0]['security_deposit'];
		$computersubscription = $data['NewAdmission'][0]['computer_subscription'];


		$this->makePDF($req_id, $GSID, $GRNO, $AdmissionFormNo, $gender, $dob, $undertaking, $GFID, $FatherName, $FatherNic, $OfficialName, $AbridgedName, $CallName, $GOA, $SOA, $doj, $admissionfee, $securitydeposit, $computersubscription);
	}



	public function makePDF($req_id, $GSID, $GRNO, $AdmissionFormNo, $gender, $dob, $undertaking, $GFID, $FatherName, $FatherNic, $OfficialName, $name, $CallName, $GOA, $SOA, $doj, $admissionfee, $securitydeposit, $computersubscription){

		$this->load->model('front_office/req_admission_model');
		$data['Siblings'] = $this->req_admission_model->getSiblingsData($this->makeGFID_Num($GFID));
		$UserName = ucwords($this->session->userdata['username']);


		// Overall Font Size
		$font_size = 10;
		$font_name = 'Helvetica';
		$gender_mark_size = 26;
		$now_date = date('d-M-Y');


		require_once('components/pdf/fpdf/fpdf.php');
		require_once('components/pdf/fpdi/fpdi.php');

		
		// initiate FPDI
		$pdf = new FPDI();

		// get the page count
		$pageCount = $pdf->setSourceFile('components/pdf/front_office/new_admission/newadmission_printform.pdf');
		// Border On
		$bo = 0;
		// iterate through all pages
		for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
		    // import a page
		    $templateId = $pdf->importPage($pageNo);
		    // get the size of the imported page
		    $size = $pdf->getTemplateSize($templateId);

		    // create a page (landscape or portrait depending on the imported page size)
		    if ($size['w'] > $size['h']) {
		        $pdf->AddPage('L', array($size['w'], $size['h']));
		    } else {
		        $pdf->AddPage('P', array($size['w'], $size['h']));
		    }		    

		    // use the imported page
	    	$pdf->useTemplate($templateId);

	    	if ($templateId == 1){

	    		// Registration Check
    			$pdf->AddFont('wingdng2','','wingdng2.php');
			    $pdf->SetFont('wingdng2','',16);
			    $pdf->SetXY(41, 24);
			    $pdf->Write(8, 'P');
	    		
	    		// Request Date
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',10);
			    $pdf->SetXY(132, 24);
			    $pdf->Cell(26.5, 5, $now_date, $bo, 0, 'C', 0);

			    // Request No.
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',10);
			    $pdf->SetXY(184.5, 24);
			    $pdf->Cell(12.5, 5, str_pad($req_id, 3, "0", STR_PAD_LEFT), $bo, 0, 'C', 0);

			    // GS_ID
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',10);
			    $pdf->SetXY(40.5, 40);
			    $pdf->Cell(27, 5, $GSID, $bo,0, 'L', 0);

			    // GF-ID
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',10);
			    $pdf->SetXY(40.5, 45.1);
			    $pdf->Cell(27, 5, $GFID, $bo, 0, 'L', 0);

			    // Form_No
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',10);
			    $pdf->SetXY(40.5, 50.2);
			    $pdf->Cell(27, 5, $AdmissionFormNo, $bo, 0, 'L', 0);

			    // Gender
			    if ($gender == 'B')
			    {
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',10);
			    $pdf->SetXY(80.1, 40);
			    //$pdf->Write(10, 'Boy');
			    $pdf->Cell(27, 5, 'Boy', $bo, 0, 'L', 0);
				}elseif($gender == 'G')
				{
				$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',10);
			    $pdf->SetXY(80.1, 40);
			    //$pdf->Write(10, 'Girl');
			    $pdf->Cell(27, 5, 'Girl', $bo, 0, 'L', 0);	
				}

				// Date of Birth
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',10);
			    $pdf->SetXY(80.1, 45.1);
			    $pdf->Cell(27, 5, $dob, $bo, 0, 'L', 0);
	    		
	    		// Gender
			    if ($undertaking == '1')
			    {
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',10);
			    $pdf->SetXY(80.1, 50.2);
			    $pdf->Cell(27, 5, 'Yes', $bo, 0, 'L', 0);
			    }elseif($undertaking == '2')
				{
				$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',10);
			    $pdf->SetXY(80.1, 50.2);
			    $pdf->Cell(27, 5, 'No', $bo, 0, 'L', 0);
			    }

			    /*// GF_ID
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',10);
			    $pdf->SetXY(45, 79);
			    $pdf->MultiCell(35, 4, $GFID, 0, 'L', 0);*/
		    
			    // Father Nic
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',10);
			    $pdf->SetXY(40.5, 64);
			    $pdf->Cell(40, 5, $FatherNic, $bo, 0, 'L', 0);

			    // Father Name
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',10);
			    $pdf->SetXY(40.5, 69.1);
			    $pdf->Cell(65, 5, $FatherName, $bo, 0, 'L', 0);

			    // Official Name
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',10);
			    $pdf->SetXY(132, 40);
			    $pdf->Cell(65, 5, $OfficialName, $bo, 0, 'L', 0);

			    // Abriged Name
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',10);
			    $pdf->SetXY(132, 45.1);
			    $pdf->Cell(40, 5, $name, $bo, 0, 'L', 0);

			    // Call Name
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',10);
			    $pdf->SetXY(132, 50.2);
			    $pdf->Cell(27, 5, $CallName, $bo, 0, 'L', 0);

			    // Grade Name
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',10);
			    $pdf->SetXY(132, 64);
			    $pdf->Cell(27, 5, $GOA, $bo, 0, 'L', 0);

			    // Session Name
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',10);
			    $pdf->SetXY(132, 69.4);
			    $pdf->Cell(27, 5, $SOA, $bo, 0, 'L', 0);

			    // Activaton Date
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',10);
			    $pdf->SetXY(132, 74.6);
			    $pdf->Cell(27, 5, $doj, $bo, 0, 'L', 0);

			    // Username
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',10);
			    $pdf->SetXY(40.5, 117.5);
			    $pdf->Cell(65, 5, $UserName, $bo, 0, 'L', 0);

			    /****** Admission Fee ******/

			    // Admission Fee
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',10);
			    $pdf->SetXY(40.5, 87.5);
			    $pdf->Cell(40, 5, $admissionfee, $bo, 0, 'L', 0);

			    // Security Deposit
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',10);
			    $pdf->SetXY(40.5, 92.9);
			    $pdf->Cell(40, 5, $securitydeposit, $bo, 0, 'L', 0);

			    // Security Deposit
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',10);
			    $pdf->SetXY(40.5, 98.1);
			    $pdf->Cell(40, 5, $computersubscription, $bo, 0, 'L', 0);


			    /****** Start Sibling 1 ******/
			    $i = 1;
			    foreach ($data['Siblings'] as $sibling) {
			    	if($sibling['gs_id'] != $GSID){

			    		// GS-ID
			    		$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',10);
					    $pdf->SetXY(119, 82.5 + ($i * 5.4));
					    $pdf->Cell(13, 5, $sibling['gs_id'], $bo, 0, 'C', 0);

				    	// Name
			    		$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',10);
					    $pdf->SetXY(132, 82.5 + ($i * 5.4));
					    $pdf->Cell(40, 5, $sibling['abridged_name'], $bo, 0, 'L', 0);

					    // Grade
					    if ($sibling['section_name'] != 'Bin'){
					    	$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',10);
						    $pdf->SetXY(171, 82.5 + ($i * 5.4));
						    $pdf->Cell(13, 5, $sibling['grade_name'] . "-" . $sibling['section_name'], $bo, 0, 'C', 0);
						}else {
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',10);
						    $pdf->SetXY(171, 82.5 + ($i * 5.4));
						    $pdf->Cell(13, 5, $sibling['grade_name'], $bo, 0, 'C', 0);
						}

					    // House
					    if ($sibling['house_name'] != 'not_defined'){
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',10);
						    $pdf->SetXY(184, 82.5 + ($i * 5.4));
						    $pdf->
						    Cell(13, 5, $sibling['house_name'], $bo, 0, 'C', 0);
						}else {
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',10);
						    $pdf->SetXY(184, 82.5 + ($i * 5.4));
						    $pdf->
						    Cell(13, 5, "N/A", $bo, 0, 'C', 0);
						}

					    $i++;
					}
			    }
			   	/****** End Sibling ******/
			}
		}

		// Output the new PDF
		$pdf->Output($GSID . '-' . $name . '.pdf', 'I');
		//$pdf->Output();
	}

	
}