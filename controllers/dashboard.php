<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		// Dashboard theme is Daashboard Simple
		$this->load->view('dashboard/dashboard_admin_orb');
		$this->load->view('menus/menu_orb_footer');
	}
}