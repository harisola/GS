<?php
class Grades extends MY_Model{
	//private $ADB;
	private $DDB;
	
	function __construct(){
		parent::__construct();
		$this->DDB = $this->load->database('default',TRUE);
	}
	
	// ============================================
	//  Get Grades
	// ============================================
	
	public function get(){
		$this->DDB->select("*");
		$this->DDB->from('_grade');
		$query = $this->DDB->get();
		return $query->result();
	}
	
	// ============================================
	//  Get Categories 
	// ============================================
	public function getCategoris(){
		$this->DDB->select("*");
		$this->DDB->from('assessment_category');
		$query = $this->DDB->get();
		return $query->result();
	}
}// mean class assessment category	
