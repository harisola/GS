<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fee_bill_duplicate extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('accounts/fee_bill/fee_bill_upload_mis_model');
	}

	public function index()
	{		
		$this->form_validation->set_rules($this->validation_gsid);
		$this->form_validation->set_message('verifyGSID','NO Fee Bill found');



		if($this->form_validation->run() == TRUE){
			if(count($_POST))
			{	
				$GSID = $this->input->post('gs_id');
				$this->GSID = $GSID;
				$ASFrom = 5;
				$ASTo = 6;
				$this->feebill = $this->fee_bill_upload_mis_model->getAllFeeBillDetail($GSID, $ASFrom, $ASTo);
				$this->StudentInfo = $this->fee_bill_upload_mis_model->getStudentInformation($GSID);
				$this->MultiFIF = $this->fee_bill_upload_mis_model->getComplete_FamilyFeeInfo($GSID);
				
				$this->load->view('accounts/fee_bill/duplicate_feebill_form');
				$this->load->view('accounts/fee_bill/duplicate_feebill_information');
			}					
		}else{
			$this->load->view('accounts/fee_bill/duplicate_feebill_form');
		}
		
		$this->load->view('accounts/fee_bill/duplicate_feebill_footer_orb');
	}



	public $validation_gsid = array(		
		array('field' => 'gs_id', 'label' => 'GS-ID', 'rules' => 'trim|sanitize|callback_verifyGSID')		
	);



	function verifyGSID($str)
	{
	   $field_value = $str;
	   $GSID = $this->input->post('gs_id');
	   
	   if($GSID == "" || $this->fee_bill_upload_mis_model->checkGSID($GSID) == false)
	   {
	     return FALSE;
	   }
	   else
	   {
	     return TRUE;
	   }
	}



	public function printForm()
	{
		if(count($_POST))
		{
			$FeeBillID = $this->input->post('feebill_id');
			$FeeBillGBID = $this->input->post('feebill_gbid');
			$NewFeeBillGBID = $this->input->post('feebill_new_gbid');
			$BillCycleNo = $this->fee_bill_upload_mis_model->matchBillID_GBID($FeeBillID, $FeeBillGBID);

			if($BillCycleNo > 0)
			{			
				$GSID = substr($FeeBillGBID, 7, 6);
				$ASFrom = 5;
				$ASTo = 6;				
				
				$this->getPDFNow($GSID, $BillCycleNo, $ASFrom, $ASTo, $NewFeeBillGBID);
			}
		}		
	}

	public function getPDFNow($GSID, $BillCycleNo, $ASFrom, $ASTo, $NewBillNo)
	{	
		$this->db_atif_fee = $this->load->database('fee_bill_db', TRUE);
		$this->load->model('accounts/fee_bill/duplicate_feebill_model');
		$data['FeeBill'] = $this->duplicate_feebill_model->getFeeBillOfGSID($GSID, $ASFrom, $ASTo);			

		foreach ($data['FeeBill'] as $FeeBill) {
			if($FeeBill->bill_cycle_no == $BillCycleNo){
				$GradeID = $FeeBill->grade_id;

				$StudentName = $FeeBill->abridged_name;
				$CallName = $FeeBill->call_name;
				$Gender = $FeeBill->gender;
				$GradeName = $FeeBill->grade_name;
				$SectionName = $FeeBill->section_name;
				$WingName = $FeeBill->wing_name;
				$StudentStatus = $FeeBill->student_status_name;
				$GFID = $FeeBill->gf_id;
				$FatherName = $FeeBill->father_name;
				$GTF_Title_L1 = "Tuition Fee";
				$GTF_MA_L1 = number_format($FeeBill->fee_bf);
				$GTF_TA_L1 = number_format(floatval($FeeBill->fee_bf) * floatval($FeeBill->billmonths));

				$GTF_Title_L2 = "Resource Fee";
				$GTF_MA_L2 = number_format($FeeBill->fee_sfs);
				$GTF_TA_L2 = number_format(floatval($FeeBill->fee_sfs) * floatval($FeeBill->billmonths));

				$GTF_Title_L3 = "Musakhar Charges (Multi-Disciplinary Ed Technologies)";
				$GTF_MA_L3 = "750";
				$GTF_TA_L3 = "1,500";

				$GTF_Title_L4 = "GROSS TUITION FEE";
				$GTF_MA_L4 = "16,250";
				$GTF_TA_L4 = "32,500";

				$BD_Title_L1 = "Scholarship";
				$BD_Progress_L1 = "S(AC)85";
				$BD_Tag_L1 = "@";
				$BD_MA_L1 = "100%";
				$BD_TA_L1 = "(32,500)";

				$BD_Title_L2 = "Scholarship2";
				$BD_Progress_L2 = "S(AC)852";
				$BD_Tag_L2 = "@";
				$BD_MA_L2 = "100%";
				$BD_TA_L2 = "(32,500)";

				$OC_Title_L1 = "Sports, Lab, Library, Audio-Visual";
				$OC_MA_L1 = "6,000";
				$OC_TA_L1 = "18,000";

				$OC_Title_L2 = "Sports, Lab, Library, Audio-Visual";
				$OC_MA_L2 = "6,000";
				$OC_TA_L2 = "18,000";

				$OC_Title_L3 = "Sports, Lab, Library, Audio-Visual";
				$OC_MA_L3 = "6,000";
				$OC_TA_L3 = "18,000";

				$OC_Title_L4 = "Sports, Lab, Library, Audio-Visual";
				$OC_MA_L4 = "6,000";
				$OC_TA_L4 = "18,000";

				$OC_Title_L5 = "ADDITIONAL CHARGES";
				$OC_MA_L5 = "";
				$OC_TA_L5 = "72,000";

				$TCB_Title = "TOTAL CURRENT BILLING";
				$TCB_TA = "72,000";

				$TNA_Title_L1 = "Advance Tax to Govt on Parent's Behalf";
				$TNA_t2_L1 = "(adjustable)";
				$TNA_TA_L1 = "";

				$TNA_Title_L2 = "Arrears / Adjustments";
				$TNA_t2_L2 = "";
				$TNA_TA_L2 = "";

				$TP_Title = "TOTAL PAYABLE";
				$TP_SubTitle = "(by due date)";
				$TP_TA = "72,000";

				$LatePayment = "19,050";

				$TuitionFee = $FeeBill->fee_bf;
				$ResourceFee = $FeeBill->fee_sfs;
				$MusakharCharges = $FeeBill->fee_mc;
				$YearlyCharges = $FeeBill->fee_yr;

				$CTC = $FeeBill->total_ctc;
				$CNB = $FeeBill->total_cnb;
				$CFF = $FeeBill->total_cff;
				$CSP = $FeeBill->total_csp;
				$CRR = $FeeBill->total_crr;
				$COT = $FeeBill->total_cot;
				$TotalDiscount = $FeeBill->total_discount;

				$SAC = $FeeBill->total_sac;
				$SNA = $FeeBill->total_sna;
				$TotalScholarship = $FeeBill->total_scholarship;

				$SouthCampusDiscount = $FeeBill->total_south;

				$OC_SmartCard = $FeeBill->oc_smartcard_charges;
				$OC_Magazine = $FeeBill->oc_magazine;

				$BillTitle = $FeeBill->title;
				$IssueDate = $FeeBill->issue_date;
				$DueDate = $FeeBill->due_date;
				$BankValidityDate = $FeeBill->bank_validity_date;
				//$GBID = $FeeBill->gb_id;
				$GBID = $NewBillNo;

				$MinResourceFee = $FeeBill->min_resource_fee;
				$BillAdjustment = $FeeBill->billing_adjustment;
				$FeeBillPayable = $FeeBill->feebill_payable;
			}
		}		


		// Overall Font Size
		$font_size = 10;
		$font_name = 'Arial';
		$gender_mark_size = 26;
		$now_date = date('d-M-Y');

		require_once('components/pdf/fpdf/fpdf.php');
		require_once('components/pdf/fpdi/fpdi.php');

		
		// initiate FPDI
		$pdf = new FPDI();

		// get the page count
		$pageCount = $pdf->setSourceFile('components/pdf/accounts/fee_bill/FeeBill_1509.pdf');
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

	    		// Cell Border on
	    		$bo = 0;

	    		$StartingX = 18.5;
    			$StartingY = 32.5;
    			$lastX = 0;
    			$lastY = 0;

    			$GapY = 94; //Bank Copy
    			$GapY2 = 189; //Parent Copy
    			

	    		/***************** OFFICE COPY *****************/
	    		
	    			////////////// Start Bill Title //////////////

	    			$StartingCW = 30.7;
    				$StartingCH = 4;

		    		// Bill Title
		    		$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'B',5.5);
				    $pdf->SetXY($StartingX, $StartingY);
				    $pdf->Cell($StartingCW, $StartingCH, $BillTitle, $bo, 0, 'C', 0);

				   	////////////// End Bill Title //////////////

	    			////////////// Start Bill Number //////////////

				    $BillNoX = 43;
				    $BillNoY = -3;
	    			$lastX = $StartingX + $BillNoX;
	    			$lastY = $StartingY + $BillNoY;
	    			$CX = 8;
	    			$CY = 4;
	    		
					// Bill # 01
		    		$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',4);
				    $pdf->SetXY($lastX, $lastY+0.12);
				    $pdf->Cell($CX, $CY, 'Bill #', $bo, 0, 'L', 0);

		    		// Bill # 02 (year & month)
		    		$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',5.5);
				    $pdf->SetXY($lastX+$CX-4, $lastY);
				    $pdf->Cell($CX, $CY, substr($GBID,0,7), $bo, 0, 'L', 0);

				    // Bill # 03 (gs_id)
		    		$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'B',5.5);
				    $pdf->SetXY($lastX+($CX*2)-6, $lastY);
				    $pdf->Cell($CX, $CY, $GSID, $bo, 0, 'C', 0);

				    // Bill # 04 (bill type)
		    		$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',5.5);
				    $pdf->SetXY($lastX+($CX*3)-7.5, $lastY);
				    $pdf->Cell($CX, $CY, substr($GBID,14,18), $bo, 0, 'L', 0);

			    	////////////// End Bill Number //////////////

			    	////////////// Start Student Detail //////////////

	    			$SDX = -3.5;
	    			$SDY = 9.5;
	    			$lastX = $lastX + $SDX;
	    			$lastY = $lastY + $SDY;
	    			$CX = 30;
	    			$CY = 4;

	    			if ($Gender == 'B'){
	    				$Gender = 'S/O ';
	    			}else if ($Gender == 'G'){
	    				$Gender = 'D/O ';
	    			}

	    		
					// Student Name
		    		$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'B',6.5);
				    $pdf->SetXY($lastX, $lastY);
				    $pdf->Cell($CX, $CY, strtoupper($StudentName), $bo, 0, 'C', 0);

				    // Gender + Father Name
		    		$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',6);
				    $pdf->SetXY($lastX, $lastY+$CY-0.5);
				    $pdf->Cell($CX, $CY, $Gender.$FatherName, $bo, 0, 'C', 0);

				    // GS-ID 01
		    		$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',4.5);
				    $pdf->SetXY($lastX, $lastY+($CY*2)-1);
				    $pdf->Cell($CX/3, $CY, 'GS ', $bo, 0, 'L', 0);

				    // GS-ID 02
		    		$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'B',4.5);
				    $pdf->SetXY($lastX+1, $lastY+($CY*2)-1);
				    $pdf->Cell($CX/3, $CY, $GSID, $bo, 0, 'C', 0);

				    // Grade & Section
				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'B',6.5);
				    $pdf->SetXY($lastX+($CX/3), $lastY+($CY*2)-1);
				    $pdf->Cell($CX/3, $CY, $GradeName.'-'.$SectionName, $bo, 0, 'C', 0);

				    // GF-ID 01
		    		$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',4.5);
				    $pdf->SetXY($lastX+($CX/1.45), $lastY+($CY*2)-1);
				    $pdf->Cell($CX/3, $CY, 'GF ', $bo, 0, 'L', 0);

				    // GF-ID 02
		    		$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'B',4.5);
				    $pdf->SetXY($lastX+($CX/1.45)+1, $lastY+($CY*2)-1);
				    $pdf->Cell($CX/3, $CY, $GFID, $bo, 0, 'C', 0);

			    	////////////// End Student Detail //////////////

			    	////////////// Start Bill Issue Date //////////////

	    			$SBIX = -43;
	    			$SBIY = 16.5;
	    			$lastX = $lastX + $SBIX;
	    			$lastY = $lastY + $SBIY;
	    			$CX = 17;
	    			$CY = 4;
	    		
	    			// Bill Issue Date
	    			$IssueDate = date_create($IssueDate);
	    			$IssueDate = date_format($IssueDate, "D d M 'y");
		    		$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'B',5.5);
				    $pdf->SetXY($lastX, $lastY);
				    $pdf->Cell($CX, $CY, $IssueDate, $bo, 0, 'C', 0);

				    // Bill Validity Date
	    			$BankValidityDate = date_create($BankValidityDate);
	    			$BankValidityDate = date_format($BankValidityDate, "D d M 'y");
		    		$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'B',6);
				    $pdf->SetXY($lastX+$CX, $lastY);
				    $pdf->Cell($CX+26, $CY, $BankValidityDate, $bo, 0, 'C', 0);

				    // Bill Validity Date
	    			$DueDate = date_create($DueDate);
	    			$DueDate = date_format($DueDate, "D d M 'y");
		    		$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'B',5.5);
				    $pdf->SetXY($lastX+($CX*2)+26, $lastY);
				    $pdf->Cell($CX, $CY, $DueDate, $bo, 0, 'C', 0);

				   	////////////// End Bill Issue Date //////////////

				   	////////////// Start Bill Amount //////////////

				    	////////////// Start Bill Amount LINE 1 //////////////

			    			$SBA_1X = 5;
			    			$SBA_1Y = 22;
			    			$lastX = $lastX + $SBA_1X;
			    			$lastY = $lastY + $SBA_1Y;
			    			$CX = 46;
			    			$CY = 4;
			    		
			    			// Bill Amount Title
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX, $lastY);
						    $pdf->Cell($CX, $CY, $GTF_Title_L1, $bo, 0, 'L', 0);

						    // Bill Amount Monthly
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX+($CX-2), $lastY);
						    $pdf->Cell(($CX/4), $CY, $GTF_MA_L1, $bo, 0, 'C', 0);

						    // Bill Amount total
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX+($CX+($CX/4)), $lastY);
						    $pdf->Cell(($CX/4), $CY, $GTF_TA_L1, $bo, 0, 'C', 0);

				    	////////////// End Bill Amount LINE 1 //////////////

						////////////// Start Bill Amount LINE 2 //////////////

			    			$SBA_1X = 0;
			    			$SBA_1Y = 4;
			    			$lastX = $lastX + $SBA_1X;
			    			$lastY = $lastY + $SBA_1Y;
			    			$CX = 46;
			    			$CY = 4;
			    		
			    			// Bill Amount Title
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX, $lastY);
						    $pdf->Cell($CX, $CY, $GTF_Title_L2, $bo, 0, 'L', 0);

						    // Bill Amount Monthly
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX+($CX-2), $lastY);
						    $pdf->Cell(($CX/4), $CY, $GTF_MA_L2, $bo, 0, 'C', 0);

						    // Bill Amount total
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX+($CX+($CX/4)), $lastY);
						    $pdf->Cell(($CX/4), $CY, $GTF_TA_L2, $bo, 0, 'C', 0);

				    	////////////// End Bill Amount LINE 2 //////////////

					    ////////////// Start Bill Amount LINE 3 //////////////

			    			$SBA_1X = 0;
			    			$SBA_1Y = 4;
			    			$lastX = $lastX + $SBA_1X;
			    			$lastY = $lastY + $SBA_1Y;
			    			$CX = 46;
			    			$CY = 4;
			    		
			    			// Bill Amount Title
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX, $lastY);
						    $pdf->Cell($CX, $CY, $GTF_Title_L3, $bo, 0, 'L', 0);

						    // Bill Amount Monthly
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX+($CX-2), $lastY);
						    $pdf->Cell(($CX/4), $CY, $GTF_MA_L3, $bo, 0, 'C', 0);

						    // Bill Amount total
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX+($CX+($CX/4)), $lastY);
						    $pdf->Cell(($CX/4), $CY, $GTF_TA_L3, $bo, 0, 'C', 0);

				    	////////////// End Bill Amount LINE 3 //////////////

					    ////////////// Start Bill Amount LINE 4 //////////////

			    			$SBA_1X = 0;
			    			$SBA_1Y = 5;
			    			$lastX = $lastX + $SBA_1X;
			    			$lastY = $lastY + $SBA_1Y;
			    			$CX = 46;
			    			$CY = 4;
			    		
			    			// Bill Amount Title
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'B',6.5);
						    $pdf->SetXY($lastX+2, $lastY);
						    $pdf->Cell($CX, $CY, $GTF_Title_L4, $bo, 0, 'L', 0);

						    // Bill Amount Monthly
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6.5);
						    $pdf->SetXY($lastX+($CX-2), $lastY);
						    $pdf->Cell(($CX/4), $CY, $GTF_MA_L4, $bo, 0, 'C', 0);

						    // Bill Amount total);
						    $pdf->SetFont($font_name,'B',6.5);
						    $pdf->SetXY($lastX+($CX+($CX/4)), $lastY);
						    $pdf->Cell(($CX/4), $CY, $GTF_TA_L4, $bo, 0, 'C', 0);

				    	////////////// End Bill Amount LINE 4 //////////////

				   	////////////// End Bill Amount //////////////

				    ////////////// Start Fee Bill Discription //////////////

						////////////// Start Bill Discription LINE 1 //////////////

			    			$SBA_1X = 0;
			    			$SBA_1Y = 4;
			    			$lastX = $lastX + $SBA_1X;
			    			$lastY = $lastY + $SBA_1Y;
			    			$CX = 25;
			    			$CY = 4;
			    		
			    			// Bill Discription Title
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',5.5);
						    $pdf->SetXY($lastX, $lastY);
						    $pdf->Cell($CX, $CY, $BD_Title_L1, $bo, 0, 'L', 0);

						    // Bill Discription Progress
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',5.5);
						    $pdf->SetXY($lastX+$CX, $lastY);
						    $pdf->Cell(($CX/1.7), $CY, $BD_Progress_L1, $bo, 0, 'L', 0);

						    // Bill Discription Tag
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',5.5);
						    $pdf->SetXY($lastX+$CX+($CX/1.7), $lastY);
						    $pdf->Cell($CX/6, $CY, $BD_Tag_L1, $bo, 0, 'C', 0);

						    // Bill Discription Monthly Amount
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',5.5);
						    $pdf->SetXY($lastX+$CX+($CX/1.3), $lastY);
						    $pdf->Cell($CX/2.2, $CY, $BD_MA_L1, $bo, 0, 'C', 0);

						    // Bill Discription Total Amount
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',5.5);
						    $pdf->SetXY($lastX+($CX*2)+7.5, $lastY);
						    $pdf->Cell($CX/2.2, $CY, $BD_TA_L1, $bo, 0, 'C', 0);

				    	////////////// End Bill Discription LINE 1 //////////////

						////////////// Start Bill Discription LINE 2 //////////////

			    			$SBA_1X = 0;
			    			$SBA_1Y = 4;
			    			$lastX = $lastX + $SBA_1X;
			    			$lastY = $lastY + $SBA_1Y;
			    			$CX = 25;
			    			$CY = 4;
			    		
			    			// Bill Discription Title
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',5.5);
						    $pdf->SetXY($lastX, $lastY);
						    $pdf->Cell($CX, $CY, $BD_Title_L2, $bo, 0, 'L', 0);

						    // Bill Discription Progress
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',5.5);
						    $pdf->SetXY($lastX+$CX, $lastY);
						    $pdf->Cell(($CX/1.7), $CY, $BD_Progress_L2, $bo, 0, 'L', 0);

						    // Bill Discription Tag
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',5.5);
						    $pdf->SetXY($lastX+$CX+($CX/1.7), $lastY);
						    $pdf->Cell($CX/6, $CY, $BD_Tag_L2, $bo, 0, 'C', 0);

						    // Bill Discription Monthly Amount
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',5.5);
						    $pdf->SetXY($lastX+$CX+($CX/1.3), $lastY);
						    $pdf->Cell($CX/2.2, $CY, $BD_MA_L2, $bo, 0, 'C', 0);

						    // Bill Discription Total Amount
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',5.5);
						    $pdf->SetXY($lastX+($CX*2)+7.5, $lastY);
						    $pdf->Cell($CX/2.2, $CY, $BD_TA_L1, $bo, 0, 'C', 0);

				    	////////////// End Bill Discription LINE 2 //////////////

					////////////// End Fee Bill Discription //////////////

			    	////////////// Start Fee Bill Other Charges //////////////

						////////////// Start Other Charges LINE 1 //////////////

			    			$SBA_1X = 0;
			    			$SBA_1Y = 7;
			    			$lastX = $lastX + $SBA_1X;
			    			$lastY = $lastY + $SBA_1Y;
			    			$CX = 46;
			    			$CY = 4;
			    		
			    			// Other Amount Title
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX, $lastY);
						    $pdf->Cell($CX, $CY, $OC_Title_L1, $bo, 0, 'L', 0);

						    // Other Amount Monthly
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX+($CX-2), $lastY);
						    $pdf->Cell(($CX/4), $CY, $OC_MA_L1, $bo, 0, 'C', 0);

						    // Other Amount total
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX+($CX+($CX/4)), $lastY);
						    $pdf->Cell(($CX/4), $CY, $OC_TA_L1, $bo, 0, 'C', 0);

			    		////////////// End Other Charges LINE 1 //////////////

					    ////////////// Start Other Charges LINE 2 //////////////

			    			$SBA_1X = 0;
			    			$SBA_1Y = 4;
			    			$lastX = $lastX + $SBA_1X;
			    			$lastY = $lastY + $SBA_1Y;
			    			$CX = 46;
			    			$CY = 4;
			    		
			    			// Other Amount Title
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX, $lastY);
						    $pdf->Cell($CX, $CY, $OC_Title_L2, $bo, 0, 'L', 0);

						    // Other Amount Monthly
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX+($CX-2), $lastY);
						    $pdf->Cell(($CX/4), $CY, $OC_MA_L2, $bo, 0, 'C', 0);

						    // Other Amount total
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX+($CX+($CX/4)), $lastY);
						    $pdf->Cell(($CX/4), $CY, $OC_TA_L2, $bo, 0, 'C', 0);

			    		////////////// End Other Charges LINE 2 //////////////

						////////////// Start Other Charges LINE 3 //////////////

			    			$SBA_1X = 0;
			    			$SBA_1Y = 4;
			    			$lastX = $lastX + $SBA_1X;
			    			$lastY = $lastY + $SBA_1Y;
			    			$CX = 46;
			    			$CY = 4;
			    		
			    			// Other Amount Title
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX, $lastY);
						    $pdf->Cell($CX, $CY, $OC_Title_L3, $bo, 0, 'L', 0);

						    // Other Amount Monthly
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX+($CX-2), $lastY);
						    $pdf->Cell(($CX/4), $CY, $OC_MA_L3, $bo, 0, 'C', 0);

						    // Other Amount total
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX+($CX+($CX/4)), $lastY);
						    $pdf->Cell(($CX/4), $CY, $OC_TA_L3, $bo, 0, 'C', 0);

			    		////////////// End Other Charges LINE 3 //////////////

						////////////// Start Other Charges LINE 4 //////////////

			    			$SBA_1X = 0;
			    			$SBA_1Y = 4;
			    			$lastX = $lastX + $SBA_1X;
			    			$lastY = $lastY + $SBA_1Y;
			    			$CX = 46;
			    			$CY = 4;
			    		
			    			// Other Amount Title
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX, $lastY);
						    $pdf->Cell($CX, $CY, $OC_Title_L4, $bo, 0, 'L', 0);

						    // Other Amount Monthly
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX+($CX-2), $lastY);
						    $pdf->Cell(($CX/4), $CY, $OC_MA_L4, $bo, 0, 'C', 0);

						    // Other Amount total
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX+($CX+($CX/4)), $lastY);
						    $pdf->Cell(($CX/4), $CY, $OC_TA_L4, $bo, 0, 'C', 0);

			    		////////////// End Other Charges LINE 4 //////////////

					    ////////////// Start Other Charges LINE 5 //////////////

			    			$SBA_1X = 0;
			    			$SBA_1Y = 5;
			    			$lastX = $lastX + $SBA_1X;
			    			$lastY = $lastY + $SBA_1Y;
			    			$CX = 46;
			    			$CY = 4;
			    		
			    			// Other Amount Title
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'B',6.5);
						    $pdf->SetXY($lastX, $lastY);
						    $pdf->Cell($CX, $CY, $OC_Title_L5, $bo, 0, 'L', 0);

						    // Other Amount Monthly
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6.5);
						    $pdf->SetXY($lastX+($CX-2), $lastY);
						    $pdf->Cell(($CX/4), $CY, $OC_MA_L5, $bo, 0, 'C', 0);

						    // Other Amount total
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'B',6.5);
						    $pdf->SetXY($lastX+($CX+($CX/4)), $lastY);
						    $pdf->Cell(($CX/4), $CY, $OC_TA_L5, $bo, 0, 'C', 0);

			    		////////////// End Other Charges LINE 5 //////////////

				    ////////////// End Fee Bill Other Charges //////////////

				    ////////////// Start Total Current Bill //////////////

		    			$SBA_1X = -3;
		    			$SBA_1Y = 7.7;
		    			$lastX = $lastX + $SBA_1X;
		    			$lastY = $lastY + $SBA_1Y;
		    			$CX = 46;
		    			$CY = 4;
		    		
		    			// Other Amount Title
			    		$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'B',7);
					    $pdf->SetXY($lastX, $lastY);
					    $pdf->Cell($CX, $CY, $TCB_Title, $bo, 0, 'L', 0);

					    // Other Amount total
			    		$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'B',7);
					    $pdf->SetXY($lastX+($CX+($CX/2.8)), $lastY);
					    $pdf->Cell(($CX/4), $CY, $TCB_TA, $bo, 0, 'C', 0);
			    		
					////////////// End Total Current Bill //////////////

				    ////////////// Start Taxtation and Arrears //////////////

					    ////////////// Start Taxtation LINE 1//////////////

					    	$SBA_1X = 3;
			    			$SBA_1Y = 11;
			    			$lastX = $lastX + $SBA_1X;
			    			$lastY = $lastY + $SBA_1Y;
			    			$CX = 46;
			    			$CY = 4;
			    		
			    			// Other Amount Title
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'B',6);
						    $pdf->SetXY($lastX, $lastY);
						    $pdf->Cell($CX, $CY, $TNA_Title_L1, $bo, 0, 'L', 0);

						    // Other Amount Monthly
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX+($CX-2), $lastY);
						    $pdf->Cell(($CX/4), $CY, $TNA_t2_L1, $bo, 0, 'C', 0);

						    // Other Amount total
						    if ($TNA_TA_L1 == "" OR $TNA_TA_L1 < 0){
						    	$TNA_TA_L1 = "-";
							}

				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'B',6);
						    $pdf->SetXY($lastX+($CX+($CX/4.2)), $lastY);
						    $pdf->Cell(($CX/4), $CY, $TNA_TA_L1, $bo, 0, 'R', 0);

					    ////////////// End Taxtation LINE 1 //////////////

						////////////// Start Arrwears LINE 2//////////////

					    	$SBA_1X = 0;
			    			$SBA_1Y = 7;
			    			$lastX = $lastX + $SBA_1X;
			    			$lastY = $lastY + $SBA_1Y;
			    			$CX = 46;
			    			$CY = 4;
			    		
			    			// Other Amount Title
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'B',6);
						    $pdf->SetXY($lastX, $lastY);
						    $pdf->Cell($CX, $CY, $TNA_Title_L2, $bo, 0, 'L', 0);

						    // Other Amount Monthly
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX+($CX-2), $lastY);
						    $pdf->Cell(($CX/4), $CY, $TNA_t2_L2, $bo, 0, 'C', 0);

						    // Other Amount total
						    if ($TNA_TA_L2 == "" OR $TNA_TA_L2 < 0){
						    	$TNA_TA_L2 = "-";
							}

				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'B',6);
						    $pdf->SetXY($lastX+($CX+($CX/4.2)), $lastY);
						    $pdf->Cell(($CX/4), $CY, $TNA_TA_L2, $bo, 0, 'R', 0);

					    ////////////// End Arrears LINE 2 //////////////

				    ////////////// End Taxtation and Arrears //////////////

					////////////// Start Total Current Bill //////////////

		    			$SBA_1X = -3;
		    			$SBA_1Y = 7.8;
		    			$lastX = $lastX + $SBA_1X;
		    			$lastY = $lastY + $SBA_1Y;
		    			$CX = 46;
		    			$CY = 4;
		    		
		    			// Other Amount Title
			    		$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'B',7);
					    $pdf->SetXY($lastX, $lastY);
					    $pdf->Cell($CX, $CY, $TP_Title, $bo, 0, 'L', 0);
					    
					    // Other Amount Monthly
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetXY($lastX+($CX/2), $lastY);
					    $pdf->Cell(($CX/4), $CY, $TP_SubTitle, $bo, 0, 'C', 0);

					    // Other Amount total
			    		$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'B',7);
					    $pdf->SetXY($lastX+($CX+($CX/2.8)), $lastY);
					    $pdf->Cell(($CX/4), $CY, $TP_TA, $bo, 0, 'R', 0);
			    		
					////////////// End Total Current Bill //////////////

				    ////////////// Start Late Payment //////////////

					    $SBA_1X = 47;
		    			$SBA_1Y = 10.5;
		    			$lastX = $lastX + $SBA_1X;
		    			$lastY = $lastY + $SBA_1Y;
		    			$CX = 10;
		    			$CY = 4;

					     // Late Payment
			    		$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'B',6.5);
					    $pdf->SetXY($lastX+2, $lastY);
					    $pdf->Cell($CX, $CY, $LatePayment, $bo, 0, 'R', 0);


				    ////////////// Start Late Payment //////////////


			    /***************** OFFICE COPY *****************/

			    /***************** Bank COPY *****************/

				$StartingX = 18.5 + $GapY;
    			$StartingY = 32.5;
    			$lastX = 0;
    			$lastY = 0;			    
	    		
	    			////////////// Start Bill Title //////////////

	    			$StartingCW = 30.7;
    				$StartingCH = 4;

		    		// Bill Title
		    		$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'B',5.5);
				    $pdf->SetXY($StartingX, $StartingY);
				    $pdf->Cell($StartingCW, $StartingCH, $BillTitle, $bo, 0, 'C', 0);

				   	////////////// End Bill Title //////////////

	    			////////////// Start Bill Number //////////////

				    $BillNoX = 43;
				    $BillNoY = -3;
	    			$lastX = $StartingX + $BillNoX;
	    			$lastY = $StartingY + $BillNoY;
	    			$CX = 8;
	    			$CY = 4;
	    		
					// Bill # 01
		    		$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',4);
				    $pdf->SetXY($lastX, $lastY+0.12);
				    $pdf->Cell($CX, $CY, 'Bill #', $bo, 0, 'L', 0);

		    		// Bill # 02 (year & month)
		    		$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',5.5);
				    $pdf->SetXY($lastX+$CX-4, $lastY);
				    $pdf->Cell($CX, $CY, substr($GBID,0,7), $bo, 0, 'L', 0);

				    // Bill # 03 (gs_id)
		    		$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'B',5.5);
				    $pdf->SetXY($lastX+($CX*2)-6, $lastY);
				    $pdf->Cell($CX, $CY, $GSID, $bo, 0, 'C', 0);

				    // Bill # 04 (bill type)
		    		$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',5.5);
				    $pdf->SetXY($lastX+($CX*3)-7.5, $lastY);
				    $pdf->Cell($CX, $CY, substr($GBID,14,18), $bo, 0, 'L', 0);

			    	////////////// End Bill Number //////////////

			    	////////////// Start Student Detail //////////////

	    			$SDX = -3.5;
	    			$SDY = 9.5;
	    			$lastX = $lastX + $SDX;
	    			$lastY = $lastY + $SDY;
	    			$CX = 30;
	    			$CY = 4;

	    			if ($Gender == 'B'){
	    				$Gender = 'S/O ';
	    			}else if ($Gender == 'G'){
	    				$Gender = 'D/O ';
	    			}

	    		
					// Student Name
		    		$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'B',6.5);
				    $pdf->SetXY($lastX, $lastY);
				    $pdf->Cell($CX, $CY, strtoupper($StudentName), $bo, 0, 'C', 0);

				    // Gender + Father Name
		    		$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',6);
				    $pdf->SetXY($lastX, $lastY+$CY-0.5);
				    $pdf->Cell($CX, $CY, $Gender.$FatherName, $bo, 0, 'C', 0);

				    // GS-ID 01
		    		$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',4.5);
				    $pdf->SetXY($lastX, $lastY+($CY*2)-1);
				    $pdf->Cell($CX/3, $CY, 'GS ', $bo, 0, 'L', 0);

				    // GS-ID 02
		    		$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'B',4.5);
				    $pdf->SetXY($lastX+1, $lastY+($CY*2)-1);
				    $pdf->Cell($CX/3, $CY, $GSID, $bo, 0, 'C', 0);

				    // Grade & Section
				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'B',6.5);
				    $pdf->SetXY($lastX+($CX/3), $lastY+($CY*2)-1);
				    $pdf->Cell($CX/3, $CY, $GradeName.'-'.$SectionName, $bo, 0, 'C', 0);

				    // GF-ID 01
		    		$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',4.5);
				    $pdf->SetXY($lastX+($CX/1.45), $lastY+($CY*2)-1);
				    $pdf->Cell($CX/3, $CY, 'GF ', $bo, 0, 'L', 0);

				    // GF-ID 02
		    		$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'B',4.5);
				    $pdf->SetXY($lastX+($CX/1.45)+1, $lastY+($CY*2)-1);
				    $pdf->Cell($CX/3, $CY, $GFID, $bo, 0, 'C', 0);

			    	////////////// End Student Detail //////////////

			    	////////////// Start Bill Issue Date //////////////

	    			$SBIX = -43;
	    			$SBIY = 16.5;
	    			$lastX = $lastX + $SBIX;
	    			$lastY = $lastY + $SBIY;
	    			$CX = 17;
	    			$CY = 4;
	    		
	    			// Bill Issue Date
	    			/*$IssueDate = date_create($IssueDate);
	    			$IssueDate = date_format($IssueDate, "D d M 'y");*/
		    		$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'B',5.5);
				    $pdf->SetXY($lastX, $lastY);
				    $pdf->Cell($CX, $CY, $IssueDate, $bo, 0, 'C', 0);

				    // Bill Validity Date
	    			/*$BankValidityDate = date_create($BankValidityDate);
	    			$BankValidityDate = date_format($BankValidityDate, "D d M 'y");*/
		    		$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'B',6);
				    $pdf->SetXY($lastX+$CX, $lastY);
				    $pdf->Cell($CX+26, $CY, $BankValidityDate, $bo, 0, 'C', 0);

				    // Bill Validity Date
	    			/*$DueDate = date_create($DueDate);
	    			$DueDate = date_format($DueDate, "D d M 'y");*/
		    		$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'B',5.5);
				    $pdf->SetXY($lastX+($CX*2)+26, $lastY);
				    $pdf->Cell($CX, $CY, $DueDate, $bo, 0, 'C', 0);

				   	////////////// End Bill Issue Date //////////////

				   	////////////// Start Bill Amount //////////////

				    	////////////// Start Bill Amount LINE 1 //////////////

			    			$SBA_1X = 5;
			    			$SBA_1Y = 22;
			    			$lastX = $lastX + $SBA_1X;
			    			$lastY = $lastY + $SBA_1Y;
			    			$CX = 46;
			    			$CY = 4;
			    		
			    			// Bill Amount Title
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX, $lastY);
						    $pdf->Cell($CX, $CY, $GTF_Title_L1, $bo, 0, 'L', 0);

						    // Bill Amount Monthly
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX+($CX-2), $lastY);
						    $pdf->Cell(($CX/4), $CY, $GTF_MA_L1, $bo, 0, 'C', 0);

						    // Bill Amount total
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX+($CX+($CX/4)), $lastY);
						    $pdf->Cell(($CX/4), $CY, $GTF_TA_L1, $bo, 0, 'C', 0);

				    	////////////// End Bill Amount LINE 1 //////////////

						////////////// Start Bill Amount LINE 2 //////////////

			    			$SBA_1X = 0;
			    			$SBA_1Y = 4;
			    			$lastX = $lastX + $SBA_1X;
			    			$lastY = $lastY + $SBA_1Y;
			    			$CX = 46;
			    			$CY = 4;
			    		
			    			// Bill Amount Title
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX, $lastY);
						    $pdf->Cell($CX, $CY, $GTF_Title_L2, $bo, 0, 'L', 0);

						    // Bill Amount Monthly
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX+($CX-2), $lastY);
						    $pdf->Cell(($CX/4), $CY, $GTF_MA_L2, $bo, 0, 'C', 0);

						    // Bill Amount total
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX+($CX+($CX/4)), $lastY);
						    $pdf->Cell(($CX/4), $CY, $GTF_TA_L2, $bo, 0, 'C', 0);

				    	////////////// End Bill Amount LINE 2 //////////////

					    ////////////// Start Bill Amount LINE 3 //////////////

			    			$SBA_1X = 0;
			    			$SBA_1Y = 4;
			    			$lastX = $lastX + $SBA_1X;
			    			$lastY = $lastY + $SBA_1Y;
			    			$CX = 46;
			    			$CY = 4;
			    		
			    			// Bill Amount Title
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX, $lastY);
						    $pdf->Cell($CX, $CY, $GTF_Title_L3, $bo, 0, 'L', 0);

						    // Bill Amount Monthly
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX+($CX-2), $lastY);
						    $pdf->Cell(($CX/4), $CY, $GTF_MA_L3, $bo, 0, 'C', 0);

						    // Bill Amount total
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX+($CX+($CX/4)), $lastY);
						    $pdf->Cell(($CX/4), $CY, $GTF_TA_L3, $bo, 0, 'C', 0);

				    	////////////// End Bill Amount LINE 3 //////////////

					    ////////////// Start Bill Amount LINE 4 //////////////

			    			$SBA_1X = 0;
			    			$SBA_1Y = 5;
			    			$lastX = $lastX + $SBA_1X;
			    			$lastY = $lastY + $SBA_1Y;
			    			$CX = 46;
			    			$CY = 4;
			    		
			    			// Bill Amount Title
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'B',6.5);
						    $pdf->SetXY($lastX+2, $lastY);
						    $pdf->Cell($CX, $CY, $GTF_Title_L4, $bo, 0, 'L', 0);

						    // Bill Amount Monthly
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6.5);
						    $pdf->SetXY($lastX+($CX-2), $lastY);
						    $pdf->Cell(($CX/4), $CY, $GTF_MA_L4, $bo, 0, 'C', 0);

						    // Bill Amount total);
						    $pdf->SetFont($font_name,'B',6.5);
						    $pdf->SetXY($lastX+($CX+($CX/4)), $lastY);
						    $pdf->Cell(($CX/4), $CY, $GTF_TA_L4, $bo, 0, 'C', 0);

				    	////////////// End Bill Amount LINE 4 //////////////

				   	////////////// End Bill Amount //////////////

				    ////////////// Start Fee Bill Discription //////////////

						////////////// Start Bill Discription LINE 1 //////////////

			    			$SBA_1X = 0;
			    			$SBA_1Y = 4;
			    			$lastX = $lastX + $SBA_1X;
			    			$lastY = $lastY + $SBA_1Y;
			    			$CX = 25;
			    			$CY = 4;
			    		
			    			// Bill Discription Title
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',5.5);
						    $pdf->SetXY($lastX, $lastY);
						    $pdf->Cell($CX, $CY, $BD_Title_L1, $bo, 0, 'L', 0);

						    // Bill Discription Progress
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',5.5);
						    $pdf->SetXY($lastX+$CX, $lastY);
						    $pdf->Cell(($CX/1.7), $CY, $BD_Progress_L1, $bo, 0, 'L', 0);

						    // Bill Discription Tag
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',5.5);
						    $pdf->SetXY($lastX+$CX+($CX/1.7), $lastY);
						    $pdf->Cell($CX/6, $CY, $BD_Tag_L1, $bo, 0, 'C', 0);

						    // Bill Discription Monthly Amount
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',5.5);
						    $pdf->SetXY($lastX+$CX+($CX/1.3), $lastY);
						    $pdf->Cell($CX/2.2, $CY, $BD_MA_L1, $bo, 0, 'C', 0);

						    // Bill Discription Total Amount
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',5.5);
						    $pdf->SetXY($lastX+($CX*2)+7.5, $lastY);
						    $pdf->Cell($CX/2.2, $CY, $BD_TA_L1, $bo, 0, 'C', 0);

				    	////////////// End Bill Discription LINE 1 //////////////

						////////////// Start Bill Discription LINE 2 //////////////

			    			$SBA_1X = 0;
			    			$SBA_1Y = 4;
			    			$lastX = $lastX + $SBA_1X;
			    			$lastY = $lastY + $SBA_1Y;
			    			$CX = 25;
			    			$CY = 4;
			    		
			    			// Bill Discription Title
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',5.5);
						    $pdf->SetXY($lastX, $lastY);
						    $pdf->Cell($CX, $CY, $BD_Title_L2, $bo, 0, 'L', 0);

						    // Bill Discription Progress
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',5.5);
						    $pdf->SetXY($lastX+$CX, $lastY);
						    $pdf->Cell(($CX/1.7), $CY, $BD_Progress_L2, $bo, 0, 'L', 0);

						    // Bill Discription Tag
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',5.5);
						    $pdf->SetXY($lastX+$CX+($CX/1.7), $lastY);
						    $pdf->Cell($CX/6, $CY, $BD_Tag_L2, $bo, 0, 'C', 0);

						    // Bill Discription Monthly Amount
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',5.5);
						    $pdf->SetXY($lastX+$CX+($CX/1.3), $lastY);
						    $pdf->Cell($CX/2.2, $CY, $BD_MA_L2, $bo, 0, 'C', 0);

						    // Bill Discription Total Amount
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',5.5);
						    $pdf->SetXY($lastX+($CX*2)+7.5, $lastY);
						    $pdf->Cell($CX/2.2, $CY, $BD_TA_L1, $bo, 0, 'C', 0);

				    	////////////// End Bill Discription LINE 2 //////////////

					////////////// End Fee Bill Discription //////////////

			    	////////////// Start Fee Bill Other Charges //////////////

						////////////// Start Other Charges LINE 1 //////////////

			    			$SBA_1X = 0;
			    			$SBA_1Y = 7;
			    			$lastX = $lastX + $SBA_1X;
			    			$lastY = $lastY + $SBA_1Y;
			    			$CX = 46;
			    			$CY = 4;
			    		
			    			// Other Amount Title
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX, $lastY);
						    $pdf->Cell($CX, $CY, $OC_Title_L1, $bo, 0, 'L', 0);

						    // Other Amount Monthly
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX+($CX-2), $lastY);
						    $pdf->Cell(($CX/4), $CY, $OC_MA_L1, $bo, 0, 'C', 0);

						    // Other Amount total
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX+($CX+($CX/4)), $lastY);
						    $pdf->Cell(($CX/4), $CY, $OC_TA_L1, $bo, 0, 'C', 0);

			    		////////////// End Other Charges LINE 1 //////////////

					    ////////////// Start Other Charges LINE 2 //////////////

			    			$SBA_1X = 0;
			    			$SBA_1Y = 4;
			    			$lastX = $lastX + $SBA_1X;
			    			$lastY = $lastY + $SBA_1Y;
			    			$CX = 46;
			    			$CY = 4;
			    		
			    			// Other Amount Title
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX, $lastY);
						    $pdf->Cell($CX, $CY, $OC_Title_L2, $bo, 0, 'L', 0);

						    // Other Amount Monthly
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX+($CX-2), $lastY);
						    $pdf->Cell(($CX/4), $CY, $OC_MA_L2, $bo, 0, 'C', 0);

						    // Other Amount total
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX+($CX+($CX/4)), $lastY);
						    $pdf->Cell(($CX/4), $CY, $OC_TA_L2, $bo, 0, 'C', 0);

			    		////////////// End Other Charges LINE 2 //////////////

						////////////// Start Other Charges LINE 3 //////////////

			    			$SBA_1X = 0;
			    			$SBA_1Y = 4;
			    			$lastX = $lastX + $SBA_1X;
			    			$lastY = $lastY + $SBA_1Y;
			    			$CX = 46;
			    			$CY = 4;
			    		
			    			// Other Amount Title
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX, $lastY);
						    $pdf->Cell($CX, $CY, $OC_Title_L3, $bo, 0, 'L', 0);

						    // Other Amount Monthly
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX+($CX-2), $lastY);
						    $pdf->Cell(($CX/4), $CY, $OC_MA_L3, $bo, 0, 'C', 0);

						    // Other Amount total
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX+($CX+($CX/4)), $lastY);
						    $pdf->Cell(($CX/4), $CY, $OC_TA_L3, $bo, 0, 'C', 0);

			    		////////////// End Other Charges LINE 3 //////////////

						////////////// Start Other Charges LINE 4 //////////////

			    			$SBA_1X = 0;
			    			$SBA_1Y = 4;
			    			$lastX = $lastX + $SBA_1X;
			    			$lastY = $lastY + $SBA_1Y;
			    			$CX = 46;
			    			$CY = 4;
			    		
			    			// Other Amount Title
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX, $lastY);
						    $pdf->Cell($CX, $CY, $OC_Title_L4, $bo, 0, 'L', 0);

						    // Other Amount Monthly
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX+($CX-2), $lastY);
						    $pdf->Cell(($CX/4), $CY, $OC_MA_L4, $bo, 0, 'C', 0);

						    // Other Amount total
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX+($CX+($CX/4)), $lastY);
						    $pdf->Cell(($CX/4), $CY, $OC_TA_L4, $bo, 0, 'C', 0);

			    		////////////// End Other Charges LINE 4 //////////////

					    ////////////// Start Other Charges LINE 5 //////////////

			    			$SBA_1X = 0;
			    			$SBA_1Y = 5;
			    			$lastX = $lastX + $SBA_1X;
			    			$lastY = $lastY + $SBA_1Y;
			    			$CX = 46;
			    			$CY = 4;
			    		
			    			// Other Amount Title
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'B',6.5);
						    $pdf->SetXY($lastX, $lastY);
						    $pdf->Cell($CX, $CY, $OC_Title_L5, $bo, 0, 'L', 0);

						    // Other Amount Monthly
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6.5);
						    $pdf->SetXY($lastX+($CX-2), $lastY);
						    $pdf->Cell(($CX/4), $CY, $OC_MA_L5, $bo, 0, 'C', 0);

						    // Other Amount total
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'B',6.5);
						    $pdf->SetXY($lastX+($CX+($CX/4)), $lastY);
						    $pdf->Cell(($CX/4), $CY, $OC_TA_L5, $bo, 0, 'C', 0);

			    		////////////// End Other Charges LINE 5 //////////////

				    ////////////// End Fee Bill Other Charges //////////////

				    ////////////// Start Total Current Bill //////////////

		    			$SBA_1X = -3;
		    			$SBA_1Y = 7.7;
		    			$lastX = $lastX + $SBA_1X;
		    			$lastY = $lastY + $SBA_1Y;
		    			$CX = 46;
		    			$CY = 4;
		    		
		    			// Other Amount Title
			    		$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'B',7);
					    $pdf->SetXY($lastX, $lastY);
					    $pdf->Cell($CX, $CY, $TCB_Title, $bo, 0, 'L', 0);

					    // Other Amount total
			    		$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'B',7);
					    $pdf->SetXY($lastX+($CX+($CX/2.8)), $lastY);
					    $pdf->Cell(($CX/4), $CY, $TCB_TA, $bo, 0, 'C', 0);
			    		
					////////////// End Total Current Bill //////////////

				    ////////////// Start Taxtation and Arrears //////////////

					    ////////////// Start Taxtation LINE 1//////////////

					    	$SBA_1X = 3;
			    			$SBA_1Y = 11;
			    			$lastX = $lastX + $SBA_1X;
			    			$lastY = $lastY + $SBA_1Y;
			    			$CX = 46;
			    			$CY = 4;
			    		
			    			// Other Amount Title
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'B',6);
						    $pdf->SetXY($lastX, $lastY);
						    $pdf->Cell($CX, $CY, $TNA_Title_L1, $bo, 0, 'L', 0);

						    // Other Amount Monthly
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX+($CX-2), $lastY);
						    $pdf->Cell(($CX/4), $CY, $TNA_t2_L1, $bo, 0, 'C', 0);

						    // Other Amount total
						    if ($TNA_TA_L1 == "" OR $TNA_TA_L1 < 0){
						    	$TNA_TA_L1 = "-";
							}

				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'B',6);
						    $pdf->SetXY($lastX+($CX+($CX/4.2)), $lastY);
						    $pdf->Cell(($CX/4), $CY, $TNA_TA_L1, $bo, 0, 'R', 0);

					    ////////////// End Taxtation LINE 1 //////////////

						////////////// Start Arrwears LINE 2//////////////

					    	$SBA_1X = 0;
			    			$SBA_1Y = 7;
			    			$lastX = $lastX + $SBA_1X;
			    			$lastY = $lastY + $SBA_1Y;
			    			$CX = 46;
			    			$CY = 4;
			    		
			    			// Other Amount Title
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'B',6);
						    $pdf->SetXY($lastX, $lastY);
						    $pdf->Cell($CX, $CY, $TNA_Title_L2, $bo, 0, 'L', 0);

						    // Other Amount Monthly
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX+($CX-2), $lastY);
						    $pdf->Cell(($CX/4), $CY, $TNA_t2_L2, $bo, 0, 'C', 0);

						    // Other Amount total
						    if ($TNA_TA_L2 == "" OR $TNA_TA_L2 < 0){
						    	$TNA_TA_L2 = "-";
							}

				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'B',6);
						    $pdf->SetXY($lastX+($CX+($CX/4.2)), $lastY);
						    $pdf->Cell(($CX/4), $CY, $TNA_TA_L2, $bo, 0, 'R', 0);

					    ////////////// End Arrears LINE 2 //////////////

				    ////////////// End Taxtation and Arrears //////////////

					////////////// Start Total Current Bill //////////////

		    			$SBA_1X = -3;
		    			$SBA_1Y = 7.8;
		    			$lastX = $lastX + $SBA_1X;
		    			$lastY = $lastY + $SBA_1Y;
		    			$CX = 46;
		    			$CY = 4;
		    		
		    			// Other Amount Title
			    		$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'B',7);
					    $pdf->SetXY($lastX, $lastY);
					    $pdf->Cell($CX, $CY, $TP_Title, $bo, 0, 'L', 0);
					    
					    // Other Amount Monthly
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetXY($lastX+($CX/2), $lastY);
					    $pdf->Cell(($CX/4), $CY, $TP_SubTitle, $bo, 0, 'C', 0);

					    // Other Amount total
			    		$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'B',7);
					    $pdf->SetXY($lastX+($CX+($CX/2.8)), $lastY);
					    $pdf->Cell(($CX/4), $CY, $TP_TA, $bo, 0, 'R', 0);
			    		
					////////////// End Total Current Bill //////////////

				    ////////////// Start Late Payment //////////////

					    $SBA_1X = 47;
		    			$SBA_1Y = 10.5;
		    			$lastX = $lastX + $SBA_1X;
		    			$lastY = $lastY + $SBA_1Y;
		    			$CX = 10;
		    			$CY = 4;

					     // Late Payment
			    		$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'B',6.5);
					    $pdf->SetXY($lastX+2, $lastY);
					    $pdf->Cell($CX, $CY, $LatePayment, $bo, 0, 'R', 0);


				    ////////////// Start Late Payment //////////////


			    /***************** Bank COPY *****************/

			    /***************** Parent COPY *****************/

				$StartingX = 18.5 + $GapY2;
    			$StartingY = 32.5;
    			$lastX = 0;
    			$lastY = 0;			    
	    		
	    			////////////// Start Bill Title //////////////

	    			$StartingCW = 30.7;
    				$StartingCH = 4;

		    		// Bill Title
		    		$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'B',5.5);
				    $pdf->SetXY($StartingX, $StartingY);
				    $pdf->Cell($StartingCW, $StartingCH, $BillTitle, $bo, 0, 'C', 0);

				   	////////////// End Bill Title //////////////

	    			////////////// Start Bill Number //////////////

				    $BillNoX = 43;
				    $BillNoY = -3;
	    			$lastX = $StartingX + $BillNoX;
	    			$lastY = $StartingY + $BillNoY;
	    			$CX = 8;
	    			$CY = 4;
	    		
					// Bill # 01
		    		$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',4);
				    $pdf->SetXY($lastX, $lastY+0.12);
				    $pdf->Cell($CX, $CY, 'Bill #', $bo, 0, 'L', 0);

		    		// Bill # 02 (year & month)
		    		$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',5.5);
				    $pdf->SetXY($lastX+$CX-4, $lastY);
				    $pdf->Cell($CX, $CY, substr($GBID,0,7), $bo, 0, 'L', 0);

				    // Bill # 03 (gs_id)
		    		$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'B',5.5);
				    $pdf->SetXY($lastX+($CX*2)-6, $lastY);
				    $pdf->Cell($CX, $CY, $GSID, $bo, 0, 'C', 0);

				    // Bill # 04 (bill type)
		    		$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',5.5);
				    $pdf->SetXY($lastX+($CX*3)-7.5, $lastY);
				    $pdf->Cell($CX, $CY, substr($GBID,14,18), $bo, 0, 'L', 0);

			    	////////////// End Bill Number //////////////

			    	////////////// Start Student Detail //////////////

	    			$SDX = -3.5;
	    			$SDY = 9.5;
	    			$lastX = $lastX + $SDX;
	    			$lastY = $lastY + $SDY;
	    			$CX = 30;
	    			$CY = 4;

	    			if ($Gender == 'B'){
	    				$Gender = 'S/O ';
	    			}else if ($Gender == 'G'){
	    				$Gender = 'D/O ';
	    			}

	    		
					// Student Name
		    		$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'B',6.5);
				    $pdf->SetXY($lastX, $lastY);
				    $pdf->Cell($CX, $CY, strtoupper($StudentName), $bo, 0, 'C', 0);

				    // Gender + Father Name
		    		$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',6);
				    $pdf->SetXY($lastX, $lastY+$CY-0.5);
				    $pdf->Cell($CX, $CY, $Gender.$FatherName, $bo, 0, 'C', 0);

				    // GS-ID 01
		    		$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',4.5);
				    $pdf->SetXY($lastX, $lastY+($CY*2)-1);
				    $pdf->Cell($CX/3, $CY, 'GS ', $bo, 0, 'L', 0);

				    // GS-ID 02
		    		$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'B',4.5);
				    $pdf->SetXY($lastX+1, $lastY+($CY*2)-1);
				    $pdf->Cell($CX/3, $CY, $GSID, $bo, 0, 'C', 0);

				    // Grade & Section
				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'B',6.5);
				    $pdf->SetXY($lastX+($CX/3), $lastY+($CY*2)-1);
				    $pdf->Cell($CX/3, $CY, $GradeName.'-'.$SectionName, $bo, 0, 'C', 0);

				    // GF-ID 01
		    		$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',4.5);
				    $pdf->SetXY($lastX+($CX/1.45), $lastY+($CY*2)-1);
				    $pdf->Cell($CX/3, $CY, 'GF ', $bo, 0, 'L', 0);

				    // GF-ID 02
		    		$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'B',4.5);
				    $pdf->SetXY($lastX+($CX/1.45)+1, $lastY+($CY*2)-1);
				    $pdf->Cell($CX/3, $CY, $GFID, $bo, 0, 'C', 0);

			    	////////////// End Student Detail //////////////

			    	////////////// Start Bill Issue Date //////////////

	    			$SBIX = -43;
	    			$SBIY = 16.5;
	    			$lastX = $lastX + $SBIX;
	    			$lastY = $lastY + $SBIY;
	    			$CX = 17;
	    			$CY = 4;
	    		
	    			// Bill Issue Date
	    			/*$IssueDate = date_create($IssueDate);
	    			$IssueDate = date_format($IssueDate, "D d M 'y");*/
		    		$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'B',5.5);
				    $pdf->SetXY($lastX, $lastY);
				    $pdf->Cell($CX, $CY, $IssueDate, $bo, 0, 'C', 0);

				    // Bill Validity Date
	    			/*$BankValidityDate = date_create($BankValidityDate);
	    			$BankValidityDate = date_format($BankValidityDate, "D d M 'y");*/
		    		$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'B',6);
				    $pdf->SetXY($lastX+$CX, $lastY);
				    $pdf->Cell($CX+26, $CY, $BankValidityDate, $bo, 0, 'C', 0);

				    // Bill Validity Date
	    			/*$DueDate = date_create($DueDate);
	    			$DueDate = date_format($DueDate, "D d M 'y");*/
		    		$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'B',5.5);
				    $pdf->SetXY($lastX+($CX*2)+26, $lastY);
				    $pdf->Cell($CX, $CY, $DueDate, $bo, 0, 'C', 0);

				   	////////////// End Bill Issue Date //////////////

				   	////////////// Start Bill Amount //////////////

				    	////////////// Start Bill Amount LINE 1 //////////////

			    			$SBA_1X = 5;
			    			$SBA_1Y = 22;
			    			$lastX = $lastX + $SBA_1X;
			    			$lastY = $lastY + $SBA_1Y;
			    			$CX = 46;
			    			$CY = 4;
			    		
			    			// Bill Amount Title
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX, $lastY);
						    $pdf->Cell($CX, $CY, $GTF_Title_L1, $bo, 0, 'L', 0);

						    // Bill Amount Monthly
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX+($CX-2), $lastY);
						    $pdf->Cell(($CX/4), $CY, $GTF_MA_L1, $bo, 0, 'C', 0);

						    // Bill Amount total
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX+($CX+($CX/4)), $lastY);
						    $pdf->Cell(($CX/4), $CY, $GTF_TA_L1, $bo, 0, 'C', 0);

				    	////////////// End Bill Amount LINE 1 //////////////

						////////////// Start Bill Amount LINE 2 //////////////

			    			$SBA_1X = 0;
			    			$SBA_1Y = 4;
			    			$lastX = $lastX + $SBA_1X;
			    			$lastY = $lastY + $SBA_1Y;
			    			$CX = 46;
			    			$CY = 4;
			    		
			    			// Bill Amount Title
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX, $lastY);
						    $pdf->Cell($CX, $CY, $GTF_Title_L2, $bo, 0, 'L', 0);

						    // Bill Amount Monthly
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX+($CX-2), $lastY);
						    $pdf->Cell(($CX/4), $CY, $GTF_MA_L2, $bo, 0, 'C', 0);

						    // Bill Amount total
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX+($CX+($CX/4)), $lastY);
						    $pdf->Cell(($CX/4), $CY, $GTF_TA_L2, $bo, 0, 'C', 0);

				    	////////////// End Bill Amount LINE 2 //////////////

					    ////////////// Start Bill Amount LINE 3 //////////////

			    			$SBA_1X = 0;
			    			$SBA_1Y = 4;
			    			$lastX = $lastX + $SBA_1X;
			    			$lastY = $lastY + $SBA_1Y;
			    			$CX = 46;
			    			$CY = 4;
			    		
			    			// Bill Amount Title
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX, $lastY);
						    $pdf->Cell($CX, $CY, $GTF_Title_L3, $bo, 0, 'L', 0);

						    // Bill Amount Monthly
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX+($CX-2), $lastY);
						    $pdf->Cell(($CX/4), $CY, $GTF_MA_L3, $bo, 0, 'C', 0);

						    // Bill Amount total
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX+($CX+($CX/4)), $lastY);
						    $pdf->Cell(($CX/4), $CY, $GTF_TA_L3, $bo, 0, 'C', 0);

				    	////////////// End Bill Amount LINE 3 //////////////

					    ////////////// Start Bill Amount LINE 4 //////////////

			    			$SBA_1X = 0;
			    			$SBA_1Y = 5;
			    			$lastX = $lastX + $SBA_1X;
			    			$lastY = $lastY + $SBA_1Y;
			    			$CX = 46;
			    			$CY = 4;
			    		
			    			// Bill Amount Title
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'B',6.5);
						    $pdf->SetXY($lastX+2, $lastY);
						    $pdf->Cell($CX, $CY, $GTF_Title_L4, $bo, 0, 'L', 0);

						    // Bill Amount Monthly
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6.5);
						    $pdf->SetXY($lastX+($CX-2), $lastY);
						    $pdf->Cell(($CX/4), $CY, $GTF_MA_L4, $bo, 0, 'C', 0);

						    // Bill Amount total);
						    $pdf->SetFont($font_name,'B',6.5);
						    $pdf->SetXY($lastX+($CX+($CX/4)), $lastY);
						    $pdf->Cell(($CX/4), $CY, $GTF_TA_L4, $bo, 0, 'C', 0);

				    	////////////// End Bill Amount LINE 4 //////////////

				   	////////////// End Bill Amount //////////////

				    ////////////// Start Fee Bill Discription //////////////

						////////////// Start Bill Discription LINE 1 //////////////

			    			$SBA_1X = 0;
			    			$SBA_1Y = 4;
			    			$lastX = $lastX + $SBA_1X;
			    			$lastY = $lastY + $SBA_1Y;
			    			$CX = 25;
			    			$CY = 4;
			    		
			    			// Bill Discription Title
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',5.5);
						    $pdf->SetXY($lastX, $lastY);
						    $pdf->Cell($CX, $CY, $BD_Title_L1, $bo, 0, 'L', 0);

						    // Bill Discription Progress
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',5.5);
						    $pdf->SetXY($lastX+$CX, $lastY);
						    $pdf->Cell(($CX/1.7), $CY, $BD_Progress_L1, $bo, 0, 'L', 0);

						    // Bill Discription Tag
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',5.5);
						    $pdf->SetXY($lastX+$CX+($CX/1.7), $lastY);
						    $pdf->Cell($CX/6, $CY, $BD_Tag_L1, $bo, 0, 'C', 0);

						    // Bill Discription Monthly Amount
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',5.5);
						    $pdf->SetXY($lastX+$CX+($CX/1.3), $lastY);
						    $pdf->Cell($CX/2.2, $CY, $BD_MA_L1, $bo, 0, 'C', 0);

						    // Bill Discription Total Amount
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',5.5);
						    $pdf->SetXY($lastX+($CX*2)+7.5, $lastY);
						    $pdf->Cell($CX/2.2, $CY, $BD_TA_L1, $bo, 0, 'C', 0);

				    	////////////// End Bill Discription LINE 1 //////////////

						////////////// Start Bill Discription LINE 2 //////////////

			    			$SBA_1X = 0;
			    			$SBA_1Y = 4;
			    			$lastX = $lastX + $SBA_1X;
			    			$lastY = $lastY + $SBA_1Y;
			    			$CX = 25;
			    			$CY = 4;
			    		
			    			// Bill Discription Title
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',5.5);
						    $pdf->SetXY($lastX, $lastY);
						    $pdf->Cell($CX, $CY, $BD_Title_L2, $bo, 0, 'L', 0);

						    // Bill Discription Progress
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',5.5);
						    $pdf->SetXY($lastX+$CX, $lastY);
						    $pdf->Cell(($CX/1.7), $CY, $BD_Progress_L2, $bo, 0, 'L', 0);

						    // Bill Discription Tag
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',5.5);
						    $pdf->SetXY($lastX+$CX+($CX/1.7), $lastY);
						    $pdf->Cell($CX/6, $CY, $BD_Tag_L2, $bo, 0, 'C', 0);

						    // Bill Discription Monthly Amount
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',5.5);
						    $pdf->SetXY($lastX+$CX+($CX/1.3), $lastY);
						    $pdf->Cell($CX/2.2, $CY, $BD_MA_L2, $bo, 0, 'C', 0);

						    // Bill Discription Total Amount
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',5.5);
						    $pdf->SetXY($lastX+($CX*2)+7.5, $lastY);
						    $pdf->Cell($CX/2.2, $CY, $BD_TA_L1, $bo, 0, 'C', 0);

				    	////////////// End Bill Discription LINE 2 //////////////

					////////////// End Fee Bill Discription //////////////

			    	////////////// Start Fee Bill Other Charges //////////////

						////////////// Start Other Charges LINE 1 //////////////

			    			$SBA_1X = 0;
			    			$SBA_1Y = 7;
			    			$lastX = $lastX + $SBA_1X;
			    			$lastY = $lastY + $SBA_1Y;
			    			$CX = 46;
			    			$CY = 4;
			    		
			    			// Other Amount Title
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX, $lastY);
						    $pdf->Cell($CX, $CY, $OC_Title_L1, $bo, 0, 'L', 0);

						    // Other Amount Monthly
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX+($CX-2), $lastY);
						    $pdf->Cell(($CX/4), $CY, $OC_MA_L1, $bo, 0, 'C', 0);

						    // Other Amount total
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX+($CX+($CX/4)), $lastY);
						    $pdf->Cell(($CX/4), $CY, $OC_TA_L1, $bo, 0, 'C', 0);

			    		////////////// End Other Charges LINE 1 //////////////

					    ////////////// Start Other Charges LINE 2 //////////////

			    			$SBA_1X = 0;
			    			$SBA_1Y = 4;
			    			$lastX = $lastX + $SBA_1X;
			    			$lastY = $lastY + $SBA_1Y;
			    			$CX = 46;
			    			$CY = 4;
			    		
			    			// Other Amount Title
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX, $lastY);
						    $pdf->Cell($CX, $CY, $OC_Title_L2, $bo, 0, 'L', 0);

						    // Other Amount Monthly
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX+($CX-2), $lastY);
						    $pdf->Cell(($CX/4), $CY, $OC_MA_L2, $bo, 0, 'C', 0);

						    // Other Amount total
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX+($CX+($CX/4)), $lastY);
						    $pdf->Cell(($CX/4), $CY, $OC_TA_L2, $bo, 0, 'C', 0);

			    		////////////// End Other Charges LINE 2 //////////////

						////////////// Start Other Charges LINE 3 //////////////

			    			$SBA_1X = 0;
			    			$SBA_1Y = 4;
			    			$lastX = $lastX + $SBA_1X;
			    			$lastY = $lastY + $SBA_1Y;
			    			$CX = 46;
			    			$CY = 4;
			    		
			    			// Other Amount Title
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX, $lastY);
						    $pdf->Cell($CX, $CY, $OC_Title_L3, $bo, 0, 'L', 0);

						    // Other Amount Monthly
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX+($CX-2), $lastY);
						    $pdf->Cell(($CX/4), $CY, $OC_MA_L3, $bo, 0, 'C', 0);

						    // Other Amount total
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX+($CX+($CX/4)), $lastY);
						    $pdf->Cell(($CX/4), $CY, $OC_TA_L3, $bo, 0, 'C', 0);

			    		////////////// End Other Charges LINE 3 //////////////

						////////////// Start Other Charges LINE 4 //////////////

			    			$SBA_1X = 0;
			    			$SBA_1Y = 4;
			    			$lastX = $lastX + $SBA_1X;
			    			$lastY = $lastY + $SBA_1Y;
			    			$CX = 46;
			    			$CY = 4;
			    		
			    			// Other Amount Title
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX, $lastY);
						    $pdf->Cell($CX, $CY, $OC_Title_L4, $bo, 0, 'L', 0);

						    // Other Amount Monthly
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX+($CX-2), $lastY);
						    $pdf->Cell(($CX/4), $CY, $OC_MA_L4, $bo, 0, 'C', 0);

						    // Other Amount total
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX+($CX+($CX/4)), $lastY);
						    $pdf->Cell(($CX/4), $CY, $OC_TA_L4, $bo, 0, 'C', 0);

			    		////////////// End Other Charges LINE 4 //////////////

					    ////////////// Start Other Charges LINE 5 //////////////

			    			$SBA_1X = 0;
			    			$SBA_1Y = 5;
			    			$lastX = $lastX + $SBA_1X;
			    			$lastY = $lastY + $SBA_1Y;
			    			$CX = 46;
			    			$CY = 4;
			    		
			    			// Other Amount Title
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'B',6.5);
						    $pdf->SetXY($lastX, $lastY);
						    $pdf->Cell($CX, $CY, $OC_Title_L5, $bo, 0, 'L', 0);

						    // Other Amount Monthly
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6.5);
						    $pdf->SetXY($lastX+($CX-2), $lastY);
						    $pdf->Cell(($CX/4), $CY, $OC_MA_L5, $bo, 0, 'C', 0);

						    // Other Amount total
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'B',6.5);
						    $pdf->SetXY($lastX+($CX+($CX/4)), $lastY);
						    $pdf->Cell(($CX/4), $CY, $OC_TA_L5, $bo, 0, 'C', 0);

			    		////////////// End Other Charges LINE 5 //////////////

				    ////////////// End Fee Bill Other Charges //////////////

				    ////////////// Start Total Current Bill //////////////

		    			$SBA_1X = -3;
		    			$SBA_1Y = 7.7;
		    			$lastX = $lastX + $SBA_1X;
		    			$lastY = $lastY + $SBA_1Y;
		    			$CX = 46;
		    			$CY = 4;
		    		
		    			// Other Amount Title
			    		$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'B',7);
					    $pdf->SetXY($lastX, $lastY);
					    $pdf->Cell($CX, $CY, $TCB_Title, $bo, 0, 'L', 0);

					    // Other Amount total
			    		$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'B',7);
					    $pdf->SetXY($lastX+($CX+($CX/2.8)), $lastY);
					    $pdf->Cell(($CX/4), $CY, $TCB_TA, $bo, 0, 'C', 0);
			    		
					////////////// End Total Current Bill //////////////

				    ////////////// Start Taxtation and Arrears //////////////

					    ////////////// Start Taxtation LINE 1//////////////

					    	$SBA_1X = 3;
			    			$SBA_1Y = 11;
			    			$lastX = $lastX + $SBA_1X;
			    			$lastY = $lastY + $SBA_1Y;
			    			$CX = 46;
			    			$CY = 4;
			    		
			    			// Other Amount Title
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'B',6);
						    $pdf->SetXY($lastX, $lastY);
						    $pdf->Cell($CX, $CY, $TNA_Title_L1, $bo, 0, 'L', 0);

						    // Other Amount Monthly
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX+($CX-2), $lastY);
						    $pdf->Cell(($CX/4), $CY, $TNA_t2_L1, $bo, 0, 'C', 0);

						    // Other Amount total
						    if ($TNA_TA_L1 == "" OR $TNA_TA_L1 < 0){
						    	$TNA_TA_L1 = "-";
							}

				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'B',6);
						    $pdf->SetXY($lastX+($CX+($CX/4.2)), $lastY);
						    $pdf->Cell(($CX/4), $CY, $TNA_TA_L1, $bo, 0, 'R', 0);

					    ////////////// End Taxtation LINE 1 //////////////

						////////////// Start Arrwears LINE 2//////////////

					    	$SBA_1X = 0;
			    			$SBA_1Y = 7;
			    			$lastX = $lastX + $SBA_1X;
			    			$lastY = $lastY + $SBA_1Y;
			    			$CX = 46;
			    			$CY = 4;
			    		
			    			// Other Amount Title
				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'B',6);
						    $pdf->SetXY($lastX, $lastY);
						    $pdf->Cell($CX, $CY, $TNA_Title_L2, $bo, 0, 'L', 0);

						    // Other Amount Monthly
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetXY($lastX+($CX-2), $lastY);
						    $pdf->Cell(($CX/4), $CY, $TNA_t2_L2, $bo, 0, 'C', 0);

						    // Other Amount total
						    if ($TNA_TA_L2 == "" OR $TNA_TA_L2 < 0){
						    	$TNA_TA_L2 = "-";
							}

				    		$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'B',6);
						    $pdf->SetXY($lastX+($CX+($CX/4.2)), $lastY);
						    $pdf->Cell(($CX/4), $CY, $TNA_TA_L2, $bo, 0, 'R', 0);

					    ////////////// End Arrears LINE 2 //////////////

				    ////////////// End Taxtation and Arrears //////////////

					////////////// Start Total Current Bill //////////////

		    			$SBA_1X = -3;
		    			$SBA_1Y = 7.8;
		    			$lastX = $lastX + $SBA_1X;
		    			$lastY = $lastY + $SBA_1Y;
		    			$CX = 46;
		    			$CY = 4;
		    		
		    			// Other Amount Title
			    		$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'B',7);
					    $pdf->SetXY($lastX, $lastY);
					    $pdf->Cell($CX, $CY, $TP_Title, $bo, 0, 'L', 0);
					    
					    // Other Amount Monthly
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetXY($lastX+($CX/2), $lastY);
					    $pdf->Cell(($CX/4), $CY, $TP_SubTitle, $bo, 0, 'C', 0);

					    // Other Amount total
			    		$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'B',7);
					    $pdf->SetXY($lastX+($CX+($CX/2.8)), $lastY);
					    $pdf->Cell(($CX/4), $CY, $TP_TA, $bo, 0, 'R', 0);
			    		
					////////////// End Total Current Bill //////////////

				    ////////////// Start Late Payment //////////////

					    $SBA_1X = 47;
		    			$SBA_1Y = 10.5;
		    			$lastX = $lastX + $SBA_1X;
		    			$lastY = $lastY + $SBA_1Y;
		    			$CX = 10;
		    			$CY = 4;

					     // Late Payment
			    		$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'B',6.5);
					    $pdf->SetXY($lastX+2, $lastY);
					    $pdf->Cell($CX, $CY, $LatePayment, $bo, 0, 'R', 0);


				    ////////////// Start Late Payment //////////////


			    /***************** Parent COPY *****************/
			}
		}

		// Output the new PDF
		$pdf->Output($GSID . '_' . $BillCycleNo . '.pdf', 'I');
		//$pdf->Output();

	}
}