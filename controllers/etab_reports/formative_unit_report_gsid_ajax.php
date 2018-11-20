<?php 
Class Formative_unit_report_gsid_ajax extends CI_Controller{
	public function __construct(){
		parent::__construct();

		$this->data['staff_150_photo_path'] ='assets/photos/hcm/150x150/staff/';
		$this->data['photo_file'] = '.png';
	}

	function index(){		
	}




	public function getStudentReports(){
		$html = '';

		if(count($_POST) && $_POST['gsid'] != null){

			$GSID = $_POST['gsid'];
			$selectedOption = trim($_POST['option']);

			if($selectedOption == ''){
				$selectedOption = 'Progress Report';
			}

			$grade_id = $this->input->post('grade_id');
			$section_id = $this->input->post('section_id');
			

			

			$html = '
			<style type="text/css">
				.fa-group{
					padding-right: 10px;
				}
				.fa-calendar{
					padding-right: 10px;
				}
				.fa-child{
					padding-right: 10px;
				}
				.fa-money{
					padding-right: 10px;
				}
				.fa-building{
					padding-right: 10px;
				}
				.fa-codepen{
					padding-right: 10px;
				}
				.fa-credit-card{
					padding-right: 10px;
				}
			</style>
			';


			$this->load->model('student_log/student_log_logtype');
			$StudentName = $this->student_log_logtype->getStudentName($GSID);

			$html .= '
			<div class="powerwidget black" role="widget">
				<header>
					<h2>'.$StudentName.'<small>Information</small></h2>

					<div class="powerwidget-ctrls" role="menu">
						<a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
					</div>
				</header>
				<div class="inner-spacer" style="height: 75vh;">

					 <ul class="nav nav-tabs" id="student_complete_information">';


					 $html .= '<li ';

					 	//if($log->name == $selectedOption){
					 		$html .= 'class="active"';
					 	//}
					 	$html .= '>
					 		<a href="#draft_report" data-toggle="tab">
					 			<i class="fa fa-user"></i> Progress Report </a></li>';


					 //foreach ($this->data['log_type'] as $log) {
					 	$html .= '<li ';

					 	//if($log->name == $selectedOption){
					 		//$html .= 'class="active"';
					 	//}
					 	$html .= '>
					 		<a href="#unit_report" data-toggle="tab">
					 			<i class="fa fa-user"></i> Unit Report</a></li>';
					 //}
					 

					$html .= '
					</ul>
					  <div class="tab-content">';


					 	$html .= '<div class="tab-pane ';
                        if($selectedOption == 'Unit Report'){
					 		//$html .= 'active';
					 		$html .= '" id="unit_report">';

					 	}
                        

                        if($selectedOption == 'Progress Report'){
                        	$html .= 'active';
                        	$html .= '" id="draft_report">';

                        }



						/*********************************    Unit Report
						******************************************************/
						if($selectedOption == "Unit Report"){
								$html .= $this->get_student_report_unit($GSID);
						}


						/*********************** Progress Report *********/

						if($selectedOption == 'Progress Report'){
							
							$html .= $this->get_student_draft_report($GSID,$grade_id,$section_id);
						}




                       $html .= '</div>';
	                    

	                $html .='
	                  </div>';




				$html .='
				</div>
			</div>
			';

		}


		echo $html;
	}















	private function get_student_report_unit($GSID){
		$html = '';

		/*$html .= 'This is student comments: ' . $GSID;*/


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
				height: 90%;
			}
		</style>';



		$html .= '
		<div class="unit_report_pdf_iframe">
			<iframe src="'.site_url().'/etab_reports/formative_unit_report_gsid_ajax/ThisStudent_UnitReport?GSID='.$GSID.'" frameborder="0">
			</iframe>
		</div>';

		return $html;
	}













	public function ThisStudent_UnitReport(){
		$GSID = $this->input->get('GSID');


		$this->load->model('atif_sp/assessment_report_model');
		/*************************Unit Assessment Marks
        /***********************************************/
        $this->data['assessment_marks'] = $this->assessment_report_model->Get_Formative_Unit_Marks_GSID($GSID);





        // Overall Font Size
		$font_name = 'times'; //Helvetica
		$now_date = date('d-M-Y');
		


		require_once('components/pdf/fpdf/fpdf_rotate.php');
		require_once('components/pdf/fpdi/fpdi.php');



		$pdf = new PDF('P', 'mm', 'A4');
		$pdf->AddPage();


		// Helping Variables
		$ReportStarting_X = 10;
		$ReportStarting_Y = 7;
		$ReportLast_X = 0;
		$ReportLast_Y = 0;




		// Heading - Unit Report
		$border = 1;
		$font_size = 17;
		$header_width =  $pdf->w-20;
    	$pdf->SetFont($font_name,'B',$font_size);
    	$pdf->SetXY($ReportStarting_X,$ReportStarting_Y);
    	$pdf->Cell($header_width,10,'Unit Assessment',0,0,'C');

    	
		$font_size = 15;
    	$pdf->SetFont($font_name,'B',$font_size);
    	$pdf->SetXY($ReportStarting_X,$ReportStarting_Y+6);
    	$pdf->Cell($header_width,10,"Student's Profile",0,0,'C');


    	if(empty($this->data['assessment_marks'][0])){
    		$font_size = 20;
	    	$pdf->SetFont($font_name,'B',$font_size);
	    	$pdf->SetXY($ReportStarting_X,$ReportStarting_Y+26);
	    	$pdf->Cell($header_width,10,"No Assessment Found",0,0,'C');
    	}else{
    		// Calling all subjects
    		$GradeID = $this->data['assessment_marks'][0]->grade_id;
    		$SectionID = $this->data['assessment_marks'][0]->section_id;
    		$this->data['assessments'] = $this->assessment_report_model->Get_Formative_Unit_Marks_GSID_Subjects($GradeID, $SectionID);



    		// Student Name and Class
    		$font_size = 12;
	    	$pdf->SetFont($font_name,'BU',$font_size);
	    	$pdf->SetXY(($pdf->w-120)/3,$ReportStarting_Y+20);
	    	$pdf->Cell(100,10,"Name : ".$this->data['assessment_marks'][0]->abridged_name.' ('.$GSID.')',0,0,'L');

	    	$font_size = 12;
	    	$pdf->SetFont($font_name,'BU',$font_size);
	    	$pdf->SetXY(($pdf->w-120)/3+100,$ReportStarting_Y+20);
	    	$pdf->Cell(50,10,"Class : ".$this->data['assessment_marks'][0]->grade_name.'-'.$this->data['assessment_marks'][0]->section_name,0,0,'R');


			

			// Heading
			$font_size = 10;
			$pdf->SetFillColor(175,175,175);
	    	$pdf->SetFont($font_name,'B',$font_size);
	    	$pdf->SetXY(($pdf->w-120)/3,$ReportStarting_Y+28);
	    	$pdf->Cell(50,10,"Subject",1,0,'C',1);
	    	
	    	$pdf->SetXY(($pdf->w-120)/3+50,$ReportStarting_Y+28);
	    	$pdf->Cell(50,10,"Marks Obtained %",1,0,'C',1);

	    	$pdf->SetXY(($pdf->w-120)/3+100,$ReportStarting_Y+28);
	    	$pdf->Cell(50,10,"Grade",1,0,'C',1);




	    	$font_size = 10;
	    	$font_name = 'Helvetica';
	    	$pdf->SetFillColor(255,255,255);
	    	$pdf->SetFont($font_name,'',$font_size);
	    	$i=1;
	    	$previousSubject = '';


	    	foreach ($this->data['assessments'] as $assessment) {	
	    		$result = '';
	    		$grade = '';
	    		$subjectName = '';

	    		foreach ($this->data['assessment_marks'] as $marks) {

	    			if($marks->subject_code == $assessment->subject_code){
	    				$result = $marks->percentageAssessment;
	    				$subjectName = $marks->subject_name;
	    				$grade = $marks->grade;
	    			}
	    		}

	    		if($subjectName == ''){
	    			$pdf->SetXY(($pdf->w-120)/3,$ReportStarting_Y+28+($i*8));
		    		$pdf->Cell(50,8,$assessment->subject_name,1,0,'C',1);
	    		}else{
	    			$pdf->SetXY(($pdf->w-120)/3,$ReportStarting_Y+28+($i*8));
		    		$pdf->Cell(50,8,$subjectName,1,0,'C',1);
	    		}
	    		
	    		$pdf->SetXY(($pdf->w-120)/3+50,$ReportStarting_Y+28+($i*8));
	    		$pdf->Cell(50,8,$result,1,0,'C',1);


				$pdf->SetXY(($pdf->w-120)/3+100,$ReportStarting_Y+28+($i*8));
	    		$pdf->Cell(50,8,$grade,1,0,'C',1);
	    		

	    		$i++;
	    		$previousSubject = $assessment->subject_name;
	    	}



	    	$font_size = 12;
	    	$font_name = 'times';
	    	$pdf->SetFont($font_name,'B',$font_size);
	    	$pdf->SetXY(($pdf->w-120)/3,$ReportStarting_Y+28+($i*8)+2);
    		$pdf->Cell(50,8,'Signature:',0,0,'L',1);

    		$i++;
    		$pdf->SetFont($font_name,'',$font_size);
    		$pdf->SetXY(($pdf->w-120)/3,$ReportStarting_Y+28+($i*8)+2);
    		$pdf->Cell(50,8,'Class Teaher:    _______________________',0,0,'L',1);

    		$i++;
    		$pdf->SetXY(($pdf->w-120)/3,$ReportStarting_Y+28+($i*8)+5);
    		$pdf->Cell(50,8,'Ac. Facilitator:  _______________________',0,0,'L',1);

    		$i++;
    		$pdf->SetXY(($pdf->w-120)/3,$ReportStarting_Y+28+($i*8)+10);
    		$pdf->Cell(50,8,'Parents:             _______________________',0,0,'L',1);

    		$i++;
    		$pdf->SetXY(($pdf->w-120)/3,$ReportStarting_Y+28+($i*8)+12);
    		$pdf->Cell(50,8,'Date:                 _______________________',0,0,'L',1);

    	}






    	// Output the new PDF
		$pdf->Output('Assessment_Student_Unit_Report' . '.pdf', 'I');

	}


	// Get Student Draft Report

	public function get_student_draft_report($GSID,$grade_id,$section_id){


		$html = '';

		/*$html .= 'This is student comments: ' . $GSID;*/


		$html .= '
		<style>
			.draft_report_pdf_iframe {
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



		$html .= '
		<div class="draft_report_pdf_iframe">
			<iframe src="'.base_url().'index.php/etab_reports/progress_report_ajax/ThisStudent_progressReport?GSID='.$GSID.'&grade_id='.$grade_id.'&section_id='.$section_id.'" frameborder="0" style="width:100%;height:2000px">
			</iframe>
		</div>';

		return $html;

		
	}
}