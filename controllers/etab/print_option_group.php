<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Print_option_group extends MY_Controller {	

	public function __construct(){
		parent::__construct();
	}
	// index
	public function index(){

		$this->load->model('autocomplete/anotherdb_model','AO');
		$data['grades'] = $this->AO->getSomething();
		$this->load->model('etab/academic/academic_model','AM');
		$data['sessions'] = $this->AM->get();
		//var_dump($sessions);
		//exit;
		
		

		$login_user_id = $this->session->userdata("user_id"); //118 GAA
		$reg_user = $this->ETS->getStaffID( $login_user_id );
		$reg_user_id = $reg_user['id'];
		$branch_id = (int)$reg_user['branch_id'];
		
		$this->load->model('etab/academic/academic_model','AM');
		$sessions = $this->AM->getSession($branch_id);
		$c_sss_id = $sessions[0]["id"];
		//$data['sessionsTerm'] = $this->AM->getSesstrm($c_sss_id);
		
		$data['sessionsTerm'] = (int)$c_sss_id;
		$sessionsTerm = $this->AM->getSesstrm($c_sss_id);
		$data['term'] = (int)$sessionsTerm[0]["TermID"];

		
		$this->load->view('etab/print_option_group/print_option_group_view',$data);
		$this->load->view('etab/print_option_group/print_option_group_footer');
		
	}
}	