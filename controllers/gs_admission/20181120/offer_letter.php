<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Offer_letter extends CI_Controller{
	
    public function __construct(){
        parent::__construct();
		$this->load->library('session');
    }
	
	
	public function show(){



		$FormNo = $this->input->GET('FormNo');

		$this->load->model('admission/offer_model');
		$data['student'] = $this->offer_model->get_OfferLetter_StudentData($FormNo);



		$Title = $data['student'][0]->title;
		$Parent = ucwords($data['student'][0]->parent);
		$Address = ucwords($data['student'][0]->address);
		$ApplicantName = ucwords($data['student'][0]->official_name);
		$CallName = ucwords($data['student'][0]->call_name);
		$GradeID = $data['student'][0]->grade_id;
		//$GradeName = $data['student'][0]->grade_name;
		$ValidDate = $data['student'][0]->valid_date;
		$hijri_date = $data['student'][0]->islami_date;


		if($GradeID == 1 or $GradeID == 2 or $GradeID == 3 or $GradeID == 4 or $GradeID == 5
			 or $GradeID == 6 or $GradeID == 7 or $GradeID == 8 or $GradeID == 9 or $GradeID == 17){
			$HOD = 'Ms. Khadija Noorani';
			$Designation = 'Vice Principal';
			$Deparment = 'Starter & Junior Sections';
		}else if($GradeID == 10 or $GradeID == 11 or $GradeID == 12){
			$HOD = 'Ms. Sadia Ashar';
			$Designation = 'Headmistress';
			$Deparment = 'Middle Section';
		}else if($GradeID == 13 or $GradeID == 14 or $GradeID == 15 or $GradeID == 16){
			$HOD = 'Ms. Uzma Shakeel';
			$Designation = 'Headmistress';
			$Deparment = 'Senior Section';
		}

		if ($GradeID == 1){
			$GradeName = 'Pre-nursery';
		}elseif ($GradeID == 2) {
			$GradeName = 'Nursery';
		}elseif ($GradeID == 3) {
			$GradeName = 'Kindergarten';
		}elseif ($GradeID == 4) {
			$GradeName = 'Grade I';
		}elseif ($GradeID == 5) {
			$GradeName = 'Grade II';
		}elseif ($GradeID == 6) {
			$GradeName = 'Grade III';
		}elseif ($GradeID == 7) {
			$GradeName = 'Grade IV';
		}elseif ($GradeID == 8) {
			$GradeName = 'Grade V';
		}elseif ($GradeID == 9) {
			$GradeName = 'Grade VI';
		}elseif ($GradeID == 10) {
			$GradeName = 'Grade VII';
		}elseif ($GradeID == 11) {
			$GradeName = 'Grade VIII';
		}elseif ($GradeID == 12) {
			$GradeName = 'Grade IX';
		}elseif ($GradeID == 13) {
			$GradeName = 'Grade X';
		}elseif ($GradeID == 14) {
			$GradeName = 'Grade XI';
		}elseif ($GradeID == 17) {
			$GradeName = 'Playgroup';
		}

		// Overall Font Size
		$font_size = 10;
		$font_name = 'times';
		$gender_mark_size = 26;
		$now_date = date('l, F d, Y');


		require_once('components/pdf/fpdf/fpdf.php');
		require_once('components/pdf/fpdi/fpdi.php');
		
		

		/*$url = 'https://api.aladhan.com/gToH?date=18-01-2017';*/

		

		// initiate FPDI
		$pdf = new FPDI();

		// get the page count
		if($data['student'][0]->grade_id <= 5 or $data['student'][0]->grade_id = 17){
			$pageCount = $pdf->setSourceFile('components/pdf/admission/offer_letter_nc(1819).pdf');
		}else{
			$pageCount = $pdf->setSourceFile('components/pdf/admission/offer_letter_sc(1819).pdf');
		}
		// Border On
		$bo = 0;
		// iterate through all pages
		for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
		    // import a page
		    $templateId = $pdf->importPage($pageNo);
		    // get the size of the imported page
		    $size = $pdf->getTemplateSize($templateId);

		    // create a page (landscape or portrait depending on the imported page size)
		    if ($size['w'] > $size['h']) {
		        $pdf->AddPage('L', array($size['w'], $size['h']));
		    } else {
		        $pdf->AddPage('P', array($size['w'], $size['h']));
		    }		    

		    // use the imported page
	    	$pdf->useTemplate($templateId);

	    	

	    	


	    	if ($templateId == 1){

	    		// Submission Date
	    		
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',10);
			    $pdf->SetXY(17.5, 50);
			    $pdf->Cell(50, 5, $Title.' '.$Parent.',', $bo, 2, 'L', 0);
			    $pdf->MultiCell(75, 5, $Address.', Karachi.', $bo, 'L', 0);

			    $pdf->SetXY(25.5, 70.2);
			    $pdf->Cell(50, 5, $Title.' '.$Parent.',', $bo, 2, 'L', 0);

			    $pdf->SetFont($font_name,'B',11);
			    $pdf->SetXY(17.5, 86.5);
			    $pdf->Cell(172, 5, strtoupper($ApplicantName), $bo, 2, 'C', 0);
			    $pdf->Cell(172, 5, strtoupper('Admission Offer - '.$GradeName), $bo, 0, 'C', 0);

			    $pdf->SetFont($font_name,'',10);
			    $pdf->SetXY(116.5, 99.8);			    
			    $pdf->Cell(32, 5, $CallName, $bo, 0, 'C', 0);
			    $pdf->Cell(19, 5, '', $bo, 0, 'C', 0);
			    $pdf->Cell(22, 5, $GradeName, $bo, 0, 'C', 0);

			    
			}else if ($templateId == 2){

				$pdf->SetFont($font_name,'B',10);
			    $pdf->SetXY(30.5, 94.5);
			    $pdf->Cell(60, 5, $ValidDate.'.', $bo, 0, 'C', 0);

			    $pdf->SetFont($font_name,'',10);
			    $pdf->SetXY(17.5, 160);
			    $pdf->Cell(37, 5, $HOD, $bo, 2, 'L', 0);
			    $pdf->Cell(37, 5, $Designation.', '.$Deparment, $bo, 2, 'L', 0);
			    //$pdf->Cell(37, 5, $Deparment, $bo, 2, 'L', 0);

			    $pdf->SetXY(151.5, 160);
			    $pdf->Cell(37, 5, $now_date, $bo, 2, 'R', 0);
			    $pdf->Cell(37, 5, $hijri_date, $bo, 2, 'R', 0);

				$pdf->SetFont($font_name,'B',10);

				$pdf->SetXY(18.5, 190);
			    $pdf->Cell(165, 5, 'of Admission Offer ('.$GradeName.')', $bo, 2, 'C', 0);
			    $pdf->Cell(165, 5, $ApplicantName, $bo, 2, 'C', 0);

			}else if ($templateId == 3){

	    		// Submission Date
	    		
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',10);
			    $pdf->SetXY(17.5, 50);
			    $pdf->Cell(50, 5, $Title.' '.$Parent.',', $bo, 2, 'L', 0);
			    $pdf->MultiCell(75, 5, $Address.', Karachi.', $bo, 'L', 0);

			    $pdf->SetXY(25.5, 70.2);
			    $pdf->Cell(50, 5, $Title.' '.$Parent.',', $bo, 2, 'L', 0);

			    $pdf->SetFont($font_name,'B',11);
			    $pdf->SetXY(17.5, 86.5);
			    $pdf->Cell(172, 5, strtoupper($ApplicantName), $bo, 2, 'C', 0);
			    $pdf->Cell(172, 5, strtoupper('Admission Offer - '.$GradeName), $bo, 0, 'C', 0);

			    $pdf->SetFont($font_name,'',10);
			    $pdf->SetXY(116.5, 99.8);			    
			    $pdf->Cell(32, 5, $CallName, $bo, 0, 'C', 0);
			    $pdf->Cell(19, 5, '', $bo, 0, 'C', 0);
			    $pdf->Cell(22, 5, $GradeName, $bo, 0, 'C', 0);

			    
			}else if ($templateId == 4){

				$pdf->SetFont($font_name,'B',10);
			    $pdf->SetXY(30.5, 94.5);
			    $pdf->Cell(60, 5, $ValidDate.'.', $bo, 0, 'C', 0);

			    $pdf->SetFont($font_name,'',10);
			    $pdf->SetXY(17.5, 160);
			    $pdf->Cell(37, 5, $HOD, $bo, 2, 'L', 0);
			    $pdf->Cell(37, 5, $Designation.', '.$Deparment, $bo, 2, 'L', 0);
			    //$pdf->Cell(37, 5, $Deparment, $bo, 2, 'L', 0);

			    $pdf->SetXY(151.5, 160);
			    $pdf->Cell(37, 5, $now_date, $bo, 2, 'R', 0);
			    $pdf->Cell(37, 5, $hijri_date, $bo, 2, 'R', 0);

				$pdf->SetFont($font_name,'B',10);

				$pdf->SetXY(18.5, 190);
			    $pdf->Cell(165, 5, 'of Admission Offer ('.$GradeName.')', $bo, 2, 'C', 0);
			    $pdf->Cell(165, 5, $ApplicantName, $bo, 2, 'C', 0);

			}
		}

		// Output the new PDF
		$pdf->Output('xyz' . '.pdf', 'I');
	}
}