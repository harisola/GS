<?php
class Career_form_ajax extends CI_Controller{
	public function __construct(){
		parent::__construct();
	}

	public function get_career_form(){
		$html = '';


        $name = $this->input->post("name");
        $gender = $this->input->post("gender");
        $nic = $this->input->post("nic");
        $mobilephone = $this->input->post("mobile_phone");
        $landline = $this->input->post("land_line");
        $position = $this->input->post("tag");
        $form_id = $this->input->post("gc_id");



        $groupID = '0';
        $blockID = '0';
        if(substr(substr($gpp_id,-3),1) != '0'){
        	$groupID = substr(substr($gpp_id,-3),1);
        	$blockID = substr($gpp_id,1);
        }

        //var_dump($_POST);


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


		$helper = 'name='.$name.'&gender='.$gender.'&nic='.$nic.'&mobilephone='.$mobilephone.
    '&landline='.$landline.'&position='.$position.'&form_id='.$form_id;


		$html .= '
		<div class="unit_report_pdf_iframe">
			<iframe src="'.site_url().'/hcm/career_form_ajax/get_career_form_pdf?'.$helper.'" frameborder="0">
			</iframe>
		</div>';


    	echo $html;
	}


  public function get_career_form_pdf_gcid(){
    $form_id = $this->input->get("gc_id");
    $name = $this->input->get("name");
    $gender = $this->input->get("gender");
    $nic = $this->input->get("nic");
    $mobilephone = $this->input->get("mobile_phone");
    $landline = $this->input->get("land_line");
    $position = $this->input->get("tag");

    $urlGET = "name=".$name."&gender=".$gender."&nic=".$nic.
    "&mobilephone=".$mobilephone."&landline=".$landline."&position=".$position."&gc_id=".$form_id;
    redirect('http://10.10.10.63/gs/index.php/hcm/career_form_ajax/get_career_form_pdf?'.$urlGET);
  }


	 public function get_career_form_pdf(){
        $form_id = $this->input->get("gc_id");


        $this->load->model('hcm/career_form_model');
        $formData = $this->career_form_model->get_careerForm_data($form_id);
        if(empty($formData)){exit;}

        $name = $formData[0]->name;
        $gender = $formData[0]->gender;
        $nic = $formData[0]->nic;
        $mobilephone = $formData[0]->mobile_phone;
        $landline = $formData[0]->land_line;
        $position = $formData[0]->position_applied;
        $created_date = date("d-M-Y", strtotime($formData[0]->created_date));

        

        // Overall Font Size
    		$font_size = 10;
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

    	    		// position applied for
    	    		$pdf->SetFont($font_name);
    			    $pdf->SetFont($font_name,'',10);
    			    $pdf->SetXY(161, 71);
    			    $pdf->MultiCell(35, 4, $position, 0, 'L', 0);


    	    		// Setting form number
    	    		$pdf->SetFont($font_name);
    			    $pdf->SetFont($font_name,'',10);
    			    $pdf->SetXY(117, 51);
    			    $pdf->Write(8, 'Form # ');
    			    $pdf->SetFont($font_name,'',12);
    			    $pdf->SetXY(145, 51);
    		    	$pdf->Cell(10, 8, $form_id, 0, 0, 'R', 0);

    		    	// Todate
    		    	$pdf->SetFont($font_name,'',12);
    			    $pdf->SetXY(24, 51);
    			    $pdf->Write(8, $created_date);

    			    // applicant name is here
    			    $pdf->SetFont($font_name);
    			    $pdf->SetFont($font_name,'',$font_size);
    			    $pdf->SetXY(17, 77.5);
    			    $pdf->Write(8, ucwords(strtolower($name)));

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

    			   	// cnic is here
    			   	$pdf->SetFont($font_name);
    			   	$pdf->SetFont($font_name,'',$font_size);
    			    $pdf->SetXY(90.5, 130);
    			    $pdf->Write(8, $nic);

    			    // mobile phone number is here
    			    $pdf->SetFont($font_name);
    			   	$pdf->SetFont($font_name,'',$font_size);
    			    $pdf->SetXY(90.5, 117);
    			    $pdf->Write(8, $mobilephone);

    			    // landline number is here
    			    $pdf->SetFont($font_name);
    			   	$pdf->SetFont($font_name,'',$font_size);
    			    $pdf->SetXY(125.5, 117);
    			    $pdf->Write(8, $landline);
    			}
    		}

    		// Output the new PDF
    		$pdf->Output($form_id . '-' . $name . '.pdf', 'D');
    		//$pdf->Output();

    }


    public function getPDFNow()
    {

        $this->load->model('hcm/career_form_model');
        $this->load->model('hcm/career_form_uni_model');
        $this->load->model('hcm/career_form_emp_model');
        $this->load->model('hcm/career_form_proq_model');
        $career_id = $this->input->get('career_id');
        $fileMode = $this->input->get('download');


        // Loading data to array
        $online['applicant_form'] = array($this->career_form_model->get_by(array('gc_id =' => $career_id)));
        $online['applicant_form_uni'] = array($this->career_form_uni_model->get_by(array('career_id =' => $online['applicant_form'][0][0]->id)));
        $online['applicant_form_emp'] = array($this->career_form_emp_model->get_by(array('career_id =' => $online['applicant_form'][0][0]->id)));
        $online['applicant_pro_q'] = array($this->career_form_proq_model->get_by(array('career_id =' => $online['applicant_form'][0][0]->id)));      
        

        
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
        $home_1 = "";
        $home_2 = "";
        $home_3 = "";
        $home_4 = "";
        $home_5 = "";
        $homeaddress = $online['applicant_form'][0][0]->home_address;
        $bufferhome = str_replace(array("\r", "\n"), " ", $homeaddress);


        $newtext = wordwrap($bufferhome, 35, "%", true);
        $str = explode("%", $newtext);
        $Total_rows = ceil((strlen($bufferhome)/35));

        for($a = 0; $a < $Total_rows; $a++)
        {
            if($a==0)
                $home_1 = $str[$a]; 

            if($a==1)
                $home_2 = $str[$a];


            if($a==2)
                $home_3 = $str[$a];

            if($a==3)
                $home_4 = $str[$a];

            if($a==4)
                $home_5 = $str[$a];
            
        }

        // $home_1 = trim(substr($bufferhome, 0, 40));
        // $home_2 = trim(substr($bufferhome, 40, 40));
        // $home_3 = trim(substr($bufferhome, 80, 40));
        // $home_4 = trim(substr($bufferhome, 120, 40));
        // $home_5 = trim(substr($bufferhome, 160, 40));

        
        $email = $online['applicant_form'][0][0]->email;
        $seekingpositon = $online['applicant_form'][0][0]->seeking_position;
        $appliedbefore = $online['applicant_form'][0][0]->applied_before;

        $schoolName = $online['applicant_form'][0][0]->school_name;
        $allSchoolSubjects = $online['applicant_form'][0][0]->school_subjects;
        $schoolSubjects = explode(",",$allSchoolSubjects);

        $schoolSubjects_L1 = "";
        $schoolSubjects_L2 = "";
        $schoolSubjects_L3 = "";
        $schoolResult = "";
        $schoolYear = "";

        $collegeName = "";
        $allCollegeSubjects = "";
        $collegeSubjects = "";
        $collegeSubjects_L1 = "";
        $collegeSubjects_L2 = "";
        $collegeSubjects_L3 = "";
        $collegeResult = "";
        $collegeYear = "";

        $uni1_Name = "";
        $uni1_subjects = "";
        $uni1_degree = "";
        $uni1_grade = "";
        $uni1_year = "";

        $TaughtSubject_1 = $online['applicant_form'][0][0]->teach_subject_1;
        $TaughtSubject_2 = $online['applicant_form'][0][0]->teach_subject_2;
        $TaughtSubject_3 = $online['applicant_form'][0][0]->teach_subject_3;
        $TaughtSubject_4 = $online['applicant_form'][0][0]->teach_subject_4;

        $TaughtGrade_1 = $online['applicant_form'][0][0]->teach_grade_1;
        $TaughtGrade_2 = $online['applicant_form'][0][0]->teach_grade_2;
        $TaughtGrade_3 = $online['applicant_form'][0][0]->teach_grade_3;
        $TaughtGrade_4 = $online['applicant_form'][0][0]->teach_grade_4;


        if(!empty($schoolSubjects[0])){
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

        if(!empty($online['applicant_form_uni'][0][0])){
            $uni1_Name = $online['applicant_form_uni'][0][0]->name;
            $uni1_subjects = $online['applicant_form_uni'][0][0]->subjects;
            $uni1_degree = $online['applicant_form_uni'][0][0]->degree;
            $uni1_grade = $online['applicant_form_uni'][0][0]->grade;
            $uni1_year = $online['applicant_form_uni'][0][0]->year;
        }else{
            $uni1_Name = '';
            $uni1_subjects = '';
            $uni1_degree = '';
            $uni1_grade = '';
            $uni1_year = '';
        }

        }

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

        $uni4_Name = "";
        $uni4_subjects = "";
        $uni4_degree = "";
        $uni4_grade = "";
        $uni4_year = "";


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
        if(sizeof($online['applicant_form_uni'][0]) > 3) {
            $uni4_Name = $online['applicant_form_uni'][0][3]->name;
            $uni4_subjects = $online['applicant_form_uni'][0][3]->subjects;
            $uni4_degree = $online['applicant_form_uni'][0][3]->degree;
            $uni4_grade = $online['applicant_form_uni'][0][3]->grade;
            $uni4_year = $online['applicant_form_uni'][0][3]->year;
        }

        $currentlyemployed = $online['applicant_form'][0][0]->currently_employed;
                
        $trainingQualification_1 = "";
        $trainingQualification_2 = "";
        $trainingQualification_3 = "";
        $trainingQualification_4 = "";
        $trainingQualification_5 = "";
        $trainingQualification_6 = "";
        $trainingQualification_7 = "";
        $trainingQualification_8 = "";
        $trainingQualification = $online['applicant_form'][0][0]->training_qualification;
        $bufferQualification = str_replace(array("\r", "\n"), " ", $trainingQualification);
        $trainingQualification_1 = trim(substr($bufferQualification, 0, 50));
        $trainingQualification_2 = trim(substr($bufferQualification, 50, 50));
        $trainingQualification_3 = trim(substr($bufferQualification, 100, 50));
        $trainingQualification_4 = trim(substr($bufferQualification, 150, 50));

        
        $word = $online['applicant_form'][0][0]->it_word;
        $excel = $online['applicant_form'][0][0]->it_excel;
        $powerpoint = $online['applicant_form'][0][0]->it_powerpoint;
        $erpsoftware = $online['applicant_form'][0][0]->it_erpsoftware;
        $graphics = $online['applicant_form'][0][0]->it_graphics;
        $itemail = $online['applicant_form'][0][0]->it_email;
        $internet = $online['applicant_form'][0][0]->it_internet;
        $other = $online['applicant_form'][0][0]->it_other;


        $organization = "";
        $designation = "";
        $classtaught = "";
        $subjecttaught = "";
        $salary = "";
        $fromyear = "";
        $toyear = "";
        $reasonofleaving = "";

        $organization_2 = "";
        $designation_2 = "";
        $classtaught_2 = "";
        $subjecttaught_2 = "";
        $salary_2 = "";
        $fromyear_2 = "";
        $toyear_2 = "";
        $reasonofleaving_2 = "";

        $organization_3 = "";
        $designation_3 = "";
        $classtaught_3 = "";
        $subjecttaught_3 = "";
        $salary_3 = "";
        $fromyear_3 = "";
        $toyear_3 = "";
        $reasonofleaving_3 = "";

        $organization_4 = "";
        $designation_4 = "";
        $classtaught_4 = "";
        $subjecttaught_4 = "";
        $salary_4 = "";
        $fromyear_4 = "";
        $toyear_4 = "";
        $reasonofleaving_4 = "";

        $organization_5 = "";
        $designation_5 = "";
        $classtaught_5 = "";
        $subjecttaught_5 = "";
        $salary_5 = "";
        $fromyear_5 = "";
        $toyear_5 = "";
        $reasonofleaving_5 = "";

        if(!empty($online['applicant_form_emp'][0][0])){
            $organization = $online['applicant_form_emp'][0][0]->organization;
            $designation = $online['applicant_form_emp'][0][0]->designation;
            $classtaught = $online['applicant_form_emp'][0][0]->class_taught;
            $subjecttaught = $online['applicant_form_emp'][0][0]->subject_taught;
            $salary = $online['applicant_form_emp'][0][0]->salary;
            $fromyear = $online['applicant_form_emp'][0][0]->year_from;
            $toyear = $online['applicant_form_emp'][0][0]->year_to;
            $reasonofleaving = $online['applicant_form_emp'][0][0]->reason_for_leaving;         

            
            if(sizeof($online['applicant_form_emp'][0]) > 1) {
                $organization_2 = $online['applicant_form_emp'][0][1]->organization;
                $designation_2 = $online['applicant_form_emp'][0][1]->designation;
                $classtaught_2 = $online['applicant_form_emp'][0][1]->class_taught;
                $subjecttaught_2 = $online['applicant_form_emp'][0][1]->subject_taught;
                $salary_2 = $online['applicant_form_emp'][0][1]->salary;
                $fromyear_2 = $online['applicant_form_emp'][0][1]->year_from;
                $toyear_2 = $online['applicant_form_emp'][0][1]->year_to;
                $reasonofleaving_2 = $online['applicant_form_emp'][0][1]->reason_for_leaving;
            }

            if(sizeof($online['applicant_form_emp'][0]) > 2) {
                $organization_3 = $online['applicant_form_emp'][0][2]->organization;
                $designation_3 = $online['applicant_form_emp'][0][2]->designation;
                $classtaught_3 = $online['applicant_form_emp'][0][2]->class_taught;
                $subjecttaught_3 = $online['applicant_form_emp'][0][1]->subject_taught;
                $salary_3 = $online['applicant_form_emp'][0][2]->salary;
                $fromyear_3 = $online['applicant_form_emp'][0][2]->year_from;
                $toyear_3 = $online['applicant_form_emp'][0][2]->year_to;
                $reasonofleaving_3 = $online['applicant_form_emp'][0][2]->reason_for_leaving;
            }

            if(sizeof($online['applicant_form_emp'][0]) > 3) {
                $organization_4 = $online['applicant_form_emp'][0][3]->organization;
                $designation_4 = $online['applicant_form_emp'][0][3]->designation;
                $classtaught_4 = $online['applicant_form_emp'][0][3]->class_taught;
                $subjecttaught_4 = $online['applicant_form_emp'][0][1]->subject_taught;
                $salary_4 = $online['applicant_form_emp'][0][3]->salary;
                $fromyear_4 = $online['applicant_form_emp'][0][3]->year_from;
                $toyear_4 = $online['applicant_form_emp'][0][3]->year_to;
                $reasonofleaving_4 = $online['applicant_form_emp'][0][3]->reason_for_leaving;
            }

            if(sizeof($online['applicant_form_emp'][0]) > 4) {
                $organization_5 = $online['applicant_form_emp'][0][4]->organization;
                $designation_5 = $online['applicant_form_emp'][0][4]->designation;
                $classtaught_5 = $online['applicant_form_emp'][0][4]->class_taught;
                $subjecttaught_5 = $online['applicant_form_emp'][0][1]->subject_taught;
                $salary_5 = $online['applicant_form_emp'][0][4]->salary;
                $fromyear_5 = $online['applicant_form_emp'][0][4]->year_from;
                $toyear_5 = $online['applicant_form_emp'][0][4]->year_to;
                $reasonofleaving_5 = $online['applicant_form_emp'][0][4]->reason_for_leaving;
            }
        }

        $noticeperiod = $online['applicant_form'][0][0]->notice_period;
        $whencanjoin = $online['applicant_form'][0][0]->when_can_join;
        $cursalary = $online['applicant_form'][0][0]->current_salary;
        $expsalary = $online['applicant_form'][0][0]->expected_salary;
        $curtiming = $online['applicant_form'][0][0]->current_timing;

                        
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
                $pdf->SetXY(158, 71);
                $pdf->MultiCell(35, 4, $position, 0, 'L', 0);

                // Setting form number
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',10);
                $pdf->SetXY(117, 51);
                $pdf->Write(8, 'Form # ');
                $pdf->SetFont($font_name,'',12);
                $pdf->SetXY(145, 51);                   
                $pdf->Cell(10, 8, $form_id, 0, 0, 'R', 0);

                // Todate
                $pdf->SetFont($font_name,'',12);
                $pdf->SetXY(19, 51);                    
                $pdf->Write(8, $formDate);


                /********************************************************************* Personal ****
                ************************************************************************************/

                // applicant name is here
                $decrement_step = 0.1;
                $line_width = 66;
                $pdf->SetFont($font_name);              
                $pdf->SetXY(14, 77.5);
                $this_font_size = $font_size;
                while($pdf->GetStringWidth($name) > $line_width) {                  
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }               
                $pdf->Write(8, ucwords(strtolower($name)));

                // applicant DOB is here
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(88, 77.5);
                $pdf->Write(8, $DOB);

                // gender marking
                if ($gender == 'M')
                {
                    $pdf->AddFont('wingdng2','','wingdng2.php');
                    $pdf->SetFont('wingdng2','',$gender_mark_size);
                    $pdf->SetXY(123, 78.2);
                    $pdf->Write(8, 'P');

                }else if($gender == 'F'){
                    $pdf->AddFont('wingdng2','','wingdng2.php');
                    $pdf->SetFont('wingdng2','',$gender_mark_size);
                    $pdf->SetXY(141, 78.2);
                    $pdf->Write(8, 'P');
                }
                
                // Nationality              
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(88, 91);
                $pdf->Write(8, $countryName);

                // Religion             
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(122, 91);
                $pdf->Write(8, $religion);



                // Marital Status               
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(88, 104);
                $pdf->Write(8, $maritalStatus);

                // Place of Birth               
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(122, 104);
                $pdf->Write(8, $birthPlace);

                // Home Address             
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(14, 104);
                $pdf->Write(8, ucwords(strtolower($home_1)));
                $pdf->SetXY(14, 110.5);
                $pdf->Write(8, ucwords(strtolower($home_2)));
                $pdf->SetXY(14, 117);
                $pdf->Write(8, ucwords(strtolower($home_3)));
                $pdf->SetXY(14, 123.5);
                $pdf->Write(8, ucwords(strtolower($home_4)));
                $pdf->SetXY(14, 130);
                $pdf->Write(8, ucwords(strtolower($home_5)));


                // cnic is here
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(88, 130);
                $pdf->Write(8, $nic);

                // mobile phone number is here
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(88, 117);
                $pdf->Write(8, $mobilephone);

                // landline number is here
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(122.5, 117);
                $pdf->Write(8, $landline);



                // Email Address
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(14, 143);
                $pdf->Write(8, strtolower($email));

                // Applied Before
                if ($appliedbefore == 'Y')
                {
                    $pdf->AddFont('wingdng2','','wingdng2.php');
                    $pdf->SetFont('wingdng2','',$gender_mark_size);
                    $pdf->SetXY(35, 92);
                    $pdf->Write(8, 'P');

                }else if($appliedbefore == 'N'){
                    $pdf->AddFont('wingdng2','','wingdng2.php');
                    $pdf->SetFont('wingdng2','',$gender_mark_size);
                    $pdf->SetXY(70.5, 92);
                    $pdf->Write(8, 'P');
                }

                /*********************************************************** Educational Record ****
                ************************************************************************************/

                /***** Start School *****/
                // School Name
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(14, 173);
                $pdf->Write(8, $schoolName);
                /*$decrement_step = 0.1;
                $line_width = 80;
                $pdf->SetFont($font_name);
                $pdf->SetXY(14, 173);
                $this_font_size = $font_size;
                while($pdf->GetStringWidth($schoolName) > $line_width) {
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }
                $pdf->Write(8, ucwords(strtolower($schoolName)));
                }*/

                // School Subjects Line 1
                $decrement_step = 0.1;
                $line_width = 44.5;
                $pdf->SetFont($font_name);              
                $pdf->SetXY(102.3, 173);
                $this_font_size = $font_size;
                while($pdf->GetStringWidth($schoolSubjects_L1) > $line_width) {                 
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }               
                $pdf->Write(8, ucwords(strtolower($schoolSubjects_L1)));

                // School Subjects Line 2
                $decrement_step = 0.1;
                $line_width = 44.5;
                $pdf->SetFont($font_name);              
                $pdf->SetXY(102.3, 179);
                $this_font_size = $font_size;
                while($pdf->GetStringWidth($schoolSubjects_L2) > $line_width) {
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }               
                $pdf->Write(8, ucwords(strtolower($schoolSubjects_L2)));

                // School Result
                $pdf->SetFont($font_name);              
                if(strlen($schoolResult) == 1){
                    $pdf->SetXY(151, 173);
                    $pdf->SetFont($font_name,'',$font_size_Big1);
                }
                else if(strlen($schoolResult) >= 2 && strlen($schoolResult) <= 5) {
                    $pdf->SetXY(149, 173);
                    $pdf->SetFont($font_name,'',$font_size_Big1);
                }else{
                    $pdf->SetXY(145, 173);
                    $pdf->SetFont($font_name,'',$font_size);
                }
                $pdf->Write(8, strtoupper($schoolResult));

                // School Year
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(173.5, 173);
                $pdf->Write(8, $schoolYear);
                /***** End School *****/

                /***** Start College *****/
                // College Name
                $decrement_step = 0.1;
                $line_width = 80;
                $pdf->SetFont($font_name);              
                $pdf->SetXY(14, 192.5);
                $this_font_size = $font_size;
                while($pdf->GetStringWidth($collegeName) > $line_width) {
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }
                $pdf->Write(8, ucwords(strtolower($collegeName)));

                // College Subjects Line 1
                $decrement_step = 0.1;
                $line_width = 44.5;
                $pdf->SetFont($font_name);              
                $pdf->SetXY(102.3, 192.5);
                $this_font_size = $font_size;
                while($pdf->GetStringWidth($collegeSubjects_L1) > $line_width) {                    
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }               
                $pdf->Write(8, ucwords(strtolower($collegeSubjects_L1)));

                // College Subjects Line 2
                $decrement_step = 0.1;
                $line_width = 44.5;
                $pdf->SetFont($font_name);              
                $pdf->SetXY(102.3, 198.5);
                $this_font_size = $font_size;
                while($pdf->GetStringWidth($collegeSubjects_L2) > $line_width) {
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }               
                $pdf->Write(8, ucwords(strtolower($collegeSubjects_L2)));
                
                // College Result
                $pdf->SetFont($font_name);              
                if(strlen($collegeResult) == 1){
                    $pdf->SetXY(151, 192.5);
                    $pdf->SetFont($font_name,'',$font_size_Big1);
                }
                else if(strlen($collegeResult) >= 2 && strlen($collegeResult) <= 5) {
                    $pdf->SetXY(149, 192.5);
                    $pdf->SetFont($font_name,'',$font_size_Big1);
                }else{
                    $pdf->SetXY(145, 192.5);
                    $pdf->SetFont($font_name,'',$font_size);
                }
                $pdf->Write(8, strtoupper($collegeResult));
                // College Year
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(173.5, 192.5);
                $pdf->Write(8, $collegeYear);
                /***** End College *****/

                /***** Start University *****/
                // University - 1 Name
                $decrement_step = 0.1;
                $line_width = 80;
                $pdf->SetFont($font_name);              
                $pdf->SetXY(14, 211.5);
                $this_font_size = $font_size;
                while($pdf->GetStringWidth($uni1_Name) > $line_width) {
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }
                $pdf->Write(8, ucwords(strtolower($uni1_Name)));

                // University - 1 Subject
                $decrement_step = 0.1;
                $line_width = 35;
                $pdf->SetFont($font_name);              
                $pdf->SetXY(102, 211.5);
                $this_font_size = $font_size;
                while($pdf->GetStringWidth($uni1_subjects) > $line_width) 
                {
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }
                $pdf->Write(8, ucwords(strtolower($uni1_subjects)));

                // University - 1 Degree
                $decrement_step = 0.1;
                $line_width = 10;
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                if(strlen($uni1_degree) <= 3){
                    $pdf->SetXY(142, 211.5);
                }else{
                    $pdf->SetXY(139, 211.5);
                }
                $this_font_size = $font_size;
                while($pdf->GetStringWidth($uni1_degree) > $line_width) {                   
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }               
                $pdf->Write(8, $uni1_degree);

                // University - 1 Grade
                $decrement_step = 0.1;
                $line_width = 10;
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(153, 211.5);
                $this_font_size = $font_size;
                while($pdf->GetStringWidth($uni1_grade) > $line_width) {                    
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }
                $pdf->Write(8, $uni1_grade);

                // University - 1 Year
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(173.5, 211.5);
                $pdf->Write(8, $uni1_year);



                // University - 2 Name
                $decrement_step = 0.1;
                $line_width = 80;
                $pdf->SetFont($font_name);              
                $pdf->SetXY(14, 218);
                $this_font_size = $font_size;
                while($pdf->GetStringWidth($uni2_Name) > $line_width) {
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }
                $pdf->Write(8, ucwords(strtolower($uni2_Name)));

                // University - 2 Subject
                $decrement_step = 0.1;
                $line_width = 35;
                $pdf->SetFont($font_name);              
                $pdf->SetXY(102, 218);
                $this_font_size = $font_size;
                while($pdf->GetStringWidth($uni2_subjects) > $line_width) {
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }
                $pdf->Write(8, ucwords(strtolower($uni2_subjects)));

                // University - 2 Degree
                $decrement_step = 0.1;
                $line_width = 10;
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                if(strlen($uni2_degree) <= 3){
                    $pdf->SetXY(142, 218);
                }else{
                    $pdf->SetXY(139, 218);
                }
                $this_font_size = $font_size;
                while($pdf->GetStringWidth($uni2_degree) > $line_width) {                   
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }               
                $pdf->Write(8, $uni2_degree);
                // University - 2 Grade

                $decrement_step = 0.1;
                $line_width = 10;
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(153, 218);
                $this_font_size = $font_size;
                while($pdf->GetStringWidth($uni2_grade) > $line_width) {                    
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }
                $pdf->Write(8, $uni2_grade);
                // University - 2 Year
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(173.5, 218);
                $pdf->Write(8, $uni2_year);



                // University - 3 Name
                $decrement_step = 0.1;
                $line_width = 80;
                $pdf->SetFont($font_name);              
                $pdf->SetXY(14, 224.5);
                $this_font_size = $font_size;
                while($pdf->GetStringWidth($uni3_Name) > $line_width) {
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }
                $pdf->Write(8, ucwords(strtolower($uni3_Name)));

                // University - 3 Subject
                $decrement_step = 0.1;
                $line_width = 35;
                $pdf->SetFont($font_name);              
                $pdf->SetXY(102, 224.5);
                $this_font_size = $font_size;
                while($pdf->GetStringWidth($uni3_subjects) > $line_width) {
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }
                $pdf->Write(8, ucwords(strtolower($uni3_subjects)));

                // University - 3 Degree
                $decrement_step = 0.1;
                $line_width = 10;
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                if(strlen($uni3_degree) <= 3){
                    $pdf->SetXY(142, 224.5);
                }else{
                    $pdf->SetXY(139, 224.5);
                }
                $this_font_size = $font_size;
                while($pdf->GetStringWidth($uni3_degree) > $line_width) {                   
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }               
                $pdf->Write(8, $uni3_degree);
                // University - 3 Grade
                $decrement_step = 0.1;
                $line_width = 10;
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(153, 224.5);
                $this_font_size = $font_size;
                while($pdf->GetStringWidth($uni3_grade) > $line_width) {
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }
                $pdf->Write(8, $uni3_grade);
                // University - 3 Year
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(173.5, 224.5);
                $pdf->Write(8, $uni3_year);
                /***** End University *****/


                /************************************************ Training, Skills & Experience ****
                ************************************************************************************/
                
                // Traing Qualification
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(14, 247.5);
                $pdf->Write(8, ucwords(strtolower($trainingQualification_1)));
                $pdf->SetXY(14, 253.5);
                $pdf->Write(8, ucwords(strtolower($trainingQualification_2)));
                $pdf->SetXY(14, 259.5);
                $pdf->Write(8, ucwords(strtolower($trainingQualification_3)));
                $pdf->SetXY(14, 265.5);
                $pdf->Write(8, ucwords(strtolower($trainingQualification_4)));
                $pdf->SetXY(14, 271.5);

                $pro_qualification_1 = "";
                $pro_qualification_2 = "";
                $pro_qualification_3 = "";
                $pro_qualification_4 = "";

                if(!empty($online['applicant_pro_q'][0])){
                    $pro_qualification_1 = $online['applicant_pro_q'][0][0]->title;
                    $pro_qualification_2 = $online['applicant_pro_q'][0][0]->institute;
                    $pro_qualification_3 = $online['applicant_pro_q'][0][0]->year_awarded;
                    $pro_qualification_4 = $online['applicant_pro_q'][0][0]->detail;

                    // Professional Qualification
                    $pdf->SetFont($font_name);
                    $pdf->SetFont($font_name,'',$font_size);
                    $pdf->SetXY(102, 247.5);
                    $pdf->Write(8, ucwords(strtolower($pro_qualification_1)));
                    $pdf->SetXY(102, 253.5);
                    $pdf->Write(8, ucwords(strtolower($pro_qualification_2)));
                    $pdf->SetXY(102, 259.5);
                    $pdf->Write(8, ucwords(strtolower($pro_qualification_3)));
                    
                    
                    $decrement_step = 0.1;
                    $line_width = 83;
                    $pdf->SetFont($font_name);
                    $pdf->SetFont($font_name,'',$font_size);
                    $pdf->SetXY(102, 265.5);
                    $this_font_size = $font_size;
                    while($pdf->GetStringWidth($pro_qualification_4) > $line_width) {
                        $this_font_size -= $decrement_step;
                        $pdf->SetFont($font_name,'',$this_font_size);
                    }
                    $pdf->Write(8, $pro_qualification_4);
                }
            }

            if ($templateId == 2) {

                /*************************************************************** IT Expertise  ****
                ************************************************************************************/

                // Word
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(21.8, 20);
                $pdf->Write(8, $word);

                // Excel
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(46.8, 20);
                $pdf->Write(8, $excel);

                // Power Point
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(72.5, 20);
                $pdf->Write(8, $powerpoint);

                // ERP Software
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(102.2, 20);
                $pdf->Write(8, $erpsoftware);

                // Internet & Usage
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(137, 20);
                $pdf->Write(8, $internet);

                // Email
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(178.3, 20);
                $pdf->Write(8, $itemail);

                // Graphics
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(21.5, 30);
                $pdf->Write(8, $graphics);

                // Other
                $decrement_step = 0.1;
                $line_width = 109;
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(83, 30);
                $this_font_size = $font_size;
                while($pdf->GetStringWidth($other) > $line_width) {
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }
                $pdf->Write(8, $other);

                
                /*************************************************** Current & Last Employment ****
                ************************************************************************************/

                // Currently employed
                if ($currentlyemployed == 'Y')
                {
                    $pdf->AddFont('wingdng2','','wingdng2.php');
                    $pdf->SetFont('wingdng2','',$gender_mark_size);
                    $pdf->SetXY(62.5, 50);
                    $pdf->Write(8, 'P');

                }else if($currentlyemployed == 'N'){
                    $pdf->AddFont('wingdng2','','wingdng2.php');
                    $pdf->SetFont('wingdng2','',$gender_mark_size);
                    $pdf->SetXY(87, 50);
                    $pdf->Write(8, 'P');
                }

                // Name of Employer

                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(66, 56.5);
                $pdf->Write(8, $organization);

                // Years of Service

                $year = "";
                $yearsofservice = ($toyear - $fromyear);
                if ($yearsofservice != "") {
                    if ($yearsofservice == '1'){
                        $year = $yearsofservice .' Year';
                    }elseif ($yearsofservice >= '2') {
                        $year = $yearsofservice .' Years';
                    }elseif ($yearsofservice <='0') {
                        $year = 'Less than year';
                    }
                }

                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(66, 75.5);
                $pdf->Write(8, $year);

                // Designation

                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(66, 82);
                $pdf->Write(8, $designation);

                // Notice Period 

                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(75, 103);
                $pdf->Write(8, $noticeperiod);

                // When can you join

                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(153, 103);
                $pdf->Write(8, $whencanjoin);

                // Current Salary

                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(51, 111.2);
                $pdf->Write(8, $cursalary);

                // Expected Salary

                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(162, 111);
                $pdf->Write(8, $expsalary);

                // Current Timings

                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(51, 119);
                $pdf->Write(8, $curtiming);

                /******************************************* Employment Information and History ****
                ************************************************************************************/
                /***** Start Employment Line 1 *****/
                // Istitution 1
                $decrement_step = 0.1;
                $line_width = 42;
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(20, 157);
                $this_font_size = $font_size;
                while($pdf->GetStringWidth($organization) > $line_width) {
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }
                $pdf->Write(8, $organization);

                // Designation 1
                $decrement_step = 0.1;
                $line_width = 23.5;
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(64.5, 157);
                while($pdf->GetStringWidth($designation) > $line_width) {
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }
                $pdf->Write(8, $designation);

                // Class Taught 1
                $decrement_step = 0.1;
                $line_width = 17;
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(89.5, 157);
                while($pdf->GetStringWidth($classtaught) > $line_width) {
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }
                $pdf->Write(8, $classtaught);

                // Subject Taught 1
                $decrement_step = 0.1;
                $line_width = 17;
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(102.5, 157);
                while($pdf->GetStringWidth($subjecttaught) > $line_width) {
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }
                $pdf->Write(8, $subjecttaught);

                // Salary 1
                $decrement_step = 0.1;
                $line_width = 17;
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(115.7, 157);
                while($pdf->GetStringWidth($salary) > $line_width) {
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }
                $pdf->Write(8, $salary);

                // From Year 1
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(129, 157);
                $pdf->Write(8, $fromyear);

                // To Year 1
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(142, 157);
                $pdf->Write(8, $toyear);

                // Reason of Leaving 1
                $decrement_step = 0.1;
                $line_width = 42;
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(153, 157);
                $this_font_size = $font_size;
                while($pdf->GetStringWidth($reasonofleaving) > $line_width) {
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }
                $pdf->Write(8, $reasonofleaving);

                /***** End Employment Line 1 *****/

                /***** Start Employment Line 2 *****/
                // Istitution 2
                $decrement_step = 0.1;
                $line_width = 42;
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(20, 163.4);
                $this_font_size = $font_size;
                while($pdf->GetStringWidth($organization_2) > $line_width) {
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }
                $pdf->Write(8, $organization_2);

                // Designation 2
                $decrement_step = 0.1;
                $line_width = 23.5;
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(64.5, 163.4);
                while($pdf->GetStringWidth($designation_2) > $line_width) {
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }
                $pdf->Write(8, $designation_2);

                // Class Taught 2
                $decrement_step = 0.1;
                $line_width = 17;
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(89.5, 163.4);
                while($pdf->GetStringWidth($classtaught_2) > $line_width) {
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }
                $pdf->Write(8, $classtaught_2);

                // Subject Taught 2
                $decrement_step = 0.1;
                $line_width = 17;
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(102.5, 163.4);
                while($pdf->GetStringWidth($subjecttaught_2) > $line_width) {
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }
                $pdf->Write(8, $subjecttaught_2);

                // Salary 2
                $decrement_step = 0.1;
                $line_width = 17;
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(115.5, 163.4);
                while($pdf->GetStringWidth($salary_2) > $line_width) {
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }
                $pdf->Write(8, $salary_2);

                // From Year 2
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(129, 163.4);
                $pdf->Write(8, $fromyear_2);

                // To Year 2
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(142, 163.4);
                $pdf->Write(8, $toyear_2);

                // Reason of Leaving 2              
                $decrement_step = 0.1;
                $line_width = 42;
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(153, 163.4);
                $this_font_size = $font_size;
                while($pdf->GetStringWidth($reasonofleaving_2) > $line_width) {
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }
                $pdf->Write(8, $reasonofleaving_2);

                /***** End Employment Line 2 *****/

                /***** Start Employment Line 3 *****/
                // Istitution 3             
                $decrement_step = 0.1;
                $line_width = 42;
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(20, 169.8);
                $this_font_size = $font_size;
                while($pdf->GetStringWidth($organization_3) > $line_width) {
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }
                $pdf->Write(8, $organization_3);

                // Designation 3
                $decrement_step = 0.1;
                $line_width = 23.5;
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(64.5, 169.8);
                while($pdf->GetStringWidth($designation_3) > $line_width) {
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }
                $pdf->Write(8, $designation_3);

                // Class Taught 3
                $decrement_step = 0.1;
                $line_width = 17;
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(89.5, 169.8);
                while($pdf->GetStringWidth($classtaught_3) > $line_width) {
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }
                $pdf->Write(8, $classtaught_3);

                // Subject Taught 3
                $decrement_step = 0.1;
                $line_width = 17;
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(102.5, 169.8);
                while($pdf->GetStringWidth($subjecttaught_3) > $line_width) {
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }
                $pdf->Write(8, $subjecttaught_3);

                // Salary 3
                $decrement_step = 0.1;
                $line_width = 17;
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(115.5, 169.8);
                while($pdf->GetStringWidth($salary_3) > $line_width) {
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }
                $pdf->Write(8, $salary_3);

                // From Year 3
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(129, 169.8);
                $pdf->Write(8, $fromyear_3);

                // To Year 3
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(142, 169.8);
                $pdf->Write(8, $toyear_3);

                // Reason of Leaving 3
                $decrement_step = 0.1;
                $line_width = 42;
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(153, 169.8);
                $this_font_size = $font_size;
                while($pdf->GetStringWidth($reasonofleaving_3) > $line_width) {
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }
                $pdf->Write(8, $reasonofleaving_3);


                /***** End Employment Line 3 *****/

                /***** Start Employment Line 4 *****/
                // Istitution 4
                $decrement_step = 0.1;
                $line_width = 42;
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(20, 176.2);
                $this_font_size = $font_size;
                while($pdf->GetStringWidth($organization_4) > $line_width) {
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }
                $pdf->Write(8, $organization_4);

                // Designation 4
                $decrement_step = 0.1;
                $line_width = 23.5;
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(64.5, 176.2);
                while($pdf->GetStringWidth($designation_4) > $line_width) {
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }
                $pdf->Write(8, $designation_4);

                // Class Taught 4
                $decrement_step = 0.1;
                $line_width = 17;
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(89.5, 176.2);
                while($pdf->GetStringWidth($classtaught_4) > $line_width) {
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }
                $pdf->Write(8, $classtaught_4);

                // Subject Taught 4
                $decrement_step = 0.1;
                $line_width = 17;
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(102.5, 176.2);
                while($pdf->GetStringWidth($subjecttaught_4) > $line_width) {
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }
                $pdf->Write(8, $subjecttaught_4);

                // Salary 4
                $decrement_step = 0.1;
                $line_width = 17;
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(115.5, 176.2);
                while($pdf->GetStringWidth($salary_4) > $line_width) {
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }
                $pdf->Write(8, $salary_4);

                // From Year 4
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(129, 176.2);
                $pdf->Write(8, $fromyear_4);

                // To Year 4
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(142, 176.2);
                $pdf->Write(8, $toyear_4);

                // Reason of Leaving 4              
                $decrement_step = 0.1;
                $line_width = 42;
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(153, 176.2);
                $this_font_size = $font_size;
                while($pdf->GetStringWidth($reasonofleaving_4) > $line_width) {
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }
                $pdf->Write(8, $reasonofleaving_4);


                /***** End Employment Line 4 *****/

                /***** Start Employment Line 5 *****/
                // Istitution 5
                $decrement_step = 0.1;
                $line_width = 42;
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(20, 182.6);
                $this_font_size = $font_size;
                while($pdf->GetStringWidth($organization_5) > $line_width) {
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }
                $pdf->Write(8, $organization_5);

                // Designation 5
                $decrement_step = 0.1;
                $line_width = 23.5;
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(64.5, 182.6);
                while($pdf->GetStringWidth($designation_5) > $line_width) {
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }
                $pdf->Write(8, $designation_5);

                // Class Taught 5
                $decrement_step = 0.1;
                $line_width = 17;
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(89.5, 182.6);
                while($pdf->GetStringWidth($classtaught_5) > $line_width) {
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }
                $pdf->Write(8, $classtaught_5);

                // Subject Taught 5
                $decrement_step = 0.1;
                $line_width = 17;
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(102.5, 182.6);
                while($pdf->GetStringWidth($subjecttaught_5) > $line_width) {
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }
                $pdf->Write(8, $subjecttaught_5);

                // Salary 5
                $decrement_step = 0.1;
                $line_width = 17;
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(115.5, 182.6);
                while($pdf->GetStringWidth($salary_5) > $line_width) {
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }
                $pdf->Write(8, $salary_5);

                // From Year 5
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(129, 182.6);
                $pdf->Write(8, $fromyear_5);

                // To Year 5
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(142, 182.6);
                $pdf->Write(8, $toyear_5);

                // Reason of Leaving 5              
                $decrement_step = 0.1;
                $line_width = 42;
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(153, 182.6);
                $this_font_size = $font_size;
                while($pdf->GetStringWidth($reasonofleaving_5) > $line_width) {
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }
                $pdf->Write(8, $reasonofleaving_5);

                /***** End Employment Line 5 *****/

                /******************************************************* What can you offer us? ****
                ************************************************************************************/

                // Seeking Position
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(20, 210);
                $pdf->Write(8, $seekingpositon);

                /******************************************************* Classes to teach **********
                ************************************************************************************/

                $class_to_teach = $online['applicant_form'][0][0]->class_to_teach;
                if(!empty($class_to_teach)){

                    $classes = explode(",",$class_to_teach);

                    foreach ($classes as $class) {
                        $array_val = 0;
                        if($class == "Early Years"){
                            // Early Class
                            $pdf->AddFont('wingdng2','','wingdng2.php');
                            $pdf->SetFont('wingdng2','',$gender_mark_size);
                            $pdf->SetXY(24.5, 226);
                            $pdf->Write(8, 'P');
                        }

                        $array_val++;
                        if($class == "I"){
                            // Class 1
                            $pdf->AddFont('wingdng2','','wingdng2.php');
                            $pdf->SetFont('wingdng2','',$gender_mark_size);
                            $pdf->SetXY(41.5, 226);
                            $pdf->Write(8, 'P');
                        }

                        $array_val++;
                        if($class == "II"){
                            // Class 2
                            $pdf->AddFont('wingdng2','','wingdng2.php');
                            $pdf->SetFont('wingdng2','',$gender_mark_size);
                            $pdf->SetXY(54.5, 226);
                            $pdf->Write(8, 'P');
                        }
                    
                        $array_val++;
                        if($class == "III"){
                            // Class 3
                            $pdf->AddFont('wingdng2','','wingdng2.php');
                            $pdf->SetFont('wingdng2','',$gender_mark_size);
                            $pdf->SetXY(67, 226);
                            $pdf->Write(8, 'P');
                        }
                    
                        $array_val++;
                        if($class == "IV"){
                            // Class 4
                            $pdf->AddFont('wingdng2','','wingdng2.php');
                            $pdf->SetFont('wingdng2','',$gender_mark_size);
                            $pdf->SetXY(79.5, 226);
                            $pdf->Write(8, 'P');
                        }

                        $array_val++;
                        if($class == "V"){
                            // Class 5
                            $pdf->AddFont('wingdng2','','wingdng2.php');
                            $pdf->SetFont('wingdng2','',$gender_mark_size);
                            $pdf->SetXY(92, 226);
                            $pdf->Write(8, 'P');
                        }
                        
                        $array_val++;
                        if($class == "VI"){
                            // Class 6
                            $pdf->AddFont('wingdng2','','wingdng2.php');
                            $pdf->SetFont('wingdng2','',$gender_mark_size);
                            $pdf->SetXY(105.5, 226);
                            $pdf->Write(8, 'P');
                        }
                        
                        $array_val++;
                        if($class == "VII"){
                            // Class 7
                            $pdf->AddFont('wingdng2','','wingdng2.php');
                            $pdf->SetFont('wingdng2','',$gender_mark_size);
                            $pdf->SetXY(118.5, 226);
                            $pdf->Write(8, 'P');
                        }
                        
                        $array_val++;
                        if($class == "VIII"){
                            // Class 8
                            $pdf->AddFont('wingdng2','','wingdng2.php');
                            $pdf->SetFont('wingdng2','',$gender_mark_size);
                            $pdf->SetXY(130.5, 226);
                            $pdf->Write(8, 'P');
                        }


                        $array_val++;
                        if($class == "IX"){
                            // Class 9
                            $pdf->AddFont('wingdng2','','wingdng2.php');
                            $pdf->SetFont('wingdng2','',$gender_mark_size);
                            $pdf->SetXY(143.5, 226);
                            $pdf->Write(8, 'P');
                        }
                    
                        $array_val++;
                        if($class == "X"){
                            // Class 10
                            $pdf->AddFont('wingdng2','','wingdng2.php');
                            $pdf->SetFont('wingdng2','',$gender_mark_size);
                            $pdf->SetXY(155.5, 226);
                            $pdf->Write(8, 'P');
                        }
                    
                        $array_val++;
                        if($class == "XI"){
                            // Class 11
                            $pdf->AddFont('wingdng2','','wingdng2.php');
                            $pdf->SetFont('wingdng2','',$gender_mark_size);
                            $pdf->SetXY(168.5, 226);
                            $pdf->Write(8, 'P');
                        }
                    
                        $array_val++;
                        if($class == "A-Level"){
                            // Class 12
                            $pdf->AddFont('wingdng2','','wingdng2.php');
                            $pdf->SetFont('wingdng2','',$gender_mark_size);
                            $pdf->SetXY(184, 226);
                            $pdf->Write(8, 'P');
                        }
                    }
                    
                }


                /********************************************** Able and Willing to teach **********
                ************************************************************************************/
                // Subject & Grades 1
                $decrement_step = 0.1;
                $line_width = 84;
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(20, 246.2);
                $this_font_size = $font_size;
                while($pdf->GetStringWidth($TaughtSubject_1) > $line_width) {
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }
                $pdf->Write(8, $TaughtSubject_1);


                $decrement_step = 0.1;
                $line_width = 84;
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(110, 246.2);
                $this_font_size = $font_size;
                while($pdf->GetStringWidth($TaughtGrade_1) > $line_width) {
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }
                $pdf->Write(8, $TaughtGrade_1);


                // Subject & Grades 2
                $decrement_step = 0.1;
                $line_width = 84;
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(20, 252.4);
                $this_font_size = $font_size;
                while($pdf->GetStringWidth($TaughtSubject_2) > $line_width) {
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }
                $pdf->Write(8, $TaughtSubject_2);


                $decrement_step = 0.1;
                $line_width = 84;
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(110, 252.4);
                $this_font_size = $font_size;
                while($pdf->GetStringWidth($TaughtGrade_2) > $line_width) {
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }
                $pdf->Write(8, $TaughtGrade_2);



                // Subject & Grades 3
                $decrement_step = 0.1;
                $line_width = 84;
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(20, 258.6);
                $this_font_size = $font_size;
                while($pdf->GetStringWidth($TaughtSubject_3) > $line_width) {
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }
                $pdf->Write(8, $TaughtSubject_3);


                $decrement_step = 0.1;
                $line_width = 84;
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(110, 258.6);
                $this_font_size = $font_size;
                while($pdf->GetStringWidth($TaughtGrade_3) > $line_width) {
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }
                $pdf->Write(8, $TaughtGrade_3);




                // Subject & Grades 4
                $decrement_step = 0.1;
                $line_width = 84;
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(20, 265);
                $this_font_size = $font_size;
                while($pdf->GetStringWidth($TaughtSubject_4) > $line_width) {
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }
                $pdf->Write(8, $TaughtSubject_4);


                $decrement_step = 0.1;
                $line_width = 84;
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(110, 265);
                $this_font_size = $font_size;
                while($pdf->GetStringWidth($TaughtGrade_4) > $line_width) {
                    $this_font_size -= $decrement_step;
                    $pdf->SetFont($font_name,'',$this_font_size);
                }
                $pdf->Write(8, $TaughtGrade_4);


            }
        }


        if(isset($fileMode) && $fileMode == "1"){
            $pdf->Output($form_id . '-' . $name . '.pdf', 'D');
        }else{
            $pdf->Output($form_id . '-' . $name . '.pdf', 'I');
        }
    }



}
