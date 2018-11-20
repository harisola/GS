
<?php

class Testing extends MY_Controller{

	public function __construct(){
		parent::__construct();


	}
	public function index(){
		//$this->load->view('menus/header_new');

		//Call Page
		//Call Footer
		$this->load->view('haris/Student_Listing');
		$this->load->view('haris/footer_new');
	}
}