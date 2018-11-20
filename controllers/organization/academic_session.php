<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Netcarver\Textile;

class Academic_session extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('organization/academic_session_model');
	}

	public function index()
	{	
		$this->load->view('menus/menu_orb_footer');	
	}
}