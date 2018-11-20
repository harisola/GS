<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Admission_form_print_ajax extends CI_Controller{



	public function __construct(){
		parent::__construct();
		$this->load->library('session');
	}



	public function index(){
	}






	public function print_admission_assessment_slip(){
		$FormID = $this->input->GET('FormID');





		$this->load->model('admission/admission_form_issuance_model');
        $data['form_submission'] = $this->admission_form_issuance_model->getFormSubmissionData($FormID);

        //var_dump($data['form_issuance']);

        //$AdmissionSession = '2017-18';
        $FormNo = $data['form_submission'][0]->form_no;
        $OfficialName = $data['form_submission'][0]->official_name;
        $Grade = $data['form_submission'][0]->grade_name;
        $BatchCategory = $data['form_submission'][0]->batch_category;
        $Batch = $data['form_submission'][0]->batch;
        $Process = $data['form_submission'][0]->process;
        $DateTime = $data['form_submission'][0]->date_time;

        if ($Grade == 'A1' or $Grade == 'A2') {
        	$BatchCategory = '-';
        }

        // Overall Font Size
		$font_size = 10;
		$font_name = 'Arial';
		$gender_mark_size = 26;
		$now_date = date('d-M-Y');
		$now_time = date('h:i a');


		require_once('components/pdf/fpdf/fpdf.php');
		require_once('components/pdf/fpdi/fpdi.php');

		
		// initiate FPDI
		$pdf = new FPDI();

		// get the page count
		$pageCount = $pdf->setSourceFile('components/pdf/admission/ActionSlip(1819).pdf');
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

	    		
	    		// Grade
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',11	);
			    $pdf->SetXY(43, 53);
			    $pdf->Cell(34, 9, $Grade, $bo, 2, 'C', 0);

			    $pdf->SetXY(179, 53);
			    $pdf->Cell(34, 9, $Grade, $bo, 2, 'C', 0);

			    // From Number
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',11);
			    $pdf->SetXY(97, 53);
			    $pdf->Cell(32, 9, $FormNo, $bo, 0, 'C', 0);

			    $pdf->SetXY(233, 53);
			    $pdf->Cell(32, 9, $FormNo, $bo, 0, 'C', 0);

			    // Official Name
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',11);
			    $pdf->SetXY(43, 65);
			    $pdf->Cell(86, 9, $OfficialName, $bo, 0, 'C', 0);

			    $pdf->SetXY(179, 65);
			    $pdf->Cell(86, 9, $OfficialName, $bo, 0, 'C', 0);

			    // Process
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',11);
			    $pdf->SetXY(12.5, 87);
			    $pdf->Cell(62.5, 23, $Process, $bo, 0, 'C', 0);

			    $pdf->SetXY(148.5, 87);
			    $pdf->Cell(62.5, 23, $Process, $bo, 0, 'C', 0);

			    // Appointment Date and Time
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',11);
			    $pdf->SetXY(77.5, 87);
			    $pdf->Cell(51, 8, $DateTime, $bo, 0, 'C', 0);

			    $pdf->SetXY(213.5, 87);
			    $pdf->Cell(51, 8, $DateTime, $bo, 0, 'C', 0);

			    // Batch
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',11);
			    $pdf->SetXY(77.5, 101);
			    $pdf->Cell(51, 8, $BatchCategory, $bo, 0, 'C', 0);

			    $pdf->SetXY(213.5, 101);
			    $pdf->Cell(51, 8, $BatchCategory, $bo, 0, 'C', 0);
			    
			    // Today's Date
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'B',11);
			    $pdf->SetXY(95.5, 164.5);
			    $pdf->Cell(34, 7, $now_date, $bo, 2, 'C', 0);
			    $pdf->Cell(34, 7, $now_time, $bo, 0, 'C', 0);

			    $pdf->SetXY(231.5, 164.5);
			    $pdf->Cell(34, 7, $now_date, $bo, 2, 'C', 0);
			    $pdf->Cell(34, 7, $now_time, $bo, 0, 'C', 0);
			}
		}

		// Output the new PDF
		$pdf->Output('AssessmentSlip_' . '.pdf', 'I');
		//$pdf->Output();
    }







    public function batch_details(){
    	$BatchID = $this->input->GET('BatchID');


    	$this->load->model('admission/admission_batch_model');
        $data['admission_batch'] = $this->admission_batch_model->getbatchadmissiondetail($BatchID);

        //var_dump($data['admission_batch']);
		
		// Overall Font Size			
		$font_name = 'Helvetica';
		$now_date = date('d-M-Y');

        /***** Format *****/
        $Bsi_For = 'Basic Info';
        $Ast_For = 'Assessment';
        $Dis_For = 'Discussion';
        $Wil_For = 'WaitList';
        $Ofr_For = 'Offer';
        $Border_For = 1;
        $FontSize_For = 9;
        $X_For = 6;
        $Y_For = 5;
        $CW_For = 286;
        $CH_For = 5;
        /*********************/


        /***** Title *****/
        if(!empty($data['admission_batch'][0]->batch_category)){
        	$Bth_Tit = $data['admission_batch'][0]->batch_category;

        }
        else{
        	$Bth_Tit = '';
        }
        $Adm_Tit = 'Admission 2017';
        if(!empty($data['admission_batch'][0]->grade_name)){
        $Gde_Tit = $data['admission_batch'][0]->grade_name;	
        }
        else{
        	$Gde_Tit = '';
        }
        $Border_Tit = 0;
        $FontSize_Tit = 13;
        $X_Tit = 6;
        $Y_Tit = 13;
        $CW_Tit = 286;
        $CH_Tit = 5;
        /******************/


        /***** Column *****/
        $Sno_Col = 'Sr. No.';
        $Frm_Col = 'Form No.';
        $Obt_Col = 'Orgnl Batch';
        $Fbt_Col = 'Final Batch';
        $App_Col = ucwords(strtolower('Applicant Name'));
        $Fth_Col = ucwords(strtolower('Father Name'));
        $Isu_Col = 'Issue Date';
        $Sbt_Col = 'Submit Date';
        $Gdr_Col = 'Gender';
        $Sib_Col = 'Sibling';
        $Ast_Col = 'AST Appointment';
        $Ado_Col = 'AST Done On';
        $Aby_Col = 'AST By';
        $Rlt_Col = 'R';
        $Dec_Col = 'D';
        $Dis_Col = 'DIS Appointment';
        $Ddo_Col = 'DIS Done On';
        $Dby_Col = 'DIS By';
        $Wty_Col = 'WIL Type';
        $Wde_Col = 'WIL Decision';
        $Odt_Col = 'OFR Date';
        $Out_Col = 'Outcome';
        $Dat_Col = 'Date';
        $Border_Col = 1;
        $Border_Col2 = 0;
        $FontSize_Col = 7;
        $X_Col = 6;
        $Y_Col = 26;
        $CW_Col = 286;
        $CH_Col = 9;
        /******************/

        /***** Table Setup *******/
        $Border_Tbl = 1;
        $Border_Tbl2 = 0;
        $FontSize_Tbl = 8;
        $X_Tbl = 6;
        $Y_Tbl = 29;
        $CW_Tbl = 286;
        $CH_Tbl = 9;
        /************************/

        /***** Calculation Veriables *******/

        $Clc_InProcess = 0;
        $Clc_ReAllocated = 0;
        $Clc_Settled = 0;
        $Clc_Followup = 0;

        $Clc_boy = 0;
        $Clc_Girl = 0;

        $Clc_Sib = 0;
        $Clc_PetSib = 0;

        $Clc_AAplus = 0;
        $Clc_AA = 0;
        $Clc_AAminus = 0;
        $Clc_ABplus = 0;
        $Clc_AB = 0;
        $Clc_ABminus = 0;
        $Clc_AC = 0;
        $Clc_AD = 0;
        $Clc_ACfd = 0;
        $Clc_AWil = 0;
        $Clc_AOhd = 0;
        $Clc_ARgt = 0;

        $Clc_DAplus = 0;
        $Clc_DA = 0;
        $Clc_DAminus = 0;
        $Clc_DBplus = 0;
        $Clc_DB = 0;
        $Clc_DBminus = 0;
        $Clc_DC = 0;
        $Clc_DD = 0;
        $Clc_DOfr = 0;
        $Clc_DWil = 0;
        $Clc_DOhd = 0;
        $Clc_DRgt = 0;

        $Clc_TWil = 0;
        $Clc_TOhd = 0;
        $Clc_TCnf = 0;
        $Clc_TNit = 0;
        $Clc_TRgt = 0;
        $Clc_TInp = 0;
        $Clc_TAst = 0;
        $Clc_TDis = 0;
        $Clc_CNF = 0;

        $Border_Clc = 1;
        $Border_Clc2 = 0;
        $FontSize_Clc = 8;
        $X_Clc = '';
        $Y_Clc = '';
        $CW_Clc = '';
        $CH_Clc = '';
        /************************/


        


		require_once('components/pdf/fpdf/fpdf.php');
		require_once('components/pdf/fpdi/fpdi.php');

		// initiate FPDI			
		$pdf = new FPDI();
		$pdf->AddPage('L','A4');
		$pdf->SetMargins(0,0,0);
		$pdf->SetAutoPageBreak(0,0);


		/**************** Format ****************/

		$pdf->SetFont($font_name);
	    $pdf->SetFont($font_name,'',$FontSize_For);
	    $pdf->SetXY($X_For, $Y_For);
	    $pdf->Cell($CW_For/2.5, $CH_For, $Bsi_For, $Border_For, 0, 'C', 0);
	    $pdf->Cell($CW_For/5, $CH_For, $Ast_For, $Border_For, 0, 'C', 0);
	    $pdf->Cell($CW_For/5, $CH_For, $Dis_For, $Border_For, 0, 'C', 0);
	    $pdf->Cell($CW_For/13, $CH_For, $Wil_For, $Border_For, 0, 'C', 0);
	    $pdf->Cell($CW_For/8, $CH_For, $Ofr_For, $Border_For, 0, 'C', 0);

	    /****************************************/

	    /**************** Title ****************/

	    $pdf->SetFillColor(209,209,209);
		$pdf->SetFont($font_name);
	    $pdf->SetFont($font_name,'',$FontSize_For);
	    $pdf->SetXY($X_Tit, $Y_Tit);
	    $pdf->Cell($CW_Tit/3, $CH_Tit, 'Batch', $Border_Tit, 0, 'C', 1);

	    $pdf->SetFont($font_name,'B',$FontSize_Tit);
	    $pdf->Cell($CW_Tit/3, $CH_Tit, $Adm_Tit, $Border_Tit, 0, 'C', 1);

	    $pdf->SetFont($font_name,'',$FontSize_For);
	    $pdf->Cell($CW_Tit/3, $CH_Tit, 'Grade of Admission', $Border_Tit, 2, 'C', 1);

	    $pdf->SetFont($font_name,'B',$FontSize_Tit);
	    $pdf->SetXY($X_Tit, $Y_Tit+$CH_Tit);
	    $pdf->Cell($CW_Tit/3, $CH_Tit, $Bth_Tit, $Border_Tit, 0, 'C', 1);

	    $pdf->SetFont($font_name,'',$FontSize_For);
	    $pdf->Cell($CW_Tit/3, $CH_Tit, 'Batch Sheet for Admission Tracking', $Border_Tit, 0, 'C', 1);

	    $pdf->SetFont($font_name,'B',$FontSize_Tit);
	    $pdf->Cell($CW_Tit/3, $CH_Tit, $Gde_Tit, $Border_Tit, 0, 'C', 1);

	    /***************************************/

	    /**************** Column ****************/

	    //$pdf->SetFillColor(209,209,209);
		$pdf->SetFont($font_name);
	    $pdf->SetFont($font_name,'B',$FontSize_Col);
	    

	    
	    // Upper Left
	    $pdf->SetXY($X_Col, $Y_Col);
	    $pdf->Cell(($CW_Col/2.5)/8, $CH_Col/2, $Sno_Col, $Border_Col2, 0, 'L', 1);
	    $pdf->Cell(($CW_Col/2.5)/5, $CH_Col/2, $Obt_Col, $Border_Col2, 0, 'L', 1);
	    $pdf->Cell(($CW_Col/2.5)/3, $CH_Col/2, $App_Col, $Border_Col2, 0, 'L', 1);
	    $pdf->Cell(($CW_Col/2.5)/5, $CH_Col/2, $Isu_Col, $Border_Col2, 0, 'L', 1);
		$pdf->Cell(($CW_Col/2.5)/7, $CH_Col/2, $Gdr_Col, $Border_Col2, 0, 'L', 1);

		$pdf->Cell(($CW_Col/2.5)/2.8, $CH_Col/2, $Ast_Col, $Border_Col2, 0, 'C', 1);
		$pdf->Cell(($CW_Col/2.5)/7, $CH_Col/2, $Rlt_Col, $Border_Col2, 0, 'L', 1);

		$pdf->Cell(($CW_Col/2.5)/2.8, $CH_Col/2, $Dis_Col, $Border_Col2, 0, 'C', 1);
		$pdf->Cell(($CW_Col/2.5)/7, $CH_Col/2, $Rlt_Col, $Border_Col2, 0, 'L', 1);

		$pdf->Cell(($CW_Col/2.5)/5.25, $CH_Col/2, $Wty_Col, $Border_Col2, 0, 'L', 1);

		$pdf->Cell(($CW_Col/2.5)/6.4, $CH_Col/2, $Odt_Col, $Border_Col2, 0, 'L', 1);
		$pdf->Cell(($CW_Col/2.5)/6.4, $CH_Col/2, $Out_Col, $Border_Col2, 0, 'L', 1);

		//Lower Right
		$pdf->SetXY($X_Col, $Y_Col+$CH_Col/2);
		$pdf->Cell(($CW_Col/2.5)/8, $CH_Col/2, $Frm_Col, $Border_Col2, 0, 'R', 1);
	    $pdf->Cell(($CW_Col/2.5)/5, $CH_Col/2, $Fbt_Col, $Border_Col2, 0, 'R', 1);
	    $pdf->Cell(($CW_Col/2.5)/3, $CH_Col/2, $Fth_Col, $Border_Col2, 0, 'R', 1);
	    $pdf->Cell(($CW_Col/2.5)/5, $CH_Col/2, $Sbt_Col, $Border_Col2, 0, 'R', 1);
		$pdf->Cell(($CW_Col/2.5)/7, $CH_Col/2, $Sib_Col, $Border_Col2, 0, 'R', 1);

		$pdf->Cell(($CW_Col/2.5)/5.6, $CH_Col/2, $Ado_Col, $Border_Col2, 0, 'L', 1);
		$pdf->Cell(($CW_Col/2.5)/5.6, $CH_Col/2, $Aby_Col, $Border_Col2, 0, 'R', 1);
		$pdf->Cell(($CW_Col/2.5)/7, $CH_Col/2, $Dec_Col, $Border_Col2, 0, 'R', 1);

		$pdf->Cell(($CW_Col/2.5)/5.6, $CH_Col/2, $Ddo_Col, $Border_Col2, 0, 'L', 1);
		$pdf->Cell(($CW_Col/2.5)/5.6, $CH_Col/2, $Dby_Col, $Border_Col2, 0, 'R', 1);
		$pdf->Cell(($CW_Col/2.5)/7, $CH_Col/2, $Dec_Col, $Border_Col2, 0, 'R', 1);

		$pdf->Cell(($CW_Col/2.5)/5.25, $CH_Col/2, $Wde_Col, $Border_Col2, 0, 'R', 1);

		$pdf->Cell(($CW_Col/2.5)/6.4, $CH_Col/2, '', $Border_Col2, 0, 'R', 1);
		$pdf->Cell(($CW_Col/2.5)/6.4, $CH_Col/2, $Dat_Col, $Border_Col2, 0, 'R', 1);

		//Cell Formating
		$pdf->SetXY($X_Col, $Y_Col);
	    $pdf->Cell(($CW_Col/2.5)/8, $CH_Col, '', $Border_Col, 0, 'C', 0);
	    $pdf->Cell(($CW_Col/2.5)/5, $CH_Col, '', $Border_Col, 0, 'C', 0);
	    $pdf->Cell(($CW_Col/2.5)/3, $CH_Col, '', $Border_Col, 0, 'C', 0);
	    $pdf->Cell(($CW_Col/2.5)/5, $CH_Col, '', $Border_Col, 0, 'C', 0);
	    $pdf->Cell(($CW_Col/2.5)/7, $CH_Col, '', $Border_Col, 0, 'C', 0);
	    $pdf->Cell(($CW_Col/2.5)/2.8, $CH_Col, '', $Border_Col, 0, 'C', 0);
	    $pdf->Cell(($CW_Col/2.5)/7, $CH_Col, '', $Border_Col, 0, 'C', 0);
	    $pdf->Cell(($CW_Col/2.5)/2.8, $CH_Col, '', $Border_Col, 0, 'C', 0);
	    $pdf->Cell(($CW_Col/2.5)/7, $CH_Col, '', $Border_Col, 0, 'C', 0);
	    $pdf->Cell(($CW_Col/2.5)/5.25, $CH_Col, '', $Border_Col, 0, 'C', 0);
	    $pdf->Cell(($CW_Col/2.5)/6.4, $CH_Col, '', $Border_Col, 0, 'C', 0);
	    $pdf->Cell(($CW_Col/2.5)/6.4, $CH_Col, '', $Border_Col, 0, 'C', 0);

		/***************************************/

		$i = 1;
		$len = 1.5 + count($data['admission_batch']);
		foreach ($data['admission_batch'] as $data) {
			/***** Table Data *****/
			
	        $Sno_Tbl = $i;
	        $Frm_Tbl =	sprintf('%04d',$data->form_no);
	        $Obt_Tbl = '';
	        $Fbt_Tbl = '';
	        $App_Tbl = ucwords(strtolower($data->applicant_name));
	        $Fth_Tbl = ucwords(strtolower($data->father_name));
	        $Isu_Tbl = $data->form_issuance_date;
	        $Sbt_Tbl = $data->form_submission_date;
	        $Gdr_Tbl = $data->gender;
	        $Sib_Tbl = $data->pet_code;
	        $Sibling = $data->sibling;
	        $Ast_Tbl = $data->form_assessment_date;
	        $Ado_Tbl = $data->ast_done_on;
	        $Aby_Tbl = $data->ast_name_code;
	        $Art_Tbl = $data->form_assessment_result;
	        $Adc_Tbl = $data->form_assessment_decision;
	        $Dis_Tbl = $data->form_discussion_date;
	        $Ddo_Tbl = $data->dis_done_on;
	        $Dby_Tbl = $data->dis_name_code;
	        $Drt_Tbl = $data->form_discussion_result;
	        $Ddc_Tbl = $data->form_discussion_decision;
	        $Wty_Tbl = $data->weightage;
	        $Wde_Tbl = $data->wil_decision;
	        $Odt_Tbl = $data->OFFER;
	        $Out_Tbl = '';
	        $Dat_Tbl = $data->outcome_date;
	        $Stg_Tbl = $data->form_status_stage_id;
	        $Stg_CNF = $data->form_status_id;

	        /*if ($Stg_Tbl == 9){	$Wde_Tbl = 'WIL'; }
	        if ($Stg_Tbl == 8){	$Out_Tbl = 'OHD'; } */
	        if ($Stg_Tbl == 7){ $Out_Tbl = 'ABT'; }
	        if ($Stg_Tbl == 15){ $Out_Tbl = 'RGT'; }
	        if ($Stg_CNF >= 6){ $Out_Tbl = 'CNF'; }
	        /******************/

			/**************** Table ****************/


		    //$pdf->SetFillColor(209,209,209);
			$pdf->SetFont($font_name);
		    $pdf->SetFont($font_name,'',$FontSize_Tbl);
		    

		    
		    // Upper Left
		    $pdf->SetXY($X_Tbl, $Y_Tbl+($i*$CH_Tbl));
		    $pdf->Cell(($CW_Tbl/2.5)/8, ($CH_Tbl/2), $Sno_Tbl, $Border_Tbl2, 0, 'L', 0);
		    $pdf->Cell(($CW_Tbl/2.5)/5, $CH_Tbl/2, $Obt_Tbl, $Border_Tbl2, 0, 'L', 0);
		    $pdf->Cell(($CW_Tbl/2.5)/3, $CH_Tbl/2, $App_Tbl, $Border_Tbl2, 0, 'L', 0);
		    $pdf->Cell(($CW_Tbl/2.5)/5, $CH_Tbl/2, $Isu_Tbl, $Border_Tbl2, 0, 'L', 0);
			$pdf->Cell(($CW_Tbl/2.5)/7, $CH_Tbl/2, $Gdr_Tbl, $Border_Tbl2, 0, 'L', 0);

			$pdf->Cell(($CW_Tbl/2.5)/2.8, $CH_Tbl/2, $Ast_Tbl, $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Tbl/2.5)/7, $CH_Tbl/2, $Art_Tbl, $Border_Tbl2, 0, 'L', 0);

			$pdf->Cell(($CW_Tbl/2.5)/2.8, $CH_Tbl/2, $Dis_Tbl, $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Tbl/2.5)/7, $CH_Tbl/2, $Drt_Tbl, $Border_Tbl2, 0, 'L', 0);

			$pdf->Cell(($CW_Tbl/2.5)/5.25, $CH_Tbl/2, $Wty_Tbl, $Border_Tbl2, 0, 'L', 0);

			$pdf->Cell(($CW_Tbl/2.5)/6.4, $CH_Tbl/2, $Odt_Tbl, $Border_Tbl2, 0, 'L', 0);
			$pdf->Cell(($CW_Tbl/2.5)/6.4, $CH_Tbl/2, $Out_Tbl, $Border_Tbl2, 0, 'L', 0);

			//Lower Right
			$pdf->SetXY($X_Tbl, $Y_Tbl+$CH_Tbl/2+($i*$CH_Tbl));
			$pdf->Cell(($CW_Tbl/2.5)/8, $CH_Tbl/2, $Frm_Tbl, $Border_Tbl2, 0, 'R', 0);
		    $pdf->Cell(($CW_Tbl/2.5)/5, $CH_Tbl/2, $Fbt_Tbl, $Border_Tbl2, 0, 'R', 0);
		    $pdf->Cell(($CW_Tbl/2.5)/3, $CH_Tbl/2, $Fth_Tbl, $Border_Tbl2, 0, 'R', 0);
		    $pdf->Cell(($CW_Tbl/2.5)/5, $CH_Tbl/2, $Sbt_Tbl, $Border_Tbl2, 0, 'R', 0);
			$pdf->Cell(($CW_Tbl/2.5)/7, $CH_Tbl/2, $Sib_Tbl, $Border_Tbl2, 0, 'R', 0);

			$pdf->Cell(($CW_Tbl/2.5)/5.6, $CH_Tbl/2, $Ado_Tbl, $Border_Tbl2, 0, 'L', 0);
			$pdf->Cell(($CW_Tbl/2.5)/5.6, $CH_Tbl/2, $Aby_Tbl, $Border_Tbl2, 0, 'R', 0);
			$pdf->Cell(($CW_Tbl/2.5)/7, $CH_Tbl/2, $Adc_Tbl, $Border_Tbl2, 0, 'R', 0);

			$pdf->Cell(($CW_Tbl/2.5)/5.6, $CH_Tbl/2, $Ddo_Tbl, $Border_Tbl2, 0, 'L', 0);
			$pdf->Cell(($CW_Tbl/2.5)/5.6, $CH_Tbl/2, $Dby_Tbl, $Border_Tbl2, 0, 'R', 0);
			$pdf->Cell(($CW_Tbl/2.5)/7, $CH_Tbl/2, $Ddc_Tbl, $Border_Tbl2, 0, 'R', 0);

			$pdf->Cell(($CW_Tbl/2.5)/5.25, $CH_Tbl/2, $Wde_Tbl, $Border_Tbl2, 0, 'R', 0);

			$pdf->Cell(($CW_Tbl/2.5)/6.4, $CH_Tbl/2, '', $Border_Tbl2, 0, 'R', 0);
			$pdf->Cell(($CW_Tbl/2.5)/6.4, $CH_Tbl/2, $Dat_Tbl, $Border_Tbl2, 0, 'R', 0);

			//Cell Formating
			$pdf->SetXY($X_Tbl, $Y_Tbl+($i*$CH_Tbl));
		    $pdf->Cell(($CW_Tbl/2.5)/8, $CH_Tbl, '', $Border_Tbl, 0, 'C', 0);
		    $pdf->Cell(($CW_Tbl/2.5)/5, $CH_Tbl, '', $Border_Tbl, 0, 'C', 0);
		    $pdf->Cell(($CW_Tbl/2.5)/3, $CH_Tbl, '', $Border_Tbl, 0, 'C', 0);
		    $pdf->Cell(($CW_Tbl/2.5)/5, $CH_Tbl, '', $Border_Tbl, 0, 'C', 0);
		    $pdf->Cell(($CW_Tbl/2.5)/7, $CH_Tbl, '', $Border_Tbl, 0, 'C', 0);
		    $pdf->Cell(($CW_Tbl/2.5)/2.8, $CH_Tbl, '', $Border_Tbl, 0, 'C', 0);
		    $pdf->Cell(($CW_Tbl/2.5)/7, $CH_Tbl, '', $Border_Tbl, 0, 'C', 0);
		    $pdf->Cell(($CW_Tbl/2.5)/2.8, $CH_Tbl, '', $Border_Tbl, 0, 'C', 0);
		    $pdf->Cell(($CW_Tbl/2.5)/7, $CH_Tbl, '', $Border_Tbl, 0, 'C', 0);
		    $pdf->Cell(($CW_Tbl/2.5)/5.25, $CH_Tbl, '', $Border_Tbl, 0, 'C', 0);
		    $pdf->Cell(($CW_Tbl/2.5)/6.4, $CH_Tbl, '', $Border_Tbl, 0, 'C', 0);
		    $pdf->Cell(($CW_Tbl/2.5)/6.4, $CH_Tbl, '', $Border_Tbl, 2, 'C', 0);

		    /**************** Calculation Veriable *******************/
		    // Gender
		    if ($Gdr_Tbl == 'Boy'){ $Clc_boy++;	}
		    if ($Gdr_Tbl == 'Girl'){ $Clc_Girl++; }
		    // Sibling
		    if ($Sibling == 'Yes'){ $Clc_Sib++; }
		    if ($Sib_Tbl === 'Yes'){ $Clc_PetSib++; }
		    // Assessment Result
		    if ($Art_Tbl == 'A+'){ $Clc_AAplus++; }
		    if ($Art_Tbl == 'A'){ $Clc_AA++; }
		    if ($Art_Tbl == 'A-'){ $Clc_AAminus++; }
		    if ($Art_Tbl == 'B+'){ $Clc_ABplus++; }
		    if ($Art_Tbl == 'B'){ $Clc_AB++; }
		    if ($Art_Tbl == 'B-'){ $Clc_ABminus++; }
		    if ($Art_Tbl == 'C'){ $Clc_AC++; }
		    if ($Art_Tbl == 'D'){ $Clc_AD++; }
		    if ($Adc_Tbl == 'CFD'){ $Clc_ACfd++; }
		    if ($Adc_Tbl == 'WIL'){ $Clc_AWil++; }
		    if ($Adc_Tbl == 'OHD'){ $Clc_AOhd++; }
		    if ($Adc_Tbl == 'RGT'){ $Clc_ARgt++; }
		    
		    // Discussion Result
		    if ($Drt_Tbl == 'A+'){ $Clc_DAplus++; }
		    if ($Drt_Tbl == 'A'){ $Clc_DA++; }
		    if ($Drt_Tbl == 'A-'){ $Clc_DAminus++; }
		    if ($Drt_Tbl == 'B+'){ $Clc_DBplus++; }
		    if ($Drt_Tbl == 'B'){ $Clc_DB++; }
		    if ($Drt_Tbl == 'B-'){ $Clc_DBminus++; }
		    if ($Drt_Tbl == 'C'){ $Clc_DC++; }
		    if ($Drt_Tbl == 'D'){ $Clc_DD++; }
		    if ($Ddc_Tbl == 'OFR'){ $Clc_DOfr++; }
		    if ($Ddc_Tbl == 'WIL'){ $Clc_DWil++; }
		    if ($Ddc_Tbl == 'OHD'){ $Clc_DOhd++; }
		    if ($Ddc_Tbl == 'RGT'){ $Clc_DRgt++; }
		    $Clc_TDis = $Clc_DOfr + $Clc_DWil + $Clc_DOhd + $Clc_DRgt;

		    if ($data->and_id == 1){
		    	$Clc_ACfd = $Clc_TDis;
		    }
		    $Clc_TAst = $Clc_ACfd + $Clc_AWil + $Clc_AOhd + $Clc_ARgt;

		    if ($Stg_Tbl == 9 Or $Stg_Tbl == 17){ $Clc_TWil++; }
		    if ($Stg_Tbl == 8 Or $Stg_Tbl == 16){ $Clc_TOhd++; }
		    //if ($Stg_Tbl == 9){ $Clc_TCnf++; }
		    if ($Stg_Tbl == 5){ $Clc_Followup++; }
		    if ($Stg_Tbl == 7){ $Clc_TNit++; }
		    if ($Stg_Tbl == 15){ $Clc_TRgt++; }
		    if ($Stg_CNF >= 6){ $Clc_CNF++; }

		    $Clc_Settled = $Clc_CNF+$Clc_TRgt+$Clc_TNit;
		    $Clc_InProcess = ($len-1.5) - $Clc_Settled;


		    /********************************************************/

		    /*$pdf->SetXY($X_Tbl, $Y_Tbl+($CH_Tbl*$len));
		    $pdf->Cell(($CW_Tbl/2.5)/8, $CH_Tbl/1.5, '', $Border_Tbl, 0, 'C', 0);*/

		    $i++;

			/***************************************/
		}

		$X_Clc = $X_Tbl;
		$Y_Clc = $Y_Tbl+($CH_Tbl*$len);
		$CW_Clc = ($CW_Tbl/2.5);
		$CH_Clc = $CH_Tbl/1.5;

		// Calculation Header
		$pdf->SetFont($font_name,'B',$FontSize_Tbl);
		$pdf->SetXY($X_Clc, $Y_Clc);
		$pdf->Cell($CW_Clc/3.07, $CH_Clc/1.5, 'Applicants', $Border_Tbl, 0, 'C', 1);
		$pdf->Cell($CW_Clc/3, $CH_Clc/1.5, '', $Border_Tbl, 0, 'C', 1);
		$pdf->Cell($CW_Clc/2.93, $CH_Clc/1.5, 'Profile', $Border_Tbl, 0, 'C', 1);
		$pdf->Cell($CW_Clc/2, $CH_Clc/1.5, 'Assessment', $Border_Tbl, 0, 'C', 1);
		$pdf->Cell($CW_Clc/2, $CH_Clc/1.5, 'Discussion', $Border_Tbl, 0, 'C', 1);
		$pdf->Cell($CW_Clc/5.25, $CH_Clc/1.5, 'Intermediates', $Border_Tbl, 0, 'C', 1);
		$pdf->Cell($CW_Clc/3.2, $CH_Clc/1.5, 'Outcomes', $Border_Tbl, 0, 'C', 1);


		$X_Clc = $X_Tbl;
		$Y_Clc = $Y_Tbl+($CH_Tbl*$len)+($CH_Clc/1.5);
		$CW_Clc = ($CW_Tbl/2.5);
		$CH_Clc = $CH_Tbl/1.5;

		// Calculation First Line
		$pdf->SetFont($font_name,'',$FontSize_Tbl);
		$pdf->SetXY($X_Clc, $Y_Clc);
		$pdf->Cell(($CW_Clc/3.07)/2, $CH_Clc, 'Total Forms', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/3.07)/2, $CH_Clc, 'Settled', $Border_Tbl2, 0, 'C', 0);

		$pdf->Cell($CW_Clc/3, $CH_Clc, '', $Border_Tbl2, 0, 'C', 0);

		$pdf->Cell(($CW_Clc/2.93)/2, $CH_Clc, 'Girls', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2.93)/2, $CH_Clc, 'Boys', $Border_Tbl2, 0, 'C', 0);

		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, 'A+', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, 'A', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, 'A-', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, 'B+', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, 'B', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, 'B-', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, 'C', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, 'D', $Border_Tbl2, 0, 'C', 0);

		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, 'A+', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, 'A', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, 'A-', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, 'B+', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, 'B', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, 'B-', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, 'C', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, 'D', $Border_Tbl2, 0, 'C', 0);

		$pdf->Cell(($CW_Clc/5.25)/3, $CH_Clc, 'WL', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/5.25)/3, $CH_Clc, 'OH', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/5.25)/3, $CH_Clc, 'F/U', $Border_Tbl2, 0, 'C', 0);

		$pdf->Cell(($CW_Clc/3.2)/3, $CH_Clc, 'CNF', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/3.2)/3, $CH_Clc, 'RGT', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/3.2)/3, $CH_Clc, 'ABT', $Border_Tbl2, 0, 'C', 0);

		// Calculation Second Line
		$X_Clc = $X_Tbl;
		$Y_Clc = $Y_Tbl+($CH_Tbl*$len)+($CH_Clc*1.3);
		$CW_Clc = ($CW_Tbl/2.5);
		$CH_Clc = $CH_Tbl/1.5;

		$pdf->SetFont($font_name,'B',$FontSize_Tbl+1);
		$pdf->SetXY($X_Clc, $Y_Clc);
		$pdf->Cell(($CW_Clc/3.07)/2, $CH_Clc, ($len-1.5), $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/3.07)/2, $CH_Clc, $Clc_Settled, $Border_Tbl2, 0, 'C', 0);

		$pdf->Cell($CW_Clc/3, $CH_Clc, '', $Border_Tbl2, 0, 'C', 0);

		$pdf->Cell(($CW_Clc/2.93)/2, $CH_Clc, $Clc_Girl, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2.93)/2, $CH_Clc, $Clc_boy, $Border_Tbl2, 0, 'C', 0);

		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, $Clc_AAplus, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, $Clc_AA, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, $Clc_AAminus, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, $Clc_ABplus, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, $Clc_AB, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, $Clc_ABminus, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, $Clc_AC, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, $Clc_AD, $Border_Tbl2, 0, 'C', 0);

		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, $Clc_DAplus, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, $Clc_DA, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, $Clc_DAminus, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, $Clc_DBplus, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, $Clc_DB, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, $Clc_DBminus, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, $Clc_DC, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, $Clc_DD, $Border_Tbl2, 0, 'C', 0);

		$pdf->Cell(($CW_Clc/5.25)/3, $CH_Clc, $Clc_TWil, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/5.25)/3, $CH_Clc, $Clc_TOhd, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/5.25)/3, $CH_Clc, $Clc_Followup, $Border_Tbl2, 0, 'C', 0);

		$pdf->Cell(($CW_Clc/3.2)/3, $CH_Clc, $Clc_CNF, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/3.2)/3, $CH_Clc, $Clc_TRgt, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/3.2)/3, $CH_Clc, $Clc_TNit, $Border_Tbl2, 0, 'C', 0);

		// Calculation 3rd Line
		$X_Clc = $X_Tbl;
		$Y_Clc = $Y_Tbl+($CH_Tbl*$len)+($CH_Clc*2.1);
		$CW_Clc = ($CW_Tbl/2.5);
		$CH_Clc = $CH_Tbl/1.5;

		$pdf->SetFont($font_name,'',$FontSize_Tbl);
		$pdf->SetXY($X_Clc, $Y_Clc);
		$pdf->Cell(($CW_Clc/3.07)/2, $CH_Clc, 'Re-Allocated', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/3.07)/2, $CH_Clc, 'In Process', $Border_Tbl2, 0, 'C', 0);

		$pdf->Cell($CW_Clc/3, $CH_Clc, '', $Border_Tbl2, 0, 'C', 0);

		$pdf->Cell(($CW_Clc/2.93)/2, $CH_Clc, 'Siblings', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2.93)/2, $CH_Clc, "Pet's", $Border_Tbl2, 0, 'C', 0);

		$pdf->Cell(($CW_Clc/2)/3, $CH_Clc, "T ASS'D", $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/6, $CH_Clc, '> CFD', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/6, $CH_Clc, 'WL', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/6, $CH_Clc, '*OH*', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/6, $CH_Clc, 'TBR', $Border_Tbl2, 0, 'C', 0);

		$pdf->Cell(($CW_Clc/2)/3, $CH_Clc, "T DIS'D", $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/6, $CH_Clc, '> TBO', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/6, $CH_Clc, 'WL', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/6, $CH_Clc, '*OH*', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/6, $CH_Clc, 'TBR', $Border_Tbl2, 0, 'C', 0);

		$pdf->Cell(($CW_Clc/5.25), $CH_Clc, "OFR'D", $Border_Tbl2, 0, 'C', 0);

		$pdf->Cell(($CW_Clc/3.2), $CH_Clc, 'INP', $Border_Tbl2, 0, 'C', 0);

		// Calculation 4th Line
		$X_Clc = $X_Tbl;
		$Y_Clc = $Y_Tbl+($CH_Tbl*$len)+($CH_Clc*2.7);
		$CW_Clc = ($CW_Tbl/2.5);
		$CH_Clc = $CH_Tbl/1.5;

		$pdf->SetFont($font_name,'B',$FontSize_Tbl+1);
		$pdf->SetXY($X_Clc, $Y_Clc);
		$pdf->Cell(($CW_Clc/3.07)/2, $CH_Clc, $Clc_ReAllocated, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/3.07)/2, $CH_Clc, $Clc_InProcess, $Border_Tbl2, 0, 'C', 0);

		$pdf->Cell($CW_Clc/3, $CH_Clc, '', $Border_Tbl2, 0, 'C', 0);

		$pdf->Cell(($CW_Clc/2.93)/2, $CH_Clc, $Clc_Sib, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2.93)/2, $CH_Clc, ($Clc_Sib-$Clc_PetSib), $Border_Tbl2, 0, 'C', 0);

		$pdf->Cell(($CW_Clc/2)/3, $CH_Clc, $Clc_TAst, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/6, $CH_Clc, $Clc_ACfd, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/6, $CH_Clc, $Clc_AWil, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/6, $CH_Clc, $Clc_AOhd, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/6, $CH_Clc, $Clc_ARgt, $Border_Tbl2, 0, 'C', 0);

		$pdf->Cell(($CW_Clc/2)/3, $CH_Clc, $Clc_TDis, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/6, $CH_Clc, $Clc_DOfr, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/6, $CH_Clc, $Clc_DWil, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/6, $CH_Clc, $Clc_DOhd, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/6, $CH_Clc, $Clc_DRgt, $Border_Tbl2, 0, 'C', 0);

		$pdf->Cell(($CW_Clc/5.25), $CH_Clc, $Clc_DOfr, $Border_Tbl2, 0, 'C', 0);

		$pdf->Cell(($CW_Clc/3.2), $CH_Clc, $Clc_InProcess, $Border_Tbl2, 0, 'C', 0);

		// Formatting

		$X_Clc = $X_Tbl;
		$Y_Clc = $Y_Tbl+($CH_Tbl*$len);
		$CW_Clc = ($CW_Tbl/2.5);
		$CH_Clc = $CH_Tbl*2.5;

		$pdf->SetXY($X_Clc, $Y_Clc);
		$pdf->Cell($CW_Clc/3.07, $CH_Clc, '', $Border_Tbl, 0, 'C', 0);
		$pdf->Cell($CW_Clc/3, $CH_Clc, '', $Border_Tbl, 0, 'C', 0);
		$pdf->Cell($CW_Clc/2.93, $CH_Clc, '', $Border_Tbl, 0, 'C', 0);
		$pdf->Cell($CW_Clc/2, $CH_Clc, '', $Border_Tbl, 0, 'C', 0);
		$pdf->Cell($CW_Clc/2, $CH_Clc, '', $Border_Tbl, 0, 'C', 0);
		$pdf->Cell($CW_Clc/5.25, $CH_Clc, '', $Border_Tbl, 0, 'C', 0);
		$pdf->Cell($CW_Clc/3.2, $CH_Clc, '', $Border_Tbl, 0, 'C', 0);

		// Upper
		/*$pdf->SetXY($X_Clc, $Y_Clc);
		$pdf->Cell($CW_Clc/8, $CH_Clc, ($len-1.5).' Forms', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell($CW_Clc/5, $CH_Clc, $Clc_ReAllocated.' Re-Allocated', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell($CW_Clc/3, $CH_Clc, '', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell($CW_Clc/2.9, $CH_Clc, $Clc_boy.' Boys    '.$Clc_Girl.' Girls', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell($CW_Clc/2, $CH_Clc, $Clc_AAplus.'A+  '.$Clc_AA.'A  '.$Clc_AAminus.'A-    '.$Clc_ABplus.'B+  '.$Clc_AB.'B  '.$Clc_ABminus.'B-    '.$Clc_AC.'C  '.$Clc_AD.'D', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell($CW_Clc/2, $CH_Clc, $Clc_DAplus.'A+  '.$Clc_DA.'A  '.$Clc_DAminus.'A-    '.$Clc_DBplus.'B+  '.$Clc_DB.'B  '.$Clc_DBminus.'B-    '.$Clc_DC.'C  '.$Clc_DD.'D', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell($CW_Clc/5.25, $CH_Clc, 'Total WIL', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell($CW_Clc/3.2, $CH_Clc, 'CNF    NIT    RGT    INP', $Border_Tbl2, 0, 'C', 0);
		// Lower
		$pdf->SetXY($X_Clc, $Y_Clc+$CH_Clc);
		$pdf->Cell($CW_Clc/8, $CH_Clc, $Clc_InProcess.' In Pro', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell($CW_Clc/5, $CH_Clc, $Clc_Settled.' Settled', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell($CW_Clc/3, $CH_Clc, '', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell($CW_Clc/2.9, $CH_Clc, $Clc_Sib.' Siblings    '.$Clc_NonSib.' Non-Siblings', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell($CW_Clc/2, $CH_Clc, $Clc_ACfd.' CFD     '.$Clc_AWil.' WIL     '.$Clc_AOhd.' *OHD*   '.$Clc_ARgt.' RGT', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell($CW_Clc/2, $CH_Clc, $Clc_DOfr.' OFR     '.$Clc_DWil.' WIL     '.$Clc_DOhd.' *OHD*   '.$Clc_DRgt.' RGT', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell($CW_Clc/5.25, $CH_Clc, $Clc_TWil, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell($CW_Clc/3.2, $CH_Clc, $Clc_TCnf.'        '.$Clc_TNit.'        '.$Clc_TRgt.'        '.$Clc_TInp, $Border_Tbl2, 0, 'C', 0);
		// Formatting
		$pdf->SetXY($X_Clc, $Y_Clc);
		$pdf->Cell($CW_Clc/8, $CH_Clc*2, '', $Border_Tbl, 0, 'C', 0);
		$pdf->Cell($CW_Clc/5, $CH_Clc*2, '', $Border_Tbl, 0, 'C', 0);
		$pdf->Cell($CW_Clc/3, $CH_Clc*2, '', $Border_Tbl, 0, 'C', 0);
		$pdf->Cell($CW_Clc/2.9, $CH_Clc*2, '', $Border_Tbl, 0, 'C', 0);
		$pdf->Cell($CW_Clc/2, $CH_Clc*2, '', $Border_Tbl, 0, 'C', 0);
		$pdf->Cell($CW_Clc/2, $CH_Clc*2, '', $Border_Tbl, 0, 'C', 0);
		$pdf->Cell($CW_Clc/5.25, $CH_Clc*2, '', $Border_Tbl, 0, 'C', 0);
		$pdf->Cell($CW_Clc/3.2, $CH_Clc*2, '', $Border_Tbl, 0, 'C', 0);*/
	

		$this->load->model('staff/staff_registered_model');
		$this->data['staff_registered_data'] = $this->staff_registered_model->get_by(array('user_id' => (int)$this->session->userdata('user_id')));
	    if (!empty($this->data['staff_registered_data'][0])){
	    	$Username = ucwords($this->data['staff_registered_data'][0]->abridged_name);
	    } else {
	    	$Username = 'UserName';
		}
	    $pdf->SetTextColor(255,255,255);
	    $pdf->SetFont($font_name,'',7.5);
	    $pdf->SetFillColor(0,0,0);
	    $pdf->SetXY(233, 202);
	    $pdf->Cell(60, 4, date('D-d-M-Y H:i') . ' (' . $Username . ')', 0, 0, 'R', true);
	    
	    
		// Output the new PDF
		$pdf->Output($Bth_Tit . '.pdf', 'I');
    }





























    public function discussion_sheet(){
		$BatchID = $this->input->GET('BatchID');


		$this->load->model('admission/admission_batch_model');
        $data['admission_batch'] = $this->admission_batch_model->getbatchadmissiondetail($BatchID);

        //var_dump($data['admission_batch']);


        // Overall Font Size
		$font_size = 10;
		$font_name = 'Arial';
		$gender_mark_size = 26;
		$now_date = date('d-M-Y');
		$now_time = date('h:i a');


		require_once('components/pdf/fpdf/fpdf.php');
		require_once('components/pdf/fpdi/fpdi.php');

		
		// initiate FPDI
		$pdf = new FPDI();

		// get the page count
		if ($data['admission_batch'][0]->grade_id >= 10 and $data['admission_batch'][0]->grade_id <= 16){
			$pageCount = $pdf->setSourceFile('components/pdf/admission/DiscussionSheetSC(1819).pdf');
		}else{
			$pageCount = $pdf->setSourceFile('components/pdf/admission/DiscussionSheetNC(1819).pdf');
		}
		// Border On
		$bo = 0;



		// iterate through all pages
		for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
		    // import a page
		    $templateId = $pdf->importPage($pageNo);
		    // get the size of the imported page
		    $size = $pdf->getTemplateSize($templateId);

		    foreach ($data['admission_batch'] as $student) {

		    		// PDF write -- Variables are here

		    	$FormNo = $student->form_no;
		    	$GFID = $student->gf_id;
		    	$DisDate = $student->form_assessment_date;
		    	$Grade = $student->grade_name;
		    	$Batch = $student->batch_category;
		    	$BatchNum = $student->batch_slot_no;
		    	$ApplicantName = ucwords($student->applicant_name);
		    	$DOB = $student->dob;
		    	$FatherName = ucwords($student->father_name);
	    		$MotherName = ucwords($student->mother_name);

		    	// create a page (landscape or portrait depending on the imported page size)
			    if ($size['w'] > $size['h']) {
			        $pdf->AddPage('L', array($size['w'], $size['h']));
			    } else {
			        $pdf->AddPage('P', array($size['w'], $size['h']));
			    }		    

			    // use the imported page
		    	$pdf->useTemplate($templateId);

		    	if ($templateId == 1){
		    		
		    		$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'B',11	);

				    // Form #
				    $pdf->SetXY(105, 6.5);
				    $pdf->Cell(39, 7.5, $FormNo, $bo, 2, 'C', 0);

				    // GF-ID
				    $pdf->SetXY(163.5, 6.5);
				    $pdf->Cell(39, 7.5, $GFID, $bo, 2, 'C', 0);

				    // Discussion Date
				    $pdf->SetTextColor(255,255,255);
				    $pdf->SetXY(7, 15.7);
				    $pdf->Cell(72, 6.5, 'Date: '.$DisDate, $bo, 0, 'L', 0);
				    $pdf->Cell(52, 6.5, $Grade, $bo, 0, 'C', 0);
				    $pdf->Cell(72, 6.5, $Batch.'-'.$BatchNum, $bo, 2, 'R', 0);

				    // Applicat Name
				    $pdf->SetTextColor(0,0,0);
				    $pdf->SetXY(35, 23.7);
				    $pdf->Cell(109, 7.5, $ApplicantName, $bo, 2, 'C', 0);

				    // Date of Birth
				    $pdf->SetXY(163.5, 23.7);
				    $pdf->Cell(38.5, 7.5, $DOB, $bo, 2, 'C', 0);

				    // Father Name
				    $pdf->SetXY(35, 32.7);
				    $pdf->Cell(69, 7.5, $FatherName, $bo, 2, 'C', 0);

				    // Mother Name
				    $pdf->SetXY(130, 32.7);
				    $pdf->Cell(72, 7.5, $MotherName, $bo, 2, 'C', 0);

				    /*$pdf->SetXY(179, 53);
				    $pdf->Cell(34, 9, $Grade, $bo, 2, 'C', 0);
				    */
				}	
		    }
		}

		// Output the new PDF
		$pdf->Output('DiscussionSheet_' . '.pdf', 'I');
		//$pdf->Output();
    }



 	public function discussion_sheet_alevel(){
		$form_id = $this->input->GET('FormID');



		$this->load->model('admission/admission_batch_model');
        $data['admission_batch'] = $this->admission_batch_model->getbatchadmissiondetailAlevel($form_id);

        //var_dump($data['admission_batch']);


        // Overall Font Size
		$font_size = 10;
		$font_name = 'Arial';
		$gender_mark_size = 26;
		$now_date = date('d-M-Y');
		$now_time = date('h:i a');


		require_once('components/pdf/fpdf/fpdf.php');
		require_once('components/pdf/fpdi/fpdi.php');

		
		// initiate FPDI
		$pdf = new FPDI();

		// get the page count
		if ($data['admission_batch'][0]->grade_id >= 10 and $data['admission_batch'][0]->grade_id <= 16){
			$pageCount = $pdf->setSourceFile('components/pdf/admission/DiscussionSheetSC(1819).pdf');
		}else{
			$pageCount = $pdf->setSourceFile('components/pdf/admission/DiscussionSheetNC(1819).pdf');
		}
		// Border On
		$bo = 0;



		// iterate through all pages
		for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
		    // import a page
		    $templateId = $pdf->importPage($pageNo);
		    // get the size of the imported page
		    $size = $pdf->getTemplateSize($templateId);

		    foreach ($data['admission_batch'] as $student) {

		    		// PDF write -- Variables are here

		    	$FormNo = $student->form_no;
		    	$GFID = $student->gf_id;
		    	$DisDate = $student->form_assessment_date;
		    	$Grade = $student->grade_name;
		    	//$Batch = $student->batch_category;
		    	//$BatchNum = $student->batch_slot_no;
		    	$ApplicantName = ucwords($student->applicant_name);
		    	$DOB = $student->dob;
		    	$FatherName = ucwords($student->father_name);
	    		$MotherName = ucwords($student->mother_name);

		    	// create a page (landscape or portrait depending on the imported page size)
			    if ($size['w'] > $size['h']) {
			        $pdf->AddPage('L', array($size['w'], $size['h']));
			    } else {
			        $pdf->AddPage('P', array($size['w'], $size['h']));
			    }		    

			    // use the imported page
		    	$pdf->useTemplate($templateId);

		    	if ($templateId == 1){
		    		
		    		$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'B',11	);

				    // Form #
				    $pdf->SetXY(105, 6.5);
				    $pdf->Cell(39, 7.5, $FormNo, $bo, 2, 'C', 0);

				    // GF-ID
				    $pdf->SetXY(163.5, 6.5);
				    $pdf->Cell(39, 7.5, $GFID, $bo, 2, 'C', 0);

				    // Discussion Date
				    $pdf->SetTextColor(255,255,255);
				    $pdf->SetXY(7, 15.7);
				    $pdf->Cell(72, 6.5, 'Date: '.$DisDate, $bo, 0, 'L', 0);
				    $pdf->Cell(52, 6.5, $Grade, $bo, 0, 'C', 0);
				    $pdf->Cell(72, 6.5,'', $bo, 2, 'R', 0);

				    // Applicat Name
				    $pdf->SetTextColor(0,0,0);
				    $pdf->SetXY(35, 23.7);
				    $pdf->Cell(109, 7.5, $ApplicantName, $bo, 2, 'C', 0);

				    // Date of Birth
				    $pdf->SetXY(163.5, 23.7);
				    $pdf->Cell(38.5, 7.5, $DOB, $bo, 2, 'C', 0);

				    // Father Name
				    $pdf->SetXY(35, 32.7);
				    $pdf->Cell(69, 7.5, $FatherName, $bo, 2, 'C', 0);

				    // Mother Name
				    $pdf->SetXY(130, 32.7);
				    $pdf->Cell(72, 7.5, $MotherName, $bo, 2, 'C', 0);

				    /*$pdf->SetXY(179, 53);
				    $pdf->Cell(34, 9, $Grade, $bo, 2, 'C', 0);
				    */
				}	
		    }
		}

		// Output the new PDF
		$pdf->Output('DiscussionSheet_' . '.pdf', 'I');
		//$pdf->Output();
    }










































    public function assessment_sheet(){
		$BatchID = $this->input->GET('BatchID');


		$this->load->model('admission/admission_batch_model');
        $data['admission_batch'] = $this->admission_batch_model->getbatchadmissiondetail($BatchID);

        $Class = substr($BatchID, 0, 1);


        // Overall Font Size
		$font_size = 10;
		$font_name = 'Arial';
		$gender_mark_size = 26;
		$now_date = date('d-M-Y');
		$now_time = date('h:i a');


		require_once('components/pdf/fpdf/fpdf.php');
		require_once('components/pdf/fpdi/fpdi.php');

		
		// initiate FPDI
		$pdf = new FPDI();



		// get the page count
		if($Class=='A'){
			$pageCount = $pdf->setSourceFile('components/pdf/admission/AssessmentSheetPN(1718).pdf');
		}else if($Class=='B'){
			$pageCount = $pdf->setSourceFile('components/pdf/admission/AssessmentSheetN(1718).pdf');
		}
		// Border On
		$bo = 0;



		// iterate through all pages
		for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
		    // import a page
		    $templateId = $pdf->importPage($pageNo);
		    // get the size of the imported page
		    $size = $pdf->getTemplateSize($templateId);

		    foreach ($data['admission_batch'] as $student) {

		    		// PDF write -- Variables are here
		    	$ApplicantName = ucwords($student->applicant_name);
		    	$Batch = $student->batch_category;
		    	$BatchNum = $student->batch_slot_no;
		    	$AssDate = $student->simple_form_assessment_date;
		    	$Age = $student->age;

		    	// create a page (landscape or portrait depending on the imported page size)
			    if ($size['w'] > $size['h']) {
			        $pdf->AddPage('L', array($size['w'], $size['h']));
			    } else {
			        $pdf->AddPage('P', array($size['w'], $size['h']));
			    }		    

			    // use the imported page
		    	$pdf->useTemplate($templateId);

		    	if ($templateId == 1){

		    		
		    		$pdf->SetFont($font_name);
				    $pdf->SetFont($font_name,'',9	);
				    $pdf->SetXY(38, 3);
				    $pdf->Cell(50, 9, $ApplicantName, $bo, 2, 'C', 0);

				    $pdf->SetXY(129, 3);
				    $pdf->Cell(20, 9, $Age, $bo, 2, 'C', 0);

				    $pdf->SetXY(165, 3);
				    $pdf->Cell(15, 9, $Batch, $bo, 2, 'C', 0);

				    $pdf->SetXY(188, 3);
				    $pdf->Cell(15, 9, $AssDate, $bo, 2, 'L', 0);
				}	
		    }
		}

		// Output the new PDF
		$pdf->Output('DiscussionSheet_' . '.pdf', 'I');
		//$pdf->Output();
    }







    // Grade Wise Batch Summary
    public function batch_garde_summary(){
    	$GradeID = $this->input->GET('GradeID');
    	$OptionID = $this->input->GET('OptionID');


    	$this->load->model('admission/admission_batch_model');

    	if($OptionID==1){
        	$data['admission_batch'] = $this->admission_batch_model->get_batchwisegradesummary($GradeID);    		
    	}else if($OptionID==2){
        	$data['admission_batch'] = $this->admission_batch_model->get_GradeBatchSummary($GradeID);    		
    	}

        //var_dump($data['admission_batch']);
		
		// Overall Font Size			
		$font_name = 'Helvetica';
		$now_date = date('D d M @ h:i a');



        /***** Title *****/
        $Adm_Tit = 'Admission 2017';
        if(!empty($data['admission_batch'][0]->grade_name)){
        $Gde_Tit = $data['admission_batch'][0]->grade_name;	
        }
        else{
        	$Gde_Tit = '';
        }        

        

        /***** Calculation Veriables *******/
        $Border_Clc = 1;
        $Border_Clc2 = 0;
        $FontSize_Clc = 8;
        $X_Clc = '';
        $Y_Clc = '';
        $CW_Clc = '';
        $CH_Clc = '';


        $TForms = 0;
        $TInprocess = 0;
        $TReAllocated = 0;
        $TSettled = 0;

        $TGirls = 0;
        $TBoys = 0;
        $TSiblings = 0;
        $TPets = 0;

        $TAAP = 0;
        $TAA = 0;
        $TAAM = 0;
        $TABP = 0;
        $TAB = 0;
        $TABM = 0;
        $TAC = 0;
        $TAD = 0;
        $TASD = 0;
        $TACFD = 0;
        $TAWL = 0;
        $TAOH = 0;
        $TARGR = 0;

        $TDAP = 0;
        $TDA = 0;
        $TDAM = 0;
        $TDBP = 0;
        $TDB = 0;
        $TDBM = 0;
        $TDC = 0;
        $TDD = 0;
        $TDSC = 0;
        $TDOFR = 0;
        $TDWL = 0;
        $TDOH = 0;
        $TDRGR = 0;

        $TWL = 0;
        $TOH = 0;
        $TFU = 0;
        $TOFD = 0;

        $TCNF = 0;
        $TRGT = 0;
        $TNIT = 0;
        /************************/


        


		require_once('components/pdf/fpdf/fpdf.php');
		require_once('components/pdf/fpdi/fpdi.php');

		// initiate FPDI			
		$pdf = new FPDI();
		$pdf->aliasNbPages();
		$pdf->AddPage('L','A4');
		$pdf->SetMargins(0,0,0);
		$pdf->SetAutoPageBreak(true, 17);



		/***** Title Setup *******/
        $Border_Tit = 0;
        $FontSize_Tit = 12;
        $FontSize_Tit2 = 10;
        $X_Tit = 6;
        $Y_Tit = 5;
        $CW_Tit = 286;
        $CH_Tit = 6;
        /************************/
		

	    /**************** Title ****************/

	    $pdf->SetFillColor(209,209,209);
		$pdf->SetFont($font_name);
	    $pdf->SetFont($font_name,'',$FontSize_Tit2);
	    $pdf->SetXY($X_Tit, $Y_Tit);
	    if ($OptionID == 1){
	    	$pdf->Cell($CW_Tit/3, $CH_Tit, 'Batch Wise Summary', $Border_Tit, 0, 'C', 1);
		}else if ($OptionID == 2){
			$pdf->Cell($CW_Tit/3, $CH_Tit, 'Grade Wise Summary', $Border_Tit, 0, 'C', 1);
		}

	    $pdf->SetFont($font_name,'B',$FontSize_Tit);
	    $pdf->Cell($CW_Tit/3, $CH_Tit, $Adm_Tit, $Border_Tit, 0, 'C', 1);

	    $pdf->SetFont($font_name,'',$FontSize_Tit2);
	    $pdf->Cell($CW_Tit/3, $CH_Tit, 'Page No', $Border_Tit, 2, 'C', 1);

	    $pdf->SetFont($font_name,'B',$FontSize_Tit);
	    $pdf->SetXY($X_Tit, $Y_Tit+$CH_Tit);
	    $pdf->Cell($CW_Tit/3, $CH_Tit, $Gde_Tit, $Border_Tit, 0, 'C', 1);

	    $pdf->SetFont($font_name,'',$FontSize_Tit2);
	    $pdf->Cell($CW_Tit/3, $CH_Tit, 'as of '.$now_date, $Border_Tit, 0, 'C', 1);

	    $pdf->SetFont($font_name,'B',$FontSize_Tit);
	    $pdf->Cell($CW_Tit/3, $CH_Tit, '1', $Border_Tit, 0, 'C', 1);

	    /***************************************/


		/***** Table Setup *******/        
        $Border_Tbl = 1;
        $Border_Tbl2 = 0;
        $FontSize_Tbl = 8;
        $X_Tbl = 6;
        $Y_Tbl = 20;
        $CW_Tbl = 286;
        $CH_Tbl = 9;
        $CW_Clc = ($CW_Tbl/2.5);
		$CH_Clc = $CH_Tbl/1.5;
        /************************/

        // Calculation Header
			$pdf->SetFont($font_name,'B',$FontSize_Tbl);
			$pdf->SetXY($X_Tbl, $Y_Tbl);
			$pdf->Cell($CW_Clc/3.07, $CH_Clc/1.5, 'Applicants', $Border_Tbl, 0, 'C', 1);
			$pdf->Cell($CW_Clc/3, $CH_Clc/1.5, '', $Border_Tbl, 0, 'C', 1);
			$pdf->Cell($CW_Clc/2.93, $CH_Clc/1.5, 'Profile', $Border_Tbl, 0, 'C', 1);
			$pdf->Cell($CW_Clc/2, $CH_Clc/1.5, 'Assessment', $Border_Tbl, 0, 'C', 1);
			$pdf->Cell($CW_Clc/2, $CH_Clc/1.5, 'Discussion', $Border_Tbl, 0, 'C', 1);
			$pdf->Cell($CW_Clc/5.25, $CH_Clc/1.5, 'Intermediates', $Border_Tbl, 0, 'C', 1);
			$pdf->Cell($CW_Clc/3.23, $CH_Clc/1.5, 'Outcomes', $Border_Tbl, 0, 'C', 1);


		$PageNo = 1;
		$i = 1;
		$len = count($data['admission_batch']);

		foreach ($data['admission_batch'] as $data) {

			if ($i > 7){
				$i = 1;
				$pdf->AddPage('L','A4');


				$PageNo++;
				/***** Title Setup *******/
		        $Border_Tit = 0;
		        $FontSize_Tit = 12;
		        $FontSize_Tit2 = 10;
		        $X_Tit = 6;
		        $Y_Tit = 5;
		        $CW_Tit = 286;
		        $CH_Tit = 6;
		        /************************/
				

			    /**************** Title ****************/

			    $pdf->SetFillColor(209,209,209);
				$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',$FontSize_Tit2);
			    $pdf->SetXY($X_Tit, $Y_Tit);
			    if ($OptionID == 1){
			    	$pdf->Cell($CW_Tit/3, $CH_Tit, 'Batch Wise Summary', $Border_Tit, 0, 'C', 1);
				}else if ($OptionID == 2){
					$pdf->Cell($CW_Tit/3, $CH_Tit, 'Grade Wise Summary', $Border_Tit, 0, 'C', 1);
				}
			    $pdf->SetFont($font_name,'B',$FontSize_Tit);
			    $pdf->Cell($CW_Tit/3, $CH_Tit, $Adm_Tit, $Border_Tit, 0, 'C', 1);

			    $pdf->SetFont($font_name,'',$FontSize_Tit2);
			    $pdf->Cell($CW_Tit/3, $CH_Tit, 'Page No', $Border_Tit, 2, 'C', 1);

			    $pdf->SetFont($font_name,'B',$FontSize_Tit);
			    $pdf->SetXY($X_Tit, $Y_Tit+$CH_Tit);
			    $pdf->Cell($CW_Tit/3, $CH_Tit, $Gde_Tit, $Border_Tit, 0, 'C', 1);

			    $pdf->SetFont($font_name,'',$FontSize_Tit2);
			    $pdf->Cell($CW_Tit/3, $CH_Tit, 'as of '.$now_date, $Border_Tit, 0, 'C', 1);

			    $pdf->SetFont($font_name,'B',$FontSize_Tit);
			    $pdf->Cell($CW_Tit/3, $CH_Tit, $PageNo, $Border_Tit, 0, 'C', 1);

			    /***************************************/


				/***** Table Setup *******/        
		        $Border_Tbl = 1;
		        $Border_Tbl2 = 0;
		        $FontSize_Tbl = 8;
		        $X_Tbl = 6;
		        $Y_Tbl = 20;
		        $CW_Tbl = 286;
		        $CH_Tbl = 9;
		        $CW_Clc = ($CW_Tbl/2.5);
				$CH_Clc = $CH_Tbl/1.5;
		        /************************/

		        // Calculation Header
					$pdf->SetFont($font_name,'B',$FontSize_Tbl);
					$pdf->SetXY($X_Tbl, $Y_Tbl);
					$pdf->Cell($CW_Clc/3.07, $CH_Clc/1.5, 'Applicants', $Border_Tbl, 0, 'C', 1);
					$pdf->Cell($CW_Clc/3, $CH_Clc/1.5, '', $Border_Tbl, 0, 'C', 1);
					$pdf->Cell($CW_Clc/2.93, $CH_Clc/1.5, 'Profile', $Border_Tbl, 0, 'C', 1);
					$pdf->Cell($CW_Clc/2, $CH_Clc/1.5, 'Assessment', $Border_Tbl, 0, 'C', 1);
					$pdf->Cell($CW_Clc/2, $CH_Clc/1.5, 'Discussion', $Border_Tbl, 0, 'C', 1);
					$pdf->Cell($CW_Clc/5.25, $CH_Clc/1.5, 'Intermediates', $Border_Tbl, 0, 'C', 1);
					$pdf->Cell($CW_Clc/3.23, $CH_Clc/1.5, 'Outcomes', $Border_Tbl, 0, 'C', 1);
			}

			// Veriable
			$Clc_TotalForm = $data->total_forms;
			$Clc_InProcess = 0;
	        $Clc_ReAllocated = $data->re_allocated;
	        $Clc_Settled = 0;
	        $Clc_Followup = 0;

	        $Clc_Batch = $data->batch;
	        $Clc_BatchDate = $data->batch_date;

	        $Clc_boy = $data->gender_b;
	        $Clc_Girl = $data->gender_g;

	        $Clc_Sib = $data->siblings;
	        $Clc_PetSib = $data->pet;

	        $Clc_AAplus = $data->ass_ap;
	        $Clc_AA = $data->ass_a;
	        $Clc_AAminus = $data->ass_am;
	        $Clc_ABplus = $data->ass_bp;
	        $Clc_AB = $data->ass_b;
	        $Clc_ABminus = $data->ass_bm;
	        $Clc_AC = $data->ass_c;
	        $Clc_AD = $data->ass_d;
	        $Clc_ACfd = $data->ass_cfd;
	        $Clc_AWil = $data->ass_wl;
	        $Clc_AOhd = $data->ass_oh;
	        $Clc_ARgt = $data->ass_rgr + $data->ass_rgr_pre;

	        $Clc_DAplus = $data->dsc_ap;
	        $Clc_DA = $data->dsc_a;
	        $Clc_DAminus = $data->dsc_am;
	        $Clc_DBplus = $data->dsc_bp;
	        $Clc_DB = $data->dsc_b;
	        $Clc_DBminus = $data->dsc_bm;
	        $Clc_DC = $data->dsc_c;
	        $Clc_DD = $data->dsc_d;
	        $Clc_DOfr = $data->dsc_tbo + $data->inter_ofd + $data->adm_cnf + $data->dsc_total;
	        $Clc_DWil = $data->dsc_wl;
	        $Clc_DOhd = $data->dsc_oh;
	        $Clc_DRgt = $data->dsc_rgr + $data->dsc_rgr_pre;

	        $Clc_TWil = $data->inter_wl;
	        $Clc_TOhd = $data->inter_oh;
	        $Clc_TOfd = $data->inter_ofd + $data->adm_cnf;
	        $Clc_TCnf = 0;
	        $Clc_TNit = $data->ass_total + $data->dsc_total;
	        $Clc_TRgt = $data->ass_rgr + $data->dsc_rgr;
	        //$Clc_TInp = 0;

	        
	        $Clc_TAst = $Clc_AAplus + $Clc_AA + $Clc_AAminus + $Clc_ABplus + $Clc_AB + $Clc_ABminus + $Clc_AC + $Clc_AD;
	        $Clc_TDis = $Clc_DAplus + $Clc_DA + $Clc_DAminus + $Clc_DBplus + $Clc_DB + $Clc_DBminus + $Clc_DC + $Clc_DD;
	        $Clc_CNF = $data->adm_cnf;

	        if ($data->batch_case == 'AND'){
	        	$Clc_ACfd = $Clc_DOfr + $Clc_DWil + $Clc_DOhd + $Clc_DRgt;
	        }else if ($data->batch_case == 'ASO'){
	        	$Clc_ACfd = $data->ass_cfd + $Clc_TDis;
	        }

	        $Clc_Settled = $Clc_CNF + $Clc_TNit + $Clc_TRgt;
			$Clc_InProcess = $Clc_TotalForm - $Clc_Settled;
			

			$X_Clc = 6;
			$Y_Clc = 7 + ($CH_Tbl*2.5) * $i;
			$CW_Clc = ($CW_Tbl/2.5);
			$CH_Clc = $CH_Tbl/1.5;



			// Calculation First Line
			$pdf->SetTextColor(96,96,96);
			$pdf->SetFont($font_name,'',$FontSize_Tbl);
			$pdf->SetXY($X_Clc, $Y_Clc);
			$pdf->Cell(($CW_Clc/3.07)/2, $CH_Clc, 'T Forms Sub', $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/3.07)/2, $CH_Clc, 'In Process', $Border_Tbl2, 0, 'C', 0);

			$pdf->Cell($CW_Clc/3, $CH_Clc, '', $Border_Tbl2, 0, 'C', 0);

			$pdf->Cell(($CW_Clc/2.93)/2, $CH_Clc, 'Girls', $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/2.93)/2, $CH_Clc, 'Boys', $Border_Tbl2, 0, 'C', 0);

			$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, 'A+', $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, 'A', $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, 'A-', $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, 'B+', $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, 'B', $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, 'B-', $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, 'C', $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, 'D', $Border_Tbl2, 0, 'C', 0);

			$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, 'A+', $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, 'A', $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, 'A-', $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, 'B+', $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, 'B', $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, 'B-', $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, 'C', $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, 'D', $Border_Tbl2, 0, 'C', 0);

			$pdf->Cell(($CW_Clc/5.25)/3, $CH_Clc, 'WL', $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/5.25)/3, $CH_Clc, 'OH', $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/5.25)/3, $CH_Clc, 'F/U', $Border_Tbl2, 0, 'C', 0);

			$pdf->Cell(($CW_Clc/3.2)/3, $CH_Clc, "CNF'D", $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/3.2)/3, $CH_Clc, "RGT'D", $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/3.2)/3, $CH_Clc, "ABT'D", $Border_Tbl2, 0, 'C', 0);

			// Calculation Second Line
			$X_Clc = $X_Tbl;
			$Y_Clc = 11 + ($CH_Tbl*2.5) * $i;
			$CW_Clc = ($CW_Tbl/2.5);
			$CH_Clc = $CH_Tbl/1.5;

			$pdf->SetTextColor(0,0,0);
			$pdf->SetFont($font_name,'B',$FontSize_Tbl+1);
			$pdf->SetXY($X_Clc, $Y_Clc);
			$pdf->Cell(($CW_Clc/3.07)/2, $CH_Clc, $Clc_TotalForm, $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/3.07)/2, $CH_Clc, $Clc_InProcess, $Border_Tbl2, 0, 'C', 0);

			$pdf->SetFont($font_name,'B',$FontSize_Tbl+3);
			$pdf->Cell($CW_Clc/3, $CH_Clc, $Clc_Batch, $Border_Tbl2, 0, 'C', 0);

			$pdf->SetFont($font_name,'B',$FontSize_Tbl+1);
			$pdf->Cell(($CW_Clc/2.93)/2, $CH_Clc, $Clc_Girl, $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/2.93)/2, $CH_Clc, $Clc_boy, $Border_Tbl2, 0, 'C', 0);

			$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, $Clc_AAplus, $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, $Clc_AA, $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, $Clc_AAminus, $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, $Clc_ABplus, $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, $Clc_AB, $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, $Clc_ABminus, $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, $Clc_AC, $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, $Clc_AD, $Border_Tbl2, 0, 'C', 0);

			$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, $Clc_DAplus, $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, $Clc_DA, $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, $Clc_DAminus, $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, $Clc_DBplus, $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, $Clc_DB, $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, $Clc_DBminus, $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, $Clc_DC, $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, $Clc_DD, $Border_Tbl2, 0, 'C', 0);

			$pdf->Cell(($CW_Clc/5.25)/3, $CH_Clc, $Clc_TWil, $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/5.25)/3, $CH_Clc, $Clc_TOhd, $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/5.25)/3, $CH_Clc, $Clc_Followup, $Border_Tbl2, 0, 'C', 0);

			$pdf->Cell(($CW_Clc/3.2)/3, $CH_Clc, $Clc_CNF, $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/3.2)/3, $CH_Clc, $Clc_TRgt, $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/3.2)/3, $CH_Clc, $Clc_TNit, $Border_Tbl2, 0, 'C', 0);

			
			// Calculation 3rd Line
			$X_Clc = $X_Tbl;
			$Y_Clc = 17 + ($CH_Tbl*2.5) * $i;
			$CW_Clc = ($CW_Tbl/2.5);
			$CH_Clc = $CH_Tbl/1.5;

			$pdf->SetTextColor(96,96,96);
			$pdf->SetFont($font_name,'',$FontSize_Tbl);
			$pdf->SetXY($X_Clc, $Y_Clc);
			if ($OptionID == 2){
				$pdf->Cell(($CW_Clc/3.07)/2, $CH_Clc, '', $Border_Tbl2, 0, 'C', 0);
			}else {
				$pdf->Cell(($CW_Clc/3.07)/2, $CH_Clc, 'Re-Allocated', $Border_Tbl2, 0, 'C', 0);
			}
			$pdf->Cell(($CW_Clc/3.07)/2, $CH_Clc, 'Settled', $Border_Tbl2, 0, 'C', 0);

			$pdf->Cell($CW_Clc/3, $CH_Clc, $Clc_BatchDate, $Border_Tbl2, 0, 'C', 0);

			$pdf->Cell(($CW_Clc/2.93)/2, $CH_Clc, 'Siblings', $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/2.93)/2, $CH_Clc, "Pet's", $Border_Tbl2, 0, 'C', 0);

			$pdf->Cell(($CW_Clc/2)/3, $CH_Clc, "T ASS'D", $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/2)/6, $CH_Clc, '> CFD', $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/2)/6, $CH_Clc, 'WL', $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/2)/6, $CH_Clc, '*OH*', $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/2)/6, $CH_Clc, 'TBR', $Border_Tbl2, 0, 'C', 0);

			$pdf->Cell(($CW_Clc/2)/3, $CH_Clc, "T DIS'D", $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/2)/6, $CH_Clc, '> TBO', $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/2)/6, $CH_Clc, 'WL', $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/2)/6, $CH_Clc, '*OH*', $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/2)/6, $CH_Clc, 'TBR', $Border_Tbl2, 0, 'C', 0);

			$pdf->Cell(($CW_Clc/5.25), $CH_Clc, "OFR'D", $Border_Tbl2, 0, 'C', 0);

			$pdf->Cell(($CW_Clc/3.2), $CH_Clc, 'INP', $Border_Tbl2, 0, 'C', 0);

			// Calculation 4th Line
			$X_Clc = $X_Tbl;
			$Y_Clc = 21 + ($CH_Tbl*2.5) * $i;
			$CW_Clc = ($CW_Tbl/2.5);
			$CH_Clc = $CH_Tbl/1.5;

			$pdf->SetTextColor(0,0,0);
			$pdf->SetFont($font_name,'B',$FontSize_Tbl+1);
			$pdf->SetXY($X_Clc, $Y_Clc);
			if ($OptionID == 2){
				$pdf->Cell(($CW_Clc/3.07)/2, $CH_Clc, '', $Border_Tbl2, 0, 'C', 0);
			}else{
				$pdf->Cell(($CW_Clc/3.07)/2, $CH_Clc, $Clc_ReAllocated, $Border_Tbl2, 0, 'C', 0);
			}
			$pdf->Cell(($CW_Clc/3.07)/2, $CH_Clc, $Clc_Settled, $Border_Tbl2, 0, 'C', 0);

			$pdf->Cell($CW_Clc/3, $CH_Clc, '', $Border_Tbl2, 0, 'C', 0);

			$pdf->Cell(($CW_Clc/2.93)/2, $CH_Clc, $Clc_Sib, $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/2.93)/2, $CH_Clc, $Clc_PetSib, $Border_Tbl2, 0, 'C', 0);

			$pdf->Cell(($CW_Clc/2)/3, $CH_Clc, $Clc_TAst, $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/2)/6, $CH_Clc, $Clc_ACfd, $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/2)/6, $CH_Clc, $Clc_AWil, $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/2)/6, $CH_Clc, $Clc_AOhd, $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/2)/6, $CH_Clc, $Clc_ARgt, $Border_Tbl2, 0, 'C', 0);

			$pdf->Cell(($CW_Clc/2)/3, $CH_Clc, $Clc_TDis, $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/2)/6, $CH_Clc, $Clc_DOfr, $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/2)/6, $CH_Clc, $Clc_DWil, $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/2)/6, $CH_Clc, $Clc_DOhd, $Border_Tbl2, 0, 'C', 0);
			$pdf->Cell(($CW_Clc/2)/6, $CH_Clc, $Clc_DRgt, $Border_Tbl2, 0, 'C', 0);

			$pdf->Cell(($CW_Clc/5.25), $CH_Clc, $Clc_TOfd, $Border_Tbl2, 0, 'C', 0);

			$pdf->Cell(($CW_Clc/3.2), $CH_Clc, $Clc_InProcess, $Border_Tbl2, 0, 'C', 0);

			// Formatting

			$X_Clc = 6;
			$Y_Clc = 5 + ($CH_Tbl*2.5) * $i;
			$CW_Clc = ($CW_Tbl/2.5);
			$CH_Clc = $CH_Tbl*2.5;

			$pdf->SetXY($X_Clc, $Y_Clc);
			$pdf->Cell($CW_Clc/3.07, $CH_Clc, '', $Border_Tbl, 0, 'C', 0);
			$pdf->Cell($CW_Clc/3, $CH_Clc, '', $Border_Tbl, 0, 'C', 0);
			$pdf->Cell($CW_Clc/2.93, $CH_Clc, '', $Border_Tbl, 0, 'C', 0);
			$pdf->Cell($CW_Clc/2, $CH_Clc, '', $Border_Tbl, 0, 'C', 0);
			$pdf->Cell($CW_Clc/2, $CH_Clc, '', $Border_Tbl, 0, 'C', 0);
			$pdf->Cell($CW_Clc/5.25, $CH_Clc, '', $Border_Tbl, 0, 'C', 0);
			$pdf->Cell($CW_Clc/3.23, $CH_Clc, '', $Border_Tbl, 0, 'C', 0);


			$TForms += $Clc_TotalForm;
			$TInprocess += $Clc_InProcess;
	        $TReAllocated += $Clc_ReAllocated;
	        $TSettled += $Clc_Settled;

	        $TGirls += $Clc_Girl;
	        $TBoys += $Clc_boy;
	        $TSiblings += $Clc_Sib;
	        $TPets += $Clc_PetSib;

	        $TAAP += $Clc_AAplus;
	        $TAA += $Clc_AA;
	        $TAAM += $Clc_AAminus;
	        $TABP += $Clc_ABplus;
	        $TAB += $Clc_AB;
	        $TABM += $Clc_ABminus;
	        $TAC += $Clc_AC;
	        $TAD += $Clc_AD;
	        $TASD += $Clc_TAst;
	        $TACFD += $Clc_ACfd;
	        $TAWL += $Clc_AWil;
	        $TAOH += $Clc_AOhd;
	        $TARGR += $Clc_ARgt;

	        $TDAP += $Clc_DAplus;
	        $TDA += $Clc_DA;
	        $TDAM += $Clc_DAminus;
	        $TDBP += $Clc_DBplus;
	        $TDB += $Clc_DB;
	        $TDBM += $Clc_DBminus;
	        $TDC += $Clc_DC;
	        $TDD += $Clc_DD;
	        $TDSC += $Clc_TDis;
	        $TDOFR += $Clc_DOfr;
	        $TDWL += $Clc_DWil;
	        $TDOH += $Clc_DOhd;
	        $TDRGR += $Clc_DRgt;

	        $TWL += $Clc_TWil;
	        $TOH += $Clc_TOhd;
	        $TFU += 0;
	        $TOFD += $Clc_TOfd;

	        $TCNF += $Clc_CNF;
	        $TRGT += $Clc_TRgt;
	        $TNIT += $Clc_TNit;



		    $i++;

			/***************************************/
		}


		
		$X_Clc1 = $X_Tbl;
		$Y_Clc1 = $Y_Clc+($CH_Clc)+($len/$PageNo);
		$CW_Clc = ($CW_Tbl/2.5);
		$CH_Clc = $CH_Tbl/1.5;

		// Calculation First Line
		$pdf->SetTextColor(96,96,96);
		$pdf->SetFont($font_name,'',$FontSize_Tbl);
		$pdf->SetXY($X_Clc1, $Y_Clc1);
		$pdf->Cell(($CW_Clc/3.07)/2, $CH_Clc, 'T Forms Sub', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/3.07)/2, $CH_Clc, 'In Process', $Border_Tbl2, 0, 'C', 0);

		$pdf->Cell($CW_Clc/3, $CH_Clc, '', $Border_Tbl2, 0, 'C', 0);

		$pdf->Cell(($CW_Clc/2.93)/2, $CH_Clc, 'Girls', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2.93)/2, $CH_Clc, 'Boys', $Border_Tbl2, 0, 'C', 0);

		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, 'A+', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, 'A', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, 'A-', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, 'B+', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, 'B', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, 'B-', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, 'C', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, 'D', $Border_Tbl2, 0, 'C', 0);

		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, 'A+', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, 'A', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, 'A-', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, 'B+', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, 'B', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, 'B-', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, 'C', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, 'D', $Border_Tbl2, 0, 'C', 0);

		$pdf->Cell(($CW_Clc/5.25)/3, $CH_Clc, 'WL', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/5.25)/3, $CH_Clc, 'OH', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/5.25)/3, $CH_Clc, 'F/U', $Border_Tbl2, 0, 'C', 0);

		$pdf->Cell(($CW_Clc/3.2)/3, $CH_Clc, "CNF'D", $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/3.2)/3, $CH_Clc, "RGT'D", $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/3.2)/3, $CH_Clc, "ABT'D", $Border_Tbl2, 0, 'C', 0);

		// Calculation Second Line
		$pdf->SetTextColor(0,0,0);
		$X_Clc1 = $X_Tbl;
		$Y_Clc1 = $Y_Clc+($CH_Clc*4.5)+($len/$PageNo);
		$CW_Clc = ($CW_Tbl/2.5);
		$CH_Clc = $CH_Tbl/1.5;

		$pdf->SetFont($font_name,'B',$FontSize_Tbl+1);
		$pdf->SetXY($X_Clc1, $Y_Clc1);
		$pdf->Cell(($CW_Clc/3.07)/2, $CH_Clc, $TForms, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/3.07)/2, $CH_Clc, $TInprocess, $Border_Tbl2, 0, 'C', 0);

		$pdf->SetFont($font_name,'B',$FontSize_Tbl+3);
		$pdf->Cell($CW_Clc/3, $CH_Clc, $Gde_Tit, $Border_Tbl2, 0, 'C', 0);

		$pdf->SetFont($font_name,'B',$FontSize_Tbl+1);
		$pdf->Cell(($CW_Clc/2.93)/2, $CH_Clc, $TGirls, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2.93)/2, $CH_Clc, $TBoys, $Border_Tbl2, 0, 'C', 0);

		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, $TAAP, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, $TAA, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, $TAAM, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, $TABP, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, $TAB, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, $TABM, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, $TAC, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, $TAD, $Border_Tbl2, 0, 'C', 0);

		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, $TDAP, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, $TDA, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, $TDAM, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, $TDBP, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, $TDB, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, $TDBM, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, $TDC, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/8, $CH_Clc, $TDD, $Border_Tbl2, 0, 'C', 0);

		$pdf->Cell(($CW_Clc/5.25)/3, $CH_Clc, $TWL, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/5.25)/3, $CH_Clc, $TOH, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/5.25)/3, $CH_Clc, $TFU, $Border_Tbl2, 0, 'C', 0);

		$pdf->Cell(($CW_Clc/3.2)/3, $CH_Clc, $TCNF, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/3.2)/3, $CH_Clc, $TRGT, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/3.2)/3, $CH_Clc, $TNIT, $Border_Tbl2, 0, 'C', 0);
		
		// Calculation 3rd Line
		$pdf->SetTextColor(96,96,96);
		$X_Clc1 = $X_Tbl;
		$Y_Clc1 = $Y_Clc+($CH_Clc*5.5)+($len/$PageNo);
		$CW_Clc = ($CW_Tbl/2.5);
		$CH_Clc = $CH_Tbl/1.5;

		$pdf->SetFont($font_name,'',$FontSize_Tbl);
		$pdf->SetXY($X_Clc1, $Y_Clc1);
		if ($OptionID == 2){
			$pdf->Cell(($CW_Clc/3.07)/2, $CH_Clc, '', $Border_Tbl2, 0, 'C', 0);
		}else {
			$pdf->Cell(($CW_Clc/3.07)/2, $CH_Clc, 'Re-Allocated', $Border_Tbl2, 0, 'C', 0);
		}
		$pdf->Cell(($CW_Clc/3.07)/2, $CH_Clc, 'Settled', $Border_Tbl2, 0, 'C', 0);

		$pdf->Cell($CW_Clc/3, $CH_Clc, '', $Border_Tbl2, 0, 'C', 0);

		$pdf->Cell(($CW_Clc/2.93)/2, $CH_Clc, 'Siblings', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2.93)/2, $CH_Clc, "Pet's", $Border_Tbl2, 0, 'C', 0);

		$pdf->Cell(($CW_Clc/2)/3, $CH_Clc, "T ASS'D", $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/6, $CH_Clc, '> CFD', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/6, $CH_Clc, 'WL', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/6, $CH_Clc, '*OH*', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/6, $CH_Clc, 'TBR', $Border_Tbl2, 0, 'C', 0);

		$pdf->Cell(($CW_Clc/2)/3, $CH_Clc, "T DIS'D", $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/6, $CH_Clc, '> TBO', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/6, $CH_Clc, 'WL', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/6, $CH_Clc, '*OH*', $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/6, $CH_Clc, 'TBR', $Border_Tbl2, 0, 'C', 0);

		$pdf->Cell(($CW_Clc/5.25), $CH_Clc, "OFR'D", $Border_Tbl2, 0, 'C', 0);

		$pdf->Cell(($CW_Clc/3.2), $CH_Clc, 'INP', $Border_Tbl2, 0, 'C', 0);
		
		// Calculation 4th Line
		$pdf->SetTextColor(0,0,0);
		$X_Clc1 = $X_Tbl;
		$Y_Clc1 = $Y_Clc+($CH_Clc*6.2)+($len/$PageNo);
		$CW_Clc = ($CW_Tbl/2.5);
		$CH_Clc = $CH_Tbl/1.5;

		$pdf->SetFont($font_name,'B',$FontSize_Tbl+1);
		$pdf->SetXY($X_Clc1, $Y_Clc1);
		if ($OptionID == 2){
			$pdf->Cell(($CW_Clc/3.07)/2, $CH_Clc, '', $Border_Tbl2, 0, 'C', 0);
		}else{
			$pdf->Cell(($CW_Clc/3.07)/2, $CH_Clc, $TReAllocated, $Border_Tbl2, 0, 'C', 0);
		}
		$pdf->Cell(($CW_Clc/3.07)/2, $CH_Clc, $TSettled, $Border_Tbl2, 0, 'C', 0);

		$pdf->Cell($CW_Clc/3, $CH_Clc, '', $Border_Tbl2, 0, 'C', 0);

		$pdf->Cell(($CW_Clc/2.93)/2, $CH_Clc, $TSiblings, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2.93)/2, $CH_Clc, $TPets, $Border_Tbl2, 0, 'C', 0);

		$pdf->Cell(($CW_Clc/2)/3, $CH_Clc, $TASD, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/6, $CH_Clc, $TACFD, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/6, $CH_Clc, $TAWL, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/6, $CH_Clc, $TAOH, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/6, $CH_Clc, $TARGR, $Border_Tbl2, 0, 'C', 0);

		$pdf->Cell(($CW_Clc/2)/3, $CH_Clc, $TDSC, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/6, $CH_Clc, $TDOFR, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/6, $CH_Clc, $TDWL, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/6, $CH_Clc, $TDOH, $Border_Tbl2, 0, 'C', 0);
		$pdf->Cell(($CW_Clc/2)/6, $CH_Clc, $TDRGR, $Border_Tbl2, 0, 'C', 0);

		$pdf->Cell(($CW_Clc/5.25), $CH_Clc, $TOFD, $Border_Tbl2, 0, 'C', 0);

		$pdf->Cell(($CW_Clc/3.2), $CH_Clc, $TInprocess, $Border_Tbl2, 0, 'C', 0);

		// Formatting

		$X_Clc1 = $X_Tbl;
		$Y_Clc1 = $Y_Clc+($CH_Clc*3.5)+($len/$PageNo);
		$CW_Clc = ($CW_Tbl/2.5);
		$CH_Clc = $CH_Tbl*2.5;

		$pdf->SetXY($X_Clc1, $Y_Clc1);
		$pdf->Cell($CW_Clc/3.07, $CH_Clc, '', $Border_Tbl, 0, 'C', 0);
		$pdf->Cell($CW_Clc/3, $CH_Clc, '', $Border_Tbl, 0, 'C', 0);
		$pdf->Cell($CW_Clc/2.93, $CH_Clc, '', $Border_Tbl, 0, 'C', 0);
		$pdf->Cell($CW_Clc/2, $CH_Clc, '', $Border_Tbl, 0, 'C', 0);
		$pdf->Cell($CW_Clc/2, $CH_Clc, '', $Border_Tbl, 0, 'C', 0);
		$pdf->Cell($CW_Clc/5.25, $CH_Clc, '', $Border_Tbl, 0, 'C', 0);
		$pdf->Cell($CW_Clc/3.2, $CH_Clc, '', $Border_Tbl, 0, 'C', 0);
	

		$this->load->model('staff/staff_registered_model');
		$this->data['staff_registered_data'] = $this->staff_registered_model->get_by(array('user_id' => (int)$this->session->userdata('user_id')));
	    if (!empty($this->data['staff_registered_data'][0])){
	    	$Username = ucwords($this->data['staff_registered_data'][0]->abridged_name);
	    } else {
	    	$Username = 'UserName';
		}
	    $pdf->SetTextColor(255,255,255);
	    $pdf->SetFont($font_name,'',7.5);
	    $pdf->SetFillColor(0,0,0);
	    $pdf->SetXY(233, 189);
	    $pdf->Cell(60, 4, date('D-d-M-Y H:i') . ' (' . $Username . ')', 0, 0, 'R', true);
	    
	    
		// Output the new PDF
		$pdf->Output($Gde_Tit . '.pdf', 'I');
    }
}