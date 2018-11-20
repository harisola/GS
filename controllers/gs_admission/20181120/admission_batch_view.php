<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admission_batch_view extends CI_Controller{

	public  function __construct(){
		parent::__construct();
		$this->load->library('session');
		$user_id = $this->session->userdata('user_id');
		$this->user_id = $user_id;
	}

	public function index(){

		if($this->ion_auth->logged_in() == FALSE){
			redirect('welcome');
		}else{
			$this->load->view('gs_files/header');
	        $this->load->view('gs_files/main-nav');
	        $this->load->view('gs_files/breadcrumb');

	        $this->load->model('admission/admission_batch_model','abm');
	        $data['grade'] = $this->abm->get_batch_grade();
	        // var_dump($data['grade']);

	        $this->load->view('gs_admission/batch/batch_view',$data);
	        $this->load->view('gs_admission/batch/batch_view_footer');
	    }
	}


	// Get Batch Available Like 'A-01'
	public function get_batch_available(){
		$this->load->model('admission/admission_batch_model','abm');
		$grade_id = $this->input->post('grade_id');
		$where = array(
			'grade_id' => $grade_id
		);
		$select = '';
		$batch_available = $this->abm->get_by_all('atif_gs_admission._form_batch',$select,$where);
		echo json_encode($batch_available);

	}

	public function get_batch_detail(){
		$batch_category = $this->input->post('batch_category');
		$this->load->model('admission/admission_batch_model','abm');
		$batch_detail = $this->abm->sp_form_batch_detail($batch_category);
		$html = '';
		$html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th class="valignMiddle">Slot</th>';
        $html .= '<th class="valignMiddle">Default Appointment</th>';
        $html .= '<th class="valignMiddle text-center">Form #</th>';
        $html .= '<th class="">Applicant Name</th>';
        $html .= '<th class="text-center">Revised Batch</th>';
        $html .= '<th class="text-center">Revised Appointment</th>';
        $html .='</tr>';
        $html .='</thead>';
		$html .= '<tbody>';
		foreach($batch_detail as $b_detail){
			$html .= '<tr>';
			$html .= '<td>'.$b_detail->slot.'</td>';
			$html .= '<td>'.$b_detail->default_appointment.'</td>';
			$html .= '<td>'.$b_detail->form_no.'</td>';
			$html .= '<td>'.$b_detail->applicant_name.'</td>';
			$html .= '<td>'.$b_detail->revised_batch.'</td>';
			$html .='<td>'.$b_detail->revised_appointment.'</td>';
			$html .= '</tr>';
		}
		$html .='</tbody>';
		echo $html;
	}


}