<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Tapin extends MY_Controller {
	public function __construct(){
		parent::__construct();		
	}


	public function index()		
	{
		$this->load->model('threshold/ajax_base', 'AB');
		$data['Get_TapIn_Location']  = $this->AB->Get_TapIn_Location();
		$this->load->view('threshold/tapin/tapin_view',$data);
		$this->load->view('threshold/tapin/tapin_footer_orb');
	}
}