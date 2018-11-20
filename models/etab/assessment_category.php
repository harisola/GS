<?php
class Assessment_category extends CI_Model{

	private $atif_assessment;

	function __construct(){
		parent::__construct();
		$this->atif_assessment = $this->load->database('assessment', TRUE);
	}
	
	public function createCategory( $data ){
		
	}
}// mean class assessment category	
