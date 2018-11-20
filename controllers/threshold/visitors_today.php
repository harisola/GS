<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Visitors_today extends MY_Controller {
	public function __construct(){
		parent::__construct();		
		

		$now = date('Y-m-d 00:00:00');
		$today_date = human_to_unix($now);

		$this->load->model('threshold/all_visitors_model');
		$this->data['visitors'] = $this->all_visitors_model->get_by(array('time_in >=' => $today_date));
	}


	public function index()		
	{
		$this->load->view('threshold/all_visitors');
		$this->load->view('threshold/all_visitors_footer_orb');	
	}	
}