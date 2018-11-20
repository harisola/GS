<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Class_list_setup_ajax extends CI_Controller
{
  public function __construct()
  {
  	parent::__construct();
	}
	public function view_tab()
	{

		$this->load->model('class_list/class_list_freeze_date_model', 'SI');
		$freeze_date = $this->input->post("freeze_date");

		
		$data = array('freeze_date'=>$freeze_date);
		$nowtime = time();
		$modified_by = (int)$this->session->userdata['user_id'];

$query = "INSERT INTO `atif`.`class_list_freeze_date` (`freeze_date`, `created`, `register_by`) VALUES ('".$freeze_date."', '".$nowtime."', '".$modified_by."');";

   	echo $this->SI->set_freeze_date($query);

		
	}
}