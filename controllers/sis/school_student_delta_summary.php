<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class School_student_delta_summary extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->dateRangeFrom = "";
		$this->dateRangeTo = "";
	}

	public function index()
	{
		if(count($_POST))
		{
			$dateRange = $this->input->post('e1');
			$dateRange = json_decode($dateRange, true);
			$this->dateRangeFrom = $dateRange["start"];
			$this->dateRangeTo = date('Y-M-d'); //$dateRange["end"];
		}
		$this->load->view('school_wide_report/student_delta_summary_view');
		$this->load->view('school_wide_report/student_strength_orb_footer');
	}

	public function printForm2()
	{
		$now_date = date('d-M-Y');

		 //Set the Content Type
		header("Content-type: image/jpeg");
		// Create Image From Existing Template
	    $imgPath = 'Components/image/school_wide_report/student_delta_summary.jpg';
	    $image = imagecreatefromjpeg($imgPath);
	    // Allocate A Color For The Text
	    $colorText = imagecolorallocate($image, 0, 0, 0);
	    // Set Path to Font File
  		$font_path = 'Components/image/font/calibri.ttf';




	    $this->load->model('school_wide_report/student_delta_summary_model');
		$data['strength_report'] = $this->student_delta_summary_model->getStudentGradeSectionSummary();
		$data['grade_strength_report'] = $this->student_delta_summary_model->getStudentGradeSummary();
		$data['wing_strength_report'] = $this->student_delta_summary_model->getStudentWingSummary();
		$data['campus_strength_report'] = $this->student_delta_summary_model->getStudentCampusSummary();


		$name = $data['strength_report'][0]['grade_name'];

		$sectionNames = array('G', 'S', 'C', 'P', 'R', 'W', 'E', 'L', 'K', 'M');
		$FontSize_data = 6;
		$SectionName = "";
		$GradeName = "";		
		$Students = "";		
		$Jinnah = "";		
		$Iqbal = "";
		$Syed = "";
		$Girl = "";
		$Boy = "";
		$y = 0;


		// some color in RGB



	    $string = $now_date;
	    $fontSize = 28;
	    $angle = 0;
	    $x = 50;
	    $y = 50;
	    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

	    /**************************************************************
		// Call School
		// Num of (Jinnah, Iqbal, Syed) and (Boys, Girls)
		//*************************************************************/
		$i=0;
		$xx = 87;
	    $fontSize = 22;
	    
		$Jinnah = $data['campus_strength_report'][0]['students'] + $data['campus_strength_report'][1]['students'];
		$Iqbal = $data['campus_strength_report'][0]['present'] + $data['campus_strength_report'][1]['present'];
		$Syed = $data['campus_strength_report'][0]['students'] + $data['campus_strength_report'][1]['students'] - $data['campus_strength_report'][0]['present'] + $data['campus_strength_report'][1]['present'];
		$Girl = $data['campus_strength_report'][0]['no_card'] + $data['campus_strength_report'][1]['no_card'];
		$Boy = $data['campus_strength_report'][0]['late'] + $data['campus_strength_report'][1]['late'];
		$Students = "2.5";
		$DO = "2.5";
		$LA = "2.5";
		$LI = "2.5";

	    $yy = 750;
		$y_inner = 85;
		$x_inner_house = 67;
		$x_inner_gender = 100;

		// Jinnah, Iqbal, Syed
		$string = $Jinnah;			    
	    $angle = 0;
	    $x = $xx+($i*14.5);
	    $y = $yy;
	    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

	    $string = $Iqbal;			    
	    $angle = 0;
	    $x = $xx+$x_inner_house+($i*14.5)+21;
	    $y = $yy;
	    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

		$string = $Syed;			    
	    $angle = 0;
	    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5)-2;
	    $y = $yy;
	    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


	    // Boy and Girl
	    $string = $Girl;			    
	    $angle = 0;
	    $x = $xx+41;
	    $y = $yy + $y_inner;
	    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

	    $string = $Boy;			    
	    $angle = 0;
	    $x = $xx+$x_inner_gender+32;
	    $y = $yy + $y_inner;
	    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
		
	    // Total Students
	    $string = $Students;			    
	    $angle = 0;
	    $x = $xx+25;
	    $y = $yy + $y_inner + $y_inner + 2;
	    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
		
		
		$string = $DO;					    
	    $angle = 0;
	    $x = $xx+125;
	    $y = $yy + $y_inner + $y_inner + 2;
	    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
		
		// Students
		 $string = $LA;			    
	    $angle = 0;
	    $x = $xx+25;
	    $y = $yy + $y_inner + $y_inner + 85;
	    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
		
		
		$string = $LI;					    
	    $angle = 0;
	    $x = $xx+125;
	    $y = $yy + $y_inner + $y_inner +  85;
	    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
	    /**************************************************************
		// Call Campus
		// Num of (Jinnah, Iqbal, Syed) and (Boys, Girls)
		//*************************************************************/
		$i=0;
		$xx = 147;
	    $fontSize = 20;    
		foreach ($data['campus_strength_report'] as $strength_report) {	    			
			$GradeName = $strength_report['campus_name'];			
			$Jinnah = $strength_report['students'];
			$Iqbal = $strength_report['present'];
			$Syed = $strength_report['students'] - $strength_report['present'];
			$Girl = $strength_report['no_card'];
			$Boy = $strength_report['late'];
			$Students = "2.5";			

			// North Campus
			if($strength_report['campus_name'] == 'North Campus'){
				$yy = 352;
				$y_inner = 55;
				$x_inner_house = 67;
				$x_inner_gender = 100;

				// Jinnah, Iqbal, Syed
				$string = $Jinnah;			    
			    $angle = 0;
			    $x = $xx+($i*14.5)+5;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Iqbal;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*14.5)+30;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				$string = $Syed;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5)+2;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


			    // Boy and Girl
			    $string = $Girl;			    
			    $angle = 0;
			    $x = $xx+30;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Boy;			    
			    $angle = 0;
			    $x = $xx+$x_inner_gender+35;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				
			    // Total Students
			    $string = $Students;			    
			    $angle = 0;
			    $x = $xx+20;
			    $y = $yy + $y_inner + $y_inner + 2;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				$string = $DO;			    
			    $angle = 0;
			    $x = $xx+135;
			    $y = $yy + $y_inner + $y_inner + 2;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				// Students
				 $string = $LA;			    
				$angle = 0;
				$x = $xx+25;
				$y = $yy + $y_inner + $y_inner + 55;
				imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				
				$string = $LI;					    
				$angle = 0;
				$x = $xx+125;
				$y = $yy + $y_inner + $y_inner +  55;
				imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
			}else// South Campus
			if($strength_report['campus_name'] == 'South Campus'){
				$yy = 1202;
				$y_inner = 55;
				$x_inner_house = 67;
				$x_inner_gender = 100;

				// Jinnah, Iqbal, Syed
				$string = $Jinnah;			    
			    $angle = 0;
			    $x = $xx+($i*14.5)+5;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Iqbal;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*14.5)+30;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				$string = $Syed;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5)+2;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


			    // Boy and Girl
			    $string = $Girl;			    
			    $angle = 0;
			    $x = $xx+30;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Boy;			    
			    $angle = 0;
			    $x = $xx+$x_inner_gender+35;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				
			    // Total Students
			    $string = $Students;			    
			    $angle = 0;
			    $x = $xx+20;
			    $y = $yy + $y_inner + $y_inner + 2;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				$string = $DO;			    
			    $angle = 0;
			    $x = $xx+135;
			    $y = $yy + $y_inner + $y_inner + 2;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				// Students
				 $string = $LA;			    
				$angle = 0;
				$x = $xx+25;
				$y = $yy + $y_inner + $y_inner + 55;
				imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				
				$string = $LI;					    
				$angle = 0;
				$x = $xx+125;
				$y = $yy + $y_inner + $y_inner +  55;
				imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			}
		}


	    /**************************************************************
		// Call Wing
		// Num of (Jinnah, Iqbal, Syed) and (Boys, Girls)
		//*************************************************************/
		$i=0;
		$xx = 420;
	    $fontSize = 22;	    
		foreach ($data['wing_strength_report'] as $strength_report) {	    			
			$GradeName = $strength_report['wing_name'];			
			$Jinnah = $strength_report['students'];
			$Iqbal = $strength_report['present'];
			$Syed = $strength_report['students'] - $strength_report['present'];
			$Girl = $strength_report['no_card'];
			$Boy = $strength_report['late'];
			$Students = "2.5";

			// Pre-Primary
			if($strength_report['wing_name'] == 'Pre-Primary'){
				$yy = 283;
				$y_inner = 28;
				$x_inner_house = 58;
				$x_inner_gender = 100;

				// Jinnah, Iqbal, Syed
				$string = $Jinnah;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Iqbal;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*14.5)+20;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				$string = $Syed;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5)+5;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


			    // Boy and Girl
			    $string = $Girl;			    
			    $angle = 0;
			    $x = $xx+18;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Boy;			    
			    $angle = 0;
			    $x = $xx+$x_inner_gender+($i*14.5)+19;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
    			  			

			    // Total Students
			    $string = $Students;			    
			    $angle = 0;
			    $x = $xx+20;
			    $y = $yy + $y_inner + $y_inner - 2;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				 $string = $DO;			    
			    $angle = 0;
			    $x = $xx+105;
			    $y = $yy + $y_inner + $y_inner - 2;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				 // Total Students
			    $string = $LA;			    
			    $angle = 0;
			    $x = $xx+20;
			    $y = $yy + $y_inner + $y_inner + 26;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				 $string = $LI;			    
			    $angle = 0;
			    $x = $xx+105;
			    $y = $yy + $y_inner + $y_inner + 26;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			}else// Elementry
			if($strength_report['wing_name'] == 'Elementry'){
				$yy = 668;
				$y_inner = 28;
				$x_inner_house = 58;
				$x_inner_gender = 100;

				// Jinnah, Iqbal, Syed
				$string = $Jinnah;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Iqbal;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*14.5)+20;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				$string = $Syed;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5)+5;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


			    // Boy and Girl
			    $string = $Girl;			    
			    $angle = 0;
			    $x = $xx+18;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Boy;			    
			    $angle = 0;
			    $x = $xx+$x_inner_gender+($i*14.5)+19;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
    			  			

			    // Total Students
			    $string = $Students;			    
			    $angle = 0;
			    $x = $xx+20;
			    $y = $yy + $y_inner + $y_inner - 2;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				 $string = $DO;			    
			    $angle = 0;
			    $x = $xx+105;
			    $y = $yy + $y_inner + $y_inner - 2;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				 // Total Students
			    $string = $LA;			    
			    $angle = 0;
			    $x = $xx+20;
			    $y = $yy + $y_inner + $y_inner + 26;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				 $string = $LI;			    
			    $angle = 0;
			    $x = $xx+105;
			    $y = $yy + $y_inner + $y_inner + 26;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			}else// Junior
			if($strength_report['wing_name'] == 'Junior'){
				$yy = 1080;
				$y_inner = 28;
				$x_inner_house = 58;
				$x_inner_gender = 100;

				// Jinnah, Iqbal, Syed
				$string = $Jinnah;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Iqbal;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*14.5)+20;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				$string = $Syed;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5)+5;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


			    // Boy and Girl
			    $string = $Girl;			    
			    $angle = 0;
			    $x = $xx+18;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Boy;			    
			    $angle = 0;
			    $x = $xx+$x_inner_gender+($i*14.5)+19;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
    			  			

			    // Total Students
			    $string = $Students;			    
			    $angle = 0;
			    $x = $xx+20;
			    $y = $yy + $y_inner + $y_inner - 2;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				 $string = $DO;			    
			    $angle = 0;
			    $x = $xx+105;
			    $y = $yy + $y_inner + $y_inner - 2;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				 // Total Students
			    $string = $LA;			    
			    $angle = 0;
			    $x = $xx+20;
			    $y = $yy + $y_inner + $y_inner + 26;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				 $string = $LI;			    
			    $angle = 0;
			    $x = $xx+105;
			    $y = $yy + $y_inner + $y_inner + 26;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			}else// Middler
			if($strength_report['wing_name'] == 'Middler'){
				$yy = 1572;
				$y_inner = 28;
				$x_inner_house = 58;
				$x_inner_gender = 100;

				// Jinnah, Iqbal, Syed
				$string = $Jinnah;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Iqbal;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*14.5)+20;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				$string = $Syed;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5)+5;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


			    // Boy and Girl
			    $string = $Girl;			    
			    $angle = 0;
			    $x = $xx+18;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Boy;			    
			    $angle = 0;
			    $x = $xx+$x_inner_gender+($i*14.5)+19;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
    			  			

			    // Total Students
			    $string = $Students;			    
			    $angle = 0;
			    $x = $xx+20;
			    $y = $yy + $y_inner + $y_inner - 2;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				 $string = $DO;			    
			    $angle = 0;
			    $x = $xx+105;
			    $y = $yy + $y_inner + $y_inner - 2;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				 // Total Students
			    $string = $LA;			    
			    $angle = 0;
			    $x = $xx+20;
			    $y = $yy + $y_inner + $y_inner + 26;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				 $string = $LI;			    
			    $angle = 0;
			    $x = $xx+105;
			    $y = $yy + $y_inner + $y_inner + 26;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			}else// O-Level
			if($strength_report['wing_name'] == 'O-Level'){
				$yy = 1904;
				$y_inner = 28;
				$x_inner_house = 58;
				$x_inner_gender = 100;

				// Jinnah, Iqbal, Syed
				$string = $Jinnah;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Iqbal;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*14.5)+20;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				$string = $Syed;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5)+5;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


			    // Boy and Girl
			    $string = $Girl;			    
			    $angle = 0;
			    $x = $xx+18;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Boy;			    
			    $angle = 0;
			    $x = $xx+$x_inner_gender+($i*14.5)+19;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
    			  			

			    // Total Students
			    $string = $Students;			    
			    $angle = 0;
			    $x = $xx+20;
			    $y = $yy + $y_inner + $y_inner - 2;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				 $string = $DO;			    
			    $angle = 0;
			    $x = $xx+105;
			    $y = $yy + $y_inner + $y_inner - 2;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				 // Total Students
			    $string = $LA;			    
			    $angle = 0;
			    $x = $xx+20;
			    $y = $yy + $y_inner + $y_inner + 26;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				 $string = $LI;			    
			    $angle = 0;
			    $x = $xx+105;
			    $y = $yy + $y_inner + $y_inner + 26;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			}else// A-Level
			if($strength_report['wing_name'] == 'A-Level'){
				$yy = 2177;
				$y_inner = 28;
				$x_inner_house = 58;
				$x_inner_gender = 100;

				// Jinnah, Iqbal, Syed
				$string = $Jinnah;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Iqbal;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*14.5)+20;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				$string = $Syed;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5)+5;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


			    // Boy and Girl
			    $string = $Girl;			    
			    $angle = 0;
			    $x = $xx+18;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Boy;			    
			    $angle = 0;
			    $x = $xx+$x_inner_gender+($i*14.5)+19;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
    			  			

			    // Total Students
			    $string = $Students;			    
			    $angle = 0;
			    $x = $xx+20;
			    $y = $yy + $y_inner + $y_inner - 2;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				 $string = $DO;			    
			    $angle = 0;
			    $x = $xx+105;
			    $y = $yy + $y_inner + $y_inner - 2;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				 // Total Students
			    $string = $LA;			    
			    $angle = 0;
			    $x = $xx+20;
			    $y = $yy + $y_inner + $y_inner + 26;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				 $string = $LI;			    
			    $angle = 0;
			    $x = $xx+105;
			    $y = $yy + $y_inner + $y_inner + 26;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			}
		}

	    /**************************************************************
		// Call Grade
		// Num of (Jinnah, Iqbal, Syed) and (Boys, Girls)
		//*************************************************************/
		$i=0;
		$xx = 638;
	    $fontSize = 18;	    
		foreach ($data['grade_strength_report'] as $strength_report) {	    			
			$GradeName = $strength_report['grade_name'];			
			$Jinnah = $strength_report['students'];
			$Iqbal = $strength_report['present'];
			$Syed = $strength_report['students'] - $strength_report['present'];
			$Girl = $strength_report['no_card'];
			$Boy = $strength_report['late'];
			$Students = "2.5";	

			// Pre-Nursery			
			if($strength_report['grade_name'] == 'PN'){				
				$yy = 144;
				$y_inner = 28;
				$x_inner_house = 48;
				$x_inner_gender = 90;

				// Jinnah, Iqbal, Syed
				$string = $Jinnah;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Iqbal;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*14.5)+20;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				$string = $Syed;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5)+15;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


			    // Boy and Girl
			    $string = $Girl;			    
			    $angle = 0;
			    $x = $xx+($i*14.5)+15;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Boy;			    
			    $angle = 0;
			    $x = $xx+$x_inner_gender+($i*14.5)+15;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
    			  			

			    // Total Students
			    $string = $Students;			    
			    $angle = 0;
			    $x = $xx+10+($i*14.5);
			    $y = $yy + $y_inner + $y_inner + 0;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				$string = $DO;			    
			    $angle = 0;
			    $x = $xx+95+($i*14.5);
			    $y = $yy + $y_inner + $y_inner + 0;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				//Students
			    $string = $LA;			    
			    $angle = 0;
			    $x = $xx+10+($i*14.5);
			    $y = $yy + $y_inner + $y_inner + 28;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				$string = $LI;			    
			    $angle = 0;
			    $x = $xx+95+($i*14.5);
			    $y = $yy + $y_inner + $y_inner + 28;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			}else // Nursery
			if($strength_report['grade_name'] == 'N'){
				$yy = 281;
				$y_inner = 28;
				$x_inner_house = 48;
				$x_inner_gender = 90;

				// Jinnah, Iqbal, Syed
				$string = $Jinnah;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Iqbal;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*14.5)+20;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				$string = $Syed;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5)+15;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


			    // Boy and Girl
			    $string = $Girl;			    
			    $angle = 0;
			    $x = $xx+($i*14.5)+15;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Boy;			    
			    $angle = 0;
			    $x = $xx+$x_inner_gender+($i*14.5)+15;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
    			  			

			    // Total Students
			    $string = $Students;			    
			    $angle = 0;
			    $x = $xx+10+($i*14.5);
			    $y = $yy + $y_inner + $y_inner + 0;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				$string = $DO;			    
			    $angle = 0;
			    $x = $xx+95+($i*14.5);
			    $y = $yy + $y_inner + $y_inner + 0;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				//Students
			    $string = $LA;			    
			    $angle = 0;
			    $x = $xx+10+($i*14.5);
			    $y = $yy + $y_inner + $y_inner + 28;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				$string = $LI;			    
			    $angle = 0;
			    $x = $xx+95+($i*14.5);
			    $y = $yy + $y_inner + $y_inner + 28;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			}else // KG
			if($strength_report['grade_name'] == 'KG'){
				$yy = 419;
				$y_inner = 28;
				$x_inner_house = 48;
				$x_inner_gender = 90;

				// Jinnah, Iqbal, Syed
				$string = $Jinnah;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Iqbal;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*14.5)+20;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				$string = $Syed;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5)+15;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


			    // Boy and Girl
			    $string = $Girl;			    
			    $angle = 0;
			    $x = $xx+($i*14.5)+15;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Boy;			    
			    $angle = 0;
			    $x = $xx+$x_inner_gender+($i*14.5)+15;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
    			  			

			    // Total Students
			    $string = $Students;			    
			    $angle = 0;
			    $x = $xx+10+($i*14.5);
			    $y = $yy + $y_inner + $y_inner + 0;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				$string = $DO;			    
			    $angle = 0;
			    $x = $xx+95+($i*14.5);
			    $y = $yy + $y_inner + $y_inner + 0;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				//Students
			    $string = $LA;			    
			    $angle = 0;
			    $x = $xx+10+($i*14.5);
			    $y = $yy + $y_inner + $y_inner + 28;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				$string = $LI;			    
			    $angle = 0;
			    $x = $xx+95+($i*14.5);
			    $y = $yy + $y_inner + $y_inner + 28;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			}else // I
			if($strength_report['grade_name'] == 'I'){
				$yy = 610;
				$y_inner = 28;
				$x_inner_house = 48;
				$x_inner_gender = 90;

				// Jinnah, Iqbal, Syed
				$string = $Jinnah;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Iqbal;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*14.5)+20;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				$string = $Syed;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5)+15;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


			    // Boy and Girl
			    $string = $Girl;			    
			    $angle = 0;
			    $x = $xx+($i*14.5)+15;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Boy;			    
			    $angle = 0;
			    $x = $xx+$x_inner_gender+($i*14.5)+15;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
    			  			

			    // Total Students
			    $string = $Students;			    
			    $angle = 0;
			    $x = $xx+10+($i*14.5);
			    $y = $yy + $y_inner + $y_inner + 0;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				$string = $DO;			    
			    $angle = 0;
			    $x = $xx+95+($i*14.5);
			    $y = $yy + $y_inner + $y_inner + 0;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				//Students
			    $string = $LA;			    
			    $angle = 0;
			    $x = $xx+10+($i*14.5);
			    $y = $yy + $y_inner + $y_inner + 28;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				$string = $LI;			    
			    $angle = 0;
			    $x = $xx+95+($i*14.5);
			    $y = $yy + $y_inner + $y_inner + 28;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			}else {
				// II			
				$yy = $yy + 138;
				$y_inner = 28;
				$x_inner_house = 48;
				$x_inner_gender = 90;

				// Jinnah, Iqbal, Syed
				$string = $Jinnah;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Iqbal;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*14.5)+20;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				$string = $Syed;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5)+15;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


			    // Boy and Girl
			    $string = $Girl;			    
			    $angle = 0;
			    $x = $xx+($i*14.5)+15;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Boy;			    
			    $angle = 0;
			    $x = $xx+$x_inner_gender+($i*14.5)+15;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
    			  			

			    // Total Students
			    $string = $Students;			    
			    $angle = 0;
			    $x = $xx+10+($i*14.5);
			    $y = $yy + $y_inner + $y_inner - 2;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				$string = $DO;			    
			    $angle = 0;
			    $x = $xx+95+($i*14.5);
			    $y = $yy + $y_inner + $y_inner - 2;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				//Students
			    $string = $LA;			    
			    $angle = 0;
			    $x = $xx+10+($i*14.5);
			    $y = $yy + $y_inner + $y_inner + 27;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				$string = $LI;			    
			    $angle = 0;
			    $x = $xx+95+($i*14.5);
			    $y = $yy + $y_inner + $y_inner + 27;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			}
		}



	    /**************************************************************
		// Call Grade-Section
		// Num of (Jinnah, Iqbal, Syed) and (Boys, Girls)
		//*************************************************************/
	    $i=0;
	     $fontSize = 18;
		foreach ($data['strength_report'] as $strength_report) {	    			
			$GradeName = $strength_report['grade_name'];
			$SectionName = $strength_report['section_name'];
			$Jinnah = $strength_report['students'];
			$Iqbal = $strength_report['present'];
			$Syed = $strength_report['students'] - $strength_report['present'];
			$Girl = $strength_report['no_card'];
			$Boy = $strength_report['late'];
			$Students = "2.5";	
			$DO = "2.5";	
			$LA = "2.5";	
			$LI= "2.5";		
			

			if ($i >= 10){
				$i = 0;
			}

			if(in_array($SectionName, $sectionNames)){
				while($SectionName != $sectionNames[$i]){
				    $i++;
				    if ($i >= 10){
	    				$i = 0;
	    			}
	    		}
			}	

			if ($i >= 10){
				$i = 0;
			}

			// Pre-Nursery			
			if($strength_report['grade_name'] == 'PN'){				
				$xx = 895 + ($i*168);
				$yy = 146;

				$y_inner = 32;
				$x_inner_house = 56;
				$x_inner_gender = 65;
				$x_inner_score = 0;

				// Jinnah, Iqbal, Syed
				$string = $Jinnah;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Iqbal;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*14.5)+2;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				$string = $Syed;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5)+9;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);    			


			    // Boy and Girl
			    $string = $Girl;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy + $y_inner-7;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  				

			    $string = $Boy;			    
			    $angle = 0;
			    $x = $xx+$x_inner_gender+($i*14.5)+35;
			    $y = $yy + $y_inner -7;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
    			  			

			    // Total Students
			    $string = $Students;			    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) - 8;
			    $y = $yy + $y_inner + $y_inner - 10;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  
				
				 $string = $DO;			    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) + 85;
			    $y = $yy + $y_inner + $y_inner - 10;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				// Total Students
			    $string = $LA;			    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) - 8;
			    $y = $yy + $y_inner + $y_inner + 18;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  
				
				 $string = $LI;				    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) + 85;
			    $y = $yy + $y_inner + $y_inner +18;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);    			
			}else // Nursery			
			if($strength_report['grade_name'] == 'N'){
				$xx = 895 + ($i*169);

				$yy = 283;
				$y_inner = 32;
				$x_inner_house = 56;
				$x_inner_gender = 65;
				$x_inner_score = 0;

				// Jinnah, Iqbal, Syed
				$string = $Jinnah;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Iqbal;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*14.5)+2;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				$string = $Syed;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5)+9;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);    			


			    // Boy and Girl
			    $string = $Girl;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy + $y_inner-7;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  				

			    $string = $Boy;			    
			    $angle = 0;
			    $x = $xx+$x_inner_gender+($i*14.5)+35;
			    $y = $yy + $y_inner -7;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
    			  			

			    // Total Students
			    $string = $Students;			    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) - 8;
			    $y = $yy + $y_inner + $y_inner - 10;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  
				
				 $string = $DO;			    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) + 85;
			    $y = $yy + $y_inner + $y_inner - 10;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				// Total Students
			    $string = $LA;			    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) - 8;
			    $y = $yy + $y_inner + $y_inner + 18;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  
				
				 $string = $LI;				    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) + 85;
			    $y = $yy + $y_inner + $y_inner +18;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);    			
			}else // KG			
			if($strength_report['grade_name'] == 'KG'){
				$xx = 895 + ($i*169);

				$yy = 420;
				$y_inner = 32;
				$x_inner_house = 56;
				$x_inner_gender = 65;
				$x_inner_score = 0;

				// Jinnah, Iqbal, Syed
				$string = $Jinnah;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Iqbal;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*14.5)+2;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				$string = $Syed;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5)+9;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);    			


			    // Boy and Girl
			    $string = $Girl;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy + $y_inner-7;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  				

			    $string = $Boy;			    
			    $angle = 0;
			    $x = $xx+$x_inner_gender+($i*14.5)+35;
			    $y = $yy + $y_inner -7;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
    			  			

			    // Total Students
			    $string = $Students;			    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) - 8;
			    $y = $yy + $y_inner + $y_inner - 10;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  
				
				 $string = $DO;			    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) + 85;
			    $y = $yy + $y_inner + $y_inner - 10;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				// Total Students
			    $string = $LA;			    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) - 8;
			    $y = $yy + $y_inner + $y_inner + 18;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  
				
				 $string = $LI;				    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) + 85;
			    $y = $yy + $y_inner + $y_inner +18;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);     			
			}else // I			
			if($strength_report['grade_name'] == 'I'){
				$xx = 895 + ($i*169);

				$yy = 612;
				$y_inner = 32;
				$x_inner_house = 56;
				$x_inner_gender = 65;
				$x_inner_score = 0;

				// Jinnah, Iqbal, Syed
				$string = $Jinnah;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Iqbal;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*14.5)+2;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				$string = $Syed;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5)+9;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);    			


			    // Boy and Girl
			    $string = $Girl;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy + $y_inner-7;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  				

			    $string = $Boy;			    
			    $angle = 0;
			    $x = $xx+$x_inner_gender+($i*14.5)+35;
			    $y = $yy + $y_inner -7;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
    			  			

			    // Total Students
			    $string = $Students;			    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) - 8;
			    $y = $yy + $y_inner + $y_inner - 10;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  
				
				 $string = $DO;			    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) + 85;
			    $y = $yy + $y_inner + $y_inner - 10;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				// Total Students
			    $string = $LA;			    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) - 8;
			    $y = $yy + $y_inner + $y_inner + 18;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  
				
				 $string = $LI;				    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) + 85;
			    $y = $yy + $y_inner + $y_inner +18;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);     			
			}else // II
			if($strength_report['grade_name'] == 'II'){
				$xx = 895 + ($i*169);

				$yy = 750;
				$y_inner = 32;
				$x_inner_house = 56;
				$x_inner_gender = 65;
				$x_inner_score = 0;

				// Jinnah, Iqbal, Syed
				$string = $Jinnah;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Iqbal;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*14.5)+2;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				$string = $Syed;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5)+9;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);    			


			    // Boy and Girl
			    $string = $Girl;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy + $y_inner-7;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  				

			    $string = $Boy;			    
			    $angle = 0;
			    $x = $xx+$x_inner_gender+($i*14.5)+35;
			    $y = $yy + $y_inner -7;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
    			  			

			    // Total Students
			    $string = $Students;			    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) - 8;
			    $y = $yy + $y_inner + $y_inner - 10;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  
				
				 $string = $DO;			    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) + 85;
			    $y = $yy + $y_inner + $y_inner - 10;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				// Total Students
			    $string = $LA;			    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) - 8;
			    $y = $yy + $y_inner + $y_inner + 18;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  
				
				 $string = $LI;				    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) + 85;
			    $y = $yy + $y_inner + $y_inner +18;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);     			
			}else // III
			if($strength_report['grade_name'] == 'III'){
				$xx = 895 + ($i*169);

				$yy = 888;
				$y_inner = 32;
				$x_inner_house = 56;
				$x_inner_gender = 65;
				$x_inner_score = 0;

				// Jinnah, Iqbal, Syed
				$string = $Jinnah;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Iqbal;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*14.5)+2;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				$string = $Syed;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5)+9;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);    			


			    // Boy and Girl
			    $string = $Girl;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy + $y_inner-7;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  				

			    $string = $Boy;			    
			    $angle = 0;
			    $x = $xx+$x_inner_gender+($i*14.5)+35;
			    $y = $yy + $y_inner -7;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
    			  			

			    // Total Students
			    $string = $Students;			    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) - 8;
			    $y = $yy + $y_inner + $y_inner - 10;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  
				
				 $string = $DO;			    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) + 85;
			    $y = $yy + $y_inner + $y_inner - 10;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				// Total Students
			    $string = $LA;			    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) - 8;
			    $y = $yy + $y_inner + $y_inner + 18;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  
				
				 $string = $LI;				    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) + 85;
			    $y = $yy + $y_inner + $y_inner +18;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);    			
			}else // IV
			if($strength_report['grade_name'] == 'IV'){
				$xx = 895 + ($i*169);

				$yy = 1026;
				$y_inner = 32;
				$x_inner_house = 56;
				$x_inner_gender = 65;
				$x_inner_score = 0;

				// Jinnah, Iqbal, Syed
				$string = $Jinnah;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Iqbal;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*14.5)+2;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				$string = $Syed;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5)+9;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);    			


			    // Boy and Girl
			    $string = $Girl;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy + $y_inner-7;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  				

			    $string = $Boy;			    
			    $angle = 0;
			    $x = $xx+$x_inner_gender+($i*14.5)+35;
			    $y = $yy + $y_inner -7;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
    			  			

			    // Total Students
			    $string = $Students;			    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) - 8;
			    $y = $yy + $y_inner + $y_inner - 10;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  
				
				 $string = $DO;			    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) + 85;
			    $y = $yy + $y_inner + $y_inner - 10;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				// Total Students
			    $string = $LA;			    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) - 8;
			    $y = $yy + $y_inner + $y_inner + 18;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  
				
				 $string = $LI;				    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) + 85;
			    $y = $yy + $y_inner + $y_inner +18;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);     			
			}else // V
			if($strength_report['grade_name'] == 'V'){
				$xx = 895 + ($i*169);

				$yy = 1162;
				$y_inner = 32;
				$x_inner_house = 56;
				$x_inner_gender = 65;
				$x_inner_score = 0;

				// Jinnah, Iqbal, Syed
				$string = $Jinnah;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Iqbal;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*14.5)+2;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				$string = $Syed;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5)+9;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);    			


			    // Boy and Girl
			    $string = $Girl;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy + $y_inner-7;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  				

			    $string = $Boy;			    
			    $angle = 0;
			    $x = $xx+$x_inner_gender+($i*14.5)+35;
			    $y = $yy + $y_inner -7;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
    			  			

			    // Total Students
			    $string = $Students;			    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) - 8;
			    $y = $yy + $y_inner + $y_inner - 10;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  
				
				 $string = $DO;			    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) + 85;
			    $y = $yy + $y_inner + $y_inner - 10;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				// Total Students
			    $string = $LA;			    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) - 8;
			    $y = $yy + $y_inner + $y_inner + 18;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  
				
				 $string = $LI;				    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) + 85;
			    $y = $yy + $y_inner + $y_inner +18;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);     			
			}else // VI
			if($strength_report['grade_name'] == 'VI'){
				$xx = 895 + ($i*169);

				$yy = 1300;
				$y_inner = 32;
				$x_inner_house = 56;
				$x_inner_gender = 65;
				$x_inner_score = 0;

				// Jinnah, Iqbal, Syed
				$string = $Jinnah;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Iqbal;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*14.5)+2;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				$string = $Syed;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5)+9;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);    			


			    // Boy and Girl
			    $string = $Girl;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy + $y_inner-7;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  				

			    $string = $Boy;			    
			    $angle = 0;
			    $x = $xx+$x_inner_gender+($i*14.5)+35;
			    $y = $yy + $y_inner -7;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
    			  			

			    // Total Students
			    $string = $Students;			    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) - 8;
			    $y = $yy + $y_inner + $y_inner - 10;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  
				
				 $string = $DO;			    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) + 85;
			    $y = $yy + $y_inner + $y_inner - 10;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				// Total Students
			    $string = $LA;			    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) - 8;
			    $y = $yy + $y_inner + $y_inner + 18;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  
				
				 $string = $LI;				    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) + 85;
			    $y = $yy + $y_inner + $y_inner +18;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);     			
			}else // VII
			if($strength_report['grade_name'] == 'VII'){
				$xx = 895 + ($i*169);

				$yy = 1435;
				$y_inner = 32;
				$x_inner_house = 56;
				$x_inner_gender = 65;
				$x_inner_score = 0;

				// Jinnah, Iqbal, Syed
				$string = $Jinnah;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Iqbal;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*14.5)+2;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				$string = $Syed;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5)+9;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);    			


			    // Boy and Girl
			    $string = $Girl;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy + $y_inner-7;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  				

			    $string = $Boy;			    
			    $angle = 0;
			    $x = $xx+$x_inner_gender+($i*14.5)+35;
			    $y = $yy + $y_inner -7;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
    			  			

			    // Total Students
			    $string = $Students;			    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) - 8;
			    $y = $yy + $y_inner + $y_inner - 10;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  
				
				 $string = $DO;			    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) + 85;
			    $y = $yy + $y_inner + $y_inner - 10;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				// Total Students
			    $string = $LA;			    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) - 8;
			    $y = $yy + $y_inner + $y_inner + 18;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  
				
				 $string = $LI;				    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) + 85;
			    $y = $yy + $y_inner + $y_inner +18;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);      			
			}else // VIII
			if($strength_report['grade_name'] == 'VIII'){
				$xx = 895 + ($i*169);

				$yy = 1572;
				$y_inner = 32;
				$x_inner_house = 56;
				$x_inner_gender = 65;
				$x_inner_score = 0;

				// Jinnah, Iqbal, Syed
				$string = $Jinnah;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Iqbal;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*14.5)+2;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				$string = $Syed;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5)+9;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);    			


			    // Boy and Girl
			    $string = $Girl;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy + $y_inner-7;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  				

			    $string = $Boy;			    
			    $angle = 0;
			    $x = $xx+$x_inner_gender+($i*14.5)+35;
			    $y = $yy + $y_inner -7;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
    			  			

			    // Total Students
			    $string = $Students;			    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) - 8;
			    $y = $yy + $y_inner + $y_inner - 10;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  
				
				 $string = $DO;			    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) + 85;
			    $y = $yy + $y_inner + $y_inner - 10;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				// Total Students
			    $string = $LA;			    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) - 8;
			    $y = $yy + $y_inner + $y_inner + 18;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  
				
				 $string = $LI;				    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) + 85;
			    $y = $yy + $y_inner + $y_inner +18;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);     			
			}else // IX
			if($strength_report['grade_name'] == 'IX'){
				$xx = 895 + ($i*169);

				$yy = 1710;
				$y_inner = 32;
				$x_inner_house = 56;
				$x_inner_gender = 65;
				$x_inner_score = 0;

				// Jinnah, Iqbal, Syed
				$string = $Jinnah;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Iqbal;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*14.5)+2;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				$string = $Syed;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5)+9;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);    			


			    // Boy and Girl
			    $string = $Girl;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy + $y_inner-7;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  				

			    $string = $Boy;			    
			    $angle = 0;
			    $x = $xx+$x_inner_gender+($i*14.5)+35;
			    $y = $yy + $y_inner -7;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
    			  			

			    // Total Students
			    $string = $Students;			    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) - 8;
			    $y = $yy + $y_inner + $y_inner - 10;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  
				
				 $string = $DO;			    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) + 85;
			    $y = $yy + $y_inner + $y_inner - 10;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				// Total Students
			    $string = $LA;			    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) - 8;
			    $y = $yy + $y_inner + $y_inner + 18;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  
				
				 $string = $LI;				    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) + 85;
			    $y = $yy + $y_inner + $y_inner +18;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);     			
			}else // X
			if($strength_report['grade_name'] == 'X'){
				$xx = 895 + ($i*169);

				$yy = 1847;
				$y_inner = 32;
				$x_inner_house = 56;
				$x_inner_gender = 65;
				$x_inner_score = 0;

				// Jinnah, Iqbal, Syed
				$string = $Jinnah;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Iqbal;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*14.5)+2;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				$string = $Syed;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5)+9;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);    			


			    // Boy and Girl
			    $string = $Girl;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy + $y_inner-7;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  				

			    $string = $Boy;			    
			    $angle = 0;
			    $x = $xx+$x_inner_gender+($i*14.5)+35;
			    $y = $yy + $y_inner -7;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
    			  			

			    // Total Students
			    $string = $Students;			    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) - 8;
			    $y = $yy + $y_inner + $y_inner - 10;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  
				
				 $string = $DO;			    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) + 85;
			    $y = $yy + $y_inner + $y_inner - 10;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				// Total Students
			    $string = $LA;			    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) - 8;
			    $y = $yy + $y_inner + $y_inner + 18;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  
				
				 $string = $LI;				    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) + 85;
			    $y = $yy + $y_inner + $y_inner +18;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);     			
			}else // XI
			if($strength_report['grade_name'] == 'XI'){
				$xx = 895 + ($i*169);

				$yy = 1985;
				$y_inner = 32;
				$x_inner_house = 56;
				$x_inner_gender = 65;
				$x_inner_score = 0;

				// Jinnah, Iqbal, Syed
				$string = $Jinnah;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Iqbal;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*14.5)+2;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				$string = $Syed;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5)+9;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);    			


			    // Boy and Girl
			    $string = $Girl;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy + $y_inner-7;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  				

			    $string = $Boy;			    
			    $angle = 0;
			    $x = $xx+$x_inner_gender+($i*14.5)+35;
			    $y = $yy + $y_inner -7;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
    			  			

			    // Total Students
			    $string = $Students;			    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) - 8;
			    $y = $yy + $y_inner + $y_inner - 10;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  
				
				 $string = $DO;			    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) + 85;
			    $y = $yy + $y_inner + $y_inner - 10;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				// Total Students
			    $string = $LA;			    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) - 8;
			    $y = $yy + $y_inner + $y_inner + 18;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  
				
				 $string = $LI;				    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) + 85;
			    $y = $yy + $y_inner + $y_inner +18;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);      			
			}else // A1
			if($strength_report['grade_name'] == 'A1'){
				$xx = 895 + ($i*169);

				$yy = 2123;
				$y_inner = 32;
				$x_inner_house = 56;
				$x_inner_gender = 65;
				$x_inner_score = 0;

				// Jinnah, Iqbal, Syed
				$string = $Jinnah;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Iqbal;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*14.5)+2;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				$string = $Syed;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5)+9;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);    			


			    // Boy and Girl
			    $string = $Girl;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy + $y_inner-7;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  				

			    $string = $Boy;			    
			    $angle = 0;
			    $x = $xx+$x_inner_gender+($i*14.5)+35;
			    $y = $yy + $y_inner -7;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
    			  			

			    // Total Students
			    $string = $Students;			    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) - 8;
			    $y = $yy + $y_inner + $y_inner - 10;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  
				
				 $string = $DO;			    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) + 85;
			    $y = $yy + $y_inner + $y_inner - 10;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				// Total Students
			    $string = $LA;			    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) - 8;
			    $y = $yy + $y_inner + $y_inner + 18;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  
				
				 $string = $LI;				    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) + 85;
			    $y = $yy + $y_inner + $y_inner +18;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);     			
			}else // A2
			if($strength_report['grade_name'] == 'A2'){
				$xx = 895 + ($i*169);

				$yy = 2260;
				$y_inner = 32;
				$x_inner_house = 56;
				$x_inner_gender = 65;
				$x_inner_score = 0;

				// Jinnah, Iqbal, Syed
				$string = $Jinnah;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Iqbal;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*14.5)+2;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				$string = $Syed;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5)+9;
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);    			


			    // Boy and Girl
			    $string = $Girl;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy + $y_inner-7;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  				

			    $string = $Boy;			    
			    $angle = 0;
			    $x = $xx+$x_inner_gender+($i*14.5)+35;
			    $y = $yy + $y_inner -7;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
    			  			

			    // Total Students
			    $string = $Students;			    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) - 8;
			    $y = $yy + $y_inner + $y_inner - 10;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  
				
				 $string = $DO;			    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) + 85;
			    $y = $yy + $y_inner + $y_inner - 10;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				// Total Students
			    $string = $LA;			    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) - 8;
			    $y = $yy + $y_inner + $y_inner + 18;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  
				
				 $string = $LI;				    
			    $angle = 0;
			    $x = $xx+$x_inner_score+($i*14.5) + 85;
			    $y = $yy + $y_inner + $y_inner +18;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);      			
			}
			$i++;
		}
	    // Send Image to Browser
		imagejpeg($image);
		// Clear Memory
		imagedestroy($image);
	}


	public function printForm()
	{
		$this->getPDFNow();
	}


	public function getPDFNow()
	{
		$this->load->model('school_wide_report/student_delta_summary_model');
		if(count($_POST))
		{
			$dateRange = $this->input->post('e1');
			$dateRange = json_decode($dateRange, true);
			$this->dateRangeFrom = $dateRange["start"];
			$this->dateRangeTo = $dateRange["end"];
			
			$data['strength_report'] = $this->student_delta_summary_model->getStudentGradeSectionSummary_Date($this->dateRangeFrom, $this->dateRangeTo);		
			$data['grade_strength_report'] = $this->student_delta_summary_model->getStudentGradeSummary_Date($this->dateRangeFrom, $this->dateRangeTo);
			$data['wing_strength_report'] = $this->student_delta_summary_model->getStudentWingSummary_Date($this->dateRangeFrom, $this->dateRangeTo);
			$data['campus_strength_report'] = $this->student_delta_summary_model->getStudentCampusSummary_Date($this->dateRangeFrom, $this->dateRangeTo);
		}else{
			$this->dateRangeFrom = $this->data['attendance_session_date'];
			$this->dateRangeTo = date('Y-M-d');
			$data['strength_report'] = $this->student_delta_summary_model->getStudentGradeSectionSummary_Date($this->dateRangeFrom, $this->dateRangeTo);		
			$data['grade_strength_report'] = $this->student_delta_summary_model->getStudentGradeSummary_Date($this->dateRangeFrom, $this->dateRangeTo);
			$data['wing_strength_report'] = $this->student_delta_summary_model->getStudentWingSummary_Date($this->dateRangeFrom, $this->dateRangeTo);
			$data['campus_strength_report'] = $this->student_delta_summary_model->getStudentCampusSummary_Date($this->dateRangeFrom, $this->dateRangeTo);
		}
		


		$name = $data['strength_report'][0]['grade_name'];

		$sectionNames = array('G', 'S', 'C', 'P', 'R', 'W', 'E', 'L', 'K', 'M');
		$FontSize_data = 6;
		$SectionName = "";
		$GradeName = "";		
		$Students = "";		
		$Jinnah = "";		
		$Iqbal = "";
		$Syed = "";
		$Girl = "";
		$Boy = "";
		$y = 0;
			


		// Overall Font Size
		$font_size = 10;
		$font_name = 'Helvetica';
		$gender_mark_size = 26;
		$now_date = date('l F d, Y', strtotime($this->dateRangeFrom)) . ' TO ' . date('l F d, Y', strtotime($this->dateRangeTo));

		require_once('components/pdf/fpdf/fpdf.php');
		require_once('components/pdf/fpdi/fpdi.php');

		
		// initiate FPDI
		$pdf = new FPDI();

		// get the page count
		$pageCount = $pdf->setSourceFile('components/pdf/school/school_wide_report/student_delta_summary.pdf');
		// iterate through all pages
		for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
		    // import a page
		    $templateId = $pdf->importPage($pageNo);
		    // get the size of the imported page
		    $size = $pdf->getTemplateSize($templateId);

		    // create a page (landscape or portrait depending on the imported page size)
		    if ($size['w'] > $size['h']) {
		        $pdf->AddPage('C', array($size['w'], $size['h']));
		    } else {
		        $pdf->AddPage('P', array($size['w'], $size['h']));
		    }		    

		    // use the imported page
	    	$pdf->useTemplate($templateId);

	    	if ($templateId == 1){

	    		// border on
	    		$bo = 0;
	    		$pdf->SetMargins(0,0,0);
	    		$pdf->SetAutoPageBreak(1,1);

	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',12);
			    $pdf->SetFillColor(255,255,255);
			    $pdf->SetDrawColor(255,0,0);
			    $pdf->SetXY(93,9);
			    $pdf->Cell(190, 6, $now_date, $bo, 0, 'C', 0);

			    $pdf->SetTextColor(255,255,255);
			    $pdf->SetFont($font_name,'',7);
			    $pdf->SetFillColor(0,0,0);
			    $pdf->SetXY(237, 201);
			    $pdf->Cell(55, 3, date('D-d-M-Y H:i') . ' (' . ucwords($this->data['staff_registered_data'][0]->abridged_name) . ')', 0, 0, 'C', true);
			    $pdf->SetTextColor(0,0,0);

			    

			    /**************************************************************
				* Call School
				* Num of (Total, Present, Absent, NoCard, Late, LRA, Score1, Score10, Inactive) 
				/*************************************************************/
				$HouseChange = $data['campus_strength_report'][0]['req_house'] + $data['campus_strength_report'][1]['req_house'];
				$SectionChange = $data['campus_strength_report'][0]['req_section'] + $data['campus_strength_report'][1]['req_section'];
				$TagChange = $data['campus_strength_report'][0]['req_std_card'] + $data['campus_strength_report'][1]['req_std_card'];
				$AdmissionIn = $data['campus_strength_report'][0]['req_admission'] + $data['campus_strength_report'][1]['req_admission'];
				$WithdrawalOut = $data['campus_strength_report'][0]['req_withdrawal'] + $data['campus_strength_report'][1]['req_withdrawal'];
				$DetentionIn = $data['campus_strength_report'][0]['detain'] + $data['campus_strength_report'][1]['detain'];
				$DententionOut = $data['campus_strength_report'][0]['detain'] + $data['campus_strength_report'][1]['detain'];
				$InActiveAdd = $data['campus_strength_report'][0]['inative_add'] + $data['campus_strength_report'][1]['inative_add'];
				$InActiveLess = $data['campus_strength_report'][0]['inative_less'] + $data['campus_strength_report'][1]['inative_less'];


				if($HouseChange == 0){$HouseChange = "";}
				if($SectionChange == 0){$SectionChange = "";}
				if($TagChange == 0){$TagChange = "";}
				if($AdmissionIn == 0){$AdmissionIn = "";}
				if($WithdrawalOut == 0){$WithdrawalOut = "";}
				if($DetentionIn == 0){$DetentionIn = "";}
				if($DententionOut == 0){$DententionOut = "";}
				if($InActiveAdd == 0){$InActiveAdd = "";}
				if($InActiveLess == 0){$InActiveLess = "";}

				$X = 11.6;
				$Y = 67.8;
				$CX = 7.3;
				$CY = 5;
				$Gap = 1.8;
				// HouseChange, SectionChange, TagChange
				$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',6.5);
			    $pdf->SetFillColor(255,255,255);
			    $pdf->SetDrawColor(255,0,0);
			    $pdf->SetXY($X, $Y);
			    $pdf->Cell($CX, $CY, $HouseChange, $bo, 0, 'C', 0);
			    
    			$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',6.5);
			    $pdf->SetFillColor(255,255,255);
			    $pdf->SetDrawColor(255,0,0);
			    $pdf->SetXY($X+$CX,$Y);
			    $pdf->Cell($CX, $CY, $SectionChange, $bo, 0, 'C', 0);
			    
    			$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',6.5);
			    $pdf->SetFillColor(255,255,255);
			    $pdf->SetDrawColor(255,0,0);
			    $pdf->SetXY($X+$CX+$CX,$Y);
			    $pdf->Cell($CX, $CY, $TagChange, $bo, 0, 'C', 0);

			    // AdmissionIn, WithdrawalOut
				$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',7);
			    $pdf->SetFillColor(255,255,255);
			    $pdf->SetDrawColor(255,0,0);
			    $pdf->SetXY($X,$Y+$CY+$Gap);
			    $pdf->Cell($CX+($CX/2), $CY, $AdmissionIn, $bo, 0, 'C', 0);

    			$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',7);
			    $pdf->SetFillColor(255,255,255);
			    $pdf->SetDrawColor(255,0,0);
			    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY+$Gap);
			    $pdf->Cell($CX+($CX/2), $CY, $WithdrawalOut, $bo, 0, 'C', 0);

			    // DententionIn, DententionOut
    			$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',7);
			    $pdf->SetFillColor(255,255,255);
			    $pdf->SetDrawColor(255,0,0);
			    $pdf->SetXY($X,$Y+$CY+$CY+($Gap*2));
			    $pdf->Cell($CX+($CX/2), $CY, $DetentionIn, $bo, 0, 'C', 0);
			    
				$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',7);
			    $pdf->SetFillColor(255,255,255);
			    $pdf->SetDrawColor(255,0,0);
			    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY+$CY+($Gap*2));
			    $pdf->Cell($CX+($CX/2), $CY, $DententionOut, $bo, 0, 'C', 0);

			    // InActiveAdd, InActiveLess
    			$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',7);
			    $pdf->SetFillColor(255,255,255);
			    $pdf->SetDrawColor(255,0,0);
			    $pdf->SetXY($X,$Y+$CY+$CY+$CY+($Gap*3));
			    $pdf->Cell($CX+($CX/2), $CY, $InActiveAdd, $bo, 0, 'C', 0);

			    
    			$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',7);
			    $pdf->SetFillColor(255,255,255);
			    $pdf->SetDrawColor(255,0,0);
			    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY+$CY+$CY+($Gap*3));
			    $pdf->Cell($CX+($CX/2), $CY, $InActiveLess, $bo, 0, 'C', 0);

			    
				/**************************************************************
				* Call Campus
				* Num of (Total, Present, Absent, NoCard, Late, LRA, Score1, Score10, Inactive) 
				/*************************************************************/
				$i=0;
				foreach ($data['campus_strength_report'] as $campus_strength_report) {
					$HouseChange = $campus_strength_report['req_house'];
					$SectionChange = $campus_strength_report['req_section'];
					$TagChange = $campus_strength_report['req_std_card'];
					$AdmissionIn = $campus_strength_report['req_admission'];
					$WithdrawalOut = $campus_strength_report['req_withdrawal'];
					$DetentionIn = $campus_strength_report['detain'];
					$DententionOut = $campus_strength_report['detain'];
					$InActiveAdd = $campus_strength_report['inative_add'];
					$InActiveLess = $campus_strength_report['inative_less'];


					if($HouseChange == 0){$HouseChange = "";}
					if($SectionChange == 0){$SectionChange = "";}
					if($TagChange == 0){$TagChange = "";}
					if($AdmissionIn == 0){$AdmissionIn = "";}
					if($WithdrawalOut == 0){$WithdrawalOut = "";}
					if($DetentionIn == 0){$DetentionIn = "";}
					if($DententionOut == 0){$DententionOut = "";}
					if($InActiveAdd == 0){$InActiveAdd = "";}
					if($InActiveLess == 0){$InActiveLess = "";}
	    					

	    			if($CampusName = 'North Campus'){
	    				if($campus_strength_report['campus_name'] == 'North Campus'){
	    					$X = 18.9;
							$Y = 34.8;
							$CX = 7.3;
							$CY = 4.5;
							// HouseChange, SectionChange, TagChange
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6.5);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X, $Y);
						    $pdf->Cell($CX, $CY, $HouseChange, $bo, 0, 'C', 0);
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6.5);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y);
						    $pdf->Cell($CX, $CY, $SectionChange, $bo, 0, 'C', 0);
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6.5);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y);
						    $pdf->Cell($CX, $CY, $TagChange, $bo, 0, 'C', 0);

						    // AdmissionIn, WithdrawalOut
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',7);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $AdmissionIn, $bo, 0, 'C', 0);

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',7);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $WithdrawalOut, $bo, 0, 'C', 0);

						    // DententionIn, DententionOut
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',7);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $DetentionIn, $bo, 0, 'C', 0);
						    
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',7);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $DententionOut, $bo, 0, 'C', 0);

						    // InActiveAdd, InActiveLess
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',7);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $InActiveAdd, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',7);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $InActiveLess, $bo, 0, 'C', 0);						    
	    				}
	    			}
	    			if($CampusName = 'South Campus'){
	    				if($campus_strength_report['campus_name'] == 'South Campus'){
	    					$X = 18.9;
							$Y = 104.2;
							$CX = 7.3;
							$CY = 4.5;
							// HouseChange, SectionChange, TagChange
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6.5);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X, $Y);
						    $pdf->Cell($CX, $CY, $HouseChange, $bo, 0, 'C', 0);
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6.5);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y);
						    $pdf->Cell($CX, $CY, $SectionChange, $bo, 0, 'C', 0);
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6.5);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y);
						    $pdf->Cell($CX, $CY, $TagChange, $bo, 0, 'C', 0);

						    // AdmissionIn, WithdrawalOut
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',7);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $AdmissionIn, $bo, 0, 'C', 0);

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',7);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $WithdrawalOut, $bo, 0, 'C', 0);

						    // DententionIn, DententionOut
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',7);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $DetentionIn, $bo, 0, 'C', 0);
						    
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',7);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $DententionOut, $bo, 0, 'C', 0);

						    // InActiveAdd, InActiveLess
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',7);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $InActiveAdd, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',7);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $InActiveLess, $bo, 0, 'C', 0);
	    				}
	    			}

	    		}

				/**************************************************************
				* Call Wing
				* Num of (Total, Present, Absent, NoCard, Late, LRA, Score1, Score10, Inactive)
				/*************************************************************/
				$i=0;
				foreach ($data['wing_strength_report'] as $wing_strength_report) {
					$WingName = $wing_strength_report['wing_name'];					
					$HouseChange = $wing_strength_report['req_house'];
					$SectionChange = $wing_strength_report['req_section'];
					$TagChange = $wing_strength_report['req_std_card'];
					$AdmissionIn = $wing_strength_report['req_admission'];
					$WithdrawalOut = $wing_strength_report['req_withdrawal'];
					$DetentionIn = $wing_strength_report['detain'];
					$DententionOut = $wing_strength_report['detain'];
					$InActiveAdd = $wing_strength_report['inative_add'];
					$InActiveLess = $wing_strength_report['inative_less'];

					if($HouseChange == 0){$HouseChange = "";}
					if($SectionChange == 0){$SectionChange = "";}
					if($TagChange == 0){$TagChange = "";}
					if($AdmissionIn == 0){$AdmissionIn = "";}
					if($WithdrawalOut == 0){$WithdrawalOut = "";}
					if($DetentionIn == 0){$DetentionIn = "";}
					if($DententionOut == 0){$DententionOut = "";}
					if($InActiveAdd == 0){$InActiveAdd = "";}
					if($InActiveLess == 0){$InActiveLess = "";}

	    			if($WingName = 'Pre-Primary'){
	    				if($wing_strength_report['wing_name'] == 'Pre-Primary'){
	    					$X = 46.5;
							$Y = 30.4;
							$CX = 6.2;
							$CY = 2.25;
							// HouseChange, SectionChange, TagChange
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X, $Y);
						    $pdf->Cell($CX, $CY, $HouseChange, $bo, 0, 'C', 0);
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y);
						    $pdf->Cell($CX, $CY, $SectionChange, $bo, 0, 'C', 0);
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y);
						    $pdf->Cell($CX, $CY, $TagChange, $bo, 0, 'C', 0);

						    // AdmissionIn, WithdrawalOut
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $AdmissionIn, $bo, 0, 'C', 0);

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $WithdrawalOut, $bo, 0, 'C', 0);

						    // DententionIn, DententionOut
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $DetentionIn, $bo, 0, 'C', 0);
						    
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $DententionOut, $bo, 0, 'C', 0);

						    // InActiveAdd, InActiveLess
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $InActiveAdd, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $InActiveLess, $bo, 0, 'C', 0);
	    				}
	    			}
	    			if($WingName = 'Elementry'){
	    				if($wing_strength_report['wing_name'] == 'Elementry'){
	    					$X = 46.5;
							$Y = 61.8;
							$CX = 6.2;
							$CY = 2.25;
							// HouseChange, SectionChange, TagChange
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X, $Y);
						    $pdf->Cell($CX, $CY, $HouseChange, $bo, 0, 'C', 0);
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y);
						    $pdf->Cell($CX, $CY, $SectionChange, $bo, 0, 'C', 0);
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y);
						    $pdf->Cell($CX, $CY, $TagChange, $bo, 0, 'C', 0);

						    // AdmissionIn, WithdrawalOut
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $AdmissionIn, $bo, 0, 'C', 0);

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $WithdrawalOut, $bo, 0, 'C', 0);

						    // DententionIn, DententionOut
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $DetentionIn, $bo, 0, 'C', 0);
						    
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $DententionOut, $bo, 0, 'C', 0);

						    // InActiveAdd, InActiveLess
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $InActiveAdd, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $InActiveLess, $bo, 0, 'C', 0);
	    				}
	    			}
	    			if($WingName = 'Junior'){
	    				if($wing_strength_report['wing_name'] == 'Junior'){
	    					$X = 46.5;
							$Y = 95.5;
							$CX = 6.2;
							$CY = 2.25;
							// HouseChange, SectionChange, TagChange
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X, $Y);
						    $pdf->Cell($CX, $CY, $HouseChange, $bo, 0, 'C', 0);
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y);
						    $pdf->Cell($CX, $CY, $SectionChange, $bo, 0, 'C', 0);
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y);
						    $pdf->Cell($CX, $CY, $TagChange, $bo, 0, 'C', 0);

						    // AdmissionIn, WithdrawalOut
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $AdmissionIn, $bo, 0, 'C', 0);

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $WithdrawalOut, $bo, 0, 'C', 0);

						    // DententionIn, DententionOut
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $DetentionIn, $bo, 0, 'C', 0);
						    
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $DententionOut, $bo, 0, 'C', 0);

						    // InActiveAdd, InActiveLess
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $InActiveAdd, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $InActiveLess, $bo, 0, 'C', 0);
	    				}
	    			}
	    			if($WingName = 'Middler'){
	    				if($wing_strength_report['wing_name'] == 'Middler'){
	    					$X = 46.5;
							$Y = 135.8;
							$CX = 6.2;
							$CY = 2.25;
							// HouseChange, SectionChange, TagChange
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X, $Y);
						    $pdf->Cell($CX, $CY, $HouseChange, $bo, 0, 'C', 0);
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y);
						    $pdf->Cell($CX, $CY, $SectionChange, $bo, 0, 'C', 0);
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y);
						    $pdf->Cell($CX, $CY, $TagChange, $bo, 0, 'C', 0);

						    // AdmissionIn, WithdrawalOut
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $AdmissionIn, $bo, 0, 'C', 0);

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $WithdrawalOut, $bo, 0, 'C', 0);

						    // DententionIn, DententionOut
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $DetentionIn, $bo, 0, 'C', 0);
						    
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $DententionOut, $bo, 0, 'C', 0);

						    // InActiveAdd, InActiveLess
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $InActiveAdd, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $InActiveLess, $bo, 0, 'C', 0);
	    				}
	    			}
	    			if($WingName = 'O-Level'){
	    				if($wing_strength_report['wing_name'] == 'O-Level'){
	    					$X = 46.5;
							$Y = 162.6;
							$CX = 6.2;
							$CY = 2.25;
							// HouseChange, SectionChange, TagChange
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X, $Y);
						    $pdf->Cell($CX, $CY, $HouseChange, $bo, 0, 'C', 0);
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y);
						    $pdf->Cell($CX, $CY, $SectionChange, $bo, 0, 'C', 0);
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y);
						    $pdf->Cell($CX, $CY, $TagChange, $bo, 0, 'C', 0);

						    // AdmissionIn, WithdrawalOut
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $AdmissionIn, $bo, 0, 'C', 0);

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $WithdrawalOut, $bo, 0, 'C', 0);

						    // DententionIn, DententionOut
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $DetentionIn, $bo, 0, 'C', 0);
						    
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $DententionOut, $bo, 0, 'C', 0);

						    // InActiveAdd, InActiveLess
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $InActiveAdd, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $InActiveLess, $bo, 0, 'C', 0);
	    				}
	    			}
	    			if($WingName = 'A-Level'){
	    				if($wing_strength_report['wing_name'] == 'A-Level'){
	    					$X = 46.5;
							$Y = 185;
							$CX = 6.2;
							$CY = 2.25;
							// HouseChange, SectionChange, TagChange
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X, $Y);
						    $pdf->Cell($CX, $CY, $HouseChange, $bo, 0, 'C', 0);
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y);
						    $pdf->Cell($CX, $CY, $SectionChange, $bo, 0, 'C', 0);
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y);
						    $pdf->Cell($CX, $CY, $TagChange, $bo, 0, 'C', 0);

						    // AdmissionIn, WithdrawalOut
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $AdmissionIn, $bo, 0, 'C', 0);

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $WithdrawalOut, $bo, 0, 'C', 0);

						    // DententionIn, DententionOut
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $DetentionIn, $bo, 0, 'C', 0);
						    
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $DententionOut, $bo, 0, 'C', 0);

						    // InActiveAdd, InActiveLess
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $InActiveAdd, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $InActiveLess, $bo, 0, 'C', 0);
	    				}
	    			}
	    		}

				/**************************************************************
				// Call Grade
				// Num of (Jinnah, Iqbal, Syed) and (Boys, Girls)
				//*************************************************************/
				$i=0;
				foreach ($data['grade_strength_report'] as $grade_strength_report) {
					$GradeName = $grade_strength_report['grade_name'];					
					$HouseChange = $grade_strength_report['req_house'];
					$SectionChange = $grade_strength_report['req_section'];
					$TagChange = $grade_strength_report['req_std_card'];
					$AdmissionIn = $grade_strength_report['req_admission'];
					$WithdrawalOut = $grade_strength_report['req_withdrawal'];
					$DetentionIn = $grade_strength_report['detain'];
					$DententionOut = $grade_strength_report['detain'];
					$InActiveAdd = $grade_strength_report['inative_add'];
					$InActiveLess = $grade_strength_report['inative_less'];


					if($HouseChange == 0){$HouseChange = "";}
					if($SectionChange == 0){$SectionChange = "";}
					if($TagChange == 0){$TagChange = "";}
					if($AdmissionIn == 0){$AdmissionIn = "";}
					if($WithdrawalOut == 0){$WithdrawalOut = "";}
					if($DetentionIn == 0){$DetentionIn = "";}
					if($DententionOut == 0){$DententionOut = "";}
					if($InActiveAdd == 0){$InActiveAdd = "";}
					if($InActiveLess == 0){$InActiveLess = "";}

					

	    			if($GradeName = 'PN'){
	    				if($grade_strength_report['grade_name'] == 'PN'){
	    					$X = 68.1;
							$Y = 19.2;
							$CX = 6.2;
							$CY = 2.25;
							// HouseChange, SectionChange, TagChange
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X, $Y);
						    $pdf->Cell($CX, $CY, $HouseChange, $bo, 0, 'C', 0);
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y);
						    $pdf->Cell($CX, $CY, $SectionChange, $bo, 0, 'C', 0);
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y);
						    $pdf->Cell($CX, $CY, $TagChange, $bo, 0, 'C', 0);

						    // AdmissionIn, WithdrawalOut
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $AdmissionIn, $bo, 0, 'C', 0);

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $WithdrawalOut, $bo, 0, 'C', 0);

						    // DententionIn, DententionOut
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $DetentionIn, $bo, 0, 'C', 0);
						    
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $DententionOut, $bo, 0, 'C', 0);

						    // InActiveAdd, InActiveLess
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $InActiveAdd, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $InActiveLess, $bo, 0, 'C', 0);
		    			}
					}
					if($GradeName = 'N'){
						if($grade_strength_report['grade_name'] == 'N'){
		    				$X = 68.1;
							$Y = 30.35;
							$CX = 6.2;
							$CY = 2.25;
							// HouseChange, SectionChange, TagChange
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X, $Y);
						    $pdf->Cell($CX, $CY, $HouseChange, $bo, 0, 'C', 0);
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y);
						    $pdf->Cell($CX, $CY, $SectionChange, $bo, 0, 'C', 0);
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y);
						    $pdf->Cell($CX, $CY, $TagChange, $bo, 0, 'C', 0);

						    // AdmissionIn, WithdrawalOut
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $AdmissionIn, $bo, 0, 'C', 0);

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $WithdrawalOut, $bo, 0, 'C', 0);

						    // DententionIn, DententionOut
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $DetentionIn, $bo, 0, 'C', 0);
						    
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $DententionOut, $bo, 0, 'C', 0);

						    // InActiveAdd, InActiveLess
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $InActiveAdd, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $InActiveLess, $bo, 0, 'C', 0);
						}
					}
					if($GradeName = 'KG'){
	    				if($grade_strength_report['grade_name'] == 'KG'){
			    			$X = 68.1;
							$Y = 41.55;
							$CX = 6.2;
							$CY = 2.25;
							// HouseChange, SectionChange, TagChange
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X, $Y);
						    $pdf->Cell($CX, $CY, $HouseChange, $bo, 0, 'C', 0);
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y);
						    $pdf->Cell($CX, $CY, $SectionChange, $bo, 0, 'C', 0);
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y);
						    $pdf->Cell($CX, $CY, $TagChange, $bo, 0, 'C', 0);

						    // AdmissionIn, WithdrawalOut
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $AdmissionIn, $bo, 0, 'C', 0);

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $WithdrawalOut, $bo, 0, 'C', 0);

						    // DententionIn, DententionOut
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $DetentionIn, $bo, 0, 'C', 0);
						    
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $DententionOut, $bo, 0, 'C', 0);

						    // InActiveAdd, InActiveLess
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $InActiveAdd, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $InActiveLess, $bo, 0, 'C', 0);
						}
					}
					if($GradeName = 'I'){	    				
	    				if($grade_strength_report['grade_name'] == 'I'){
	    					$X = 68.1;
							$Y = 57.3;
							$CX = 6.2;
							$CY = 2.25;
							// HouseChange, SectionChange, TagChange
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X, $Y);
						    $pdf->Cell($CX, $CY, $HouseChange, $bo, 0, 'C', 0);
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y);
						    $pdf->Cell($CX, $CY, $SectionChange, $bo, 0, 'C', 0);
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y);
						    $pdf->Cell($CX, $CY, $TagChange, $bo, 0, 'C', 0);

						    // AdmissionIn, WithdrawalOut
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $AdmissionIn, $bo, 0, 'C', 0);

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $WithdrawalOut, $bo, 0, 'C', 0);

						    // DententionIn, DententionOut
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $DetentionIn, $bo, 0, 'C', 0);
						    
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $DententionOut, $bo, 0, 'C', 0);

						    // InActiveAdd, InActiveLess
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $InActiveAdd, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $InActiveLess, $bo, 0, 'C', 0);
						}
					}
					if($GradeName = 'II'){	    				
	    				if($grade_strength_report['grade_name'] == 'II'){
	    					$X = 68.1;
							$Y = 68.5;
							$CX = 6.2;
							$CY = 2.25;
							// HouseChange, SectionChange, TagChange
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X, $Y);
						    $pdf->Cell($CX, $CY, $HouseChange, $bo, 0, 'C', 0);
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y);
						    $pdf->Cell($CX, $CY, $SectionChange, $bo, 0, 'C', 0);
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y);
						    $pdf->Cell($CX, $CY, $TagChange, $bo, 0, 'C', 0);

						    // AdmissionIn, WithdrawalOut
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $AdmissionIn, $bo, 0, 'C', 0);

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $WithdrawalOut, $bo, 0, 'C', 0);

						    // DententionIn, DententionOut
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $DetentionIn, $bo, 0, 'C', 0);
						    
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $DententionOut, $bo, 0, 'C', 0);

						    // InActiveAdd, InActiveLess
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $InActiveAdd, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $InActiveLess, $bo, 0, 'C', 0);
						}
					}
					if($GradeName = 'III'){
	    				if($grade_strength_report['grade_name'] == 'III'){
	    					$X = 68.1;
							$Y = 79.7;
							$CX = 6.2;
							$CY = 2.25;
							// HouseChange, SectionChange, TagChange
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X, $Y);
						    $pdf->Cell($CX, $CY, $HouseChange, $bo, 0, 'C', 0);
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y);
						    $pdf->Cell($CX, $CY, $SectionChange, $bo, 0, 'C', 0);
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y);
						    $pdf->Cell($CX, $CY, $TagChange, $bo, 0, 'C', 0);

						    // AdmissionIn, WithdrawalOut
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $AdmissionIn, $bo, 0, 'C', 0);

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $WithdrawalOut, $bo, 0, 'C', 0);

						    // DententionIn, DententionOut
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $DetentionIn, $bo, 0, 'C', 0);
						    
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $DententionOut, $bo, 0, 'C', 0);

						    // InActiveAdd, InActiveLess
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $InActiveAdd, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $InActiveLess, $bo, 0, 'C', 0);
						}
					}
					if($GradeName = 'IV'){
	    				if($grade_strength_report['grade_name'] == 'IV'){
	    					$X = 68.1;
							$Y = 90.9;
							$CX = 6.2;
							$CY = 2.25;
							// HouseChange, SectionChange, TagChange
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X, $Y);
						    $pdf->Cell($CX, $CY, $HouseChange, $bo, 0, 'C', 0);
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y);
						    $pdf->Cell($CX, $CY, $SectionChange, $bo, 0, 'C', 0);
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y);
						    $pdf->Cell($CX, $CY, $TagChange, $bo, 0, 'C', 0);

						    // AdmissionIn, WithdrawalOut
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $AdmissionIn, $bo, 0, 'C', 0);

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $WithdrawalOut, $bo, 0, 'C', 0);

						    // DententionIn, DententionOut
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $DetentionIn, $bo, 0, 'C', 0);
						    
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $DententionOut, $bo, 0, 'C', 0);

						    // InActiveAdd, InActiveLess
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $InActiveAdd, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $InActiveLess, $bo, 0, 'C', 0);
	    				}
	    			}
	    			if($GradeName = 'V'){
	    				if($grade_strength_report['grade_name'] == 'V'){
	    					$X = 68.1;
							$Y = 102.15;
							$CX = 6.2;
							$CY = 2.25;
							// HouseChange, SectionChange, TagChange
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X, $Y);
						    $pdf->Cell($CX, $CY, $HouseChange, $bo, 0, 'C', 0);
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y);
						    $pdf->Cell($CX, $CY, $SectionChange, $bo, 0, 'C', 0);
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y);
						    $pdf->Cell($CX, $CY, $TagChange, $bo, 0, 'C', 0);

						    // AdmissionIn, WithdrawalOut
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $AdmissionIn, $bo, 0, 'C', 0);

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $WithdrawalOut, $bo, 0, 'C', 0);

						    // DententionIn, DententionOut
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $DetentionIn, $bo, 0, 'C', 0);
						    
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $DententionOut, $bo, 0, 'C', 0);

						    // InActiveAdd, InActiveLess
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $InActiveAdd, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $InActiveLess, $bo, 0, 'C', 0);
		    			}
		    		}
		    		if($GradeName = 'VI'){
	    				if($grade_strength_report['grade_name'] == 'VI'){
	    					$X = 68.1;
							$Y = 113.4;
							$CX = 6.2;
							$CY = 2.25;
							// HouseChange, SectionChange, TagChange
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X, $Y);
						    $pdf->Cell($CX, $CY, $HouseChange, $bo, 0, 'C', 0);
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y);
						    $pdf->Cell($CX, $CY, $SectionChange, $bo, 0, 'C', 0);
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y);
						    $pdf->Cell($CX, $CY, $TagChange, $bo, 0, 'C', 0);

						    // AdmissionIn, WithdrawalOut
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $AdmissionIn, $bo, 0, 'C', 0);

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $WithdrawalOut, $bo, 0, 'C', 0);

						    // DententionIn, DententionOut
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $DetentionIn, $bo, 0, 'C', 0);
						    
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $DententionOut, $bo, 0, 'C', 0);

						    // InActiveAdd, InActiveLess
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $InActiveAdd, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $InActiveLess, $bo, 0, 'C', 0);
	    				}
	    			}
	    			if($GradeName = 'VII'){
	    				if($grade_strength_report['grade_name'] == 'VII'){
	    					$X = 68.1;
							$Y = 124.45;
							$CX = 6.2;
							$CY = 2.25;
							// HouseChange, SectionChange, TagChange
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X, $Y);
						    $pdf->Cell($CX, $CY, $HouseChange, $bo, 0, 'C', 0);
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y);
						    $pdf->Cell($CX, $CY, $SectionChange, $bo, 0, 'C', 0);
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y);
						    $pdf->Cell($CX, $CY, $TagChange, $bo, 0, 'C', 0);

						    // AdmissionIn, WithdrawalOut
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $AdmissionIn, $bo, 0, 'C', 0);

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $WithdrawalOut, $bo, 0, 'C', 0);

						    // DententionIn, DententionOut
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $DetentionIn, $bo, 0, 'C', 0);
						    
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $DententionOut, $bo, 0, 'C', 0);

						    // InActiveAdd, InActiveLess
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $InActiveAdd, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $InActiveLess, $bo, 0, 'C', 0);
	    				}
	    			}
	    			if($GradeName = 'VIII'){
	    				if($grade_strength_report['grade_name'] == 'VIII'){
	    					$X = 68.1;
							$Y = 135.7;
							$CX = 6.2;
							$CY = 2.25;
							// HouseChange, SectionChange, TagChange
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X, $Y);
						    $pdf->Cell($CX, $CY, $HouseChange, $bo, 0, 'C', 0);
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y);
						    $pdf->Cell($CX, $CY, $SectionChange, $bo, 0, 'C', 0);
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y);
						    $pdf->Cell($CX, $CY, $TagChange, $bo, 0, 'C', 0);

						    // AdmissionIn, WithdrawalOut
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $AdmissionIn, $bo, 0, 'C', 0);

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $WithdrawalOut, $bo, 0, 'C', 0);

						    // DententionIn, DententionOut
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $DetentionIn, $bo, 0, 'C', 0);
						    
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $DententionOut, $bo, 0, 'C', 0);

						    // InActiveAdd, InActiveLess
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $InActiveAdd, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $InActiveLess, $bo, 0, 'C', 0);
	    				}
	    			}
	    			if($GradeName = 'IX'){
	    				if($grade_strength_report['grade_name'] == 'IX'){
	    					$X = 68.1;
							$Y = 146.9;
							$CX = 6.2;
							$CY = 2.25;
							// HouseChange, SectionChange, TagChange
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X, $Y);
						    $pdf->Cell($CX, $CY, $HouseChange, $bo, 0, 'C', 0);
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y);
						    $pdf->Cell($CX, $CY, $SectionChange, $bo, 0, 'C', 0);
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y);
						    $pdf->Cell($CX, $CY, $TagChange, $bo, 0, 'C', 0);

						    // AdmissionIn, WithdrawalOut
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $AdmissionIn, $bo, 0, 'C', 0);

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $WithdrawalOut, $bo, 0, 'C', 0);

						    // DententionIn, DententionOut
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $DetentionIn, $bo, 0, 'C', 0);
						    
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $DententionOut, $bo, 0, 'C', 0);

						    // InActiveAdd, InActiveLess
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $InActiveAdd, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $InActiveLess, $bo, 0, 'C', 0);
	    				}
	    			}
	    			if($GradeName = 'X'){
	    				if($grade_strength_report['grade_name'] == 'X'){
	    					$X = 68.1;
							$Y = 158.15;
							$CX = 6.2;
							$CY = 2.25;
							// HouseChange, SectionChange, TagChange
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X, $Y);
						    $pdf->Cell($CX, $CY, $HouseChange, $bo, 0, 'C', 0);
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y);
						    $pdf->Cell($CX, $CY, $SectionChange, $bo, 0, 'C', 0);
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y);
						    $pdf->Cell($CX, $CY, $TagChange, $bo, 0, 'C', 0);

						    // AdmissionIn, WithdrawalOut
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $AdmissionIn, $bo, 0, 'C', 0);

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $WithdrawalOut, $bo, 0, 'C', 0);

						    // DententionIn, DententionOut
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $DetentionIn, $bo, 0, 'C', 0);
						    
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $DententionOut, $bo, 0, 'C', 0);

						    // InActiveAdd, InActiveLess
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $InActiveAdd, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $InActiveLess, $bo, 0, 'C', 0);
	    				}
	    			}
	    			if($GradeName = 'XI'){
	    				if($grade_strength_report['grade_name'] == 'XI'){
	    					$X = 68.1;
							$Y = 169.35;
							$CX = 6.2;
							$CY = 2.25;
							// HouseChange, SectionChange, TagChange
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X, $Y);
						    $pdf->Cell($CX, $CY, $HouseChange, $bo, 0, 'C', 0);
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y);
						    $pdf->Cell($CX, $CY, $SectionChange, $bo, 0, 'C', 0);
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y);
						    $pdf->Cell($CX, $CY, $TagChange, $bo, 0, 'C', 0);

						    // AdmissionIn, WithdrawalOut
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $AdmissionIn, $bo, 0, 'C', 0);

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $WithdrawalOut, $bo, 0, 'C', 0);

						    // DententionIn, DententionOut
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $DetentionIn, $bo, 0, 'C', 0);
						    
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $DententionOut, $bo, 0, 'C', 0);

						    // InActiveAdd, InActiveLess
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $InActiveAdd, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $InActiveLess, $bo, 0, 'C', 0);
	    				}
	    			}
	    			if($GradeName = 'A1'){
	    				if($grade_strength_report['grade_name'] == 'A1'){
	    					$X = 68.1;
							$Y = 180.6;
							$CX = 6.2;
							$CY = 2.25;
							// HouseChange, SectionChange, TagChange
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X, $Y);
						    $pdf->Cell($CX, $CY, $HouseChange, $bo, 0, 'C', 0);
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y);
						    $pdf->Cell($CX, $CY, $SectionChange, $bo, 0, 'C', 0);
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y);
						    $pdf->Cell($CX, $CY, $TagChange, $bo, 0, 'C', 0);

						    // AdmissionIn, WithdrawalOut
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $AdmissionIn, $bo, 0, 'C', 0);

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $WithdrawalOut, $bo, 0, 'C', 0);

						    // DententionIn, DententionOut
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $DetentionIn, $bo, 0, 'C', 0);
						    
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $DententionOut, $bo, 0, 'C', 0);

						    // InActiveAdd, InActiveLess
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $InActiveAdd, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $InActiveLess, $bo, 0, 'C', 0);
	    				}
	    			}
	    			if($GradeName = 'A2'){
	    				if($grade_strength_report['grade_name'] == 'A2'){
	    					$X = 68.1;
							$Y = 191.8;
							$CX = 6.2;
							$CY = 2.25;
							// HouseChange, SectionChange, TagChange
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X, $Y);
						    $pdf->Cell($CX, $CY, $HouseChange, $bo, 0, 'C', 0);
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y);
						    $pdf->Cell($CX, $CY, $SectionChange, $bo, 0, 'C', 0);
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y);
						    $pdf->Cell($CX, $CY, $TagChange, $bo, 0, 'C', 0);

						    // AdmissionIn, WithdrawalOut
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $AdmissionIn, $bo, 0, 'C', 0);

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $WithdrawalOut, $bo, 0, 'C', 0);

						    // DententionIn, DententionOut
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $DetentionIn, $bo, 0, 'C', 0);
						    
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $DententionOut, $bo, 0, 'C', 0);

						    // InActiveAdd, InActiveLess
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $InActiveAdd, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($CX/2),$Y+$CY+$CY+$CY);
						    $pdf->Cell($CX+($CX/2), $CY, $InActiveLess, $bo, 0, 'C', 0);
	    				}
	    			}
				}





				/**************************************************************
				* Call Grade-Section
				* Num of (Jinnah, Iqbal, Syed) and (Boys, Girls)
				/*************************************************************/

			    $i=0;
	    		foreach ($data['strength_report'] as $strength_report) {	    			
	    			$GradeName = $strength_report['grade_name'];
					$SectionName = $strength_report['section_name'];
					$HouseChange = $strength_report['req_house'];
					$SectionChange = $strength_report['req_section'];
					$TagChange = $strength_report['req_std_card'];
					$AdmissionIn = $strength_report['req_admission'];
					$WithdrawalOut = $strength_report['req_withdrawal'];
					$DetentionIn = $strength_report['detain'];
					$DententionOut = $strength_report['detain'];
					$InActiveAdd = $strength_report['inative_add'];
					$InActiveLess = $strength_report['inative_less'];

					if($HouseChange == 0){$HouseChange = "";}
					if($SectionChange == 0){$SectionChange = "";}
					if($TagChange == 0){$TagChange = "";}
					if($AdmissionIn == 0){$AdmissionIn = "";}
					if($WithdrawalOut == 0){$WithdrawalOut = "";}
					if($DetentionIn == 0){$DetentionIn = "";}
					if($DententionOut == 0){$DententionOut = "";}
					if($InActiveAdd == 0){$InActiveAdd = "";}
					if($InActiveLess == 0){$InActiveLess = "";}

	    			if ($i >= 10){
	    				$i = 0;
	    			}

	    			if(in_array($SectionName, $sectionNames)){
	    				while($SectionName != $sectionNames[$i]){
						    $i++;
						    if ($i >= 10){
			    				$i = 0;
			    			}
			    		}
	    			}	

	    			if ($i >= 10){
	    				$i = 0;
	    			}		
	    			

	    			// Pre-Nursery
	    			if($strength_report['grade_name'] == 'PN'){	 	    				   				
    					// HouseChange, SectionChange, TagChange
    					$X = 92.65;
						$Y = 19.2;
						$CX = 6.2;
						$CY = 2.25;
						$Gap = 19.3;
	    				$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y);
					    $pdf->Cell($CX, $CY, $HouseChange, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($i*$Gap),$Y);
					    $pdf->Cell($CX, $CY, $SectionChange, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y);
					    $pdf->Cell($CX, $CY, $TagChange, $bo, 0, 'C', 0);

					    // AdmissionIn, WithdrawalOut
	    				$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $AdmissionIn, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($CX/2)+($i*$Gap),$Y+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $WithdrawalOut, $bo, 0, 'C', 0);

					    // DetentionIn, DetentionOut
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $DetentionIn, $bo, 0, 'C', 0);

					    
	    				$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($CX/2)+($i*$Gap),$Y+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $DententionOut, $bo, 0, 'C', 0);

					    // InActiveAdd, InActiveLess
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y+$CY+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $InActiveAdd, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($CX/2)+($i*$Gap),$Y+$CY+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $InActiveLess, $bo, 0, 'C', 0);
	    			}

	    			// Nursery	    			
	    			else if($strength_report['grade_name'] == 'N'){
	    				$X = 92.65;
						$Y = 30.35;
						$CX = 6.2;
						$CY = 2.25;
						$Gap = 19.3;
	    				$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y);
					    $pdf->Cell($CX, $CY, $HouseChange, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($i*$Gap),$Y);
					    $pdf->Cell($CX, $CY, $SectionChange, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y);
					    $pdf->Cell($CX, $CY, $TagChange, $bo, 0, 'C', 0);

					    // AdmissionIn, WithdrawalOut
	    				$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $AdmissionIn, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($CX/2)+($i*$Gap),$Y+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $WithdrawalOut, $bo, 0, 'C', 0);

					    // DetentionIn, DetentionOut
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $DetentionIn, $bo, 0, 'C', 0);

					    
	    				$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($CX/2)+($i*$Gap),$Y+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $DententionOut, $bo, 0, 'C', 0);

					    // InActiveAdd, InActiveLess
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y+$CY+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $InActiveAdd, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($CX/2)+($i*$Gap),$Y+$CY+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $InActiveLess, $bo, 0, 'C', 0);
	    			}

	    			// KG
	    			else if($strength_report['grade_name'] == 'KG'){
	    				$X = 92.65;
						$Y = 41.55;
						$CX = 6.2;
						$CY = 2.25;
						$Gap = 19.3;
	    				$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y);
					    $pdf->Cell($CX, $CY, $HouseChange, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($i*$Gap),$Y);
					    $pdf->Cell($CX, $CY, $SectionChange, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y);
					    $pdf->Cell($CX, $CY, $TagChange, $bo, 0, 'C', 0);

					    // AdmissionIn, WithdrawalOut
	    				$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $AdmissionIn, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($CX/2)+($i*$Gap),$Y+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $WithdrawalOut, $bo, 0, 'C', 0);

					    // DetentionIn, DetentionOut
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $DetentionIn, $bo, 0, 'C', 0);

					    
	    				$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($CX/2)+($i*$Gap),$Y+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $DententionOut, $bo, 0, 'C', 0);

					    // InActiveAdd, InActiveLess
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y+$CY+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $InActiveAdd, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($CX/2)+($i*$Gap),$Y+$CY+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $InActiveLess, $bo, 0, 'C', 0);
	    			}
		    		
	    			// I
	    			else if($strength_report['grade_name'] == 'I'){
	    				$X = 92.65;
						$Y = 57.3;
						$CX = 6.2;
						$CY = 2.25;
						$Gap = 19.3;
	    				$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y);
					    $pdf->Cell($CX, $CY, $HouseChange, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($i*$Gap),$Y);
					    $pdf->Cell($CX, $CY, $SectionChange, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y);
					    $pdf->Cell($CX, $CY, $TagChange, $bo, 0, 'C', 0);

					    // AdmissionIn, WithdrawalOut
	    				$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $AdmissionIn, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($CX/2)+($i*$Gap),$Y+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $WithdrawalOut, $bo, 0, 'C', 0);

					    // DetentionIn, DetentionOut
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $DetentionIn, $bo, 0, 'C', 0);

					    
	    				$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($CX/2)+($i*$Gap),$Y+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $DententionOut, $bo, 0, 'C', 0);

					    // InActiveAdd, InActiveLess
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y+$CY+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $InActiveAdd, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($CX/2)+($i*$Gap),$Y+$CY+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $InActiveLess, $bo, 0, 'C', 0);
	    			}

	    			// II
	    			else if($strength_report['grade_name'] == 'II'){
	    				$X = 92.65;
						$Y = 68.5;
						$CX = 6.2;
						$CY = 2.25;
						$Gap = 19.3;
	    				$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y);
					    $pdf->Cell($CX, $CY, $HouseChange, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($i*$Gap),$Y);
					    $pdf->Cell($CX, $CY, $SectionChange, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y);
					    $pdf->Cell($CX, $CY, $TagChange, $bo, 0, 'C', 0);

					    // AdmissionIn, WithdrawalOut
	    				$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $AdmissionIn, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($CX/2)+($i*$Gap),$Y+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $WithdrawalOut, $bo, 0, 'C', 0);

					    // DetentionIn, DetentionOut
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $DetentionIn, $bo, 0, 'C', 0);

					    
	    				$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($CX/2)+($i*$Gap),$Y+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $DententionOut, $bo, 0, 'C', 0);

					    // InActiveAdd, InActiveLess
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y+$CY+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $InActiveAdd, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($CX/2)+($i*$Gap),$Y+$CY+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $InActiveLess, $bo, 0, 'C', 0);
	    			}

	    			// III
	    			else if($strength_report['grade_name'] == 'III'){
	    				$X = 92.65;
						$Y = 79.7;
						$CX = 6.2;
						$CY = 2.25;
						$Gap = 19.3;
	    				$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y);
					    $pdf->Cell($CX, $CY, $HouseChange, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($i*$Gap),$Y);
					    $pdf->Cell($CX, $CY, $SectionChange, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y);
					    $pdf->Cell($CX, $CY, $TagChange, $bo, 0, 'C', 0);

					    // AdmissionIn, WithdrawalOut
	    				$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $AdmissionIn, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($CX/2)+($i*$Gap),$Y+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $WithdrawalOut, $bo, 0, 'C', 0);

					    // DetentionIn, DetentionOut
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $DetentionIn, $bo, 0, 'C', 0);

					    
	    				$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($CX/2)+($i*$Gap),$Y+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $DententionOut, $bo, 0, 'C', 0);

					    // InActiveAdd, InActiveLess
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y+$CY+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $InActiveAdd, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($CX/2)+($i*$Gap),$Y+$CY+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $InActiveLess, $bo, 0, 'C', 0);
	    			}

	    			// IV
	    			else if($strength_report['grade_name'] == 'IV'){
	    				$X = 92.65;
						$Y = 90.9;
						$CX = 6.2;
						$CY = 2.25;
						$Gap = 19.3;
	    				$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y);
					    $pdf->Cell($CX, $CY, $HouseChange, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($i*$Gap),$Y);
					    $pdf->Cell($CX, $CY, $SectionChange, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y);
					    $pdf->Cell($CX, $CY, $TagChange, $bo, 0, 'C', 0);

					    // AdmissionIn, WithdrawalOut
	    				$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $AdmissionIn, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($CX/2)+($i*$Gap),$Y+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $WithdrawalOut, $bo, 0, 'C', 0);

					    // DetentionIn, DetentionOut
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $DetentionIn, $bo, 0, 'C', 0);

					    
	    				$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($CX/2)+($i*$Gap),$Y+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $DententionOut, $bo, 0, 'C', 0);

					    // InActiveAdd, InActiveLess
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y+$CY+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $InActiveAdd, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($CX/2)+($i*$Gap),$Y+$CY+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $InActiveLess, $bo, 0, 'C', 0);
	    			}


	    			// V
	    			else if($strength_report['grade_name'] == 'V'){	    				
	    				$X = 92.65;
						$Y = 102.15;
						$CX = 6.2;
						$CY = 2.25;
						$Gap = 19.3;
	    				$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y);
					    $pdf->Cell($CX, $CY, $HouseChange, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($i*$Gap),$Y);
					    $pdf->Cell($CX, $CY, $SectionChange, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y);
					    $pdf->Cell($CX, $CY, $TagChange, $bo, 0, 'C', 0);

					    // AdmissionIn, WithdrawalOut
	    				$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $AdmissionIn, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($CX/2)+($i*$Gap),$Y+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $WithdrawalOut, $bo, 0, 'C', 0);

					    // DetentionIn, DetentionOut
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $DetentionIn, $bo, 0, 'C', 0);

					    
	    				$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($CX/2)+($i*$Gap),$Y+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $DententionOut, $bo, 0, 'C', 0);

					    // InActiveAdd, InActiveLess
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y+$CY+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $InActiveAdd, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($CX/2)+($i*$Gap),$Y+$CY+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $InActiveLess, $bo, 0, 'C', 0);
					}
	    			// VI
	    			else if($strength_report['grade_name'] == 'VI'){
	    				$X = 92.65;
						$Y = 113.4;
						$CX = 6.2;
						$CY = 2.25;
						$Gap = 19.3;
	    				$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y);
					    $pdf->Cell($CX, $CY, $HouseChange, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($i*$Gap),$Y);
					    $pdf->Cell($CX, $CY, $SectionChange, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y);
					    $pdf->Cell($CX, $CY, $TagChange, $bo, 0, 'C', 0);

					    // AdmissionIn, WithdrawalOut
	    				$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $AdmissionIn, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($CX/2)+($i*$Gap),$Y+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $WithdrawalOut, $bo, 0, 'C', 0);

					    // DetentionIn, DetentionOut
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $DetentionIn, $bo, 0, 'C', 0);

					    
	    				$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($CX/2)+($i*$Gap),$Y+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $DententionOut, $bo, 0, 'C', 0);

					    // InActiveAdd, InActiveLess
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y+$CY+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $InActiveAdd, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($CX/2)+($i*$Gap),$Y+$CY+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $InActiveLess, $bo, 0, 'C', 0);
	    			}


	    			// VII
	    			else if($strength_report['grade_name'] == 'VII'){
	    				$X = 92.65;
						$Y = 124.45;
						$CX = 6.2;
						$CY = 2.25;
						$Gap = 19.3;
	    				$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y);
					    $pdf->Cell($CX, $CY, $HouseChange, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($i*$Gap),$Y);
					    $pdf->Cell($CX, $CY, $SectionChange, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y);
					    $pdf->Cell($CX, $CY, $TagChange, $bo, 0, 'C', 0);

					    // AdmissionIn, WithdrawalOut
	    				$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $AdmissionIn, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($CX/2)+($i*$Gap),$Y+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $WithdrawalOut, $bo, 0, 'C', 0);

					    // DetentionIn, DetentionOut
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $DetentionIn, $bo, 0, 'C', 0);

					    
	    				$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($CX/2)+($i*$Gap),$Y+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $DententionOut, $bo, 0, 'C', 0);

					    // InActiveAdd, InActiveLess
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y+$CY+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $InActiveAdd, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($CX/2)+($i*$Gap),$Y+$CY+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $InActiveLess, $bo, 0, 'C', 0);
	    			}



	    			// VIII
	    			else if($strength_report['grade_name'] == 'VIII'){
	    				$X = 92.65;
						$Y = 135.7;
						$CX = 6.2;
						$CY = 2.25;
						$Gap = 19.3;
	    				$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y);
					    $pdf->Cell($CX, $CY, $HouseChange, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($i*$Gap),$Y);
					    $pdf->Cell($CX, $CY, $SectionChange, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y);
					    $pdf->Cell($CX, $CY, $TagChange, $bo, 0, 'C', 0);

					    // AdmissionIn, WithdrawalOut
	    				$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $AdmissionIn, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($CX/2)+($i*$Gap),$Y+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $WithdrawalOut, $bo, 0, 'C', 0);

					    // DetentionIn, DetentionOut
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $DetentionIn, $bo, 0, 'C', 0);

					    
	    				$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($CX/2)+($i*$Gap),$Y+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $DententionOut, $bo, 0, 'C', 0);

					    // InActiveAdd, InActiveLess
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y+$CY+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $InActiveAdd, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($CX/2)+($i*$Gap),$Y+$CY+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $InActiveLess, $bo, 0, 'C', 0);
	    			}


	    			// IX
	    			else if($strength_report['grade_name'] == 'IX'){
	    				$X = 92.65;
						$Y = 146.9;
						$CX = 6.2;
						$CY = 2.25;
						$Gap = 19.3;
	    				$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y);
					    $pdf->Cell($CX, $CY, $HouseChange, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($i*$Gap),$Y);
					    $pdf->Cell($CX, $CY, $SectionChange, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y);
					    $pdf->Cell($CX, $CY, $TagChange, $bo, 0, 'C', 0);

					    // AdmissionIn, WithdrawalOut
	    				$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $AdmissionIn, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($CX/2)+($i*$Gap),$Y+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $WithdrawalOut, $bo, 0, 'C', 0);

					    // DetentionIn, DetentionOut
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $DetentionIn, $bo, 0, 'C', 0);

					    
	    				$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($CX/2)+($i*$Gap),$Y+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $DententionOut, $bo, 0, 'C', 0);

					    // InActiveAdd, InActiveLess
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y+$CY+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $InActiveAdd, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($CX/2)+($i*$Gap),$Y+$CY+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $InActiveLess, $bo, 0, 'C', 0);
	    			}


	    			// X
	    			else if($strength_report['grade_name'] == 'X'){
	    				$X = 92.65;
						$Y = 158.15;
						$CX = 6.2;
						$CY = 2.25;
						$Gap = 19.3;
	    				$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y);
					    $pdf->Cell($CX, $CY, $HouseChange, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($i*$Gap),$Y);
					    $pdf->Cell($CX, $CY, $SectionChange, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y);
					    $pdf->Cell($CX, $CY, $TagChange, $bo, 0, 'C', 0);

					    // AdmissionIn, WithdrawalOut
	    				$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $AdmissionIn, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($CX/2)+($i*$Gap),$Y+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $WithdrawalOut, $bo, 0, 'C', 0);

					    // DetentionIn, DetentionOut
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $DetentionIn, $bo, 0, 'C', 0);

					    
	    				$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($CX/2)+($i*$Gap),$Y+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $DententionOut, $bo, 0, 'C', 0);

					    // InActiveAdd, InActiveLess
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y+$CY+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $InActiveAdd, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($CX/2)+($i*$Gap),$Y+$CY+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $InActiveLess, $bo, 0, 'C', 0);
	    			}


	    			// XI
	    			else if($strength_report['grade_name'] == 'XI'){
	    				$X = 92.65;
						$Y = 169.35;
						$CX = 6.2;
						$CY = 2.25;
						$Gap = 19.3;
	    				$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y);
					    $pdf->Cell($CX, $CY, $HouseChange, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($i*$Gap),$Y);
					    $pdf->Cell($CX, $CY, $SectionChange, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y);
					    $pdf->Cell($CX, $CY, $TagChange, $bo, 0, 'C', 0);

					    // AdmissionIn, WithdrawalOut
	    				$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $AdmissionIn, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($CX/2)+($i*$Gap),$Y+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $WithdrawalOut, $bo, 0, 'C', 0);

					    // DetentionIn, DetentionOut
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $DetentionIn, $bo, 0, 'C', 0);

					    
	    				$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($CX/2)+($i*$Gap),$Y+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $DententionOut, $bo, 0, 'C', 0);

					    // InActiveAdd, InActiveLess
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y+$CY+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $InActiveAdd, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($CX/2)+($i*$Gap),$Y+$CY+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $InActiveLess, $bo, 0, 'C', 0);
	    			}


	    			// A1
	    			else if($strength_report['grade_name'] == 'A1'){
	    				$X = 92.65;
						$Y = 180.6;
						$CX = 6.2;
						$CY = 2.25;
						$Gap = 19.3;
	    				$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y);
					    $pdf->Cell($CX, $CY, $HouseChange, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($i*$Gap),$Y);
					    $pdf->Cell($CX, $CY, $SectionChange, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y);
					    $pdf->Cell($CX, $CY, $TagChange, $bo, 0, 'C', 0);

					    // AdmissionIn, WithdrawalOut
	    				$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $AdmissionIn, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($CX/2)+($i*$Gap),$Y+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $WithdrawalOut, $bo, 0, 'C', 0);

					    // DetentionIn, DetentionOut
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $DetentionIn, $bo, 0, 'C', 0);

					    
	    				$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($CX/2)+($i*$Gap),$Y+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $DententionOut, $bo, 0, 'C', 0);

					    // InActiveAdd, InActiveLess
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y+$CY+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $InActiveAdd, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($CX/2)+($i*$Gap),$Y+$CY+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $InActiveLess, $bo, 0, 'C', 0);
	    			}


	    			// A2
	    			else if($strength_report['grade_name'] == 'A2'){
	    				$X = 92.65;
						$Y = 191.8;
						$CX = 6.2;
						$CY = 2.25;
						$Gap = 19.3;
	    				$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y);
					    $pdf->Cell($CX, $CY, $HouseChange, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($i*$Gap),$Y);
					    $pdf->Cell($CX, $CY, $SectionChange, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y);
					    $pdf->Cell($CX, $CY, $TagChange, $bo, 0, 'C', 0);

					    // AdmissionIn, WithdrawalOut
	    				$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $AdmissionIn, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($CX/2)+($i*$Gap),$Y+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $WithdrawalOut, $bo, 0, 'C', 0);

					    // DetentionIn, DetentionOut
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $DetentionIn, $bo, 0, 'C', 0);

					    
	    				$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($CX/2)+($i*$Gap),$Y+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $DententionOut, $bo, 0, 'C', 0);

					    // InActiveAdd, InActiveLess
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+($i*$Gap),$Y+$CY+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $InActiveAdd, $bo, 0, 'C', 0);

					    
		    			$pdf->SetFont($font_name);
					    $pdf->SetFont($font_name,'',6);
					    $pdf->SetFillColor(255,255,255);
					    $pdf->SetDrawColor(255,0,0);
					    $pdf->SetXY($X+$CX+($CX/2)+($i*$Gap),$Y+$CY+$CY+$CY);
					    $pdf->Cell($CX+($CX/2), $CY, $InActiveLess, $bo, 0, 'C', 0);
	    			}

	    			$i++;
	    		}
			}
			// page 2
			/*****School Wide Student Delta Logs *****/
			// Add Page
			$data['admission_in_detail'] = $this->student_delta_summary_model->getStudentAdmissionDetail_Date($this->dateRangeFrom, $this->dateRangeTo);		
			$data['withdrawal_out_detail'] = $this->student_delta_summary_model->getStudentWirhdrawalDetail_Date($this->dateRangeFrom, $this->dateRangeTo);
			$data['card_change_detail'] = $this->student_delta_summary_model->getStudentCardChangeDetail_Date($this->dateRangeFrom, $this->dateRangeTo);
			$data['section_change_detail'] = $this->student_delta_summary_model->getStudentSectionDetail_Date($this->dateRangeFrom, $this->dateRangeTo);
			$data['house_change_detail'] = $this->student_delta_summary_model->getStudentHouseDetail_Date($this->dateRangeFrom, $this->dateRangeTo);
			$data['Detain_detail'] = $this->student_delta_summary_model->getStudentDetainDetail_Date();
			$data['active_inactive'] = $this->student_delta_summary_model->getStudentActiveDetail_Date($this->dateRangeFrom, $this->dateRangeTo);

			
			$pdf->AddPage('L','a4');
    		// border on
    		$bo = 0;
    		$BBO = 1;
    		$pdf->SetMargins(0,0,0);
    		$pdf->SetAutoPageBreak(0,0);

    		$page_on = False;
    		$page_num = $pdf->pageNo();


    		$Title = 'School Wide Student Delta Logs';

    		$pdf->SetFont($font_name);
		    $pdf->SetFont($font_name,'B',12);
		    $pdf->SetFillColor(255,255,255);
		    $pdf->SetDrawColor(255,0,0);
		    $pdf->SetXY(3,3);
		    $pdf->Cell(291, 6, $Title, $bo, 0, 'C', 0);

    		$pdf->SetFont($font_name);
		    $pdf->SetFont($font_name,'B',12);
		    $pdf->SetFillColor(255,255,255);
		    $pdf->SetDrawColor(255,0,0);
		    $pdf->SetXY(3,9);
		    $pdf->Cell(291, 6, $now_date, $bo, 0, 'C', 0);

		    
		    /*$pdf->SetFont($font_name);
		    $pdf->SetFont($font_name,'B',12);
		    $pdf->SetFillColor(255,255,255);
		    $pdf->SetDrawColor(255,0,0);
		    $pdf->SetXY(2,1);
		    $pdf->Cell(291, 6, "Page ".$page_num, $bo, 0, 'C', 0);*/

		    /****Page LayOut****/ 
		    
		    $pdf->SetFont($font_name);
		    $pdf->SetFont($font_name,'B',10);
		    $pdf->SetFillColor(0,0,0);
		    $pdf->SetDrawColor(0,0,0);
		    $pdf->SetTextColor(255,255,255);
		    $pdf->SetXY(3,15);
		    $pdf->Cell(88, 6,'Admission', $BBO, 0, 'C', 1);

		    	// Sr#
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',8);
			    $pdf->SetFillColor(192,192,192);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetTextColor(0,0,0);
			    $pdf->SetXY(3,21);
			    $pdf->Cell(8, 5,'Sr#', $BBO, 0, 'C', 1);
			    // Date
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',8);
			    $pdf->SetFillColor(192,192,192);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetTextColor(0,0,0);
			    $pdf->SetXY(11,21);
			    $pdf->Cell(21, 5,'Request Date', $BBO, 0, 'C', 1);
			    // GS-ID
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',8);
			    $pdf->SetFillColor(192,192,192);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetTextColor(0,0,0);
			    $pdf->SetXY(32,21);
			    $pdf->Cell(13, 5,'GS-ID', $BBO, 0, 'C', 1);
			    // Abridged Name
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',8);
			    $pdf->SetFillColor(192,192,192);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetTextColor(0,0,0);
			    $pdf->SetXY(45,21);
			    $pdf->Cell(33, 5,'Student Name', $BBO, 0, 'C', 1);
			     // Grade & Section
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',8);
			    $pdf->SetFillColor(192,192,192);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetTextColor(0,0,0);
			    $pdf->SetXY(78,21);
			    $pdf->Cell(13, 5,'Grade', $BBO, 0, 'C', 1);


		    // Withdrawal LayOut
		    
		    $pdf->SetFont($font_name);
		    $pdf->SetFont($font_name,'B',10);
		    $pdf->SetFillColor(0,0,0);
		    $pdf->SetDrawColor(0,0,0);
		    $pdf->SetTextColor(255,255,255);
		    $pdf->SetXY(92,15);
		    $pdf->Cell(98, 6,'Withdrawal', $BBO, 0, 'C', 1);

		    	// Sr#
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',8);
			    $pdf->SetFillColor(192,192,192);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetTextColor(0,0,0);
			    $pdf->SetXY(92,21);
			    $pdf->Cell(8, 5,'Sr#', $BBO, 0, 'C', 1);
			    // Date
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',8);
			    $pdf->SetFillColor(192,192,192);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetTextColor(0,0,0);
			    $pdf->SetXY(100,21);
			    $pdf->Cell(21, 5,'Request Date', $BBO, 0, 'C', 1);
			    // GS-ID
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',8);
			    $pdf->SetFillColor(192,192,192);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetTextColor(0,0,0);
			    $pdf->SetXY(121,21);
			    $pdf->Cell(13, 5,'GS-ID', $BBO, 0, 'C', 1);
			    // Abridged Name
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',8);
			    $pdf->SetFillColor(192,192,192);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetTextColor(0,0,0);
			    $pdf->SetXY(134,21);
			    $pdf->Cell(33, 5,'Student Name', $BBO, 0, 'C', 1);
			     // Grade & Section
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',8);
			    $pdf->SetFillColor(192,192,192);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetTextColor(0,0,0);
			    $pdf->SetXY(167,21);
			    $pdf->Cell(13, 5,'Grade', $BBO, 0, 'C', 1);
			     // Grade & Section
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',8);
			    $pdf->SetFillColor(192,192,192);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetTextColor(0,0,0);
			    $pdf->SetXY(180,21);
			    $pdf->Cell(10, 5,'Status', $BBO, 0, 'C', 1);

			// Tag Change LayOut
		    
		    $pdf->SetFont($font_name);
		    $pdf->SetFont($font_name,'B',10);
		    $pdf->SetFillColor(0,0,0);
		    $pdf->SetDrawColor(0,0,0);
		    $pdf->SetTextColor(255,255,255);
		    $pdf->SetXY(92,112);
		    $pdf->Cell(98, 6,'Tag Change', $BBO, 0, 'C', 1);

		    	// Sr#
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',8);
			    $pdf->SetFillColor(192,192,192);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetTextColor(0,0,0);
			    $pdf->SetXY(92,118);
			    $pdf->Cell(8, 5,'Sr#', $BBO, 0, 'C', 1);
			    // Date
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',8);
			    $pdf->SetFillColor(192,192,192);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetTextColor(0,0,0);
			    $pdf->SetXY(100,118);
			    $pdf->Cell(21, 5,'Request Date', $BBO, 0, 'C', 1);
			    // GS-ID
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',8);
			    $pdf->SetFillColor(192,192,192);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetTextColor(0,0,0);
			    $pdf->SetXY(121,118);
			    $pdf->Cell(13, 5,'GS-ID', $BBO, 0, 'C', 1);
			    // Abridged Name
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',8);
			    $pdf->SetFillColor(192,192,192);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetTextColor(0,0,0);
			    $pdf->SetXY(134,118);
			    $pdf->Cell(33, 5,'Student Name', $BBO, 0, 'C', 1);
			     // Grade & Section
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',8);
			    $pdf->SetFillColor(192,192,192);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetTextColor(0,0,0);
			    $pdf->SetXY(167,118);
			    $pdf->Cell(13, 5,'Grade', $BBO, 0, 'C', 1);
			     // Charged
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',6);
			    $pdf->SetFillColor(192,192,192);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetTextColor(0,0,0);
			    $pdf->SetXY(180,118);
			    $pdf->Cell(10, 5,'Charged', $BBO, 0, 'C', 1);


		    // Section LayOut
		    
		    $pdf->SetFont($font_name);
		    $pdf->SetFont($font_name,'B',10);
		    $pdf->SetFillColor(0,0,0);
		    $pdf->SetDrawColor(0,0,0);
		    $pdf->SetTextColor(255,255,255);
		    $pdf->SetXY(191,15);
		    $pdf->Cell(104, 6,'Section Change', $BBO, 0, 'C', 1);

		    	// Sr#
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',8);
			    $pdf->SetFillColor(192,192,192);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetTextColor(0,0,0);
			    $pdf->SetXY(191,21);
			    $pdf->Cell(8, 5,'Sr#', $BBO, 0, 'C', 1);
			    // Date
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',8);
			    $pdf->SetFillColor(192,192,192);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetTextColor(0,0,0);
			    $pdf->SetXY(199,21);
			    $pdf->Cell(21, 5,'Request Date', $BBO, 0, 'C', 1);
			    // GS-ID
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',8);
			    $pdf->SetFillColor(192,192,192);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetTextColor(0,0,0);
			    $pdf->SetXY(220,21);
			    $pdf->Cell(13, 5,'GS-ID', $BBO, 0, 'C', 1);
			    // Abridged Name
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',8);
			    $pdf->SetFillColor(192,192,192);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetTextColor(0,0,0);
			    $pdf->SetXY(233,21);
			    $pdf->Cell(33, 5,'Student Name', $BBO, 0, 'C', 1);
			    // Grade & Section
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',8);
			    $pdf->SetFillColor(192,192,192);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetTextColor(0,0,0);
			    $pdf->SetXY(266,21);
			    $pdf->Cell(13, 5,'Grade', $BBO, 0, 'C', 1);
			    // Old Section
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',8);
			    $pdf->SetFillColor(192,192,192);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetTextColor(0,0,0);
			    $pdf->SetXY(279,21);
			    $pdf->Cell(8, 5,'Old', $BBO, 0, 'C', 1);
			    // New Section
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',8);
			    $pdf->SetFillColor(192,192,192);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetTextColor(0,0,0);
			    $pdf->SetXY(287,21);
			    $pdf->Cell(8, 5,'New', $BBO, 0, 'C', 1);

		    // House LayOut
		    
		    $pdf->SetFont($font_name);
		    $pdf->SetFont($font_name,'B',10);
		    $pdf->SetFillColor(0,0,0);
		    $pdf->SetDrawColor(0,0,0);
		    $pdf->SetTextColor(255,255,255);
		    $pdf->SetXY(191,62.5);
		    $pdf->Cell(104, 6,'House Change', $BBO, 0, 'C', 1);

		    	// Sr#
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',8);
			    $pdf->SetFillColor(192,192,192);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetTextColor(0,0,0);
			    $pdf->SetXY(191,68.5);
			    $pdf->Cell(8, 5,'Sr#', $BBO, 0, 'C', 1);
			    // Date
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',8);
			    $pdf->SetFillColor(192,192,192);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetTextColor(0,0,0);
			    $pdf->SetXY(199,68.5);
			    $pdf->Cell(21, 5,'Request Date', $BBO, 0, 'C', 1);
			    // GS-ID
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',8);
			    $pdf->SetFillColor(192,192,192);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetTextColor(0,0,0);
			    $pdf->SetXY(220,68.5);
			    $pdf->Cell(13, 5,'GS-ID', $BBO, 0, 'C', 1);
			    // Abridged Name
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',8);
			    $pdf->SetFillColor(192,192,192);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetTextColor(0,0,0);
			    $pdf->SetXY(233,68.5);
			    $pdf->Cell(33, 5,'Student Name', $BBO, 0, 'C', 1);
			     // Grade & Section
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',8);
			    $pdf->SetFillColor(192,192,192);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetTextColor(0,0,0);
			    $pdf->SetXY(266,68.5);
			    $pdf->Cell(13, 5,'Grade', $BBO, 0, 'C', 1);
			    // Old Section
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',8);
			    $pdf->SetFillColor(192,192,192);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetTextColor(0,0,0);
			    $pdf->SetXY(279,68.5);
			    $pdf->Cell(8, 5,'Old', $BBO, 0, 'C', 1);
			    // New Section
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',8);
			    $pdf->SetFillColor(192,192,192);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetTextColor(0,0,0);
			    $pdf->SetXY(287,68.5);
			    $pdf->Cell(8, 5,'New', $BBO, 0, 'C', 1);

		    // Detaintion LayOut
		    
		    $pdf->SetFont($font_name);
		    $pdf->SetFont($font_name,'B',10);
		    $pdf->SetFillColor(0,0,0);
		    $pdf->SetDrawColor(0,0,0);
		    $pdf->SetTextColor(255,255,255);
		    $pdf->SetXY(191,112);
		    $pdf->Cell(104, 6,'Detained', $BBO, 0, 'C', 1);

		    	// Sr#
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',8);
			    $pdf->SetFillColor(192,192,192);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetTextColor(0,0,0);
			    $pdf->SetXY(191,118);
			    $pdf->Cell(8, 5,'Sr#', $BBO, 0, 'C', 1);
			    // GS-ID
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',8);
			    $pdf->SetFillColor(192,192,192);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetTextColor(0,0,0);
			    $pdf->SetXY(199,118);
			    $pdf->Cell(13, 5,'GS-ID', $BBO, 0, 'C', 1);
			    // Abridged Name
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',8);
			    $pdf->SetFillColor(192,192,192);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetTextColor(0,0,0);
			    $pdf->SetXY(212,118);
			    $pdf->Cell(33, 5,'Student Name', $BBO, 0, 'C', 1);
			     // Previous Grade & Section
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',8);
			    $pdf->SetFillColor(192,192,192);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetTextColor(0,0,0);
			    $pdf->SetXY(245,118);
			    $pdf->Cell(25, 5,'Previous Grade', $BBO, 0, 'C', 1);
			    // Grade and Secti0n
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',8);
			    $pdf->SetFillColor(192,192,192);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetTextColor(0,0,0);
			    $pdf->SetXY(270,118);
			    $pdf->Cell(25, 5,'Grade & Section', $BBO, 0, 'C', 1);


		    // Inactive LayOut
		    
		    $pdf->SetFont($font_name);
		    $pdf->SetFont($font_name,'B',10);
		    $pdf->SetFillColor(0,0,0);
		    $pdf->SetDrawColor(0,0,0);
		    $pdf->SetTextColor(255,255,255);
		    $pdf->SetXY(191,159.5);
		    $pdf->Cell(104, 6,'Active / Inactive', $BBO, 0, 'C', 1);

		    	// Sr#
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',8);
			    $pdf->SetFillColor(192,192,192);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetTextColor(0,0,0);
			    $pdf->SetXY(191,165.5);
			    $pdf->Cell(8, 5,'Sr#', $BBO, 0, 'C', 1);
			    // Date
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',8);
			    $pdf->SetFillColor(192,192,192);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetTextColor(0,0,0);
			    $pdf->SetXY(199,165.5);
			    $pdf->Cell(21, 5,'Request Date', $BBO, 0, 'C', 1);
			    // GS-ID
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',8);
			    $pdf->SetFillColor(192,192,192);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetTextColor(0,0,0);
			    $pdf->SetXY(220,165.5);
			    $pdf->Cell(13, 5,'GS-ID', $BBO, 0, 'C', 1);
			    // Abridged Name
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',8);
			    $pdf->SetFillColor(192,192,192);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetTextColor(0,0,0);
			    $pdf->SetXY(233,165.5);
			    $pdf->Cell(33, 5,'Student Name', $BBO, 0, 'C', 1);
			     // Grade & Section
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',8);
			    $pdf->SetFillColor(192,192,192);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetTextColor(0,0,0);
			    $pdf->SetXY(266,165.5);
			    $pdf->Cell(13, 5,'Grade', $BBO, 0, 'C', 1);
			    // Old Section
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',8);
			    $pdf->SetFillColor(192,192,192);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetTextColor(0,0,0);
			    $pdf->SetXY(279,165.5);
			    $pdf->Cell(8, 5,'Old', $BBO, 0, 'C', 1);
			    // New Section
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',8);
			    $pdf->SetFillColor(192,192,192);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetTextColor(0,0,0);
			    $pdf->SetXY(287,165.5);
			    $pdf->Cell(8, 5,'New', $BBO, 0, 'C', 1);

		    /***** Admission In *****/
		    $i=1;
		    $noofrow = 36;
		    foreach(array_slice($data['admission_in_detail'], 0, $noofrow, False) as $new_admission){

			    $Abridged_Name = $new_admission['abridged_name'];
			    $Grade_Name = $new_admission['grade_name'];
			    $Section_Name = $new_admission['section_name'];
			    $Req_Date = $new_admission['req_date'];
			    $GS_ID = $new_admission['gs_id'];

			    $Req_Date = date('d-M-Y',strtotime($Req_Date));
			    //var_dump($data['admission_in_detail']);

			    $CX = 96;
			    $CY = 5;
			    $X = 3;
			    $Y = 21;

			    
			    $r1 = 255;
			    $g1 = 255;
			    $b1 = 255;
			    $r2 = 226;
			    $g2 = 226;
			    $b2 = 226;
			    

			    // Sr#
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',8);
			    if ($i % 2 == 0){
			    	$pdf->SetFillColor($r1,$g1,$b1);
			    }else {
					$pdf->SetFillColor($r2,$g2,$b2);
				}
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetXY(3,$Y+($i*$CY));
			    $pdf->Cell(8, $CY,$i, $BBO, 0, 'C', 1);
			    // Date
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',8);
			    if ($i % 2 == 0){
			    	$pdf->SetFillColor($r1,$g1,$b1);
			    }else {
					$pdf->SetFillColor($r2,$g2,$b2);
				}
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetXY(11,$Y+($i*$CY));
			    $pdf->Cell(21, $CY, $Req_Date, $BBO, 0, 'C', 1);
			    // GS-ID
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',8);
			    if ($i % 2 == 0){
			    	$pdf->SetFillColor($r1,$g1,$b1);
			    }else {
					$pdf->SetFillColor($r2,$g2,$b2);
				}
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetXY(32,$Y+($i*$CY));
			    $pdf->Cell(13, $CY, $GS_ID, $BBO, 0, 'C', 1);
			    // Abridged Name
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',8);
			    if ($i % 2 == 0){
			    	$pdf->SetFillColor($r1,$g1,$b1);
			    }else {
					$pdf->SetFillColor($r2,$g2,$b2);
				}
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetXY(45,$Y+($i*$CY));
			    $pdf->Cell(33, $CY, $Abridged_Name, $BBO, 0, 'L', 1);
			     // Grade & Section
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',8);
			    if ($i % 2 == 0){
			    	$pdf->SetFillColor($r1,$g1,$b1);
			    }else {
					$pdf->SetFillColor($r2,$g2,$b2);
				}
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetXY(78,$Y+($i*$CY));
			    $pdf->Cell(13, $CY, $Grade_Name.'-'.$Section_Name, $BBO, 0, 'C', 1);

			    if ($i >= $noofrow) {
			    	$page_on = true;
			    	$noofrow * $page_num;
			    }
			    $i++;
			    
			}
			/***** Withdrawal Out *****/
			$i=1;
		    foreach(array_slice($data['withdrawal_out_detail'], 0, 17, False) as $new_Withdrawal){		    	
			    $Abridged_Name = $new_Withdrawal['abridged_name'];
			    $Grade_Name = $new_Withdrawal['grade_name'];
			    $Section_Name = $new_Withdrawal['section_name'];
			    $Req_Date = $new_Withdrawal['req_date'];
			    $GS_ID = $new_Withdrawal['gs_id'];
			    $Std_Status = $new_Withdrawal['student_status_dname'];

			    $Req_Date = date('d-M-Y',strtotime($Req_Date));
			    //var_dump($data['admission_in_detail']);

			    $CX = 96;
			    $CY = 5;
			    $X = 3;
			    $Y = 21;

			    $r1 = 255;
			    $g1 = 255;
			    $b1 = 255;
			    $r2 = 226;
			    $g2 = 226;
			    $b2 = 226;

			    // Sr#
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',8);
			    if ($i % 2 == 0){
			    	$pdf->SetFillColor($r1,$g1,$b1);
			    }else {
					$pdf->SetFillColor($r2,$g2,$b2);
				}
			    $pdf->SetXY(92,$Y+($i*$CY));
			    $pdf->Cell(8, $CY,$i, $BBO, 0, 'C', 1);
			    // Date
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',8);
			    if ($i % 2 == 0){
			    	$pdf->SetFillColor($r1,$g1,$b1);
			    }else {
					$pdf->SetFillColor($r2,$g2,$b2);
				}
			    $pdf->SetXY(100,$Y+($i*$CY));
			    $pdf->Cell(21, $CY, $Req_Date, $BBO, 0, 'C', 1);
			    // GS-ID
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',8);
			    if ($i % 2 == 0){
			    	$pdf->SetFillColor($r1,$g1,$b1);
			    }else {
					$pdf->SetFillColor($r2,$g2,$b2);
				}
			    $pdf->SetXY(121,$Y+($i*$CY));
			    $pdf->Cell(13, $CY, $GS_ID, $BBO, 0, 'C', 1);
			    // Abridged Name
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',8);
			    if ($i % 2 == 0){
			    	$pdf->SetFillColor($r1,$g1,$b1);
			    }else {
					$pdf->SetFillColor($r2,$g2,$b2);
				}
			    $pdf->SetXY(134,$Y+($i*$CY));
			    $pdf->Cell(33, $CY, $Abridged_Name, $BBO, 0, 'L', 1);
			     // Grade & Section
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',8);
			    if ($i % 2 == 0){
			    	$pdf->SetFillColor($r1,$g1,$b1);
			    }else {
					$pdf->SetFillColor($r2,$g2,$b2);
				}
			    $pdf->SetXY(167,$Y+($i*$CY));
			    $pdf->Cell(13, $CY, $Grade_Name.'-'.$Section_Name, $BBO, 0, 'C', 1);
			     // Student Status
			    if ($Std_Status == 'Active'){
			    	$Std_Status = 'A';
			    }else if ($Std_Status == 'Withdrawal'){
			    	$Std_Status = 'W';
			    }else if ($Std_Status == 'Inactive'){
			    	$Std_Status = 'I';
			    }
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',8);
			    if ($i % 2 == 0){
			    	$pdf->SetFillColor($r1,$g1,$b1);
			    }else {
					$pdf->SetFillColor($r2,$g2,$b2);
				}
			    $pdf->SetXY(180,$Y+($i*$CY));
			    $pdf->Cell(10, $CY, $Std_Status, $BBO, 0, 'C', 1);
			    if ($i >= 17){
			    	$page_on = true;
			    }
			   	$i++;
			}

			/***** Tag Change *****/
			$i=1;
		    foreach(array_slice($data['card_change_detail'], 0, 17, False) as $tag_change){		    	
			    $Abridged_Name = $tag_change['abridged_name'];
			    $Grade_Name = $tag_change['grade_name'];
			    $Section_Name = $tag_change['section_name'];
			    $Req_Date = $tag_change['req_date'];
			    $GS_ID = $tag_change['gs_id'];
			    $Charged = $tag_change['amount'];

			    $Req_Date = date('d-M-Y',strtotime($Req_Date));
			    //var_dump($data['admission_in_detail']);

			    $CX = 96;
			    $CY = 5;
			    $X = 3;
			    $Y = 118;

			    $r1 = 255;
			    $g1 = 255;
			    $b1 = 255;
			    $r2 = 226;
			    $g2 = 226;
			    $b2 = 226;

			    // Sr#
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',8);
			    if ($i % 2 == 0){
			    	$pdf->SetFillColor($r1,$g1,$b1);
			    }else {
					$pdf->SetFillColor($r2,$g2,$b2);
				}
			    $pdf->SetXY(92,$Y+($i*$CY));
			    $pdf->Cell(8, $CY,$i, $BBO, 0, 'C', 1);
			    // Date
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',8);
			    if ($i % 2 == 0){
			    	$pdf->SetFillColor($r1,$g1,$b1);
			    }else {
					$pdf->SetFillColor($r2,$g2,$b2);
				}
			    $pdf->SetXY(100,$Y+($i*$CY));
			    $pdf->Cell(21, $CY, $Req_Date, $BBO, 0, 'C', 1);
			    // GS-ID
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',8);
			    if ($i % 2 == 0){
			    	$pdf->SetFillColor($r1,$g1,$b1);
			    }else {
					$pdf->SetFillColor($r2,$g2,$b2);
				}
			    $pdf->SetXY(121,$Y+($i*$CY));
			    $pdf->Cell(13, $CY, $GS_ID, $BBO, 0, 'C', 1);
			    // Abridged Name
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',8);
			    if ($i % 2 == 0){
			    	$pdf->SetFillColor($r1,$g1,$b1);
			    }else {
					$pdf->SetFillColor($r2,$g2,$b2);
				}
			    $pdf->SetXY(134,$Y+($i*$CY));
			    $pdf->Cell(33, $CY, $Abridged_Name, $BBO, 0, 'L', 1);
			     // Grade & Section
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',8);
			    if ($i % 2 == 0){
			    	$pdf->SetFillColor($r1,$g1,$b1);
			    }else {
					$pdf->SetFillColor($r2,$g2,$b2);
				}
			    $pdf->SetXY(167,$Y+($i*$CY));
			    $pdf->Cell(13, $CY, $Grade_Name.'-'.$Section_Name, $BBO, 0, 'C', 1);
			    // Charged
			    if ($Charged == 0){
			    	$Charged = 'N';
			    }else {
			    	$Charged = 'Y';
			    }
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',8);
			    if ($i % 2 == 0){
			    	$pdf->SetFillColor($r1,$g1,$b1);
			    }else {
					$pdf->SetFillColor($r2,$g2,$b2);
				}
			    $pdf->SetXY(180,$Y+($i*$CY));
			    $pdf->Cell(10, $CY, $Charged, $BBO, 0, 'C', 1);

			    if ($i >= 17){
			    	$page_on = true;
			    }
			    
			    $i++;
			}

			/***** Section Change *****/
			$i=1;
		    foreach(array_slice($data['section_change_detail'], 0, 7, False) as $section_change){
			    $Abridged_Name = $section_change['abridged_name'];
			    $Grade_Name = $section_change['grade_name'];
			    $Old_Section = $section_change['old_section'];
			    $New_Section = $section_change['new_section'];
			    $Req_Date = $section_change['req_date'];
			    $GS_ID = $section_change['gs_id'];

			    $Req_Date = date('d-M-Y',strtotime($Req_Date));
			    //var_dump($data['admission_in_detail']);

			    $CX = 96;
			    $CY = 5;
			    $X = 3;
			    $Y = 21;

			    $r1 = 255;
			    $g1 = 255;
			    $b1 = 255;
			    $r2 = 226;
			    $g2 = 226;
			    $b2 = 226;


			    // Sr#
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',8);
			    if ($i % 2 == 0){
			    	$pdf->SetFillColor($r1,$g1,$b1);
			    }else {
					$pdf->SetFillColor($r2,$g2,$b2);
				}
			    $pdf->SetXY(191,$Y+($i*$CY));
			    $pdf->Cell(8, $CY,$i, $BBO, 0, 'C', 1);
			    // Date
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',8);
			    if ($i % 2 == 0){
			    	$pdf->SetFillColor($r1,$g1,$b1);
			    }else {
					$pdf->SetFillColor($r2,$g2,$b2);
				}
			    $pdf->SetXY(199,$Y+($i*$CY));
			    $pdf->Cell(21, $CY, $Req_Date, $BBO, 0, 'C', 1);
			    // GS-ID
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',8);
			    if ($i % 2 == 0){
			    	$pdf->SetFillColor($r1,$g1,$b1);
			    }else {
					$pdf->SetFillColor($r2,$g2,$b2);
				}
			    $pdf->SetXY(220,$Y+($i*$CY));
			    $pdf->Cell(13, $CY, $GS_ID, $BBO, 0, 'C', 1);
			    // Abridged Name
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',8);
			    if ($i % 2 == 0){
			    	$pdf->SetFillColor($r1,$g1,$b1);
			    }else {
					$pdf->SetFillColor($r2,$g2,$b2);
				}
			    $pdf->SetXY(233,$Y+($i*$CY));
			    $pdf->Cell(33, $CY, $Abridged_Name, $BBO, 0, 'L', 1);
			     // Grade & Section
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',8);
			    if ($i % 2 == 0){
			    	$pdf->SetFillColor($r1,$g1,$b1);
			    }else {
					$pdf->SetFillColor($r2,$g2,$b2);
				}
			    $pdf->SetXY(266,$Y+($i*$CY));
			    $pdf->Cell(13, $CY, $Grade_Name, $BBO, 0, 'C', 1);
			     // Old Section
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',8);
			    if ($i % 2 == 0){
			    	$pdf->SetFillColor($r1,$g1,$b1);
			    }else {
					$pdf->SetFillColor($r2,$g2,$b2);
				}
			    $pdf->SetXY(279,$Y+($i*$CY));
			    $pdf->Cell(8, $CY, $Old_Section, $BBO, 0, 'C', 1);
			     // New Section
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',8);
			    if ($i % 2 == 0){
			    	$pdf->SetFillColor($r1,$g1,$b1);
			    }else {
					$pdf->SetFillColor($r2,$g2,$b2);
				}
			    $pdf->SetXY(287,$Y+($i*$CY));
			    $pdf->Cell(8, $CY, $New_Section, $BBO, 0, 'C', 1);

			    if ($i >= 7){
			    	$page_on = true;
			    }
				
			    $i++;
			}

			/***** House Change *****/
			$i=1;
		    foreach(array_slice($data['house_change_detail'], 0, 7, False) as $house_change){
			    $Abridged_Name = $house_change['abridged_name'];
			    $Grade_Name = $house_change['grade_name'];
			    $Section_Name = $house_change['section_name'];
			    $Req_Date = $house_change['req_date'];
			    $GS_ID = $house_change['gs_id'];
			    $Old_House = $house_change['old_house'];
			    $New_House = $house_change['new_house'];

			    $Req_Date = date('d-M-Y',strtotime($Req_Date));
			    //var_dump($data['admission_in_detail']);

			    $CX = 96;
			    $CY = 5;
			    $X = 3;
			    $Y = 68.5;

			    $r1 = 255;
			    $g1 = 255;
			    $b1 = 255;
			    $r2 = 226;
			    $g2 = 226;
			    $b2 = 226;


			    // Sr#
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',8);
			    if ($i % 2 == 0){
			    	$pdf->SetFillColor($r1,$g1,$b1);
			    }else {
					$pdf->SetFillColor($r2,$g2,$b2);
				}
			    $pdf->SetXY(191,$Y+($i*$CY));
			    $pdf->Cell(8, $CY,$i, $BBO, 0, 'C', 1);
			    // Date
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',8);
			    if ($i % 2 == 0){
			    	$pdf->SetFillColor($r1,$g1,$b1);
			    }else {
					$pdf->SetFillColor($r2,$g2,$b2);
				}
			    $pdf->SetXY(199,$Y+($i*$CY));
			    $pdf->Cell(21, $CY, $Req_Date, $BBO, 0, 'C', 1);
			    // GS-ID
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',8);
			    if ($i % 2 == 0){
			    	$pdf->SetFillColor($r1,$g1,$b1);
			    }else {
					$pdf->SetFillColor($r2,$g2,$b2);
				}
			    $pdf->SetXY(220,$Y+($i*$CY));
			    $pdf->Cell(13, $CY, $GS_ID, $BBO, 0, 'C', 1);
			    // Abridged Name
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',8);
			    if ($i % 2 == 0){
			    	$pdf->SetFillColor($r1,$g1,$b1);
			    }else {
					$pdf->SetFillColor($r2,$g2,$b2);
				}
			    $pdf->SetXY(233,$Y+($i*$CY));
			    $pdf->Cell(33, $CY, $Abridged_Name, $BBO, 0, 'L', 1);
			     // Grade & Section
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',8);
			    if ($i % 2 == 0){
			    	$pdf->SetFillColor($r1,$g1,$b1);
			    }else {
					$pdf->SetFillColor($r2,$g2,$b2);
				}
			    $pdf->SetXY(266,$Y+($i*$CY));
			    $pdf->Cell(13, $CY, $Grade_Name.'-'.$Section_Name, $BBO, 0, 'C', 1);
			     // Old House
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',8);
			    if ($i % 2 == 0){
			    	$pdf->SetFillColor($r1,$g1,$b1);
			    }else {
					$pdf->SetFillColor($r2,$g2,$b2);
				}
			    $pdf->SetXY(279,$Y+($i*$CY));
			    $pdf->Cell(8, $CY, $Old_House, $BBO, 0, 'C', 1);
			     // New House
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',8);
			    if ($i % 2 == 0){
			    	$pdf->SetFillColor($r1,$g1,$b1);
			    }else {
					$pdf->SetFillColor($r2,$g2,$b2);
				}
			    $pdf->SetXY(287,$Y+($i*$CY));
			    $pdf->Cell(8, $CY, $New_House, $BBO, 0, 'C', 1);

			    if ($i >= 7){
			    	$page_on = true;
			    }
			    
			    $i++;
			}
			/***** Detaintion *****/
			$i=1;
		    foreach(array_slice($data['Detain_detail'], 0, 7, False) as $detain_detail){
			    $Abridged_Name = $detain_detail['abridged_name'];
			    $Grade_Name = $detain_detail['grade_name'];
			    $Section_Name = $detain_detail['section_name'];
			    $GS_ID = $detain_detail['gs_id'];
			    $Previous = $detain_detail['previous_class'];

			    $Req_Date = date('d-M-Y',strtotime($Req_Date));
			    //var_dump($data['admission_in_detail']);

			    $CX = 96;
			    $CY = 5;
			    $X = 3;
			    $Y = 118;

			    $r1 = 255;
			    $g1 = 255;
			    $b1 = 255;
			    $r2 = 226;
			    $g2 = 226;
			    $b2 = 226;


			    // Sr#
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',8);
			    if ($i % 2 == 0){
			    	$pdf->SetFillColor($r1,$g1,$b1);
			    }else {
					$pdf->SetFillColor($r2,$g2,$b2);
				}
			    $pdf->SetXY(191,$Y+($i*$CY));
			    $pdf->Cell(8, $CY,$i, $BBO, 0, 'C', 1);
			    // GS-ID
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',8);
			    if ($i % 2 == 0){
			    	$pdf->SetFillColor($r1,$g1,$b1);
			    }else {
					$pdf->SetFillColor($r2,$g2,$b2);
				}
			    $pdf->SetXY(199,$Y+($i*$CY));
			    $pdf->Cell(13, $CY, $GS_ID, $BBO, 0, 'C', 1);
			    // Abridged Name
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',8);
			    if ($i % 2 == 0){
			    	$pdf->SetFillColor($r1,$g1,$b1);
			    }else {
					$pdf->SetFillColor($r2,$g2,$b2);
				}
			    $pdf->SetXY(212,$Y+($i*$CY));
			    $pdf->Cell(33, $CY, $Abridged_Name, $BBO, 0, 'L', 1);
			     // Previous Grade and Section
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',8);
			    if ($i % 2 == 0){
			    	$pdf->SetFillColor($r1,$g1,$b1);
			    }else {
					$pdf->SetFillColor($r2,$g2,$b2);
				}
			    $pdf->SetXY(270,$Y+($i*$CY));
			    $pdf->Cell(25, $CY, $Previous, $BBO, 0, 'C', 1);
			     // Grade & Section
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',8);
			    if ($i % 2 == 0){
			    	$pdf->SetFillColor($r1,$g1,$b1);
			    }else {
					$pdf->SetFillColor($r2,$g2,$b2);
				}
			    $pdf->SetXY(245,$Y+($i*$CY));
			    $pdf->Cell(25, $CY, $Grade_Name.'-'.$Section_Name, $BBO, 0, 'C', 1);

			    if ($i >= 7){
			    	$page_on = true;
			    }
			    		    
			    $i++;
			}

			/***** Active / Inactive *****/
			$i=1;
		    foreach(array_slice($data['active_inactive'], 0, 7, False) as $Active_Inactive){
			    $Abridged_Name = $Active_Inactive['abridged_name'];
			    $Grade_Name = $Active_Inactive['grade_name'];
			    $Section_Name = $Active_Inactive['section_name'];
			    $GS_ID = $Active_Inactive['gs_id'];
			    $Old_Status =$Active_Inactive['old'];
			    $New_Status = $Active_Inactive['new'];
			    

			    $Req_Date = date('d-M-Y',strtotime($Req_Date));
			    //var_dump($data['admission_in_detail']);

			    if ($Old_Status == 'Active') {
			    	$Old_Status ='A';
			    }else if ($Old_Status == 'Inactive') {
			    	$Old_Status = 'I';
			    }

			    if ($New_Status == 'Active') {
			    	$New_Status ='A';
			    }else if ($New_Status == 'Inactive') {
			    	$New_Status = 'I';
			    }

			    $CX = 96;
			    $CY = 5;
			    $X = 3;
			    $Y = 165.5;

			    $r1 = 255;
			    $g1 = 255;
			    $b1 = 255;
			    $r2 = 226;
			    $g2 = 226;
			    $b2 = 226;


			    // Sr#
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',8);
			    if ($i % 2 == 0){
			    	$pdf->SetFillColor($r1,$g1,$b1);
			    }else {
					$pdf->SetFillColor($r2,$g2,$b2);
				}
			    $pdf->SetXY(191,$Y+($i*$CY));
			    $pdf->Cell(8, $CY,$i, $BBO, 0, 'C', 1);
			    // Date
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',8);
			    if ($i % 2 == 0){
			    	$pdf->SetFillColor($r1,$g1,$b1);
			    }else {
					$pdf->SetFillColor($r2,$g2,$b2);
				}
			    $pdf->SetXY(199,$Y+($i*$CY));
			    $pdf->Cell(21, $CY, $Req_Date, $BBO, 0, 'C', 1);
			    // GS-ID
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',8);
			    if ($i % 2 == 0){
			    	$pdf->SetFillColor($r1,$g1,$b1);
			    }else {
					$pdf->SetFillColor($r2,$g2,$b2);
				}
			    $pdf->SetXY(220,$Y+($i*$CY));
			    $pdf->Cell(13, $CY, $GS_ID, $BBO, 0, 'C', 1);
			    // Abridged Name
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',8);
			    if ($i % 2 == 0){
			    	$pdf->SetFillColor($r1,$g1,$b1);
			    }else {
					$pdf->SetFillColor($r2,$g2,$b2);
				}
			    $pdf->SetXY(233,$Y+($i*$CY));
			    $pdf->Cell(33, $CY, $Abridged_Name, $BBO, 0, 'L', 1);
			     // Grade & Section
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',8);
			    if ($i % 2 == 0){
			    	$pdf->SetFillColor($r1,$g1,$b1);
			    }else {
					$pdf->SetFillColor($r2,$g2,$b2);
				}
			    $pdf->SetXY(266,$Y+($i*$CY));
			    $pdf->Cell(13, $CY, $Grade_Name.'-'.$Section_Name, $BBO, 0, 'C', 1);
			     // Old Status
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',8);
			    if ($i % 2 == 0){
			    	$pdf->SetFillColor($r1,$g1,$b1);
			    }else {
					$pdf->SetFillColor($r2,$g2,$b2);
				}
			    $pdf->SetXY(279,$Y+($i*$CY));
			    $pdf->Cell(8, $CY, $Old_Status, $BBO, 0, 'C', 1);
			     // New Status
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',8);
			    if ($i % 2 == 0){
			    	$pdf->SetFillColor($r1,$g1,$b1);
			    }else {
					$pdf->SetFillColor($r2,$g2,$b2);
				}
			    $pdf->SetXY(287,$Y+($i*$CY));
			    $pdf->Cell(8, $CY, $New_Status, $BBO, 0, 'C', 1);

			    if ($i >= 7){
			    	$page_on = true;
			    }
			    		    
			    $i++;
			}
		}
		// Output the new PDF
		$pdf->Output('SDS' . '(' . $now_date  . ')' . '.pdf', 'D');
		//$pdf->Output();

	}
}