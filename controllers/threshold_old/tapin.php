<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Tapin extends MY_Controller {
	public function __construct(){
		parent::__construct();		
	}


	public function index()		
	{
		$this->load->view('threshold/tapin/tapin_view');
		$this->load->view('threshold/tapin/tapin_footer_orb');
	}
}