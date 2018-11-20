<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fif_form extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$GFID = 0;
		$this->form_validation->set_rules($this->validation_visitor_admission);
		$this->form_validation->set_message('verifyFIFID','GS-ID or GF-ID is required');		

		if($this->form_validation->run() == FALSE){
			if(count($_POST))
			{
				$GSID = $this->input->post('gs_id');
				$GFID = $this->input->post('gf_id');				
			}

			$this->load->view('sis/fif_form_id');
			$this->load->view('sis/fif_footer_orb');
		}else{
			//Variables
			$this->GFID = "";


			$this->load->model('sis/fif_student_info_model');
			if(strlen($this->input->post('gs_id')) == 6) {				
				$GFID = $this->fif_student_info_model->getGFID($this->input->post('gs_id'));
				$this->GFID = $this->fif_student_info_model->makeGFID($GFID);
			}else if(strlen($this->input->post('gf_id')) == 6) {
				$GFID = $this->fif_student_info_model->makeGFID_Num($this->input->post('gf_id'));
				$this->GFID = $this->input->post('gf_id');
			}
			
			$this->data['siblings'] = $this->fif_student_info_model->getSiblingsInfo($GFID);
			/* getting student trail */			
			for($num=0; $num<sizeof($this->data['siblings']);$num++){
				$this->data['sib'][$num] = $this->fif_student_info_model->getStudentTrail($this->data['siblings'][$num]['gs_id']);
			}			

			if(!empty($this->data['siblings'])){
				$this->data['homeInfo'] = $this->fif_student_info_model->getHomeInfo($GFID);
				$this->data['parentInfo'] = $this->fif_student_info_model->getParentsInfo($GFID);
				$this->data['ECInfo'] = $this->fif_student_info_model->getECInfo($GFID);
				$this->data['Father_Q'] = $this->fif_student_info_model->getFatherQualification($GFID);
				$this->data['Mother_Q'] = $this->fif_student_info_model->getMotherQualification($GFID);
				$this->data['Father_W'] = $this->fif_student_info_model->getFatherWorkDetail($GFID);
				$this->data['Mother_W'] = $this->fif_student_info_model->getMotherWorkDetail($GFID);

				$this->FatherPhoto = $this->fif_student_info_model->getFatherPhotoPath($GFID);
				$this->MotherPhoto = $this->fif_student_info_model->getMotherPhotoPath($GFID);
			}
			
			if(empty($this->data['siblings'])){
				$this->error = "ID NOT Found!";
				$this->load->view('sis/fif_form_id_notfound');
			}else{
				$this->load->view('sis/fif_form_view');
			}			
			$this->load->view('sis/fif_footer_orb');	
		}	
	}


	public $validation_visitor_admission = array(		
		array('field' => 'gs_id', 'label' => 'GS-ID or GF-ID', 'rules' => 'trim|sanitize|callback_verifyFIFID')		
	);
	


	function verifyFIFID($str)
	{
	   $field_value = $str;	   
	   
	   if($this->input->post('gs_id') == "" && $this->input->post('gf_id') == "")
	   {
	     return FALSE;
	   }
	   else
	   {
	     return TRUE;
	   }
	}


	// Student Information
	public function edit2()
	{
		$pk = $_POST['pk'];
	    $name = $_POST['name'];
	    $value = $_POST['value'];
	    
		$table_data = array(
			$name => $value
		);
		
		$this->load->model('front_office/student_registered_model');
	    if(!empty($value)) {	        
	        $id = $this->student_registered_model->save($table_data, $pk);        
	        
	    } else {
	        header('HTTP 400 Bad Request', true, 400);
	        echo "This field is required!";
	    }
	}



	// Student Home & Primary Contact
	public function edit3()
	{
		$pk = $_POST['pk'];
	    $name = $_POST['name'];
	    $value = $_POST['value'];
	    
		$table_data = array(
			$name => $value
		);
		
		$this->load->model('front_office/student_contact_info_model');
	    if(!empty($value)) {	        
	        $id = $this->student_contact_info_model->save($table_data, $pk);        
	        
	    } else {
	        header('HTTP 400 Bad Request', true, 400);
	        echo "This field is required!";
	    }
	}



	// Parent Information
	public function edit4()
	{
		$pk = $_POST['pk'];
	    $name = $_POST['name'];
	    $value = $_POST['value'];
	    
		$table_data = array(
			$name => $value
		);
		
		$this->load->model('front_office/family_registered_model');
	    if(!empty($value)) {	        
	        $id = $this->family_registered_model->save($table_data, $pk);        
	        
	    } else {
	        header('HTTP 400 Bad Request', true, 400);
	        echo "This field is required!";
	    }
	}





	// Family Emergency Contact Information
	public function edit5()
	{
		$pk = $_POST['pk'];
	    $name = $_POST['name'];
	    $value = $_POST['value'];
	    
		$table_data = array(
			$name => $value
		);
		
		$this->load->model('front_office/student_family_ec_model');
	    if(!empty($value)) {	        
	        $id = $this->student_family_ec_model->save($table_data, $pk);        
	        
	    } else {
	        header('HTTP 400 Bad Request', true, 400);
	        echo "This field is required!";
	    }
	}




	// Family Qualification Information
	public function edit6()
	{
		$pk = $_POST['pk'];
	    $name = $_POST['name'];
	    $value = $_POST['value'];
	    
		$table_data = array(
			$name => $value
		);
		
		$this->load->model('front_office/student_family_qualification_model');
	    if(!empty($value)) {	        
	        $id = $this->student_family_qualification_model->save($table_data, $pk);        
	        
	    } else {
	        header('HTTP 400 Bad Request', true, 400);
	        echo "This field is required!";
	    }
	}




	// Family Work Detail Information
	public function edit7()
	{
		$pk = $_POST['pk'];
	    $name = $_POST['name'];
	    $value = $_POST['value'];
	    
		$table_data = array(
			$name => $value
		);
		
		$this->load->model('front_office/student_family_work_detail_model');
	    if(!empty($value)) {	        
	        $id = $this->student_family_work_detail_model->save($table_data, $pk);        
	        
	    } else {
	        header('HTTP 400 Bad Request', true, 400);
	        echo "This field is required!";
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




	public function printForm()
	{
		if(count($_POST))
		{				
			$this->load->model('sis/fif_student_info_model');		
			$GFID = $this->input->post('fif_gfid');
			$GFID = $this->fif_student_info_model->makeGFID_Num($GFID);
			
			$data['siblings'] = $this->fif_student_info_model->getSiblingsInfo($GFID);
			$data['homeInfo'] = $this->fif_student_info_model->getHomeInfo($GFID);
			$data['parentInfo'] = $this->fif_student_info_model->getParentsInfo($GFID);
			$data['ECInfo'] = $this->fif_student_info_model->getECInfo($GFID);
			$data['FatherQualification'] = $this->fif_student_info_model->getFatherQualification($GFID);
			$data['MotherQualification'] = $this->fif_student_info_model->getMotherQualification($GFID);
			$data['FatherWorkDetail'] = $this->fif_student_info_model->getFatherWorkDetail($GFID);
			$data['MotherWorkDetail'] = $this->fif_student_info_model->getMotherWorkDetail($GFID);

			$FatherPhoto = $this->fif_student_info_model->getFatherPhotoPath($GFID);
			$MotherPhoto = $this->fif_student_info_model->getMotherPhotoPath($GFID);




			$BorderOn = 0;

			// Overall Font Size
			$font_size = 10;
			$font_name = 'Helvetica';
			$gender_mark_size = 15;
			

			$now_date = date('Y-m-d');
			$now_date = strtotime($now_date);
			$now_date = strtotime("+7 day", $now_date);
			$now_date = date('D, M d, Y', $now_date);
			$FIF_Note = "";/*"Please ensure that this form is duty completed and returned to the School's Front Office by ". $now_date.  ". Your cooperation is highly appreciated Jazakallah alkhair.*/

			$GFID = substr($GFID, 0,2) . "-" . substr($GFID, 2,3);
			

			// Page 2
			// Home & Primary Contact
			$AppartmentNo = $data['homeInfo'][0]['apartment_no'];
			$BuildingName = $data['homeInfo'][0]['building_name'];
			$PlotNo = $data['homeInfo'][0]['plot_no'];
			$StreetName = $data['homeInfo'][0]['street_name'];
			$SubRegion = $data['homeInfo'][0]['sub_region'];
			$Region = $data['homeInfo'][0]['region'];
			$City = $data['homeInfo'][0]['city'];
			$HomePhone = $data['homeInfo'][0]['phone'];
			$PMC = $data['homeInfo'][0]['primary_phone'];
			$PSC = $data['homeInfo'][0]['primary_sms'];
			$PEC = $data['homeInfo'][0]['primary_email'];

			// Family Information
			$FatherName = $data['parentInfo'][0]['name'];
			$MotherName = $data['parentInfo'][1]['name'];
			$FN_1 = $data['parentInfo'][0]['nationality_1'];
			$MN_1 = $data['parentInfo'][1]['nationality_1'];
			$FN_2 = $data['parentInfo'][0]['nationality_2'];
			$MN_2 = $data['parentInfo'][1]['nationality_2'];
			$FNIC = $data['parentInfo'][0]['nic'];
			$MNIC = $data['parentInfo'][1]['nic'];
			$FMP = $data['parentInfo'][0]['mobile_phone'];
			$MMP = $data['parentInfo'][1]['mobile_phone'];
			$FP = $data['parentInfo'][0]['profession'];
			$MP = $data['parentInfo'][1]['profession'];
			$FS = $data['parentInfo'][0]['speciality'];
			$MS = $data['parentInfo'][1]['speciality'];
			$FE = $data['parentInfo'][0]['email'];
			$ME = $data['parentInfo'][1]['email'];
			$MaritalStatus = $data['parentInfo'][0]['marital_status'];
			$FYOD = $data['parentInfo'][0]['yod'];
			$MYOD = $data['parentInfo'][1]['yod'];

			// Family Qualification Information
			// Father Qualification
			$FQ_HQL = $data['FatherQualification'][0]['level'];
			$FQ_HQT = $data['FatherQualification'][0]['title'];
			$FQ_IU_1 = $data['FatherQualification'][0]['institute'];
			$FQ_YOC_1 = $data['FatherQualification'][0]['year_of_completion'];
			$FQ_SQL = $data['FatherQualification'][1]['level'];
			$FQ_SQT = $data['FatherQualification'][1]['title'];
			$FQ_IU_2 = $data['FatherQualification'][1]['institute'];
			$FQ_YOC_2 = $data['FatherQualification'][1]['year_of_completion'];

			// Mother Qualification
			$MQ_HQL = $data['MotherQualification'][0]['level'];
			$MQ_HQT = $data['MotherQualification'][0]['title'];
			$MQ_IU_1 = $data['MotherQualification'][0]['institute'];
			$MQ_YOC_1 = $data['MotherQualification'][0]['year_of_completion'];
			$MQ_SQL = $data['MotherQualification'][1]['level'];
			$MQ_SQT = $data['MotherQualification'][1]['title'];
			$MQ_IU_2 = $data['MotherQualification'][1]['institute'];
			$MQ_YOC_2 = $data['MotherQualification'][1]['year_of_completion'];

			/****** Family Work Detail ******/
			// Father Work Detail
			$FWD_Org = $data['FatherWorkDetail'][0]['organization'];
			$FWD_Dep = $data['FatherWorkDetail'][0]['department'];
			$FWD_Des = $data['FatherWorkDetail'][0]['designation'];
			$FWD_WP = $data['FatherWorkDetail'][0]['phone'];
			$FWD_WA = $data['FatherWorkDetail'][0]['address'];
			$FWD_WR = $data['FatherWorkDetail'][0]['region'];


			// Mother Work Detail
			$MWD_Org = $data['MotherWorkDetail'][0]['organization'];
			$MWD_Dep = $data['MotherWorkDetail'][0]['department'];
			$MWD_Des = $data['MotherWorkDetail'][0]['designation'];
			$MWD_WP = $data['MotherWorkDetail'][0]['phone'];
			$MWD_WA = $data['MotherWorkDetail'][0]['address'];
			$MWD_WR = $data['MotherWorkDetail'][0]['region'];

			// Emergency Contact
			$ECName = '';
			$ECEmail = '';
			$ECPhone = '';
			$ECRelation = '';
			$ECAddress = '';
			if(!empty($data['ECInfo'])){
				$ECName = $data['ECInfo'][0]['name'];
				$ECEmail = $data['ECInfo'][0]['email'];
				$ECPhone = $data['ECInfo'][0]['phone'];
				$ECRelation = $data['ECInfo'][0]['relationship'];
				$ECAddress = $data['ECInfo'][0]['home_address'];
			}

			// Add More Siblings
			$AddMore_Line1 = "Add Generian siblings here";
			$AddMore_Line2 = "-- current or alumni --";
			$AddMore_Line3 = "if any.";


			require_once('components/pdf/fpdf/fpdf.php');
			require_once('components/pdf/fpdi/fpdi.php');

			
			// initiate FPDI
			$pdf = new FPDI();

			// get the page count
			$pageCount = $pdf->setSourceFile('components/pdf/front_office/fif/fif_print_form.pdf');
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
			        $pdf->AddPage('P', array($size['w'], 295));
			    }		    

			    $pdf->SetMargins(0,0,0);
			    $pdf->SetAutoPageBreak(0,0);
			    // use the imported page
		    	$pdf->useTemplate($templateId);
		    	$pdf->AddFont('wingdng2','','wingdng2.php');

		    	if ($templateId == 1){
		    		
		    		// Todate
			    	$pdf->SetFont($font_name,'B',8);
				    $pdf->SetXY(95, 8);				    
				    $pdf->Write(8, '');

				    $isLeft = false;
				    $siblingsCounter = 0;
				    $i = 1;
				    foreach ($data['siblings'] as $sibling) {
			    		$siblingsCounter++;

				    	$GSID = $sibling['gs_id'];
						$OfficialName = $sibling['official_name'];
						$AbridgedName = $sibling['abridged_name'];
						$CallName = $sibling['call_name'];
						$GRNO = $sibling['gr_no'];
						if(file_exists('assets/photos/sis/150x150/student/' . $GRNO . ".png")){
							$StudentPicPath = base_url() . 'assets/photos/sis/150x150/student/' . $GRNO . ".png";
						}else{
							$StudentPicPath = base_url() . 'assets/photos/sis/150x150/student/' . "NoPhoto.png";
						}
						$Grade = $sibling['grade_name'];
						$Section = $sibling['section_name'];
						$House = $sibling['house_name'];
						$GO = $sibling['generation_of'];
						$YOA = $sibling['year_of_admission'];
						$GOA = $sibling['grade_of_admission'];
						$dob = date_create($sibling['dob']);
						$dob = date_format($dob, 'd-M-Y');
						$SSN = $sibling['std_status_code'];
						$N_1 = "Pakistan";//$data['siblings'][0]['nationality_1'];
						$SMP = $sibling['mobile_phone'];
						$Email = $sibling['email'];
						$Dash = '-';
						$TaxNIC = $sibling['tax_nic'];
						if($TaxNIC == '') { $TaxNIC = $FNIC; }

						if($Section == ''){
							$Dash = '';
						}			    				    


						if($isLeft == true){							
						    // GS-ID
						    $pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',10);
						    $pdf->SetXY(120, 18.5+$i);
						    $pdf->Setfillcolor(225,225,225);
						    $pdf->SetDrawColor(225,0,0);
						    $pdf->Cell(77, 5.25, $GSID, $BorderOn, 2, 'L', 0);
						    $pdf->Cell(77, 5.25, $OfficialName, $BorderOn, 2, 'L', 0);
						    $pdf->SetFont($font_name,'B',10);
						    $pdf->Cell(77, 5.25, $AbridgedName, $BorderOn, 2, 'L', 0);
						    $pdf->SetFont($font_name,'',10);
						    $pdf->Cell(77, 5.25, $CallName, $BorderOn, 2, 'L', 0);
						    $pdf->SetFont($font_name,'B',10);
						    $pdf->Cell(77, 5.25, $Grade.$Dash.$Section, $BorderOn, 2, 'L', 0);
						    $pdf->SetFont($font_name,'',10);
						    $pdf->Cell(77, 5.25, $House, $BorderOn, 2, 'L', 0);
						    $pdf->Cell(77, 5.25, $GO, $BorderOn, 2, 'L', 0);
						    $pdf->Cell(77, 5.25, $YOA, $BorderOn, 2, 'L', 0);
						    $pdf->Cell(77, 5.25, $GOA, $BorderOn, 2, 'L', 0);
						    $pdf->Cell(77, 5.25, $dob, $BorderOn, 2, 'L', 0);
						    $pdf->Cell(77, 5.25, $SSN, $BorderOn, 2, 'L', 0);
						    $pdf->Cell(77, 5.25, $N_1, $BorderOn, 2, 'L', 0);
						    $pdf->Cell(77, 5.25, $SMP, $BorderOn, 2, 'L', 0);
						    $pdf->Cell(77, 5.25, $Email, $BorderOn, 2, 'L', 0);
						    $pdf->Cell(77, 5.25, '', $BorderOn, 2, 'L', 0);
						    $pdf->SetFont($font_name,'',8);
						    $pdf->Cell(77, -10, $TaxNIC, $BorderOn, 2, 'R', 0);
						    if($FNIC == $TaxNIC){
							    $pdf->SetFont('wingdng2','',$gender_mark_size);
							    $pdf->Cell(10, 12, 'P', $BorderOn, 2, 'L', 0);
							}else if($MNIC == $TaxNIC){
							    $pdf->SetFont('wingdng2','',$gender_mark_size);
							    $pdf->Cell(15, 12, 'P', $BorderOn, 2, 'R', 0);
							}else{
							    $pdf->SetFont('wingdng2','',$gender_mark_size);
							    $pdf->Cell(28, 12, 'P', $BorderOn, 2, 'R', 0);
						    }


						    // Student Pic Path
						    $pdf->Image($StudentPicPath,164, 29+$i,33,0,'PNG');

					    	$isLeft = false;
					    	if($siblingsCounter >= 4){
					    		$i = 160;
					    	}else{
					    		$i = 80;
					    	}
					    	$i++;
						}else{
							// GS-ID
						    $pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',10);
						    $pdf->SetXY(13, 18.5+$i);
						    $pdf->Setfillcolor(225,225,225);
						    $pdf->SetDrawColor(225,0,0);
						    $pdf->Cell(77, 5.25, $GSID, $BorderOn, 2, 'R', 0);
						    $pdf->Cell(77, 5.25, $OfficialName, $BorderOn, 2, 'R', 0);
						    $pdf->SetFont($font_name,'B',10);
						    $pdf->Cell(77, 5.25, $AbridgedName, $BorderOn, 2, 'R', 0);
						    $pdf->SetFont($font_name,'',10);
						    $pdf->Cell(77, 5.25, $CallName, $BorderOn, 2, 'R', 0);
						    $pdf->SetFont($font_name,'B',10);
						    $pdf->Cell(77, 5.25, $Grade.$Dash.$Section, $BorderOn, 2, 'R', 0);
						    $pdf->SetFont($font_name,'',10);
						    $pdf->Cell(77, 5.25, $House, $BorderOn, 2, 'R', 0);
						    $pdf->Cell(77, 5.25, $GO, $BorderOn, 2, 'R', 0);
						    $pdf->Cell(77, 5.25, $YOA, $BorderOn, 2, 'R', 0);
						    $pdf->Cell(77, 5.25, $GOA, $BorderOn, 2, 'R', 0);
						    $pdf->Cell(77, 5.25, $dob, $BorderOn, 2, 'R', 0);
						    $pdf->Cell(77, 5.25, $SSN, $BorderOn, 2, 'R', 0);
						    $pdf->Cell(77, 5.25, $N_1, $BorderOn, 2, 'R', 0);
						    $pdf->Cell(77, 5.25, $SMP, $BorderOn, 2, 'R', 0);
						    $pdf->Cell(77, 5.25, $Email, $BorderOn, 2, 'R', 0);
						    $pdf->Cell(77, 5.25, '', $BorderOn, 2, 'R', 0);
						    $pdf->SetFont($font_name,'',8);
						    $pdf->Cell(77, -10, $TaxNIC, $BorderOn, 2, 'R', 0);
							if($FNIC == $TaxNIC){
							    $pdf->SetFont('wingdng2','',$gender_mark_size);
							    $pdf->Cell(10, 12, 'P', $BorderOn, 2, 'L', 0);
							}else if($MNIC == $TaxNIC){
							    $pdf->SetFont('wingdng2','',$gender_mark_size);
							    $pdf->Cell(15, 12, 'P', $BorderOn, 2, 'R', 0);
							}else{
							    $pdf->SetFont('wingdng2','',$gender_mark_size);
							    $pdf->Cell(28, 12, 'P', $BorderOn, 2, 'R', 0);
						    }


						    // Student Pic Path
						    $pdf->Image($StudentPicPath,13, 29+$i,33,0,'PNG');

							$isLeft = true;							
						}						
					}

				    $i=1;
				    $isLeft = false;
				    for($j=1; $j<=6; $j++){				    	
		    			if($isLeft == true){
		    				if($j > $siblingsCounter){
		    					// Add Generians
							    $pdf->SetFont($font_name);
							    $pdf->SetFont($font_name,'B',10);
							    $pdf->SetXY(121, (-80+46.2) + ($i*80));
							    $pdf->Setfillcolor(225,225,225);
							    $pdf->SetDrawColor(225,0,0);
							    $pdf->MultiCell(60, 4, $AddMore_Line1, $BorderOn, 'L', 0);

							    // Current or Alumni
							    $pdf->SetFont($font_name);
							    $pdf->SetFont($font_name,'',10);
							    $pdf->SetXY(121, (-80+51.2) + ($i*80));
							    $pdf->Setfillcolor(225,225,225);
							    $pdf->SetDrawColor(225,0,0);
							    $pdf->MultiCell(40, 4, $AddMore_Line2, $BorderOn, 'L', 0);

							    // If Any
							    $pdf->SetFont($font_name);
							    $pdf->SetFont($font_name,'',10);
							    $pdf->SetXY(121, (-80+56.5) + ($i*80));
							    $pdf->Setfillcolor(225,225,225);
							    $pdf->SetDrawColor(225,0,0);
							    $pdf->MultiCell(40, 4, $AddMore_Line3, $BorderOn, 'L', 0);			    				
						    }
				    		$isLeft = false;
				    		$i++;
				    	}else{
				    		if($j > $siblingsCounter){
					    		// Grade and Section
							    $pdf->SetFont($font_name);
							    $pdf->SetFont($font_name,'B',10);
							    $pdf->SetXY(27, (-80+46.2) + ($i*80));
							    $pdf->Setfillcolor(225,225,225);
							    $pdf->SetDrawColor(225,0,0);
							    $pdf->MultiCell(60, 4, $AddMore_Line1, $BorderOn, 'R', 0);

							    // Student House Name
							    $pdf->SetFont($font_name);
							    $pdf->SetFont($font_name,'',10);
							    $pdf->SetXY(47, (-80+51.2) + ($i*80));
							    $pdf->Setfillcolor(225,225,225);
							    $pdf->SetDrawColor(225,0,0);
							    $pdf->MultiCell(40, 4, $AddMore_Line2, $BorderOn, 'R', 0);

							    // Generation of
							    $pdf->SetFont($font_name);
							    $pdf->SetFont($font_name,'',10);
							    $pdf->SetXY(47, (-80+56.5) + ($i*80));
							    $pdf->Setfillcolor(225,225,225);
							    $pdf->SetDrawColor(225,0,0);
							    $pdf->MultiCell(40, 4, $AddMore_Line3, $BorderOn, 'R', 0);
							}

				    		$isLeft = true;					    					    		
				    	}				    	
				    }
		    		
				}
				if ($templateId == 2){

					// GFID
					$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'B',14);
				    $pdf->TextWithDirection(197.5, 39.5, $GFID, 'U');

					/****** Home & Primary Contact ******/
					$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',10);
				    $pdf->SetXY(47.5, 11.3);
				    $pdf->Setfillcolor(225,225,225);
				    $pdf->SetDrawColor(225,0,0);		
				    $pdf->Cell(52.5, 5.9, $AppartmentNo, $BorderOn, 2, 'L', 0);
				    $pdf->Cell(52.5, 5.9, $BuildingName, $BorderOn, 2, 'L', 0);
				    $pdf->Cell(52.5, 5.9, $PlotNo, $BorderOn, 2, 'L', 0);
				    $pdf->Cell(52.5, 5.9, $StreetName, $BorderOn, 2, 'L', 0);
				    $pdf->Cell(52.5, 5.9, $SubRegion, $BorderOn, 2, 'L', 0);
				    $pdf->Cell(52.5, 5.9, $Region, $BorderOn, 2, 'L', 0);
				    $pdf->Cell(52.5, 5.9, $City, $BorderOn, 2, 'L', 0);

					$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',10);
				    $pdf->SetXY(120, 11.3);
				    $pdf->Setfillcolor(225,225,225);
				    $pdf->SetDrawColor(225,0,0);		
				    $pdf->Cell(70, 5.9, $HomePhone, $BorderOn, 2, 'L', 0);

				    // Primary Mobile Contact
				    if ($PMC == 'Both')
				    {				       
				    	$pdf->AddFont('wingdng2','','wingdng2.php');
					    $pdf->SetFont('wingdng2','',$gender_mark_size);
					    $pdf->SetXY(137, 18);
					    $pdf->Write(6, 'P');
				   	
				   		$pdf->AddFont('wingdng2','','wingdng2.php');
					    $pdf->SetFont('wingdng2','',$gender_mark_size);
					    $pdf->SetXY(160.8,18);
					    $pdf->Write(6, 'P');
					}
				    if ($PMC == 'Father')
				    {
				    	$pdf->AddFont('wingdng2','','wingdng2.php');
					    $pdf->SetFont('wingdng2','',$gender_mark_size);
					    $pdf->SetXY(137, 18);
					    $pdf->Write(6, 'P');

				   	}
				   	if($PMC == 'Mother'){
				   		$pdf->AddFont('wingdng2','','wingdng2.php');
					    $pdf->SetFont('wingdng2','',$gender_mark_size);
					    $pdf->SetXY(160.8, 18);
					    $pdf->Write(6, 'P');
				   	}

				   	// Primary SMS Contact
				    if ($PSC == 'Both')
				    {				       
				    	$pdf->AddFont('wingdng2','','wingdng2.php');
					    $pdf->SetFont('wingdng2','',$gender_mark_size);
					    $pdf->SetXY(137, 23.6);
					    $pdf->Write(6, 'P');
				   	
				   		$pdf->AddFont('wingdng2','','wingdng2.php');
					    $pdf->SetFont('wingdng2','',$gender_mark_size);
					    $pdf->SetXY(160.8,23.6);
					    $pdf->Write(6, 'P');
					}
				    if ($PSC == 'Father')
				    {
				    	$pdf->AddFont('wingdng2','','wingdng2.php');
					    $pdf->SetFont('wingdng2','',$gender_mark_size);
					    $pdf->SetXY(137, 23.6);
					    $pdf->Write(6, 'P');

				   	}
				   	if($PSC == 'Mother'){
				   		$pdf->AddFont('wingdng2','','wingdng2.php');
					    $pdf->SetFont('wingdng2','',$gender_mark_size);
					    $pdf->SetXY(160.8, 23.6);
					    $pdf->Write(6, 'P');
				   	}

				   	// Primary PEC Contact
				    if ($PEC == 'Both')
				    {				       
				    	$pdf->AddFont('wingdng2','','wingdng2.php');
					    $pdf->SetFont('wingdng2','',$gender_mark_size);
					    $pdf->SetXY(137, 29.5);
					    $pdf->Write(6, 'P');
				   	
				   		$pdf->AddFont('wingdng2','','wingdng2.php');
					    $pdf->SetFont('wingdng2','',$gender_mark_size);
					    $pdf->SetXY(160.8, 29.5);
					    $pdf->Write(6, 'P');
					}
				    if ($PEC == 'Father')
				    {
				    	$pdf->AddFont('wingdng2','','wingdng2.php');
					    $pdf->SetFont('wingdng2','',$gender_mark_size);
					    $pdf->SetXY(137, 29.5);
					    $pdf->Write(6, 'P');

				   	}
				   	if($PEC == 'Mother'){
				   		$pdf->AddFont('wingdng2','','wingdng2.php');
					    $pdf->SetFont('wingdng2','',$gender_mark_size);
					    $pdf->SetXY(160.8, 29.5);
					    $pdf->Write(6, 'P');
				   	}

				   	/****** Family Information ******/
				   	// Father Name
				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',10);
				    $pdf->SetXY(10, 60.3);
				    $pdf->Setfillcolor(225,225,225);
				    $pdf->SetDrawColor(225,0,0);
				    $pdf->Cell(70, 5.8, $FatherName, $BorderOn, 2, 'R', 0);
				    $pdf->Cell(70, 5.8, $FN_1, $BorderOn, 2, 'R', 0);
				    $pdf->Cell(70, 5.8, $FN_2, $BorderOn, 2, 'R', 0);
				    $pdf->Cell(70, 5.8, $FNIC, $BorderOn, 2, 'R', 0);
				    $pdf->Cell(70, 5.8, $FMP, $BorderOn, 2, 'R', 0);
				    $pdf->Cell(70, 5.8, $FP, $BorderOn, 2, 'R', 0);
				    $pdf->Cell(70, 5.8, $FS, $BorderOn, 2, 'R', 0);
				    $pdf->Cell(70, 5.8, $FE, $BorderOn, 2, 'R', 0);
				    
				    // Father Photo Path
				    $pdf->Image($FatherPhoto,10.2,65.5,24,0,'PNG');

				    // YOD
				    if ($data['parentInfo'][0]['is_late'] == '1')
				    {				       
				    	$pdf->AddFont('wingdng2','','wingdng2.php');
					    $pdf->SetFont('wingdng2','',$gender_mark_size);
					    $pdf->SetXY(9.5, 92.3);
					    $pdf->Write(1, 'P');
					}

				    // Mother Name
				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',10);
				    $pdf->SetXY(118.5, 60.3);
				    $pdf->Setfillcolor(225,225,225);
				    $pdf->SetDrawColor(225,0,0);
				    $pdf->Cell(70, 5.8, $MotherName, $BorderOn, 2, 'L', 0);
				    $pdf->Cell(70, 5.8, $MN_1, $BorderOn, 2, 'L', 0);
				    $pdf->Cell(70, 5.8, $MN_2, $BorderOn, 2, 'L', 0);
				    $pdf->Cell(70, 5.8, $MNIC, $BorderOn, 2, 'L', 0);
				    $pdf->Cell(70, 5.8, $MMP, $BorderOn, 2, 'L', 0);
				    $pdf->Cell(70, 5.8, $MP, $BorderOn, 2, 'L', 0);
				    $pdf->Cell(70, 5.8, $MS, $BorderOn, 2, 'L', 0);
				    $pdf->Cell(70, 5.8, $ME, $BorderOn, 2, 'L', 0);

				    // Mother Photo Path
				    $pdf->Image($MotherPhoto,166,65.5,24,0,'PNG');

				    // YOD
				    if ($data['parentInfo'][1]['is_late'] == '1')
				    {				       
				    	$pdf->AddFont('wingdng2','','wingdng2.php');
					    $pdf->SetFont('wingdng2','',$gender_mark_size);
					    $pdf->SetXY(184.5, 92.3);
					    $pdf->Write(1, 'P');
					}

				    // Marital Status
					if ($MaritalStatus == 'Married')
				    {				       
				    	$pdf->AddFont('wingdng2','','wingdng2.php');
					    $pdf->SetFont('wingdng2','',$gender_mark_size);
					    $pdf->SetXY(34.5, 115);
					    $pdf->Write(2, 'P');
					}
			   		if ($MaritalStatus == 'Widowed')
				    {
				    	$pdf->AddFont('wingdng2','','wingdng2.php');
					    $pdf->SetFont('wingdng2','',$gender_mark_size);
					    $pdf->SetXY(58.2, 115);
					    $pdf->Write(2, 'P');
				   	}
				   	if($MaritalStatus == 'Divorced')
				   	{
				   		$pdf->AddFont('wingdng2','','wingdng2.php');
					    $pdf->SetFont('wingdng2','',$gender_mark_size);
					    $pdf->SetXY(82.4, 115);
					    $pdf->Write(2, 'P');
				   	}
					if($MaritalStatus == 'Other')
					{
				   		$pdf->AddFont('wingdng2','','wingdng2.php');
					    $pdf->SetFont('wingdng2','',$gender_mark_size);
					    $pdf->SetXY(107.3, 115);
					    $pdf->Write(2, 'P');
				   	}

				   	/****** Family Qualification ******/
				   	// Father Qualification
				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',10);
				    $pdf->SetXY(10, 118.5);
				    $pdf->Setfillcolor(225,225,225);
				    $pdf->SetDrawColor(225,0,0);
				    $pdf->Cell(66, 5.8, '', $BorderOn, 2, 'R', 0);
				    $pdf->Cell(66, 7.8, $FQ_HQL, $BorderOn, 2, 'R', 0);
				    $pdf->Cell(66, 7.8, $FQ_HQT, $BorderOn, 2, 'R', 0);
				    $pdf->Cell(66, 5.2, $FQ_IU_1, $BorderOn, 2, 'R', 0);
				    $pdf->Cell(66, 5.8, $FQ_YOC_1, $BorderOn, 2, 'R', 0);
				    $pdf->Cell(66, 7.8, $FQ_SQL, $BorderOn, 2, 'R', 0);
				    $pdf->Cell(66, 7.8, $FQ_SQT, $BorderOn, 2, 'R', 0);
				    $pdf->Cell(66, 5.7, $FQ_IU_2, $BorderOn, 2, 'R', 0);
					$pdf->Cell(66, 5.8, $FQ_YOC_2, $BorderOn, 2, 'R', 0);

					// Mother Qualification
				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',10);
				    $pdf->SetXY(123.5, 118.5);
				    $pdf->Setfillcolor(225,225,225);
				    $pdf->SetDrawColor(225,0,0);
				    $pdf->Cell(66, 5.8, '', $BorderOn, 2, 'L', 0);
				    $pdf->Cell(66, 7.8, $MQ_HQL, $BorderOn, 2, 'L', 0);
				    $pdf->Cell(66, 7.8, $MQ_HQT, $BorderOn, 2, 'L', 0);
				    $pdf->Cell(66, 5.2, $MQ_IU_1, $BorderOn, 2, 'L', 0);
				    $pdf->Cell(66, 5.8, $MQ_YOC_1, $BorderOn, 2, 'L', 0);
				    $pdf->Cell(66, 7.8, $MQ_SQL, $BorderOn, 2, 'L', 0);
				    $pdf->Cell(66, 7.8, $MQ_SQT, $BorderOn, 2, 'L', 0);
				    $pdf->Cell(66, 5.7, $MQ_IU_2, $BorderOn, 2, 'L', 0);
					$pdf->Cell(66, 5.8, $MQ_YOC_2, $BorderOn, 2, 'L', 0);

				    /******* Family Work Detail ******/
				    // Father Detail
				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',10);
				    $pdf->SetXY(10, 178.5);
				    $pdf->Setfillcolor(225,225,225);
				    $pdf->SetDrawColor(225,0,0);
				    $pdf->Cell(66, 5.9, '', $BorderOn, 2, 'R', 0);
				    $pdf->Cell(66, 5.8, $FWD_Org, $BorderOn, 2, 'R', 0);
				    $pdf->Cell(66, 5.8, $FWD_Dep, $BorderOn, 2, 'R', 0);
				    $pdf->Cell(66, 5.8, $FWD_Des, $BorderOn, 2, 'R', 0);
				    $pdf->Cell(66, 5.8, $FWD_WP, $BorderOn, 2, 'R', 0);
				    $pdf->MultiCell(66, 5.8, $FWD_WA, $BorderOn, 'R', 0);

				    $pdf->SetXY(10, 225);
				    $pdf->Cell(66, 5.8, $FWD_WR, $BorderOn, 2, 'R', 0);

				    // Mother Detail
				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',10);
				    $pdf->SetXY(123.5, 178.5);
				    $pdf->Setfillcolor(225,225,225);
				    $pdf->SetDrawColor(225,0,0);
				    $pdf->Cell(66, 5.9, '', $BorderOn, 2, 'L', 0);
				    $pdf->Cell(66, 5.8, $MWD_Org, $BorderOn, 2, 'L', 0);
				    $pdf->Cell(66, 5.8, $MWD_Dep, $BorderOn, 2, 'L', 0);
				    $pdf->Cell(66, 5.8, $MWD_Des, $BorderOn, 2, 'L', 0);
				    $pdf->Cell(66, 5.8, $MWD_WP, $BorderOn, 2, 'L', 0);
				    $pdf->MultiCell(66, 5.8, $MWD_WA, $BorderOn, 'L', 0);

				    $pdf->SetXY(123.5, 225);
				    $pdf->Cell(66, 5.8, $MWD_WR, $BorderOn, 2, 'L', 0);

				   	/****** Emergency Contact ******/
				   	// EC Name
				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',10);
				    $pdf->SetXY(21, 240);
				    $pdf->Setfillcolor(225,225,225);
				    $pdf->SetDrawColor(225,0,0);
				    //$pdf->MultiCell(43, 4, $ECName, $BorderOn, 'L', 0);
				    $pdf->Cell(75, 5.8, $ECName, $BorderOn, 2, 'L', 0);

				    // EC Email
				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',10);
				    $pdf->SetXY(48, 246);
				    $pdf->Setfillcolor(225,225,225);
				    $pdf->SetDrawColor(225,0,0);
				    $pdf->MultiCell(49, 4, $ECEmail, $BorderOn, 'L', 0);

				    // EC Phone
				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',10);
				    $pdf->SetXY(21, 264.5);
				    $pdf->Setfillcolor(225,225,225);
				    $pdf->SetDrawColor(225,0,0);
				    $pdf->MultiCell(75, 4, $ECPhone, $BorderOn, 'L', 0);

				    // EC Relationship
				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',10);
				    $pdf->SetXY(28, 272.5);
				    $pdf->Setfillcolor(225,225,225);
				    $pdf->SetDrawColor(225,0,0);
				    $pdf->MultiCell(68, 4, $ECRelation, $BorderOn, 'L', 0);

				    // EC Address
				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',10);
				    $pdf->SetXY(48.5, 277.5);
				    $pdf->Setfillcolor(225,225,225);
				    $pdf->SetDrawColor(225,0,0);
				    $pdf->MultiCell(47, 4, $ECAddress, $BorderOn, 'L', 0);
				}
			}

			// Output the new PDF			
			$pdf->Output($GFID . '.pdf', 'I');
			//$pdf->Output();
		}
	}

}