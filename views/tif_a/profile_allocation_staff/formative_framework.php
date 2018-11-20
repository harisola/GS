<?php 

class Formative_framework extends CI_Controller{

	public function __construct(){
		parent::__construct();
	}



	 //    public function getThisFormativeframework_PDF(){
  //   	$html = '';


  //   	$user_id = $this->input->post("user_id");
  //       $role_id = $this->input->post("role_id");
  //       $sectionID = $this->input->post("sectionID");
  //       $gradeID = $this->input->post("gradeID");
  //       $optional = $this->input->post("optional");
  //       //$GPID = $this->input->post("GPID");
  //       $prgmID = $this->input->post("prgmID");
  //       $gpp_id = $this->input->post("gpp_id");
  //       $academic = $this->input->post("academic");
  //       $term = $this->input->post("term");
  //       $subjectID = $this->input->post("subjectID");

        
  //       $groupID = '0';
  //       $blockID = '0';
  //       if(substr(substr($gpp_id,-3),1) != '0'){
  //       	$groupID = substr(substr($gpp_id,-3),1);
  //       	$blockID = substr($gpp_id,1);
  //       }

  //       //var_dump($_POST);


  //   	$html .= '<style>
		// .unit_report_pdf_iframe {
		// 	position: relative;
		// 	padding-bottom: 65.25%;
		// 	padding-top: 30px;
		// 	height: 0;
		// 	overflow: auto; 
		// 	-webkit-overflow-scrolling:touch; //<<--- THIS IS THE KEY 
		// 	border: solid black 1px;
		// 	} 
		// 	.unit_report_pdf_iframe iframe {
		// 	position: absolute;
		// 	top: 0;
		// 	left: 0;
		// 	width: 100%;
		// 	height: 90%;
		// }
		// </style>';


		// $helper = 'user_id='.$user_id.'&role_id='.$role_id.'&sectionID='.$sectionID.'&optional='.$optional.'&prgmID='.$prgmID.'&gpp_id='.$gpp_id.'&academic='.$academic.'&term='.$term.'&subjectID='.$subjectID.'&gradeID='.$gradeID.'&groupID='.$groupID.'&blockID='.$blockID;


		// $html .= '
		// <div class="unit_report_pdf_iframe">
		// 	<iframe src="'.site_url().'/etab_reports/formative_framework/get_formative_framework_report?'.$helper.'" frameborder="0">
		// 	</iframe>
		// </div>';

		
  //   	echo $html;
  //   }

	// public function get_formative_framework_report(){
	// 	$user_id = $this->input->get("user_id");
 //        $role_id = $this->input->get("role_id");
 //        $sectionID = $this->input->get("sectionID");
 //        $gradeID = $this->input->get("gradeID");
 //        $optional = $this->input->get("optional");
        
 //        $prgmID = $this->input->get("prgmID");
 //        $gpp_id = $this->input->get("gpp_id");
 //        $academic = $this->input->get("academic");
 //        $term = $this->input->get("term");
 //        $subjectID = $this->input->get("subjectID");

 //        //var_dump($this->input->get());



 //        $this->load->model('atif_sp/assessment_report_model');
 //        $GroupID = 0;
 //        $BlockID = 0;



 //        /**************************** Assessment Titles 
 //        /***********************************************/
 //        $this->data['assessment_titles'] = $this->assessment_report_model->get_grade_subject_assessments($gradeID, $subjectID, $role_id, $term);
 //        /******************************** Students Data 
 //        /***********************************************/
 //        if($optional == 0){
 //        	$this->data['students_gs_data'] = $this->assessment_report_model->get_students_grade_section($gradeID, $sectionID);
 //        }else{
 //        	$GroupID = substr(substr($gpp_id, -3), 0, 1);
 //        	if($GroupID == 'A'){$GroupID=1;}else
 //        	if($GroupID == 'B'){$GroupID=2;}else
 //        	if($GroupID == 'C'){$GroupID=3;}else
 //        	if($GroupID == 'D'){$GroupID=4;}else
 //        	if($GroupID == 'E'){$GroupID=5;}else
 //        	if($GroupID == 'F'){$GroupID=6;}

 //        	$BlockID = substr($gpp_id, -1);

 //        	$this->data['students_gs_data'] = $this->assessment_report_model->get_students_grade_optional_group_block($gradeID, $subjectID, $GroupID, $BlockID);
 //        }
 //        /***************************** Assessment Marks
 //        /***********************************************/
 //        if($optional == 0){
	//         $this->data['assessment_marks'] = $this->assessment_report_model->get_grade_subject_assessments_marks($gradeID, $sectionID, $subjectID, $role_id, $term);
	//     }else{
	//     	$this->data['assessment_marks'] = $this->assessment_report_model->get_grade_subject_optional_assessments_marks($gradeID, $subjectID, $GroupID, $BlockID, $role_id, $term);
	//     }

 //        /******************* Assessment Aggregate Marks 
 //        /***********************************************/
 //        if($optional == 0){
	//         $this->data['assessment_agg_marks'] = $this->assessment_report_model->get_grade_subject_assessments_aggMarks($gradeID, $sectionID, $subjectID, $role_id, $term);

	//     }else{
	//     	$this->data['assessment_agg_marks'] = $this->assessment_report_model->get_grade_subject_optional_assessments_aggMarks($gradeID, $subjectID, $GroupID, $BlockID, $role_id, $term);
	//     }

	//     $select_grade = $this->assessment_report_model->get_grade($academic,$prgmID);




	//     $noOfStudents = sizeof($this->data['students_gs_data']);
 //    	$noOfAssessments = sizeof($this->data['assessment_titles']);
    	




 //     	// Overall Font Size
	// 	$font_size = 8;
	// 	$font_name = 'Helvetica'; //Helvetica
	// 	$gender_mark_size = 26;
	// 	$now_date = date('d-M-Y');
	// 	$border = 1;

	



	// 	require_once('components/pdf/fpdf/fpdf_rotate.php');
	// 	require_once('components/pdf/fpdi/fpdi.php');

		


		
	// 	// initiate FPDI
	// 	// if($noOfAssessments <= 27){
	// 	// 	$pdf = new PDF('L', 'mm', 'A4');
	// 	// }
	// 	// if($noOfAssessments > 27 and $noOfAssessments <= 30){
	// 	// 	//$pdf = new PDF('L', 'mm', 'A3');
	// 	// 	$pdf = new PDF('L','mm',array(270,370));
	// 	// }
	// 	// else if($noOfAssessments  > 30 and $noOfAssessments <= 33)
	// 	// {
	// 	// 	$pdf = new PDF('L','mm',array(300,400));
	// 	// }
	// 	// else if($noOfAssessments > 33 and $noOfAssessments <= 36)
	// 	// {
	// 	// 	$pdf = new PDF('L','mm',array(350,450));

	// 	// }
	// 	// else if ($noOfAssessments > 36 and $noOfAssessments <= 39){
			
	// 	// 	$pdf = new PDF('L','mm',array(400,500));

	// 	// }
	// 	// else if($noOfAssessments > 39 and $noOfAssessments <=42)
	// 	// {
	// 	// 	$pdf = new PDF('L','mm',array(450,550));
	// 	// }else{
	// 	// 	$pdf = new PDF('L','mm', 'A3');
	// 	// }

	// 	$pdf = new PDF('L','mm',array(500,600));

	// 	$pdf->AddPage();
	// 	$pdf->SetFont($font_name,'',$font_size);
	// 	$i = 0;



	// 	$borderon = 0;
		
	// 	$rptheading_CW = 65;
	// 	$rptheading_CH = 10;

	// 	$rptheading_X = ($pdf->w-($rptheading_CW))/2;
	// 	$rptheading_Y = 7;
		
		
	// 	if(empty($this->data['assessment_marks'][0]->subject_name)){
	// 		$subject_name = '';
	// 	}else{
	// 		$subject_name = $this->data['assessment_marks'][0]->subject_name;
	// 	}
		



	// 	$assessment_X = 81;
	// 	$assessment_Y = 7;

	// 	$student_X = 7;
	// 	$student_Y = 57;
	// 	$student_CH = 4;



	// 	/**************************************************** Report Heading
	// 	*********************************************************************/
	// 	$pdf->AddFont('CooperBT-Black','','CooperBlackBT.php');

	// 	$heading_font_name = 'CooperBT-Black';
	// 	$heading_font_size = 10;
	// 	$pdf->SetFont($heading_font_name,'',$heading_font_size+2);
 //    	$pdf->SetXY($rptheading_X,$rptheading_Y);
 //    	$pdf->Cell($rptheading_CW,$rptheading_CH,"Generation's School",$borderon,2,'C', 0);
 //    	$pdf->SetFont($heading_font_name,'',$heading_font_size);
 //    	$pdf->Cell($rptheading_CW,$rptheading_CH,"Formative Frame Work",$borderon,2,'C',0);
 //    	$pdf->Cell($rptheading_CW,$rptheading_CH,$gpp_id,$borderon,2,'C',0);
 //    	// $pdf->Cell($rptheading_CW,$rptheading_CH-6,$subject_name,$borderon,2,'L');

    	

	// 	/*************************************************** Assessment Titles
	// 	***********************************************************************/




	// 	/*************************************************** Assessment Titles
	// 	***********************************************************************/

	// 	$rptheading_X = 10;
	// 	$rptheading_Y = $rptheading_Y + ($rptheading_CH * 3) ;

	// 	$heading_font_name = 'Helvetica';
	// 	$heading_font_size = 10;
	// 	$pdf->SetFont($heading_font_name,'',$heading_font_size);

	// 	$title_height = 20;
	// 	$title_width = 7;

	// 	$pdf->SetXY($rptheading_X,$rptheading_Y);
	// 	$pdf->Cell($title_width,$title_height,'S#',1,0,'C');

	// 	$rptheading_X = $rptheading_X+$title_width;
	// 	$title_width = 50;
	// 	$pdf->SetXY($rptheading_X,$rptheading_Y);
	// 	$pdf->Cell($title_width,$title_height,'Student Name',1,0,'C');

	// 	$rptheading_X = $rptheading_X+$title_width;
	// 	$i = 0;
	// 	$rptheading_X_new = 0;

	// 	foreach ($this->data['assessment_titles'] as $data) {

	// 		// $lastx = 0;
	// 		// $lasty = 0;

	// 		$col = $data->full_name;

	// 	   	// $pdf->Cell($X,$Y,,$border);

	// 		if($data->this_order == 2){
	// 			// Fill Grey
	// 			$textw = strlen($col);
	// 			// var_dump($textw);

	// 			if($textw > 14 && $textw <=30){
	// 				$heading_font_name = 'Helvetica';
	// 				$heading_font_size = 7;
	// 				$pdf->SetFont($heading_font_name,'',$heading_font_size);

	// 			}else if($textw > 30){
	// 				$heading_font_name = 'Helvetica';
	// 				$heading_font_size = 6;
	// 				$pdf->SetFont($heading_font_name,'',$heading_font_size);
	// 			}
	// 			else if($textw <= 14){
	// 				$heading_font_name = 'Helvetica';
	// 				$heading_font_size = 8;
	// 				$pdf->SetFont($heading_font_name,'',$heading_font_size);
	// 			}
	// 			//var_dump($textw);

	// 			$pdf->SetFillColor(175,175,175);
	// 			$pdf->SetXY($rptheading_X + $i,$rptheading_Y);
	// 			$pdf->Cell(33,20,$col,1, 1,'C', 0);
				
	// 			$i += 33;
	// 			$rptheading_X_new = $rptheading_X+$i;
				
	// 		}



	// 	}



	// 	$pdf->SetXY($rptheading_X_new,$rptheading_Y);
	// 	$pdf->Cell(20,$title_height,'Formative 100%',1,1,'C');

	// 	$heading_font_name = 'Helvetica';
	// 	$heading_font_size = 12;
	// 	$pdf->SetFont($heading_font_name,'',$heading_font_size);

	// 	//========== New Line of Topic ====================//	

	// 	$rptheading_X = 10;
	// 	$rptheading_Y = $rptheading_Y+20;

	// 	$title_width = 7;
	// 	$title_height = 18;

	// 	$pdf->SetXY($rptheading_X,$rptheading_Y);
	// 	$pdf->Cell($title_width,$title_height,'',1,1,'C');

	// 	$rptheading_X = $rptheading_X+$title_width;
	// 	$title_width = 50;

	// 	$pdf->SetXY($rptheading_X,$rptheading_Y);
	// 	$pdf->Cell($title_width,$title_height,'Topic',1,1,'L');

	// 	$rptheading_X = $rptheading_X+$title_width;

	// 	$title_width = 11;
	// 	foreach($this->data['assessment_titles'] as $data){


	// 		if($data->this_order == 2){
	// 		for($i = 0 ; $i < 3;$i++){
	// 			$pdf->Setxy($rptheading_X,$rptheading_Y);
	// 			$pdf->Cell($title_width,$title_height,'',1,1,'L');
	// 			$rptheading_X = $rptheading_X + $title_width;
	// 		}
	// 		}

	// 	}

	// 	$pdf->SetXY($rptheading_X,$rptheading_Y);
	// 	$pdf->Cell(20,$title_height,'',1,1,'L');

	// 	//==================== Marks =================//

	// 	$rptheading_Y = $rptheading_Y + $title_height;
	// 	$rptheading_X = 10;

	// 	$title_width = 7;
	// 	$title_height = 12;

	// 	$pdf->SetXY($rptheading_X,$rptheading_Y);
	// 	$pdf->Cell($title_width,$title_height,'',1,1,'C');

	// 	$rptheading_X = $rptheading_X + $title_width;
	// 	$title_width = 50;

	// 	$pdf->SetXY($rptheading_X,$rptheading_Y);
	// 	$pdf->Cell($title_width,$title_height,'Marks',1,1,'L');

	// 	$rptheading_X = $rptheading_X+$title_width;

	// 	$title_width = 11;
	// 	foreach($this->data['assessment_titles'] as $data){

	// 		if($data->this_order == 2){
	// 		for($i = 0 ; $i < 3;$i++){
	// 			$pdf->Setxy($rptheading_X,$rptheading_Y);
	// 			$pdf->Cell($title_width,$title_height,'',1,1,'L');
	// 			$rptheading_X = $rptheading_X + $title_width;
	// 			}
	// 		}

	// 	}

	// 	$pdf->SetXY($rptheading_X,$rptheading_Y);
	// 	$pdf->Cell(20,$title_height,'',1,1,'L');

	// //========================Marks End =====================//

	// //=========================Dates=========================//

	// 	$rptheading_Y = $rptheading_Y + $title_height;
	// 	$rptheading_X = 10;

	// 	$title_width = 7;
	// 	$title_height = 12;

	// 	$pdf->SetXY($rptheading_X,$rptheading_Y);
	// 	$pdf->Cell($title_width,$title_height,'',1,1,'C');

	// 	$rptheading_X = $rptheading_X + $title_width;
	// 	$title_width = 50;

	// 	$pdf->SetXY($rptheading_X,$rptheading_Y);
	// 	$pdf->Cell($title_width,$title_height,'Dates',1,1,'L');

	// 	$rptheading_X = $rptheading_X+$title_width;

	// 	$title_width = 11;
	// 	foreach($this->data['assessment_titles'] as $data){

	// 		if($data->this_order == 2){
	// 		for($i = 0 ; $i < 3;$i++){
	// 			$pdf->Setxy($rptheading_X,$rptheading_Y);
	// 			$pdf->Cell($title_width,$title_height,'',1,1,'L');
	// 			$rptheading_X = $rptheading_X + $title_width;
	// 			}
	// 		}

	// 	}
	// 	$pdf->SetXY($rptheading_X,$rptheading_Y);
	// 	$pdf->Cell(20,$title_height,'',1,1,'L');



	// //===============Dates End ==============================//


	// //================== Student Names =========================//

	// 	$rptheading_Y = $rptheading_Y + $title_height;
	// 	$rptheading_X = 10;



	// 	$count = 1;
	// 	foreach ($this->data['students_gs_data'] as $student) {

	// 	$title_width = 7;
	// 	$title_height = 12;

	// 	$pdf->SetXY($rptheading_X,$rptheading_Y);
	// 	$pdf->Cell($title_width,$title_height,$count,1,1,'C');

	// 	$rptheading_X = $rptheading_X + $title_width;
	// 	$title_width = 50;

	// 	$pdf->SetXY($rptheading_X,$rptheading_Y);
	// 	$pdf->Cell($title_width,$title_height,$student->abridged_name,1,1,'L');

	// 	$rptheading_X = $rptheading_X+$title_width;
	// 	$title_width = 11;

	// 	foreach ($this->data['assessment_titles'] as $data) {

	// 		if($data->this_order == 2){
	// 		for($i = 0 ; $i < 3;$i++){
	// 			$pdf->Setxy($rptheading_X,$rptheading_Y);
	// 			$pdf->Cell($title_width,$title_height,'',1,1,'L');
	// 			$rptheading_X = $rptheading_X + $title_width;
	// 			}
	// 		}
			
	// 	}

	// 	$pdf->SetXY($rptheading_X,$rptheading_Y);
	// 	$pdf->Cell(20,$title_height,'',1,1,'L');

	// 	$rptheading_X = 10;
	// 	$rptheading_Y = $rptheading_Y+$title_height;
	// 	$count++;

			
	// 	}



	// 	// $pdf->SetFillColor(255,255,255);
	// 	// $pdf->RotatedCell($assessment_X+$i,$assessment_Y,50,7,'Total (100)',1,0,'R',270,1);
	// 	// $pdf->RotatedCell($assessment_X+$i+7,$assessment_Y,50,7,'Percentage',1,0,'R',270,1);
	// 	// $pdf->RotatedCell($assessment_X+$i+14,$assessment_Y,50,7,'Rank',1,0,'R',270,1);
	// 	// $pdf->RotatedCell($assessment_X+$i+21,$assessment_Y,50,7,'Grades',1,0,'R',270,1);
	// 	// $pdf->SetFont($font_name,'B',$font_size);
	// 	// $pdf->SetXY($assessment_X+$i+21,$student_Y-$student_CH);
	// 	// $pdf->Cell(30,$student_CH,'Student Name',1,0,'L');



 //    	$pdf->Output('Assessment_Report' . '.pdf', 'I');   

	   

	// }



	// public function get_formative_framework_report(){
	// 	$user_id = $this->input->get("user_id");
 //        $role_id = $this->input->get("role_id");
 //        $sectionID = $this->input->get("sectionID");
 //        $gradeID = $this->input->get("gradeID");
 //        $optional = $this->input->get("optional");
        
 //        $prgmID = $this->input->get("prgmID");
 //        $gpp_id = $this->input->get("gpp_id");
 //        $academic = $this->input->get("academic");
 //        $term = $this->input->get("term");
 //        $subjectID = $this->input->get("subjectID");

 //        //var_dump($this->input->get());



 //        $this->load->model('atif_sp/assessment_report_model');
 //        $GroupID = 0;
 //        $BlockID = 0;



 //        /**************************** Assessment Titles 
 //        /***********************************************/
 //        $this->data['assessment_titles'] = $this->assessment_report_model->get_grade_subject_assessments($gradeID, $subjectID, $role_id, $term);
 //        /******************************** Students Data 
 //        /***********************************************/
 //        if($optional == 0){
 //        	$this->data['students_gs_data'] = $this->assessment_report_model->get_students_grade_section($gradeID, $sectionID);
 //        }else{
 //        	$GroupID = substr(substr($gpp_id, -3), 0, 1);
 //        	if($GroupID == 'A'){$GroupID=1;}else
 //        	if($GroupID == 'B'){$GroupID=2;}else
 //        	if($GroupID == 'C'){$GroupID=3;}else
 //        	if($GroupID == 'D'){$GroupID=4;}else
 //        	if($GroupID == 'E'){$GroupID=5;}else
 //        	if($GroupID == 'F'){$GroupID=6;}

 //        	$BlockID = substr($gpp_id, -1);

 //        	$this->data['students_gs_data'] = $this->assessment_report_model->get_students_grade_optional_group_block($gradeID, $subjectID, $GroupID, $BlockID);
 //        }
 //        /***************************** Assessment Marks
 //        /***********************************************/
 //        if($optional == 0){
	//         $this->data['assessment_marks'] = $this->assessment_report_model->get_grade_subject_assessments_marks($gradeID, $sectionID, $subjectID, $role_id, $term);
	//     }else{
	//     	$this->data['assessment_marks'] = $this->assessment_report_model->get_grade_subject_optional_assessments_marks($gradeID, $subjectID, $GroupID, $BlockID, $role_id, $term);
	//     }

 //        /******************* Assessment Aggregate Marks 
 //        /***********************************************/
 //        if($optional == 0){
	//         $this->data['assessment_agg_marks'] = $this->assessment_report_model->get_grade_subject_assessments_aggMarks($gradeID, $sectionID, $subjectID, $role_id, $term);

	//     }else{
	//     	$this->data['assessment_agg_marks'] = $this->assessment_report_model->get_grade_subject_optional_assessments_aggMarks($gradeID, $subjectID, $GroupID, $BlockID, $role_id, $term);
	//     }

	//     $select_grade = $this->assessment_report_model->get_grade($academic,$prgmID);




	//     $noOfStudents = sizeof($this->data['students_gs_data']);
 //    	$noOfAssessments = sizeof($this->data['assessment_titles']);
    	




 //     	// Overall Font Size
	// 	$font_size = 8;
	// 	$font_name = 'Helvetica'; //Helvetica
	// 	$gender_mark_size = 26;
	// 	$now_date = date('d-M-Y');
	// 	$border = 1;

	



	// 	require_once('components/pdf/fpdf/fpdf_rotate.php');
	// 	require_once('components/pdf/fpdi/fpdi.php');

		


		
	// 	// initiate FPDI
	// 	// if($noOfAssessments <= 27){
	// 	// 	$pdf = new PDF('L', 'mm', 'A4');
	// 	// }
	// 	// if($noOfAssessments > 27 and $noOfAssessments <= 30){
	// 	// 	//$pdf = new PDF('L', 'mm', 'A3');
	// 	// 	$pdf = new PDF('L','mm',array(270,370));
	// 	// }
	// 	// else if($noOfAssessments  > 30 and $noOfAssessments <= 33)
	// 	// {
	// 	// 	$pdf = new PDF('L','mm',array(300,400));
	// 	// }
	// 	// else if($noOfAssessments > 33 and $noOfAssessments <= 36)
	// 	// {
	// 	// 	$pdf = new PDF('L','mm',array(350,450));

	// 	// }
	// 	// else if ($noOfAssessments > 36 and $noOfAssessments <= 39){
			
	// 	// 	$pdf = new PDF('L','mm',array(400,500));

	// 	// }
	// 	// else if($noOfAssessments > 39 and $noOfAssessments <=42)
	// 	// {
	// 	// 	$pdf = new PDF('L','mm',array(450,550));
	// 	// }else{
	// 	// 	$pdf = new PDF('L','mm', 'A3');
	// 	// }

	// 	$pdf = new PDF('L','mm',array(500,600));

	// 	$pdf->AddPage();
	// 	$pdf->SetFont($font_name,'',$font_size);
	// 	$i = 0;



	// 	$borderon = 0;
		
	// 	$rptheading_CW = 65;
	// 	$rptheading_CH = 10;

	// 	$rptheading_X = ($pdf->w-($rptheading_CW))/2;
	// 	$rptheading_Y = 7;
		
		
	// 	if(empty($this->data['assessment_marks'][0]->subject_name)){
	// 		$subject_name = '';
	// 	}else{
	// 		$subject_name = $this->data['assessment_marks'][0]->subject_name;
	// 	}
		



	// 	$assessment_X = 81;
	// 	$assessment_Y = 7;

	// 	$student_X = 7;
	// 	$student_Y = 57;
	// 	$student_CH = 4;



	// 	/**************************************************** Report Heading
	// 	*********************************************************************/
	// 	$pdf->AddFont('CooperBT-Black','','CooperBlackBT.php');

	// 	$heading_font_name = 'CooperBT-Black';
	// 	$heading_font_size = 18;
	// 	$pdf->SetFont($heading_font_name,'',$heading_font_size+2);
 //    	$pdf->SetXY($rptheading_X,$rptheading_Y);
 //    	$pdf->Cell($rptheading_CW,$rptheading_CH,"Generation's School",$borderon,2,'C', 0);
    	
    	
    	
	// 	$heading_font_size = 12;
	// 	$pdf->SetFont($heading_font_name,'',$heading_font_size);
 //    	$pdf->Cell($rptheading_CW,$rptheading_CH,"Formative Frame Work",$borderon,2,'C',0);
 //    	$pdf->Cell($rptheading_CW,$rptheading_CH,$gpp_id,$borderon,2,'C',0);
 //    	// $pdf->Cell($rptheading_CW,$rptheading_CH-6,$subject_name,$borderon,2,'L');

    	

	// 	/*************************************************** Assessment Titles
	// 	***********************************************************************/




	// 	/*************************************************** Assessment Titles
	// 	***********************************************************************/

	// 	$rptheading_X = 5;
	// 	$rptheading_Y = $rptheading_Y + ($rptheading_CH * 5) ;

	// 	$heading_font_name = 'Helvetica';
	// 	$heading_font_size = 14;
	// 	$pdf->SetFont($heading_font_name,'',$heading_font_size);

	// 	$title_height = 20;
	// 	$title_width = 7;




	// 	$pdf->SetXY($rptheading_X,$rptheading_Y);
	// 	$pdf->Cell($title_width,$title_height,'S#',1,0,'C');

	// 	$rptheading_X = $rptheading_X+$title_width;
	// 	$title_width = 50;
	// 	$pdf->SetXY($rptheading_X,$rptheading_Y);
	// 	$pdf->Cell($title_width,$title_height,'Student Name',1,0,'C');

	// 	$rptheading_X = $rptheading_X+$title_width;
	// 	$i = 0;
	// 	$rptheading_X_new = 0;

	// 	foreach ($this->data['assessment_titles'] as $data) {

	// 		// $lastx = 0;
	// 		// $lasty = 0;

	// 		$col = $data->full_name;

	// 	   	// $pdf->Cell($X,$Y,,$border);

	// 		if($data->this_order == 2){
	// 			// Fill Grey
	// 			//$textw = strlen($col);
	// 			// var_dump($textw);

	// 			// if($textw > 14 && $textw <=30){
	// 			// 	$heading_font_name = 'Helvetica';
	// 			// 	$heading_font_size = 7;
	// 			// 	$pdf->SetFont($heading_font_name,'',$heading_font_size);

	// 			// }else if($textw > 30){
	// 			// 	$heading_font_name = 'Helvetica';
	// 			// 	$heading_font_size = 6;
	// 			// 	$pdf->SetFont($heading_font_name,'',$heading_font_size);
	// 			// }
	// 			// else if($textw <= 14){
	// 			// 	$heading_font_name = 'Helvetica';
	// 			// 	$heading_font_size = 8;
	// 			// 	$pdf->SetFont($heading_font_name,'',$heading_font_size);
	// 			// }
	// 			//var_dump($textw);

	// 			//$pdf->SetFillColor(175,175,175);
	// 			$this_font_size = 0;
	// 	    	$decrement_step = 0.5;
		    	
	// 	    	$line_width = 42;
	// 	    	$this_font_size = $heading_font_size;

	// 	    	$heading_font_name = 'Helvetica';
	// 			$heading_font_size = 15;
	// 			$pdf->SetFont($heading_font_name,'',$heading_font_size);

	
	// 			while($pdf->GetStringWidth($col) > $line_width) {
	// 					$this_font_size -= $decrement_step;
	// 					$pdf->SetFont($font_name,'',$this_font_size);
	// 			}
			



	// 			$pdf->SetXY($rptheading_X + $i,$rptheading_Y);
	// 			$pdf->Cell($line_width,20,$col,1, 1,'C', 0);
				
	// 			$i += $line_width;
	// 			$rptheading_X_new = $rptheading_X+$i;
				
	// 		}



	// 	}

	// 	$heading_font_name = 'Helvetica';
	// 	$heading_font_size = 10;
	// 	$pdf->SetFont($heading_font_name,'',$heading_font_size);


	// 	$pdf->SetXY($rptheading_X_new,$rptheading_Y);
	// 	$pdf->Cell(20,$title_height,'Formative',1,1,'C');

	// 	$heading_font_name = 'Helvetica';
	// 	$heading_font_size = 12;
	// 	$pdf->SetFont($heading_font_name,'',$heading_font_size);

	// 	//========== New Line of Topic ====================//	

	// 	$rptheading_X = 5;
	// 	$rptheading_Y = $rptheading_Y+20;

	// 	$title_width = 7;
	// 	$title_height = 18;

	// 	$pdf->SetXY($rptheading_X,$rptheading_Y);
	// 	$pdf->Cell($title_width,$title_height,'',1,1,'C');

	// 	$rptheading_X = $rptheading_X+$title_width;
	// 	$title_width = 50;

	// 	$pdf->SetXY($rptheading_X,$rptheading_Y);
	// 	$pdf->Cell($title_width,$title_height,'Topic',1,1,'L');

	// 	$rptheading_X = $rptheading_X+$title_width;

	// 	$title_width = 14;
	// 	foreach($this->data['assessment_titles'] as $data){


	// 		if($data->this_order == 2){
	// 		for($i = 0 ; $i < 3;$i++){
	// 			$pdf->Setxy($rptheading_X,$rptheading_Y);
	// 			$pdf->Cell($title_width,$title_height,'',1,1,'L');
	// 			$rptheading_X = $rptheading_X + $title_width;
	// 		}
	// 		}

	// 	}

	// 	$pdf->SetXY($rptheading_X,$rptheading_Y);
	// 	$pdf->Cell(20,$title_height,'',1,1,'L');

	// 	//==================== Marks =================//

	// 	$rptheading_Y = $rptheading_Y + $title_height;
	// 	$rptheading_X = 5;

	// 	$title_width = 7;
	// 	$title_height = 12;

	// 	$pdf->SetXY($rptheading_X,$rptheading_Y);
	// 	$pdf->Cell($title_width,$title_height,'',1,1,'C');

	// 	$rptheading_X = $rptheading_X + $title_width;
	// 	$title_width = 50;

	// 	$pdf->SetXY($rptheading_X,$rptheading_Y);
	// 	$pdf->Cell($title_width,$title_height,'Marks',1,1,'L');

	// 	$rptheading_X = $rptheading_X+$title_width;

	// 	$title_width = 14;
	// 	foreach($this->data['assessment_titles'] as $data){

	// 		if($data->this_order == 2){
	// 		for($i = 0 ; $i < 3;$i++){
	// 			$pdf->Setxy($rptheading_X,$rptheading_Y);
	// 			$pdf->Cell($title_width,$title_height,'',1,1,'L');
	// 			$rptheading_X = $rptheading_X + $title_width;
	// 			}
	// 		}

	// 	}

	// 	$pdf->SetXY($rptheading_X,$rptheading_Y);
	// 	$pdf->Cell(20,$title_height,'',1,1,'L');

	// //========================Marks End =====================//

	// //=========================Dates=========================//

	// 	$rptheading_Y = $rptheading_Y + $title_height;
	// 	$rptheading_X = 5;

	// 	$title_width = 7;
	// 	$title_height = 12;

	// 	$pdf->SetXY($rptheading_X,$rptheading_Y);
	// 	$pdf->Cell($title_width,$title_height,'',1,1,'C');

	// 	$rptheading_X = $rptheading_X + $title_width;
	// 	$title_width = 50;

	// 	$pdf->SetXY($rptheading_X,$rptheading_Y);
	// 	$pdf->Cell($title_width,$title_height,'Dates',1,1,'L');

	// 	$rptheading_X = $rptheading_X+$title_width;

	// 	$title_width = 14;
	// 	foreach($this->data['assessment_titles'] as $data){

	// 		if($data->this_order == 2){
	// 		for($i = 0 ; $i < 3;$i++){
	// 			$pdf->Setxy($rptheading_X,$rptheading_Y);
	// 			$pdf->Cell($title_width,$title_height,'',1,1,'L');
	// 			$rptheading_X = $rptheading_X + $title_width;
	// 			}
	// 		}

	// 	}
	// 	$pdf->SetXY($rptheading_X,$rptheading_Y);
	// 	$pdf->Cell(20,$title_height,'',1,1,'L');



	// //===============Dates End ==============================//


	// //================== Student Names =========================//

	// 	$rptheading_Y = $rptheading_Y + $title_height;
	// 	$rptheading_X = 5;



	// 	$count = 1;
	// 	foreach ($this->data['students_gs_data'] as $student) {

	// 	$title_width = 7;
	// 	$title_height = 12;

	// 	$pdf->SetXY($rptheading_X,$rptheading_Y);
	// 	$pdf->Cell($title_width,$title_height,$count,1,1,'C');

	// 	$rptheading_X = $rptheading_X + $title_width;
	// 	$title_width = 50;

	// 	$pdf->SetXY($rptheading_X,$rptheading_Y);
	// 	$pdf->Cell($title_width,$title_height,$student->abridged_name,1,1,'L');

	// 	$rptheading_X = $rptheading_X+$title_width;
	// 	$title_width = 14;

	// 	foreach ($this->data['assessment_titles'] as $data) {

	// 		if($data->this_order == 2){
	// 		for($i = 0 ; $i < 3;$i++){
	// 			$pdf->Setxy($rptheading_X,$rptheading_Y);
	// 			$pdf->Cell($title_width,$title_height,'',1,1,'L');
	// 			$rptheading_X = $rptheading_X + $title_width;
	// 			}
	// 		}
			
	// 	}

	// 	$pdf->SetXY($rptheading_X,$rptheading_Y);
	// 	$pdf->Cell(20,$title_height,'',1,1,'L');

	// 	$rptheading_X = 5;
	// 	$rptheading_Y = $rptheading_Y+$title_height;
	// 	$count++;

			
	// 	}



	// 	// $pdf->SetFillColor(255,255,255);
	// 	// $pdf->RotatedCell($assessment_X+$i,$assessment_Y,50,7,'Total (100)',1,0,'R',270,1);
	// 	// $pdf->RotatedCell($assessment_X+$i+7,$assessment_Y,50,7,'Percentage',1,0,'R',270,1);
	// 	// $pdf->RotatedCell($assessment_X+$i+14,$assessment_Y,50,7,'Rank',1,0,'R',270,1);
	// 	// $pdf->RotatedCell($assessment_X+$i+21,$assessment_Y,50,7,'Grades',1,0,'R',270,1);
	// 	// $pdf->SetFont($font_name,'B',$font_size);
	// 	// $pdf->SetXY($assessment_X+$i+21,$student_Y-$student_CH);
	// 	// $pdf->Cell(30,$student_CH,'Student Name',1,0,'L');



 //    	$pdf->Output('Assessment_Report' . '.pdf', 'I');   

	   

	// }

	public function getThisSummativeFramework(){
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
			<iframe src="'.site_url().'/etab_reports/formative_framework/get_summative_framework_report?'.$helper.'" frameborder="0">
			</iframe>
		</div>';

		
    	echo $html;
	}

	public function get_summative_framework_report(){

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

        //var_dump($this->input->get());



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

        // var_dump($this->data['students_gs_data']);
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
		// if($noOfAssessments <= 27){
			$pdf = new PDF('L', 'mm', 'A4');
		// }
		// if($noOfAssessments > 27 and $noOfAssessments <= 30){
		// 	//$pdf = new PDF('L', 'mm', 'A3');
			//$pdf = new PDF('L','mm',array(270,370));
		// }
		// else if($noOfAssessments  > 30 and $noOfAssessments <= 33)
		// {
			//$pdf = new PDF('L','mm',array(300,400));
		// }
		// else if($noOfAssessments > 33 and $noOfAssessments <= 36)
		// {
		// 	$pdf = new PDF('L','mm',array(350,450));

		// }
		// else if ($noOfAssessments > 36 and $noOfAssessments <= 39){
			
		// 	$pdf = new PDF('L','mm',array(400,500));

		// }
		// else if($noOfAssessments > 39 and $noOfAssessments <=42)
		// {
		// 	$pdf = new PDF('L','mm',array(450,550));
		// }else{
		// 	$pdf = new PDF('L','mm', 'A3');
		// }

		// $pdf = new PDF('L','mm',array(500,600));

		$pdf->AddPage();
		$pdf->SetFont($font_name,'',$font_size);
		$i = 0;



		$borderon = 0;
		
		$rptheading_CW = 40;
		$rptheading_CH = 10;

		$rptheading_X = 1;
		$rptheading_Y = 5;
		
		
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
		$heading_font_size = 10;
		$pdf->SetFont($heading_font_name,'',$heading_font_size);
    	$pdf->SetXY($rptheading_X,$rptheading_Y);
    	$pdf->Cell($rptheading_CW,$rptheading_CH,"Generation's School",0,'L', 0);

    	
    	$heading_font_name = 'Helvetica';
		$heading_font_size = 5;
		$pdf->SetFont($heading_font_name,'',$heading_font_size);

		$rptheading_X = 1;
		$rptheading_Y = $rptheading_Y+$rptheading_CH-5;
 
    	$pdf->SetXY($rptheading_X,$rptheading_Y);
    	$pdf->Cell($rptheading_CW+1,$rptheading_CH,"SUMMATIVE(UNIT AND TERM ASSESSMENTS)",0,'L', 0);

  //   	$heading_font_size = 8;
  //   	$pdf->SetFont($heading_font_name,'',$heading_font_size);

  //   	$pdf->Cell($rptheading_CW,$rptheading_CH,"SUMMATIVE (UNIT AND TERM ASSESSMENTS)  TERM II",$borderon,2,'C',0);
  //   	$pdf->Cell($rptheading_CW,$rptheading_CH,$gpp_id,$borderon,2,'C',0);
    	$rptheading_X = 1;
		$rptheading_Y = $rptheading_Y+$rptheading_CH-5;
		$pdf->SetXY($rptheading_X,$rptheading_Y);
    	$pdf->Cell($rptheading_CW+1,$rptheading_CH,$gpp_id,0,'C');

    	$x_axis = 45;
    	$y_axis = 8;

    	$heading_font_name = 'Helvetica';
		$heading_font_size = 8;
		$pdf->SetFont($heading_font_name,'',$heading_font_size);

		
		$title_height = 15;
		$title_width = 10;

		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'S#',1,0,'C');

		$x_axis = $x_axis + $title_width;

		$title_width = 40;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'Student Name',1,0,'C');

		// Unit Assessment

		$x_axis_new = $x_axis + $title_width;
		$x_axis = $x_axis + $title_width;
		$title_height_one = 5;

		$pdf->SetXY($x_axis_new,$y_axis);
		$pdf->Cell($title_width,$title_height_one,'Unit Assessments','T',0,'C');

		$title_width = $title_width/2;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'Paper-I','B',0,'L');

		$x_axis = $x_axis+$title_width;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'Paper-II','R,B',0,'R');

		// Total Unit Assessment

		$x_axis = $x_axis + $title_width;
		$title_width = 12;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'Total',1,0,'C');

		$x_axis = $x_axis + $title_width;
		$title_width = 12;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'%',1,0,'C');

		$x_axis = $x_axis + $title_width;
		$title_width = 12;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'Grade',1,0,'C');

		//========= Term Assessment ==================//

		$x_axis_new = $x_axis+$title_width;
		$title_height_one = 5;
		$x_axis = $x_axis + $title_width;
		$title_width = 40;

		$pdf->SetXY($x_axis_new,$y_axis);
		$pdf->Cell($title_width,$title_height_one,'Term Assessment','T',0,'C');

		$title_width = $title_width/2;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'Paper-I','B',0,'L');

		$x_axis = $x_axis+$title_width;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'Paper-II','R,B',0,'R');

		$x_axis = $x_axis + $title_width;
		$title_width = 12;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'Total',1,0,'C');

		$x_axis = $x_axis + $title_width;
		$title_width = 12;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'%',1,0,'C');

		$x_axis = $x_axis + $title_width;
		$title_width = 12;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'Grade',1,0,'C');

		$x_axis = $x_axis + $title_width;
		$title_width = 12;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'',1,0,'C');


		//===================Topic=======================//
		//==============================================//
		$x_axis = 45;
		$y_axis = $y_axis + $title_height;

		$title_height = 6;
		$title_width = 10;


		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'',1,0,'C');

		
		$x_axis = $x_axis+$title_width;
		$title_width = 40; 
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'Topic',1,0,'L');

		$x_axis = $x_axis+$title_width;
		$title_width = $title_width/2;

		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'',1,0,'');

		$x_axis = $x_axis+$title_width;
		$title_width = $title_width;

		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'',1,0,'');

		$x_axis = $x_axis + $title_width;
		$title_width = 12;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'',1,0,'C');

		$x_axis = $x_axis + $title_width;
		$title_width = 12;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'',1,0,'C');

		$x_axis = $x_axis + $title_width;
		$title_width = 12;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'',1,0,'C');

		$x_axis_new = $x_axis+$title_width;
		$title_height_one = 5;
		$x_axis = $x_axis + $title_width;
		$title_width = 40;

		

		$title_width = $title_width/2;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'',1,0,'L');

		$x_axis = $x_axis+$title_width;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'',1,0,'R');

		$x_axis = $x_axis + $title_width;
		$title_width = 12;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'',1,0,'C');

		$x_axis = $x_axis + $title_width;
		$title_width = 12;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'',1,0,'C');

		$x_axis = $x_axis + $title_width;
		$title_width = 12;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'',1,0,'C');

		$x_axis = $x_axis + $title_width;
		$title_width = 12;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'',1,0,'C');

		//===================Marks=======================//
		//==============================================//

		$x_axis = 45;
		$y_axis = $y_axis + $title_height;
		$title_height = 6;
		$title_width = 10;


		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'',1,0,'C');

		$x_axis = $x_axis+$title_width;
		$title_width = 40; 
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'Max Marks',1,0,'L');

		$x_axis = $x_axis+$title_width;
		$title_width = $title_width/2;

		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'',1,0,'');

		$x_axis = $x_axis+$title_width;
		$title_width = $title_width;

		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'',1,0,'');

		$x_axis = $x_axis + $title_width;
		$title_width = 12;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'',1,0,'C');

		$x_axis = $x_axis + $title_width;
		$title_width = 12;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'',1,0,'C');

		$x_axis = $x_axis + $title_width;
		$title_width = 12;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'',1,0,'C');

		$x_axis_new = $x_axis+$title_width;
		$title_height_one = 5;
		$x_axis = $x_axis + $title_width;
		$title_width = 40;

		

		$title_width = $title_width/2;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'',1,0,'L');

		$x_axis = $x_axis+$title_width;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'',1,0,'R');

		$x_axis = $x_axis + $title_width;
		$title_width = 12;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'',1,0,'C');

		$x_axis = $x_axis + $title_width;
		$title_width = 12;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'',1,0,'C');

		$x_axis = $x_axis + $title_width;
		$title_width = 12;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'',1,0,'C');

		$x_axis = $x_axis + $title_width;
		$title_width = 12;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'',1,0,'C');


		//===================Dates=======================//
		//==============================================//

		$x_axis = 45;
		$y_axis = $y_axis + $title_height;
		$title_height = 6;
		$title_width = 10;


		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'',1,0,'C');

		$x_axis = $x_axis+$title_width;
		$title_width = 40; 
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'Dates',1,0,'L');

		$x_axis = $x_axis+$title_width;
		$title_width = $title_width/2;

		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'',1,0,'');

		$x_axis = $x_axis+$title_width;
		$title_width = $title_width;

		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'',1,0,'');

		$x_axis = $x_axis + $title_width;
		$title_width = 12;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'',1,0,'C');

		$x_axis = $x_axis + $title_width;
		$title_width = 12;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'',1,0,'C');

		$x_axis = $x_axis + $title_width;
		$title_width = 12;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'',1,0,'C');

		$x_axis_new = $x_axis+$title_width;
		$title_height_one = 5;
		$x_axis = $x_axis + $title_width;
		$title_width = 40;

		

		$title_width = $title_width/2;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'',1,0,'L');

		$x_axis = $x_axis+$title_width;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'',1,0,'R');

		$x_axis = $x_axis + $title_width;
		$title_width = 12;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'',1,0,'C');

		$x_axis = $x_axis + $title_width;
		$title_width = 12;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'',1,0,'C');

		$x_axis = $x_axis + $title_width;
		$title_width = 12;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'',1,0,'C');

		$x_axis = $x_axis + $title_width;
		$title_width = 12;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'',1,0,'C');

		// ====================Student Name =====================// 
		// =====================================================//

		$count = 1;

		foreach($this->data['students_gs_data'] as $data){

		$x_axis = 45;
		$y_axis = $y_axis + $title_height;
		$title_height = 5;
		$title_width = 10;

		if(!empty($data->section_name)){
			$section_name = $data->section_name;
			$grade_section = $data->grade_name.'-'.$section_name;

		}else{
			$section_name = '';
			$grade_section = $data->grade_name;
		}



		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,$count,1,0,'C');

		$x_axis = $x_axis+$title_width;
		$title_width = 40; 
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,$data->abridged_name,1,0,'L');

		$x_axis = $x_axis+$title_width;
		$title_width = $title_width/2;

		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'',1,0,'');

		$x_axis = $x_axis+$title_width;
		$title_width = $title_width;

		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'',1,0,'');

		$x_axis = $x_axis + $title_width;
		$title_width = 12;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'',1,0,'C');

		$x_axis = $x_axis + $title_width;
		$title_width = 12;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'',1,0,'C');

		$x_axis = $x_axis + $title_width;
		$title_width = 12;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'',1,0,'C');

		$x_axis_new = $x_axis+$title_width;
		$title_height_one = 5;
		$x_axis = $x_axis + $title_width;
		$title_width = 40;

		

		$title_width = $title_width/2;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'',1,0,'L');

		$x_axis = $x_axis+$title_width;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'',1,0,'R');

		$x_axis = $x_axis + $title_width;
		$title_width = 12;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'',1,0,'C');

		$x_axis = $x_axis + $title_width;
		$title_width = 12;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'',1,0,'C');

		$x_axis = $x_axis + $title_width;
		$title_width = 12;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'',1,0,'C');

		$x_axis = $x_axis + $title_width;
		$title_width = 12;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($title_width,$title_height,'',1,0,'C');

		$count++;

		}

		$pdf->SetXY(232,3);
		$pdf->Cell(16,5,'class '.$grade_section,0,'L');

		$page_height = $pdf->h;


		$this->load->model('staff/staff_registered_model');
		$this->data['staff_registered_data'] = $this->staff_registered_model->get_by(array('user_id' => (int)$this->session->userdata('user_id')));
		$pdf->SetFillColor(0,0,0);
		$pdf->SetTextColor(255,255,255);
    	$pdf->SetXY(7,$page_height-25);
    	$pdf->Cell(60, 4, date('D-d-M-Y H:i') . ' (' . ucwords($this->data['staff_registered_data'][0]->abridged_name) . ')', 1, 0, 'L', 1);


    	$pdf->Output('Assessment_Report' . '.pdf', 'I');


	}

	public function getThisUpdatedFramework(){

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
			<iframe src="'.site_url().'/etab_reports/formative_framework/get_updated_formative_framework_report?'.$helper.'" frameborder="0">
			</iframe>
		</div>';

		
    	echo $html;

	}


	public function get_updated_formative_framework_report(){
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

        //var_dump($this->input->get());



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

	    $select_grade = $this->assessment_report_model->get_grade($academic,$prgmID);




	    $noOfStudents = sizeof($this->data['students_gs_data']);
    	$noOfAssessments = sizeof($this->data['assessment_titles']);
    	




     	// Overall Font Size
		

	



		require_once('components/pdf/fpdf/fpdf_rotate.php');
		require_once('components/pdf/fpdi/fpdi.php');

		


		
		// initiate FPDI
		// if($noOfAssessments <= 27){
		 	$pdf = new PDF('L', 'mm', 'A4');
		// }
		// if($noOfAssessments > 27 and $noOfAssessments <= 30){
		// 	//$pdf = new PDF('L', 'mm', 'A3');
		// 	$pdf = new PDF('L','mm',array(270,370));
		// }
		// else if($noOfAssessments  > 30 and $noOfAssessments <= 33)
		// {
		// 	$pdf = new PDF('L','mm',array(300,400));
		// }
		// else if($noOfAssessments > 33 and $noOfAssessments <= 36)
		// {
		// 	$pdf = new PDF('L','mm',array(350,450));

		// }
		// else if ($noOfAssessments > 36 and $noOfAssessments <= 39){
			
		// 	$pdf = new PDF('L','mm',array(400,500));

		// }
		// else if($noOfAssessments > 39 and $noOfAssessments <=42)
		// {
		// 	$pdf = new PDF('L','mm',array(450,550));
		// }else{
		// 	$pdf = new PDF('L','mm', 'A3');
		// }

		//$pdf = new PDF('L','mm',array(500,600));

		$pdf->AddPage();
		
		$i = 0;


		$pdf->AddFont('CooperBT-Black','','CooperBlackBT.php');

		$heading_font_name = 'CooperBT-Black';
		$heading_font_size = 14;
		$pdf->SetFont($heading_font_name,'',$heading_font_size);
    	$pdf->SetXY(140,1);
    	$pdf->Cell(40,9,"Generation's School",0,'L', 0);

    	$heading_font_name = 'Helvetica';
		$heading_font_size = 6;
		$pdf->SetFont($heading_font_name,'',$heading_font_size);
		$pdf->SetXY(1,5);
    	$pdf->Cell(60,5,"Formative Frame Work,Term I",0,'L');

    	$heading_font_name = 'Helvetica';
		$heading_font_size = 6;
		$pdf->SetFont($heading_font_name,'',$heading_font_size);
		$pdf->SetXY(275,5);
    	$pdf->Cell(60,5,$gpp_id,0,'L');

		
		
		$font_size = 6;
		$font_name = 'Helvetica'; //Helvetica
		$gender_mark_size = 26;
		$now_date = date('d-M-Y');
		$border = 1;
		$pdf->SetFont($font_name,'',$font_size);
		
		
		if(empty($this->data['assessment_marks'][0]->subject_name)){
			$subject_name = '';
		}else{
			$subject_name = $this->data['assessment_marks'][0]->subject_name;
		}

		$x_axis = 1;
		$y_axis = 10;
		$cell_width = 10;
		$cell_height = 15;

		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($cell_width,$cell_height,'SNO#',1,0,'C');

		$x_axis = $x_axis+$cell_width;
		$cell_width = 25;

		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($cell_width,$cell_height,'StudentName',1,0,'C');

		foreach ($this->data['assessment_titles'] as $data) {

			$font_size = 6;
			$font_name = 'Helvetica';
			$pdf->SetFont($font_name,'',$font_size); 

			if($data->this_order == 2){
				$assessment_name = $data->assessment_name;
				$assessment_weightage = $data->assessment_weightage;

					$x_axis = $x_axis+$cell_width;
					$y_axis = 10;
					$cell_width = 21;
					for($i = 0; $i < 2 ; $i++){
						if($i == 0){
						if(strlen($assessment_name) > 18){
							$assessment_name_array = explode(" ",$assessment_name);
							for($j = 0 ; $j < sizeof($assessment_name_array);$j++){

								$x_axis_new = $x_axis;
								$y_axis_assessment = $y_axis;

								if($j == 0){
								$pdf->SetXY($x_axis_new,$y_axis_assessment);
								$pdf->Cell($cell_width,3,$assessment_name_array[$j],'T,L,R',0,'C');
								}

								if($j==1){
								$pdf->SetXY($x_axis_new,$y_axis_assessment);
								$pdf->Cell($cell_width,8,$assessment_name_array[$j],'L,R',0,'C');
								}

								if($j==2){
								$pdf->SetXY($x_axis_new,$y_axis_assessment);
								$pdf->Cell($cell_width,12,$assessment_name_array[$j],'L,R',0,'C');
								}	

							}
						}
						else{
							$pdf->SetXY($x_axis,$y_axis);
							$pdf->Cell($cell_width,8,$assessment_name,1,0,'C');
						}	
						}
						else{
						$y_axis_new = 18;
						$pdf->SetXY($x_axis,$y_axis_new);
						$pdf->Cell($cell_width,7,$assessment_weightage.'%',1,0,'C');
						}
						
				}

			}
			//var_dump($data);
		}


		$font_size = 4;
		$font_name = 'Helvetica';
		$pdf->SetFont($font_name,'',$font_size);

		$x_axis = $x_axis + $cell_width;
		$cell_width = 8;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($cell_width,$cell_height,'Formative',1,0,'C');


		//===============================Topic====================================//
		//========================================================================//

		$font_size = 6;
		$font_name = 'Helvetica';
		$pdf->SetFont($font_name,'',$font_size);
		
		$x_axis = 1;
		$y_axis = $y_axis+$cell_height;

		$cell_width = 10;
		$cell_height = 7;

		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($cell_width,$cell_height,'',1,0,'C');

		$x_axis = $x_axis+$cell_width;
		$cell_width = 25;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($cell_width,$cell_height,'Topic',1,0,'L');

		$x_axis = $x_axis+$cell_width;

		$cell_width = 7;
		foreach($this->data['assessment_titles'] as $data){

			if($data->this_order == 2){
			for($i = 0 ; $i < 3;$i++){
				$pdf->Setxy($x_axis,$y_axis);
				$pdf->Cell($cell_width,$cell_height,'',1,0,'L');
				$x_axis = $x_axis + $cell_width;
			}
			}

		}

		$cell_width = 8;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($cell_width,$cell_height,'',1,0,'L');

		//===================Marks=============================//
		//====================================================//

		$y_axis = $y_axis + $cell_height;
		$x_axis = 1;

		$cell_width = 10;
		$cell_height = 7;

		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($cell_width,$cell_height,'',1,0,'C');

		$x_axis = $x_axis+$cell_width;
		$cell_width = 25;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($cell_width,$cell_height,'Marks',1,0,'L');

		$x_axis = $x_axis+$cell_width;

		$cell_width = 7;
		foreach($this->data['assessment_titles'] as $data){

			if($data->this_order == 2){
			for($i = 0 ; $i < 3;$i++){
				$pdf->Setxy($x_axis,$y_axis);
				$pdf->Cell($cell_width,$cell_height,'',1,0,'L');
				$x_axis = $x_axis + $cell_width;
			}
			}

		}

		$cell_width = 8;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($cell_width,$cell_height,'',1,0,'L');

		//======================Dates=====================//
		//===============================================//

		$y_axis = $y_axis + $cell_height;
		$x_axis = 1;

		$cell_width = 10;
		$cell_height = 7;

		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($cell_width,$cell_height,'',1,0,'C');

		$x_axis = $x_axis+$cell_width;
		$cell_width = 25;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($cell_width,$cell_height,'Dates',1,0,'L');

		$x_axis = $x_axis+$cell_width;

		$cell_width = 7;
		foreach($this->data['assessment_titles'] as $data){

			if($data->this_order == 2){
			for($i = 0 ; $i < 3;$i++){
				$pdf->Setxy($x_axis,$y_axis);
				$pdf->Cell($cell_width,$cell_height,'',1,0,'L');
				$x_axis = $x_axis + $cell_width;
			}
			}

		}

		$cell_width = 8;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($cell_width,$cell_height,'',1,0,'L');


		//============================= Student Data ==========================//
		//=====================================================================//
		$count = 1;
		

		foreach($this->data['students_gs_data'] as $student){

			$y_axis = $y_axis+$cell_height;
			$x_axis = 1;

			$cell_width = 10;
			$cell_height = 4.75;

			$pdf->SetXY($x_axis,$y_axis);
			$pdf->Cell($cell_width,$cell_height,$count,1,0,'C');

			$x_axis = $x_axis + $cell_width;
			
			$cell_width = 25;
			$pdf->SetXY($x_axis,$y_axis);
			$pdf->Cell($cell_width,$cell_height,$student->abridged_name,1,0,'L');

			$x_axis = $x_axis+$cell_width;

			$cell_width = 7;
			foreach($this->data['assessment_titles'] as $data){

			if($data->this_order == 2){
			for($i = 0 ; $i < 3;$i++){
				$pdf->Setxy($x_axis,$y_axis);
				$pdf->Cell($cell_width,$cell_height,'',1,0,'L');
				$x_axis = $x_axis + $cell_width;
				}
			}

		}

			$cell_width = 8;
			$pdf->SetXY($x_axis,$y_axis);
			$pdf->Cell($cell_width,$cell_height,'',1,0,'L');

			$count++;	
		}

		$page_height = $pdf->h;


		$this->load->model('staff/staff_registered_model');
		$this->data['staff_registered_data'] = $this->staff_registered_model->get_by(array('user_id' => (int)$this->session->userdata('user_id')));
		$pdf->SetFillColor(0,0,0);
		$pdf->SetTextColor(255,255,255);
    	$pdf->SetXY(7,$page_height-25);
    	$pdf->Cell(60, 4, date('D-d-M-Y H:i') . ' (' . ucwords($this->data['staff_registered_data'][0]->abridged_name) . ')', 1, 0, 'L', 1);





		$pdf->Output('Assessment_Report' . '.pdf', 'I');
	}

	public function getThisSubjectFramework(){

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
			<iframe src="'.site_url().'/etab_reports/formative_framework/get_subject_marksheet_framework_report?'.$helper.'" frameborder="0">
			</iframe>
		</div>';

		
    	echo $html;

	}

	public function get_subject_marksheet_framework_report(){

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

        //var_dump($this->input->get());

        // var_dump($gpp_id);

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

	    $select_grade = $this->assessment_report_model->get_grade($academic,$prgmID);

	    $teacher_name = $this->assessment_report_model->get_class_teacher($academic,$role_id);

	    $subject_teacher = $teacher_name[0]->name;



	    $noOfStudents = sizeof($this->data['students_gs_data']);
    	$noOfAssessments = sizeof($this->data['assessment_titles']);
    	




     	// Overall Font Size
		

	
    	// var_dump($role_id);


		require_once('components/pdf/fpdf/fpdf_rotate.php');
		require_once('components/pdf/fpdi/fpdi.php');

		


		
		// initiate FPDI
		// if($noOfAssessments <= 27){
		 	$pdf = new PDF('P', 'mm', 'A4');
		// }
		// if($noOfAssessments > 27 and $noOfAssessments <= 30){
		// 	//$pdf = new PDF('L', 'mm', 'A3');
		// 	$pdf = new PDF('L','mm',array(270,370));
		// }
		// else if($noOfAssessments  > 30 and $noOfAssessments <= 33)
		// {
		// 	$pdf = new PDF('L','mm',array(300,400));
		// }
		// else if($noOfAssessments > 33 and $noOfAssessments <= 36)
		// {
		// 	$pdf = new PDF('L','mm',array(350,450));

		// }
		// else if ($noOfAssessments > 36 and $noOfAssessments <= 39){
			
		// 	$pdf = new PDF('L','mm',array(400,500));

		// }
		// else if($noOfAssessments > 39 and $noOfAssessments <=42)
		// {
		// 	$pdf = new PDF('L','mm',array(450,550));
		// }else{
		// 	$pdf = new PDF('L','mm', 'A3');
		// }

		//$pdf = new PDF('L','mm',array(500,600));

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

		$pdf->SetXY(85,6);
    	$pdf->Cell(50,9,"Subject Mark Sheet - Formative",0,'L');

    	$pdf->SetXY(98,9);
    	$pdf->Cell(50,9,"A Levels",0,'L');

    	$pdf->SetXY(97,13);
    	$pdf->Cell(50,9,"2016-2017",0,'L');

    	$pdf->SetXY(100,17);
    	$pdf->Cell(50,9,"Term II",0,'L');

    	$pdf->SetFillColor(0,0,0);
		$pdf->SetTextColor(255,255,255);
		$pdf->SetXY(0,24);
		$pdf->Cell(210,5,'Assessment',1,0,'C',1);

		$pdf->SetTextColor(0,0,0);
		$pdf->SetXY(1,30);
		$pdf->Cell(20,6,'Class:',0,'L');

		$grade = explode('-',$gpp_id);
		$grade_name = $grade[0];

		$pdf->SetXY(20,30);
		$pdf->Cell(20,6,$grade_name,0,'L');


		$pdf->SetXY(1,35);
		$pdf->Cell(20,6,'Teacher:',0,'L');

		$pdf->SetXY(20,35);
		$pdf->Cell(20,6,$subject_teacher,0,'L');

		$pdf->SetXY(1,40);
		$pdf->Cell(20,6,'Subject:',0,'L');

		$pdf->SetXY(20,40);
		$pdf->Cell(20,6,$gpp_id,0,'L');

		// var_dump($this->data['assessment_marks']);

		// Header Title of the Report
		$x_axis = 14;
		$y_axis= 50;

		$cell_width = 10;
		$cell_height = 20;

		$font_size = 8;
		$font_name = 'Helvetica';
		$pdf->SetFont($font_name,'',$font_size);

		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($cell_width,$cell_height,'SR.#',1,0,'C');

		// Particular Column

		$x_axis = $x_axis+$cell_width;
		$cell_width = 50;
		$cell_height = 8;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($cell_width,$cell_height,'Particulars',1,'L');

		$y_axis = $y_axis+$cell_height;
		$cell_height = 4;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($cell_width,$cell_height,'Weightage',1,'L');

		$y_axis = $y_axis+$cell_height;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($cell_width,$cell_height,'Date',1,'L');

		$y_axis = $y_axis+$cell_height;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($cell_width,$cell_height,'Name',1,'L');

		
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($cell_width,$cell_height,'Max.Marks',0,0,'C');

		// Class Assessment

		foreach($this->data['assessment_titles'] as $data){

			$col = $data->assessment_name;
			if($data->this_order == 2){

				if($col == 'Class Assessment'){
					$class_assessment_weightage = $data->assessment_weightage;
				}

				if($col == 'Review Assessment'){
					$review_assessment_weightage = $data->assessment_weightage;
				}
			}

		}

		$x_axis = $x_axis+$cell_width;
		$y_axis = 50;
		$cell_width = 50;
		$cell_height = 8;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($cell_width,$cell_height,'Class Assessments',1,0,'C');

		$y_axis = $y_axis+$cell_height;
		$cell_height = 4;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($cell_width,$cell_height,$class_assessment_weightage.'%',1,0,'C');

		$y_axis = $y_axis+$cell_height;
		$cell_height = 4;
		$x_axis_new = $x_axis;
		for($i=0;$i<4;$i++){
			
			$cell_width_new = 12.5;
			$pdf->SetXY($x_axis_new,$y_axis);
			$pdf->Cell($cell_width_new,$cell_height,'',1,0,'C');
			$x_axis_new = $x_axis_new+$cell_width_new;
		}

		$y_axis = $y_axis+$cell_height;
		$cell_height = 4;
		$x_axis_new = $x_axis;
		for($i=0;$i<4;$i++){
			
			$cell_width_new = 12.5;
			$pdf->SetXY($x_axis_new,$y_axis);
			$pdf->Cell($cell_width_new,$cell_height,'',1,0,'C');
			$x_axis_new = $x_axis_new+$cell_width_new;
		}

		//=============Reveiew Assessment=======================//

		$x_axis = $x_axis+$cell_width;
		$y_axis = 50;
		$cell_width = 30;
		$cell_height = 8;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($cell_width,$cell_height,'Review Assessments',1,0,'C');

		$y_axis = $y_axis+$cell_height;
		$cell_height = 4;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($cell_width,$cell_height,$review_assessment_weightage.'%',1,0,'C');

		$y_axis = $y_axis+$cell_height;
		$cell_height = 4;
		$x_axis_new = $x_axis;
		for($i=0;$i<2;$i++){
			
			$cell_width_new = 15;
			$pdf->SetXY($x_axis_new,$y_axis);
			$pdf->Cell($cell_width_new,$cell_height,'',1,0,'C');
			$x_axis_new = $x_axis_new+$cell_width_new;
		}

		$y_axis = $y_axis+$cell_height;
		$cell_height = 4;
		$x_axis_new = $x_axis;
		for($i=0;$i<2;$i++){
			
			$cell_width_new = 15;
			$pdf->SetXY($x_axis_new,$y_axis);
			$pdf->Cell($cell_width_new,$cell_height,'',1,0,'C');
			$x_axis_new = $x_axis_new+$cell_width_new;
		}

		//========================TOTAL=============================//

		$x_axis = $x_axis+$cell_width;
		$y_axis = 50;
		$cell_width = 40;
		$cell_height = 12;

		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($cell_width,$cell_height,'Total',1,0,'C');

		$y_axis = $y_axis+$cell_height;
		$cell_height = 4;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($cell_width,$cell_height,'',1,0,'C');

		$y_axis = $y_axis+$cell_height;
		$cell_height = 4;
		$x_axis_new = $x_axis;
	
			
		$cell_width_new = 13.3;
		$pdf->SetXY($x_axis_new,$y_axis);
		$pdf->Cell($cell_width_new,$cell_height,'Marks',1,0,'C');
		$x_axis_new = $x_axis_new+$cell_width_new;

		$pdf->SetXY($x_axis_new,$y_axis);
		$pdf->Cell($cell_width_new,$cell_height,'%',1,0,'C');
		$x_axis_new = $x_axis_new+$cell_width_new;

		$pdf->SetXY($x_axis_new,$y_axis);
		$pdf->Cell($cell_width_new,$cell_height,'Grade',1,0,'C');
		$x_axis_new = $x_axis_new+$cell_width_new;
		

		//================= Body ============================//
		//===================================================//

		
		$y_axis = $y_axis+4;
		
		$cell_height = 6;
		$count = 1;

		foreach($this->data['students_gs_data'] as $data){
			$x_axis = 14;
			$cell_width = 10;
			$pdf->SetXY($x_axis,$y_axis);
			$pdf->Cell($cell_width,$cell_height,$count,1,0,'C');
			
			// Student Name
			$x_axis = $x_axis+$cell_width;
			$cell_width = 50;
			$pdf->SetXY($x_axis,$y_axis);
			$pdf->Cell($cell_width,$cell_height,$data->abridged_name,1);

			// Class Assessment List
			$x_axis = $x_axis+$cell_width;
			$cell_width = 50;
			for($i=0;$i<4;$i++){

				$x_axis_new = $x_axis;
				for($i=0;$i<4;$i++){
			
				$cell_width_new = 12.5;
				$pdf->SetXY($x_axis_new,$y_axis);
				$pdf->Cell($cell_width_new,$cell_height,'',1,0,'C');
				$x_axis_new = $x_axis_new+$cell_width_new;
			}

			}

			$x_axis = $x_axis + $cell_width;
			$cell_width = 50;
			$x_axis_new = $x_axis;
			for($i=0;$i<2;$i++){
			
			$cell_width_new = 15;
			$pdf->SetXY($x_axis_new,$y_axis);
			$pdf->Cell($cell_width_new,$cell_height,'',1,0,'C');
			$x_axis_new = $x_axis_new+$cell_width_new;
			}

			$x_axis = $x_axis+$cell_width;
			for($i=0;$i<3;$i++){
			$cell_width_new = 13.3;
			$pdf->SetXY($x_axis_new,$y_axis);
			$pdf->Cell($cell_width_new,$cell_height,'',1,0,'C');
			$x_axis_new = $x_axis_new+$cell_width_new;
			}



			$count++;
			$y_axis = $y_axis+$cell_height;

		}

		$total_weightage = $class_assessment_weightage+$review_assessment_weightage;

		$pdf->SetXY(153,35);
		$pdf->Cell(40,6,'Weightage : '.$total_weightage.'%',1,0,'C');

		
		$page_height = $pdf->h;

		$this->load->model('staff/staff_registered_model');
		$this->data['staff_registered_data'] = $this->staff_registered_model->get_by(array('user_id' => (int)$this->session->userdata('user_id')));
		$pdf->SetFillColor(0,0,0);
		$pdf->SetTextColor(255,255,255);
    	$pdf->SetXY(7,$page_height-25);
    	$pdf->Cell(60, 4, date('D-d-M-Y H:i') . ' (' . ucwords($this->data['staff_registered_data'][0]->abridged_name) . ')', 1, 0, 'L', 1);

    
    	

		// $x_axis = 2;
		// $y_axis = 2;
		// $cell_width = 10;
		// $cell_height = 10;

		// $pdf->SetXY($x_axis,$y_axis);
		// $pdf->Cell($cell_width,$cell_height,'Generation');


		$pdf->Output('Assessment_Report' . '.pdf', 'I');

	}

	public function getThisSubjectFormativeFramework(){

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
			<iframe src="'.site_url().'/etab_reports/formative_framework/get_subject_marksheet_formative_framework_report?'.$helper.'" frameborder="0">
			</iframe>
		</div>';

		
    	echo $html;

	}

	public function get_subject_marksheet_formative_framework_report(){

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

        //var_dump($this->input->get());

        // var_dump($gpp_id);

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

	    $select_grade = $this->assessment_report_model->get_grade($academic,$prgmID);

	    $teacher_name = $this->assessment_report_model->get_class_teacher($academic,$role_id);

	    $subject_teacher = $teacher_name[0]->name;



	    $noOfStudents = sizeof($this->data['students_gs_data']);
    	$noOfAssessments = sizeof($this->data['assessment_titles']);
    	




     	// Overall Font Size
		

	
    	// var_dump($role_id);


		require_once('components/pdf/fpdf/fpdf_rotate.php');
		require_once('components/pdf/fpdi/fpdi.php');

		


		
		// initiate FPDI
		// if($noOfAssessments <= 27){
		 	$pdf = new PDF('P', 'mm', 'A4');
		// }
		// if($noOfAssessments > 27 and $noOfAssessments <= 30){
		// 	//$pdf = new PDF('L', 'mm', 'A3');
		// 	$pdf = new PDF('L','mm',array(270,370));
		// }
		// else if($noOfAssessments  > 30 and $noOfAssessments <= 33)
		// {
		// 	$pdf = new PDF('L','mm',array(300,400));
		// }
		// else if($noOfAssessments > 33 and $noOfAssessments <= 36)
		// {
		// 	$pdf = new PDF('L','mm',array(350,450));

		// }
		// else if ($noOfAssessments > 36 and $noOfAssessments <= 39){
			
		// 	$pdf = new PDF('L','mm',array(400,500));

		// }
		// else if($noOfAssessments > 39 and $noOfAssessments <=42)
		// {
		// 	$pdf = new PDF('L','mm',array(450,550));
		// }else{
		// 	$pdf = new PDF('L','mm', 'A3');
		// }

		//$pdf = new PDF('L','mm',array(500,600));

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

		$pdf->SetXY(85,6);
    	$pdf->Cell(50,9,"Subject Mark Sheet - Formative",0,'L');

    	$pdf->SetXY(98,9);
    	$pdf->Cell(50,9,"A Levels",0,'L');

    	$pdf->SetXY(97,13);
    	$pdf->Cell(50,9,"2016-2017",0,'L');

    	$pdf->SetXY(100,17);
    	$pdf->Cell(50,9,"Term II",0,'L');

    	$pdf->SetFillColor(0,0,0);
		$pdf->SetTextColor(255,255,255);
		$pdf->SetXY(0,24);
		$pdf->Cell(210,5,'On going Academic Activities',1,0,'C',1);

		$pdf->SetTextColor(0,0,0);
		$pdf->SetXY(1,30);
		$pdf->Cell(20,6,'Class:',0,'L');

		$grade = explode('-',$gpp_id);
		$grade_name = $grade[0];

		$pdf->SetXY(20,30);
		$pdf->Cell(20,6,$grade_name,0,'L');


		$pdf->SetXY(1,35);
		$pdf->Cell(20,6,'Teacher:',0,'L');

		$pdf->SetXY(20,35);
		$pdf->Cell(20,6,$subject_teacher,0,'L');

		$pdf->SetXY(1,40);
		$pdf->Cell(20,6,'Subject:',0,'L');

		$pdf->SetXY(20,40);
		$pdf->Cell(20,6,$gpp_id,0,'L');

		// var_dump($this->data['assessment_marks']);

		// Header Title of the Report

		$x_axis = 1;
		$y_axis= 50;

		$cell_width = 10;
		$cell_height = 20;

		$font_size = 8;
		$font_name = 'Helvetica';
		$pdf->SetFont($font_name,'',$font_size);

		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($cell_width,$cell_height,'SR.#',1,0,'C');

		$x_axis = $x_axis + $cell_width;
		$cell_height = 8;
		$cell_width = 40;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($cell_width,$cell_height,'Particulars',1,0,'L');

		$y_axis = $y_axis+$cell_height;
		$cell_height = 4;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($cell_width,$cell_height,'Weightage',1,0,'L');

		$y_axis = $y_axis+$cell_height;
		$cell_height = 4;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($cell_width,$cell_height,'Date',1,0,'L');

		$y_axis = $y_axis+$cell_height;
		$cell_height = 4;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($cell_width,$cell_height,'Name',1,0,'L');

		
		$cell_height = 4;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($cell_width,$cell_height,'Max.Marks',1,0,'R');

		$x_axis = $x_axis + $cell_width;
		
		$y_axis = 50;
		
		$font_size = 8;
		$font_name = 'Helvetica';
		$pdf->SetFont($font_name,'',$font_size);

		foreach ($this->data['assessment_titles'] as $data) {

			//var_dump($data);
			if($data->this_order == 2){


				if($data->assessment_name == 'Class Assessment' ){
				
				}else if($data->assessment_name == 'Review Assessment'){

				}else{
					

					$assessment_name = strlen($data->assessment_name);
					if($assessment_name > 10){

						$assessment_name_array = explode(" ", $data->assessment_name);
						$cell_width_space = 20;
							$y_axis_new = 50;
						for($i=0;$i<sizeof($assessment_name_array);$i++){

							
							if($i==0){
							$cell_height_space = 4;
							$pdf->SetXY($x_axis,$y_axis_new);
							$pdf->Cell($cell_width_space,$cell_height_space,$assessment_name_array[$i],'T,L,R',0,'C');
							
							$y_axis_new = $y_axis_new+$cell_height_space;

							}

							if($i==1){
								//var_dump($y_axis_new);
							//$cell_height_space = 4;
							$pdf->SetXY($x_axis,$y_axis_new);
							$pdf->Cell($cell_width_space,$cell_height_space,$assessment_name_array[$i],'L,R',0,'C');
							$y_axis_new = $y_axis_new+$cell_height_space;
							}
							

							//$y_axis_new = $y_axis + $cell_height_space;
							//$cell_height_space = $cell_height_space+4;
						}

							//$y_axis_new = $y_axis_new + $cell_height_space;
							$pdf->SetXY($x_axis,$y_axis_new);
							$pdf->Cell($cell_width_space,$cell_height_space,$data->assessment_weightage.'%',1,0,'C');

							$y_axis_new = $y_axis_new + $cell_height_space;
							$pdf->SetXY($x_axis,$y_axis_new);
							$pdf->Cell($cell_width_space,$cell_height_space,'',1,0,'C');

							$y_axis_new = $y_axis_new + $cell_height_space;
							$pdf->SetXY($x_axis,$y_axis_new);
							$pdf->Cell($cell_width_space,$cell_height_space,'',1,0,'C');


						$x_axis = $x_axis+$cell_width_space;
					}else{

						$cell_width_new = 20;
						$cell_height_new = 8;
						$pdf->SetXY($x_axis,$y_axis);
						$pdf->Cell($cell_width_new,$cell_height_new,$data->assessment_name,1,0,'C');

						$y_axis_weightage = $y_axis+$cell_height_new;
						$cell_height_weightage = 4;
						$pdf->SetXY($x_axis,$y_axis_weightage);
						$pdf->Cell($cell_width_new,$cell_height_weightage,$data->assessment_weightage.'%',1,0,'C');

						$y_axis_weightage = $y_axis+$cell_height_new;
						$cell_height_weightage = 8;
						$pdf->SetXY($x_axis,$y_axis_weightage);
						$pdf->Cell($cell_width_new,$cell_height_weightage,'',1,0,'C');

						$y_axis_weightage = $y_axis+$cell_height_new;
						$cell_height_weightage = 12;
						$pdf->SetXY($x_axis,$y_axis_weightage);
						$pdf->Cell($cell_width_new,$cell_height_weightage,'',1,0,'C');


						$x_axis = $x_axis+$cell_width_new;
					}	
				}
				
			}
	
		}

		
		$cell_width = 30;
		$cell_height = 12;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($cell_width,$cell_height,'Total',1,0,'C');

		$y_axis = $cell_height+$y_axis;
		$cell_height = 4;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($cell_width,$cell_height,'',1,0,'C');

		$cell_width_new = 10;
		$y_axis = $cell_height+$y_axis;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($cell_width_new,$cell_height,'Marks',1,0,'C');

		$x_axis = $cell_width_new+$x_axis;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($cell_width_new,$cell_height,'%',1,0,'C');

		$x_axis = $cell_width_new+$x_axis;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($cell_width_new,$cell_height,'Grade',1,0,'C');


		// Body of the grade

		$y_axis = $y_axis+$cell_height;
		
		$count = 1;
		$total_weightage = 0;

		foreach($this->data['students_gs_data'] as $data){

			$cell_height = 6;
			$cell_width = 10;
			$x_axis = 1;

			$pdf->SetXY($x_axis,$y_axis);
			$pdf->Cell($cell_width,$cell_height,$count,1,0,'C');

			$x_axis = $x_axis+$cell_width;
			$cell_width = 40;

			$pdf->SetXY($x_axis,$y_axis);
			$pdf->Cell($cell_width,$cell_height,$data->abridged_name,1,0,'L');

			$x_axis = $x_axis+$cell_width;

			foreach ($this->data['assessment_titles'] as $title) {

				if($title->this_order == 2){

					if($title->assessment_name == 'Class Assessment'){

					}else if($title->assessment_name == 'Review Assessment'){

					}else{

						$cell_width = 20;
						$pdf->SetXY($x_axis,$y_axis);
						$pdf->Cell($cell_width,$cell_height,'',1,0,'L');

						$x_axis = $x_axis+$cell_width;
						
						

					}

				}
				
			}

			for($i=0;$i<3;$i++){
				$cell_width = 10;
				$pdf->SetXY($x_axis,$y_axis);
				$pdf->Cell($cell_width,$cell_height,'',1,0,'L');
				$x_axis = $x_axis+$cell_width;
			}


			$count++;
			$y_axis = $y_axis+$cell_height;

		}

		// Weightage

		foreach($this->data['assessment_titles'] as $weightage){
			if($weightage->this_order == 2){
				if($weightage->assessment_name == 'Class Assessment'){
				}else if($weightage->assessment_name == 'Review Assessment'){

				}else{
					$total_weightage += $weightage->assessment_weightage; 
				}

			}
		}


		$pdf->SetXY(153,35);
		$pdf->Cell(40,6,'Weightage : '.$total_weightage.'%',1,0,'C');




		
		$page_height = $pdf->h;

		$this->load->model('staff/staff_registered_model');
		$this->data['staff_registered_data'] = $this->staff_registered_model->get_by(array('user_id' => (int)$this->session->userdata('user_id')));
		$pdf->SetFillColor(0,0,0);
		$pdf->SetTextColor(255,255,255);
    	$pdf->SetXY(7,$page_height-25);
    	$pdf->Cell(60, 4, date('D-d-M-Y H:i') . ' (' . ucwords($this->data['staff_registered_data'][0]->abridged_name) . ')', 1, 0, 'L', 1);

    
    	

		// $x_axis = 2;
		// $y_axis = 2;
		// $cell_width = 10;
		// $cell_height = 10;

		// $pdf->SetXY($x_axis,$y_axis);
		// $pdf->Cell($cell_width,$cell_height,'Generation');


		$pdf->Output('Assessment_Report' . '.pdf', 'I');




	}

	public function getThisTermFramework(){
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
			<iframe src="'.site_url().'/etab_reports/formative_framework/get_subject_marksheet_term_framework_report?'.$helper.'" frameborder="0">
			</iframe>
		</div>';

		
    	echo $html;
	}

	public function get_subject_marksheet_term_framework_report(){

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

        //var_dump($this->input->get());

        // var_dump($gpp_id);

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

	    $select_grade = $this->assessment_report_model->get_grade($academic,$prgmID);

	    $teacher_name = $this->assessment_report_model->get_class_teacher($academic,$role_id);

	    $subject_teacher = $teacher_name[0]->name;



	    $noOfStudents = sizeof($this->data['students_gs_data']);
    	$noOfAssessments = sizeof($this->data['assessment_titles']);
    	




     	// Overall Font Size
		

	
    	// var_dump($role_id);


		require_once('components/pdf/fpdf/fpdf_rotate.php');
		require_once('components/pdf/fpdi/fpdi.php');

		


		
		// initiate FPDI
		// if($noOfAssessments <= 27){
		 	$pdf = new PDF('P', 'mm', 'A4');
		// }
		// if($noOfAssessments > 27 and $noOfAssessments <= 30){
		// 	//$pdf = new PDF('L', 'mm', 'A3');
		// 	$pdf = new PDF('L','mm',array(270,370));
		// }
		// else if($noOfAssessments  > 30 and $noOfAssessments <= 33)
		// {
		// 	$pdf = new PDF('L','mm',array(300,400));
		// }
		// else if($noOfAssessments > 33 and $noOfAssessments <= 36)
		// {
		// 	$pdf = new PDF('L','mm',array(350,450));

		// }
		// else if ($noOfAssessments > 36 and $noOfAssessments <= 39){
			
		// 	$pdf = new PDF('L','mm',array(400,500));

		// }
		// else if($noOfAssessments > 39 and $noOfAssessments <=42)
		// {
		// 	$pdf = new PDF('L','mm',array(450,550));
		// }else{
		// 	$pdf = new PDF('L','mm', 'A3');
		// }

		//$pdf = new PDF('L','mm',array(500,600));

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

		$pdf->SetXY(85,6);
    	$pdf->Cell(50,9,"Subject Mark Sheet - Formative",0,'L');

    	$pdf->SetXY(98,9);
    	$pdf->Cell(50,9,"A Levels",0,'L');

    	$pdf->SetXY(97,13);
    	$pdf->Cell(50,9,"2016-2017",0,'L');

    	$pdf->SetXY(100,17);
    	$pdf->Cell(50,9,"Term II",0,'L');

    	$pdf->SetFillColor(0,0,0);
		$pdf->SetTextColor(255,255,255);
		$pdf->SetXY(0,24);
		$pdf->Cell(210,5,'Assessments',1,0,'C',1);

		$pdf->SetTextColor(0,0,0);
		$pdf->SetXY(1,30);
		$pdf->Cell(20,6,'Class:',0,'L');

		$grade = explode('-',$gpp_id);
		$grade_name = $grade[0];

		$pdf->SetXY(20,30);
		$pdf->Cell(20,6,$grade_name,0,'L');


		$pdf->SetXY(1,35);
		$pdf->Cell(20,6,'Teacher:',0,'L');

		$pdf->SetXY(20,35);
		$pdf->Cell(20,6,$subject_teacher,0,'L');

		$pdf->SetXY(1,40);
		$pdf->Cell(20,6,'Subject:',0,'L');

		$pdf->SetXY(20,40);
		$pdf->Cell(20,6,$gpp_id,0,'L');

		$x_axis = 20;
		$y_axis = 50;

		$cell_width = 10;
		$cell_height = 30;

		//============================ Header ===============================//
		//==================================================================// 

		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($cell_width,$cell_height,'Sr.#',1,0,'C');

		$x_axis = $cell_width+$x_axis;
		$cell_width = 60;
		$cell_height = 10;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($cell_width,$cell_height,'Particulars',1,0,'L');


		$y_axis = $cell_height+$y_axis;
		$cell_height = 5;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($cell_width,$cell_height,'Paper',1,0,'L');

		$y_axis = $cell_height+$y_axis;
		$cell_height = 5;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($cell_width,$cell_height,'Weightage',1,0,'L');

		$y_axis = $cell_height+$y_axis;
		$cell_height = 5;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($cell_width,$cell_height,'Date',1,0,'L');


		$y_axis = $cell_height+$y_axis;
		$cell_height = 5;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($cell_width,$cell_height,'Name',1,0,'L');

		
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($cell_width,$cell_height,'Max.Marks',1,0,'C');

		$y_axis = 50;
		$x_axis = $x_axis+$cell_width;
		$cell_width = 60;
		$cell_height = 10;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($cell_width,$cell_height,'Term Assessments',1,0,'C');

		$y_axis = $cell_height+$y_axis;
		$x_axis_padding = $x_axis;
		$cell_height = 5;
		$cell_width_padding = 20;
		$pdf->SetXY($x_axis_padding,$y_axis);
		$pdf->Cell($cell_width_padding,$cell_height,'Paper 1',1,0,'C');

		$x_axis_padding = $x_axis_padding+$cell_width_padding;
		$pdf->SetXY($x_axis_padding,$y_axis);
		$pdf->Cell($cell_width_padding,$cell_height,'Paper 2',1,0,'C');

		$x_axis_padding = $x_axis_padding + $cell_width_padding;
		$pdf->SetXY($x_axis_padding,$y_axis);
		$pdf->Cell($cell_width_padding,$cell_height,'Paper 3',1,0,'C');
		$y_axis = $y_axis+$cell_height;
		
		for($i=0;$i<3;$i++){
			$x_axis_padding = $x_axis;
			for($j=0;$j<3;$j++){
				$pdf->SetXY($x_axis_padding,$y_axis);
				$pdf->Cell($cell_width_padding,$cell_height,'',1,0,'L');
				$x_axis_padding = $x_axis_padding+$cell_width_padding;
			}
			$y_axis = $y_axis+$cell_height;
		}

		$x_axis = $x_axis_padding;
		$y_axis = 50;
		$cell_width = 40;
		$cell_height = 20;

		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($cell_width,$cell_height,'Total',1,0,'C');

		$y_axis = $y_axis+$cell_height;
		$cell_height = 5;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($cell_width,$cell_height,'',1,0,'C');

		$y_axis = $y_axis+$cell_height;
		$x_axis_padding = $x_axis;
		$cell_width_padding = 13.33;
		$pdf->SetXY($x_axis,$y_axis);
		$pdf->Cell($cell_width_padding,$cell_height,'Marks',1,0,'C');

		$x_axis_padding = $x_axis_padding+$cell_width_padding;
		$cell_width_padding = 13.33;
		$pdf->SetXY($x_axis_padding,$y_axis);
		$pdf->Cell($cell_width_padding,$cell_height,'%',1,0,'C');

		$x_axis_padding = $x_axis_padding+$cell_width_padding;
		$cell_width_padding = 13.33;
		$pdf->SetXY($x_axis_padding,$y_axis);
		$pdf->Cell($cell_width_padding,$cell_height,'Grade',1,0,'C');

		//========================== Student Data =============================//
		//====================================================================//
		
		$count = 1;

		foreach($this->data['students_gs_data'] as $student){

			$x_axis = 20;
			$y_axis = $y_axis+$cell_height;

			$cell_width = 10;
			$cell_height = 5;

			$pdf->SetXY($x_axis,$y_axis);
			$pdf->Cell($cell_width,$cell_height,$count,1,0,'C');

			
			$x_axis = $x_axis+$cell_width;
			$cell_width = 60;
			$pdf->SetXY($x_axis,$y_axis);
			$pdf->Cell($cell_width,$cell_height,$student->abridged_name,1,0,'L');


			$x_axis = $x_axis+$cell_width;

			for($i=0;$i<3;$i++){	
				$cell_width = 20;
				$pdf->SetXY($x_axis,$y_axis);
				$pdf->Cell($cell_width,$cell_height,'',1,0,'L');
				$x_axis = $x_axis+$cell_width;
			}

			//$x_axis = $x_axis+$cell_width;
			for($i=0;$i<3;$i++){
				$cell_width = 13.33;
				$pdf->SetXY($x_axis,$y_axis);
				$pdf->Cell($cell_width,$cell_height,'',1,0,'L');
				$x_axis = $x_axis+$cell_width;
			}
			$count++;
		}

		$pdf->SetXY(149,35);
		$pdf->Cell(40,6,'Weightage : 100%',1,0,'C');

		$page_height = $pdf->h;

		$this->load->model('staff/staff_registered_model');
		$this->data['staff_registered_data'] = $this->staff_registered_model->get_by(array('user_id' => (int)$this->session->userdata('user_id')));
		$pdf->SetFillColor(0,0,0);
		$pdf->SetTextColor(255,255,255);
    	$pdf->SetXY(20,$page_height-25);
    	$pdf->Cell(60, 4, date('D-d-M-Y H:i') . ' (' . ucwords($this->data['staff_registered_data'][0]->abridged_name) . ')', 1, 0, 'L', 1);

    	

		


		$pdf->Output('Assessment_Report' . '.pdf', 'I');

	}



}