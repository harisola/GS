<?php
class Get_subject_report_ajax extends CI_Controller{
	public function __construct(){
		parent::__construct();
	}

	public function get_programme_assessment_subject_report(){
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
			<iframe src="'.site_url().'/etab_reports/get_subject_report_ajax/GetSubjectReport?'.$helper.'" frameborder="0">
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
        $this->data['assessment_titles'] = $this->assessment_report_model->get_summative_assessment_titles($gradeID, $subjectID, $role_id, $term);
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
	        // $this->data['assessment_marks'] = $this->assessment_report_model->get_grade_subject_assessments_marks($gradeID, $sectionID, $subjectID, $role_id, $term);
            $this->data['assessment_marks'] = $this->assessment_report_model->get_grade_ComFormSumm_assessments_marks($gradeID, $sectionID, $subjectID, $role_id, $term);
          

	    }else{
	    	// $this->data['assessment_marks'] = $this->assessment_report_model->get_grade_subject_optional_assessments_marks($gradeID, $subjectID, $GroupID, $BlockID, $role_id, $term);
            $this->data['assessment_marks'] = $this->assessment_report_model->get_grade_subject_optionalFormSumm_assessments_marks($gradeID, $subjectID, $GroupID, $BlockID, $role_id, $term);
	    }

        /******************* Assessment Aggregate Marks 
        /***********************************************/
        if($optional == 0){
	        $this->data['assessment_agg_marks'] = $this->assessment_report_model->get_grade_subject_assessmentsFormSumm_aggMarks($gradeID, $sectionID, $subjectID, $role_id, $term);
	    }else{
	    	$this->data['assessment_agg_marks'] = $this->assessment_report_model->get_grade_subject_optionalFormSumm_assessments_aggMarks($gradeID, $subjectID, $GroupID, $BlockID, $role_id, $term);
	    }

        $select_grade = $this->assessment_report_model->get_grade($academic,$prgmID);



	    $noOfStudents = sizeof($this->data['students_gs_data']);
    	$noOfAssessments = sizeof($this->data['assessment_titles']);






     	


     	// Overall Font Size
		$font_size = 8;
		$font_name = 'Helvetica'; //Helvetica
		$gender_mark_size = 26;
		$now_date = date('d-M-Y');
		$border = 1;
		

	



		require_once('components/pdf/fpdf/fpdf_rotate.php');
		require_once('components/pdf/fpdi/fpdi.php');

		


		
		// initiate FPDI
		if($noOfAssessments <= 27){
			$pdf = new PDF('L', 'mm', 'A4');
		}
		if($noOfAssessments > 27 and $noOfAssessments <= 30){
			//$pdf = new PDF('L', 'mm', 'A3');
			$pdf = new PDF('L','mm',array(210,310));
		}
		else if($noOfAssessments  > 30 and $noOfAssessments <= 33)
		{
			$pdf = new PDF('L','mm',array(240,340));
		}
		else if($noOfAssessments > 33 and $noOfAssessments <= 36)
		{
			$pdf = new PDF('L','mm',array(250,350));

		}
		else if ($noOfAssessments > 36 and $noOfAssessments <= 39){
			
			$pdf = new PDF('L','mm',array(270,370));

		}
		else if($noOfAssessments > 39 and $noOfAssessments <=42)
		{
			$pdf = new PDF('L','mm',array(300,400));
		}else{
			$pdf = new PDF('L','mm', 'A3');
		}

		$pdf->AddPage();
		$pdf->SetFont($font_name,'',$font_size);
		$i = 0;



		$borderon = 0;
		$rptheading_X = 7;
		$rptheading_Y = 7;
		$rptheading_CW = 65;
		$rptheading_CH = 10;
		$page_height = $pdf->h;
		
		if(empty($this->data['assessment_marks'][0]->subject_name)){
			$subject_name = '';
		}else{
			$subject_name = $this->data['assessment_marks'][0]->subject_name;
		}
		



		$assessment_X = 81;
		$assessment_Y = 7;

		$student_X = 7;
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
    	$pdf->Cell($rptheading_CW,$rptheading_CH-5,"Subject Report",$borderon,2,'L');
    	$pdf->Cell($rptheading_CW,$rptheading_CH-6,$gpp_id,$borderon,2,'L');
    	$pdf->Cell($rptheading_CW,$rptheading_CH-6,$subject_name,$borderon,2,'L');

    	

		/*************************************************** Assessment Titles
		***********************************************************************/




		/*************************************************** Assessment Titles
		***********************************************************************/
        
       
        $found = 0;
		foreach ($this->data['assessment_titles'] as $data) {

			$lastx = 0;
			$lasty = 0;

			$col = $data->full_name;



            if($data->assessment_category_name == 'Formative'){
                $pdf->SetFillColor(255,252,239);
            }
            elseif($data->assessment_category_name == 'Summative') {
                $pdf->SetFillColor(175,175,175);
            }
		   	$pdf->RotatedCell($assessment_X+$i,$assessment_Y,50,7,$col,1,0,'R',270,1);

		   	$i += $assessment_Y;		
		}
		$pdf->SetFillColor(255,252,239);
		$pdf->RotatedCell($assessment_X+$i,$assessment_Y,50,7,'Formative Total(100)',1,0,'R',270,1);
        
        $pdf->SetFillColor(175,175,175);
        $pdf->RotatedCell($assessment_X+$i+($assessment_Y),$assessment_Y,50,7,'Summative Total(100)',1,0,'R',270,1);
        $pdf->SetFillColor(255,255,255);
        $pdf->RotatedCell($assessment_X+$i+2*($assessment_Y),$assessment_Y,50,7,'Total(100)',1,0,'R',270,1);
         $pdf->RotatedCell($assessment_X+$i+3*($assessment_Y),$assessment_Y,50,7,'Grades',1,0,'R',270,1);



		/******************************************************** Student Info
		***********************************************************************/
		$i = 0;
		$counter = 1;
		$marks_Total = 0;
        $sum_formative_total = 0;
        $indivisual_student_formative = array();
        $sum_summative_total = 0;
        $indivisual_student_summative = array();
        $sum_summative_formative_total = 0;
        $indivisual_student_summative_formative = array();
        $average_foramtive_total = 0;
      


		// Heading
    	$pdf->SetFont($font_name,'B',$font_size);
    	$pdf->SetXY($student_X,$student_Y-$student_CH);
    	$pdf->Cell(7,$student_CH,'Sr',1,0,'C');
    	$pdf->Cell(15,$student_CH,'GS-ID',1,0,'C');
    	$pdf->Cell(30,$student_CH,'Student Name',1,0,'L');
    	$pdf->Cell(15,$student_CH,'GS Status',1,0,'C');





    	$arr_y=0;
    	$arr_x=0;

        $A_plus_total = 0;
        $A_total = 0;
        $B_total = 0;
        $C_total = 0;
        $D_total = 0;
        $U_total = 0;

       
        
		foreach ($this->data['students_gs_data'] as $data) {


			$arr_x=0;
			$font_size = 7;
			$marks_Total = 0;
            $formative_total = 0;
            
            $summative_total = 0;
            $total_formative_summative = 0;
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

            // var_dump($this->data['assessment_titles']);

            //====================== Title For Assessment Titles ============//
            //===============================================================//
        	foreach ($this->data['assessment_titles'] as $title) {


        		if($title->this_order == '1'){
        			$marksObtained = 0;
        			foreach ($this->data['assessment_marks'] as $marks) {

        				if($marks->gs_id == $data->gs_id
        					&& $marks->ass_detail_id == $title->assessment_type_id
        					&& $marks->marks_obtained > 0){

        					$marksObtained = $marks->marks_obtained;

        				}

        			}


        			$pdf->SetFillColor(175,175,175);
        			$pdf->SetXY($assessment_X+$z,$student_Y+$i);
        			$pdf->Cell(7,$student_CH,$marksObtained,1,0,'C', 1);
        			$totalMarks[$arr_y][$arr_x] = $marksObtained;

        		}else if($title->this_order == '2'){
        			$marksObtained = 0;
        			foreach ($this->data['assessment_agg_marks'] as $marks) {
        				if($marks->gs_id == $data->gs_id
        					&& $marks->assessment_id == $title->assessment_type_id
        					&& $marks->aggrAssessment > 0){

        					$marksObtained = $marks->aggrAssessment;

                            if($marks->assessment_category == 'Formative'){
                            $formative_total = $formative_total + $marks->aggrAssessment;

                            }

                            if($marks->assessment_category == 'Summative'){
                                $summative_total = $summative_total + $marks->aggrAssessment;
                                $sum_summative_total += ROUND($summative_total);
                                $indivisual_student_summative[$arr_y] = ROUND($summative_total);



                            }



        				}



        			}


        			$marks_Total += $marksObtained;


                    if($title->assessment_category_name == 'Formative'){
                        $pdf->SetFillColor(255,252,239);
                    }
                    else if($title->assessment_category_name == 'Summative'){
                        $pdf->SetFillColor(175,175,175);
                    }



        			$pdf->SetXY($assessment_X+$z,$student_Y+$i);
        			$pdf->Cell(7,$student_CH,$marksObtained,1,0,'C', 1); 
        			$totalMarks[$arr_y][$arr_x] = $marksObtained;

                    
                }

                    //==================== Formative Total ==========//
                    //===============================================//

                  
                        $pdf->SetFillColor(255,252,239);
                        $pdf->SetXY($assessment_X+$z+7,$student_Y+$i);
                        $pdf->Cell(7,$student_CH,ROUND($formative_total),1,0,'C', 1);
                        
                       
                        $indivisual_student_formative[$arr_y] = ROUND($formative_total);
                        $totalMarks[$arr_y][$arr_x] = $marksObtained;
                    



                    //===============End==========================//


                    //======== Summative Total =======================//



                    $pdf->SetFillColor(175,175,175);
                    $pdf->SetXY($assessment_X+$z+14,$student_Y+$i);
                    $pdf->Cell(7,$student_CH,ROUND($summative_total),1,0,'C', 1); 
                    $totalMarks[$arr_y][$arr_x] = $marksObtained;

                    //==============End===================//


                    //=============Total=======================//

                    $total_formative_summative = (($formative_total+$summative_total)/200)*100;
                    $pdf->SetFillColor(255,255,255);
                    $pdf->SetXY($assessment_X+$z+21,$student_Y+$i);
                    $pdf->Cell(7,$student_CH,ROUND($total_formative_summative),1,0,'C', 1); 
                    $totalMarks[$arr_y][$arr_x] = $marksObtained;


                    //================END======================//


                    //========= Grading Subject ================ //

                    $total_formative_summative = ROUND($total_formative_summative);

                    
                    $Aplus_name = $select_grade[0]->name;
                    $Aplus_weightage = $select_grade[0]->weightage;

                    $A_name = $select_grade[1]->name;
                    $A_weightage = $select_grade[1]->weightage;

                    $B_name = $select_grade[2]->name;
                    $B_weightage = $select_grade[2]->weightage;

                    $C_name = $select_grade[3]->name;
                    $C_weightage = $select_grade[3]->weightage;

                    $D_name = $select_grade[4]->name;
                    $D_weightage = $select_grade[4]->weightage;

                    $U_name = $select_grade[5]->name;
                    $U_weightage = $select_grade[5]->weightage;

                    if($total_formative_summative >= intval($Aplus_weightage) && $total_formative_summative <= 100){
                        $grade_Aplus = $Aplus_name;
                        $pdf->SetXY($assessment_X+$z+28,$student_Y+$i);
                        $pdf->Cell(7,$student_CH,$grade_Aplus,1,0,'C', 1);
                    }

                    if($total_formative_summative >= intval($A_weightage) && $total_formative_summative < $Aplus_weightage){
                        $grade_A = $A_name;
                        $pdf->SetXY($assessment_X+$z+28,$student_Y+$i);
                        $pdf->Cell(7,$student_CH,$grade_A,1,0,'C', 1);
                    }
                    
                    if($total_formative_summative >= intval($B_weightage) && $total_formative_summative < $A_weightage){
                        $grade_B = $B_name;
                        $pdf->SetXY($assessment_X+$z+28,$student_Y+$i);
                        $pdf->Cell(7,$student_CH,$grade_B,1,0,'C', 1);
                    }

                    if($total_formative_summative >= intval($C_weightage) && $total_formative_summative < $B_weightage){
                        $grade_C = $C_name;
                        $pdf->SetXY($assessment_X+$z+28,$student_Y+$i);
                        $pdf->Cell(7,$student_CH,$grade_C,1,0,'C', 1);
                    }

                    if($total_formative_summative >= intval($D_weightage) && $total_formative_summative < $C_weightage){
                        $grade_D = $D_name;
                        $pdf->SetXY($assessment_X+$z+28,$student_Y+$i);
                        $pdf->Cell(7,$student_CH,$grade_D,1,0,'C', 1);
                    }

                    if($total_formative_summative < intval($U_weightage)){
                        $grade_U = $U_name;
                        $pdf->SetXY($assessment_X+$z+28,$student_Y+$i);
                        $pdf->Cell(7,$student_CH,$grade_U,1,0,'C', 1);
                    }

                //=======================End ==========================//
  

        	
        		$z+=7;
        		$arr_x++;				
        	}

             //======== Formative Overall Total =====================//
            $sum_formative_total = $sum_formative_total + $formative_total;

            // ============ Summative Overall Total ====================//
            $sum_summative_formative_total += $total_formative_summative;
            $indivisual_student_summative_formative[$arr_y] = $total_formative_summative;


            if($total_formative_summative >= intval($Aplus_weightage) && $total_formative_summative <= 100){
                        $grade_Aplus = $Aplus_name;
                        $A_plus_total = $A_plus_total+1;
                    }

                    if($total_formative_summative >= intval($A_weightage) && $total_formative_summative < $Aplus_weightage){
                        $grade_A = $A_name;
                        $A_total = $A_total + 1 ;
                    }
                    
                    if($total_formative_summative >= intval($B_weightage) && $total_formative_summative < $A_weightage){
                        $grade_B = $B_name;
                        $B_total = $B_total + 1;
                    }

                    if($total_formative_summative >= intval($C_weightage) && $total_formative_summative < $B_weightage){
                        $grade_C = $C_name;
                        $C_total = $C_total + 1;
                    }

                    if($total_formative_summative >= intval($D_weightage) && $total_formative_summative < $C_weightage){
                        $grade_D = $D_name;
                        $D_total = $D_total + 1;
                    }

                    if($total_formative_summative < intval($U_weightage)){
                        $grade_U = $U_name;
                        $U_total = $U_total + 1;
                        
                    }

            



			$student_totalMarks[$arr_y] = $marks_Total;


        	$i += $student_CH;
        	$counter++;
        	$arr_y++;
        }


        




        /************************************************* Student Ranking
        /*****************************************************************
   //      $i=0;
   //      for($j=0; $j<$noOfStudents; $j++){
   //      	$studentRank = $this->assessment_report_model->getRankOf($student_totalMarks, $student_totalMarks[$j]);
   //      	$pdf->SetXY($assessment_X+$z+14,$student_Y+$i);
			// $pdf->Cell(7,$student_CH,$studentRank,1,0,'C');
			// $i += $student_CH;
   //      }
        /*****************************************************************









        /********************************************* Average Computation
        /******************************************************************/
       
        $z = -7;
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


        	if($this->data['assessment_titles'][$x]->assessment_category_name=='Formative'){
        		$pdf->SetFillColor(255,252,239);
        	}else {
        		$pdf->SetFillColor(175,175,175);
        	}
    		$showMarks = ROUND($showMarks / $noOfStudents, 1);
        	$pdf->SetXY($assessment_X+$z,$student_Y+$i);
			$pdf->Cell(7,$student_CH,$showMarks,1,0,'C', 1);

			for($y=0; $y<$noOfStudents; $y++){	// No of Students
        		if($totalMarks[$y][$x] >= $showMarks){
        			$AboveAverageCount++;
        		}else if($totalMarks[$y][$x] < $showMarks){
					$BelowAverageCount++;
				}
        	}

        	
        	$pdf->SetXY($assessment_X+$z,$student_Y+$i+4);
			$pdf->Cell(7,$student_CH,$AboveAverageCount,1,0,'C', 1);
			
        	$pdf->SetXY($assessment_X+$z,$student_Y+$i+8);
			$pdf->Cell(7,$student_CH,$BelowAverageCount,1,0,'C', 1);
        	

			$z+=7;

            $assessment_formative_x = $assessment_X + $z;
            $assessment_formative_y = $student_Y+$i;

            $assessment_formative_above_x = $assessment_X + $z;
            $assessment_formative_above_y = $student_Y+$i+4;

            $assessment_formative_below_x = $assessment_X+$z;
            $assessment_formative_below_y = $student_Y+$i+8; 

            $assessment_summative_x = $assessment_X + $z +7;
            $assessment_summative_y = $student_Y+$i;

            $assessment_summative_above_x = $assessment_X + $z +7;
            $assessment_summative_above_y = $student_Y+$i+4;

            $assessment_summative_below_x = $assessment_X + $z +7;
            $assessment_summative_below_y = $student_Y+$i+8;

            $assessment_formative_summative_x = $assessment_X+$z+14;
            $assessment_formative_summative_y = $student_Y+$i;

            $assessment_formative_summative_above_x = $assessment_X+$z+14;
            $assessment_formative_summative_above_y = $student_Y+$i+4;

            $assessment_formative_summative_below_x = $assessment_X+$z+14;
            $assessment_formative_summative_below_y = $student_Y+$i+8;
        }

        
        $average_foramtive_total = ROUND($sum_formative_total/$noOfStudents);
        $average_summative_total = ROUND($sum_summative_total/$noOfStudents);
        $average_summative_formative_total = ROUND($sum_summative_formative_total/$noOfStudents);


        $above_formative_total = 0;
        $below_formative_total = 0;

        $above_summative_total = 0;
        $below_summative_total = 0;

        $above_summative_formative_total = 0;
        $below_summative_formative_total = 0;

        // Calculating Indivisual Formative Total

        // Above Formative Total
        for($j=0;$j<sizeof($indivisual_student_formative);$j++){
            if($indivisual_student_formative[$j] >= $average_foramtive_total){
                $above_formative_total++;
            }
        }
        //Below Formative Total
        for($j=0;$j<sizeof($indivisual_student_formative);$j++){
            if($indivisual_student_formative[$j] < $average_foramtive_total){
                $below_formative_total++;
            }
        }


        

        // Pasting Formative Total Average
        $pdf->SetFillColor(255,252,239);
        $pdf->SetXY($assessment_formative_x,$assessment_formative_y);
        $pdf->Cell(7,$student_CH,$average_foramtive_total,1,0,'C',1);

        $pdf->SetXY($assessment_formative_above_x,$assessment_formative_above_y);
        $pdf->Cell(7,$student_CH,$above_formative_total,1,0,'C',1);

        $pdf->SetXY($assessment_formative_below_x,$assessment_formative_below_y);
        $pdf->Cell(7,$student_CH,$below_formative_total,1,0,'C',1);

        //Calculating Individual Summative Total

        //Above Summative Total
        for($j=0;$j<sizeof($indivisual_student_summative);$j++){
            if($indivisual_student_summative[$j] >= $average_summative_total){
                $above_summative_total++;
            }
        }

        //Below Summative Total
        for($j=0;$j<sizeof($indivisual_student_summative);$j++){
            if($indivisual_student_summative[$j] < $average_summative_total){
                $below_summative_total++;
            }
        }

        //Pasting Summative Total Average
        $pdf->SetFillColor(175,175,175);
        $pdf->SetXY($assessment_summative_x,$assessment_summative_y);
        $pdf->Cell(7,$student_CH,$average_summative_total,1,0,'C',1);

        $pdf->SetXY($assessment_summative_above_x,$assessment_summative_above_y);
        $pdf->Cell(7,$student_CH,$above_summative_total,1,0,'C',1);

        $pdf->SetXY($assessment_summative_below_x,$assessment_summative_below_y);
        $pdf->Cell(7,$student_CH,$below_summative_total,1,0,'C',1);


        //Calculating Individual Formative Summative Total

        for($j=0;$j<sizeof($indivisual_student_summative_formative);$j++){
            if($indivisual_student_summative_formative[$j] >= $average_summative_formative_total){
                $above_summative_formative_total++;
            }
        }

        for($j=0;$j<sizeof($indivisual_student_summative_formative);$j++){
            if($indivisual_student_summative_formative[$j] < $average_summative_formative_total){
                $below_summative_formative_total++;
            }
        }

        //Pasting Formative Summative Total Average

        $pdf->SetFillColor(255,255,255);
        $pdf->SetXY($assessment_formative_summative_x,$assessment_formative_summative_y);
        $pdf->Cell(7,$student_CH,$average_summative_formative_total,1,0,'C',1);

        $pdf->SetXY($assessment_formative_summative_above_x,$assessment_formative_summative_above_y);
        $pdf->Cell(7,$student_CH,$above_summative_formative_total,1,0,'C',1);

        $pdf->SetXY($assessment_formative_summative_below_x,$assessment_formative_summative_below_y);
        $pdf->Cell(7,$student_CH,$below_summative_formative_total,1,0,'C',1);




        /******************************************************************/

        /********************************GRADE RANK ***********************/
        /******************************************************************/

        $classAssGrade = array();

        $cellHeight = 5;
        $cellWidth = 21;

        $pdf->SetFillColor(255,255,255);
        $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Grade',1,0,'C',1);

        $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'%',1,0,'C',1);



        $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Grades Total',1,0,'C',1);





        //A++
        $counter++;
        $cellWidth = 21;
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'A+',1,0,'C',1);

        if($Aplus_name == 'A+'){
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Above '.$Aplus_weightage.'%',1,0,'C',1);
        }



        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$A_plus_total,1,0,'C',1);



        //A
        $counter++;
        $cellWidth = 21;
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'A',1,0,'C',1);

        if($A_name == 'A'){
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Above '.$A_weightage.'%',1,0,'C',1);
        }


        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$A_total,1,0,'C',1);




        //B
        $counter++;
        $cellWidth = 21;
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'B',1,0,'C',1);

        if($B_name == 'B'){
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Above '.$B_weightage.'%',1,0,'C',1);
        }

        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$B_total,1,0,'C',1);




        //C
        $counter++;
        $cellWidth = 21;
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'C',1,0,'C',1);

        if($C_name == 'C'){
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Above '.$C_weightage.'%',1,0,'C',1);
        }


        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$C_total,1,0,'C',1);

 


        //D
        $counter++;
        $cellWidth = 21;
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'D',1,0,'C',1);

        if($D_name == 'D'){
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Above '.$D_weightage.'%',1,0,'C',1);
        }


        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$D_total,1,0,'C',1);


        //U

        $counter++;
        $cellWidth = 21;
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'U',1,0,'C',1);

        if($U_name == 'U'){
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Below '.$U_weightage.'%',1,0,'C',1);
        }


        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$U_total,1,0,'C',1);




        /********************************************************************/
        /********************************************************************/

        /****************************************Report Footer**************
		*********************************************************/	
        $this->load->model('staff/staff_registered_model');
		$this->data['staff_registered_data'] = $this->staff_registered_model->get_by(array('user_id' => (int)$this->session->userdata('user_id')));
		$pdf->SetFillColor(0,0,0);
		$pdf->SetTextColor(255,255,255);
    	$pdf->SetXY(7,$page_height-30);
    	$pdf->Cell(60, 4, date('D-d-M-Y H:i') . ' (' . ucwords($this->data['staff_registered_data'][0]->abridged_name) . ')', 1, 0, 'L', 1);

			



		

		// Output the new PDF
		$pdf->Output('Assessment_Report' . '.pdf', 'I');   
    }

    public function GetSubjectReport(){

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

                        /******************* Subject Name  **************/
            $subjectTeacher = $this->assessment_report_model->getSubectTeacherName($role_id);
            if(!empty($subjectTeacher)){
                $subjectTeacher = $subjectTeacher[0]->name;
            }else{
                $subjectTeacher = '';
            }


        //*********************************************//



        /**************************** Assessment Titles 
        /***********************************************/
        $this->data['assessment_titles'] = $this->assessment_report_model->get_summative_assessment_titles_term_1($gradeID, $subjectID, $role_id, $term);




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
            // $this->data['assessment_marks'] = $this->assessment_report_model->get_grade_subject_assessments_marks($gradeID, $sectionID, $subjectID, $role_id, $term);
            $this->data['assessment_marks'] = $this->assessment_report_model->get_grade_ComFormSumm_assessments_marks($gradeID, $sectionID, $subjectID, $role_id, $term);
          

        }else{
            // $this->data['assessment_marks'] = $this->assessment_report_model->get_grade_subject_optional_assessments_marks($gradeID, $subjectID, $GroupID, $BlockID, $role_id, $term);

            $this->data['assessment_marks'] = $this->assessment_report_model->get_grade_subject_optionalFormSumm_assessments_marks($gradeID, $subjectID, $GroupID, $BlockID, $role_id, $term);



        }

        /******************* Assessment Aggregate Marks 
        /***********************************************/
        if($optional == 0){
            $this->data['assessment_agg_marks'] = $this->assessment_report_model->get_grade_subject_assessmentsFormSumm_aggMarks($gradeID, $sectionID, $subjectID, $role_id, $term);
        }else{
            $this->data['assessment_agg_marks'] = $this->assessment_report_model->get_grade_subject_optionalFormSumm_assessments_aggMarks($gradeID, $subjectID, $GroupID, $BlockID, $role_id, $term);
        }

        $select_grade = $this->assessment_report_model->get_grade($academic,$prgmID);



        $noOfStudents = sizeof($this->data['students_gs_data']);
        $noOfAssessments = sizeof($this->data['assessment_titles']);






        


        // Overall Font Size
        $font_size = 8;
        $font_name = 'Helvetica'; //Helvetica
        $gender_mark_size = 26;
        $now_date = date('d-M-Y');
        $border = 1;
        

    



        require_once('components/pdf/fpdf/fpdf_rotate.php');
        require_once('components/pdf/fpdi/fpdi.php');

        


        
        // initiate FPDI
        if($noOfAssessments <= 27){
            $pdf = new PDF('L', 'mm', 'A4');
        }
        if($noOfAssessments > 27 and $noOfAssessments <= 30){
            //$pdf = new PDF('L', 'mm', 'A3');
            $pdf = new PDF('L','mm',array(210,310));
        }
        else if($noOfAssessments  > 30 and $noOfAssessments <= 33)
        {
            $pdf = new PDF('L','mm',array(240,340));
        }
        else if($noOfAssessments > 33 and $noOfAssessments <= 36)
        {
            $pdf = new PDF('L','mm',array(250,350));

        }
        else if ($noOfAssessments > 36 and $noOfAssessments <= 39){
            
            $pdf = new PDF('L','mm',array(270,370));

        }
        else if($noOfAssessments > 39 and $noOfAssessments <=42)
        {
            $pdf = new PDF('L','mm',array(300,400));
        }else{
            $pdf = new PDF('L','mm', 'A3');
        }

        $pdf->AddPage();
        $pdf->SetFont($font_name,'',$font_size);
        $i = 0;



        $borderon = 0;
        $rptheading_X = 7;
        $rptheading_Y = 7;
        $rptheading_CW = 65;
        $rptheading_CH = 10;
        $page_height = $pdf->h;
        
        if(empty($this->data['assessment_marks'][0]->subject_name)){
            $subject_name = '';
        }else{
            $subject_name = $this->data['assessment_marks'][0]->subject_name;
        }
        



        $assessment_X = 81;
        $assessment_Y = 7;

        $student_X = 7;
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
        $pdf->Cell($rptheading_CW,$rptheading_CH-5,"Subject Report",$borderon,2,'L');
        $pdf->Cell($rptheading_CW,$rptheading_CH-6,$gpp_id,$borderon,2,'L');
       // $pdf->Cell($rptheading_CW,$rptheading_CH-6,$subject_name,$borderon,2,'L');
        $pdf->Cell($rptheading_CW,$rptheading_CH-7,$subjectTeacher,$borderon,2,'L');

        

        /*************************************************** Assessment Titles
        ***********************************************************************/




        /*************************************************** Assessment Titles
        ***********************************************************************/
            //var_dump($this->data['assessment_titles']);
        
       
        $found = 0;
        $check = 0;
        $check2 = 0;
        foreach ($this->data['assessment_titles'] as $data) {

            $lastx = 0;
            $lasty = 0;

            $col = $data->full_name;

            if($data->assessment_category_name == 'Formative'){
                $pdf->SetFillColor(255,252,239);
            }

            elseif($data->assessment_category_name == 'Summative') {
               
                if($check == 0){
                     $pdf->SetFillColor(175,175,175);
                    // $pdf->SetFillColor(255,252,239);
                    // $i += $assessment_Y; 
                $pdf->RotatedCell($assessment_X+$i,$assessment_Y,50,7,'Formative Total(100)',1,0,'R',270,1);
                $check = 1;
                $i += $assessment_Y;
                $pdf->SetFillColor(255,252,239);

                }

            }
            $pdf->RotatedCell($assessment_X+$i,$assessment_Y,50,7,$col,1,0,'R',270,1);

            $i += $assessment_Y;        
        }
        $pdf->SetFillColor(255,252,239);
        
        $pdf->SetFillColor(175,175,175);
        $pdf->RotatedCell($assessment_X+$i,$assessment_Y,50,7,'Summative Total(100)',1,0,'R',270,1);
        $pdf->SetFillColor(255,255,255);
        $pdf->RotatedCell($assessment_X+$i+($assessment_Y),$assessment_Y,50,7,'Total(100)',1,0,'R',270,1);
         $pdf->RotatedCell($assessment_X+$i+2*($assessment_Y),$assessment_Y,50,7,'Grades',1,0,'R',270,1);



        /******************************************************** Student Info
        ***********************************************************************/
        $i = 0;
        $counter = 1;
        $marks_Total = 0;
        $sum_formative_total = 0;
        $indivisual_student_formative = array();
        $sum_summative_total = 0;
        $indivisual_student_summative = array();
        $sum_summative_formative_total = 0;
        $indivisual_student_summative_formative = array();
        $average_foramtive_total = 0;
      


        // Heading
        $pdf->SetFont($font_name,'B',$font_size);
        $pdf->SetXY($student_X,$student_Y-$student_CH);
        $pdf->Cell(7,$student_CH,'Sr',1,0,'C');
        $pdf->Cell(15,$student_CH,'GS-ID',1,0,'C');
        $pdf->Cell(30,$student_CH,'Student Name',1,0,'L');
        $pdf->Cell(15,$student_CH,'GS Status',1,0,'C');





        $arr_y=0;
        $arr_x=0;

        // FOR JUNOIRS  
        if($gradeID >= 6 && $gradeID <= 9){

        $A_plus_total = 0;
        $A_total = 0;
        $B_plus_total = 0;
        $B_total = 0;
        $C_plus_total = 0;
        $C_total = 0;       
                
        
        }else{

        $A_plus_total = 0;
        $A_total = 0;
        $B_total = 0;
        $C_total = 0;
        $D_total = 0;
        $U_total = 0;

        }

       
        
        foreach ($this->data['students_gs_data'] as $data) {
            $arr_x=0;
            $font_size = 7;
            $marks_Total = 0;
            $formative_total = 0;
            $check2 = 0;
            $summative_total = 0;
            $total_formative_summative = 0;
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

            // var_dump($this->data['assessment_titles']);

            //====================== Title For Assessment Titles ============//
            //===============================================================//
            foreach ($this->data['assessment_titles'] as $title) {



                if($title->this_order == '2'){
                    if($title->assessment_category_name == 'Summative'){
                                            if($check2 == 0){
                        $pdf->SetFillColor(175,177,175);
                        $pdf->SetXY($assessment_X+$z,$student_Y+$i);
                        $pdf->Cell(7,$student_CH,ROUND($formative_total),1,0,'C',1);
                        $check2 = 1;
                        $z += 7;
                        $pdf->SetFillColor(255,252,239); 
                    }
                    }
                    $marksObtained = 0;
                    foreach ($this->data['assessment_agg_marks'] as $marks) {
                        if($marks->gs_id == $data->gs_id
                            && $marks->assessment_id == $title->assessment_type_id
                            && $marks->aggrAssessment > 0){

                            $marksObtained = $marks->aggrAssessment;

                            if($marks->assessment_category == 'Formative'){
                            $formative_total = $formative_total + $marks->aggrAssessment;

                            }

                            if($marks->assessment_category == 'Summative'){

                                $summative_total = $summative_total + $marks->aggrAssessment;
                                $sum_summative_total += ROUND($summative_total);

                                //var_dump($indivisual_student_summative);

                                

                            }
                           // $indivisual_student_summative[$arr_y] = ROUND($summative_total);
                        }/*else if($marks->gs_id == $data->gs_id && $marks->aggrAssessment > 0 && $marks->ass_detail_id == $title->assessment_type_id && $marks->assessment_category == 'Summative'){
                            $summative_total = $summative_total + $marks->aggrAssessment;
                            $sum_summative_total += ROUND($summative_total);
                        }*/
                    }


                    $marks_Total += $marksObtained;


                    if($title->assessment_category_name == 'Formative'){
                        $pdf->SetFillColor(255,252,239);
                    }
                    else if($title->assessment_category_name == 'Summative'){
                        $pdf->SetFillColor(255,252,239);
                    }



                    $pdf->SetXY($assessment_X+$z,$student_Y+$i);
                    $pdf->Cell(7,$student_CH,$marksObtained,1,0,'C', 1); 
                    $totalMarks[$arr_y][$arr_x] = $marksObtained;

                    
                }
                else if($title->this_order == '1'){
                    if($check2 == 0){
                        $pdf->SetFillColor(175,177,175);
                        $pdf->SetXY($assessment_X+$z,$student_Y+$i);
                        $pdf->Cell(7,$student_CH,ROUND(($formative_total),0, PHP_ROUND_HALF_UP),1,0,'C',1);
                        $check2 = 1;
                        $z += 7;
                        $pdf->SetFillColor(255,252,239); 
                    }

                    $marksObtained = 0;
                    foreach ($this->data['assessment_marks'] as $marks) {

                        if($marks->gs_id == $data->gs_id
                            && $marks->ass_detail_id == $title->assessment_type_id
                            && $marks->marks_obtained > 0){

                            $marksObtained = $marks->marks_obtained;

                        }

                    }

                    

                    

                     $pdf->SetFillColor(255,252,239);
                    $pdf->SetXY($assessment_X+$z,$student_Y+$i);
                    $pdf->Cell(7,$student_CH,$marksObtained,1,0,'C', 1);
                    $totalMarks[$arr_y][$arr_x] = $marksObtained;

                }

                    //==================== Formative Total ==========//
                    //===============================================//

                  
                        // $pdf->SetFillColor(255,252,239);
                        // $pdf->SetXY($assessment_X+$z+7,$student_Y+$i);
                        // $pdf->Cell(7,$student_CH,ROUND($formative_total),1,0,'C', 1);
                        
                        $indivisual_student_summative[$arr_y] = ROUND($summative_total);
                        $indivisual_student_formative[$arr_y] = ROUND($formative_total);
                        $totalMarks[$arr_y][$arr_x] = $marksObtained;
                    



                    //===============End==========================//


                    //======== Summative Total =======================//



                    $pdf->SetFillColor(175,175,175);
                    $pdf->SetXY($assessment_X+$z+7,$student_Y+$i);
                    $pdf->Cell(7,$student_CH,ROUND(($summative_total),0, PHP_ROUND_HALF_UP),1,0,'C', 1); 
                    $totalMarks[$arr_y][$arr_x] = $marksObtained;

                    //==============End===================//


                    //=============Total=======================//

                    $total_formative_summative = ((ROUND(($formative_total),0, PHP_ROUND_HALF_UP)+ROUND(($summative_total),0,PHP_ROUND_HALF_UP))/200)*100;
                    $pdf->SetFillColor(255,255,255);
                    $pdf->SetXY($assessment_X+$z+14,$student_Y+$i);
                    $pdf->Cell(7,$student_CH,ROUND($total_formative_summative),1,0,'C', 1); 
                    $totalMarks[$arr_y][$arr_x] = $marksObtained;




                    //================END======================//


                    //========= Grading Subject ================ //

                    $total_formative_summative = ROUND($total_formative_summative);



                    
            if($gradeID >= 6 && $gradeID <= 9){
            // Junior Section
            //var_dump($select_grade);
            $A_plus_name = $select_grade[0]->name;
            $Aplus_weightage = $select_grade[0]->weightage;

            $A_name = $select_grade[1]->name;
            $A_weightage = $select_grade[1]->weightage;

            $B_name = $select_grade[2]->name;
            $B_weightage = $select_grade[2]->weightage;

            $C_name = $select_grade[3]->name;
            $C_weightage = $select_grade[3]->weightage;

            $B_plus_name = $select_grade[6]->name;
            $B_plus_weightage = $select_grade[6]->weightage;

            $C_plus_name = $select_grade[7]->name;
            $C_plus_weightage = $select_grade[7]->weightage;

            if($total_formative_summative >= intval($Aplus_weightage) && $total_formative_summative <= 100){
                $grade_Aplus = $A_plus_name;
                $pdf->SetXY($assessment_X+$z+21,$student_Y+$i);
                $pdf->Cell(7,$student_CH,$grade_Aplus,1,0,'C', 1);
            }

            if($total_formative_summative >= intval($A_weightage) && $total_formative_summative < $Aplus_weightage){
                $grade_A = $A_name;
                $pdf->SetXY($assessment_X+$z+21,$student_Y+$i);
                $pdf->Cell(7,$student_CH,$grade_A,1,0,'C', 1);
            }
            
            if($total_formative_summative >= intval($B_plus_weightage) && $total_formative_summative < $A_weightage){
                $grade_B_plus = $B_plus_name;
                $pdf->SetXY($assessment_X+$z+21,$student_Y+$i);
                $pdf->Cell(7,$student_CH,$grade_B_plus ,1,0,'C', 1);
            }

            if($total_formative_summative >= intval($B_weightage) && $total_formative_summative < $B_plus_weightage){
                $grade_B = $B_name;
                $pdf->SetXY($assessment_X+$z+21,$student_Y+$i);
                $pdf->Cell(7,$student_CH,$grade_B,1,0,'C', 1);
            }

            if($total_formative_summative >= intval($C_plus_weightage) && $total_formative_summative < $B_weightage){
                $grade_C_plus = $C_plus_name;
                $pdf->SetXY($assessment_X+$z+21,$student_Y+$i);
                $pdf->Cell(7,$student_CH,$grade_C_plus,1,0,'C', 1);
            }

            if($total_formative_summative < intval($C_weightage)){
                $grade_C = $C_name;
                $pdf->SetXY($assessment_X+$z+21,$student_Y+$i);
                $pdf->Cell(7,$student_CH,$grade_C,1,0,'C', 1);
            }

            $pdf->SetFillColor(255,255,255);
            $pdf->SetXY($assessment_X+$z+28,$student_Y+$i);
            $pdf->Cell(30,$student_CH,$data->official_name,1,0,'L',1);

            //=======================End======================//

            }else{
                    // Senior
                    $Aplus_name = $select_grade[0]->name;
                    $Aplus_weightage = $select_grade[0]->weightage;

                    $A_name = $select_grade[1]->name;
                    $A_weightage = $select_grade[1]->weightage;

                    $B_name = $select_grade[2]->name;
                    $B_weightage = $select_grade[2]->weightage;

                    $C_name = $select_grade[3]->name;
                    $C_weightage = $select_grade[3]->weightage;

                    $D_name = $select_grade[4]->name;
                    $D_weightage = $select_grade[4]->weightage;

                    $U_name = $select_grade[5]->name;
                    $U_weightage = $select_grade[5]->weightage;

                    if($total_formative_summative >= intval($Aplus_weightage) && $total_formative_summative <= 100){
                        $grade_Aplus = $Aplus_name;
                        $pdf->SetXY($assessment_X+$z+21,$student_Y+$i);
                        $pdf->Cell(7,$student_CH,$grade_Aplus,1,0,'C', 1);
                    }

                    if($total_formative_summative >= intval($A_weightage) && $total_formative_summative < $Aplus_weightage){
                        $grade_A = $A_name;
                        $pdf->SetXY($assessment_X+$z+21,$student_Y+$i);
                        $pdf->Cell(7,$student_CH,$grade_A,1,0,'C', 1);
                    }
                    
                    if($total_formative_summative >= intval($B_weightage) && $total_formative_summative < $A_weightage){
                        $grade_B = $B_name;
                        $pdf->SetXY($assessment_X+$z+21,$student_Y+$i);
                        $pdf->Cell(7,$student_CH,$grade_B,1,0,'C', 1);
                    }

                    if($total_formative_summative >= intval($C_weightage) && $total_formative_summative < $B_weightage){
                        $grade_C = $C_name;
                        $pdf->SetXY($assessment_X+$z+21,$student_Y+$i);
                        $pdf->Cell(7,$student_CH,$grade_C,1,0,'C', 1);
                    }

                    if($total_formative_summative >= $D_weightage && $total_formative_summative < $C_weightage){
                        $grade_D = $D_name;
                        $pdf->SetXY($assessment_X+$z+21,$student_Y+$i);
                        $pdf->Cell(7,$student_CH,$grade_D,1,0,'C', 1);
                    }

                    if($total_formative_summative < $U_weightage){
                        $grade_U = $U_name;
                        $pdf->SetXY($assessment_X+$z+21,$student_Y+$i);
                        $pdf->Cell(7,$student_CH,$grade_U,1,0,'C', 1);
                    }

                
                }

                //=======================End ==========================//
  

            
                $z+=7;
                $arr_x++;               
            }
            

             //======== Formative Overall Total =====================//
            $sum_formative_total = $sum_formative_total + $formative_total;


            // ============ Summative Overall Total ====================//
            $sum_summative_formative_total += $total_formative_summative;
            $indivisual_student_summative_formative[$arr_y] = $total_formative_summative;


                    // FOR JUNIORS   
            if($gradeID >= 3 && $gradeID <= 9){

            if($total_formative_summative >= intval($Aplus_weightage) && $total_formative_summative <= 100){
                $grade_Aplus = $A_plus_name;
                $A_plus_total = $A_plus_total+1;
            }

             if($total_formative_summative >= intval($A_weightage) && $total_formative_summative < $Aplus_weightage){
                 $grade_A = $A_name;
                 $A_total = $A_total + 1 ;
            }
             
             if($total_formative_summative >= intval($B_plus_weightage) && $total_formative_summative < $A_weightage){
                   $grade_B_plus = $B_plus_name;
                   $B_plus_total = $B_plus_total + 1;
            }

            if($total_formative_summative >= intval($B_weightage) && $total_formative_summative < $B_plus_weightage){
                $grade_B = $B_name;            
                $B_total = $B_total + 1;
            }

            if($total_formative_summative >= intval($C_plus_weightage) && $total_formative_summative < $B_weightage){
                $grade_C_plus = $C_plus_name;
                $C_plus_total = $C_plus_total + 1;
            }

            if($total_formative_summative < intval($C_weightage)){
                $grade_C = $C_name;
                $C_total = $C_total + 1;
                            
            }

        }else{

                // Senior Section
                if($total_formative_summative >= intval($Aplus_weightage) && $total_formative_summative <= 100){
                        $grade_Aplus = $Aplus_name;
                        $A_plus_total = $A_plus_total+1;
                    }

                if($total_formative_summative >= intval($A_weightage) && $total_formative_summative < $Aplus_weightage){
                        $grade_A = $A_name;
                        $A_total = $A_total + 1 ;
                    }
                    
                if($total_formative_summative >= intval($B_weightage) && $total_formative_summative < $A_weightage){
                        $grade_B = $B_name;
                        $B_total = $B_total + 1;
                    }

                if($total_formative_summative >= intval($C_weightage) && $total_formative_summative < $B_weightage){
                        $grade_C = $C_name;
                        $C_total = $C_total + 1;
                    }

                if($total_formative_summative >= $D_weightage && $total_formative_summative < $C_weightage){
                        $grade_D = $D_name;
                        $D_total = $D_total + 1;
                    }

                if($total_formative_summative < $U_weightage){
                        $grade_U = $U_name;
                        $U_total = $U_total + 1;
                        
                    }

            
            }

            



            $student_totalMarks[$arr_y] = $marks_Total;


            $i += $student_CH;
            $counter++;
            $arr_y++;
           
        }



        




        /************************************************* Student Ranking
        /*****************************************************************
   //      $i=0;
   //      for($j=0; $j<$noOfStudents; $j++){
   //       $studentRank = $this->assessment_report_model->getRankOf($student_totalMarks, $student_totalMarks[$j]);
   //       $pdf->SetXY($assessment_X+$z+14,$student_Y+$i);
            // $pdf->Cell(7,$student_CH,$studentRank,1,0,'C');
            // $i += $student_CH;
   //      }
        /*****************************************************************









        /********************************************* Average Computation
        /******************************************************************/
       
        $z = -7;
        $showMarks = 0;
        $pdf->SetXY($student_X+22,$student_Y+$i);
        $pdf->Cell(45,$student_CH,'Average',1,0,'R');
        $pdf->SetXY($student_X+22,$student_Y+$i+4);
        $pdf->Cell(45,$student_CH,'Above Average',1,0,'R');
        $pdf->SetXY($student_X+22,$student_Y+$i+8);
        $pdf->Cell(45,$student_CH,'Below Average',1,0,'R');

        // $AboveAverageCount = 0;
        // $BelowAverageCount = 0;
        $check3 = 0;
        for($x=0; $x<$noOfAssessments; $x++){   // No of Assessment
            $showMarks = 0;
            $AboveAverageCount = 0;
            $BelowAverageCount = 0;
            for($y=0; $y<$noOfStudents; $y++){  // No of Students
                $showMarks += $totalMarks[$y][$x];
            }

            $showMarks = ROUND($showMarks / $noOfStudents, 1);
            $pdf->SetXY($assessment_X+$z,$student_Y+$i);
            $pdf->Cell(7,$student_CH,$showMarks,1,0,'C', 1);

            if($this->data['assessment_titles'][$x]->assessment_category_name=='Formative'){
                $pdf->SetFillColor(255,252,239);
                for($y=0; $y<$noOfStudents; $y++){  // No of Students
                    if($totalMarks[$y][$x] >= $showMarks){
                        $AboveAverageCount++;

                    }else if($totalMarks[$y][$x] < $showMarks){
                        $BelowAverageCount++;
                    }

            }
            }else if($this->data['assessment_titles'][$x]->assessment_category_name == 'Summative') {

                
                if($check3==0){

                $average_foramtive_total = ROUND($sum_formative_total/$noOfStudents);
                $above_formative_total = 0;
                $below_formative_total = 0;
                for($j=0;$j<sizeof($indivisual_student_formative);$j++){
                    if($indivisual_student_formative[$j] >= $average_foramtive_total){
                        $above_formative_total++;
                        }else if($indivisual_student_formative[$j] < $average_foramtive_total){
                            $below_formative_total++;
                        }
                    }

                    $pdf->SetFillColor(175,175,175);
                    $pdf->SetXY($assessment_X+$z,$student_Y+$i);
                    $pdf->Cell(7,$student_CH,$average_foramtive_total,1,0,'C',1);

                    $pdf->SetXY($assessment_X+$z,$student_Y+$i+4);
                    $pdf->Cell(7,$student_CH,$above_formative_total,1,0,'C',1);

                    $pdf->SetXY($assessment_X+$z,$student_Y+$i+8);
                    $pdf->Cell(7,$student_CH,$below_formative_total,1,0,'C',1);
                    $check3 = 1;
                    $z += 7;

                    $pdf->SetFillColor(255,252,239);
                    $pdf->SetXY($assessment_X+$z,$student_Y+$i);
                    $pdf->Cell(7,$student_CH,$showMarks,1,0,'C', 1);


               }

                for($y=0; $y<$noOfStudents; $y++){  // No of Students
                    if($totalMarks[$y][$x] >= $showMarks){
                        $AboveAverageCount++;
                    }else if($totalMarks[$y][$x] < $showMarks){
                        $BelowAverageCount++;
                    }
                }     
            }




            
            $pdf->SetXY($assessment_X+$z,$student_Y+$i+4);
            $pdf->Cell(7,$student_CH,$AboveAverageCount,1,0,'C', 1);
            
            $pdf->SetXY($assessment_X+$z,$student_Y+$i+8);
            $pdf->Cell(7,$student_CH,$BelowAverageCount,1,0,'C', 1);
            

            $z+=7;

            // $assessment_formative_x = $assessment_X + $z;
            // $assessment_formative_y = $student_Y+$i;

            // $assessment_formative_above_x = $assessment_X + $z;
            // $assessment_formative_above_y = $student_Y+$i+4;

            // $assessment_formative_below_x = $assessment_X+$z;
            // $assessment_formative_below_y = $student_Y+$i+8; 

            $assessment_summative_x = $assessment_X + $z;
            $assessment_summative_y = $student_Y+$i;

            $assessment_summative_above_x = $assessment_X + $z;
            $assessment_summative_above_y = $student_Y+$i+4;

            $assessment_summative_below_x = $assessment_X + $z;
            $assessment_summative_below_y = $student_Y+$i+8;

            $assessment_formative_summative_x = $assessment_X+$z+7;
            $assessment_formative_summative_y = $student_Y+$i;

            $assessment_formative_summative_above_x = $assessment_X+$z+7;
            $assessment_formative_summative_above_y = $student_Y+$i+4;

            $assessment_formative_summative_below_x = $assessment_X+$z+7;
            $assessment_formative_summative_below_y = $student_Y+$i+8;
        }

        
        //$average_foramtive_total = ROUND($sum_formative_total/$noOfStudents);
        //var_dump($sum_summative_total);
        //$average_summative_total = ROUND($sum_summative_total/$noOfStudents);
        $average_summative_formative_total = ROUND($sum_summative_formative_total/$noOfStudents);
        $average_summative_total = 0;

        // $above_formative_total = 0;
        // $below_formative_total = 0;

        $above_summative_total = 0;
        $below_summative_total = 0;

        $above_summative_formative_total = 0;
        $below_summative_formative_total = 0;

        // Calculating Indivisual Formative Total

        // Above Formative Total
        // for($j=0;$j<sizeof($indivisual_student_formative);$j++){
        //     if($indivisual_student_formative[$j] > $average_foramtive_total){
        //         $above_formative_total++;
        //     }
        // }
        //Below Formative Total
        // for($j=0;$j<sizeof($indivisual_student_formative);$j++){
        //     if($indivisual_student_formative[$j] <= $average_foramtive_total){
        //         $below_formative_total++;
        //     }
        // }


        

        // Pasting Formative Total Average
        // $pdf->SetFillColor(255,252,239);
        // $pdf->SetXY($assessment_formative_x,$assessment_formative_y);
        // $pdf->Cell(7,$student_CH,$average_foramtive_total,1,0,'C',1);

        // $pdf->SetXY($assessment_formative_above_x,$assessment_formative_above_y);
        // $pdf->Cell(7,$student_CH,$above_formative_total,1,0,'C',1);

        // $pdf->SetXY($assessment_formative_below_x,$assessment_formative_below_y);
        // $pdf->Cell(7,$student_CH,$below_formative_total,1,0,'C',1);

        //Calculating Individual Summative Total
        //
        
        for($j=0;$j<sizeof($indivisual_student_summative);$j++){
            $average_summative_total += $indivisual_student_summative[$j];
        }

        $average_summative_total = ROUND($average_summative_total/$noOfStudents);

        //Above Summative Total

        for($j=0;$j<sizeof($indivisual_student_summative);$j++){
            if($indivisual_student_summative[$j] >= $average_summative_total){
                $above_summative_total++;
            }
        }

        //Below Summative Total
        for($j=0;$j<sizeof($indivisual_student_summative);$j++){
            if($indivisual_student_summative[$j] < $average_summative_total){
                $below_summative_total++;
            }
        }

        //Pasting Summative Total Average
        $pdf->SetFillColor(175,175,175);
        $pdf->SetXY($assessment_summative_x,$assessment_summative_y);
        $pdf->Cell(7,$student_CH,$average_summative_total,1,0,'C',1);

        $pdf->SetXY($assessment_summative_above_x,$assessment_summative_above_y);
        $pdf->Cell(7,$student_CH,$above_summative_total,1,0,'C',1);

        $pdf->SetXY($assessment_summative_below_x,$assessment_summative_below_y);
        $pdf->Cell(7,$student_CH,$below_summative_total,1,0,'C',1);


        //Calculating Individual Formative Summative Total

        for($j=0;$j<sizeof($indivisual_student_summative_formative);$j++){
            if($indivisual_student_summative_formative[$j] >= $average_summative_formative_total){
                $above_summative_formative_total++;
            }
        }

        for($j=0;$j<sizeof($indivisual_student_summative_formative);$j++){
            if($indivisual_student_summative_formative[$j] < $average_summative_formative_total){
                $below_summative_formative_total++;
            }
        }

        //Pasting Formative Summative Total Average

        $pdf->SetFillColor(255,255,255);
        $pdf->SetXY($assessment_formative_summative_x,$assessment_formative_summative_y);
        $pdf->Cell(7,$student_CH,$average_summative_formative_total,1,0,'C',1);

        $pdf->SetXY($assessment_formative_summative_above_x,$assessment_formative_summative_above_y);
        $pdf->Cell(7,$student_CH,$above_summative_formative_total,1,0,'C',1);

        $pdf->SetXY($assessment_formative_summative_below_x,$assessment_formative_summative_below_y);
        $pdf->Cell(7,$student_CH,$below_summative_formative_total,1,0,'C',1);




        /******************************************************************/

        /********************************GRADE RANK ***********************/
        /******************************************************************/
        // junior
         if($gradeID >= 6 && $gradeID <= 9){

        $classAssGrade = array();

        $cellHeight = 5;
        $cellWidth = 21;

        $pdf->SetFillColor(255,255,255);
        $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Grade',1,0,'C',1);

        $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'%',1,0,'C',1);



        $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Grades Total',1,0,'C',1);





        //A++
        $counter++;
        $cellWidth = 21;
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'A+',1,0,'C',1);

        if($A_plus_name == 'A+'){
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Above '.$Aplus_weightage.'%',1,0,'C',1);
        }



        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$A_plus_total,1,0,'C',1);



        //A
        $counter++;
        $cellWidth = 21;
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'A',1,0,'C',1);

        if($A_name == 'A'){
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Above '.$A_weightage.'%',1,0,'C',1);
        }


        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$A_total,1,0,'C',1);




        //B++
        $counter++;
        $cellWidth = 21;
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'B+',1,0,'C',1);

        if($B_plus_name == 'B+'){
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Above '.$B_plus_weightage.'%',1,0,'C',1);
        }

        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$B_plus_total,1,0,'C',1);




        //B
        $counter++;
        $cellWidth = 21;
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'B',1,0,'C',1);

        if($B_name == 'B'){
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Above '.$B_weightage.'%',1,0,'C',1);
        }


        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$B_total,1,0,'C',1);

 


        //C+
        $counter++;
        $cellWidth = 21;
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'C+',1,0,'C',1);

        if($C_plus_name == 'C+'){
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Above '.$C_plus_weightage.'%',1,0,'C',1);
        }


        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$C_plus_total,1,0,'C',1);


        //C

        $counter++;
        $cellWidth = 21;
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'C',1,0,'C',1);

        if($C_name == 'C'){
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Below '.$C_weightage.'%',1,0,'C',1);
        }


        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$C_total,1,0,'C',1);

        }else{

           // For Middler And Seniors 
        $classAssGrade = array();

        $cellHeight = 5;
        $cellWidth = 21;

        $pdf->SetFillColor(255,255,255);
        $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Grade',1,0,'C',1);

        $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'%',1,0,'C',1);



        $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Grades Total',1,0,'C',1);

        //A++
        $counter++;
        $cellWidth = 21;
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'A+',1,0,'C',1);

        if($Aplus_name == 'A+'){
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Above '.$Aplus_weightage.'%',1,0,'C',1);
        }



        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$A_plus_total,1,0,'C',1);



        //A
        $counter++;
        $cellWidth = 21;
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'A',1,0,'C',1);

        if($A_name == 'A'){
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Above '.$A_weightage.'%',1,0,'C',1);
        }


        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$A_total,1,0,'C',1);




        //B
        $counter++;
        $cellWidth = 21;
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'B',1,0,'C',1);

        if($B_name == 'B'){
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Above '.$B_weightage.'%',1,0,'C',1);
        }

        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$B_total,1,0,'C',1);




        //C
        $counter++;
        $cellWidth = 21;
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'C',1,0,'C',1);

        if($C_name == 'C'){
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Above '.$C_weightage.'%',1,0,'C',1);
        }


        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$C_total,1,0,'C',1);

 


        //D
        $counter++;
        $cellWidth = 21;
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'D',1,0,'C',1);

        if($D_name == 'D'){
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Above '.$D_weightage.'%',1,0,'C',1);
        }


        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$D_total,1,0,'C',1);


        //U

        $counter++;
        $cellWidth = 21;
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'U',1,0,'C',1);

        if($U_name == 'U'){
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Below '.$U_weightage.'%',1,0,'C',1);
        }


        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$U_total,1,0,'C',1);



        }



        /********************************************************************/
        /********************************************************************/

        /****************************************Report Footer**************
        *********************************************************/  
        $this->load->model('staff/staff_registered_model');
        $this->data['staff_registered_data'] = $this->staff_registered_model->get_by(array('user_id' => (int)$this->session->userdata('user_id')));
        $pdf->SetFillColor(0,0,0);
        $pdf->SetTextColor(255,255,255);
        $pdf->SetXY(7,$page_height-30);
        $pdf->Cell(60, 4, date('D-d-M-Y H:i') . ' (' . ucwords($this->data['staff_registered_data'][0]->abridged_name) . ')', 1, 0, 'L', 1);

            



        

        // Output the new PDF
        $pdf->Output('Subject_Report' . '.pdf','I');   

    }


       	
}