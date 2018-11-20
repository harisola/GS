<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class School_attendance_snapshot extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		/*$dateRange = $_SERVER['REQUEST_URI'];
		$dateRange = substr($dateRange, strpos($dateRange, '?') + 4);
		$dateRange = urldecode($dateRange);
		$dateRange = json_decode($dateRange, true);
		$dateRangeFrom = $dateRange["start"];
		$dateRangeTo = $dateRange["end"];*/
		$this->load->view('school_wide_report/student_attendance_snapshot_view');
		$this->load->view('school_wide_report/student_strength_orb_footer');
	}	

	
	public function printForm2()
	{
		$now_date = date('l F d, Y');

		 //Set the Content Type
		header("Content-type: image/jpeg");
		// Create Image From Existing Template
	    $imgPath = 'Components/image/school_wide_report/student_attendance_snapshot.jpg';
	    $image = imagecreatefromjpeg($imgPath);
	    // Allocate A Color For The Text
	    $colorText = imagecolorallocate($image, 0, 0, 0);
	    // Set Path to Font File
  		$font_path = 'Components/image/font/calibri.ttf';




	    $this->load->model('school_wide_report/student_attendance_model');
		$data['strength_report'] = $this->student_attendance_model->getStudentGradeSectionSummary();
		$data['grade_strength_report'] = $this->student_attendance_model->getStudentGradeSummary();
		$data['wing_strength_report'] = $this->student_attendance_model->getStudentWingSummary();
		$data['campus_strength_report'] = $this->student_attendance_model->getStudentCampusSummary();


		$name = $data['strength_report'][0]['grade_name'];

		$sectionNames = array('G', 'S', 'C', 'P', 'R', 'W', 'E', 'L', 'K', 'M');
		$FontSize_data = 6;
		$SectionName = "";
		$GradeName = "";		
		$ScoreToday = "";		
		$TotalStd = "";		
		$TotalPresent = "";
		$TotalAbsent = "";
		$DayPass = "";
		$Late = "";
		$y = 0;
		



	    $string = $now_date;
	    $fontSize = 22;
	    $angle = 0;
	    $x = 50;
	    $y = 50;
	    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

	    /**************************************************************
		// Call School
		// Num of (Jinnah, Iqbal, Syed) and (Boys, Girls)
		//*************************************************************/
		$i=0;
		$xx = 110;
	    $fontSize = 23;
	    
		$TotalStd = $data['campus_strength_report'][0]['students'] + $data['campus_strength_report'][1]['students'];
		$TotalPresent = $data['campus_strength_report'][0]['present'] + $data['campus_strength_report'][1]['present'];
		$TotalAbsent = $data['campus_strength_report'][0]['students'] + $data['campus_strength_report'][1]['students'] - $data['campus_strength_report'][0]['present'] - $data['campus_strength_report'][1]['present'];
		$DayPass = $data['campus_strength_report'][0]['no_card'] + $data['campus_strength_report'][1]['no_card'];
		$Late = $data['campus_strength_report'][0]['late'] + $data['campus_strength_report'][1]['late'];
		$ScoreToday = "";
		$LRA = "";
		$LR = "";
		$IA = $data['campus_strength_report'][0]['inactive_student_status'] + $data['campus_strength_report'][1]['inactive_student_status'];

	    $yy = 782;
		$y_inner = 100;
		$x_inner_house = 81;
		$x_inner_gender = 80;

		// Jinnah, Iqbal, Syed
		$string = $TotalStd;			    
	    $angle = 0;
	    $x = $xx+($i*14.5);
	    $y = $yy;
		imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

	    $string = $TotalPresent;			    
	    $angle = 0;
	    $x = $xx+$x_inner_house+($i*14.5);
	    $y = $yy;
	    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

		$string = $TotalAbsent;			    
	    $angle = 0;
	    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
	    $y = $yy;
	    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


	    // Boy and Girl and LRA
	    $string = $DayPass;			    
	    $angle = 0;
	    $x = $xx;
	    $y = $yy + $y_inner;
	    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

	    $string = $Late;			    
	    $angle = 0;
	    $x = $xx+$x_inner_gender;
	    $y = $yy + $y_inner;
	    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
		  			
		$string = $LRA;			    
	    $angle = 0;
	    $x = $xx+$x_inner_gender+$x_inner_gender;
	    $y = $yy + $y_inner;
	    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
	    // Total Students
	    $string = $ScoreToday;			    
	    $angle = 0;
	    $x = $xx;
	    $y = $yy + $y_inner + $y_inner - 30;
	    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
		
		$string = $LR;			    
	    $angle = 0;
	    $x = $xx+$x_inner_gender;
	    $y = $yy + $y_inner + $y_inner - 30;
	    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
		
		$string = $IA;			    
	    $angle = 0;
	    $x = $xx+$x_inner_gender+$x_inner_gender;
	    $y = $yy + $y_inner + $y_inner + 2;
	    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

	    /**************************************************************
		// Call Campus
		// Num of (Jinnah, Iqbal, Syed) and (Boys, Girls)
		//*************************************************************/
		$i=0;
		$xx = 190;
	     $fontSize = 23; 	    
		foreach ($data['campus_strength_report'] as $strength_report) {	    			
			$GradeName = $strength_report['campus_name'];			
			$TotalStd = $strength_report['students'];
			$TotalPresent = $strength_report['present'];
			$TotalAbsent = $strength_report['students'] - $strength_report['present'];
			$DayPass = $strength_report['no_card'];
			$Late = $strength_report['late'];
			$ScoreToday = "";
			$IA = $strength_report['inactive_student_status'];

			// North Campus
			if($strength_report['campus_name'] == 'North Campus'){
				$yy = 390;
				$y_inner = 65;
				$x_inner_house = 80;
				$x_inner_gender = 100;

				// Jinnah, Iqbal, Syed
				$string = $TotalStd;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $TotalPresent;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				$string = $TotalAbsent;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


			    // Boy and Girl
			    $string = $DayPass;			    
			    $angle = 0;
			    $x = $xx;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Late;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
    			  			
				$string = $LRA;			    
				$angle = 0;
				$x = $xx+$x_inner_house+$x_inner_house;
				$y = $yy + $y_inner;
				imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			    // Total Students
			    $string = $ScoreToday;			    
			    $angle = 0;
			    $x = $xx;
			    $y = $yy + $y_inner + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				$string = $LR;			    
				$angle = 0;
				$x = $xx + $x_inner_house;
				$y = $yy + $y_inner + $y_inner;
				imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				$string = $IA;			    
				$angle = 0;
				$x = $xx + $x_inner_house + $x_inner_house;
				$y = $yy + $y_inner + $y_inner;
				imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			}else// South Campus
			if($strength_report['campus_name'] == 'South Campus'){
				$yy = 1215;
				$y_inner = 65;
				$x_inner_house = 80;
				$x_inner_gender = 100;

				// Jinnah, Iqbal, Syed
				$string = $TotalStd;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $TotalPresent;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				$string = $TotalAbsent;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


			    // Boy and Girl
			    $string = $DayPass;			    
			    $angle = 0;
			    $x = $xx;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Late;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
    			  			

			    $string = $LRA;			    
				$angle = 0;
				$x = $xx+$x_inner_house+$x_inner_house;
				$y = $yy + $y_inner;
				imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			    // Total Students
			    $string = $ScoreToday;			    
			    $angle = 0;
			    $x = $xx;
			    $y = $yy + $y_inner + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				$string = $LR;			    
				$angle = 0;
				$x = $xx+$x_inner_house;
				$y = $yy + $y_inner + $y_inner;
				imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				$string = $IA;			    
				$angle = 0;
				$x = $xx+$x_inner_house+$x_inner_house;
				$y = $yy + $y_inner + $y_inner + 2;
				imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			}
		}


	    /**************************************************************
		// Call Wing
		// Num of (Jinnah, Iqbal, Syed) and (Boys, Girls)
		//*************************************************************/
		$i=0;
		$xx = 520;
	    $fontSize = 22;	    
		foreach ($data['wing_strength_report'] as $strength_report) {	    			
			$GradeName = $strength_report['wing_name'];			
			$TotalStd = $strength_report['students'];
			$TotalPresent = $strength_report['present'];
			$TotalAbsent = $strength_report['students'] - $strength_report['present'];
			$DayPass = $strength_report['no_card'];
			$Late = $strength_report['late'];
			$ScoreToday = "";
			$IA = $strength_report['inactive_student_status'];

			// Pre-Primary
			if($strength_report['wing_name'] == 'Pre-Primary'){
				$yy = 305;
				$y_inner = 33;
				$x_inner_house = 68;
				$x_inner_gender = 100;

				// Jinnah, Iqbal, Syed
				$string = $TotalStd;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $TotalPresent;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				$string = $TotalAbsent;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


			    // Boy and Girl
			    $string = $DayPass;			    
			    $angle = 0;
			    $x = $xx;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Late;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*14.5);
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
    			  			

			    $string = $LRA;			    
				$angle = 0;
				$x = $xx+$x_inner_house+$x_inner_house;
				$y = $yy + $y_inner;
				imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			    // Total Students
			    $string = $ScoreToday;			    
			    $angle = 0;
			    $x = $xx;
			    $y = $yy + $y_inner + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				$string = $LR;			    
				$angle = 0;
				$x = $xx+$x_inner_house;
				$y = $yy + $y_inner + $y_inner;
				imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				$string = $IA;			    
				$angle = 0;
				$x = $xx+$x_inner_house+$x_inner_house;
				$y = $yy + $y_inner + $y_inner;
				imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			}else// Elementry
			if($strength_report['wing_name'] == 'Elementary'){
				$yy = 702;
				$y_inner = 33;
				$x_inner_house = 68;
				$x_inner_gender = 100;

				// Jinnah, Iqbal, Syed
				$string = $TotalStd;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


			    $string = $TotalPresent;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				$string = $TotalAbsent;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


			    // Boy and Girl
			    $string = $DayPass;			    
			    $angle = 0;
			    $x = $xx;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Late;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*14.5);
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
    			  			

			   $string = $LRA;			    
				$angle = 0;
				$x = $xx+$x_inner_house+$x_inner_house;
				$y = $yy + $y_inner;
				imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			    // Total Students
			    $string = $ScoreToday;			    
			    $angle = 0;
			    $x = $xx;
			    $y = $yy + $y_inner + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				$string = $LR;			    
				$angle = 0;
				$x = $xx+$x_inner_house;
				$y = $yy + $y_inner + $y_inner;
				imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				$string = $IA;			    
				$angle = 0;
				$x = $xx+$x_inner_house+$x_inner_house;
				$y = $yy + $y_inner + $y_inner;
				imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			}else// Junior
			if($strength_report['wing_name'] == 'Junior'){
				$yy = 1098;
				$y_inner = 33;
				$x_inner_house = 68;
				$x_inner_gender = 100;

				// Jinnah, Iqbal, Syed
				$string = $TotalStd;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $TotalPresent;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				$string = $TotalAbsent;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


			    // Boy and Girl
			    $string = $DayPass;			    
			    $angle = 0;
			    $x = $xx;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Late;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*14.5);
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
    			  			

			    $string = $LRA;			    
				$angle = 0;
				$x = $xx+$x_inner_house+$x_inner_house;
				$y = $yy + $y_inner;
				imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			    // Total Students
			    $string = $ScoreToday;			    
			    $angle = 0;
			    $x = $xx;
			    $y = $yy + $y_inner + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				$string = $LR;			    
				$angle = 0;
				$x = $xx+$x_inner_house;
				$y = $yy + $y_inner + $y_inner;
				imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				$string = $IA;			    
				$angle = 0;
				$x = $xx+$x_inner_house+$x_inner_house;
				$y = $yy + $y_inner + $y_inner;
				imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			}else// Middler
			if($strength_report['wing_name'] == 'Middler'){
				$yy = 1559;
				$y_inner = 33;
				$x_inner_house = 68;
				$x_inner_gender = 100;

				// Jinnah, Iqbal, Syed
				$string = $TotalStd;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $TotalPresent;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				$string = $TotalAbsent;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


			    // Boy and Girl
			    $string = $DayPass;			    
			    $angle = 0;
			    $x = $xx;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Late;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*14.5);
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
    			  			

			   $string = $LRA;			    
				$angle = 0;
				$x = $xx+$x_inner_house+$x_inner_house;
				$y = $yy + $y_inner;
				imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			    // Total Students
			    $string = $ScoreToday;			    
			    $angle = 0;
			    $x = $xx;
			    $y = $yy + $y_inner + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				$string = $LR;			    
				$angle = 0;
				$x = $xx+$x_inner_house;
				$y = $yy + $y_inner + $y_inner;
				imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				$string = $IA;			    
				$angle = 0;
				$x = $xx+$x_inner_house+$x_inner_house;
				$y = $yy + $y_inner + $y_inner;
				imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			}else// O-Level
			if($strength_report['wing_name'] == 'O-Level'){
				$yy = 1890;
				$y_inner = 33;
				$x_inner_house = 68;
				$x_inner_gender = 100;


				// Jinnah, Iqbal, Syed
				$string = $TotalStd;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $TotalPresent;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				$string = $TotalAbsent;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


			    // Boy and Girl
			    $string = $DayPass;			    
			    $angle = 0;
			    $x = $xx;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Late;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*14.5);
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
    			  			

			    $string = $LRA;			    
				$angle = 0;
				$x = $xx+$x_inner_house+$x_inner_house;
				$y = $yy + $y_inner;
				imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			    // Total Students
			    $string = $ScoreToday;			    
			    $angle = 0;
			    $x = $xx;
			    $y = $yy + $y_inner + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				$string = $LR;			    
				$angle = 0;
				$x = $xx+$x_inner_house;
				$y = $yy + $y_inner + $y_inner;
				imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				$string = $IA;			    
				$angle = 0;
				$x = $xx+$x_inner_house+$x_inner_house;
				$y = $yy + $y_inner + $y_inner;
				imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			}else// A-Level
			if($strength_report['wing_name'] == 'A-Level'){
				$yy = 2155;
				$y_inner = 33;
				$x_inner_house = 68;
				$x_inner_gender = 100;


				// Jinnah, Iqbal, Syed
				$string = $TotalStd;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $TotalPresent;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				$string = $TotalAbsent;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


			    // Boy and Girl
			    $string = $DayPass;			    
			    $angle = 0;
			    $x = $xx;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Late;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*14.5);
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
    			  			

			   $string = $LRA;			    
				$angle = 0;
				$x = $xx+$x_inner_house+$x_inner_house;
				$y = $yy + $y_inner;
				imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			    // Total Students
			    $string = $ScoreToday;			    
			    $angle = 0;
			    $x = $xx;
			    $y = $yy + $y_inner + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				$string = $LR;			    
				$angle = 0;
				$x = $xx+$x_inner_house;
				$y = $yy + $y_inner + $y_inner;
				imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				$string = $IA;			    
				$angle = 0;
				$x = $xx+$x_inner_house+$x_inner_house;
				$y = $yy + $y_inner + $y_inner;
				imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			}
		}

	    /**************************************************************
		// Call Grade
		// Num of (Jinnah, Iqbal, Syed) and (Boys, Girls)
		//*************************************************************/
		$i=0;
		$xx = 768;
	    $fontSize = 20;	    
		foreach ($data['grade_strength_report'] as $strength_report) {	    			
			$GradeName = $strength_report['grade_name'];			
			$TotalStd = $strength_report['students'];
			$TotalPresent = $strength_report['present'];
			$TotalAbsent = $strength_report['students'] - $strength_report['present'];
			$DayPass = $strength_report['no_card'];
			$Late = $strength_report['late'];
			$ScoreToday = "";
			$IA = $strength_report['inactive_student_status'];		

			// Pre-Nursery			
			if($strength_report['grade_name'] == 'PN'){				
				$yy = 172;
				$y_inner = 33;
				$x_inner_house = 60;
				$x_inner_gender = 75;

				// Jinnah, Iqbal, Syed
				$string = $TotalStd;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $TotalPresent;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				$string = $TotalAbsent;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


			    // Boy and Girl
			    $string = $DayPass;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Late;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*14.5);
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
    			  			
				$string = $LRA;			    
				$angle = 0;
				$x = $xx+$x_inner_house+$x_inner_house;
				$y = $yy + $y_inner;
				imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			    // Total Students
			    $string = $ScoreToday;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy + $y_inner + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				$string = $LR;			    
				$angle = 0;
				$x = $xx+$x_inner_house;
				$y = $yy + $y_inner + $y_inner;
				imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				$string = $IA;			    
				$angle = 0;
				$x = $xx+$x_inner_house+$x_inner_house;
				$y = $yy + $y_inner + $y_inner;
				imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			}else // Nursery
			if($strength_report['grade_name'] == 'N'){
				$yy = 304;
				$y_inner = 33;
				$x_inner_house = 60;
				$x_inner_gender = 75;


				// Jinnah, Iqbal, Syed
				$string = $TotalStd;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $TotalPresent;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				$string = $TotalAbsent;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


			    // Boy and Girl
			    $string = $DayPass;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Late;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*14.5);
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
    			  			

			    $string = $LRA;			    
				$angle = 0;
				$x = $xx+$x_inner_house+$x_inner_house;
				$y = $yy + $y_inner;
				imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			    // Total Students
			    $string = $ScoreToday;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy + $y_inner + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				$string = $LR;			    
				$angle = 0;
				$x = $xx+$x_inner_house;
				$y = $yy + $y_inner + $y_inner;
				imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				$string = $IA;			    
				$angle = 0;
				$x = $xx+$x_inner_house+$x_inner_house;
				$y = $yy + $y_inner + $y_inner;
				imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			}else // KG
			if($strength_report['grade_name'] == 'KG'){
				$yy = 436;
				$y_inner = 33;
				$x_inner_house = 60;
				$x_inner_gender = 75;

				// Jinnah, Iqbal, Syed
				$string = $TotalStd;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $TotalPresent;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				$string = $TotalAbsent;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


			    // Boy and Girl
			    $string = $DayPass;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Late;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*14.5);
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
    			  			

			    $string = $LRA;			    
				$angle = 0;
				$x = $xx+$x_inner_house+$x_inner_house;
				$y = $yy + $y_inner;
				imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			    // Total Students
			    $string = $ScoreToday;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy + $y_inner + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				$string = $LR;			    
				$angle = 0;
				$x = $xx+$x_inner_house;
				$y = $yy + $y_inner + $y_inner;
				imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				$string = $IA;			    
				$angle = 0;
				$x = $xx+$x_inner_house+$x_inner_house;
				$y = $yy + $y_inner + $y_inner;
				imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			}else // I
			if($strength_report['grade_name'] == 'I'){
				$yy = 635;
				$y_inner = 33;
				$x_inner_house = 60;
				$x_inner_gender = 75;

				// Jinnah, Iqbal, Syed
				$string = $TotalStd;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $TotalPresent;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				$string = $TotalAbsent;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


			    // Boy and Girl
			    $string = $DayPass;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Late;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*14.5);
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
    			  			

			    $string = $LRA;			    
				$angle = 0;
				$x = $xx+$x_inner_house+$x_inner_house;
				$y = $yy + $y_inner;
				imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			    // Total Students
			    $string = $ScoreToday;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy + $y_inner + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				$string = $LR;			    
				$angle = 0;
				$x = $xx+$x_inner_house;
				$y = $yy + $y_inner + $y_inner;
				imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				$string = $IA;			    
				$angle = 0;
				$x = $xx+$x_inner_house+$x_inner_house;
				$y = $yy + $y_inner + $y_inner;
				imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			}else {
				// II			
				$yy = $yy + 132;
				$y_inner = 33;
				$x_inner_house = 60;
				$x_inner_gender = 75;

				// Jinnah, Iqbal, Syed
				$string = $TotalStd;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $TotalPresent;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				$string = $TotalAbsent;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


			    // Boy and Girl
			    $string = $DayPass;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Late;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*14.5);
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
    			  			

			   $string = $LRA;			    
				$angle = 0;
				$x = $xx+$x_inner_house+$x_inner_house;
				$y = $yy + $y_inner;
				imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			    // Total Students
			    $string = $ScoreToday;			    
			    $angle = 0;
			    $x = $xx+($i*14.5);
			    $y = $yy + $y_inner + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				$string = $LR;			    
				$angle = 0;
				$x = $xx+$x_inner_house;
				$y = $yy + $y_inner + $y_inner;
				imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				
				$string = $IA;			    
				$angle = 0;
				$x = $xx+$x_inner_house+$x_inner_house;
				$y = $yy + $y_inner + $y_inner;
				imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			}
		}



	    /**************************************************************
		// Call Grade-Section
		// Num of (Jinnah, Iqbal, Syed) and (Boys, Girls)
		//*************************************************************/
	    $i=0;
	    $fontSize = 20;
		foreach ($data['strength_report'] as $strength_report) {	    			
			$GradeName = $strength_report['grade_name'];
			$SectionName = $strength_report['section_name'];
			$TotalStd = $strength_report['students'];
			$TotalPresent = $strength_report['present'];
			$TotalAbsent = $strength_report['students'] - $strength_report['present'];
			$DayPass = $strength_report['no_card'];
			$Late = $strength_report['late'];
			$ScoreToday = "";
			$IA = $strength_report['inactive_student_status'];
			

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
				if($strength_report['section_name'] != 'Bin'){
					$xx = 1042 + ($i*175);
					$yy = 172;

					$y_inner = 33;
					$x_inner_house = 60;
					$x_inner_gender = 65;
					$x_inner_score = 0;

					// Jinnah, Iqbal, Syed
					$string = $TotalStd;			    
				    $angle = 0;
				    $x = $xx+($i*14.5);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $TotalPresent;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($i*14.5);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

					$string = $TotalAbsent;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);    			


				    // Boy and Girl
				    $string = $DayPass;			    
				    $angle = 0;
				    $x = $xx+($i*14.5);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  				

				    $string = $Late;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($i*14.5);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
	    			  			
					$string = $LRA;			    
					$angle = 0;
					$x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
					$y = $yy + $y_inner;
					imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				    // Total Students
				    $string = $ScoreToday;			    
				    $angle = 0;
				    $x = $xx+($i*14.5);
				    $y = $yy + $y_inner + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);   
					
					$string = $LR;			    
					$angle = 0;
					$x = $xx+$x_inner_house+($i*14.5);
					$y = $yy + $y_inner + $y_inner;
					imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
					
					$string = $IA;			    
					$angle = 0;
					$x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
					$y = $yy + $y_inner + $y_inner;
					imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				}
			}else // Nursery			
			if($strength_report['grade_name'] == 'N'){
				if($strength_report['section_name'] != 'Bin'){
					$xx = 1042 + ($i*175);

					$yy = 307;
					$y_inner = 33;
					$x_inner_house = 60;
					$x_inner_gender = 65;
					$x_inner_score = 0;

					// Jinnah, Iqbal, Syed
					$string = $TotalStd;			    
				    $angle = 0;
				    $x = $xx+($i*14.5);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $TotalPresent;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($i*14.5);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

					$string = $TotalAbsent;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);    			


				    // Boy and Girl
				    $string = $DayPass;			    
				    $angle = 0;
				    $x = $xx+($i*14.5);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  				

				    $string = $Late;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($i*14.5);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
	    			  			
					$string = $LRA;			    
					$angle = 0;
					$x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
					$y = $yy + $y_inner;
					imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				    // Total Students
				    $string = $ScoreToday;			    
				    $angle = 0;
					 $x = $xx+($i*14.5);
				    //$x = $xx+47+($i*14.5);
				    $y = $yy + $y_inner + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);       
					
					$string = $LR;			    
					$angle = 0;
					$x = $xx+$x_inner_house+($i*14.5);
					$y = $yy + $y_inner + $y_inner;
					imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
					
					$string = $IA;			    
					$angle = 0;
					$x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
					$y = $yy + $y_inner + $y_inner;
					imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string); 		
				}			    			
			}else // KG			
			if($strength_report['grade_name'] == 'KG'){
				if($strength_report['section_name'] != 'Bin'){
					$xx = 1042 + ($i*175);

					$yy = 438;
					$y_inner = 33;
					$x_inner_house = 60;
					$x_inner_gender = 65;
					$x_inner_score = 0;
					
					// Jinnah, Iqbal, Syed
					$string = $TotalStd;			    
				    $angle = 0;
				    $x = $xx+($i*14.5);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $TotalPresent;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($i*14.5);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

					$string = $TotalAbsent;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);    			


				    // Boy and Girl
				    $string = $DayPass;			    
				    $angle = 0;
				    $x = $xx+($i*14.5);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  				

				    $string = $Late;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($i*14.5);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
	    			  			

				   $string = $LRA;			    
					$angle = 0;
					$x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
					$y = $yy + $y_inner;
					imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				    // Total Students
				    $string = $ScoreToday;			    
				    $angle = 0;
					 $x = $xx+($i*14.5);
				    //$x = $xx+47+($i*14.5);
				    $y = $yy + $y_inner + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);       
					
					$string = $LR;			    
					$angle = 0;
					$x = $xx+$x_inner_house+($i*14.5);
					$y = $yy + $y_inner + $y_inner;
					imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
					
					$string = $IA;			    
					$angle = 0;
					$x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
					$y = $yy + $y_inner + $y_inner;
					imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				}
			}else // I			
			if($strength_report['grade_name'] == 'I'){
				if($strength_report['section_name'] != 'Bin'){
					$xx = 1042 + ($i*175);

					$yy = 634;
					$y_inner = 33;
					$x_inner_house = 60;
					$x_inner_gender = 65;
					$x_inner_score = 0;
					

					// Jinnah, Iqbal, Syed
					$string = $TotalStd;			    
				    $angle = 0;
				    $x = $xx+($i*14.5);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $TotalPresent;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($i*14.5);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

					$string = $TotalAbsent;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);    			


				    // Boy and Girl
				    $string = $DayPass;			    
				    $angle = 0;
				    $x = $xx+($i*14.5);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  				

				    $string = $Late;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($i*14.5);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
	    			  			

				   $string = $LRA;			    
					$angle = 0;
					$x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
					$y = $yy + $y_inner;
					imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				    // Total Students
				    $string = $ScoreToday;			    
				    $angle = 0;
					 $x = $xx+($i*14.5);
				    //$x = $xx+47+($i*14.5);
				    $y = $yy + $y_inner + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);       
					
					$string = $LR;			    
					$angle = 0;
					$x = $xx+$x_inner_house+($i*14.5);
					$y = $yy + $y_inner + $y_inner;
					imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
					
					$string = $IA;			    
					$angle = 0;
					$x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
					$y = $yy + $y_inner + $y_inner;
					imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				}   			
			}else // II
			if($strength_report['grade_name'] == 'II'){
				if($strength_report['section_name'] != 'Bin'){
					$xx = 1042 + ($i*175);

					$yy = 768;
					$y_inner = 33;
					$x_inner_house = 60;
					$x_inner_gender = 65;
					$x_inner_score = 0;

					// Jinnah, Iqbal, Syed
					$string = $TotalStd;			    
				    $angle = 0;
				    $x = $xx+($i*14.5);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $TotalPresent;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($i*14.5);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

					$string = $TotalAbsent;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5)+5;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);    			


				    // Boy and Girl
				    $string = $DayPass;			    
				    $angle = 0;
				    $x = $xx+($i*14.5);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  				

				    $string = $Late;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($i*14.5);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
	    			  			

				   $string = $LRA;			    
					$angle = 0;
					$x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
					$y = $yy + $y_inner;
					imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				    // Total Students
				    $string = $ScoreToday;			    
				    $angle = 0;
					 $x = $xx+($i*14.5);
				    //$x = $xx+47+($i*14.5);
				    $y = $yy + $y_inner + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);       
					
					$string = $LR;			    
					$angle = 0;
					$x = $xx+$x_inner_house+($i*14.5);
					$y = $yy + $y_inner + $y_inner;
					imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
					
					$string = $IA;			    
					$angle = 0;
					$x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
					$y = $yy + $y_inner + $y_inner;
					imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				}     			
			}else // III
			if($strength_report['grade_name'] == 'III'){
				if($strength_report['section_name'] != 'Bin'){
					$xx = 1042 + ($i*175);

					$yy = 900;
					$y_inner = 33;
					$x_inner_house = 60;
					$x_inner_gender = 65;
					$x_inner_score = 0;

					// Jinnah, Iqbal, Syed
					$string = $TotalStd;			    
				    $angle = 0;
				    $x = $xx+($i*14.5);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $TotalPresent;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($i*14.5);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

					$string = $TotalAbsent;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);    			


				    // Boy and Girl
				    $string = $DayPass;			    
				    $angle = 0;
				    $x = $xx+($i*14.5);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  				

				    $string = $Late;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($i*14.5);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
	    			  			

				    $string = $LRA;			    
					$angle = 0;
					$x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
					$y = $yy + $y_inner;
					imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				    // Total Students
				    $string = $ScoreToday;			    
				    $angle = 0;
					 $x = $xx+($i*14.5);
				    //$x = $xx+47+($i*14.5);
				    $y = $yy + $y_inner + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);       
					
					$string = $LR;			    
					$angle = 0;
					$x = $xx+$x_inner_house+($i*14.5);
					$y = $yy + $y_inner + $y_inner;
					imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
					
					$string = $IA;			    
					$angle = 0;
					$x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
					$y = $yy + $y_inner + $y_inner;
					imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				}     			
			}else // IV
			if($strength_report['grade_name'] == 'IV'){
				if($strength_report['section_name'] != 'Bin'){
					$xx = 1042 + ($i*175);

					$yy = 1032;
					$y_inner = 33;
					$x_inner_house = 60;
					$x_inner_gender = 65;
					$x_inner_score = 0;

					// Jinnah, Iqbal, Syed
					$string = $TotalStd;			    
				    $angle = 0;
				    $x = $xx+($i*14.5);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $TotalPresent;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($i*14.5);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

					$string = $TotalAbsent;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);    			


				    // Boy and Girl
				    $string = $DayPass;			    
				    $angle = 0;
				    $x = $xx+($i*14.5);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  				

				    $string = $Late;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($i*14.5);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
	    			  			

				   $string = $LRA;			    
					$angle = 0;
					$x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
					$y = $yy + $y_inner;
					imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				    // Total Students
				    $string = $ScoreToday;			    
				    $angle = 0;
					 $x = $xx+($i*14.5);
				    //$x = $xx+47+($i*14.5);
				    $y = $yy + $y_inner + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);       
					
					$string = $LR;			    
					$angle = 0;
					$x = $xx+$x_inner_house+($i*14.5);
					$y = $yy + $y_inner + $y_inner;
					imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
					
					$string = $IA;			    
					$angle = 0;
					$x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
					$y = $yy + $y_inner + $y_inner;
					imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				}	    			
			}else // V
			if($strength_report['grade_name'] == 'V'){
				if($strength_report['section_name'] != 'Bin'){
					$xx = 1042 + ($i*175);

					$yy = 1164;
					$y_inner = 33;
					$x_inner_house = 60;
					$x_inner_gender = 65;
					$x_inner_score = 0;

					// Jinnah, Iqbal, Syed
					$string = $TotalStd;			    
				    $angle = 0;
				    $x = $xx+($i*14.5);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $TotalPresent;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($i*14.5);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

					$string = $TotalAbsent;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);    			


				    // Boy and Girl
				    $string = $DayPass;			    
				    $angle = 0;
				    $x = $xx+($i*14.5);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  				

				    $string = $Late;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($i*14.5);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
	    			  			

				    $string = $LRA;			    
					$angle = 0;
					$x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
					$y = $yy + $y_inner;
					imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				    // Total Students
				    $string = $ScoreToday;			    
				    $angle = 0;
					 $x = $xx+($i*14.5);
				    //$x = $xx+47+($i*14.5);
				    $y = $yy + $y_inner + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);       
					
					$string = $LR;			    
					$angle = 0;
					$x = $xx+$x_inner_house+($i*14.5);
					$y = $yy + $y_inner + $y_inner;
					imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
					
					$string = $IA;			    
					$angle = 0;
					$x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
					$y = $yy + $y_inner + $y_inner;
					imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				}	    			
			}else // VI
			if($strength_report['grade_name'] == 'VI'){
				if($strength_report['section_name'] != 'Bin'){
					$xx = 1042 + ($i*175);

					$yy = 1298;
					$y_inner = 33;
					$x_inner_house = 60;
					$x_inner_gender = 65;
					$x_inner_score = 0;

					// Jinnah, Iqbal, Syed
					$string = $TotalStd;			    
				    $angle = 0;
				    $x = $xx+($i*14.5);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $TotalPresent;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($i*14.5);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

					$string = $TotalAbsent;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);    			


				    // Boy and Girl
				    $string = $DayPass;			    
				    $angle = 0;
				    $x = $xx+($i*14.5);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  				

				    $string = $Late;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($i*14.5);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
	    			  			

				    $string = $LRA;			    
					$angle = 0;
					$x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
					$y = $yy + $y_inner;
					imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				    // Total Students
				    $string = $ScoreToday;			    
				    $angle = 0;
					 $x = $xx+($i*14.5);
				    //$x = $xx+47+($i*14.5);
				    $y = $yy + $y_inner + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);       
					
					$string = $LR;			    
					$angle = 0;
					$x = $xx+$x_inner_house+($i*14.5);
					$y = $yy + $y_inner + $y_inner;
					imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
					
					$string = $IA;			    
					$angle = 0;
					$x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
					$y = $yy + $y_inner + $y_inner;
					imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				}  			
			}else // VII
			if($strength_report['grade_name'] == 'VII'){
				if($strength_report['section_name'] != 'Bin'){
					$xx = 1042 + ($i*175);

					$yy = 1428;
					$y_inner = 33;
					$x_inner_house = 60;
					$x_inner_gender = 65;
					$x_inner_score = 0;

					// Jinnah, Iqbal, Syed
					$string = $TotalStd;			    
				    $angle = 0;
				    $x = $xx+($i*14.5);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $TotalPresent;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($i*14.5);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

					$string = $TotalAbsent;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);    			


				    // Boy and Girl
				    $string = $DayPass;			    
				    $angle = 0;
				    $x = $xx+($i*14.5);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  				

				    $string = $Late;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($i*14.5);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
	    			  			

				   $string = $LRA;			    
					$angle = 0;
					$x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
					$y = $yy + $y_inner;
					imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				    // Total Students
				    $string = $ScoreToday;			    
				    $angle = 0;
					 $x = $xx+($i*14.5);
				    //$x = $xx+47+($i*14.5);
				    $y = $yy + $y_inner + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);       
					
					$string = $LR;			    
					$angle = 0;
					$x = $xx+$x_inner_house+($i*14.5);
					$y = $yy + $y_inner + $y_inner;
					imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
					
					$string = $IA;			    
					$angle = 0;
					$x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
					$y = $yy + $y_inner + $y_inner;
					imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string); 
				}    			
			}else // VIII
			if($strength_report['grade_name'] == 'VIII'){
				if($strength_report['section_name'] != 'Bin'){
					$xx = 1042 + ($i*175);

					$yy = 1560;
					$y_inner = 33;
					$x_inner_house = 60;
					$x_inner_gender = 65;
					$x_inner_score = 0;

					// Jinnah, Iqbal, Syed
					$string = $TotalStd;			    
				    $angle = 0;
				    $x = $xx+($i*14.5);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $TotalPresent;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($i*14.5);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

					$string = $TotalAbsent;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);    			


				    // Boy and Girl
				    $string = $DayPass;			    
				    $angle = 0;
				    $x = $xx+($i*14.5);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  				

				    $string = $Late;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($i*14.5);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
	    			  			

				   $string = $LRA;			    
					$angle = 0;
					$x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
					$y = $yy + $y_inner;
					imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				    // Total Students
				    $string = $ScoreToday;			    
				    $angle = 0;
					 $x = $xx+($i*14.5);
				    //$x = $xx+47+($i*14.5);
				    $y = $yy + $y_inner + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);       
					
					$string = $LR;			    
					$angle = 0;
					$x = $xx+$x_inner_house+($i*14.5);
					$y = $yy + $y_inner + $y_inner;
					imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
					
					$string = $IA;			    
					$angle = 0;
					$x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
					$y = $yy + $y_inner + $y_inner;
					imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				}     			
			}else // IX
			if($strength_report['grade_name'] == 'IX'){
				if($strength_report['section_name'] != 'Bin'){
					$xx = 1042 + ($i*175);

					$yy = 1692;
					$y_inner = 33;
					$x_inner_house = 60;
					$x_inner_gender = 65;
					$x_inner_score = 0;

					// Jinnah, Iqbal, Syed
					$string = $TotalStd;			    
				    $angle = 0;
				    $x = $xx+($i*14.5);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $TotalPresent;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($i*14.5);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

					$string = $TotalAbsent;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);    			


				    // Boy and Girl
				    $string = $DayPass;			    
				    $angle = 0;
				    $x = $xx+($i*14.5);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  				

				    $string = $Late;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($i*14.5);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
	    			  			

				   $string = $LRA;			    
					$angle = 0;
					$x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
					$y = $yy + $y_inner;
					imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				    // Total Students
				    $string = $ScoreToday;			    
				    $angle = 0;
					 $x = $xx+($i*14.5);
				    //$x = $xx+47+($i*14.5);
				    $y = $yy + $y_inner + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);       
					
					$string = $LR;			    
					$angle = 0;
					$x = $xx+$x_inner_house+($i*14.5);
					$y = $yy + $y_inner + $y_inner;
					imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
					
					$string = $IA;			    
					$angle = 0;
					$x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
					$y = $yy + $y_inner + $y_inner;
					imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				}	     			
			}else // X
			if($strength_report['grade_name'] == 'X'){
				if($strength_report['section_name'] != 'Bin'){
					$xx = 1042 + ($i*175);

					$yy = 1824;
					$y_inner = 33;
					$x_inner_house = 60;
					$x_inner_gender = 65;
					$x_inner_score = 0;

					// Jinnah, Iqbal, Syed
					$string = $TotalStd;			    
				    $angle = 0;
				    $x = $xx+($i*14.5);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $TotalPresent;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($i*14.5);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

					$string = $TotalAbsent;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);    			


				    // Boy and Girl
				    $string = $DayPass;			    
				    $angle = 0;
				    $x = $xx+($i*14.5);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  				

				    $string = $Late;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($i*14.5);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
	    			  			

				    $string = $LRA;			    
					$angle = 0;
					$x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
					$y = $yy + $y_inner;
					imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				    // Total Students
				    $string = $ScoreToday;			    
				    $angle = 0;
					 $x = $xx+($i*14.5);
				    //$x = $xx+47+($i*14.5);
				    $y = $yy + $y_inner + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);       
					
					$string = $LR;			    
					$angle = 0;
					$x = $xx+$x_inner_house+($i*14.5);
					$y = $yy + $y_inner + $y_inner;
					imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
					
					$string = $IA;			    
					$angle = 0;
					$x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
					$y = $yy + $y_inner + $y_inner;
					imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string); 
				}   			
			}else // XI
			if($strength_report['grade_name'] == 'XI'){
				if($strength_report['section_name'] != 'Bin'){
					$xx = 1042 + ($i*175);

					$yy = 1958;
					$y_inner = 33;
					$x_inner_house = 60;
					$x_inner_gender = 65;
					$x_inner_score = 0;

					// Jinnah, Iqbal, Syed
					$string = $TotalStd;			    
				    $angle = 0;
				    $x = $xx+($i*14.5);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $TotalPresent;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($i*14.5);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

					$string = $TotalAbsent;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);    			


				    // Boy and Girl
				    $string = $DayPass;			    
				    $angle = 0;
				    $x = $xx+($i*14.5);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  				

				    $string = $Late;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($i*14.5);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
	    			  			

				   $string = $LRA;			    
					$angle = 0;
					$x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
					$y = $yy + $y_inner;
					imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				    // Total Students
				    $string = $ScoreToday;			    
				    $angle = 0;
					 $x = $xx+($i*14.5);
				    //$x = $xx+47+($i*14.5);
				    $y = $yy + $y_inner + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);       
					
					$string = $LR;			    
					$angle = 0;
					$x = $xx+$x_inner_house+($i*14.5);
					$y = $yy + $y_inner + $y_inner;
					imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
					
					$string = $IA;			    
					$angle = 0;
					$x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
					$y = $yy + $y_inner + $y_inner;
					imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				}     			
			}else // A1
			if($strength_report['grade_name'] == 'A1'){
				if($strength_report['section_name'] != 'Bin'){
					$xx = 1042 + ($i*175);

					$yy = 2088;
					$y_inner = 33;
					$x_inner_house = 60;
					$x_inner_gender = 65;
					$x_inner_score = 0;

					// Jinnah, Iqbal, Syed
					$string = $TotalStd;			    
				    $angle = 0;
				    $x = $xx+($i*14.5);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $TotalPresent;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($i*14.5);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

					$string = $TotalAbsent;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);    			


				    // Boy and Girl
				    $string = $DayPass;			    
				    $angle = 0;
				    $x = $xx+($i*14.5);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  				

				    $string = $Late;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($i*14.5);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
	    			  			

				    $string = $LRA;			    
					$angle = 0;
					$x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
					$y = $yy + $y_inner;
					imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				    // Total Students
				    $string = $ScoreToday;			    
				    $angle = 0;
					 $x = $xx+($i*14.5);
				    //$x = $xx+47+($i*14.5);
				    $y = $yy + $y_inner + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);       
					
					$string = $LR;			    
					$angle = 0;
					$x = $xx+$x_inner_house+($i*14.5);
					$y = $yy + $y_inner + $y_inner;
					imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
					
					$string = $IA;			    
					$angle = 0;
					$x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
					$y = $yy + $y_inner + $y_inner;
					imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				}	    			
			}else // A2
			if($strength_report['grade_name'] == 'A2'){
				if($strength_report['section_name'] != 'Bin'){
					$xx = 1042 + ($i*175);

					$yy = 2222;
					$y_inner = 33;
					$x_inner_house = 60;
					$x_inner_gender = 65;
					$x_inner_score = 0;

					// Jinnah, Iqbal, Syed
					$string = $TotalStd;			    
				    $angle = 0;
				    $x = $xx+($i*14.5);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $TotalPresent;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($i*14.5);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

					$string = $TotalAbsent;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);    			


				    // Boy and Girl
				    $string = $DayPass;			    
				    $angle = 0;
				    $x = $xx+($i*14.5);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);  				

				    $string = $Late;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($i*14.5);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
	    			  			

				    $string = $LRA;			    
					$angle = 0;
					$x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
					$y = $yy + $y_inner;
					imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				    // Total Students
				    $string = $ScoreToday;			    
				    $angle = 0;
					 $x = $xx+($i*14.5);
				    //$x = $xx+47+($i*14.5);
				    $y = $yy + $y_inner + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);       
					
					$string = $LR;			    
					$angle = 0;
					$x = $xx+$x_inner_house+($i*14.5);
					$y = $yy + $y_inner + $y_inner;
					imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
					
					$string = $IA;			    
					$angle = 0;
					$x = $xx+$x_inner_house+$x_inner_house+($i*14.5);
					$y = $yy + $y_inner + $y_inner;
					imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
				}	    			
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
		$dateRangeFrom = "";
		if(count($_POST))
		{
			$dateRange = $this->input->post('e2');
			$dateRange = json_decode($dateRange, true);
			$dateRangeFrom = $dateRange["start"];
			$dateRangeTo = $dateRange["end"];
		}

		$this->getPDFNow($dateRangeFrom);
	}


	public function getPDFNow($dateRangeFrom)
	{	
		if($dateRangeFrom == ""){
			$now_date = date('d-M-Y');
			$this->load->model('school_wide_report/student_attendance_model');
			$data['strength_report'] = $this->student_attendance_model->getStudentGradeSectionSummary();
			$data['grade_strength_report'] = $this->student_attendance_model->getStudentGradeSummary();
			$data['wing_strength_report'] = $this->student_attendance_model->getStudentWingSummary();
			$data['campus_strength_report'] = $this->student_attendance_model->getStudentCampusSummary();
		}else{
			$now_date = $dateRangeFrom;
			$this->load->model('school_wide_report/student_attendance_model');
			$data['strength_report'] = $this->student_attendance_model->getStudentGradeSectionSummary_date($now_date);
			$data['grade_strength_report'] = $this->student_attendance_model->getStudentGradeSummary_date($now_date);
			$data['wing_strength_report'] = $this->student_attendance_model->getStudentWingSummary_date($now_date);
			$data['campus_strength_report'] = $this->student_attendance_model->getStudentCampusSummary_date($now_date);
			$now_date = date("l d-M-Y", strtotime($now_date));
		}	


		$name = $data['strength_report'][0]['grade_name'];

		$sectionNames = array('G', 'S', 'C', 'P', 'R', 'W', 'E', 'L', 'K', 'M');
		$FontSize_data = 6;
		$SectionName = "";
		$GradeName = "";		
		$ScoreToday = "";		
		$TotalStd = "";		
		$TotalPresent = "";
		$TotalAbsent = "";
		$DayPass = "";
		$Late = "";
		$y = 0;
			


		// Overall Font Size
		$font_size = 10;
		$font_name = 'Helvetica';
		$gender_mark_size = 26;		

		require_once('components/pdf/fpdf/fpdf.php');
		require_once('components/pdf/fpdi/fpdi.php');

		
		// initiate FPDI
		$pdf = new FPDI();

		// get the page count
		$pageCount = $pdf->setSourceFile('components/pdf/school/school_wide_report/student_attendance_snapshot.pdf');
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

	    		$pdf->SetMargins(0,0,0);
	    		$pdf->SetAutoPageBreak(0,0);

	    		$bo = 0;
	    		$now_date =  date("l F d, Y", strtotime($now_date));

	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',16);
			    $pdf->SetFillColor(255,255,255);
			    $pdf->SetDrawColor(255,0,0);
			    $pdf->SetXY(93.6,9);
			    $pdf->Cell(173, 5, $now_date, $bo, 0, 'C', 0);

			    $pdf->SetTextColor(255,255,255);
			    $pdf->SetFont($font_name,'',6.5);
			    $pdf->SetFillColor(0,0,0);
			    $pdf->SetXY(229.5, 211);
			    $pdf->Cell(47, 2.5, date('D-d-M-Y H:i') . ' (' . ucwords($this->data['staff_registered_data'][0]->abridged_name) . ')', 0, 0, 'C', true);
			    //$pdf->Write(6, date('d-M-Y H:i:s'));
			    $pdf->SetTextColor(0,0,0);

			    


			    /**************************************************************
				* Call School
				* Num of (Total, Present, Absent, NoCard, Late, LRA, Score1, Score10, Inactive) 
				/*************************************************************/
				$Total = $data['campus_strength_report'][0]['students'] + $data['campus_strength_report'][1]['students'];
				$Present = $data['campus_strength_report'][0]['present'] + $data['campus_strength_report'][1]['present'];
				$Absent = $data['campus_strength_report'][0]['students'] + $data['campus_strength_report'][1]['students'] - $data['campus_strength_report'][0]['present'] - $data['campus_strength_report'][1]['present'];
				$NoCard = $data['campus_strength_report'][0]['no_card'] + $data['campus_strength_report'][1]['no_card'];
				$Late = $data['campus_strength_report'][0]['late'] + $data['campus_strength_report'][1]['late'];
				$LRA = "";				
				$Score10 = "";
				$Inactive = $data['campus_strength_report'][0]['inactive_student_status'] + $data['campus_strength_report'][1]['inactive_student_status'];
				$ScoreToday = 10-(($Absent*2)+($DayPass*1)+($Late*1));
				if($ScoreToday < 0) {
					$ScoreToday = "--";
				}

				$X = 12;
				$Y = 72.8;
				$CX = 7;
				$CY = 6;
				$Gap = 2.7;
				// Total, Present, Absent
				$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',7);
			    $pdf->SetFillColor(255,255,255);
			    $pdf->SetDrawColor(255,0,0);
			    $pdf->SetXY($X,$Y);
			    $pdf->Cell($CX, $CY, $Total, $bo, 0, 'C', 0);

			    
    			$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',7);
			    $pdf->SetFillColor(255,255,255);
			    $pdf->SetDrawColor(255,0,0);
			    $pdf->SetXY($X+$CX,$Y);
			    $pdf->Cell($CX, $CY, $Present, $bo, 0, 'C', 0);

			    
    			$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',7);
			    $pdf->SetFillColor(255,255,255);
			    $pdf->SetDrawColor(255,0,0);
			    $pdf->SetXY($X+$CX+$CX,$Y);
			    $pdf->Cell($CX, $CY, $Absent, $bo, 0, 'C', 0);

			    // NoCard, Late, LRA
				$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',7);
			    $pdf->SetFillColor(255,255,255);
			    $pdf->SetDrawColor(255,0,0);
			    $pdf->SetXY($X,$Y+$CY+$Gap);
			    $pdf->Cell($CX, $CY, $NoCard, $bo, 0, 'C', 0);

			    
    			$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',7);
			    $pdf->SetFillColor(255,255,255);
			    $pdf->SetDrawColor(255,0,0);
			    $pdf->SetXY($X+$CX,$Y+$CY+$Gap);
			    $pdf->Cell($CX, $CY, $Late, $bo, 0, 'C', 0);

			    
    			$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',7);
			    $pdf->SetFillColor(255,255,255);
			    $pdf->SetDrawColor(255,0,0);
			    $pdf->SetXY($X+$CX+$CX,$Y+$CY+$Gap);
			    $pdf->Cell($CX, $CY, $LRA, $bo, 0, 'C', 0);

			    // DP1, DP10, Inactive
				$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',7);
			    $pdf->SetFillColor(255,255,255);
			    $pdf->SetDrawColor(255,0,0);
			    $pdf->SetXY($X,$Y+$CY+$CY+$Gap);
			    $pdf->Cell($CX, $CY, $ScoreToday, $bo, 0, 'C', 0);

			    
    			$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',7);
			    $pdf->SetFillColor(255,255,255);
			    $pdf->SetDrawColor(255,0,0);
			    $pdf->SetXY($X+$CX,$Y+$CY+$CY+$Gap);
			    $pdf->Cell($CX, $CY, $Score10, $bo, 0, 'C', 0);

			    
    			$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',7);
			    $pdf->SetFillColor(255,255,255);
			    $pdf->SetDrawColor(255,0,0);
			    $pdf->SetXY($X+$CX+$CX,$Y+$CY+$CY+$Gap+$Gap);
			    $pdf->Cell($CX, $CY, $Inactive, $bo, 0, 'C', 0);

			    
				/**************************************************************
				* Call Campus
				* Num of (Total, Present, Absent, NoCard, Late, LRA, Score1, Score10, Inactive) 
				/*************************************************************/
				$i=0;
				foreach ($data['campus_strength_report'] as $campus_strength_report) {
					$CampusName = $campus_strength_report['campus_name'];					
					$Total = $campus_strength_report['students'];
					$Present = $campus_strength_report['present'];
					$Absent = $campus_strength_report['students'] - $campus_strength_report['present'];
					$NoCard = $campus_strength_report['no_card'];
					$Late = $campus_strength_report['late'];
					$LRA = "";					
					$Score10 = "";
					$Inactive = $campus_strength_report['inactive_student_status'];
					$ScoreToday = 10-(($Absent*2)+($DayPass*1)+($Late*1));
					if($ScoreToday < 0) {
						$ScoreToday = "--";
					}
	    					

	    			if($CampusName = 'North Campus'){
	    				if($campus_strength_report['campus_name'] == 'North Campus'){
	    					
	    					$X = 19;
	    					$Y = 38.5;
	    					$CX = 6.9;
	    					$CY = 5.7;
	    					// Total, Present, Absent
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',7);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y);
						    $pdf->Cell($CX, $CY, $Total, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',7);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y);
						    $pdf->Cell($CX, $CY, $Present, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',7);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y);
						    $pdf->Cell($CX, $CY, $Absent, $bo, 0, 'C', 0);

						    // NoCard, Late, LRA
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',7);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY);
						    $pdf->Cell($CX, $CY, $NoCard, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',7);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y+$CY);
						    $pdf->Cell($CX, $CY, $Late, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',7);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y+$CY);
						    $pdf->Cell($CX, $CY, $LRA, $bo, 0, 'C', 0);

						    // DP1, DP10, Inactive
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',7);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $ScoreToday, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',7);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Score10, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',7);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Inactive, $bo, 0, 'C', 0);
						    
	    				}
	    			}
	    			if($CampusName = 'South Campus'){
	    				if($campus_strength_report['campus_name'] == 'South Campus'){
	    					$X = 19;
	    					$Y = 110.5;
	    					$CX = 6.9;
	    					$CY = 5.7;
	    					// Total, Present, Absent
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',7);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y);
						    $pdf->Cell($CX, $CY, $Total, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',7);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y);
						    $pdf->Cell($CX, $CY, $Present, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',7);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y);
						    $pdf->Cell($CX, $CY, $Absent, $bo, 0, 'C', 0);

						    // NoCard, Late, LRA
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',7);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY);
						    $pdf->Cell($CX, $CY, $NoCard, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',7);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y+$CY);
						    $pdf->Cell($CX, $CY, $Late, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',7);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y+$CY);
						    $pdf->Cell($CX, $CY, $LRA, $bo, 0, 'C', 0);

						    // DP1, DP10, Inactive
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',7);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $ScoreToday, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',7);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Score10, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',7);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Inactive, $bo, 0, 'C', 0);
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
					$Total = $wing_strength_report['students'];
					$Present = $wing_strength_report['present'];
					$Absent = $wing_strength_report['students'] - $wing_strength_report['present'];
					$NoCard = $wing_strength_report['no_card'];
					$Late = $wing_strength_report['late'];
					$LRA = "";					
					$Score10 = "";
					$Inactive = $wing_strength_report['inactive_student_status'];
					$ScoreToday = 10-(($Absent*2)+($DayPass*1)+($Late*1));
					if($ScoreToday < 0) {
						$ScoreToday = "--";
					}

	    			if($WingName = 'Pre-Primary'){
	    				if($wing_strength_report['wing_name'] == 'Pre-Primary'){
	    					$X = 47.2;
	    					$Y = 32.8;
	    					$CX = 5.9;
	    					$CY = 2.9;
	    					// Total, Present, Absent
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y);
						    $pdf->Cell($CX, $CY, $Total, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y);
						    $pdf->Cell($CX, $CY, $Present, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y);
						    $pdf->Cell($CX, $CY, $Absent, $bo, 0, 'C', 0);

						    // NoCard, Late, LRA
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY);
						    $pdf->Cell($CX, $CY, $NoCard, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y+$CY);
						    $pdf->Cell($CX, $CY, $Late, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y+$CY);
						    $pdf->Cell($CX, $CY, $LRA, $bo, 0, 'C', 0);

						    // DP1, DP10, Inactive
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $ScoreToday, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Score10, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Inactive, $bo, 0, 'C', 0);
	    				}
	    			}
	    			if($WingName = 'Elementary'){
	    				if($wing_strength_report['wing_name'] == 'Elementary'){
	    					$X = 47.2;
	    					$Y = 67.3;
	    					$CX = 5.9;
	    					$CY = 2.9;
	    					// Total, Present, Absent
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y);
						    $pdf->Cell($CX, $CY, $Total, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y);
						    $pdf->Cell($CX, $CY, $Present, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y);
						    $pdf->Cell($CX, $CY, $Absent, $bo, 0, 'C', 0);

						    // NoCard, Late, LRA
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY);
						    $pdf->Cell($CX, $CY, $NoCard, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y+$CY);
						    $pdf->Cell($CX, $CY, $Late, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y+$CY);
						    $pdf->Cell($CX, $CY, $LRA, $bo, 0, 'C', 0);

						    // DP1, DP10, Inactive
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $ScoreToday, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Score10, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Inactive, $bo, 0, 'C', 0);
	    				}
	    			}
	    			if($WingName = 'Junior'){
	    				if($wing_strength_report['wing_name'] == 'Junior'){
	    					$X = 47.2;
	    					$Y = 101.9;
	    					$CX = 5.9;
	    					$CY = 2.9;
	    					// Total, Present, Absent
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y);
						    $pdf->Cell($CX, $CY, $Total, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y);
						    $pdf->Cell($CX, $CY, $Present, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y);
						    $pdf->Cell($CX, $CY, $Absent, $bo, 0, 'C', 0);

						    // NoCard, Late, LRA
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY);
						    $pdf->Cell($CX, $CY, $NoCard, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y+$CY);
						    $pdf->Cell($CX, $CY, $Late, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y+$CY);
						    $pdf->Cell($CX, $CY, $LRA, $bo, 0, 'C', 0);

						    // DP1, DP10, Inactive
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $ScoreToday, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Score10, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Inactive, $bo, 0, 'C', 0);
	    				}
	    			}
	    			if($WingName = 'Middler'){
	    				if($wing_strength_report['wing_name'] == 'Middler'){
	    					$X = 47.2;
	    					$Y = 142.2;
	    					$CX = 5.9;
	    					$CY = 2.9;
	    					// Total, Present, Absent
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y);
						    $pdf->Cell($CX, $CY, $Total, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y);
						    $pdf->Cell($CX, $CY, $Present, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y);
						    $pdf->Cell($CX, $CY, $Absent, $bo, 0, 'C', 0);

						    // NoCard, Late, LRA
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY);
						    $pdf->Cell($CX, $CY, $NoCard, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y+$CY);
						    $pdf->Cell($CX, $CY, $Late, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y+$CY);
						    $pdf->Cell($CX, $CY, $LRA, $bo, 0, 'C', 0);

						    // DP1, DP10, Inactive
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $ScoreToday, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Score10, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Inactive, $bo, 0, 'C', 0);
	    				}
	    			}
	    			if($WingName = 'O-Level'){
	    				if($wing_strength_report['wing_name'] == 'O-Level'){
	    					$X = 47.2;
	    					$Y = 171;
	    					$CX = 5.9;
	    					$CY = 2.9;
	    					// Total, Present, Absent
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y);
						    $pdf->Cell($CX, $CY, $Total, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y);
						    $pdf->Cell($CX, $CY, $Present, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y);
						    $pdf->Cell($CX, $CY, $Absent, $bo, 0, 'C', 0);

						    // NoCard, Late, LRA
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY);
						    $pdf->Cell($CX, $CY, $NoCard, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y+$CY);
						    $pdf->Cell($CX, $CY, $Late, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y+$CY);
						    $pdf->Cell($CX, $CY, $LRA, $bo, 0, 'C', 0);

						    // DP1, DP10, Inactive
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $ScoreToday, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Score10, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Inactive, $bo, 0, 'C', 0);
	    				}
	    			}
	    			if($WingName = 'A-Level'){
	    				if($wing_strength_report['wing_name'] == 'A-Level'){
	    					$X = 47.2;
	    					$Y = 194;
	    					$$CX = 5.9;
	    					$CY = 2.9;
	    					// Total, Present, Absent
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y);
						    $pdf->Cell($CX, $CY, $Total, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y);
						    $pdf->Cell($CX, $CY, $Present, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y);
						    $pdf->Cell($CX, $CY, $Absent, $bo, 0, 'C', 0);

						    // NoCard, Late, LRA
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY);
						    $pdf->Cell($CX, $CY, $NoCard, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y+$CY);
						    $pdf->Cell($CX, $CY, $Late, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y+$CY);
						    $pdf->Cell($CX, $CY, $LRA, $bo, 0, 'C', 0);

						    // DP1, DP10, Inactive
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $ScoreToday, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Score10, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Inactive, $bo, 0, 'C', 0);
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
					$Total = $grade_strength_report['students'];
					$Present = $grade_strength_report['present'];
					$Absent = $grade_strength_report['students'] - $grade_strength_report['present'];
					$NoCard = $grade_strength_report['no_card'];
					$Late = $grade_strength_report['late'];
					$LRA = "";
					$Score1 = "";
					$Score10 = "";
					$Inactive = $grade_strength_report['inactive_student_status'];
					$ScoreToday = 10-(($Absent*2)+($DayPass*1)+($Late*1));
					if($ScoreToday < 0) {
						$ScoreToday = "--";
					}

	    			if($GradeName = 'PN'){
	    				if($grade_strength_report['grade_name'] == 'PN'){
	    					$X = 69.3;
	    					$Y = 21.3;
	    					$CX = 5.4;
	    					$CY = 2.9;
		    				// Total, Present, Absent
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y);
						    $pdf->Cell($CX, $CY, $Total, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y);
						    $pdf->Cell($CX, $CY, $Present, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y);
						    $pdf->Cell($CX, $CY, $Absent, $bo, 0, 'C', 0);

						    // NoCard, Late, LRA
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY);
						    $pdf->Cell($CX, $CY, $NoCard, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y+$CY);
						    $pdf->Cell($CX, $CY, $Late, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y+$CY);
						    $pdf->Cell($CX, $CY, $LRA, $bo, 0, 'C', 0);

						    // DP1, DP10, Inactive
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $ScoreToday, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Score10, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Inactive, $bo, 0, 'C', 0);
		    			}
					}
					if($GradeName = 'N'){
						if($grade_strength_report['grade_name'] == 'N'){
							$X = 69.3;
	    					$Y = 32.8;
	    					$CX = 5.4;
	    					$CY = 2.9;
		    				// Total, Present, Absent
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y);
						    $pdf->Cell($CX, $CY, $Total, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y);
						    $pdf->Cell($CX, $CY, $Present, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y);
						    $pdf->Cell($CX, $CY, $Absent, $bo, 0, 'C', 0);

						    // NoCard, Late, LRA
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY);
						    $pdf->Cell($CX, $CY, $NoCard, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y+$CY);
						    $pdf->Cell($CX, $CY, $Late, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y+$CY);
						    $pdf->Cell($CX, $CY, $LRA, $bo, 0, 'C', 0);

						    // DP1, DP10, Inactive
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $ScoreToday, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Score10, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Inactive, $bo, 0, 'C', 0);
						}
					}
					if($GradeName = 'KG'){
	    				if($grade_strength_report['grade_name'] == 'KG'){
	    					$X = 69.3;
	    					$Y = 44.3;
	    					$CX = 5.4;
	    					$CY = 2.9;
			    			// Total, Present, Absent
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y);
						    $pdf->Cell($CX, $CY, $Total, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y);
						    $pdf->Cell($CX, $CY, $Present, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y);
						    $pdf->Cell($CX, $CY, $Absent, $bo, 0, 'C', 0);

						    // NoCard, Late, LRA
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY);
						    $pdf->Cell($CX, $CY, $NoCard, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y+$CY);
						    $pdf->Cell($CX, $CY, $Late, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y+$CY);
						    $pdf->Cell($CX, $CY, $LRA, $bo, 0, 'C', 0);

						    // DP1, DP10, Inactive
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $ScoreToday, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Score10, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Inactive, $bo, 0, 'C', 0);
						}
					}
					if($GradeName = 'I'){	    				
	    				if($grade_strength_report['grade_name'] == 'I'){
	    					$X = 69.3;
	    					$Y = 61.6;
	    					$CX = 5.4;
	    					$CY = 2.9;
	    					// Total, Present, Absent
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y);
						    $pdf->Cell($CX, $CY, $Total, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y);
						    $pdf->Cell($CX, $CY, $Present, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y);
						    $pdf->Cell($CX, $CY, $Absent, $bo, 0, 'C', 0);

						    // NoCard, Late, LRA
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY);
						    $pdf->Cell($CX, $CY, $NoCard, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y+$CY);
						    $pdf->Cell($CX, $CY, $Late, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y+$CY);
						    $pdf->Cell($CX, $CY, $LRA, $bo, 0, 'C', 0);

						    // DP1, DP10, Inactive
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $ScoreToday, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Score10, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Inactive, $bo, 0, 'C', 0);
						}
					}
					if($GradeName = 'II'){	    				
	    				if($grade_strength_report['grade_name'] == 'II'){
	    					$X = 69.3;
	    					$Y = 73.1;
							$CX = 5.4;
	    					$CY = 2.9;
	    					// Total, Present, Absent
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y);
						    $pdf->Cell($CX, $CY, $Total, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y);
						    $pdf->Cell($CX, $CY, $Present, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y);
						    $pdf->Cell($CX, $CY, $Absent, $bo, 0, 'C', 0);

						    // NoCard, Late, LRA
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY);
						    $pdf->Cell($CX, $CY, $NoCard, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y+$CY);
						    $pdf->Cell($CX, $CY, $Late, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y+$CY);
						    $pdf->Cell($CX, $CY, $LRA, $bo, 0, 'C', 0);

						    // DP1, DP10, Inactive
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $ScoreToday, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Score10, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Inactive, $bo, 0, 'C', 0);
						}
					}
					if($GradeName = 'III'){
	    				if($grade_strength_report['grade_name'] == 'III'){
	    					$X = 69.3;
	    					$Y = 84.6;
	    					$CX = 5.4;
	    					$CY = 2.9;
	    					// Total, Present, Absent
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y);
						    $pdf->Cell($CX, $CY, $Total, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y);
						    $pdf->Cell($CX, $CY, $Present, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y);
						    $pdf->Cell($CX, $CY, $Absent, $bo, 0, 'C', 0);

						    // NoCard, Late, LRA
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY);
						    $pdf->Cell($CX, $CY, $NoCard, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y+$CY);
						    $pdf->Cell($CX, $CY, $Late, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y+$CY);
						    $pdf->Cell($CX, $CY, $LRA, $bo, 0, 'C', 0);

						    // DP1, DP10, Inactive
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $ScoreToday, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Score10, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Inactive, $bo, 0, 'C', 0);
						}
					}
					if($GradeName = 'IV'){
	    				if($grade_strength_report['grade_name'] == 'IV'){
	    					$X = 69.3;
	    					$Y = 96.1;
	    					$CX = 5.4;
	    					$CY = 2.9;
	    					// Total, Present, Absent
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y);
						    $pdf->Cell($CX, $CY, $Total, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y);
						    $pdf->Cell($CX, $CY, $Present, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y);
						    $pdf->Cell($CX, $CY, $Absent, $bo, 0, 'C', 0);

						    // NoCard, Late, LRA
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY);
						    $pdf->Cell($CX, $CY, $NoCard, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y+$CY);
						    $pdf->Cell($CX, $CY, $Late, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y+$CY);
						    $pdf->Cell($CX, $CY, $LRA, $bo, 0, 'C', 0);

						    // DP1, DP10, Inactive
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $ScoreToday, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Score10, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Inactive, $bo, 0, 'C', 0);
	    				}
	    			}
	    			if($GradeName = 'V'){
	    				if($grade_strength_report['grade_name'] == 'V'){
	    					$X = 69.3;
	    					$Y = 107.6;
	    					$CX = 5.4;
	    					$CY = 2.9;
	    					// Total, Present, Absent
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y);
						    $pdf->Cell($CX, $CY, $Total, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y);
						    $pdf->Cell($CX, $CY, $Present, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y);
						    $pdf->Cell($CX, $CY, $Absent, $bo, 0, 'C', 0);

						    // NoCard, Late, LRA
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY);
						    $pdf->Cell($CX, $CY, $NoCard, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y+$CY);
						    $pdf->Cell($CX, $CY, $Late, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y+$CY);
						    $pdf->Cell($CX, $CY, $LRA, $bo, 0, 'C', 0);

						    // DP1, DP10, Inactive
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $ScoreToday, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Score10, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Inactive, $bo, 0, 'C', 0);
		    			}
		    		}
		    		if($GradeName = 'VI'){
	    				if($grade_strength_report['grade_name'] == 'VI'){
	    					$X = 69.3;
	    					$Y = 119.1;
	    					$CX = 5.4;
	    					$CY = 2.9;
	    					// Total, Present, Absent
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y);
						    $pdf->Cell($CX, $CY, $Total, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y);
						    $pdf->Cell($CX, $CY, $Present, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y);
						    $pdf->Cell($CX, $CY, $Absent, $bo, 0, 'C', 0);

						    // NoCard, Late, LRA
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY);
						    $pdf->Cell($CX, $CY, $NoCard, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y+$CY);
						    $pdf->Cell($CX, $CY, $Late, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y+$CY);
						    $pdf->Cell($CX, $CY, $LRA, $bo, 0, 'C', 0);

						    // DP1, DP10, Inactive
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $ScoreToday, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Score10, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Inactive, $bo, 0, 'C', 0);
	    				}
	    			}
	    			if($GradeName = 'VII'){
	    				if($grade_strength_report['grade_name'] == 'VII'){
	    					$X = 69.3;
	    					$Y = 130.6;
	    					$CX = 5.4;
	    					$CY = 2.9;
	    					// Total, Present, Absent
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y);
						    $pdf->Cell($CX, $CY, $Total, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y);
						    $pdf->Cell($CX, $CY, $Present, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y);
						    $pdf->Cell($CX, $CY, $Absent, $bo, 0, 'C', 0);

						    // NoCard, Late, LRA
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY);
						    $pdf->Cell($CX, $CY, $NoCard, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y+$CY);
						    $pdf->Cell($CX, $CY, $Late, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y+$CY);
						    $pdf->Cell($CX, $CY, $LRA, $bo, 0, 'C', 0);

						    // DP1, DP10, Inactive
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $ScoreToday, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Score10, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Inactive, $bo, 0, 'C', 0);
	    				}
	    			}
	    			if($GradeName = 'VIII'){
	    				if($grade_strength_report['grade_name'] == 'VIII'){
	    					$X = 69.3;
	    					$Y = 142.2;
	    					$CX = 5.4;
	    					$CY = 2.9;
	    					// Total, Present, Absent
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y);
						    $pdf->Cell($CX, $CY, $Total, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y);
						    $pdf->Cell($CX, $CY, $Present, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y);
						    $pdf->Cell($CX, $CY, $Absent, $bo, 0, 'C', 0);

						    // NoCard, Late, LRA
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY);
						    $pdf->Cell($CX, $CY, $NoCard, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y+$CY);
						    $pdf->Cell($CX, $CY, $Late, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y+$CY);
						    $pdf->Cell($CX, $CY, $LRA, $bo, 0, 'C', 0);

						    // DP1, DP10, Inactive
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $ScoreToday, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Score10, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Inactive, $bo, 0, 'C', 0);
	    				}
	    			}
	    			if($GradeName = 'IX'){
	    				if($grade_strength_report['grade_name'] == 'IX'){
	    					$X = 69.3;
	    					$Y = 153.7;
	    					$CX = 5.4;
	    					$CY = 2.9;
	    					// Total, Present, Absent
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y);
						    $pdf->Cell($CX, $CY, $Total, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y);
						    $pdf->Cell($CX, $CY, $Present, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y);
						    $pdf->Cell($CX, $CY, $Absent, $bo, 0, 'C', 0);

						    // NoCard, Late, LRA
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY);
						    $pdf->Cell($CX, $CY, $NoCard, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y+$CY);
						    $pdf->Cell($CX, $CY, $Late, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y+$CY);
						    $pdf->Cell($CX, $CY, $LRA, $bo, 0, 'C', 0);

						    // DP1, DP10, Inactive
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $ScoreToday, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Score10, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Inactive, $bo, 0, 'C', 0);
	    				}
	    			}
	    			if($GradeName = 'X'){
	    				if($grade_strength_report['grade_name'] == 'X'){
	    					$X = 69.3;
	    					$Y = 165.2;
	    					$CX = 5.4;
	    					$CY = 2.9;
	    					// Total, Present, Absent
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y);
						    $pdf->Cell($CX, $CY, $Total, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y);
						    $pdf->Cell($CX, $CY, $Present, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y);
						    $pdf->Cell($CX, $CY, $Absent, $bo, 0, 'C', 0);

						    // NoCard, Late, LRA
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY);
						    $pdf->Cell($CX, $CY, $NoCard, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y+$CY);
						    $pdf->Cell($CX, $CY, $Late, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y+$CY);
						    $pdf->Cell($CX, $CY, $LRA, $bo, 0, 'C', 0);

						    // DP1, DP10, Inactive
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $ScoreToday, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Score10, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Inactive, $bo, 0, 'C', 0);
	    				}
	    			}
	    			if($GradeName = 'XI'){
	    				if($grade_strength_report['grade_name'] == 'XI'){
	    					$X = 69.3;
	    					$Y = 176.7;
	    					$CX = 5.4;
	    					$CY = 2.9;
	    					// Total, Present, Absent
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y);
						    $pdf->Cell($CX, $CY, $Total, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y);
						    $pdf->Cell($CX, $CY, $Present, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y);
						    $pdf->Cell($CX, $CY, $Absent, $bo, 0, 'C', 0);

						    // NoCard, Late, LRA
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY);
						    $pdf->Cell($CX, $CY, $NoCard, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y+$CY);
						    $pdf->Cell($CX, $CY, $Late, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y+$CY);
						    $pdf->Cell($CX, $CY, $LRA, $bo, 0, 'C', 0);

						    // DP1, DP10, Inactive
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $ScoreToday, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Score10, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Inactive, $bo, 0, 'C', 0);
	    				}
	    			}
	    			if($GradeName = 'A1'){
	    				if($grade_strength_report['grade_name'] == 'A1'){
	    					$X = 69.3;
	    					$Y = 188.2;
	    					$CX = 5.4;
	    					$CY = 2.9;
	    					// Total, Present, Absent
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y);
						    $pdf->Cell($CX, $CY, $Total, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y);
						    $pdf->Cell($CX, $CY, $Present, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y);
						    $pdf->Cell($CX, $CY, $Absent, $bo, 0, 'C', 0);

						    // NoCard, Late, LRA
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY);
						    $pdf->Cell($CX, $CY, $NoCard, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y+$CY);
						    $pdf->Cell($CX, $CY, $Late, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y+$CY);
						    $pdf->Cell($CX, $CY, $LRA, $bo, 0, 'C', 0);

						    // DP1, DP10, Inactive
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $ScoreToday, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Score10, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Inactive, $bo, 0, 'C', 0);
	    				}
	    			}
	    			if($GradeName = 'A2'){
	    				if($grade_strength_report['grade_name'] == 'A2'){
	    					$X = 69.3;
	    					$Y = 199.7;
	    					$CX = 5.4;
	    					$CY = 2.9;
	    					// Total, Present, Absent
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y);
						    $pdf->Cell($CX, $CY, $Total, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y);
						    $pdf->Cell($CX, $CY, $Present, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y);
						    $pdf->Cell($CX, $CY, $Absent, $bo, 0, 'C', 0);

						    // NoCard, Late, LRA
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY);
						    $pdf->Cell($CX, $CY, $NoCard, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y+$CY);
						    $pdf->Cell($CX, $CY, $Late, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y+$CY);
						    $pdf->Cell($CX, $CY, $LRA, $bo, 0, 'C', 0);

						    // DP1, DP10, Inactive
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $ScoreToday, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Score10, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX,$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Inactive, $bo, 0, 'C', 0);
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
					$Total = $strength_report['students'];
					$Present = $strength_report['present'];
					$Absent = $strength_report['students'] - $strength_report['present'];
					$NoCard = $strength_report['no_card'];
					$Late = $strength_report['late'];
					$LRA = "";
					$Score1 = "";
					$Score10 = "";
					$Inactive = $strength_report['inactive_student_status'];
					$ScoreToday = 10-(($Absent*2)+($DayPass*1)+($Late*1));
					if($ScoreToday < 0) {
						$ScoreToday = "--";
					}
	    			

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
	    				if($strength_report['section_name'] != 'Bin') {
		    				$X = 93.5;
		    				$Y = 21.3;
		    				$CX = 5.4;
	    					$CY = 2.9;
	    					$Gap = 17.45;
	    					// Total, Present, Absent
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+($i*$Gap),$Y);
						    $pdf->Cell($CX, $CY, $Total, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($i*$Gap),$Y);
						    $pdf->Cell($CX, $CY, $Present, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y);
						    $pdf->Cell($CX, $CY, $Absent, $bo, 0, 'C', 0);

						    // NoCard, Late, LRA
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+($i*$Gap),$Y+$CY);
						    $pdf->Cell($CX, $CY, $NoCard, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($i*$Gap),$Y+$CY);
						    $pdf->Cell($CX, $CY, $Late, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y+$CY);
						    $pdf->Cell($CX, $CY, $LRA, $bo, 0, 'C', 0);

						    // DP1, DP10, Inactive
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+($i*$Gap),$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $ScoreToday, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($i*$Gap),$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Score10, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Inactive, $bo, 0, 'C', 0);
					    }					    
	    			}

	    			// Nursery	    			
	    			else if($strength_report['grade_name'] == 'N'){
	    				if($strength_report['section_name'] != 'Bin') {
		    				$X = 93.5;
		    				$Y = 32.8;
		    				$CX = 5.4;
	    					$CY = 2.9;
	    					$Gap = 17.45;
	    					// Total, Present, Absent
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+($i*$Gap),$Y);
						    $pdf->Cell($CX, $CY, $Total, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($i*$Gap),$Y);
						    $pdf->Cell($CX, $CY, $Present, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y);
						    $pdf->Cell($CX, $CY, $Absent, $bo, 0, 'C', 0);

						    // NoCard, Late, LRA
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+($i*$Gap),$Y+$CY);
						    $pdf->Cell($CX, $CY, $NoCard, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($i*$Gap),$Y+$CY);
						    $pdf->Cell($CX, $CY, $Late, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y+$CY);
						    $pdf->Cell($CX, $CY, $LRA, $bo, 0, 'C', 0);

						    // DP1, DP10, Inactive
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+($i*$Gap),$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $ScoreToday, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($i*$Gap),$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Score10, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Inactive, $bo, 0, 'C', 0);
						}
	    			}

	    			// KG
	    			else if($strength_report['grade_name'] == 'KG'){
    					if($strength_report['section_name'] != 'Bin') {
		    				$X = 93.5;
		    				$Y = 44.3;
		    				$CX = 5.4;
	    					$CY = 2.9;
	    					$Gap = 17.45;
	    					// Total, Present, Absent
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+($i*$Gap),$Y);
						    $pdf->Cell($CX, $CY, $Total, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($i*$Gap),$Y);
						    $pdf->Cell($CX, $CY, $Present, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y);
						    $pdf->Cell($CX, $CY, $Absent, $bo, 0, 'C', 0);

						    // NoCard, Late, LRA
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+($i*$Gap),$Y+$CY);
						    $pdf->Cell($CX, $CY, $NoCard, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($i*$Gap),$Y+$CY);
						    $pdf->Cell($CX, $CY, $Late, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y+$CY);
						    $pdf->Cell($CX, $CY, $LRA, $bo, 0, 'C', 0);

						    // DP1, DP10, Inactive
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+($i*$Gap),$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $ScoreToday, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($i*$Gap),$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Score10, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Inactive, $bo, 0, 'C', 0);
		    			}
		    		}
		    		
	    			// I
	    			else if($strength_report['grade_name'] == 'I'){
	    				if($strength_report['section_name'] != 'Bin') {
		    				$X = 93.5;
		    				$Y = 61.6;
		    				$CX = 5.4;
	    					$CY = 2.9;
	    					$Gap = 17.45;
	    					// Total, Present, Absent
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+($i*$Gap),$Y);
						    $pdf->Cell($CX, $CY, $Total, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($i*$Gap),$Y);
						    $pdf->Cell($CX, $CY, $Present, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y);
						    $pdf->Cell($CX, $CY, $Absent, $bo, 0, 'C', 0);

						    // NoCard, Late, LRA
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+($i*$Gap),$Y+$CY);
						    $pdf->Cell($CX, $CY, $NoCard, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($i*$Gap),$Y+$CY);
						    $pdf->Cell($CX, $CY, $Late, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y+$CY);
						    $pdf->Cell($CX, $CY, $LRA, $bo, 0, 'C', 0);

						    // DP1, DP10, Inactive
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+($i*$Gap),$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $ScoreToday, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($i*$Gap),$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Score10, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Inactive, $bo, 0, 'C', 0);
						}
	    			}

	    			// II
	    			else if($strength_report['grade_name'] == 'II'){
	    				if($strength_report['section_name'] != 'Bin') {
		    				$X = 93.5;
		    				$Y = 73.1;
		    				$CX = 5.4;
	    					$CY = 2.9;
	    					$Gap = 17.45;
	    					// Total, Present, Absent
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+($i*$Gap),$Y);
						    $pdf->Cell($CX, $CY, $Total, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($i*$Gap),$Y);
						    $pdf->Cell($CX, $CY, $Present, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y);
						    $pdf->Cell($CX, $CY, $Absent, $bo, 0, 'C', 0);

						    // NoCard, Late, LRA
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+($i*$Gap),$Y+$CY);
						    $pdf->Cell($CX, $CY, $NoCard, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($i*$Gap),$Y+$CY);
						    $pdf->Cell($CX, $CY, $Late, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y+$CY);
						    $pdf->Cell($CX, $CY, $LRA, $bo, 0, 'C', 0);

						    // DP1, DP10, Inactive
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+($i*$Gap),$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $ScoreToday, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($i*$Gap),$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Score10, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Inactive, $bo, 0, 'C', 0);
						}
	    			}

	    			// III
	    			else if($strength_report['grade_name'] == 'III'){
	    				if($strength_report['section_name'] != 'Bin') {
		    				$X = 93.5;
		    				$Y = 84.6;
		    				$CX = 5.4;
	    					$CY = 2.9;
	    					$Gap = 17.45;
	    					// Total, Present, Absent
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+($i*$Gap),$Y);
						    $pdf->Cell($CX, $CY, $Total, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($i*$Gap),$Y);
						    $pdf->Cell($CX, $CY, $Present, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y);
						    $pdf->Cell($CX, $CY, $Absent, $bo, 0, 'C', 0);

						    // NoCard, Late, LRA
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+($i*$Gap),$Y+$CY);
						    $pdf->Cell($CX, $CY, $NoCard, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($i*$Gap),$Y+$CY);
						    $pdf->Cell($CX, $CY, $Late, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y+$CY);
						    $pdf->Cell($CX, $CY, $LRA, $bo, 0, 'C', 0);

						    // DP1, DP10, Inactive
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+($i*$Gap),$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $ScoreToday, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($i*$Gap),$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Score10, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Inactive, $bo, 0, 'C', 0);
						}
	    			}

	    			// IV
	    			else if($strength_report['grade_name'] == 'IV'){
	    				if($strength_report['section_name'] != 'Bin') {
	    					$X = 93.5;
		    				$Y = 96.1;
		    				$CX = 5.4;
	    					$CY = 2.9;
	    					$Gap = 17.45;
	    					// Total, Present, Absent
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+($i*$Gap),$Y);
						    $pdf->Cell($CX, $CY, $Total, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($i*$Gap),$Y);
						    $pdf->Cell($CX, $CY, $Present, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y);
						    $pdf->Cell($CX, $CY, $Absent, $bo, 0, 'C', 0);

						    // NoCard, Late, LRA
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+($i*$Gap),$Y+$CY);
						    $pdf->Cell($CX, $CY, $NoCard, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($i*$Gap),$Y+$CY);
						    $pdf->Cell($CX, $CY, $Late, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y+$CY);
						    $pdf->Cell($CX, $CY, $LRA, $bo, 0, 'C', 0);

						    // DP1, DP10, Inactive
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+($i*$Gap),$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $ScoreToday, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($i*$Gap),$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Score10, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Inactive, $bo, 0, 'C', 0);
						}
	    			}


	    			// V
	    			else if($strength_report['grade_name'] == 'V'){
	    				if($strength_report['section_name'] != 'Bin') {  				
		    				$X = 93.5;
		    				$Y = 107.6;
		    				$CX = 5.4;
	    					$CY = 2.9;
	    					$Gap = 17.45;
	    					// Total, Present, Absent
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+($i*$Gap),$Y);
						    $pdf->Cell($CX, $CY, $Total, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($i*$Gap),$Y);
						    $pdf->Cell($CX, $CY, $Present, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y);
						    $pdf->Cell($CX, $CY, $Absent, $bo, 0, 'C', 0);

						    // NoCard, Late, LRA
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+($i*$Gap),$Y+$CY);
						    $pdf->Cell($CX, $CY, $NoCard, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($i*$Gap),$Y+$CY);
						    $pdf->Cell($CX, $CY, $Late, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y+$CY);
						    $pdf->Cell($CX, $CY, $LRA, $bo, 0, 'C', 0);

						    // DP1, DP10, Inactive
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+($i*$Gap),$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $ScoreToday, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($i*$Gap),$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Score10, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Inactive, $bo, 0, 'C', 0);
						}
					}
	    			// VI
	    			else if($strength_report['grade_name'] == 'VI'){
	    				if($strength_report['section_name'] != 'Bin') {
		    				$X = 93.5;
		    				$Y = 119.1;
		    				$CX = 5.4;
	    					$CY = 2.9;
	    					$Gap = 17.45;
	    					// Total, Present, Absent
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+($i*$Gap),$Y);
						    $pdf->Cell($CX, $CY, $Total, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($i*$Gap),$Y);
						    $pdf->Cell($CX, $CY, $Present, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y);
						    $pdf->Cell($CX, $CY, $Absent, $bo, 0, 'C', 0);

						    // NoCard, Late, LRA
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+($i*$Gap),$Y+$CY);
						    $pdf->Cell($CX, $CY, $NoCard, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($i*$Gap),$Y+$CY);
						    $pdf->Cell($CX, $CY, $Late, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y+$CY);
						    $pdf->Cell($CX, $CY, $LRA, $bo, 0, 'C', 0);

						    // DP1, DP10, Inactive
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+($i*$Gap),$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $ScoreToday, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($i*$Gap),$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Score10, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Inactive, $bo, 0, 'C', 0);
						}
	    			}


	    			// VII
	    			else if($strength_report['grade_name'] == 'VII'){
	    				if($strength_report['section_name'] != 'Bin') {
		    				$X = 93.5;
		    				$Y = 130.6;
		    				$CX = 5.4;
	    					$CY = 2.9;
	    					$Gap = 17.45;
	    					// Total, Present, Absent
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+($i*$Gap),$Y);
						    $pdf->Cell($CX, $CY, $Total, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($i*$Gap),$Y);
						    $pdf->Cell($CX, $CY, $Present, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y);
						    $pdf->Cell($CX, $CY, $Absent, $bo, 0, 'C', 0);

						    // NoCard, Late, LRA
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+($i*$Gap),$Y+$CY);
						    $pdf->Cell($CX, $CY, $NoCard, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($i*$Gap),$Y+$CY);
						    $pdf->Cell($CX, $CY, $Late, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y+$CY);
						    $pdf->Cell($CX, $CY, $LRA, $bo, 0, 'C', 0);

						    // DP1, DP10, Inactive
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+($i*$Gap),$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $ScoreToday, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($i*$Gap),$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Score10, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Inactive, $bo, 0, 'C', 0);
						}
	    			}



	    			// VIII
	    			else if($strength_report['grade_name'] == 'VIII'){
	    				if($strength_report['section_name'] != 'Bin') {
		    				$X = 93.5;
		    				$Y = 142.2;
		    				$CX = 5.4;
	    					$CY = 2.9;
	    					$Gap = 17.45;
	    					// Total, Present, Absent
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+($i*$Gap),$Y);
						    $pdf->Cell($CX, $CY, $Total, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($i*$Gap),$Y);
						    $pdf->Cell($CX, $CY, $Present, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y);
						    $pdf->Cell($CX, $CY, $Absent, $bo, 0, 'C', 0);

						    // NoCard, Late, LRA
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+($i*$Gap),$Y+$CY);
						    $pdf->Cell($CX, $CY, $NoCard, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($i*$Gap),$Y+$CY);
						    $pdf->Cell($CX, $CY, $Late, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y+$CY);
						    $pdf->Cell($CX, $CY, $LRA, $bo, 0, 'C', 0);

						    // DP1, DP10, Inactive
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+($i*$Gap),$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $ScoreToday, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($i*$Gap),$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Score10, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Inactive, $bo, 0, 'C', 0);
						}
	    			}


	    			// IX
	    			else if($strength_report['grade_name'] == 'IX'){
	    				if($strength_report['section_name'] != 'Bin') {
		    				$X = 93.5;
		    				$Y = 153.7;
		    				$CX = 5.4;
	    					$CY = 2.9;
	    					$Gap = 17.45;
	    					// Total, Present, Absent
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+($i*$Gap),$Y);
						    $pdf->Cell($CX, $CY, $Total, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($i*$Gap),$Y);
						    $pdf->Cell($CX, $CY, $Present, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y);
						    $pdf->Cell($CX, $CY, $Absent, $bo, 0, 'C', 0);

						    // NoCard, Late, LRA
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+($i*$Gap),$Y+$CY);
						    $pdf->Cell($CX, $CY, $NoCard, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($i*$Gap),$Y+$CY);
						    $pdf->Cell($CX, $CY, $Late, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y+$CY);
						    $pdf->Cell($CX, $CY, $LRA, $bo, 0, 'C', 0);

						    // DP1, DP10, Inactive
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+($i*$Gap),$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $ScoreToday, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($i*$Gap),$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Score10, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Inactive, $bo, 0, 'C', 0);
						}
	    			}
	    			// X
	    			else if($strength_report['grade_name'] == 'X'){
	    				if($strength_report['section_name'] != 'Bin') {
		    				$X = 93.5;
		    				$Y = 165.2;
		    				$CX = 5.4;
	    					$CY = 2.9;
	    					$Gap = 17.45;
	    					// Total, Present, Absent
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+($i*$Gap),$Y);
						    $pdf->Cell($CX, $CY, $Total, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($i*$Gap),$Y);
						    $pdf->Cell($CX, $CY, $Present, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y);
						    $pdf->Cell($CX, $CY, $Absent, $bo, 0, 'C', 0);

						    // NoCard, Late, LRA
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+($i*$Gap),$Y+$CY);
						    $pdf->Cell($CX, $CY, $NoCard, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($i*$Gap),$Y+$CY);
						    $pdf->Cell($CX, $CY, $Late, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y+$CY);
						    $pdf->Cell($CX, $CY, $LRA, $bo, 0, 'C', 0);

						    // DP1, DP10, Inactive
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+($i*$Gap),$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $ScoreToday, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($i*$Gap),$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Score10, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Inactive, $bo, 0, 'C', 0);
						}
	    			}


	    			// XI
	    			else if($strength_report['grade_name'] == 'XI'){
	    				if($strength_report['section_name'] != 'Bin') {
		    				$X = 93.5;
		    				$Y = 176.7;
		    				$CX = 5.4;
	    					$CY = 2.9;
	    					$Gap = 17.45;
	    					// Total, Present, Absent
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+($i*$Gap),$Y);
						    $pdf->Cell($CX, $CY, $Total, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($i*$Gap),$Y);
						    $pdf->Cell($CX, $CY, $Present, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y);
						    $pdf->Cell($CX, $CY, $Absent, $bo, 0, 'C', 0);

						    // NoCard, Late, LRA
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+($i*$Gap),$Y+$CY);
						    $pdf->Cell($CX, $CY, $NoCard, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($i*$Gap),$Y+$CY);
						    $pdf->Cell($CX, $CY, $Late, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y+$CY);
						    $pdf->Cell($CX, $CY, $LRA, $bo, 0, 'C', 0);

						    // DP1, DP10, Inactive
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+($i*$Gap),$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $ScoreToday, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($i*$Gap),$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Score10, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Inactive, $bo, 0, 'C', 0);
						}
	    			}


	    			// A1
	    			else if($strength_report['grade_name'] == 'A1'){
	    				if($strength_report['section_name'] != 'Bin') {
		    				$X = 93.5;
		    				$Y = 188.2;
		    				$CX = 5.4;
	    					$CY = 2.9;
	    					$Gap = 17.45;
	    					// Total, Present, Absent
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+($i*$Gap),$Y);
						    $pdf->Cell($CX, $CY, $Total, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($i*$Gap),$Y);
						    $pdf->Cell($CX, $CY, $Present, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y);
						    $pdf->Cell($CX, $CY, $Absent, $bo, 0, 'C', 0);

						    // NoCard, Late, LRA
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+($i*$Gap),$Y+$CY);
						    $pdf->Cell($CX, $CY, $NoCard, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($i*$Gap),$Y+$CY);
						    $pdf->Cell($CX, $CY, $Late, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y+$CY);
						    $pdf->Cell($CX, $CY, $LRA, $bo, 0, 'C', 0);

						    // DP1, DP10, Inactive
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+($i*$Gap),$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $ScoreToday, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($i*$Gap),$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Score10, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Inactive, $bo, 0, 'C', 0);
						}
	    			}


	    			// A2
	    			else if($strength_report['grade_name'] == 'A2'){
	    				if($strength_report['section_name'] != 'Bin') {
		    				$X = 93.5;
		    				$Y = 199.7;
		    				$CX = 5.4;
	    					$CY = 2.9;
	    					$Gap = 17.45;
	    					// Total, Present, Absent
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+($i*$Gap),$Y);
						    $pdf->Cell($CX, $CY, $Total, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($i*$Gap),$Y);
						    $pdf->Cell($CX, $CY, $Present, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y);
						    $pdf->Cell($CX, $CY, $Absent, $bo, 0, 'C', 0);

						    // NoCard, Late, LRA
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+($i*$Gap),$Y+$CY);
						    $pdf->Cell($CX, $CY, $NoCard, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($i*$Gap),$Y+$CY);
						    $pdf->Cell($CX, $CY, $Late, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y+$CY);
						    $pdf->Cell($CX, $CY, $LRA, $bo, 0, 'C', 0);

						    // DP1, DP10, Inactive
		    				$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+($i*$Gap),$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $ScoreToday, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+($i*$Gap),$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Score10, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',6);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($X+$CX+$CX+($i*$Gap),$Y+$CY+$CY);
						    $pdf->Cell($CX, $CY, $Inactive, $bo, 0, 'C', 0);
						}
	    			}

	    			$i++;
	    		}	
			}
		}

		// Output the new PDF
		//$pdf->Output('SAS' . '(' . $now_date  . ')' . '.pdf', 'I');
		$pdf->Output('SAS' . '(' . $now_date  . ')' . '.pdf', 'D');
		//$pdf->Output();

	}
	

}