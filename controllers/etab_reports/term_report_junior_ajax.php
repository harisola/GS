<?php

class Term_report_junior_ajax extends CI_Controller{

	public function __construct(){
		parent::__construct();
	}

	public function generate_UnitAssessment_n_Review_report(){
		$gradeID = $this->input->get('gradeID');
        $sectionID = $this->input->get('sectionID');
        $gradeName = $this->input->get('gradeName');
        $sectionName = $this->input->get('sectionName');
        $termID = $this->input->get('term');

        $class = $gradeName . '-' . $sectionName;
        $optional = 0;






        $this->load->model('atif_sp/assessment_report_model');
        /******************************** Students Data 
        /***********************************************/
        //$data['students_gs_data'] = $this->assessment_report_model->get_students_grade_section($gradeID, $sectionID);

        $data['students_gs_data'] = $this->assessment_report_model->get_students_grade_section_SessionTerm($gradeID, $sectionID, "");
        $no_of_students = sizeof($data['students_gs_data']);

        /************************** Assessment Subjects
        /***********************************************/
        /*if($gradeID <= 9){
            //$data['assessment_titles'] = $this->assessment_report_model->Complete_Assessment_Report_GS_Subjects_Science($gradeID, $sectionID);
            $data['assessment_titles'] = $this->assessment_report_model->Complete_Assessment_Report_GS_Subjects_Science_SessionTerm($gradeID, $sectionID, "_1617_1");
        }else{*/
            //$data['assessment_titles'] = $this->assessment_report_model->Complete_Assessment_Report_GS_Subjects($gradeID, $sectionID);
            $data['assessment_titles'] = $this->assessment_report_model->Complete_Assessment_Report_GS_Subjects_SessionTerm($gradeID, $sectionID, "");
        //}

  



        /***************************** Assessment Marks
        /***********************************************/

            /*if($gradeID <= 9){
            //$data['assessment_marks'] = $this->assessment_report_model->Complete_Assessment_Report_GS_lvl_3_Science($gradeID, $sectionID, $termID);
            $data['assessment_marks'] = $this->assessment_report_model->Complete_Assessment_Report_GS_lvl_3_Science_SessionTerm($gradeID, $sectionID, $termID, "");
            }else{*/
                //$data['assessment_marks'] = $this->assessment_report_model->Complete_Assessment_Report_GS_lvl_3($gradeID, $sectionID, $termID);
                $data['assessment_marks'] = $this->assessment_report_model->Complete_Assessment_Report_GS_lvl_3_SessionTerm($gradeID, $sectionID, $termID, "");
            //}

      
        /***************************** Assessment Grade
        /***********************************************/

        /*if($gradeID <= 9){
            //$data['assessment_grade'] = $this->assessment_report_model->Complete_Assessment_Report_GS_lvl_4_Science($gradeID, $sectionID, $termID);
            $data['assessment_grade'] = $this->assessment_report_model->Complete_Assessment_Report_GS_lvl_4_Science_SessionTerm($gradeID, $sectionID, $termID, "");
        }else{*/
            //$data['assessment_grade'] = $this->assessment_report_model->Complete_Assessment_Report_GS_lvl_4($gradeID, $sectionID, $termID);
            $data['assessment_grade'] = $this->assessment_report_model->Complete_Assessment_Report_GS_lvl_4_SessionTerm($gradeID, $sectionID, $termID, "");
        //}


        /******************************* Assessment ASP
        /***********************************************/
        //$data['assessment_asp'] = $this->assessment_report_model->Complete_Assessment_Report_GS_lvl_ASP($gradeID, $sectionID, $termID);

        $data['assessment_asp'] = $this->assessment_report_model->Complete_Assessment_Report_GS_lvl_ASP_SessionTerm($gradeID, $sectionID, $termID, "");
     
        /********************* Assessment Overall Grade
        /***********************************************/
        $data['assessment_overall_garde'] = $this->assessment_report_model->get_Grade_Overall_grading($gradeID);
        /*************************************************************************************************************************************/
        $no_of_subjects = sizeof($data['assessment_titles']);





        $TermReportTitle = ' (Term-2 Report 2017-18)';
        

        require_once('components/pdf/fpdf/fpdf_rotate.php');
        require_once('components/pdf/fpdi/fpdi.php');

        // initiate FPDI
        $pdf = new PDF('L', 'mm', 'A3');
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(false);

        $pdf->AddFont('CooperBT-Black','','CooperBlackBT.php');
        $pdf->AddFont('AbadiMT-CondensedLight','','abadi-light.php');
        $pdf->AddFont('Verdana','','Verdana.php');






        /***************************************************************************** Global Variables
        /***********************************************************************************************/
        $border = 1;
        $now_date = date('D-d-M-Y H:i');
        


        $heading_font_size = 16;
        $heading_font_name = 'CooperBT-Black';

        $sub_heading_font_size = 14;
        $sub_heading_font_name = 'times';


        $table_header_height = 16;
        $table_header_sub_width = 44.2;
        $table_header_sub_info_width = 11.05;
        $table_header_sub_height = 8;
        $table_header_font_size = 10;
        $table_header_font_name = 'times'; //Helvetica, CooperBT-Black, Verdana, times, courier


        $text_font_size = 8;
        $text_font_name = 'Verdana'; //Helvetica, CooperBT-Black, Verdana, times, courier
        $text_column_height = 6;
        $text_column_width_sno = 14;
        $text_column_width_gsid = 20;
        $text_column_width_abname = 40;
        $text_column_width_status = 16;
        


        $ReportStarting_X = 10;
        $ReportStarting_Y = 2;
        $startWith_X = $ReportStarting_X;
        $startWith_Y = $ReportStarting_Y;


        $grade_Ap_r_FontColor = 0;   $grade_Ap_g_FontColor = 0;      $grade_Ap_b_FontColor = 0;
        $grade_A_r_FontColor = 0;    $grade_A_g_FontColor = 0;       $grade_A_b_FontColor = 0;
        $grade_B_r_FontColor = 0;    $grade_B_g_FontColor = 0;       $grade_B_b_FontColor = 0;
        $grade_C_r_FontColor = 0;    $grade_C_g_FontColor = 0;       $grade_C_b_FontColor = 0;
        $grade_D_r_FontColor = 0;    $grade_D_g_FontColor = 0;       $grade_D_b_FontColor = 0;
        $grade_U_r_FontColor = 139;  $grade_U_g_FontColor = 0;       $grade_U_b_FontColor = 0;
        $text_fontColor_r = 0;       $text_fontColor_g = 0;          $text_fontColor_b = 0;
        $fontColor_r = 0;            $fontColor_g = 0;               $fontColor_b = 0;

        $BG_grade_Ap_r_FontColor = 255;   $BG_grade_Ap_g_FontColor = 255;      $BG_grade_Ap_b_FontColor = 255;
        $BG_grade_A_r_FontColor = 255;    $BG_grade_A_g_FontColor = 255;       $BG_grade_A_b_FontColor = 255;
        $BG_grade_B_r_FontColor = 255;    $BG_grade_B_g_FontColor = 255;       $BG_grade_B_b_FontColor = 255;
        $BG_grade_C_r_FontColor = 255;    $BG_grade_C_g_FontColor = 255;       $BG_grade_C_b_FontColor = 255;
        $BG_grade_D_r_FontColor = 255;    $BG_grade_D_g_FontColor = 255;       $BG_grade_D_b_FontColor = 255;
        $BG_grade_U_r_FontColor = 255;    $BG_grade_U_g_FontColor = 255;       $BG_grade_U_b_FontColor = 100;
        $BG_text_fontColor_r = 255;       $BG_text_fontColor_g = 255;          $BG_text_fontColor_b = 255;
        $BG_fontColor_r = 255;            $BG_fontColor_g = 255;               $BG_fontColor_b = 255;
        /***********************************************************************************************/
        





















        /*************************************************************************** Grade Computation
        /***********************************************************************************************/
        $studentMarks = array();
        $studentTotalPercentage = array();
        foreach ($data['students_gs_data'] as $student) {
            $i=0;
            $Total = 0;
            $studentTotalMarks[$student->gs_id] = 0;
            $studentTotalPercentage[$student->gs_id] = 0;
            $studentGrade_U[$student->gs_id] = 0;
            $studentMarks[$student->gs_id]['ftmarks'] = 0;
            $studentMarks[$student->gs_id]['stmarks'] = 0;
            foreach ($data['assessment_titles'] as $title) {
                foreach ($data['assessment_marks'] as $marks) {
                    $marksObtained_ft = 0; $marksObtained_st = 0;
                    if($marks->gs_id == $student->gs_id && $marks->subject_name == $title->subjectname && $title->program_id != 612 && $title->program_id != 609){
                        if($marks->assessment_type_id == 1 && $marks->ass_per_mrk > 0){
                            $marksObtained_ft = $marks->ass_per_mrk;
                            //var_dump($marksObtained_ft);
                            $Total+=$marksObtained_ft;
                            $studentMarks[$title->subjectname]['ft'][$student->gs_id] = $marksObtained_ft;
                            $studentMarks[$title->subjectname]['ftgd'][$student->gs_id] = $marks->grade;
                            $studentMarks[$student->gs_id]['subjects'][$i] = $title->subjectname;
                            $studentMarks[$student->gs_id]['ftmarks'] += $marksObtained_ft;
                            //$studentTotalMarks[$student->gs_id] += $marksObtained_ft;
                        }else if($marks->assessment_type_id == 2 && $marks->ass_per_mrk > 0){
                            $marksObtained_st = $marks->ass_per_mrk;
                            $Total+=$marksObtained_st;
                            //var_dump($marksObtained_st);
                            $studentMarks[$title->subjectname]['st'][$student->gs_id] = $marksObtained_st;
                            $studentMarks[$title->subjectname]['stgd'][$student->gs_id] = $marks->grade;
                            $studentMarks[$student->gs_id]['subjects'][$i] = $title->subjectname;
                            $studentMarks[$student->gs_id]['stmarks'] += $marksObtained_st;
                            //$studentTotalMarks[$student->gs_id] += $marksObtained_st;
                        }  
                    }
                }
                

                foreach ($data['assessment_grade'] as $grade) {
                    if($grade->gs_id == $student->gs_id && $grade->subject_name == $title->subjectname && $title->program_id != 612 && $title->program_id != 609){
                        $studentMarks[$title->subjectname]['gd'][$student->gs_id] = $grade->grade;
                        $studentTotalMarks[$student->gs_id] += $grade->ass_per_mrk;
                        if($grade->grade == 'U'){
                            $studentGrade_U[$student->gs_id]=1;
                        }
                    }
                }


                $i++;
            }


            foreach ($data['assessment_asp'] as $ASP) {
                if($ASP->gs_id == $student->gs_id){
                    $studentTotalMarks[$student->gs_id] += $ASP->asp_total;
                    if(!empty($studentMarks[$student->gs_id]['subjects'])){
                        $studentTotalPercentage[$student->gs_id] = ROUND($studentTotalMarks[$student->gs_id] / sizeof($studentMarks[$student->gs_id]['subjects']), 1);                        
                    }else{
                        $studentTotalPercentage[$student->gs_id] = 0;
                    }
                }
            }
        }



        foreach ($data['assessment_titles'] as $title) {
            if(!empty($studentMarks[$title->subjectname]['ft']) && !empty($studentMarks[$title->subjectname]['st'])){
                $studentMarks[$title->subjectname]['avg'] = ROUND((array_sum($studentMarks[$title->subjectname]['ft']) + array_sum($studentMarks[$title->subjectname]['st']))/2, 0);
                $studentMarks[$title->subjectname]['avg'] = ROUND($studentMarks[$title->subjectname]['avg'] / count($studentMarks[$title->subjectname]['ft']), 0);
            }

            foreach ($data['students_gs_data'] as $student) {
                if(!empty($studentMarks[$title->subjectname]['ft'][$student->gs_id])){
                    if(!empty($studentMarks[$title->subjectname]['st'][$student->gs_id])){
                        $studentMarks[$title->subjectname]['std_total'][$student->gs_id] = 
                        ROUND(($studentMarks[$title->subjectname]['ft'][$student->gs_id] + $studentMarks[$title->subjectname]['st'][$student->gs_id])/2,0);
                    }else{
                        $studentMarks[$title->subjectname]['std_total'][$student->gs_id] = ROUND($studentMarks[$title->subjectname]['ft'][$student->gs_id]/2,0);
                    }
                }
            }
        }

        //var_dump($studentGrade_U);
        //exit;
        /***********************************************************************************************/
















        


        /******************************************************************************** Report Footer
        /***********************************************************************************************/
        $pdf->SetFont($text_font_name,'',$text_font_size);
        $this->load->model('staff/staff_registered_model');
        $this->data['staff_registered_data'] = $this->staff_registered_model->get_by(array('user_id' => (int)$this->session->userdata('user_id')));
        $thisText = ucwords($this->data['staff_registered_data'][0]->abridged_name);
        $pdf->SetFillColor(0,0,0);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetXY($ReportStarting_X,$pdf->h-15);
        $pdf->Cell(72, 4, $now_date . ' ( '.$thisText.' )', 1, 0, 'L', 1);

        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY($pdf->w-30,$pdf->h-15);
        $pdf->Cell(20, 4, 'Page 1 / ' . ceil(($no_of_subjects+2.5)/7), 0, 0, 'L');


        /****************************************************************************** Report Heading
        /***********************************************************************************************/
        $pdf->setTextColor($text_fontColor_r, $text_fontColor_g, $text_fontColor_b);
        $pdf->SetFillColor($BG_text_fontColor_r, $BG_text_fontColor_g, $BG_text_fontColor_b);
        $used_height_y = 10;
        $pdf->SetFont($heading_font_name,'',$heading_font_size);
        $header_width = $pdf->w - $ReportStarting_X*2;
        $pdf->SetXY($startWith_X,$startWith_Y);
        $pdf->Cell($header_width, $used_height_y, "Generation's School",0,0,'C');


        $startWith_Y += $used_height_y;
        $used_height_y = 10;
        $pdf->SetFont($sub_heading_font_name,'',$sub_heading_font_size);
        $header_width = ($pdf->w - $ReportStarting_X*2)/4;
        $pdf->SetXY($startWith_X,$startWith_Y);
        $pdf->Cell($header_width, $used_height_y, "Co-Teacher : ".$data['students_gs_data'][0]->co_teacher,0,0,'L');

        $pdf->SetFont($sub_heading_font_name,'',$sub_heading_font_size);
        $header_width = ($pdf->w - $ReportStarting_X*2)/4;
        $pdf->SetXY($pdf->w-($pdf->w/4)- $ReportStarting_X/2,$startWith_Y);
        $pdf->Cell($header_width, $used_height_y, "Class Teacher : ".$data['students_gs_data'][0]->class_teacher,0,0,'R');


        $sub_heading_font_size = 16;
        $pdf->SetFont($sub_heading_font_name,'',$sub_heading_font_size);
        $header_width = $pdf->w - $ReportStarting_X*2;
        $pdf->SetXY($startWith_X,$startWith_Y);
        $pdf->Cell($header_width, $used_height_y, $class . $TermReportTitle,0,0,'C');

        /***************** Sub Headings
        /***** Student Information
        /******************************/
        $dataFlowX = $startWith_X;
        $startWith_Y += $used_height_y;
        $pdf->SetFont($table_header_font_name,'B',$table_header_font_size);
        $pdf->SetXY($startWith_X,$startWith_Y);
        $pdf->Cell($text_column_width_sno, $table_header_height, 'S.No.',1,0,'C');

        $startWith_X += $text_column_width_sno;
        $pdf->SetXY($startWith_X,$startWith_Y);
        $pdf->Cell($text_column_width_gsid, $table_header_height, 'GS-ID',1,0,'C');

        $startWith_X += $text_column_width_gsid;
        $pdf->SetXY($startWith_X,$startWith_Y);
        $pdf->Cell($text_column_width_abname, $table_header_height, 'Abridged Name',1,0,'L');

        $startWith_X += $text_column_width_abname;
        $pdf->SetXY($startWith_X,$startWith_Y);
        $pdf->Cell($text_column_width_status, $table_header_height, 'Status',1,0,'C');


        $i=1;
        $dataFlowY =  $startWith_Y;
        $dataFlowX = $startWith_X - $text_column_width_abname - $text_column_width_gsid - $text_column_width_sno;
        $pdf->SetFont($text_font_name,'',$text_font_size);
        foreach ($data['students_gs_data'] as $student) {
            $startWith_X = $startWith_X - $text_column_width_abname - $text_column_width_gsid - $text_column_width_sno;
            $startWith_Y += $table_header_height;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($text_column_width_sno, $text_column_height, $i,1,0,'C');

            $startWith_X += $text_column_width_sno;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($text_column_width_gsid, $text_column_height, $student->gs_id,1,0,'C');

            $startWith_X += $text_column_width_gsid;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($text_column_width_abname, $text_column_height, $student->abridged_name,1,0,'L');

            $startWith_X += $text_column_width_abname;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($text_column_width_status, $text_column_height, $student->std_status_code,1,0,'C');
            

            $i++;
            $startWith_Y = $startWith_Y - ($table_header_height-$text_column_height);
        }

        /***** Grade Subjects
        /******************************/

        $dataFlowX = $dataFlowX + $text_column_width_abname + $text_column_width_gsid + $text_column_width_sno + $text_column_width_status;
        $startWith_X = $dataFlowX;
        $startWith_Y = $dataFlowY;
        $pdf->SetFont($table_header_font_name,'B',$table_header_font_size);
        $i=1;
        foreach ($data['assessment_titles'] as $title) {
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($table_header_sub_width, $table_header_sub_height, $title->subjectname,1,0,'C');

            $startWith_X += $table_header_sub_width;

            if($i == 7){break;}
            $i++;
        }
        $i=1;
        $startWith_X = $dataFlowX;
        $startWith_Y += $table_header_sub_height;
        foreach ($data['assessment_titles'] as $title) {
            if($title->program_id != 612 && $title->program_id != 609){

            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($table_header_sub_info_width, $table_header_sub_height, 'FT',1,0,'C');

            $startWith_X += $table_header_sub_info_width;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($table_header_sub_info_width, $table_header_sub_height, 'ST',1,0,'C');

            $startWith_X += $table_header_sub_info_width;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($table_header_sub_info_width, $table_header_sub_height, 'T',1,0,'C');

            $startWith_X += $table_header_sub_info_width;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($table_header_sub_info_width, $table_header_sub_height, 'G',1,0,'C');
            $startWith_X += $table_header_sub_info_width;

            }else{

            // $pdf->SetXY($startWith_X,$startWith_Y);
            // $pdf->Cell($table_header_sub_info_width, $table_header_sub_height, 'AT',1,0,'C');

           // $startWith_X += $table_header_sub_info_width;
            // $pdf->SetXY($startWith_X,$startWith_Y);
            // $pdf->Cell($table_header_sub_info_width, $table_header_sub_height, 'ST',1,0,'C');

            //$startWith_X += $table_header_sub_info_width;
            // $pdf->SetXY($startWith_X,$startWith_Y);
            // $pdf->Cell($table_header_sub_info_width, $table_header_sub_height, 'T',1,0,'C');

           // $startWith_X += $table_header_sub_info_width;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell(44.2, $table_header_sub_height, 'G',1,0,'C');
            $startWith_X += 44.2;

            }


            

            if($i == 7){break;}
            $i++;
        }





        $formativeMarks = '';
        $summativeMarks = '';
        $finalMarks = '';
        $finalGrade = '';
        $record_found = false;
        $startWith_Y += $table_header_sub_height;
        $pdf->SetFont($text_font_name,'',$text_font_size);
        foreach ($data['students_gs_data'] as $student) {

            $i = 1;
            $startWith_X = $dataFlowX;
            foreach ($data['assessment_titles'] as $title) {
                $formativeMarks = '';
                $summativeMarks = '';
                foreach ($data['assessment_marks'] as $marks) {
                    if($marks->gs_id == $student->gs_id
                       && $marks->subject_name == $title->subjectname){
                        if($marks->assessment_type_id == 1 && $marks->ass_per_mrk >= 0){
                            $formativeMarks = $marks->ass_per_mrk;
                        }else if($marks->assessment_type_id == 2 && $marks->ass_per_mrk >= 0){
                            $summativeMarks = $marks->ass_per_mrk;
                            break;
                        }  
                    }
                }


                $finalMarks = '';
                $finalGrade = '';
                $fontColor_r = $text_fontColor_r;
                $fontColor_g = $text_fontColor_g;
                $fontColor_b = $text_fontColor_b;

                $BG_fontColor_r = $BG_text_fontColor_r;
                $BG_fontColor_g = $BG_text_fontColor_g;
                $BG_fontColor_b = $BG_text_fontColor_b;
                $pdf->setTextColor($fontColor_r, $fontColor_g, $fontColor_b);
                $pdf->setFillColor($BG_fontColor_r, $BG_fontColor_g, $BG_fontColor_b);
                foreach ($data['assessment_grade'] as $grade) {
                    if($grade->gs_id == $student->gs_id
                       && $grade->subject_name == $title->subjectname){
                        $finalMarks = $grade->ass_per_mrk;
                        $finalGrade = $grade->grade;

                        if($grade->grade=='A+'){
                            $fontColor_r = $grade_Ap_r_FontColor;
                            $fontColor_g = $grade_Ap_g_FontColor;
                            $fontColor_b = $grade_Ap_b_FontColor;

                            $BG_fontColor_r = $BG_grade_Ap_r_FontColor;
                            $BG_fontColor_g = $BG_grade_Ap_g_FontColor;
                            $BG_fontColor_b = $BG_grade_Ap_b_FontColor;
                        }else if($grade->grade=='A'){
                            $fontColor_r = $grade_A_r_FontColor;
                            $fontColor_g = $grade_A_g_FontColor;
                            $fontColor_b = $grade_A_b_FontColor;

                            $BG_fontColor_r = $BG_grade_A_r_FontColor;
                            $BG_fontColor_g = $BG_grade_A_g_FontColor;
                            $BG_fontColor_b = $BG_grade_A_b_FontColor;
                        }else if($grade->grade=='B+'){
                            $fontColor_r = $grade_B_r_FontColor;
                            $fontColor_g = $grade_B_g_FontColor;
                            $fontColor_b = $grade_B_b_FontColor;

                            $BG_fontColor_r = $BG_grade_B_r_FontColor;
                            $BG_fontColor_g = $BG_grade_B_g_FontColor;
                            $BG_fontColor_b = $BG_grade_B_b_FontColor;
                        }else if($grade->grade=='B'){
                            $fontColor_r = $grade_C_r_FontColor;
                            $fontColor_g = $grade_C_g_FontColor;
                            $fontColor_b = $grade_C_b_FontColor;

                            $BG_fontColor_r = $BG_grade_C_r_FontColor;
                            $BG_fontColor_g = $BG_grade_C_g_FontColor;
                            $BG_fontColor_b = $BG_grade_C_b_FontColor;
                        }else if($grade->grade=='C+'){
                            $fontColor_r = $grade_D_r_FontColor;
                            $fontColor_g = $grade_D_g_FontColor;
                            $fontColor_b = $grade_D_b_FontColor;

                            $BG_fontColor_r = $BG_grade_D_r_FontColor;
                            $BG_fontColor_g = $BG_grade_D_g_FontColor;
                            $BG_fontColor_b = $BG_grade_D_b_FontColor;
                        }else if($grade->grade=='C'){
                            $fontColor_r = $grade_U_r_FontColor;
                            $fontColor_g = $grade_U_g_FontColor;
                            $fontColor_b = $grade_U_b_FontColor;

                            $BG_fontColor_r = $BG_grade_U_r_FontColor;
                            $BG_fontColor_g = $BG_grade_U_g_FontColor;
                            $BG_fontColor_b = $BG_grade_U_b_FontColor;
                        }
                        break;
                    }
                }


                $pdf->setTextColor($fontColor_r, $fontColor_g, $fontColor_b);
                $pdf->setFillColor($BG_fontColor_r, $BG_fontColor_g, $BG_fontColor_b);
                $pdf->SetXY($startWith_X,$startWith_Y);
                $startWith_X_junior = 0;
                $startWith_X_junior = $startWith_X;

                if($title->program_id != 612 && $title->program_id != 609 ){
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $formativeMarks,1,0,'C',1);
                    $startWith_X += $table_header_sub_info_width;
                }else{

                    //$pdf->Cell($table_header_sub_info_width, $text_column_height, '',0,0,'C');
                }

                $pdf->SetXY($startWith_X,$startWith_Y);
                if($title->program_id != 612 && $title->program_id != 609 ){
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $summativeMarks,1,0,'C',1);
                    $startWith_X += $table_header_sub_info_width;
                }else{
                    //$pdf->Cell($table_header_sub_info_width, $text_column_height, '',1,0,'C',1);
                }

                $pdf->SetXY($startWith_X,$startWith_Y);
                if($title->program_id != 612 && $title->program_id != 609){
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $finalMarks,1,0,'C',1);
                    $startWith_X += $table_header_sub_info_width;
                }else{
                    // $pdf->Cell($table_header_sub_info_width, $text_column_height, '',1,0,'C',1);
                }
                if($title->program_id != 612 && $title->program_id != 609){
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $finalGrade,1,0,'C',1);
                    $startWith_X += $table_header_sub_info_width;
                }else{

                    $pdf->SetXY($startWith_X_junior,$startWith_Y);
                    $pdf->Cell(44.2, $text_column_height, $finalGrade,1,0,'C',1);

                    $startWith_X += 44.2;

                }                

                if($i == 7){break;}
                $i++;
            }

            $startWith_Y += $text_column_height;
        }







        /*************** Class Average
        /******************************/
        $pdf->setTextColor($text_fontColor_r, $text_fontColor_g, $text_fontColor_b);
        $pdf->SetFillColor($BG_text_fontColor_r, $BG_text_fontColor_g, $BG_text_fontColor_b);

        $dataFlowX = $ReportStarting_X + $text_column_width_sno + $text_column_width_gsid;
        $dataFlowY = $startWith_Y + 4;

        $startWith_X = $dataFlowX;
        $startWith_Y = $dataFlowY;

        $pdf->SetXY($startWith_X,$startWith_Y);
        $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'Class Average',1,0,'L',1);

        $startWith_Y += $text_column_height;
        $pdf->SetXY($startWith_X,$startWith_Y);
        $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'Above Average',1,0,'L',1);

        $startWith_Y += $text_column_height;
        $pdf->SetXY($startWith_X,$startWith_Y);
        $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'Below Average',1,0,'L',1);



        /*************** Class Grading
        /******************************/
        $startWith_X = $dataFlowX;
        $startWith_Y += $text_column_height + 4;

        $pdf->SetXY($startWith_X,$startWith_Y);
        $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'A+',1,0,'L',1);

        $startWith_Y += $text_column_height;
        $pdf->SetXY($startWith_X,$startWith_Y);
        $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'A',1,0,'L',1);

        $startWith_Y += $text_column_height;
        $pdf->SetXY($startWith_X,$startWith_Y);
        $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'B+',1,0,'L',1);

        $startWith_Y += $text_column_height;
        $pdf->SetXY($startWith_X,$startWith_Y);
        $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'B',1,0,'L',1);

        $startWith_Y += $text_column_height;
        $pdf->SetXY($startWith_X,$startWith_Y);
        $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'C+',1,0,'L',1);

        $startWith_Y += $text_column_height;
        $pdf->SetXY($startWith_X,$startWith_Y);
        $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'C',1,0,'L',1);








        $i=1;
        $thisText = '';
        $startWith_Y = $dataFlowY;
        $dataFlowX = $startWith_X+$text_column_width_abname+$text_column_width_status;
        $startWith_X = $dataFlowX;
        foreach ($data['assessment_titles'] as $title) {
            /************************************** Class Average
            ******************************************************/
            $startWith_Y = $dataFlowY;
            $thisText = '';
            $formativeTotal = ''; $summativeTotal = '';
            $formativeTotalAverage = ''; $summativeTotalAverage = '';
            $formativeTotalAverageB = ''; $summativeTotalAverageB = '';
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subjectname]['ft'])){
                $formativeTotal = ROUND(array_sum($studentMarks[$title->subjectname]['ft']) / count($studentMarks[$title->subjectname]['ft']), 0);
            }
            $thisText = $formativeTotal;
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
            /************************************** Above Average
            ******************************************************/
            $thisText = '';
            $startWith_Y += $text_column_height;
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subjectname]['ft'])){
                $formativeTotalAverage = $this->assessment_report_model->getCountOf_GreaterOnly_2d($studentMarks[$title->subjectname]['ft'], $formativeTotal);   
            }
            $thisText = $formativeTotalAverage;
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
            /************************************** Below Average
            ******************************************************/
            $thisText = '';
            $startWith_Y += $text_column_height;
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subjectname]['ft'])){
                $formativeTotalAverageB = $this->assessment_report_model->getCountOf_LessOnly_2d($studentMarks[$title->subjectname]['ft'], $formativeTotal);
            }
            $thisText = $formativeTotalAverageB;
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');

            /************************** APlus * A * B * C * D * U
            ******************************************************/
            $startWith_Y += $text_column_height + 4;
            $thisText = '';
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subjectname]['ftgd'])){
                $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['ftgd'], 'A+');
            }
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


            $startWith_Y += $text_column_height;
            $thisText = '';
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subjectname]['ftgd'])){
                $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['ftgd'], 'A');
            }
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


            $startWith_Y += $text_column_height;
            $thisText = '';
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subjectname]['ftgd'])){
                $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['ftgd'], 'B+');
            }
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


            $startWith_Y += $text_column_height;
            $thisText = '';
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subjectname]['ftgd'])){
                $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['ftgd'], 'B');
            }
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


            $startWith_Y += $text_column_height;
            $thisText = '';
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subjectname]['ftgd'])){
                $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['ftgd'], 'C+');
            }
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


            $startWith_Y += $text_column_height;
            $thisText = '';
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subjectname]['ftgd'])){
                $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['ftgd'], 'C');
            }
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');












            /************************************** Class Average
            ******************************************************/
            $thisText = '';
            $startWith_Y = $dataFlowY;
            $startWith_X += $table_header_sub_info_width;
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subjectname]['st'])){
                $summativeTotal = ROUND(array_sum($studentMarks[$title->subjectname]['st']) / count($studentMarks[$title->subjectname]['st']), 0);    
                $thisText = $summativeTotal;
            }            
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
            /************************************** Above Average
            ******************************************************/
            $thisText = '';
            $startWith_Y += $text_column_height;
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subjectname]['st'])){
                $summativeTotalAverage = $this->assessment_report_model->getCountOf_GreaterOnly_2d($studentMarks[$title->subjectname]['st'], $summativeTotal);
                $thisText = $summativeTotalAverage;
            }
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
            /************************************** Below Average
            ******************************************************/
            $thisText = '';
            $startWith_Y += $text_column_height;
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subjectname]['st'])){
                $summativeTotalAverageB = $this->assessment_report_model->getCountOf_LessOnly_2d($studentMarks[$title->subjectname]['st'], $summativeTotal);
                $thisText = $summativeTotalAverageB;
            }
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');

            /************************** APlus * A * B * C * D * U
            ******************************************************/
            $startWith_Y += $text_column_height + 4;
            $thisText = '';
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subjectname]['stgd'])){
                $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['stgd'], 'A+');
            }
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


            $startWith_Y += $text_column_height;
            $thisText = '';
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subjectname]['stgd'])){
                $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['stgd'], 'A');
            }
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


            $startWith_Y += $text_column_height;
            $thisText = '';
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subjectname]['stgd'])){
                $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['stgd'], 'B+');
            }
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


            $startWith_Y += $text_column_height;
            $thisText = '';
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subjectname]['stgd'])){
                $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['stgd'], 'B');
            }
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


            $startWith_Y += $text_column_height;
            $thisText = '';
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subjectname]['stgd'])){
                $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['stgd'], 'C+');
            }
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


            $startWith_Y += $text_column_height;
            $thisText = '';
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subjectname]['stgd'])){
                $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['stgd'], 'C');
            }
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');












            /************************************** Class Average
            ******************************************************/
            $thisText = '';
            $startWith_Y = $dataFlowY;
            $startWith_X += $table_header_sub_info_width;
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subjectname]['st'])){
                $thisText = ROUND(($formativeTotal + $summativeTotal)/2,0); //helloooooo
            }else{
                $thisText = $formativeTotal;
            }
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
            /************************************** Above Average
            ******************************************************/
            $thisText = '';
            $startWith_Y += $text_column_height;
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subjectname]['st'])){
                if(!empty($studentMarks[$title->subjectname]['std_total'])){
                    $thisText = $this->assessment_report_model->getCountOf_GreaterOnly_2d($studentMarks[$title->subjectname]['std_total'], $studentMarks[$title->subjectname]['avg']);
                }else{
                    $thisText = '';
                }                
            }else{
                $thisText = $formativeTotalAverage;
            }
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
            /************************************** Below Average
            ******************************************************/
            $thisText = '';
            $startWith_Y += $text_column_height;
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subjectname]['st'])){
                if(!empty($studentMarks[$title->subjectname]['std_total'])){
                    $thisText = $this->assessment_report_model->getCountOf_LessOnly_2d($studentMarks[$title->subjectname]['std_total'], $studentMarks[$title->subjectname]['avg']);
                }else{
                    $thisText = '';
                }
            }else{
                $thisText = $formativeTotalAverageB;
            }
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');



            /************************** APlus * A * B * C * D * U
            ******************************************************/
            $startWith_Y += $text_column_height + 4;
            $thisText = '';
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subjectname]['gd'])){
                $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['gd'], 'A+');
            }
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


            $startWith_Y += $text_column_height;
            $thisText = '';
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subjectname]['gd'])){
                $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['gd'], 'A');
            }
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


            $startWith_Y += $text_column_height;
            $thisText = '';
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subjectname]['gd'])){
                $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['gd'], 'B+');
            }
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


            $startWith_Y += $text_column_height;
            $thisText = '';
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subjectname]['gd'])){
                $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['gd'], 'B');
            }
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


            $startWith_Y += $text_column_height;
            $thisText = '';
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subjectname]['gd'])){
                $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['gd'], 'C+');
            }
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


            $startWith_Y += $text_column_height;
            $thisText = '';
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subjectname]['gd'])){
                $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['gd'], 'C');
            }
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');












            $startWith_X += $table_header_sub_info_width;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($table_header_sub_info_width, $text_column_height, '',0,0,'C');

            $startWith_X += $table_header_sub_info_width;
            if($i == 7){break;}
            $i++;
        }

        /***********************************************************************************************/


























        if($no_of_subjects > 7){
            $pdf->AddPage();


            /***************************************************************************** Global Variables
            /***********************************************************************************************/
            $ReportStarting_X = 10;
            $ReportStarting_Y = 2;
            $startWith_X = $ReportStarting_X;
            $startWith_Y = $ReportStarting_Y;
            /***********************************************************************************************/
            


            



            /******************************************************************************** Report Footer
            /***********************************************************************************************/
            $pdf->SetFont($text_font_name,'',$text_font_size);
            $this->load->model('staff/staff_registered_model');
            $this->data['staff_registered_data'] = $this->staff_registered_model->get_by(array('user_id' => (int)$this->session->userdata('user_id')));
            $thisText = ucwords($this->data['staff_registered_data'][0]->abridged_name);
            $pdf->SetFillColor(0,0,0);
            $pdf->SetTextColor(255, 255, 255);
            $pdf->SetXY($ReportStarting_X,$pdf->h-15);
            $pdf->Cell(72, 4, $now_date . ' ( '.$thisText.' )', 1, 0, 'L', 1);

            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetXY($pdf->w-30,$pdf->h-15);
            $pdf->Cell(20, 4, 'Page 2 / ' . ceil(($no_of_subjects+2.5)/7), 0, 0, 'L');



            /****************************************************************************** Report Heading
            /***********************************************************************************************/
            $pdf->setTextColor($text_fontColor_r, $text_fontColor_g, $text_fontColor_b);
            $pdf->SetFillColor($BG_text_fontColor_r, $BG_text_fontColor_g, $BG_text_fontColor_b);
            $used_height_y = 10;
            $pdf->SetFont($heading_font_name,'',$heading_font_size);
            $header_width = $pdf->w - $ReportStarting_X*2;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($header_width, $used_height_y, "Generation's School",0,0,'C');


            $startWith_Y += $used_height_y;
            $used_height_y = 10;
            $pdf->SetFont($sub_heading_font_name,'',$sub_heading_font_size);
            $header_width = ($pdf->w - $ReportStarting_X*2)/4;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($header_width, $used_height_y, "Co-Teacher : ".$data['students_gs_data'][0]->co_teacher,0,0,'L');

            $pdf->SetFont($sub_heading_font_name,'',$sub_heading_font_size);
            $header_width = ($pdf->w - $ReportStarting_X*2)/4;
            $pdf->SetXY($pdf->w-($pdf->w/4)- $ReportStarting_X/2,$startWith_Y);
            $pdf->Cell($header_width, $used_height_y, "Class Teacher : ".$data['students_gs_data'][0]->class_teacher,0,0,'R');


            $sub_heading_font_size = 16;
            $pdf->SetFont($sub_heading_font_name,'',$sub_heading_font_size);
            $header_width = $pdf->w - $ReportStarting_X*2;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($header_width, $used_height_y, $class . $TermReportTitle,0,0,'C');

            /***************** Sub Headings
            /***** Student Information
            /******************************/
            $dataFlowX = $startWith_X;
            $startWith_Y += $used_height_y;
            $pdf->SetFont($table_header_font_name,'B',$table_header_font_size);
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($text_column_width_sno, $table_header_height, 'S.No.',1,0,'C');

            $startWith_X += $text_column_width_sno;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($text_column_width_gsid, $table_header_height, 'GS-ID',1,0,'C');

            $startWith_X += $text_column_width_gsid;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($text_column_width_abname, $table_header_height, 'Abridged Name',1,0,'L');

            $startWith_X += $text_column_width_abname;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($text_column_width_status, $table_header_height, 'Status',1,0,'C');


            $i=1;
            $dataFlowY =  $startWith_Y;
            $dataFlowX = $startWith_X - $text_column_width_abname - $text_column_width_gsid - $text_column_width_sno;
            $pdf->SetFont($text_font_name,'',$text_font_size);
            foreach ($data['students_gs_data'] as $student) {
                $startWith_X = $startWith_X - $text_column_width_abname - $text_column_width_gsid - $text_column_width_sno;
                $startWith_Y += $table_header_height;
                $pdf->SetXY($startWith_X,$startWith_Y);
                $pdf->Cell($text_column_width_sno, $text_column_height, $i,1,0,'C');

                $startWith_X += $text_column_width_sno;
                $pdf->SetXY($startWith_X,$startWith_Y);
                $pdf->Cell($text_column_width_gsid, $text_column_height, $student->gs_id,1,0,'C');

                $startWith_X += $text_column_width_gsid;
                $pdf->SetXY($startWith_X,$startWith_Y);
                $pdf->Cell($text_column_width_abname, $text_column_height, $student->abridged_name,1,0,'L');

                $startWith_X += $text_column_width_abname;
                $pdf->SetXY($startWith_X,$startWith_Y);
                $pdf->Cell($text_column_width_status, $text_column_height, $student->std_status_code,1,0,'C');
                

                $i++;
                $startWith_Y = $startWith_Y - ($table_header_height-$text_column_height);
            }

            /***** Grade Subjects
            /******************************/

            $dataFlowX = $dataFlowX + $text_column_width_abname + $text_column_width_gsid + $text_column_width_sno + $text_column_width_status;
            $startWith_X = $dataFlowX;
            $startWith_Y = $dataFlowY;
            $pdf->SetFont($table_header_font_name,'B',$table_header_font_size);
            $i=1;
            foreach ($data['assessment_titles'] as $title) {
                if($i>7){
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    $pdf->Cell($table_header_sub_width, $table_header_sub_height, $title->subjectname,1,0,'C');

                    $startWith_X += $table_header_sub_width;
                }

                if($i == 14){break;}
                $i++;
            }
            $i=1;
            $startWith_X = $dataFlowX;
            $startWith_Y += $table_header_sub_height;
            foreach ($data['assessment_titles'] as $title) {
                if($i>7){
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    $pdf->Cell($table_header_sub_info_width, $table_header_sub_height, 'FT',1,0,'C');

                    $startWith_X += $table_header_sub_info_width;
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    $pdf->Cell($table_header_sub_info_width, $table_header_sub_height, 'ST',1,0,'C');

                    $startWith_X += $table_header_sub_info_width;
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    $pdf->Cell($table_header_sub_info_width, $table_header_sub_height, 'T',1,0,'C');

                    $startWith_X += $table_header_sub_info_width;
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    $pdf->Cell($table_header_sub_info_width, $table_header_sub_height, 'G',1,0,'C');

                    $startWith_X += $table_header_sub_info_width;


                }
            
                if($i == 14){break;}
                $i++;
            }




            $formativeMarks = '';
            $summativeMarks = '';
            $finalMarks = '';
            $finalGrade = '';
            $record_found = false;
            $startWith_Y += $table_header_sub_height;
            $pdf->SetFont($text_font_name,'',$text_font_size);
            foreach ($data['students_gs_data'] as $student) {

                $i = 1;
                $startWith_X = $dataFlowX;
                foreach ($data['assessment_titles'] as $title) {
                    if($i>7){
                        $formativeMarks = '';
                        $summativeMarks = '';
                        foreach ($data['assessment_marks'] as $marks) {
                            if($marks->gs_id == $student->gs_id
                               && $marks->subject_name == $title->subjectname){
                                if($marks->assessment_type_id == 1 && $marks->ass_per_mrk >= 0){
                                    $formativeMarks = $marks->ass_per_mrk;
                                }else if($marks->assessment_type_id == 2 && $marks->ass_per_mrk >= 0){
                                    $summativeMarks = $marks->ass_per_mrk;
                                    break;
                                }  
                            }
                        }


                        $finalMarks = '';
                        $finalGrade = '';
                        $fontColor_r = $text_fontColor_r;
                        $fontColor_g = $text_fontColor_g;
                        $fontColor_b = $text_fontColor_b;

                        $BG_fontColor_r = $BG_text_fontColor_r;
                        $BG_fontColor_g = $BG_text_fontColor_g;
                        $BG_fontColor_b = $BG_text_fontColor_b;
                        $pdf->setTextColor($fontColor_r, $fontColor_g, $fontColor_b);
                        $pdf->setFillColor($BG_fontColor_r, $BG_fontColor_g, $BG_fontColor_b);
                        foreach ($data['assessment_grade'] as $grade) {
                            if($grade->gs_id == $student->gs_id
                               && $grade->subject_name == $title->subjectname){
                                $finalMarks = $grade->ass_per_mrk;
                                $finalGrade = $grade->grade;

                                if($grade->grade=='A+'){
                                    $fontColor_r = $grade_Ap_r_FontColor;
                                    $fontColor_g = $grade_Ap_g_FontColor;
                                    $fontColor_b = $grade_Ap_b_FontColor;

                                    $BG_fontColor_r = $BG_grade_Ap_r_FontColor;
                                    $BG_fontColor_g = $BG_grade_Ap_g_FontColor;
                                    $BG_fontColor_b = $BG_grade_Ap_b_FontColor;
                                }else if($grade->grade=='A'){
                                    $fontColor_r = $grade_A_r_FontColor;
                                    $fontColor_g = $grade_A_g_FontColor;
                                    $fontColor_b = $grade_A_b_FontColor;

                                    $BG_fontColor_r = $BG_grade_A_r_FontColor;
                                    $BG_fontColor_g = $BG_grade_A_g_FontColor;
                                    $BG_fontColor_b = $BG_grade_A_b_FontColor;
                                }else if($grade->grade=='B+'){
                                    $fontColor_r = $grade_B_r_FontColor;
                                    $fontColor_g = $grade_B_g_FontColor;
                                    $fontColor_b = $grade_B_b_FontColor;

                                    $BG_fontColor_r = $BG_grade_B_r_FontColor;
                                    $BG_fontColor_g = $BG_grade_B_g_FontColor;
                                    $BG_fontColor_b = $BG_grade_B_b_FontColor;
                                }else if($grade->grade=='B'){
                                    $fontColor_r = $grade_C_r_FontColor;
                                    $fontColor_g = $grade_C_g_FontColor;
                                    $fontColor_b = $grade_C_b_FontColor;

                                    $BG_fontColor_r = $BG_grade_C_r_FontColor;
                                    $BG_fontColor_g = $BG_grade_C_g_FontColor;
                                    $BG_fontColor_b = $BG_grade_C_b_FontColor;
                                }else if($grade->grade=='C+'){
                                    $fontColor_r = $grade_D_r_FontColor;
                                    $fontColor_g = $grade_D_g_FontColor;
                                    $fontColor_b = $grade_D_b_FontColor;

                                    $BG_fontColor_r = $BG_grade_D_r_FontColor;
                                    $BG_fontColor_g = $BG_grade_D_g_FontColor;
                                    $BG_fontColor_b = $BG_grade_D_b_FontColor;
                                }else if($grade->grade=='C'){
                                    $fontColor_r = $grade_U_r_FontColor;
                                    $fontColor_g = $grade_U_g_FontColor;
                                    $fontColor_b = $grade_U_b_FontColor;

                                    $BG_fontColor_r = $BG_grade_U_r_FontColor;
                                    $BG_fontColor_g = $BG_grade_U_g_FontColor;
                                    $BG_fontColor_b = $BG_grade_U_b_FontColor;
                                }
                                break;
                            }
                        }


                        $pdf->setTextColor($fontColor_r, $fontColor_g, $fontColor_b);
                        $pdf->setFillColor($BG_fontColor_r, $BG_fontColor_g, $BG_fontColor_b);
                        $pdf->SetXY($startWith_X,$startWith_Y);
                        if($title->program_id != 612 && $title->program_id != 609 ){
                            $pdf->Cell($table_header_sub_info_width, $text_column_height, $formativeMarks,1,0,'C',1);
                        }else{
                             $pdf->Cell($table_header_sub_info_width, $text_column_height, '',1,0,'C',1);
                        }

                        $startWith_X += $table_header_sub_info_width;
                        $pdf->SetXY($startWith_X,$startWith_Y);
                        if($title->program_id != 612 && $title->program_id != 609 ){
                            $pdf->Cell($table_header_sub_info_width, $text_column_height, $summativeMarks,1,0,'C',1);
                        }else{
                            $pdf->Cell($table_header_sub_info_width, $text_column_height, '',1,0,'C',1);
                        }

                        $startWith_X += $table_header_sub_info_width;
                        $pdf->SetXY($startWith_X,$startWith_Y);
                        if($title->program_id != 612 && $title->program_id != 609 ){
                            $pdf->Cell($table_header_sub_info_width, $text_column_height, $finalMarks,1,0,'C',1);
                        }else{
                            $pdf->Cell($table_header_sub_info_width, $text_column_height, '',1,0,'C',1);
                        }
                        $startWith_X += $table_header_sub_info_width;
                        $pdf->SetXY($startWith_X,$startWith_Y);
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, $finalGrade,1,0,'C',1);

                        $startWith_X += $table_header_sub_info_width;                

                        if($i == 14){break;}
                    }
                    $i++;
                }

                $startWith_Y += $text_column_height;
            }








            /*************** Class Average
            /******************************/
            $pdf->setTextColor($text_fontColor_r, $text_fontColor_g, $text_fontColor_b);
            $pdf->SetFillColor($BG_text_fontColor_r, $BG_text_fontColor_g, $BG_text_fontColor_b);

            $dataFlowX = $ReportStarting_X + $text_column_width_sno + $text_column_width_gsid;
            $dataFlowY = $startWith_Y + 4;

            $startWith_X = $dataFlowX;
            $startWith_Y = $dataFlowY;

            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'Class Average',1,0,'L',1);

            $startWith_Y += $text_column_height;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'Above Average',1,0,'L',1);

            $startWith_Y += $text_column_height;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'Below Average',1,0,'L',1);

            /*************** Class Grading
            /******************************/
            $startWith_X = $dataFlowX;
            $startWith_Y += $text_column_height + 4;

            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'A+',1,0,'L',1);

            $startWith_Y += $text_column_height;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'A',1,0,'L',1);

            $startWith_Y += $text_column_height;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'B+',1,0,'L',1);

            $startWith_Y += $text_column_height;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'B',1,0,'L',1);

            $startWith_Y += $text_column_height;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'C+',1,0,'L',1);

            $startWith_Y += $text_column_height;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'C',1,0,'L',1);






            $i=1;
            $thisText = '';
            $startWith_Y = $dataFlowY;
            $dataFlowX = $startWith_X+$text_column_width_abname+$text_column_width_status;
            $startWith_X = $dataFlowX;
            foreach ($data['assessment_titles'] as $title) {
                if($i>7){
                    /************************************** Class Average
                    ******************************************************/
                    $startWith_Y = $dataFlowY;
                    $thisText = '';
                    $formativeTotal = ''; $summativeTotal = '';
                    $formativeTotalAverage = ''; $summativeTotalAverage = '';
                    $formativeTotalAverageB = ''; $summativeTotalAverageB = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['ft'])){
                        $formativeTotal = ROUND(array_sum($studentMarks[$title->subjectname]['ft']) / count($studentMarks[$title->subjectname]['ft']), 0);
                    }
                    $thisText = $formativeTotal;
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
                    /************************************** Above Average
                    ******************************************************/
                    $thisText = '';
                    $startWith_Y += $text_column_height;
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['ft'])){
                        $formativeTotalAverage = $this->assessment_report_model->getCountOf_GreaterOnly_2d($studentMarks[$title->subjectname]['ft'], $formativeTotal);           
                    }
                    $thisText = $formativeTotalAverage;
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
                    /************************************** Below Average
                    ******************************************************/
                    $thisText = '';
                    $startWith_Y += $text_column_height;
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['ft'])){
                        $formativeTotalAverageB = $this->assessment_report_model->getCountOf_LessOnly_2d($studentMarks[$title->subjectname]['ft'], $formativeTotal);
                    }
                    $thisText = $formativeTotalAverageB;
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');

                    /************************** APlus * A * B * C * D * U
                    ******************************************************/
                    $startWith_Y += $text_column_height + 4;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['ftgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['ftgd'], 'A+');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['ftgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['ftgd'], 'A');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['ftgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['ftgd'], 'B+');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['ftgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['ftgd'], 'B');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['ftgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['ftgd'], 'C+');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['ftgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['ftgd'], 'C');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');












                    /************************************** Class Average
                    ******************************************************/
                    $thisText = '';
                    $startWith_Y = $dataFlowY;
                    $startWith_X += $table_header_sub_info_width;
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['st'])){
                        $summativeTotal = ROUND(array_sum($studentMarks[$title->subjectname]['st']) / count($studentMarks[$title->subjectname]['ft']), 0);    
                        $thisText = $summativeTotal;
                    }            
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
                    /************************************** Above Average
                    ******************************************************/
                    $thisText = '';
                    $startWith_Y += $text_column_height;
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['st'])){
                        $summativeTotalAverage = $this->assessment_report_model->getCountOf_GreaterOnly_2d($studentMarks[$title->subjectname]['st'], $summativeTotal);
                        $thisText = $summativeTotalAverage;
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
                    /************************************** Below Average
                    ******************************************************/
                    $thisText = '';
                    $startWith_Y += $text_column_height;
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['st'])){
                        $summativeTotalAverageB = $this->assessment_report_model->getCountOf_LessOnly_2d($studentMarks[$title->subjectname]['st'], $summativeTotal);
                        $thisText = $summativeTotalAverageB;
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');

                    /************************** APlus * A * B * C * D * U
                    ******************************************************/
                    $startWith_Y += $text_column_height + 4;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['stgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['stgd'], 'A+');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['stgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['stgd'], 'A');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['stgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['stgd'], 'B+');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['stgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['stgd'], 'B');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['stgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['stgd'], 'C+');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['stgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['stgd'], 'C');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');












                    /************************************** Class Average
                    ******************************************************/
                    $thisText = '';
                    $startWith_Y = $dataFlowY;
                    $startWith_X += $table_header_sub_info_width;
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['st'])){
                        $thisText = ROUND(($formativeTotal + $summativeTotal)/2,0);
                    }else{
                        $thisText = $formativeTotal;
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
                    /************************************** Above Average
                    ******************************************************/
                    $thisText = '';
                    $startWith_Y += $text_column_height;
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['st'])){
                        if(!empty($studentMarks[$title->subjectname]['std_total'])){
                            $thisText = $this->assessment_report_model->getCountOf_GreaterOnly_2d($studentMarks[$title->subjectname]['std_total'], $studentMarks[$title->subjectname]['avg']);
                        }else{
                            $thisText = '';
                        }
                    }else{
                        $thisText = $formativeTotalAverage;
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
                    /************************************** Below Average
                    ******************************************************/
                    $thisText = '';
                    $startWith_Y += $text_column_height;
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['st'])){
                        if(!empty($studentMarks[$title->subjectname]['std_total'])){
                            $thisText = $this->assessment_report_model->getCountOf_LessOnly_2d($studentMarks[$title->subjectname]['std_total'], $studentMarks[$title->subjectname]['avg']);
                        }else{
                            $thisText = '';
                        }
                    }else{
                        $thisText = $formativeTotalAverageB;
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');



                    /************************** APlus * A * B * C * D * U
                    ******************************************************/
                    $startWith_Y += $text_column_height + 4;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['gd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['gd'], 'A+');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['gd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['gd'], 'A');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['gd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['gd'], 'B+');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['gd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['gd'], 'B');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['gd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['gd'], 'C+');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['gd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['gd'], 'C');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');











                    $startWith_X += $table_header_sub_info_width;
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, '',0,0,'C');

                    $startWith_X += $table_header_sub_info_width;
                }

                if($i == 14){break;}
                $i++;
            }
            /***********************************************************************************************/
        }























        if($no_of_subjects > 14){
            $pdf->AddPage();


            /***************************************************************************** Global Variables
            /***********************************************************************************************/
            $ReportStarting_X = 10;
            $ReportStarting_Y = 2;
            $startWith_X = $ReportStarting_X;
            $startWith_Y = $ReportStarting_Y;
            /***********************************************************************************************/
            


            






            /******************************************************************************** Report Footer
            /***********************************************************************************************/
            $pdf->SetFont($text_font_name,'',$text_font_size);
            $this->load->model('staff/staff_registered_model');
            $this->data['staff_registered_data'] = $this->staff_registered_model->get_by(array('user_id' => (int)$this->session->userdata('user_id')));
            $thisText = ucwords($this->data['staff_registered_data'][0]->abridged_name);
            $pdf->SetFillColor(0,0,0);
            $pdf->SetTextColor(255, 255, 255);
            $pdf->SetXY($ReportStarting_X,$pdf->h-15);
            $pdf->Cell(72, 4, $now_date . ' ( '.$thisText.' )', 1, 0, 'L', 1);

            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetXY($pdf->w-30,$pdf->h-15);
            $pdf->Cell(20, 4, 'Page 3 / ' . ceil(($no_of_subjects+2.5)/7), 0, 0, 'L');

            /****************************************************************************** Report Heading
            /***********************************************************************************************/
            $pdf->setTextColor($text_fontColor_r, $text_fontColor_g, $text_fontColor_b);
            $pdf->SetFillColor($BG_text_fontColor_r, $BG_text_fontColor_g, $BG_text_fontColor_b);
            $used_height_y = 10;
            $pdf->SetFont($heading_font_name,'',$heading_font_size);
            $header_width = $pdf->w - $ReportStarting_X*2;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($header_width, $used_height_y, "Generation's School",0,0,'C');


            $startWith_Y += $used_height_y;
            $used_height_y = 10;
            $pdf->SetFont($sub_heading_font_name,'',$sub_heading_font_size);
            $header_width = ($pdf->w - $ReportStarting_X*2)/4;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($header_width, $used_height_y, "Co-Teacher : ".$data['students_gs_data'][0]->co_teacher,0,0,'L');

            $pdf->SetFont($sub_heading_font_name,'',$sub_heading_font_size);
            $header_width = ($pdf->w - $ReportStarting_X*2)/4;
            $pdf->SetXY($pdf->w-($pdf->w/4)- $ReportStarting_X/2,$startWith_Y);
            $pdf->Cell($header_width, $used_height_y, "Class Teacher : ".$data['students_gs_data'][0]->class_teacher,0,0,'R');


            $sub_heading_font_size = 16;
            $pdf->SetFont($sub_heading_font_name,'',$sub_heading_font_size);
            $header_width = $pdf->w - $ReportStarting_X*2;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($header_width, $used_height_y, $class . $TermReportTitle,0,0,'C');

            /***************** Sub Headings
            /***** Student Information
            /******************************/
            $dataFlowX = $startWith_X;
            $startWith_Y += $used_height_y;
            $pdf->SetFont($table_header_font_name,'B',$table_header_font_size);
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($text_column_width_sno, $table_header_height, 'S.No.',1,0,'C');

            $startWith_X += $text_column_width_sno;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($text_column_width_gsid, $table_header_height, 'GS-ID',1,0,'C');

            $startWith_X += $text_column_width_gsid;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($text_column_width_abname, $table_header_height, 'Abridged Name',1,0,'L');

            $startWith_X += $text_column_width_abname;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($text_column_width_status, $table_header_height, 'Status',1,0,'C');


            $i=1;
            $dataFlowY =  $startWith_Y;
            $dataFlowX = $startWith_X - $text_column_width_abname - $text_column_width_gsid - $text_column_width_sno;
            $pdf->SetFont($text_font_name,'',$text_font_size);
            foreach ($data['students_gs_data'] as $student) {
                $startWith_X = $startWith_X - $text_column_width_abname - $text_column_width_gsid - $text_column_width_sno;
                $startWith_Y += $table_header_height;
                $pdf->SetXY($startWith_X,$startWith_Y);
                $pdf->Cell($text_column_width_sno, $text_column_height, $i,1,0,'C');

                $startWith_X += $text_column_width_sno;
                $pdf->SetXY($startWith_X,$startWith_Y);
                $pdf->Cell($text_column_width_gsid, $text_column_height, $student->gs_id,1,0,'C');

                $startWith_X += $text_column_width_gsid;
                $pdf->SetXY($startWith_X,$startWith_Y);
                $pdf->Cell($text_column_width_abname, $text_column_height, $student->abridged_name,1,0,'L');

                $startWith_X += $text_column_width_abname;
                $pdf->SetXY($startWith_X,$startWith_Y);
                $pdf->Cell($text_column_width_status, $text_column_height, $student->std_status_code,1,0,'C');
                

                $i++;
                $startWith_Y = $startWith_Y - ($table_header_height-$text_column_height);
            }

            /***** Grade Subjects
            /******************************/

            $dataFlowX = $dataFlowX + $text_column_width_abname + $text_column_width_gsid + $text_column_width_sno + $text_column_width_status;
            $startWith_X = $dataFlowX;
            $startWith_Y = $dataFlowY;
            $pdf->SetFont($table_header_font_name,'B',$table_header_font_size);
            $i=1;
            foreach ($data['assessment_titles'] as $title) {
                if($i>14){
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    $pdf->Cell($table_header_sub_width, $table_header_sub_height, $title->subjectname,1,0,'C');

                    $startWith_X += $table_header_sub_width;
                }

                if($i == 21){break;}
                $i++;
            }
            $i=1;
            $startWith_X = $dataFlowX;
            $startWith_Y += $table_header_sub_height;
            foreach ($data['assessment_titles'] as $title) {
                if($i>14){
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    $pdf->Cell($table_header_sub_info_width, $table_header_sub_height, 'FT',1,0,'C');

                    $startWith_X += $table_header_sub_info_width;
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    $pdf->Cell($table_header_sub_info_width, $table_header_sub_height, 'ST',1,0,'C');

                    $startWith_X += $table_header_sub_info_width;
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    $pdf->Cell($table_header_sub_info_width, $table_header_sub_height, 'T',1,0,'C');

                    $startWith_X += $table_header_sub_info_width;
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    $pdf->Cell($table_header_sub_info_width, $table_header_sub_height, 'G',1,0,'C');

                    $startWith_X += $table_header_sub_info_width;
                }
            
                if($i == 21){break;}
                $i++;
            }




            $formativeMarks = '';
            $summativeMarks = '';
            $finalMarks = '';
            $finalGrade = '';
            $record_found = false;
            $startWith_Y += $table_header_sub_height;
            $pdf->SetFont($text_font_name,'',$text_font_size);
            foreach ($data['students_gs_data'] as $student) {

                $i = 1;
                $startWith_X = $dataFlowX;
                foreach ($data['assessment_titles'] as $title) {
                    if($i>14){
                        $formativeMarks = '';
                        $summativeMarks = '';
                        foreach ($data['assessment_marks'] as $marks) {
                            if($marks->gs_id == $student->gs_id
                               && $marks->subject_name == $title->subjectname){
                                if($marks->assessment_type_id == 1 && $marks->ass_per_mrk >= 0){
                                    $formativeMarks = $marks->ass_per_mrk;
                                }else if($marks->assessment_type_id == 2 && $marks->ass_per_mrk >= 0){
                                    $summativeMarks = $marks->ass_per_mrk;
                                    break;
                                }  
                            }
                        }


                        $finalMarks = '';
                        $finalGrade = '';
                        $fontColor_r = $text_fontColor_r;
                        $fontColor_g = $text_fontColor_g;
                        $fontColor_b = $text_fontColor_b;

                        $BG_fontColor_r = $BG_text_fontColor_r;
                        $BG_fontColor_g = $BG_text_fontColor_g;
                        $BG_fontColor_b = $BG_text_fontColor_b;
                        $pdf->setTextColor($fontColor_r, $fontColor_g, $fontColor_b);
                        $pdf->setFillColor($BG_fontColor_r, $BG_fontColor_g, $BG_fontColor_b);
                        foreach ($data['assessment_grade'] as $grade) {
                            if($grade->gs_id == $student->gs_id
                               && $grade->subject_name == $title->subjectname){
                                $finalMarks = $grade->ass_per_mrk;
                                $finalGrade = $grade->grade;

                                if($grade->grade=='A+'){
                                    $fontColor_r = $grade_Ap_r_FontColor;
                                    $fontColor_g = $grade_Ap_g_FontColor;
                                    $fontColor_b = $grade_Ap_b_FontColor;

                                    $BG_fontColor_r = $BG_grade_Ap_r_FontColor;
                                    $BG_fontColor_g = $BG_grade_Ap_g_FontColor;
                                    $BG_fontColor_b = $BG_grade_Ap_b_FontColor;
                                }else if($grade->grade=='A'){
                                    $fontColor_r = $grade_A_r_FontColor;
                                    $fontColor_g = $grade_A_g_FontColor;
                                    $fontColor_b = $grade_A_b_FontColor;

                                    $BG_fontColor_r = $BG_grade_A_r_FontColor;
                                    $BG_fontColor_g = $BG_grade_A_g_FontColor;
                                    $BG_fontColor_b = $BG_grade_A_b_FontColor;
                                }else if($grade->grade=='B+'){
                                    $fontColor_r = $grade_B_r_FontColor;
                                    $fontColor_g = $grade_B_g_FontColor;
                                    $fontColor_b = $grade_B_b_FontColor;

                                    $BG_fontColor_r = $BG_grade_B_r_FontColor;
                                    $BG_fontColor_g = $BG_grade_B_g_FontColor;
                                    $BG_fontColor_b = $BG_grade_B_b_FontColor;
                                }else if($grade->grade=='B'){
                                    $fontColor_r = $grade_C_r_FontColor;
                                    $fontColor_g = $grade_C_g_FontColor;
                                    $fontColor_b = $grade_C_b_FontColor;

                                    $BG_fontColor_r = $BG_grade_C_r_FontColor;
                                    $BG_fontColor_g = $BG_grade_C_g_FontColor;
                                    $BG_fontColor_b = $BG_grade_C_b_FontColor;
                                }else if($grade->grade=='C+'){
                                    $fontColor_r = $grade_D_r_FontColor;
                                    $fontColor_g = $grade_D_g_FontColor;
                                    $fontColor_b = $grade_D_b_FontColor;

                                    $BG_fontColor_r = $BG_grade_D_r_FontColor;
                                    $BG_fontColor_g = $BG_grade_D_g_FontColor;
                                    $BG_fontColor_b = $BG_grade_D_b_FontColor;
                                }else if($grade->grade=='C'){
                                    $fontColor_r = $grade_U_r_FontColor;
                                    $fontColor_g = $grade_U_g_FontColor;
                                    $fontColor_b = $grade_U_b_FontColor;

                                    $BG_fontColor_r = $BG_grade_U_r_FontColor;
                                    $BG_fontColor_g = $BG_grade_U_g_FontColor;
                                    $BG_fontColor_b = $BG_grade_U_b_FontColor;
                                }
                                break;
                            }
                        }


                        $pdf->setTextColor($fontColor_r, $fontColor_g, $fontColor_b);
                        $pdf->setFillColor($BG_fontColor_r, $BG_fontColor_g, $BG_fontColor_b);
                        $pdf->SetXY($startWith_X,$startWith_Y);
                        if($title->program_id != 612 && $title->program_id != 609 ){
                            $pdf->Cell($table_header_sub_info_width, $text_column_height, $formativeMarks,1,0,'C',1);
                        }else{
                             $pdf->Cell($table_header_sub_info_width, $text_column_height,'',1,0,'C',1);
                        }
                        $startWith_X += $table_header_sub_info_width;
                        $pdf->SetXY($startWith_X,$startWith_Y);
                        if($title->program_id != 612 && $title->program_id != 609 ){
                            $pdf->Cell($table_header_sub_info_width, $text_column_height, $summativeMarks,1,0,'C',1);
                        }else{
                            $pdf->Cell($table_header_sub_info_width, $text_column_height,'',1,0,'C',1);
                        }

                        $startWith_X += $table_header_sub_info_width;
                        $pdf->SetXY($startWith_X,$startWith_Y);
                        if($title->program_id != 612 && $title->program_id != 609 ){
                            $pdf->Cell($table_header_sub_info_width, $text_column_height, $finalMarks,1,0,'C',1);
                        }else{
                            $pdf->Cell($table_header_sub_info_width, $text_column_height, '',1,0,'C',1);
                        }
                        $startWith_X += $table_header_sub_info_width;
                        $pdf->SetXY($startWith_X,$startWith_Y);
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, $finalGrade,1,0,'C',1);

                        $startWith_X += $table_header_sub_info_width;                

                        if($i == 21){break;}
                    }
                    $i++;
                }

                $startWith_Y += $text_column_height;
            }












            /*************** Class Average ** Here it is
            /******************************/
            $pdf->setTextColor($text_fontColor_r, $text_fontColor_g, $text_fontColor_b);
            $pdf->SetFillColor($BG_text_fontColor_r, $BG_text_fontColor_g, $BG_text_fontColor_b);

            $dataFlowX = $ReportStarting_X + $text_column_width_sno + $text_column_width_gsid;
            $dataFlowY = $startWith_Y + 4;

            $startWith_X = $dataFlowX;
            $startWith_Y = $dataFlowY;

            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'Class Average',1,0,'L',1);

            $startWith_Y += $text_column_height;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'Above Average',1,0,'L',1);

            $startWith_Y += $text_column_height;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'Below Average',1,0,'L',1);

            /*************** Class Grading
            /******************************/
            $startWith_X = $dataFlowX;
            $startWith_Y += $text_column_height + 4;

            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'A+',1,0,'L',1);

            $startWith_Y += $text_column_height;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'A',1,0,'L',1);

            $startWith_Y += $text_column_height;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'B+',1,0,'L',1);

            $startWith_Y += $text_column_height;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'B',1,0,'L',1);

            $startWith_Y += $text_column_height;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'C+',1,0,'L',1);

            $startWith_Y += $text_column_height;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'C',1,0,'L',1);
















            $i=1;
            $thisText = '';
            $startWith_Y = $dataFlowY;
            $dataFlowX = $startWith_X+$text_column_width_abname+$text_column_width_status;
            $startWith_X = $dataFlowX;
            foreach ($data['assessment_titles'] as $title) {
                if($i>14){
                    /************************************** Class Average
                    ******************************************************/
                    $startWith_Y = $dataFlowY;
                    $thisText = '';
                    $formativeTotal = ''; $summativeTotal = '';
                    $formativeTotalAverage = ''; $summativeTotalAverage = '';
                    $formativeTotalAverageB = ''; $summativeTotalAverageB = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['ft'])){
                        $formativeTotal = ROUND(array_sum($studentMarks[$title->subjectname]['ft']) / count($studentMarks[$title->subjectname]['ft']), 0);
                    }
                    $thisText = $formativeTotal;
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
                    /************************************** Above Average
                    ******************************************************/
                    $thisText = '';
                    $startWith_Y += $text_column_height;
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['ft'])){
                        $formativeTotalAverage = $this->assessment_report_model->getCountOf_GreaterOnly_2d($studentMarks[$title->subjectname]['ft'], $formativeTotal);           
                    }
                    $thisText = $formativeTotalAverage;
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
                    /************************************** Below Average
                    ******************************************************/
                    $thisText = '';
                    $startWith_Y += $text_column_height;
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['ft'])){
                        $formativeTotalAverageB = $this->assessment_report_model->getCountOf_LessOnly_2d($studentMarks[$title->subjectname]['ft'], $formativeTotal);
                    }
                    $thisText = $formativeTotalAverageB;
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');

                    /************************** APlus * A * B * C * D * U
                    ******************************************************/
                    $startWith_Y += $text_column_height + 4;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['ftgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['ftgd'], 'A+');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['ftgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['ftgd'], 'A');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['ftgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['ftgd'], 'B+');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['ftgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['ftgd'], 'B');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['ftgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['ftgd'], 'C+');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['ftgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['ftgd'], 'C');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');












                    /************************************** Class Average
                    ******************************************************/
                    $thisText = '';
                    $startWith_Y = $dataFlowY;
                    $startWith_X += $table_header_sub_info_width;
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['st'])){
                        $summativeTotal = ROUND(array_sum($studentMarks[$title->subjectname]['st']) / count($studentMarks[$title->subjectname]['ft']), 0);    
                        $thisText = $summativeTotal;
                    }            
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
                    /************************************** Above Average
                    ******************************************************/
                    $thisText = '';
                    $startWith_Y += $text_column_height;
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['st'])){
                        $summativeTotalAverage = $this->assessment_report_model->getCountOf_GreaterOnly_2d($studentMarks[$title->subjectname]['st'], $summativeTotal);
                        $thisText = $summativeTotalAverage;
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
                    /************************************** Below Average
                    ******************************************************/
                    $thisText = '';
                    $startWith_Y += $text_column_height;
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['st'])){
                        $summativeTotalAverageB = $this->assessment_report_model->getCountOf_LessOnly_2d($studentMarks[$title->subjectname]['st'], $summativeTotal);
                        $thisText = $summativeTotalAverageB;
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');

                    /************************** APlus * A * B * C * D * U
                    ******************************************************/
                    $startWith_Y += $text_column_height + 4;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['stgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['stgd'], 'A+');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['stgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['stgd'], 'A');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['stgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['stgd'], 'B+');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['stgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['stgd'], 'B');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['stgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['stgd'], 'C+');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['stgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['stgd'], 'C');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');












                    /************************************** Class Average
                    ******************************************************/
                    $thisText = '';
                    $startWith_Y = $dataFlowY;
                    $startWith_X += $table_header_sub_info_width;
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['st'])){
                        $thisText = ROUND(($formativeTotal + $summativeTotal)/2,0);
                    }else{
                        $thisText = $formativeTotal;
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
                    /************************************** Above Average
                    ******************************************************/
                    $thisText = '';
                    $startWith_Y += $text_column_height;
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['st'])){
                        if(!empty($studentMarks[$title->subjectname]['std_total'])){
                            $thisText = $this->assessment_report_model->getCountOf_GreaterOnly_2d($studentMarks[$title->subjectname]['std_total'], $studentMarks[$title->subjectname]['avg']);
                        }else{
                            $thisText = '';
                        }
                    }else{
                        $thisText = $formativeTotalAverage;
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
                    /************************************** Below Average
                    ******************************************************/
                    $thisText = '';
                    $startWith_Y += $text_column_height;
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['st'])){
                        if(!empty($studentMarks[$title->subjectname]['std_total'])){
                            $thisText = $this->assessment_report_model->getCountOf_LessOnly_2d($studentMarks[$title->subjectname]['std_total'], $studentMarks[$title->subjectname]['avg']);
                        }else{
                            $thisText = '';
                        }
                    }else{
                        $thisText = $formativeTotalAverageB;
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');



                    /************************** APlus * A * B * C * D * U
                    ******************************************************/
                    $startWith_Y += $text_column_height + 4;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['gd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['gd'], 'A+');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['gd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['gd'], 'A');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['gd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['gd'], 'B+');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['gd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['gd'], 'B');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['gd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['gd'], 'C+');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['gd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['gd'], 'C');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');











                    $startWith_X += $table_header_sub_info_width;
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, '',0,0,'C');

                    $startWith_X += $table_header_sub_info_width;
                }

                if($i == 21){break;}
                $i++;
            }
            /***********************************************************************************************/
        }



























        /******************************************************************** Student Horizontal Report
        /***********************************************************************************************/
        $student_h_width = 20;
        $no_of_columns = 5;
        $TotalWidthUsed = 5+($student_h_width)*$no_of_columns;

        if(($startWith_X+$TotalWidthUsed) <= $pdf->w-10){
            $startWith_X += 5;
            $startWith_Y = $ReportStarting_Y+20;

            $pdf->SetFont($table_header_font_name,'B',$table_header_font_size);
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->MultiCell($student_h_width, $table_header_height, ' A S P ',1,'C');

            $startWith_X += $student_h_width;
            $pdf->SetFont($table_header_font_name,'B',$table_header_font_size);
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->MultiCell($student_h_width, $table_header_height/2, 'No. of Subjects',1,'C');

            $startWith_X += $student_h_width;
            $pdf->SetFont($table_header_font_name,'B',$table_header_font_size);
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($student_h_width, $table_header_height, 'Total',1,0,'C');

            $startWith_X += $student_h_width;
            $pdf->SetFont($table_header_font_name,'B',$table_header_font_size);
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($student_h_width, $table_header_height, 'Overall %',1,0,'C');

            $startWith_X += $student_h_width;
            $pdf->SetFont($table_header_font_name,'B',$table_header_font_size);
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($student_h_width, $table_header_height, 'Grade',1,0,'C');

            $startWith_X += $student_h_width;
            $pdf->SetFont($table_header_font_name,'B',$table_header_font_size);
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($student_h_width, $table_header_height, 'Rank',1,0,'C');

            for($k=1; $k<=4; $k++){
                $startWith_X += $student_h_width;
                $pdf->SetFont($table_header_font_name,'B',$table_header_font_size);
                $pdf->SetXY($startWith_X,$startWith_Y);
                $pdf->Cell($student_h_width, $table_header_height, '',1,0,'C');
            }


            $dataFlowY = $startWith_Y + $table_header_height;
            $startWith_Y = $dataFlowY;
            $startWith_X -= ($student_h_width*(($no_of_columns)+4));
            $OverAll_Perc = array(); $OverAll_Perc_count=0;
            foreach ($data['students_gs_data'] as $student) {
                $asp_marks = ''; $thisText_No = '';  $thisText_Total = '';   $thisText_Per = '';     $thisText_Grade = '';   $thisText_Rank = '';

                foreach ($data['assessment_asp'] as $ASP) {
                    if($ASP->gs_id == $student->gs_id){
                        $asp_marks = $ASP->asp_total;
                    }
                }
                /******************** Writing Student Wise Grade Information
                /************************************************************/
                if(!empty($studentMarks[$student->gs_id]['subjects'])){
                    $thisText_No = sizeof($studentMarks[$student->gs_id]['subjects']);
                    $thisText_Total = $studentTotalMarks[$student->gs_id]; 
                    $thisText_Per = ROUND(($thisText_Total / $thisText_No), 1);

                    $grade_Ap_per = 0;
                    $grade_A_per = 0;
                    $grade_B_per = 0;
                    $grade_C_per = 0;
                    $grade_D_per = 0;
                    $grade_U_per = 0;
                    foreach($data['assessment_overall_garde'] as $grading){
                        if($grading->grading_name == 'A+'){$grade_Ap_per = $grading->weightage;}
                        if($grading->grading_name == 'A'){$grade_A_per = $grading->weightage;}
                        if($grading->grading_name == 'B+'){$grade_B_per = $grading->weightage;}
                        if($grading->grading_name == 'B'){$grade_C_per = $grading->weightage;}
                        if($grading->grading_name == 'C+'){$grade_D_per = $grading->weightage;}
                        if($grading->grading_name == 'C'){$grade_U_per = $grading->weightage;}
                    }


                    if($thisText_Per >= $grade_Ap_per){
                        $thisText_Grade = 'A+';
                    }else if($thisText_Per >= $grade_A_per){
                        $thisText_Grade = 'A';
                    }else if($thisText_Per >= $grade_B_per){
                        $thisText_Grade = 'B+';
                    }else if($thisText_Per >= $grade_C_per){
                        $thisText_Grade = 'B';
                    }else if($thisText_Per >= $grade_D_per){
                        $thisText_Grade = 'C+';
                    }else {
                        $thisText_Grade = 'C';
                    }

                      

                    $thisText_Rank = $this->assessment_report_model->getRankOf($studentTotalPercentage, $thisText_Per);

                    if($studentGrade_U[$student->gs_id] == 1000){
                        $thisText_Grade = 'C';

                        $fontColor_r = $grade_U_r_FontColor;
                        $fontColor_g = $grade_U_g_FontColor;
                        $fontColor_b = $grade_U_b_FontColor;

                        $BG_fontColor_r = $BG_grade_U_r_FontColor;
                        $BG_fontColor_g = $BG_grade_U_g_FontColor;
                        $BG_fontColor_b = $BG_grade_U_b_FontColor;
                    }else{
                        if($thisText_Grade == 'A+'){
                            $fontColor_r = $grade_Ap_r_FontColor;
                            $fontColor_g = $grade_Ap_g_FontColor;
                            $fontColor_b = $grade_Ap_b_FontColor;

                            $BG_fontColor_r = $BG_grade_Ap_r_FontColor;
                            $BG_fontColor_g = $BG_grade_Ap_g_FontColor;
                            $BG_fontColor_b = $BG_grade_Ap_b_FontColor;
                        }else if($thisText_Grade=='A'){
                            $fontColor_r = $grade_A_r_FontColor;
                            $fontColor_g = $grade_A_g_FontColor;
                            $fontColor_b = $grade_A_b_FontColor;

                            $BG_fontColor_r = $BG_grade_A_r_FontColor;
                            $BG_fontColor_g = $BG_grade_A_g_FontColor;
                            $BG_fontColor_b = $BG_grade_A_b_FontColor;
                        }else if($thisText_Grade=='B+'){
                            $fontColor_r = $grade_B_r_FontColor;
                            $fontColor_g = $grade_B_g_FontColor;
                            $fontColor_b = $grade_B_b_FontColor;

                            $BG_fontColor_r = $BG_grade_B_r_FontColor;
                            $BG_fontColor_g = $BG_grade_B_g_FontColor;
                            $BG_fontColor_b = $BG_grade_B_b_FontColor;
                        }else if($thisText_Grade=='B'){
                            $fontColor_r = $grade_C_r_FontColor;
                            $fontColor_g = $grade_C_g_FontColor;
                            $fontColor_b = $grade_C_b_FontColor;

                            $BG_fontColor_r = $BG_grade_C_r_FontColor;
                            $BG_fontColor_g = $BG_grade_C_g_FontColor;
                            $BG_fontColor_b = $BG_grade_C_b_FontColor;
                        }else if($thisText_Grade=='C+'){
                            $fontColor_r = $grade_D_r_FontColor;
                            $fontColor_g = $grade_D_g_FontColor;
                            $fontColor_b = $grade_D_b_FontColor;

                            $BG_fontColor_r = $BG_grade_D_r_FontColor;
                            $BG_fontColor_g = $BG_grade_D_g_FontColor;
                            $BG_fontColor_b = $BG_grade_D_b_FontColor;
                        }else if($thisText_Grade=='C'){
                            $fontColor_r = $grade_U_r_FontColor;
                            $fontColor_g = $grade_U_g_FontColor;
                            $fontColor_b = $grade_U_b_FontColor;

                            $BG_fontColor_r = $BG_grade_U_r_FontColor;
                            $BG_fontColor_g = $BG_grade_U_g_FontColor;
                            $BG_fontColor_b = $BG_grade_U_b_FontColor;
                        }
                    }

                    $pdf->setTextColor($fontColor_r, $fontColor_g, $fontColor_b);
                    $pdf->setFillColor($BG_fontColor_r, $BG_fontColor_g, $BG_fontColor_b);
                }

                $pdf->SetXY($startWith_X,$startWith_Y);
                $pdf->Cell($student_h_width, $text_column_height, $asp_marks, 1, 0, 'C', 1);

                $startWith_X += $student_h_width;                                
                $pdf->SetXY($startWith_X,$startWith_Y);
                $pdf->Cell($student_h_width, $text_column_height, $thisText_No,1,0,'C',1);

                $startWith_X += $student_h_width;
                $pdf->SetXY($startWith_X,$startWith_Y);
                $pdf->Cell($student_h_width, $text_column_height, $thisText_Total,1,0,'C',1);

                $startWith_X += $student_h_width;
                $pdf->SetXY($startWith_X,$startWith_Y);
                $pdf->Cell($student_h_width, $text_column_height, $thisText_Per,1,0,'C',1);
                $OverAll_Perc[$OverAll_Perc_count] = $thisText_Per; $OverAll_Perc_count++;

                $startWith_X += $student_h_width;
                $pdf->SetXY($startWith_X,$startWith_Y);
                $pdf->Cell($student_h_width, $text_column_height, $thisText_Grade,1,0,'C',1);

                $startWith_X += $student_h_width;
                $pdf->SetXY($startWith_X,$startWith_Y);
                $pdf->Cell($student_h_width, $text_column_height, $thisText_Rank,1,0,'C',1);

                for($k=1; $k<=4; $k++){
                    $startWith_X += $student_h_width;
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    $pdf->Cell($student_h_width, $text_column_height, '',1,0,'C',1);
                }


                $startWith_Y += $text_column_height;
                $startWith_X -= ($student_h_width*(($no_of_columns)+4));
            }


            /******************************************* Overall Percentage Average -- Existing Page
            *****************************************************************************************/
            $startWith_Y += 4;
            $startWith_X += ($student_h_width*3);


            $Overall_ClassAverage = ROUND((array_sum($OverAll_Perc)/$no_of_students),0);
            $thisText = $Overall_ClassAverage;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($student_h_width, $text_column_height, $thisText, 1, 0, 'C');


            $startWith_Y += $text_column_height;
            $thisText = $this->assessment_report_model->getCountOf_GreaterOnly_2d($OverAll_Perc, $Overall_ClassAverage);
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($student_h_width, $text_column_height, $thisText, 1, 0, 'C');


            $startWith_Y += $text_column_height; 
            $thisText = $this->assessment_report_model->getCountOf_LessOnly_2d($OverAll_Perc, $Overall_ClassAverage);
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($student_h_width, $text_column_height, $thisText, 1, 0, 'C');


            $grade_Ap_per = 0;
            $grade_A_per = 0;
            $grade_B_per = 0;
            $grade_C_per = 0;
            $grade_D_per = 0;
            $grade_U_per = 0;
            
            foreach($data['assessment_overall_garde'] as $grading){
                if($grading->grading_name == 'A+'){$grade_Ap_per = $this->assessment_report_model->getCountOf_GreaterOnly_2d($OverAll_Perc, $grading->weightage);}
                if($grading->grading_name == 'A'){$grade_A_per = $this->assessment_report_model->getCountOf_GreaterOnly_2d_Between($OverAll_Perc, 91, 81);}
                if($grading->grading_name == 'B+'){$grade_B_per = $this->assessment_report_model->getCountOf_GreaterOnly_2d_Between($OverAll_Perc,  81, 71);}
                if($grading->grading_name == 'B'){$grade_C_per = $this->assessment_report_model->getCountOf_GreaterOnly_2d_Between($OverAll_Perc, 71, 61);}
                if($grading->grading_name == 'C+'){$grade_D_per = $this->assessment_report_model->getCountOf_GreaterOnly_2d_Between($OverAll_Perc,  61, 51);}
                if($grading->grading_name == 'C'){$grade_U_per = $this->assessment_report_model->getCountOf_LessOnly_2d($OverAll_Perc, $grading->weightage);}
            }

            $startWith_Y += $text_column_height + 4;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($student_h_width, $text_column_height, $grade_Ap_per, 1, 0, 'C');


            $startWith_Y += $text_column_height;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($student_h_width, $text_column_height, $grade_A_per, 1, 0, 'C');


            $startWith_Y += $text_column_height;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($student_h_width, $text_column_height, $grade_B_per, 1, 0, 'C');


            $startWith_Y += $text_column_height;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($student_h_width, $text_column_height, $grade_C_per, 1, 0, 'C');


            $startWith_Y += $text_column_height;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($student_h_width, $text_column_height, $grade_D_per, 1, 0, 'C');


            $startWith_Y += $text_column_height;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($student_h_width, $text_column_height, $grade_U_per, 1, 0, 'C');

            /******************************************* Overall Percentage Average -- Existing Page -- END
            ************************************************************************************************/


        }else{
            $pdf->AddPage();


            /***************************************************************************** Global Variables
            /***********************************************************************************************/
            $ReportStarting_X = 10;
            $ReportStarting_Y = 2;
            $startWith_X = $ReportStarting_X;
            $startWith_Y = $ReportStarting_Y;
            /***********************************************************************************************/
            


            






            /******************************************************************************** Report Footer
            /***********************************************************************************************/
            $pdf->SetFont($text_font_name,'',$text_font_size);
            $this->load->model('staff/staff_registered_model');
            $this->data['staff_registered_data'] = $this->staff_registered_model->get_by(array('user_id' => (int)$this->session->userdata('user_id')));
            $thisText = ucwords($this->data['staff_registered_data'][0]->abridged_name);
            $pdf->SetFillColor(0,0,0);
            $pdf->SetTextColor(255, 255, 255);
            $pdf->SetXY($ReportStarting_X,$pdf->h-15);
            $pdf->Cell(72, 4, $now_date . ' ( '.$thisText.' )', 1, 0, 'L', 1);

            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetXY($pdf->w-30,$pdf->h-15);
            $pdf->Cell(20, 4, 'Page 3 / ' . ceil(($no_of_subjects+2.5)/7), 0, 0, 'L');

            /****************************************************************************** Report Heading
            /***********************************************************************************************/
            $pdf->setTextColor($text_fontColor_r, $text_fontColor_g, $text_fontColor_b);
            $pdf->SetFillColor($BG_text_fontColor_r, $BG_text_fontColor_g, $BG_text_fontColor_b);
            $used_height_y = 10;
            $pdf->SetFont($heading_font_name,'',$heading_font_size);
            $header_width = $pdf->w - $ReportStarting_X*2;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($header_width, $used_height_y, "Generation's School",0,0,'C');


            $startWith_Y += $used_height_y;
            $used_height_y = 10;
            $pdf->SetFont($sub_heading_font_name,'',$sub_heading_font_size);
            $header_width = ($pdf->w - $ReportStarting_X*2)/4;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($header_width, $used_height_y, "Co-Teacher : ".$data['students_gs_data'][0]->co_teacher,0,0,'L');

            $pdf->SetFont($sub_heading_font_name,'',$sub_heading_font_size);
            $header_width = ($pdf->w - $ReportStarting_X*2)/4;
            $pdf->SetXY($pdf->w-($pdf->w/4)- $ReportStarting_X/2,$startWith_Y);
            $pdf->Cell($header_width, $used_height_y, "Class Teacher : ".$data['students_gs_data'][0]->class_teacher,0,0,'R');


            $sub_heading_font_size = 16;
            $pdf->SetFont($sub_heading_font_name,'',$sub_heading_font_size);
            $header_width = $pdf->w - $ReportStarting_X*2;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($header_width, $used_height_y, $class . $TermReportTitle,0,0,'C');

            /***************** Sub Headings
            /***** Student Information
            /******************************/
            $dataFlowX = $startWith_X;
            $startWith_Y += $used_height_y;
            $pdf->SetFont($table_header_font_name,'B',$table_header_font_size);
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($text_column_width_sno, $table_header_height, 'S.No.',1,0,'C');

            $startWith_X += $text_column_width_sno;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($text_column_width_gsid, $table_header_height, 'GS-ID',1,0,'C');

            $startWith_X += $text_column_width_gsid;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($text_column_width_abname, $table_header_height, 'Abridged Name',1,0,'L');

            $startWith_X += $text_column_width_abname;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($text_column_width_status, $table_header_height, 'Status',1,0,'C');


            $i=1;
            $dataFlowY =  $startWith_Y;
            $dataFlowX = $startWith_X - $text_column_width_abname - $text_column_width_gsid - $text_column_width_sno;
            $pdf->SetFont($text_font_name,'',$text_font_size);
            $OverAll_Perc = array(); $OverAll_Perc_count=0;
            foreach ($data['students_gs_data'] as $student) {
                $pdf->setTextColor($text_fontColor_r, $text_fontColor_g, $text_fontColor_b);
                $pdf->SetFillColor($BG_text_fontColor_r, $BG_text_fontColor_g, $BG_text_fontColor_b);
                
                $startWith_X = $startWith_X - $text_column_width_abname - $text_column_width_gsid - $text_column_width_sno;
                $startWith_Y += $table_header_height;
                $pdf->SetXY($startWith_X,$startWith_Y);
                $pdf->Cell($text_column_width_sno, $text_column_height, $i,1,0,'C');

                $startWith_X += $text_column_width_sno;
                $pdf->SetXY($startWith_X,$startWith_Y);
                $pdf->Cell($text_column_width_gsid, $text_column_height, $student->gs_id,1,0,'C');

                $startWith_X += $text_column_width_gsid;
                $pdf->SetXY($startWith_X,$startWith_Y);
                $pdf->Cell($text_column_width_abname, $text_column_height, $student->abridged_name,1,0,'L');

                $startWith_X += $text_column_width_abname;
                $pdf->SetXY($startWith_X,$startWith_Y);
                $pdf->Cell($text_column_width_status, $text_column_height, $student->std_status_code,1,0,'C');
                


                /******************** Writing Student Wise Grade Information
                /************************************************************/
                $asp_marks = ''; $thisText_No = '';  $thisText_Total = '';   $thisText_Per = '';     $thisText_Grade = '';   $thisText_Rank = '';
                foreach ($data['assessment_asp'] as $ASP) {
                    if($ASP->gs_id == $student->gs_id){
                        $asp_marks = $ASP->asp_total;
                    }
                }
                if(!empty($studentMarks[$student->gs_id]['subjects'])){
                    $thisText_No = sizeof($studentMarks[$student->gs_id]['subjects']);
                    $thisText_Total = $studentTotalMarks[$student->gs_id];
                    $thisText_Per = ROUND(($thisText_Total / $thisText_No), 1);

                    $grade_Ap_per = 0;
                    $grade_A_per = 0;
                    $grade_B_per = 0;
                    $grade_C_per = 0;
                    $grade_D_per = 0;
                    $grade_U_per = 0;

                    foreach($data['assessment_overall_garde'] as $grading){
                        if($grading->grading_name == 'A+'){$grade_Ap_per = $grading->weightage;}
                        if($grading->grading_name == 'A'){$grade_A_per = $grading->weightage;}
                        if($grading->grading_name == 'B+'){$grade_B_per = $grading->weightage;}
                        if($grading->grading_name == 'B'){$grade_C_per = $grading->weightage;}
                        if($grading->grading_name == 'C+'){$grade_D_per = $grading->weightage;}
                        if($grading->grading_name == 'C'){$grade_U_per = $grading->weightage;}
                    }


                    if($thisText_Per >= $grade_Ap_per){
                        $thisText_Grade = 'A+';
                    }else if($thisText_Per >= $grade_A_per){
                        $thisText_Grade = 'A';
                    }else if($thisText_Per >= $grade_B_per){
                        $thisText_Grade = 'B+';
                    }else if($thisText_Per >= $grade_C_per){
                        $thisText_Grade = 'B';
                    }else if($thisText_Per >= $grade_D_per){
                        $thisText_Grade = 'C+';
                    }else {
                        $thisText_Grade = 'C';
                    }
                    
                    
                    $thisText_Rank = $this->assessment_report_model->getRankOf($studentTotalPercentage, $thisText_Per);
                    // var_dump($thisText_Per);

                    if($studentGrade_U[$student->gs_id] == 1000){
                        $thisText_Grade = 'C';

                        $fontColor_r = $grade_U_r_FontColor;
                        $fontColor_g = $grade_U_g_FontColor;
                        $fontColor_b = $grade_U_b_FontColor;

                        $BG_fontColor_r = $BG_grade_U_r_FontColor;
                        $BG_fontColor_g = $BG_grade_U_g_FontColor;
                        $BG_fontColor_b = $BG_grade_U_b_FontColor;
                    }else{
                        if($thisText_Grade == 'A+'){
                            $fontColor_r = $grade_Ap_r_FontColor;
                            $fontColor_g = $grade_Ap_g_FontColor;
                            $fontColor_b = $grade_Ap_b_FontColor;

                            $BG_fontColor_r = $BG_grade_Ap_r_FontColor;
                            $BG_fontColor_g = $BG_grade_Ap_g_FontColor;
                            $BG_fontColor_b = $BG_grade_Ap_b_FontColor;
                        }else if($thisText_Grade=='A'){
                            $fontColor_r = $grade_A_r_FontColor;
                            $fontColor_g = $grade_A_g_FontColor;
                            $fontColor_b = $grade_A_b_FontColor;

                            $BG_fontColor_r = $BG_grade_A_r_FontColor;
                            $BG_fontColor_g = $BG_grade_A_g_FontColor;
                            $BG_fontColor_b = $BG_grade_A_b_FontColor;
                        }else if($thisText_Grade=='B+'){
                            $fontColor_r = $grade_B_r_FontColor;
                            $fontColor_g = $grade_B_g_FontColor;
                            $fontColor_b = $grade_B_b_FontColor;

                            $BG_fontColor_r = $BG_grade_B_r_FontColor;
                            $BG_fontColor_g = $BG_grade_B_g_FontColor;
                            $BG_fontColor_b = $BG_grade_B_b_FontColor;
                        }else if($thisText_Grade=='B'){
                            $fontColor_r = $grade_C_r_FontColor;
                            $fontColor_g = $grade_C_g_FontColor;
                            $fontColor_b = $grade_C_b_FontColor;

                            $BG_fontColor_r = $BG_grade_C_r_FontColor;
                            $BG_fontColor_g = $BG_grade_C_g_FontColor;
                            $BG_fontColor_b = $BG_grade_C_b_FontColor;
                        }else if($thisText_Grade=='C+'){
                            $fontColor_r = $grade_D_r_FontColor;
                            $fontColor_g = $grade_D_g_FontColor;
                            $fontColor_b = $grade_D_b_FontColor;

                            $BG_fontColor_r = $BG_grade_D_r_FontColor;
                            $BG_fontColor_g = $BG_grade_D_g_FontColor;
                            $BG_fontColor_b = $BG_grade_D_b_FontColor;
                        }else if($thisText_Grade=='C'){
                            $fontColor_r = $grade_U_r_FontColor;
                            $fontColor_g = $grade_U_g_FontColor;
                            $fontColor_b = $grade_U_b_FontColor;

                            $BG_fontColor_r = $BG_grade_U_r_FontColor;
                            $BG_fontColor_g = $BG_grade_U_g_FontColor;
                            $BG_fontColor_b = $BG_grade_U_b_FontColor;
                        }
                    }
                    $pdf->setTextColor($fontColor_r, $fontColor_g, $fontColor_b);
                    $pdf->setFillColor($BG_fontColor_r, $BG_fontColor_g, $BG_fontColor_b);
                }
                $startWith_X += $text_column_width_status + 5;
                $pdf->SetXY($startWith_X,$startWith_Y);
                $pdf->Cell($student_h_width, $text_column_height, $asp_marks, 1, 0, 'C', 1);

                $startWith_X += $student_h_width;
                $pdf->SetXY($startWith_X,$startWith_Y);
                $pdf->Cell($student_h_width, $text_column_height, $thisText_No,1,0,'C',1);

                $startWith_X += $student_h_width;
                $pdf->SetXY($startWith_X,$startWith_Y);
                $pdf->Cell($student_h_width, $text_column_height, $thisText_Total,1,0,'C',1);

                $startWith_X += $student_h_width;
                $pdf->SetXY($startWith_X,$startWith_Y);
                $pdf->Cell($student_h_width, $text_column_height, $thisText_Per,1,0,'C',1);
                $OverAll_Perc[$OverAll_Perc_count] = $thisText_Per; $OverAll_Perc_count++;

                $startWith_X += $student_h_width;
                $pdf->SetXY($startWith_X,$startWith_Y);
                $pdf->Cell($student_h_width, $text_column_height, $thisText_Grade,1,0,'C',1);

                $startWith_X += $student_h_width;
                $pdf->SetXY($startWith_X,$startWith_Y);
                $pdf->Cell($student_h_width, $text_column_height, $thisText_Rank,1,0,'C',1);

                for($k=1; $k<=4; $k++){
                    $startWith_X += $student_h_width;
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    $pdf->Cell($student_h_width, $text_column_height, '',1,0,'C',1);
                }
                


                $i++;
                $startWith_X -= $text_column_width_status + ($student_h_width * ($no_of_columns+4)) + 5;
                $startWith_Y = $startWith_Y - ($table_header_height-$text_column_height);
            }

            $SuperX =  $startWith_X;

            /******************************************* Overall Percentage Average -- New Page
            *****************************************************************************************/
            $SuperY = $startWith_Y + 20;
            $startWith_Y = $SuperY;
            $startWith_X += ($student_h_width*4)+1;


            $Overall_ClassAverage = ROUND((array_sum($OverAll_Perc)/$no_of_students),0);
            $thisText = $Overall_ClassAverage;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($student_h_width, $text_column_height, $thisText, 1, 0, 'C');


            $startWith_Y += $text_column_height;
            $thisText = $this->assessment_report_model->getCountOf_GreaterOnly_2d($OverAll_Perc, $Overall_ClassAverage);
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($student_h_width, $text_column_height, $thisText, 1, 0, 'C');


            $startWith_Y += $text_column_height; 
            $thisText = $this->assessment_report_model->getCountOf_LessOnly_2d($OverAll_Perc, $Overall_ClassAverage);
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($student_h_width, $text_column_height, $thisText, 1, 0, 'C');


            $grade_Ap_per = 0;
            $grade_A_per = 0;
            $grade_B_per = 0;
            $grade_C_per = 0;
            $grade_D_per = 0;
            $grade_U_per = 0;

            //var_dump($data['assessment_overall_garde']);
            
            foreach($data['assessment_overall_garde'] as $grading){
                if($grading->grading_name == 'A+'){$grade_Ap_per = $this->assessment_report_model->getCountOf_GreaterOnly_2d($OverAll_Perc, $grading->weightage);}
                if($grading->grading_name == 'A'){$grade_A_per = $this->assessment_report_model->getCountOf_GreaterOnly_2d_Between($OverAll_Perc, 91, 81);}
                if($grading->grading_name == 'B+'){$grade_B_per = $this->assessment_report_model->getCountOf_GreaterOnly_2d_Between($OverAll_Perc, 81, 71);}
                if($grading->grading_name == 'B'){$grade_C_per = $this->assessment_report_model->getCountOf_GreaterOnly_2d_Between($OverAll_Perc, 71, 61);}
                if($grading->grading_name == 'C+'){$grade_D_per = $this->assessment_report_model->getCountOf_GreaterOnly_2d_Between($OverAll_Perc, 61, 51);}
                if($grading->grading_name == 'C'){$grade_U_per = $this->assessment_report_model->getCountOf_LessOnly_2d($OverAll_Perc, $grading->weightage);}
            }

            //var_dump($grade_A_per);

            $startWith_Y += $text_column_height + 4;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($student_h_width, $text_column_height, $grade_Ap_per, 1, 0, 'C');


            $startWith_Y += $text_column_height;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($student_h_width, $text_column_height, $grade_A_per, 1, 0, 'C');


            $startWith_Y += $text_column_height;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($student_h_width, $text_column_height, $grade_B_per, 1, 0, 'C');


            $startWith_Y += $text_column_height;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($student_h_width, $text_column_height, $grade_C_per, 1, 0, 'C');


            $startWith_Y += $text_column_height;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($student_h_width, $text_column_height, $grade_D_per, 1, 0, 'C');


            $startWith_Y += $text_column_height;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($student_h_width, $text_column_height, $grade_U_per, 1, 0, 'C');








            /*************** Class Average
            /******************************/
            $pdf->setTextColor($text_fontColor_r, $text_fontColor_g, $text_fontColor_b);
            $pdf->SetFillColor($BG_text_fontColor_r, $BG_text_fontColor_g, $BG_text_fontColor_b);

            $dataFlowX = $ReportStarting_X + $text_column_width_sno + $text_column_width_gsid;
            $dataFlowY = $startWith_Y + 4;

            $startWith_X = $dataFlowX;
            $startWith_Y = $SuperY;

            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'Class Average',1,0,'L',1);

            $startWith_Y += $text_column_height;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'Above Average',1,0,'L',1);

            $startWith_Y += $text_column_height;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'Below Average',1,0,'L',1);



            /*************** Class Grading
            /******************************/
            $startWith_X = $dataFlowX;
            $startWith_Y += $text_column_height + 4;

            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'A+',1,0,'L',1);

            $startWith_Y += $text_column_height;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'A',1,0,'L',1);

            $startWith_Y += $text_column_height;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'B+',1,0,'L',1);

            $startWith_Y += $text_column_height;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'B',1,0,'L',1);

            $startWith_Y += $text_column_height;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'C+',1,0,'L',1);

            $startWith_Y += $text_column_height;
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'C',1,0,'L',1);

            /******************************************* Overall Percentage Average -- New Page -- END
            ************************************************************************************************/


            $dataFlowY = $startWith_Y + 20;
            


            $pdf->setTextColor($text_fontColor_r, $text_fontColor_g, $text_fontColor_b);
            $pdf->SetFillColor($BG_text_fontColor_r, $BG_text_fontColor_g, $BG_text_fontColor_b);

            $startWith_X = $SuperX + 21;//$text_column_width_status + 5;
            $startWith_Y = $ReportStarting_Y+20;

            $pdf->SetFont($table_header_font_name,'B',$table_header_font_size);
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->MultiCell($student_h_width, $table_header_height, ' A S P ',1,'C');

            $startWith_X += $student_h_width;            
            $pdf->SetFont($table_header_font_name,'B',$table_header_font_size);
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->MultiCell($student_h_width, $table_header_height/2, 'No. of Subjects',1,'C');

            $startWith_X += $student_h_width;
            $pdf->SetFont($table_header_font_name,'B',$table_header_font_size);
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($student_h_width, $table_header_height, 'Total',1,0,'C');

            $startWith_X += $student_h_width;
            $pdf->SetFont($table_header_font_name,'B',$table_header_font_size);
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($student_h_width, $table_header_height, 'Overall %',1,0,'C');

            $startWith_X += $student_h_width;
            $pdf->SetFont($table_header_font_name,'B',$table_header_font_size);
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($student_h_width, $table_header_height, 'Grade',1,0,'C');

            $startWith_X += $student_h_width;
            $pdf->SetFont($table_header_font_name,'B',$table_header_font_size);
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($student_h_width, $table_header_height, 'Rank',1,0,'C');

            for($k=1; $k<=4; $k++){
                $startWith_X += $student_h_width;
                $pdf->SetFont($table_header_font_name,'B',$table_header_font_size);
                $pdf->SetXY($startWith_X,$startWith_Y);
                $pdf->Cell($student_h_width, $table_header_height, '',1,0,'C');
            }
        }
        






        /*************** Class Average WOrkingCH
        /******************************/
        /*$pdf->setTextColor($text_fontColor_r, $text_fontColor_g, $text_fontColor_b);
        $pdf->SetFillColor($BG_text_fontColor_r, $BG_text_fontColor_g, $BG_text_fontColor_b);

        $dataFlowX = $ReportStarting_X + $text_column_width_sno + $text_column_width_gsid;
        //$dataFlowY = $startWith_Y + 4;

        $startWith_X = $dataFlowX;
        $startWith_Y = $dataFlowY;

        $pdf->SetXY($startWith_X,$startWith_Y);
        $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'Class Average',1,0,'L',1);

        $startWith_Y += $text_column_height;
        $pdf->SetXY($startWith_X,$startWith_Y);
        $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'Above Average',1,0,'L',1);

        $startWith_Y += $text_column_height;
        $pdf->SetXY($startWith_X,$startWith_Y);
        $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'Below Average',1,0,'L',1);



        /*************** Class Grading
        /******************************/
        /*$startWith_X = $dataFlowX;
        $startWith_Y += $text_column_height + 4;

        $pdf->SetXY($startWith_X,$startWith_Y);
        $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'APlus D',1,0,'L',1);

        $startWith_Y += $text_column_height;
        $pdf->SetXY($startWith_X,$startWith_Y);
        $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'A',1,0,'L',1);

        $startWith_Y += $text_column_height;
        $pdf->SetXY($startWith_X,$startWith_Y);
        $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'B',1,0,'L',1);

        $startWith_Y += $text_column_height;
        $pdf->SetXY($startWith_X,$startWith_Y);
        $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'C',1,0,'L',1);

        $startWith_Y += $text_column_height;
        $pdf->SetXY($startWith_X,$startWith_Y);
        $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'D',1,0,'L',1);

        $startWith_Y += $text_column_height;
        $pdf->SetXY($startWith_X,$startWith_Y);
        $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'U',1,0,'L',1);

        /***********************************************************************************************/





























        // Output the new PDF
        $pdf->Output('Assessment_Unit_Report' . '.pdf', 'I');
	}
}