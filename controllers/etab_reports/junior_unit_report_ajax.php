<?php
class Junior_unit_report_ajax extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->font_helvitica = array('Helvetica','B',15);
		$this->load->library('session');
	}

	//**********************
	//Name:Rohail Aslam
	//Description:Unit Report
	//***********************
	public function get_junior_report(){
		$grade_id = $this->input->post('grade');
		$section_id = $this->input->post('section');
		$academic_session_id = $this->input->post('academic');
		$grade_name = $this->input->post('grade_name');
		$section_name = $this->input->post('section_name');
		$html = '';
		$url_link = '/etab_reports/junior_unit_report_ajax/unit_report_junior_pdf?grade_id='.$grade_id.'&section_id='.$section_id.'&academic_session_id='.$academic_session_id.'&grade_name='.$grade_name.'&section_name='.$section_name;
		$html .= '<style type="text/css">
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
                height: 100%;
            }
		</style>';
		$html .= '<div class="powerwidget purple">
              <header role="heading">
                <i class="fa fa-tasks"></i> Report : '.$grade_name.'-'.$section_name.'
                <span class="powerwidget-loader"></span>
              </header>
              <div class="inner-spacer" role="content">';        
		$html .= '<div class="unit_report_pdf_iframe">';
		$html .= '<iframe src="'.site_url($url_link).'" frameBorder=0></iframe>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';
		echo $html;
	}


		/*
			Name :Rohail Aslam
			Description:Return PDF OF Unit Report
			Date:Sep 20,2017
			User Library:FPDF
		*/
	public function unit_report_junior_pdf(){

		// GET RESPONSE
		if(isset($_GET)){
		$grade_id = $this->input->get('grade_id');
		$section_id = $this->input->get('section_id');
		$academic_session_id = $this->input->get('academic_session_id');
		$grade_name = $this->input->get('grade_name');
		$section_name = $this->input->get('section_name');
		}
		$class = $grade_name . "-".$section_name;


		//Load Model
		$this->load->model('atif_sp/assessment_report_model');
		// Assessment Subjects
		$this->data['assessment_titles'] = $this->assessment_report_model->get_unit_assessment_subjects_SessionTerm($grade_id, $section_id, "");
		// Assessment Student Data
		$this->data['students_gs_data'] = $this->assessment_report_model->get_students_grade_section_SessionTerm($grade_id, $section_id, "");
		// Assessment Aggregiate Marks
		$this->data['assessment_agg_marks'] = $this->assessment_report_model->Get_Formative_Unit_Marks_CurrentGS_SessionTerm($grade_id, $section_id, 1, "");
		$this->data['unit_weightage'] = $this->assessment_report_model->get_unit_assessment_weightage($grade_id,1,$academic_session_id);
		//User Information  
		$this->load->model('staff/staff_registered_model');
        $this->data['staff_registered_data'] = $this->staff_registered_model->get_by(array('user_id' => (int)$this->session->userdata('user_id')));

		$noOfSubject = sizeof($this->data['assessment_titles']);
		$noOfStudent = sizeof($this->data['students_gs_data']);
		// var_dump($noOfSubject);

		//Load FPDF Library
		require_once('\components\pdf\fpdf\rotation.php');
		require_once('\components\pdf\fpdi\fpdi.php');

		$pdf = new FPDF('P', 'mm', 'A4');
	

		$pdf->AddPage();
		
		$i = 0;


		$pdf->AddFont('CooperBT-Black','','CooperBlackBT.php');
		$heading_font_name = 'CooperBT-Black';
		$heading_font_size = 12;
		$pdf->SetFont($heading_font_name,'',$heading_font_size);
    	$pdf->SetXY(80,2);
    	$pdf->Cell(40,9,"Generation's School",0,'L');

    	$font_size = 8;
		$font_name = 'Helvetica';
		$pdf->SetFont($font_name,'',$font_size);

		$pdf->SetXY(81,6);
    	$pdf->Cell(50,9,"MID TERM ASSESSMENT REPORT.",0,'L');

    	$pdf->SetXY(94,9);
    	$pdf->Cell(50,9,"Junior Section",0,'L');

    	$pdf->SetXY(96,13);
    	$pdf->Cell(50,9,"2017-2018",0,'L');

    	$pdf->SetXY(99,17);
    	$pdf->Cell(50,9,"Term I",0,'L');

    	$pdf->SetFillColor(0,0,0);
		$pdf->SetTextColor(255,255,255);
		$pdf->SetXY(0,24);
		$pdf->Cell(210,5,$class,1,0,'C',1);

		$pdf->SetTextColor(0,0,0);
		$pdf->SetXY(1,30);
		$pdf->Cell(20,6,'Teacher:',0,'L');

		$pdf->SetXY(20,30);
		$pdf->Cell(20,6,$this->data['students_gs_data'][0]->class_teacher,0,'L');


		$pdf->SetXY(1,35);
		$pdf->Cell(20,6,'Term:',0,'L');

		$pdf->SetXY(20,35);
		$pdf->Cell(20,6,'I',0,'L');

		if(!empty($this->data['assessment_agg_marks'])){

		// X-AXIS
		$x_axis = 2;
		$y_axis = 41;
		$cell_width = 38;
		$cell_height = 10;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($cell_width,$cell_height,'Subjects',1,0,'C');

		$x_axis += $cell_width;
		$i = 0;
		$cell_width = 24;
		foreach($this->data['assessment_titles'] as $subject){
			$pdf->SetXY($x_axis,$y_axis);
			$pdf->Cell($cell_width,$cell_height,$subject->subject_name,1,0,'C');
			$x_axis = $x_axis + $cell_width;
		}

		$x_axis = 2;
		$y_axis +=  $cell_height;
		$cell_width = 38;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($cell_width,$cell_height,'Max Marks',1,0,'C');

		$x_axis = $x_axis+$cell_width;
		$cell_width = 24;


		foreach($this->data['assessment_titles'] as $subject){
			
			foreach ($this->data['unit_weightage'] as $weightage) {
				if($subject->subjects == $weightage->subject_id){
					$cell_width_small = 8;
					

						$pdf->SetXY($x_axis,$y_axis);
						$pdf->Cell($cell_width_small,$cell_height,$weightage->weightage,1,0,'C');

						$x_axis = $x_axis+$cell_width_small;
						$pdf->SetXY($x_axis,$y_axis);
						$pdf->Cell($cell_width_small,$cell_height,$weightage->percent,1,0,'C');

						$x_axis = $x_axis+$cell_width_small;
						$pdf->SetXY($x_axis,$y_axis);
						$pdf->Cell($cell_width_small,$cell_height,$weightage->grade,1,0,'C');
						$x_axis = $x_axis+$cell_width_small;
					
				}
			}

		}

		$x_axis = 2;
		$y_axis += $cell_height;
		

		$i = 0;
		$cell_height = 6.5;
		$subject_count = 0;
		foreach($this->data['students_gs_data'] as $student){
			$x_axis = 2;
			$cell_width_small = 4;
			$pdf->SetXY($x_axis,$y_axis);
			$pdf->Cell($cell_width_small,$cell_height,($i+1),1,0,'C');

			$x_axis = $x_axis+$cell_width_small;
			$cell_width = 26;
			$pdf->SetXY($x_axis,$y_axis);
			$pdf->Cell($cell_width,$cell_height,$student->abridged_name,1,0,'C');

			$x_axis = $x_axis+$cell_width;
			$cell_width = 8;
			$pdf->SetFont($font_name,'',6);
			$pdf->SetXY($x_axis,$y_axis);
			$pdf->Cell($cell_width,$cell_height,$student->gs_id,1,0,'C');

			$x_axis = $x_axis+$cell_width;
			$pdf->SetFont($font_name,'',$font_size);
			$j = 0;
			foreach($this->data['assessment_titles'] as $title){
				$flag_subject = 0;
				foreach ($this->data['assessment_agg_marks'] as $marks) {
					if($marks->gs_id == $student->gs_id && $marks->role_id == $title->role_id){
						$flag_subject = 1;
						$cell_width_small_number = 8;
						$pdf->SetXY($x_axis,$y_axis);
						$pdf->Cell($cell_width_small_number,$cell_height,$marks->aggrassessment,1,0,'C');

						$x_axis += $cell_width_small_number;

						$pdf->SetXY($x_axis,$y_axis);
						$pdf->Cell($cell_width_small_number,$cell_height,$marks->percentageAssessment,1,0,'C');

						$x_axis += $cell_width_small_number;

						$pdf->SetXY($x_axis,$y_axis);
						$pdf->Cell($cell_width_small_number,$cell_height,$marks->grade,1,0,'C');
						$subjectGrading[$i][$j] = $marks->grade; 
						$x_axis += $cell_width_small_number;
						$j++;
					 }

				}

				if($flag_subject == 0){
					$cell_width_small_number = 8;
					$pdf->SetXY($x_axis,$y_axis);
					$pdf->Cell($cell_width_small_number,$cell_height,'',1,0,'C');

					$x_axis += $cell_width_small_number;

					$pdf->SetXY($x_axis,$y_axis);
					$pdf->Cell($cell_width_small_number,$cell_height,'',1,0,'C');

					$x_axis += $cell_width_small_number;

					$pdf->SetXY($x_axis,$y_axis);
					$pdf->Cell($cell_width_small_number,$cell_height,'',1,0,'C');
					$x_axis += $cell_width_small_number;
				}

			}

			//$x_axis = $x_axis+$cell_width;
			$y_axis = $y_axis+$cell_height;
			$i++;

		}

		

		$x_axis = 2;
		$cell_width = 38;
		$cell_height = 5;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($cell_width,$cell_height,'A+',1,0,'L');

		$x_axis = $x_axis+$cell_width;

		// A+
	
		foreach ($this->data['assessment_titles'] as $title) {
			$flag  = 0;
			$a_plus = 0;
			foreach($this->data['assessment_agg_marks'] as $marks){
				if($marks->role_id == $title->role_id){
					$flag = 1;
					//var_dump($marks->grade);
					if($marks->grade == 'A+'){
						$a_plus = $a_plus+1;
					}

				}
			}
			if($flag == 0){
					$cell_width_small_number = 8;
					$pdf->SetXY($x_axis,$y_axis);
					$pdf->Cell($cell_width_small_number,$cell_height,'',1,0,'C');

					$x_axis += $cell_width_small_number;

					$pdf->SetXY($x_axis,$y_axis);
					$pdf->Cell($cell_width_small_number,$cell_height,'',1,0,'C');

					$x_axis += $cell_width_small_number;

					$pdf->SetXY($x_axis,$y_axis);
					$pdf->Cell($cell_width_small_number,$cell_height,'',1,0,'C');
					$x_axis += $cell_width_small_number;
			}

			if($flag == 1){
					$cell_width_small_number = 8;
					$pdf->SetXY($x_axis,$y_axis);
					$pdf->Cell($cell_width_small_number,$cell_height,'',1,0,'C');

					$x_axis += $cell_width_small_number;

					$pdf->SetXY($x_axis,$y_axis);
					$pdf->Cell($cell_width_small_number,$cell_height,'',1,0,'C');

					$x_axis += $cell_width_small_number;

					$pdf->SetXY($x_axis,$y_axis);
					$pdf->Cell($cell_width_small_number,$cell_height,$a_plus,1,0,'C');
					$x_axis += $cell_width_small_number;
			}
		}

		// A
		$y_axis = $cell_height+$y_axis;
		$x_axis = 2;
		$cell_width = 38;
		$cell_height = 5;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($cell_width,$cell_height,'A',1,0,'L');

		$x_axis = $x_axis+$cell_width;

		foreach ($this->data['assessment_titles'] as $title) {
			$flag  = 0;
			$a_grade = 0;
			foreach($this->data['assessment_agg_marks'] as $marks){
				if($marks->role_id == $title->role_id){
					$flag = 1;
					//var_dump($marks->grade);
					if($marks->grade == 'A'){
						$a_grade = $a_grade+1;
					}

				}
			}
			if($flag == 0){
					$cell_width_small_number = 8;
					$pdf->SetXY($x_axis,$y_axis);
					$pdf->Cell($cell_width_small_number,$cell_height,'',1,0,'C');

					$x_axis += $cell_width_small_number;

					$pdf->SetXY($x_axis,$y_axis);
					$pdf->Cell($cell_width_small_number,$cell_height,'',1,0,'C');

					$x_axis += $cell_width_small_number;

					$pdf->SetXY($x_axis,$y_axis);
					$pdf->Cell($cell_width_small_number,$cell_height,'',1,0,'C');
					$x_axis += $cell_width_small_number;
			}

			if($flag == 1){
					$cell_width_small_number = 8;
					$pdf->SetXY($x_axis,$y_axis);
					$pdf->Cell($cell_width_small_number,$cell_height,'',1,0,'C');

					$x_axis += $cell_width_small_number;

					$pdf->SetXY($x_axis,$y_axis);
					$pdf->Cell($cell_width_small_number,$cell_height,'',1,0,'C');

					$x_axis += $cell_width_small_number;

					$pdf->SetXY($x_axis,$y_axis);
					$pdf->Cell($cell_width_small_number,$cell_height,$a_grade,1,0,'C');
					$x_axis += $cell_width_small_number;
			}
		}


		// B+
		$y_axis = $cell_height+$y_axis;
		$x_axis = 2;
		$cell_width = 38;
		$cell_height = 5;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($cell_width,$cell_height,'B+',1,0,'L');

		$x_axis = $x_axis+$cell_width;

		foreach ($this->data['assessment_titles'] as $title) {
			$flag  = 0;
			$b_plus_grade = 0;
			foreach($this->data['assessment_agg_marks'] as $marks){
				if($marks->role_id == $title->role_id){
					$flag = 1;
					//var_dump($marks->grade);
					if($marks->grade == 'B+'){
						$b_plus_grade = $b_plus_grade+1;
					}

				}
			}
			if($flag == 0){
					$cell_width_small_number = 8;
					$pdf->SetXY($x_axis,$y_axis);
					$pdf->Cell($cell_width_small_number,$cell_height,'',1,0,'C');

					$x_axis += $cell_width_small_number;

					$pdf->SetXY($x_axis,$y_axis);
					$pdf->Cell($cell_width_small_number,$cell_height,'',1,0,'C');

					$x_axis += $cell_width_small_number;

					$pdf->SetXY($x_axis,$y_axis);
					$pdf->Cell($cell_width_small_number,$cell_height,'',1,0,'C');
					$x_axis += $cell_width_small_number;
			}

			if($flag == 1){
					$cell_width_small_number = 8;
					$pdf->SetXY($x_axis,$y_axis);
					$pdf->Cell($cell_width_small_number,$cell_height,'',1,0,'C');

					$x_axis += $cell_width_small_number;

					$pdf->SetXY($x_axis,$y_axis);
					$pdf->Cell($cell_width_small_number,$cell_height,'',1,0,'C');

					$x_axis += $cell_width_small_number;

					$pdf->SetXY($x_axis,$y_axis);
					$pdf->Cell($cell_width_small_number,$cell_height,$b_plus_grade,1,0,'C');
					$x_axis += $cell_width_small_number;
			}
		}

		// B
		$y_axis = $cell_height+$y_axis;
		$x_axis = 2;
		$cell_width = 38;
		$cell_height = 5;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($cell_width,$cell_height,'B',1,0,'L');

		$x_axis = $x_axis+$cell_width;

		foreach ($this->data['assessment_titles'] as $title) {
			$flag  = 0;
			$b_grade = 0;
			foreach($this->data['assessment_agg_marks'] as $marks){
				if($marks->role_id == $title->role_id){
					$flag = 1;
					//var_dump($marks->grade);
					if($marks->grade == 'B'){
						$b_grade = $b_grade+1;
					}

				}
			}
			if($flag == 0){
					$cell_width_small_number = 8;
					$pdf->SetXY($x_axis,$y_axis);
					$pdf->Cell($cell_width_small_number,$cell_height,'',1,0,'C');

					$x_axis += $cell_width_small_number;

					$pdf->SetXY($x_axis,$y_axis);
					$pdf->Cell($cell_width_small_number,$cell_height,'',1,0,'C');

					$x_axis += $cell_width_small_number;

					$pdf->SetXY($x_axis,$y_axis);
					$pdf->Cell($cell_width_small_number,$cell_height,'',1,0,'C');
					$x_axis += $cell_width_small_number;
			}

			if($flag == 1){
					$cell_width_small_number = 8;
					$pdf->SetXY($x_axis,$y_axis);
					$pdf->Cell($cell_width_small_number,$cell_height,'',1,0,'C');

					$x_axis += $cell_width_small_number;

					$pdf->SetXY($x_axis,$y_axis);
					$pdf->Cell($cell_width_small_number,$cell_height,'',1,0,'C');

					$x_axis += $cell_width_small_number;

					$pdf->SetXY($x_axis,$y_axis);
					$pdf->Cell($cell_width_small_number,$cell_height,$b_grade,1,0,'C');
					$x_axis += $cell_width_small_number;
			}
		}


		// C+
		$y_axis = $cell_height+$y_axis;
		$x_axis = 2;
		$cell_width = 38;
		$cell_height = 5;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($cell_width,$cell_height,'C+',1,0,'L');

		$x_axis = $x_axis+$cell_width;

		foreach ($this->data['assessment_titles'] as $title) {
			$flag  = 0;
			$c_plus = 0;
			foreach($this->data['assessment_agg_marks'] as $marks){
				if($marks->role_id == $title->role_id){
					$flag = 1;
					//var_dump($marks->grade);
					if($marks->grade == 'C+'){
						$c_plus = $c_plus+1;
					}

				}
			}
			if($flag == 0){
					$cell_width_small_number = 8;
					$pdf->SetXY($x_axis,$y_axis);
					$pdf->Cell($cell_width_small_number,$cell_height,'',1,0,'C');

					$x_axis += $cell_width_small_number;

					$pdf->SetXY($x_axis,$y_axis);
					$pdf->Cell($cell_width_small_number,$cell_height,'',1,0,'C');

					$x_axis += $cell_width_small_number;

					$pdf->SetXY($x_axis,$y_axis);
					$pdf->Cell($cell_width_small_number,$cell_height,'',1,0,'C');
					$x_axis += $cell_width_small_number;
			}

			if($flag == 1){
					$cell_width_small_number = 8;
					$pdf->SetXY($x_axis,$y_axis);
					$pdf->Cell($cell_width_small_number,$cell_height,'',1,0,'C');

					$x_axis += $cell_width_small_number;

					$pdf->SetXY($x_axis,$y_axis);
					$pdf->Cell($cell_width_small_number,$cell_height,'',1,0,'C');

					$x_axis += $cell_width_small_number;

					$pdf->SetXY($x_axis,$y_axis);
					$pdf->Cell($cell_width_small_number,$cell_height,$c_plus,1,0,'C');
					$x_axis += $cell_width_small_number;
			}
		}


		// C
		$y_axis = $cell_height+$y_axis;
		$x_axis = 2;
		$cell_width = 38;
		$cell_height = 5;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($cell_width,$cell_height,'C',1,0,'L');

		$x_axis = $x_axis+$cell_width;

		foreach ($this->data['assessment_titles'] as $title) {
			$flag  = 0;
			$c_grade = 0;
			foreach($this->data['assessment_agg_marks'] as $marks){
				if($marks->role_id == $title->role_id){
					$flag = 1;
					//var_dump($marks->grade);
					if($marks->grade == 'C'){
						$c_grade = $c_grade+1;
					}

				}
			}
			if($flag == 0){
					$cell_width_small_number = 8;
					$pdf->SetXY($x_axis,$y_axis);
					$pdf->Cell($cell_width_small_number,$cell_height,'',1,0,'C');

					$x_axis += $cell_width_small_number;

					$pdf->SetXY($x_axis,$y_axis);
					$pdf->Cell($cell_width_small_number,$cell_height,'',1,0,'C');

					$x_axis += $cell_width_small_number;

					$pdf->SetXY($x_axis,$y_axis);
					$pdf->Cell($cell_width_small_number,$cell_height,'',1,0,'C');
					$x_axis += $cell_width_small_number;
			}

			if($flag == 1){
					$cell_width_small_number = 8;
					$pdf->SetXY($x_axis,$y_axis);
					$pdf->Cell($cell_width_small_number,$cell_height,'',1,0,'C');

					$x_axis += $cell_width_small_number;

					$pdf->SetXY($x_axis,$y_axis);
					$pdf->Cell($cell_width_small_number,$cell_height,'',1,0,'C');

					$x_axis += $cell_width_small_number;

					$pdf->SetXY($x_axis,$y_axis);
					$pdf->Cell($cell_width_small_number,$cell_height,$c_grade,1,0,'C');
					$x_axis += $cell_width_small_number;
			}
		}
	
	}else{ // END IF NOT EMPTY ASSESSMENT WEIGHTAGE

		$x_axis = (($pdf->w)/2)-40;
		$y_axis = 40;
		$width = 50;
		$height = 10;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->SetFont($font_name,'',30);
		$pdf->Cell(0,$height,'No Assessment Created',0,0,'L');
	}
		

		$pdf->Output();
	}

}