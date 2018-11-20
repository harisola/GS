<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fee_bill_upload_mis extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->fileMSG = 3;
		if(isset($_POST["submit"]))
		{
			$dateTime = date("Y-m-d_h-i-sa");
			$target_dir = $_SERVER['DOCUMENT_ROOT'] . "/gs/Assets/accounts/fee_bill_mis/";
			$titleRow = 10;
			$temp = explode(".", $_FILES["fileToUpload"]["name"]);
			$fullFileName = $dateTime . '(' . $temp[0] . ')' . '.' . end($temp);
			//$target_file = $target_dir . round(microtime(true)) . '.' . end($temp);
			$target_file = $target_dir . $fullFileName;
			//$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);			
			$uploadOk = 1;
			$errorMessage = "";
			$this->fileError = "";
			
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			/*// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
			    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			    if($check !== false) {
			        $errorMessage = "File is an image - " . $check["mime"] . ".";
			        $uploadOk = 1;
			    } else {
			        $errorMessage = "File is not an image.";
			        $uploadOk = 0;
			    }
			}*/



			// Check if file already exists
			if (file_exists($target_file)) {
			    $errorMessage = "Sorry, file already exists.";
			    $uploadOk = 0;
			}
			// Check file size
			if ($_FILES["fileToUpload"]["size"] > 5000000) {    //10000000 for 10MB,  5000000 for 5MB
			    $errorMessage = "Sorry, your file is too large.";
			    $uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "xls" && $imageFileType != "xlsx") {
			    $errorMessage = "Sorry, only XLS & XLSX files are allowed.";
			    $uploadOk = 0;
			}




			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
			    $errorMessage = "Sorry, your file was not uploaded.";			    
			// if everything is ok, try to upload file
			} else {
			    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			        $errorMessage = "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
			        $uploadOk = 1;
			    } else {
			        $errorMessage = "Sorry, there was an error uploading your file.";
			        $uploadOk = 0;
			    }
			}


			$data['header'] = "";
			$data['values'] = "";
			$header = "";
			$arr_data = "";
			
			if ($uploadOk == 1)
			{	
				$file = $target_dir . $fullFileName;

				//load the excel library
				$this->load->library('excel');
				//read file from path
				$objPHPExcel = PHPExcel_IOFactory::load($file);
				//get only the Cell Collection
				$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
				//extract to a PHP readable array format
				foreach ($cell_collection as $cell) {
				    $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
				    $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
				    $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
				    //header will/should be in row 1 only. of course this can be modified to suit your need.				    
				    if ($row <= $titleRow) {
				        $header[$row][$column] = $data_value;
				    } else {
				        $arr_data[$row][$column] = $data_value;
				    }
				}
				//send the data in an array format
				$data['header'] = $header;				
				$data['values'] = $arr_data;
			


				$this->load->model('accounts/fee_bill/fee_bill_upload_mis_model');
				$totalRecords = 0;
				foreach ($data['values'] as $BankMIS) {

					if($BankMIS['C'] != ''){
						$totalRecords++;
					}				
				}

				
				$totalRecords=$totalRecords+$titleRow;
				$dataRow = 0;
				for ($i=$titleRow+1; $i<=$totalRecords; $i++){
					$dateError = false;


					//*********************************\\
					// Checking possible errors of Date
					if(strlen($data['values'][$i]['C']) != 11 || $this->fee_bill_upload_mis_model->checkMonth(substr(trim($data['values'][$i]['C']),0,3)) == false){
						$uploadOk = 0;
						$this->fileError[$dataRow]['error_date'] = 'Date must be in string like :  ' . date("M-d-Y");
						$this->fileError[$dataRow]['date'] = '*' . trim($data['values'][$i]['C']);						
					}else{					
						$this->fileError[$dataRow]['date'] = trim($data['values'][$i]['C']);
					}
					//*********************************\\
					

					$this->fileError[$dataRow]['student_name'] = $data['values'][$i]['D'];
					$this->fileError[$dataRow]['grade_section'] = $data['values'][$i]['E'];


					//*********************************\\
					// Checking possible errors of GS-ID
					$GSID_Org = trim($data['values'][$i]['F']);
					$uploadedGBID = substr(trim($data['values'][$i]['G']), 2, 2);
					if($uploadedGBID != 81 && $uploadedGBID != 82){
						if(strlen($GSID_Org) == 5){
							$GSID_Org = str_pad($GSID_Org, 5, '0', STR_PAD_LEFT);
							$GSID_Org = substr($GSID_Org, 0, 2) . '-' . substr($GSID_Org, 2);
						}
						if(strlen($GSID_Org) != 6 || $this->fee_bill_upload_mis_model->checkGSID($GSID_Org) == false){
							$uploadOk = 0;
							if($GSID_Org == ''){
								$this->fileError[$dataRow]['error_gsid'] = 'GS-ID is missing';
							} else if(strlen($GSID_Org) != 6){
								$this->fileError[$dataRow]['error_gsid'] = 'This GS-ID is invalid';
							}else if($this->fee_bill_upload_mis_model->checkGSID($GSID_Org) == false){
								$this->fileError[$dataRow]['error_gsid'] = 'GS-ID   NOT   found in Database ' . $GSID_Org;
							}

							$this->fileError[$dataRow]['gs_id'] = '*' . trim($data['values'][$i]['F']);
						}else{					
							$this->fileError[$dataRow]['gs_id'] = trim($data['values'][$i]['F']);
						}
					}else{
						$this->fileError[$dataRow]['gs_id'] = trim($data['values'][$i]['F']);	
					}
					//*********************************\\
					



					//*********************************\\
					// Checking possible errors of Bill No

					$thisGBID = trim($data['values'][$i]['G']);
					if($uploadedGBID != 81 && $uploadedGBID != 82){
						$lastBillNumber = $this->fee_bill_upload_mis_model->getLastBillNumber($GSID_Org, $thisGBID);
					}else{
						$lastBillNumber = $thisGBID;
					}
					//$thisGBID = $this->fee_bill_upload_mis_model->convertBankGBIDtoGBID(trim($data['values'][$i]['G']));
					$this->fileError[$dataRow]['error_billno'] = '';
					if($uploadedGBID != 81 && $uploadedGBID != 82){
						if(strlen($data['values'][$i]['G']) != 10 || $this->fee_bill_upload_mis_model->checkBillID($thisGBID) == false ||
							$this->fee_bill_upload_mis_model->matchBillNo_GSID($thisGBID, $GSID_Org) == false ||
							$lastBillNumber != $thisGBID
						   ){
						   	$uploadOk = 0;
						   	if($data['values'][$i]['G'] == ''){
								$this->fileError[$dataRow]['error_billno'] = 'Bill Number is missing';					   	
						   	}else if(strlen($data['values'][$i]['G']) != 10){
								$this->fileError[$dataRow]['error_billno'] = 'This Bill Number is invalid';					   	
							}else if($this->fee_bill_upload_mis_model->checkBillID($thisGBID) == false){
								$this->fileError[$dataRow]['error_billno'] = 'This Bill Number  NOT  found in Database';						
							}else if($this->fee_bill_upload_mis_model->matchBillNo_GSID($thisGBID, $GSID_Org) == false){
					   			$this->fileError[$dataRow]['error_billno'] = 'Bill Number Mismatched GS-ID';						
							}else if($lastBillNumber != $thisGBID){
								$this->fileError[$dataRow]['error_billno'] = 'Correct Bill Number is : ' . $lastBillNumber;
							}
							$this->fileError[$dataRow]['bill_no'] = '*' . $data['values'][$i]['G'];
						}else{					
							$this->fileError[$dataRow]['bill_no'] = trim($data['values'][$i]['G']);
						}
					}else{
						$this->fileError[$dataRow]['bill_no'] = trim($data['values'][$i]['G']);
					}
					//*********************************\\





					//*********************************\\
					// Checking possible errors of Bill receiving amount
					$correctFeeAmount = $this->fee_bill_upload_mis_model->getCorrectFeeAmount($lastBillNumber);
					$billReceivedAmount = floatval($data['values'][$i]['H']);
					if($billReceivedAmount <= 0 || $this->fee_bill_upload_mis_model->matchBillAmount($thisGBID, $billReceivedAmount) == false){
						$uploadOk = 0;
						if($this->fee_bill_upload_mis_model->matchBillAmount($thisGBID, $billReceivedAmount) == false){
							if($data['values'][$i]['G'] == ''){
								$this->fileError[$dataRow]['error_billamount'] = 'Bill Number is missing';
							}else{
								if($correctFeeAmount <= 0){
									$this->fileError[$dataRow]['error_billamount'] = 'Please check Bill Number';
								}else{
									$this->fileError[$dataRow]['error_billamount'] = 'Bill No. : ' . str_replace(" / ", "-",$lastBillNumber) . ' payable amount is ' . $correctFeeAmount;
								}
							}
						}
						$this->fileError[$dataRow]['fee_amount'] = '*' . $billReceivedAmount;
					}else{					
						$this->fileError[$dataRow]['fee_amount'] = $billReceivedAmount;
					}					
					//*********************************\\
					


					//*********************************\\
					// Checking possible errors of Late Fee
					if(floatval(trim($data['values'][$i]['I'])) == 0 || floatval($data['values'][$i]['I']) == 600){						
						$this->fileError[$dataRow]['late_fee'] = $data['values'][$i]['I'];
					}else{
						$uploadOk = 0;
						$this->fileError[$dataRow]['late_fee'] = '*' . floatval(trim($data['values'][$i]['I']));
						if(floatval($data['values'][$i]['I']) < 0){
							$this->fileError[$dataRow]['error_latefee'] = 'Late fee can not be a negative value';
						}else if(floatval($data['values'][$i]['I']) > 600){
							$this->fileError[$dataRow]['error_latefee'] = 'Late fee amount can not be more than 600';
						}						
					}
					//*********************************\\


					$this->fileError[$dataRow]['bank_mode'] = $data['values'][$i]['J'];
					$this->fileError[$dataRow]['bank_branch'] = $data['values'][$i]['K'];
					
					$this->fileError[$dataRow]['row'] = $dataRow+11;
					$dataRow++;
				}




				$this->fileMSG = $uploadOk;
				if($uploadOk == 1){
					for ($i=$titleRow+1; $i<=$totalRecords; $i++){
						$file_date = strtoupper(trim($data['values'][$i]['C']));
						$file_date_month_str = substr($file_date, 0, 3);
						$file_date_month_dec = '00';
						if($file_date_month_str == 'JAN'){
							$file_date_month_dec = '01';
						}else if($file_date_month_str == 'FEB'){
							$file_date_month_dec = '02';
						}else if($file_date_month_str == 'MAR'){
							$file_date_month_dec = '03';
						}else if($file_date_month_str == 'APR'){
							$file_date_month_dec = '04';
						}else if($file_date_month_str == 'MAY'){
							$file_date_month_dec = '05';
						}else if($file_date_month_str == 'JUN'){
							$file_date_month_dec = '06';
						}else if($file_date_month_str == 'JUL'){
							$file_date_month_dec = '07';
						}else if($file_date_month_str == 'AUG'){
							$file_date_month_dec = '08';
						}else if($file_date_month_str == 'SEP'){
							$file_date_month_dec = '09';
						}else if($file_date_month_str == 'OCT'){
							$file_date_month_dec = '10';
						}else if($file_date_month_str == 'NOV'){
							$file_date_month_dec = '11';
						}else if($file_date_month_str == 'DEC'){
							$file_date_month_dec = '12';
						}

						$file_date_day_dec = substr($file_date, 4, 2);
						$file_date_year_dec = substr($file_date, 7, 4);

						$this->db_fee_bill = $this->load->database('fee_bill_student_db',TRUE);
						$upload_date = $file_date_year_dec . '-' . $file_date_month_dec . '-' . $file_date_day_dec;
						$upload_gsid = trim($data['values'][$i]['F']);
						//$upload_gbid = $this->fee_bill_upload_mis_model->convertBankGBIDtoGBID(trim($data['values'][$i]['G']));
						$uploaded_gbid = trim($data['values'][$i]['G']);
						$upload_feeamount = floatval(trim($data['values'][$i]['H']));
						$upload_latefee = floatval(trim($data['values'][$i]['I']));
						$upload_bank_mode = trim($data['values'][$i]['J']);
						$upload_bank_branch = trim($data['values'][$i]['K']);
						$upload_sc_ids = $this->fee_bill_upload_mis_model->getOCSmartCardIds(trim($data['values'][$i]['G']));
						$feebill_id = $this->fee_bill_upload_mis_model->getFeeBillID(trim($data['values'][$i]['G']));

						$feebill_data = array(
							'fee_bill_id' => $feebill_id,
							'received_date' => $upload_date,
							'received_amount' => $upload_feeamount,
							'received_late_fee' => $upload_latefee,
							'received_payment_mode' => $upload_bank_mode,
							'received_branch' => $upload_bank_branch,
							'is_void' => 0,
							'record_deleted' => 0
						);
						$this->load->model('accounts/fee_bill/fee_bill_receiving_model');
						$FeeBillReceivingID = $this->fee_bill_receiving_model->receivingExists($feebill_id);
						if($FeeBillReceivingID == 0){
							$feebill_saved = $this->fee_bill_receiving_model->save($feebill_data);
							/******************************************************/
							/* Student Registration is here if Admission Fee paid */
							/******************************************************/
							if($uploadedGBID == 81 || $uploadedGBID == 82){
								$this->load->model('admission/admission_compelete_check_model','adm');
								//CHANGE HERE
								if($this->adm->ShouldRegisterStudent(substr($thisGBID, 5, 4))){
									$this->RegisterThisStudent(trim($data['values'][$i]['G']), $upload_date, $upload_bank_branch);
								}
							}
							
						}else{
							$feebill_saved = $this->fee_bill_receiving_model->save($feebill_data, $FeeBillReceivingID);
						}						



						$this->db_atif = $this->load->database('default',TRUE);
						$this->load->model('front_office/req_duplicatecard_model');
						$upload_sc_id = explode(",", $upload_sc_ids);
						foreach ($upload_sc_id as $id) {
							$sc_data = array(
								'amount_rec' => 1,
								'amount_rec_date' => $upload_date
							);							
							$this->req_duplicatecard_model->save($sc_data, $id);
						}
					}
				}
				$this->load->view('accounts/fee_bill_upload_mis/fee_bill_upload_mis_view');
				$this->load->view('accounts/fee_bill_upload_mis/fee_bill_upload_mis_errors_view');
			}else{
				$this->load->view('accounts/fee_bill_upload_mis/fee_bill_upload_mis_view');
			}
		}else{
			$this->load->view('accounts/fee_bill_upload_mis/fee_bill_upload_mis_view');
		}		
		$this->load->view('accounts/fee_bill_upload_mis/fee_bill_upload_mis_footer_orb');
	}











	public function RegisterThisStudent($FeeBillID, $ReceivedDate, $ReceivedBranch){
			$this->load->model('front_office/family_registered_model');
			$FormNo = substr($FeeBillID, 5, 4);
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
			if($isNewFamily){
				$data = array(
				'nic' => $NIC,
				'gf_id' => $GFID,
				'name' => $FatherName,
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
					'parent_type' => 1
				);
				$this->student_family_work_detail_model->save($data);

				$data = array(
					'gf_id' => $GFID,
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