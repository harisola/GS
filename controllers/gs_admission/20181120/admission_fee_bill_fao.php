<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admission_fee_bill_fao extends CI_Controller{
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
		$feeStructure = $this->offer_model->get_Admission_FeeStructure($data['student'][0]->grade_id);
		$isEAOPaid = $this->offer_model->is_EAO_paid_of('72', $data['student'][0]->form_no);



		$waiver=$data['student'][0]->Admission_Form_Wavier;

		if($data['student'][0]->grade_id >= 15 && $data['student'][0]->grade_id <= 16){
			/***** Change Here ***** Fee Bill ID *****/
			$FeeBillID = ''; $FeeBillIDSum = 0;
			$BillID = '';
			if($isEAOPaid){
				$BillID = date('y') . '85';
			}else{
				$BillID = date('y') . '86';
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


			$AdmissionYear = "Billing for Year Aug'18 - Jul'19"; //date('Y');
			$CallName = $data['student'][0]->call_name;

			$FatherName = '';
			if($data['student'][0]->gender=='G'){
				$FatherName = 'D/O ';
			}else{
				$FatherName = 'S/O ';
			}
			$FatherName .= $data['student'][0]->father_name;

			$Admitted = '                               ' . $data['student'][0]->grade_name;

			// $IssueDate = date("D d M 'y", strtotime($thisDate[0]->offer_date));
			// $IssueDate_Save = date("Y-m-d", strtotime($thisDate[0]->offer_date));

			$IssueDate = date("D d M 'y", strtotime("now"));
			$IssueDate_Save = date("Y-m-d", strtotime("now"));


			
			$select = 'bill_due_date';
			$where_gb_id = array(
				'gb_id' => $FeeBillID_Save
			);

			//$due_date_exists = $this->offer_model->get_by_all('atif_fee_student.fee_bill', $select, $where_gb_id);
			$due_date_exists = $this->offer_model->get_by_all_query($FeeBillID_Save);

			$Due_date_ks = $this->offer_model->get_Fill_Due_Date($FormID);

			if( !empty($Due_date_ks)){
				$Solangi_Fb_Due_Date = $Due_date_ks->Due_date;	
			}else
			{
				$Solangi_Fb_Due_Date = "20 August 2018";
			}
			


			//var_dump($due_date_exists);
			
			// Due Date Extension

			// if(!empty($due_date_exists)){
			// 	 $DueDate = date("D d M 'y", strtotime($due_date_exists[0]->bill_due_date));
			// 	 $DueDate_Save = $due_date_exists[0]->bill_due_date;
			// }else{
			// 	$DueDate = date("D d M 'y", strtotime($thisDate[0]->offer_date. ' + 5 weekday'));
			// 	$DueDate_Save = date("Y-m-d", strtotime($thisDate[0]->offer_date. ' + 5 weekday'));
			// }
			

			// $DueDate = date("D d M 'y", strtotime("now". ' + 5 weekday'));
			// $DueDate_Save = date("Y-m-d", strtotime("now". ' + 5 weekday'));

			
			

			$DueDate = date("D d M 'y", strtotime($Solangi_Fb_Due_Date));
			$DueDate_Save = date("Y-m-d", strtotime($Solangi_Fb_Due_Date));

			$BankValidityDate = $DueDate;
			$BankValidityDate_Save = $DueDate_Save;

			$this->VerifyBillDates($IssueDate_Save,$DueDate_Save);



			$Heading =  ''; //'FOR GRADE (' . $data['student'][0]->grade_name . ')';
			$fee_part_a_l1_text = "Tuition Fee";
			$fee_part_a_l2_text = "";
			$fee_part_b_l1_text = "Resource Charges";
			if($waiver==1){
				$fee_part_b_l2_text = "Admission Fee (With 50% Waiver)";
			}else{
				$fee_part_b_l2_text = "Admission Fee (Non-Refundable)";

			}		
			$fee_part_b_l3_text = "Security Deposit (Refundable)";

			$fee_part_c_l1_text = "Preferred / Early Admission Offer";
			$fee_part_c_l1_amount_c = 25000;


			/***** Concession *****/
			$ConcessionCode = $data['student'][0]->concession_code;
			$Concession = $data['student'][0]->concession_perc;
			$ConcessionAmount = 0;
			$ConcessionAmount_a = 0;
			$ConcessionAmount_b = 0;
			$ConcessionTotalPer = 0;

			/***** Scholarship *****/
			$ScholarshipAC = $data['student'][0]->scholarship_ac;
			$ScholarshipNAC = $data['student'][0]->scholarship_nac;
			$ScholarshipACAmount = 0;
			$ScholarshipNACAmount = 0;
			$ScholarshipAmount = 0;
			$ScholarshipAmount_a = 0;
			$ScholarshipAmount_b = 0;
			$ScholarshipCode = '';
			$ScholarshipTotalPer = 0;
			/***** Per Installment Factor *****/
			$perInstallment = 2.4;





			/*===== ===== ===== Fee - Part A ===== ===== =====*/
			$fee_part_a_l1_amount_a = $feeStructure[0]->tuition_fee;
			$fee_part_a_l1_amount_b = $feeStructure[0]->tuition_fee * 12;
			$fee_part_a_l1_amount_c = $feeStructure[0]->tuition_fee * $perInstallment;




			/*===== ===== ===== Fee - Part B ===== ===== =====*/
			$fee_part_a_l2_amount_c = 0;


			$fee_part_b_l1_amount_a = $feeStructure[0]->lab_avc;
			$fee_part_b_l1_amount_b = $feeStructure[0]->lab_avc * 12;
			$fee_part_b_l1_amount_c = $feeStructure[0]->lab_avc * $perInstallment;

			if($waiver==1){
				$fee_part_b_l2_amount_c = (33000/2);//admission fee

			}else{
				$fee_part_b_l2_amount_c = 33000;//admission fee
			}			$fee_part_b_l3_amount_c = 12000;//security fee





			$total_part_a_amount_a = $fee_part_a_l1_amount_a;
			$total_part_a_amount_b = $fee_part_a_l1_amount_b;
			$total_part_a_amount_c = $fee_part_a_l1_amount_c;




			/***** ***** Concession ***** *****/
			$ConcessionTotalPer = $Concession;
			if($Concession>0){
				$ConcessionAmount = $total_part_a_amount_c * $Concession / 100;
				$ConcessionAmount_a = $ConcessionAmount / $perInstallment;
				$ConcessionAmount_b = $ConcessionAmount_a * 12;

				$ConcessionAmount_a = '('.number_format($ConcessionAmount_a).')';
				$ConcessionAmount_b = '('.number_format($ConcessionAmount_b).')';
				$ConcessionTotalPer = $ConcessionTotalPer.'%';
				if($ConcessionCode == 'C(TC)'){
					$fee_part_b_l1_amount_c = 0;
				}
			}else{
				$Concession = 0;
			}
			/***** ****** Concession - END ***** *****/




			/***** ***** Scholarship ***** *****/
			if($ScholarshipAC > 0){
				$ScholarshipACAmount = $total_part_a_amount_c * $ScholarshipAC / 100;
				$ScholarshipCode .= 'S(AC)' . $ScholarshipAC . ' ';
			}

			if($ScholarshipNAC > 0){
				$ScholarshipNACAmount = $total_part_a_amount_c * $ScholarshipNAC / 100;
				$ScholarshipCode .= 'S(NA)' . $ScholarshipNAC;
			}
			$ScholarshipTotalPer = ($ScholarshipAC + $ScholarshipNAC).'%';
			$ScholarshipAmount = $ScholarshipACAmount + $ScholarshipNACAmount;
			if($ScholarshipAmount>0){
				$ScholarshipAmount_a = $ScholarshipAmount / $perInstallment;
				$ScholarshipAmount_b = $ScholarshipAmount_a * 12;

				$ScholarshipAmount_a = '('.number_format($ScholarshipAmount_a).')';
				$ScholarshipAmount_b = '('.number_format($ScholarshipAmount_b).')';
			}
			/***** ****** Scholarship - END ***** *****/





			$total_additional_charges = $fee_part_b_l1_amount_c + $fee_part_b_l2_amount_c + $fee_part_b_l3_amount_c + $fee_part_a_l2_amount_c;
			$total_additional_charges_a = $fee_part_b_l1_amount_c / $perInstallment;
			$total_additional_charges_b = $total_additional_charges_a * 12;
			$total_additional_charges_a = number_format($total_additional_charges_a);
			$total_additional_charges_b = number_format($total_additional_charges_b);
			$TotalPayable = $total_part_a_amount_c + $total_additional_charges - $ConcessionAmount - $ScholarshipAmount;
			$TotalCurrentBilling = $total_part_a_amount_c + $total_additional_charges - $ConcessionAmount - $ScholarshipAmount;
			if($isEAOPaid){
				$TotalPayable -= $fee_part_c_l1_amount_c;
			}





			if($this->offer_model->feeBillCheck($FeeBillID_Save)){
				$this->offer_model->updateFeeBill_ALevel($FeeBillID_Save, $IssueDate_Save, $DueDate_Save, $BankValidityDate_Save, $TotalPayable, $ConcessionCode, $Concession, $fee_part_b_l2_amount_c, $fee_part_b_l3_amount_c, $total_additional_charges, $fee_part_a_l1_amount_c, $ScholarshipCode.'-'.$ScholarshipAmount);
			}else{
				$this->offer_model->insertFeeBill_ALevel($FeeBillID_Save, $IssueDate_Save, $DueDate_Save, $BankValidityDate_Save, $TotalPayable, $ConcessionCode, $Concession, $fee_part_b_l2_amount_c, $fee_part_b_l3_amount_c, $total_additional_charges, $fee_part_a_l1_amount_c, $ScholarshipCode.'-'.$ScholarshipAmount);
			}

			$afterDueDateCurrent = 0;
			$afterDueDateCurrent = $TotalPayable+600;





			$fee_part_a_l1_amount_a = number_format($fee_part_a_l1_amount_a);
			$fee_part_a_l1_amount_b = number_format($fee_part_a_l1_amount_b);
			$fee_part_a_l1_amount_c = number_format($fee_part_a_l1_amount_c);


			$fee_part_a_l2_amount_c = number_format($fee_part_a_l2_amount_c);
			
			$fee_part_b_l1_amount_a = number_format($fee_part_b_l1_amount_a);
			$fee_part_b_l1_amount_b = number_format($fee_part_b_l1_amount_b);
			$fee_part_b_l1_amount_c = number_format($fee_part_b_l1_amount_c);

			$fee_part_b_l2_amount_c = number_format($fee_part_b_l2_amount_c);
			$fee_part_b_l3_amount_c = number_format($fee_part_b_l3_amount_c);

			$fee_part_c_l1_amount_c = number_format($fee_part_c_l1_amount_c);


			$total_part_a_amount_a = number_format($total_part_a_amount_a);
			$total_part_a_amount_b = number_format($total_part_a_amount_b);
			$total_part_a_amount_c = number_format($total_part_a_amount_c);

			$total_additional_charges = number_format($total_additional_charges);
			$TotalCurrentBilling = number_format($TotalCurrentBilling);
			$TotalPayable = number_format($TotalPayable);

			if($total_additional_charges == 0){
				$total_additional_charges = "-";
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
			if($isEAOPaid){
				$pageCount = $pdf->setSourceFile('components/pdf/admission/AdmissionFeeBill-FAO_85.pdf');
			}else{
				$pageCount = $pdf->setSourceFile('components/pdf/admission/AdmissionFeeBill-FAO_86.pdf');
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
		    		if(count($staffInfo) > 0 && $staffInfo[0]->status_code != null){
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
				    $pdf->SetFont($font_name,'', 6.5);
				    $pdf->setXY($MasterX + 9, $MasterY + 30);
				    $pdf->Cell(33.5, 4, $AdmissionYear, $bo, 0, 'C', 0);
				    $pdf->setXY($MasterX + 103, $MasterY + 30);
				    $pdf->Cell(33.5, 4, $AdmissionYear, $bo, 0, 'C', 0);
				    $pdf->setXY($MasterX + 197, $MasterY + 30);
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
				    $pdf->SetFont($font_name,'',6);
				    $pdf->SetXY($MasterX + 10, $MasterY + 46);
					$pdf->Cell(32, 5, $data['student'][0]->father_nic, $bo, 0, 'C', 0);
					$pdf->SetXY($MasterX + 104, $MasterY + 46);
					$pdf->Cell(32, 5, $data['student'][0]->father_nic, $bo, 0, 'C', 0);
					$pdf->SetXY($MasterX + 197.5, $MasterY + 46);
					$pdf->Cell(32, 5, $data['student'][0]->father_nic, $bo, 0, 'C', 0);












				    /***** Dates
				    *************/
				    $pdf->SetFont($font_name,'',6);
				    $pdf->SetXY($MasterX + 7.5, $MasterY + 54.5);
				    $pdf->Cell(14, 5, $IssueDate, $bo, 0, 'C', 0);
				    $pdf->SetXY($MasterX + 20.5, $MasterY + 54.5);
				    $pdf->Cell(46.5, 5, $DueDate, $bo, 0, 'C', 0);
				    $pdf->SetXY($MasterX + 67, $MasterY + 54.5);
				    $pdf->Cell(19, 5, $BankValidityDate, $bo, 0, 'C', 0);

				    $pdf->SetXY($MasterX + 101, $MasterY + 54.5);
				    $pdf->Cell(14, 5, $IssueDate, $bo, 0, 'C', 0);
				    $pdf->SetXY($MasterX + 114.5, $MasterY + 54.5);
				    $pdf->Cell(46.5, 5, $DueDate, $bo, 0, 'C', 0);
				    $pdf->SetXY($MasterX + 161, $MasterY + 54.5);
				    $pdf->Cell(19, 5, $BankValidityDate, $bo, 0, 'C', 0);

				    $pdf->SetXY($MasterX + 195, $MasterY + 54.5);
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
				    $pdf->Cell(45, 5, $fee_part_a_l1_text, $bo, 0, 'L', 0);
				    $pdf->SetXY($MasterX + 38.5, $MasterY + 95);
				    $pdf->Cell(13, 5, $fee_part_a_l1_amount_a, $bo, 0, 'R', 0);

				    $pdf->SetXY($MasterX + 53.5, $MasterY + 95);
				    $pdf->Cell(13, 5, $fee_part_a_l1_amount_b, $bo, 0, 'R', 0);
			    
				    $pdf->SetXY($MasterX + 68.5, $MasterY + 95);
				    $pdf->Cell(13, 5, $fee_part_a_l1_amount_c, $bo, 0, 'R', 0);


				    if($fee_part_a_l2_amount_c > 0){
					    $pdf->SetXY($MasterX + 10, $MasterY + 120);
					    $pdf->Cell(45, 5, $fee_part_a_l2_text, $bo, 0, 'L', 0);
					    $pdf->SetXY($MasterX + 68.5, $MasterY + 120);
					    $pdf->Cell(13, 5, $fee_part_a_l2_amount_c, $bo, 0, 'R', 0);
					}

					$pdf->SetXY($MasterX + 38.5, $MasterY + 106.5);
				    $pdf->Cell(13, 5, $total_part_a_amount_a, $bo, 0, 'R', 0);

				    $pdf->SetXY($MasterX + 53.5, $MasterY + 106.5);
				    $pdf->Cell(13, 5, $total_part_a_amount_b, $bo, 0, 'R', 0);

				    $pdf->SetXY($MasterX + 68.5, $MasterY + 106.5);
				    $pdf->Cell(13, 5, $total_part_a_amount_c, $bo, 0, 'R', 0);







				    /***** Bank Copy *****/
				    $pdf->SetXY($MasterX + 104, $MasterY + 95);
				    $pdf->Cell(45, 5, $fee_part_a_l1_text, $bo, 0, 'L', 0);
				    $pdf->SetXY($MasterX + 132, $MasterY + 95);
				    $pdf->Cell(13, 5, $fee_part_a_l1_amount_a, $bo, 0, 'R', 0);

				    $pdf->SetXY($MasterX + 147, $MasterY + 95);
				    $pdf->Cell(13, 5, $fee_part_a_l1_amount_b, $bo, 0, 'R', 0);

				    $pdf->SetXY($MasterX + 162, $MasterY + 95);
				    $pdf->Cell(13, 5, $fee_part_a_l1_amount_c, $bo, 0, 'R', 0);

				    if($fee_part_a_l2_amount_c > 0){
					    $pdf->SetXY($MasterX + 104, $MasterY + 120);
					    $pdf->Cell(45, 5, $fee_part_a_l2_text, $bo, 0, 'L', 0);
					    $pdf->SetXY($MasterX + 162, $MasterY + 120);
					    $pdf->Cell(13, 5, $fee_part_a_l2_amount_c, $bo, 0, 'R', 0);
					}
					
					$pdf->SetXY($MasterX + 132, $MasterY + 106.5);
				    $pdf->Cell(13, 5, $total_part_a_amount_a, $bo, 0, 'R', 0);

				    $pdf->SetXY($MasterX + 147, $MasterY + 106.5);
				    $pdf->Cell(13, 5, $total_part_a_amount_b, $bo, 0, 'R', 0);

				    $pdf->SetXY($MasterX + 162, $MasterY + 106.5);
				    $pdf->Cell(13, 5, $total_part_a_amount_c, $bo, 0, 'R', 0);







				    /***** Parent Copy *****/
				    $pdf->SetXY($MasterX + 198, $MasterY + 95);
				    $pdf->Cell(45, 5, $fee_part_a_l1_text, $bo, 0, 'L', 0);
				    $pdf->SetXY($MasterX + 225.5, $MasterY + 95);
				    $pdf->Cell(13, 5, $fee_part_a_l1_amount_a, $bo, 0, 'R', 0);

				    $pdf->SetXY($MasterX + 240.5, $MasterY + 95);
				    $pdf->Cell(13, 5, $fee_part_a_l1_amount_b, $bo, 0, 'R', 0);

				    $pdf->SetXY($MasterX + 255.5, $MasterY + 95);
				    $pdf->Cell(13, 5, $fee_part_a_l1_amount_c, $bo, 0, 'R', 0);

				    if($fee_part_a_l2_amount_c > 0){
					    $pdf->SetXY($MasterX + 198, $MasterY + 120);
					    $pdf->Cell(45, 5, $fee_part_a_l2_text, $bo, 0, 'L', 0);
					    $pdf->SetXY($MasterX + 255.5, $MasterY + 120);
					    $pdf->Cell(13, 5, $fee_part_a_l2_amount_c, $bo, 0, 'R', 0);			    	
				    }

				    $pdf->SetXY($MasterX + 225.5, $MasterY + 106.5);
				    $pdf->Cell(13, 5, $total_part_a_amount_a, $bo, 0, 'R', 0);

				    $pdf->SetXY($MasterX + 240.5, $MasterY + 106.5);
				    $pdf->Cell(13, 5, $total_part_a_amount_b, $bo, 0, 'R', 0);

				    $pdf->SetXY($MasterX + 255.5, $MasterY + 106.5);
				    $pdf->Cell(13, 5, $total_part_a_amount_c, $bo, 0, 'R', 0);




				    

				    










				    /***** Fee - B
				    ***************/
				    $fee_part_b_yaxis = 120;
				    if($total_additional_charges > 0){
					    $pdf->SetXY($MasterX + 10, $MasterY + $fee_part_b_yaxis);
					    $pdf->Cell(45, 5, $fee_part_b_l1_text, $bo, 0, 'L', 0);

					    $pdf->SetXY($MasterX + 38.5, $MasterY + $fee_part_b_yaxis);
					    $pdf->Cell(13, 5, $fee_part_b_l1_amount_a, $bo, 0, 'R', 0);

					    $pdf->SetXY($MasterX + 53.5, $MasterY + $fee_part_b_yaxis);
					    $pdf->Cell(13, 5, $fee_part_b_l1_amount_b, $bo, 0, 'R', 0);

					    $pdf->SetXY($MasterX + 68.5, $MasterY + $fee_part_b_yaxis);
					    $pdf->Cell(13, 5, $fee_part_b_l1_amount_c, $bo, 0, 'R', 0);



					    $pdf->SetXY($MasterX + 68.5 - 30, $MasterY + 132);
					    $pdf->Cell(13, 5, $total_additional_charges_a, $bo, 0, 'R', 0);

					    $pdf->SetXY($MasterX + 68.5 - 15, $MasterY + 132);
					    $pdf->Cell(13, 5, $total_additional_charges_b, $bo, 0, 'R', 0);

					    $pdf->SetXY($MasterX + 68.5, $MasterY + 132);
					    $pdf->Cell(13, 5, $total_additional_charges, $bo, 0, 'R', 0);




					    $pdf->SetXY($MasterX + 104, $MasterY + $fee_part_b_yaxis);
					    $pdf->Cell(45, 5, $fee_part_b_l1_text, $bo, 0, 'L', 0);

					    $pdf->SetXY($MasterX + 132, $MasterY + $fee_part_b_yaxis);
					    $pdf->Cell(13, 5, $fee_part_b_l1_amount_a, $bo, 0, 'R', 0);

					    $pdf->SetXY($MasterX + 147, $MasterY + $fee_part_b_yaxis);
					    $pdf->Cell(13, 5, $fee_part_b_l1_amount_b, $bo, 0, 'R', 0);

					    $pdf->SetXY($MasterX + 162, $MasterY + $fee_part_b_yaxis);
					    $pdf->Cell(13, 5, $fee_part_b_l1_amount_c, $bo, 0, 'R', 0);


					    $pdf->SetXY($MasterX + 162 - 30, $MasterY + 132);
					    $pdf->Cell(13, 5, $total_additional_charges_a, $bo, 0, 'R', 0);

					    $pdf->SetXY($MasterX + 162 - 15, $MasterY + 132);
					    $pdf->Cell(13, 5, $total_additional_charges_b, $bo, 0, 'R', 0);

					    $pdf->SetXY($MasterX + 162, $MasterY + 132);
					    $pdf->Cell(13, 5, $total_additional_charges, $bo, 0, 'R', 0);






					    $pdf->SetXY($MasterX + 198, $MasterY + $fee_part_b_yaxis);
					    $pdf->Cell(45, 5, $fee_part_b_l1_text, $bo, 0, 'L', 0);

					    $pdf->SetXY($MasterX + 225.5, $MasterY + $fee_part_b_yaxis);
					    $pdf->Cell(13, 5, $fee_part_b_l1_amount_a, $bo, 0, 'R', 0);

					    $pdf->SetXY($MasterX + 240.5, $MasterY + $fee_part_b_yaxis);
					    $pdf->Cell(13, 5, $fee_part_b_l1_amount_b, $bo, 0, 'R', 0);

					    $pdf->SetXY($MasterX + 255.5, $MasterY + $fee_part_b_yaxis);
					    $pdf->Cell(13, 5, $fee_part_b_l1_amount_c, $bo, 0, 'R', 0);


					    $pdf->SetXY($MasterX + 255.5 - 30, $MasterY + 132);
					    $pdf->Cell(13, 5, $total_additional_charges_a, $bo, 0, 'R', 0);

					    $pdf->SetXY($MasterX + 255.5 - 15, $MasterY + 132);
					    $pdf->Cell(13, 5, $total_additional_charges_b, $bo, 0, 'R', 0);

					    $pdf->SetXY($MasterX + 255.5, $MasterY + 132);
					    $pdf->Cell(13, 5, $total_additional_charges, $bo, 0, 'R', 0);



					    /***** ***** ***** Line - 2 ***** ***** *****/
					    $fee_part_b_yaxis += 3.5;
					    $pdf->SetXY($MasterX + 10, $MasterY + $fee_part_b_yaxis);
					    $pdf->Cell(45, 5, $fee_part_b_l2_text, $bo, 0, 'L', 0);
					    $pdf->SetXY($MasterX + 68.5, $MasterY + $fee_part_b_yaxis);
					    $pdf->Cell(13, 5, $fee_part_b_l2_amount_c, $bo, 0, 'R', 0);

					    $pdf->SetXY($MasterX + 104, $MasterY + $fee_part_b_yaxis);
					    $pdf->Cell(45, 5, $fee_part_b_l2_text, $bo, 0, 'L', 0);
					    $pdf->SetXY($MasterX + 162, $MasterY + $fee_part_b_yaxis);
					    $pdf->Cell(13, 5, $fee_part_b_l2_amount_c, $bo, 0, 'R', 0);

					    $pdf->SetXY($MasterX + 198, $MasterY + $fee_part_b_yaxis);
					    $pdf->Cell(45, 5, $fee_part_b_l2_text, $bo, 0, 'L', 0);
					    $pdf->SetXY($MasterX + 255.5, $MasterY + $fee_part_b_yaxis);
					    $pdf->Cell(13, 5, $fee_part_b_l2_amount_c, $bo, 0, 'R', 0);


					    /***** ***** ***** Line - 3 ***** ***** *****/
					    $fee_part_b_yaxis += 3.5;
					    $pdf->SetXY($MasterX + 10, $MasterY + $fee_part_b_yaxis);
					    $pdf->Cell(45, 5, $fee_part_b_l3_text, $bo, 0, 'L', 0);
					    $pdf->SetXY($MasterX + 68.5, $MasterY + $fee_part_b_yaxis);
					    $pdf->Cell(13, 5, $fee_part_b_l3_amount_c, $bo, 0, 'R', 0);

					    $pdf->SetXY($MasterX + 104, $MasterY + $fee_part_b_yaxis);
					    $pdf->Cell(45, 5, $fee_part_b_l3_text, $bo, 0, 'L', 0);
					    $pdf->SetXY($MasterX + 162, $MasterY + $fee_part_b_yaxis);
					    $pdf->Cell(13, 5, $fee_part_b_l3_amount_c, $bo, 0, 'R', 0);

					    $pdf->SetXY($MasterX + 198, $MasterY + $fee_part_b_yaxis);
					    $pdf->Cell(45, 5, $fee_part_b_l3_text, $bo, 0, 'L', 0);
					    $pdf->SetXY($MasterX + 255.5, $MasterY + $fee_part_b_yaxis);
					    $pdf->Cell(13, 5, $fee_part_b_l3_amount_c, $bo, 0, 'R', 0);

				    }else{
				    	$pdf->SetXY($MasterX + 68.5, $MasterY + 132);
				    	$pdf->Cell(13, 5, '-', $bo, 0, 'R', 0);
				    	$pdf->SetXY($MasterX + 162, $MasterY + 132);
				    	$pdf->Cell(13, 5, '-', $bo, 0, 'R', 0);
				    	$pdf->SetXY($MasterX + 255.5, $MasterY + 132);
				    	$pdf->Cell(13, 5, '-', $bo, 0, 'R', 0);
				    }







				    if($isEAOPaid){
				    	$fee_part_b_yaxis = 146;
				    	$pdf->SetXY($MasterX + 10, $MasterY + $fee_part_b_yaxis);
					    $pdf->Cell(45, 5, $fee_part_c_l1_text, $bo, 0, 'L', 0);
					    $pdf->SetXY($MasterX + 68.5, $MasterY + $fee_part_b_yaxis);
					    $pdf->Cell(13, 5, "(" . $fee_part_c_l1_amount_c .")", $bo, 0, 'R', 0);


					    $pdf->SetXY($MasterX + 104, $MasterY + $fee_part_b_yaxis);
					    $pdf->Cell(45, 5, $fee_part_c_l1_text, $bo, 0, 'L', 0);
					    $pdf->SetXY($MasterX + 162, $MasterY + $fee_part_b_yaxis);
					    $pdf->Cell(13, 5, "(" . $fee_part_c_l1_amount_c .")", $bo, 0, 'R', 0);


					    $pdf->SetXY($MasterX + 198, $MasterY + $fee_part_b_yaxis);
					    $pdf->Cell(45, 5, $fee_part_c_l1_text, $bo, 0, 'L', 0);
					    $pdf->SetXY($MasterX + 255.5, $MasterY + $fee_part_b_yaxis);
					    $pdf->Cell(13, 5, "(" . $fee_part_c_l1_amount_c .")", $bo, 0, 'R', 0);

					    					    // FOR ADVANCE TAX
					    $fee_part_b_yaxis = 152.5;
				    	$pdf->SetXY($MasterX + 10, $MasterY + $fee_part_b_yaxis);
					    $pdf->Cell(45, 5, "Advance Tax to Govt on Parents' Behalf (adjustable)", $bo, 0, 'L', 0);
					    $pdf->SetXY($MasterX + 68.5, $MasterY + $fee_part_b_yaxis);
					    $pdf->Cell(13, 5,"-", $bo, 0, 'R', 0);


					    $pdf->SetXY($MasterX + 104, $MasterY + $fee_part_b_yaxis);
					    $pdf->Cell(45, 5,  "Advance Tax to Govt on Parents' Behalf (adjustable)", $bo, 0, 'L', 0);
					    $pdf->SetXY($MasterX + 162, $MasterY + $fee_part_b_yaxis);
					    $pdf->Cell(13, 5, "-", $bo, 0, 'R', 0);


					    $pdf->SetXY($MasterX + 198, $MasterY + $fee_part_b_yaxis);
					    $pdf->Cell(45, 5, "Advance Tax to Govt on Parents' Behalf (adjustable)", $bo, 0, 'L', 0);
					    $pdf->SetXY($MasterX + 255.5, $MasterY + $fee_part_b_yaxis);
					    $pdf->Cell(13, 5, "-", $bo, 0, 'R', 0);
				    }else{

				    	$fee_part_b_yaxis = 146;
				    	$pdf->SetXY($MasterX + 10, $MasterY + $fee_part_b_yaxis);
					    $pdf->Cell(45, 5, $fee_part_c_l1_text, $bo, 0, 'L', 0);
					    $pdf->SetXY($MasterX + 68.5, $MasterY + $fee_part_b_yaxis);
					    $pdf->Cell(13, 5,"-", $bo, 0, 'R', 0);


					    $pdf->SetXY($MasterX + 104, $MasterY + $fee_part_b_yaxis);
					    $pdf->Cell(45, 5, $fee_part_c_l1_text, $bo, 0, 'L', 0);
					    $pdf->SetXY($MasterX + 162, $MasterY + $fee_part_b_yaxis);
					    $pdf->Cell(13, 5, "-", $bo, 0, 'R', 0);


					    $pdf->SetXY($MasterX + 198, $MasterY + $fee_part_b_yaxis);
					    $pdf->Cell(45, 5, $fee_part_c_l1_text, $bo, 0, 'L', 0);
					    $pdf->SetXY($MasterX + 255.5, $MasterY + $fee_part_b_yaxis);
					    $pdf->Cell(13, 5, "-", $bo, 0, 'R', 0);

					     // FOR ADVANCE TAX
					    $fee_part_b_yaxis = 152.5;
				    	$pdf->SetXY($MasterX + 10, $MasterY + $fee_part_b_yaxis);
					    $pdf->Cell(45, 5, "Advance Tax to Govt on Parents' Behalf (adjustable)", $bo, 0, 'L', 0);
					    $pdf->SetXY($MasterX + 68.5, $MasterY + $fee_part_b_yaxis);
					    $pdf->Cell(13, 5,"-", $bo, 0, 'R', 0);


					    $pdf->SetXY($MasterX + 104, $MasterY + $fee_part_b_yaxis);
					    $pdf->Cell(45, 5,  "Advance Tax to Govt on Parents' Behalf (adjustable)", $bo, 0, 'L', 0);
					    $pdf->SetXY($MasterX + 162, $MasterY + $fee_part_b_yaxis);
					    $pdf->Cell(13, 5, "-", $bo, 0, 'R', 0);


					    $pdf->SetXY($MasterX + 198, $MasterY + $fee_part_b_yaxis);
					    $pdf->Cell(45, 5, "Advance Tax to Govt on Parents' Behalf (adjustable)", $bo, 0, 'L', 0);
					    $pdf->SetXY($MasterX + 255.5, $MasterY + $fee_part_b_yaxis);
					    $pdf->Cell(13, 5, "-", $bo, 0, 'R', 0);
				    }







				    if($ConcessionCode == 'C(TC)'){
				    	$fee_part_b_l1_amount_c = 15000;
						if($data['student'][0]->grade_id >= 15 && $data['student'][0]->grade_id <= 16){
							/*
							$fee_part_a_l1_amount_c = 33000;
							$fee_part_b_l1_amount_c = 12000;
							*/
							$fee_part_b_l1_text = "";
							$fee_part_b_l1_amount_c = "";
						}




						// It is OK. Dont chnage it.
						if($fee_part_b_l1_amount_c != ""){
							$fee_part_b_l1_amount_c = number_format($fee_part_b_l1_amount_c);
						}


						

						/***** Office Copy *****/
				    	$pdf->SetXY($MasterX + 10, $MasterY + 123);
					    $pdf->Cell(45, 5, $fee_part_b_l1_text, $bo, 0, 'L', 0);
					    $pdf->SetXY($MasterX + 68.5, $MasterY + 123);
					    $pdf->Cell(13, 5, $fee_part_b_l1_amount_c, $bo, 0, 'R', 0);

					    $pdf->SetXY($MasterX + 10, $MasterY + 127);
					    $pdf->Cell(45, 5, $fee_part_b_l2_text, $bo, 0, 'L', 0);
					    $pdf->SetXY($MasterX + 68.5, $MasterY + 127);
					    if($fee_part_b_l1_amount_c!= "") {$pdf->Cell(13, 5, '(' . $fee_part_b_l1_amount_c . ')', $bo, 0, 'R', 0);}


					    /***** Bank Copy *****/
				    	$pdf->SetXY($MasterX + 104, $MasterY + 123);
					    $pdf->Cell(45, 5, $fee_part_b_l1_text, $bo, 0, 'L', 0);
					    $pdf->SetXY($MasterX + 162, $MasterY + 123);
					    $pdf->Cell(13, 5, $fee_part_b_l1_amount_c, $bo, 0, 'R', 0);

					    $pdf->SetXY($MasterX + 104, $MasterY + 127);
					    $pdf->Cell(45, 5, $fee_part_b_l2_text, $bo, 0, 'L', 0);
					    $pdf->SetXY($MasterX + 162, $MasterY + 127);
					    if($fee_part_b_l1_amount_c!= "") {$pdf->Cell(13, 5, '(' . $fee_part_b_l1_amount_c . ')', $bo, 0, 'R', 0);}


					    /***** Parent Copy *****/
				    	$pdf->SetXY($MasterX + 198, $MasterY + 123);
					    $pdf->Cell(45, 5, $fee_part_b_l1_text, $bo, 0, 'L', 0);
					    $pdf->SetXY($MasterX + 255.5, $MasterY + 123);
					    $pdf->Cell(13, 5, $fee_part_b_l1_amount_c, $bo, 0, 'R', 0);

					    $pdf->SetXY($MasterX + 198, $MasterY + 127);
					    $pdf->Cell(45, 5, $fee_part_b_l2_text, $bo, 0, 'L', 0);
					    $pdf->SetXY($MasterX + 255.5, $MasterY + 127);
					    if($fee_part_b_l1_amount_c!= "") {$pdf->Cell(13, 5, '(' . $fee_part_b_l1_amount_c . ')', $bo, 0, 'R', 0);}
						/*
						$pdf->SetXY($MasterX + 10, $MasterY + 135);
					    $pdf->Cell(45, 5, $fee_part_a_l2_text, $bo, 0, 'L', 0);
					    $pdf->SetXY($MasterX + 68.5, $MasterY + 135);
					    $pdf->Cell(13, 5, $fee_part_a_l2_amount_c, $bo, 0, 'R', 0);*/
					}










					/***** Scholarship
				    ******************/
				    $thisGap = 0;
				    if($ScholarshipAmount > 0){
				    	$thisGap = 4;
				    	$ScholarshipAmount = '(' . number_format($ScholarshipAmount) . ')';
				    	$pdf->SetXY($MasterX + 10, $MasterY + 111);
				    	$pdf->Cell(13, 5, $ScholarshipCode, $bo, 0, 'L', 0);

				    	$pdf->SetXY($MasterX + 68.5 - 40, $MasterY + 111);
				    	$pdf->Cell(13, 5, $ScholarshipTotalPer, $bo, 0, 'R', 0);

				    	$pdf->SetXY($MasterX + 68.5 - 30, $MasterY + 111);
				    	$pdf->Cell(13, 5, $ScholarshipAmount_a, $bo, 0, 'R', 0);

				    	$pdf->SetXY($MasterX + 68.5 - 15, $MasterY + 111);
				    	$pdf->Cell(13, 5, $ScholarshipAmount_b, $bo, 0, 'R', 0);

				    	$pdf->SetXY($MasterX + 68.5, $MasterY + 111);
				    	$pdf->Cell(13, 5, $ScholarshipAmount, $bo, 0, 'R', 0);





				    	$pdf->SetXY($MasterX + 104, $MasterY + 111);
				    	$pdf->Cell(13, 5, $ScholarshipCode, $bo, 0, 'L', 0);

				    	$pdf->SetXY($MasterX + 162 - 40, $MasterY + 111);
				    	$pdf->Cell(13, 5, $ScholarshipTotalPer, $bo, 0, 'R', 0);

				    	$pdf->SetXY($MasterX + 162 - 30, $MasterY + 111);
				    	$pdf->Cell(13, 5, $ScholarshipAmount_a, $bo, 0, 'R', 0);

				    	$pdf->SetXY($MasterX + 162 - 15, $MasterY + 111);
				    	$pdf->Cell(13, 5, $ScholarshipAmount_b, $bo, 0, 'R', 0);

				    	$pdf->SetXY($MasterX + 162, $MasterY + 111);
				    	$pdf->Cell(13, 5, $ScholarshipAmount, $bo, 0, 'R', 0);





				    	$pdf->SetXY($MasterX + 198, $MasterY + 111);
				    	$pdf->Cell(13, 5, $ScholarshipCode, $bo, 0, 'L', 0);

				    	$pdf->SetXY($MasterX + 255.5 - 40, $MasterY + 111);
				    	$pdf->Cell(13, 5, $ScholarshipTotalPer, $bo, 0, 'R', 0);

				    	$pdf->SetXY($MasterX + 255.5 - 30, $MasterY + 111);
				    	$pdf->Cell(13, 5, $ScholarshipAmount_a, $bo, 0, 'R', 0);

				    	$pdf->SetXY($MasterX + 255.5 - 15, $MasterY + 111);
				    	$pdf->Cell(13, 5, $ScholarshipAmount_b, $bo, 0, 'R', 0);

				    	$pdf->SetXY($MasterX + 255.5, $MasterY + 111);
				    	$pdf->Cell(13, 5, $ScholarshipAmount, $bo, 0, 'R', 0);
				    }


				    /***** Concession
				    ******************/
				    $ConcessionAmount = '(' . number_format($ConcessionAmount) . ')';
				    if($Concession > 0){
				    	$pdf->SetXY($MasterX + 10, $MasterY + 111 + $thisGap);
				    	$pdf->Cell(13, 5, $ConcessionCode.' @' . $Concession, $bo, 0, 'L', 0);

				    	$pdf->SetXY($MasterX + 68.5 - 40 , $MasterY + 111 + $thisGap);
				    	$pdf->Cell(13, 5, $ConcessionTotalPer, $bo, 0, 'R', 0);

				    	$pdf->SetXY($MasterX + 68.5 - 30 , $MasterY + 111 + $thisGap);
				    	$pdf->Cell(13, 5, $ConcessionAmount_a, $bo, 0, 'R', 0);

				    	$pdf->SetXY($MasterX + 68.5 - 15, $MasterY + 111 + $thisGap);
				    	$pdf->Cell(13, 5, $ConcessionAmount_b, $bo, 0, 'R', 0);

				    	$pdf->SetXY($MasterX + 68.5, $MasterY + 111 + $thisGap);
				    	$pdf->Cell(13, 5, $ConcessionAmount, $bo, 0, 'R', 0);



				    	$pdf->SetXY($MasterX + 104, $MasterY + 111 + $thisGap);
				    	$pdf->Cell(13, 5, $ConcessionCode.' @' . $Concession, $bo, 0, 'L', 0);

				    	$pdf->SetXY($MasterX + 162 - 40, $MasterY + 111 + $thisGap);
				    	$pdf->Cell(13, 5, $ConcessionTotalPer, $bo, 0, 'R', 0);

				    	$pdf->SetXY($MasterX + 162 - 30, $MasterY + 111 + $thisGap);
				    	$pdf->Cell(13, 5, $ConcessionAmount_a, $bo, 0, 'R', 0);

				    	$pdf->SetXY($MasterX + 162 -15, $MasterY + 111 + $thisGap);
				    	$pdf->Cell(13, 5, $ConcessionAmount_b, $bo, 0, 'R', 0);

				    	$pdf->SetXY($MasterX + 162, $MasterY + 111 + $thisGap);
				    	$pdf->Cell(13, 5, $ConcessionAmount, $bo, 0, 'R', 0);




				    	$pdf->SetXY($MasterX + 198, $MasterY + 111 + $thisGap);
				    	$pdf->Cell(13, 5, $ConcessionCode.' @' . $Concession, $bo, 0, 'L', 0);

				    	$pdf->SetXY($MasterX + 255.5 - 40, $MasterY + 111 + $thisGap);
				    	$pdf->Cell(13, 5, $ConcessionTotalPer, $bo, 0, 'R', 0);

				    	$pdf->SetXY($MasterX + 255.5 - 30, $MasterY + 111 + $thisGap);
				    	$pdf->Cell(13, 5, $ConcessionAmount_a, $bo, 0, 'R', 0);

				    	$pdf->SetXY($MasterX + 255.5 - 15, $MasterY + 111 + $thisGap);
				    	$pdf->Cell(13, 5, $ConcessionAmount_b, $bo, 0, 'R', 0);

				    	$pdf->SetXY($MasterX + 255.5, $MasterY + 111 + $thisGap);
				    	$pdf->Cell(13, 5, $ConcessionAmount, $bo, 0, 'R', 0);
				    }



















				    /***** Total Payable
				    *********************/
				    $pdf->SetXY($MasterX + 73, $MasterY + 139);
				    $pdf->Cell(13, 5, $TotalCurrentBilling, $bo, 0, 'R', 0);

				    $pdf->SetXY($MasterX + 167, $MasterY + 139);
				    $pdf->Cell(13, 5, $TotalCurrentBilling, $bo, 0, 'R', 0);

				    $pdf->SetXY($MasterX + 260, $MasterY + 139);
				    $pdf->Cell(13, 5, $TotalCurrentBilling, $bo, 0, 'R', 0);





				    /***** Current Payable
				    **********************/
				    $pdf->SetXY($MasterX + 73, $MasterY + 158.5);
				    $pdf->Cell(13, 5, $TotalPayable, $bo, 0, 'R', 0);

				    $pdf->SetXY($MasterX + 167, $MasterY + 158.5);
				    $pdf->Cell(13, 5, $TotalPayable, $bo, 0, 'R', 0);

				    $pdf->SetXY($MasterX + 260, $MasterY + 158.5);
				    $pdf->Cell(13, 5, $TotalPayable, $bo, 0, 'R', 0);



					/***** Current Payable After Due Date
				    **********************/

				    $pdf->SetXY($MasterX + 73, $MasterY + 166);
				    $pdf->Cell(13, 5, "N/A", $bo, 0, 'R', 0);

				    $pdf->SetXY($MasterX + 167, $MasterY + 166);
				    $pdf->Cell(13, 5, "N/A", $bo, 0, 'R', 0);

				    $pdf->SetXY($MasterX + 260, $MasterY + 166);
				    $pdf->Cell(13, 5, "N/A", $bo, 0, 'R', 0);
				}
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