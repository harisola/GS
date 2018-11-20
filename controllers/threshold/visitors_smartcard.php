<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Visitors_smartcard extends MY_Controller {
	public function __construct(){
		parent::__construct();		
	}


	public function index()		
	{
		$this->load->model('nfc_card/rfid_model');
		$this->form_validation->set_rules($this->validation_nfc_card);		
		

		if($this->form_validation->run() == FALSE){
			
		}else{
			if(count($_POST))
			{
				$this->NFCCardHolder = $this->rfid_model->get_Alumni_n_ParentsCard_Data($this->input->post('rfid_dec'));
				if(!empty($this->NFCCardHolder)){
					$this->add();
				}
			}
		}

		$this->load->view('threshold/nfc_card/alumni_n_family_rfid_view');
		$this->load->view('threshold/nfc_card/alumni_n_family_rfid_orb_footer');
	}


	public $validation_nfc_card = array(
		array('field' => 'rfid_dec', 'label' => 'Smart Card', 'rules' => 'trim|sanitize|required|min_length[10]')
	);

	function validate_rfid_card($str)
	{
	   $field_value = $str;
	   $result = false;

	   $this->load->model('nfc_card/rfid_model');
	   if($this->rfid_model->validate_Alumni_n_ParentsCard($field_value))
	   {
	     $result = true;
	   }
	   else
	   {
	     $result = false;
	   }

	   return $result;
	}







	public function add()
	{
		if(count($_POST))
		{
			$this->load->model('threshold/visitor_guest_model');
			$now = date('Y-m-d H:i:s');

			if($this->NFCCardHolder[0]['visitor'] == 'Alumni') {
				$type_id = 7;
			}else if($this->NFCCardHolder[0]['visitor'] == 'Parent') {
				$type_id = 1;
			}
			
			$no_of_person = 1;
			$name = $this->NFCCardHolder[0]['name'];
			$nic = "";
			$mobile_phone = "";
			$purpose = "";
			$contact_person = "";
			$contact_department = "";
			
			$rfid_dec = $this->NFCCardHolder[0]['rfid_dec'];
			$rfid_hex = $this->NFCCardHolder[0]['rfid_hex'];
			$time_in = human_to_unix($now);			
			

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

			$this->visitor_guest_model->save($data);			
		}
	}
}