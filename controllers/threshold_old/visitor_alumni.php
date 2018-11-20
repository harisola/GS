<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Visitor_alumni extends MY_Controller {
	public function __construct(){
		parent::__construct();		
	}


	public function index()		
	{
		$this->load->model('sis/fif_student_info_model');
		$this->attendance['students'] = $this->fif_student_info_model->get();

		$this->load->view('threshold/alumni/alumni_form_view');
		$this->load->view('threshold/alumni/alumni_search_form_view');
		$this->load->view('threshold/alumni/alumni_visitor_footer_orb');
	}


	public function add()
	{
		if(count($_POST))
		{
			$this->load->model('threshold/visitor_vendor_model');
			$now = date('Y-m-d H:i:s');

			$type_id = 4;
			$no_of_person = 1;
			$name = $this->input->post('gs_id');
			$nic = "";
			$mobile_phone = "";

			$purpose = "";
			$contact_person = "";
			$contact_department = "";
			$rfid_dec = $this->input->post('alumni_assigned_card');
			$rfid_hex = "";
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

			$this->visitor_vendor_model->save($data);
			redirect('/threshold/visitor_alumni');
		}
	}
}
