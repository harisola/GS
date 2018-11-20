<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Interaction_hr extends MY_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->model('hcm/career_form_model');
		$this->load->model('hcm/career_form_uni_model');
		$this->load->model('hcm/career_form_emp_model');
		$this->load->model('hcm/career_form_interaction_flow');
	    $this->load->model('hcm/career_form_interaction_send_received');
	}

	public function index()
	{
		// if user has rights to edit the applicant data
		if($this->data['can_user_view'] == 1 && $this->data['can_user_edit'] == 1 && $this->data['can_user_delete'] == 0){

			$this->online['applicant_data'] = array($this->career_form_model->getStage2HRFormData());
			$this->load->view('hcm/career/career_stage2_interaction_hr');
		}

		// Loading footer in the end		
		$this->load->view('hcm/career/career_view_forms_footer');
	}

	public function printForm()
	{
		if(count($_POST))
		{
			$GCID = $this->input->post('id');
			$converted_GCID = str_replace("-", "", $GCID);
			$converted_GCID = str_replace("/", "_", $converted_GCID);

			$image_path = $this->data['applicant_form_path2'];
			$form_image[0] = $image_path . $converted_GCID . "_1.jpg";
			$form_image[1] = $image_path . $converted_GCID . "_2.jpg";
			/*$form_image[2] = $image_path . $this->input->post('id') . "_3.jpg";
			$form_image[3] = $image_path . $this->input->post('id') . "_4.jpg";
			$form_image[4] = $image_path . $this->input->post('id') . "_5.jpg";*/
			$file_name = $this->input->post('name');
			$file_id = $GCID;		

			$this->generate_pdf_from_images($form_image, $file_id, $file_name);
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
		$pdf = new FPDF('L','mm','A3');

		// Adding images to page
		$max = sizeof($image_for_pdf);
		for($i=0; $i < $max; $i++)
		{
			//pages		
			$pdf->AddPage();

			// for A-3
			$pdf->Image($image_for_pdf[$i],0,0,420,297);


			// for A-4
			/*
			$im = imagecreatefromjpeg($image_for_pdf[$i]);
			$size = min(imagesx($im), imagesy($im));
			$im2 = imagecrop($im, ['x' => 0, 'y' => 0, 'width' => $size, 'height' => $size]);
			if ($im2 !== FALSE) {
			    $pdf->Image($im2,0,0,420,297);
			}*/
		}

		// Output the new PDF
		$pdf->Output($file_id . '-' . $file_name . '.pdf', 'I');
	}


	public function edit()
	{
		$pk = $_POST['pk'];
	    $name = $_POST['name'];
	    $value = $_POST['value'];
	    
		$table_data = array(
		$name => $value
		);

		//var_dump($table_data);
		/*
		Check submitted value
		*/
	    if(!empty($value)) {	        
	        $id = $this->career_form_model->save($table_data, $pk);	        

	        if($value != 1){
	        	$table_data = array('applicant_status_alive' => 0);
	        	$id = $this->career_form_model->save($table_data, $pk);
	        }else{
	        	$table_data = array('applicant_status_alive' => 1);
	        	$id = $this->career_form_model->save($table_data, $pk);
	        }
	        //print_r($_POST);
	    } else {
	        header('HTTP 400 Bad Request', true, 400);
	        echo "This field is required!";
	    }
	}


	public function edit2(){
		if(count($_POST))
		{
			$this->load->model('hcm/career_form_interaction_send_received');
			$form_received_id = $this->input->post('form_received_id');
			$now = date('Y-m-d H:i:s');
			$data = array(				
				'form_received_datetime' => human_to_unix($now),
				'form_location' => 0, // Received by IC
			);

			$flow_id = (int)$this->career_form_interaction_send_received->save($data, $form_received_id);			
			redirect('/hcm/interaction_hr', 'refresh');
		}
	}


	public function add(){
		if(count($_POST))
		{
			$tags="";
			if(empty($this->input->post('tag'))){
				$tags = "";
			}else{
				$tags = substr(implode(', ', $this->input->post('tag')), 0);
			}

			$data = array(
				'career_id' => $this->input->post('career_id'),
				'forward_interaction_centre_id' => $this->input->post('interaction_centre_id'),
				'forward_interaction_id' => $this->input->post('interaction_id'),
				'forward_grade_id' => $this->input->post('grade_id'),
				'forward_comments' => $this->input->post('forward_comments'),
				'forward_tags' => $tags
			);

			$flow_id = (int)$this->career_form_interaction_flow->save($data);
			redirect('/hcm/interaction_hr', 'refresh');
		}
	}


	public function add2(){
		if(count($_POST))
		{
			$now = date('Y-m-d H:i:s');
			$data = array(
				'career_id' => $this->input->post('career_id'),
				'form_location' => 1,    // in transit from HR to IC
				'form_send_interaction_center_id' => $this->input->post('interaction_centre_id'),
				'form_send_datetime' => human_to_unix($now)
			);

			$flow_id = (int)$this->career_form_interaction_send_received->save($data);			
			redirect('/hcm/interaction_hr', 'refresh');
		}
	}
}
