<?php 

class Formative_report_ajax extends CI_Controller{

	public function __construct(){
		parent::__construct();
	}

	public function get_subject(){

		
		
		$gradeID = $this->input->post('grade');
		$sectionID = $this->input->post('section');
		$academic_id = $this->input->post('academic');
		$term_id = $this->input->post('term_id');



		$this->load->model('etab_reports/formative_report_model','frm');
		$programsetup = $this->frm->getProgramme($gradeID,$academic_id);

			



		/***********************************************ProgrammeSetup*************************************************************************************************************************************************************/

		$html = '';
		if(!empty($programsetup)){

			$html .="<thead>";
			$html .="<tbody>";

			foreach ($programsetup as $program) {

				if($program->optional == 1){

					$html .="<tr>";
					$html .= "<td class='optional' data-program='$program->id' data-subject='$program->subjects' data-grade = '".$gradeID."' data-academic = '".$academic_id. "' data-optional = '".$program->optional."' data-term = '".$term_id."'>".$program->name."</td>";
					$html .= "</tr>";
				}
				else if($program->optional == 0){


				$this->load->model('etab_reports/formative_report_model','frm');
				$select = "id,gp_id,staff_id";
				$where = array(
				'program_id' => $program->id,
				'academic_session_id' => $academic_id,
				'section_id' => $sectionID
				);

				$group ='';
				$role = $this->frm->get_by('atif_role_matrix.role_subject_teacher',$select,$where,$group);
		
				
				
					$html .="<tr>";
					$html .= "<td class='compulsory' data-program='$program->id' data-subject='$program->subjects' data-grade = '".$gradeID. "' data-academic ='".$academic_id."' data-section = '".$sectionID."' data-optional = '".$program->optional."' data-role ='".$role[0]->id."' data-term='".$term_id."' data-gp-id='".$role[0]->gp_id."'>".$program->name."</td>";
					$html .= "</tr>";
				}	
			}

			$html .="</thead>";
			$html .="</tbody>";

			$html .="<style>
				.optional{
					background-color:#F7DFDA;
				}
				.compulsory{
					background-color:#E2F4FA;
				}
			</style>";


			echo $html;
		}
	}

	//===================================Get Optional Group ==========================================================================================================================//

	public function get_optional_group(){


		$program = $this->input->post('program');
		$subject = $this->input->post('subject');
		$grade = $this->input->post('grade');
		$academic_id = $this->input->post('academic_id');
		$optional = $this->input->post('optional');
		$term_id = $this->input->post('term_id');




		if($optional == 1){

			$this->load->model('etab_reports/formative_report_model','frm');
			$select = "id,gp_id,staff_id";
			$where = array(
				'program_id' => $program,
				'academic_session_id' => $academic_id
			);

			$group ='';
			$group = $this->frm->get_by('atif_role_matrix.role_subject_teacher',$select,$where,$group);

			$html="";
			$html .="<div class='col-md-2'>";
			$html .="<div class='powerwidget black' data-widget-editbutton='false' data-widget-deletebutton='false' id='group-option'>";
			$html .= "<header><h2>Optional Group Block</h2></header>";
			$html .= "<div class='inner-spacer' style='overflow-y: scroll; height: 35vh;'>";
			$html .= "<table class='table table-hover'>";
			$html .="<thead></thead>";
			$html .= "<tbody>";
			foreach ($group as $group_block) {
			 $html .= "<tr>";
			 $html .="<td class='option_selection' data-program='".$program."' data-subject = '".$subject."' data-grade='".$grade."' data-academic = '".$academic_id."' data-gp_id = '".$group_block->gp_id. "' data-optional= '".$optional."' data-role ='".$group_block->id."'data-term ='".$term_id."'>";
			 $html .= $group_block->gp_id;
			 $html .="</td>";
			 $html .= "</tr>";		
			}
			$html .= "</tbody>";
			$html .= "</table>";
			$html .= "</div>";
			$html .= "</div>";
			$html .= "</div>";

			echo $html;
	

		}
	}

	//====================================Class Assessment Reports ============================//
	//========================================================================================//

	    public function getThisProgramAssessment_PDF(){
    	$html = '';


    	$user_id = $this->input->post("user_id");
        $role_id = $this->input->post("role_id");
        $sectionID = $this->input->post("sectionID");
        $gradeID = $this->input->post("gradeID");
        $optional = $this->input->post("optional");
        //$GPID = $this->input->post("GPID");
        $prgmID = $this->input->post("prgmID");
        $gpp_id = $this->input->post("gpp_id");
        $academic = $this->input->post("academic");
        $term = $this->input->post("term");
        $subjectID = $this->input->post("subjectID");


        
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


		$helper = 'user_id='.$user_id.'&role_id='.$role_id.'&sectionID='.$sectionID.'&optional='.$optional.'&prgmID='.$prgmID.'&gpp_id='.$gpp_id.'&academic='.$academic.'&term='.$term.'&subjectID='.$subjectID.'&gradeID='.$gradeID.'&groupID='.$groupID.'&blockID='.$blockID;


		$html .= '
		<div class="unit_report_pdf_iframe">
			<iframe src="'.site_url().'/etab_reports/Formative_report_ajax/show_Assessment_Report_PDF?'.$helper.'" frameborder="0">
			</iframe>
		</div>';

		
    	echo $html;
    }

    public function show_Assessment_Report_PDF(){
        
        $user_id = $this->input->get("user_id");
        $role_id = $this->input->get("role_id");
        $sectionID = $this->input->get("sectionID");
        $gradeID = $this->input->get("gradeID");
        $optional = $this->input->get("optional");
        
        $prgmID = $this->input->get("prgmID");
        $gpp_id = $this->input->get("gpp_id");
        $academic = $this->input->get("academic");
        $term = $this->input->get("term");
        $subjectID = $this->input->get("subjectID");






        $this->load->model('atif_sp/assessment_report_model');
        $GroupID = 0;
        $BlockID = 0;



        /**************************** Assessment Titles 
        /***********************************************/
        $this->data['assessment_titles'] = $this->assessment_report_model->get_grade_subject_assessments($gradeID, $subjectID, $role_id, $term);
        /******************************** Students Data 
        /***********************************************/
        if($optional == 0){
        	$this->data['students_gs_data'] = $this->assessment_report_model->get_students_grade_section($gradeID, $sectionID);
        }else{
        	$GroupID = substr(substr($gpp_id, -3), 0, 1);
        	if($GroupID == 'A'){$GroupID=1;}else
        	if($GroupID == 'B'){$GroupID=2;}else
        	if($GroupID == 'C'){$GroupID=3;}else
        	if($GroupID == 'D'){$GroupID=4;}else
        	if($GroupID == 'E'){$GroupID=5;}else
        	if($GroupID == 'F'){$GroupID=6;}

        	$BlockID = substr($gpp_id, -1);

        	$this->data['students_gs_data'] = $this->assessment_report_model->get_students_grade_optional_group_block($gradeID, $subjectID, $GroupID, $BlockID);
        }
        /***************************** Assessment Marks
        /***********************************************/
        if($optional == 0){
	        $this->data['assessment_marks'] = $this->assessment_report_model->get_grade_subject_assessments_marks($gradeID, $sectionID, $subjectID, $role_id, $term);
	    }else{
	    	$this->data['assessment_marks'] = $this->assessment_report_model->get_grade_subject_optional_assessments_marks($gradeID, $subjectID, $GroupID, $BlockID, $role_id, $term);
	    }

        /******************* Assessment Aggregate Marks 
        /***********************************************/
        if($optional == 0){
	        $this->data['assessment_agg_marks'] = $this->assessment_report_model->get_grade_subject_assessments_aggMarks($gradeID, $sectionID, $subjectID, $role_id, $term);
	    }else{
	    	$this->data['assessment_agg_marks'] = $this->assessment_report_model->get_grade_subject_optional_assessments_aggMarks($gradeID, $subjectID, $GroupID, $BlockID, $role_id, $term);
	    }



	    $noOfStudents = sizeof($this->data['students_gs_data']);
    	$noOfAssessments = 0;








     	


     	// Overall Font Size
		$font_size = 8;
		$font_name = 'Helvetica'; //Helvetica
		$gender_mark_size = 26;
		$now_date = date('d-M-Y');
		$border = 1;

	



		require_once('components/pdf/fpdf/fpdf_rotate.php');
		require_once('components/pdf/fpdi/fpdi.php');

		


		
		// initiate FPDI		
		$pdf = new PDF('P', 'mm', 'A4');
		

		$pdf->AddPage();
		$pdf->SetFont($font_name,'',$font_size);
		$i = 0;



		$borderon = 0;
		$rptheading_X = 40;
		$rptheading_Y = 7;
		$rptheading_CW = 65;
		$rptheading_CH = 10;
		
		if(empty($this->data['assessment_marks'][0]->subject_name)){
			$subject_name = '';
		}else{			
			$subject_name = $this->data['assessment_marks'][0]->subject_name;
		}
		



		$assessment_X = 81+40-7;
		$assessment_Y = 7;

		$student_X = 40;
		$student_Y = 57;
		$student_CH = 4;



		/**************************************************** Report Heading
		*********************************************************************/
		$pdf->AddFont('CooperBT-Black','','CooperBlackBT.php');

		$heading_font_name = 'CooperBT-Black';
		$heading_font_size = 12;
		$pdf->SetFont($heading_font_name,'',$heading_font_size);
    	$pdf->SetXY($rptheading_X,$rptheading_Y);
    	$pdf->Cell($rptheading_CW,$rptheading_CH,"Generation's School",$borderon,2,'L');


    	$heading_font_name = 'Helvetica';
		$heading_font_size = 10;
		$pdf->SetFont($heading_font_name,'',$heading_font_size);
    	$pdf->Cell($rptheading_CW,$rptheading_CH-5,"Formative Report",$borderon,2,'L');
    	$pdf->Cell($rptheading_CW,$rptheading_CH-6,$gpp_id,$borderon,2,'L');
    	$pdf->Cell($rptheading_CW,$rptheading_CH-6,$subject_name,$borderon,2,'L');

    	

		/*************************************************** Assessment Titles
		***********************************************************************/




		/*************************************************** Assessment Titles
		***********************************************************************/
		$noOfAssessments=0;


		
		$original = array();		
		//array_splice( $original, 3, 0, $inserted); // splice in at position 3
		foreach ($this->data['assessment_titles'] as $title) {			
			array_push($original, (array)$title);
			if(($title->assessment_typeid == '65' || $title->assessment_typeid == '76') && $title->this_order == 2){
				$inserted = array(
					'full_name' => 'Grade',
					'assessment_typeid' => $title->assessment_typeid,
					'this_order' => 2,
					'assessment_type_id' => 9999,
					'assessment_id' => $title->assessment_type_id
					); 				
				array_push($original, $inserted);
			}
		}

		
		



		foreach ($original as $data) {


			$lastx = 0;
			$lasty = 0;

			
			
			if($data['assessment_typeid'] == '65' || $data['assessment_typeid'] == '76')
			{
				$col = $data['full_name'];

			   	// $pdf->Cell($X,$Y,,$border);

				if($data['this_order'] == 2){
					// Fill Grey
					if($data['assessment_type_id']==9999){
						$pdf->SetFillColor(220,220,220);
					}else{
						$pdf->SetFillColor(200,200,200);
					}




					if($data['assessment_typeid'] == '65'){
						if($data['assessment_type_id']==9999){
							$col = 'Grade';
						}else{
							$col = 'Class Assessment';
						}
					}/*else if($data['assessment_typeid'] == '76'){
						$col = 'Review Assessment';
					}*/
					}else{
						// Fill White
						$pdf->SetFillColor(255,255,255);
					}

				
				if($data['assessment_type_id'] == 9999 && $data['assessment_typeid'] == '76'){}
				else{
		   		$pdf->RotatedCell($assessment_X+$i,$assessment_Y,50,7,$col,1,0,'R',270,1);

		   		$i += $assessment_Y;	

		   		$noOfAssessments++;	}
			   	
			}
		}
		$pdf->SetFillColor(255,255,255);
	/*	$pdf->RotatedCell($assessment_X+$i,$assessment_Y,50,7,'Total (100)',1,0,'R',270,1);
		$pdf->RotatedCell($assessment_X+$i+7,$assessment_Y,50,7,'Percentage',1,0,'R',270,1);
		$pdf->RotatedCell($assessment_X+$i+14,$assessment_Y,50,7,'Rank',1,0,'R',270,1);*/










		/******************************************************** Student Info
		***********************************************************************/
		$i = 0;
		$counter = 1;
		$marks_Total = 0;


		// Heading
    	$pdf->SetFont($font_name,'B',$font_size);
    	$pdf->SetXY($student_X,$student_Y-$student_CH);
    	$pdf->Cell(7,$student_CH,'Sr',1,0,'C');
    	$pdf->Cell(15,$student_CH,'GS-ID',1,0,'C');
    	$pdf->Cell(30,$student_CH,'Student Name',1,0,'L');
    	$pdf->Cell(15,$student_CH,'GS Status',1,0,'C');





    	$arr_y=0;
    	$arr_x=0;

    	$classAssGrade = array();
        $classAssArrVal = 0;
		foreach ($this->data['students_gs_data'] as $data) {

			$arr_x=0;
			$font_size = 7;
			$marks_Total = 0;
        	// Data
        	$pdf->SetFillColor(255,255,255); 
        	$pdf->SetFont($font_name,'',$font_size);
        	$pdf->SetXY($student_X,$student_Y+$i);
        	$pdf->Cell(7,$student_CH,$counter,1,0,'C');
        	$pdf->Cell(15,$student_CH,$data->gs_id,1,0,'C');
        	$pdf->Cell(30,$student_CH,$data->abridged_name,1,0,'L');
        	$pdf->Cell(15,$student_CH,$data->std_status_code,1,0,'C');



        	$z = -7;
        	$font_size = 8;        	        	
        	foreach ($original as $title) {
        		if($title['assessment_typeid'] == '65' || $title['assessment_typeid'] == '76')
				{
	        		if($title['this_order'] == '1'){
	        			$marksObtained = 0;
	        			foreach ($this->data['assessment_marks'] as $marks) {
	        				if($marks->gs_id == $data->gs_id
	        					&& $marks->ass_detail_id == $title['assessment_type_id']
	        					&& $marks->marks_obtained > 0){

	        					$marksObtained = $marks->marks_obtained;
	        				}
	        			}

	        			$pdf->SetFillColor(255,255,255);
	        			$pdf->SetXY($assessment_X+$z,$student_Y+$i);
	        			$pdf->Cell(7,$student_CH,$marksObtained,1,0,'C', 1);
	        			$totalMarks[$arr_y][$arr_x] = $marksObtained;

	        		}else if($title['this_order'] == '2'){
	        			$marksObtained = 0;
	        			$pdf->SetFillColor(200,200,200);
	        			foreach ($this->data['assessment_agg_marks'] as $marks) {
	        				if($marks->gs_id == $data->gs_id
	        					&& $marks->assessment_id == $title['assessment_type_id']
	        					&& $marks->aggrAssessment > 0){

	        					$marksObtained = $marks->percAssessment;	        					
	        				}else if($marks->gs_id == $data->gs_id
	        					&& $title['assessment_type_id'] == 9999
	        					&& $marks->assessment_id == $title['assessment_id']){		
	        					$marksObtained = $marks->grade;
	        					$pdf->SetFillColor(220,220,220);
	        					if($title['assessment_type_id'] == 9999 && $title['assessment_typeid'] == '65'){
	        						$classAssGrade[$classAssArrVal] = $marks->grade;
	        						$classAssArrVal++;
	        					}
		        				
	        				}
	        			}


	        			if($title['assessment_type_id'] == 9999 && $title['assessment_typeid'] == '76'){}
	        			else{$marks_Total += $marksObtained;
	        			$pdf->SetXY($assessment_X+$z,$student_Y+$i);
	        			$pdf->Cell(7,$student_CH,$marksObtained,1,0,'C', 1); 
	        			$totalMarks[$arr_y][$arr_x] = $marksObtained;}
	        		}
	        		$z+=7;
	        		$arr_x++;				
	        	}
        	}

        	


			$marks_Total = ROUND($marks_Total, 1);        	
			/*$pdf->SetXY($assessment_X+$z,$student_Y+$i);
			$pdf->Cell(7,$student_CH,$marks_Total,1,0,'C'); */

			$marks_Total = ROUND($marks_Total, 0);        	
			/*$pdf->SetXY($assessment_X+$z+7,$student_Y+$i);
			$pdf->Cell(7,$student_CH,$marks_Total,1,0,'C');*/

			$student_totalMarks[$arr_y] = $marks_Total;


        	$i += $student_CH;
        	$counter++;
        	$arr_y++;
        }



        /************************************************* Student Ranking
        /******************************************************************/
       /* $i=0;
        for($j=0; $j<$noOfStudents; $j++){
        	$studentRank = $this->assessment_report_model->getRankOf($student_totalMarks, $student_totalMarks[$j]);
        	$pdf->SetXY($assessment_X+$z+14,$student_Y+$i);
			$pdf->Cell(7,$student_CH,$studentRank,1,0,'C');
			$i += $student_CH;
        }*/
        /******************************************************************/









        /********************************************* Average Computation
        /******************************************************************/
        /*$z = -7;
        $showMarks = 0;
        $pdf->SetXY($student_X+22,$student_Y+$i);
    	$pdf->Cell(45,$student_CH,'Average',1,0,'R');
    	$pdf->SetXY($student_X+22,$student_Y+$i+4);
    	$pdf->Cell(45,$student_CH,'Above Average',1,0,'R');
    	$pdf->SetXY($student_X+22,$student_Y+$i+8);
    	$pdf->Cell(45,$student_CH,'Below Average',1,0,'R');

    	$AboveAverageCount = 0;
    	$BelowAverageCount = 0;
        for($x=0; $x<$noOfAssessments; $x++){	// No of Assessment
        	$showMarks = 0;
        	$AboveAverageCount = 0;
    		$BelowAverageCount = 0;
        	for($y=0; $y<$noOfStudents; $y++){	// No of Students
        		$showMarks += $totalMarks[$y][$x];
        	}



        	
    		$pdf->SetFillColor(255,255,255);
        	
    		$showMarks = ROUND($showMarks / $noOfStudents, 1);
        	$pdf->SetXY($assessment_X+$z,$student_Y+$i);
			$pdf->Cell(7,$student_CH,$showMarks,1,0,'C', 1);

			for($y=0; $y<$noOfStudents; $y++){	// No of Students
        		if($totalMarks[$y][$x] > $showMarks){
        			$AboveAverageCount++;
        		}else if($totalMarks[$y][$x] <= $showMarks){
					$BelowAverageCount++;
				}
        	}

        	
        	$pdf->SetXY($assessment_X+$z,$student_Y+$i+4);
			$pdf->Cell(7,$student_CH,$AboveAverageCount,1,0,'C', 1);
			
        	$pdf->SetXY($assessment_X+$z,$student_Y+$i+8);
			$pdf->Cell(7,$student_CH,$BelowAverageCount,1,0,'C', 1);
        	

			$z+=7;	 
        }*/

        

        $cellHeight = 5;
        $cellWidth = 21;

        $pdf->SetFillColor(255,255,255);
        $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Grade',1,0,'L',1);

        $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'%',1,0,'C',1);

        // $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        // $pdf->Cell($cellWidth,$cellHeight,'Grade',1,0,'C',1);

        $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Grades Total',1,0,'C',1);


        // $pdf->SetXY($rptheading_X+($cellWidth*4),$student_Y+($counter*$cellHeight));
        // $pdf->Cell($cellWidth,$cellHeight,'Avg',1,0,'C',1);



        //A++
        $counter++;
        $cellWidth = 21;
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'A+',1,0,'C',1);

        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'90% To 100%',1,0,'C',1);

        // $pdf->SetFillColor(211,211,211);
        // $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        // $pdf->Cell($cellWidth,$cellHeight,'A+',1,0,'L',1);

        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$this->assessment_report_model->CountThisGradeIn($classAssGrade, 'A+'),1,0,'C',1);

        // $pdf->SetFillColor(211,211,211);
        // $pdf->SetXY($rptheading_X+($cellWidth*4),$student_Y+($counter*$cellHeight));
        // $pdf->Cell($cellWidth,$cellHeight,'5.0',1,0,'L',1);

        //A
        $counter++;
        $cellWidth = 21;
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'A',1,0,'C',1);

        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'80% To 89%',1,0,'C',1);

        // $pdf->SetFillColor(211,211,211);
        // $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        // $pdf->Cell($cellWidth,$cellHeight,'A',1,0,'L',1);

        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$this->assessment_report_model->CountThisGradeIn($classAssGrade, 'A'),1,0,'C',1);

        // $pdf->SetFillColor(211,211,211);
        // $pdf->SetXY($rptheading_X+($cellWidth*4),$student_Y+($counter*$cellHeight));
        // $pdf->Cell($cellWidth,$cellHeight,'25.0',1,0,'L',1);


        //B
        $counter++;
        $cellWidth = 21;
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'B',1,0,'C',1);

        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'70% To 79%',1,0,'C',1);

        // $pdf->SetFillColor(211,211,211);
        // $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        // $pdf->Cell($cellWidth,$cellHeight,'B',1,0,'L',1);

        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$this->assessment_report_model->CountThisGradeIn($classAssGrade, 'B'),1,0,'C',1);

        // $pdf->SetFillColor(211,211,211);
        // $pdf->SetXY($rptheading_X+($cellWidth*4),$student_Y+($counter*$cellHeight));
        // $pdf->Cell($cellWidth,$cellHeight,'0.0',1,0,'L',1);


        //C
        $counter++;
        $cellWidth = 21;
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'C',1,0,'C',1);

        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'60% To 69%',1,0,'C',1);

        // $pdf->SetFillColor(211,211,211);
        // $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        // $pdf->Cell($cellWidth,$cellHeight,'C',1,0,'L',1);

        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$this->assessment_report_model->CountThisGradeIn($classAssGrade, 'C'),1,0,'C',1);

        // $pdf->SetFillColor(211,211,211);
        // $pdf->SetXY($rptheading_X+($cellWidth*4),$student_Y+($counter*$cellHeight));
        // $pdf->Cell($cellWidth,$cellHeight,'25.0',1,0,'L',1);


        //D
        $counter++;
        $cellWidth = 21;
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'D',1,0,'C',1);

        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'50% To 59%',1,0,'C',1);

        // $pdf->SetFillColor(211,211,211);
        // $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        // $pdf->Cell($cellWidth,$cellHeight,'D',1,0,'L',1);

        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$this->assessment_report_model->CountThisGradeIn($classAssGrade, 'D'),1,0,'C',1);

        // $pdf->SetFillColor(211,211,211);
        // $pdf->SetXY($rptheading_X+($cellWidth*4),$student_Y+($counter*$cellHeight));
        // $pdf->Cell($cellWidth,$cellHeight,'25.0',1,0,'L',1);

        //U

        $counter++;
        $cellWidth = 21;
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'U',1,0,'C',1);

        
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Below 50%',1,0,'C',1);

        // $pdf->SetFillColor(211,211,211);
        // $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        // $pdf->Cell($cellWidth,$cellHeight,'U',1,0,'L',1);

        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$this->assessment_report_model->CountThisGradeIn($classAssGrade, 'U'),1,0,'C',1);

        // $pdf->SetFillColor(211,211,211);
        // $pdf->SetXY($rptheading_X+($cellWidth*4),$student_Y+($counter*$cellHeight));
        // $pdf->Cell($cellWidth,$cellHeight,'25.0',1,0,'L',1);


        /******************************************************************/

        /****************************************Report Footer**************
		*********************************************************/	
        $this->load->model('staff/staff_registered_model');
		$this->data['staff_registered_data'] = $this->staff_registered_model->get_by(array('user_id' => (int)$this->session->userdata('user_id')));
		$pdf->SetFillColor(0,0,0);
		$pdf->SetTextColor(255,255,255);
    	$pdf->SetXY(7,$student_Y+($counter*5.5));
    	$pdf->Cell(60, 4, date('D-d-M-Y H:i') . ' (' . ucwords($this->data['staff_registered_data'][0]->abridged_name) . ')', 1, 0, 'L', 1);

			



		

		// Output the new PDF
		$pdf->Output('Assessment_Report' . '.pdf', 'I');   
    }

        public function get_student_option_allocation(){
    	
    	$user_id = $this->input->post('user_id');
    	$role_id = $this->input->post('role_id');
    	$sectionID = $this->input->post('sectionID');
    	$optional = $this->input->post('optional');
    	$program_id = $this->input->post('prgmID');
    	$gp_id = $this->input->post('gpp_id');
    	$academic_id = $this->input->post('academic');
    	$term = $this->input->post('term');
    	$subject_id = $this->input->post('subjectID');
    	$grade_id = $this->input->post('gradeID');

    	$helper = 'academic_id='.$academic_id.'&grade_id='.$grade_id.'&section_id='.$sectionID.'&program_id='.$program_id.'&subject_id='.$subject_id.'&gp_id='.$gp_id.'&role_id='.$role_id.'&user_id='.$user_id.'&term_id='.$term.'&optional='.$optional;



    	$html = '';
    	$html .= '<style>
    			  iframe{
    			  	width:100%;
    			  	height:800px;
    			  }
    			</style>';
    	$html .= '<div class="powerwidget purple">';
    	$html .= '<header>Student Option Allocation</header>';
    	$html .= '<div class="inner-spacer">';
    	$html .= '<iframe src='.site_url().'/etab_reports/formative_report_ajax/get_student_option_allocation_pdf?'.$helper.'></iframe>';
    	$html .= '</div>';
    	$html .= '</div>';

    	echo $html ;
    }

    public function get_student_option_allocation_pdf(){
    	
    	$academic_id =  $this->input->get('academic_id');
    	$grade_id =  $this->input->get('grade_id');
    	$section_id =  $this->input->get('section_id');
    	$program_id =  $this->input->get('program_id');
    	$subject_id =  $this->input->get('subject_id');
    	$gp_id = $this->input->get('gp_id');
    	$role_id =  $this->input->get('role_id');
    	$user_id = $this->input->get('user_id');
    	$optional = $this->input->get('optional');
    	$term_id = $this->input->get('term_id');


    	


    	$gpp_id = explode("-", $gp_id);
    	$group = $gpp_id[2];
    	$block = $gpp_id[3];

    	if(!empty($group)){
    		if($group == 'A'){
    			$group = 1;
    		}elseif($group == 'B'){
    			$group = 2;
    		}elseif($group == 'C'){
    			$group = 3;
    		}elseif($group == 'D'){
    			$group = 4;
    		}elseif($group == 'E'){
    			$group = 5;
    		}elseif($group == 'F'){
    			$group =6;
    		}
    	}

    	$key = 'a_'.$academic_id.'_t_'.$term_id.'_grd_'.$grade_id.'_grp_'.$group.'_s_'.$subject_id;

    	$this->load->model('etab_reports/formative_report_model','frm');
    	$get_block = $this->frm->get_subjectblocks($key,$program_id,$subject_id);
    	$block_id = $get_block[0]->ID;

    	$student_selected_block = $this->frm->studentselectedblock($block_id,$block);

    	require_once('components/pdf/fpdf/fpdf_rotate.php');
    	require_once('components/pdf/fpdi/fpdi.php');

    	$pdf = new PDF('P','mm','A4');

    	$pdf->AddPage();

    	$page_height = $pdf->h;
    	

    	$page_center_xaxis =80;
    	$y_axis = 8;
    	$rptheading_CW = 65;
		$rptheading_CH = 10;
		$borderon = 1;

    	// =================School Heading====================//
    	$pdf->AddFont('CooperBT-Black','','CooperBlackBT.php');
		$heading_font_name = 'CooperBT-Black';
		$heading_font_size = 12;
		$pdf->SetFont($heading_font_name,'',$heading_font_size);
    	$pdf->SetXY($page_center_xaxis,$y_axis);
    	$pdf->Cell($rptheading_CW,$rptheading_CH,"Generation's School",0,0,'C');


    	$page_center_xaxis = 80;
    	$y_axis = $y_axis+10;
    	$heading_font_size = 8;
    	$pdf->SetFont($heading_font_name,'',$heading_font_size);
    	$pdf->SetXY($page_center_xaxis,$y_axis);
    	$pdf->Cell($rptheading_CW,$rptheading_CH,"Student Options Allocation",0,0,'C');

    	$page_center_xaxis = 78;
    	$y_axis = $y_axis+10;
    	$heading_font_size = 8;
    	$pdf->SetFont($heading_font_name,'',$heading_font_size);
    	$pdf->SetXY($page_center_xaxis,$y_axis);
    	$pdf->Cell($rptheading_CW,$rptheading_CH,$gp_id,0,0,'C');


    	//================= Header of a report=============================//
    	$x_axis = 50;	
    	$font_name = "Helvetica";
    	$cellWidth = 40;
    	$cellHeight = 7;
    	$font_size = 10;
    	$y_axis = $y_axis+15;

    	$header = array('GS-ID','Student Name','GS Status');

    	$pdf->SetFont($font_name,'',$font_size);

    	$selected_array=array('gs_id','abridged_name','std_status_code');
    	$pdf->SetFillColor(175,175,175);
    	for($i=0;$i<sizeof($header);$i++){
    		
    		$pdf->SetXY($x_axis+($cellWidth*$i),$y_axis);
    		$pdf->Cell($cellWidth,$cellHeight,$header[$i],1,0,'C',1);

    	}


    	$counter = 1;
    	for($i=0;$i<sizeof($student_selected_block);$i++){
		
			for($j=0;$j<3; $j++){
					
				$pdf->SetXY($x_axis+($cellWidth*$j),$y_axis+($cellHeight*$counter));
				$y = $y_axis+($cellHeight*$counter);
					
			$pdf->Cell($cellWidth,$cellHeight,$student_selected_block[$i][$selected_array[$j]],1,0,'C');

			}
			$counter++;

    	}

    	$where = array('user_id'=>$this->session->userdata('user_id'));
    	$select = '';

		$user_id = $this->frm->get_by('atif.staff_registered',$select='',$where);
		

		$page_height = $page_height-40;
		$pdf->SetFillColor(0,0,0);
		$pdf->SetTextColor(255,255,255);
    	$pdf->SetXY(7,$page_height);
    	$pdf->Cell(80, 7, date('D-d-M-Y H:i') . ' (' . ucwords($user_id[0]->name) . ')', 1, 0, 'L', 1);
    	$pdf->Output('optional_defination','I');



    }


	
}