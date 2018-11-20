<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Tapin_ajax extends CI_Controller {
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
		$this->load->model('class_list/student_basic_profile_model');
		$ParentData = $this->student_basic_profile_model->get_parent_data_rfidDec($RFID_Dec);
		
		$dap_color = '';
		$dap_code = '';
		
		if(!empty($ParentData)){
			$dap_color = $ParentData[0]["dap_color"];
			$dap_code = $ParentData[0]["dap_code"];	
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


		//var_dump($ParentData);
		//var_dump($RFID_Dec);

		$FatherName = '';
		$MotherName = '';
		$SiblingsData = array();
		$sibling_photo = ""; 
		$father_photo = base_url() . 'assets/photos/sis/150x150/male.png';
		$mother_photo = base_url() . 'assets/photos/sis/150x150/female.png';
		$father_photo_found = false;
		$mother_photo_found = false;
		$fatherIN = 'grayBorder';
		$fatherOUT = 'grayBorder';
		$motherIN = 'grayBorder';
		$motherOUT = 'grayBorder';
		$siblings_data = '';


		$IsPersonIN = $this->student_basic_profile_model->checkIsParentIN($RFID_Dec);
		

		if(!empty($IsPersonIN)){
			$layout = 3;
			$updateID = $IsPersonIN[0]['id'];
		}else{
			$layout = 2;
		}
		
		if(!empty($ParentData)){
			$FatherName = $ParentData[0]['name'];
			$MotherName = $ParentData[1]['name'];
			$description = $ParentData[1]['gf_id'];

			if($ParentData[0]['marked'] == 1){
				$FillColor = $HighlightColor;
			}

			if($ParentData[0]['rfid_dec'] == $RFID_Dec){
				$name = $ParentData[0]['name'];
				$nic  = $ParentData[0]['nic'];
				$mobile_phone  = $ParentData[0]['mobile_phone'];
				$gender = 'F';

				if($updateID == 0){
					$fatherIN = '';
					$motherIN = 'grayBorder';
				}else{
					$fatherOUT = '';
					$motherOUT = 'grayBorder';
				}
			}else{
				$name = $ParentData[1]['name'];
				$nic  = $ParentData[1]['nic'];
				$mobile_phone  = $ParentData[1]['mobile_phone'];
				$gender = 'F';

				if($updateID == 0){
					$motherIN = '';
					$fatherIN = 'grayBorder';
				}else{
					$motherOUT = '';
					$fatherOUT = 'grayBorder';
				}
			}



			$SiblingsData = $this->student_basic_profile_model->get_siblings_data_GFID($ParentData[0]['gf_id']);



			foreach ($SiblingsData as $sibling) {
			  // checking father, mother photo
			  if(!$father_photo_found){
			    $father_photo = base_url() . 'assets/photos/sis/150x150/father/' . $sibling['gr_no'] . '.png';
			    if(file_exists('assets/photos/sis/150x150/father/' . $sibling['gr_no'] . '.png')){
			      $father_photo_found = true;
			    }
			  }
			  if(!$mother_photo_found){
			    $mother_photo = base_url() . 'assets/photos/sis/150x150/mother/' . $sibling['gr_no'] . '.png';
			    if(file_exists('assets/photos/sis/150x150/mother/' . $sibling['gr_no'] . '.png')){
			      $mother_photo_found = true;
			    }
			  }


			  	// checking siblings photo
	            $sibling_photo = base_url() . 'assets/photos/sis/150x150/student/' . $sibling['gr_no'] . '.png';
	            if(!file_exists('assets/photos/sis/150x150/student/' . $sibling['gr_no'] . '.png')){
	              if($sibling['gender'] == 'B' || $sibling['gender'] == 'b'){
	                $sibling_photo = base_url() . 'assets/photos/sis/150x150/male.png';
	              }else{
	                $sibling_photo = base_url() . 'assets/photos/sis/150x150/female.png';
	              }
	            }





	            $siblings_data .= '
	            	<div class="col-md-2">
                    	<img src="'.$sibling_photo.'" width="80" /><br />
                		<h4>'.$sibling['call_name'].'</h4>
                		<h5>'.$sibling['grade_name'].'-'.$sibling['section_name'].'</h5>
                		<div style="background: #'.$sibling['status_color_hex'].';"><h5>'.$sibling['std_status_code'].'</h5></div>
                    </div><!-- col-md-2 -->
	            ';
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
	                    <h2>Record not found!</h2>
	                </div><!-- timeIn -->
		        </div><!-- requestTapIn -->
		    </div>
			';
		}else if($layout == 2){
			$html .= '
			<div class="inner-spacer" role="content" style="background: '.$FillColor.';">
				<div class="requestTapIn textCenter">
	            	<div class="imageCenter IN">
	                	<div class="col-md-6 '.$fatherIN.'">
	                    	<img src="'.$father_photo.'" width="220" /><br /><br />
	                    	<h4>'.$FatherName.'</h4>
	                    </div><!-- col-md-6 -->
	                    <div class="col-md-6 '.$motherIN.'">
	                    	<img src="'.$mother_photo.'" width="220" /><br /><br />
	                    	<h4>'.$MotherName.'</h4>
	                    </div><!-- col-md-6 -->
	                    <hr />
	                    <div class="col-md-12 SiblingsHere textCenter">
	                    	'.$siblings_data.'
	                    </div><!-- -->
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
	                	<div class="col-md-6 '.$fatherOUT.'">
	                    	<img src="'.$father_photo.'" width="220" /><br /><br />
	                    	<h4>'.$FatherName.'</h4>
	                    </div><!-- col-md-6 -->
	                    <div class="col-md-6 '.$motherOUT.'">
	                    	<img src="'.$mother_photo.'" width="220" /><br /><br />
	                    	<h4>'.$MotherName.'</h4>
	                    </div><!-- col-md-6 -->
	                    <hr />
	                    <div class="col-md-12 SiblingsHere textCenter">
	                        '.$siblings_data.'
	                    </div><!-- -->
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






		/*************************************** Saving data to Visitor *****/
		if(count($_POST))
		{
			$this->load->model('threshold/visitor_parent_model');


			if($layout == 2){
				$data = array(
					'type_id' => $type_id,
					'no_of_persons' => $no_of_person,
					'name' => $name,
					'nic' => $nic,
					'mobile_phone' => $mobile_phone,
					'purpose' => ucwords(strtolower($purpose)),
					'contact_person' => ucwords(strtolower($contact_person)),
					'contact_department' => ucwords(strtolower($contact_department)),
					'description' => $description,
					'rfid_dec' => $rfid_dec,
					'rfid_hex' => ucwords($rfid_hex),
					'time_in' => $time_in,
					'gender' => $gender,
					'time_out' => 0,
					'register_by' => (int)$this->session->userdata['user_id'],
					'modified_by' => (int)$this->session->userdata['user_id'],
				);
				$this->visitor_parent_model->save($data);
			}else if($layout == 3){
				$data = array(
					'time_out' => $time_in
				);
				$this->visitor_parent_model->save($data, $updateID);
			}
			

		}
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