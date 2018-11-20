<?php 

class Progress_report_ajax extends CI_Controller{

	public function __construct(){
		parent::__construct();
	}




	public function ThisStudent_progressReport(){
		
		$gs_id = $this->input->get('GSID');
		$grade_id = $this->input->get('grade_id');
		$section_id = $this->input->get('section_id');

		$this->load->model('atif_sp/progress_report_ajax_model','pra');
		$select_grade = $this->pra->get_grading($grade_id);

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

            


		require_once('components/pdf/fpdf/fpdf.php');	
		require_once('components/pdf/fpdi/fpdi.php');


		$borderOn = 0;

     	// Overall Font Size
		$font_size = 8;
		$font_name = 'Helvetica'; //Helvetica
		$gender_mark_size = 26;
		$now_date = date('d-M-Y');
		$border = 1;



			
		// initiate FPDIFC
		$pdf = new FPDI('P','mm','A4');
		// $title = $FullName;
		// $pdf->SetTitle($title);

		$pdf->SetFont($font_name,'',$font_size);
		
		//==========FOR O LEVEL =====================//
		//===========================================// 

		if($grade_id == 13 || $grade_id == 14){



		


		$pageCount = $pdf->setSourceFile('components\pdf\draft_report\OLevel-DraftReport.pdf');



		for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++){
			    // import a page
			$templateId = $pdf->importPage($pageNo);
			    // get the size of the imported page
			$size = $pdf->getTemplateSize($templateId);

			if ($size['w'] > $size['h']) {
			    $pdf->AddPage('L', array($size['w'], $size['h']));
		    } 
			else{
			    $pdf->AddPage('P', array($size['w'], 295));
			}

			    // use the imported page
		    $pdf->useTemplate($templateId);


		    if($templateId == 1){

		    $term_id = 1;
			$formative_summative =  $this->pra->get_formative_summative($gs_id,$term_id);
			$term_marks = $this->pra->get_term_marks($gs_id,$term_id);
			$asp_marks = $this->pra->get_term_asp($grade_id,$section_id,$term_id);
		 // var_dump($asp_marks);
			//var_dump($term_marks);

			// var_dump($formative_summative);
			// exit;

			// Calculate Term1 Marks

			$term1_marks = array();
			$count = 0;
	
			foreach($term_marks as $term_mks){
				$term1_marks[$count]= $term_mks->ass_per_mrk;
				$count++; 

			}

			$term_one_marks =  array_sum($term1_marks);

			
			$term_one_marks = ROUND($term_one_marks);
			

			$x_axis = 21;
			$y_axis = 4;

			// Abridge Name
			if(!empty($formative_summative[0]->abridged_name)){

		    	$pdf->SetXY($x_axis,$y_axis);
        		$pdf->Cell(20,10,$formative_summative[0]->abridged_name,0,0,'C');

        		}
		    //}

		  	

		    $y_axis = 75.5;
		    $x_axis = 42;
		    foreach($formative_summative as $form_sum_marks){

		    foreach($term_marks as $term_mark){

		    	// For English Literature

		    if($form_sum_marks->subject_name == 'E. Literature' && $term_mark->subject_name == 'E. Literature'){ 
		    		
		    		if($form_sum_marks->assessment_type_id == 1){

		    			$pdf->SetXY($x_axis,39);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

		    		}else if ($form_sum_marks->assessment_type_id == 2){

		    			$pdf->SetXY($x_axis+11,39);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+22,39);
        				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+33,39);
        				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');
		    		}
		    	} // END IF



		    	// For ENGLISH LANGUAGE

		    	if($form_sum_marks->subject_name == 'E. Language' && $term_mark->subject_name == 'E. Language'){ 
		    		
		    		if($form_sum_marks->assessment_type_id == 1){

		    			$pdf->SetXY($x_axis,$y_axis);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

		    		}else if ($form_sum_marks->assessment_type_id == 2){

		    			$pdf->SetXY($x_axis+11,$y_axis);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+22,$y_axis);
        				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+33,$y_axis);
        				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');
		    		}
		    	} // END IF

		    	// FOR MATHEMATICS

		    	if($form_sum_marks->subject_name == 'Mathematics' && $term_mark->subject_name == 'Mathematics'){ 
		    		

		    		if($form_sum_marks->assessment_type_id == 1){

		    			$pdf->SetXY($x_axis,$y_axis+30);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

		    		}else if ($form_sum_marks->assessment_type_id == 2){

		    			$pdf->SetXY($x_axis+11,$y_axis+30);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+22,$y_axis+30);
        				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+33,$y_axis+30);
        				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');
		    		}
		    	} // END IF

		    	// FOR ISLAMIAT
		    	if($form_sum_marks->subject_name == 'Islamiyat' && $term_mark->subject_name == 'Islamiyat'){ 
		    		

		    		if($form_sum_marks->assessment_type_id == 1){

		    			$pdf->SetXY($x_axis,$y_axis+38);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

		    		}else if ($form_sum_marks->assessment_type_id == 2){

		    			$pdf->SetXY($x_axis+11,$y_axis+38);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+22,$y_axis+38);
        				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+33,$y_axis+38);
        				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');
		    		}
		    	} // END IF


		    	// FOR Chemistry OR Accounts

		    	if($form_sum_marks->subject_name == 'Chemistry' && $term_mark->subject_name == 'Chemistry'){ 
		    		

		    		if($form_sum_marks->assessment_type_id == 1){

		    			$pdf->SetXY($x_axis,$y_axis+46);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk."/-",0,0,'C');

		    		}else if ($form_sum_marks->assessment_type_id == 2){

		    			$pdf->SetXY($x_axis+11,$y_axis+46);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk."/-",0,0,'C');

        				$pdf->SetXY($x_axis+22,$y_axis+46);
        				$pdf->Cell(20,10,$term_mark->ass_per_mrk."/-",0,0,'C');

        				$pdf->SetXY($x_axis+33,$y_axis+46);
        				$pdf->Cell(20,10,$term_mark->grade."/-",0,0,'C');
		    		}
		    	} // END IF

		    	if($form_sum_marks->subject_name == 'Accounts' && $term_mark->subject_name == 'Accounts'){ 
		    		

		    		if($form_sum_marks->assessment_type_id == 1){

		    			$pdf->SetXY($x_axis+3.5,$y_axis+46);
        				$pdf->Cell(20,10,"/".$form_sum_marks->ass_per_mrk,0,0,'C');

		    		}else if ($form_sum_marks->assessment_type_id == 2){

		    			$pdf->SetXY($x_axis+11+3.5,$y_axis+46);
        				$pdf->Cell(20,10,"/".$form_sum_marks->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+22+3.5,$y_axis+46);
        				$pdf->Cell(20,10,"/".$term_mark->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+33+3.5,$y_axis+46);
        				$pdf->Cell(20,10,"/".$term_mark->grade,0,0,'C');
		    		}
		    	} // END IF






		    	// FOR PHYSICS


		    	if($form_sum_marks->subject_name == 'Physics' && $term_mark->subject_name == 'Physics'){ 
		    		

		    		if($form_sum_marks->assessment_type_id == 1){

		    			$pdf->SetXY($x_axis,$y_axis+54);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

		    		}else if ($form_sum_marks->assessment_type_id == 2){

		    			$pdf->SetXY($x_axis+11,$y_axis+54);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+22,$y_axis+54);
        				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+33,$y_axis+54);
        				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');
		    		}
		    	} // END IF


		    	// Biology

		    	if($form_sum_marks->subject_name == 'Biology' && $term_mark->subject_name == 'Biology'){ 
		    		

		    		if($form_sum_marks->assessment_type_id == 1){

		    			$pdf->SetXY($x_axis,$y_axis+62);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk."/-",0,0,'C');

		    		}else if ($form_sum_marks->assessment_type_id == 2){

		    			$pdf->SetXY($x_axis+11,$y_axis+62);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk."/-",0,0,'C');

        				$pdf->SetXY($x_axis+22,$y_axis+62);
        				$pdf->Cell(20,10,$term_mark->ass_per_mrk."/-",0,0,'C');

        				$pdf->SetXY($x_axis+33,$y_axis+62);
        				$pdf->Cell(20,10,$term_mark->grade."/-",0,0,'C');
		    		}
		    	} // END IF


		    	if($form_sum_marks->subject_name == 'Economics' && $term_mark->subject_name == 'Economics'){ 
		    		

		    		if($form_sum_marks->assessment_type_id == 1){

		    			$pdf->SetXY($x_axis+3.5,$y_axis+62);
        				$pdf->Cell(20,10,"/".$form_sum_marks->ass_per_mrk,0,0,'C');

		    		}else if ($form_sum_marks->assessment_type_id == 2){

		    			$pdf->SetXY($x_axis+11+3.5,$y_axis+62);
        				$pdf->Cell(20,10,"/".$form_sum_marks->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+22+3.5,$y_axis+62);
        				$pdf->Cell(20,10,"/".$term_mark->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+33+3.5,$y_axis+62);
        				$pdf->Cell(20,10,"/".$term_mark->grade,0,0,'C');
		    		}
		    	} // END IF



		    	// Additional Math

		    	if($form_sum_marks->subject_name == "Add'nal Math" && $term_mark->subject_name == "Add'nal Math"){ 
		    		

		    		if($form_sum_marks->assessment_type_id == 1){

		    			$pdf->SetXY($x_axis,$y_axis+71);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

		    		}else if ($form_sum_marks->assessment_type_id == 2){

		    			$pdf->SetXY($x_axis+11,$y_axis+71);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+22,$y_axis+71);
        				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+33,$y_axis+71);
        				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');
		    		}
		    	}





		    	// History 
		    	if($form_sum_marks->subject_name == 'P History' && $term_mark->subject_name == 'P History'){ 
		    		

		    		if($form_sum_marks->assessment_type_id == 1){

		    			$pdf->SetXY($x_axis,$y_axis+80);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

		    		}else if ($form_sum_marks->assessment_type_id == 2){

		    			$pdf->SetXY($x_axis+11,$y_axis+80);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+22,$y_axis+80);
        				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+33,$y_axis+80);
        				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');
		    		}
		    	} // END IF


		    			    	// World  History 
		    	if($form_sum_marks->subject_name == 'W History' && $term_mark->subject_name == 'W History'){ 
		    		

		    		if($form_sum_marks->assessment_type_id == 1){

		    			$pdf->SetXY($x_axis+4,$y_axis+80);
        				$pdf->Cell(20,10,"/".$form_sum_marks->ass_per_mrk,0,0,'C');

		    		}else if ($form_sum_marks->assessment_type_id == 2){

		    			$pdf->SetXY($x_axis+11+4,$y_axis+80);
        				$pdf->Cell(20,10,"/".$form_sum_marks->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+22+4,$y_axis+80);
        				$pdf->Cell(20,10,"/".$term_mark->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+33+4,$y_axis+80);
        				$pdf->Cell(20,10,"/".$term_mark->grade,0,0,'C');
		    		}
		    	} // END IF

		    	// Geography

		    	if($form_sum_marks->subject_name == 'P Geography' && $term_mark->subject_name == 'P Geography'){ 
		    		

		    		if($form_sum_marks->assessment_type_id == 1){

		    			$pdf->SetXY($x_axis,$y_axis+88);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

		    		}else if ($form_sum_marks->assessment_type_id == 2){

		    			$pdf->SetXY($x_axis+11,$y_axis+88);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+22,$y_axis+88);
        				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+33,$y_axis+88);
        				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');
		    		}
		    	} // END IF


		    	


		      } // End Term Marks

		    } // End Form_Sum_Marks


		    // ASP MARKS

		    foreach($asp_marks as $asp){

		    	if($asp->gs_id == $gs_id){

		    		$ptm_attendance = $asp->ptm_orientation+$asp->ptm_unit;
		    		$first_day = $asp->attendance;
		    		$stationary = $asp->stationery;
		    		
		    		$pdf->SetXY($x_axis,$y_axis+113);
        			$pdf->Cell(20,10,$ptm_attendance,0,0,'C');

        			$pdf->SetXY($x_axis,$y_axis+120);
        			$pdf->Cell(20,10,$stationary,0,0,'C');

        			$pdf->SetXY($x_axis,$y_axis+127);
        			$pdf->Cell(20,10,$first_day,0,0,'C');

        			$total_term_one = $term_one_marks + $asp->asp_total;
        			
		    	}
		    }

		    if(empty($total_term_one)){
		    	$total_term_one = $term_one_marks;
		    }
		    $total_term_one = ROUND($total_term_one/$count,1);

		    $pdf->SetXY(26,13);
        	$pdf->Cell(20,10,$total_term_one,0,0,'C');



        	// Grading PASTING
        	if($total_term_one >= intval($Aplus_weightage)){
                $grade_Aplus = $Aplus_name;
                $pdf->SetXY(76,13);
                $pdf->Cell(20,10,$grade_Aplus,0,0,'C');
            }

            if($total_term_one >= intval($A_weightage) && $total_term_one < $Aplus_weightage){
                $grade_A = $A_name;
                $pdf->SetXY(76,13);
                $pdf->Cell(20,10,$grade_A,0,0,'C');
            }
            
            if($total_term_one >= intval($B_weightage) && $total_term_one < $A_weightage){
                $grade_B = $B_name;
               $pdf->SetXY(76,13);
                $pdf->Cell(20,10,$grade_B,0,0,'C');
            }

            if($total_term_one >= intval($C_weightage) && $total_term_one < $B_weightage){
                $grade_C = $C_name;
               $pdf->SetXY(76,13);
                $pdf->Cell(20,10,$grade_C,0,0,'C');
            }

            if($total_term_one >= intval($D_weightage) && $total_term_one < $C_weightage){
                $grade_D = $D_name;
                $pdf->SetXY(76,13);
                $pdf->Cell(20,10,$grade_D,0,0,'C');
            }

            if($total_term_one < intval($U_weightage)){
                $grade_U = $U_name;
                $pdf->SetXY(76,13);
                $pdf->Cell(20,10,$grade_U,0,0,'C');
            }
		   	

		} // ENd Page 1

		if($templateId == 2){
			// $x_axis = 0;
			// $y_axis = 0;

			foreach($formative_summative as $form_sum_marks){

			foreach($term_marks as $term_mark){
				if($form_sum_marks->subject_name == 'First Language Urdu' && $term_mark->subject_name == 'First Language Urdu'){ 
		    		

		    		if($form_sum_marks->assessment_type_id == 1){

		    			$pdf->SetXY(100,34);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

		    		}else if ($form_sum_marks->assessment_type_id == 2){

		    			$pdf->SetXY(78,34);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

        				$pdf->SetXY(56,34);
        				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

        				$pdf->SetXY(34,34);
        				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');
		    		}

		    	 } // END IF	

		     } // END  Term Marks 
		  }  // End Formative Summative	

		} // End Page 2

		if($templateId == 3){

			$term_id = 2;
			$get_formative_summative_term_two =  $this->pra->get_formative_summative_term_two($gs_id,$term_id);
			$get_term_marks_term_two = $this->pra->get_term_marks_term_two($gs_id,$term_id);
			$asp_marks_term_two = $this->pra->get_term_asp_term_two($grade_id,$section_id,$term_id);


			$x_axis = 22;
			$y_axis = 5;

			// Abridge Name
			if(!empty($get_formative_summative_term_two[0]->abridged_name)){

		    	$pdf->SetXY($x_axis,$y_axis);
        		$pdf->Cell(20,10,$get_formative_summative_term_two[0]->abridged_name,0,0,'C');

        	}



			$term2_marks = array();
			$count = 0;
	
			foreach($get_term_marks_term_two as $term_mks){
				$term2_marks[$count]= $term_mks->ass_per_mrk;
				$count++; 

			}

			$term_two_marks =  array_sum($term2_marks);

			
			$term_two_marks = ROUND($term_two_marks);

        	$y_axis = 75.5;
		    $x_axis = 42;
		    foreach($get_formative_summative_term_two as $form_sum_marks){

		    foreach($get_term_marks_term_two as $term_mark){

		    	// For English Literature

		    if($form_sum_marks->subject_name == 'E. Literature' && $term_mark->subject_name == 'E. Literature'){ 
		    		
		    		if($form_sum_marks->assessment_type_id == 1){

		    			$pdf->SetXY($x_axis,39);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

		    		}else if ($form_sum_marks->assessment_type_id == 2){

		    			$pdf->SetXY($x_axis+11,39);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+22,39);
        				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+33,39);
        				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');
		    		}
		    	} // END IF



		    	// For ENGLISH LANGUAGE

		    	if($form_sum_marks->subject_name == 'E. Language' && $term_mark->subject_name == 'E. Language'){ 
		    		
		    		if($form_sum_marks->assessment_type_id == 1){

		    			$pdf->SetXY($x_axis,$y_axis);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

		    		}else if ($form_sum_marks->assessment_type_id == 2){

		    			$pdf->SetXY($x_axis+11,$y_axis);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+22,$y_axis);
        				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+33,$y_axis);
        				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');
		    		}
		    	} // END IF

		    	// FOR MATHEMATICS

		    	if($form_sum_marks->subject_name == 'Mathematics' && $term_mark->subject_name == 'Mathematics'){ 
		    		

		    		if($form_sum_marks->assessment_type_id == 1){

		    			$pdf->SetXY($x_axis,$y_axis+30);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

		    		}else if ($form_sum_marks->assessment_type_id == 2){

		    			$pdf->SetXY($x_axis+11,$y_axis+30);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+22,$y_axis+30);
        				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+33,$y_axis+30);
        				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');
		    		}
		    	} // END IF

		    	// FOR ISLAMIAT
		    	if($form_sum_marks->subject_name == 'Islamiyat' && $term_mark->subject_name == 'Islamiyat'){ 
		    		

		    		if($form_sum_marks->assessment_type_id == 1){

		    			$pdf->SetXY($x_axis,$y_axis+38);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

		    		}else if ($form_sum_marks->assessment_type_id == 2){

		    			$pdf->SetXY($x_axis+11,$y_axis+38);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+22,$y_axis+38);
        				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+33,$y_axis+38);
        				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');
		    		}
		    	} // END IF


		    	// FOR Chemistry OR Accounts

		    	if($form_sum_marks->subject_name == 'Chemistry' && $term_mark->subject_name == 'Chemistry'){ 
		    		

		    		if($form_sum_marks->assessment_type_id == 1){

		    			$pdf->SetXY($x_axis,$y_axis+46);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk."/-",0,0,'C');

		    		}else if ($form_sum_marks->assessment_type_id == 2){

		    			$pdf->SetXY($x_axis+11,$y_axis+46);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk."/-",0,0,'C');

        				$pdf->SetXY($x_axis+22,$y_axis+46);
        				$pdf->Cell(20,10,$term_mark->ass_per_mrk."/-",0,0,'C');

        				$pdf->SetXY($x_axis+33,$y_axis+46);
        				$pdf->Cell(20,10,$term_mark->grade."/-",0,0,'C');
		    		}
		    	} // END IF

		    	if($form_sum_marks->subject_name == 'Accounts' && $term_mark->subject_name == 'Accounts'){ 
		    		

		    		if($form_sum_marks->assessment_type_id == 1){

		    			$pdf->SetXY($x_axis+3.5,$y_axis+46);
        				$pdf->Cell(20,10,"/".$form_sum_marks->ass_per_mrk,0,0,'C');

		    		}else if ($form_sum_marks->assessment_type_id == 2){

		    			$pdf->SetXY($x_axis+11+3.5,$y_axis+46);
        				$pdf->Cell(20,10,"/".$form_sum_marks->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+22+3.5,$y_axis+46);
        				$pdf->Cell(20,10,"/".$term_mark->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+33+3.5,$y_axis+46);
        				$pdf->Cell(20,10,"/".$term_mark->grade,0,0,'C');
		    		}
		    	} // END IF






		    	// FOR PHYSICS


		    	if($form_sum_marks->subject_name == 'Physics' && $term_mark->subject_name == 'Physics'){ 
		    		

		    		if($form_sum_marks->assessment_type_id == 1){

		    			$pdf->SetXY($x_axis,$y_axis+54);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

		    		}else if ($form_sum_marks->assessment_type_id == 2){

		    			$pdf->SetXY($x_axis+11,$y_axis+54);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+22,$y_axis+54);
        				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+33,$y_axis+54);
        				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');
		    		}
		    	} // END IF


		    	// Biology

		    	if($form_sum_marks->subject_name == 'Biology' && $term_mark->subject_name == 'Biology'){ 
		    		

		    		if($form_sum_marks->assessment_type_id == 1){

		    			$pdf->SetXY($x_axis,$y_axis+62);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk."/-",0,0,'C');

		    		}else if ($form_sum_marks->assessment_type_id == 2){

		    			$pdf->SetXY($x_axis+11,$y_axis+62);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk."/-",0,0,'C');

        				$pdf->SetXY($x_axis+22,$y_axis+62);
        				$pdf->Cell(20,10,$term_mark->ass_per_mrk."/-",0,0,'C');

        				$pdf->SetXY($x_axis+33,$y_axis+62);
        				$pdf->Cell(20,10,$term_mark->grade."/-",0,0,'C');
		    		}
		    	} // END IF


		    	if($form_sum_marks->subject_name == 'Economics' && $term_mark->subject_name == 'Economics'){ 
		    		

		    		if($form_sum_marks->assessment_type_id == 1){

		    			$pdf->SetXY($x_axis+3.5,$y_axis+62);
        				$pdf->Cell(20,10,"/".$form_sum_marks->ass_per_mrk,0,0,'C');

		    		}else if ($form_sum_marks->assessment_type_id == 2){

		    			$pdf->SetXY($x_axis+11+3.5,$y_axis+62);
        				$pdf->Cell(20,10,"/".$form_sum_marks->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+22+3.5,$y_axis+62);
        				$pdf->Cell(20,10,"/".$term_mark->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+33+3.5,$y_axis+62);
        				$pdf->Cell(20,10,"/".$term_mark->grade,0,0,'C');
		    		}
		    	} // END IF



		    	// Additional Math

		    	if($form_sum_marks->subject_name == "Add'nal Math" && $term_mark->subject_name == "Add'nal Math"){ 
		    		

		    		if($form_sum_marks->assessment_type_id == 1){

		    			$pdf->SetXY($x_axis,$y_axis+71);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

		    		}else if ($form_sum_marks->assessment_type_id == 2){

		    			$pdf->SetXY($x_axis+11,$y_axis+71);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+22,$y_axis+71);
        				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+33,$y_axis+71);
        				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');
		    		}
		    	}





		    	// History 
		    	if($form_sum_marks->subject_name == 'P History' && $term_mark->subject_name == 'P History'){ 
		    		

		    		if($form_sum_marks->assessment_type_id == 1){

		    			$pdf->SetXY($x_axis,$y_axis+80);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

		    		}else if ($form_sum_marks->assessment_type_id == 2){

		    			$pdf->SetXY($x_axis+11,$y_axis+80);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+22,$y_axis+80);
        				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+33,$y_axis+80);
        				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');
		    		}
		    	} // END IF

		    	// World  History 
		    	if($form_sum_marks->subject_name == 'W History' && $term_mark->subject_name == 'W History'){ 
		    		

		    		if($form_sum_marks->assessment_type_id == 1){

		    			$pdf->SetXY($x_axis+4,$y_axis+80);
        				$pdf->Cell(20,10,"/".$form_sum_marks->ass_per_mrk,0,0,'C');

		    		}else if ($form_sum_marks->assessment_type_id == 2){

		    			$pdf->SetXY($x_axis+11+4,$y_axis+80);
        				$pdf->Cell(20,10,"/".$form_sum_marks->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+22+4,$y_axis+80);
        				$pdf->Cell(20,10,"/".$term_mark->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+33+4,$y_axis+80);
        				$pdf->Cell(20,10,"/".$term_mark->grade,0,0,'C');
		    		}
		    	} // END IF



		    	// Geography

		    	if($form_sum_marks->subject_name == 'P Geography' && $term_mark->subject_name == 'P Geography'){ 
		    		

		    		if($form_sum_marks->assessment_type_id == 1){

		    			$pdf->SetXY($x_axis,$y_axis+88);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

		    		}else if ($form_sum_marks->assessment_type_id == 2){

		    			$pdf->SetXY($x_axis+11,$y_axis+88);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+22,$y_axis+88);
        				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+33,$y_axis+88);
        				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');
		    		}
		    	} // END IF

		    	// ASP MARKS

		    	
		    	


		      } // End Term Marks Term2

		    } // End Form_Sum_Marks Term2

		    
		    foreach($asp_marks_term_two as $asp){

			    	if($asp->gs_id == $gs_id){

			    		$ptm_attendance = $asp->ptm_orientation+$asp->ptm_unit;
			    		$first_day = $asp->attendance;
			    		$stationary = $asp->stationery;
			    		
			    		$pdf->SetXY($x_axis,$y_axis+113);
	        			$pdf->Cell(20,10,$ptm_attendance,0,0,'C');

	        			$pdf->SetXY($x_axis,$y_axis+120);
	        			$pdf->Cell(20,10,$stationary,0,0,'C');

	        			$pdf->SetXY($x_axis,$y_axis+127);
	        			$pdf->Cell(20,10,$first_day,0,0,'C');

	        			$total_term_two = $term_two_marks + $asp->asp_total;
	        			
			    	}
		    }


		    if(empty($total_term_two)){
		    	$total_term_two = $term_two_marks;
		    }

		    $total_term_two = ROUND($total_term_two/$count,1);


		    // Term Two

		    $pdf->SetXY(50,13);
        	$pdf->Cell(20,10,$total_term_two,0,0,'C');

			
		    // Term One
			$pdf->SetXY(21,13);
        	$pdf->Cell(20,10,$total_term_one,0,0,'C');


        	// Overall Percentage

        	$overall = $total_term_two+$total_term_one;
        	$overall = $overall/2;
        	$overall = ROUND($overall,1);

        	$pdf->SetXY(81,13);
        	$pdf->Cell(20,10,$overall,0,0,'C');



        	// Grading PASTING

        	//var_dump($U_weightage);
        	if($overall >= intval($Aplus_weightage) && $overall <= 100){
        		// var_dump($overall);
                $grade_Aplus = $Aplus_name;
                $pdf->SetXY(108,13);
                $pdf->Cell(20,10,$grade_Aplus,0,0,'C');
            }

            if($overall >= intval($A_weightage) && $overall < $Aplus_weightage){
                $grade_A = $A_name;
                $pdf->SetXY(108,13);
                $pdf->Cell(20,10,$grade_A,0,0,'C');
            }
            
            if($overall >= intval($B_weightage) && $overall < $A_weightage){
                $grade_B = $B_name;
                $pdf->SetXY(108,13);
                $pdf->Cell(20,10,$grade_B,0,0,'C');
            }

            if($overall >= intval($C_weightage) && $overall < $B_weightage){
                $grade_C = $C_name;
               $pdf->SetXY(108,13);
                $pdf->Cell(20,10,$grade_C,0,0,'C');
            }

            if($overall >= intval($D_weightage) && $overall < $C_weightage){
                $grade_D = $D_name;
                $pdf->SetXY(108,13);
                $pdf->Cell(20,10,$grade_D,0,0,'C');
            }
            
            if($overall < intval($U_weightage)){ 
                $grade_U = $U_name;
                $pdf->SetXY(108,13);
                $pdf->Cell(20,10,$grade_U,0,0,'C');
            }

		} // End PAGE 3


		if($templateId == 4){




			// $x_axis = 0;
			// $y_axis = 0;

			foreach($get_formative_summative_term_two as $form_sum_marks){

			foreach($get_term_marks_term_two as $term_mark){
				if($form_sum_marks->subject_name == 'First Language Urdu' && $term_mark->subject_name == 'First Language Urdu'){ 
		    		

		    		if($form_sum_marks->assessment_type_id == 1){

		    			$pdf->SetXY(100,34);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

		    		}else if ($form_sum_marks->assessment_type_id == 2){

		    			$pdf->SetXY(78,34);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

        				$pdf->SetXY(56,34);
        				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

        				$pdf->SetXY(34,34);
        				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');
		    		}

		    	 } // END IF	

		     } // END  Term Marks 
		  }  // End Formative Summative	

		} // End Page 4



	  }

	} // End O Level

	// ==========================A-LEVEL===============================//
	//=================================================================//

	if($grade_id == 15 || $grade_id == 16){

		$pageCount = $pdf->setSourceFile('components\pdf\draft_report\ALevel-DraftReport.pdf');

		for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++){
			    // import a page
			$templateId = $pdf->importPage($pageNo);
			    // get the size of the imported page
			$size = $pdf->getTemplateSize($templateId);

			if ($size['w'] > $size['h']) {
			    $pdf->AddPage('L', array($size['w'], $size['h']));
		    } 
			else{
			    $pdf->AddPage('P', array($size['w'], 295));
			}

			    // use the imported page
		    $pdf->useTemplate($templateId);



		    if($templateId == 1){

		    $term_id = 1;
			$formative_summative =  $this->pra->get_formative_summative($gs_id,$term_id);
			$term_marks = $this->pra->get_term_marks($gs_id,$term_id);
			$asp_marks = $this->pra->get_term_asp($grade_id,$section_id,$term_id);


			$x_axis = 19;
			$y_axis = 4;

			// Abridge Name
			if(!empty($formative_summative[0]->abridged_name)){

		    	$pdf->SetXY($x_axis,$y_axis);
        		$pdf->Cell(30,10,$formative_summative[0]->abridged_name,0,0,'C');

        	}


        	// Session Name

        	$pdf->SetXY(139.5,5);
        	$pdf->Cell(30,10,'16',0,0,'C');

        	$pdf->SetXY(149.5,5);
        	$pdf->Cell(30,10,'17',0,0,'C');

        	 $pdf->SetFont($font_name,'',12);

		    $x_axis = 20;
        	$y_axis = 30;
		    
		    foreach($term_marks as $term_mks){

		    	$found_one = 0;
		    	$found_two = 0;

		    	foreach($formative_summative as $form_summ){

		    		if($term_mks->subject_name == $form_summ->subject_name){

		    			$subject_name = $term_mks->subject_name;
		    			if($form_summ->assessment_type_id == 1){

		    				$pdf->SetXY($x_axis,$y_axis);
        					$pdf->Cell(20,10,$term_mks->subject_name,0,0,'C');

        					$x_axis_new = $x_axis + 52;

        					$pdf->SetXY($x_axis_new,$y_axis);
        					$pdf->Cell(20,10,$form_summ->ass_per_mrk,0,0,'C');

        					$found_one = 1;


		    			}else{
		    				
		    				$x_axis_new = $x_axis_new+23;
		    				$pdf->SetXY($x_axis_new,$y_axis);
        					$pdf->Cell(20,10,$form_summ->ass_per_mrk,0,0,'C');

        					$x_axis_new = $x_axis_new+23;
		    				$pdf->SetXY($x_axis_new,$y_axis);
        					$pdf->Cell(20,10,$term_mks->ass_per_mrk,0,0,'C');

        					$x_axis_new = $x_axis_new+23;
		    				$pdf->SetXY($x_axis_new,$y_axis);
        					$pdf->Cell(20,10,$term_mks->grade,0,0,'C');


        					$found_two = 1;
		    			}

		    			if($found_one == 1 && $found_two == 1){
		    				$y_axis = $y_axis+36;
		    			}


		    		} // End IF Subject Matching



		    	} // END Formative AND SUMMATIVE 

		    } // END Term Marks


		    // Calculating Term ONE Marks
		    $term_one = array();
		    $count = 0;

		   
		    foreach($term_marks as $term_mks){
		    	$term_one[$count] = $term_mks->ass_per_mrk;
		    	$count++;
		    }

		    $term_one = array_sum($term_one);

		    $ptm_attendance = '';
		    $first_day = '';
		    $stationary = '';
		    foreach($asp_marks as $asp){

			    if($asp->gs_id == $gs_id){

		    		$ptm_attendance = $asp->ptm_orientation+$asp->ptm_unit;
		    		$first_day = $asp->attendance;
		    		$stationary = $asp->stationery;
		    		
		    		// $pdf->SetXY($x_axis,$y_axis+113);
        // 			$pdf->Cell(20,10,$ptm_attendance,0,0,'C');

        // 			$pdf->SetXY($x_axis,$y_axis+120);
        // 			$pdf->Cell(20,10,$stationary,0,0,'C');

        // 			$pdf->SetXY($x_axis,$y_axis+127);
        // 			$pdf->Cell(20,10,$first_day,0,0,'C');

        			$total_term_one = $term_one + $asp->asp_total;
	        			
			    }
		    }

		    //============ TOTAL TERM 1 =============//

		    if(empty($total_term_one)){
		    	$total = $term_one/$count;
		    	$total = round($total,1);
		    }else{
		    	$total = $total_term_one/$count;
		    	$total = ROUND($total,1);
		    }

		    $term_one_total = $total;
		    
		    // var_dump($total);

		    $pdf->SetFont($font_name,'',8);

		    $pdf->SetXY(27,12.5);
        	$pdf->Cell(20,10,$total,0,0,'C');


        	// Grading PASTING

        	//var_dump($U_weightage);
        	if($total >= intval($Aplus_weightage) && $total <= 100){
        		// var_dump($overall);
                $grade_Aplus = $Aplus_name;
                $pdf->SetXY(76,13);
                $pdf->Cell(20,10,$grade_Aplus,0,0,'C');
            }

            if($total >= intval($A_weightage) && $total < $Aplus_weightage){
                $grade_A = $A_name;
                $pdf->SetXY(76,13);
                $pdf->Cell(20,10,$grade_A,0,0,'C');
            }
            
            if($total >= intval($B_weightage) && $total < $A_weightage){
                $grade_B = $B_name;
                $pdf->SetXY(76,13);
                $pdf->Cell(20,10,$grade_B,0,0,'C');
            }

            if($total >= intval($C_weightage) && $total < $B_weightage){
                $grade_C = $C_name;
                $pdf->SetXY(76,13);
                $pdf->Cell(20,10,$grade_C,0,0,'C');
            }

            if($total >= intval($D_weightage) && $total < $C_weightage){
                $grade_D = $D_name;
                $pdf->SetXY(76,13);
                $pdf->Cell(20,10,$grade_D,0,0,'C');
            }
            
            if($total < intval($U_weightage)){
                $grade_U = $U_name;
                $pdf->SetXY(76,13);
                $pdf->Cell(20,10,$grade_U,0,0,'C');
            }


		} // End Page 1


		if($templateId == 2){

			$pdf->SetFont($font_name,'',10);

			$pdf->SetXY(148.5,18);
        	$pdf->Cell(20,10,$ptm_attendance,0,0,'C');


			$pdf->SetXY(73,18);
			$pdf->Cell(20,10,$first_day,0,0,'C');


		} // End Page 2

		// if($templateId == 3){

		// 	$term_id = 2;
		// 	$get_formative_summative_term_two =  $this->pra->get_formative_summative_term_two($gs_id,$term_id);
		// 	$get_term_marks_term_two = $this->pra->get_term_marks_term_two($gs_id,$term_id);
		// 	$asp_marks_term_two = $this->pra->get_term_asp_term_two($grade_id,$section_id,$term_id);


		// 	$x_axis = 22;
		// 	$y_axis = 4;

		// 	$pdf->SetFont($font_name,'',8);

		// 	// Abridge Name
		// 	if(!empty($get_formative_summative_term_two[0]->abridged_name)){

		//     	$pdf->SetXY($x_axis,$y_axis);
  //       		$pdf->Cell(20,10,$get_formative_summative_term_two[0]->abridged_name,0,0,'C');

  //       	}

  //       	// Session Name

  //       	$pdf->SetXY(139.5,5);
  //       	$pdf->Cell(30,10,'16',0,0,'C');

  //       	$pdf->SetXY(149.5,5);
  //       	$pdf->Cell(30,10,'17',0,0,'C');

  //       	$pdf->SetFont($font_name,'',12);

		//     $x_axis = 20;
  //       	$y_axis = 30;
		    
		//     foreach($get_term_marks_term_two as $term_mks){

		//     	$found_one = 0;
		//     	$found_two = 0;
		    	
		    	

		//     	foreach($get_formative_summative_term_two as $form_summ){

		//     		if($term_mks->subject_name == $form_summ->subject_name){

		//     			$subject_name = $term_mks->subject_name;
		//     			if($form_summ->assessment_type_id == 1){

		//     				$pdf->SetXY($x_axis,$y_axis);
  //       					$pdf->Cell(20,10,$term_mks->subject_name,0,0,'C');

  //       					$x_axis_new = $x_axis + 52;

  //       					$pdf->SetXY($x_axis_new,$y_axis);
  //       					$pdf->Cell(20,10,$form_summ->ass_per_mrk,0,0,'C');



  //       					$found_one = 1;
        					
        					


		//     			}else{
		    				
		//     				$x_axis_new = $x_axis_new+23;
		//     				$pdf->SetXY($x_axis_new,$y_axis);
  //       					$pdf->Cell(20,10,$form_summ->ass_per_mrk,0,0,'C');

  //       					$x_axis_new = $x_axis_new+23;
		//     				$pdf->SetXY($x_axis_new,$y_axis);
  //       					$pdf->Cell(20,10,$term_mks->ass_per_mrk,0,0,'C');

  //       					$x_axis_new = $x_axis_new+23;
		//     				$pdf->SetXY($x_axis_new,$y_axis);
  //       					$pdf->Cell(20,10,$term_mks->grade,0,0,'C');


  //       					$found_two = 1;


        					
		//     			}

		//     			if($found_one == 1 && $found_two == 1) {
		//     				$y_axis = $y_axis+36;
		//     			}

		//     			// if($found_one == 1 && $found_two == 0){
		//     			// 	$y_axis = $y_axis+36;
		//     			// }




		//     		} // End IF Subject Matching



		//     	} // END Formative AND SUMMATIVE 

		//     } // END Term Marks


		//     $count = 0;
		//     $term_two = array();
		//     if(!empty($get_term_marks_term_two)){
		// 	    foreach($get_term_marks_term_two as $term_mks){
		// 	    	$term_two[$count] = $term_mks->ass_per_mrk;
		// 	    	$count++;
		// 	    } // END FOREACH

		// 	    $term_two = array_sum($term_two);
			    

		// 	} // END IF

		// 	$ptm_attendance_two = '';
		// 	$first_day_two = '';
		// 	$stationery_two = '';

		// 	foreach($asp_marks_term_two as $asp_marks){

		// 		if($asp_marks->gs_id == $gs_id){

		//     		$ptm_attendance_two = $asp_marks->ptm_orientation+$asp_marks->ptm_unit;
		//     		$first_day_two = $asp_marks->attendance;
		//     		$stationary_two = $asp_marks->stationery;
		    		


  //       			$total_term_two = $term_two + $asp_marks->asp_total;
        			
	        			
		// 	    } // END IF

		// 	} // END FOR EACH

		// 	if(empty($total_term_two)){
		//     	$total = $term_two/$count;
		//     	$total = round($total,1);
		//     }else{
		//     	$total = $total_term_two/$count;
		//     	$total = ROUND($total,1);
		//     }

		//     $pdf->SetFont($font_name,'',8);

		//     $pdf->SetXY(49,12.5);
  //       	$pdf->Cell(20,10,$total,0,0,'C');


  //       	// TOTAL TERM ONE
  //       	$pdf->SetXY(19,12.5);
  //       	$pdf->Cell(20,10,$term_one_total,0,0,'C');

  //       	$overall = ($total+$term_one_total)/2;
  //       	$overall = ROUND($overall,1);


  //       	//OVERALL CALCULATION

  //       	$pdf->SetXY(79,12.5);
  //       	$pdf->Cell(20,10,$overall,0,0,'C');

  //       	// GRADING PASTING	

  //       	if($overall >= intval($Aplus_weightage) && $overall <= 100){
  //               $grade_Aplus = $Aplus_name;
  //               $pdf->SetXY(106,12.5);
  //               $pdf->Cell(20,10,$grade_Aplus,0,0,'C');
  //           }

  //           if($overall >= intval($A_weightage) && $overall < $Aplus_weightage){
  //               $grade_A = $A_name;
  //               $pdf->SetXY(106,12.5);
  //               $pdf->Cell(20,10,$grade_A,0,0,'C');
  //           }
            
  //           if($overall >= intval($B_weightage) && $overall < $A_weightage){
  //               $grade_B = $B_name;
  //               $pdf->SetXY(106,12.5);
  //               $pdf->Cell(20,10,$grade_B,0,0,'C');
  //           }

  //           if($overall >= intval($C_weightage) && $overall < $B_weightage){
  //               $grade_C = $C_name;
  //               $pdf->SetXY(106,12.5);
  //               $pdf->Cell(20,10,$grade_C,0,0,'C');
  //           }

  //           if($overall >= intval($D_weightage) && $overall < $C_weightage){
  //               $grade_D = $D_name;
  //               $pdf->SetXY(106,12.5);
  //               $pdf->Cell(20,10,$grade_D,0,0,'C');
  //           }
            
  //           if($overall < intval($U_weightage)){
  //               $grade_U = $U_name;
  //               $pdf->SetXY(106,12.5);
  //               $pdf->Cell(20,10,$grade_U,0,0,'C');
  //           }

   

		// } // End Page 3

		// if($templateId == 4){


		// 	$pdf->SetFont($font_name,'',10);

			
		// 	$pdf->SetXY(73,18);
  //           $pdf->Cell(20,10,$first_day_two,0,0,'C');
        	

        	
  //           $pdf->SetXY(148,18);
  //           $pdf->Cell(20,10,$ptm_attendance_two,0,0,'C');
        	

		// }// END PAGE 4


	  } // End Page Count

	} // END A LEVEL


	// ================== MIDDLER ================== //
	//==============================================//

	if($grade_id == 12){

		$pageCount = $pdf->setSourceFile('components\pdf\draft_report\Middle-DraftReport_IX.pdf');

		for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++){
			    // import a page
			$templateId = $pdf->importPage($pageNo);
			    // get the size of the imported page
			$size = $pdf->getTemplateSize($templateId);

			if ($size['w'] > $size['h']) {
			    $pdf->AddPage('L', array($size['w'], $size['h']));
		    } 
			else{
			    $pdf->AddPage('P', array($size['w'], 295));
			}

			    // use the imported page
		    $pdf->useTemplate($templateId);

		    if($templateId == 1){

		    $term_id = 1;
			$formative_summative =  $this->pra->get_formative_summative($gs_id,$term_id);
			$term_marks = $this->pra->get_term_marks($gs_id,$term_id);
			$asp_marks = $this->pra->get_term_asp($grade_id,$section_id,$term_id);

			$x_axis = 21;
			$y_axis = 4;

			// Abridge Name
			if(!empty($formative_summative[0]->abridged_name)){

		    	$pdf->SetXY($x_axis,$y_axis);
        		$pdf->Cell(20,10,$formative_summative[0]->abridged_name,0,0,'C');

        	}


		    
        	$term1_marks = array();
			$count = 0;
	
			foreach($term_marks as $term_mks){
				$term1_marks[$count]= $term_mks->ass_per_mrk;
				$count++; 

			}

			$term_one_marks =  array_sum($term1_marks);

			
			$term_one_marks = ROUND($term_one_marks);



		    $y_axis = 75.5;
		    $x_axis = 42;
		    foreach($formative_summative as $form_sum_marks){

		    	foreach($term_marks as $term_mark){

		    	// For English Literature

		    	if($form_sum_marks->subject_name == 'E. Literature' && $term_mark->subject_name == 'E. Literature'){ 
		    		
		    		if($form_sum_marks->assessment_type_id == 1){

		    			$pdf->SetXY($x_axis,39);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+22,39);
        				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+33,39);
        				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');

		    		}else if ($form_sum_marks->assessment_type_id == 2){

		    			$pdf->SetXY($x_axis+11,39);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');


		    		}
		    	} // END IF


		    	// For English Language

		    	if($form_sum_marks->subject_name == 'E. Language' && $term_mark->subject_name == 'E. Language'){ 
		    		
		    		if($form_sum_marks->assessment_type_id == 1){

		    			$pdf->SetXY($x_axis,$y_axis);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');



        				$pdf->SetXY($x_axis+22,$y_axis);
        				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+33,$y_axis);
        				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');

		    		}else if ($form_sum_marks->assessment_type_id == 2){

		    			$pdf->SetXY($x_axis+11,$y_axis);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');


		    		}
		    	} // END IF

		    	// FOR MATHEMATICS

		    	if($form_sum_marks->subject_name == 'Mathematics' && $term_mark->subject_name == 'Mathematics'){ 
		    		

		    		if($form_sum_marks->assessment_type_id == 1){

		    			$pdf->SetXY($x_axis,$y_axis+30);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+22,$y_axis+30);
        				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+33,$y_axis+30);
        				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');

		    		}else if ($form_sum_marks->assessment_type_id == 2){

		    			$pdf->SetXY($x_axis+11,$y_axis+30);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');


		    		}
		    	} // END IF

		    	// FOR ISLAMIAT
		    	if($form_sum_marks->subject_name == 'Islamiyat' && $term_mark->subject_name == 'Islamiyat'){ 
		    		

		    		if($form_sum_marks->assessment_type_id == 1){

		    			$pdf->SetXY($x_axis,$y_axis+38);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+22,$y_axis+38);
        				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+33,$y_axis+38);
        				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');

		    		}else if ($form_sum_marks->assessment_type_id == 2){

		    			$pdf->SetXY($x_axis+11,$y_axis+38);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');


		    		}
		    	} // END IF


		    	// FOR Chemistry OR Accounts

		    	if($form_sum_marks->subject_name == 'Chemistry' && $term_mark->subject_name == 'Chemistry'){ 
		    		

		    		if($form_sum_marks->assessment_type_id == 1){

		    			$pdf->SetXY($x_axis,$y_axis+46);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+22,$y_axis+46);
        				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+33,$y_axis+46);
        				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');

		    		}else if ($form_sum_marks->assessment_type_id == 2){

		    			$pdf->SetXY($x_axis+11,$y_axis+46);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');


		    		}
		    	} // END IF



		    	// FOR PHYSICS


		    	if($form_sum_marks->subject_name == 'Physics' && $term_mark->subject_name == 'Physics'){ 
		    		

		    		if($form_sum_marks->assessment_type_id == 1){

		    			$pdf->SetXY($x_axis,$y_axis+54);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+22,$y_axis+54);
        				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+33,$y_axis+54);
        				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');

		    		}else if ($form_sum_marks->assessment_type_id == 2){

		    			$pdf->SetXY($x_axis+11,$y_axis+54);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');


		    		}
		    	} // END IF


		    	// Biology

		    	if($form_sum_marks->subject_name == 'Biology' && $term_mark->subject_name == 'Biology'){ 
		    		

		    		if($form_sum_marks->assessment_type_id == 1){

		    			$pdf->SetXY($x_axis,$y_axis+62);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+22,$y_axis+62);
        				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+33,$y_axis+62);
        				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');

		    		}else if ($form_sum_marks->assessment_type_id == 2){

		    			$pdf->SetXY($x_axis+11,$y_axis+62);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');


		    		}
		    	} // END IF





		    	// History

		    	if($form_sum_marks->subject_name == "History" && $term_mark->subject_name == "History"){ 
		    		

		    		if($form_sum_marks->assessment_type_id == 1){

		    			$pdf->SetXY($x_axis,$y_axis+71);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

		    		}else if ($form_sum_marks->assessment_type_id == 2){

		    			$pdf->SetXY($x_axis+11,$y_axis+71);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+22,$y_axis+71);
        				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+33,$y_axis+71);
        				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');
		    		}
		    	}







		    	// Geography

		    	if($form_sum_marks->subject_name == 'ICT/CS' && $term_mark->subject_name == 'ICT/CS'){ 
		    		

		    		if($form_sum_marks->assessment_type_id == 1){

		    			$pdf->SetXY($x_axis,$y_axis+88);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

		    		}else if ($form_sum_marks->assessment_type_id == 2){

		    			$pdf->SetXY($x_axis+11,$y_axis+88);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+22,$y_axis+88);
        				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+33,$y_axis+88);
        				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');
		    		}
		    	} // END IF

		    	// Arabic 


		    	if($form_sum_marks->subject_name == 'Arabic ' && $term_mark->subject_name == 'Arabic '){ 
		    		

		    		if($form_sum_marks->assessment_type_id == 1){

		    			$pdf->SetXY($x_axis,$y_axis+96);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+22,$y_axis+96);
        				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+33,$y_axis+96);
        				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');

		    		}else if ($form_sum_marks->assessment_type_id == 2){

		    			$pdf->SetXY($x_axis+11,$y_axis+96);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');


		    		}
		    	} // END IF





		        } // END FOR TERM MARKS

		    } // END FOR FORMATIVE AND SUMMATIVE MARKS

		   	//======== ASP MARKS ======//

		    $ptm_attendance = '';
		    $first_day = '';
		    $stationary = '';
		    foreach($asp_marks as $asp){

			    if($asp->gs_id == $gs_id){

		    		$ptm_attendance = $asp->ptm_orientation+$asp->ptm_unit;
		    		$first_day = $asp->attendance;
		    		$stationary = $asp->stationery;
		    		
		    		// $pdf->SetXY($x_axis,$y_axis+113);
        // 			$pdf->Cell(20,10,$ptm_attendance,0,0,'C');

        // 			$pdf->SetXY($x_axis,$y_axis+120);
        // 			$pdf->Cell(20,10,$stationary,0,0,'C');

        // 			$pdf->SetXY($x_axis,$y_axis+127);
        // 			$pdf->Cell(20,10,$first_day,0,0,'C');

        			$total_term_one = $term_one_marks + $asp->asp_total;
	        			
			    } 	//END IF

		    } 	// END FOREACH

		    //============ TOTAL TERM 1 =============//

		    if(empty($total_term_one)){
		    	$total = $term_one_marks/$count;
		    	$total = round($total,1);
		    }else{
		    	$total = $total_term_one/$count;
		    	$total = ROUND($total,1);
		    }

		    $term_one_total = $total;

			$pdf->SetXY(26,12);
		    $pdf->Cell(20,10,$term_one_total,0,0,'C');


		    $pdf->SetXY(42,188);
		    $pdf->Cell(20,10,$first_day,0,0,'C');


		    $pdf->SetXY(42,195);
		    $pdf->Cell(20,10,$stationary,0,0,'C');



		    $pdf->SetXY(42,202.5);
		    $pdf->Cell(20,10,$ptm_attendance,0,0,'C');


		    // GRADING PASTING	

        	if($term_one_total >= intval($Aplus_weightage) && $term_one_total <= 100){
                $grade_Aplus = $Aplus_name;
                $pdf->SetXY(75,12);
                $pdf->Cell(20,10,$grade_Aplus,0,0,'C');
            }

            if($term_one_total >= intval($A_weightage) && $term_one_total < $Aplus_weightage){
                $grade_A = $A_name;
                $pdf->SetXY(75,12);
                $pdf->Cell(20,10,$grade_A,0,0,'C');
            }
            
            if($term_one_total >= intval($B_weightage) && $term_one_total < $A_weightage){
                $grade_B = $B_name;
                $pdf->SetXY(75,12);
                $pdf->Cell(20,10,$grade_B,0,0,'C');
            }

            if($term_one_total >= intval($C_weightage) && $term_one_total < $B_weightage){
                $grade_C = $C_name;
                $pdf->SetXY(75,12);
                $pdf->Cell(20,10,$grade_C,0,0,'C');
            }

            if($term_one_total >= intval($D_weightage) && $term_one_total < $C_weightage){
                $grade_D = $D_name;
                $pdf->SetXY(75,12);
                $pdf->Cell(20,10,$grade_D,0,0,'C');
            }
            
            if($term_one_total < intval($U_weightage)){
                $grade_U = $U_name;
                $pdf->SetXY(75,12);
                $pdf->Cell(20,10,$grade_U,0,0,'C');
            }




		    } //END PAGE 1


		    if($templateId == 2){


		    foreach($formative_summative as $form_sum_marks){

		    	foreach($term_marks as $term_mark){

		    	// For First Language Urdu Paper 2
		    	if($form_sum_marks->subject_name == 'First Language Urdu Paper 2' && $term_mark->subject_name == 'First Language Urdu Paper 2'){ 
		    		

		    		if($form_sum_marks->assessment_type_id == 1){

		    			$pdf->SetXY(100,20);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

		    		}else if ($form_sum_marks->assessment_type_id == 2){

		    			$pdf->SetXY(78,20);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

        				$pdf->SetXY(56,20);
        				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

        				$pdf->SetXY(34,20);
        				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');
		    		}

		    	 } // END IF

		    	// For First Language Urdu Paper 1

				if($form_sum_marks->subject_name == 'First Language Urdu Paper 1' && $term_mark->subject_name == 'First Language Urdu Paper 1'){ 
		    		

		    		if($form_sum_marks->assessment_type_id == 1){

		    			$pdf->SetXY(100,34);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

		    		}else if ($form_sum_marks->assessment_type_id == 2){

		    			$pdf->SetXY(78,34);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

        				$pdf->SetXY(56,34);
        				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

        				$pdf->SetXY(34,34);
        				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');
		    		}

		    	 } // END IF

		      } // END FOR TERM 2

		  	} // END FOR FORMATIVE AND SUMMATIVE
 

		  } // END PAGE 2


		 //  if($templateId == 3){

		 //  	$term_id = 2;
			// $get_formative_summative_term_two =  $this->pra->get_formative_summative_term_two($gs_id,$term_id);
			// $get_term_marks_term_two = $this->pra->get_term_marks_term_two($gs_id,$term_id);
			// $asp_marks_term_two = $this->pra->get_term_asp_term_two($grade_id,$section_id,$term_id);


			// $x_axis = 22;
			// $y_axis = 4;


			// // Calculating Term 2

			// $term_two = array();
			// $count = 0;

			// if(!empty($get_term_marks_term_two)){

			// 	foreach($get_term_marks_term_two as $term_marks){
			// 		$term_two[$count] = $term_marks->ass_per_mrk;
			// 		$count++;
			// 	}

			// 	$term_two = array_sum($term_two);
			// 	//var_dump($term_two);
			// }


			// //======== ASP MARKS ======//

		 //    $ptm_attendance = '';
		 //    $first_day = '';
		 //    $stationary = '';
		 //    foreach($asp_marks_term_two as $asp){

			//     if($asp->gs_id == $gs_id){

		 //    		$ptm_attendance = $asp->ptm_orientation+$asp->ptm_unit;
		 //    		$first_day = $asp->attendance;
		 //    		$stationary = $asp->stationery;
		    		
		 //    		// $pdf->SetXY($x_axis,$y_axis+113);
   //      // 			$pdf->Cell(20,10,$ptm_attendance,0,0,'C');

   //      // 			$pdf->SetXY($x_axis,$y_axis+120);
   //      // 			$pdf->Cell(20,10,$stationary,0,0,'C');

   //      // 			$pdf->SetXY($x_axis,$y_axis+127);
   //      // 			$pdf->Cell(20,10,$first_day,0,0,'C');

   //      			$total_term_two = $term_two + $asp->asp_total;
	        			
			//     } 	//END IF

		 //    } 	// END FOREACH

		 //    //============ TOTAL TERM 1 =============//

		 //    if(empty($total_term_two)){
		 //    	$total = $term_two/$count;
		 //    	$total = round($total,1);
		 //    }else{
		 //    	$total = $total_term_two/$count;
		 //    	$total = ROUND($total,1);
		 //    }

		 //    $total_term_two = $total;

			// // Term Two Total

			// $pdf->SetXY(50,12);
		 //    $pdf->Cell(20,10,$total_term_two,0,0,'C');	


		 //    // Term One Total
			// $pdf->SetXY(20,12);
		 //    $pdf->Cell(20,10,$term_one_total,0,0,'C');

		 //    $overall = 0 ;
		 //    $overall = ($total_term_two + $term_one_total)/2;
		 //    $overall = ROUND($overall);

		 //    $pdf->SetXY(81,12);
		 //    $pdf->Cell(20,10,$overall,0,0,'C');

		 //    // GRADING PASTING	

   //      	if($overall >= intval($Aplus_weightage) && $overall <= 100){
   //              $grade_Aplus = $Aplus_name;
   //              $pdf->SetXY(108,12);
   //              $pdf->Cell(20,10,$grade_Aplus,0,0,'C');
   //          }

   //          if($overall >= intval($A_weightage) && $overall < $Aplus_weightage){
   //              $grade_A = $A_name;
   //              $pdf->SetXY(108,12);
   //              $pdf->Cell(20,10,$grade_A,0,0,'C');
   //          }
            
   //          if($overall >= intval($B_weightage) && $overall < $A_weightage){
   //              $grade_B = $B_name;
   //              $pdf->SetXY(108,12);
   //              $pdf->Cell(20,10,$grade_B,0,0,'C');
   //          }

   //          if($overall >= intval($C_weightage) && $overall < $B_weightage){
   //              $grade_C = $C_name;
   //              $pdf->SetXY(108,12);
   //              $pdf->Cell(20,10,$grade_C,0,0,'C');
   //          }

   //          if($overall >= intval($D_weightage) && $overall < $C_weightage){
   //              $grade_D = $D_name;
   //              $pdf->SetXY(108,12);
   //              $pdf->Cell(20,10,$grade_D,0,0,'C');
   //          }
            
   //          if($overall < intval($U_weightage)){
   //              $grade_U = $U_name;
   //              $pdf->SetXY(108,12);
   //              $pdf->Cell(20,10,$grade_U,0,0,'C');
   //          }

   //          // Ptm Attendance
   //          $pdf->SetXY(42,203);
   //          $pdf->Cell(20,10,$ptm_attendance,0,0,'C');

   //          //Ptm Stationary

   //          $pdf->SetXY(42,195);
   //          $pdf->Cell(20,10,$stationary,0,0,'C');


   //          // First day Attendance
   //          $pdf->SetXY(42,188);
   //          $pdf->Cell(20,10,$first_day,0,0,'C');


			// $pdf->SetFont($font_name,'',8);

			// // Abridge Name
			// if(!empty($get_formative_summative_term_two[0]->abridged_name)){

		 //    	$pdf->SetXY($x_axis,$y_axis);
   //      		$pdf->Cell(20,10,$get_formative_summative_term_two[0]->abridged_name,0,0,'C');

   //      	}

   //      	$y_axis = 75.5;
		 //    $x_axis = 42;
		 //    foreach($get_formative_summative_term_two as $form_sum_marks){

		 //    	foreach($get_term_marks_term_two as $term_mark){

		 //    	// For English Literature

		 //    	if($form_sum_marks->subject_name == 'E. Literature' && $term_mark->subject_name == 'E. Literature'){ 
		    		
		 //    		if($form_sum_marks->assessment_type_id == 1){

		 //    			$pdf->SetXY($x_axis,39);
   //      				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

   //      				$pdf->SetXY($x_axis+22,39);
   //      				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

   //      				$pdf->SetXY($x_axis+33,39);
   //      				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');

		 //    		}else if ($form_sum_marks->assessment_type_id == 2){

		 //    			$pdf->SetXY($x_axis+11,39);
   //      				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');


		 //    		}
		 //    	} // END IF


		 //    	// For English Language

		 //    	if($form_sum_marks->subject_name == 'E. Language' && $term_mark->subject_name == 'E. Language'){ 
		    		
		 //    		if($form_sum_marks->assessment_type_id == 1){

		 //    			$pdf->SetXY($x_axis,$y_axis);
   //      				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');



   //      				$pdf->SetXY($x_axis+22,$y_axis);
   //      				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

   //      				$pdf->SetXY($x_axis+33,$y_axis);
   //      				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');

		 //    		}else if ($form_sum_marks->assessment_type_id == 2){

		 //    			$pdf->SetXY($x_axis+11,$y_axis);
   //      				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');


		 //    		}
		 //    	} // END IF

		 //    	// FOR MATHEMATICS

		 //    	if($form_sum_marks->subject_name == 'Mathematics' && $term_mark->subject_name == 'Mathematics'){ 
		    		

		 //    		if($form_sum_marks->assessment_type_id == 1){

		 //    			$pdf->SetXY($x_axis,$y_axis+30);
   //      				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

   //      				$pdf->SetXY($x_axis+22,$y_axis+30);
   //      				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

   //      				$pdf->SetXY($x_axis+33,$y_axis+30);
   //      				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');

		 //    		}else if ($form_sum_marks->assessment_type_id == 2){

		 //    			$pdf->SetXY($x_axis+11,$y_axis+30);
   //      				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');


		 //    		}
		 //    	} // END IF

		 //    	// FOR ISLAMIAT
		 //    	if($form_sum_marks->subject_name == 'Islamiyat' && $term_mark->subject_name == 'Islamiyat'){ 
		    		

		 //    		if($form_sum_marks->assessment_type_id == 1){

		 //    			$pdf->SetXY($x_axis,$y_axis+38);
   //      				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

   //      				$pdf->SetXY($x_axis+22,$y_axis+38);
   //      				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

   //      				$pdf->SetXY($x_axis+33,$y_axis+38);
   //      				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');

		 //    		}else if ($form_sum_marks->assessment_type_id == 2){

		 //    			$pdf->SetXY($x_axis+11,$y_axis+38);
   //      				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');


		 //    		}
		 //    	} // END IF


		 //    	// FOR Chemistry OR Accounts

		 //    	if($form_sum_marks->subject_name == 'Chemistry' && $term_mark->subject_name == 'Chemistry'){ 
		    		

		 //    		if($form_sum_marks->assessment_type_id == 1){

		 //    			$pdf->SetXY($x_axis,$y_axis+46);
   //      				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

   //      				$pdf->SetXY($x_axis+22,$y_axis+46);
   //      				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

   //      				$pdf->SetXY($x_axis+33,$y_axis+46);
   //      				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');

		 //    		}else if ($form_sum_marks->assessment_type_id == 2){

		 //    			$pdf->SetXY($x_axis+11,$y_axis+46);
   //      				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');


		 //    		}
		 //    	} // END IF



		 //    	// FOR PHYSICS


		 //    	if($form_sum_marks->subject_name == 'Physics' && $term_mark->subject_name == 'Physics'){ 
		    		

		 //    		if($form_sum_marks->assessment_type_id == 1){

		 //    			$pdf->SetXY($x_axis,$y_axis+54);
   //      				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

   //      				$pdf->SetXY($x_axis+22,$y_axis+54);
   //      				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

   //      				$pdf->SetXY($x_axis+33,$y_axis+54);
   //      				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');

		 //    		}else if ($form_sum_marks->assessment_type_id == 2){

		 //    			$pdf->SetXY($x_axis+11,$y_axis+54);
   //      				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');


		 //    		}
		 //    	} // END IF


		 //    	// Biology

		 //    	if($form_sum_marks->subject_name == 'Biology' && $term_mark->subject_name == 'Biology'){ 
		    		

		 //    		if($form_sum_marks->assessment_type_id == 1){

		 //    			$pdf->SetXY($x_axis,$y_axis+62);
   //      				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

   //      				$pdf->SetXY($x_axis+22,$y_axis+62);
   //      				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

   //      				$pdf->SetXY($x_axis+33,$y_axis+62);
   //      				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');

		 //    		}else if ($form_sum_marks->assessment_type_id == 2){

		 //    			$pdf->SetXY($x_axis+11,$y_axis+62);
   //      				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');


		 //    		}
		 //    	} // END IF





		 //    	// History

		 //    	if($form_sum_marks->subject_name == "History" && $term_mark->subject_name == "History"){ 
		    		

		 //    		if($form_sum_marks->assessment_type_id == 1){

		 //    			$pdf->SetXY($x_axis,$y_axis+71);
   //      				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

		 //    		}else if ($form_sum_marks->assessment_type_id == 2){

		 //    			$pdf->SetXY($x_axis+11,$y_axis+71);
   //      				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

   //      				$pdf->SetXY($x_axis+22,$y_axis+71);
   //      				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

   //      				$pdf->SetXY($x_axis+33,$y_axis+71);
   //      				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');
		 //    		}
		 //    	}







		 //    	// ICT

		 //    	if($form_sum_marks->subject_name == 'ICT/CS' && $term_mark->subject_name == 'ICT/CS'){ 
		    		

		 //    		if($form_sum_marks->assessment_type_id == 1){

		 //    			$pdf->SetXY($x_axis,$y_axis+88);
   //      				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

		 //    		}else if ($form_sum_marks->assessment_type_id == 2){

		 //    			$pdf->SetXY($x_axis+11,$y_axis+88);
   //      				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

   //      				$pdf->SetXY($x_axis+22,$y_axis+88);
   //      				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

   //      				$pdf->SetXY($x_axis+33,$y_axis+88);
   //      				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');
		 //    		}
		 //    	} // END IF

		 //    	// Arabic 


		 //    	if($form_sum_marks->subject_name == 'Arabic ' && $term_mark->subject_name == 'Arabic '){ 
		    		

		 //    		if($form_sum_marks->assessment_type_id == 1){

		 //    			$pdf->SetXY($x_axis,$y_axis+96);
   //      				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

   //      				$pdf->SetXY($x_axis+22,$y_axis+96);
   //      				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

   //      				$pdf->SetXY($x_axis+33,$y_axis+96);
   //      				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');

		 //    		}else if ($form_sum_marks->assessment_type_id == 2){

		 //    			$pdf->SetXY($x_axis+11,$y_axis+96);
   //      				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');


		 //    		}
		 //    	} // END IF





		 //        } // END FOR TERM MARKS

		 //    } // END FOR FORMATIVE AND SUMMATIVE MARKS



		 //  } // END PAGE 3


		 //  if($templateId == 4){

		 //  	$term_id = 2;
			// $get_formative_summative_term_two =  $this->pra->get_formative_summative_term_two($gs_id,$term_id);
			// $get_term_marks_term_two = $this->pra->get_term_marks_term_two($gs_id,$term_id);
			// $asp_marks_term_two = $this->pra->get_term_asp_term_two($grade_id,$section_id,$term_id);

			// foreach($get_formative_summative_term_two as $form_sum_marks){

		 //    	foreach($get_term_marks_term_two as $term_mark){


		 //    		// For First Language Urdu Paper 2
		 //    	if($form_sum_marks->subject_name == 'First Language Urdu Paper 2' && $term_mark->subject_name == 'First Language Urdu Paper 2'){ 
		    		

		 //    		if($form_sum_marks->assessment_type_id == 1){

		 //    			$pdf->SetXY(100,20);
   //      				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

   //      				$pdf->SetXY(56,20);
   //      				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

   //      				$pdf->SetXY(34,20);
   //      				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');

		 //    		}else if ($form_sum_marks->assessment_type_id == 2){

		 //    			$pdf->SetXY(78,20);
   //      				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');


		 //    		}

		 //    	 } // END IF

		 //    	// For First Language Urdu Paper 1

			// 	if($form_sum_marks->subject_name == 'First Language Urdu Paper 1' && $term_mark->subject_name == 'First Language Urdu Paper 1'){ 
		    		

		 //    		if($form_sum_marks->assessment_type_id == 1){

		 //    			$pdf->SetXY(100,34);
   //      				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

   //      				$pdf->SetXY(56,34);
   //      				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

   //      				$pdf->SetXY(34,34);
   //      				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');

		 //    		}else if ($form_sum_marks->assessment_type_id == 2){

		 //    			$pdf->SetXY(78,34);
   //      				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');


		 //    		}

		 //    	 } // END IF



		 //    	} // End For Each Term
		 //    } // End For Each Formative Summative



		 //  } // END PAGE 4

		} // END PAGE COUNT 

	}  // END GRADE IX


	//=============================== Middler VII AND VIII =============================//
	//==================================================================================//

	if($grade_id == 10 || $grade_id == 11){

		$pageCount = $pdf->setSourceFile('components\pdf\draft_report\Middle-DraftReport_VII_VIII.pdf');

		for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++){
			    // import a page
			$templateId = $pdf->importPage($pageNo);
			    // get the size of the imported page
			$size = $pdf->getTemplateSize($templateId);

			if ($size['w'] > $size['h']) {
			    $pdf->AddPage('L', array($size['w'], $size['h']));
		    } 
			else{
			    $pdf->AddPage('P', array($size['w'], 295));
			}

			    // use the imported page
		    $pdf->useTemplate($templateId);

		if($templateId == 1){

			$term_id = 1;
			$formative_summative =  $this->pra->get_formative_summative_science($gs_id,$term_id);
			$term_marks = $this->pra->get_term_marks_science($gs_id,$term_id);
			$asp_marks = $this->pra->get_term_asp($grade_id,$section_id,$term_id);

			$x_axis = 21;
			$y_axis = 4;


			$term1_marks = array();
			$count = 0;
			
				
			foreach($term_marks as $term_mks){

				if($term_mks->subject_name == 'Biology' || $term_mks->subject_name == 'Chemistry' || $term_mks->subject_name == 'Physics'){

				}else{
					$term1_marks[$count]= $term_mks->ass_per_mrk;
				$count++;	
				}
				 
				
				

			}
			

			$term_one_marks =  array_sum($term1_marks);

			
			$term_one_marks = ROUND($term_one_marks);

			

			// Abridge Name
			if(!empty($formative_summative[0]->abridged_name)){

		    	$pdf->SetXY($x_axis,$y_axis);
        		$pdf->Cell(20,10,$formative_summative[0]->abridged_name,0,0,'C');

        	}

        	$y_axis = 75.5;
		    $x_axis = 42;
		    foreach($formative_summative as $form_sum_marks){

		    	foreach($term_marks as $term_mark){

		    	// For English Literature

		    	if($form_sum_marks->subject_name == 'E. Literature' && $term_mark->subject_name == 'E. Literature'){ 
		    		
		    		if($form_sum_marks->assessment_type_id == 1){

		    			$pdf->SetXY($x_axis,39);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+22,39);
        				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+33,39);
        				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');

		    		}else if ($form_sum_marks->assessment_type_id == 2){

		    			$pdf->SetXY($x_axis+11,39);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');


		    		}
		    	} // END IF


		    	// For English Language

		    	if($form_sum_marks->subject_name == 'E. Language' && $term_mark->subject_name == 'E. Language'){ 
		    		
		    		if($form_sum_marks->assessment_type_id == 1){

		    			$pdf->SetXY($x_axis,$y_axis);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');



        				$pdf->SetXY($x_axis+22,$y_axis);
        				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+33,$y_axis);
        				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');

		    		}else if ($form_sum_marks->assessment_type_id == 2){

		    			$pdf->SetXY($x_axis+11,$y_axis);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');


		    		}
		    	} // END IF

		    	// FOR MATHEMATICS

		    	if($form_sum_marks->subject_name == 'Mathematics' && $term_mark->subject_name == 'Mathematics'){ 
		    		

		    		if($form_sum_marks->assessment_type_id == 1){

		    			$pdf->SetXY($x_axis,$y_axis+30);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+22,$y_axis+30);
        				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+33,$y_axis+30);
        				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');

		    		}else if ($form_sum_marks->assessment_type_id == 2){

		    			$pdf->SetXY($x_axis+11,$y_axis+30);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');


		    		}
		    	} // END IF

		    	// FOR ISLAMIAT
		    	if($form_sum_marks->subject_name == 'Islamiyat' && $term_mark->subject_name == 'Islamiyat'){ 
		    		

		    		if($form_sum_marks->assessment_type_id == 1){

		    			$pdf->SetXY($x_axis,$y_axis+38);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+22,$y_axis+38);
        				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+33,$y_axis+38);
        				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');

		    		}else if ($form_sum_marks->assessment_type_id == 2){

		    			$pdf->SetXY($x_axis+11,$y_axis+38);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');


		    		}
		    	} // END IF


		    	// FOR SCIENCE

		    	if($form_sum_marks->subject_name == 'Science' && $term_mark->subject_name == 'Science'){ 
		    		

		    		if($form_sum_marks->assessment_type_id == 1){

		    			$pdf->SetXY($x_axis,$y_axis+46);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+22,$y_axis+46);
        				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+33,$y_axis+46);
        				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');

		    		}else if ($form_sum_marks->assessment_type_id == 2){

		    			$pdf->SetXY($x_axis+11,$y_axis+46);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');


		    		}
		    	} // END IF

		    	// FOR Design And Technology


		    	if($form_sum_marks->subject_name == 'Design Tech' && $term_mark->subject_name == 'Design Tech'){ 
		    		

		    		if($form_sum_marks->assessment_type_id == 1){

		    			$pdf->SetXY($x_axis,$y_axis+54);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+22,$y_axis+54);
        				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+33,$y_axis+54);
        				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');

		    		}else if ($form_sum_marks->assessment_type_id == 2){

		    			$pdf->SetXY($x_axis+11,$y_axis+54);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');


		    		}
		    	} // END IF


		    	// Arabic  

		    	if($form_sum_marks->subject_name == 'Arabic ' && $term_mark->subject_name == 'Arabic '){ 
		    		

		    		if($form_sum_marks->assessment_type_id == 1){

		    			$pdf->SetXY($x_axis,$y_axis+62);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+22,$y_axis+62);
        				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+33,$y_axis+62);
        				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');

		    		}else if ($form_sum_marks->assessment_type_id == 2){

		    			$pdf->SetXY($x_axis+11,$y_axis+62);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');


		    		}
		    	} // END IF





		    	// History

		    	if($form_sum_marks->subject_name == "History" && $term_mark->subject_name == "History"){ 
		    		

		    		if($form_sum_marks->assessment_type_id == 1){

		    			$pdf->SetXY($x_axis,$y_axis+71);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

		    		}else if ($form_sum_marks->assessment_type_id == 2){

		    			$pdf->SetXY($x_axis+11,$y_axis+71);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+22,$y_axis+71);
        				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+33,$y_axis+71);
        				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');
		    		}
		    	}







		    	// Geography 

		    	if($form_sum_marks->subject_name == 'Geography ' && $term_mark->subject_name == 'Geography '){ 
		    		

		    		if($form_sum_marks->assessment_type_id == 1){

		    			$pdf->SetXY($x_axis,$y_axis+80);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

		    		}else if ($form_sum_marks->assessment_type_id == 2){

		    			$pdf->SetXY($x_axis+11,$y_axis+80);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+22,$y_axis+80);
        				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+33,$y_axis+80);
        				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');
		    		}
		    	} // END IF

		    	// ICT/CS 

		    	if($form_sum_marks->subject_name == 'ICT/CS' && $term_mark->subject_name == 'ICT/CS'){ 
		    		

		    		if($form_sum_marks->assessment_type_id == 1){

		    			$pdf->SetXY($x_axis,$y_axis+88);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+22,$y_axis+88);
        				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+33,$y_axis+88);
        				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');

		    		}else if ($form_sum_marks->assessment_type_id == 2){

		    			$pdf->SetXY($x_axis+11,$y_axis+88);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');


		    		}
		    	} // END IF

		    	// Art AND CRAFT 

		    	if($form_sum_marks->subject_name == 'Arts & Crafts' && $term_mark->subject_name == 'Arts & Crafts'){ 
		    		

		    		if($form_sum_marks->assessment_type_id == 1){

		    			$pdf->SetXY($x_axis,$y_axis+96);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+22,$y_axis+96);
        				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

        				$pdf->SetXY($x_axis+33,$y_axis+96);
        				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');

		    		}else if ($form_sum_marks->assessment_type_id == 2){

		    			$pdf->SetXY($x_axis+11,$y_axis+96);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');


		    		}
		    	} // END IF

		    } // END Term Marks
		}	// End Formative And Summative

			//======== ASP MARKS ======//

		    $ptm_attendance = '';
		    $first_day = '';
		    $stationary = '';
		    foreach($asp_marks as $asp){

			    if($asp->gs_id == $gs_id){

		    		$ptm_attendance = $asp->ptm_orientation+$asp->ptm_unit;
		    		$first_day = $asp->attendance;
		    		$stationary = $asp->stationery;
		    		
		    		// $pdf->SetXY($x_axis,$y_axis+113);
        // 			$pdf->Cell(20,10,$ptm_attendance,0,0,'C');

        // 			$pdf->SetXY($x_axis,$y_axis+120);
        // 			$pdf->Cell(20,10,$stationary,0,0,'C');

        // 			$pdf->SetXY($x_axis,$y_axis+127);
        // 			$pdf->Cell(20,10,$first_day,0,0,'C');

        			$total_term_one = $term_one_marks + $asp->asp_total;
	        			
			    } 	//END IF

		    } 	// END FOREACH

		    //============ TOTAL TERM 1 =============//

		    if(empty($total_term_one)){
		    	$total = $term_one_marks/$count;
		    	$total = round($total,1);
		    }else{
		    	$total = $total_term_one/$count;
		    	$total = ROUND($total,1);
		    }

		    $term_one_total = $total;

			$pdf->SetXY(26,12);
		    $pdf->Cell(20,10,$term_one_total,0,0,'C');


		    $pdf->SetXY(42,188);
		    $pdf->Cell(20,10,$first_day,0,0,'C');


		    $pdf->SetXY(42,195);
		    $pdf->Cell(20,10,$stationary,0,0,'C');



		    $pdf->SetXY(42,202.5);
		    $pdf->Cell(20,10,$ptm_attendance,0,0,'C');


		    // GRADING PASTING	

        	if($term_one_total >= intval($Aplus_weightage) && $term_one_total <= 100){
                $grade_Aplus = $Aplus_name;
                $pdf->SetXY(75,12);
                $pdf->Cell(20,10,$grade_Aplus,0,0,'C');
            }

            if($term_one_total >= intval($A_weightage) && $term_one_total < $Aplus_weightage){
                $grade_A = $A_name;
                $pdf->SetXY(75,12);
                $pdf->Cell(20,10,$grade_A,0,0,'C');
            }
            
            if($term_one_total >= intval($B_weightage) && $term_one_total < $A_weightage){
                $grade_B = $B_name;
                $pdf->SetXY(75,12);
                $pdf->Cell(20,10,$grade_B,0,0,'C');
            }

            if($term_one_total >= intval($C_weightage) && $term_one_total < $B_weightage){
                $grade_C = $C_name;
                $pdf->SetXY(75,12);
                $pdf->Cell(20,10,$grade_C,0,0,'C');
            }

            if($term_one_total >= intval($D_weightage) && $term_one_total < $C_weightage){
                $grade_D = $D_name;
                $pdf->SetXY(75,12);
                $pdf->Cell(20,10,$grade_D,0,0,'C');
            }
            
            if($term_one_total < intval($U_weightage)){
                $grade_U = $U_name;
                $pdf->SetXY(75,12);
                $pdf->Cell(20,10,$grade_U,0,0,'C');
            }


        	
		} // END Page 1


        if($templateId == 2){

            foreach($formative_summative as $form_sum_marks){

		    	foreach($term_marks as $term_mark){

		    	// For First Language Urdu Paper 2
		    	if($form_sum_marks->subject_name == 'Urdu Literature' && $term_mark->subject_name == 'Urdu Literature'){ 
		    		

		    		if($form_sum_marks->assessment_type_id == 1){

		    			$pdf->SetXY(100,20);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

		    		}else if ($form_sum_marks->assessment_type_id == 2){

		    			$pdf->SetXY(78,20);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

        				$pdf->SetXY(56,20);
        				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

        				$pdf->SetXY(34,20);
        				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');
		    		}

		    	 } // END IF

		    	// For First Language Urdu Paper 1

				if($form_sum_marks->subject_name == 'Urdu Language' && $term_mark->subject_name == 'Urdu Language'){ 
		    		

		    		if($form_sum_marks->assessment_type_id == 1){

		    			$pdf->SetXY(100,34);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

		    		}else if ($form_sum_marks->assessment_type_id == 2){

		    			$pdf->SetXY(78,34);
        				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

        				$pdf->SetXY(56,34);
        				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

        				$pdf->SetXY(34,34);
        				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');
		    		}

		    	 } // END IF

		      } // END FOR TERM 2

		  	} // END FOR FORMATIVE AND SUMMATIVE

        } // END PAGE 2

   //      if($templateId == 3){

   //      	$term_id = 2;
			// $get_formative_summative_term_two =  $this->pra->get_formative_summative_science_term_two($gs_id,$term_id);
			// $get_term_marks_term_two = $this->pra->get_term_marks_science_term_two($gs_id,$term_id);
			// $asp_marks_term_two = $this->pra->get_term_asp_term_two($grade_id,$section_id,$term_id);


			// $x_axis = 22;
			// $y_axis = 4;


			// // Calculating Term 2

			// $term_two = array();
			// $count = 0;

			// if(!empty($get_term_marks_term_two)){

			// 	foreach($get_term_marks_term_two as $term_marks){
					
			// 		if($term_marks->subject_name == 'Biology' || $term_marks->subject_name == 'Chemistry' || $term_marks->subject_name == 'Physics'){

			// 	}else{
			// 		$term_two[$count]= $term_marks->ass_per_mrk;
			// 	$count++;	
			// 	}
			// 	}

			// 	$term_two = array_sum($term_two);
			// 	//var_dump($term_two);
			// }


			// //======== ASP MARKS ======//

		 //    $ptm_attendance = '';
		 //    $first_day = '';
		 //    $stationary = '';
		 //    foreach($asp_marks_term_two as $asp){

			//     if($asp->gs_id == $gs_id){

		 //    		$ptm_attendance = $asp->ptm_orientation+$asp->ptm_unit;
		 //    		$first_day = $asp->attendance;
		 //    		$stationary = $asp->stationery;
		    		
		 //    		// $pdf->SetXY($x_axis,$y_axis+113);
   //      // 			$pdf->Cell(20,10,$ptm_attendance,0,0,'C');

   //      // 			$pdf->SetXY($x_axis,$y_axis+120);
   //      // 			$pdf->Cell(20,10,$stationary,0,0,'C');

   //      // 			$pdf->SetXY($x_axis,$y_axis+127);
   //      // 			$pdf->Cell(20,10,$first_day,0,0,'C');

   //      			$total_term_two = $term_two + $asp->asp_total;
	        			
			//     } 	//END IF

		 //    } 	// END FOREACH

		 //    //============ TOTAL TERM 1 =============//

		 //    if(empty($total_term_two)){
		 //    	$total = $term_two/$count;
		 //    	$total = round($total,1);
		 //    }else{
		 //    	$total = $total_term_two/$count;
		 //    	$total = ROUND($total,1);
		 //    }

		 //    $total_term_two = $total;

			// // Term Two Total

			// $pdf->SetXY(50,12);
		 //    $pdf->Cell(20,10,$total_term_two,0,0,'C');	


		 //    // Term One Total
			// $pdf->SetXY(20,12);
		 //    $pdf->Cell(20,10,$term_one_total,0,0,'C');

		 //    $overall = 0 ;
		 //    $overall = ($total_term_two + $term_one_total)/2;
		 //    $overall = ROUND($overall);

		 //    $pdf->SetXY(81,12);
		 //    $pdf->Cell(20,10,$overall,0,0,'C');

		 //    // GRADING PASTING	

   //      	if($overall >= intval($Aplus_weightage) && $overall <= 100){
   //              $grade_Aplus = $Aplus_name;
   //              $pdf->SetXY(108,12);
   //              $pdf->Cell(20,10,$grade_Aplus,0,0,'C');
   //          }

   //          if($overall >= intval($A_weightage) && $overall < $Aplus_weightage){
   //              $grade_A = $A_name;
   //              $pdf->SetXY(108,12);
   //              $pdf->Cell(20,10,$grade_A,0,0,'C');
   //          }
            
   //          if($overall >= intval($B_weightage) && $overall < $A_weightage){
   //              $grade_B = $B_name;
   //              $pdf->SetXY(108,12);
   //              $pdf->Cell(20,10,$grade_B,0,0,'C');
   //          }

   //          if($overall >= intval($C_weightage) && $overall < $B_weightage){
   //              $grade_C = $C_name;
   //              $pdf->SetXY(108,12);
   //              $pdf->Cell(20,10,$grade_C,0,0,'C');
   //          }

   //          if($overall >= intval($D_weightage) && $overall < $C_weightage){
   //              $grade_D = $D_name;
   //              $pdf->SetXY(108,12);
   //              $pdf->Cell(20,10,$grade_D,0,0,'C');
   //          }
            
   //          if($overall < intval($U_weightage)){
   //              $grade_U = $U_name;
   //              $pdf->SetXY(108,12);
   //              $pdf->Cell(20,10,$grade_U,0,0,'C');
   //          }

   //          // Ptm Attendance
   //          $pdf->SetXY(42,203);
   //          $pdf->Cell(20,10,$ptm_attendance,0,0,'C');

   //          //Ptm Stationary

   //          $pdf->SetXY(42,195);
   //          $pdf->Cell(20,10,$stationary,0,0,'C');


   //          // First day Attendance
   //          $pdf->SetXY(42,188);
   //          $pdf->Cell(20,10,$first_day,0,0,'C');


			// $pdf->SetFont($font_name,'',8);

			// // Abridge Name
			// if(!empty($get_formative_summative_term_two[0]->abridged_name)){

		 //    	$pdf->SetXY($x_axis,$y_axis);
   //      		$pdf->Cell(20,10,$get_formative_summative_term_two[0]->abridged_name,0,0,'C');

   //      	}

   //      	$y_axis = 75.5;
		 //    $x_axis = 42;
		 //    foreach($get_formative_summative_term_two as $form_sum_marks){

		 //    	foreach($get_term_marks_term_two as $term_mark){

		 //    		// For English Literature

		 //    	if($form_sum_marks->subject_name == 'E. Literature' && $term_mark->subject_name == 'E. Literature'){ 
		    		
		 //    		if($form_sum_marks->assessment_type_id == 1){

		 //    			$pdf->SetXY($x_axis,39);
   //      				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

   //      				$pdf->SetXY($x_axis+22,39);
   //      				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

   //      				$pdf->SetXY($x_axis+33,39);
   //      				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');

		 //    		}else if ($form_sum_marks->assessment_type_id == 2){

		 //    			$pdf->SetXY($x_axis+11,39);
   //      				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');


		 //    		}
		 //    	} // END IF


		 //    	// For English Language

		 //    	if($form_sum_marks->subject_name == 'E. Language' && $term_mark->subject_name == 'E. Language'){ 
		    		
		 //    		if($form_sum_marks->assessment_type_id == 1){

		 //    			$pdf->SetXY($x_axis,$y_axis);
   //      				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');



   //      				$pdf->SetXY($x_axis+22,$y_axis);
   //      				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

   //      				$pdf->SetXY($x_axis+33,$y_axis);
   //      				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');

		 //    		}else if ($form_sum_marks->assessment_type_id == 2){

		 //    			$pdf->SetXY($x_axis+11,$y_axis);
   //      				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');


		 //    		}
		 //    	} // END IF

		 //    	// FOR MATHEMATICS

		 //    	if($form_sum_marks->subject_name == 'Mathematics' && $term_mark->subject_name == 'Mathematics'){ 
		    		

		 //    		if($form_sum_marks->assessment_type_id == 1){

		 //    			$pdf->SetXY($x_axis,$y_axis+30);
   //      				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

   //      				$pdf->SetXY($x_axis+22,$y_axis+30);
   //      				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

   //      				$pdf->SetXY($x_axis+33,$y_axis+30);
   //      				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');

		 //    		}else if ($form_sum_marks->assessment_type_id == 2){

		 //    			$pdf->SetXY($x_axis+11,$y_axis+30);
   //      				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');


		 //    		}
		 //    	} // END IF

		 //    	// FOR ISLAMIAT
		 //    	if($form_sum_marks->subject_name == 'Islamiyat' && $term_mark->subject_name == 'Islamiyat'){ 
		    		

		 //    		if($form_sum_marks->assessment_type_id == 1){

		 //    			$pdf->SetXY($x_axis,$y_axis+38);
   //      				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

   //      				$pdf->SetXY($x_axis+22,$y_axis+38);
   //      				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

   //      				$pdf->SetXY($x_axis+33,$y_axis+38);
   //      				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');

		 //    		}else if ($form_sum_marks->assessment_type_id == 2){

		 //    			$pdf->SetXY($x_axis+11,$y_axis+38);
   //      				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');


		 //    		}
		 //    	} // END IF


		 //    	// FOR SCIENCE

		 //    	if($form_sum_marks->subject_name == 'Science' && $term_mark->subject_name == 'Science'){ 
		    		

		 //    		if($form_sum_marks->assessment_type_id == 1){

		 //    			$pdf->SetXY($x_axis,$y_axis+46);
   //      				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

   //      				$pdf->SetXY($x_axis+22,$y_axis+46);
   //      				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

   //      				$pdf->SetXY($x_axis+33,$y_axis+46);
   //      				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');

		 //    		}else if ($form_sum_marks->assessment_type_id == 2){

		 //    			$pdf->SetXY($x_axis+11,$y_axis+46);
   //      				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');


		 //    		}
		 //    	} // END IF

		 //    	// FOR Design And Technology


		 //    	if($form_sum_marks->subject_name == 'Design Tech' && $term_mark->subject_name == 'Design Tech'){ 
		    		

		 //    		if($form_sum_marks->assessment_type_id == 1){

		 //    			$pdf->SetXY($x_axis,$y_axis+54);
   //      				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

   //      				$pdf->SetXY($x_axis+22,$y_axis+54);
   //      				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

   //      				$pdf->SetXY($x_axis+33,$y_axis+54);
   //      				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');

		 //    		}else if ($form_sum_marks->assessment_type_id == 2){

		 //    			$pdf->SetXY($x_axis+11,$y_axis+54);
   //      				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');


		 //    		}
		 //    	} // END IF


		 //    	// Arabic  

		 //    	if($form_sum_marks->subject_name == 'Arabic ' && $term_mark->subject_name == 'Arabic '){ 
		    		

		 //    		if($form_sum_marks->assessment_type_id == 1){

		 //    			$pdf->SetXY($x_axis,$y_axis+62);
   //      				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

   //      				$pdf->SetXY($x_axis+22,$y_axis+62);
   //      				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

   //      				$pdf->SetXY($x_axis+33,$y_axis+62);
   //      				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');

		 //    		}else if ($form_sum_marks->assessment_type_id == 2){

		 //    			$pdf->SetXY($x_axis+11,$y_axis+62);
   //      				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');


		 //    		}
		 //    	} // END IF





		 //    	// History

		 //    	if($form_sum_marks->subject_name == "History" && $term_mark->subject_name == "History"){ 
		    		

		 //    		if($form_sum_marks->assessment_type_id == 1){

		 //    			$pdf->SetXY($x_axis,$y_axis+71);
   //      				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

		 //    		}else if ($form_sum_marks->assessment_type_id == 2){

		 //    			$pdf->SetXY($x_axis+11,$y_axis+71);
   //      				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

   //      				$pdf->SetXY($x_axis+22,$y_axis+71);
   //      				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

   //      				$pdf->SetXY($x_axis+33,$y_axis+71);
   //      				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');
		 //    		}
		 //    	}







		 //    	// Geography 

		 //    	if($form_sum_marks->subject_name == 'Geography ' && $term_mark->subject_name == 'Geography '){ 
		    		

		 //    		if($form_sum_marks->assessment_type_id == 1){

		 //    			$pdf->SetXY($x_axis,$y_axis+80);
   //      				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

		 //    		}else if ($form_sum_marks->assessment_type_id == 2){

		 //    			$pdf->SetXY($x_axis+11,$y_axis+80);
   //      				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

   //      				$pdf->SetXY($x_axis+22,$y_axis+80);
   //      				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

   //      				$pdf->SetXY($x_axis+33,$y_axis+80);
   //      				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');
		 //    		}
		 //    	} // END IF

		 //    	// ICT/CS 

		 //    	if($form_sum_marks->subject_name == 'ICT/CS' && $term_mark->subject_name == 'ICT/CS'){ 
		    		

		 //    		if($form_sum_marks->assessment_type_id == 1){

		 //    			$pdf->SetXY($x_axis,$y_axis+88);
   //      				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

   //      				$pdf->SetXY($x_axis+22,$y_axis+88);
   //      				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

   //      				$pdf->SetXY($x_axis+33,$y_axis+88);
   //      				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');

		 //    		}else if ($form_sum_marks->assessment_type_id == 2){

		 //    			$pdf->SetXY($x_axis+11,$y_axis+88);
   //      				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');


		 //    		}
		 //    	} // END IF

		 //    	// Art AND CRAFT 

		 //    	if($form_sum_marks->subject_name == 'Arts & Crafts' && $term_mark->subject_name == 'Arts & Crafts'){ 
		    		

		 //    		if($form_sum_marks->assessment_type_id == 1){

		 //    			$pdf->SetXY($x_axis,$y_axis+96);
   //      				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

   //      				$pdf->SetXY($x_axis+22,$y_axis+96);
   //      				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

   //      				$pdf->SetXY($x_axis+33,$y_axis+96);
   //      				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');

		 //    		}else if ($form_sum_marks->assessment_type_id == 2){

		 //    			$pdf->SetXY($x_axis+11,$y_axis+96);
   //      				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');


		 //    		}
		 //    	} // END IF

		 //      } // END FOR TERM 2
		 //    } // END For GET FORMATIVE AND SUMMATIVE


   //      } // END PAGE 3

   //      if($templateId == 4){

   //      foreach($get_formative_summative_term_two as $form_sum_marks){

		 //    	foreach($get_term_marks_term_two as $term_mark){

		 //    	// For First Language Urdu Paper 2
		 //    	if($form_sum_marks->subject_name == 'Urdu Literature' && $term_mark->subject_name == 'Urdu Literature'){ 
		    		

		 //    		if($form_sum_marks->assessment_type_id == 1){

		 //    			$pdf->SetXY(100,20);
   //      				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

		 //    		}else if ($form_sum_marks->assessment_type_id == 2){

		 //    			$pdf->SetXY(78,20);
   //      				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

   //      				$pdf->SetXY(56,20);
   //      				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

   //      				$pdf->SetXY(34,20);
   //      				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');
		 //    		}

		 //    	 } // END IF

		 //    	// For First Language Urdu Paper 1

			// 	if($form_sum_marks->subject_name == 'Urdu Language' && $term_mark->subject_name == 'Urdu Language'){ 
		    		

		 //    		if($form_sum_marks->assessment_type_id == 1){

		 //    			$pdf->SetXY(100,34);
   //      				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

		 //    		}else if ($form_sum_marks->assessment_type_id == 2){

		 //    			$pdf->SetXY(78,34);
   //      				$pdf->Cell(20,10,$form_sum_marks->ass_per_mrk,0,0,'C');

   //      				$pdf->SetXY(56,34);
   //      				$pdf->Cell(20,10,$term_mark->ass_per_mrk,0,0,'C');

   //      				$pdf->SetXY(34,34);
   //      				$pdf->Cell(20,10,$term_mark->grade,0,0,'C');
		 //    		}

		 //    	 } // END IF

		 //      } // END FOR TERM 2

		 //  	} // END FOR FORMATIVE AND SUMMATIVE


   //      } // END PAGE 4

		} // END PAGE COUNT
		
	} // END GRADE VII AND VIII


	$pdf->Output('Olevel' . '.pdf', 'I');
} // Progress Report



}