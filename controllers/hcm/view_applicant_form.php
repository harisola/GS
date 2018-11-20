<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class View_applicant_form extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('hcm/applicant_form_model');
		$this->users_data['applicant_data'] = array($this->applicant_form_model->get());
	}

	public function index()
	{
		// if user has rights to edit the applicant data
		if($this->data['can_user_view'] == 1 && $this->data['can_user_edit'] == 1 && $this->data['can_user_delete'] == 0){
			// Loading applicant view according to rights
			$this->load->view('hcm/View_applicant_forms/applicant_forms_all_view_orb');
		}
		// Loading footer in the end
		$this->load->view('menus/menu_orb_footer');
	}

	public function printForm()
	{
		if(count($_POST))
		{
			$image_path = $this->data['applicant_form_path'];
			$form_image[0] = $image_path . $this->input->post('id') . "_1.jpg";
			$form_image[1] = $image_path . $this->input->post('id') . "_2.jpg";
			$form_image[2] = $image_path . $this->input->post('id') . "_3.jpg";
			$form_image[3] = $image_path . $this->input->post('id') . "_4.jpg";
			$form_image[4] = $image_path . $this->input->post('id') . "_5.jpg";
			$file_name = $this->input->post('name');
			$file_id = $this->input->post('id');

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
		$pdf->Output($file_id . '-' . $file_name . '.pdf', 'I');
	}
}