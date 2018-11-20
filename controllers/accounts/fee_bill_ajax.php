<?php 

class Fee_bill_ajax extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->db_atif_fee = $this->load->database('fee_bill_db', TRUE);
	}





	public function getStudentInfo(){
		$GSID = $this->input->post('gs_id');
		$this->load->model('accounts/fee_bill/fee_bill_installment');
		$studentInfo = $this->fee_bill_installment->getStudentInfo($GSID);

		if(empty($studentInfo)){
			echo "<h1>GS-ID not found!</h1><br><br>";
		}else{
			echo 
			'<strong><font size="5">' . $studentInfo[0]->abridged_name . ', Installment # </font>
			<font size="6">' . $studentInfo[0]->installment_no . '</font><br><br><br></strong>';
		}
	}





	public function get_student_bill(){
    	$html = '';
       

    	$html .= '<style>
		.unit_report_pdf_iframe {
			position: relative;
			padding-bottom: 65.25%;
			padding-top: 30px;
			height: 0;
			overflow: auto; 
			-webkit-overflow-scrolling:touch; //<<--- THIS IS THE KEY 
			border: solid black 1px;
			} 
			.unit_report_pdf_iframe iframe {
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 90%;
		}
		</style>';




		$GSID = $this->input->post("gs_id");
		$Waive = $gradeID = $this->input->post('waive');
    	$IssueDate = $gradeID = $this->input->post('issue_date');
    	$DueDate = $gradeID = $this->input->post('due_date');
    	$ValidityDate = $gradeID = $this->input->post('validity_date');
		if(empty($GSID) || empty($IssueDate) || empty($DueDate) || empty($ValidityDate)){
			$html .= "<h1>";
    		if(empty($GSID)) { $html .= "GS-ID required! <br>"; }
    		if(empty($IssueDate)) { $html .= "Issue Date required! <br>"; }
    		if(empty($DueDate)) { $html .= "Due Date required! <br>"; }
    		if(empty($ValidityDate)) { $html .= "Validity Date required! <br>"; }
    		$html .= "</h1>";
    		echo $html;
    		return;
    	}else{
    		$this->load->model('accounts/fee_bill/fee_bill_installment');
			$studentInfo = $this->fee_bill_installment->getStudentInfo($GSID);
			if(empty($studentInfo)){
				echo "<h1>GS-ID not found!</h1><br><br>";
				return;
			}
    	}


		$helper = 'gs_id='.$GSID.'&waive='.$Waive.'&issue_date='.$IssueDate.'&due_date='.$DueDate.'&validity_date='.$ValidityDate;
		$html .= '
		<div class="unit_report_pdf_iframe">
			<iframe src="'.site_url().'/accounts/Fee_bill_ajax/generateThisFeeBill?'.$helper.'" frameborder="0">
			</iframe>
		</div>';

		
    	echo $html;
    }






    public function generateThisFeeBill(){
    	$GSID = $gradeID = $this->input->get('gs_id');
    	$Waive = $gradeID = $this->input->get('waive');
    	$IssueDate = $gradeID = $this->input->get('issue_date');
    	$DueDate = $gradeID = $this->input->get('due_date');
    	$BankValidityDate = $gradeID = $this->input->get('validity_date');


    	$html = "";
    	if(empty($GSID) || empty($IssueDate) || empty($DueDate) || empty($BankValidityDate)){
    		if(empty($GSID)) { $html .= "GS-ID not found! <br>"; }
    		if(empty($IssueDate)) { $html .= "Issue Date not found! <br>"; }
    		if(empty($DueDate)) { $html .= "Due Date not found! <br>"; }
    		if(empty($BankValidityDate)) { $html .= "Validity Date not found! <br>"; }
    		return $html;
    	}else{










    		$this->load->model('accounts/fee_bill/fee_bill_installment');
    		$studentInfo = $this->fee_bill_installment->getStudentInfo($GSID);
    		$staffInfo = $this->fee_bill_installment->GetStaffInfo($GSID);

    		$currentInstallment = $studentInfo[0]->installment_no;
			$abridgedName = $studentInfo[0]->abridged_name;
			$fatherNIC = $studentInfo[0]->father_nic;
			$fatherName = $studentInfo[0]->father_name;
			$class = $studentInfo[0]->class;
			$studentGSID = "<hn>GS <hb>".$GSID."</hb></hn>";



    		/***** Layout Variables *****/
    		$bo = 0;
    		$MasterX = 4;
		    $MasterY = 0;
		    /***** Layout Variables ***** End *****/




		    /***** Fee Bill ID *****/
		    $FeeBillID = ''; $FeeBillIDSum = 0;
			$BillID = '170'.$currentInstallment;
			$BillID = $BillID . str_replace("-", "", $GSID);
			for($i=0; $i<strlen($BillID); $i++){
				$FeeBillIDSum += intval(substr($BillID, $i, 1));
			}
			$FeeBillIDSum += 3;
			$FeeBillIDSum = substr($FeeBillIDSum, -1);
			$FeeBillID_Save = (substr($BillID, 0, 2).substr($BillID, 2, 2).substr($BillID, 4, 5).$FeeBillIDSum);
			$FeeBillID = "<hn>".'Bill # <hb>' . substr($FeeBillID_Save, 0, 2) . '-' . substr($FeeBillID_Save, 2, 2) . '-' . substr($FeeBillID_Save, 4, 5) . '-' . $FeeBillIDSum . " </hb></hn>";
		    /***** Fee Bill ID ***** End *****/






    		/***** All Fee Bill Variables *****/
    		$billingForTheYear = "<hn>Billing for the year <hnb>Aug '17 - Jul '18</hnb></hn>";
    		$installmentNo = "Installment 0" . $currentInstallment . ' of 05';
    		



			$totalInstallments = 5;
			$currentInstallment = 0;
			/***** All Fee Bill Variables ***** End *****/




			/***** setting Variables of Staff *****/
			$text_GTID = $staffInfo[0]->gt_id;
			$text_Status = $staffInfo[0]->status_code;
			/***** setting Variables of Staff ***** End *****/

			



			














			// Overall Font Size
			$font_size = 10;
			$font_name = 'Helvetica';
			$gender_mark_size = 26;
			$now_date = date('d-M-Y');


			require_once('components/pdf/fpdf/PDF_WriteTag.php');
			require_once('components/pdf/fpdi/fpdi_atif.php');

			
			// initiate FPDI
			$pdf = new FPDI();
			//$pdf = new fpdi();

			// get the page count
			$pageCount = $pdf->setSourceFile('components/pdf/accounts/fee_bill/FeeBill_BlankFormat.pdf');
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









		    	// Stylesheet
				$pdf->SetStyle("p", "courier", "N", 12, "10, 100, 250", 15);
				$pdf->SetStyle("h1", "times", "N", 18, "102, 0, 102", 0);
				$pdf->SetStyle("a", "times", "BU", 9, "0, 0, 255");
				$pdf->SetStyle("pers", "times", "I", 0, "255, 0, 0");
				$pdf->SetStyle("place", "arial", "U", 0, "153, 0, 0");
				$pdf->SetStyle("vb", "times", "B", 0, "102, 153, 153");
				$pdf->SetStyle("hn", "Helvetica", "N", 5, "0, 0, 0");
				$pdf->SetStyle("hnb", "Helvetica", "B", 5, "0, 0, 0");
				$pdf->SetStyle("hb", "Helvetica", "B", 8, "0, 0, 0");







		    	if ($templateId == 1){
		    		
		    		/***** Staff Info ****/
		    		if(count($staffInfo) > 0){
			    		$pdf->SetFont($font_name,'', 5);
					    $pdf->SetXY($MasterX + 7, $MasterY + 57.5);
					    $pdf->Cell(14, 5, $text_GTID, $bo, 0, 'C', 0);
					    $pdf->SetXY($MasterX + 20.5, $MasterY + 57.5);
					    $pdf->Cell(46.5, 5, $text_Status, $bo, 0, 'C', 0);

					    $pdf->SetXY($MasterX + 100.5, $MasterY + 57.5);
					    $pdf->Cell(14, 5, $text_GTID, $bo, 0, 'C', 0);
					    $pdf->SetXY($MasterX + 114.5, $MasterY + 57.5);
					    $pdf->Cell(46.5, 5, $text_Status, $bo, 0, 'C', 0);

					    $pdf->SetXY($MasterX + 194.5, $MasterY + 57.5);
					    $pdf->Cell(14, 5, $text_GTID, $bo, 0, 'C', 0);
					    $pdf->SetXY($MasterX + 208.5, $MasterY + 57.5);
					    $pdf->Cell(46.5, 5, $text_Status, $bo, 0, 'C', 0);
					}




					/***** Block - 1
				    *****************/
				    $pdf->SetFont($font_name,'', 5);
				    $pdf->SetFont($font_name,'',7);
				    $pdf->SetXY($MasterX + 52.5, $MasterY + 27);
					$pdf->WriteTag(30, 3, $FeeBillID, $bo, "C", 0, 1);
				    $pdf->SetXY($MasterX + 146, $MasterY + 27);
				    $pdf->WriteTag(30, 3, $FeeBillID, $bo, "C", 0, 1);
				    $pdf->SetXY($MasterX + 240, $MasterY + 27);
				    $pdf->WriteTag(30, 3, $FeeBillID, $bo, "C", 0, 1);




					/***** Block - 2
				    *****************/
				    $pdf->SetFont($font_name,'', 5);
				    $pdf->setXY($MasterX + 9, $MasterY + 27);
				    $pdf->WriteTag(34, 3, $billingForTheYear, $bo, "C", 0, 1);
				    $pdf->setXY($MasterX + 103, $MasterY + 27);
				    $pdf->WriteTag(34, 3, $billingForTheYear, $bo, "C", 0, 1);
				    $pdf->setXY($MasterX + 197, $MasterY + 27);
				    $pdf->WriteTag(34, 3, $billingForTheYear, $bo, "C", 0, 1);



				    /***** Block - 2
				    *****************/
				    $pdf->SetFont($font_name,'B', 7);
				    $pdf->setXY($MasterX + 8.5, $MasterY + 30.5);
				    $pdf->Cell(33.5, 4, $installmentNo, $bo, 0, 'C', 0);
				    $pdf->setXY($MasterX + 102.5, $MasterY + 30.5);
				    $pdf->Cell(33.5, 4, $installmentNo, $bo, 0, 'C', 0);
				    $pdf->setXY($MasterX + 196.5, $MasterY + 30.5);
				    $pdf->Cell(33.5, 4, $installmentNo, $bo, 0, 'C', 0);



				    /***** Block - 3
				    *****************/
				    $pdf->SetFont($font_name,'',8);
				    $pdf->SetXY($MasterX + 53, $MasterY + 35.5);
				    $pdf->Cell(29, 5, $abridgedName, $bo, 0, 'C', 0);
				    $pdf->SetFont($font_name,'',8);
				    $pdf->SetXY($MasterX + 53, $MasterY + 38.5);
				    $pdf->WriteTag(15, 3, $studentGSID, $bo, "L", 0, 1);
				    $pdf->SetXY($MasterX + 53 + 15, $MasterY + 38.5);
				    $pdf->Cell(14, 5, $class, $bo, 0, 'R', 0);
				    $pdf->SetFont($font_name,'',5);
				    $pdf->SetXY($MasterX + 53, $MasterY + 41.5);
				    $pdf->Cell(29, 5, $fatherName, $bo, 0, 'C', 0);

				    $pdf->SetFont($font_name,'',8);
				    $pdf->SetXY($MasterX + 147, $MasterY + 35.5);
				    $pdf->Cell(29, 5, $abridgedName, $bo, 0, 'C', 0);
				    $pdf->SetFont($font_name,'',8);
				    $pdf->SetXY($MasterX + 147, $MasterY + 38.5);
				    $pdf->WriteTag(15, 3, $studentGSID, $bo, "L", 0, 1);
				    $pdf->SetXY($MasterX + 147 + 15, $MasterY + 38.5);
				    $pdf->Cell(14, 5, $class, $bo, 0, 'R', 0);
				    $pdf->SetFont($font_name,'',5);
				    $pdf->SetXY($MasterX + 147, $MasterY + 41.5);
				    $pdf->Cell(29, 5, $fatherName, $bo, 0, 'C', 0);

				    $pdf->SetFont($font_name,'',8);
				    $pdf->SetXY($MasterX + 240.5, $MasterY + 35.5);
				    $pdf->Cell(29, 5, $abridgedName, $bo, 0, 'C', 0);
				    $pdf->SetFont($font_name,'',8);
				    $pdf->SetXY($MasterX + 240.5, $MasterY + 38.5);
				    $pdf->WriteTag(15, 3, $studentGSID, $bo, "L", 0, 1);
				    $pdf->SetXY($MasterX + 240.5 + 15, $MasterY + 38.5);
				    $pdf->Cell(14, 5, $class, $bo, 0, 'R', 0);
				    $pdf->SetFont($font_name,'',5);
				    $pdf->SetXY($MasterX + 240.5, $MasterY + 41.5);
				    $pdf->Cell(29, 5, $fatherName, $bo, 0, 'C', 0);




				    /***** Father NIC
				    *****************/
				    $pdf->SetFont($font_name,'',8);
				    $pdf->SetXY($MasterX + 10, $MasterY + 46.5);
					$pdf->Cell(32, 5, $fatherNIC, $bo, 0, 'C', 0);
					$pdf->SetXY($MasterX + 104, $MasterY + 46.5);
					$pdf->Cell(32, 5, $fatherNIC, $bo, 0, 'C', 0);
					$pdf->SetXY($MasterX + 197.5, $MasterY + 46.5);
					$pdf->Cell(32, 5, $fatherNIC, $bo, 0, 'C', 0);





					/***** Dates
				    *************/
				    $pdf->SetFont($font_name,'',6);
				    $pdf->SetXY($MasterX + 7.5, $MasterY + 54.5);
				    $pdf->Cell(14, 5, $IssueDate, $bo, 0, 'C', 0);
				    $pdf->SetXY($MasterX + 20.5, $MasterY + 54.5);
				    $pdf->Cell(46.5, 5, $DueDate, $bo, 0, 'C', 0);
				    $pdf->SetXY($MasterX + 67.5, $MasterY + 54.5);
				    $pdf->Cell(19, 5, $BankValidityDate, $bo, 0, 'C', 0);

				    $pdf->SetXY($MasterX + 101, $MasterY + 54.5);
				    $pdf->Cell(14, 5, $IssueDate, $bo, 0, 'C', 0);
				    $pdf->SetXY($MasterX + 115, $MasterY + 54.5);
				    $pdf->Cell(46.5, 5, $DueDate, $bo, 0, 'C', 0);
				    $pdf->SetXY($MasterX + 161.5, $MasterY + 54.5);
				    $pdf->Cell(19, 5, $BankValidityDate, $bo, 0, 'C', 0);

				    $pdf->SetXY($MasterX + 195, $MasterY + 54.5);
				    $pdf->Cell(14, 5, $IssueDate, $bo, 0, 'C', 0);
				    $pdf->SetXY($MasterX + 209, $MasterY + 54.5);
				    $pdf->Cell(46.5, 5, $DueDate, $bo, 0, 'C', 0);
				    $pdf->SetXY($MasterX + 255.5, $MasterY + 54.5);
				    $pdf->Cell(19, 5, $BankValidityDate, $bo, 0, 'C', 0);

				}
			}




			// Output the new PDF
			$fileName = 'FeeBill-'.$GSID;
			$pdf->Output($fileName . '.pdf', 'I');
	    }
	}
}