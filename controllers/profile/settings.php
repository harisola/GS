<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Settings extends MY_Controller {
	public function __construct(){
		parent::__construct();					
	}

	public function index()
	{
		$this->load->view('menus/menu_orb_footer');
	}
}