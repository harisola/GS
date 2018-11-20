<?php
class programme_report_ajax extends CI_Controller{
	public function __construct(){
		parent::__construct();
	}

	public function get_programme(){

		$grade_id = $this->input->post('grade_id');
		$grade_name = $this->input->post('grade_name');
		$academic_id = $this->input->post('academic_id');
		
		$html = '';

		$html .= '<style>
				iframe{
					width:100%;
					height:700px;

				}
		</style>';

		$helper = 'grade_id='.$grade_id.'&academic_id='.$academic_id.'&grade_name='.$grade_name;
		
		$html .= '<div class="powerwidget purple">';
		$html .= '<header><h2>'.$grade_name.'</h2></header>';
		$html .= '<div class="inner-spacer">';
		$html .= '<iframe src="'.site_url().'/etab_reports/programme_report_ajax/show_programme_report_pdf?'.$helper.'"></iframe>';
		$html .= '</div>';
		$html .= '</div>';
	

		echo $html;
	}

	public function show_programme_report_pdf(){

		$grade_id = $this->input->get('grade_id');
		$academic_session_id = $this->input->get('academic_id');
		$grade_name = $this->input->get('grade_name');


		
		$select="";
		$where=array(
			'gradeID' => $grade_id,
		);
		$group="";


		$this->load->model('etab_reports/programme_report_model','prm');
		$programme = $this->prm->get_subejct_detail($grade_id,$academic_session_id, "_1617_2");

		//var_dump($programme);
		require_once('components/pdf/fpdf/fpdf_rotate.php');
		require_once('components/pdf/fpdi/fpdi.php');

		$pdf = new PDF('P','mm','A4');

		


		$pdf->AddPage();

		$pdf->AddFont('CooperBT-Black','','CooperBlackBT.php');
		$font_name = 'CooperBT-Black';
		$font_size = 20;
		$pdf->SetFont($font_name,'',$font_size);

		$x_axis_center = 60;
		$y_axis = 10;
		$border_on = 1;
		$pdf->SetXY($x_axis_center,$y_axis);
		$pdf->Cell(40,8,"Generation's School",0,'C');


		$x_axis_center = 75;
		$y_axis = 20;
		$pdf->SetFont($font_name,'',12);
		$pdf->SetXY($x_axis_center,$y_axis);
		$pdf->Cell(40,8,"Programme Report",0,'C');


		$x_axis_center = 90;
		$y_axis = 30;
		$pdf->SetFont($font_name,'',12);
		$pdf->SetXY($x_axis_center,$y_axis);
		$pdf->Cell(40,8,"Grade:".$grade_name,0,'C');



		$header_font_name = 'Helvetica';
		$header_font_size = 10;
		$header = array('Subject','Code','Optional');


		
		// Set Header Font Name And Font Size


		$pdf->SetFont($header_font_name,'',$header_font_size);

		$x_axis_report = 10;
		$y_axis_report = 10;
		$y_axis_report = $y_axis_report+$y_axis;
		$cell_width = 60;
		$cell_height = 6; 


		// Header Column of a Report
		$pdf->SetFillColor(175,175,175);
		for($i=0;$i<sizeof($header);$i++){

			if($i == 0){
				$pdf->SetXY($x_axis_report,$y_axis_report);
				$pdf->Cell($cell_width,$cell_height,$header[$i],$border_on,0,'C',1);	
			}
			else{
				$pdf->SetXY($x_axis_report+($cell_width*$i),$y_axis_report);
				$pdf->Cell($cell_width,$cell_height,$header[$i],$border_on,0,'C',1);
			}

		}

		


		// Column Of A Report
		$data_extract = array('subject_name','subject_code','optional');
		

		for($j=0;$j<sizeof($programme);$j++){
						
			if($j==0){
				$y_axis_report = $y_axis_report+$cell_height;

				for($k = 0 ; $k < 3 ; $k++){

					if($programme[$j][$data_extract[2]] == '1'){

						$programme[$j][$data_extract[2]] = 'Yes';
						
					}
					else if($programme[$j][$data_extract[2]] == '0'){

						$programme[$j][$data_extract[2]] = '';

					}

					$pdf->SetXY($x_axis_report+($cell_width*$k),$y_axis_report);
					$pdf->Cell($cell_width,$cell_height,$programme[$j][$data_extract[$k]],$border_on,0,'C');
				}
			}
			else{
			 	
				for($k = 0 ; $k < 3 ; $k++){
					
					if($programme[$j][$data_extract[2]] == '1'){

						$programme[$j][$data_extract[2]] = 'Yes';
						
					}
					else if($programme[$j][$data_extract[2]] == '0'){

						$programme[$j][$data_extract[2]] = '';

					}

					$pdf->SetXY($x_axis_report+($cell_width*$k),$y_axis_report+($cell_height*$j));
					$pdf->Cell($cell_width,$cell_height,$programme[$j][$data_extract[$k]],$border_on,0,'C');
			 	}
			 	
			}




		}

		$where = array('user_id'=>$this->session->userdata('user_id'));

		$user_id = $this->prm->get_by('atif.staff_registered',$select='',$where);
		

		
		$pdf->SetFillColor(0,0,0);
		$pdf->SetTextColor(255,255,255);
    	$pdf->SetXY(7,150);
    	$pdf->Cell(80, 4, date('D-d-M-Y H:i') . ' (' . ucwords($user_id[0]->name) . ')', 1, 0, 'L', 1);

		$pdf->Output('Assessment_Report' . '.pdf', 'I');   

		
   
	}
}