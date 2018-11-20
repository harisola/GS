<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Name_view extends MY_Controller {
	public function __construct(){
		parent::__construct();				
	}

	public function index()
	{			
		$this_class = $this->input->get(NULL, TRUE);
		$grade_section = "";

		$this->GradeName = "";
		$this->SectionName = "";
		$this->AllSections = "";

		//$this->GradeName = $this->class_list_sr_view_model->get_all_grade_name();

		if($this_class == false)
		{
			$this_class_access = true;
			// setting where statement for class list			
			foreach ($this->data['allowed_classes'] as $classes) {			
				if($classes['all_sections_allowed'] == 1)
				{
					$grade_section .= "grade_id = " . $classes['grade_id'] . " or ";
				}else{
					$grade_section .= "(grade_id = " . $classes['grade_id'] . " and section_id = " . $classes['section_id'] . ") or ";
				}
			}
			$grade_section = trim($grade_section, " or ");
		}else{
			$grade_pos = strrpos($this_class['class'], "-");
			$grade = substr($this_class['class'], 0, $grade_pos);
			$section = substr($this_class['class'], ($grade_pos+1), strlen($this_class['class']));

			$this->GradeName = $grade;			
			$this->SectionName = $section;
			$this->AllSections = $this->class_list_sr_view_model->get_all_sections_of_grade($grade);


			//var_dump($this->GradeName);
			//var_dump($this->SectionName);
			//var_dump($this->AllSections);

			// bounding to allowed classes
			$this_class_access = false;
			foreach ($this->data['allowed_classes'] as $classes) {
				if($this_class_access == false && $classes['grade_dname'] == $grade && ($classes['section_dname'] == $section || $classes['all_sections_allowed'] == 1)){
					/*var_dump($classes['grade_dname'] . "   " . $classes['section_dname']);*/
					$grade_section = "grade_dname = '" . $grade . "' and section_dname = '" . $section . "'";					
					$this_class_access = true;
				}
			}			
		}

		if($this_class_access == true)
		{
			// Getting all the allowed classes data
			$this->data['class_list_data'] = $this->class_list_sr_view_model->get_all_classes($grade_section, $this->active_academic_session, "no");
		}else{
			redirect('class_list/name_view');
		}
		

		$this->data['gradeSection'] =  $this->class_list_sr_view_model->get_all_grade_section($this->session->userdata['user_id']);
		if($this_class == false)
		{
			//$this->load->view('class_list/student_log/student_log_view_orb');
			$this->load->view('class_list/name_view/name_view_faculty_orb', $this->data['class_list_data']);
			// Loading footer
			/*$this->load->view('class_list/name_view/name_view_orb_footer');*/
			$this->load->view('class_list/face_view/face_view_orb_footer_org');
		}else{			
			
			$this->load->view('class_list/name_view/name_view_faculty_orb', $this->data['class_list_data']);
			$this->load->view('class_list/face_view/face_view_faculty_orb', $this->data['class_list_data']);
			$this->load->view('class_list/face_view/face_view_orb_footer_org');
			

			/*
			$this->load->view('class_list/student_log/student_log_view_orb');
			$this->load->view('class_list/face_view/face_view_orb_footer');	
			*/
		}					
	}



	public function printForm(){
		if(count($_POST)){			
			$GradeID = $_POST['selected_grade'];
			$SectionID = $_POST['selected_section'];			

			$StudentsData = $this->class_list_sr_view_model->get_students_info_of_GS($GradeID, $SectionID);

			$this->load->model('staff_integration/role_assign_program_model');
			$CnC_Teachers = $this->role_assign_program_model->get_CnC_Teacher($GradeID, $SectionID);


			$totalBoys = "";
			$totalGirls = "";
			$totalJinnah = "";
			$totalIqbal = "";
			$totalSyed = "";
			$totalPromoted = "";
			$totalDetain = "";
			$totalNew = "";
			$totalSiblingsPrimary = "";
			$totalSiblingsSecondary = "";

			$currentdate = date('d-M-Y');
			$previous_grade_section = "";
			
			// Overall Font Size			
			$font_name = 'Helvetica';
			$gender_mark_size = 26;
			$now_date = date('d-M-Y');

			require_once('components/pdf/fpdf/fpdf.php');
			require_once('components/pdf/fpdi/fpdi.php');

			
			// initiate FPDI			
			$pdf = new FPDI();
			$pdf->AddPage('P','A4');		


			$BBO = 0;
			$font_size = 10;
			/*$Title = "Generation's School" ;
    		$pdf->SetFont($font_name);
		    $pdf->SetFont($font_name,'B',$font_size);
		    $pdf->SetFillColor(255,255,255);
		    $pdf->SetDrawColor(255,0,0);
		    $pdf->SetXY(3,3);
		    $pdf->Cell(204, 6, $Title, $BBO, 0, 'C', 0);*/


		    $font_size = 20;		    
    		$pdf->SetFont($font_name);
		    $pdf->SetFont($font_name,'B',$font_size);
		    $pdf->SetFillColor(255,255,255);
		    $pdf->SetDrawColor(255,0,0);
		    $pdf->SetXY(3,5);
		    $pdf->Cell(204, 10, $StudentsData[0]['grade_name'] . '-' . $StudentsData[0]['section_name'], $BBO, 0, 'C', 0);


		    $font_size = 8;
		    $font_name = 'Helvetica';
    		$pdf->SetFont($font_name);
		    $pdf->SetFont($font_name,'B',$font_size);
		    $pdf->SetFillColor(255,255,255);
		    $pdf->SetDrawColor(255,0,0);
		    $pdf->SetXY(3,15);
		    $pdf->Cell(204, 6, date('D-d-M-Y H:i'), $BBO, 0, 'C', 0);

		    $pdf->SetTextColor(255,255,255);
		    $pdf->SetFont($font_name,'',7);
		    $pdf->SetFillColor(0,0,0);
		    $pdf->SetXY(150, 270);
		    $pdf->Cell(55, 3, date('D-d-M-Y H:i') . ' (' . ucwords($this->data['staff_registered_data'][0]->abridged_name) . ')', $BBO, 0, 'C', true);


		    $pdf->SetMargins(0,0,0);
			$pdf->SetAutoPageBreak(0,0);

			$BBO = 1;
		    $y = 30;
		    $cellHeight = 7;
		    $LastWidth = 0;		    
		    $starting_x = 7;		    

		    $width_roll_num = 15;		    
		    $width_gsid = 20;
			$width_abridged_name = 35;
			$width_official_name = 45;
			$width_call_name = 20;
			$width_dob = 20;
			$width_gender = 12;
			$width_age = 35;
			$width_gfid = 20;
			$width_house = 12;		    	    
			$width_previous_grade = 20;
			$width_siblings = 20;
			$width_father_name = 45;
			$width_mother_name = 40;
			$width_petitioner = 20;
			$width_blank = 40;


		    $pdf->SetTextColor(0,0,0);
		    // Roll #
		    $pdf->SetFont($font_name);
		    $pdf->SetFont($font_name,'B',9);
		    $pdf->SetFillColor(0,0,0);
		    $pdf->SetDrawColor(0,0,0);
		    $pdf->SetXY($starting_x,$y);
		    $pdf->Cell($width_roll_num, $cellHeight,'Roll #', $BBO, 0, 'C', 0);
		    $LastWidth += $width_roll_num + $starting_x;

		    // GS ID
		    $pdf->SetFont($font_name);
		    $pdf->SetFont($font_name,'B',9);
		    $pdf->SetFillColor(0,0,0);
		    $pdf->SetDrawColor(0,0,0);
		    $pdf->SetXY($LastWidth,$y);
		    $pdf->Cell($width_gsid, $cellHeight,'GS-ID', $BBO, 0, 'C', 0);
		    $LastWidth += $width_gsid;

		    // Student Status Code
		    $pdf->SetFont($font_name);
		    $pdf->SetFont($font_name,'B',9);
		    $pdf->SetFillColor(0,0,0);
		    $pdf->SetDrawColor(0,0,0);
		    $pdf->SetXY($LastWidth,$y);
		    $pdf->Cell($width_gsid, $cellHeight,'GS Status', $BBO, 0, 'C', 0);
		    $LastWidth += $width_gsid;

		    // Abridged Name
		    $pdf->SetFont($font_name);
		    $pdf->SetFont($font_name,'B',9);
		    $pdf->SetFillColor(0,0,0);
		    $pdf->SetDrawColor(0,0,0);
		    $pdf->SetXY($LastWidth,$y);
		    $pdf->Cell($width_abridged_name, $cellHeight,'Abridged Name', $BBO, 0, 'L', 0);
		    $LastWidth += $width_abridged_name;





		    /***************************************************************************************
		    ** All Post Variables
		    ****************************************************************************************/
		    if(isset($_POST['official_name'])){
		    	// Official Name
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',9);
			    $pdf->SetFillColor(0,0,0);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetXY($LastWidth,$y);
			    $pdf->Cell($width_official_name, $cellHeight,'Official Name', $BBO, 0, 'L', 0);
			    $LastWidth += $width_official_name;
			}

			if(isset($_POST['call_name'])){
				// Call Name
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',9);
			    $pdf->SetFillColor(0,0,0);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetXY($LastWidth,$y);
			    $pdf->Cell($width_call_name, $cellHeight,'Call Name', $BBO, 0, 'L', 0);
			    $LastWidth += $width_call_name;
			}

			if(isset($_POST['dob'])){
				// D O B
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',9);
			    $pdf->SetFillColor(0,0,0);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetXY($LastWidth,$y);
			    $pdf->Cell($width_dob, $cellHeight,'D O B', $BBO, 0, 'C', 0);
			    $LastWidth += $width_dob;
			}

			if(isset($_POST['gender'])){
				// Gender
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',9);
			    $pdf->SetFillColor(0,0,0);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetXY($LastWidth,$y);
			    $pdf->Cell($width_gender, $cellHeight,'Gender', $BBO, 0, 'C', 0);
			    $LastWidth += $width_gender;
			}

			if(isset($_POST['age'])){
				// Age
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',9);
			    $pdf->SetFillColor(0,0,0);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetXY($LastWidth,$y);
			    $pdf->Cell($width_age, $cellHeight,'Age', $BBO, 0, 'C', 0);
			    $LastWidth += $width_age;
			}

			if(isset($_POST['gf_id'])){
				// Age
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',9);
			    $pdf->SetFillColor(0,0,0);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetXY($LastWidth,$y);
			    $pdf->Cell($width_gfid, $cellHeight,'GF ID', $BBO, 0, 'C', 0);
			    $LastWidth += $width_gfid;
			}

			if(isset($_POST['house'])){
				// House
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',9);
			    $pdf->SetFillColor(0,0,0);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetXY($LastWidth,$y);
			    $pdf->Cell($width_house, $cellHeight,'House', $BBO, 0, 'C', 0);
			    $LastWidth += $width_house;
			}

			if(isset($_POST['previous_grade'])){
				// House
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',9);
			    $pdf->SetFillColor(0,0,0);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetXY($LastWidth,$y);
			    $pdf->Cell($width_previous_grade, $cellHeight,'Previous', $BBO, 0, 'C', 0);
			    $LastWidth += $width_previous_grade;
			}

			if(isset($_POST['siblings'])){
				// House
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',9);
			    $pdf->SetFillColor(0,0,0);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetXY($LastWidth,$y);
			    $pdf->Cell($width_siblings, $cellHeight,'Siblings', $BBO, 0, 'C', 0);
			    $LastWidth += $width_siblings;
			}

			if(isset($_POST['father_name'])){
				// House
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',9);
			    $pdf->SetFillColor(0,0,0);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetXY($LastWidth,$y);
			    $pdf->Cell($width_father_name, $cellHeight,'Father Name', $BBO, 0, 'L', 0);
			    $LastWidth += $width_father_name;
			}

			if(isset($_POST['mother_name'])){
				// House
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',9);
			    $pdf->SetFillColor(0,0,0);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetXY($LastWidth,$y);
			    $pdf->Cell($width_mother_name, $cellHeight,'Mother Name', $BBO, 0, 'L', 0);
			    $LastWidth += $width_mother_name;
			}

			if(isset($_POST['petitioner_code'])){
				// House
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',9);
			    $pdf->SetFillColor(0,0,0);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetXY($LastWidth,$y);
			    $pdf->Cell($width_petitioner, $cellHeight,'Petitioner', $BBO, 0, 'C', 0);
			    $LastWidth += $width_petitioner;
			}

			if(isset($_POST['blank'])){
				// House
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',9);
			    $pdf->SetFillColor(0,0,0);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetXY($LastWidth,$y);
			    $pdf->Cell($width_blank, $cellHeight,'', $BBO, 0, 'C', 0);
			    $LastWidth += $width_blank;
			}

			/********************************************************************************** END *****/





		    $i = 1; $fenceRed = 91; $fenceGreen = 85; $fenceBlue = 85;
		    foreach ($StudentsData as $student) {

		    	if($student['std_status_category'] == 'Fence' || $student['std_status_category'] == 'Out'){
			    	$pdf->SetTextColor($fenceRed,$fenceGreen,$fenceBlue);
			    }else{
			    	$pdf->SetTextColor(0,0,0);
			    }


		    	$y += $cellHeight;
		    	$LastWidth = 0;
		    	// Roll #
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',9);
			    $pdf->SetFillColor(0,0,0);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetXY($starting_x,$y);
			    $pdf->Cell($width_roll_num, $cellHeight,$i, $BBO, 0, 'C', 0);
			    if($student['std_status_category'] == 'Out'){
			    	$pdf->Cell($width_roll_num, $cellHeight, "---------------------------------------------------------------------", 0, 0, 'L', 0);
				}
			    $LastWidth += $width_roll_num + $starting_x;

			    // GS ID
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',9);
			    $pdf->SetFillColor(0,0,0);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetXY($LastWidth,$y);
			    $pdf->Cell($width_gsid, $cellHeight, $student['gs_id'], $BBO, 0, 'C', 0);
			    $LastWidth += $width_gsid;


			    // Student Status Code
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',9);
			    $pdf->SetFillColor(0,0,0);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetXY($LastWidth,$y);
			    $pdf->Cell($width_gsid, $cellHeight, $student['std_status_code'], $BBO, 0, 'C', 0);
			    $LastWidth += $width_gsid;


			    // Abridged Name
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',9);
			    $pdf->SetFillColor(0,0,0);
			    $pdf->SetDrawColor(0,0,0);
			    $pdf->SetXY($LastWidth,$y);
			    $pdf->Cell($width_abridged_name, $cellHeight, $student['abridged_name'], $BBO, 0, 'L', 0);
			    $LastWidth += $width_abridged_name;
			    




			    /***************************************************************************************
			    ** All Post Variables
			    ****************************************************************************************/
			    if(isset($_POST['official_name'])){
				    // Official Name
				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',9);
				    $pdf->SetFillColor(0,0,0);
				    $pdf->SetDrawColor(0,0,0);
				    $pdf->SetXY($LastWidth,$y);
				    $pdf->Cell($width_official_name, $cellHeight, $student['official_name'], $BBO, 0, 'L', 0);
				    $LastWidth += $width_official_name;				    
				}

				if(isset($_POST['call_name'])){
					// Call Name
				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',9);
				    $pdf->SetFillColor(0,0,0);
				    $pdf->SetDrawColor(0,0,0);
				    $pdf->SetXY($LastWidth,$y);
				    $pdf->Cell($width_call_name, $cellHeight, $student['call_name'], $BBO, 0, 'L', 0);
				    $LastWidth += $width_call_name;
				}

				if(isset($_POST['dob'])){
					// D O B
				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',9);
				    $pdf->SetFillColor(0,0,0);
				    $pdf->SetDrawColor(0,0,0);
				    $pdf->SetXY($LastWidth,$y);
				    $pdf->Cell($width_dob, $cellHeight, date('d-M-Y', strtotime($student['dob'])), $BBO, 0, 'C', 0);
				    $LastWidth += $width_dob;
				}

				if(isset($_POST['gender'])){
					// Gender
				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',9);
				    $pdf->SetFillColor(0,0,0);
				    $pdf->SetDrawColor(0,0,0);
				    $pdf->SetXY($LastWidth,$y);
				    $pdf->Cell($width_gender, $cellHeight, $student['gender'], $BBO, 0, 'C', 0);
				    $LastWidth += $width_gender;
				}

				if(isset($_POST['age'])){
					// Age
				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',9);
				    $pdf->SetFillColor(0,0,0);
				    $pdf->SetDrawColor(0,0,0);
				    $pdf->SetXY($LastWidth,$y);
				    $pdf->Cell($width_age, $cellHeight, $student['age_ym'], $BBO, 0, 'C', 0);
				    $LastWidth += $width_age;
				}

				if(isset($_POST['gf_id'])){
					// GF ID
				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',9);
				    $pdf->SetFillColor(0,0,0);
				    $pdf->SetDrawColor(0,0,0);
				    $pdf->SetXY($LastWidth,$y);
				    $pdf->Cell($width_gfid, $cellHeight, $student['gf_id'], $BBO, 0, 'C', 0);
				    $LastWidth += $width_gfid;
				}

				if(isset($_POST['house'])){
					// GF ID
				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',9);
				    $pdf->SetFillColor(0,0,0);
				    $pdf->SetDrawColor(0,0,0);
				    $pdf->SetXY($LastWidth,$y);
				    $pdf->Cell($width_house, $cellHeight, substr($student['house_name'], 0,1), $BBO, 0, 'C', 0);
				    $LastWidth += $width_house;
				}

				$previous_grade_section = 'New';
				if(strlen($student['previous_grade_section']) > 1){
					$previous_grade_section = $student['previous_grade_section'];
				}
				if(isset($_POST['previous_grade'])){					
					// House
				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',9);
				    $pdf->SetFillColor(0,0,0);
				    $pdf->SetDrawColor(0,0,0);
				    $pdf->SetXY($LastWidth,$y);
				    $pdf->Cell($width_previous_grade, $cellHeight,$previous_grade_section, $BBO, 0, 'C', 0);
				    $LastWidth += $width_previous_grade;
				}

				if(isset($_POST['siblings'])){
					// House
				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',9);
				    $pdf->SetFillColor(0,0,0);
				    $pdf->SetDrawColor(0,0,0);
				    $pdf->SetXY($LastWidth,$y);
				    $pdf->Cell($width_siblings, $cellHeight,$student['active_siblings_position'] . '/' . $student['active_siblings_total'], $BBO, 0, 'C', 0);
				    $LastWidth += $width_siblings;
				}

				if(isset($_POST['father_name'])){
					// House
				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',9);
				    $pdf->SetFillColor(0,0,0);
				    $pdf->SetDrawColor(0,0,0);
				    $pdf->SetXY($LastWidth,$y);
				    $pdf->Cell($width_father_name, $cellHeight,$student['father_name'], $BBO, 0, 'L', 0);
				    $LastWidth += $width_father_name;
				}

				if(isset($_POST['mother_name'])){
					// House
				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',9);
				    $pdf->SetFillColor(0,0,0);
				    $pdf->SetDrawColor(0,0,0);
				    $pdf->SetXY($LastWidth,$y);
				    $pdf->Cell($width_mother_name, $cellHeight,$student['mother_name'], $BBO, 0, 'L', 0);
				    $LastWidth += $width_mother_name;
				}

				if(isset($_POST['petitioner_code'])){
					// House
				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',9);
				    $pdf->SetFillColor(0,0,0);
				    $pdf->SetDrawColor(0,0,0);
				    $pdf->SetXY($LastWidth,$y);
				    $pdf->Cell($width_petitioner, $cellHeight,$student['petitioner_code'], $BBO, 0, 'C', 0);
				    $LastWidth += $width_petitioner;
				}


				if(isset($_POST['blank'])){
					// House
				    $pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',9);
				    $pdf->SetFillColor(0,0,0);
				    $pdf->SetDrawColor(0,0,0);
				    $pdf->SetXY($LastWidth,$y);
				    $pdf->Cell($width_blank, $cellHeight,'', $BBO, 0, 'C', 0);
				    $LastWidth += $width_blank;
				}

				/********************************************************************************** END *****/


				// Computation - Gender
				if($student['gender'] == 'B'){
					$totalBoys++;
				}else if($student['gender'] == 'G'){
					$totalGirls++;
				}


				// Computation - Hosue
				if($student['house_name'] == 'Jinnah'){
					$totalJinnah++;
				}else if($student['house_name'] == 'Iqbal'){
					$totalIqbal++;
				}else if($student['house_name'] == 'Syed'){
					$totalSyed++;
				}


				// Computation - Previous
				if($previous_grade_section == 'New'){
					$totalNew++;
				}else if(substr($previous_grade_section,0,strpos($previous_grade_section, "-")) == $StudentsData[0]['grade_name']){
					$totalDetain++;
				}else{
					$totalPromoted++;
				}


				// Computation - Siblings
				if($student['active_siblings_position'] == '1'){
					$totalSiblingsPrimary++;
				}else{
					$totalSiblingsSecondary++;
				}

			    $i++;
		    }
		    

   


		    /**************************************************************************************************
		    ** Class Teacher and Co Teacher
		    ***************************************************************************************************/
		    $pdf->SetTextColor(0,0,0);
		    $BBO = 0;
		    $font_size = 8;
		    $font_name = 'Helvetica';		    
    		$pdf->SetFont($font_name);
		    $pdf->SetFont($font_name,'',$font_size);
		    $pdf->SetFillColor(255,255,255);
		    $pdf->SetDrawColor(255,0,0);


		    $pdf->SetXY($starting_x-1,25);
		    $pdf->Cell(25, 5, 'Co Teacher : ', $BBO, 0, 'L', 0);

		    $pdf->SetXY($LastWidth-65,25);
		    $pdf->Cell(25, 5, 'Class Teacher : ', $BBO, 0, 'R', 0);

		    foreach ($CnC_Teachers as $Teacher) {
		    	$pdf->SetFont($font_name,'B',$font_size);
		    	if($Teacher['type_id'] == '15'){		    		
				    $pdf->SetXY($LastWidth-30,25);
				    $pdf->Cell(30, 5, $Teacher['staff_name'], $BBO, 0, 'R', 0);
		    	}

		    	if($Teacher['type_id'] == '16'){
		    		$pdf->SetXY(30,25);
				    $pdf->Cell(30, 5, $Teacher['staff_name'], $BBO, 0, 'L', 0);
		    	}
		    }
		    /********************************************************************************** END *****/
		    $starting_y = $y + 12;
			$BBO = 1;
		    $font_size = 6;
		    $font_name = 'Helvetica';		    
    		$pdf->SetFont($font_name);
		    $pdf->SetFont($font_name,'B',$font_size);

		    // Big Box
		    $pdf->SetFillColor(255,255,255);
		    $pdf->SetDrawColor(0,0,0);
		    $pdf->SetXY($starting_x,$starting_y);
		    $pdf->Cell(55, 24, '', $BBO, 0, 'L', 0);



		    $starting_x = 8.5;
		    $pdf->SetFont($font_name,'',$font_size);
		    // Gender Box
		    $pdf->SetFillColor(255,255,255);
		    $pdf->SetDrawColor(0,0,0);
		    $pdf->SetXY($starting_x+3,$starting_y+13);
		    $pdf->Cell(3, 3, 'B', $BBO, 0, 'C', 0);
		    $pdf->SetXY($starting_x+6,$starting_y+13);
		    $pdf->Cell(6, 3, $totalBoys, $BBO, 0, 'C', 0);
		    $pdf->SetXY($starting_x+3,$starting_y+16);
		    $pdf->Cell(3, 3, 'G', $BBO, 0, 'C', 0);
		    $pdf->SetXY($starting_x+6,$starting_y+16);
		    $pdf->Cell(6, 3, $totalGirls, $BBO, 0, 'C', 0);

		    // House Box
		    $pdf->SetXY($starting_x+15,$starting_y+10);
		    $pdf->Cell(3, 3, 'J', $BBO, 0, 'C', 0);
		    $pdf->SetXY($starting_x+18,$starting_y+10);
		    $pdf->Cell(6, 3, $totalJinnah, $BBO, 0, 'C', 0);
		    $pdf->SetXY($starting_x+15,$starting_y+13);
		    $pdf->Cell(3, 3, 'I', $BBO, 0, 'C', 0);
		    $pdf->SetXY($starting_x+18,$starting_y+13);
		    $pdf->Cell(6, 3, $totalIqbal, $BBO, 0, 'C', 0);
		    $pdf->SetXY($starting_x+15,$starting_y+16);
		    $pdf->Cell(3, 3, 'S', $BBO, 0, 'C', 0);
		    $pdf->SetXY($starting_x+18,$starting_y+16);
		    $pdf->Cell(6, 3, $totalSyed, $BBO, 0, 'C', 0);


		    // House Box
		    $pdf->SetXY($starting_x+27,$starting_y+10);
		    $pdf->Cell(3, 3, 'P', $BBO, 0, 'C', 0);
		    $pdf->SetXY($starting_x+30,$starting_y+10);
		    $pdf->Cell(6, 3, $totalPromoted, $BBO, 0, 'C', 0);
		    $pdf->SetXY($starting_x+27,$starting_y+13);
		    $pdf->Cell(3, 3, 'D', $BBO, 0, 'C', 0);
		    $pdf->SetXY($starting_x+30,$starting_y+13);
		    $pdf->Cell(6, 3, $totalDetain, $BBO, 0, 'C', 0);
		    $pdf->SetXY($starting_x+27,$starting_y+16);
		    $pdf->Cell(3, 3, 'N', $BBO, 0, 'C', 0);
		    $pdf->SetXY($starting_x+30,$starting_y+16);
		    $pdf->Cell(6, 3, $totalNew, $BBO, 0, 'C', 0);


		    // Siblings Box		    
		    $pdf->SetXY($starting_x+39,$starting_y+13);
		    $pdf->Cell(4, 3, 'PS', $BBO, 0, 'C', 0);		    
		    $pdf->SetXY($starting_x+43,$starting_y+13);
		    $pdf->Cell(6, 3, $totalSiblingsPrimary, $BBO, 0, 'C', 0);		    
		    $pdf->SetXY($starting_x+39,$starting_y+16);
		    $pdf->Cell(4, 3, 'SS', $BBO, 0, 'C', 0);		    
		    $pdf->SetXY($starting_x+43,$starting_y+16);
		    $pdf->Cell(6, 3, $totalSiblingsSecondary, $BBO, 0, 'C', 0);
		    


		    $starting_x = 7;
		    // Summary of Students
		    $pdf->SetFont($font_name,'B',$font_size);
		    $pdf->SetFillColor(221,221,219);
		    $pdf->SetDrawColor(0,0,0);
		    $pdf->SetXY($starting_x,$starting_y);
		    $pdf->Cell(55, 3, 'Summary of Students', $BBO, 0, 'C', 1);



		    // Header - Gender
		    $BBO = 0;
		    $font_size = 4;
		    $font_name = 'Helvetica';
    		$pdf->SetFont($font_name);
		    $pdf->SetFont($font_name,'B',$font_size);
		    $pdf->SetFillColor(255,255,255);
		    $pdf->SetDrawColor(255,0,0);
		    $pdf->SetXY($starting_x+4.5,$starting_y+6);
		    $pdf->Cell(9, 4, 'Gender', $BBO, 0, 'C', 0);
		    $pdf->SetXY($starting_x+4.5+9+3,$starting_y+6);
		    $pdf->Cell(9, 4, 'House', $BBO, 0, 'C', 0);
		    $pdf->SetXY($starting_x+4.5+9+15,$starting_y+6);
		    $pdf->Cell(9, 4, 'Previous', $BBO, 0, 'C', 0);
		    $pdf->SetXY($starting_x+4.5+9+15+12,$starting_y+6);
		    $pdf->Cell(10, 4, 'Siblings', $BBO, 0, 'C', 0);



		    // Class --> Grade-Section
		    $font_size = 6;
		    $BBO = 0;
		    $pdf->SetFont($font_name,'',$font_size);
		    $pdf->SetFillColor(255,255,255);
		    $pdf->SetDrawColor(0,0,0);
		    $pdf->SetXY($starting_x,$starting_y+3);
		    $pdf->Cell(55, 3, 'Class ' . $StudentsData[0]['grade_name'] . '-' . $StudentsData[0]['section_name'], $BBO, 0, 'C', 0);

		    // Total Students
		    $BBO = 1;
		    $pdf->SetFont($font_name,'B',$font_size);
		    $pdf->SetFillColor(221,221,219);
		    $pdf->SetDrawColor(0,0,0);
		    $pdf->SetXY($starting_x,$starting_y+24-3);
		    $pdf->Cell(55, 3, 'Total     ' . ($i-1), $BBO, 0, 'C', 1);

			/**************************************************************************************************
		    ** Class Teacher and Co Teacher
		    ***************************************************************************************************/

			/********************************************************************************** END *****/



			// Output the new PDF
			$pdf->Output($StudentsData[0]['grade_name'] . '-' . $StudentsData[0]['section_name'] . '.pdf', 'D');	
		}
	}
}