<?php

class Library_formates_ajax extends CI_Controller{


	public function __construct(){
		parent::__construct();
	}

	public function get_library_formates(){


		$grade_id = $this->input->post('grade_id');
		$section_id = $this->input->post('section_id');
		$section_name = $this->input->post('section_name');
		$grade_name = $this->input->post('grade_name');
		$academic_id = $this->input->post('academic_id');


		

		$helper = "grade_id=".$grade_id."&section_id=".$section_id."&academic_session_id=".$academic_id."&grade_name=".$grade_name."&section_name=".$section_name;
		$html ='';
		$html .= '<style> iframe{
			width:100%;
			height:700px;
		}</style>';
		$html .= '<div class="powerwidget purple">';
		$html .= '<header>Library Formates ('.$grade_name.'-'.$section_name.')</header>';
		$html .= '<div class="inner-spacer">';
		$html .='<iframe src='.site_url().'/etab_reports/library_formates_ajax/get_library_formates_report?'.$helper.'></iframe>';
		$html .= '</div>';
		$html .= '</div>';
		echo $html;
	}

	public function get_library_formates_report(){
		
		$grade_id = $this->input->get('grade_id');
		$section_id = $this->input->get('section_id');
		$academic_id = $this->input->get('academic_session_id');
		$grade_name = $this->input->get('grade_name');
		$section_name = $this->input->get('section_name');

		require_once('components/pdf/fpdf/fpdf_rotate.php');
        require_once('components/pdf/fpdi/fpdi.php');

        $this->load->model('atif_sp/assessment_report_model');
        $this->data['students_gs_data'] = $this->assessment_report_model->get_students_grade_section($grade_id, $section_id);
        $this->load->model('etab_reports/programme_report_model','prm');

        $class_teacher = 15;
        $class_teacher =$this->prm->get_teacher($grade_id,$section_id,$class_teacher);   
        $font_name = 'CooperBT-Black';
        $font_size = 15;
        

        $pdf = new PDF('P','mm','A4');

        $page_width =($pdf->w/2);


        $heading_cellWidth = 60;
        $heading_cellHeight = 10;

        $y_axis = 2;
        $heading_x_axis = $page_width-35;


        $pdf->AddFont('CooperBT-Black','','CooperBlackBT.php');
        $pdf->SetFont($font_name,'',$font_size);
        $pdf->Addpage();

        $pdf->SetXY($heading_x_axis,$y_axis);
        $pdf->Cell($heading_cellWidth,$heading_cellHeight,"Generation's School",0);

        //==================================Library Formates======================//
        //=======================================================================//

        
        $y_axis = $y_axis+10;
        $font_size = 12;
        $heading_x_axis = $heading_x_axis+10;
        $pdf->SetFont($font_name,'',$font_size);
        $pdf->SetXY($heading_x_axis,$y_axis);
        $pdf->Cell($heading_cellWidth,$heading_cellHeight,"Library Formates",0);

        // ================ Grade Name =====================================//
        //=================================================================//
        $font_name ='Helvetica';
        $y_axis = $y_axis;
        $x_axis = 9;
        $font_size = 10;
        $pdf->SetFont($font_name,'',$font_size);
        $pdf->SetXY($x_axis,$y_axis);
        $pdf->Cell($heading_cellWidth,$heading_cellHeight,"Grade ".$grade_name."-".$section_name);

        //===============Class Teacher ===========================================//
        //========================================================================//
        $y_axis = $y_axis+5;
        $x_axis = 9;
        $font_size = 10;
        $pdf->SetFont($font_name,'',$font_size);
        $pdf->SetXY($x_axis,$y_axis);
        $pdf->Cell($heading_cellWidth,$heading_cellHeight,"C.Teacher:".$class_teacher[0]->class_teacher);

        //==========================Header Heading ========================//

        $header = array('Regularity & Punctuality','Reading with Interest','Utilization of Library Privillege','Fiction','Non-Fiction','Reference');

        $y_axis += 8;
        $ReportStarting_X = 10;
        $ReportLast_X = 0;

        
        $cellWidth=14;
        $cellHeight=40;
        $font_name = 'Helvetica';
        $font_size = 8;
        $pdf->SetFont($font_name,'',$font_size);
        $pdf->SetXY($ReportStarting_X,$y_axis);
        $pdf->Cell(7,$cellHeight,'Sr',1,0,'C');
        $pdf->Cell(15,$cellHeight,'GS-ID',1,0,'C');
        $pdf->Cell(30,$cellHeight,'Student Name',1,0,'L');
        $pdf->Cell(15,$cellHeight,'GS Status',1,0,'C');
        $ReportLast_X += 15+30+12+20;

        for($i=0;$i<sizeof($header);$i++){
        	$pdf->SetFillColor(175,175,175);
            $pdf->RotatedCell($ReportLast_X+($i*$cellWidth),$y_axis+$cellHeight,$cellHeight,$cellWidth,$header[$i],1,0,'L',90,1);
            //$pdf->SetXY($ReportLast_X+($i*$cellWidth),$y_axis+$cellHeight);
            //$pdf->MultiCell($cellWidth,$cellHeight,$header[$i]);
        }

        $counter = 0;
        $cellHeight = 7;
        $y_axis = 65;

   		foreach ($this->data['students_gs_data'] as $data) {
   			
   			$font_size = 8;
            $pdf->SetFont($font_name,'',$font_size);
            $pdf->SetXY($ReportStarting_X,$y_axis+($counter*7));
            $pdf->Cell(7,$cellHeight,$counter+1,1,0,'C');
            $pdf->Cell(15,$cellHeight,$data->gs_id,1,0,'C');
            $pdf->Cell(30,$cellHeight,$data->abridged_name,1,0,'L');
            $pdf->Cell(15,$cellHeight,$data->std_status_code,1,0,'C');
            $pdf->Cell(14,$cellHeight,"",1,0,'C');
            $pdf->Cell(14,$cellHeight,"",1,0,'C');
            $pdf->Cell(14,$cellHeight,"",1,0,'C');
            $pdf->Cell(14,$cellHeight,"",1,0,'C');
            $pdf->Cell(14,$cellHeight,"",1,0,'C');
            $pdf->Cell(14,$cellHeight,"",1,0,'C');
            $counter++;
   		}

        
        $page_height = $pdf->h;
        $header_font_size = 10;
        $header_font_name = 'CooperBT-Black';
        $pdf->SetFont($font_name,'',$header_font_size);

        $where = array('user_id'=>$this->session->userdata('user_id'));

        $user_id = $this->prm->get_by('atif.staff_registered',$select='',$where);
        
        $page_height = $page_height-29.5;

        
        $pdf->SetFillColor(0,0,0);
        $pdf->SetTextColor(255,255,255);
        $pdf->SetXY(7,$page_height);
        $pdf->Cell(120, 9, date('D-d-M-Y H:i') . ' (' . ucwords($user_id[0]->name) . ')', 1, 0, 'L', 1);

        $pdf->Output('library_formates'.'.pdf','I');
	}
}