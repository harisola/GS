<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class School_strength_report extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->model('school_wide_report/student_strength_model');

		$where_student = array(
			'category' => 'Student'
		);
		$data['student'] = $this->student_strength_model->get_by('atif._studentstatus',$select='',$where_student);

		$where_fence = array(
			'category' => 'Fence'
		);

		$data['fence'] = $this->student_strength_model->get_by('atif._studentstatus',$select='',$where_fence);
		
		$where_out = array(
			'category' => 'Out'
		);

		$data['Out'] = $this->student_strength_model->get_by('atif._studentstatus',$select='',$where_out);



		$this->load->view('school_wide_report/student_strength_report_view',$data);
		$this->load->view('school_wide_report/student_strength_orb_footer');
	}


	public function printForm2()


	{

		$now_date = date('l F d, Y');

		 //Set the Content Type
		header("Content-type: image/jpeg");
		// Create Image From Existing Template
	    $imgPath = 'Components/image/school_wide_report/student_strength.jpg';
	    $image = imagecreatefromjpeg($imgPath);	    
	    // Set Path to Font File
  		$font_path = 'Components/image/font/calibri.ttf';




	    $this->load->model('school_wide_report/student_strength_model');
		$data['strength_report'] = $this->student_strength_model->getStudentGradeSectionSummary();
		$data['grade_strength_report'] = $this->student_strength_model->getStudentGradeSummary();
		$data['wing_strength_report'] = $this->student_strength_model->getStudentWingSummary();
		$data['campus_strength_report'] = $this->student_strength_model->getStudentCampusSummary();




		// Allocate A Color For The Text
	    $colorText = imagecolorallocate($image, 0, 0, 0);
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




	    $string = $now_date;
	    $fontSize = 80;
	    $angle = 0;
	    $x = 2600;
	    $y = 200;
	    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

	    /**************************************************************
		// Call School
		// Num of (Jinnah, Iqbal, Syed) and (Boys, Girls)
		//*************************************************************/
		$i=0;
		$xx = 170;
	    $fontSize = 40;

	    $WingName = $data['campus_strength_report'][0]['grade_name'] + $data['campus_strength_report'][1]['grade_name'];
		$Jinnah = $data['campus_strength_report'][0]['jinnah'] + $data['campus_strength_report'][1]['jinnah'];
		$Iqbal = $data['campus_strength_report'][0]['iqbal'] + $data['campus_strength_report'][1]['iqbal'];
		$Syed = $data['campus_strength_report'][0]['syed'] + $data['campus_strength_report'][1]['syed'];
		$Girl = $data['campus_strength_report'][0]['girl'] + $data['campus_strength_report'][1]['girl'];
		$Boy = $data['campus_strength_report'][0]['boy'] + $data['campus_strength_report'][1]['boy'];
		$Students = $data['campus_strength_report'][0]['students'] + $data['campus_strength_report'][1]['students'];

	    $yy = 1360;
		$y_inner = 165;
		$x_inner_house = 130;
		$x_inner_gender = 100;
		$Gap = 150;

		// Jinnah, Iqbal, Syed
		$string = $Jinnah;			    
	    $angle = 0;
	    $x = $xx+($i*$Gap);
	    $y = $yy;
	    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

	    $string = $Iqbal;			    
	    $angle = 0;
	    $x = $xx+$x_inner_house+($i*$Gap);
	    $y = $yy;
	    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

		$string = $Syed;			    
	    $angle = 0;
	    $x = $xx+$x_inner_house+$x_inner_house+($i*$Gap);
	    $y = $yy;
	    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


	    $fontSize = 40;
	    // Boy and Girl
	    $string = $Girl;			    
	    $angle = 0;
	    $x = $xx+30;
	    $y = $yy + $y_inner;
	    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

	    $string = $Boy;			    
	    $angle = 0;
	    $x = $xx+$x_inner_house+($x_inner_house - 35);
	    $y = $yy + $y_inner;
	    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
		  			

	    $fontSize = 40;
	    // Total Students
	    $string = $Students;			    
	    $angle = 0;
	    $x = $xx + ($x_inner_house);
	    $y = $yy + ($y_inner + $y_inner) - 25;
	    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

	    /**************************************************************
		// Call Campus
		// Num of (Jinnah, Iqbal, Syed) and (Boys, Girls)
		//*************************************************************/
		$i=0;
		$xx = 315;
	    $fontSize = 40;	    
		foreach ($data['campus_strength_report'] as $strength_report) {	    			
			$WingName = $strength_report['grade_name'];			
			$Jinnah = $strength_report['jinnah'];
			$Iqbal = $strength_report['iqbal'];
			$Syed = $strength_report['syed'];
			$Girl = $strength_report['girl'];
			$Boy = $strength_report['boy'];
			$Students = $strength_report['students'];			

			// North Campus
			if($strength_report['grade_name'] == 'North Campus'){
				$yy = 682;
				$y_inner = 105;
				$x_inner_house = 130;
				$Gap = 150;

				// Jinnah, Iqbal, Syed
				$string = $Jinnah;			    
			    $angle = 0;
			    $x = $xx+($i*$Gap);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Iqbal;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*$Gap);
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
			    $x = $xx+10;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Boy;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+$x_inner_house;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
    			  			

			    // Total Students
			    $string = $Students;			    
			    $angle = 0;
			    $x = $xx+($x_inner_house - 25);
			    $y = $yy + $y_inner + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			}else// South Campus
			if($strength_report['grade_name'] == 'South Campus'){
				$yy = 2050;
				$y_inner = 105;
				$x_inner_house = 130;
				$Gap = 150;

				// Jinnah, Iqbal, Syed
				$string = $Jinnah;			    
			    $angle = 0;
			    $x = $xx+($i*$Gap);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Iqbal;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*$Gap);
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
			    $x = $xx+10;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Boy;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+$x_inner_house;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
    			  			

			    // Total Students
			    $string = $Students;			    
			    $angle = 0;
			    $x = $xx+($x_inner_house - 25);
			    $y = $yy + $y_inner + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			}
		}


	    /**************************************************************
		// Call Wing
		// Num of (Jinnah, Iqbal, Syed) and (Boys, Girls)
		//*************************************************************/
		$i=0;
		$xx = 835;
	    $fontSize = 35;	    
		foreach ($data['wing_strength_report'] as $strength_report) {	    			
			$WingName = $strength_report['wing_name'];			
			$Jinnah = $strength_report['jinnah'];
			$Iqbal = $strength_report['iqbal'];
			$Syed = $strength_report['syed'];
			$Girl = $strength_report['girl'];
			$Boy = $strength_report['boy'];
			$Students = $strength_report['students'];		

			// Pre-Primary
			if($strength_report['wing_name'] == 'Pre-Primary'){
				$yy = 595;
				$y_inner = 52;
				$x_inner_house = 108;
				$Gap = 150;

				// Jinnah, Iqbal, Syed
				$string = $Jinnah;			    
			    $angle = 0;
			    $x = $xx+($i*$Gap);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Iqbal;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*$Gap);
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
			    $x = $xx+10;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Boy;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+$x_inner_house;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
    			  			

			    // Total Students
			    $string = $Students;			    
			    $angle = 0;
			    $x = $xx+($x_inner_house);
			    $y = $yy + $y_inner + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			}else// Elementry
			if($strength_report['wing_name'] == 'Elementary'){
				$yy = 1228;
				$y_inner = 52;
				$x_inner_house = 108;
				$Gap = 150;

				// Jinnah, Iqbal, Syed
				$string = $Jinnah;			    
			    $angle = 0;
			    $x = $xx+($i*$Gap);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Iqbal;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*$Gap);
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
			    $x = $xx+10;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Boy;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+$x_inner_house;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
    			  			

			    // Total Students
			    $string = $Students;			    
			    $angle = 0;
			    $x = $xx+($x_inner_house);
			    $y = $yy + $y_inner + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			}else// Junior
			if($strength_report['wing_name'] == 'Junior'){
				$yy = 1860;
				$y_inner = 52;
				$x_inner_house = 108;
				$Gap = 150;

				// Jinnah, Iqbal, Syed
				$string = $Jinnah;			    
			    $angle = 0;
			    $x = $xx+($i*$Gap);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Iqbal;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*$Gap);
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
			    $x = $xx+10;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Boy;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+$x_inner_house;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
    			  			

			    // Total Students
			    $string = $Students;			    
			    $angle = 0;
			    $x = $xx+($x_inner_house);
			    $y = $yy + $y_inner + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			}else// Middler
			if($strength_report['wing_name'] == 'Middler'){
				$yy = 2600;
				$y_inner = 52;
				$x_inner_house = 108;
				$Gap = 150;

				// Jinnah, Iqbal, Syed
				$string = $Jinnah;			    
			    $angle = 0;
			    $x = $xx+($i*$Gap);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Iqbal;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*$Gap);
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
			    $x = $xx+10;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Boy;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+$x_inner_house;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
    			  			

			    // Total Students
			    $string = $Students;			    
			    $angle = 0;
			    $x = $xx+($x_inner_house);
			    $y = $yy + $y_inner + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			}else// O-Level
			if($strength_report['wing_name'] == 'O-Level'){
				$yy = 3128;
				$y_inner = 52;
				$x_inner_house = 108;
				$Gap = 150;

				// Jinnah, Iqbal, Syed
				$string = $Jinnah;			    
			    $angle = 0;
			    $x = $xx+($i*$Gap);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Iqbal;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*$Gap);
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
			    $x = $xx+10;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Boy;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+$x_inner_house;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
    			  			

			    // Total Students
			    $string = $Students;			    
			    $angle = 0;
			    $x = $xx+($x_inner_house);
			    $y = $yy + $y_inner + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			}else// A-Level
			if($strength_report['wing_name'] == 'A-Level'){
				$yy = 3552;
				$y_inner = 52;
				$x_inner_house = 108;
				$Gap = 150;

				// Jinnah, Iqbal, Syed
				$string = $Jinnah;			    
			    $angle = 0;
			    $x = $xx+($i*$Gap);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Iqbal;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*$Gap);
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
			    $x = $xx+10;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Boy;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+$x_inner_house;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
    			  			

			    // Total Students
			    $string = $Students;			    
			    $angle = 0;
			    $x = $xx+($x_inner_house);
			    $y = $yy + $y_inner + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			}
		}

	    /**************************************************************
		// Call Grade
		// Num of (Jinnah, Iqbal, Syed) and (Boys, Girls)
		//*************************************************************/
		$i=0;
		$xx = 1230;
	    $fontSize = 32;	    
		foreach ($data['grade_strength_report'] as $strength_report) {	    			
			$GradeName = $strength_report['grade_name'];			
			$Jinnah = $strength_report['jinnah'];
			$Iqbal = $strength_report['iqbal'];
			$Syed = $strength_report['syed'];
			$Girl = $strength_report['girl'];
			$Boy = $strength_report['boy'];
			$Students = $strength_report['students'];			

			// Pre-Nursery			
			if($strength_report['grade_name'] == 'PN'){				
				$yy = 380;
				$y_inner = 55;
				$x_inner_house = 95;
				$Gap = 150;

				// Jinnah, Iqbal, Syed
				$string = $Jinnah;			    
			    $angle = 0;
			    $x = $xx+($i*$Gap);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Iqbal;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*$Gap);
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
			    $x = $xx+10;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Boy;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($x_inner_house/1.5);
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
    			  			

			    // Total Students
			    $string = $Students;			    
			    $angle = 0;
			    $x = $xx+($x_inner_house);
			    $y = $yy + $y_inner + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			}else // Nursery
			if($strength_report['grade_name'] == 'N'){
				$yy = 590;
				$y_inner = 55;
				$x_inner_house = 95;
				$Gap = 150;

				// Jinnah, Iqbal, Syed
				$string = $Jinnah;			    
			    $angle = 0;
			    $x = $xx+($i*$Gap);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Iqbal;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*$Gap);
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
			    $x = $xx+10;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Boy;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($x_inner_house/1.5);
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
    			  			

			    // Total Students
			    $string = $Students;			    
			    $angle = 0;
			    $x = $xx+($x_inner_house);
			    $y = $yy + $y_inner + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			}else // KG
			if($strength_report['grade_name'] == 'KG'){
				$yy = 800;
				$y_inner = 55;
				$x_inner_house = 95;
				$Gap = 150;

				// Jinnah, Iqbal, Syed
				$string = $Jinnah;			    
			    $angle = 0;
			    $x = $xx+($i*$Gap);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Iqbal;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*$Gap);
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
			    $x = $xx+10;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Boy;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($x_inner_house/1.5);
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
    			  			

			    // Total Students
			    $string = $Students;			    
			    $angle = 0;
			    $x = $xx+($x_inner_house);
			    $y = $yy + $y_inner + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			}else // I
			if($strength_report['grade_name'] == 'I'){
				$yy = 1120;
				$y_inner = 55;
				$x_inner_house = 95;
				$Gap = 150;

				// Jinnah, Iqbal, Syed
				$string = $Jinnah;			    
			    $angle = 0;
			    $x = $xx+($i*$Gap);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Iqbal;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*$Gap);
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
			    $x = $xx+10;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Boy;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($x_inner_house/1.5);
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
    			  			

			    // Total Students
			    $string = $Students;			    
			    $angle = 0;
			    $x = $xx+($x_inner_house);
			    $y = $yy + $y_inner + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			}else {
				// II			
				$yy = $yy + 211;
				$y_inner = 55;
				$x_inner_house = 95;
				$Gap = 150;

				// Jinnah, Iqbal, Syed
				$string = $Jinnah;			    
			    $angle = 0;
			    $x = $xx+($i*$Gap);
			    $y = $yy;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Iqbal;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($i*$Gap);
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
			    $x = $xx+10;
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

			    $string = $Boy;			    
			    $angle = 0;
			    $x = $xx+$x_inner_house+($x_inner_house/1.5);
			    $y = $yy + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
    			  			

			    // Total Students
			    $string = $Students;			    
			    $angle = 0;
			    $x = $xx+($x_inner_house);
			    $y = $yy + $y_inner + $y_inner;
			    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			}
		}



	    /**************************************************************
		// Call Grade-Section
		// Num of (Jinnah, Iqbal, Syed) and (Boys, Girls)
		//*************************************************************/
	    $i=0;
	    $fontSize = 32;
		foreach ($data['strength_report'] as $strength_report) {	    			
			$GradeName = $strength_report['grade_name'];
			$SectionName = $strength_report['section_name'];
			$Jinnah = $strength_report['jinnah'];
			$Iqbal = $strength_report['iqbal'];
			$Syed = $strength_report['syed'];
			$Girl = $strength_report['girl'];
			$Boy = $strength_report['boy'];
			$Students = $strength_report['students'];

			if($Boy == 0){
				$Boy = "";
			}
			if($Girl == 0){
				$Girl = "";
			}
			

			if($strength_report['grade_name'] == 'PN' || $strength_report['grade_name'] == 'N' || $strength_report['grade_name'] == 'KG')
			{
				if ($i >= 10){
					$i = 0;
				}
			}else{
				if ($i >= count($sectionNames)){
					$i = 0;
				}
			}

			if(in_array($SectionName, $sectionNames)){
				while($SectionName != $sectionNames[$i]){
				    $i++;
				    if ($i >= count($sectionNames)){
	    				$i = 0;
	    			}
	    		}
			}	

			if($strength_report['grade_name'] == 'PN' || $strength_report['grade_name'] == 'N' || $strength_report['grade_name'] == 'KG')
			{
				if ($i >= 10){
					$i = 0;
				}
			}else{
				if ($i >= count($sectionNames)){
					$i = 0;
				}
			}

			// Pre-Nursery			
			if($strength_report['grade_name'] == 'PN'){
				if ($strength_report['section_name'] != 'Bin'){
					if($i < 5){
						$xx = 1670 + ($i*152);
					}else{
						$xx = 1670 + ($i*153);
					}

					$yy = 380;
					$y_inner = 55;
					$x_inner_house = 95;
					$Gap = 150;

					// Jinnah, Iqbal, Syed
					$string = $Jinnah;			    
				    $angle = 0;
				    $x = $xx+($i*$Gap);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Iqbal;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($i*$Gap);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

					$string = $Syed;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+$x_inner_house+($i*$Gap)+5;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


				    // Boy and Girl
				    $string = $Girl;			    
				    $angle = 0;
				    $x = $xx+10+($i*$Gap);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Boy;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($x_inner_house/1.5)+($i*$Gap);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
	    			  			

				    // Total Students
				    $string = $Students;			    
				    $angle = 0;
				    $x = $xx+($x_inner_house+($i*$Gap));
				    $y = $yy + $y_inner + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			    }  else if ($strength_report['section_name'] == 'Bin'){
			    	$xx = 4780;
			    	// Jinnah, Iqbal, Syed
					$string = $Jinnah;			    
				    $angle = 0;
				    $x = $xx;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Iqbal;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

					$string = $Syed;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+$x_inner_house+5;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


				    // Boy and Girl
				    $string = $Girl;			    
				    $angle = 0;
				    $x = $xx+10;
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Boy;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($x_inner_house/1.5);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
	    			  			

				    // Total Students
				    $string = $Students;			    
				    $angle = 0;
				    $x = $xx+($x_inner_house);
				    $y = $yy + $y_inner + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			    }			
			}else // Nursery			
			if($strength_report['grade_name'] == 'N'){
				if ($strength_report['section_name'] != 'Bin'){
					if($i < 5){
						$xx = 1670 + ($i*152);
					}else{
						$xx = 1670 + ($i*153);
					}

					$yy = 590;
					$y_inner = 55;
					$x_inner_house = 95;
					$Gap = 150;

					// Jinnah, Iqbal, Syed
					$string = $Jinnah;			    
				    $angle = 0;
				    $x = $xx+($i*$Gap);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Iqbal;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($i*$Gap);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

					$string = $Syed;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+$x_inner_house+($i*$Gap)+5;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


				    // Boy and Girl
				    $string = $Girl;			    
				    $angle = 0;
				    $x = $xx+10+($i*$Gap);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Boy;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($x_inner_house/1.5)+($i*$Gap);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
	    			  			

				    // Total Students
				    $string = $Students;			    
				    $angle = 0;
				    $x = $xx+($x_inner_house+($i*$Gap));
				    $y = $yy + $y_inner + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			    }  else if ($strength_report['section_name'] == 'Bin'){
			    	$xx = 4780;
			    	// Jinnah, Iqbal, Syed
					$string = $Jinnah;			    
				    $angle = 0;
				    $x = $xx;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Iqbal;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

					$string = $Syed;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+$x_inner_house+5;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


				    // Boy and Girl
				    $string = $Girl;			    
				    $angle = 0;
				    $x = $xx+10;
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Boy;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($x_inner_house/1.5);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
	    			  			

				    // Total Students
				    $string = $Students;			    
				    $angle = 0;
				    $x = $xx+($x_inner_house);
				    $y = $yy + $y_inner + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			    }   			
			} else // KG			
			if($strength_report['grade_name'] == 'KG'){
				if ($strength_report['section_name'] != 'Bin'){
					if($i < 5){
						$xx = 1670 + ($i*152);
					}else{
						$xx = 1670 + ($i*153);
					}

					$yy = 800;
					$y_inner = 55;
					$x_inner_house = 95;
					$Gap = 150;

					// Jinnah, Iqbal, Syed
					$string = $Jinnah;			    
				    $angle = 0;
				    $x = $xx+($i*$Gap);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Iqbal;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($i*$Gap);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

					$string = $Syed;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+$x_inner_house+($i*$Gap)+5;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


				    // Boy and Girl
				    $string = $Girl;			    
				    $angle = 0;
				    $x = $xx+10+($i*$Gap);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Boy;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($x_inner_house/1.5)+($i*$Gap);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
	    			  			

				    // Total Students
				    $string = $Students;			    
				    $angle = 0;
				    $x = $xx+($x_inner_house+($i*$Gap));
				    $y = $yy + $y_inner + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			    }  else if ($strength_report['section_name'] == 'Bin'){
			    	$xx = 4780;
			    	// Jinnah, Iqbal, Syed
					$string = $Jinnah;			    
				    $angle = 0;
				    $x = $xx;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Iqbal;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

					$string = $Syed;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+$x_inner_house+5;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


				    // Boy and Girl
				    $string = $Girl;			    
				    $angle = 0;
				    $x = $xx+10;
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Boy;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($x_inner_house/1.5);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
	    			  			

				    // Total Students
				    $string = $Students;			    
				    $angle = 0;
				    $x = $xx+($x_inner_house);
				    $y = $yy + $y_inner + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			    } 			
			}else // I			
			if($strength_report['grade_name'] == 'I'){
				if ($strength_report['section_name'] != 'Bin'){
					if($i < 5){
						$xx = 1670 + ($i*152);
					}else{
						$xx = 1670 + ($i*153);
					}

					$yy = 1120;
					$y_inner = 55;
					$x_inner_house = 95;
					$Gap = 150;

					// Jinnah, Iqbal, Syed
					$string = $Jinnah;			    
				    $angle = 0;
				    $x = $xx+($i*$Gap);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Iqbal;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($i*$Gap);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

					$string = $Syed;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+$x_inner_house+($i*$Gap)+5;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


				    // Boy and Girl
				    $string = $Girl;			    
				    $angle = 0;
				    $x = $xx+10+($i*$Gap);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Boy;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($x_inner_house/1.5)+($i*$Gap);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
	    			  			

				    // Total Students
				    $string = $Students;			    
				    $angle = 0;
				    $x = $xx+($x_inner_house+($i*$Gap));
				    $y = $yy + $y_inner + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			    }  else if ($strength_report['section_name'] == 'Bin'){
			    	$xx = 4780;
			    	// Jinnah, Iqbal, Syed
					$string = $Jinnah;			    
				    $angle = 0;
				    $x = $xx;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Iqbal;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

					$string = $Syed;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+$x_inner_house+5;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


				    // Boy and Girl
				    $string = $Girl;			    
				    $angle = 0;
				    $x = $xx+10;
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Boy;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($x_inner_house/1.5);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
	    			  			

				    // Total Students
				    $string = $Students;			    
				    $angle = 0;
				    $x = $xx+($x_inner_house);
				    $y = $yy + $y_inner + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			    }    			
			} else // II
			if($strength_report['grade_name'] == 'II'){
				if ($strength_report['section_name'] != 'Bin'){
					if($i < 5){
						$xx = 1670 + ($i*152);
					}else{
						$xx = 1670 + ($i*153);
					}

					$yy = 1330;
					$y_inner = 55;
					$x_inner_house = 95;
					$Gap = 150;

					// Jinnah, Iqbal, Syed
					$string = $Jinnah;			    
				    $angle = 0;
				    $x = $xx+($i*$Gap);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Iqbal;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($i*$Gap);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

					$string = $Syed;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+$x_inner_house+($i*$Gap)+5;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


				    // Boy and Girl
				    $string = $Girl;			    
				    $angle = 0;
				    $x = $xx+10+($i*$Gap);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Boy;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($x_inner_house/1.5)+($i*$Gap);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
	    			  			

				    // Total Students
				    $string = $Students;			    
				    $angle = 0;
				    $x = $xx+($x_inner_house+($i*$Gap));
				    $y = $yy + $y_inner + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			    }  else if ($strength_report['section_name'] == 'Bin'){
			    	$xx = 4780;
			    	// Jinnah, Iqbal, Syed
					$string = $Jinnah;			    
				    $angle = 0;
				    $x = $xx;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Iqbal;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

					$string = $Syed;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+$x_inner_house+5;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


				    // Boy and Girl
				    $string = $Girl;			    
				    $angle = 0;
				    $x = $xx+10;
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Boy;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($x_inner_house/1.5);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
	    			  			

				    // Total Students
				    $string = $Students;			    
				    $angle = 0;
				    $x = $xx+($x_inner_house);
				    $y = $yy + $y_inner + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			    }  			
			}else // III
			if($strength_report['grade_name'] == 'III'){
				if ($strength_report['section_name'] != 'Bin'){
					if($i < 5){
						$xx = 1670 + ($i*152);
					}else{
						$xx = 1670 + ($i*153);
					}

					$yy = 1540;
					$y_inner = 55;
					$x_inner_house = 95;
					$Gap = 150;

					// Jinnah, Iqbal, Syed
					$string = $Jinnah;			    
				    $angle = 0;
				    $x = $xx+($i*$Gap);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Iqbal;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($i*$Gap);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

					$string = $Syed;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+$x_inner_house+($i*$Gap)+5;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


				    // Boy and Girl
				    $string = $Girl;			    
				    $angle = 0;
				    $x = $xx+10+($i*$Gap);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Boy;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($x_inner_house/1.5)+($i*$Gap);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
	    			  			

				    // Total Students
				    $string = $Students;			    
				    $angle = 0;
				    $x = $xx+($x_inner_house+($i*$Gap));
				    $y = $yy + $y_inner + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			    }  else if ($strength_report['section_name'] == 'Bin'){
			    	$xx = 4780;
			    	// Jinnah, Iqbal, Syed
					$string = $Jinnah;			    
				    $angle = 0;
				    $x = $xx;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Iqbal;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

					$string = $Syed;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+$x_inner_house+5;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


				    // Boy and Girl
				    $string = $Girl;			    
				    $angle = 0;
				    $x = $xx+10;
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Boy;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($x_inner_house/1.5);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
	    			  			

				    // Total Students
				    $string = $Students;			    
				    $angle = 0;
				    $x = $xx+($x_inner_house);
				    $y = $yy + $y_inner + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			    }   			
			}else // IV
			if($strength_report['grade_name'] == 'IV'){
				if ($strength_report['section_name'] != 'Bin'){
					if($i < 5){
						$xx = 1670 + ($i*152);
					}else{
						$xx = 1670 + ($i*153);
					}

					$yy = 1750;
					$y_inner = 55;
					$x_inner_house = 95;
					$Gap = 150;

					// Jinnah, Iqbal, Syed
					$string = $Jinnah;			    
				    $angle = 0;
				    $x = $xx+($i*$Gap);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Iqbal;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($i*$Gap);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

					$string = $Syed;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+$x_inner_house+($i*$Gap)+5;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


				    // Boy and Girl
				    $string = $Girl;			    
				    $angle = 0;
				    $x = $xx+10+($i*$Gap);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Boy;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($x_inner_house/1.5)+($i*$Gap);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
	    			  			

				    // Total Students
				    $string = $Students;			    
				    $angle = 0;
				    $x = $xx+($x_inner_house+($i*$Gap));
				    $y = $yy + $y_inner + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			    }  else if ($strength_report['section_name'] == 'Bin'){
			    	$xx = 4780;
			    	// Jinnah, Iqbal, Syed
					$string = $Jinnah;			    
				    $angle = 0;
				    $x = $xx;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Iqbal;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

					$string = $Syed;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+$x_inner_house+5;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


				    // Boy and Girl
				    $string = $Girl;			    
				    $angle = 0;
				    $x = $xx+10;
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Boy;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($x_inner_house/1.5);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
	    			  			

				    // Total Students
				    $string = $Students;			    
				    $angle = 0;
				    $x = $xx+($x_inner_house);
				    $y = $yy + $y_inner + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			    }   			
			}else // V
			if($strength_report['grade_name'] == 'V'){
				if ($strength_report['section_name'] != 'Bin'){
					if($i < 5){
						$xx = 1670 + ($i*152);
					}else{
						$xx = 1670 + ($i*153);
					}

					$yy = 1965;
					$y_inner = 55;
					$x_inner_house = 95;
					$Gap = 150;

					// Jinnah, Iqbal, Syed
					$string = $Jinnah;			    
				    $angle = 0;
				    $x = $xx+($i*$Gap);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Iqbal;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($i*$Gap);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

					$string = $Syed;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+$x_inner_house+($i*$Gap)+5;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


				    // Boy and Girl
				    $string = $Girl;			    
				    $angle = 0;
				    $x = $xx+10+($i*$Gap);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Boy;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($x_inner_house/1.5)+($i*$Gap);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
	    			  			

				    // Total Students
				    $string = $Students;			    
				    $angle = 0;
				    $x = $xx+($x_inner_house+($i*$Gap));
				    $y = $yy + $y_inner + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			    }  else if ($strength_report['section_name'] == 'Bin'){
			    	$xx = 4780;
			    	// Jinnah, Iqbal, Syed
					$string = $Jinnah;			    
				    $angle = 0;
				    $x = $xx;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Iqbal;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

					$string = $Syed;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+$x_inner_house+5;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


				    // Boy and Girl
				    $string = $Girl;			    
				    $angle = 0;
				    $x = $xx+10;
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Boy;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($x_inner_house/1.5);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
	    			  			

				    // Total Students
				    $string = $Students;			    
				    $angle = 0;
				    $x = $xx+($x_inner_house);
				    $y = $yy + $y_inner + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			    }    			
			}else // VI
			if($strength_report['grade_name'] == 'VI'){
				if ($strength_report['section_name'] != 'Bin'){
					if($i < 5){
						$xx = 1670 + ($i*152);
					}else{
						$xx = 1670 + ($i*153);
					}

					$yy = 2176;
					$y_inner = 55;
					$x_inner_house = 95;
					$Gap = 150;

					// Jinnah, Iqbal, Syed
					$string = $Jinnah;			    
				    $angle = 0;
				    $x = $xx+($i*$Gap);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Iqbal;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($i*$Gap);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

					$string = $Syed;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+$x_inner_house+($i*$Gap)+5;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


				    // Boy and Girl
				    $string = $Girl;			    
				    $angle = 0;
				    $x = $xx+10+($i*$Gap);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Boy;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($x_inner_house/1.5)+($i*$Gap);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
	    			  			

				    // Total Students
				    $string = $Students;			    
				    $angle = 0;
				    $x = $xx+($x_inner_house+($i*$Gap));
				    $y = $yy + $y_inner + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			    }  else if ($strength_report['section_name'] == 'Bin'){
			    	$xx = 4780;
			    	// Jinnah, Iqbal, Syed
					$string = $Jinnah;			    
				    $angle = 0;
				    $x = $xx;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Iqbal;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

					$string = $Syed;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+$x_inner_house+5;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


				    // Boy and Girl
				    $string = $Girl;			    
				    $angle = 0;
				    $x = $xx+10;
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Boy;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($x_inner_house/1.5);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
	    			  			

				    // Total Students
				    $string = $Students;			    
				    $angle = 0;
				    $x = $xx+($x_inner_house);
				    $y = $yy + $y_inner + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			    }   			
			}else // VII
			if($strength_report['grade_name'] == 'VII'){
				if ($strength_report['section_name'] != 'Bin'){
					if($i < 5){
						$xx = 1670 + ($i*152);
					}else{
						$xx = 1670 + ($i*153);
					}

					$yy = 2387;
					$y_inner = 55;
					$x_inner_house = 95;
					$Gap = 150;

					// Jinnah, Iqbal, Syed
					$string = $Jinnah;			    
				    $angle = 0;
				    $x = $xx+($i*$Gap);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Iqbal;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($i*$Gap);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

					$string = $Syed;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+$x_inner_house+($i*$Gap)+5;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


				    // Boy and Girl
				    $string = $Girl;			    
				    $angle = 0;
				    $x = $xx+10+($i*$Gap);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Boy;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($x_inner_house/1.5)+($i*$Gap);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
	    			  			

				    // Total Students
				    $string = $Students;			    
				    $angle = 0;
				    $x = $xx+($x_inner_house+($i*$Gap));
				    $y = $yy + $y_inner + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			    }  else if ($strength_report['section_name'] == 'Bin'){
			    	$xx = 4780;
			    	// Jinnah, Iqbal, Syed
					$string = $Jinnah;			    
				    $angle = 0;
				    $x = $xx;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Iqbal;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

					$string = $Syed;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+$x_inner_house+5;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


				    // Boy and Girl
				    $string = $Girl;			    
				    $angle = 0;
				    $x = $xx+10;
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Boy;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($x_inner_house/1.5);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
	    			  			

				    // Total Students
				    $string = $Students;			    
				    $angle = 0;
				    $x = $xx+($x_inner_house);
				    $y = $yy + $y_inner + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			    }   			
			}else // VIII
			if($strength_report['grade_name'] == 'VIII'){
				if ($strength_report['section_name'] != 'Bin'){
					if($i < 5){
						$xx = 1670 + ($i*152);
					}else{
						$xx = 1670 + ($i*153);
					}

					$yy = 2598;
					$y_inner = 55;
					$x_inner_house = 95;
					$Gap = 150;

					// Jinnah, Iqbal, Syed
					$string = $Jinnah;			    
				    $angle = 0;
				    $x = $xx+($i*$Gap);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Iqbal;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($i*$Gap);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

					$string = $Syed;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+$x_inner_house+($i*$Gap)+5;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


				    // Boy and Girl
				    $string = $Girl;			    
				    $angle = 0;
				    $x = $xx+10+($i*$Gap);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Boy;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($x_inner_house/1.5)+($i*$Gap);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
	    			  			

				    // Total Students
				    $string = $Students;			    
				    $angle = 0;
				    $x = $xx+($x_inner_house+($i*$Gap));
				    $y = $yy + $y_inner + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			    }  else if ($strength_report['section_name'] == 'Bin'){
			    	$xx = 4780;
			    	// Jinnah, Iqbal, Syed
					$string = $Jinnah;			    
				    $angle = 0;
				    $x = $xx;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Iqbal;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

					$string = $Syed;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+$x_inner_house+5;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


				    // Boy and Girl
				    $string = $Girl;			    
				    $angle = 0;
				    $x = $xx+10;
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Boy;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($x_inner_house/1.5);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
	    			  			

				    // Total Students
				    $string = $Students;			    
				    $angle = 0;
				    $x = $xx+($x_inner_house);
				    $y = $yy + $y_inner + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			    }    			
			}else // IX
			if($strength_report['grade_name'] == 'IX'){
				if ($strength_report['section_name'] != 'Bin'){
					if($i < 5){
						$xx = 1670 + ($i*152);
					}else{
						$xx = 1670 + ($i*153);
					}

					$yy = 2810;
					$y_inner = 55;
					$x_inner_house = 95;
					$Gap = 150;

					// Jinnah, Iqbal, Syed
					$string = $Jinnah;			    
				    $angle = 0;
				    $x = $xx+($i*$Gap);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Iqbal;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($i*$Gap);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

					$string = $Syed;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+$x_inner_house+($i*$Gap)+5;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


				    // Boy and Girl
				    $string = $Girl;			    
				    $angle = 0;
				    $x = $xx+10+($i*$Gap);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Boy;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($x_inner_house/1.5)+($i*$Gap);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
	    			  			

				    // Total Students
				    $string = $Students;			    
				    $angle = 0;
				    $x = $xx+($x_inner_house+($i*$Gap));
				    $y = $yy + $y_inner + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			    }  else if ($strength_report['section_name'] == 'Bin'){
			    	$xx = 4780;
			    	// Jinnah, Iqbal, Syed
					$string = $Jinnah;			    
				    $angle = 0;
				    $x = $xx;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Iqbal;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

					$string = $Syed;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+$x_inner_house+5;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


				    // Boy and Girl
				    $string = $Girl;			    
				    $angle = 0;
				    $x = $xx+10;
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Boy;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($x_inner_house/1.5);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
	    			  			

				    // Total Students
				    $string = $Students;			    
				    $angle = 0;
				    $x = $xx+($x_inner_house);
				    $y = $yy + $y_inner + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			    }    			
			}else // X
			if($strength_report['grade_name'] == 'X'){
				if ($strength_report['section_name'] != 'Bin'){
					if($i < 5){
						$xx = 1670 + ($i*152);
					}else{
						$xx = 1670 + ($i*153);
					}

					$yy = 3020;
					$y_inner = 55;
					$x_inner_house = 95;
					$Gap = 150;

					// Jinnah, Iqbal, Syed
					$string = $Jinnah;			    
				    $angle = 0;
				    $x = $xx+($i*$Gap);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Iqbal;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($i*$Gap);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

					$string = $Syed;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+$x_inner_house+($i*$Gap)+5;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


				    // Boy and Girl
				    $string = $Girl;			    
				    $angle = 0;
				    $x = $xx+10+($i*$Gap);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Boy;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($x_inner_house/1.5)+($i*$Gap);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
	    			  			

				    // Total Students
				    $string = $Students;			    
				    $angle = 0;
				    $x = $xx+($x_inner_house+($i*$Gap));
				    $y = $yy + $y_inner + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			    }  else if ($strength_report['section_name'] == 'Bin'){
			    	$xx = 4780;
			    	// Jinnah, Iqbal, Syed
					$string = $Jinnah;			    
				    $angle = 0;
				    $x = $xx;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Iqbal;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

					$string = $Syed;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+$x_inner_house+5;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


				    // Boy and Girl
				    $string = $Girl;			    
				    $angle = 0;
				    $x = $xx+10;
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Boy;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($x_inner_house/1.5);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
	    			  			

				    // Total Students
				    $string = $Students;			    
				    $angle = 0;
				    $x = $xx+($x_inner_house);
				    $y = $yy + $y_inner + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			    }    			
			}else // XI
			if($strength_report['grade_name'] == 'XI'){
				if ($strength_report['section_name'] != 'Bin'){
					if($i < 5){
						$xx = 1670 + ($i*152);
					}else{
						$xx = 1670 + ($i*153);
					}

					$yy = 3235;
					$y_inner = 55;
					$x_inner_house = 95;
					$Gap = 150;

					// Jinnah, Iqbal, Syed
					$string = $Jinnah;			    
				    $angle = 0;
				    $x = $xx+($i*$Gap);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Iqbal;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($i*$Gap);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

					$string = $Syed;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+$x_inner_house+($i*$Gap)+5;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


				    // Boy and Girl
				    $string = $Girl;			    
				    $angle = 0;
				    $x = $xx+10+($i*$Gap);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Boy;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($x_inner_house/1.5)+($i*$Gap);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
	    			  			

				    // Total Students
				    $string = $Students;			    
				    $angle = 0;
				    $x = $xx+($x_inner_house+($i*$Gap));
				    $y = $yy + $y_inner + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			    }  else if ($strength_report['section_name'] == 'Bin'){
			    	$xx = 4780;
			    	// Jinnah, Iqbal, Syed
					$string = $Jinnah;			    
				    $angle = 0;
				    $x = $xx;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Iqbal;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

					$string = $Syed;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+$x_inner_house+5;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


				    // Boy and Girl
				    $string = $Girl;			    
				    $angle = 0;
				    $x = $xx+10;
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Boy;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($x_inner_house/1.5);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
	    			  			

				    // Total Students
				    $string = $Students;			    
				    $angle = 0;
				    $x = $xx+($x_inner_house);
				    $y = $yy + $y_inner + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			    }    			
			}else // A1
			if($strength_report['grade_name'] == 'A1'){
				if ($strength_report['section_name'] != 'Bin'){
					if($i < 5){
						$xx = 1670 + ($i*152);
					}else{
						$xx = 1670 + ($i*153);
					}

					$yy = 3445;
					$y_inner = 55;
					$x_inner_house = 95;
					$Gap = 150;

					// Jinnah, Iqbal, Syed
					$string = $Jinnah;			    
				    $angle = 0;
				    $x = $xx+($i*$Gap);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Iqbal;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($i*$Gap);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

					$string = $Syed;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+$x_inner_house+($i*$Gap)+5;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


				    // Boy and Girl
				    $string = $Girl;			    
				    $angle = 0;
				    $x = $xx+10+($i*$Gap);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Boy;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($x_inner_house/1.5)+($i*$Gap);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
	    			  			

				    // Total Students
				    $string = $Students;			    
				    $angle = 0;
				    $x = $xx+($x_inner_house+($i*$Gap));
				    $y = $yy + $y_inner + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			    }  else if ($strength_report['section_name'] == 'Bin'){
			    	$xx = 4780;
			    	// Jinnah, Iqbal, Syed
					$string = $Jinnah;			    
				    $angle = 0;
				    $x = $xx;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Iqbal;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

					$string = $Syed;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+$x_inner_house+5;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


				    // Boy and Girl
				    $string = $Girl;			    
				    $angle = 0;
				    $x = $xx+10;
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Boy;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($x_inner_house/1.5);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
	    			  			

				    // Total Students
				    $string = $Students;			    
				    $angle = 0;
				    $x = $xx+($x_inner_house);
				    $y = $yy + $y_inner + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			    }    			
			}else // A2
			if($strength_report['grade_name'] == 'A2'){
				 if ($strength_report['section_name'] != 'Bin'){
					if($i < 5){
						$xx = 1670 + ($i*152);
					}else{
						$xx = 1670 + ($i*153);
					}

					$yy = 3655;
					$y_inner = 55;
					$x_inner_house = 95;
					$Gap = 150;

					// Jinnah, Iqbal, Syed
					$string = $Jinnah;			    
				    $angle = 0;
				    $x = $xx+($i*$Gap);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Iqbal;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($i*$Gap);
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

					$string = $Syed;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+$x_inner_house+($i*$Gap)+5;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


				    // Boy and Girl
				    $string = $Girl;			    
				    $angle = 0;
				    $x = $xx+10+($i*$Gap);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Boy;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($x_inner_house/1.5)+($i*$Gap);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
	    			  			

				    // Total Students
				    $string = $Students;			    
				    $angle = 0;
				    $x = $xx+($x_inner_house+($i*$Gap));
				    $y = $yy + $y_inner + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
			    }  else if ($strength_report['section_name'] == 'Bin'){
			    	$xx = 4780;
			    	// Jinnah, Iqbal, Syed
					$string = $Jinnah;			    
				    $angle = 0;
				    $x = $xx;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Iqbal;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

					$string = $Syed;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+$x_inner_house+5;
				    $y = $yy;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);


				    // Boy and Girl
				    $string = $Girl;			    
				    $angle = 0;
				    $x = $xx+10;
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);

				    $string = $Boy;			    
				    $angle = 0;
				    $x = $xx+$x_inner_house+($x_inner_house/1.5);
				    $y = $yy + $y_inner;
				    imagettftext($image, $fontSize, $angle, $x, $y, $colorText, $font_path, $string);
	    			  			

				    // Total Students
				    $string = $Students;			    
				    $angle = 0;
				    $x = $xx+($x_inner_house);
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
		$this->getPDFNow($this->input->post());
	}


	public function getPDFNow($data)
	{
		$WHERE = '(';
		foreach ($data as $condition) {
			foreach ($condition as $thisCondition) {
				$WHERE .= 'cl.std_status_id = '. $thisCondition . ' or ';	
			}			
		}
		$WHERE = substr($WHERE, 0, strlen($WHERE)-4);
		$WHERE .= ')';


		$this->load->model('school_wide_report/student_strength_model');
		$data['strength_report'] = $this->student_strength_model->getStudentGradeSectionSummary_where($WHERE);
		$data['grade_strength_report'] = $this->student_strength_model->getStudentGradeSummary_where($WHERE);
		$data['wing_strength_report'] = $this->student_strength_model->getStudentWingSummary_where($WHERE);
		$data['campus_strength_report'] = $this->student_strength_model->getStudentCampusSummary_where($WHERE);


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
		$now_date = date('l, F d, Y');

		require_once('components/pdf/fpdf/fpdf.php');
		require_once('components/pdf/fpdi/fpdi.php');

		
		// initiate FPDI
		$pdf = new FPDI();

		// get the page count
		$pageCount = $pdf->setSourceFile('components/pdf/school/school_wide_report/student_strength_report.pdf');
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

	    		// Border on
	    		$bo = 0;

	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',15);
			    $pdf->SetFillColor(255,255,255);
			    $pdf->SetDrawColor(255,0,0);
			    $pdf->SetXY(5,4);
			    $pdf->Cell(288, 7, $now_date, $bo, 0, 'R', 0);

	    		$pdf->SetTextColor(255,255,255);
			    $pdf->SetFont($font_name,'',7.5);
			    $pdf->SetFillColor(0,0,0);
			    $pdf->SetXY(233, 202.5);
			    $pdf->Cell(60, 3.5, date('D-d-M-Y H:i') . ' (' . ucwords($this->data['staff_registered_data'][0]->abridged_name) . ')', 0, 0, 'R', true);
			    $pdf->SetTextColor(0,0,0);

			    /**************************************************************
				* Call School
				* Num of (Jinnah, Iqbal, Syed) and (Boys, Girls)
				/*************************************************************/			   	
				$Jinnah = $data['campus_strength_report'][0]['jinnah'] + $data['campus_strength_report'][1]['jinnah'];
				$Iqbal = $data['campus_strength_report'][0]['iqbal'] + $data['campus_strength_report'][1]['iqbal'];
				$Syed = $data['campus_strength_report'][0]['syed'] + $data['campus_strength_report'][1]['syed'];
				$Girl = $data['campus_strength_report'][0]['girl'] + $data['campus_strength_report'][1]['girl'];
				$Boy = $data['campus_strength_report'][0]['boy'] + $data['campus_strength_report'][1]['boy'];
				$Students = $data['campus_strength_report'][0]['students'] + $data['campus_strength_report'][1]['students'];
				$PetStudents = $data['campus_strength_report'][0]['pet_students'] + $data['campus_strength_report'][1]['pet_students'];

				$x = 12.7;
				$y = 73;
				$cx = 6.85;
				$cy = 4.5;
				$FontSize = 7.5;

				// Jinnah, Iqbal, Syed
				$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',$FontSize);
			    $pdf->SetFillColor(255,255,255);
			    $pdf->SetDrawColor(255,0,0);
			    $pdf->SetXY($x,$y);
			    $pdf->Cell($cx, $cy, $Jinnah, $bo, 0, 'C', 0);

			    
    			$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',$FontSize);
			    $pdf->SetFillColor(255,255,255);
			    $pdf->SetDrawColor(255,0,0);
			    $pdf->SetXY($x+$cx,$y);
			    $pdf->Cell($cx, $cy, $Iqbal, $bo, 0, 'C', 0);

			    
    			$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',$FontSize);
			    $pdf->SetFillColor(255,255,255);
			    $pdf->SetDrawColor(255,0,0);
			    $pdf->SetXY($x+$cx+$cx,$y);
			    $pdf->Cell($cx, $cy, $Syed, $bo, 0, 'C', 0);


			    // Boy and Girl

    			$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',$FontSize);
			    $pdf->SetFillColor(255,255,255);
			    $pdf->SetDrawColor(255,0,0);
			    $pdf->SetXY($x,$y+($cy*1.85));
			    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);

    			
    			$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',$FontSize);
			    $pdf->SetFillColor(255,255,255);
			    $pdf->SetDrawColor(255,0,0);
			    $pdf->SetXY($x+$cx+($cx/2),$y+($cy*1.85));
			    $pdf->MultiCell($cx+($cx/2), $cy, $Boy, $bo, 'C', 0);


			    // Total Students			    
    			$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',$FontSize);
			    $pdf->SetFillColor(255,255,255);
			    $pdf->SetDrawColor(255,0,0);
			    $pdf->SetXY($x,$y+($cy*3.7));
			    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);

			    // Pet Student
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',$FontSize);
			    $pdf->SetFillColor(255,255,255);
			    $pdf->SetDrawColor(255,0,0);
			    $pdf->SetXY($x,$y+($cy*4.7));
			    $pdf->MultiCell($cx*3, $cy, $PetStudents, $bo, 'C', 0);
				/**************************************************************
				* Call Campus
				* Num of (Jinnah, Iqbal, Syed) and (Boys, Girls)
				/*************************************************************/
				$i=0;
				foreach ($data['campus_strength_report'] as $campus_strength_report) {
					$CampusName = $campus_strength_report['grade_name'];	    			
	    			$Jinnah = $campus_strength_report['jinnah'];
	    			$Iqbal = $campus_strength_report['iqbal'];
	    			$Syed = $campus_strength_report['syed'];
	    			$Girl = $campus_strength_report['girl'];
	    			$Boy = $campus_strength_report['boy'];
	    			$Students = $campus_strength_report['students'];
	    			$PetStudents = $campus_strength_report['pet_students'];
	    				

	    			if($CampusName = 'North Campus'){
	    				if($campus_strength_report['grade_name'] == 'North Campus'){
	    					$x = 19.5;
							$y = 43.5;
							$cx = 6.85;
							$cy = 5.5;
							$FontSize = 7.5;

							// Jinnah, Iqbal, Syed
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y);
						    $pdf->Cell($cx, $cy, $Jinnah, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx,$y);
						    $pdf->Cell($cx, $cy, $Iqbal, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx,$y);
						    $pdf->Cell($cx, $cy, $Syed, $bo, 0, 'C', 0);


						    // Boy and Girl

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);

			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2),$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Boy, $bo, 'C', 0);


						    // Total Students
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);

						    // Pet Student
						    $pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+($cy*3));
						    $pdf->MultiCell($cx*3, $cy, $PetStudents, $bo, 'C', 0);
	    				}
	    			}
	    			if($CampusName = 'South Campus'){
	    				if($campus_strength_report['grade_name'] == 'South Campus'){
	    					$x = 19.5;
							$y = 110.2;
							$cx = 6.85;
							$cy = 5.5;
							$FontSize = 7.5;

							// Jinnah, Iqbal, Syed
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y);
						    $pdf->Cell($cx, $cy, $Jinnah, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx,$y);
						    $pdf->Cell($cx, $cy, $Iqbal, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx,$y);
						    $pdf->Cell($cx, $cy, $Syed, $bo, 0, 'C', 0);


						    // Boy and Girl

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);

			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2),$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Boy, $bo, 'C', 0);


						    // Total Students
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);

						    // Pet Student
						    $pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+($cy*3));
						    $pdf->MultiCell($cx*3, $cy, $PetStudents, $bo, 'C', 0);
	    				}
	    			}

	    		}

				/**************************************************************
				* Call Wing
				* Num of (Jinnah, Iqbal, Syed) and (Boys, Girls)
				/*************************************************************/
				$i=0;
				foreach ($data['wing_strength_report'] as $wing_strength_report) {
					$WingName = $wing_strength_report['wing_name'];	    			
	    			$Jinnah = $wing_strength_report['jinnah'];
	    			$Iqbal = $wing_strength_report['iqbal'];
	    			$Syed = $wing_strength_report['syed'];
	    			$Girl = $wing_strength_report['girl'];
	    			$Boy = $wing_strength_report['boy'];
	    			$Students = $wing_strength_report['students'];
	    			$PetStudents = $wing_strength_report['pet_students'];

	    			if($WingName = 'Pre-Primary'){
	    				if($wing_strength_report['wing_name'] == 'Pre-Primary'){
	    					$x = 47.5;
							$y = 32.8;
							$cx = 5.8;
							$cy = 2.7;
							$FontSize = 6.5;

							// Jinnah, Iqbal, Syed
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y);
						    $pdf->Cell($cx, $cy, $Jinnah, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx,$y);
						    $pdf->Cell($cx, $cy, $Iqbal, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx,$y);
						    $pdf->Cell($cx, $cy, $Syed, $bo, 0, 'C', 0);


						    // Boy and Girl

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);

			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2),$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Boy, $bo, 'C', 0);


						    // Total Students
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);

						    // Pet Students
						    $pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+($cy*3));
						    $pdf->MultiCell($cx*3, $cy, $PetStudents, $bo, 'C', 0);
	    				}
	    			}
	    			if($WingName = 'Elementary'){
	    				if($wing_strength_report['wing_name'] == 'Elementary'){
	    					$x = 47.5;
							$y = 64.9;
							$cx = 5.8;
							$cy = 2.7;
							$FontSize = 6.5;

							// Jinnah, Iqbal, Syed
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y);
						    $pdf->Cell($cx, $cy, $Jinnah, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx,$y);
						    $pdf->Cell($cx, $cy, $Iqbal, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx,$y);
						    $pdf->Cell($cx, $cy, $Syed, $bo, 0, 'C', 0);


						    // Boy and Girl

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);

			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2),$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Boy, $bo, 'C', 0);


						    // Total Students
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);

						    // Pet Students
						    $pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+($cy*3));
						    $pdf->MultiCell($cx*3, $cy, $PetStudents, $bo, 'C', 0);
	    				}
	    			}
	    			if($WingName = 'Junior'){
	    				if($wing_strength_report['wing_name'] == 'Junior'){
	    					$x = 47.5;
							$y = 102.25;
							$cx = 5.8;
							$cy = 2.7;
							$FontSize = 6.5;

							// Jinnah, Iqbal, Syed
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y);
						    $pdf->Cell($cx, $cy, $Jinnah, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx,$y);
						    $pdf->Cell($cx, $cy, $Iqbal, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx,$y);
						    $pdf->Cell($cx, $cy, $Syed, $bo, 0, 'C', 0);


						    // Boy and Girl

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);

			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2),$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Boy, $bo, 'C', 0);


						    // Total Students
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);

						    // Pet Students
						    $pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+($cy*3));
						    $pdf->MultiCell($cx*3, $cy, $PetStudents, $bo, 'C', 0);
	    				}
	    			}
	    			if($WingName = 'Middler'){
	    				if($wing_strength_report['wing_name'] == 'Middler'){
	    					$x = 47.5;
							$y = 139.6;
							$cx = 5.8;
							$cy = 2.7;
							$FontSize = 6.5;

							// Jinnah, Iqbal, Syed
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y);
						    $pdf->Cell($cx, $cy, $Jinnah, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx,$y);
						    $pdf->Cell($cx, $cy, $Iqbal, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx,$y);
						    $pdf->Cell($cx, $cy, $Syed, $bo, 0, 'C', 0);


						    // Boy and Girl

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);

			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2),$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Boy, $bo, 'C', 0);


						    // Total Students
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);

						    // Pet Students
						    $pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+($cy*3));
						    $pdf->MultiCell($cx*3, $cy, $PetStudents, $bo, 'C', 0);
	    				}
	    			}
	    			if($WingName = 'O-Level'){
	    				if($wing_strength_report['wing_name'] == 'O-Level'){
	    					$x = 47.5;
							$y = 166.3;
							$cx = 5.8;
							$cy = 2.7;
							$FontSize = 6.5;

							// Jinnah, Iqbal, Syed
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y);
						    $pdf->Cell($cx, $cy, $Jinnah, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx,$y);
						    $pdf->Cell($cx, $cy, $Iqbal, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx,$y);
						    $pdf->Cell($cx, $cy, $Syed, $bo, 0, 'C', 0);


						    // Boy and Girl

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);

			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2),$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Boy, $bo, 'C', 0);


						    // Total Students
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);

						    // Pet Students
						    $pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+($cy*3));
						    $pdf->MultiCell($cx*3, $cy, $PetStudents, $bo, 'C', 0);
	    				}
	    			}
	    			if($WingName = 'A-Level'){
	    				if($wing_strength_report['wing_name'] == 'A-Level'){
	    					$x = 47.5;
							$y = 187.7;
							$cx = 5.8;
							$cy = 2.7;
							$FontSize = 6.5;

							// Jinnah, Iqbal, Syed
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y);
						    $pdf->Cell($cx, $cy, $Jinnah, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx,$y);
						    $pdf->Cell($cx, $cy, $Iqbal, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx,$y);
						    $pdf->Cell($cx, $cy, $Syed, $bo, 0, 'C', 0);


						    // Boy and Girl

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);

			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2),$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Boy, $bo, 'C', 0);


						    // Total Students
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);
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
	    			$Jinnah = $grade_strength_report['jinnah'];
	    			$Iqbal = $grade_strength_report['iqbal'];
	    			$Syed = $grade_strength_report['syed'];
	    			$Girl = $grade_strength_report['girl'];
	    			$Boy = $grade_strength_report['boy'];
	    			$Students = $grade_strength_report['students'];

	    			$PetStudents = $grade_strength_report['pet_students'];
	    			$PetGirl = $grade_strength_report['pet_girl'];
	    			$PetBoy = $grade_strength_report['pet_boy'];

	    			$totalSection = $grade_strength_report['total_section'];

	    			$pet_gap = 207.3;

	    			if($GradeName = 'PG'){
	    				if($grade_strength_report['grade_name'] == 'PG'){
		    				$x = 69.2;
							$y = 16.8;
							$cx = 5;
							$cy = 2.7;
							$FontSize = 6.5;

							// Jinnah, Iqbal, Syed
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y);
						    $pdf->Cell($cx, $cy, $Jinnah, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx,$y);
						    $pdf->Cell($cx, $cy, $Iqbal, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx,$y);
						    $pdf->Cell($cx, $cy, $Syed, $bo, 0, 'C', 0);


						    // Boy and Girl

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);

			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2),$y+$cy);
						    $pdf->Cell($cx+($cx/2), $cy, $Boy, $bo, 0, 'C', 0);
						    $pdf->Cell($cx+($cx/2), ($cy*2), '(' . $totalSection . ')', $bo, 0, 'C', 0);

						    // Total Students
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);

						    /******************** Petitioner ******************/
						    //  Boy and Girl
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$pet_gap,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $PetGirl, $bo, 'C', 0);
			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2)+$pet_gap,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $PetBoy, $bo, 'C', 0);

						    // Total Students						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$pet_gap,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $PetStudents, $bo, 'C', 0);
		    			}
					}

	    			if($GradeName = 'PN'){
	    				if($grade_strength_report['grade_name'] == 'PN'){
		    				$x = 69.2;
							$y = 27.5;
							$cx = 5;
							$cy = 2.7;
							$FontSize = 6.5;

							// Jinnah, Iqbal, Syed
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y);
						    $pdf->Cell($cx, $cy, $Jinnah, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx,$y);
						    $pdf->Cell($cx, $cy, $Iqbal, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx,$y);
						    $pdf->Cell($cx, $cy, $Syed, $bo, 0, 'C', 0);


						    // Boy and Girl

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);

			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2),$y+$cy);
						    $pdf->Cell($cx+($cx/2), $cy, $Boy, $bo, 0, 'C', 0);
						    $pdf->Cell($cx+($cx/2), ($cy*2), '(' . $totalSection . ')', $bo, 0, 'C', 0);

						    // Total Students
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);

						    /******************** Petitioner ******************/
						    //  Boy and Girl
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$pet_gap,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $PetGirl, $bo, 'C', 0);
			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2)+$pet_gap,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $PetBoy, $bo, 'C', 0);

						    // Total Students						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$pet_gap,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $PetStudents, $bo, 'C', 0);
		    			}
					}
					if($GradeName = 'N'){
						if($grade_strength_report['grade_name'] == 'N'){
		    				$x = 69.2;
							$y = 38.1;
							$cx = 5;
							$cy = 2.7;
							$FontSize = 6.5;

							// Jinnah, Iqbal, Syed
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y);
						    $pdf->Cell($cx, $cy, $Jinnah, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx,$y);
						    $pdf->Cell($cx, $cy, $Iqbal, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx,$y);
						    $pdf->Cell($cx, $cy, $Syed, $bo, 0, 'C', 0);


						    // Boy and Girl

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);

			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2),$y+$cy);
						    $pdf->Cell($cx+($cx/2), $cy, $Boy, $bo, 0, 'C', 0);
						    $pdf->Cell($cx+($cx/2), ($cy*2), '(' . $totalSection . ')', $bo, 0, 'C', 0);


						    // Total Students
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);

						    /******************** Petitioner ******************/
						    //  Boy and Girl
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$pet_gap,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $PetGirl, $bo, 'C', 0);
			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2)+$pet_gap,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $PetBoy, $bo, 'C', 0);

						    // Total Students						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$pet_gap,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $PetStudents, $bo, 'C', 0);
						}
					}
					if($GradeName = 'KG'){
						if($grade_strength_report['grade_name'] == 'KG'){
	    					$x = 69.2;
							$y = 48.85;
							$cx = 5;
							$cy = 2.7;
							$FontSize = 6.5;

							// Jinnah, Iqbal, Syed
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y);
						    $pdf->Cell($cx, $cy, $Jinnah, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx,$y);
						    $pdf->Cell($cx, $cy, $Iqbal, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx,$y);
						    $pdf->Cell($cx, $cy, $Syed, $bo, 0, 'C', 0);


						    // Boy and Girl

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);

			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2),$y+$cy);
						    $pdf->Cell($cx+($cx/2), $cy, $Boy, $bo, 0, 'C', 0);
						    $pdf->Cell($cx+($cx/2), ($cy*2), '(' . $totalSection . ')', $bo, 0, 'C', 0);


						    // Total Students
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);

						    /******************** Petitioner ******************/
						    //  Boy and Girl
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$pet_gap,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $PetGirl, $bo, 'C', 0);
			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2)+$pet_gap,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $PetBoy, $bo, 'C', 0);

						    // Total Students						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$pet_gap,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $PetStudents, $bo, 'C', 0);
						}
					}
					if($GradeName = 'I'){	    				
	    				if($grade_strength_report['grade_name'] == 'I'){
	    					$x = 69.2;
							$y = 59.55;
							$cx = 5;
							$cy = 2.7;
							$FontSize = 6.5;

							// Jinnah, Iqbal, Syed
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y);
						    $pdf->Cell($cx, $cy, $Jinnah, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx,$y);
						    $pdf->Cell($cx, $cy, $Iqbal, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx,$y);
						    $pdf->Cell($cx, $cy, $Syed, $bo, 0, 'C', 0);


						    // Boy and Girl

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);

			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2),$y+$cy);
						    $pdf->Cell($cx+($cx/2), $cy, $Boy, $bo, 0, 'C', 0);
						    $pdf->Cell($cx+($cx/2), ($cy*2), '(' . $totalSection . ')', $bo, 0, 'C', 0);


						    // Total Students
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);

						    /******************** Petitioner ******************/
						    //  Boy and Girl
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$pet_gap,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $PetGirl, $bo, 'C', 0);
			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2)+$pet_gap,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $PetBoy, $bo, 'C', 0);

						    // Total Students						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$pet_gap,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $PetStudents, $bo, 'C', 0);
						}
					}
					if($GradeName = 'II'){	    				
	    				if($grade_strength_report['grade_name'] == 'II'){
	    					$x = 69.2;
							$y = 70.2;
							$cx = 5;
							$cy = 2.7;
							$FontSize = 6.5;

							// Jinnah, Iqbal, Syed
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y);
						    $pdf->Cell($cx, $cy, $Jinnah, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx,$y);
						    $pdf->Cell($cx, $cy, $Iqbal, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx,$y);
						    $pdf->Cell($cx, $cy, $Syed, $bo, 0, 'C', 0);


						    // Boy and Girl

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);

			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2),$y+$cy);
						    $pdf->Cell($cx+($cx/2), $cy, $Boy, $bo, 0, 'C', 0);
						    $pdf->Cell($cx+($cx/2), ($cy*2), '(' . $totalSection . ')', $bo, 0, 'C', 0);


						    // Total Students
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);

						    /******************** Petitioner ******************/
						    //  Boy and Girl
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$pet_gap,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $PetGirl, $bo, 'C', 0);
			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2)+$pet_gap,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $PetBoy, $bo, 'C', 0);

						    // Total Students						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$pet_gap,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $PetStudents, $bo, 'C', 0);
						}
					}
					if($GradeName = 'III'){
	    				if($grade_strength_report['grade_name'] == 'III'){
	    					$x = 69.2;
							$y = 86.25;
							$cx = 5;
							$cy = 2.7;
							$FontSize = 6.5;

							// Jinnah, Iqbal, Syed
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y);
						    $pdf->Cell($cx, $cy, $Jinnah, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx,$y);
						    $pdf->Cell($cx, $cy, $Iqbal, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx,$y);
						    $pdf->Cell($cx, $cy, $Syed, $bo, 0, 'C', 0);


						    // Boy and Girl

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);

			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2),$y+$cy);
						    $pdf->Cell($cx+($cx/2), $cy, $Boy, $bo, 0, 'C', 0);
						    $pdf->Cell($cx+($cx/2), ($cy*2), '(' . $totalSection . ')', $bo, 0, 'C', 0);


						    // Total Students
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);

						    /******************** Petitioner ******************/
						    //  Boy and Girl
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$pet_gap,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $PetGirl, $bo, 'C', 0);
			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2)+$pet_gap,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $PetBoy, $bo, 'C', 0);

						    // Total Students						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$pet_gap,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $PetStudents, $bo, 'C', 0);
						}
					}
					if($GradeName = 'IV'){
	    				if($grade_strength_report['grade_name'] == 'IV'){
	    					$x = 69.2;
							$y = 96.9;
							$cx = 5;
							$cy = 2.7;
							$FontSize = 6.5;

							// Jinnah, Iqbal, Syed
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y);
						    $pdf->Cell($cx, $cy, $Jinnah, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx,$y);
						    $pdf->Cell($cx, $cy, $Iqbal, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx,$y);
						    $pdf->Cell($cx, $cy, $Syed, $bo, 0, 'C', 0);


						    // Boy and Girl

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);

			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2),$y+$cy);
						    $pdf->Cell($cx+($cx/2), $cy, $Boy, $bo, 0, 'C', 0);
						    $pdf->Cell($cx+($cx/2), ($cy*2), '(' . $totalSection . ')', $bo, 0, 'C', 0);


						    // Total Students
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);

						    /******************** Petitioner ******************/
						    //  Boy and Girl
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$pet_gap,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $PetGirl, $bo, 'C', 0);
			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2)+$pet_gap,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $PetBoy, $bo, 'C', 0);

						    // Total Students						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$pet_gap,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $PetStudents, $bo, 'C', 0);
	    				}
	    			}
	    			if($GradeName = 'V'){
	    				if($grade_strength_report['grade_name'] == 'V'){
	    					$x = 69.2;
							$y = 107.55;
							$cx = 5;
							$cy = 2.7;
							$FontSize = 6.5;

							// Jinnah, Iqbal, Syed
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y);
						    $pdf->Cell($cx, $cy, $Jinnah, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx,$y);
						    $pdf->Cell($cx, $cy, $Iqbal, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx,$y);
						    $pdf->Cell($cx, $cy, $Syed, $bo, 0, 'C', 0);


						    // Boy and Girl

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);

			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2),$y+$cy);
						    $pdf->Cell($cx+($cx/2), $cy, $Boy, $bo, 0, 'C', 0);
						    $pdf->Cell($cx+($cx/2), ($cy*2), '(' . $totalSection . ')', $bo, 0, 'C', 0);


						    // Total Students
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);

						    /******************** Petitioner ******************/
						    //  Boy and Girl
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$pet_gap,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $PetGirl, $bo, 'C', 0);
			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2)+$pet_gap,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $PetBoy, $bo, 'C', 0);

						    // Total Students						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$pet_gap,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $PetStudents, $bo, 'C', 0);
		    			}
		    		}
		    		if($GradeName = 'VI'){
	    				if($grade_strength_report['grade_name'] == 'VI'){
	    					$x = 69.2;
							$y = 118.3;
							$cx = 5;
							$cy = 2.7;
							$FontSize = 6.5;

							// Jinnah, Iqbal, Syed
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y);
						    $pdf->Cell($cx, $cy, $Jinnah, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx,$y);
						    $pdf->Cell($cx, $cy, $Iqbal, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx,$y);
						    $pdf->Cell($cx, $cy, $Syed, $bo, 0, 'C', 0);


						    // Boy and Girl

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);

			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2),$y+$cy);
						    $pdf->Cell($cx+($cx/2), $cy, $Boy, $bo, 0, 'C', 0);
						    $pdf->Cell($cx+($cx/2), ($cy*2), '(' . $totalSection . ')', $bo, 0, 'C', 0);


						    // Total Students
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);

						    /******************** Petitioner ******************/
						    //  Boy and Girl
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$pet_gap,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $PetGirl, $bo, 'C', 0);
			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2)+$pet_gap,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $PetBoy, $bo, 'C', 0);

						    // Total Students						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$pet_gap,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $PetStudents, $bo, 'C', 0);
	    				}
	    			}
	    			if($GradeName = 'VII'){
	    				if($grade_strength_report['grade_name'] == 'VII'){
	    					$x = 69.2;
							$y = 128.95;
							$cx = 5;
							$cy = 2.7;
							$FontSize = 6.5;

							// Jinnah, Iqbal, Syed
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y);
						    $pdf->Cell($cx, $cy, $Jinnah, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx,$y);
						    $pdf->Cell($cx, $cy, $Iqbal, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx,$y);
						    $pdf->Cell($cx, $cy, $Syed, $bo, 0, 'C', 0);


						    // Boy and Girl

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);

			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2),$y+$cy);
						    $pdf->Cell($cx+($cx/2), $cy, $Boy, $bo, 0, 'C', 0);
						    $pdf->Cell($cx+($cx/2), ($cy*2), '(' . $totalSection . ')', $bo, 0, 'C', 0);


						    // Total Students
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);

						    /******************** Petitioner ******************/
						    //  Boy and Girl
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$pet_gap,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $PetGirl, $bo, 'C', 0);
			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2)+$pet_gap,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $PetBoy, $bo, 'C', 0);

						    // Total Students						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$pet_gap,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $PetStudents, $bo, 'C', 0);
	    				}
	    			}
	    			if($GradeName = 'VIII'){
	    				if($grade_strength_report['grade_name'] == 'VIII'){
	    					$x = 69.2;
							$y = 139.55;
							$cx = 5;
							$cy = 2.7;
							$FontSize = 6.5;

							// Jinnah, Iqbal, Syed
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y);
						    $pdf->Cell($cx, $cy, $Jinnah, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx,$y);
						    $pdf->Cell($cx, $cy, $Iqbal, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx,$y);
						    $pdf->Cell($cx, $cy, $Syed, $bo, 0, 'C', 0);


						    // Boy and Girl

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);

			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2),$y+$cy);
						    $pdf->Cell($cx+($cx/2), $cy, $Boy, $bo, 0, 'C', 0);
						    $pdf->Cell($cx+($cx/2), ($cy*2), '(' . $totalSection . ')', $bo, 0, 'C', 0);


						    // Total Students
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);

						    /******************** Petitioner ******************/
						    //  Boy and Girl
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$pet_gap,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $PetGirl, $bo, 'C', 0);
			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2)+$pet_gap,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $PetBoy, $bo, 'C', 0);

						    // Total Students						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$pet_gap,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $PetStudents, $bo, 'C', 0);
	    				}
	    			}
	    			if($GradeName = 'IX'){
	    				if($grade_strength_report['grade_name'] == 'IX'){
	    					$x = 69.2;
							$y = 150.3;
							$cx = 5;
							$cy = 2.7;
							$FontSize = 6.5;

							// Jinnah, Iqbal, Syed
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y);
						    $pdf->Cell($cx, $cy, $Jinnah, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx,$y);
						    $pdf->Cell($cx, $cy, $Iqbal, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx,$y);
						    $pdf->Cell($cx, $cy, $Syed, $bo, 0, 'C', 0);


						    // Boy and Girl

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);

			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2),$y+$cy);
						    $pdf->Cell($cx+($cx/2), $cy, $Boy, $bo, 0, 'C', 0);
						    $pdf->Cell($cx+($cx/2), ($cy*2), '(' . $totalSection . ')', $bo, 0, 'C', 0);


						    // Total Students
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);

						    /******************** Petitioner ******************/
						    //  Boy and Girl
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$pet_gap,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $PetGirl, $bo, 'C', 0);
			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2)+$pet_gap,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $PetBoy, $bo, 'C', 0);

						    // Total Students						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$pet_gap,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $PetStudents, $bo, 'C', 0);
	    				}
	    			}
	    			if($GradeName = 'X'){
	    				if($grade_strength_report['grade_name'] == 'X'){
	    					$x = 69.2;
							$y = 160.8;
							$cx = 5;
							$cy = 2.7;
							$FontSize = 6.5;

							// Jinnah, Iqbal, Syed
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y);
						    $pdf->Cell($cx, $cy, $Jinnah, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx,$y);
						    $pdf->Cell($cx, $cy, $Iqbal, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx,$y);
						    $pdf->Cell($cx, $cy, $Syed, $bo, 0, 'C', 0);


						    // Boy and Girl

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);

			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2),$y+$cy);
						    $pdf->Cell($cx+($cx/2), $cy, $Boy, $bo, 0, 'C', 0);
						    $pdf->Cell($cx+($cx/2), ($cy*2), '(' . $totalSection . ')', $bo, 0, 'C', 0);


						    // Total Students
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);

						    /******************** Petitioner ******************/
						    //  Boy and Girl
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$pet_gap,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $PetGirl, $bo, 'C', 0);
			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2)+$pet_gap,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $PetBoy, $bo, 'C', 0);

						    // Total Students						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$pet_gap,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $PetStudents, $bo, 'C', 0);
	    				}
	    			}
	    			if($GradeName = 'XI'){
	    				if($grade_strength_report['grade_name'] == 'XI'){
	    					$x = 69.2;
							$y = 171.65;
							$cx = 5;
							$cy = 2.7;
							$FontSize = 6.5;

							// Jinnah, Iqbal, Syed
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y);
						    $pdf->Cell($cx, $cy, $Jinnah, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx,$y);
						    $pdf->Cell($cx, $cy, $Iqbal, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx,$y);
						    $pdf->Cell($cx, $cy, $Syed, $bo, 0, 'C', 0);


						    // Boy and Girl

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);

			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2),$y+$cy);
						    $pdf->Cell($cx+($cx/2), $cy, $Boy, $bo, 0, 'C', 0);
						    $pdf->Cell($cx+($cx/2), ($cy*2), '(' . $totalSection . ')', $bo, 0, 'C', 0);


						    // Total Students
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);

						    /******************** Petitioner ******************/
						    //  Boy and Girl
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$pet_gap,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $PetGirl, $bo, 'C', 0);
			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2)+$pet_gap,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $PetBoy, $bo, 'C', 0);

						    // Total Students						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$pet_gap,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $PetStudents, $bo, 'C', 0);
	    				}
	    			}
	    			if($GradeName = 'A1'){
	    				if($grade_strength_report['grade_name'] == 'A1'){
	    					$x = 69.2;
							$y = 182.35;
							$cx = 5;
							$cy = 2.7;
							$FontSize = 6.5;

							// Jinnah, Iqbal, Syed
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y);
						    $pdf->Cell($cx, $cy, $Jinnah, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx,$y);
						    $pdf->Cell($cx, $cy, $Iqbal, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx,$y);
						    $pdf->Cell($cx, $cy, $Syed, $bo, 0, 'C', 0);


						    // Boy and Girl

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);

			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2),$y+$cy);
						    $pdf->Cell($cx+($cx/2), $cy, $Boy, $bo, 0, 'C', 0);
						    $pdf->Cell($cx+($cx/2), ($cy*2), '(' . $totalSection . ')', $bo, 0, 'C', 0);


						    // Total Students
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);

						    /******************** Petitioner ******************/
						    //  Boy and Girl
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$pet_gap,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $PetGirl, $bo, 'C', 0);
			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2)+$pet_gap,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $PetBoy, $bo, 'C', 0);

						    // Total Students						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$pet_gap,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $PetStudents, $bo, 'C', 0);
	    				}
	    			}
	    			if($GradeName = 'A2'){
	    				if($grade_strength_report['grade_name'] == 'A2'){
	    					$x = 69.2;
							$y = 192.95;
							$cx = 5;
							$cy = 2.7;
							$FontSize = 6.5;

							// Jinnah, Iqbal, Syed
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y);
						    $pdf->Cell($cx, $cy, $Jinnah, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx,$y);
						    $pdf->Cell($cx, $cy, $Iqbal, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx,$y);
						    $pdf->Cell($cx, $cy, $Syed, $bo, 0, 'C', 0);


						    // Boy and Girl

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);

			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2),$y+$cy);
						    $pdf->Cell($cx+($cx/2), $cy, $Boy, $bo, 0, 'C', 0);
						    $pdf->Cell($cx+($cx/2), ($cy*2), '(' . $totalSection . ')', $bo, 0, 'C', 0);


						    // Total Students
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);

						    /******************** Petitioner ******************/
						    //  Boy and Girl
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$pet_gap,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $PetGirl, $bo, 'C', 0);
			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2)+$pet_gap,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $PetBoy, $bo, 'C', 0);

						    // Total Students						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$pet_gap,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $PetStudents, $bo, 'C', 0);
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
	    			$Jinnah = $strength_report['jinnah'];
	    			$Iqbal = $strength_report['iqbal'];
	    			$Syed = $strength_report['syed'];
	    			$Girl = $strength_report['girl'];
	    			$Boy = $strength_report['boy'];
	    			$Students = $strength_report['students'];
	    			
	    			
	    			if ($i >= 11){
	    				$i = 0;
	    			}

	    			if(in_array($SectionName, $sectionNames)){
	    				while($SectionName != $sectionNames[$i]){
						    $i++;
						    if ($i >= 11){
			    				$i = 0;
			    			}
			    		}
	    			}	

	    			if ($i >= 11){
	    				$i = 0;
	    			}

	    			// Playgroup
	    			if($strength_report['grade_name'] == 'PG'){
	    				if ($strength_report['section_name'] == 'Bin'){
	    					$x = 259;
							$y = 16.8;
							$cx = 5;
							$cy = 2.7;
							$FontSize = 6.5;

							// Jinnah, Iqbal, Syed
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y);
						    $pdf->Cell($cx, $cy, $Jinnah, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx,$y);
						    $pdf->Cell($cx, $cy, $Iqbal, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx,$y);
						    $pdf->Cell($cx, $cy, $Syed, $bo, 0, 'C', 0);


						    // Boy and Girl

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);

			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2),$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Boy, $bo, 'C', 0);


						    // Total Students
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);
	    				}else if($strength_report['section_name'] != 'Bin') {
		    				// Jinnah, Iqbal, Syed
		    				$x = 92.1;
							$y = 16.8;
							$cx = 5;
							$cy = 2.7;
							$FontSize = 6.5;
							$gap = 16.35;

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+($i*$gap),$y);
						    $pdf->MultiCell($cx, $cy, $Jinnah, $bo, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($i*$gap),$y);
						    $pdf->MultiCell($cx, $cy, $Iqbal, $bo, 'C', 0);


						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx+($i*$gap),$y);
						    $pdf->MultiCell($cx, $cy, $Syed, $bo, 'C', 0);


						    // Boy and Girl
		    				if ($Girl == 0){
		    					$Girl == "";
		    				} else {
				    			$pdf->SetFont($font_name);
							    $pdf->SetFont($font_name,'',$FontSize);
							    $pdf->SetFillColor(255,255,255);
							    $pdf->SetDrawColor(255,0,0);
							    $pdf->SetXY($x+($i*$gap),$y+$cy);
							    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);
							}

						    if ($Boy == 0) {
						    	$Boy == "";
						    } else {
				    			$pdf->SetFont($font_name);
							    $pdf->SetFont($font_name,'',$FontSize);
							    $pdf->SetFillColor(255,255,255);
							    $pdf->SetDrawColor(255,0,0);
							    $pdf->SetXY($x+$cx+($cx/2)+($i*$gap),$y+$cy);
							    $pdf->MultiCell($cx+($cx/2), $cy, $Boy, $bo, 'C', 0);
							}


						    // Total Students
		    				
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+($i*$gap),$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);
						}
	    			}
	    				    			
	    			// Pre-Nursery
	    			if($strength_report['grade_name'] == 'PN'){
	    				if ($strength_report['section_name'] == 'Bin'){
	    					$x = 259;
							$y = 27.5;
							$cx = 5;
							$cy = 2.7;
							$FontSize = 6.5;

							// Jinnah, Iqbal, Syed
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y);
						    $pdf->Cell($cx, $cy, $Jinnah, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx,$y);
						    $pdf->Cell($cx, $cy, $Iqbal, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx,$y);
						    $pdf->Cell($cx, $cy, $Syed, $bo, 0, 'C', 0);


						    // Boy and Girl

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);

			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2),$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Boy, $bo, 'C', 0);


						    // Total Students
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);
	    				}else if($strength_report['section_name'] != 'Bin') {
		    				// Jinnah, Iqbal, Syed
		    				$x = 92.1;
							$y = 27.5;
							$cx = 5;
							$cy = 2.7;
							$FontSize = 6.5;
							$gap = 16.35;

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+($i*$gap),$y);
						    $pdf->MultiCell($cx, $cy, $Jinnah, $bo, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($i*$gap),$y);
						    $pdf->MultiCell($cx, $cy, $Iqbal, $bo, 'C', 0);


						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx+($i*$gap),$y);
						    $pdf->MultiCell($cx, $cy, $Syed, $bo, 'C', 0);


						    // Boy and Girl
		    				if ($Girl == 0){
		    					$Girl == "";
		    				} else {
				    			$pdf->SetFont($font_name);
							    $pdf->SetFont($font_name,'',$FontSize);
							    $pdf->SetFillColor(255,255,255);
							    $pdf->SetDrawColor(255,0,0);
							    $pdf->SetXY($x+($i*$gap),$y+$cy);
							    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);
							}

						    if ($Boy == 0) {
						    	$Boy == "";
						    } else {
				    			$pdf->SetFont($font_name);
							    $pdf->SetFont($font_name,'',$FontSize);
							    $pdf->SetFillColor(255,255,255);
							    $pdf->SetDrawColor(255,0,0);
							    $pdf->SetXY($x+$cx+($cx/2)+($i*$gap),$y+$cy);
							    $pdf->MultiCell($cx+($cx/2), $cy, $Boy, $bo, 'C', 0);
							}


						    // Total Students
		    				
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+($i*$gap),$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);
						}
	    			}

	    			// Nursery	    			
	    			else if($strength_report['grade_name'] == 'N'){
	    				if ($strength_report['section_name'] == 'Bin'){
	    					$x = 259;
							$y = 38.1;
							$cx = 5;
							$cy = 2.7;
							$FontSize = 6.5;

							// Jinnah, Iqbal, Syed
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y);
						    $pdf->Cell($cx, $cy, $Jinnah, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx,$y);
						    $pdf->Cell($cx, $cy, $Iqbal, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx,$y);
						    $pdf->Cell($cx, $cy, $Syed, $bo, 0, 'C', 0);


						    // Boy and Girl

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);

			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2),$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Boy, $bo, 'C', 0);


						    // Total Students
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);
	    				}else if($strength_report['section_name'] != 'Bin') {
		    				// Jinnah, Iqbal, Syed
		    				$x = 92.1;
							$y = 38.1;
							$cx = 5;
							$cy = 2.7;
							$FontSize = 6.5;
							$gap = 16.35;

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+($i*$gap),$y);
						    $pdf->MultiCell($cx, $cy, $Jinnah, $bo, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($i*$gap),$y);
						    $pdf->MultiCell($cx, $cy, $Iqbal, $bo, 'C', 0);


						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx+($i*$gap),$y);
						    $pdf->MultiCell($cx, $cy, $Syed, $bo, 'C', 0);


						    // Boy and Girl
		    				if ($Girl == 0){
		    					$Girl == "";
		    				} else {
				    			$pdf->SetFont($font_name);
							    $pdf->SetFont($font_name,'',$FontSize);
							    $pdf->SetFillColor(255,255,255);
							    $pdf->SetDrawColor(255,0,0);
							    $pdf->SetXY($x+($i*$gap),$y+$cy);
							    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);
							}

						    if ($Boy == 0) {
						    	$Boy == "";
						    } else {
				    			$pdf->SetFont($font_name);
							    $pdf->SetFont($font_name,'',$FontSize);
							    $pdf->SetFillColor(255,255,255);
							    $pdf->SetDrawColor(255,0,0);
							    $pdf->SetXY($x+$cx+($cx/2)+($i*$gap),$y+$cy);
							    $pdf->MultiCell($cx+($cx/2), $cy, $Boy, $bo, 'C', 0);
							}


						    // Total Students
		    				
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+($i*$gap),$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);
						}
	    			}

	    			// KG
	    			else if($strength_report['grade_name'] == 'KG'){
	    				if ($strength_report['section_name'] == 'Bin'){
	    					$x = 259;
							$y = 48.85;
							$cx = 5;
							$cy = 2.7;
							$FontSize = 6.5;

							// Jinnah, Iqbal, Syed
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y);
						    $pdf->Cell($cx, $cy, $Jinnah, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx,$y);
						    $pdf->Cell($cx, $cy, $Iqbal, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx,$y);
						    $pdf->Cell($cx, $cy, $Syed, $bo, 0, 'C', 0);


						    // Boy and Girl

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);

			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2),$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Boy, $bo, 'C', 0);


						    // Total Students
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);
	    				}else if($strength_report['section_name'] != 'Bin') {
		    				// Jinnah, Iqbal, Syed
		    				$x = 92.1;
							$y = 48.85;
							$cx = 5;
							$cy = 2.7;
							$FontSize = 6.5;
							$gap = 16.35;

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+($i*$gap),$y);
						    $pdf->MultiCell($cx, $cy, $Jinnah, $bo, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($i*$gap),$y);
						    $pdf->MultiCell($cx, $cy, $Iqbal, $bo, 'C', 0);


						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx+($i*$gap),$y);
						    $pdf->MultiCell($cx, $cy, $Syed, $bo, 'C', 0);


						    // Boy and Girl
		    				if ($Girl == 0){
		    					$Girl == "";
		    				} else {
				    			$pdf->SetFont($font_name);
							    $pdf->SetFont($font_name,'',$FontSize);
							    $pdf->SetFillColor(255,255,255);
							    $pdf->SetDrawColor(255,0,0);
							    $pdf->SetXY($x+($i*$gap),$y+$cy);
							    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);
							}

						    if ($Boy == 0) {
						    	$Boy == "";
						    } else {
				    			$pdf->SetFont($font_name);
							    $pdf->SetFont($font_name,'',$FontSize);
							    $pdf->SetFillColor(255,255,255);
							    $pdf->SetDrawColor(255,0,0);
							    $pdf->SetXY($x+$cx+($cx/2)+($i*$gap),$y+$cy);
							    $pdf->MultiCell($cx+($cx/2), $cy, $Boy, $bo, 'C', 0);
							}


						    // Total Students
		    				
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+($i*$gap),$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);
						}
	    			}    			   		
	    			//  I
	    			else if($strength_report['grade_name'] == 'I'){
	    				if ($strength_report['section_name'] == 'Bin'){
	    					$x = 259;
							$y = 59.55;
							$cx = 5;
							$cy = 2.7;
							$FontSize = 6.5;

							// Jinnah, Iqbal, Syed
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y);
						    $pdf->Cell($cx, $cy, $Jinnah, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx,$y);
						    $pdf->Cell($cx, $cy, $Iqbal, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx,$y);
						    $pdf->Cell($cx, $cy, $Syed, $bo, 0, 'C', 0);


						    // Boy and Girl

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);

			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2),$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Boy, $bo, 'C', 0);


						    // Total Students
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);
	    				}else if($strength_report['section_name'] != 'Bin') {
		    				// Jinnah, Iqbal, Syed
		    				$x = 92.1;
							$y = 59.55;
							$cx = 5;
							$cy = 2.7;
							$FontSize = 6.5;
							$gap = 16.35;

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+($i*$gap),$y);
						    $pdf->MultiCell($cx, $cy, $Jinnah, $bo, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($i*$gap),$y);
						    $pdf->MultiCell($cx, $cy, $Iqbal, $bo, 'C', 0);


						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx+($i*$gap),$y);
						    $pdf->MultiCell($cx, $cy, $Syed, $bo, 'C', 0);


						    // Boy and Girl
		    				if ($Girl == 0){
		    					$Girl == "";
		    				} else {
				    			$pdf->SetFont($font_name);
							    $pdf->SetFont($font_name,'',$FontSize);
							    $pdf->SetFillColor(255,255,255);
							    $pdf->SetDrawColor(255,0,0);
							    $pdf->SetXY($x+($i*$gap),$y+$cy);
							    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);
							}

						    if ($Boy == 0) {
						    	$Boy == "";
						    } else {
				    			$pdf->SetFont($font_name);
							    $pdf->SetFont($font_name,'',$FontSize);
							    $pdf->SetFillColor(255,255,255);
							    $pdf->SetDrawColor(255,0,0);
							    $pdf->SetXY($x+$cx+($cx/2)+($i*$gap),$y+$cy);
							    $pdf->MultiCell($cx+($cx/2), $cy, $Boy, $bo, 'C', 0);
							}


						    // Total Students
		    				
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+($i*$gap),$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);
						}
	    			}

	    			// II
	    			else if($strength_report['grade_name'] == 'II'){
	    				if ($strength_report['section_name'] == 'Bin'){
	    					$x = 259;
							$y = 70.2;
							$cx = 5;
							$cy = 2.7;
							$FontSize = 6.5;

							// Jinnah, Iqbal, Syed
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y);
						    $pdf->Cell($cx, $cy, $Jinnah, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx,$y);
						    $pdf->Cell($cx, $cy, $Iqbal, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx,$y);
						    $pdf->Cell($cx, $cy, $Syed, $bo, 0, 'C', 0);


						    // Boy and Girl

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);

			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2),$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Boy, $bo, 'C', 0);


						    // Total Students
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);
	    				}else if($strength_report['section_name'] != 'Bin') {
		    				// Jinnah, Iqbal, Syed
		    				$x = 92.1;
							$y = 70.2;
							$cx = 5;
							$cy = 2.7;
							$FontSize = 6.5;
							$gap = 16.35;

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+($i*$gap),$y);
						    $pdf->MultiCell($cx, $cy, $Jinnah, $bo, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($i*$gap),$y);
						    $pdf->MultiCell($cx, $cy, $Iqbal, $bo, 'C', 0);


						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx+($i*$gap),$y);
						    $pdf->MultiCell($cx, $cy, $Syed, $bo, 'C', 0);


						    // Boy and Girl
		    				if ($Girl == 0){
		    					$Girl == "";
		    				} else {
				    			$pdf->SetFont($font_name);
							    $pdf->SetFont($font_name,'',$FontSize);
							    $pdf->SetFillColor(255,255,255);
							    $pdf->SetDrawColor(255,0,0);
							    $pdf->SetXY($x+($i*$gap),$y+$cy);
							    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);
							}

						    if ($Boy == 0) {
						    	$Boy == "";
						    } else {
				    			$pdf->SetFont($font_name);
							    $pdf->SetFont($font_name,'',$FontSize);
							    $pdf->SetFillColor(255,255,255);
							    $pdf->SetDrawColor(255,0,0);
							    $pdf->SetXY($x+$cx+($cx/2)+($i*$gap),$y+$cy);
							    $pdf->MultiCell($cx+($cx/2), $cy, $Boy, $bo, 'C', 0);
							}


						    // Total Students
		    				
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+($i*$gap),$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);
						}
	    			}

	    			// III
	    			else if($strength_report['grade_name'] == 'III'){
	    				if ($strength_report['section_name'] == 'Bin'){
	    					$x = 259;
							$y = 86.25;
							$cx = 5;
							$cy = 2.7;
							$FontSize = 6.5;

							// Jinnah, Iqbal, Syed
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y);
						    $pdf->Cell($cx, $cy, $Jinnah, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx,$y);
						    $pdf->Cell($cx, $cy, $Iqbal, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx,$y);
						    $pdf->Cell($cx, $cy, $Syed, $bo, 0, 'C', 0);


						    // Boy and Girl

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);

			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2),$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Boy, $bo, 'C', 0);


						    // Total Students
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);
	    				}else if($strength_report['section_name'] != 'Bin') {
		    				// Jinnah, Iqbal, Syed
		    				$x = 92.1;
							$y = 86.25;
							$cx = 5;
							$cy = 2.7;
							$FontSize = 6.5;
							$gap = 16.35;

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+($i*$gap),$y);
						    $pdf->MultiCell($cx, $cy, $Jinnah, $bo, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($i*$gap),$y);
						    $pdf->MultiCell($cx, $cy, $Iqbal, $bo, 'C', 0);


						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx+($i*$gap),$y);
						    $pdf->MultiCell($cx, $cy, $Syed, $bo, 'C', 0);


						    // Boy and Girl
		    				if ($Girl == 0){
		    					$Girl == "";
		    				} else {
				    			$pdf->SetFont($font_name);
							    $pdf->SetFont($font_name,'',$FontSize);
							    $pdf->SetFillColor(255,255,255);
							    $pdf->SetDrawColor(255,0,0);
							    $pdf->SetXY($x+($i*$gap),$y+$cy);
							    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);
							}

						    if ($Boy == 0) {
						    	$Boy == "";
						    } else {
				    			$pdf->SetFont($font_name);
							    $pdf->SetFont($font_name,'',$FontSize);
							    $pdf->SetFillColor(255,255,255);
							    $pdf->SetDrawColor(255,0,0);
							    $pdf->SetXY($x+$cx+($cx/2)+($i*$gap),$y+$cy);
							    $pdf->MultiCell($cx+($cx/2), $cy, $Boy, $bo, 'C', 0);
							}


						    // Total Students
		    				
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+($i*$gap),$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);
						}
	    			}

	    			// IV
	    			else if($strength_report['grade_name'] == 'IV'){
	    				if ($strength_report['section_name'] == 'Bin'){
	    					$x = 259;
							$y = 96.9;
							$cx = 5;
							$cy = 2.7;
							$FontSize = 6.5;

							// Jinnah, Iqbal, Syed
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y);
						    $pdf->Cell($cx, $cy, $Jinnah, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx,$y);
						    $pdf->Cell($cx, $cy, $Iqbal, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx,$y);
						    $pdf->Cell($cx, $cy, $Syed, $bo, 0, 'C', 0);


						    // Boy and Girl

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);

			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2),$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Boy, $bo, 'C', 0);


						    // Total Students
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);
	    				}else if($strength_report['section_name'] != 'Bin') {
		    				// Jinnah, Iqbal, Syed
		    				$x = 92.1;
							$y = 96.9;
							$cx = 5;
							$cy = 2.7;
							$FontSize = 6.5;
							$gap = 16.35;

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+($i*$gap),$y);
						    $pdf->MultiCell($cx, $cy, $Jinnah, $bo, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($i*$gap),$y);
						    $pdf->MultiCell($cx, $cy, $Iqbal, $bo, 'C', 0);


						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx+($i*$gap),$y);
						    $pdf->MultiCell($cx, $cy, $Syed, $bo, 'C', 0);


						    // Boy and Girl
		    				if ($Girl == 0){
		    					$Girl == "";
		    				} else {
				    			$pdf->SetFont($font_name);
							    $pdf->SetFont($font_name,'',$FontSize);
							    $pdf->SetFillColor(255,255,255);
							    $pdf->SetDrawColor(255,0,0);
							    $pdf->SetXY($x+($i*$gap),$y+$cy);
							    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);
							}

						    if ($Boy == 0) {
						    	$Boy == "";
						    } else {
				    			$pdf->SetFont($font_name);
							    $pdf->SetFont($font_name,'',$FontSize);
							    $pdf->SetFillColor(255,255,255);
							    $pdf->SetDrawColor(255,0,0);
							    $pdf->SetXY($x+$cx+($cx/2)+($i*$gap),$y+$cy);
							    $pdf->MultiCell($cx+($cx/2), $cy, $Boy, $bo, 'C', 0);
							}


						    // Total Students
		    				
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+($i*$gap),$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);
						}
	    			}


	    			// V
	    			else if($strength_report['grade_name'] == 'V'){	    				
	    				if ($strength_report['section_name'] == 'Bin'){
	    					$x = 259;
							$y = 107.55;
							$cx = 5;
							$cy = 2.7;
							$FontSize = 6.5;

							// Jinnah, Iqbal, Syed
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y);
						    $pdf->Cell($cx, $cy, $Jinnah, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx,$y);
						    $pdf->Cell($cx, $cy, $Iqbal, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx,$y);
						    $pdf->Cell($cx, $cy, $Syed, $bo, 0, 'C', 0);


						    // Boy and Girl

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);

			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2),$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Boy, $bo, 'C', 0);


						    // Total Students
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);
	    				}else if($strength_report['section_name'] != 'Bin') {
		    				// Jinnah, Iqbal, Syed
		    				$x = 92.1;
							$y = 107.55;
							$cx = 5;
							$cy = 2.7;
							$FontSize = 6.5;
							$gap = 16.35;

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+($i*$gap),$y);
						    $pdf->MultiCell($cx, $cy, $Jinnah, $bo, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($i*$gap),$y);
						    $pdf->MultiCell($cx, $cy, $Iqbal, $bo, 'C', 0);


						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx+($i*$gap),$y);
						    $pdf->MultiCell($cx, $cy, $Syed, $bo, 'C', 0);


						    // Boy and Girl
		    				if ($Girl == 0){
		    					$Girl == "";
		    				} else {
				    			$pdf->SetFont($font_name);
							    $pdf->SetFont($font_name,'',$FontSize);
							    $pdf->SetFillColor(255,255,255);
							    $pdf->SetDrawColor(255,0,0);
							    $pdf->SetXY($x+($i*$gap),$y+$cy);
							    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);
							}

						    if ($Boy == 0) {
						    	$Boy == "";
						    } else {
				    			$pdf->SetFont($font_name);
							    $pdf->SetFont($font_name,'',$FontSize);
							    $pdf->SetFillColor(255,255,255);
							    $pdf->SetDrawColor(255,0,0);
							    $pdf->SetXY($x+$cx+($cx/2)+($i*$gap),$y+$cy);
							    $pdf->MultiCell($cx+($cx/2), $cy, $Boy, $bo, 'C', 0);
							}


						    // Total Students
		    				
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+($i*$gap),$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);
						}
	    			}


	    			// VI
	    			else if($strength_report['grade_name'] == 'VI'){
	    				if ($strength_report['section_name'] == 'Bin'){
	    					$x = 259;
							$y = 118.3;
							$cx = 5;
							$cy = 2.7;
							$FontSize = 6.5;

							// Jinnah, Iqbal, Syed
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y);
						    $pdf->Cell($cx, $cy, $Jinnah, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx,$y);
						    $pdf->Cell($cx, $cy, $Iqbal, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx,$y);
						    $pdf->Cell($cx, $cy, $Syed, $bo, 0, 'C', 0);


						    // Boy and Girl

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);

			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2),$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Boy, $bo, 'C', 0);


						    // Total Students
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);
	    				}else if($strength_report['section_name'] != 'Bin') {
		    				// Jinnah, Iqbal, Syed
		    				$x = 92.1;
							$y = 118.3;
							$cx = 5;
							$cy = 2.7;
							$FontSize = 6.5;
							$gap = 16.35;

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+($i*$gap),$y);
						    $pdf->MultiCell($cx, $cy, $Jinnah, $bo, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($i*$gap),$y);
						    $pdf->MultiCell($cx, $cy, $Iqbal, $bo, 'C', 0);


						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx+($i*$gap),$y);
						    $pdf->MultiCell($cx, $cy, $Syed, $bo, 'C', 0);


						    // Boy and Girl
		    				if ($Girl == 0){
		    					$Girl == "";
		    				} else {
				    			$pdf->SetFont($font_name);
							    $pdf->SetFont($font_name,'',$FontSize);
							    $pdf->SetFillColor(255,255,255);
							    $pdf->SetDrawColor(255,0,0);
							    $pdf->SetXY($x+($i*$gap),$y+$cy);
							    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);
							}

						    if ($Boy == 0) {
						    	$Boy == "";
						    } else {
				    			$pdf->SetFont($font_name);
							    $pdf->SetFont($font_name,'',$FontSize);
							    $pdf->SetFillColor(255,255,255);
							    $pdf->SetDrawColor(255,0,0);
							    $pdf->SetXY($x+$cx+($cx/2)+($i*$gap),$y+$cy);
							    $pdf->MultiCell($cx+($cx/2), $cy, $Boy, $bo, 'C', 0);
							}


						    // Total Students
		    				
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+($i*$gap),$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);
						}
	    			}


	    			// VII
	    			else if($strength_report['grade_name'] == 'VII'){
	    				if ($strength_report['section_name'] == 'Bin'){
	    					$x = 259;
							$y = 128.95;
							$cx = 5;
							$cy = 2.7;
							$FontSize = 6.5;

							// Jinnah, Iqbal, Syed
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y);
						    $pdf->Cell($cx, $cy, $Jinnah, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx,$y);
						    $pdf->Cell($cx, $cy, $Iqbal, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx,$y);
						    $pdf->Cell($cx, $cy, $Syed, $bo, 0, 'C', 0);


						    // Boy and Girl

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);

			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2),$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Boy, $bo, 'C', 0);


						    // Total Students
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);
	    				}else if($strength_report['section_name'] != 'Bin') {
		    				// Jinnah, Iqbal, Syed
		    				$x = 92.1;
							$y = 128.95;
							$cx = 5;
							$cy = 2.7;
							$FontSize = 6.5;
							$gap = 16.35;

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+($i*$gap),$y);
						    $pdf->MultiCell($cx, $cy, $Jinnah, $bo, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($i*$gap),$y);
						    $pdf->MultiCell($cx, $cy, $Iqbal, $bo, 'C', 0);


						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx+($i*$gap),$y);
						    $pdf->MultiCell($cx, $cy, $Syed, $bo, 'C', 0);


						    // Boy and Girl
		    				if ($Girl == 0){
		    					$Girl == "";
		    				} else {
				    			$pdf->SetFont($font_name);
							    $pdf->SetFont($font_name,'',$FontSize);
							    $pdf->SetFillColor(255,255,255);
							    $pdf->SetDrawColor(255,0,0);
							    $pdf->SetXY($x+($i*$gap),$y+$cy);
							    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);
							}

						    if ($Boy == 0) {
						    	$Boy == "";
						    } else {
				    			$pdf->SetFont($font_name);
							    $pdf->SetFont($font_name,'',$FontSize);
							    $pdf->SetFillColor(255,255,255);
							    $pdf->SetDrawColor(255,0,0);
							    $pdf->SetXY($x+$cx+($cx/2)+($i*$gap),$y+$cy);
							    $pdf->MultiCell($cx+($cx/2), $cy, $Boy, $bo, 'C', 0);
							}


						    // Total Students
		    				
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+($i*$gap),$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);
						}
	    			}



	    			// VIII
	    			else if($strength_report['grade_name'] == 'VIII'){
	    				if ($strength_report['section_name'] == 'Bin'){
	    					$x = 259;
							$y = 139.55;
							$cx = 5;
							$cy = 2.7;
							$FontSize = 6.5;

							// Jinnah, Iqbal, Syed
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y);
						    $pdf->Cell($cx, $cy, $Jinnah, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx,$y);
						    $pdf->Cell($cx, $cy, $Iqbal, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx,$y);
						    $pdf->Cell($cx, $cy, $Syed, $bo, 0, 'C', 0);


						    // Boy and Girl

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);

			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2),$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Boy, $bo, 'C', 0);


						    // Total Students
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);
	    				}else if($strength_report['section_name'] != 'Bin') {
		    				// Jinnah, Iqbal, Syed
		    				$x = 92.1;
							$y = 139.55;
							$cx = 5;
							$cy = 2.7;
							$FontSize = 6.5;
							$gap = 16.35;

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+($i*$gap),$y);
						    $pdf->MultiCell($cx, $cy, $Jinnah, $bo, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($i*$gap),$y);
						    $pdf->MultiCell($cx, $cy, $Iqbal, $bo, 'C', 0);


						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx+($i*$gap),$y);
						    $pdf->MultiCell($cx, $cy, $Syed, $bo, 'C', 0);


						    // Boy and Girl
		    				if ($Girl == 0){
		    					$Girl == "";
		    				} else {
				    			$pdf->SetFont($font_name);
							    $pdf->SetFont($font_name,'',$FontSize);
							    $pdf->SetFillColor(255,255,255);
							    $pdf->SetDrawColor(255,0,0);
							    $pdf->SetXY($x+($i*$gap),$y+$cy);
							    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);
							}

						    if ($Boy == 0) {
						    	$Boy == "";
						    } else {
				    			$pdf->SetFont($font_name);
							    $pdf->SetFont($font_name,'',$FontSize);
							    $pdf->SetFillColor(255,255,255);
							    $pdf->SetDrawColor(255,0,0);
							    $pdf->SetXY($x+$cx+($cx/2)+($i*$gap),$y+$cy);
							    $pdf->MultiCell($cx+($cx/2), $cy, $Boy, $bo, 'C', 0);
							}


						    // Total Students
		    				
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+($i*$gap),$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);
						}
	    			}


	    			// IX
	    			else if($strength_report['grade_name'] == 'IX'){
	    				if ($strength_report['section_name'] == 'Bin'){
	    					$x = 259;
							$y = 150.3;
							$cx = 5;
							$cy = 2.7;
							$FontSize = 6.5;

							// Jinnah, Iqbal, Syed
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y);
						    $pdf->Cell($cx, $cy, $Jinnah, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx,$y);
						    $pdf->Cell($cx, $cy, $Iqbal, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx,$y);
						    $pdf->Cell($cx, $cy, $Syed, $bo, 0, 'C', 0);


						    // Boy and Girl

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);

			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2),$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Boy, $bo, 'C', 0);


						    // Total Students
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);
	    				}else if($strength_report['section_name'] != 'Bin') {
		    				// Jinnah, Iqbal, Syed
		    				$x = 92.1;
							$y = 150.3;
							$cx = 5;
							$cy = 2.7;
							$FontSize = 6.5;
							$gap = 16.35;

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+($i*$gap),$y);
						    $pdf->MultiCell($cx, $cy, $Jinnah, $bo, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($i*$gap),$y);
						    $pdf->MultiCell($cx, $cy, $Iqbal, $bo, 'C', 0);


						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx+($i*$gap),$y);
						    $pdf->MultiCell($cx, $cy, $Syed, $bo, 'C', 0);


						    // Boy and Girl
		    				if ($Girl == 0){
		    					$Girl == "";
		    				} else {
				    			$pdf->SetFont($font_name);
							    $pdf->SetFont($font_name,'',$FontSize);
							    $pdf->SetFillColor(255,255,255);
							    $pdf->SetDrawColor(255,0,0);
							    $pdf->SetXY($x+($i*$gap),$y+$cy);
							    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);
							}

						    if ($Boy == 0) {
						    	$Boy == "";
						    } else {
				    			$pdf->SetFont($font_name);
							    $pdf->SetFont($font_name,'',$FontSize);
							    $pdf->SetFillColor(255,255,255);
							    $pdf->SetDrawColor(255,0,0);
							    $pdf->SetXY($x+$cx+($cx/2)+($i*$gap),$y+$cy);
							    $pdf->MultiCell($cx+($cx/2), $cy, $Boy, $bo, 'C', 0);
							}


						    // Total Students
		    				
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+($i*$gap),$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);
						}
	    			}


	    			// X
	    			else if($strength_report['grade_name'] == 'X'){
	    				if ($strength_report['section_name'] == 'Bin'){
	    					$x = 259;
							$y = 160.8;
							$cx = 5;
							$cy = 2.7;
							$FontSize = 6.5;

							// Jinnah, Iqbal, Syed
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y);
						    $pdf->Cell($cx, $cy, $Jinnah, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx,$y);
						    $pdf->Cell($cx, $cy, $Iqbal, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx,$y);
						    $pdf->Cell($cx, $cy, $Syed, $bo, 0, 'C', 0);


						    // Boy and Girl

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);

			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2),$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Boy, $bo, 'C', 0);


						    // Total Students
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);
	    				}else if($strength_report['section_name'] != 'Bin') {
		    				// Jinnah, Iqbal, Syed
		    				$x = 92.1;
							$y = 160.8;
							$cx = 5;
							$cy = 2.7;
							$FontSize = 6.5;
							$gap = 16.35;

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+($i*$gap),$y);
						    $pdf->MultiCell($cx, $cy, $Jinnah, $bo, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($i*$gap),$y);
						    $pdf->MultiCell($cx, $cy, $Iqbal, $bo, 'C', 0);


						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx+($i*$gap),$y);
						    $pdf->MultiCell($cx, $cy, $Syed, $bo, 'C', 0);


						    // Boy and Girl
		    				if ($Girl == 0){
		    					$Girl == "";
		    				} else {
				    			$pdf->SetFont($font_name);
							    $pdf->SetFont($font_name,'',$FontSize);
							    $pdf->SetFillColor(255,255,255);
							    $pdf->SetDrawColor(255,0,0);
							    $pdf->SetXY($x+($i*$gap),$y+$cy);
							    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);
							}

						    if ($Boy == 0) {
						    	$Boy == "";
						    } else {
				    			$pdf->SetFont($font_name);
							    $pdf->SetFont($font_name,'',$FontSize);
							    $pdf->SetFillColor(255,255,255);
							    $pdf->SetDrawColor(255,0,0);
							    $pdf->SetXY($x+$cx+($cx/2)+($i*$gap),$y+$cy);
							    $pdf->MultiCell($cx+($cx/2), $cy, $Boy, $bo, 'C', 0);
							}


						    // Total Students
		    				
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+($i*$gap),$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);
						}
	    			}


	    			// XI
	    			else if($strength_report['grade_name'] == 'XI'){
	    				if ($strength_report['section_name'] == 'Bin'){
	    					$x = 259;
							$y = 171.65;
							$cx = 5;
							$cy = 2.7;
							$FontSize = 6.5;

							// Jinnah, Iqbal, Syed
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y);
						    $pdf->Cell($cx, $cy, $Jinnah, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx,$y);
						    $pdf->Cell($cx, $cy, $Iqbal, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx,$y);
						    $pdf->Cell($cx, $cy, $Syed, $bo, 0, 'C', 0);


						    // Boy and Girl

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);

			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2),$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Boy, $bo, 'C', 0);


						    // Total Students
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);
	    				}else if($strength_report['section_name'] != 'Bin') {
		    				// Jinnah, Iqbal, Syed
		    				$x = 92.1;
							$y = 171.65;
							$cx = 5;
							$cy = 2.7;
							$FontSize = 6.5;
							$gap = 16.35;

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+($i*$gap),$y);
						    $pdf->MultiCell($cx, $cy, $Jinnah, $bo, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($i*$gap),$y);
						    $pdf->MultiCell($cx, $cy, $Iqbal, $bo, 'C', 0);


						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx+($i*$gap),$y);
						    $pdf->MultiCell($cx, $cy, $Syed, $bo, 'C', 0);


						    // Boy and Girl
		    				if ($Girl == 0){
		    					$Girl == "";
		    				} else {
				    			$pdf->SetFont($font_name);
							    $pdf->SetFont($font_name,'',$FontSize);
							    $pdf->SetFillColor(255,255,255);
							    $pdf->SetDrawColor(255,0,0);
							    $pdf->SetXY($x+($i*$gap),$y+$cy);
							    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);
							}

						    if ($Boy == 0) {
						    	$Boy == "";
						    } else {
				    			$pdf->SetFont($font_name);
							    $pdf->SetFont($font_name,'',$FontSize);
							    $pdf->SetFillColor(255,255,255);
							    $pdf->SetDrawColor(255,0,0);
							    $pdf->SetXY($x+$cx+($cx/2)+($i*$gap),$y+$cy);
							    $pdf->MultiCell($cx+($cx/2), $cy, $Boy, $bo, 'C', 0);
							}


						    // Total Students
		    				
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+($i*$gap),$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);
						}
	    			}


	    			// A1
	    			else if($strength_report['grade_name'] == 'A1'){
	    				if ($strength_report['section_name'] == 'Bin'){
	    					$x = 259;
							$y = 182.35;
							$cx = 5;
							$cy = 2.7;
							$FontSize = 6.5;

							// Jinnah, Iqbal, Syed
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y);
						    $pdf->Cell($cx, $cy, $Jinnah, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx,$y);
						    $pdf->Cell($cx, $cy, $Iqbal, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx,$y);
						    $pdf->Cell($cx, $cy, $Syed, $bo, 0, 'C', 0);


						    // Boy and Girl

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);

			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2),$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Boy, $bo, 'C', 0);


						    // Total Students
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);
	    				}else if($strength_report['section_name'] != 'Bin') {
		    				// Jinnah, Iqbal, Syed
		    				$x = 92.1;
							$y = 182.35;
							$cx = 5;
							$cy = 2.7;
							$FontSize = 6.5;
							$gap = 16.35;

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+($i*$gap),$y);
						    $pdf->MultiCell($cx, $cy, $Jinnah, $bo, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($i*$gap),$y);
						    $pdf->MultiCell($cx, $cy, $Iqbal, $bo, 'C', 0);


						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx+($i*$gap),$y);
						    $pdf->MultiCell($cx, $cy, $Syed, $bo, 'C', 0);


						    // Boy and Girl
		    				if ($Girl == 0){
		    					$Girl == "";
		    				} else {
				    			$pdf->SetFont($font_name);
							    $pdf->SetFont($font_name,'',$FontSize);
							    $pdf->SetFillColor(255,255,255);
							    $pdf->SetDrawColor(255,0,0);
							    $pdf->SetXY($x+($i*$gap),$y+$cy);
							    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);
							}

						    if ($Boy == 0) {
						    	$Boy == "";
						    } else {
				    			$pdf->SetFont($font_name);
							    $pdf->SetFont($font_name,'',$FontSize);
							    $pdf->SetFillColor(255,255,255);
							    $pdf->SetDrawColor(255,0,0);
							    $pdf->SetXY($x+$cx+($cx/2)+($i*$gap),$y+$cy);
							    $pdf->MultiCell($cx+($cx/2), $cy, $Boy, $bo, 'C', 0);
							}


						    // Total Students
		    				
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+($i*$gap),$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);
						}
	    			}


	    			// A2
	    			else if($strength_report['grade_name'] == 'A2'){
	    				if ($strength_report['section_name'] == 'Bin'){
	    					$x = 259;
							$y = 192.95;
							$cx = 5;
							$cy = 2.7;
							$FontSize = 6.5;

							// Jinnah, Iqbal, Syed
							$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y);
						    $pdf->Cell($cx, $cy, $Jinnah, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx,$y);
						    $pdf->Cell($cx, $cy, $Iqbal, $bo, 0, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx,$y);
						    $pdf->Cell($cx, $cy, $Syed, $bo, 0, 'C', 0);


						    // Boy and Girl

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);

			    			
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($cx/2),$y+$cy);
						    $pdf->MultiCell($cx+($cx/2), $cy, $Boy, $bo, 'C', 0);


						    // Total Students
						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x,$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);
	    				}else if($strength_report['section_name'] != 'Bin') {
		    				// Jinnah, Iqbal, Syed
		    				$x = 92.1;
							$y = 192.95;
							$cx = 5;
							$cy = 2.7;
							$FontSize = 6.5;
							$gap = 16.35;

			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+($i*$gap),$y);
						    $pdf->MultiCell($cx, $cy, $Jinnah, $bo, 'C', 0);

						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+($i*$gap),$y);
						    $pdf->MultiCell($cx, $cy, $Iqbal, $bo, 'C', 0);


						    
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+$cx+$cx+($i*$gap),$y);
						    $pdf->MultiCell($cx, $cy, $Syed, $bo, 'C', 0);


						    // Boy and Girl
		    				if ($Girl == 0){
		    					$Girl == "";
		    				} else {
				    			$pdf->SetFont($font_name);
							    $pdf->SetFont($font_name,'',$FontSize);
							    $pdf->SetFillColor(255,255,255);
							    $pdf->SetDrawColor(255,0,0);
							    $pdf->SetXY($x+($i*$gap),$y+$cy);
							    $pdf->MultiCell($cx+($cx/2), $cy, $Girl, $bo, 'C', 0);
							}

						    if ($Boy == 0) {
						    	$Boy == "";
						    } else {
				    			$pdf->SetFont($font_name);
							    $pdf->SetFont($font_name,'',$FontSize);
							    $pdf->SetFillColor(255,255,255);
							    $pdf->SetDrawColor(255,0,0);
							    $pdf->SetXY($x+$cx+($cx/2)+($i*$gap),$y+$cy);
							    $pdf->MultiCell($cx+($cx/2), $cy, $Boy, $bo, 'C', 0);
							}


						    // Total Students
		    				
			    			$pdf->SetFont($font_name);
						    $pdf->SetFont($font_name,'',$FontSize);
						    $pdf->SetFillColor(255,255,255);
						    $pdf->SetDrawColor(255,0,0);
						    $pdf->SetXY($x+($i*$gap),$y+($cy*2));
						    $pdf->MultiCell($cx*3, $cy, $Students, $bo, 'C', 0);
						}
	    			}

	    			$i++;
	    		} 		
			}
		}

		// Output the new PDF
		$pdf->Output('SSR' . '(' . $now_date  . ')' . '.pdf', 'I');
		//$pdf->Output();

	}
}