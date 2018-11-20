<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Interaction_centre_review_oa extends MY_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		// if user has rights to edit the applicant data
		if($this->data['can_user_view'] == 1 && $this->data['can_user_edit'] == 1 && $this->data['can_user_delete'] == 0){

			$this->load->model('hcm/career_ic_allowed_model');
	    	$this->load->model('staff/staff_registered_model');
			$staff_data = array($this->staff_registered_model->get_by(array('user_id' => (int)$this->session->userdata('user_id'))));
			$staff_ic_allowed = (array($this->career_ic_allowed_model->get_by(array('staff_id' => $staff_data[0][0]->id))));			


		    $this->load->model('hcm/career_form_model');
			$this->load->model('hcm/career_form_uni_model');
			$this->load->model('hcm/career_form_emp_model');
			$this->load->model('hcm/career_form_interaction_flow');			
		    $this->load->model('hcm/career_form_interaction_send_received');

		    if(isset($staff_ic_allowed[0][1]->interaction_centre_id)){
				$this->online['applicant_data'] = array($this->career_form_model->getStage2HRFormData_ICID2($staff_ic_allowed[0][0]->interaction_centre_id, $staff_ic_allowed[0][1]->interaction_centre_id));	
			}else{
				$this->online['applicant_data'] = array($this->career_form_model->getStage2HRFormData_ICID($staff_ic_allowed[0][0]->interaction_centre_id));
			}
			/*$this->online['applicant_data'] = array($this->career_form_model->getStage2HRFormData_ICID($staff_ic_allowed[0][0]->interaction_centre_id));*/
			$this->load->view('hcm/career/interaction_centre_review_view_oa');
		}		

		// Loading footer in the end		
		$this->load->view('hcm/career/career_view_forms_footer');
	}


	public function add(){
		if(count($_POST))
		{
			$this->load->model('hcm/career_form_recommended_by_ic_model');
			$tags="";
			if(empty($this->input->post('tag'))){
				$tags = "";
			}else{
				$tags = substr(implode(', ', $this->input->post('tag')), 0);
			}

			$data = array(
				'career_id' => $this->input->post('career_id'),
				'forward_interaction_centre_id' => $this->input->post('interaction_centre_id'),
				'forward_interaction_id' => $this->input->post('interaction_id'),
				'forward_grade_id' => $this->input->post('grade_id'),
				'forward_comments' => $this->input->post('forward_comments'),
				'recommended_by_centre' => $this->input->post('recommended_by_centre'),
				'forward_tags' => $tags
			);

			$flow_id = (int)$this->career_form_recommended_by_ic_model->save($data);
			redirect('/hcm/interaction_centre_review_oa', 'refresh');
		}
	}


	public function add2(){
		if(count($_POST))
		{
			$this->load->model('hcm/career_form_interaction_send_received');
			$now = date('Y-m-d H:i:s');
			$data = array(
				'career_id' => $this->input->post('career_id'),
				'form_location' => 3, // Forwarded by IC to HR
				'form_send_interaction_center_id' => $this->input->post('interaction_centre_id'),
				'form_send_datetime' => human_to_unix($now)
			);

			$flow_id = (int)$this->career_form_interaction_send_received->save($data);			
			redirect('/hcm/interaction_centre_review_oa', 'refresh');
		}
	}


	public function edit(){
		if(count($_POST))
		{
			$this->load->model('hcm/career_form_interaction_send_received');
			$form_received_id = $this->input->post('form_received_id');
			$now = date('Y-m-d H:i:s');
			$data = array(				
				'form_received_datetime' => human_to_unix($now),
				'form_location' => 2, // Received by IC
			);

			$flow_id = (int)$this->career_form_interaction_send_received->save($data, $form_received_id);			
			redirect('/hcm/interaction_centre_review_oa', 'refresh');
		}
	}




	public function printForm()
	{
		if(count($_POST))
		{
			$this->getPDFNow($this->input->post('career_id'));
		}
	}



	public function getPDFNow($career_id)
	{		
		$this->load->model('hcm/career_form_model');
		$this->load->model('hcm/career_form_uni_model');
		$this->load->model('hcm/career_form_emp_model');

		// Loading data to array
		$online['applicant_form'] = array($this->career_form_model->get_by(array('id =' => $career_id)));
		$online['applicant_form_uni'] = array($this->career_form_uni_model->get_by(array('career_id =' => $career_id)));
		$online['applicant_form_emp'] = array($this->career_form_emp_model->get_by(array('career_id =' => $career_id)));
		

		
		$form_id = $online['applicant_form'][0][0]->gc_id;
		$name = $online['applicant_form'][0][0]->name;
		$gender = $online['applicant_form'][0][0]->gender;
		$nic = $online['applicant_form'][0][0]->nic;
		$mobilephone = $online['applicant_form'][0][0]->mobile_phone;
		$landline = $online['applicant_form'][0][0]->landline;
		$position = $online['applicant_form'][0][0]->position_applied;
		$datetime = explode(" ",unix_to_human($online['applicant_form'][0][0]->created));
		$formDate = $datetime[0];
		$formTime = $datetime[1];
		$DOB = date('d-M-Y', strtotime($online['applicant_form'][0][0]->dob));
		$countryCode = $online['applicant_form'][0][0]->nationality;

		$countryName = "";
		if ($countryCode == "PK"){ $countryName = "Pakistan"; }	
		else if ($countryCode == "AF"){ $countryName = "Afghanistan"; }
		else if ($countryCode == "AL"){ $countryName = "Albania"; }
		else if ($countryCode == "DZ"){ $countryName = "Algeria"; }
		else if ($countryCode == "AS"){ $countryName = "American Samoa"; }
		else if ($countryCode == "AD"){ $countryName = "Andorra"; }
		else if ($countryCode == "AO"){ $countryName = "Angola"; }
		else if ($countryCode == "AI"){ $countryName = "Anguilla"; }
		else if ($countryCode == "AR"){ $countryName = "Argentina"; }
		else if ($countryCode == "AM"){ $countryName = "Armenia"; }
		else if ($countryCode == "AW"){ $countryName = "Aruba"; }
		else if ($countryCode == "AU"){ $countryName = "Australia"; }
		else if ($countryCode == "AT"){ $countryName = "Austria"; }
		else if ($countryCode == "AZ"){ $countryName = "Azerbaijan"; }
		else if ($countryCode == "BS"){ $countryName = "Bahamas"; }
		else if ($countryCode == "BH"){ $countryName = "Bahrain"; }
		else if ($countryCode == "BD"){ $countryName = "Bangladesh"; }
		else if ($countryCode == "BB"){ $countryName = "Barbados"; }
		else if ($countryCode == "BY"){ $countryName = "Belarus"; }
		else if ($countryCode == "BE"){ $countryName = "Belgium"; }
		else if ($countryCode == "BZ"){ $countryName = "Belize"; }
		else if ($countryCode == "BJ"){ $countryName = "Benin"; }
		else if ($countryCode == "BM"){ $countryName = "Bermuda"; }
		else if ($countryCode == "BT"){ $countryName = "Bhutan"; }
		else if ($countryCode == "BO"){ $countryName = "Bolivia"; }
		else if ($countryCode == "BA"){ $countryName = "Bosnia and Herzegowina"; }
		else if ($countryCode == "BW"){ $countryName = "Botswana"; }
		else if ($countryCode == "BV"){ $countryName = "Bouvet Island"; }
		else if ($countryCode == "BR"){ $countryName = "Brazil"; }
		else if ($countryCode == "IO"){ $countryName = "British Indian Ocean Territory"; }
		else if ($countryCode == "BN"){ $countryName = "Brunei Darussalam"; }
		else if ($countryCode == "BG"){ $countryName = "Bulgaria"; }
		else if ($countryCode == "BF"){ $countryName = "Burkina Faso"; }
		else if ($countryCode == "BI"){ $countryName = "Burundi"; }
		else if ($countryCode == "KH"){ $countryName = "Cambodia"; }
		else if ($countryCode == "CM"){ $countryName = "Cameroon"; }
		else if ($countryCode == "CA"){ $countryName = "Canada"; }
		else if ($countryCode == "CV"){ $countryName = "Cape Verde"; }
		else if ($countryCode == "KY"){ $countryName = "Cayman Islands"; }
		else if ($countryCode == "CF"){ $countryName = "Central African Republic"; }
		else if ($countryCode == "TD"){ $countryName = "Chad"; }
		else if ($countryCode == "CL"){ $countryName = "Chile"; }
		else if ($countryCode == "CN"){ $countryName = "China"; }
		else if ($countryCode == "CX"){ $countryName = "Christmas Island"; }
		else if ($countryCode == "CC"){ $countryName = "Cocos (Keeling) Islands"; }
		else if ($countryCode == "CO"){ $countryName = "Colombia"; }
		else if ($countryCode == "KM"){ $countryName = "Comoros"; }
		else if ($countryCode == "CG"){ $countryName = "Congo"; }
		else if ($countryCode == "CD"){ $countryName = "Congo, the Democratic Republic of the"; }
		else if ($countryCode == "CK"){ $countryName = "Cook Islands"; }
		else if ($countryCode == "CR"){ $countryName = "Costa Rica"; }
		else if ($countryCode == "CI"){ $countryName = "Cote d'Ivoire"; }
		else if ($countryCode == "HR"){ $countryName = "Croatia (Hrvatska)"; }
		else if ($countryCode == "CU"){ $countryName = "Cuba"; }
		else if ($countryCode == "CY"){ $countryName = "Cyprus"; }
		else if ($countryCode == "CZ"){ $countryName = "Czech Republic"; }
		else if ($countryCode == "DK"){ $countryName = "Denmark"; }
		else if ($countryCode == "DJ"){ $countryName = "Djibouti"; }
		else if ($countryCode == "DM"){ $countryName = "Dominica"; }
		else if ($countryCode == "DO"){ $countryName = "Dominican Republic"; }
		else if ($countryCode == "EC"){ $countryName = "Ecuador"; }
		else if ($countryCode == "EG"){ $countryName = "Egypt"; }
		else if ($countryCode == "SV"){ $countryName = "El Salvador"; }
		else if ($countryCode == "GQ"){ $countryName = "Equatorial Guinea"; }
		else if ($countryCode == "ER"){ $countryName = "Eritrea"; }
		else if ($countryCode == "EE"){ $countryName = "Estonia"; }
		else if ($countryCode == "ET"){ $countryName = "Ethiopia"; }
		else if ($countryCode == "FK"){ $countryName = "Falkland Islands (Malvinas)"; }
		else if ($countryCode == "FO"){ $countryName = "Faroe Islands"; }
		else if ($countryCode == "FJ"){ $countryName = "Fiji"; }
		else if ($countryCode == "FI"){ $countryName = "Finland"; }
		else if ($countryCode == "FR"){ $countryName = "France"; }
		else if ($countryCode == "GF"){ $countryName = "French Guiana"; }
		else if ($countryCode == "PF"){ $countryName = "French Polynesia"; }
		else if ($countryCode == "TF"){ $countryName = "French Southern Territories"; }
		else if ($countryCode == "GA"){ $countryName = "Gabon"; }
		else if ($countryCode == "GM"){ $countryName = "Gambia"; }
		else if ($countryCode == "GE"){ $countryName = "Georgia"; }
		else if ($countryCode == "DE"){ $countryName = "Germany"; }
		else if ($countryCode == "GH"){ $countryName = "Ghana"; }
		else if ($countryCode == "GI"){ $countryName = "Gibraltar"; }
		else if ($countryCode == "GR"){ $countryName = "Greece"; }
		else if ($countryCode == "GL"){ $countryName = "Greenland"; }
		else if ($countryCode == "GD"){ $countryName = "Grenada"; }
		else if ($countryCode == "GP"){ $countryName = "Guadeloupe"; }
		else if ($countryCode == "GU"){ $countryName = "Guam"; }
		else if ($countryCode == "GT"){ $countryName = "Guatemala"; }
		else if ($countryCode == "GN"){ $countryName = "Guinea"; }
		else if ($countryCode == "GW"){ $countryName = "Guinea-Bissau"; }
		else if ($countryCode == "GY"){ $countryName = "Guyana"; }
		else if ($countryCode == "HT"){ $countryName = "Haiti"; }
		else if ($countryCode == "HM"){ $countryName = "Heard and Mc Donald Islands"; }
		else if ($countryCode == "VA"){ $countryName = "Holy See (Vatican City State)"; }
		else if ($countryCode == "HN"){ $countryName = "Honduras"; }
		else if ($countryCode == "HK"){ $countryName = "Hong Kong"; }
		else if ($countryCode == "HU"){ $countryName = "Hungary"; }
		else if ($countryCode == "IS"){ $countryName = "Iceland"; }
		else if ($countryCode == "IN"){ $countryName = "India"; }
		else if ($countryCode == "ID"){ $countryName = "Indonesia"; }
		else if ($countryCode == "IR"){ $countryName = "Iran (Islamic Republic of)"; }
		else if ($countryCode == "IQ"){ $countryName = "Iraq"; }
		else if ($countryCode == "IE"){ $countryName = "Ireland"; }
		else if ($countryCode == "IL"){ $countryName = "Israel"; }
		else if ($countryCode == "IT"){ $countryName = "Italy"; }
		else if ($countryCode == "JM"){ $countryName = "Jamaica"; }
		else if ($countryCode == "JP"){ $countryName = "Japan"; }
		else if ($countryCode == "JO"){ $countryName = "Jordan"; }
		else if ($countryCode == "KZ"){ $countryName = "Kazakhstan"; }
		else if ($countryCode == "KE"){ $countryName = "Kenya"; }
		else if ($countryCode == "KI"){ $countryName = "Kiribati"; }
		else if ($countryCode == "KP"){ $countryName = "Korea, Democratic People's Republic of"; }
		else if ($countryCode == "KR"){ $countryName = "Korea, Republic of"; }
		else if ($countryCode == "KW"){ $countryName = "Kuwait"; }
		else if ($countryCode == "KG"){ $countryName = "Kyrgyzstan"; }
		else if ($countryCode == "LA"){ $countryName = "Lao People's Democratic Republic"; }
		else if ($countryCode == "LV"){ $countryName = "Latvia"; }
		else if ($countryCode == "LB"){ $countryName = "Lebanon"; }
		else if ($countryCode == "LS"){ $countryName = "Lesotho"; }
		else if ($countryCode == "LR"){ $countryName = "Liberia"; }
		else if ($countryCode == "LY"){ $countryName = "Libyan Arab Jamahiriya"; }
		else if ($countryCode == "LI"){ $countryName = "Liechtenstein"; }
		else if ($countryCode == "LT"){ $countryName = "Lithuania"; }
		else if ($countryCode == "LU"){ $countryName = "Luxembourg"; }
		else if ($countryCode == "MO"){ $countryName = "Macau"; }
		else if ($countryCode == "MK"){ $countryName = "Macedonia, The Former Yugoslav Republic of"; }
		else if ($countryCode == "MG"){ $countryName = "Madagascar"; }
		else if ($countryCode == "MW"){ $countryName = "Malawi"; }
		else if ($countryCode == "MY"){ $countryName = "Malaysia"; }
		else if ($countryCode == "MV"){ $countryName = "Maldives"; }
		else if ($countryCode == "ML"){ $countryName = "Mali"; }
		else if ($countryCode == "MT"){ $countryName = "Malta"; }
		else if ($countryCode == "MH"){ $countryName = "Marshall Islands"; }
		else if ($countryCode == "MQ"){ $countryName = "Martinique"; }
		else if ($countryCode == "MR"){ $countryName = "Mauritania"; }
		else if ($countryCode == "MU"){ $countryName = "Mauritius"; }
		else if ($countryCode == "YT"){ $countryName = "Mayotte"; }
		else if ($countryCode == "MX"){ $countryName = "Mexico"; }
		else if ($countryCode == "FM"){ $countryName = "Micronesia, Federated States of"; }
		else if ($countryCode == "MD"){ $countryName = "Moldova, Republic of"; }
		else if ($countryCode == "MC"){ $countryName = "Monaco"; }
		else if ($countryCode == "MN"){ $countryName = "Mongolia"; }
		else if ($countryCode == "MS"){ $countryName = "Montserrat"; }
		else if ($countryCode == "MA"){ $countryName = "Morocco"; }
		else if ($countryCode == "MZ"){ $countryName = "Mozambique"; }
		else if ($countryCode == "MM"){ $countryName = "Myanmar"; }
		else if ($countryCode == "NA"){ $countryName = "Namibia"; }
		else if ($countryCode == "NR"){ $countryName = "Nauru"; }
		else if ($countryCode == "NP"){ $countryName = "Nepal"; }
		else if ($countryCode == "NL"){ $countryName = "Netherlands"; }
		else if ($countryCode == "AN"){ $countryName = "Netherlands Antilles"; }
		else if ($countryCode == "NC"){ $countryName = "New Caledonia"; }
		else if ($countryCode == "NZ"){ $countryName = "New Zealand"; }
		else if ($countryCode == "NI"){ $countryName = "Nicaragua"; }
		else if ($countryCode == "NE"){ $countryName = "Niger"; }
		else if ($countryCode == "NG"){ $countryName = "Nigeria"; }
		else if ($countryCode == "NU"){ $countryName = "Niue"; }
		else if ($countryCode == "NF"){ $countryName = "Norfolk Island"; }
		else if ($countryCode == "MP"){ $countryName = "Northern Mariana Islands"; }
		else if ($countryCode == "NO"){ $countryName = "Norway"; }
		else if ($countryCode == "OM"){ $countryName = "Oman"; }
		else if ($countryCode == "PK"){ $countryName = "Pakistan"; }
		else if ($countryCode == "PW"){ $countryName = "Palau"; }
		else if ($countryCode == "PA"){ $countryName = "Panama"; }
		else if ($countryCode == "PG"){ $countryName = "Papua New Guinea"; }
		else if ($countryCode == "PY"){ $countryName = "Paraguay"; }
		else if ($countryCode == "PE"){ $countryName = "Peru"; }
		else if ($countryCode == "PH"){ $countryName = "Philippines"; }
		else if ($countryCode == "PN"){ $countryName = "Pitcairn"; }
		else if ($countryCode == "PL"){ $countryName = "Poland"; }
		else if ($countryCode == "PT"){ $countryName = "Portugal"; }
		else if ($countryCode == "PR"){ $countryName = "Puerto Rico"; }
		else if ($countryCode == "QA"){ $countryName = "Qatar"; }
		else if ($countryCode == "RE"){ $countryName = "Reunion"; }
		else if ($countryCode == "RO"){ $countryName = "Romania"; }
		else if ($countryCode == "RU"){ $countryName = "Russian Federation"; }
		else if ($countryCode == "RW"){ $countryName = "Rwanda"; }
		else if ($countryCode == "KN"){ $countryName = "Saint Kitts and Nevis"; }
		else if ($countryCode == "LC"){ $countryName = "Saint LUCIA"; }
		else if ($countryCode == "VC"){ $countryName = "Saint Vincent and the Grenadines"; }
		else if ($countryCode == "WS"){ $countryName = "Samoa"; }
		else if ($countryCode == "SM"){ $countryName = "San Marino"; }
		else if ($countryCode == "ST"){ $countryName = "Sao Tome and Principe"; }
		else if ($countryCode == "SA"){ $countryName = "Saudi Arabia"; }
		else if ($countryCode == "SN"){ $countryName = "Senegal"; }
		else if ($countryCode == "SC"){ $countryName = "Seychelles"; }
		else if ($countryCode == "SL"){ $countryName = "Sierra Leone"; }
		else if ($countryCode == "SG"){ $countryName = "Singapore"; }
		else if ($countryCode == "SK"){ $countryName = "Slovakia (Slovak Republic)"; }
		else if ($countryCode == "SI"){ $countryName = "Slovenia"; }
		else if ($countryCode == "SB"){ $countryName = "Solomon Islands"; }
		else if ($countryCode == "SO"){ $countryName = "Somalia"; }
		else if ($countryCode == "ZA"){ $countryName = "South Africa"; }
		else if ($countryCode == "GS"){ $countryName = "South Georgia and the South Sandwich Islands"; }
		else if ($countryCode == "ES"){ $countryName = "Spain"; }
		else if ($countryCode == "LK"){ $countryName = "Sri Lanka"; }
		else if ($countryCode == "SH"){ $countryName = "St. Helena"; }
		else if ($countryCode == "PM"){ $countryName = "St. Pierre and Miquelon"; }
		else if ($countryCode == "SD"){ $countryName = "Sudan"; }
		else if ($countryCode == "SR"){ $countryName = "Suriname"; }
		else if ($countryCode == "SJ"){ $countryName = "Svalbard and Jan Mayen Islands"; }
		else if ($countryCode == "SZ"){ $countryName = "Swaziland"; }
		else if ($countryCode == "SE"){ $countryName = "Sweden"; }
		else if ($countryCode == "CH"){ $countryName = "Switzerland"; }
		else if ($countryCode == "SY"){ $countryName = "Syrian Arab Republic"; }
		else if ($countryCode == "TW"){ $countryName = "Taiwan, Province of China"; }
		else if ($countryCode == "TJ"){ $countryName = "Tajikistan"; }
		else if ($countryCode == "TZ"){ $countryName = "Tanzania, United Republic of"; }
		else if ($countryCode == "TH"){ $countryName = "Thailand"; }
		else if ($countryCode == "TG"){ $countryName = "Togo"; }
		else if ($countryCode == "TK"){ $countryName = "Tokelau"; }
		else if ($countryCode == "TO"){ $countryName = "Tonga"; }
		else if ($countryCode == "TT"){ $countryName = "Trinidad and Tobago"; }
		else if ($countryCode == "TN"){ $countryName = "Tunisia"; }
		else if ($countryCode == "TR"){ $countryName = "Turkey"; }
		else if ($countryCode == "TM"){ $countryName = "Turkmenistan"; }
		else if ($countryCode == "TC"){ $countryName = "Turks and Caicos Islands"; }
		else if ($countryCode == "TV"){ $countryName = "Tuvalu"; }
		else if ($countryCode == "UG"){ $countryName = "Uganda"; }
		else if ($countryCode == "UA"){ $countryName = "Ukraine"; }
		else if ($countryCode == "AE"){ $countryName = "United Arab Emirates"; }
		else if ($countryCode == "GB"){ $countryName = "United Kingdom"; }
		else if ($countryCode == "US"){ $countryName = "United States"; }
		else if ($countryCode == "UM"){ $countryName = "United States Minor Outlying Islands"; }
		else if ($countryCode == "UY"){ $countryName = "Uruguay"; }
		else if ($countryCode == "UZ"){ $countryName = "Uzbekistan"; }
		else if ($countryCode == "VU"){ $countryName = "Vanuatu"; }
		else if ($countryCode == "VE"){ $countryName = "Venezuela"; }
		else if ($countryCode == "VN"){ $countryName = "Viet Nam"; }
		else if ($countryCode == "VG"){ $countryName = "Virgin Islands (British)"; }
		else if ($countryCode == "VI"){ $countryName = "Virgin Islands (U.S.)"; }
		else if ($countryCode == "WF"){ $countryName = "Wallis and Futuna Islands"; }
		else if ($countryCode == "EH"){ $countryName = "Western Sahara"; }
		else if ($countryCode == "YE"){ $countryName = "Yemen"; }
		else if ($countryCode == "ZM"){ $countryName = "Zambia"; }
		else if ($countryCode == "ZW"){ $countryName = "Zimbabwe"; }

		$religion = $online['applicant_form'][0][0]->religion;
		$maritalStatus = $online['applicant_form'][0][0]->marital_status;
		$birthPlace = $online['applicant_form'][0][0]->place_of_birth;
		$email = $online['applicant_form'][0][0]->email;

		$schoolName = $online['applicant_form'][0][0]->school_name;
		$allSchoolSubjects = $online['applicant_form'][0][0]->school_subjects;
		$schoolSubjects = explode(",",$allSchoolSubjects);
		$schoolSubjects_L1 = $schoolSubjects[0] . ", " . $schoolSubjects[1] . ", " . $schoolSubjects[2];
		$schoolSubjects_L2 = $schoolSubjects[3];
		if(strlen($schoolSubjects[4]) > 0) { $schoolSubjects_L2 .= ", " . $schoolSubjects[4]; }
		if(strlen($schoolSubjects[5]) > 0) { $schoolSubjects_L2 .= ", " . $schoolSubjects[5]; }
		$schoolSubjects_L3 = $schoolSubjects[6];
		if(strlen($schoolSubjects[7]) > 0) { $schoolSubjects_L3 .= ", " . $schoolSubjects[7]; }
		if(strlen($schoolSubjects[8]) > 0) { $schoolSubjects_L3 .= ", " . $schoolSubjects[8]; }
		$schoolResult = $online['applicant_form'][0][0]->school_result;
		$schoolYear = $online['applicant_form'][0][0]->school_year;

		$collegeName = $online['applicant_form'][0][0]->college_name;
		$allCollegeSubjects = $online['applicant_form'][0][0]->college_subjects;
		$collegeSubjects = explode(",",$allCollegeSubjects);
		$collegeSubjects_L1 = $collegeSubjects[0] . ", " . $collegeSubjects[1];
		$collegeSubjects_L2 = $collegeSubjects[2];
		if(strlen($collegeSubjects[3]) > 0) { $collegeSubjects_L2 .= ", " . $collegeSubjects[3]; }
		$collegeSubjects_L3 = $collegeSubjects[4];		
		$collegeResult = $online['applicant_form'][0][0]->college_result;
		$collegeYear = $online['applicant_form'][0][0]->college_year;

		$uni1_Name = $online['applicant_form_uni'][0][0]->name;
		$uni1_subjects = $online['applicant_form_uni'][0][0]->subjects;
		$uni1_degree = $online['applicant_form_uni'][0][0]->degree;
		$uni1_grade = $online['applicant_form_uni'][0][0]->grade;
		$uni1_year = $online['applicant_form_uni'][0][0]->year;

		$uni2_Name = "";
		$uni2_subjects = "";
		$uni2_degree = "";
		$uni2_grade = "";
		$uni2_year = "";

		$uni3_Name = "";
		$uni3_subjects = "";
		$uni3_degree = "";
		$uni3_grade = "";
		$uni3_year = "";

		if(sizeof($online['applicant_form_uni'][0]) > 1) {
			$uni2_Name = $online['applicant_form_uni'][0][1]->name;
			$uni2_subjects = $online['applicant_form_uni'][0][1]->subjects;
			$uni2_degree = $online['applicant_form_uni'][0][1]->degree;
			$uni2_grade = $online['applicant_form_uni'][0][1]->grade;
			$uni2_year = $online['applicant_form_uni'][0][1]->year;
		}

		if(sizeof($online['applicant_form_uni'][0]) > 2) {
			$uni3_Name = $online['applicant_form_uni'][0][2]->name;
			$uni3_subjects = $online['applicant_form_uni'][0][2]->subjects;
			$uni3_degree = $online['applicant_form_uni'][0][2]->degree;
			$uni3_grade = $online['applicant_form_uni'][0][2]->grade;
			$uni3_year = $online['applicant_form_uni'][0][2]->year;
		}


		
		$trainingQualification_1 = "";
		$trainingQualification_2 = "";
		$trainingQualification_3 = "";
		$trainingQualification_4 = "";
		$trainingQualification_5 = "";
		$trainingQualification_6 = "";
		$trainingQualification_7 = "";
		$trainingQualification_8 = "";
		$trainingQualification = $online['applicant_form'][0][0]->training_qualification;
		$trainingQualification_1 = trim(substr($trainingQualification, 0, 90));
		$trainingQualification_2 = trim(substr($trainingQualification, 90, 180));
		$trainingQualification_3 = trim(substr($trainingQualification, 180, 270));
		$trainingQualification_4 = trim(substr($trainingQualification, 270, 360));
		$trainingQualification_5 = trim(substr($trainingQualification, 360, 450));



		// Overall Font Size
		$font_size = 10;
		$font_size_Big1 = 12;
		$font_size_Big2 = 14;
		$font_name = 'Helvetica';
		$gender_mark_size = 26;
		$now_date = date('d-M-Y');

		require_once('components/pdf/fpdf/fpdf.php');
		require_once('components/pdf/fpdi/fpdi.php');

		
		// initiate FPDI
		$pdf = new FPDI();

		// get the page count
		$pageCount = $pdf->setSourceFile('components/pdf/hcm/HRApplicantForm2.pdf');
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
	    		

	    		/*********************************************************************** Header ****
			    ************************************************************************************/
	    		// position applied for
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',10);
			    $pdf->SetXY(161, 71);
			    $pdf->MultiCell(35, 4, $position, 0, 'L', 0);

	    		// Setting form number
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',10);
			    $pdf->SetXY(120, 51);
			    $pdf->Write(8, 'Form # ');
			    $pdf->SetFont($font_name,'',12);
			    $pdf->SetXY(148, 51);				    
		    	$pdf->Cell(10, 8, $form_id, 0, 0, 'R', 0);

		    	// Todate
		    	$pdf->SetFont($font_name,'',12);
			    $pdf->SetXY(24, 51);				    
			    $pdf->Write(8, $formDate);


			    /********************************************************************* Personal ****
			    ************************************************************************************/

			    // applicant name is here
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',$font_size);
			    $pdf->SetXY(17, 77.5);
			    $pdf->Write(8, ucwords(strtolower($name)));

			    // applicant DOB is here
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',$font_size);
			    $pdf->SetXY(91, 77.5);
			    $pdf->Write(8, $DOB);

			    // gender marking
			    if ($gender == 'M')
			    {
			    	$pdf->AddFont('wingdng2','','wingdng2.php');
				    $pdf->SetFont('wingdng2','',$gender_mark_size);
				    $pdf->SetXY(126, 78.2);
				    $pdf->Write(8, 'P');

			   	}else if($gender == 'F'){
			   		$pdf->AddFont('wingdng2','','wingdng2.php');
				    $pdf->SetFont('wingdng2','',$gender_mark_size);
				    $pdf->SetXY(144, 78.2);
				    $pdf->Write(8, 'P');
			   	}


			   	// Nationality			   	
			   	$pdf->SetFont($font_name);
			   	$pdf->SetFont($font_name,'',$font_size);
			    $pdf->SetXY(91, 91);
			    $pdf->Write(8, $countryName);

			    // Religion			   	
			   	$pdf->SetFont($font_name);
			   	$pdf->SetFont($font_name,'',$font_size);
			    $pdf->SetXY(125, 91);
			    $pdf->Write(8, $religion);



			    // Marital Status			   	
			   	$pdf->SetFont($font_name);
			   	$pdf->SetFont($font_name,'',$font_size);
			    $pdf->SetXY(91, 104);
			    $pdf->Write(8, $maritalStatus);

			    // Place of Birth			   	
			   	$pdf->SetFont($font_name);
			   	$pdf->SetFont($font_name,'',$font_size);
			    $pdf->SetXY(125, 104);
			    $pdf->Write(8, $birthPlace);



			   	// cnic is here
			   	$pdf->SetFont($font_name);
			   	$pdf->SetFont($font_name,'',$font_size);
			    $pdf->SetXY(91, 130);
			    $pdf->Write(8, $nic);

			    // mobile phone number is here
			    $pdf->SetFont($font_name);
			   	$pdf->SetFont($font_name,'',$font_size);
			    $pdf->SetXY(91, 117);
			    $pdf->Write(8, $mobilephone);

			    // landline number is here
			    $pdf->SetFont($font_name);
			   	$pdf->SetFont($font_name,'',$font_size);
			    $pdf->SetXY(125.5, 117);
			    $pdf->Write(8, $landline);



			    // Email Address
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',$font_size);
			    $pdf->SetXY(17, 143);
			    $pdf->Write(8, strtolower($email));

			    
			}

			if ($templateId == 2) {			

			    /*********************************************************** Educational Record ****
			    ************************************************************************************/

			    // School
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',$font_size);
			    $pdf->SetXY(17, 184);
			    $pdf->Write(8, $schoolName);
			    // School Subjects Line 1
			    $decrement_step = 0.1;
			    $line_width = 45;
			    $pdf->SetFont($font_name);			    
			    $pdf->SetXY(105.7, 184);
			    $this_font_size = $font_size;
			    while($pdf->GetStringWidth($schoolSubjects_L1) > $line_width) {					
					$this_font_size -= $decrement_step;
					$pdf->SetFont($font_name,'',$this_font_size);
				}				
			    $pdf->Write(8, ucwords(strtolower($schoolSubjects_L1)));
			    // School Subjects Line 2
			    $decrement_step = 0.1;
			    $line_width = 45;
			    $pdf->SetFont($font_name);			    
			    $pdf->SetXY(105.7, 190);
			    $this_font_size = $font_size;
			    while($pdf->GetStringWidth($schoolSubjects_L2) > $line_width) {
					$this_font_size -= $decrement_step;
					$pdf->SetFont($font_name,'',$this_font_size);
				}				
			    $pdf->Write(8, ucwords(strtolower($schoolSubjects_L2)));
			    // School Subjects Line 3
			    $decrement_step = 0.1;
			    $line_width = 45;
			    $pdf->SetFont($font_name);			    
			    $pdf->SetXY(105.7, 196);
			    $this_font_size = $font_size;
			    while($pdf->GetStringWidth($schoolSubjects_L3) > $line_width) {
					$this_font_size -= $decrement_step;
					$pdf->SetFont($font_name,'',$this_font_size);
				}				
			    $pdf->Write(8, ucwords(strtolower($schoolSubjects_L3)));
			    // School Result
			    $pdf->SetFont($font_name);			    
			    if(strlen($schoolResult) == 1){
		    		$pdf->SetXY(154, 184);
		    		$pdf->SetFont($font_name,'',$font_size_Big1);
			    }
			    else if(strlen($schoolResult) >= 2 && strlen($schoolResult) <= 5) {
			    	$pdf->SetXY(152, 184);
			    	$pdf->SetFont($font_name,'',$font_size_Big1);
			    }else{
				    $pdf->SetXY(148, 184);
				    $pdf->SetFont($font_name,'',$font_size);
				}
			    $pdf->Write(8, strtoupper($schoolResult));
			    // School Year
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',$font_size);
			    $pdf->SetXY(177.5, 184);
			    $pdf->Write(8, $schoolYear);



			    // College
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',$font_size);
			    $pdf->SetXY(17, 209);
			    $pdf->Write(8, $collegeName);
			    // College Subjects Line 1
			    $decrement_step = 0.1;
			    $line_width = 45;
			    $pdf->SetFont($font_name);			    
			    $pdf->SetXY(105.7, 209);
			    $this_font_size = $font_size;
			    while($pdf->GetStringWidth($collegeSubjects_L1) > $line_width) {					
					$this_font_size -= $decrement_step;
					$pdf->SetFont($font_name,'',$this_font_size);
				}				
			    $pdf->Write(8, ucwords(strtolower($collegeSubjects_L1)));
			    // College Subjects Line 2
			    $decrement_step = 0.1;
			    $line_width = 45;
			    $pdf->SetFont($font_name);			    
			    $pdf->SetXY(105.7, 215.5);
			    $this_font_size = $font_size;
			    while($pdf->GetStringWidth($collegeSubjects_L2) > $line_width) {
					$this_font_size -= $decrement_step;
					$pdf->SetFont($font_name,'',$this_font_size);
				}				
			    $pdf->Write(8, ucwords(strtolower($collegeSubjects_L2)));
			    // College Subjects Line 3
			    $decrement_step = 0.1;
			    $line_width = 45;
			    $pdf->SetFont($font_name);			    
			    $pdf->SetXY(105.7, 221.5);
			    $this_font_size = $font_size;
			    while($pdf->GetStringWidth($collegeSubjects_L3) > $line_width) {
					$this_font_size -= $decrement_step;
					$pdf->SetFont($font_name,'',$this_font_size);
				}				
			    $pdf->Write(8, ucwords(strtolower($collegeSubjects_L3)));
			    // College Result
			    $pdf->SetFont($font_name);			    
			    if(strlen($collegeResult) == 1){
		    		$pdf->SetXY(154, 209);
		    		$pdf->SetFont($font_name,'',$font_size_Big1);
			    }
			    else if(strlen($collegeResult) >= 2 && strlen($collegeResult) <= 5) {
			    	$pdf->SetXY(152, 209);
			    	$pdf->SetFont($font_name,'',$font_size_Big1);
			    }else{
				    $pdf->SetXY(148, 209);
				    $pdf->SetFont($font_name,'',$font_size);
				}
			    $pdf->Write(8, strtoupper($collegeResult));
			    // College Year
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',$font_size);
			    $pdf->SetXY(177.5, 209);
			    $pdf->Write(8, $collegeYear);



			    // University - 1 Name
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',$font_size);
			    $pdf->SetXY(17, 234.5);
			    $pdf->Write(8, $uni1_Name);
		    	// University - 1 Subject
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',$font_size);
			    $pdf->SetXY(105.7, 234.5);
			    $pdf->Write(8, $uni1_subjects);
			    // University - 1 Degree
			    $line_width = 10;
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',$font_size);
			    if(strlen($uni1_degree) <= 3){
			    	$pdf->SetXY(146, 234.5);
			    }else{
			    	$pdf->SetXY(144.2, 234.5);
			    }
			    $this_font_size = $font_size;
			    while($pdf->GetStringWidth($uni1_degree) > $line_width) {					
					$this_font_size -= $decrement_step;
					$pdf->SetFont($font_name,'',$this_font_size);
				}				
			    $pdf->Write(8, $uni1_degree);
			    // University - 1 Grade
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',$font_size);
			    $pdf->SetXY(156.5, 234.5);
			    $this_font_size = $font_size;
			    while($pdf->GetStringWidth($uni1_grade) > $line_width) {					
					$this_font_size -= $decrement_step;
					$pdf->SetFont($font_name,'',$this_font_size);
				}
			    $pdf->Write(8, $uni1_grade);
			    // University - 1 Year
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',$font_size);
			    $pdf->SetXY(177.5, 234.5);
			    $pdf->Write(8, $uni1_year);



			    // University - 2 Name
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',$font_size);
			    $pdf->SetXY(17, 240.5);
			    $pdf->Write(8, $uni2_Name);
		    	// University - 2 Subject
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',$font_size);
			    $pdf->SetXY(105.7, 240.5);
			    $pdf->Write(8, $uni2_subjects);
			    // University - 2 Degree
			    $line_width = 10;
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',$font_size);
			    if(strlen($uni2_degree) <= 3){
			    	$pdf->SetXY(146, 240.5);
			    }else{
			    	$pdf->SetXY(144.2, 240.5);
			    }
			    $this_font_size = $font_size;
			    while($pdf->GetStringWidth($uni2_degree) > $line_width) {					
					$this_font_size -= $decrement_step;
					$pdf->SetFont($font_name,'',$this_font_size);
				}				
			    $pdf->Write(8, $uni2_degree);
			    // University - 2 Grade
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',$font_size);
			    $pdf->SetXY(156.5, 240.5);
			    $this_font_size = $font_size;
			    while($pdf->GetStringWidth($uni2_grade) > $line_width) {					
					$this_font_size -= $decrement_step;
					$pdf->SetFont($font_name,'',$this_font_size);
				}
			    $pdf->Write(8, $uni2_grade);
			    // University - 2 Year
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',$font_size);
			    $pdf->SetXY(177.5, 240.5);
			    $pdf->Write(8, $uni2_year);



			    // University - 3 Name
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',$font_size);
			    $pdf->SetXY(17, 246.5);
			    $pdf->Write(8, $uni3_Name);
		    	// University - 3 Subject
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',$font_size);
			    $pdf->SetXY(105.7, 246.5);
			    $pdf->Write(8, $uni3_subjects);
			    // University - 3 Degree
			    $line_width = 10;
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',$font_size);
			    if(strlen($uni3_degree) <= 3){
			    	$pdf->SetXY(146, 246.5);
			    }else{
			    	$pdf->SetXY(144.2, 246.5);
			    }
			    $this_font_size = $font_size;
			    while($pdf->GetStringWidth($uni3_degree) > $line_width) {					
					$this_font_size -= $decrement_step;
					$pdf->SetFont($font_name,'',$this_font_size);
				}				
			    $pdf->Write(8, $uni3_degree);
			    // University - 3 Grade
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',$font_size);
			    $pdf->SetXY(156.5, 246.5);
			    $this_font_size = $font_size;
			    while($pdf->GetStringWidth($uni3_grade) > $line_width) {
					$this_font_size -= $decrement_step;
					$pdf->SetFont($font_name,'',$this_font_size);
				}
			    $pdf->Write(8, $uni3_grade);
			    // University - 3 Year
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',$font_size);
			    $pdf->SetXY(177.5, 246.5);
			    $pdf->Write(8, $uni3_year);


			    /************************************************ Training, Skills & Experience ****
			    ************************************************************************************/
			    
			    // applicant name is here
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',$font_size);
			    $pdf->SetXY(17, 25);
			    $pdf->Write(8, ucwords(strtolower($trainingQualification_1)));
			    $pdf->SetXY(17, 31);
			    $pdf->Write(8, ucwords(strtolower($trainingQualification_2)));
			    $pdf->SetXY(17, 37);
			    $pdf->Write(8, ucwords(strtolower($trainingQualification_3)));
			    $pdf->SetXY(17, 43);
			    $pdf->Write(8, ucwords(strtolower($trainingQualification_4)));
			    $pdf->SetXY(17, 49);
			    $pdf->Write(8, ucwords(strtolower($trainingQualification_5)));
			    $pdf->SetXY(17, 55);
			    $pdf->Write(8, ucwords(strtolower($trainingQualification_6)));
			    $pdf->SetXY(17, 61);
			    $pdf->Write(8, ucwords(strtolower($trainingQualification_7)));
			    $pdf->SetXY(17, 67);
			    $pdf->Write(8, ucwords(strtolower($trainingQualification_8)));
			}
		}

		// Output the new PDF
		$pdf->Output($form_id . '-' . $name . '.pdf', 'D');
		//$pdf->Output();

	}
}