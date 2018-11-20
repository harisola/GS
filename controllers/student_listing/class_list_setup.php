<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Class_list_setup extends MY_Controller {
	public function __construct(){
		parent::__construct();		
		
		//$this->load->model('report/attendance_staff_today_model');
	}


	public function index()
	{	

		$this->load->model('class_list/class_list_freeze_date_model', 'SI');
$query = "SELECT freezed_date as Freeze_date 
FROM `atif`.`class_list_freeze_date` WHERE academic_session = (select ac.id as Current_Academic_id from `atif`.`_academic_session` as ac
where ac.is_lock=0 and ac.is_active=1 limit 1)";

   	$data['results'] = $this->SI->get_freezed_date($query);


		$this->load->view('class_list/setup/class_list_setup_view', $data );
		$this->load->view('class_list/setup/class_list_setup_footer_orb');
	}
}