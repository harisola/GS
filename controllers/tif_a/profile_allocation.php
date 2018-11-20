
<?php

class Profile_allocation extends CI_Controller{

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
	        //$this->load->view('gs_files/breadcrumb');
		$select = '';
		$where = '';
		$this->load->model('tif_a/profile_allocation_model','pam');
		$data['staff'] = $this->pam->get_by('atif.staff_registered',$select,$where);

		$data['staff_allocation'] = $this->pam->staff_profile_allocation();

		$data['profile_description'] = $this->pam->get_by('atif_gs_events.tt_profile',$select,$where);
		//  var_dump($data['staff_allocation']);
		// exit;
		// exit;
		$this->load->view('tif_a/profile_allocation/tt_profile_allocation',$data);
		$this->load->view('tif_a/profile_allocation/allocation_footer');
		}
	}
}