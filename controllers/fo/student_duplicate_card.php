<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Student_duplicate_card extends MY_Controller {
	public function __construct(){
		parent::__construct();				
	}


	public function index()
	{
		$this->form_validation->set_rules($this->validation_duplicatecard_student);

		if($this->form_validation->run() == FALSE){
			if(count($_POST))
			{
				$this->gs_id = $this->input->post('gs_id');
				$this->wef_date = $this->input->post('wef_date');				
			}

			$this->load->view('frontoffice/duplicate_card_student_form.php');
			$this->load->model('front_office/req_duplicatecard_model');
			$this->data['DuplicateCardData'] = $this->req_duplicatecard_model->getAllDuplicateCardData();
			$this->load->view('frontoffice/duplicate_card_student_info.php');
			$this->load->view('frontoffice/frontoffice_footer_orb.php');
		}else{
			$this->add();
		}	
	}


	public $validation_duplicatecard_student = array(		
		array('field' => 'gs_id', 'label' => 'GS-ID', 'rules' => 'trim|sanitize|required'),		
		array('field' => 'description', 'label' => 'Duplicated Card Reason', 'rules' => 'trim|sanitize|required'),
		array('field' => 'card_amount', 'label' => 'Duplicated Card Amount', 'rules' => 'trim|sanitize|required')		
	);



	public function add()
	{
		if(count($_POST))
		{
			$GSID = $this->input->post('gs_id');			
			$description = $this->input->post('description');
			$card_amount = $this->input->post('card_amount');
			$client_ip = "";
			$req_duplicatecard_id = 0;			


			/*******************************************************
			* IP Address
			* ******************************************************/
			if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			    $client_ip = $_SERVER['HTTP_CLIENT_IP'];
			} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			    $client_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			} else {
			    $client_ip = $_SERVER['REMOTE_ADDR'];
			}

			

			$this->load->model('front_office/req_duplicatecard_model');
			$StudentID = $this->req_duplicatecard_model->getStudentID($GSID);

			$StudentCardNo = 0;
			$StudentCardNo = $this->req_duplicatecard_model->getDuplicateCardNo($StudentID);
			if($StudentCardNo == "0"){
				$StudentCardNo = 1;
			}

			$data = array(
				'student_id' => $StudentID,
				'req_date' => date("Y-m-d"),				
				'description' => $description,
				'duplicate' => $StudentCardNo,
				'amount' => $card_amount,
				'ip' => $client_ip				
			);


			if($this->req_duplicatecard_model->isAlreadyReqGenerated_Today($StudentID) < 1) {
				$req_duplicatecard_id = $this->req_duplicatecard_model->save($data);
				$this->printForm($req_duplicatecard_id, $StudentCardNo);
			}

		}		
		
		redirect('/fo/student_duplicate_card');
	}


	public function printForm($duplicateCardReqID, $StudentCardNo)
	{		
		$ReqDuplicateCardID = $duplicateCardReqID;		
		$this->load->model('front_office/req_duplicatecard_model');
		$data['DuplicateCard'] = $this->req_duplicatecard_model->getDuplicateCardData($ReqDuplicateCardID);

		$req_id = $data['DuplicateCard'][0]['id'];
		$GSID = $data['DuplicateCard'][0]['gs_id'];
		$GRNO = $data['DuplicateCard'][0]['gr_no'];
		$gender = $data['DuplicateCard'][0]['gender'];
		$reason = $data['DuplicateCard'][0]['description'];
		$parentname = $data['DuplicateCard'][0]['name'];
		$parent = $data['DuplicateCard'][0]['parent_type'];
		$AbrigedName = $data['DuplicateCard'][0]['abridged_name'];

		$FatherName = "";
		if ($parent = "1"){
			$FatherName = $parentname;
		}

		$Grade = $data['DuplicateCard'][0]['grade_name'];
		$Section = $data['DuplicateCard'][0]['section_name'];
		$amount = $data['DuplicateCard'][0]['amount'];


		$this->makePDF($req_id, $GSID, $GRNO, $gender, $reason, $AbrigedName, $FatherName, $Grade, $Section, $amount, $StudentCardNo);		
	}


	public function printForm2()
	{		
		$ReqDuplicateCardID = $this->input->post('duplicate_card_id');
		$this->load->model('front_office/req_duplicatecard_model');
		$data['DuplicateCard'] = $this->req_duplicatecard_model->getDuplicateCardData($ReqDuplicateCardID);

		$req_id = $data['DuplicateCard'][0]['id'];
		$GSID = $data['DuplicateCard'][0]['gs_id'];
		$GRNO = $data['DuplicateCard'][0]['gr_no'];
		$gender = $data['DuplicateCard'][0]['gender'];
		$reason = $data['DuplicateCard'][0]['description'];
		$parentname = $data['DuplicateCard'][0]['name'];
		$parent = $data['DuplicateCard'][0]['parent_type'];
		$AbrigedName = $data['DuplicateCard'][0]['abridged_name'];
		$StudentCardNo = $data['DuplicateCard'][0]['duplicate'];

		$FatherName = "";
		if ($parent = "1"){
			$FatherName = $parentname;
		}

		$Grade = $data['DuplicateCard'][0]['grade_name'];
		$Section = $data['DuplicateCard'][0]['section_name'];
		$amount = $data['DuplicateCard'][0]['amount'];


		$this->makePDF($req_id, $GSID, $GRNO, $gender, $reason, $AbrigedName, $FatherName, $Grade, $Section, $amount, $StudentCardNo);		
	}



	public function makePDF($req_id, $GSID, $GRNO, $gender, $reason, $name, $FatherName, $Grade, $Section, $amount, $DuplicateCardNo){
		$UserName = ucwords($this->session->userdata['username']);

		// Overall Font Size
		$font_size = 10;
		$font_name = 'Helvetica';
		$gender_mark_size = 26;
		$now_date = date('d-M-Y');


		require_once('components/pdf/fpdf/fpdf.php');
		require_once('components/pdf/fpdi/fpdi.php');

		
		// initiate FPDI
		$pdf = new FPDI();

		// get the page count
		$pageCount = $pdf->setSourceFile('components/pdf/front_office/duplicate_card/req_student_card_printform.pdf');
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
	    		
	    		// Duplicate
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',10);
			    $pdf->SetXY(15, 19.5);
			    $pdf->MultiCell(35, 4, "Duplicate " . $DuplicateCardNo, 0, 'L', 0);

	    		// Request Date
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',10);
			    $pdf->SetXY(139, 19.5);
			    $pdf->MultiCell(35, 4, $now_date, 0, 'L', 0);

			    // Request No.
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',10);
			    $pdf->SetXY(193, 19.5);
			    $pdf->MultiCell(35, 4, str_pad($req_id, 3, "0", STR_PAD_LEFT), 0, 'L', 0);

			    // GS_ID
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',10);
			    $pdf->SetXY(42, 35.5);
			    $pdf->MultiCell(35, 4, $GSID, 0, 'L', 0);

			    // GR_No
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',10);
			    $pdf->SetXY(42, 40.8);
			    $pdf->MultiCell(35, 4, $GRNO, 0, 'L', 0);

			    // Gender
			    if ($gender == 'B')
			    {
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',10);
			    $pdf->SetXY(42, 45.5);
			    $pdf->Write(10, 'Boy');
			    }elseif($gender == 'G')
				{
				$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',10);
			    $pdf->SetXY(42, 45.5);
			    $pdf->Write(10, 'Girl');
			    }

			    // Reason
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',10);
			    $pdf->SetXY(42, 56.5);
			    $pdf->MultiCell(75, 4, $reason, 0, 'L', 0);

			    // Name
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',10);
			    $pdf->SetXY(136, 35.5);
			    $pdf->MultiCell(50, 4, $name, 0, 'L', 0);

			    // Father Name
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',10);
			    $pdf->SetXY(136, 40.8);
			    $pdf->MultiCell(50, 4, $FatherName, 0, 'L', 0);

			    // Grade and Section
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',10);
			    $pdf->SetXY(136, 48.5);
			    $pdf->MultiCell(50, 4, $Grade."-".$Section, 0, 'L', 0);

			    // Amount Charged
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',10);
			    $pdf->SetXY(136, 56.5);
			    $pdf->MultiCell(35, 4, $amount, 0, 'L', 0);


			    /****** For Account Use ******/

			    // GS_ID
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',10);
			    $pdf->SetXY(42, 96.5);
			    $pdf->MultiCell(35, 4, $GSID, 0, 'L', 0);

			    // GR_No
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',10);
			    $pdf->SetXY(42, 102);
			    $pdf->MultiCell(35, 4, $GRNO, 0, 'L', 0);

			    // Name
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',8);
			    $pdf->SetXY(42, 112.5);
			    $pdf->MultiCell(35, 4, $name, 0, 'L', 0);

			    // Grade and Section
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',10);
			    $pdf->SetXY(42, 118);
			    $pdf->MultiCell(50, 4, $Grade."-".$Section, 0, 'L', 0);

			    // Username
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',10);
			    $pdf->SetXY(42, 80.5);
			    $pdf->MultiCell(35, 4, $UserName, 0, 'L', 0);
			}
		}

		// Output the new PDF
		$pdf->Output($GSID . '-' . $name . '.pdf', 'D');
		//$pdf->Output();
	}
}