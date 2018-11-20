<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Visitor_worker_ajax extends CI_Controller {
	public function __construct(){
		parent::__construct();		
	}


	public function index()		
	{
		$this->form_validation->set_rules($this->validation_visitor_worker);
		$this->form_validation->set_message('validate_rfid','Please tap only authorized WORKER card!');

		if($this->form_validation->run() == FALSE){
			// Error
			echo 0;
			
		}else{
			// Success
			$returnSuccess = $this->add();
			echo $returnSuccess;
		}		
	}



	public $validation_visitor_worker = array(
		array('field' => 'cnic', 'label' => 'NIC', 'rules' => 'trim|sanitize|required|min_length[15]|max_length[15]'),
		array('field' => 'name', 'label' => 'Name', 'rules' => 'trim|sanitize|required'),
		array('field' => 'worker_visit_to_dapartment', 'label' => 'Department', 'rules' => 'trim|sanitize|required'),
		array('field' => 'mobile_phone', 'label' => 'Mobile Phone', 'rules' => 'trim|sanitize|required|min_length[12]|max_length[12]'),
		array('field' => 'worker_visit_purpose', 'label' => 'Visit for', 'rules' => 'trim|sanitize|required'),				
		array('field' => 'worker_assigned_card', 'label' => 'Visitor Card No.', 'rules' => 'trim|sanitize|required|min_length[10]|max_length[10]|callback_validate_rfid')		
	);



	function validate_rfid($str)
	{
	   $field_value = $str;	   
	   $visitor_type = 5;
	   
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
			$this->load->model('threshold/visitor_worker_model');
			$now = date('Y-m-d H:i:s');

			$type_id = 5;
			$no_of_person = 1;
			$name = $this->input->post('name');
			$nic = $this->input->post('cnic');
			$mobile_phone = $this->input->post('mobile_phone');

			$purpose = $this->input->post('worker_visit_purpose');
			$contact_person = $this->input->post('worker_visit_to_person');
			$contact_department = $this->input->post('worker_visit_to_dapartment');
			$rfid_dec = $this->input->post('worker_assigned_card');
			$rfid_hex = dechex(intval($rfid_dec));			
			$time_in = human_to_unix($now);
			//var_dump($this->input->post());
			

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

			$return = $this->visitor_worker_model->save($data);
			return $return;
			
		}
	}
}