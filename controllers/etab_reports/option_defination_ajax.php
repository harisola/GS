<?php
class Option_defination_ajax extends CI_Controller{
	public function __construct(){
		parent::__construct();
	}
	public function get_option_defination_report(){
		$grade_id = $this->input->post('grade_id');
		$academic_id = $this->input->post('academic_id');
		$grade_name = $this->input->post('grade_name');
		$helper = "grade_id=".$grade_id."&academic_id=".$academic_id."&grade_name=".$grade_name;
		$html='';

		$html .= '<style>
				iframe{
					width:100%;
					height:700px;

				}
		</style>';

		$html .= '<div class="powerwidget purple">';
		$html .= '<header><h2>'.$grade_name.'</h2></header>';
		$html .= '<div class="inner-spacer">';
		$html .= '<iframe src="'.site_url().'/etab_reports/option_defination_ajax/get_option_defination_report_pdf?'.$helper.'"></iframe>';
		$html .= '</div>';
		$html .= '</div>';


		echo $html;
	}

	public function get_option_defination_report_pdf(){

		$grade_id = $this->input->get('grade_id');
		$academic_id = $this->input->get('academic_id');
		$grade_name = $this->input->get('grade_name');

		$select='';
		$where = array();

		$this->load->model('etab_reports/programme_report_model','prm');
		$get_selection_group = $this->prm->get_by('atif_subject.subject_selection_group',$select,$where);

		//var_dump($get_selection_group);		


		require_once('components/pdf/fpdf/fpdf_rotate.php');
		require_once('components/pdf/fpdi/fpdi.php');

		$pdf = new PDF('L','mm','A4');
		$pdf->AddPage();

		$page_height = $pdf->h;

		// Add Font

		$pdf->AddFont('CooperBT-Black','','CooperBlackBT.php');
		$font_name = 'CooperBT-Black';
		$font_size = 20;
		$pdf->SetFont($font_name,'',$font_size);

		// ====================Heading in PDF===================//
		$x_axis_center = 110;
		$y_axis = 10;
		$border_on = 1;
		$pdf->SetXY($x_axis_center,$y_axis);
		$pdf->Cell(40,8,"Generation's School");

		$font_size=12;
		$pdf->SetFont($font_name,'',$font_size);
		$heading_axis_center = 120;
		$y_axis = $y_axis + 10;
		$pdf->SetXY($heading_axis_center,$y_axis);
		$pdf->Cell(40,8,"Option Defination Report");

		$font_size=10;
		$pdf->SetFont($font_name,'',$font_size);
		$heading_axis_center = 140;
		$y_axis = $y_axis + 10;
		$pdf->SetXY($heading_axis_center,$y_axis);
		$pdf->Cell(40,8,"Grade:".$grade_name);

		//=============Header in pdf===========================//

		$x_axis = 20;
		$y_axis = $y_axis+10;
		$header_font_name = 'Helvetica';
		$header_font_size = 10;
		$pdf->SetFont($header_font_name,'',$header_font_size);

		$cell_width = 45;
		$cell_height = 8;
		$y_axis = $y_axis+10;

		$subject_group =  $this->prm->get_subject_selection_group($grade_id,$academic_id);
			


		//==============Subject Selection Grade ============================//

		if(empty($subject_group)){

			$pdf->AddFont('CooperBT-Black','','CooperBlackBT.php');
			$font_name = 'CooperBT-Black';
			$font_size = 20;
			$pdf->SetFont($font_name,'',$font_size);
			$pdf->SetXY(110,50);

			$pdf->Cell($cell_width,$cell_height,"No Optional Subject");
		}else{
			$header_font_size = 14;
			$pdf->SetFont($header_font_name,'',$header_font_size);
		}

		$counter = 0;

		foreach($get_selection_group as $group){

			$counter_y = 1;
			$found = 0;
			
			for($i=0;$i<sizeof($subject_group);$i++){

				if($group->id == $subject_group[$i]->subject_selection_group_id){
					
					if($found == 0){
					$pdf->SetFillColor(175,175,175);	
					$pdf->SetXY($x_axis+($cell_width*$counter),$y_axis);
					$pdf->Cell($cell_width,$cell_height,$group->name,$border_on,0,'C',1);
					$found = 1;
					}
					$pdf->SetXY($x_axis+($cell_width*$counter),$y_axis+($cell_height*$counter_y));
					$pdf->Cell($cell_width,$cell_height,$subject_group[$i]->subject_name,$border_on,0,'C');
					$counter_y++;		
				}
			}
			$counter++;
			$i=0;

		}

		$pdf->SetFont($header_font_name,'',$header_font_size);

		$where = array('user_id'=>$this->session->userdata('user_id'));

		$user_id = $this->prm->get_by('atif.staff_registered',$select='',$where);
		
		$page_height = $page_height-40;

		
		$pdf->SetFillColor(0,0,0);
		$pdf->SetTextColor(255,255,255);
    	$pdf->SetXY(7,$page_height);
    	$pdf->Cell(120, 9, date('D-d-M-Y H:i') . ' (' . ucwords($user_id[0]->name) . ')', 1, 0, 'L', 1);

		$pdf->Output('Assessment_Report' . '.pdf', 'I');

	}

	

}