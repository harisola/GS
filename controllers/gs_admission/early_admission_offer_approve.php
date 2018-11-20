<?php

class Early_admission_offer_approve extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$user_id =  (int)$this->session->userdata('user_id'); 
		$this->user_id = $user_id;

	}

	public function index(){

		$this->load->view('gs_files/header');
        $this->load->view('gs_files/main-nav');
        $this->load->view('gs_files/breadcrumb');

        $this->load->model('admission/offer_model','am');

        $data['grade'] = $this->am->get_all_alevel_grades();
      

        $this->load->view('gs_admission/Offer_approve/early_offer_view',$data);
        $this->load->view('gs_admission/Offer_approve/early_offer_footer');


	}

	








	public function printForm()
	{
		if(count($_GET))
		{	
			$this->load->model('admission/offer_model', 'fif_student_info_model');
			$formID = $this->input->get('FormID');
			$form_detail = $this->fif_student_info_model->getGFID_of_FormID($formID);
			$GFID = $form_detail[0]['gf_id'];
			//$GFID = $this->fif_student_info_model->makeGFID_Num($GFID);
			
			$data['siblings'] = $this->fif_student_info_model->getSiblingsInfo($GFID);
			$data['homeInfo'] = $this->fif_student_info_model->getHomeInfo($GFID);
			$data['parentInfo'] = $this->fif_student_info_model->getParentsInfo($GFID);

			//$GFID = 999999;
			$data['ECInfo'] = $this->fif_student_info_model->getECInfo($GFID);
			$data['FatherQualification'] = $this->fif_student_info_model->getFatherQualification($GFID);
			$data['MotherQualification'] = $this->fif_student_info_model->getMotherQualification($GFID);
			$data['FatherWorkDetail'] = $this->fif_student_info_model->getFatherWorkDetail($GFID);
			$data['MotherWorkDetail'] = $this->fif_student_info_model->getMotherWorkDetail($GFID);

			$FatherPhoto = $this->fif_student_info_model->getFatherPhotoPath($GFID);
			$MotherPhoto = $this->fif_student_info_model->getMotherPhotoPath($GFID);

			//$GFID = 999999;
			$BorderOn = 0;

			// Overall Font Size
			$font_size = 10;
			$font_name = 'Helvetica';
			$gender_mark_size = 26;
			

			$now_date = date('Y-m-d');
			$now_date = strtotime($now_date);
			$now_date = strtotime("+7 day", $now_date);
			$now_date = date('D, M d, Y', $now_date);
			$FIF_Note = "Please ensure that this form is duty completed and returned to the School's Front Office by ". $now_date.  ". Your cooperation is highly appreciated Jazakallah alkhair.";

			/*$FormNo = substr($GFID,0,2);
			if($FormNo == date('y')){
				$GFID = $form_detail[0]['form_no'];
			}
			else{
				$GFID = substr($GFID, 0,2) . "-" . substr($GFID, 2,3);	
			}*/
			$GFID = str_pad($GFID, 5, "0", STR_PAD_LEFT);
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
			$YOD = $data['parentInfo'][0]['yod'];

			// Family Qualification Information
			// Father Qualification
			$FQ_HQL = '';
			$FQ_HQT = '';
			$FQ_IU_1 = '';
			$FQ_YOC_1 = '';
			$FQ_SQL = '';
			$FQ_SQT = '';
			$FQ_IU_2 = '';
			$FQ_YOC_2 = '';
			if(!empty($data['FatherQualification'])){
				$FQ_HQL = $data['FatherQualification'][0]['level'];
				$FQ_HQT = $data['FatherQualification'][0]['title'];
				$FQ_IU_1 = $data['FatherQualification'][0]['institute'];
				$FQ_YOC_1 = $data['FatherQualification'][0]['year_of_completion'];
				$FQ_SQL = $data['FatherQualification'][1]['level'];
				$FQ_SQT = $data['FatherQualification'][1]['title'];
				$FQ_IU_2 = $data['FatherQualification'][1]['institute'];
				$FQ_YOC_2 = $data['FatherQualification'][1]['year_of_completion'];
			}

			// Mother Qualification
			$MQ_HQL = '';
			$MQ_HQT = '';
			$MQ_IU_1 = '';
			$MQ_YOC_1 = '';
			$MQ_SQL = '';
			$MQ_SQT = '';
			$MQ_IU_2 = '';
			$MQ_YOC_2 = '';
			if(!empty($data['MotherQualification'])){
				$MQ_HQL = $data['MotherQualification'][0]['level'];
				$MQ_HQT = $data['MotherQualification'][0]['title'];
				$MQ_IU_1 = $data['MotherQualification'][0]['institute'];
				$MQ_YOC_1 = $data['MotherQualification'][0]['year_of_completion'];
				$MQ_SQL = $data['MotherQualification'][1]['level'];
				$MQ_SQT = $data['MotherQualification'][1]['title'];
				$MQ_IU_2 = $data['MotherQualification'][1]['institute'];
				$MQ_YOC_2 = $data['MotherQualification'][1]['year_of_completion'];
			}



			/****** Family Work Detail ******/
			// Father Work Detail
			$FWD_Org = '';
			$FWD_Dep = '';
			$FWD_Des = '';
			$FWD_WP = '';
			$FWD_WA = '';
			$FWD_WR = '';
			if(!empty($data['FatherWorkDetail'])){
				$FWD_Org = $data['FatherWorkDetail'][0]['organization'];
				$FWD_Dep = $data['FatherWorkDetail'][0]['department'];
				$FWD_Des = $data['FatherWorkDetail'][0]['designation'];
				$FWD_WP = $data['FatherWorkDetail'][0]['phone'];
				$FWD_WA = $data['FatherWorkDetail'][0]['address'];
				$FWD_WR = $data['FatherWorkDetail'][0]['region'];
			}

			// Mother Work Detail
			$MWD_Org = '';
			$MWD_Dep = '';
			$MWD_Des = '';
			$MWD_WP = '';
			$MWD_WA = '';
			$MWD_WR = '';
			if(!empty($data['MotherWorkDetail'])){
				$MWD_Org = $data['MotherWorkDetail'][0]['organization'];
				$MWD_Dep = $data['MotherWorkDetail'][0]['department'];
				$MWD_Des = $data['MotherWorkDetail'][0]['designation'];
				$MWD_WP = $data['MotherWorkDetail'][0]['phone'];
				$MWD_WA = $data['MotherWorkDetail'][0]['address'];
				$MWD_WR = $data['MotherWorkDetail'][0]['region'];
			}

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

			    // use the imported page
		    	$pdf->useTemplate($templateId);

		    	if ($templateId == 1){
		    		
		    		// Todate
			    	$pdf->SetFont($font_name,'B',8);
				    $pdf->SetXY(95, 8);				    
				    $pdf->Write(8, $now_date.".");

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


						if($isLeft == true){							
						    // GS-ID
						    $pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',10);
						    $pdf->SetXY(120, (-72.5+26) + ($i*72.5));
						    $pdf->Setfillcolor(225,225,225);
						    $pdf->SetDrawColor(225,0,0);
						    $pdf->MultiCell(20, 4, $GSID, $BorderOn, 'L', 0);

						    // Student Official Name
						    $pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',10);
						    $pdf->SetXY(120, (-72.5+31) + ($i*72.5));
						    $pdf->Setfillcolor(225,225,225);
						    $pdf->SetDrawColor(225,0,0);
						    $pdf->MultiCell(65, 4, $OfficialName, $BorderOn, 'L', 0);

						    // Student Abridged Name
						    $pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'B',11);
						    $pdf->SetXY(120, (-72.5+36) + ($i*72.5));
						    $pdf->Setfillcolor(225,225,225);
						    $pdf->SetDrawColor(225,0,0);
						    $pdf->MultiCell(65, 4, $AbridgedName, $BorderOn, 'L', 0);

						    // Student Call Name
						    $pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',10);
						    $pdf->SetXY(120, (-72.5+41.2) + ($i*72.5));
						    $pdf->Setfillcolor(225,225,225);
						    $pdf->SetDrawColor(225,0,0);
						    $pdf->MultiCell(25, 4, $CallName, $BorderOn, 'L', 0);

						    // Student Pic Path
						    $pdf->Image($StudentPicPath,154.5,(-72.5+41.2) + ($i*72.5),33,0,'PNG');	
						     

						    // Grade and Section
						    $pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'B',10);
						    $pdf->SetXY(120, (-72.5+46.2) + ($i*72.5));
						    $pdf->Setfillcolor(225,225,225);
						    $pdf->SetDrawColor(225,0,0);
						    $pdf->MultiCell(25, 4, $Grade."-".$Section, $BorderOn, 'L', 0);

						    // Student House Name
						    $pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',10);
						    $pdf->SetXY(120, (-72.5+51.2) + ($i*72.5));
						    $pdf->Setfillcolor(225,225,225);
						    $pdf->SetDrawColor(225,0,0);
						    $pdf->MultiCell(25, 4, $House, $BorderOn, 'L', 0);

						    // Generation of
						    $pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',10);
						    $pdf->SetXY(120, (-72.5+56.5) + ($i*72.5));
						    $pdf->Setfillcolor(225,225,225);
						    $pdf->SetDrawColor(225,0,0);
						    $pdf->MultiCell(25, 4, $GO, $BorderOn, 'L', 0);

							// Session of Admission
						    $pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',10);
						    $pdf->SetXY(120, (-72.5+61.6) + ($i*72.5));
						    $pdf->Setfillcolor(225,225,225);
						    $pdf->SetDrawColor(225,0,0);
						    $pdf->MultiCell(25, 4, $YOA, $BorderOn, 'L', 0);

						    // Grade of Admission
						    $pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',10);
						    $pdf->SetXY(120, (-72.5+66.7) + ($i*72.5));
						    $pdf->Setfillcolor(225,225,225);
						    $pdf->SetDrawColor(225,0,0);
						    $pdf->MultiCell(25, 4, $GOA, $BorderOn, 'L', 0); 

						    // Date of Birth
						    $pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',10);
						    $pdf->SetXY(120, (-72.5+71.8) + ($i*72.5));
						    $pdf->Setfillcolor(225,225,225);
						    $pdf->SetDrawColor(225,0,0);
						    $pdf->MultiCell(25, 4, $dob, $BorderOn, 'L', 0);

						    // Student Status
						    $pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',10);
						    $pdf->SetXY(120, (-72.5+76.9) + ($i*72.5));
						    $pdf->Setfillcolor(225,225,225);
						    $pdf->SetDrawColor(225,0,0);
						    $pdf->MultiCell(25, 4, $SSN, $BorderOn, 'L', 0);

						    // Nationality_1
						    $pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',10);
						    $pdf->SetXY(120, (-72.5+82) + ($i*72.5));
						    $pdf->Setfillcolor(225,225,225);
						    $pdf->SetDrawColor(225,0,0);
						    $pdf->MultiCell(25, 4, $N_1, $BorderOn, 'L', 0);

						    // Student Mobile Phone
						    $pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',10);
						    $pdf->SetXY(120, (-72.5+87.1) + ($i*72.5));
						    $pdf->Setfillcolor(225,225,225);
						    $pdf->SetDrawColor(225,0,0);
						    $pdf->MultiCell(25, 4, $SMP, $BorderOn, 'L', 0);

						    // Student Email
						    $pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',10);
						    $pdf->SetXY(120, (-72.5+92.2) + ($i*72.5));
						    $pdf->Setfillcolor(225,225,225);
						    $pdf->SetDrawColor(225,0,0);
						    $pdf->MultiCell(50, 4, $Email, $BorderOn, 'L', 0);

					    	$isLeft = false;
					    	$i++;
						}else{
							// GS-ID
						    $pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',10);
						    $pdf->SetXY(76, (-72.5+26) + ($i*72.5));
						    $pdf->Setfillcolor(225,225,225);
						    $pdf->SetDrawColor(225,0,0);
						    $pdf->MultiCell(20, 4, $GSID, $BorderOn, 'R', 0);

						    // Student Official Name
						    $pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',10);
						    $pdf->SetXY(31, (-72.5+31) + ($i*72.5));
						    $pdf->Setfillcolor(225,225,225);
						    $pdf->SetDrawColor(225,0,0);
						    $pdf->MultiCell(65, 4, $OfficialName, $BorderOn, 'R', 0);

						    // Student Abridged Name
						    $pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'B',11);
						    $pdf->SetXY(31, (-72.5+36) + ($i*72.5));
						    $pdf->Setfillcolor(225,225,225);
						    $pdf->SetDrawColor(225,0,0);
						    $pdf->MultiCell(65, 4, $AbridgedName, $BorderOn, 'R', 0);

						    // Student Call Name
						    $pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',10);
						    $pdf->SetXY(71, (-72.5+41.2) + ($i*72.5));
						    $pdf->Setfillcolor(225,225,225);
						    $pdf->SetDrawColor(225,0,0);
						    $pdf->MultiCell(25, 4, $CallName, $BorderOn, 'R', 0);

						    // Student Pic Path
						    $pdf->Image($StudentPicPath,28,(-72.5+41.2) + ($i*72.5),33,0,'PNG');	
						     

						    // Grade and Section
						    $pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'B',10);
						    $pdf->SetXY(71, (-72.5+46.2) + ($i*72.5));
						    $pdf->Setfillcolor(225,225,225);
						    $pdf->SetDrawColor(225,0,0);
						    $pdf->MultiCell(25, 4, $Grade."-".$Section, $BorderOn, 'R', 0);

						    // Student House Name
						    $pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',10);
						    $pdf->SetXY(71, (-72.5+51.2) + ($i*72.5));
						    $pdf->Setfillcolor(225,225,225);
						    $pdf->SetDrawColor(225,0,0);
						    $pdf->MultiCell(25, 4, $House, $BorderOn, 'R', 0);

						    // Generation of
						    $pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',10);
						    $pdf->SetXY(71, (-72.5+56.5) + ($i*72.5));
						    $pdf->Setfillcolor(225,225,225);
						    $pdf->SetDrawColor(225,0,0);
						    $pdf->MultiCell(25, 4, $GO, $BorderOn, 'R', 0);

							// Session of Admission
						    $pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',10);
						    $pdf->SetXY(71, (-72.5+61.6) + ($i*72.5));
						    $pdf->Setfillcolor(225,225,225);
						    $pdf->SetDrawColor(225,0,0);
						    $pdf->MultiCell(25, 4, $YOA, $BorderOn, 'R', 0);

						    // Grade of Admission
						    $pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',10);
						    $pdf->SetXY(71, (-72.5+66.7) + ($i*72.5));
						    $pdf->Setfillcolor(225,225,225);
						    $pdf->SetDrawColor(225,0,0);
						    $pdf->MultiCell(25, 4, $GOA, $BorderOn, 'R', 0); 

						    // Date of Birth
						    $pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',10);
						    $pdf->SetXY(71, (-72.5+71.8) + ($i*72.5));
						    $pdf->Setfillcolor(225,225,225);
						    $pdf->SetDrawColor(225,0,0);
						    $pdf->MultiCell(25, 4, $dob, $BorderOn, 'R', 0);

						    // Student Status
						    $pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',10);
						    $pdf->SetXY(71, (-72.5+76.9) + ($i*72.5));
						    $pdf->Setfillcolor(225,225,225);
						    $pdf->SetDrawColor(225,0,0);
						    $pdf->MultiCell(25, 4, $SSN, $BorderOn, 'R', 0);

						    // Nationality_1
						    $pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',10);
						    $pdf->SetXY(71, (-72.5+82) + ($i*72.5));
						    $pdf->Setfillcolor(225,225,225);
						    $pdf->SetDrawColor(225,0,0);
						    $pdf->MultiCell(25, 4, $N_1, $BorderOn, 'R', 0);

						    // Student Mobile Phone
						    $pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',10);
						    $pdf->SetXY(71, (-72.5+87.1) + ($i*72.5));
						    $pdf->Setfillcolor(225,225,225);
						    $pdf->SetDrawColor(225,0,0);
						    $pdf->MultiCell(25, 4, $SMP, $BorderOn, 'R', 0);

						    // Student Email
						    $pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',10);
						    $pdf->SetXY(46, (-72.5+92.2) + ($i*72.5));
						    $pdf->Setfillcolor(225,225,225);
						    $pdf->SetDrawColor(225,0,0);
						    $pdf->MultiCell(50, 4, $Email, $BorderOn, 'R', 0);

							$isLeft = true;							
						}						
					}

					// FIF Note
				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',8);
				    $pdf->SetXY(25, 244);
				    $pdf->Setfillcolor(225,225,225);
				    $pdf->SetDrawColor(225,0,0);
				    $pdf->MultiCell(165, 4, $FIF_Note, $BorderOn, 'C', 0);

				    $i=1;
				    $isLeft = false;
				    for($j=1; $j<=6; $j++){				    	
		    			if($isLeft == true){
		    				if($j > $siblingsCounter){
		    					// Add Generians
							    $pdf->SetFont($font_name);
							    $pdf->SetFont($font_name,'B',10);
							    $pdf->SetXY(120, (-72.5+46.2) + ($i*72.5));
							    $pdf->Setfillcolor(225,225,225);
							    $pdf->SetDrawColor(225,0,0);
							    $pdf->MultiCell(60, 4, $AddMore_Line1, $BorderOn, 'L', 0);

							    // Current or Alumni
							    $pdf->SetFont($font_name);
							    $pdf->SetFont($font_name,'',10);
							    $pdf->SetXY(120, (-72.5+51.2) + ($i*72.5));
							    $pdf->Setfillcolor(225,225,225);
							    $pdf->SetDrawColor(225,0,0);
							    $pdf->MultiCell(40, 4, $AddMore_Line2, $BorderOn, 'L', 0);

							    // If Any
							    $pdf->SetFont($font_name);
							    $pdf->SetFont($font_name,'',10);
							    $pdf->SetXY(120, (-72.5+56.5) + ($i*72.5));
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
							    $pdf->SetXY(35, (-72.5+46.2) + ($i*72.5));
							    $pdf->Setfillcolor(225,225,225);
							    $pdf->SetDrawColor(225,0,0);
							    $pdf->MultiCell(60, 4, $AddMore_Line1, $BorderOn, 'R', 0);

							    // Student House Name
							    $pdf->SetFont($font_name);
							    $pdf->SetFont($font_name,'',10);
							    $pdf->SetXY(55, (-72.5+51.2) + ($i*72.5));
							    $pdf->Setfillcolor(225,225,225);
							    $pdf->SetDrawColor(225,0,0);
							    $pdf->MultiCell(40, 4, $AddMore_Line2, $BorderOn, 'R', 0);

							    // Generation of
							    $pdf->SetFont($font_name);
							    $pdf->SetFont($font_name,'',10);
							    $pdf->SetXY(55, (-72.5+56.5) + ($i*72.5));
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
				    $pdf->SetXY(189, 11.2);
				    $pdf->Setfillcolor(225,225,225);
				    $pdf->SetDrawColor(225,0,0);
				    $pdf->MultiCell(4, 4, $GFID, $BorderOn, 'C', 0);

					/****** Home & Primary Contact ******/
					// Apartment No.
					$decrement_step = 0.1;					
				    $line_width = 45;
				    $pdf->SetFont($font_name);			    
				    $pdf->SetXY(58, 11.2);
				    $this_font_size = $font_size;
				    while($pdf->GetStringWidth($AppartmentNo) >= $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
					}				
				    $pdf->Cell($line_width, 4, $AppartmentNo, $BorderOn, 0, 'L', 0);
					
				    // Building Name
				    $decrement_step = 0.1;
				    $line_width = 45;
				    $pdf->SetFont($font_name);			    
				    $pdf->SetXY(58, 17);
				    $this_font_size = $font_size;
				    while($pdf->GetStringWidth($BuildingName) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
					}				
				    $pdf->Cell($line_width, 4, $BuildingName, $BorderOn, 0, 'L', 0);
				    
				    // Plot No
				    $decrement_step = 0.1;
				    $line_width = 45;
				    $pdf->SetFont($font_name);			    
				    $pdf->SetXY(58, 22.5);
				    $this_font_size = $font_size;
				    while($pdf->GetStringWidth($PlotNo) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
					}				
				    $pdf->Cell($line_width, 4, $PlotNo, $BorderOn, 0, 'L', 0);

				    // Street Name
				    $decrement_step = 0.1;
				    $line_width = 45;
				    $pdf->SetFont($font_name);			    
				    $pdf->SetXY(58, 28);
				    $this_font_size = $font_size;
				    while($pdf->GetStringWidth($StreetName) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
					}				
				    $pdf->Cell($line_width, 4, $StreetName, $BorderOn, 0, 'L', 0);
				    
				    // Sub Region
				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',10);
				    $pdf->SetXY(58, 33.5);
				    $pdf->Setfillcolor(225,225,225);
				    $pdf->SetDrawColor(225,0,0);
				    $pdf->MultiCell(45, 4, $SubRegion, $BorderOn, 'L', 0);

				    // Region
				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',10);
				    $pdf->SetXY(58, 39);
				    $pdf->Setfillcolor(225,225,225);
				    $pdf->SetDrawColor(225,0,0);
				    $pdf->MultiCell(45, 4, $Region, $BorderOn, 'L', 0);

				    // City
				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',10);
				    $pdf->SetXY(58, 44.5);
				    $pdf->Setfillcolor(225,225,225);
				    $pdf->SetDrawColor(225,0,0);
				    $pdf->MultiCell(45, 4, $City, $BorderOn, 'L', 0);

				    // Home Phone
				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',10);
				    $pdf->SetXY(130, 11.2);
				    $pdf->Setfillcolor(225,225,225);
				    $pdf->SetDrawColor(225,0,0);
				    $pdf->MultiCell(50, 4, $HomePhone, $BorderOn, 'L', 0);

				    // Primary Mobile Contact
				    if ($PMC == 'Both')
				    {				       
				    	$pdf->AddFont('wingdng2','','wingdng2.php');
					    $pdf->SetFont('wingdng2','',$gender_mark_size);
					    $pdf->SetXY(137.5, 16);
					    $pdf->Write(6, 'P');
				   	
				   		$pdf->AddFont('wingdng2','','wingdng2.php');
					    $pdf->SetFont('wingdng2','',$gender_mark_size);
					    $pdf->SetXY(160,16);
					    $pdf->Write(6, 'P');
					}
				    if ($PMC == 'Father')
				    {
				    	$pdf->AddFont('wingdng2','','wingdng2.php');
					    $pdf->SetFont('wingdng2','',$gender_mark_size);
					    $pdf->SetXY(137.5, 16);
					    $pdf->Write(6, 'P');

				   	}
				   	if($PMC == 'Mother'){
				   		$pdf->AddFont('wingdng2','','wingdng2.php');
					    $pdf->SetFont('wingdng2','',$gender_mark_size);
					    $pdf->SetXY(160, 16);
					    $pdf->Write(6, 'P');
				   	}

				   	// Primary SMS Contact
				    if ($PSC == 'Both')
				    {				       
				    	$pdf->AddFont('wingdng2','','wingdng2.php');
					    $pdf->SetFont('wingdng2','',$gender_mark_size);
					    $pdf->SetXY(137.5, 21.5);
					    $pdf->Write(6, 'P');
				   	
				   		$pdf->AddFont('wingdng2','','wingdng2.php');
					    $pdf->SetFont('wingdng2','',$gender_mark_size);
					    $pdf->SetXY(160,21.5);
					    $pdf->Write(6, 'P');
					}
				    if ($PSC == 'Father')
				    {
				    	$pdf->AddFont('wingdng2','','wingdng2.php');
					    $pdf->SetFont('wingdng2','',$gender_mark_size);
					    $pdf->SetXY(137.5, 21.5);
					    $pdf->Write(6, 'P');

				   	}
				   	if($PSC == 'Mother'){
				   		$pdf->AddFont('wingdng2','','wingdng2.php');
					    $pdf->SetFont('wingdng2','',$gender_mark_size);
					    $pdf->SetXY(160, 21.5);
					    $pdf->Write(6, 'P');
				   	}

				   	// Primary PEC Contact
				    if ($PEC == 'Both')
				    {				       
				    	$pdf->AddFont('wingdng2','','wingdng2.php');
					    $pdf->SetFont('wingdng2','',$gender_mark_size);
					    $pdf->SetXY(137.5, 27);
					    $pdf->Write(6, 'P');
				   	
				   		$pdf->AddFont('wingdng2','','wingdng2.php');
					    $pdf->SetFont('wingdng2','',$gender_mark_size);
					    $pdf->SetXY(160, 27);
					    $pdf->Write(6, 'P');
					}
				    if ($PEC == 'Father')
				    {
				    	$pdf->AddFont('wingdng2','','wingdng2.php');
					    $pdf->SetFont('wingdng2','',$gender_mark_size);
					    $pdf->SetXY(137.5, 27);
					    $pdf->Write(6, 'P');

				   	}
				   	if($PEC == 'Mother'){
				   		$pdf->AddFont('wingdng2','','wingdng2.php');
					    $pdf->SetFont('wingdng2','',$gender_mark_size);
					    $pdf->SetXY(160, 27);
					    $pdf->Write(6, 'P');
				   	}

				   	/****** Family Information ******/
				   	// Father Name
				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',10);
				    $pdf->SetXY(35, 57);
				    $pdf->Setfillcolor(225,225,225);
				    $pdf->SetDrawColor(225,0,0);
				    $pdf->MultiCell(50, 4, $FatherName, $BorderOn, 'R', 0);
				    
				    // Mother Name
				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',10);
				    $pdf->SetXY(122, 57);
				    $pdf->Setfillcolor(225,225,225);
				    $pdf->SetDrawColor(225,0,0);
				    $pdf->MultiCell(50, 4, $MotherName, $BorderOn, 'L', 0);

				    // Father Photo Path
				    $pdf->Image($FatherPhoto,22,62.4,21,0,'PNG');
				    // Mother Photo Path
				    $pdf->Image($MotherPhoto,164,62.4,21,0,'PNG');

				    // YOD
				    if ($YOD == 'Late')
				    {				       
				    	$pdf->AddFont('wingdng2','','wingdng2.php');
					    $pdf->SetFont('wingdng2','',$gender_mark_size);
					    $pdf->SetXY(22, 62.4);
					    $pdf->Write(1, 'O');
					}
			   		
				    // Father Nationality 1
				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',10);
				    $pdf->SetXY(35, 62.4);
				    $pdf->Setfillcolor(225,225,225);
				    $pdf->SetDrawColor(225,0,0);
				    $pdf->MultiCell(50, 4, $FN_1, $BorderOn, 'R', 0);

				    // Mother Nationality 1
				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',10);
				    $pdf->SetXY(122, 62.4);
				    $pdf->Setfillcolor(225,225,225);
				    $pdf->SetDrawColor(225,0,0);
				    $pdf->MultiCell(50, 4, $MN_1, $BorderOn, 'L', 0);

				    // Father Nationality 2
				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',10);
				    $pdf->SetXY(35, 67.7);
				    $pdf->Setfillcolor(225,225,225);
				    $pdf->SetDrawColor(225,0,0);
				    $pdf->MultiCell(50, 4, $FN_2, $BorderOn, 'R', 0);

				    // Mother Nationality 2
				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',10);
				    $pdf->SetXY(122, 67.7);
				    $pdf->Setfillcolor(225,225,225);
				    $pdf->SetDrawColor(225,0,0);
				    $pdf->MultiCell(50, 4, $MN_2, $BorderOn, 'L', 0);

				    // Father NIC
				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',10);
				    $pdf->SetXY(35, 73.3);
				    $pdf->Setfillcolor(225,225,225);
				    $pdf->SetDrawColor(225,0,0);
				    $pdf->MultiCell(50, 4, $FNIC, $BorderOn, 'R', 0);

				    // Mother NIC
				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',10);
				    $pdf->SetXY(122, 73.3);
				    $pdf->Setfillcolor(225,225,225);
				    $pdf->SetDrawColor(225,0,0);
				    $pdf->MultiCell(50, 4, $MNIC, $BorderOn, 'L', 0);

				    // Father Mobile Phone
				    $decrement_step = 0.1;
				    $line_width = 40;
				    $pdf->SetFont($font_name);			    
				    $pdf->SetXY(45, 78.9);
				    $this_font_size = $font_size;
				    while($pdf->GetStringWidth($FMP) > $line_width) {					
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
					}				
				    $pdf->Cell($line_width, 4, $FMP, $BorderOn, 0, 'R', 0);
				    
				    // Mother Moblie Phone
				    $decrement_step = 0.1;
				    $line_width = 40;
				    $pdf->SetFont($font_name);			    
				    $pdf->SetXY(122, 78.9);
				    $this_font_size = $font_size;
				    while($pdf->GetStringWidth($MMP) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
					}				
				    $pdf->Cell($line_width, 4, $MMP, $BorderOn, 0, 'L', 0);
				    
				    // Father Profession
				    $decrement_step = 0.1;
				    $line_width = 58;
				    $pdf->SetFont($font_name);			    
				    $pdf->SetXY(27, 84.5);
				    $this_font_size = $font_size;
				    while($pdf->GetStringWidth($FP) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
					}				
				    $pdf->Cell($line_width, 4, $FP, $BorderOn, 0, 'R', 0);
				    
				    // Mother Profession
				    $decrement_step = 0.1;
				    $line_width = 58;
				    $pdf->SetFont($font_name);			    
				    $pdf->SetXY(122, 84.5);
				    $this_font_size = $font_size;
				    while($pdf->GetStringWidth($MP) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
					}				
				    $pdf->Cell($line_width, 4, $MP, $BorderOn, 0, 'L', 0);

				    // Father Speciality
				    $decrement_step = 0.1;
				    $line_width = 40;
				    $pdf->SetFont($font_name);			    
				    $pdf->SetXY(45, 90.1);
				    $this_font_size = $font_size;
				    while($pdf->GetStringWidth($FS) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
					}				
				    $pdf->Cell($line_width, 4, $FS, $BorderOn, 0, 'R', 0);
				    
				    // Mother Speciality
				    $decrement_step = 0.1;
				    $line_width = 40;
				    $pdf->SetFont($font_name);			    
				    $pdf->SetXY(122, 90.1);
				    $this_font_size = $font_size;
				    while($pdf->GetStringWidth($MS) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
					}				
				    $pdf->Cell($line_width, 4, $MS, $BorderOn, 0, 'L', 0);
				    
				    // Father Email
				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',10);
				    $pdf->SetXY(35, 96);
				    $pdf->Setfillcolor(225,225,225);
				    $pdf->SetDrawColor(225,0,0);
				    $pdf->MultiCell(50, 4, $FE, $BorderOn, 'R', 0);

				    // Mother Email
				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',10);
				    $pdf->SetXY(122, 96);
				    $pdf->Setfillcolor(225,225,225);
				    $pdf->SetDrawColor(225,0,0);
				    $pdf->MultiCell(50, 4, $ME, $BorderOn, 'L', 0);

				    // Marital Status
					if ($MaritalStatus == 'Married')
				    {				       
				    	$pdf->AddFont('wingdng2','','wingdng2.php');
					    $pdf->SetFont('wingdng2','',$gender_mark_size);
					    $pdf->SetXY(43, 108);
					    $pdf->Write(2, 'P');
					}
			   		if ($MaritalStatus == 'Widowed')
				    {
				    	$pdf->AddFont('wingdng2','','wingdng2.php');
					    $pdf->SetFont('wingdng2','',$gender_mark_size);
					    $pdf->SetXY(65, 108);
					    $pdf->Write(2, 'P');
				   	}
				   	if($MaritalStatus == 'Divorced'){
				   		$pdf->AddFont('wingdng2','','wingdng2.php');
					    $pdf->SetFont('wingdng2','',$gender_mark_size);
					    $pdf->SetXY(87, 108);
					    $pdf->Write(2, 'P');
				   	}
					if($MaritalStatus == 'Other'){
				   		$pdf->AddFont('wingdng2','','wingdng2.php');
					    $pdf->SetFont('wingdng2','',$gender_mark_size);
					    $pdf->SetXY(109, 108);
					    $pdf->Write(2, 'P');
				   	}

				   	/****** Family Qualification ******/
				   	// Father Qualification
				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',10);
				    $pdf->SetXY(22, 120);
				    $pdf->Setfillcolor(225,225,225);
				    $pdf->SetDrawColor(225,0,0);
				    $pdf->MultiCell(60, 4, $FQ_HQL, $BorderOn, 'R', 0);

				    $decrement_step = 0.1;
				    $line_width = 60;
				    $pdf->SetFont($font_name);			    
				    $pdf->SetXY(22, 127.7);
				    $this_font_size = $font_size;
				    while($pdf->GetStringWidth($FQ_HQT) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
					}				
				    $pdf->Cell($line_width, 4, $FQ_HQT, $BorderOn, 0, 'R', 0);
				    /*$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',10);
				    $pdf->SetXY(32, 127.7);
				    $pdf->Setfillcolor(225,225,225);
				    $pdf->SetDrawColor(225,0,0);
				    $pdf->MultiCell(50, 4, $FQ_HQT, $BorderOn, 'R', 0);*/

				    $decrement_step = 0.1;
				    $line_width = 60;
				    $pdf->SetFont($font_name);			    
				    $pdf->SetXY(22, 132);
				    $this_font_size = $font_size;
				    while($pdf->GetStringWidth($FQ_IU_1) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
					}				
				    $pdf->Cell($line_width, 4, $FQ_IU_1, $BorderOn, 0, 'R', 0);
				    /*$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',10);
				    $pdf->SetXY(32, 132);
				    $pdf->Setfillcolor(225,225,225);
				    $pdf->SetDrawColor(225,0,0);
				    $pdf->MultiCell(50, 4, $FQ_IU_1, $BorderOn, 'R', 0);*/

				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',10);
				    $pdf->SetXY(22, 138);
				    $pdf->Setfillcolor(225,225,225);
				    $pdf->SetDrawColor(225,0,0);
				    $pdf->MultiCell(60, 4, $FQ_YOC_1, $BorderOn, 'R', 0);

				    $decrement_step = 0.1;
				    $line_width = 60;
				    $pdf->SetFont($font_name);			    
				    $pdf->SetXY(22, 145);
				    $this_font_size = $font_size;
				    while($pdf->GetStringWidth($FQ_SQL) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
					}				
				    $pdf->Cell($line_width, 4, $FQ_SQL, $BorderOn, 0, 'R', 0);
				    
				    $decrement_step = 0.1;
				    $line_width = 60;
				    $pdf->SetFont($font_name);			    
				    $pdf->SetXY(22, 152.3);
				    $this_font_size = $font_size;
				    while($pdf->GetStringWidth($FQ_SQT) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
					}				
				    $pdf->Cell($line_width, 4, $FQ_SQT, $BorderOn, 0, 'R', 0);
				   
				    $decrement_step = 0.1;
				    $line_width = 60;
				    $pdf->SetFont($font_name);			    
				    $pdf->SetXY(22, 158);
				    $this_font_size = $font_size;
				    while($pdf->GetStringWidth($FQ_IU_2) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
					}				
				    $pdf->Cell($line_width, 4, $FQ_IU_2, $BorderOn, 0, 'R', 0);
				    
				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',10);
				    $pdf->SetXY(22, 163.5);
				    $pdf->Setfillcolor(225,225,225);
				    $pdf->SetDrawColor(225,0,0);
				    $pdf->MultiCell(60, 4, $FQ_YOC_2, $BorderOn, 'R', 0);

				    // Mother Qualification
				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',10);
				    $pdf->SetXY(122, 120);
				    $pdf->Setfillcolor(225,225,225);
				    $pdf->SetDrawColor(225,0,0);
				    $pdf->MultiCell(60, 4, $MQ_HQL, $BorderOn, 'L', 0);

				    $decrement_step = 0.1;
				    $line_width = 60;
				    $pdf->SetFont($font_name);			    
				    $pdf->SetXY(122, 127.7);
				    $this_font_size = $font_size;
				    while($pdf->GetStringWidth($MQ_HQT) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
					}				
				    $pdf->Cell($line_width, 4, $MQ_HQT, $BorderOn, 0, 'L', 0);
				    
				    $decrement_step = 0.1;
				    $line_width = 60;
				    $pdf->SetFont($font_name);			    
				    $pdf->SetXY(122, 132);
				    $this_font_size = $font_size;
				    while($pdf->GetStringWidth($MQ_IU_1) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
					}				
				    $pdf->Cell($line_width, 4, $MQ_IU_1, $BorderOn, 0, 'L', 0);
				    
				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',10);
				    $pdf->SetXY(122, 138);
				    $pdf->Setfillcolor(225,225,225);
				    $pdf->SetDrawColor(225,0,0);
				    $pdf->MultiCell(60, 4, $MQ_YOC_1, $BorderOn, 'L', 0);

				    $decrement_step = 0.1;
				    $line_width = 60;
				    $pdf->SetFont($font_name);			    
				    $pdf->SetXY(122, 145);
				    $this_font_size = $font_size;
				    while($pdf->GetStringWidth($MQ_SQL) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
					}				
				    $pdf->Cell($line_width, 4, $MQ_SQL, $BorderOn, 0, 'L', 0);
				    
				    $decrement_step = 0.1;
				    $line_width = 60;
				    $pdf->SetFont($font_name);			    
				    $pdf->SetXY(122, 152.3);
				    $this_font_size = $font_size;
				    while($pdf->GetStringWidth($MQ_SQT) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
					}				
				    $pdf->Cell($line_width, 4, $MQ_SQT, $BorderOn, 0, 'L', 0);
				    
				    $decrement_step = 0.1;
				    $line_width = 60;
				    $pdf->SetFont($font_name);			    
				    $pdf->SetXY(122, 158);
				    $this_font_size = $font_size;
				    while($pdf->GetStringWidth($MQ_IU_2) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
					}				
				    $pdf->Cell($line_width, 4, $MQ_IU_2, $BorderOn, 0, 'L', 0);
				    
				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',10);
				    $pdf->SetXY(122, 163.5);
				    $pdf->Setfillcolor(225,225,225);
				    $pdf->SetDrawColor(225,0,0);
				    $pdf->MultiCell(60, 4, $MQ_YOC_2, $BorderOn, 'L', 0);

				    /******* Family Work Detail ******/
				    // Father Detail
				    $decrement_step = 0.1;
				    $line_width = 60;
				    $pdf->SetFont($font_name);			    
				    $pdf->SetXY(22, 175);
				    $this_font_size = $font_size;
				    while($pdf->GetStringWidth($FWD_Org) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
					}				
				    $pdf->Cell($line_width, 4, $FWD_Org, $BorderOn, 0, 'R', 0);
				    
				    $decrement_step = 0.1;
				    $line_width = 60;
				    $pdf->SetFont($font_name);			    
				    $pdf->SetXY(22, 180);
				    $this_font_size = $font_size;
				    while($pdf->GetStringWidth($FWD_Dep) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
					}				
				    $pdf->Cell($line_width, 4, $FWD_Dep, $BorderOn, 0, 'R', 0);
				    
				    $decrement_step = 0.1;
				    $line_width = 60;
				    $pdf->SetFont($font_name);			    
				    $pdf->SetXY(22, 185.5);
				    $this_font_size = $font_size;
				    while($pdf->GetStringWidth($FWD_Des) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
					}				
				    $pdf->Cell($line_width, 4, $FWD_Des, $BorderOn, 0, 'R', 0);
				    
				    $decrement_step = 0.1;
				    $line_width = 60;
				    $pdf->SetFont($font_name);			    
				    $pdf->SetXY(22, 191);
				    $this_font_size = $font_size;
				    while($pdf->GetStringWidth($FWD_WP) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
					}				
				    $pdf->Cell($line_width, 4, $FWD_WP, $BorderOn, 0, 'R', 0);
				    

				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',10);
				    $pdf->SetXY(22, 196.5);
				    $pdf->Setfillcolor(225,225,225);
				    $pdf->SetDrawColor(225,0,0);
				    $pdf->MultiCell(60, 4, $FWD_WA, $BorderOn, 'R', 0);

				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',10);
				    $pdf->SetXY(22, 212.5);
				    $pdf->Setfillcolor(225,225,225);
				    $pdf->SetDrawColor(225,0,0);
				    $pdf->MultiCell(60, 4, $FWD_WR, $BorderOn, 'R', 0);

				    // Mother Detail
				    $decrement_step = 0.1;
				    $line_width = 60;
				    $pdf->SetFont($font_name);			    
				    $pdf->SetXY(122, 175);
				    $this_font_size = $font_size;
				    while($pdf->GetStringWidth($MWD_Org) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
					}				
				    $pdf->Cell($line_width, 4, $MWD_Org, $BorderOn, 0, 'L', 0);
				    
				    $decrement_step = 0.1;
				    $line_width = 60;
				    $pdf->SetFont($font_name);			    
				    $pdf->SetXY(122, 180);
				    $this_font_size = $font_size;
				    while($pdf->GetStringWidth($MWD_Dep) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
					}				
				    $pdf->Cell($line_width, 4, $MWD_Dep, $BorderOn, 0, 'L', 0);
				    
				    $decrement_step = 0.1;
				    $line_width = 60;
				    $pdf->SetFont($font_name);			    
				    $pdf->SetXY(122, 185.5);
				    $this_font_size = $font_size;
				    while($pdf->GetStringWidth($MWD_Des) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
					}				
				    $pdf->Cell($line_width, 4, $MWD_Des, $BorderOn, 0, 'L', 0);

				    $decrement_step = 0.1;
				    $line_width = 60;
				    $pdf->SetFont($font_name);			    
				    $pdf->SetXY(122, 191);
				    $this_font_size = $font_size;
				    while($pdf->GetStringWidth($MWD_WP) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
					}				
				    $pdf->Cell($line_width, 4, $MWD_WP, $BorderOn, 0, 'L', 0);
				    
				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',10);
				    $pdf->SetXY(122, 196.5);
				    $pdf->Setfillcolor(225,225,225);
				    $pdf->SetDrawColor(225,0,0);
				    $pdf->MultiCell(60, 4, $MWD_WA, $BorderOn, 'L', 0);

				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',10);
				    $pdf->SetXY(122, 212.5);
				    $pdf->Setfillcolor(225,225,225);
				    $pdf->SetDrawColor(225,0,0);
				    $pdf->MultiCell(55, 4, $MWD_WR, $BorderOn, 'L', 0);

				   	/****** Emergency Contact ******/
				   	// EC Name
				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',10);
				    $pdf->SetXY(56.2, 228);
				    $pdf->Setfillcolor(225,225,225);
				    $pdf->SetDrawColor(225,0,0);
				    $pdf->MultiCell(43, 4, $ECName, $BorderOn, 'L', 0);

				    // EC Email
				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',10);
				    $pdf->SetXY(56.2, 233);
				    $pdf->Setfillcolor(225,225,225);
				    $pdf->SetDrawColor(225,0,0);
				    $pdf->MultiCell(43, 4, $ECEmail, $BorderOn, 'L', 0);

				    // EC Phone
				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',10);
				    $pdf->SetXY(56.2, 249);
				    $pdf->Setfillcolor(225,225,225);
				    $pdf->SetDrawColor(225,0,0);
				    $pdf->MultiCell(43, 4, $ECPhone, $BorderOn, 'L', 0);

				    // EC Relationship
				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',10);
				    $pdf->SetXY(56.2, 257);
				    $pdf->Setfillcolor(225,225,225);
				    $pdf->SetDrawColor(225,0,0);
				    $pdf->MultiCell(43, 4, $ECRelation, $BorderOn, 'L', 0);

				    // EC Address
				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',10);
				    $pdf->SetXY(56.2, 262);
				    $pdf->Setfillcolor(225,225,225);
				    $pdf->SetDrawColor(225,0,0);
				    $pdf->MultiCell(43, 4, $ECAddress, $BorderOn, 'L', 0);
				}
			}

			// Output the new PDF			
			$pdf->Output($GFID . '.pdf', 'I');
			//$pdf->Output();
		}
	}


}