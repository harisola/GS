<?php
class Programme_option_selection extends MY_Controller{
	function __construct() {
		parent::__construct();
	}
	
	
	public function index(){
		
		$this->load->model('autocomplete/anotherdb_model','AO');
		$data['grades'] = $this->AO->getSomething();
		$this->load->model('etab/academic/academic_model','AM');
		$data['sessions'] = $this->AM->get();
		
		
		//var_dump($data['sessions']);
		//exit;
		
		$login_user_id = $this->session->userdata("user_id"); //118 GAA
		$this->load->model('etab/teacher_side/teacher_side_model', 'ETM');
		$reg_user = $this->ETM->getStaffID( $login_user_id );
		$reg_user_id = $reg_user['id'];
		//exit;
		$branch_id = (int)$reg_user['branch_id'];
		
		
		
		$sessions = $this->AM->getSession($branch_id);
		$data['sessionsTerm'] = $c_sss_id = $sessions[0]["id"];
		
		$sessionsTerm = $this->AM->getSesstrm($c_sss_id);
		$data['term'] = (int)$sessionsTerm[0]["TermID"];
		
		
		
		$this->load->view("subjects/option_selection/option_selection",$data);
		$this->load->view("subjects/option_selection/footer");
	}
	
	
	
}
?>	