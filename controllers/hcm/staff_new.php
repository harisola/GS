<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Staff_new extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('staff/staff_registered_model');
		$this->load->model('staff/staff_title_model');
		$this->load->model('staff/staff_get_gtid');		
		$this->staff_data['staff_title'] = array($this->staff_title_model->get());
		$this->card['top_line'] = array($this->staff_get_gtid->getCardTopLine());
		$this->card['bottom_line'] = array($this->staff_get_gtid->getCardBottomLine());
	}

	public function index()
	{		
		if($this->data['can_user_add'] == 1){

			$this->form_validation->set_rules($this->staff_registered_model->validation);

			if($this->form_validation->run() == FALSE){
				
			}else{
				$this->add();
			}
		}

		$this->load->view('hcm/staff/staff_new_orb');
		$firstdate = date('Y-m-d 0:0:0');
		$firstdate = human_to_unix($firstdate);						
		$this->staff_today_data['staff_today_data'] = array($this->staff_registered_model->get_by(array('created >=' => $firstdate)));
		$this->load->view('hcm/staff/staff_new_today_orb', $this->staff_today_data['staff_today_data']);
		// Loading footer in the end
		$this->load->view('hcm/staff/staff_new_orb_footer');
	}

	public function refresh_now(){
		redirect($this->uri->uri_string());
	}

	public function add()
	{

		if(count($_POST))
		{
			/**
			*Insert staff form data from POST values
			**/
			
			$d_DOB = $this->input->post('DOB'); // 23rd of January
			list($day, $month, $year) = explode('-',$d_DOB);
			$d_DOB = $year . '-' . $month . '-' . $day;

			$d_DOJ = $this->input->post('DOJ'); // 23rd of January
			list($day, $month, $year) = explode('-',$d_DOJ);
			$d_DOJ = $year . '-' . $month . '-' . $day;

			$GTIDYear = substr($year, 2, 2);
			$GTID = $this->staff_get_gtid->get_max_gtid($GTIDYear);
			
			if($GTID == ""){
				$GTID = $GTIDYear . "-001";
			}else{				
				$GTID = $GTIDYear . "-" . str_pad(((int)substr($GTID, 3, 3) + 1), 3, '0', STR_PAD_LEFT);
			}			

			$data = array(
				'register_by' => (int)$this->session->userdata('user_id'),
				'employee_id' => (int)$this->input->post('employee_id'),				
				'name' => ucwords(strtolower($this->input->post('staff_name'))),
				//'call_name' => ucwords(strtolower($this->input->post('call_name'))),
				'abridged_name' => ucwords(strtolower($this->input->post('abridged_name'))),
				'name_code' => strtoupper($this->input->post('name_code')),
				'father_name' => ucwords(strtolower($this->input->post('father_name'))),
				'nic' => $this->input->post('nic'),
				'mobile_phone' => $this->input->post('mobilephonereq'),
				'land_line' => $this->input->post('landline'),
				'gender' => $this->input->post('gender'),
				'dob' => $d_DOB,
				'doj' => $d_DOJ,
				'designation' => ucwords(strtolower($this->input->post('designation'))),
				'department' => ucwords(strtolower($this->input->post('department'))),
				'section' => ucwords(strtolower($this->input->post('section'))),
				'sub_section' => ucwords(strtolower($this->input->post('sub_section'))),
				'category' => ucwords(strtolower($this->input->post('category'))),
				'eobi_no' => ucwords(strtolower($this->input->post('eobi_no'))),
				'sessi_no' => ucwords(strtolower($this->input->post('sessi_no'))),
				'gg_id' => ucwords(strtolower($this->input->post('gg_id'))),
				'title_person_id' => (int)$this->input->post('title_person_id'),
				'gt_id' => $GTID,
				'gs_staff_type' => $this->input->post('gs_staff_type'),
				'c_topline' => $this->input->post('card_top_line'),
				'c_bottomline' => $this->input->post('card_bottom_line'),
				'menu_coverage_id' => 2
			);
			$staff_id = (int)$this->staff_registered_model->save($data);
		}
	}
}