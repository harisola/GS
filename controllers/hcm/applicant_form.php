<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Applicant_form extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('hcm/applicant_form_model');						
	}

	public function index()
	{					
		if($this->data['can_user_add'] == 1){

			$this->form_validation->set_rules($this->applicant_form_model->validation);
								
			if($this->form_validation->run() == FALSE){
				if(count($_POST))
				{
					$position_applied = '';
					foreach ($this->input->post('hcm_all_position_tags') as $pos){
						$position_applied = $position_applied . ", " . $pos;
					}
					$position_applied = substr($position_applied, 2);					
					
					// storing the new applied information for new form
					$this->exists_applicant['full_name'] = ucwords(strtolower($this->input->post('applicant_name')));
					$this->exists_applicant['mobile_phone'] = $this->input->post('mobilephonereq');
					$this->exists_applicant['land_line'] = $this->input->post('landline');
					$this->exists_applicant['gender'] = $this->input->post('gender');
					$this->exists_applicant['position'] = ucwords($position_applied);
					$this->exists_applicant['nic'] = $this->input->post('cnic');

					// storing information for last applied form
					$this->exists_applicant['last_record'] = array($this->applicant_form_model->get_by(array('nic =' => $this->exists_applicant['nic'])));


					$this->load->view('hcm/staffing/applicant_form_exists_orb', $this->exists_applicant);
					$firstdate = date('Y-m-d 0:0:0');
					$firstdate = human_to_unix($firstdate);						
					$this->applicant_today_data['applicant_data'] = array($this->applicant_form_model->getAllApplicantForms_From($firstdate));
					$this->load->view('hcm/staffing/applicant_form_today_orb', $this->applicant_today_data['applicant_data']);

				}else{
					// load applicant form to add new applicants
					$this->load->view('hcm/staffing/applicant_form_add_orb');
					$firstdate = date('Y-m-d 0:0:0');				
					$firstdate = human_to_unix($firstdate);						
					$this->applicant_today_data['applicant_data'] = array($this->applicant_form_model->getAllApplicantForms_From($firstdate));				
					$this->load->view('hcm/staffing/applicant_form_today_orb', $this->applicant_today_data['applicant_data']);
				}
			}else{						
				$this->add();			
			}
		}


		/**
		* If user has view / edit / delete rights
		**/
		if($this->data['can_user_view'] == 1 || $this->data['can_user_edit'] == 1 || $this->data['can_user_delete'] == 1){
			$this->users_data['applicant_data'] = array($this->applicant_form_model->getAllApplicantForms());			
		}

		/*var_dump($this->data['can_user_view']);
		var_dump($this->data['can_user_edit']);
		var_dump($this->data['can_user_delete']);*/

		// if user has only view rights
		if($this->data['can_user_view'] == 1 && $this->data['can_user_edit'] == 0 && $this->data['can_user_delete'] == 0){
			// Loading applicant view according to rights
			$this->load->view('hcm/staffing/applicant_form_view_orb', $this->users_data['applicant_data']);
		}
		// if user has rights to edit the applicant data
		else if($this->data['can_user_view'] == 1 && $this->data['can_user_edit'] == 1 && $this->data['can_user_delete'] == 0){
			// Loading applicant view according to rights
			$this->load->view('hcm/staffing/applicant_form_edit_orb', $this->users_data['applicant_data']);
		}
		// if user has rights to remove the applicant data
		else if($this->data['can_user_view'] == 1 && $this->data['can_user_edit'] == 1 && $this->data['can_user_delete'] == 1){
			// Loading applicant view according to rights
			$this->load->view('hcm/staffing/applicant_form_delete_orb', $this->users_data['applicant_data']);
		}


		// Loading footer in the end
		$this->load->view('menus/menu_orb_footer');
	}

	public function refresh_now(){
		redirect($this->uri->uri_string());
	}

	public function edit()
	{
		$pk = $_POST['pk'];
	    $name = $_POST['name'];
	    $value = $_POST['value'];
	    $positionvalue = "";

	    if($name == 'position'){
	    	foreach($value as $thisvalue){
	    		$positionvalue .= $thisvalue . ", ";
	    	}
	    	$positionvalue = substr_replace($positionvalue, "", -2);
	    	$table_data = array(
		    	$name => $positionvalue
	    	);
	    }else{
		    $table_data = array(
		    	$name => $value
	    	);
	    }
    	//var_dump($table_data);
	    /*
	     Check submitted value
	    */
	    if(!empty($value)) {	        
	        $id = $this->applicant_form_model->save($table_data, $pk);	        
	        //print_r($_POST);
	    } else {
	        header('HTTP 400 Bad Request', true, 400);
	        echo "This field is required!";
	    }
	}

	public function printForm()
	{
		if(count($_POST))
		{

			$data = array(			
				'full_name' => ucwords(strtolower($this->input->post('full_name'))),
				'nic' => $this->input->post('nic'),
				'mobile_phone' => $this->input->post('mobile_phone'),
				'land_line' => $this->input->post('land_line'),
				'gender' => $this->input->post('gender'),
				'position' => ucwords($this->input->post('position'))
			);

			$form_id = $this->input->post('id');
			$name = ucwords($this->input->post('full_name'));
			$gender = $this->input->post('gender');
			$nic = $this->input->post('nic');
			$mobilephone = $this->input->post('mobile_phone');
			$landline =  $this->input->post('land_line');
			$position = ucwords($this->input->post('position'));

			$this->load->model('hcm/career_form_model');
			$formData = $this->career_form_model->getLastFormData($nic);
			$form_id = $formData[0]->gc_id;



			



			
			$this->getPDFNow($name, $gender, $nic, $mobilephone, $landline, $position, $form_id);
		}
	}

	public function getPDFNow($name, $gender, $nic, $mobilephone, $landline, $position, $form_id)
	{
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
		$pageCount = $pdf->setSourceFile('components/pdf/hcm/HRApplicantForm2.pdf');
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
	    		
	    		// position applied for
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',10);
			    $pdf->SetXY(161, 71);
			    $pdf->MultiCell(35, 4, $position, 0, 'L', 0);


	    		// Setting form number
	    		$pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',10);
			    $pdf->SetXY(117, 51);
			    $pdf->Write(8, 'Form # ');
			    $pdf->SetFont($font_name,'',12);
			    $pdf->SetXY(145, 51);					    
		    	$pdf->Cell(10, 8, $form_id, 0, 0, 'R', 0);

		    	// Todate
		    	$pdf->SetFont($font_name,'',12);
			    $pdf->SetXY(24, 51);				    
			    $pdf->Write(8, $now_date);

			    // applicant name is here
			    $pdf->SetFont($font_name);
			    $pdf->SetFont($font_name,'',$font_size);
			    $pdf->SetXY(17, 77.5);
			    $pdf->Write(8, ucwords(strtolower($name)));

			    // gender marking
			    if ($gender == 'M')
			    {
			    	$pdf->AddFont('wingdng2','','wingdng2.php');
				    $pdf->SetFont('wingdng2','',$gender_mark_size);
				    $pdf->SetXY(126, 78.2);
				    $pdf->Write(8, 'P');

			   	}else if($gender == 'F'){
			   		$pdf->AddFont('wingdng2','','wingdng2.php');
				    $pdf->SetFont('wingdng2','',$gender_mark_size);
				    $pdf->SetXY(144, 78.2);
				    $pdf->Write(8, 'P');
			   	}

			   	// cnic is here
			   	$pdf->SetFont($font_name);
			   	$pdf->SetFont($font_name,'',$font_size);
			    $pdf->SetXY(90.5, 130);
			    $pdf->Write(8, $nic);

			    // mobile phone number is here
			    $pdf->SetFont($font_name);
			   	$pdf->SetFont($font_name,'',$font_size);
			    $pdf->SetXY(90.5, 117);
			    $pdf->Write(8, $mobilephone);

			    // landline number is here
			    $pdf->SetFont($font_name);
			   	$pdf->SetFont($font_name,'',$font_size);
			    $pdf->SetXY(125.5, 117);
			    $pdf->Write(8, $landline);
			}
		}

		// Output the new PDF
		$pdf->Output($form_id . '-' . $name . '.pdf', 'D');
		//$pdf->Output();

	}

	public function add()
	{

		if(count($_POST))
		{			
			/**
			 * Insert applicant form data from POST values
			**/
			$position_applied = '';
			foreach ($this->input->post('hcm_all_position_tags') as $pos){
				$position_applied = $position_applied . ", " . $pos;
			}
			$position_applied = substr($position_applied, 2);
			
			$this->load->model('organization/users_in_branch_model');
			$branch['data'] = $this->users_in_branch_model->get_by(array('user_id' =>(int)$this->session->userdata('user_id')));

			$this->load->model('other/max_from_table');
			$branch_form_no = $this->max_from_table->get_max_value('hcm_staffing_applicantform', 'branch_form_no', 'branch_id', (int)$branch['data'][0]->branch_id);

			$data = array(
				'register_by' => (int)$this->session->userdata('user_id'),
				'full_name' => ucwords(strtolower($this->input->post('applicant_name'))),
				'nic' => $this->input->post('cnic'),
				'mobile_phone' => $this->input->post('mobilephonereq'),
				'land_line' => $this->input->post('landline'),
				'gender' => $this->input->post('gender'),
				'position' => ucwords($position_applied),
				'branch_id' => $branch['data'][0]->branch_id,
				'branch_form_no' => $branch_form_no + 1
			);			
			
			$form_id = 0;
			$form_id = (int)$this->applicant_form_model->save($data);			
	 			
			$name = ucwords($this->input->post('applicant_name'));
			$gender = $this->input->post('gender');
			$nic = $this->input->post('cnic');
			$mobilephone = $this->input->post('mobilephonereq');
			$landline =  $this->input->post('landline');
			$position = ucwords($position_applied);



			/*******************************************************
			* Online DB 
			* ******************************************************/
			$this->load->model('hcm/career_form_model');

			if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			    $ip = $_SERVER['HTTP_CLIENT_IP'];
			} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			} else {
			    $ip = $_SERVER['REMOTE_ADDR'];
			}
			
			$thisID = date('y-m');
			$GCID = $thisID . '/' . $this->career_form_model->generateGCID($thisID);
			$data = array (						
					'name' => ucwords(strtolower($this->input->post('applicant_name'))),
					'nic' =>  $this->input->post('cnic'),
					'mobile_phone' =>  $this->input->post('mobilephonereq'),
					'landline' => $this->input->post('landline'),
					'gender' => $this->input->post('gender'),
					'position_applied' => ucwords($position_applied),
					'ip' => $ip,					
					'gc_id' => $GCID,
					'shortlist_a' => "0",
					'shortlist_b' => "1"
				);



				/*******************************************************
				* Saving Form and Getting Form No
				* ******************************************************/
				$form_id = 0;
				$form_id = (int)$this->career_form_model->save($data);
				
			
			$this->getPDFNow($name, $gender, $nic, $mobilephone, $landline, $position, $GCID);
		}
	}

	public function add2()
	{

		if(count($_POST))
		{			
			/**
			 * Previous applied applicant form data
			**/
			if($this->input->post('exists_applicant_form_action') == "Last"){

				/*$form_id = $this->input->post('lastrecord_id');				
				$name = ucwords(strtolower($this->input->post('lastrecord_full_name')));
				$gender = $this->input->post('lastrecord_gender');
				$nic = $this->input->post('lastrecord_nic');
				$mobilephone = $this->input->post('lastrecord_mobile_phone');
				$landline =  $this->input->post('lastrecord_land_line');
				$position = $this->input->post('lastrecord_position');

				$this->getPDFNow($name, $gender, $nic, $mobilephone, $landline, $position, $form_id);	*/

				$image_path = $this->data['applicant_form_path'];
				$form_image[0] = $image_path . $this->input->post('lastrecord_id') . "_1.jpg";
				$form_image[1] = $image_path . $this->input->post('lastrecord_id') . "_2.jpg";
				$form_image[2] = $image_path . $this->input->post('lastrecord_id') . "_3.jpg";
				$form_image[3] = $image_path . $this->input->post('lastrecord_id') . "_4.jpg";
				$form_image[4] = $image_path . $this->input->post('lastrecord_id') . "_5.jpg";
				$file_name = $this->input->post('lastrecord_full_name');
				$file_id = $this->input->post('lastrecord_id');

				$this->generate_pdf_from_images($form_image, $file_id, $file_name);

			}else if($this->input->post('exists_applicant_form_action') == "New"){

				$firstdate = date('Y-m-d 0:0:0');				
				$firstdate = human_to_unix($firstdate);
				$today_entry['applicant'] = array($this->applicant_form_model->get_by(array('nic =' => $this->input->post('lastrecord_id'), 'created >=' => $firstdate)));
				
				$this->load->model('organization/users_in_branch_model');
				$branch['data'] = $this->users_in_branch_model->get_by(array('user_id' =>(int)$this->session->userdata('user_id')));

				$this->load->model('other/max_from_table');
				$branch_form_no = $this->max_from_table->get_max_value('hcm_staffing_applicantform', 'branch_form_no', 'branch_id', (int)$branch['data'][0]->branch_id);

				$data = array(
					'register_by' => (int)$this->session->userdata('user_id'),
					'full_name' => ucwords(strtolower($this->input->post('newrecord_full_name'))),
					'nic' => $this->input->post('newrecord_nic'),
					'mobile_phone' => $this->input->post('newrecord_mobile_phone'),
					'land_line' => $this->input->post('newrecord_land_line'),
					'gender' => $this->input->post('newrecord_gender'),
					'position' => ucwords($this->input->post('newrecord_position')),
					'branch_id' => $branch['data'][0]->branch_id,
					'branch_form_no' => $branch_form_no + 1
				);		

				$form_id = 0;
				$form_id = (int)$this->applicant_form_model->save($data);

				


				/*******************************************************
				* Online DB 
				* ******************************************************/
				$this->load->model('hcm/career_form_model');

				$ip = '';
				if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
				    $ip = $_SERVER['HTTP_CLIENT_IP'];
				} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
				    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
				} else {
				    $ip = $_SERVER['REMOTE_ADDR'];
				}
				
				$thisID = date('y-m');
				$GCID = $thisID . '/' . $this->career_form_model->generateGCID($thisID);
				$data = array (						
						'name' => ucwords(strtolower($this->input->post('newrecord_full_name'))),
						'nic' =>  $this->input->post('newrecord_nic'),
						'mobile_phone' =>  $this->input->post('newrecord_mobile_phone'),
						'landline' => $this->input->post('newrecord_land_line'),
						'gender' => $this->input->post('newrecord_gender'),
						'position_applied' => ucwords($this->input->post('newrecord_position')),
						'ip' => $ip,					
						'gc_id' => $GCID,
						'shortlist_a' => "0",
						'shortlist_b' => "1"
					);
				/*******************************************************
				* Saving Form and Getting Form No
				* ******************************************************/
				$form_id = 0;
				$form_id = (int)$this->career_form_model->save($data);






				$name = ucwords(strtolower($this->input->post('newrecord_full_name')));
				$gender = $this->input->post('newrecord_gender');
				$nic = $this->input->post('newrecord_nic');
				$mobilephone = $this->input->post('newrecord_mobile_phone');
				$landline =  $this->input->post('newrecord_land_line');
				$position = ucwords($this->input->post('newrecord_position'));				
				
				redirect('hcm/applicant_form');
				$this->getPDFNow($name, $gender, $nic, $mobilephone, $landline, $position, $form_id);
			}
		}		
	}

	public function generate_pdf_from_images($image_for_pdf, $file_id, $file_name )
	{
		// Overall Font Size
		$font_size = 10;
		$font_name = 'Helvetica';
		$gender_mark_size = 26;
		$now_date = date('d-M-Y');

		require_once('components/pdf/fpdf/fpdf.php');
		require_once('components/pdf/fpdi/fpdi.php');

		
		// initiate FPDF		
		$pdf = new FPDF('P','mm','A4');

		// Adding images to page
		$max = sizeof($image_for_pdf);
		for($i=0; $i < $max; $i++)
		{
			//pages		
			$pdf->AddPage();
			$pdf->Image($image_for_pdf[$i],0,0,210,300);
		}

		// Output the new PDF
		$pdf->Output($file_id . '-' . $file_name . '.pdf', 'D');
	}
}