<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Visitor_alumni_ajax extends CI_Controller {
	public function __construct(){
		parent::__construct();		
	}


	public function index(){
		
		$this->form_validation->set_rules($this->validation_visitor_guest);
		$this->form_validation->set_message('validate_rfid','Please tap only authorized GUEST card!');
		
		if($this->form_validation->run() == FALSE){
			//
			echo 0;
		} else {
			$returnID = $this->add();
			echo $returnID;
		}
		

		
	}

	
	
	
	public $validation_visitor_guest = array(
		array('field' => 'gs_id', 'label' => 'GF ID', 'rules' => 'trim|sanitize|required'),
		array('field' => 'alumni_assigned_card', 'label' => 'Alumni Card No.', 'rules' => 'trim|sanitize|required|min_length[10]|max_length[10]|callback_validate_rfid')		
	);



	function validate_rfid($str)
	{
	   $field_value = $str;	   
	   $visitor_type = 7;
	   
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
			$this->load->model('threshold/visitor_vendor_model');
			$now = date('Y-m-d H:i:s');

			$type_id = 7;
			$no_of_person = 1;
			$name = $this->input->post('gs_id');
			$abridged_name1 = $this->input->post('abridged_name');
			$nic = "";
			$mobile_phone = "";

			$purpose = "";
			$contact_person = "";
			$contact_department = "";
			$rfid_dec = $this->input->post('alumni_assigned_card');
			$rfid_hex = "";
			$time_in = human_to_unix($now);			
			
		
			
			if( $abridged_name1 == '' ){
				$abridgedname2 = $this->visitor_vendor_model->getstudent($name);
				$abridged_name = $abridgedname2["abridged_name"];
				//$abridged_name = $name;
			}else{
				$abridged_name = $abridged_name1;
			}
			
			//echo $abridged_name; exit;

			$data = array(
				'type_id' => $type_id,
				'no_of_persons' => $no_of_person,
				'name' => $abridged_name,
				'nic' => $nic,
				'mobile_phone' => $mobile_phone,
				'purpose' => ucwords(strtolower($purpose)),
				'contact_person' => ucwords(strtolower($contact_person)),
				'contact_department' => ucwords(strtolower($contact_department)),
				'description' => $name,
				'rfid_dec' => $rfid_dec,
				'rfid_hex' => ucwords($rfid_hex),
				'time_in' => $time_in
			);
			
			
			

			$return = $this->visitor_vendor_model->save($data);
			return $return;
			
		}
	}
}
