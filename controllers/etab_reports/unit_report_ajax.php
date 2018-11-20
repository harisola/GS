<?php 

class Unit_report_ajax extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
	}

	   public function get_Unit_Report_pdf(){

        $gradeID = $this->input->post('grade');
        $sectionID = $this->input->post('section');
        $academic_id = $this->input->post('academic');
        $gradeName = $this->input->post('grade_name');
        $sectionName = $this->input->post('section_name');


        $html = '';



        $html .= '
        <style>
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



        $pdf_link = '/etab_reports/unit_report_ajax/generate_unit_report?gradeID=' . $gradeID .'&sectionID=' . $sectionID .'&gradeName=' . $gradeName .'&sectionName=' . $sectionName;


        $html .= '<div class="powerwidget purple" id="datatable-filter-column" data-widget-editbutton="false" role="widget" style="">
              <header role="heading">
                <i class="fa fa-tasks"></i> Report : '.$gradeName.'-'.$sectionName.'
                <div class="powerwidget-ctrls" role="menu">
                  <h3>
                    <span class="glyphicon glyphicon-remove close_setup_4 pull-right cursor" style="top: -11px;"></span>
                  </h3>
                </div>
                <span class="powerwidget-loader"></span>
              </header>

              <div class="inner-spacer" role="content">
                <div id="staff_edit_table_wrapper" class="dataTables_wrapper form-inline" role="grid">';

                
        $html .=    '<div class="unit_report_pdf_iframe"> 
                        <iframe src="'.site_url().$pdf_link.'" frameBorder="0"> </iframe> 
                    </div>';

        $html .= '
              </div>
            </div>
        </div>';



        echo $html;
    }


    public function generate_unit_report(){

        $gradeID = $this->input->get('gradeID');
        $sectionID = $this->input->get('sectionID');
        $gradeName = $this->input->get('gradeName');
        $sectionName = $this->input->get('sectionName');
        $class = $gradeName . '-' . $sectionName;
        $optional = 0;



        $this->load->model('atif_sp/assessment_report_model');
        /************************** Assessment Subjects
        /***********************************************/
        //$this->data['assessment_titles'] = $this->assessment_report_model->get_unit_assessment_subjects($gradeID, $sectionID);
        $this->data['assessment_titles'] = $this->assessment_report_model->get_unit_assessment_subjects_SessionTerm($gradeID, $sectionID, "");

        /******************************** Students Data 
        /***********************************************/
        if($optional == 0){
            //$this->data['students_gs_data'] = $this->assessment_report_model->get_students_grade_section($gradeID, $sectionID);
            $this->data['students_gs_data'] = $this->assessment_report_model->get_students_grade_section_SessionTerm($gradeID, $sectionID, "");
        }else{
            $GroupID = substr(substr($gpp_id, -3), 0, 1);
            if($GroupID == 'A'){$GroupID=1;}else
            if($GroupID == 'B'){$GroupID=2;}else
            if($GroupID == 'C'){$GroupID=3;}else
            if($GroupID == 'D'){$GroupID=4;}else
            if($GroupID == 'E'){$GroupID=5;}else
            if($GroupID == 'F'){$GroupID=6;}

            $BlockID = substr($gpp_id, -1);

            
        }
        /****************** Assessment Percentage Marks 
        /***********************************************/
        if($optional == 0){
            //$this->data['assessment_agg_marks'] = $this->assessment_report_model->Get_Formative_Unit_Marks_CurrentGS($gradeID, $sectionID, 1);
            $this->data['assessment_agg_marks'] = $this->assessment_report_model->Get_Formative_Unit_Marks_CurrentGS_SessionTerm($gradeID, $sectionID, 1, "");
        }else{
           
        }
        /*************************************************************************************************************************************/








        // Overall Font Size
        $font_name = 'Helvetica'; //Helvetica
        $now_date = date('d-M-Y');
        


        require_once('components/pdf/fpdf/fpdf_rotate.php');
        require_once('components/pdf/fpdi/fpdi.php');


        $noOfAssessments = sizeof($this->data['assessment_titles']);


        // initiate FPDI
        if($noOfAssessments <= 15){
            $pdf = new PDF('P', 'mm', array(210,400));
        }
        else if($noOfAssessments > 15){
            $pdf = new PDF('P', 'mm', array(380,400));
        }
        $pdf->AddPage();




        // Helping Variables
        $ReportStarting_X = 10;
        $ReportStarting_Y = 7;
        $ReportLast_X = 0;
        $ReportLast_Y = 0;
        $header_width = ($noOfAssessments*7)+15+30+12+14+10;




        // Heading - Unit Report
        $border = 1;
        $font_size = 15;
        $pdf->SetFont($font_name,'B',$font_size);
        $pdf->SetXY($ReportStarting_X,$ReportStarting_Y);
        $pdf->Cell($header_width,10,'MID TERM ASSESSMENT REPORT FOR CLASS  '.$class,1,0,'C');



        // Class Teacher & Co-Teacher
        $ReportLast_Y = $ReportStarting_Y+10;
        $pdf->SetXY($ReportStarting_X,$ReportLast_Y);
        $pdf->Cell($header_width,10,'',1,0,'C');

        $font_size = 10;
        $ReportLast_X = $ReportStarting_X+10;
        $pdf->SetXY($ReportLast_X,$ReportLast_Y);
        $pdf->SetFont($font_name,'B',$font_size);
        $pdf->Cell(($header_width/2)-10,10,'Class Teacher :  '.$this->data['students_gs_data'][0]->class_teacher,0,0,'L');
        $pdf->Cell(($header_width/2)-10,10,'Co-Teacher :  '.$this->data['students_gs_data'][0]->co_teacher,0,0,'R');








        /************************************************* Assessment SUBJECTS
        /***********************************************************************/
        $cellWidth=7;
        $cellHeight=40;
        
        $ReportLast_Y += 10;

        // Student Heading
        $font_size = 8;
        $pdf->SetFont($font_name,'',$font_size);
        $pdf->SetXY($ReportStarting_X,$ReportLast_Y);
        $pdf->Cell(7,$cellHeight,'Sr',1,0,'C');
        $pdf->Cell(15,$cellHeight,'GS-ID',1,0,'C');
        $pdf->Cell(30,$cellHeight,'Student Name',1,0,'L');
        $pdf->Cell(15,$cellHeight,'GS Status',1,0,'C');
        $ReportLast_X += 15+30+12;


        $i=0;
        foreach ($this->data['assessment_titles'] as $data) {

            $lastx = 0;
            $lasty = 0;

            $col = $data->subject_name;


            // Fill Grey
            $pdf->SetFillColor(175,175,175);

            
            $pdf->RotatedCell($ReportLast_X+($i*$cellWidth),$ReportLast_Y+$cellHeight,$cellHeight,$cellWidth,$col,1,0,'L',90,1);
            $i++;
        }
        
        $pdf->SetFillColor(255,255,255);
        $pdf->RotatedCell($ReportLast_X+($i*$cellWidth)+($cellWidth*0),$ReportLast_Y+$cellHeight,$cellHeight,$cellWidth,'P',1,0,'L',90,1);
        $pdf->RotatedCell($ReportLast_X+($i*$cellWidth)+($cellWidth*1),$ReportLast_Y+$cellHeight,$cellHeight,$cellWidth,'F',1,0,'L',90,1);











        /****************************************************** Students' Info
        /***********************************************************************/

        $counter = 0;
        $cellHeight = 7;
        $ReportLast_Y = 67;




        foreach ($this->data['students_gs_data'] as $data) {

            $ReportLast_X = $ReportStarting_X+15+30+12+3;


            // Student Heading
            $font_size = 8;
            $pdf->SetFont($font_name,'',$font_size);
            $pdf->SetXY($ReportStarting_X,$ReportLast_Y+($counter*7));
            $pdf->Cell(7,$cellHeight,$counter+1,1,0,'C');
            $pdf->Cell(15,$cellHeight,$data->gs_id,1,0,'C');
            $pdf->Cell(30,$cellHeight,$data->abridged_name,1,0,'L');
            $pdf->Cell(15,$cellHeight,$data->std_status_code,1,0,'C');


            
            $X=0;
            foreach ($this->data['assessment_titles'] as $title) {
                $marksObtained = 0;
                $grade = '';
                $gotZeroMarks = "No";
                foreach ($this->data['assessment_agg_marks'] as $marks) {
                    if($marks->gs_id == $data->gs_id
                            && $marks->role_id == $title->role_id
                            /*&& $marks->percentageAssessment > 0*/){

                        $marksObtained = $marks->percentageAssessment;
                        $grade = $marks->grade;
                        if($marksObtained == 0){$gotZeroMarks="Yes";}
                    }
                }


                $font_size = 9;
                $ReportLast_X+=$cellWidth;
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY($ReportLast_X,$ReportLast_Y+($counter*7));
                if($marksObtained==0 && $gotZeroMarks=="No"){
                    $pdf->Cell($cellWidth,$cellHeight,'',1,0,'C');
                }else{
                    $pdf->Cell($cellWidth,$cellHeight,$marksObtained,1,0,'C');
                }


                if($gotZeroMarks=="Yes"){
                    $studentSbjMarks[$X][$counter] = 0.01;
                    $studentSbjGrade[$X][$counter] = 'U';
                }else{
                    $studentSbjMarks[$X][$counter] = $marksObtained;
                    $studentSbjGrade[$X][$counter] = $grade;
                }
                $studentSubject[$X] = $title->optional;
                $X++;
            }



            /*******************************************************************/
            // Boxes for P & F
            /*******************************************************************/
            $ReportLast_X+=$cellWidth;
            $pdf->SetXY($ReportLast_X,$ReportLast_Y+($counter*7));
            $pdf->Cell($cellWidth,$cellHeight,'',1,0,'C');

            $ReportLast_X+=$cellWidth;
            $pdf->SetXY($ReportLast_X,$ReportLast_Y+($counter*7));
            $pdf->Cell($cellWidth,$cellHeight,'',1,0,'C');
            /*******************************************************************/



            $counter++;
        }





        $noOfStudents = $counter;



        /*******************************************************************/
        // Boxes for Average Percentage etc.
        /*******************************************************************/
        $ReportLast_X = $ReportStarting_X+22;
        $noOfSubject = sizeof($this->data['assessment_titles']);
        $cellHeight = 7;


        $pdf->SetFillColor(211,211,211);
        // Class Average Marks
        $font_size = 8;
        $pdf->SetFont($font_name,'',$font_size);
        $pdf->SetXY($ReportLast_X,$ReportLast_Y+($counter*$cellHeight));
        $pdf->Cell(45,$cellHeight,'Class Average Percentage',1,0,'L',1);
        for($i=0; $i<$noOfSubject; $i++){
            $noOfOptionalSelection=0;
            // Check if Subject is optional

            if($studentSubject[$i] == 1){
                $noOfOptionalSelection = $this->assessment_report_model->getCountOf($studentSbjMarks[$i], 0);
                if($noOfOptionalSelection > 0){
                    $averageMarks[$i] = round((array_sum($studentSbjMarks[$i]) / $this->assessment_report_model->getCountOf($studentSbjMarks[$i], 0)),0);
                }else{
                    $averageMarks[$i] = 0;
                }
            }else{
                $averageMarks[$i] = round((array_sum($studentSbjMarks[$i])/ $noOfStudents),0);
            }
            $pdf->SetXY($ReportLast_X+45+($i*$cellHeight),$ReportLast_Y+($counter*$cellHeight));
            if($averageMarks[$i]==0){
                $pdf->Cell(7,$cellHeight,'',1,0,'C',1);
            }else{
                $pdf->Cell(7,$cellHeight,$averageMarks[$i],1,0,'C',1);
            }
        }
                
        



        $pdf->SetFillColor(255,255,255);
        // Above Average
        $counter++;
        $pdf->SetXY($ReportLast_X,$ReportLast_Y+($counter*$cellHeight));
        $pdf->Cell(45,$cellHeight,'Above Average',1,0,'L');
        
        for($i=0; $i<$noOfSubject; $i++){
            $numCounter=0;
            if($studentSubject[$i] == 1){
                $numCounter = $this->assessment_report_model->getCountOf($studentSbjMarks[$i], $averageMarks[$i]);
            }else{
                for($j=0; $j<$noOfStudents; $j++){
                    if($studentSbjMarks[$i][$j] > $averageMarks[$i]){
                        $numCounter++;
                    }
                }
            }

            $pdf->SetXY($ReportLast_X+45+($i*$cellHeight),$ReportLast_Y+($counter*$cellHeight));
            if(array_sum($studentSbjMarks[$i])==0){
                $pdf->Cell(7,$cellHeight,'',1,0,'C');
            }else{
                $pdf->Cell(7,$cellHeight,$numCounter,1,0,'C');
            }
        }





        $pdf->SetFillColor(211,211,211);
        // Below Average
        $counter++;
        $pdf->SetXY($ReportLast_X,$ReportLast_Y+($counter*$cellHeight));
        $pdf->Cell(45,$cellHeight,'Below Average',1,0,'L',1);

        for($i=0; $i<$noOfSubject; $i++){
            $numCounter=0;
            if($studentSubject[$i] == 1){
                $numCounter = $this->assessment_report_model->getCountOf_Less($studentSbjMarks[$i], $averageMarks[$i]);
            }else{
                for($j=0; $j<$noOfStudents; $j++){
                    if($studentSbjMarks[$i][$j] <= $averageMarks[$i]){
                        $numCounter++;
                    }
                }   
            }
            

            $pdf->SetXY($ReportLast_X+45+($i*$cellHeight),$ReportLast_Y+($counter*$cellHeight));
            if(array_sum($studentSbjMarks[$i])==0){
                $pdf->Cell(7,$cellHeight,'',1,0,'C',1);
            }else{
                $pdf->Cell(7,$cellHeight,$numCounter,1,0,'C',1);
            }
        }







        $pdf->SetFillColor(255,255,255);
        // A+
        $counter++;
        $pdf->SetXY($ReportLast_X,$ReportLast_Y+($counter*$cellHeight));
        $pdf->Cell(45,$cellHeight,'A+',1,0,'L');

        for($i=0; $i<$noOfSubject; $i++){

            $numCounter = $this->assessment_report_model->CountThisGradeIn($studentSbjGrade[$i], 'A+');
            $pdf->SetXY($ReportLast_X+45+($i*$cellHeight),$ReportLast_Y+($counter*$cellHeight));
            if(array_sum($studentSbjMarks[$i])==0){
                $pdf->Cell(7,$cellHeight,'',1,0,'C');
            }else{
                $pdf->Cell(7,$cellHeight,$numCounter,1,0,'C');
            }
        }





        $pdf->SetFillColor(211,211,211);
        // A
        $counter++;
        $pdf->SetXY($ReportLast_X,$ReportLast_Y+($counter*$cellHeight));
        $pdf->Cell(45,$cellHeight,'A',1,0,'L',1);

        for($i=0; $i<$noOfSubject; $i++){

            $numCounter = $this->assessment_report_model->CountThisGradeIn($studentSbjGrade[$i], 'A');
            $pdf->SetXY($ReportLast_X+45+($i*$cellHeight),$ReportLast_Y+($counter*$cellHeight));
            if(array_sum($studentSbjMarks[$i])==0){
                $pdf->Cell(7,$cellHeight,'',1,0,'C',1);
            }else{
                $pdf->Cell(7,$cellHeight,$numCounter,1,0,'C',1);
            }
        }





        $pdf->SetFillColor(255,255,255);
        // B
        $counter++;
        $pdf->SetXY($ReportLast_X,$ReportLast_Y+($counter*$cellHeight));
        $pdf->Cell(45,$cellHeight,'B',1,0,'L');

        for($i=0; $i<$noOfSubject; $i++){

            $numCounter = $this->assessment_report_model->CountThisGradeIn($studentSbjGrade[$i], 'B');
            $pdf->SetXY($ReportLast_X+45+($i*$cellHeight),$ReportLast_Y+($counter*$cellHeight));
            if(array_sum($studentSbjMarks[$i])==0){
                $pdf->Cell(7,$cellHeight,'',1,0,'C');
            }else{
                $pdf->Cell(7,$cellHeight,$numCounter,1,0,'C');
            }
        }






        $pdf->SetFillColor(211,211,211);
        // C
        $counter++;
        $pdf->SetXY($ReportLast_X,$ReportLast_Y+($counter*$cellHeight));
        $pdf->Cell(45,$cellHeight,'C',1,0,'L',1);

        for($i=0; $i<$noOfSubject; $i++){

            $numCounter = $this->assessment_report_model->CountThisGradeIn($studentSbjGrade[$i], 'C');
            $pdf->SetXY($ReportLast_X+45+($i*$cellHeight),$ReportLast_Y+($counter*$cellHeight));
            if(array_sum($studentSbjMarks[$i])==0){
                $pdf->Cell(7,$cellHeight,'',1,0,'C',1);
            }else{
                $pdf->Cell(7,$cellHeight,$numCounter,1,0,'C',1);
            }
        }





        $pdf->SetFillColor(255,255,255);
        // D
        $counter++;
        $pdf->SetXY($ReportLast_X,$ReportLast_Y+($counter*$cellHeight));
        $pdf->Cell(45,$cellHeight,'D',1,0,'L');

        for($i=0; $i<$noOfSubject; $i++){

            $numCounter = $this->assessment_report_model->CountThisGradeIn($studentSbjGrade[$i], 'D');
            $pdf->SetXY($ReportLast_X+45+($i*$cellHeight),$ReportLast_Y+($counter*$cellHeight));
            if(array_sum($studentSbjMarks[$i])==0){
                $pdf->Cell(7,$cellHeight,'',1,0,'C');
            }else{
                $pdf->Cell(7,$cellHeight,$numCounter,1,0,'C');
            }
        }







        $pdf->SetFillColor(211,211,211);
        // U
        $counter++;
        $pdf->SetXY($ReportLast_X,$ReportLast_Y+($counter*$cellHeight));
        $pdf->Cell(45,$cellHeight,'U',1,0,'L',1);

        for($i=0; $i<$noOfSubject; $i++){

            $numCounter = $this->assessment_report_model->CountThisGradeIn($studentSbjGrade[$i], 'U');
            $pdf->SetXY($ReportLast_X+45+($i*$cellHeight),$ReportLast_Y+($counter*$cellHeight));
            if(array_sum($studentSbjMarks[$i])==0){
                $pdf->Cell(7,$cellHeight,'',1,0,'C',1);
            }else{
                $pdf->Cell(7,$cellHeight,$numCounter,1,0,'C',1);
            }
        }
        /*******************************************************************/











        /*******************************************************************/
        // Boxes for Grade Computation
        /*******************************************************************/
        $gradeAp_Science = '';
        $gradeA_Science = '';
        $gradeB_Science = '';
        $gradeC_Science = '';
        $gradeD_Science = '';
        $gradeU_Science = '';


        $gradeAp_Humanities = '';
        $gradeA_Humanities = '';
        $gradeB_Humanities = '';
        $gradeC_Humanities = '';
        $gradeD_Humanities = '';
        $gradeU_Humanities = '';

        $gradeAp_Overall = '';
        $gradeA_Overall = '';
        $gradeB_Overall = '';
        $gradeC_Overall = '';
        $gradeD_Overall = '';
        $gradeU_Overall = '';

        if(!empty($this->data['assessment_agg_marks'][0])){
            if($this->data['assessment_agg_marks'][0]->grade_name == 'X' || $this->data['assessment_agg_marks'][0]->grade_name == 'XI'){
            $gradeAp_Science = 90;
            $gradeA_Science = 80;
            $gradeB_Science = 70;
            $gradeC_Science = 60;
            $gradeD_Science = 50;
            $gradeU_Science = 50;


            $gradeAp_Humanities = 80;
            $gradeA_Humanities = 70;
            $gradeB_Humanities = 60;
            $gradeC_Humanities = 50;
            $gradeD_Humanities = 45;
            $gradeU_Humanities = 45;

            $gradeAp_Overall = 90;
            $gradeA_Overall = 80;
            $gradeB_Overall = 70;
            $gradeC_Overall = 60;
            $gradeD_Overall = 50;
            $gradeU_Overall = 50;

            }else if($this->data['assessment_agg_marks'][0]->grade_name == 'VII' || $this->data['assessment_agg_marks'][0]->grade_name == 'VIII'){
                $gradeAp_Science = 90;
                $gradeA_Science = 80;
                $gradeB_Science = 70;
                $gradeC_Science = 60;
                $gradeD_Science = 50;
                $gradeU_Science = 50;


                $gradeAp_Humanities = 80;
                $gradeA_Humanities = 70;
                $gradeB_Humanities = 60;
                $gradeC_Humanities = 50;
                $gradeD_Humanities = 45;
                $gradeU_Humanities = 45;

                $gradeAp_Overall = 80;
                $gradeA_Overall = 70;
                $gradeB_Overall = 60;
                $gradeC_Overall = 50;
                $gradeD_Overall = 45;
                $gradeU_Overall = 45;

            }else if($this->data['assessment_agg_marks'][0]->grade_name == 'IX'){
                $gradeAp_Science = 90;
                $gradeA_Science = 80;
                $gradeB_Science = 70;
                $gradeC_Science = 60;
                $gradeD_Science = 50;
                $gradeU_Science = 50;


                $gradeAp_Humanities = 80;
                $gradeA_Humanities = 70;
                $gradeB_Humanities = 60;
                $gradeC_Humanities = 50;
                $gradeD_Humanities = 45;
                $gradeU_Humanities = 45;

                $gradeAp_Overall = 90;
                $gradeA_Overall = 80;
                $gradeB_Overall = 70;
                $gradeC_Overall = 60;
                $gradeD_Overall = 50;
                $gradeU_Overall = 50;

            }else if($this->data['assessment_agg_marks'][0]->grade_name == 'A1' || $this->data['assessment_agg_marks'][0]->grade_name == 'A2'){
                $gradeAp_Science = 90;
                $gradeA_Science = 80;
                $gradeB_Science = 70;
                $gradeC_Science = 60;
                $gradeD_Science = 50;
                $gradeU_Science = 50;


                $gradeAp_Humanities = 90;
                $gradeA_Humanities = 80;
                $gradeB_Humanities = 70;
                $gradeC_Humanities = 60;
                $gradeD_Humanities = 50;
                $gradeU_Humanities = 50;

                $gradeAp_Overall = 90;
                $gradeA_Overall = 80;
                $gradeB_Overall = 70;
                $gradeC_Overall = 60;
                $gradeD_Overall = 50;
                $gradeU_Overall = 50;

            }    
        }
        


        $ReportLast_Y = $ReportLast_Y+($counter*$cellHeight)+6;
        $counter=1;
        $cellHeight = 5;
        $cellWidth = 21;
        $pdf->SetFillColor(255,255,255);
        $pdf->SetXY($ReportStarting_X,$ReportLast_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Grade',1,0,'L',1);

        $pdf->SetXY($ReportStarting_X+$cellWidth,$ReportLast_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Science',1,0,'C',1);

        $pdf->SetXY($ReportStarting_X+($cellWidth*2),$ReportLast_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Humanities',1,0,'C',1);

        $pdf->SetXY($ReportStarting_X+($cellWidth*3),$ReportLast_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Overall',1,0,'C',1);



        //A+
        $counter++;
        $cellWidth = 21;
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($ReportStarting_X,$ReportLast_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'A+',1,0,'L',1);

        $pdf->SetXY($ReportStarting_X+$cellWidth,$ReportLast_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight, $gradeAp_Science.'%',1,0,'C',1);


        $pdf->SetXY($ReportStarting_X+($cellWidth*2),$ReportLast_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$gradeAp_Humanities.'%',1,0,'C',1);

        $pdf->SetXY($ReportStarting_X+($cellWidth*3),$ReportLast_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$gradeAp_Overall.'%',1,0,'C',1);


        //A
        $counter++;
        $cellWidth = 21;
        $pdf->SetFillColor(255,255,255);
        $pdf->SetXY($ReportStarting_X,$ReportLast_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'A',1,0,'L',1);

        $pdf->SetXY($ReportStarting_X+$cellWidth,$ReportLast_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$gradeA_Science.'%',1,0,'C',1);

        $pdf->SetXY($ReportStarting_X+($cellWidth*2),$ReportLast_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$gradeA_Humanities.'%',1,0,'C',1);

        $pdf->SetXY($ReportStarting_X+($cellWidth*3),$ReportLast_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$gradeA_Overall.'%',1,0,'C',1);


        //B
        $counter++;
        $cellWidth = 21;
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($ReportStarting_X,$ReportLast_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'B',1,0,'L',1);

        $pdf->SetXY($ReportStarting_X+$cellWidth,$ReportLast_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$gradeB_Science.'%',1,0,'C',1);


        $pdf->SetXY($ReportStarting_X+($cellWidth*2),$ReportLast_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$gradeB_Humanities.'%',1,0,'C',1);

        $pdf->SetXY($ReportStarting_X+($cellWidth*3),$ReportLast_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$gradeB_Overall.'%',1,0,'C',1);


        //C
        $counter++;
        $cellWidth = 21;
        $pdf->SetFillColor(255,255,255);
        $pdf->SetXY($ReportStarting_X,$ReportLast_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'C',1,0,'L',1);

        $pdf->SetXY($ReportStarting_X+$cellWidth,$ReportLast_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$gradeC_Science.'%',1,0,'C',1);

        $pdf->SetXY($ReportStarting_X+($cellWidth*2),$ReportLast_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$gradeC_Humanities.'%',1,0,'C',1);

        $pdf->SetXY($ReportStarting_X+($cellWidth*3),$ReportLast_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$gradeC_Overall.'%',1,0,'C',1);


        //D
        $counter++;
        $cellWidth = 21;
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($ReportStarting_X,$ReportLast_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'D',1,0,'L',1);

        $pdf->SetXY($ReportStarting_X+$cellWidth,$ReportLast_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$gradeD_Science.'%',1,0,'C',1);


        $pdf->SetXY($ReportStarting_X+($cellWidth*2),$ReportLast_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$gradeD_Humanities.'%',1,0,'C',1);

        $pdf->SetXY($ReportStarting_X+($cellWidth*3),$ReportLast_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$gradeD_Overall.'%',1,0,'C',1);


        //U
        $counter++;
        $cellWidth = 21;
        $pdf->SetFillColor(255,255,255);
        $pdf->SetXY($ReportStarting_X,$ReportLast_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'U',1,0,'L',1);

        $pdf->SetXY($ReportStarting_X+$cellWidth,$ReportLast_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'below '.$gradeU_Science.'%',1,0,'C',1);

        $pdf->SetXY($ReportStarting_X+($cellWidth*2),$ReportLast_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'below '.$gradeU_Humanities.'%',1,0,'C',1);

        $pdf->SetXY($ReportStarting_X+($cellWidth*3),$ReportLast_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'below '.$gradeU_Overall.'%',1,0,'C',1);








        // /*******************************************************************/
        // // Teacher Signature
        // /*******************************************************************/
        // $font_size = 10;
        // $pdf->SetFont($font_name,'B',$font_size);
        // $ReportStarting_Y = $ReportLast_Y+($counter*$cellHeight)+4;
        // $counter=3;
        // $cellWidth = 100;
        // $pdf->SetFillColor(255,255,255);
        // $pdf->SetXY($ReportStarting_X+90,$ReportLast_Y+($counter*$cellHeight));
        // $pdf->Cell($cellWidth,$cellHeight,'Class Teacher signature: _____________________________',0,0,'L',1);

        // $counter=6;
        // $pdf->SetFillColor(255,255,255);
        // $pdf->SetXY($ReportStarting_X+90,$ReportLast_Y+($counter*$cellHeight));
        // $pdf->Cell($cellWidth,$cellHeight,'Headmistress signature:  _____________________________',0,0,'L',1);

                /*******************************************************************/
        // Teacher Signature
        /*******************************************************************/
        $font_size = 10;
        $pdf->SetFont($font_name,'B',$font_size);
        $ReportStarting_Y = $ReportLast_Y+($counter*$cellHeight)+4;
        $counter=1;
        $cellWidth = 100;
        $pdf->SetFillColor(255,255,255);
        $pdf->SetXY($ReportStarting_X+90,$ReportLast_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Class Teacher signature: _____________________________',0,0,'L',1);

        $counter = 3;
        $pdf->SetFillColor(255,255,255);
        $pdf->SetXY($ReportStarting_X+90,$ReportLast_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Academic Cordinator: ________________________________',0,0,'L',1);

        $counter=5;
        $pdf->SetFillColor(255,255,255);
        $pdf->SetXY($ReportStarting_X+90,$ReportLast_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Headmistress signature:  _____________________________',0,0,'L',1);







        // Output the new PDF
        $pdf->Output('Assessment_Unit_Report' . '.pdf', 'I');
    }


    public function get_term_formative_report_term1_pdf(){

        $gradeID = $this->input->post('grade');
        $sectionID = $this->input->post('section');
        $academic_id = $this->input->post('academic');
        $gradeName = $this->input->post('grade_name');
        $sectionName = $this->input->post('section_name');
        $term = $this->input->post('term');


        $html = '';



        $html .= '
        <style>
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



        $pdf_link = '/etab_reports/unit_report_ajax/formative_term1_report?gradeID=' . $gradeID .'&sectionID=' . $sectionID .'&gradeName=' . $gradeName .'&sectionName=' . $sectionName .'&term=' . $term;


        $html .= '

            <div class="powerwidget purple" id="datatable-filter-column" data-widget-editbutton="false" role="widget" style="">
              <header role="heading">
                <i class="fa fa-tasks"></i> Report : '.$gradeName.'-'.$sectionName.'
                <div class="powerwidget-ctrls" role="menu">
                  <h3>
                    <span class="glyphicon glyphicon-remove close_setup_4 pull-right cursor" style="top: -11px;"></span>
                  </h3>
                </div>
                <span class="powerwidget-loader"></span>
              </header>

              <div class="inner-spacer" role="content">
                <div id="staff_edit_table_wrapper" class="dataTables_wrapper form-inline" role="grid">';

                
        $html .=    '<div class="unit_report_pdf_iframe"> 
                        <iframe src="'.site_url().$pdf_link.'" frameBorder="0"> </iframe> 
                    </div>';

        $html .= '
              </div>
            </div>
        </div>';



        echo $html;

    }

        public function formative_term1_report(){

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

    

        if($gradeID == 10 || $gradeID == 11){

            $data['assessment_titles'] = $this->assessment_report_model->Complete_Assessment_Report_GS_Subjects_Science_SessionTerm($gradeID, $sectionID, "");
        }else{
           
            $data['assessment_titles'] = $this->assessment_report_model->Complete_Assessment_Report_GS_Subjects_SessionTerm($gradeID, $sectionID, "");
        }

 
        



        /***************************** Assessment Marks
        /***********************************************/


            if($gradeID == 10 || $gradeID == 11){
                //$data['assessment_marks'] = $this->assessment_report_model->Complete_Assessment_Report_GS_lvl_3_Science($gradeID, $sectionID, $termID);            
                $data['assessment_marks'] = $this->assessment_report_model->Complete_Assessment_Report_GS_lvl_3_Science_SessionTerm($gradeID, $sectionID, $termID, "");
            }else{
                //$data['assessment_marks'] = $this->assessment_report_model->Complete_Assessment_Report_GS_lvl_3($gradeID, $sectionID, $termID);            
                $data['assessment_marks'] = $this->assessment_report_model->Complete_Assessment_Report_GS_lvl_3_SessionTerm($gradeID, $sectionID, $termID, "");
            }

                /***************************** Assessment Grade
        /***********************************************/
        //$data['assessment_grade'] = $this->assessment_report_model->Complete_Assessment_Report_GS_lvl_4($gradeID, $sectionID, $termID);
        /*************************************************************************************************************************************/



















        /**************************** Modifing Subjects
        /***********************************************/
        /*
        if($gradeID == 10 || $gradeID || 11){
            $num = array();
            $i = 0;
            $j = 0;
            foreach($data['assessment_titles'] as $title){
                if($title->subject_code == 'CHEM' || $title->subject_code == 'PHYS' || $title->subject_code == 'BIOL'){
                    $num[$j] = $i;
                    $j++;
                }
                $i++;
            }
            // Removing unnecessary subjects
            foreach($num as $n){
                unset($data['assessment_titles'][$n]);
            }




            $thisTitle = (object) array(
                "program_id" => '9901',
                "sessionid" => '8',
                "gradeid" => $gradeID,
                "subjects" => '9902',
                "optional" => '0',
                "subjectname" => 'Science',
                "subject_name" => 'Science',
                "subject_code" => 'SCNC',
                "role_id" => '99093',
                "gp_id" => 'xXx-SCNC-0-X'
            );
            array_push($data['assessment_titles'], $thisTitle);


            foreach($data['assessment_marks'] as $marks){
                $num = array();
                $i = 0;
                $j = 0;
                $scienceMakrs = 0;
                if($marks->subject_code == 'CHEM' || $marks->subject_code == 'PHYS' || $marks->subject_code == 'BIOL'){
                    $num[$j] = $i;
                    $j++;
                    $scienceMakrs += $marks->ass_per_mrk;
                }
                $i++;
                // Removing unnecessary subjects
                foreach($num as $n){
                    unset($data['assessment_marks'][$n]);
                }
                $thisMarks = (object) array(
                    "student_id" => $marks->student_id,
                    "gs_id" => $marks->gs_id,
                    "abridged_name" => $marks->abridged_name,
                    "call_name" =>
                    "std_status_code" =>
                    "std_status_category" =>
                    "grade_name" =>
                    "section_name" =>
                    "term_id" =>
                    "program_optional" =>
                    "program_id" =>
                    "assessment_type_id" =>
                    "assessment_cat_weightage" =>
                    "subject_name" =>
                    "subject_code" =>
                    "group_name" =>
                    "subjectBlock" =>
                    "this_gpid" =>
                    "std_program" =>
                    "role_id" =>
                    "gp_id" =>
                    "staff_id" =>
                    "ass_sub_id" =>
                    "assessment_weightage" =>
                    "assessment_name" =>
                    "ass_title" =>
                    "ass_max_marks" =>
                    "marks_obtained" =>
                    "ass_per_mrk" =>
                    "sub_ass_total" =>
                    "grade" =>
                    );
                var_dump($marks);
                exit;
            }
            
        }
        //var_dump($data['assessment_titles']);
        exit;*/

















        $no_of_subjects = sizeof($data['assessment_titles']);
        /*************************************************************************** Grade Computation
        /***********************************************************************************************/
        $StdsubjectGrade = array();
        $i=0;
        $subjectGrade = '';
        $marks_obtained = 0;
        foreach ($data['students_gs_data'] as $student) {
            foreach ($data['assessment_titles'] as $title) {
                $subjectGrade = '';
                foreach ($data['assessment_marks'] as $marks) {
                    if($marks->gs_id == $student->gs_id
                       && $marks->subject_name == $title->subjectname && $marks->assessment_type_id == 1 && $marks->ass_per_mrk > 0){
                        
                            $subjectGrade = $marks->grade;
                    }
                }
                $StdsubjectGrade[$title->subjectname][$i] = $subjectGrade;
                $i++;
            }
        }
        
        /***********************************************************************************************/






















        require_once('components/pdf/fpdf/fpdf_rotate.php');
        require_once('components/pdf/fpdi/fpdi.php');

        // initiate FPDI
        $pdf = new PDF('P', 'mm', 'A4');
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

        $sub_heading_font_size = 12;
        $sub_heading_font_name = 'times';


        $table_header_height = 38;
        $table_header_sub_width = 8;
        $table_header_sub_info_width = 11.05;
        $table_header_sub_height = 8;
        $table_header_font_size = 8;
        $table_header_font_name = 'times'; //Helvetica, CooperBT-Black, Verdana, times, courier


        $text_font_size = 8;
        $text_font_name = 'Verdana'; //Helvetica, CooperBT-Black, Verdana, times, courier
        $text_column_height = 6;
        $text_column_width_sno = 10;
        $text_column_width_gsid = 14;
        $text_column_width_abname = 30;
        $text_column_width_status = 12;
        


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
        $pdf->Cell(20, 4, 'Page 1 / ' . 1, 0, 0, 'L');


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
        $pdf->Cell($header_width, $used_height_y, $class . ' (Term-II Formative Report)',0,0,'C');

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
            $startWith_X = $dataFlowX;
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
            


            /***************************************************************** Writing Marks
            /********************************************************************************/
            $startWith_X += $text_column_width_status;
            $thisText = '';
            $thisText_Grade = '';
            foreach ($data['assessment_titles'] as $title) {
                $thisText = '';
                foreach ($data['assessment_marks'] as $marks) {
                    if($marks->gs_id == $student->gs_id && $marks->subject_name == $title->subjectname && $marks->assessment_type_id == 1){
                        $thisText = $marks->ass_per_mrk;
                        $thisText_Grade = $marks->grade;
                        
                    }
                }

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
                }else if($thisText_Grade=='B'){
                    $fontColor_r = $grade_B_r_FontColor;
                    $fontColor_g = $grade_B_g_FontColor;
                    $fontColor_b = $grade_B_b_FontColor;

                    $BG_fontColor_r = $BG_grade_B_r_FontColor;
                    $BG_fontColor_g = $BG_grade_B_g_FontColor;
                    $BG_fontColor_b = $BG_grade_B_b_FontColor;
                }else if($thisText_Grade=='C'){
                    $fontColor_r = $grade_C_r_FontColor;
                    $fontColor_g = $grade_C_g_FontColor;
                    $fontColor_b = $grade_C_b_FontColor;

                    $BG_fontColor_r = $BG_grade_C_r_FontColor;
                    $BG_fontColor_g = $BG_grade_C_g_FontColor;
                    $BG_fontColor_b = $BG_grade_C_b_FontColor;
                }else if($thisText_Grade=='D'){
                    $fontColor_r = $grade_D_r_FontColor;
                    $fontColor_g = $grade_D_g_FontColor;
                    $fontColor_b = $grade_D_b_FontColor;

                    $BG_fontColor_r = $BG_grade_D_r_FontColor;
                    $BG_fontColor_g = $BG_grade_D_g_FontColor;
                    $BG_fontColor_b = $BG_grade_D_b_FontColor;
                }else if($thisText_Grade=='U'){
                    $fontColor_r = $grade_U_r_FontColor;
                    $fontColor_g = $grade_U_g_FontColor;
                    $fontColor_b = $grade_U_b_FontColor;

                    $BG_fontColor_r = $BG_grade_U_r_FontColor;
                    $BG_fontColor_g = $BG_grade_U_g_FontColor;
                    $BG_fontColor_b = $BG_grade_U_b_FontColor;
                }
                $pdf->setTextColor($fontColor_r, $fontColor_g, $fontColor_b);
                $pdf->setFillColor($BG_fontColor_r, $BG_fontColor_g, $BG_fontColor_b);

                $pdf->SetXY($startWith_X,$startWith_Y);
                $pdf->Cell($table_header_sub_width, $text_column_height, $thisText,1,0,'C',1);

                $startWith_X += $table_header_sub_width;

                $pdf->setTextColor($text_fontColor_r, $text_fontColor_g, $text_fontColor_b);
                $pdf->setFillColor($BG_text_fontColor_r, $BG_text_fontColor_g, $BG_text_fontColor_b);
            }









            $i++;
            $startWith_Y = $startWith_Y - ($table_header_height-$text_column_height);
        }



        /*************** Class Average
        /******************************/
        $pdf->setTextColor($text_fontColor_r, $text_fontColor_g, $text_fontColor_b);
        $pdf->SetFillColor($BG_text_fontColor_r, $BG_text_fontColor_g, $BG_text_fontColor_b);

        $dataFlowX = $ReportStarting_X + $text_column_width_sno + $text_column_width_gsid;
        $dataFlowY = $startWith_Y;

        $startWith_X = $dataFlowX;
        $startWith_Y = $dataFlowY+$table_header_sub_height+30;

        $pdf->SetFillColor(175,175,175);
        $pdf->SetXY($startWith_X,$startWith_Y);
        $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'Class Average',1,0,'L',1);


        $average_marks = array();
        $array_counter = 0;


        //===========================Average Count=========================//
        //=================================================================//


        //var_dump($data['assessment_titles']);
        // var_dump($data['assessment_marks']);
        // var_dump($data['assessment_titles']);
        // exit;


        foreach ($data['assessment_titles'] as $title) {
            $average_marks_add = 0;
            $no_of_optioanal_student = 0;

            foreach($data['assessment_marks'] as $marks){
                if( $marks->subject_name == $title->subjectname && $marks->assessment_type_id == 1 && $marks->std_status_category == 'Student') {
                    $average_marks_add += $marks->ass_per_mrk;
                    if($title->optional == 1){
                        $no_of_optioanal_student = $no_of_optioanal_student + 1;
                    }
                    
                }
            }

                //var_dump($no_of_optioanal_student);
                 // var_dump($average_marks_add);
            // var_dump($no_of_optioanal_student);
                
                //================Optional And Compulsory Subject =============//
                if($title->optional == 1 && $no_of_optioanal_student != 0){
                    $average_marks_adds = ROUND($average_marks_add/$no_of_optioanal_student,0);
                }
                else if ($title->optional == 0){

                    $average_marks_adds = ROUND($average_marks_add/$no_of_students,0);
                    //var_dump($average_marks_add);
                }else{
                    $average_marks_adds = 0;
                }


            $average_marks[$array_counter] = $average_marks_adds;


            if($array_counter == 0){
            $class_average_x = ($startWith_X+$text_column_width_abname+$text_column_width_status);
            }
            else{
                $class_average_x = $class_average_x + $table_header_sub_width;
            }

            if($average_marks[$array_counter] == 0){
                $average_marks[$array_counter] = "";
            }

            $pdf->SetFillColor(175,175,175);
            $pdf->SetXY($class_average_x,$startWith_Y);
            $pdf->Cell($table_header_sub_width,$text_column_height,$average_marks[$array_counter],1,0,'C',1);


            $array_counter++;

            //var_dump($average_marks_add);

            // var_dump($average_marks);


        }

            // var_dump($average_marks);

        // var_dump($data['assessment_titles']);
        //var_dump($data['assessment_marks']);





        //=================== Above Average Count ======================= //
        //===============================================================//
        //foreach($data['students_gs_data'] as )

        for($i=0; $i<sizeof($data['assessment_titles']); $i++){
            $above_average_count = 0;

            for($j=0;$j<sizeof($data['assessment_marks']);$j++){

                if($data['assessment_marks'][$j]->subject_name == $data['assessment_titles'][$i]->subjectname && $data['assessment_marks'][$j]->assessment_type_id == 1 && $data['assessment_marks'][$j]->std_status_category == 'Student'){
                        if(ROUND($data['assessment_marks'][$j]->ass_per_mrk,0) >= $average_marks[$i]){
                            $above_average_count++;
                        }
                }

            }

            // echo "<hr>";
            // echo $above_average_count;
            if($i == 0){
            $above_average_x = ($startWith_X+$text_column_width_abname+$text_column_width_status);
            }
            else{
                $above_average_x = $above_average_x + $table_header_sub_width;
            }

            if($above_average_count == 0){
                $above_average_count = '';
            }

            $pdf->SetFillColor(255,255,255);
            $above_average_y = $startWith_Y + $text_column_height; 
            $pdf->SetXY($above_average_x,$above_average_y);
            $pdf->Cell($table_header_sub_width,$text_column_height,$above_average_count,1,0,'C',1);



        }

        //==================Below Average Count ======================//
        //============================================================//
        
        for($i=0; $i<sizeof($data['assessment_titles']); $i++){
            $below_average_count = 0;

            for($j=0;$j<sizeof($data['assessment_marks']);$j++){

                if($data['assessment_marks'][$j]->subject_name == $data['assessment_titles'][$i]->subjectname && $data['assessment_marks'][$j]->assessment_type_id == 1 &&  $data['assessment_marks'][$j]->std_status_category == 'Student'){
                        if(ROUND($data['assessment_marks'][$j]->ass_per_mrk,0) < $average_marks[$i]){
                            $below_average_count++;
                        }
                }

            }

            // echo "<hr>";
            // echo $below_average_count;
            if($i == 0){
            $below_average_x = ($startWith_X+$text_column_width_abname+$text_column_width_status);
            }
            else{
                $below_average_x = $below_average_x + $table_header_sub_width;
            }

            if($below_average_count == 0){
                $below_average_count = '';
            }

            $pdf->SetFillColor(175,175,175);
            $below_average_y = $startWith_Y + ($text_column_height*2); 
            $pdf->SetXY($below_average_x,$below_average_y);
            $pdf->Cell($table_header_sub_width,$text_column_height,$below_average_count,1,0,'C',1);

        }

        $startWith_Y += $text_column_height;
        $pdf->SetFillColor(255,255,255);
        $pdf->SetXY($startWith_X,$startWith_Y);
        $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'Above Average',1,0,'L',1);



        $startWith_Y += $text_column_height;
        $pdf->SetFillColor(175,175,175);
        $pdf->SetXY($startWith_X,$startWith_Y);
        $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'Below Average',1,0,'L',1);


        //$no_of_subject = count($data['assessment_titles']);

        // var_dump($no_of_subject);
        






        /*************** Class Grading
        /******************************/
        if($gradeID >= 6 && $gradeID <= 9){

        	        $dataFlowX = $ReportStarting_X + $text_column_width_sno + $text_column_width_gsid;
        $startWith_X = $dataFlowX;
        $startWith_Y += $text_column_height;
        $pdf->SetFillColor(255,255,255);
        $pdf->SetXY($startWith_X,$startWith_Y);
        $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'APlus',1,0,'L',1);
        $startWith_X += $text_column_width_abname+$text_column_width_status;
        foreach ($data['assessment_titles'] as $title) {
            $thisText = $this->assessment_report_model->CountThisGradeIn_2d($StdsubjectGrade[$title->subjectname], 'A+');
            //var_dump($StdsubjectGrade[$title->subjectname]);
            if($thisText==0){$thisText='';}
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($table_header_sub_width, $text_column_height, $thisText,1,0,'C');

            $startWith_X += $table_header_sub_width;
        }
        //exit;


        $startWith_X = $dataFlowX;
        $startWith_Y += $text_column_height;
        $pdf->SetXY($startWith_X,$startWith_Y);
        $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'A',1,0,'L',1);
        $startWith_X += $text_column_width_abname+$text_column_width_status;
        foreach ($data['assessment_titles'] as $title) {
            $thisText = $this->assessment_report_model->CountThisGradeIn_2d($StdsubjectGrade[$title->subjectname], 'A');
            if($thisText==0){$thisText='';}
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($table_header_sub_width, $text_column_height, $thisText,1,0,'C');

            $startWith_X += $table_header_sub_width;
        }



        $startWith_X = $dataFlowX;
        $startWith_Y += $text_column_height;
        $pdf->SetXY($startWith_X,$startWith_Y);
        $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'B+',1,0,'L',1);
        $startWith_X += $text_column_width_abname+$text_column_width_status;
        foreach ($data['assessment_titles'] as $title) {
            $thisText = $this->assessment_report_model->CountThisGradeIn_2d($StdsubjectGrade[$title->subjectname], 'B+');
            if($thisText==0){$thisText='';}
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($table_header_sub_width, $text_column_height, $thisText,1,0,'C');

            $startWith_X += $table_header_sub_width;
        }



        $startWith_X = $dataFlowX;
        $startWith_Y += $text_column_height;
        $pdf->SetXY($startWith_X,$startWith_Y);
        $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'B',1,0,'L',1);
        $startWith_X += $text_column_width_abname+$text_column_width_status;
        foreach ($data['assessment_titles'] as $title) {
            $thisText = $this->assessment_report_model->CountThisGradeIn_2d($StdsubjectGrade[$title->subjectname], 'B');
            if($thisText==0){$thisText='';}
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($table_header_sub_width, $text_column_height, $thisText,1,0,'C');

            $startWith_X += $table_header_sub_width;
        }



        $startWith_X = $dataFlowX;
        $startWith_Y += $text_column_height;
        $pdf->SetXY($startWith_X,$startWith_Y);
        $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'C+',1,0,'L',1);
        $startWith_X += $text_column_width_abname+$text_column_width_status;
        foreach ($data['assessment_titles'] as $title) {
            $thisText = $this->assessment_report_model->CountThisGradeIn_2d($StdsubjectGrade[$title->subjectname], 'C+');
            if($thisText==0){$thisText='';}
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($table_header_sub_width, $text_column_height, $thisText,1,0,'C');

            $startWith_X += $table_header_sub_width;
        }



        $startWith_X = $dataFlowX;
        $startWith_Y += $text_column_height;
        $pdf->SetXY($startWith_X,$startWith_Y);
        $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'C',1,0,'L',1);
        $startWith_X += $text_column_width_abname+$text_column_width_status;
        foreach ($data['assessment_titles'] as $title) {
            $thisText = $this->assessment_report_model->CountThisGradeIn_2d($StdsubjectGrade[$title->subjectname], 'C');
            if($thisText==0){$thisText='';}
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($table_header_sub_width, $text_column_height, $thisText,1,0,'C');

            $startWith_X += $table_header_sub_width;
        }

        }else{


        $dataFlowX = $ReportStarting_X + $text_column_width_sno + $text_column_width_gsid;
        $startWith_X = $dataFlowX;
        $startWith_Y += $text_column_height;
        $pdf->SetFillColor(255,255,255);
        $pdf->SetXY($startWith_X,$startWith_Y);
        $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'APlus',1,0,'L',1);
        $startWith_X += $text_column_width_abname+$text_column_width_status;
        foreach ($data['assessment_titles'] as $title) {
            $thisText = $this->assessment_report_model->CountThisGradeIn_2d($StdsubjectGrade[$title->subjectname], 'A+');
            //var_dump($StdsubjectGrade[$title->subjectname]);
            if($thisText==0){$thisText='';}
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($table_header_sub_width, $text_column_height, $thisText,1,0,'C');

            $startWith_X += $table_header_sub_width;
        }
        //exit;


        $startWith_X = $dataFlowX;
        $startWith_Y += $text_column_height;
        $pdf->SetXY($startWith_X,$startWith_Y);
        $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'A',1,0,'L',1);
        $startWith_X += $text_column_width_abname+$text_column_width_status;
        foreach ($data['assessment_titles'] as $title) {
            $thisText = $this->assessment_report_model->CountThisGradeIn_2d($StdsubjectGrade[$title->subjectname], 'A');
            if($thisText==0){$thisText='';}
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($table_header_sub_width, $text_column_height, $thisText,1,0,'C');

            $startWith_X += $table_header_sub_width;
        }



        $startWith_X = $dataFlowX;
        $startWith_Y += $text_column_height;
        $pdf->SetXY($startWith_X,$startWith_Y);
        $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'B',1,0,'L',1);
        $startWith_X += $text_column_width_abname+$text_column_width_status;
        foreach ($data['assessment_titles'] as $title) {
            $thisText = $this->assessment_report_model->CountThisGradeIn_2d($StdsubjectGrade[$title->subjectname], 'B');
            if($thisText==0){$thisText='';}
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($table_header_sub_width, $text_column_height, $thisText,1,0,'C');

            $startWith_X += $table_header_sub_width;
        }



        $startWith_X = $dataFlowX;
        $startWith_Y += $text_column_height;
        $pdf->SetXY($startWith_X,$startWith_Y);
        $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'C',1,0,'L',1);
        $startWith_X += $text_column_width_abname+$text_column_width_status;
        foreach ($data['assessment_titles'] as $title) {
            $thisText = $this->assessment_report_model->CountThisGradeIn_2d($StdsubjectGrade[$title->subjectname], 'C');
            if($thisText==0){$thisText='';}
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($table_header_sub_width, $text_column_height, $thisText,1,0,'C');

            $startWith_X += $table_header_sub_width;
        }



        $startWith_X = $dataFlowX;
        $startWith_Y += $text_column_height;
        $pdf->SetXY($startWith_X,$startWith_Y);
        $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'D',1,0,'L',1);
        $startWith_X += $text_column_width_abname+$text_column_width_status;
        foreach ($data['assessment_titles'] as $title) {
            $thisText = $this->assessment_report_model->CountThisGradeIn_2d($StdsubjectGrade[$title->subjectname], 'D');
            if($thisText==0){$thisText='';}
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($table_header_sub_width, $text_column_height, $thisText,1,0,'C');

            $startWith_X += $table_header_sub_width;
        }



        $startWith_X = $dataFlowX;
        $startWith_Y += $text_column_height;
        $pdf->SetXY($startWith_X,$startWith_Y);
        $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'U',1,0,'L',1);
        $startWith_X += $text_column_width_abname+$text_column_width_status;
        foreach ($data['assessment_titles'] as $title) {
            $thisText = $this->assessment_report_model->CountThisGradeIn_2d($StdsubjectGrade[$title->subjectname], 'U');
            if($thisText==0){$thisText='';}
            $pdf->SetXY($startWith_X,$startWith_Y);
            $pdf->Cell($table_header_sub_width, $text_column_height, $thisText,1,0,'C');

            $startWith_X += $table_header_sub_width;
        }



        }

        














        /***** Grade Subjects
        /******************************/

        $dataFlowX = $dataFlowX + $text_column_width_abname + $text_column_width_status;
        $startWith_X = $dataFlowX;
        $startWith_Y = $ReportStarting_Y+$table_header_sub_height+30+($used_height_y*2);
        $pdf->SetFont($table_header_font_name,'B',$table_header_font_size);
        $i=1;
        foreach ($data['assessment_titles'] as $title) {
            $pdf->RotatedCell($startWith_X,$startWith_Y,$table_header_sub_height+30, $table_header_sub_width, $title->subjectname,1,0,'L',90,1);

            $startWith_X += $table_header_sub_width;
        }















        // Output the new PDF
        $pdf->Output('Formative_Term_Report' . '.pdf', 'I');

    }



    /********************* Term Report 1 **************************/
    /*************************************************************/

    public function get_UnitAssessment_n_Review_Report_pdf(){



        $gradeID = $this->input->post('grade');
        $sectionID = $this->input->post('section');
        $academic_id = $this->input->post('academic');
        $gradeName = $this->input->post('grade_name');
        $sectionName = $this->input->post('section_name');
        $term = $this->input->post('term');


        $html = '';



        $html .= '
        <style>
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



        // $pdf_link = '/etab_reports/unit_report_ajax/generate_UnitAssessment_n_Review_report?gradeID=' . $gradeID .'&sectionID=' . $sectionID .'&gradeName=' . $gradeName .'&sectionName=' . $sectionName .'&term=' . $term;

        if($gradeID <= 9){
        $pdf_link = '/etab_reports/term_report_junior_ajax/generate_UnitAssessment_n_Review_report?gradeID=' . $gradeID .'&sectionID=' . $sectionID .'&gradeName=' . $gradeName .'&sectionName=' . $sectionName .'&term=' . $term;

        }else{
        $pdf_link = '/etab_reports/unit_report_ajax/generate_UnitAssessment_n_Review_report?gradeID=' . $gradeID .'&sectionID=' . $sectionID .'&gradeName=' . $gradeName .'&sectionName=' . $sectionName .'&term=' . $term;
        }


        $html .= '<div class="powerwidget purple" id="datatable-filter-column" data-widget-editbutton="false" role="widget" style="">
              <header role="heading">
                <i class="fa fa-tasks"></i> Report : '.$gradeName.'-'.$sectionName.'
                <div class="powerwidget-ctrls" role="menu">
                  <h3>
                    <span class="glyphicon glyphicon-remove close_setup_4 pull-right cursor" style="top: -11px;"></span>
                  </h3>
                </div>
                <span class="powerwidget-loader"></span>
              </header>

              <div class="inner-spacer" role="content">
                <div id="staff_edit_table_wrapper" class="dataTables_wrapper form-inline" role="grid">';

                
        $html .=    '<div class="unit_report_pdf_iframe"> 
                        <iframe src="'.site_url().$pdf_link.'" frameBorder="0"> </iframe> 
                    </div>';

        $html .= '
              </div>
            </div>
        </div>';



        echo $html;
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
        $data['all_subjects'] = array();
        if($gradeID == 10 || $gradeID == 11){
            //$data['assessment_titles'] = $this->assessment_report_model->Complete_Assessment_Report_GS_Subjects_Science($gradeID, $sectionID);
            $data['assessment_titles'] = $this->assessment_report_model->Complete_Assessment_Report_GS_Subjects_Science_SessionTerm($gradeID, $sectionID, "");
            
        }else{
            //$data['assessment_titles'] = $this->assessment_report_model->Complete_Assessment_Report_GS_Subjects($gradeID, $sectionID);
            $data['assessment_titles'] = $this->assessment_report_model->Complete_Assessment_Report_GS_Subjects_SessionTerm($gradeID, $sectionID, "");
        }

        $data['all_subjects'] = $this->assessment_report_model->Complete_Assessment_Report_GS_Subjects_Split($gradeID, $sectionID, "");





        /***************************** Assessment Marks
        /***********************************************/

            if($gradeID == 10 || $gradeID == 11){
            //$data['assessment_marks'] = $this->assessment_report_model->Complete_Assessment_Report_GS_lvl_3_Science($gradeID, $sectionID, $termID);
            $data['assessment_marks'] = $this->assessment_report_model->Complete_Assessment_Report_GS_lvl_3_Science_SessionTerm($gradeID, $sectionID, $termID, "");
            }else{
                //$data['assessment_marks'] = $this->assessment_report_model->Complete_Assessment_Report_GS_lvl_3($gradeID, $sectionID, $termID);
                $data['assessment_marks'] = $this->assessment_report_model->Complete_Assessment_Report_GS_lvl_3_SessionTerm($gradeID, $sectionID, $termID, "");
            }


        /***************************** Assessment Grade
        /***********************************************/


         if($gradeID == 10 || $gradeID == 11){
            //$data['assessment_grade'] = $this->assessment_report_model->Complete_Assessment_Report_GS_lvl_4_Science($gradeID, $sectionID, $termID);
            $data['assessment_grade'] = $this->assessment_report_model->Complete_Assessment_Report_GS_lvl_4_Science_SessionTerm($gradeID, $sectionID, $termID, "");
        }else{
            //$data['assessment_grade'] = $this->assessment_report_model->Complete_Assessment_Report_GS_lvl_4($gradeID, $sectionID, $termID);
            $data['assessment_grade'] = $this->assessment_report_model->Complete_Assessment_Report_GS_lvl_4_SessionTerm($gradeID, $sectionID, $termID, "");
        }

   
        /******************************* Assessment ASP
        /***********************************************/
        //$data['assessment_asp'] = $this->assessment_report_model->Complete_Assessment_Report_GS_lvl_ASP($gradeID, $sectionID, $termID);

        $data['assessment_asp'] = $this->assessment_report_model->Complete_Assessment_Report_GS_lvl_ASP_SessionTerm($gradeID, $sectionID, $termID, "");
    
        /********************* Assessment Overall Grade
        /***********************************************/
        $data['assessment_overall_garde'] = $this->assessment_report_model->get_Grade_Overall_grading($gradeID, "");
        /*************************************************************************************************************************************/
        $no_of_subjects = sizeof($data['assessment_titles']);





        $TermReportTitle = ' (Term-1 Report 2017-18)';


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
                    if($marks->gs_id == $student->gs_id
                       && $marks->subject_name == $title->subjectname){
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
                    if($grade->gs_id == $student->gs_id
                       && $grade->subject_name == $title->subjectname){
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

            $subjectTeacher = array();
            $sbt_counter = 0;
            foreach ($data['all_subjects'] as $sbt) {
                if($sbt->subjects == $title->subjects){
                    $subjectTeacher[$sbt_counter] = $sbt->subject_teacher;
                    $sbt_counter++;
                }
            }
            $sbt_counter = 0;
            $subjectTeacher = array_unique($subjectTeacher);
            foreach ($subjectTeacher as $SBT_Name) {
                $pdf->SetXY($startWith_X,$pdf->h-30+($sbt_counter*4));
                $pdf->Cell($table_header_sub_width, $table_header_sub_height, $SBT_Name, 0, 0, 'L');
                $sbt_counter++;                
            }

            $startWith_X += $table_header_sub_width;

            if($i == 7){break;}
            $i++;
        }
        $i=1;
        $startWith_X = $dataFlowX;
        $startWith_Y += $table_header_sub_height;
        foreach ($data['assessment_titles'] as $title) {
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
                        }else if($grade->grade=='B'){
                            $fontColor_r = $grade_B_r_FontColor;
                            $fontColor_g = $grade_B_g_FontColor;
                            $fontColor_b = $grade_B_b_FontColor;

                            $BG_fontColor_r = $BG_grade_B_r_FontColor;
                            $BG_fontColor_g = $BG_grade_B_g_FontColor;
                            $BG_fontColor_b = $BG_grade_B_b_FontColor;
                        }else if($grade->grade=='C'){
                            $fontColor_r = $grade_C_r_FontColor;
                            $fontColor_g = $grade_C_g_FontColor;
                            $fontColor_b = $grade_C_b_FontColor;

                            $BG_fontColor_r = $BG_grade_C_r_FontColor;
                            $BG_fontColor_g = $BG_grade_C_g_FontColor;
                            $BG_fontColor_b = $BG_grade_C_b_FontColor;
                        }else if($grade->grade=='D'){
                            $fontColor_r = $grade_D_r_FontColor;
                            $fontColor_g = $grade_D_g_FontColor;
                            $fontColor_b = $grade_D_b_FontColor;

                            $BG_fontColor_r = $BG_grade_D_r_FontColor;
                            $BG_fontColor_g = $BG_grade_D_g_FontColor;
                            $BG_fontColor_b = $BG_grade_D_b_FontColor;
                        }else if($grade->grade=='U'){
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
                $pdf->Cell($table_header_sub_info_width, $text_column_height, $formativeMarks,1,0,'C',1);

                $startWith_X += $table_header_sub_info_width;
                $pdf->SetXY($startWith_X,$startWith_Y);
                $pdf->Cell($table_header_sub_info_width, $text_column_height, $summativeMarks,1,0,'C',1);

                $startWith_X += $table_header_sub_info_width;
                $pdf->SetXY($startWith_X,$startWith_Y);
                $pdf->Cell($table_header_sub_info_width, $text_column_height, $finalMarks,1,0,'C',1);

                $startWith_X += $table_header_sub_info_width;
                $pdf->SetXY($startWith_X,$startWith_Y);
                $pdf->Cell($table_header_sub_info_width, $text_column_height, $finalGrade,1,0,'C',1);

                $startWith_X += $table_header_sub_info_width;                

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
        $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'APlus',1,0,'L',1);

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
                $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['ftgd'], 'B');
            }
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


            $startWith_Y += $text_column_height;
            $thisText = '';
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subjectname]['ftgd'])){
                $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['ftgd'], 'C');
            }
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


            $startWith_Y += $text_column_height;
            $thisText = '';
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subjectname]['ftgd'])){
                $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['ftgd'], 'D');
            }
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


            $startWith_Y += $text_column_height;
            $thisText = '';
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subjectname]['ftgd'])){
                $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['ftgd'], 'U');
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
                $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['stgd'], 'B');
            }
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


            $startWith_Y += $text_column_height;
            $thisText = '';
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subjectname]['stgd'])){
                $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['stgd'], 'C');
            }
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


            $startWith_Y += $text_column_height;
            $thisText = '';
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subjectname]['stgd'])){
                $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['stgd'], 'D');
            }
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


            $startWith_Y += $text_column_height;
            $thisText = '';
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subjectname]['stgd'])){
                $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['stgd'], 'U');
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
            $totalSubjects_gd = 0;
            if(!empty($studentMarks[$title->subjectname]['gd'])){$totalSubjects_gd = count($studentMarks[$title->subjectname]['gd']);}
            $startWith_Y += $text_column_height + 4;
            $thisText = '';
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subjectname]['gd'])){
                $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['gd'], 'A+');
            }
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
            /******************************** Percentage - Grade - Ap *****/
            $pdf->SetXY($startWith_X+$table_header_sub_info_width,$startWith_Y);
            if($totalSubjects_gd==0){
                $pdf->Cell($table_header_sub_info_width, $text_column_height, '',0,0,'C');    
            }else{
                $pdf->Cell($table_header_sub_info_width, $text_column_height, ROUND($thisText/$totalSubjects_gd*100, 0).'%',0,0,'C');                
            }


            $startWith_Y += $text_column_height;
            $thisText = '';
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subjectname]['gd'])){
                $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['gd'], 'A');
            }
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
            /******************************** Percentage - Grade - A *****/
            $pdf->SetXY($startWith_X+$table_header_sub_info_width,$startWith_Y);
            if($totalSubjects_gd==0){
                $pdf->Cell($table_header_sub_info_width, $text_column_height, '',0,0,'C');    
            }else{
                $pdf->Cell($table_header_sub_info_width, $text_column_height, ROUND($thisText/$totalSubjects_gd*100, 0).'%',0,0,'C');                
            }


            $startWith_Y += $text_column_height;
            $thisText = '';
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subjectname]['gd'])){
                $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['gd'], 'B');
            }
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
            /******************************** Percentage - Grade - B *****/
            $pdf->SetXY($startWith_X+$table_header_sub_info_width,$startWith_Y);
            if($totalSubjects_gd==0){
                $pdf->Cell($table_header_sub_info_width, $text_column_height, '',0,0,'C');    
            }else{
                $pdf->Cell($table_header_sub_info_width, $text_column_height, ROUND($thisText/$totalSubjects_gd*100, 0).'%',0,0,'C');                
            }


            $startWith_Y += $text_column_height;
            $thisText = '';
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subjectname]['gd'])){
                $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['gd'], 'C');
            }
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
            /******************************** Percentage - Grade - C *****/
            $pdf->SetXY($startWith_X+$table_header_sub_info_width,$startWith_Y);
            if($totalSubjects_gd==0){
                $pdf->Cell($table_header_sub_info_width, $text_column_height, '',0,0,'C');    
            }else{
                $pdf->Cell($table_header_sub_info_width, $text_column_height, ROUND($thisText/$totalSubjects_gd*100, 0).'%',0,0,'C');                
            }


            $startWith_Y += $text_column_height;
            $thisText = '';
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subjectname]['gd'])){
                $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['gd'], 'D');
            }
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
            /******************************** Percentage - Grade - D *****/
            $pdf->SetXY($startWith_X+$table_header_sub_info_width,$startWith_Y);
            if($totalSubjects_gd==0){
                $pdf->Cell($table_header_sub_info_width, $text_column_height, '',0,0,'C');    
            }else{
                $pdf->Cell($table_header_sub_info_width, $text_column_height, ROUND($thisText/$totalSubjects_gd*100, 0).'%',0,0,'C');                
            }


            $startWith_Y += $text_column_height;
            $thisText = '';
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subjectname]['gd'])){
                $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['gd'], 'U');
            }
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
            /******************************** Percentage - Grade - U *****/
            $pdf->SetXY($startWith_X+$table_header_sub_info_width,$startWith_Y);
            if($totalSubjects_gd==0){
                $pdf->Cell($table_header_sub_info_width, $text_column_height, '',0,0,'C');    
            }else{
                $pdf->Cell($table_header_sub_info_width, $text_column_height, ROUND($thisText/$totalSubjects_gd*100, 0).'%',0,0,'C');                
            }












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

                    unset($subjectTeacher);
                    $subjectTeacher = array();
                    $sbt_counter = 0;
                    foreach ($data['all_subjects'] as $sbt) {
                        if($sbt->subjects == $title->subjects){
                            $subjectTeacher[$sbt_counter] = $sbt->subject_teacher;
                            $sbt_counter++;
                        }
                    }
                    $sbt_counter = 0;
                    $subjectTeacher = array_unique($subjectTeacher);
                    foreach ($subjectTeacher as $SBT_Name) {
                        $pdf->SetXY($startWith_X,$pdf->h-30+($sbt_counter*4));
                        $pdf->Cell($table_header_sub_width, $table_header_sub_height, $SBT_Name, 0, 0, 'L');
                        $sbt_counter++;                
                    }

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
                                }else if($grade->grade=='B'){
                                    $fontColor_r = $grade_B_r_FontColor;
                                    $fontColor_g = $grade_B_g_FontColor;
                                    $fontColor_b = $grade_B_b_FontColor;

                                    $BG_fontColor_r = $BG_grade_B_r_FontColor;
                                    $BG_fontColor_g = $BG_grade_B_g_FontColor;
                                    $BG_fontColor_b = $BG_grade_B_b_FontColor;
                                }else if($grade->grade=='C'){
                                    $fontColor_r = $grade_C_r_FontColor;
                                    $fontColor_g = $grade_C_g_FontColor;
                                    $fontColor_b = $grade_C_b_FontColor;

                                    $BG_fontColor_r = $BG_grade_C_r_FontColor;
                                    $BG_fontColor_g = $BG_grade_C_g_FontColor;
                                    $BG_fontColor_b = $BG_grade_C_b_FontColor;
                                }else if($grade->grade=='D'){
                                    $fontColor_r = $grade_D_r_FontColor;
                                    $fontColor_g = $grade_D_g_FontColor;
                                    $fontColor_b = $grade_D_b_FontColor;

                                    $BG_fontColor_r = $BG_grade_D_r_FontColor;
                                    $BG_fontColor_g = $BG_grade_D_g_FontColor;
                                    $BG_fontColor_b = $BG_grade_D_b_FontColor;
                                }else if($grade->grade=='U'){
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
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, $formativeMarks,1,0,'C',1);

                        $startWith_X += $table_header_sub_info_width;
                        $pdf->SetXY($startWith_X,$startWith_Y);
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, $summativeMarks,1,0,'C',1);

                        $startWith_X += $table_header_sub_info_width;
                        $pdf->SetXY($startWith_X,$startWith_Y);
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, $finalMarks,1,0,'C',1);

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
            $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'APlus',1,0,'L',1);

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
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['ftgd'], 'B');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['ftgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['ftgd'], 'C');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['ftgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['ftgd'], 'D');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['ftgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['ftgd'], 'U');
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
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['stgd'], 'B');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['stgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['stgd'], 'C');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['stgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['stgd'], 'D');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['stgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['stgd'], 'U');
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
                    $totalSubjects_gd = 0;
                    if(!empty($studentMarks[$title->subjectname]['gd'])){$totalSubjects_gd = count($studentMarks[$title->subjectname]['gd']);}
                    $startWith_Y += $text_column_height + 4;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['gd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['gd'], 'A+');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
                    /******************************** Percentage - Grade - Ap *****/
                    $pdf->SetXY($startWith_X+$table_header_sub_info_width,$startWith_Y);
                    if($totalSubjects_gd==0){
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, '',0,0,'C');    
                    }else{
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, ROUND($thisText/$totalSubjects_gd*100, 0).'%',0,0,'C');                
                    }


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['gd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['gd'], 'A');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
                    /******************************** Percentage - Grade - A *****/
                    $pdf->SetXY($startWith_X+$table_header_sub_info_width,$startWith_Y);
                    if($totalSubjects_gd==0){
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, '',0,0,'C');    
                    }else{
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, ROUND($thisText/$totalSubjects_gd*100, 0).'%',0,0,'C');                
                    }



                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['gd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['gd'], 'B');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
                    /******************************** Percentage - Grade - B *****/
                    $pdf->SetXY($startWith_X+$table_header_sub_info_width,$startWith_Y);
                    if($totalSubjects_gd==0){
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, '',0,0,'C');    
                    }else{
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, ROUND($thisText/$totalSubjects_gd*100, 0).'%',0,0,'C');                
                    }



                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['gd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['gd'], 'C');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
                    /******************************** Percentage - Grade - C *****/
                    $pdf->SetXY($startWith_X+$table_header_sub_info_width,$startWith_Y);
                    if($totalSubjects_gd==0){
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, '',0,0,'C');    
                    }else{
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, ROUND($thisText/$totalSubjects_gd*100, 0).'%',0,0,'C');                
                    }




                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['gd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['gd'], 'D');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
                    /******************************** Percentage - Grade - D *****/
                    $pdf->SetXY($startWith_X+$table_header_sub_info_width,$startWith_Y);
                    if($totalSubjects_gd==0){
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, '',0,0,'C');    
                    }else{
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, ROUND($thisText/$totalSubjects_gd*100, 0).'%',0,0,'C');                
                    }




                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['gd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['gd'], 'U');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
                    /******************************** Percentage - Grade - U *****/
                    $pdf->SetXY($startWith_X+$table_header_sub_info_width,$startWith_Y);
                    if($totalSubjects_gd==0){
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, '',0,0,'C');    
                    }else{
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, ROUND($thisText/$totalSubjects_gd*100, 0).'%',0,0,'C');                
                    }











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

                    unset($subjectTeacher);
                    $subjectTeacher = array();
                    $sbt_counter = 0;
                    foreach ($data['all_subjects'] as $sbt) {
                        if($sbt->subjects == $title->subjects){
                            $subjectTeacher[$sbt_counter] = $sbt->subject_teacher;
                            $sbt_counter++;
                        }
                    }
                    $sbt_counter = 0;
                    $subjectTeacher = array_unique($subjectTeacher);
                    foreach ($subjectTeacher as $SBT_Name) {
                        $pdf->SetXY($startWith_X,$pdf->h-30+($sbt_counter*4));
                        $pdf->Cell($table_header_sub_width, $table_header_sub_height, $SBT_Name, 0, 0, 'L');
                        $sbt_counter++;                
                    }

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
                                }else if($grade->grade=='B'){
                                    $fontColor_r = $grade_B_r_FontColor;
                                    $fontColor_g = $grade_B_g_FontColor;
                                    $fontColor_b = $grade_B_b_FontColor;

                                    $BG_fontColor_r = $BG_grade_B_r_FontColor;
                                    $BG_fontColor_g = $BG_grade_B_g_FontColor;
                                    $BG_fontColor_b = $BG_grade_B_b_FontColor;
                                }else if($grade->grade=='C'){
                                    $fontColor_r = $grade_C_r_FontColor;
                                    $fontColor_g = $grade_C_g_FontColor;
                                    $fontColor_b = $grade_C_b_FontColor;

                                    $BG_fontColor_r = $BG_grade_C_r_FontColor;
                                    $BG_fontColor_g = $BG_grade_C_g_FontColor;
                                    $BG_fontColor_b = $BG_grade_C_b_FontColor;
                                }else if($grade->grade=='D'){
                                    $fontColor_r = $grade_D_r_FontColor;
                                    $fontColor_g = $grade_D_g_FontColor;
                                    $fontColor_b = $grade_D_b_FontColor;

                                    $BG_fontColor_r = $BG_grade_D_r_FontColor;
                                    $BG_fontColor_g = $BG_grade_D_g_FontColor;
                                    $BG_fontColor_b = $BG_grade_D_b_FontColor;
                                }else if($grade->grade=='U'){
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
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, $formativeMarks,1,0,'C',1);

                        $startWith_X += $table_header_sub_info_width;
                        $pdf->SetXY($startWith_X,$startWith_Y);
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, $summativeMarks,1,0,'C',1);

                        $startWith_X += $table_header_sub_info_width;
                        $pdf->SetXY($startWith_X,$startWith_Y);
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, $finalMarks,1,0,'C',1);

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
            $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'APlus',1,0,'L',1);

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
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['ftgd'], 'B');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['ftgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['ftgd'], 'C');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['ftgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['ftgd'], 'D');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['ftgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['ftgd'], 'U');
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
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['stgd'], 'B');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['stgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['stgd'], 'C');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['stgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['stgd'], 'D');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['stgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['stgd'], 'U');
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
                    $totalSubjects_gd = 0;
                    if(!empty($studentMarks[$title->subjectname]['gd'])){$totalSubjects_gd = count($studentMarks[$title->subjectname]['gd']);}
                    $startWith_Y += $text_column_height + 4;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['gd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['gd'], 'A+');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
                    /******************************** Percentage - Grade - Ap *****/
                    $pdf->SetXY($startWith_X+$table_header_sub_info_width,$startWith_Y);
                    if($totalSubjects_gd==0){
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, '',0,0,'C');    
                    }else{
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, ROUND($thisText/$totalSubjects_gd*100, 0).'%',0,0,'C');                
                    }




                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['gd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['gd'], 'A');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
                    /******************************** Percentage - Grade - A *****/
                    $pdf->SetXY($startWith_X+$table_header_sub_info_width,$startWith_Y);
                    if($totalSubjects_gd==0){
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, '',0,0,'C');    
                    }else{
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, ROUND($thisText/$totalSubjects_gd*100, 0).'%',0,0,'C');                
                    }




                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['gd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['gd'], 'B');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
                    /******************************** Percentage - Grade - B *****/
                    $pdf->SetXY($startWith_X+$table_header_sub_info_width,$startWith_Y);
                    if($totalSubjects_gd==0){
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, '',0,0,'C');    
                    }else{
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, ROUND($thisText/$totalSubjects_gd*100, 0).'%',0,0,'C');                
                    }




                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['gd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['gd'], 'C');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
                    /******************************** Percentage - Grade - C *****/
                    $pdf->SetXY($startWith_X+$table_header_sub_info_width,$startWith_Y);
                    if($totalSubjects_gd==0){
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, '',0,0,'C');    
                    }else{
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, ROUND($thisText/$totalSubjects_gd*100, 0).'%',0,0,'C');                
                    }




                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['gd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['gd'], 'D');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
                    /******************************** Percentage - Grade - D *****/
                    $pdf->SetXY($startWith_X+$table_header_sub_info_width,$startWith_Y);
                    if($totalSubjects_gd==0){
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, '',0,0,'C');    
                    }else{
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, ROUND($thisText/$totalSubjects_gd*100, 0).'%',0,0,'C');                
                    }




                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subjectname]['gd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subjectname]['gd'], 'U');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
                    /******************************** Percentage - Grade - U *****/
                    $pdf->SetXY($startWith_X+$table_header_sub_info_width,$startWith_Y);
                    if($totalSubjects_gd==0){
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, '',0,0,'C');    
                    }else{
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, ROUND($thisText/$totalSubjects_gd*100, 0).'%',0,0,'C');                
                    }













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
                        if($grading->grading_name == 'B'){$grade_B_per = $grading->weightage;}
                        if($grading->grading_name == 'C'){$grade_C_per = $grading->weightage;}
                        if($grading->grading_name == 'D'){$grade_D_per = $grading->weightage;}
                        if($grading->grading_name == 'U'){$grade_U_per = $grading->weightage;}
                    }
                    if($thisText_Per >= $grade_Ap_per){
                        $thisText_Grade = 'A+';
                    }else if($thisText_Per >= $grade_A_per){
                        $thisText_Grade = 'A';
                    }else if($thisText_Per >= $grade_B_per){
                        $thisText_Grade = 'B';
                    }else if($thisText_Per >= $grade_C_per){
                        $thisText_Grade = 'C';
                    }else if($thisText_Per >= $grade_D_per){
                        $thisText_Grade = 'D';
                    }else {
                        $thisText_Grade = 'U';
                    }

                    $thisText_Rank = $this->assessment_report_model->getRankOf($studentTotalPercentage, $thisText_Per);

                    if($studentGrade_U[$student->gs_id] == 1000){
                        $thisText_Grade = 'U';

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
                        }else if($thisText_Grade=='B'){
                            $fontColor_r = $grade_B_r_FontColor;
                            $fontColor_g = $grade_B_g_FontColor;
                            $fontColor_b = $grade_B_b_FontColor;

                            $BG_fontColor_r = $BG_grade_B_r_FontColor;
                            $BG_fontColor_g = $BG_grade_B_g_FontColor;
                            $BG_fontColor_b = $BG_grade_B_b_FontColor;
                        }else if($thisText_Grade=='C'){
                            $fontColor_r = $grade_C_r_FontColor;
                            $fontColor_g = $grade_C_g_FontColor;
                            $fontColor_b = $grade_C_b_FontColor;

                            $BG_fontColor_r = $BG_grade_C_r_FontColor;
                            $BG_fontColor_g = $BG_grade_C_g_FontColor;
                            $BG_fontColor_b = $BG_grade_C_b_FontColor;
                        }else if($thisText_Grade=='D'){
                            $fontColor_r = $grade_D_r_FontColor;
                            $fontColor_g = $grade_D_g_FontColor;
                            $fontColor_b = $grade_D_b_FontColor;

                            $BG_fontColor_r = $BG_grade_D_r_FontColor;
                            $BG_fontColor_g = $BG_grade_D_g_FontColor;
                            $BG_fontColor_b = $BG_grade_D_b_FontColor;
                        }else if($thisText_Grade=='U'){
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
                if($grading->grading_name == 'A'){$grade_A_per = $this->assessment_report_model->getCountOf_GreaterOnly_2d_Between($OverAll_Perc, 85, 75);}
                if($grading->grading_name == 'B'){$grade_B_per = $this->assessment_report_model->getCountOf_GreaterOnly_2d_Between($OverAll_Perc, 75, 65);}
                if($grading->grading_name == 'C'){$grade_C_per = $this->assessment_report_model->getCountOf_GreaterOnly_2d_Between($OverAll_Perc, 65, 55);}
                if($grading->grading_name == 'D'){$grade_D_per = $this->assessment_report_model->getCountOf_GreaterOnly_2d_Between($OverAll_Perc, 55, 50);}
                if($grading->grading_name == 'U'){$grade_U_per = $this->assessment_report_model->getCountOf_LessOnly_2d($OverAll_Perc, $grading->weightage);}
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
                        if($grading->grading_name == 'B'){$grade_B_per = $grading->weightage;}
                        if($grading->grading_name == 'C'){$grade_C_per = $grading->weightage;}
                        if($grading->grading_name == 'D'){$grade_D_per = $grading->weightage;}
                        if($grading->grading_name == 'U'){$grade_U_per = $grading->weightage;}
                    }
                    if($thisText_Per >= $grade_Ap_per){
                        $thisText_Grade = 'A+';
                    }else if($thisText_Per >= $grade_A_per){
                        $thisText_Grade = 'A';
                    }else if($thisText_Per >= $grade_B_per){
                        $thisText_Grade = 'B';
                    }else if($thisText_Per >= $grade_C_per){
                        $thisText_Grade = 'C';
                    }else if($thisText_Per >= $grade_D_per){
                        $thisText_Grade = 'D';
                    }else {
                        $thisText_Grade = 'U';
                    }

                    $thisText_Rank = $this->assessment_report_model->getRankOf($studentTotalPercentage, $thisText_Per);


                    if($studentGrade_U[$student->gs_id] == 1000){
                        $thisText_Grade = 'U';

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
                        }else if($thisText_Grade=='B'){
                            $fontColor_r = $grade_B_r_FontColor;
                            $fontColor_g = $grade_B_g_FontColor;
                            $fontColor_b = $grade_B_b_FontColor;

                            $BG_fontColor_r = $BG_grade_B_r_FontColor;
                            $BG_fontColor_g = $BG_grade_B_g_FontColor;
                            $BG_fontColor_b = $BG_grade_B_b_FontColor;
                        }else if($thisText_Grade=='C'){
                            $fontColor_r = $grade_C_r_FontColor;
                            $fontColor_g = $grade_C_g_FontColor;
                            $fontColor_b = $grade_C_b_FontColor;

                            $BG_fontColor_r = $BG_grade_C_r_FontColor;
                            $BG_fontColor_g = $BG_grade_C_g_FontColor;
                            $BG_fontColor_b = $BG_grade_C_b_FontColor;
                        }else if($thisText_Grade=='D'){
                            $fontColor_r = $grade_D_r_FontColor;
                            $fontColor_g = $grade_D_g_FontColor;
                            $fontColor_b = $grade_D_b_FontColor;

                            $BG_fontColor_r = $BG_grade_D_r_FontColor;
                            $BG_fontColor_g = $BG_grade_D_g_FontColor;
                            $BG_fontColor_b = $BG_grade_D_b_FontColor;
                        }else if($thisText_Grade=='U'){
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
            
            foreach($data['assessment_overall_garde'] as $grading){
                if($grading->grading_name == 'A+'){$grade_Ap_per = $this->assessment_report_model->getCountOf_GreaterOnly_2d($OverAll_Perc, $grading->weightage);}
                if($grading->grading_name == 'A'){$grade_A_per = $this->assessment_report_model->getCountOf_GreaterOnly_2d_Between($OverAll_Perc, 85, 75);}
                if($grading->grading_name == 'B'){$grade_B_per = $this->assessment_report_model->getCountOf_GreaterOnly_2d_Between($OverAll_Perc, 75, 65);}
                if($grading->grading_name == 'C'){$grade_C_per = $this->assessment_report_model->getCountOf_GreaterOnly_2d_Between($OverAll_Perc, 65, 55);}
                if($grading->grading_name == 'D'){$grade_D_per = $this->assessment_report_model->getCountOf_GreaterOnly_2d_Between($OverAll_Perc, 55, 50);}
                if($grading->grading_name == 'U'){$grade_U_per = $this->assessment_report_model->getCountOf_LessOnly_2d($OverAll_Perc, $grading->weightage);}
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
            $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'APlus',1,0,'L',1);

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

     public function get_UnitAssessment_n_Review_Report_Split_pdf(){

        $gradeID = $this->input->post('grade');
        $sectionID = $this->input->post('section');
        $academic_id = $this->input->post('academic');
        $gradeName = $this->input->post('grade_name');
        $sectionName = $this->input->post('section_name');
        $term = $this->input->post('term');


        $html = '';



        $html .= '
        <style>
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



        $pdf_link = '/etab_reports/unit_report_ajax/generate_UnitAssessment_n_Review_report_split?gradeID=' . $gradeID .'&sectionID=' . $sectionID .'&gradeName=' . $gradeName .'&sectionName=' . $sectionName .'&term=' . $term;


        $html .= '

            <div class="powerwidget purple" id="datatable-filter-column" data-widget-editbutton="false" role="widget" style="">
              <header role="heading">
                <i class="fa fa-tasks"></i> Report : '.$gradeName.'-'.$sectionName.'
                <div class="powerwidget-ctrls" role="menu">
                  <h3>
                    <span class="glyphicon glyphicon-remove close_setup_4 pull-right cursor" style="top: -11px;"></span>
                  </h3>
                </div>
                <span class="powerwidget-loader"></span>
              </header>

              <div class="inner-spacer" role="content">
                <div id="staff_edit_table_wrapper" class="dataTables_wrapper form-inline" role="grid">';

                
        $html .=    '<div class="unit_report_pdf_iframe"> 
                        <iframe src="'.site_url().$pdf_link.'" frameBorder="0"> </iframe> 
                    </div>';

        $html .= '
              </div>
            </div>
        </div>';



        echo $html;
    }

    public function generate_UnitAssessment_n_Review_report_split(){


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
       
        /************************** Assessment Subjects/***********************************************/

        if($gradeID == 10 || $gradeID == 11){
            //$data['assessment_titles'] = $this->assessment_report_model->Complete_Assessment_Report_GS_Subjects_Science($gradeID, $sectionID);
            $data['assessment_titles'] = $this->assessment_report_model->Complete_Assessment_Report_GS_Subjects_Science_SessionTerm($gradeID, $sectionID, "");
        }else{
            //$data['assessment_titles'] = $this->assessment_report_model->Complete_Assessment_Report_GS_Subjects_Split($gradeID, $sectionID);            
            $data['assessment_titles'] = $this->assessment_report_model->Complete_Assessment_Report_GS_Subjects_Split_SessionTerm($gradeID, $sectionID, "");
        }

        $data['all_subjects'] = $this->assessment_report_model->Complete_Assessment_Report_GS_Subjects_Split($gradeID, $sectionID, "");
        



        /***************************** Assessment Marks
        /***********************************************/


        if($gradeID == 10 || $gradeID == 11){
            //$data['assessment_marks'] = $this->assessment_report_model->Complete_Assessment_Report_GS_lvl_3_Science($gradeID, $sectionID, $termID);
            $data['assessment_marks'] = $this->assessment_report_model->Complete_Assessment_Report_GS_lvl_3_Science_SessionTerm($gradeID, $sectionID, $termID, "");
        }else{
            //$data['assessment_marks'] = $this->assessment_report_model->Complete_Assessment_Report_GS_lvl_3($gradeID, $sectionID, $termID);            
            $data['assessment_marks'] = $this->assessment_report_model->Complete_Assessment_Report_GS_lvl_3_SessionTerm($gradeID, $sectionID, $termID, "");
        }


        /***************************** Assessment Grade
        /***********************************************/

        if($gradeID == 10 || $gradeID == 11){
            //$data['assessment_grade'] = $this->assessment_report_model->Complete_Assessment_Report_GS_lvl_4_Science($gradeID, $sectionID, $termID);
            $data['assessment_grade'] = $this->assessment_report_model->Complete_Assessment_Report_GS_lvl_4_Science_SessionTerm($gradeID, $sectionID, $termID, "");
        }else{
            //$data['assessment_grade'] = $this->assessment_report_model->Complete_Assessment_Report_GS_lvl_4($gradeID, $sectionID, $termID);
            $data['assessment_grade'] = $this->assessment_report_model->Complete_Assessment_Report_GS_lvl_4_SessionTerm($gradeID, $sectionID, $termID, "");
        }


        /******************************* Assessment ASP
        /***********************************************/
        //$data['assessment_asp'] = $this->assessment_report_model->Complete_Assessment_Report_GS_lvl_ASP($gradeID, $sectionID, $termID);

        $data['assessment_asp'] = $this->assessment_report_model->Complete_Assessment_Report_GS_lvl_ASP_SessionTerm($gradeID, $sectionID, $termID, "");
   
        /********************* Assessment Overall Grade
        /***********************************************/
        $data['assessment_overall_garde'] = $this->assessment_report_model->get_Grade_Overall_grading($gradeID);
        /*************************************************************************************************************************************/
        $no_of_subjects = sizeof($data['assessment_titles']);




        $PageNo = 0;

        $TermReportTitle = ' (Term-1 Report 2017-18)';


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
                    if($marks->gs_id == $student->gs_id
                       && $marks->subject_name_full == $title->subject_name){
                        if($marks->assessment_type_id == 1 && $marks->ass_per_mrk > 0){
                            $marksObtained_ft = $marks->ass_per_mrk;
                            //var_dump($marksObtained_ft);
                            $Total+=$marksObtained_ft;
                            $studentMarks[$title->subject_name]['ft'][$student->gs_id] = $marksObtained_ft;
                            $studentMarks[$title->subject_name]['ftgd'][$student->gs_id] = $marks->grade;
                            $studentMarks[$student->gs_id]['subjects'][$i] = $title->subject_name;
                            $studentMarks[$student->gs_id]['ftmarks'] += $marksObtained_ft;
                            //$studentTotalMarks[$student->gs_id] += $marksObtained_ft;
                        }else if($marks->assessment_type_id == 2 && $marks->ass_per_mrk > 0){
                            $marksObtained_st = $marks->ass_per_mrk;
                            $Total+=$marksObtained_st;
                            //var_dump($marksObtained_st);
                            $studentMarks[$title->subject_name]['st'][$student->gs_id] = $marksObtained_st;
                            $studentMarks[$title->subject_name]['stgd'][$student->gs_id] = $marks->grade;
                            $studentMarks[$student->gs_id]['subjects'][$i] = $title->subjectname;
                            $studentMarks[$student->gs_id]['stmarks'] += $marksObtained_st;
                            //$studentTotalMarks[$student->gs_id] += $marksObtained_st;
                        }  
                    }
                }
                

                foreach ($data['assessment_grade'] as $grade) {
                    if($grade->gs_id == $student->gs_id
                       && $grade->subject_name_full == $title->subject_name){
                        $studentMarks[$title->subject_name]['gd'][$student->gs_id] = $grade->grade;
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
                    $studentTotalPercentage[$student->gs_id] = ROUND($studentTotalMarks[$student->gs_id] / sizeof($studentMarks[$student->gs_id]['subjects']), 1);
                }
            }
        }



        foreach ($data['assessment_titles'] as $title) {
            if(!empty($studentMarks[$title->subject_name]['ft']) && !empty($studentMarks[$title->subject_name]['st'])){
                $studentMarks[$title->subject_name]['avg'] = ROUND((array_sum($studentMarks[$title->subject_name]['ft']) + array_sum($studentMarks[$title->subject_name]['st']))/2, 0);
                $studentMarks[$title->subject_name]['avg'] = ROUND($studentMarks[$title->subject_name]['avg'] / count($studentMarks[$title->subject_name]['ft']), 0);
            }

            foreach ($data['students_gs_data'] as $student) {
                if(!empty($studentMarks[$title->subject_name]['ft'][$student->gs_id])){
                    if(!empty($studentMarks[$title->subject_name]['st'][$student->gs_id])){
                        $studentMarks[$title->subject_name]['std_total'][$student->gs_id] = 
                        ROUND(($studentMarks[$title->subject_name]['ft'][$student->gs_id] + $studentMarks[$title->subject_name]['st'][$student->gs_id])/2,0);
                    }else{
                        $studentMarks[$title->subject_name]['std_total'][$student->gs_id] = ROUND($studentMarks[$title->subject_name]['ft'][$student->gs_id]/2,0);
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

        $PageNo++;
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY($pdf->w-30,$pdf->h-15);
        $pdf->Cell(20, 4, 'Page ' . $PageNo . ' / ' . ceil(($no_of_subjects+2.5)/7), 0, 0, 'L');


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
        $pdf->Cell($header_width, $used_height_y, $class . $TermReportTitle ,0,0,'C');

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
            $pdf->Cell($table_header_sub_width, $table_header_sub_height, $title->subject_name,1,0,'C');

            $subjectTeacher = array();
            $sbt_counter = 0;
            foreach ($data['all_subjects'] as $sbt) {
                if($sbt->subjects == $title->subjects){
                    $subjectTeacher[$sbt_counter] = $sbt->subject_teacher;
                    $sbt_counter++;
                }
            }
            $sbt_counter = 0;
            $subjectTeacher = array_unique($subjectTeacher);
            foreach ($subjectTeacher as $SBT_Name) {
                $pdf->SetXY($startWith_X,$pdf->h-30+($sbt_counter*4));
                $pdf->Cell($table_header_sub_width, $table_header_sub_height, $SBT_Name, 0, 0, 'L');
                $sbt_counter++;                
            }

            $startWith_X += $table_header_sub_width;

            if($i == 7){break;}
            $i++;
        }
        $i=1;
        $startWith_X = $dataFlowX;
        $startWith_Y += $table_header_sub_height;
        foreach ($data['assessment_titles'] as $title) {
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
                       && $marks->subject_name_full == $title->subject_name){
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
                       && $grade->subject_name_full == $title->subject_name){
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
                        }else if($grade->grade=='B'){
                            $fontColor_r = $grade_B_r_FontColor;
                            $fontColor_g = $grade_B_g_FontColor;
                            $fontColor_b = $grade_B_b_FontColor;

                            $BG_fontColor_r = $BG_grade_B_r_FontColor;
                            $BG_fontColor_g = $BG_grade_B_g_FontColor;
                            $BG_fontColor_b = $BG_grade_B_b_FontColor;
                        }else if($grade->grade=='C'){
                            $fontColor_r = $grade_C_r_FontColor;
                            $fontColor_g = $grade_C_g_FontColor;
                            $fontColor_b = $grade_C_b_FontColor;

                            $BG_fontColor_r = $BG_grade_C_r_FontColor;
                            $BG_fontColor_g = $BG_grade_C_g_FontColor;
                            $BG_fontColor_b = $BG_grade_C_b_FontColor;
                        }else if($grade->grade=='D'){
                            $fontColor_r = $grade_D_r_FontColor;
                            $fontColor_g = $grade_D_g_FontColor;
                            $fontColor_b = $grade_D_b_FontColor;

                            $BG_fontColor_r = $BG_grade_D_r_FontColor;
                            $BG_fontColor_g = $BG_grade_D_g_FontColor;
                            $BG_fontColor_b = $BG_grade_D_b_FontColor;
                        }else if($grade->grade=='U'){
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
                $pdf->Cell($table_header_sub_info_width, $text_column_height, $formativeMarks,1,0,'C',1);

                $startWith_X += $table_header_sub_info_width;
                $pdf->SetXY($startWith_X,$startWith_Y);
                $pdf->Cell($table_header_sub_info_width, $text_column_height, $summativeMarks,1,0,'C',1);

                $startWith_X += $table_header_sub_info_width;
                $pdf->SetXY($startWith_X,$startWith_Y);
                $pdf->Cell($table_header_sub_info_width, $text_column_height, $finalMarks,1,0,'C',1);

                $startWith_X += $table_header_sub_info_width;
                $pdf->SetXY($startWith_X,$startWith_Y);
                $pdf->Cell($table_header_sub_info_width, $text_column_height, $finalGrade,1,0,'C',1);

                $startWith_X += $table_header_sub_info_width;                

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
        $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'APlus',1,0,'L',1);

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
            if(!empty($studentMarks[$title->subject_name]['ft'])){
                $formativeTotal = ROUND(array_sum($studentMarks[$title->subject_name]['ft']) / count($studentMarks[$title->subject_name]['ft']), 0);
            }
            $thisText = $formativeTotal;
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
            /************************************** Above Average
            ******************************************************/
            $thisText = '';
            $startWith_Y += $text_column_height;
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subject_name]['ft'])){
                $formativeTotalAverage = $this->assessment_report_model->getCountOf_GreaterOnly_2d($studentMarks[$title->subject_name]['ft'], $formativeTotal);   
            }
            $thisText = $formativeTotalAverage;
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
            /************************************** Below Average
            ******************************************************/
            $thisText = '';
            $startWith_Y += $text_column_height;
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subject_name]['ft'])){
                $formativeTotalAverageB = $this->assessment_report_model->getCountOf_LessOnly_2d($studentMarks[$title->subject_name]['ft'], $formativeTotal);
            }
            $thisText = $formativeTotalAverageB;
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');

            /************************** APlus * A * B * C * D * U
            ******************************************************/
            $startWith_Y += $text_column_height + 4;
            $thisText = '';
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subject_name]['ftgd'])){
                $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['ftgd'], 'A+');
            }
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


            $startWith_Y += $text_column_height;
            $thisText = '';
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subject_name]['ftgd'])){
                $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['ftgd'], 'A');
            }
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


            $startWith_Y += $text_column_height;
            $thisText = '';
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subject_name]['ftgd'])){
                $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['ftgd'], 'B');
            }
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


            $startWith_Y += $text_column_height;
            $thisText = '';
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subject_name]['ftgd'])){
                $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['ftgd'], 'C');
            }
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


            $startWith_Y += $text_column_height;
            $thisText = '';
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subject_name]['ftgd'])){
                $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['ftgd'], 'D');
            }
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


            $startWith_Y += $text_column_height;
            $thisText = '';
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subject_name]['ftgd'])){
                $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['ftgd'], 'U');
            }
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');












            /************************************** Class Average
            ******************************************************/
            $thisText = '';
            $startWith_Y = $dataFlowY;
            $startWith_X += $table_header_sub_info_width;
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subject_name]['st'])){
                $summativeTotal = ROUND(array_sum($studentMarks[$title->subject_name]['st']) / count($studentMarks[$title->subject_name]['st']), 0);    
                $thisText = $summativeTotal;
            }            
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
            /************************************** Above Average
            ******************************************************/
            $thisText = '';
            $startWith_Y += $text_column_height;
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subject_name]['st'])){
                $summativeTotalAverage = $this->assessment_report_model->getCountOf_GreaterOnly_2d($studentMarks[$title->subject_name]['st'], $summativeTotal);
                $thisText = $summativeTotalAverage;
            }
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
            /************************************** Below Average
            ******************************************************/
            $thisText = '';
            $startWith_Y += $text_column_height;
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subject_name]['st'])){
                $summativeTotalAverageB = $this->assessment_report_model->getCountOf_LessOnly_2d($studentMarks[$title->subject_name]['st'], $summativeTotal);
                $thisText = $summativeTotalAverageB;
            }
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');

            /************************** APlus * A * B * C * D * U
            ******************************************************/
            $startWith_Y += $text_column_height + 4;
            $thisText = '';
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subject_name]['stgd'])){
                $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['stgd'], 'A+');
            }
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
            



            $startWith_Y += $text_column_height;
            $thisText = '';
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subject_name]['stgd'])){
                $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['stgd'], 'A');
            }
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
            


            $startWith_Y += $text_column_height;
            $thisText = '';
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subject_name]['stgd'])){
                $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['stgd'], 'B');
            }
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
            


            $startWith_Y += $text_column_height;
            $thisText = '';
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subject_name]['stgd'])){
                $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['stgd'], 'C');
            }
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
            



            $startWith_Y += $text_column_height;
            $thisText = '';
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subject_name]['stgd'])){
                $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['stgd'], 'D');
            }
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
            



            $startWith_Y += $text_column_height;
            $thisText = '';
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subject_name]['stgd'])){
                $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['stgd'], 'U');
            }
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
            












            /************************************** Class Average
            ******************************************************/
            $thisText = '';
            $startWith_Y = $dataFlowY;
            $startWith_X += $table_header_sub_info_width;
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subject_name]['st'])){
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
            if(!empty($studentMarks[$title->subject_name]['st'])){
                if(!empty($studentMarks[$title->subject_name]['std_total'])){
                    $thisText = $this->assessment_report_model->getCountOf_GreaterOnly_2d($studentMarks[$title->subject_name]['std_total'], $studentMarks[$title->subject_name]['avg']);
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
            if(!empty($studentMarks[$title->subject_name]['st'])){
                if(!empty($studentMarks[$title->subject_name]['std_total'])){
                    $thisText = $this->assessment_report_model->getCountOf_LessOnly_2d($studentMarks[$title->subject_name]['std_total'], $studentMarks[$title->subject_name]['avg']);
                }else{
                    $thisText = '';
                }
            }else{
                $thisText = $formativeTotalAverageB;
            }
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');



            /************************** APlus * A * B * C * D * U
            ******************************************************/
            $totalSubjects_gd = 0;
            if(!empty($studentMarks[$title->subjectname]['gd'])){$totalSubjects_gd = count($studentMarks[$title->subjectname]['gd']);}
            $startWith_Y += $text_column_height + 4;
            $thisText = '';
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subject_name]['gd'])){
                $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['gd'], 'A+');
            }
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
            /******************************** Percentage - Grade - Ap *****/
            $pdf->SetXY($startWith_X+$table_header_sub_info_width,$startWith_Y);
            if($totalSubjects_gd==0){
                $pdf->Cell($table_header_sub_info_width, $text_column_height, '',0,0,'C');    
            }else{
                $pdf->Cell($table_header_sub_info_width, $text_column_height, ROUND($thisText/$totalSubjects_gd*100, 0).'%',0,0,'C');                
            }


            $startWith_Y += $text_column_height;
            $thisText = '';
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subject_name]['gd'])){
                $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['gd'], 'A');
            }
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
            /******************************** Percentage - Grade - A *****/
            $pdf->SetXY($startWith_X+$table_header_sub_info_width,$startWith_Y);
            if($totalSubjects_gd==0){
                $pdf->Cell($table_header_sub_info_width, $text_column_height, '',0,0,'C');    
            }else{
                $pdf->Cell($table_header_sub_info_width, $text_column_height, ROUND($thisText/$totalSubjects_gd*100, 0).'%',0,0,'C');                
            }


            $startWith_Y += $text_column_height;
            $thisText = '';
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subject_name]['gd'])){
                $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['gd'], 'B');
            }
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
            /******************************** Percentage - Grade - B *****/
            $pdf->SetXY($startWith_X+$table_header_sub_info_width,$startWith_Y);
            if($totalSubjects_gd==0){
                $pdf->Cell($table_header_sub_info_width, $text_column_height, '',0,0,'C');    
            }else{
                $pdf->Cell($table_header_sub_info_width, $text_column_height, ROUND($thisText/$totalSubjects_gd*100, 0).'%',0,0,'C');                
            }




            $startWith_Y += $text_column_height;
            $thisText = '';
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subject_name]['gd'])){
                $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['gd'], 'C');
            }
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
            /******************************** Percentage - Grade - C *****/
            $pdf->SetXY($startWith_X+$table_header_sub_info_width,$startWith_Y);
            if($totalSubjects_gd==0){
                $pdf->Cell($table_header_sub_info_width, $text_column_height, '',0,0,'C');    
            }else{
                $pdf->Cell($table_header_sub_info_width, $text_column_height, ROUND($thisText/$totalSubjects_gd*100, 0).'%',0,0,'C');                
            }




            $startWith_Y += $text_column_height;
            $thisText = '';
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subject_name]['gd'])){
                $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['gd'], 'D');
            }
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
            /******************************** Percentage - Grade - D *****/
            $pdf->SetXY($startWith_X+$table_header_sub_info_width,$startWith_Y);
            if($totalSubjects_gd==0){
                $pdf->Cell($table_header_sub_info_width, $text_column_height, '',0,0,'C');    
            }else{
                $pdf->Cell($table_header_sub_info_width, $text_column_height, ROUND($thisText/$totalSubjects_gd*100, 0).'%',0,0,'C');                
            }




            $startWith_Y += $text_column_height;
            $thisText = '';
            $pdf->SetXY($startWith_X,$startWith_Y);
            if(!empty($studentMarks[$title->subject_name]['gd'])){
                $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['gd'], 'U');
            }
            $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
            /******************************** Percentage - Grade - U *****/
            $pdf->SetXY($startWith_X+$table_header_sub_info_width,$startWith_Y);
            if($totalSubjects_gd==0){
                $pdf->Cell($table_header_sub_info_width, $text_column_height, '',0,0,'C');    
            }else{
                $pdf->Cell($table_header_sub_info_width, $text_column_height, ROUND($thisText/$totalSubjects_gd*100, 0).'%',0,0,'C');                
            }












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

            $PageNo++;
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetXY($pdf->w-30,$pdf->h-15);
            $pdf->Cell(20, 4, 'Page '.$PageNo.' / ' . ceil(($no_of_subjects+2.5)/7), 0, 0, 'L');



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
                    $pdf->Cell($table_header_sub_width, $table_header_sub_height, $title->subject_name,1,0,'C');

                    unset($subjectTeacher);
                    $subjectTeacher = array();
                    $sbt_counter = 0;
                    foreach ($data['all_subjects'] as $sbt) {
                        if($sbt->subjects == $title->subjects){
                            $subjectTeacher[$sbt_counter] = $sbt->subject_teacher;
                            $sbt_counter++;
                        }
                    }
                    $sbt_counter = 0;
                    $subjectTeacher = array_unique($subjectTeacher);
                    foreach ($subjectTeacher as $SBT_Name) {
                        $pdf->SetXY($startWith_X,$pdf->h-30+($sbt_counter*4));
                        $pdf->Cell($table_header_sub_width, $table_header_sub_height, $SBT_Name, 0, 0, 'L');
                        $sbt_counter++;                
                    }

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
                               && $marks->subject_name_full == $title->subject_name){
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
                               && $grade->subject_name_full == $title->subject_name){
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
                                }else if($grade->grade=='B'){
                                    $fontColor_r = $grade_B_r_FontColor;
                                    $fontColor_g = $grade_B_g_FontColor;
                                    $fontColor_b = $grade_B_b_FontColor;

                                    $BG_fontColor_r = $BG_grade_B_r_FontColor;
                                    $BG_fontColor_g = $BG_grade_B_g_FontColor;
                                    $BG_fontColor_b = $BG_grade_B_b_FontColor;
                                }else if($grade->grade=='C'){
                                    $fontColor_r = $grade_C_r_FontColor;
                                    $fontColor_g = $grade_C_g_FontColor;
                                    $fontColor_b = $grade_C_b_FontColor;

                                    $BG_fontColor_r = $BG_grade_C_r_FontColor;
                                    $BG_fontColor_g = $BG_grade_C_g_FontColor;
                                    $BG_fontColor_b = $BG_grade_C_b_FontColor;
                                }else if($grade->grade=='D'){
                                    $fontColor_r = $grade_D_r_FontColor;
                                    $fontColor_g = $grade_D_g_FontColor;
                                    $fontColor_b = $grade_D_b_FontColor;

                                    $BG_fontColor_r = $BG_grade_D_r_FontColor;
                                    $BG_fontColor_g = $BG_grade_D_g_FontColor;
                                    $BG_fontColor_b = $BG_grade_D_b_FontColor;
                                }else if($grade->grade=='U'){
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
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, $formativeMarks,1,0,'C',1);

                        $startWith_X += $table_header_sub_info_width;
                        $pdf->SetXY($startWith_X,$startWith_Y);
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, $summativeMarks,1,0,'C',1);

                        $startWith_X += $table_header_sub_info_width;
                        $pdf->SetXY($startWith_X,$startWith_Y);
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, $finalMarks,1,0,'C',1);

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
            $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'APlus',1,0,'L',1);

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
                    if(!empty($studentMarks[$title->subject_name]['ft'])){
                        $formativeTotal = ROUND(array_sum($studentMarks[$title->subject_name]['ft']) / count($studentMarks[$title->subject_name]['ft']), 0);
                    }
                    $thisText = $formativeTotal;
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
                    /************************************** Above Average
                    ******************************************************/
                    $thisText = '';
                    $startWith_Y += $text_column_height;
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['ft'])){
                        $formativeTotalAverage = $this->assessment_report_model->getCountOf_GreaterOnly_2d($studentMarks[$title->subject_name]['ft'], $formativeTotal);           
                    }
                    $thisText = $formativeTotalAverage;
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
                    /************************************** Below Average
                    ******************************************************/
                    $thisText = '';
                    $startWith_Y += $text_column_height;
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['ft'])){
                        $formativeTotalAverageB = $this->assessment_report_model->getCountOf_LessOnly_2d($studentMarks[$title->subject_name]['ft'], $formativeTotal);
                    }
                    $thisText = $formativeTotalAverageB;
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');

                    /************************** APlus * A * B * C * D * U
                    ******************************************************/
                    $startWith_Y += $text_column_height + 4;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['ftgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['ftgd'], 'A+');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['ftgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['ftgd'], 'A');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['ftgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['ftgd'], 'B');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['ftgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['ftgd'], 'C');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['ftgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['ftgd'], 'D');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['ftgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['ftgd'], 'U');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');












                    /************************************** Class Average
                    ******************************************************/
                    $thisText = '';
                    $startWith_Y = $dataFlowY;
                    $startWith_X += $table_header_sub_info_width;
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['st'])){
                        $summativeTotal = ROUND(array_sum($studentMarks[$title->subject_name]['st']) / count($studentMarks[$title->subject_name]['ft']), 0);    
                        $thisText = $summativeTotal;
                    }            
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
                    /************************************** Above Average
                    ******************************************************/
                    $thisText = '';
                    $startWith_Y += $text_column_height;
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['st'])){
                        $summativeTotalAverage = $this->assessment_report_model->getCountOf_GreaterOnly_2d($studentMarks[$title->subject_name]['st'], $summativeTotal);
                        $thisText = $summativeTotalAverage;
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
                    /************************************** Below Average
                    ******************************************************/
                    $thisText = '';
                    $startWith_Y += $text_column_height;
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['st'])){
                        $summativeTotalAverageB = $this->assessment_report_model->getCountOf_LessOnly_2d($studentMarks[$title->subject_name]['st'], $summativeTotal);
                        $thisText = $summativeTotalAverageB;
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');

                    /************************** APlus * A * B * C * D * U
                    ******************************************************/
                    $startWith_Y += $text_column_height + 4;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['stgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['stgd'], 'A+');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['stgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['stgd'], 'A');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['stgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['stgd'], 'B');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['stgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['stgd'], 'C');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['stgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['stgd'], 'D');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['stgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['stgd'], 'U');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');












                    /************************************** Class Average
                    ******************************************************/
                    $thisText = '';
                    $startWith_Y = $dataFlowY;
                    $startWith_X += $table_header_sub_info_width;
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['st'])){
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
                    if(!empty($studentMarks[$title->subject_name]['st'])){
                        if(!empty($studentMarks[$title->subject_name]['std_total'])){
                            $thisText = $this->assessment_report_model->getCountOf_GreaterOnly_2d($studentMarks[$title->subject_name]['std_total'], $studentMarks[$title->subject_name]['avg']);
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
                    if(!empty($studentMarks[$title->subject_name]['st'])){
                        if(!empty($studentMarks[$title->subject_name]['std_total'])){
                            $thisText = $this->assessment_report_model->getCountOf_LessOnly_2d($studentMarks[$title->subject_name]['std_total'], $studentMarks[$title->subject_name]['avg']);
                        }else{
                            $thisText = '';
                        }
                    }else{
                        $thisText = $formativeTotalAverageB;
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');



                    /************************** APlus * A * B * C * D * U
                    ******************************************************/
                    $totalSubjects_gd = 0;
                    if(!empty($studentMarks[$title->subject_name]['gd'])){$totalSubjects_gd = count($studentMarks[$title->subject_name]['gd']);}
                    $startWith_Y += $text_column_height + 4;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['gd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['gd'], 'A+');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
                    /******************************** Percentage - Grade - Ap *****/
                    $pdf->SetXY($startWith_X+$table_header_sub_info_width,$startWith_Y);
                    if($totalSubjects_gd==0){
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, '',0,0,'C');    
                    }else{
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, ROUND($thisText/$totalSubjects_gd*100, 0).'%',0,0,'C');                
                    }




                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['gd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['gd'], 'A');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
                    /******************************** Percentage - Grade - A *****/
                    $pdf->SetXY($startWith_X+$table_header_sub_info_width,$startWith_Y);
                    if($totalSubjects_gd==0){
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, '',0,0,'C');    
                    }else{
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, ROUND($thisText/$totalSubjects_gd*100, 0).'%',0,0,'C');                
                    }




                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['gd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['gd'], 'B');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
                    /******************************** Percentage - Grade - B *****/
                    $pdf->SetXY($startWith_X+$table_header_sub_info_width,$startWith_Y);
                    if($totalSubjects_gd==0){
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, '',0,0,'C');    
                    }else{
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, ROUND($thisText/$totalSubjects_gd*100, 0).'%',0,0,'C');                
                    }




                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['gd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['gd'], 'C');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
                    /******************************** Percentage - Grade - C *****/
                    $pdf->SetXY($startWith_X+$table_header_sub_info_width,$startWith_Y);
                    if($totalSubjects_gd==0){
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, '',0,0,'C');    
                    }else{
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, ROUND($thisText/$totalSubjects_gd*100, 0).'%',0,0,'C');                
                    }




                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['gd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['gd'], 'D');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
                    /******************************** Percentage - Grade - D *****/
                    $pdf->SetXY($startWith_X+$table_header_sub_info_width,$startWith_Y);
                    if($totalSubjects_gd==0){
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, '',0,0,'C');    
                    }else{
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, ROUND($thisText/$totalSubjects_gd*100, 0).'%',0,0,'C');                
                    }




                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['gd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['gd'], 'U');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
                    /******************************** Percentage - Grade - U *****/
                    $pdf->SetXY($startWith_X+$table_header_sub_info_width,$startWith_Y);
                    if($totalSubjects_gd==0){
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, '',0,0,'C');    
                    }else{
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, ROUND($thisText/$totalSubjects_gd*100, 0).'%',0,0,'C');                
                    }











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

            $PageNo++;
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetXY($pdf->w-30,$pdf->h-15);
            $pdf->Cell(20, 4, 'Page '.$PageNo.' / ' . ceil(($no_of_subjects+2.5)/7), 0, 0, 'L');

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
                    $pdf->Cell($table_header_sub_width, $table_header_sub_height, $title->subject_name,1,0,'C');

                    unset($subjectTeacher);
                    $subjectTeacher = array();
                    $sbt_counter = 0;
                    foreach ($data['all_subjects'] as $sbt) {
                        if($sbt->subjects == $title->subjects){
                            $subjectTeacher[$sbt_counter] = $sbt->subject_teacher;
                            $sbt_counter++;
                        }
                    }
                    $sbt_counter = 0;
                    $subjectTeacher = array_unique($subjectTeacher);
                    foreach ($subjectTeacher as $SBT_Name) {
                        $pdf->SetXY($startWith_X,$pdf->h-30+($sbt_counter*4));
                        $pdf->Cell($table_header_sub_width, $table_header_sub_height, $SBT_Name, 0, 0, 'L');
                        $sbt_counter++;                
                    }

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
                               && $marks->subject_name_full == $title->subject_name){
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
                               && $grade->subject_name_full == $title->subject_name){
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
                                }else if($grade->grade=='B'){
                                    $fontColor_r = $grade_B_r_FontColor;
                                    $fontColor_g = $grade_B_g_FontColor;
                                    $fontColor_b = $grade_B_b_FontColor;

                                    $BG_fontColor_r = $BG_grade_B_r_FontColor;
                                    $BG_fontColor_g = $BG_grade_B_g_FontColor;
                                    $BG_fontColor_b = $BG_grade_B_b_FontColor;
                                }else if($grade->grade=='C'){
                                    $fontColor_r = $grade_C_r_FontColor;
                                    $fontColor_g = $grade_C_g_FontColor;
                                    $fontColor_b = $grade_C_b_FontColor;

                                    $BG_fontColor_r = $BG_grade_C_r_FontColor;
                                    $BG_fontColor_g = $BG_grade_C_g_FontColor;
                                    $BG_fontColor_b = $BG_grade_C_b_FontColor;
                                }else if($grade->grade=='D'){
                                    $fontColor_r = $grade_D_r_FontColor;
                                    $fontColor_g = $grade_D_g_FontColor;
                                    $fontColor_b = $grade_D_b_FontColor;

                                    $BG_fontColor_r = $BG_grade_D_r_FontColor;
                                    $BG_fontColor_g = $BG_grade_D_g_FontColor;
                                    $BG_fontColor_b = $BG_grade_D_b_FontColor;
                                }else if($grade->grade=='U'){
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
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, $formativeMarks,1,0,'C',1);

                        $startWith_X += $table_header_sub_info_width;
                        $pdf->SetXY($startWith_X,$startWith_Y);
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, $summativeMarks,1,0,'C',1);

                        $startWith_X += $table_header_sub_info_width;
                        $pdf->SetXY($startWith_X,$startWith_Y);
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, $finalMarks,1,0,'C',1);

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
            $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'APlus',1,0,'L',1);

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
                    if(!empty($studentMarks[$title->subject_name]['ft'])){
                        $formativeTotal = ROUND(array_sum($studentMarks[$title->subject_name]['ft']) / count($studentMarks[$title->subject_name]['ft']), 0);
                    }
                    $thisText = $formativeTotal;
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
                    /************************************** Above Average
                    ******************************************************/
                    $thisText = '';
                    $startWith_Y += $text_column_height;
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['ft'])){
                        $formativeTotalAverage = $this->assessment_report_model->getCountOf_GreaterOnly_2d($studentMarks[$title->subject_name]['ft'], $formativeTotal);           
                    }
                    $thisText = $formativeTotalAverage;
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
                    /************************************** Below Average
                    ******************************************************/
                    $thisText = '';
                    $startWith_Y += $text_column_height;
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['ft'])){
                        $formativeTotalAverageB = $this->assessment_report_model->getCountOf_LessOnly_2d($studentMarks[$title->subject_name]['ft'], $formativeTotal);
                    }
                    $thisText = $formativeTotalAverageB;
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');

                    /************************** APlus * A * B * C * D * U
                    ******************************************************/
                    $startWith_Y += $text_column_height + 4;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['ftgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['ftgd'], 'A+');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['ftgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['ftgd'], 'A');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['ftgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['ftgd'], 'B');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['ftgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['ftgd'], 'C');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['ftgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['ftgd'], 'D');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['ftgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['ftgd'], 'U');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');












                    /************************************** Class Average
                    ******************************************************/
                    $thisText = '';
                    $startWith_Y = $dataFlowY;
                    $startWith_X += $table_header_sub_info_width;
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['st'])){
                        $summativeTotal = ROUND(array_sum($studentMarks[$title->subject_name]['st']) / count($studentMarks[$title->subject_name]['ft']), 0);    
                        $thisText = $summativeTotal;
                    }            
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
                    /************************************** Above Average
                    ******************************************************/
                    $thisText = '';
                    $startWith_Y += $text_column_height;
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['st'])){
                        $summativeTotalAverage = $this->assessment_report_model->getCountOf_GreaterOnly_2d($studentMarks[$title->subject_name]['st'], $summativeTotal);
                        $thisText = $summativeTotalAverage;
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
                    /************************************** Below Average
                    ******************************************************/
                    $thisText = '';
                    $startWith_Y += $text_column_height;
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['st'])){
                        $summativeTotalAverageB = $this->assessment_report_model->getCountOf_LessOnly_2d($studentMarks[$title->subject_name]['st'], $summativeTotal);
                        $thisText = $summativeTotalAverageB;
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');

                    /************************** APlus * A * B * C * D * U
                    ******************************************************/
                    $startWith_Y += $text_column_height + 4;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['stgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['stgd'], 'A+');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['stgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['stgd'], 'A');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['stgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['stgd'], 'B');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['stgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['stgd'], 'C');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['stgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['stgd'], 'D');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['stgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['stgd'], 'U');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');












                    /************************************** Class Average
                    ******************************************************/
                    $thisText = '';
                    $startWith_Y = $dataFlowY;
                    $startWith_X += $table_header_sub_info_width;
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['st'])){
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
                    if(!empty($studentMarks[$title->subject_name]['st'])){
                        if(!empty($studentMarks[$title->subject_name]['std_total'])){
                            $thisText = $this->assessment_report_model->getCountOf_GreaterOnly_2d($studentMarks[$title->subject_name]['std_total'], $studentMarks[$title->subject_name]['avg']);
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
                    if(!empty($studentMarks[$title->subject_name]['st'])){
                        if(!empty($studentMarks[$title->subject_name]['std_total'])){
                            $thisText = $this->assessment_report_model->getCountOf_LessOnly_2d($studentMarks[$title->subject_name]['std_total'], $studentMarks[$title->subject_name]['avg']);
                        }else{
                            $thisText = '';
                        }
                    }else{
                        $thisText = $formativeTotalAverageB;
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');



                    /************************** APlus * A * B * C * D * U
                    ******************************************************/
                    $totalSubjects_gd = 0;
                    if(!empty($studentMarks[$title->subject_name]['gd'])){$totalSubjects_gd = count($studentMarks[$title->subject_name]['gd']);}
                    $startWith_Y += $text_column_height + 4;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['gd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['gd'], 'A+');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
                    /******************************** Percentage - Grade - Ap *****/
                    $pdf->SetXY($startWith_X+$table_header_sub_info_width,$startWith_Y);
                    if($totalSubjects_gd==0){
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, '',0,0,'C');    
                    }else{
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, ROUND($thisText/$totalSubjects_gd*100, 0).'%',0,0,'C');                
                    }




                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['gd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['gd'], 'A');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
                    /******************************** Percentage - Grade - A *****/
                    $pdf->SetXY($startWith_X+$table_header_sub_info_width,$startWith_Y);
                    if($totalSubjects_gd==0){
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, '',0,0,'C');    
                    }else{
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, ROUND($thisText/$totalSubjects_gd*100, 0).'%',0,0,'C');                
                    }




                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['gd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['gd'], 'B');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
                    /******************************** Percentage - Grade - B *****/
                    $pdf->SetXY($startWith_X+$table_header_sub_info_width,$startWith_Y);
                    if($totalSubjects_gd==0){
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, '',0,0,'C');    
                    }else{
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, ROUND($thisText/$totalSubjects_gd*100, 0).'%',0,0,'C');                
                    }




                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['gd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['gd'], 'C');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
                    /******************************** Percentage - Grade - C *****/
                    $pdf->SetXY($startWith_X+$table_header_sub_info_width,$startWith_Y);
                    if($totalSubjects_gd==0){
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, '',0,0,'C');    
                    }else{
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, ROUND($thisText/$totalSubjects_gd*100, 0).'%',0,0,'C');                
                    }




                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['gd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['gd'], 'D');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
                    /******************************** Percentage - Grade - D *****/
                    $pdf->SetXY($startWith_X+$table_header_sub_info_width,$startWith_Y);
                    if($totalSubjects_gd==0){
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, '',0,0,'C');    
                    }else{
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, ROUND($thisText/$totalSubjects_gd*100, 0).'%',0,0,'C');                
                    }




                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['gd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['gd'], 'U');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
                    /******************************** Percentage - Grade - U *****/
                    $pdf->SetXY($startWith_X+$table_header_sub_info_width,$startWith_Y);
                    if($totalSubjects_gd==0){
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, '',0,0,'C');    
                    }else{
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, ROUND($thisText/$totalSubjects_gd*100, 0).'%',0,0,'C');                
                    }










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













































        if($no_of_subjects > 21){
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

            $PageNo++;
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetXY($pdf->w-30,$pdf->h-15);
            $pdf->Cell(20, 4, 'Page '.$PageNo.' / ' . ceil(($no_of_subjects+2.5)/7), 0, 0, 'L');

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
                if($i>21){
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    $pdf->Cell($table_header_sub_width, $table_header_sub_height, $title->subject_name,1,0,'C');

                    unset($subjectTeacher);
                    $subjectTeacher = array();
                    $sbt_counter = 0;
                    foreach ($data['all_subjects'] as $sbt) {
                        if($sbt->subjects == $title->subjects){
                            $subjectTeacher[$sbt_counter] = $sbt->subject_teacher;
                            $sbt_counter++;
                        }
                    }
                    $sbt_counter = 0;
                    $subjectTeacher = array_unique($subjectTeacher);
                    foreach ($subjectTeacher as $SBT_Name) {
                        $pdf->SetXY($startWith_X,$pdf->h-30+($sbt_counter*4));
                        $pdf->Cell($table_header_sub_width, $table_header_sub_height, $SBT_Name, 0, 0, 'L');
                        $sbt_counter++;                
                    }

                    $startWith_X += $table_header_sub_width;
                }

                if($i == 28){break;}
                $i++;
            }
            $i=1;
            $startWith_X = $dataFlowX;
            $startWith_Y += $table_header_sub_height;
            foreach ($data['assessment_titles'] as $title) {
                if($i>21){
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
            
                if($i == 28){break;}
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
                    if($i>21){
                        $formativeMarks = '';
                        $summativeMarks = '';
                        foreach ($data['assessment_marks'] as $marks) {
                            if($marks->gs_id == $student->gs_id
                               && $marks->subject_name_full == $title->subject_name){
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
                               && $grade->subject_name_full == $title->subject_name){
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
                                }else if($grade->grade=='B'){
                                    $fontColor_r = $grade_B_r_FontColor;
                                    $fontColor_g = $grade_B_g_FontColor;
                                    $fontColor_b = $grade_B_b_FontColor;

                                    $BG_fontColor_r = $BG_grade_B_r_FontColor;
                                    $BG_fontColor_g = $BG_grade_B_g_FontColor;
                                    $BG_fontColor_b = $BG_grade_B_b_FontColor;
                                }else if($grade->grade=='C'){
                                    $fontColor_r = $grade_C_r_FontColor;
                                    $fontColor_g = $grade_C_g_FontColor;
                                    $fontColor_b = $grade_C_b_FontColor;

                                    $BG_fontColor_r = $BG_grade_C_r_FontColor;
                                    $BG_fontColor_g = $BG_grade_C_g_FontColor;
                                    $BG_fontColor_b = $BG_grade_C_b_FontColor;
                                }else if($grade->grade=='D'){
                                    $fontColor_r = $grade_D_r_FontColor;
                                    $fontColor_g = $grade_D_g_FontColor;
                                    $fontColor_b = $grade_D_b_FontColor;

                                    $BG_fontColor_r = $BG_grade_D_r_FontColor;
                                    $BG_fontColor_g = $BG_grade_D_g_FontColor;
                                    $BG_fontColor_b = $BG_grade_D_b_FontColor;
                                }else if($grade->grade=='U'){
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
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, $formativeMarks,1,0,'C',1);

                        $startWith_X += $table_header_sub_info_width;
                        $pdf->SetXY($startWith_X,$startWith_Y);
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, $summativeMarks,1,0,'C',1);

                        $startWith_X += $table_header_sub_info_width;
                        $pdf->SetXY($startWith_X,$startWith_Y);
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, $finalMarks,1,0,'C',1);

                        $startWith_X += $table_header_sub_info_width;
                        $pdf->SetXY($startWith_X,$startWith_Y);
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, $finalGrade,1,0,'C',1);

                        $startWith_X += $table_header_sub_info_width;                

                        if($i == 28){break;}
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
            $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'APlus',1,0,'L',1);

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
















            $i=1;
            $thisText = '';
            $startWith_Y = $dataFlowY;
            $dataFlowX = $startWith_X+$text_column_width_abname+$text_column_width_status;
            $startWith_X = $dataFlowX;
            foreach ($data['assessment_titles'] as $title) {
                if($i>21){
                    /************************************** Class Average
                    ******************************************************/
                    $startWith_Y = $dataFlowY;
                    $thisText = '';
                    $formativeTotal = ''; $summativeTotal = '';
                    $formativeTotalAverage = ''; $summativeTotalAverage = '';
                    $formativeTotalAverageB = ''; $summativeTotalAverageB = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['ft'])){
                        $formativeTotal = ROUND(array_sum($studentMarks[$title->subject_name]['ft']) / count($studentMarks[$title->subject_name]['ft']), 0);
                    }
                    $thisText = $formativeTotal;
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
                    /************************************** Above Average
                    ******************************************************/
                    $thisText = '';
                    $startWith_Y += $text_column_height;
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['ft'])){
                        $formativeTotalAverage = $this->assessment_report_model->getCountOf_GreaterOnly_2d($studentMarks[$title->subject_name]['ft'], $formativeTotal);           
                    }
                    $thisText = $formativeTotalAverage;
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
                    /************************************** Below Average
                    ******************************************************/
                    $thisText = '';
                    $startWith_Y += $text_column_height;
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['ft'])){
                        $formativeTotalAverageB = $this->assessment_report_model->getCountOf_LessOnly_2d($studentMarks[$title->subject_name]['ft'], $formativeTotal);
                    }
                    $thisText = $formativeTotalAverageB;
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');

                    /************************** APlus * A * B * C * D * U
                    ******************************************************/
                    $startWith_Y += $text_column_height + 4;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['ftgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['ftgd'], 'A+');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['ftgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['ftgd'], 'A');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['ftgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['ftgd'], 'B');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['ftgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['ftgd'], 'C');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['ftgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['ftgd'], 'D');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['ftgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['ftgd'], 'U');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');












                    /************************************** Class Average
                    ******************************************************/
                    $thisText = '';
                    $startWith_Y = $dataFlowY;
                    $startWith_X += $table_header_sub_info_width;
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['st'])){
                        $summativeTotal = ROUND(array_sum($studentMarks[$title->subject_name]['st']) / count($studentMarks[$title->subject_name]['ft']), 0);    
                        $thisText = $summativeTotal;
                    }            
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
                    /************************************** Above Average
                    ******************************************************/
                    $thisText = '';
                    $startWith_Y += $text_column_height;
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['st'])){
                        $summativeTotalAverage = $this->assessment_report_model->getCountOf_GreaterOnly_2d($studentMarks[$title->subject_name]['st'], $summativeTotal);
                        $thisText = $summativeTotalAverage;
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
                    /************************************** Below Average
                    ******************************************************/
                    $thisText = '';
                    $startWith_Y += $text_column_height;
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['st'])){
                        $summativeTotalAverageB = $this->assessment_report_model->getCountOf_LessOnly_2d($studentMarks[$title->subject_name]['st'], $summativeTotal);
                        $thisText = $summativeTotalAverageB;
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');

                    /************************** APlus * A * B * C * D * U
                    ******************************************************/
                    $startWith_Y += $text_column_height + 4;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['stgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['stgd'], 'A+');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['stgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['stgd'], 'A');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['stgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['stgd'], 'B');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['stgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['stgd'], 'C');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['stgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['stgd'], 'D');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');


                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['stgd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['stgd'], 'U');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');












                    /************************************** Class Average
                    ******************************************************/
                    $thisText = '';
                    $startWith_Y = $dataFlowY;
                    $startWith_X += $table_header_sub_info_width;
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['st'])){
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
                    if(!empty($studentMarks[$title->subject_name]['st'])){
                        if(!empty($studentMarks[$title->subject_name]['std_total'])){
                            $thisText = $this->assessment_report_model->getCountOf_GreaterOnly_2d($studentMarks[$title->subject_name]['std_total'], $studentMarks[$title->subject_name]['avg']);
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
                    if(!empty($studentMarks[$title->subject_name]['st'])){
                        if(!empty($studentMarks[$title->subject_name]['std_total'])){
                            $thisText = $this->assessment_report_model->getCountOf_LessOnly_2d($studentMarks[$title->subject_name]['std_total'], $studentMarks[$title->subject_name]['avg']);
                        }else{
                            $thisText = '';
                        }
                    }else{
                        $thisText = $formativeTotalAverageB;
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');



                    /************************** APlus * A * B * C * D * U
                    ******************************************************/
                    $totalSubjects_gd = 0;
                    if(!empty($studentMarks[$title->subject_name]['gd'])){$totalSubjects_gd = count($studentMarks[$title->subject_name]['gd']);}
                    $startWith_Y += $text_column_height + 4;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['gd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['gd'], 'A+');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
                    /******************************** Percentage - Grade - Ap *****/
                    $pdf->SetXY($startWith_X+$table_header_sub_info_width,$startWith_Y);
                    if($totalSubjects_gd==0){
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, '',0,0,'C');    
                    }else{
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, ROUND($thisText/$totalSubjects_gd*100, 0).'%',0,0,'C');                
                    }




                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['gd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['gd'], 'A');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
                    /******************************** Percentage - Grade - A *****/
                    $pdf->SetXY($startWith_X+$table_header_sub_info_width,$startWith_Y);
                    if($totalSubjects_gd==0){
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, '',0,0,'C');    
                    }else{
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, ROUND($thisText/$totalSubjects_gd*100, 0).'%',0,0,'C');                
                    }




                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['gd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['gd'], 'B');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
                    /******************************** Percentage - Grade - B *****/
                    $pdf->SetXY($startWith_X+$table_header_sub_info_width,$startWith_Y);
                    if($totalSubjects_gd==0){
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, '',0,0,'C');    
                    }else{
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, ROUND($thisText/$totalSubjects_gd*100, 0).'%',0,0,'C');                
                    }




                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['gd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['gd'], 'C');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
                    /******************************** Percentage - Grade - C *****/
                    $pdf->SetXY($startWith_X+$table_header_sub_info_width,$startWith_Y);
                    if($totalSubjects_gd==0){
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, '',0,0,'C');    
                    }else{
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, ROUND($thisText/$totalSubjects_gd*100, 0).'%',0,0,'C');                
                    }




                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['gd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['gd'], 'D');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
                    /******************************** Percentage - Grade - D *****/
                    $pdf->SetXY($startWith_X+$table_header_sub_info_width,$startWith_Y);
                    if($totalSubjects_gd==0){
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, '',0,0,'C');    
                    }else{
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, ROUND($thisText/$totalSubjects_gd*100, 0).'%',0,0,'C');                
                    }




                    $startWith_Y += $text_column_height;
                    $thisText = '';
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    if(!empty($studentMarks[$title->subject_name]['gd'])){
                        $thisText = $this->assessment_report_model->CountThisGradeIn_2d($studentMarks[$title->subject_name]['gd'], 'U');
                    }
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, $thisText, 1, 0, 'C');
                    /******************************** Percentage - Grade - U *****/
                    $pdf->SetXY($startWith_X+$table_header_sub_info_width,$startWith_Y);
                    if($totalSubjects_gd==0){
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, '',0,0,'C');    
                    }else{
                        $pdf->Cell($table_header_sub_info_width, $text_column_height, ROUND($thisText/$totalSubjects_gd*100, 0).'%',0,0,'C');                
                    }











                    $startWith_X += $table_header_sub_info_width;
                    $pdf->SetXY($startWith_X,$startWith_Y);
                    $pdf->Cell($table_header_sub_info_width, $text_column_height, '',0,0,'C');

                    $startWith_X += $table_header_sub_info_width;
                }

                if($i == 28){break;}
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
                        if($grading->grading_name == 'B'){$grade_B_per = $grading->weightage;}
                        if($grading->grading_name == 'C'){$grade_C_per = $grading->weightage;}
                        if($grading->grading_name == 'D'){$grade_D_per = $grading->weightage;}
                        if($grading->grading_name == 'U'){$grade_U_per = $grading->weightage;}
                    }
                    if($thisText_Per >= $grade_Ap_per){
                        $thisText_Grade = 'A+';
                    }else if($thisText_Per >= $grade_A_per){
                        $thisText_Grade = 'A';
                    }else if($thisText_Per >= $grade_B_per){
                        $thisText_Grade = 'B';
                    }else if($thisText_Per >= $grade_C_per){
                        $thisText_Grade = 'C';
                    }else if($thisText_Per >= $grade_D_per){
                        $thisText_Grade = 'D';
                    }else {
                        $thisText_Grade = 'U';
                    }

                    $thisText_Rank = $this->assessment_report_model->getRankOf($studentTotalPercentage, $thisText_Per);

                    if($studentGrade_U[$student->gs_id] == 1000){
                        $thisText_Grade = 'U';

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
                        }else if($thisText_Grade=='B'){
                            $fontColor_r = $grade_B_r_FontColor;
                            $fontColor_g = $grade_B_g_FontColor;
                            $fontColor_b = $grade_B_b_FontColor;

                            $BG_fontColor_r = $BG_grade_B_r_FontColor;
                            $BG_fontColor_g = $BG_grade_B_g_FontColor;
                            $BG_fontColor_b = $BG_grade_B_b_FontColor;
                        }else if($thisText_Grade=='C'){
                            $fontColor_r = $grade_C_r_FontColor;
                            $fontColor_g = $grade_C_g_FontColor;
                            $fontColor_b = $grade_C_b_FontColor;

                            $BG_fontColor_r = $BG_grade_C_r_FontColor;
                            $BG_fontColor_g = $BG_grade_C_g_FontColor;
                            $BG_fontColor_b = $BG_grade_C_b_FontColor;
                        }else if($thisText_Grade=='D'){
                            $fontColor_r = $grade_D_r_FontColor;
                            $fontColor_g = $grade_D_g_FontColor;
                            $fontColor_b = $grade_D_b_FontColor;

                            $BG_fontColor_r = $BG_grade_D_r_FontColor;
                            $BG_fontColor_g = $BG_grade_D_g_FontColor;
                            $BG_fontColor_b = $BG_grade_D_b_FontColor;
                        }else if($thisText_Grade=='U'){
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
                if($grading->grading_name == 'A'){$grade_A_per = $this->assessment_report_model->getCountOf_GreaterOnly_2d_Between($OverAll_Perc, 85, 75);}
                if($grading->grading_name == 'B'){$grade_B_per = $this->assessment_report_model->getCountOf_GreaterOnly_2d_Between($OverAll_Perc, 75, 65);}
                if($grading->grading_name == 'C'){$grade_C_per = $this->assessment_report_model->getCountOf_GreaterOnly_2d_Between($OverAll_Perc, 65, 55);}
                if($grading->grading_name == 'D'){$grade_D_per = $this->assessment_report_model->getCountOf_GreaterOnly_2d_Between($OverAll_Perc, 55, 50);}
                if($grading->grading_name == 'U'){$grade_U_per = $this->assessment_report_model->getCountOf_LessOnly_2d($OverAll_Perc, $grading->weightage);}
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

            $PageNo++;
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetXY($pdf->w-30,$pdf->h-15);
            $pdf->Cell(20, 4, 'Page '.$PageNo.' / ' . ceil(($no_of_subjects+2.5)/7), 0, 0, 'L');

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
                        if($grading->grading_name == 'B'){$grade_B_per = $grading->weightage;}
                        if($grading->grading_name == 'C'){$grade_C_per = $grading->weightage;}
                        if($grading->grading_name == 'D'){$grade_D_per = $grading->weightage;}
                        if($grading->grading_name == 'U'){$grade_U_per = $grading->weightage;}
                    }
                    if($thisText_Per >= $grade_Ap_per){
                        $thisText_Grade = 'A+';
                    }else if($thisText_Per >= $grade_A_per){
                        $thisText_Grade = 'A';
                    }else if($thisText_Per >= $grade_B_per){
                        $thisText_Grade = 'B';
                    }else if($thisText_Per >= $grade_C_per){
                        $thisText_Grade = 'C';
                    }else if($thisText_Per >= $grade_D_per){
                        $thisText_Grade = 'D';
                    }else {
                        $thisText_Grade = 'U';
                    }

                    $thisText_Rank = $this->assessment_report_model->getRankOf($studentTotalPercentage, $thisText_Per);


                    if($studentGrade_U[$student->gs_id] == 1000){
                        $thisText_Grade = 'U';

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
                        }else if($thisText_Grade=='B'){
                            $fontColor_r = $grade_B_r_FontColor;
                            $fontColor_g = $grade_B_g_FontColor;
                            $fontColor_b = $grade_B_b_FontColor;

                            $BG_fontColor_r = $BG_grade_B_r_FontColor;
                            $BG_fontColor_g = $BG_grade_B_g_FontColor;
                            $BG_fontColor_b = $BG_grade_B_b_FontColor;
                        }else if($thisText_Grade=='C'){
                            $fontColor_r = $grade_C_r_FontColor;
                            $fontColor_g = $grade_C_g_FontColor;
                            $fontColor_b = $grade_C_b_FontColor;

                            $BG_fontColor_r = $BG_grade_C_r_FontColor;
                            $BG_fontColor_g = $BG_grade_C_g_FontColor;
                            $BG_fontColor_b = $BG_grade_C_b_FontColor;
                        }else if($thisText_Grade=='D'){
                            $fontColor_r = $grade_D_r_FontColor;
                            $fontColor_g = $grade_D_g_FontColor;
                            $fontColor_b = $grade_D_b_FontColor;

                            $BG_fontColor_r = $BG_grade_D_r_FontColor;
                            $BG_fontColor_g = $BG_grade_D_g_FontColor;
                            $BG_fontColor_b = $BG_grade_D_b_FontColor;
                        }else if($thisText_Grade=='U'){
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
            
            foreach($data['assessment_overall_garde'] as $grading){
                if($grading->grading_name == 'A+'){$grade_Ap_per = $this->assessment_report_model->getCountOf_GreaterOnly_2d($OverAll_Perc, $grading->weightage);}
                if($grading->grading_name == 'A'){$grade_A_per = $this->assessment_report_model->getCountOf_GreaterOnly_2d_Between($OverAll_Perc, 85, 75);}
                if($grading->grading_name == 'B'){$grade_B_per = $this->assessment_report_model->getCountOf_GreaterOnly_2d_Between($OverAll_Perc, 75, 65);}
                if($grading->grading_name == 'C'){$grade_C_per = $this->assessment_report_model->getCountOf_GreaterOnly_2d_Between($OverAll_Perc, 65, 55);}
                if($grading->grading_name == 'D'){$grade_D_per = $this->assessment_report_model->getCountOf_GreaterOnly_2d_Between($OverAll_Perc, 55, 50);}
                if($grading->grading_name == 'U'){$grade_U_per = $this->assessment_report_model->getCountOf_LessOnly_2d($OverAll_Perc, $grading->weightage);}
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
            $pdf->Cell($text_column_width_abname+$text_column_width_status, $text_column_height, 'APlus',1,0,'L',1);

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