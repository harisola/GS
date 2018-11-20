<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Fee_detail extends MY_Controller {
	public function __construct(){
		parent::__construct();				
	}

	public function index()
	{			
		$this->load->model('class_list/class_list_sr_view_model');
		$this->data['class_list_data'] = $this->class_list_sr_view_model->get_all_classes_fee_detail();
		$this->load->view('student_directory/fee_detail/fee_detail_name_view');
		$this->load->view('student_directory/fee_detail/fee_detail_footer_orb');
	}
}