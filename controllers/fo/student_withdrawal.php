<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Student_withdrawal extends MY_Controller {
	public function __construct(){
		parent::__construct();				
		
	}


	public function index()
	{
		$this->form_validation->set_rules($this->validation_withdrawal_student);

		if($this->form_validation->run() == FALSE){
			if(count($_POST))
			{
				$this->gs_id = $this->input->post('gs_id');
				$this->wef_date = $this->input->post('wef_date');				
			}

			$this->load->view('frontoffice/withdrawal_form_view.php');
			$this->load->model('front_office/req_withdrawal_model');
			$this->data['Withdrawal'] = $this->req_withdrawal_model->getAllWithdrawalData();
			$this->load->view('frontoffice/withdrawal_info.php');
			$this->load->view('frontoffice/frontoffice_footer_orb.php');
		}else{
			$this->add();
		}	
	}


	public $validation_withdrawal_student = array(		
		array('field' => 'gs_id', 'label' => 'GS-ID', 'rules' => 'trim|sanitize|required'),
		array('field' => 'wef_date', 'label' => 'W.E.F Date', 'rules' => 'trim|sanitize|required'),
		array('field' => 'description', 'label' => 'Withdrawal Reason', 'rules' => 'trim|sanitize|required'),
	);



	public function add()
	{
		if(count($_POST))
		{
			$GSID = $this->input->post('gs_id');
			$wefDate = $this->input->post('wef_date');
			$description = $this->input->post('description');
			$client_ip = "";
			$req_withdrawal_id = 0;


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


			$this->load->model('front_office/req_withdrawal_model');
			$StudentID = $this->req_withdrawal_model->getStudentID($GSID);
			$oldStatusID = $this->req_withdrawal_model->getStatusID($StudentID);

			$data = array(
				'student_id' => $StudentID,
				'req_date' => date("Y-m-d"),
				'wef_date' => $wefDate,
				'old_status' => $oldStatusID,
				'description' => $description,
				'ip' => $client_ip				
			);


			$req_withdrawal_id = $this->req_withdrawal_model->save($data);

			
			/*$this->load->model('front_office/student_academic_record_model');
			$thisID = $this->student_academic_record_model->getID($StudentID);

			$data_std = array(
				'status_id' => 2
			);

			$this->student_academic_record_model->save($data_std, $thisID);*/
		}

		$this->printForm($req_withdrawal_id);
		redirect('/fo/student_withdrawal');
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


	public function printForm($WithdrawalID)
	{		
		$ReqWithdrawalID = $WithdrawalID;				
		$this->load->model('front_office/req_withdrawal_model');
		$data['Withdrawal'] = $this->req_withdrawal_model->getWithdrawalData($ReqWithdrawalID);

		$req_id = $data['Withdrawal'][0]['id'];
		$GSID = $data['Withdrawal'][0]['gs_id'];
		$GRNO = $data['Withdrawal'][0]['gr_no'];
		$MobileNo = $data['Withdrawal'][0]['student_mobile_phone'];
		$gender = $data['Withdrawal'][0]['gender'];
		$dob = date_create($data['Withdrawal'][0]['dob']);
		$dob = date_format($dob, 'd-M-Y');
		$AbrigedName = $data['Withdrawal'][0]['abridged_name'];

		// Address
		$apartment = $data['Withdrawal'][0]['apartment_no'];
		$building = $data['Withdrawal'][0]['building_name'];
		$plot_no = $data['Withdrawal'][0]['plot_no'];
		$street_name = $data['Withdrawal'][0]['street_name'];
		$sub_region = $data['Withdrawal'][0]['sub_region'];
		$region = $data['Withdrawal'][0]['region'];
		$city = $data['Withdrawal'][0]['city'];
		$Address = $apartment .",". $building .",". $plot_no .",". $street_name .",". $sub_region .",". $region .",". $city;

		$GFID = $this->makeGFID($data['Withdrawal'][0]['gf_id']);

		// Family Information
		
		$FatherName = "";
		$FatherPhone = "";
		$MotherName = "";
		$MotherPhone = "";
		$parent_type = $data['Withdrawal'][0]['parent_type'];
		$parent_name = $data['Withdrawal'][0]['name'];
		$parent_phone = $data['Withdrawal'][0]['mobile_phone'];
		if ($parent_type = "1") {
			$FatherName = $parent_name;
			$FatherPhone = $parent_phone;
		}elseif ($parent_type = "2"){
			$MotherName = $parent_name;
			$MotherPhone = $parent_phone;
		}

		$parent_type = $data['Withdrawal'][1]['parent_type'];
		$parent_name = $data['Withdrawal'][1]['name'];
		$parent_phone = $data['Withdrawal'][1]['mobile_phone'];
		if ($parent_type = "2") {
			$MotherName = $parent_name;
			$MotherPhone = $parent_phone;
		}elseif($parent_type = "1"){
			$FatherName = $parent_name;
			$FatherPhone = $parent_phone;
		}

		$homephone = $data['Withdrawal'][0]['phone'];
		$Reason = $data['Withdrawal'][0]['description'];
		$officialname =$data['Withdrawal'][0]['official_name'];
		$callname = $data['Withdrawal'][0]['call_name'];
		$GOA = $data['Withdrawal'][0]['grade_of_admission'];
		$SOA = $data['Withdrawal'][0]['year_of_admission'];

		// Grade and Section
		$Grade = $data['Withdrawal'][0]['grade_name'];
		$Section = $data['Withdrawal'][0]['section_name'];

		$W_Date = date_create($data['Withdrawal'][0]['wef_date']);
		$W_Date = date_format($W_Date, 'F d, Y');

		if(file_exists($this->data['student_150_photo_path'] . $GRNO . ".png")){
			$StudentPicPath = base_url() . $this->data['student_150_photo_path'] . $GRNO . ".png";
		}else{
			$StudentPicPath = base_url() . $this->data['student_150_photo_path'] . "NoPhoto.png";
		}


		$this->makePDF($req_id, $GSID, $GRNO, $StudentPicPath, $MobileNo, $gender, $dob, $Address, $GFID, $FatherName, $FatherPhone, $MotherName, $MotherPhone, $homephone, $Reason, $officialname, $callname, $AbrigedName, $GOA, $SOA, $Grade, $Section, $W_Date);
	}


	public function printForm2()
	{		
		$ReqWithdrawalID = $this->input->post('withdrawal_id');
		$this->load->model('front_office/req_withdrawal_model');
		$data['Withdrawal'] = $this->req_withdrawal_model->getWithdrawalData($ReqWithdrawalID);

		$req_id = $data['Withdrawal'][0]['id'];
		$GSID = $data['Withdrawal'][0]['gs_id'];
		$GRNO = $data['Withdrawal'][0]['gr_no'];
		$MobileNo = $data['Withdrawal'][0]['student_mobile_phone'];
		$gender = $data['Withdrawal'][0]['gender'];
		$dob = date_create($data['Withdrawal'][0]['dob']);
		$dob = date_format($dob, 'd-M-Y');
		$AbrigedName = $data['Withdrawal'][0]['abridged_name'];

		if(file_exists($this->data['student_150_photo_path'] . $GRNO . ".png")){
			$StudentPicPath = base_url() . $this->data['student_150_photo_path'] . $GRNO . ".png";
		}else{
			$StudentPicPath = base_url() . $this->data['student_150_photo_path'] . "NoPhoto.png";
		}

		// Address
		$apartment = $data['Withdrawal'][0]['apartment_no'];
		$building = $data['Withdrawal'][0]['building_name'];
		$plot_no = $data['Withdrawal'][0]['plot_no'];
		$street_name = $data['Withdrawal'][0]['street_name'];
		$sub_region = $data['Withdrawal'][0]['sub_region'];
		$region = $data['Withdrawal'][0]['region'];
		$city = $data['Withdrawal'][0]['city'];
		$coma = ",";
		$Address = $apartment .$coma. $building .$coma. $plot_no .$coma. $street_name .$coma. $sub_region .$coma. $region .$coma. $city;

		$GFID = $this->makeGFID($data['Withdrawal'][0]['gf_id']);

		// Family Information		
		$FatherName = "";
		$FatherPhone = "";
		$MotherName = "";
		$MotherPhone = "";
		$parent_type = $data['Withdrawal'][0]['parent_type'];
		$parent_name = $data['Withdrawal'][0]['name'];
		$parent_phone = $data['Withdrawal'][0]['mobile_phone'];
		if ($parent_type = "1") {
			$FatherName = $parent_name;
			$FatherPhone = $parent_phone;
		}elseif ($parent_type = "2"){
			$MotherName = $parent_name;
			$MotherPhone = $parent_phone;
		}

		$parent_type = $data['Withdrawal'][1]['parent_type'];
		$parent_name = $data['Withdrawal'][1]['name'];
		$parent_phone = $data['Withdrawal'][1]['mobile_phone'];
		if ($parent_type = "2") {
			$MotherName = $parent_name;
			$MotherPhone = $parent_phone;
		}elseif($parent_type = "1"){
			$FatherName = $parent_name;
			$FatherPhone = $parent_phone;
		}



		$homephone = $data['Withdrawal'][0]['phone'];
		$Reason = $data['Withdrawal'][0]['description'];
		$officialname =$data['Withdrawal'][0]['official_name'];
		$callname = $data['Withdrawal'][0]['call_name'];
		$GOA = $data['Withdrawal'][0]['grade_of_admission'];
		$SOA = $data['Withdrawal'][0]['year_of_admission'];

		// Grade and Section
		$Grade = $data['Withdrawal'][0]['grade_name'];
		$Section = $data['Withdrawal'][0]['section_name'];

		$W_Date = date_create($data['Withdrawal'][0]['wef_date']);
		$W_Date = date_format($W_Date, 'F d, Y');



		$this->makePDF($req_id, $GSID, $GRNO, $StudentPicPath, $MobileNo, $gender, $dob, $Address, $GFID, $FatherName, $FatherPhone, $MotherName, $MotherPhone, $homephone, $Reason, $officialname, $callname, $AbrigedName, $GOA, $SOA, $Grade, $Section, $W_Date);
	}



	public function makePDF($req_id, $GSID, $GRNO, $StudentPicPath, $MobileNo, $gender, $dob, $Address, $GFID, $FatherName, $FatherPhone, $MotherName, $MotherPhone, $homephone, $Reason, $officialname, $callname, $name, $GOA, $SOA, $Grade, $Section, $W_Date){
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
		$pageCount = $pdf->setSourceFile('components/pdf/front_office/withdrawal/withdrawal_printform2.pdf');
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

	    		$bo = 0;
	    		$pdf->SetDrawColor(255,0,0);
				$pdf->SetFillColor(255,255,255);
	    		
	    		// Request Date
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',11);
			    $pdf->SetXY(131.5, 7.5);
			    $pdf->MultiCell(28, 6, $now_date, $bo, 'C', 0);

			    // Request No.
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',11);
			    $pdf->SetXY(187, 7.5);
			    $pdf->MultiCell(13.5, 6, str_pad($req_id, 3, "0", STR_PAD_LEFT), $bo, 'C', 0);

			    // Student Pic Path
			    $pdf->Image($StudentPicPath,9.8,6,17,0,'PNG');

			    // GS_ID
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',9);
			    $pdf->SetXY(34.8, 22.1);
			    $pdf->MultiCell(27.7, 5.4, $GSID, $bo, 'L', 0);

			    // GR_No
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',9);
			    $pdf->SetXY(34.8, 27.5);
			    $pdf->MultiCell(27.7, 5.4, $GRNO, $bo, 'L', 0);

			    // Mobile Phone
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',9);
			    $pdf->SetXY(34.8, 32.9);
			    $pdf->MultiCell(27.7, 5.4, $MobileNo, $bo, 'L', 0);

			    // Gender
			    if ($gender == 'B')
			    {
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',9);
			    $pdf->SetXY(34.8, 38);
			    $pdf->Write(9, 'Boy');
				}elseif($gender == 'G')
				{
				$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',9);
			    $pdf->SetXY(34.8, 38);
			    $pdf->Write(9, 'Girl');
				}

				// Date of Birth
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',9);
			    $pdf->SetXY(34.8, 44.5);
			    $pdf->MultiCell(27.7, 5.4, $dob, $bo, 'L', 0);
			    
			    $decrement_step = 0.1;
			    $line_width = 62.5;
			    $pdf->SetFont($font_name);			    
			    $pdf->SetXY(34.3, 48.4);
			    $this_font_size = $font_size;
			    while($pdf->GetStringWidth($Address) > $line_width) {
					$this_font_size -= $decrement_step;
					$pdf->SetFont($font_name,'',$this_font_size);
				}				
			    $pdf->Write(9, ucwords(strtolower($Address)));

			    // GFID
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',9);
			    $pdf->SetXY(34.8, 59.1);
			    $pdf->MultiCell(27.7, 5.4, $GFID, $bo, 'L', 0);

			    // Father Name
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',9);
			    $pdf->SetXY(34.8, 64.4);
			    $pdf->MultiCell(70.5, 5.4, $FatherName, $bo, 'L', 0);

			    // Father Phone
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',9);
			    $pdf->SetXY(34.8, 69.8);
			    $pdf->MultiCell(70.5, 5.4, $FatherPhone, $bo, 'L', 0);

			    // Mother Name
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',9);
			    $pdf->SetXY(34.8, 75.2);
			    $pdf->MultiCell(70.5, 5.4, $MotherName, $bo, 'L', 0);

			    // Mother Phone
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',9);
			    $pdf->SetXY(34.8, 80.6);
			    $pdf->MultiCell(41.5, 5.4, $MotherPhone, $bo, 'L', 0);

			    // Home Phone
				$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',9);
			    $pdf->SetXY(34.8, 86);
			    $pdf->MultiCell(41.5, 5.4, $homephone, $bo, 'L', 0);
			    
			    $decrement_step = 0.1;
			    $line_width = 62.5;
			    $pdf->SetFont($font_name);			    
			    $pdf->SetXY(34.8, 90.5);
			    $this_font_size = $font_size;
			    while($pdf->GetStringWidth($Reason) > $line_width) {
					$this_font_size -= $decrement_step;
					$pdf->SetFont($font_name,'',$this_font_size);
				}				
			    $pdf->Write(9, ucwords(strtolower($Reason)));

			    // Official Name
				$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',9);
			    $pdf->SetXY(131.5, 22.1);
			    $pdf->MultiCell(70, 5.4, $officialname, $bo, 'L', 0);

			    // Abriged Name
				$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',9);
			    $pdf->SetXY(131.5, 27.5);
			    $pdf->MultiCell(42, 5.4, $name, $bo, 'L', 0);

			    // Call Name
				$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',9);
			    $pdf->SetXY(131.5, 32.9);
			    $pdf->MultiCell(28, 5.4, $callname, $bo, 'L', 0);

			    // Grade of Admission
				$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',9);
			    $pdf->SetXY(131.5, 39);
			    $pdf->MultiCell(70, 5.4, $GOA, $bo, 'L', 0);

			    // Session of Admission
				$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',9);
			    $pdf->SetXY(131.5, 44.4);
			    $pdf->MultiCell(70, 5.4, $SOA, $bo, 'L', 0);

			    // Grade and Section
				$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',9);
			    $pdf->SetXY(131.5, 49.8);
			    $pdf->MultiCell(15, 5.4, $Grade."-".$Section, $bo, 'L', 0);
    			
    			// Withdrawal Date
				$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',9);
			    $pdf->SetDrawColor(0,0,0);
				$pdf->SetFillColor(0,0,0);
				$pdf->SetTextColor(225,225,255);
			    $pdf->SetXY(158, 49.8);
			    $pdf->MultiCell(42.5, 5.4, $W_Date, $bo, 'L', 1);

			    $pdf->SetTextColor(0,0,0);
			    // Username
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',8);
			    $pdf->SetXY(34.8, 101);
			    $pdf->MultiCell(70.5, 5.4, $UserName, $bo, 'L', 0);




			    /****** Start Sibling 1 ******/
			    $this->load->model('front_office/req_admission_model');
				$data['Siblings'] = $this->req_admission_model->getSiblingsData($this->makeGFID_Num($GFID));
			    $i = 1;
			    foreach ($data['Siblings'] as $sibling) {
			    	if($sibling['gs_id'] != $GSID){
				    	// Name
			    		$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',9);
					    $pdf->SetXY(131, 53.7 + ($i * 5.4));
					    $pdf->MultiCell(42, 5.4, $sibling['abridged_name'], $bo, 'L', 0);

					    // Grade
			    		$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',9);
					    $pdf->SetXY(173, 53.7 + ($i * 5.4));
					    $pdf->MultiCell(13.5, 5.4, $sibling['grade_name'] . "-" . $sibling['section_name'], $bo, 'C', 0);

					    // House
			    		$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',9);
					    $pdf->SetXY(186.5, 53.7 + ($i * 5.4));
					    $pdf->MultiCell(13.5, 5.4, $sibling['house_name'], $bo, 'C', 0);

					    $i++;
					}
			    }
			   	/****** End Sibling ******/
			    
			    if(strtotime($W_Date) <= strtotime($now_date)) {
			    	$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'B',9);
				    $pdf->SetDrawColor(0,0,0);
				    $pdf->SetFillColor(0,0,0);
				    $pdf->SetTextColor(225,225,255);
				    $pdf->SetXY(80, 7);
				    $pdf->Cell(28, 6, "Post Dated", 1, 0, 'C', 1);
			    }else if(strtotime($W_Date) > strtotime($now_date)){
			    	$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'B',9);
				    $pdf->SetDrawColor(160,160,160);
				    $pdf->SetFillColor(160,160,160);
				    $pdf->SetTextColor(0,0,0);
				    $pdf->SetXY(80, 7);
				    $pdf->Cell(28, 6, "Advance Date", 1, 0, 'C', 1);
			    }
			}
		}

		// Output the new PDF
		$pdf->Output($GSID . '-' . $name . '.pdf', 'D');
		//$pdf->Output();
	}
}