<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Student_ai extends MY_Controller {
	public function __construct(){
		parent::__construct();				
		
	}


	public function index()
	{
		$this->form_validation->set_rules($this->validation_status_student);

		if($this->form_validation->run() == FALSE){
			if(count($_POST))
			{
				$this->gs_id = $this->input->post('gs_id');
				$this->wef_date = $this->input->post('wef_date');				
			}

			$this->load->view('frontoffice/status_ai_student_form.php');
			$this->load->model('front_office/req_student_statusai_model');
			$this->data['StatusAI'] = $this->req_student_statusai_model->getAllStatusAIData();
			$this->load->view('frontoffice/status_ai_student_info.php');
			$this->load->view('frontoffice/frontoffice_footer_orb.php');
		}else{
			$this->add();
		}	
	}


	public $validation_status_student = array(		
		array('field' => 'gs_id', 'label' => 'GS-ID', 'rules' => 'trim|sanitize|required'),
		array('field' => 'wef_date', 'label' => 'W.E.F Date', 'rules' => 'trim|sanitize|required'),
		array('field' => 'description', 'label' => 'Status Change Reason', 'rules' => 'trim|sanitize|required'),
		array('field' => 'new_status', 'label' => 'New Status', 'rules' => 'trim|sanitize|required'),
	);




	public function add()
	{
		if(count($_POST))
		{
			$GSID = $this->input->post('gs_id');
			$wefDate = $this->input->post('wef_date');
			$description = $this->input->post('description');
			$new_status_id = $this->input->post('new_status');
			$client_ip = "";
			$req_statusai_id = 0;


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


			$this->load->model('front_office/req_student_statusai_model');
			$StudentID = $this->req_student_statusai_model->getStudentID($GSID);
			$oldStatusID = $this->req_student_statusai_model->getStatusID($StudentID);

			$data = array(
				'student_id' => $StudentID,
				'req_date' => date("Y-m-d"),
				'wef_date' => $wefDate,
				'old_status' => $oldStatusID,
				'new_status' => $new_status_id,
				'description' => $description,
				'ip' => $client_ip				
			);


			$req_statusai_id = $this->req_student_statusai_model->save($data);


			/*$this->load->model('front_office/student_academic_record_model');
			$thisID = $this->student_academic_record_model->getID($StudentID);

			$data_std = array(
				'status_id' => $new_status_id
			);

			$this->student_academic_record_model->save($data_std, $thisID);*/
		}		
		redirect('/fo/student_ai');
	}
}