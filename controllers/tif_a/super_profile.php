<?php

class super_profile extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$user_id =  (int)$this->session->userdata('user_id'); 
	}

	public function index(){

		$this->load->model('tif_a/super_profile_model','spm');

		if($this->ion_auth->logged_in() == FALSE){
			redirect('welcome');
		}else{
			$this->load->view('gs_files/header');
	        $this->load->view('gs_files/main-nav');
	       	$this->load->view('gs_files/breadcrumb_super');


		// TT Profiles And TT Profile Timing
	    $data['tt_profile'] = $this->spm->get_tt_profile_detail();
		

	    // GET SUPER PROFILE
		$select = '';
        $where = array(
			'Type' => 'Staff'
		);
        $data['super_profile_desc'] = $this->spm->get_by('atif_gs_events.event_category',$select,$where);

       
		
		


        // Get Super Profie Time

        $select = '';
        $where = '';
        $data['super_profile_time'] = $this->spm->get_by('atif_gs_events.super_profile_time',$select,$where);

        //var_dump($data['super_profile_time']);exit;
		$data["thisCont"]=$this;


		
		$this->load->view('tif_a/sp_html/main_page.php',$data);
		//$this->load->view('tif_a/super_profile/super_profile_view.php',$data);
		$this->load->view('tif_a/super_profile/super_profile_footer.php');
		

		}

	}
	
	
	public function Get_STiming($SProfile_ID,$TTProfile_ID){
		$this->load->model('tif_a/super_profile_model','spm');
		$select = '';
		$where = array( 'super_profile_id' => $SProfile_ID, "profile_id"=>$TTProfile_ID );
		return $this->spm->get_by('atif_gs_events.super_profile_time',$select,$where);
	}
}