<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admission_fee_bill extends CI_Controller{
    public function __construct(){
        parent::__construct();
		$this->load->library('session');
    }





    public function fb(){
    	$FormID = $this->input->GET('FormID');

		$this->load->model('admission/offer_model');
		$thisDate = $this->offer_model->getFeeBill_OfferDate($FormID);
		$data['student'] = $this->offer_model->offer_detail_by_form_id($FormID);
		$staffInfo = $this->offer_model->getAdmission_StaffInfo($FormID);





		/***** Change Here ***** Fee Bill ID *****/
		$FeeBillID = ''; $FeeBillIDSum = 0;
		$BillID = date('y') . '81';
		if(($data['student'][0]->grade_id >= 6 && $data['student'][0]->grade_id <= 14)){
			$BillID = date('y') . '82';
		}else if($data['student'][0]->grade_id >= 15 && $data['student'][0]->grade_id <= 16){
			$BillID = date('y') . '72';
		}
		/***** Change Here ***** Fee Bill ID ***** END *****/


		$BillID = $BillID . str_pad($data['student'][0]->form_no, 5, '0', STR_PAD_LEFT);
		for($i=0; $i<strlen($BillID); $i++){
			$FeeBillIDSum += intval(substr($BillID, $i, 1));
		}
		$FeeBillIDSum += 1;
		$FeeBillIDSum = substr($FeeBillIDSum, -1);
		//$FeeBillID = 'Bill # ' . substr($BillID, 0, 2) . '-' . substr($BillID, 2, 2) . '-' . substr($BillID, 4, 5) . '-' . (substr($FeeBillIDSum, -1) + 1);
		$FeeBillID_Save = (substr($BillID, 0, 2).substr($BillID, 2, 2).substr($BillID, 4, 5).$FeeBillIDSum);
		$FeeBillID = 'Bill # ' . substr($FeeBillID_Save, 0, 2) . '-' . substr($FeeBillID_Save, 2, 2) . '-' . substr($FeeBillID_Save, 4, 5) . '-' . $FeeBillIDSum;


		$AdmissionYear = date('Y');
		$CallName = $data['student'][0]->call_name;

		$FatherName = '';
		if($data['student'][0]->gender=='G'){
			$FatherName = 'D/O ';
		}else{
			$FatherName = 'S/O ';
		}
		$FatherName .= $data['student'][0]->father_name;

		$Admitted = 'for admission to ' . $data['student'][0]->grade_name;

		$IssueDate = date("D d M 'y", strtotime($thisDate[0]->offer_date));
		$IssueDate_Save = date("Y-m-d", strtotime($thisDate[0]->offer_date));


		
		$select = 'bill_due_date';
		$where_gb_id = array(
			'gb_id' => $FeeBillID_Save
		);

		//$due_date_exists = $this->offer_model->get_by_all('atif_fee_student.fee_bill', $select, $where_gb_id);
		$due_date_exists = $this->offer_model->get_by_all_query($FeeBillID_Save);
		//var_dump($due_date_exists);
		
		// Due Date Extension

		if(!empty($due_date_exists)){
			 $DueDate = date("D d M 'y", strtotime($due_date_exists[0]->bill_due_date));
			 $DueDate_Save = $due_date_exists[0]->bill_due_date;
		}else{
			$DueDate = date("D d M 'y", strtotime($thisDate[0]->offer_date. ' + 5 weekday'));
			$DueDate_Save = date("Y-m-d", strtotime($thisDate[0]->offer_date. ' + 5 weekday'));
		}
		

		$BankValidityDate = $DueDate;
		$BankValidityDate_Save = $DueDate_Save;

		$this->VerifyBillDates($IssueDate_Save,$DueDate_Save);



		$Heading =  ''; //'FOR GRADE (' . $data['student'][0]->grade_name . ')';
		$nonRefundable_l1_text = "Admission Fee (Non-Refundable)";
		$nonRefundable_l2_text = "Computer Subscription Fee";
		$refundable_l1_text = "Security Deposit (Refundable)";
		$refundable_l2_text = "Waiver for T-CPM Staff";



		$ConcessionCode = $data['student'][0]->concession_code;
		$Concession = $data['student'][0]->concession_perc;
		$ConcessionAmount = 0;

		$nonRefundable_l1_amount = 40000;
		$nonRefundable_l2_amount = 0;
		if($data['student'][0]->grade_id >= 6 && $data['student'][0]->grade_id <= 14){
			$nonRefundable_l2_amount = 2000;
		}		
		$refundable_l1_amount = 15000;
		if($data['student'][0]->grade_id == "17"){
			$nonRefundable_l1_amount = 40000;
			$refundable_l1_amount = 15000;
		}


		if($data['student'][0]->grade_id >= 15 && $data['student'][0]->grade_id <= 16){
			$nonRefundable_l1_amount = 0;
			$refundable_l2_text = "";
			$refundable_l1_amount = 25000;
			$refundable_l1_text = "Deposit for Early Admission Offer";
			$TotalPayable = "25000";
			$total_refundable_amount = "25000";
		}

		$total_nonRefundable_amount = $nonRefundable_l1_amount;
		if($Concession>0){
			$ConcessionAmount = $total_nonRefundable_amount * $Concession / 100;
			if($ConcessionCode == 'C(TC)'){
				$refundable_l1_amount = 0;
			}
		}else{
			$Concession = 0;
		}
		$total_refundable_amount = $refundable_l1_amount + $nonRefundable_l2_amount;
		$TotalPayable = $total_nonRefundable_amount + $total_refundable_amount - $ConcessionAmount;

		
		if(($data['student'][0]->grade_id >= 1 && $data['student'][0]->grade_id <= 14) ||
			$data['student'][0]->grade_id == 17){
			if($ConcessionCode == 'C(TC)'){
				if($Concession == 0){
					$TotalPayable -= $refundable_l1_amount;					
				}
			}
		}



		if($this->offer_model->feeBillCheck($FeeBillID_Save)){
			$this->offer_model->updateFeeBill($FeeBillID_Save, $IssueDate_Save, $DueDate_Save, $BankValidityDate_Save, $TotalPayable, $ConcessionCode, $Concession, $total_nonRefundable_amount, $total_refundable_amount);
		}else{
			$this->offer_model->insertFeeBill($FeeBillID_Save, $IssueDate_Save, $DueDate_Save, $BankValidityDate_Save, $TotalPayable, $ConcessionCode, $Concession, $total_nonRefundable_amount, $total_refundable_amount);
		}





		$nonRefundable_l1_amount = number_format($nonRefundable_l1_amount);
		$nonRefundable_l2_amount = number_format($nonRefundable_l2_amount);
		$refundable_l1_amount = number_format($refundable_l1_amount);
		$total_nonRefundable_amount = number_format($total_nonRefundable_amount);
		$total_refundable_amount = number_format($total_refundable_amount);
		$TotalPayable = number_format($TotalPayable);

		if($total_refundable_amount == 0){
			$total_refundable_amount = "-";
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







		/***** Change Here ***** Fee Data *****/
		if(($data['student'][0]->grade_id >= 1 && $data['student'][0]->grade_id <= 5) OR $data['student'][0]->grade_id == 17){
			$pageCount = $pdf->setSourceFile('components/pdf/admission/AdmissionFeeBill-AF_SD.pdf');
		}else if($data['student'][0]->grade_id >= 6 && $data['student'][0]->grade_id <= 14){
			$pageCount = $pdf->setSourceFile('components/pdf/admission/AdmissionFeeBill-AF_SD_CS.pdf');
		}else if($data['student'][0]->grade_id >= 15 && $data['student'][0]->grade_id <= 16){
			$pageCount = $pdf->setSourceFile('components/pdf/admission/AdmissionFeeBill-EAO_1.pdf');
			$nonRefundable_l1_text = "";
			$nonRefundable_l1_amount = "";
			$total_nonRefundable_amount = "-";
			$Concession = 0;
			$refundable_l2_text = "";
			$refundable_l1_amount = 25000;
			$refundable_l1_text = "Deposit for Early Admission Offer";
			$TotalPayable = "25,000";
			$total_refundable_amount = "25,000";
		}
		/***** Change Here ***** Fee Data ***** END *****/

		







		//$pageCount = $pdf->setSourceFile('components/pdf/admission/AdmissionFeeBill.pdf');
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


		    $MasterX = 4;
		    $MasterY = 0;


		    // use the imported page
	    	$pdf->useTemplate($templateId);

	    	if ($templateId == 1){
	    		$pdf->SetFont($font_name);


	    		/***** Staff Info ****/
	    		if(count($staffInfo) > 0){
		    		$pdf->SetFont($font_name,'', 5);
				    $pdf->SetXY($MasterX + 7, $MasterY + 57.5);
				    $pdf->Cell(14, 5, 'GT-ID: ' . $staffInfo[0]->gt_id, $bo, 0, 'C', 0);
				    $pdf->SetXY($MasterX + 20.5, $MasterY + 57.5);
				    $pdf->Cell(46.5, 5, 'GT Status: ' . $staffInfo[0]->status_code, $bo, 0, 'C', 0);

				    $pdf->SetXY($MasterX + 100.5, $MasterY + 57.5);
				    $pdf->Cell(14, 5, 'GT-ID: ' . $staffInfo[0]->gt_id, $bo, 0, 'C', 0);
				    $pdf->SetXY($MasterX + 114.5, $MasterY + 57.5);
				    $pdf->Cell(46.5, 5, 'GT Status: ' . $staffInfo[0]->status_code, $bo, 0, 'C', 0);

				    $pdf->SetXY($MasterX + 194.5, $MasterY + 57.5);
				    $pdf->Cell(14, 5, 'GT-ID: ' . $staffInfo[0]->gt_id, $bo, 0, 'C', 0);
				    $pdf->SetXY($MasterX + 208.5, $MasterY + 57.5);
				    $pdf->Cell(46.5, 5, 'GT Status: ' . $staffInfo[0]->status_code, $bo, 0, 'C', 0);
				}

















	    		$pdf->SetFont($font_name,'',8);
			    $pdf->SetXY($MasterX + 25, $MasterY + 22);
			    $pdf->Cell(47, 5, $Heading, $bo, 0, 'C', 0);
			    $pdf->SetXY($MasterX + 124, $MasterY + 22);
			    $pdf->Cell(47, 5, $Heading, $bo, 0, 'C', 0);
			    $pdf->SetXY($MasterX + 223, $MasterY + 22);
			    $pdf->Cell(47, 5, $Heading, $bo, 0, 'C', 0);

	    		
	    		/***** Block - 1
			    *****************/
			    $pdf->SetFont($font_name,'',7);
			    $pdf->SetXY($MasterX + 52.5, $MasterY + 28);
			    $pdf->Cell(29, 3, $FeeBillID, $bo, 0, 'C', 0);
			    $pdf->SetXY($MasterX + 146, $MasterY + 28);
			    $pdf->Cell(29, 3, $FeeBillID, $bo, 0, 'C', 0);
			    $pdf->SetXY($MasterX + 240, $MasterY + 28);
			    $pdf->Cell(29, 3, $FeeBillID, $bo, 0, 'C', 0);



			    /***** Block - 2
			    *****************/
			    $pdf->setXY($MasterX + 8.5, $MasterY + 30);
			    $pdf->Cell(33.5, 4, $AdmissionYear, $bo, 0, 'C', 0);
			    $pdf->setXY($MasterX + 102.5, $MasterY + 30);
			    $pdf->Cell(33.5, 4, $AdmissionYear, $bo, 0, 'C', 0);
			    $pdf->setXY($MasterX + 196.5, $MasterY + 30);
			    $pdf->Cell(33.5, 4, $AdmissionYear, $bo, 0, 'C', 0);




			    /***** Block - 3
			    *****************/
			    $pdf->SetFont($font_name,'',8);
			    $pdf->SetXY($MasterX + 52, $MasterY + 35.5);
			    $pdf->Cell(30, 5, $CallName, $bo, 0, 'C', 0);
			    $pdf->SetFont($font_name,'',8);
			    $pdf->SetXY($MasterX + 52, $MasterY + 38.5);
			    $pdf->Cell(30, 5, $Admitted, $bo, 0, 'C', 0);
			    $pdf->SetFont($font_name,'',5);
			    $pdf->SetXY($MasterX + 52, $MasterY + 41.5);
			    $pdf->Cell(30, 5, $FatherName, $bo, 0, 'C', 0);

			    $pdf->SetFont($font_name,'',8);
			    $pdf->SetXY($MasterX + 146, $MasterY + 35.5);
			    $pdf->Cell(30, 5, $CallName, $bo, 0, 'C', 0);
			    $pdf->SetFont($font_name,'',8);
			    $pdf->SetXY($MasterX + 146, $MasterY + 38.5);
			    $pdf->Cell(30, 5, $Admitted, $bo, 0, 'C', 0);
			    $pdf->SetFont($font_name,'',5);
			    $pdf->SetXY($MasterX + 146, $MasterY + 41.5);
			    $pdf->Cell(30, 5, $FatherName, $bo, 0, 'C', 0);

			    $pdf->SetFont($font_name,'',8);
			    $pdf->SetXY($MasterX + 239.5, $MasterY + 35.5);
			    $pdf->Cell(30, 5, $CallName, $bo, 0, 'C', 0);
			    $pdf->SetFont($font_name,'',8);
			    $pdf->SetXY($MasterX + 239.5, $MasterY + 38.5);
			    $pdf->Cell(30, 5, $Admitted, $bo, 0, 'C', 0);
			    $pdf->SetFont($font_name,'',5);
			    $pdf->SetXY($MasterX + 239.5, $MasterY + 41.5);
			    $pdf->Cell(30, 5, $FatherName, $bo, 0, 'C', 0);




			    /***** Father NIC
			    *****************/
			    $pdf->SetFont($font_name,'',8);
			    $pdf->SetXY($MasterX + 10, $MasterY + 46);
				$pdf->Cell(32, 5, $data['student'][0]->father_nic, $bo, 0, 'C', 0);
				$pdf->SetXY($MasterX + 104, $MasterY + 46);
				$pdf->Cell(32, 5, $data['student'][0]->father_nic, $bo, 0, 'C', 0);
				$pdf->SetXY($MasterX + 197.5, $MasterY + 46);
				$pdf->Cell(32, 5, $data['student'][0]->father_nic, $bo, 0, 'C', 0);












			    /***** Dates
			    *************/
			    $pdf->SetFont($font_name,'',6);
			    $pdf->SetXY($MasterX + 7, $MasterY + 54.5);
			    $pdf->Cell(14, 5, $IssueDate, $bo, 0, 'C', 0);
			    $pdf->SetXY($MasterX + 20.5, $MasterY + 54.5);
			    $pdf->Cell(46.5, 5, $DueDate, $bo, 0, 'C', 0);
			    $pdf->SetXY($MasterX + 67, $MasterY + 54.5);
			    $pdf->Cell(19, 5, $BankValidityDate, $bo, 0, 'C', 0);

			    $pdf->SetXY($MasterX + 100.5, $MasterY + 54.5);
			    $pdf->Cell(14, 5, $IssueDate, $bo, 0, 'C', 0);
			    $pdf->SetXY($MasterX + 114.5, $MasterY + 54.5);
			    $pdf->Cell(46.5, 5, $DueDate, $bo, 0, 'C', 0);
			    $pdf->SetXY($MasterX + 161, $MasterY + 54.5);
			    $pdf->Cell(19, 5, $BankValidityDate, $bo, 0, 'C', 0);

			    $pdf->SetXY($MasterX + 194.5, $MasterY + 54.5);
			    $pdf->Cell(14, 5, $IssueDate, $bo, 0, 'C', 0);
			    $pdf->SetXY($MasterX + 208.5, $MasterY + 54.5);
			    $pdf->Cell(46.5, 5, $DueDate, $bo, 0, 'C', 0);
			    $pdf->SetXY($MasterX + 255, $MasterY + 54.5);
			    $pdf->Cell(19, 5, $BankValidityDate, $bo, 0, 'C', 0);












			    /***** Fee - A
			    ***************/
			    $pdf->SetFont($font_name,'',6);





			    /***** Office Copy *****/
			    $pdf->SetXY($MasterX + 10, $MasterY + 95);
			    $pdf->Cell(45, 5, $nonRefundable_l1_text, $bo, 0, 'L', 0);
			    $pdf->SetXY($MasterX + 68.5, $MasterY + 95);
			    $pdf->Cell(13, 5, $nonRefundable_l1_amount, $bo, 0, 'R', 0);

			    if($nonRefundable_l2_amount > 0){
				    $pdf->SetXY($MasterX + 10, $MasterY + 120);
				    $pdf->Cell(45, 5, $nonRefundable_l2_text, $bo, 0, 'L', 0);
				    $pdf->SetXY($MasterX + 68.5, $MasterY + 120);
				    $pdf->Cell(13, 5, $nonRefundable_l2_amount, $bo, 0, 'R', 0);
				}

			    $pdf->SetXY($MasterX + 68.5, $MasterY + 106.5);
			    $pdf->Cell(13, 5, $total_nonRefundable_amount, $bo, 0, 'R', 0);







			    /***** Bank Copy *****/
			    $pdf->SetXY($MasterX + 104, $MasterY + 95);
			    $pdf->Cell(45, 5, $nonRefundable_l1_text, $bo, 0, 'L', 0);
			    $pdf->SetXY($MasterX + 162, $MasterY + 95);
			    $pdf->Cell(13, 5, $nonRefundable_l1_amount, $bo, 0, 'R', 0);

			    if($nonRefundable_l2_amount > 0){
				    $pdf->SetXY($MasterX + 104, $MasterY + 120);
				    $pdf->Cell(45, 5, $nonRefundable_l2_text, $bo, 0, 'L', 0);
				    $pdf->SetXY($MasterX + 162, $MasterY + 120);
				    $pdf->Cell(13, 5, $nonRefundable_l2_amount, $bo, 0, 'R', 0);
				}
				
			    $pdf->SetXY($MasterX + 162, $MasterY + 106.5);
			    $pdf->Cell(13, 5, $total_nonRefundable_amount, $bo, 0, 'R', 0);







			    /***** Parent Copy *****/
			    $pdf->SetXY($MasterX + 198, $MasterY + 95);
			    $pdf->Cell(45, 5, $nonRefundable_l1_text, $bo, 0, 'L', 0);
			    $pdf->SetXY($MasterX + 255.5, $MasterY + 95);
			    $pdf->Cell(13, 5, $nonRefundable_l1_amount, $bo, 0, 'R', 0);

			    if($nonRefundable_l2_amount > 0){
				    $pdf->SetXY($MasterX + 198, $MasterY + 120);
				    $pdf->Cell(45, 5, $nonRefundable_l2_text, $bo, 0, 'L', 0);
				    $pdf->SetXY($MasterX + 255.5, $MasterY + 120);
				    $pdf->Cell(13, 5, $nonRefundable_l2_amount, $bo, 0, 'R', 0);			    	
			    }

			    $pdf->SetXY($MasterX + 255.5, $MasterY + 106.5);
			    $pdf->Cell(13, 5, $total_nonRefundable_amount, $bo, 0, 'R', 0);




			    

			    










			    /***** Fee - B
			    ***************/
			    if($total_refundable_amount > 0){
				    $pdf->SetXY($MasterX + 10, $MasterY + 123);
				    $pdf->Cell(45, 5, $refundable_l1_text, $bo, 0, 'L', 0);
				    $pdf->SetXY($MasterX + 68.5, $MasterY + 123);
				    $pdf->Cell(13, 5, $refundable_l1_amount, $bo, 0, 'R', 0);
				    $pdf->SetXY($MasterX + 68.5, $MasterY + 132);
				    $pdf->Cell(13, 5, $total_refundable_amount, $bo, 0, 'R', 0);

				    $pdf->SetXY($MasterX + 104, $MasterY + 123);
				    $pdf->Cell(45, 5, $refundable_l1_text, $bo, 0, 'L', 0);
				    $pdf->SetXY($MasterX + 162, $MasterY + 123);
				    $pdf->Cell(13, 5, $refundable_l1_amount, $bo, 0, 'R', 0);
				    $pdf->SetXY($MasterX + 162, $MasterY + 132);
				    $pdf->Cell(13, 5, $total_refundable_amount, $bo, 0, 'R', 0);

				    $pdf->SetXY($MasterX + 198, $MasterY + 123);
				    $pdf->Cell(45, 5, $refundable_l1_text, $bo, 0, 'L', 0);
				    $pdf->SetXY($MasterX + 255.5, $MasterY + 123);
				    $pdf->Cell(13, 5, $refundable_l1_amount, $bo, 0, 'R', 0);
				    $pdf->SetXY($MasterX + 255.5, $MasterY + 132);
				    $pdf->Cell(13, 5, $total_refundable_amount, $bo, 0, 'R', 0);
			    }else{
			    	$pdf->SetXY($MasterX + 68.5, $MasterY + 132);
			    	$pdf->Cell(13, 5, '-', $bo, 0, 'R', 0);
			    	$pdf->SetXY($MasterX + 162, $MasterY + 132);
			    	$pdf->Cell(13, 5, '-', $bo, 0, 'R', 0);
			    	$pdf->SetXY($MasterX + 255.5, $MasterY + 132);
			    	$pdf->Cell(13, 5, '-', $bo, 0, 'R', 0);
			    }









			    if($ConcessionCode == 'C(TC)'){
			    	$refundable_l1_amount = 15000;
					if($data['student'][0]->grade_id >= 15 && $data['student'][0]->grade_id <= 16){
						/*
						$nonRefundable_l1_amount = 33000;
						$refundable_l1_amount = 12000;
						*/
						$refundable_l1_text = "";
						$refundable_l1_amount = "";
					}




					// It is OK. Dont chnage it.
					if($refundable_l1_amount != ""){
						$refundable_l1_amount = number_format($refundable_l1_amount);
					}


					

					/***** Office Copy *****/
			    	$pdf->SetXY($MasterX + 10, $MasterY + 123);
				    $pdf->Cell(45, 5, $refundable_l1_text, $bo, 0, 'L', 0);
				    $pdf->SetXY($MasterX + 68.5, $MasterY + 123);
				    $pdf->Cell(13, 5, $refundable_l1_amount, $bo, 0, 'R', 0);

				    $pdf->SetXY($MasterX + 10, $MasterY + 127);
				    $pdf->Cell(45, 5, $refundable_l2_text, $bo, 0, 'L', 0);
				    $pdf->SetXY($MasterX + 68.5, $MasterY + 127);
				    if($refundable_l1_amount!= "") {$pdf->Cell(13, 5, '(' . $refundable_l1_amount . ')', $bo, 0, 'R', 0);}


				    /***** Bank Copy *****/
			    	$pdf->SetXY($MasterX + 104, $MasterY + 123);
				    $pdf->Cell(45, 5, $refundable_l1_text, $bo, 0, 'L', 0);
				    $pdf->SetXY($MasterX + 162, $MasterY + 123);
				    $pdf->Cell(13, 5, $refundable_l1_amount, $bo, 0, 'R', 0);

				    $pdf->SetXY($MasterX + 104, $MasterY + 127);
				    $pdf->Cell(45, 5, $refundable_l2_text, $bo, 0, 'L', 0);
				    $pdf->SetXY($MasterX + 162, $MasterY + 127);
				    if($refundable_l1_amount!= "") {$pdf->Cell(13, 5, '(' . $refundable_l1_amount . ')', $bo, 0, 'R', 0);}


				    /***** Parent Copy *****/
			    	$pdf->SetXY($MasterX + 198, $MasterY + 123);
				    $pdf->Cell(45, 5, $refundable_l1_text, $bo, 0, 'L', 0);
				    $pdf->SetXY($MasterX + 255.5, $MasterY + 123);
				    $pdf->Cell(13, 5, $refundable_l1_amount, $bo, 0, 'R', 0);

				    $pdf->SetXY($MasterX + 198, $MasterY + 127);
				    $pdf->Cell(45, 5, $refundable_l2_text, $bo, 0, 'L', 0);
				    $pdf->SetXY($MasterX + 255.5, $MasterY + 127);
				    if($refundable_l1_amount!= "") {$pdf->Cell(13, 5, '(' . $refundable_l1_amount . ')', $bo, 0, 'R', 0);}
					/*
					$pdf->SetXY($MasterX + 10, $MasterY + 135);
				    $pdf->Cell(45, 5, $nonRefundable_l2_text, $bo, 0, 'L', 0);
				    $pdf->SetXY($MasterX + 68.5, $MasterY + 135);
				    $pdf->Cell(13, 5, $nonRefundable_l2_amount, $bo, 0, 'R', 0);*/
				}








			    /***** Concession
			    ******************/
			    $ConcessionAmount = '(' . number_format($ConcessionAmount) . ')';
			    if($Concession > 0){
			    	$pdf->SetXY($MasterX + 10, $MasterY + 111);
			    	$pdf->Cell(13, 5, $ConcessionCode.' @' . $Concession, $bo, 0, 'L', 0);
			    	$pdf->SetXY($MasterX + 68.5, $MasterY + 111);
			    	$pdf->Cell(13, 5, $ConcessionAmount, $bo, 0, 'R', 0);

			    	$pdf->SetXY($MasterX + 104, $MasterY + 111);
			    	$pdf->Cell(13, 5, $ConcessionCode.' @' . $Concession, $bo, 0, 'L', 0);
			    	$pdf->SetXY($MasterX + 162, $MasterY + 111);
			    	$pdf->Cell(13, 5, $ConcessionAmount, $bo, 0, 'R', 0);

			    	$pdf->SetXY($MasterX + 198, $MasterY + 111);
			    	$pdf->Cell(13, 5, $ConcessionCode.' @' . $Concession, $bo, 0, 'L', 0);
			    	$pdf->SetXY($MasterX + 255.5, $MasterY + 111);
			    	$pdf->Cell(13, 5, $ConcessionAmount, $bo, 0, 'R', 0);
			    }












			    /***** Total Payable
			    *********************/
			    $pdf->SetXY($MasterX + 73, $MasterY + 139);
			    $pdf->Cell(13, 5, $TotalPayable, $bo, 0, 'R', 0);

			    $pdf->SetXY($MasterX + 167, $MasterY + 139);
			    $pdf->Cell(13, 5, $TotalPayable, $bo, 0, 'R', 0);

			    $pdf->SetXY($MasterX + 260, $MasterY + 139);
			    $pdf->Cell(13, 5, $TotalPayable, $bo, 0, 'R', 0);





			    /***** Current Payable
			    **********************/
			    $pdf->SetXY($MasterX + 73, $MasterY + 158.5);
			    $pdf->Cell(13, 5, $TotalPayable, $bo, 0, 'R', 0);

			    $pdf->SetXY($MasterX + 167, $MasterY + 158.5);
			    $pdf->Cell(13, 5, $TotalPayable, $bo, 0, 'R', 0);

			    $pdf->SetXY($MasterX + 260, $MasterY + 158.5);
			    $pdf->Cell(13, 5, $TotalPayable, $bo, 0, 'R', 0);
			}
		}




		// Output the new PDF
		$pdf->Output('fb' . '.pdf', 'I');

    }

    private function VerifyBillDates($IssueDate,$DueDate){
    	
    	if ($IssueDate <= $DueDate) {
    		return true;
    	}else{
    		$html = '';
    		$html .= '<script
			  src="https://code.jquery.com/jquery-3.3.1.min.js"
			  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
			  crossorigin="anonymous"></script>';
    		$html .= '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-noty/2.3.7/packaged/jquery.noty.packaged.min.js"></script>
			<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.4.0/animate.min.css">';
    		$html .= '<script>$("document").ready(function(){
    			noty({text: "Please Update the Offer Date to Proceed OR Change the date to Payment Window", type: "error",  theme: "defaultTheme"});	
    		})</script>';
    		echo $html;
    	}
    }
}