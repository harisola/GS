<?php

class Tt_profile extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$user_id =  (int)$this->session->userdata('user_id'); 
	}

	public function index(){

		if($this->ion_auth->logged_in() == FALSE){
			redirect('welcome');
		}else{
			$this->load->view('gs_files/header');
	        $this->load->view('gs_files/main-nav');
	    //    $this->load->view('gs_files/breadcrumb');


			$this->load->model('tif_a/tif_a_model','tifa');
			$data['profile'] =  $this->tifa->profile_allocated();

			$this->load->view('tif_a/tt_profile_view',$data);
			$this->load->view('tif_a/tt_profile_footer');

		}

	}
}