<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Visitor_admission extends MY_Controller {
	public function __construct(){
		parent::__construct();		
	}


	public function index()		
	{
		$this->form_validation->set_rules($this->validation_visitor_admission);
		$this->form_validation->set_message('validate_rfid','Please tap only authorized ADMISSION card!');


		$this->admission_nic = "";
		$this->admission_name = "";
		$this->admission_mobile_phone = "";
		$this->admission_visit_purpose = "";
		$this->admission_visit_to_person = "";
		$this->admission_visit_to_dapartment = "";
		$this->admission_assigned_card = "";


		if($this->form_validation->run() == FALSE){
			if(count($_POST))
			{
				$this->admission_nic = $this->input->post('cnic');
				$this->admission_name = $this->input->post('name');
				$this->admission_mobile_phone = $this->input->post('mobile_phone');
				$this->admission_visit_purpose = $this->input->post('admission_visit_purpose');
				$this->admission_visit_to_person = $this->input->post('admission_visit_to_person');
				$this->admission_visit_to_dapartment = $this->input->post('admission_visit_to_dapartment');
				$this->admission_assigned_card = $this->input->post('admission_assigned_card');
			}

			$this->load->view('threshold/admission/visitor_admission_assigncard');
			$this->load->view('threshold/admission/visitor_admission_footer_orb');	
					
		} else {
			$this->add();
		}		
	}



	public $validation_visitor_admission = array(
		array('field' => 'cnic', 'label' => 'NIC', 'rules' => 'trim|sanitize|required|min_length[15]|max_length[15]'),
		array('field' => 'name', 'label' => 'Name', 'rules' => 'trim|sanitize|required'),		
		array('field' => 'mobile_phone', 'label' => 'Mobile Phone', 'rules' => 'trim|sanitize|required|min_length[12]|max_length[12]'),
		array('field' => 'admission_visit_to_dapartment', 'label' => 'Department', 'rules' => 'trim|sanitize|required'),
		array('field' => 'admission_visit_purpose', 'label' => 'Visit for', 'rules' => 'trim|sanitize|required'),				
		array('field' => 'admission_assigned_card', 'label' => 'Visitor Card No.', 'rules' => 'trim|sanitize|required|min_length[10]|max_length[10]|callback_validate_rfid')		
	);



	function validate_rfid($str)
	{
	   $field_value = $str;	   
	   $visitor_type = 2;
	   
	   $this->load->model('threshold/visitors_card_model');
	   if($this->visitors_card_model->checkRFIDCard($field_value, $visitor_type))
	   {
	     return TRUE;
	   }
	   else
	   {
	     return FALSE;
	   }
	}

	public function add()
	{
		if(count($_POST))
		{
			$this->load->model('threshold/visitor_admission_model');
			$now = date('Y-m-d H:i:s');

			$type_id = 2;
			$no_of_person = 1;
			$name = $this->input->post('name');
			$nic = $this->input->post('cnic');
			$mobile_phone = $this->input->post('mobile_phone');

			$purpose = $this->input->post('admission_visit_purpose');
			$contact_person = $this->input->post('admission_visit_to_person');
			$contact_department = $this->input->post('admission_visit_to_dapartment');
			$rfid_dec = $this->input->post('admission_assigned_card');
			$rfid_hex = dechex(intval($rfid_dec));			
			$time_in = human_to_unix($now);
			var_dump($this->input->post());
			

			$data = array(
				'type_id' => $type_id,
				'no_of_persons' => $no_of_person,
				'name' => $name,
				'nic' => $nic,
				'mobile_phone' => $mobile_phone,
				'purpose' => ucwords(strtolower($purpose)),
				'contact_person' => ucwords(strtolower($contact_person)),
				'contact_department' => ucwords(strtolower($contact_department)),
				'rfid_dec' => $rfid_dec,
				'rfid_hex' => ucwords($rfid_hex),
				'time_in' => $time_in
			);

			$this->visitor_admission_model->save($data);
			redirect('/threshold/visitor_admission');
		}
	}
}