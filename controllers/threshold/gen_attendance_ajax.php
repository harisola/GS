<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Gen_attendance_ajax extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}


	public function getDefault_ScreenLayout(){
		$html = '';

		$html .= '
			<div class="inner-spacer" role="content" style="height: 75vh;">
				<div class="requestTapIn textCenter" style="background: #FFFFFF;">
		        	<div class="imageCenterDefault">
		        		<img src="'.base_url().'components/gs_theme/images/nfc_updated.png" width="160" />
		        	</div><!-- imageCenter -->
		        </div><!-- requestTapIn -->
		    </div>
		';


		echo $html;
	}










	public function get_TapIn_Information()
	{
		$html = '';

		$now = date('Y-m-d H:i:s');
		$RFID_Dec = $this->input->post('rfid_dec');
		$this->load->model('staff_attendance/staff_attendance_in_model');
		$TapinData = $this->staff_attendance_in_model->getStaffAttendanceData($RFID_Dec);
		
		$dap_color = '';
		$dap_code = '';
		
		if(!empty($TapinData)){
			$dap_color = $TapinData[0]["dap_color"];
			$dap_code = $TapinData[0]["dap_code"];	
		}
		
		

		$HighlightColor = '#e21b1b'; //ffe760
		$FillColor = '#FFFFFF'; /*#FFF555*/
		
		if( $dap_code != '' ){
			$FillColor = "#".$dap_color;	
			$bg ="#".$dap_color;
		}else{
			$FillColor = '#FFFFFF'; /*#FFF555*/
			$bg = '';
		}
		


		//Save data parameters
		$type_id = 1;			
		$no_of_person = 1;
		$name = "";
		$nic = "";
		$gender = '';
		$mobile_phone = "";
		$purpose = '';
		$contact_person = '';
		$contact_department = '';
		$description = '';
		$rfid_dec = $RFID_Dec;
		$rfid_hex = dechex(intval($rfid_dec));			
		$time_in = human_to_unix($now);
		$updateID = 0;


		//var_dump($TapinData);
		//var_dump($RFID_Dec);

		$FatherName = '';
		$MotherName = '';
		$SiblingsData = array();
		$sibling_photo = ""; 
		$father_photo = base_url() . 'assets/photos/sis/500x500/male.png';
		$mother_photo = base_url() . 'assets/photos/sis/500x500/female.png';
		$father_photo_found = false;
		$mother_photo_found = false;
		$fatherIN = 'grayBorder';
		$fatherOUT = 'grayBorder';
		$motherIN = 'grayBorder';
		$motherOUT = 'grayBorder';
		$siblings_data = '';

		$staffPhoto = "";
		$staff_photo_m = base_url() . 'assets/photos/sis/500x500/male.jpg';
		$staff_photo_f= base_url() . 'assets/photos/sis/500x500/female.jpg';
		
		
		


		if(!empty($TapinData) && $TapinData[0]['staff_id'] != ''){
			$IsPersonIN = $this->staff_attendance_in_model->checkIsLastIN($TapinData[0]['staff_id']);
			if($IsPersonIN){
				$layout = 3; // OUT
			}else{
				$layout = 2; // IN
			}



			$FatherName = $TapinData[0]['name'];
			$MotherName = '';
			$description = $TapinData[0]['gen_id'];

			if($TapinData[0]['marked'] == 1){
				$FillColor = $HighlightColor;
			}



			$staffPhoto = 'assets/photos/hcm/500x500/staff/' . $TapinData[0]['photo_id'] . '.jpg';
			if(!file_exists($staffPhoto)){
				if($TapinData[0]['gender'] == 'F'){
					$staffPhoto = $staff_photo_f;
				}else{
					$staffPhoto = $staff_photo_m;
				}
			}else{
				$staffPhoto = base_url() . 'assets/photos/hcm/500x500/staff/' . $TapinData[0]['photo_id'] . '.jpg';
			}


			






			/***** ***** ***** Init of Saving data & SMS ***** ***** *****/
			$thisDate = date("D d, M 'y");
			$thisTime = date("h:i:s A");

			/*******************************************************
			* IP Address
			* ******************************************************/
			$ip = '';
			if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			    $ip = $_SERVER['HTTP_CLIENT_IP'];
			} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			} else {
			    $ip = $_SERVER['REMOTE_ADDR'];
			}



			/***** ***** ***** Saving IN & OUT of Staff ***** ***** *****/
			$this->load->model('staff_attendance/staff_attendance_out_model');

			if($layout == 2){
				$data = array(
					'staff_id' => $TapinData[0]['staff_id'],
					'date' => date("Y-m-d"),
					'time' => date("H:i:s"),
					'ip4' => $ip,
					'location_id' => 3,
					'created' => $time_in,
					'modified' => $time_in,
					'register_by' => 1,
					'modified_by' => 1,
				);
				$this->staff_attendance_in_model->save($data);




				/***** ***** ***** Sending SMS ***** ***** *****/
				
				$messageTemplate = "[SALUTATION]. [NAME]
Today [CURRENTDATE]
Threshold tap-in [TRSTAPIN]
Attendance tap-in [ATDTAPIN]
SMS Time [SMSTIME]";
				$sms = $messageTemplate;
				$sms = str_replace("[SALUTATION]", $TapinData[0]['salutation'], $sms);
				$sms = str_replace("[NAME]", $TapinData[0]['name'], $sms);
				$sms = str_replace("[CURRENTDATE]", $thisDate, $sms);
				if($TapinData[0]['time_in_th'] == ''){
					$sms = str_replace("[TRSTAPIN]", '--:--:--', $sms);
				}else{
					$sms = str_replace("[TRSTAPIN]", $TapinData[0]['time_in_th'], $sms);			
				}
				if($TapinData[0]['time_in_atd'] == ''){
					$sms = str_replace("[ATDTAPIN]", $thisTime, $sms);
				}else{
					$sms = str_replace("[ATDTAPIN]", $TapinData[0]['time_in_atd'], $sms);
				}
				$sms = str_replace("[SMSTIME]", $thisTime, $sms);


				$this->staff_attendance_in_model->makeSMSPool($TapinData[0]['mobile_phone'], $sms);
				
				/*
				$ClientID = '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36';
				$ClientSecret = 'vQ{}vQ{}vQ{}';
				$url = 'http://10.10.10.63/sms/sms_zong_api.php';
				$str = "?action=out&clientid=".urlencode($ClientID)."&clientsecret=".urlencode($ClientSecret)."&mobilephone=".urlencode($TapinData[0]['mobile_phone'])."&message=".urlencode($sms);
				$url = $url.$str;

				/*
				$curl = curl_init();
				curl_setopt($curl, CURLOPT_URL, $url);
			    curl_setopt ($curl, CURLOPT_POST, TRUE);

			    curl_setopt($curl, CURLOPT_USERAGENT, 'api');
			    curl_setopt($curl, CURLOPT_TIMEOUT, 1);
			    curl_setopt($curl, CURLOPT_HEADER, 0);
			    curl_setopt($curl, CURLOPT_RETURNTRANSFER, false);
			    curl_setopt($curl, CURLOPT_FORBID_REUSE, true);
			    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 1);
			    curl_setopt($curl, CURLOPT_DNS_CACHE_TIMEOUT, 10); 

			    curl_setopt($curl, CURLOPT_FRESH_CONNECT, true);

			    $curlData = curl_exec($curl);
			    curl_close($curl);
				*/
				

				/*
				//open connection
				$ch = curl_init();

				//curl_setopt($ch, CURLOPT_HEADER, 1);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				//curl_setopt($ch, CURLOPT_HTTPGET, 1);
				curl_setopt($ch, CURLOPT_URL, $url);
				//curl_setopt($ch, CURLOPT_DNS_USE_GLOBAL_CACHE, false);
				//curl_setopt($ch, CURLOPT_DNS_CACHE_TIMEOUT, 2);

				//curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
				curl_setopt($ch, CURLOPT_TIMEOUT, 1);
				curl_exec($ch);
				*/
				

			}else if($layout == 3){
				$data = array(
					'staff_id' => $TapinData[0]['staff_id'],
					'date' => date("Y-m-d"),
					'time' => date("H:i:s"),
					'ip4' => $ip,
					'location_id' => 3,
					'created' => $time_in,
					'modified' => $time_in,
					'register_by' => 1,
					'modified_by' => 1,
				);
				$this->staff_attendance_out_model->save($data);
			}
		}else{
			$layout = 1;
		}
		



		if($layout == 1){
			$html .= '
			<div class="inner-spacer" role="content" style="background: '.$FillColor.';">
				<div class="requestTapIn textCenter">
		        	<div class="imageCenterDefault">
		        		<img src="'.base_url().'components/gs_theme/images/nfc_updated.png" width="160" />
		        	</div><!-- imageCenter -->
		        	<div class="Error">
	                    <h2 style="font-weight:normal;color:#000;">Record not found!</h2>
	                </div><!-- timeIn -->
		        </div><!-- requestTapIn -->
		    </div>
			';
		}else if($layout == 2){
			$html .= '
			<div class="inner-spacer" role="content" style="background: '.$FillColor.';">
				<div class="requestTapIn textCenter">
	            	<div class="imageCenter IN">
	                	<div class="col-md-12 '.$fatherIN.'">
	                    	<img src="'.$staffPhoto.'" width="450" /><br /><br />
	                    	<h2 style="font-weight:normal;color:#000;">'.$FatherName.'</h2>
	                    </div><!-- col-md-12 -->
	                    <hr />
	                    <div class="col-md-12">
	                        <div class="timeIn">
	                            <span class="leftFloat">Time In </span>
	                            <span class="rightFloat">'.date("h:i A").'</span>
	                        </div><!-- timeIn -->
	                    </div><!-- col-md-12 -->
	            	</div><!-- imageCenter -->
	            </div><!-- requestTapIn -->
	        </div>
			';
		}else if($layout == 3){
			$html .= '
			<div class="inner-spacer" role="content" style="background: '.$FillColor.';">
				<div class="requestTapIn textCenter">
	            	<div class="imageCenter OUT">
	                	<div class="col-md-12 '.$fatherOUT.'">
	                    	<img src="'.$staffPhoto.'" width="450" /><br /><br />
	                    	<h2 style="font-weight:normal;color:#000;">'.$FatherName.'</h2>
	                    </div><!-- col-md-12 -->
	                    <hr />
	                    <div class="col-md-12">
	                        <div class="timeOut">
	                            <span class="leftFloat">Time Out </span>
	                            <span class="rightFloat">'.date("h:i A").'</span>
	                        </div><!-- timeIn -->
	                    </div><!-- col-md-12 -->
	            	</div><!-- imageCenter -->
	            </div><!-- requestTapIn -->
	        </div>
			';
		}




		


		/*************************************** Returning Data *****/
		$h2 ='';
		
		if( $dap_code != '' ){
			$h2 .= $this->location_code($bg,$dap_code);	
		}else{
			$h2 =''; 
		}
		





		
		
		
		$return = array("h1" => $html, "h2" => $h2 );
		echo json_encode($return);

		//echo $html;
	}
	
	public function location_code($bg,$dap_code){
		$html = '';
		$html .='<div class="inner-spacer nopadding" role="content" style="background-color:'.$bg.';">
		<strong style="font-size: 150px;">'.$dap_code.'</strong></div>';
		return $html;
	}
	
}