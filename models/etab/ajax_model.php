<?php
class Ajax_model extends CI_Model{

	private $DBA;
	private $DDB;
	function __construct(){
		parent::__construct();
	}
	
	public function gradeCategory(){
		$this->DBA = $this->load->database('assessment', TRUE);
		
	}
	
	
	public function gradeSection($grade_id){
		$this->DDB = $this->load->database('default', TRUE);
		$this->DDB->distinct();
		$this->DDB->select('section_dname');
		$this->DDB->from('class_list'); 
		$this->DDB->where('grade_id', $grade_id);
		$this->DDB->order_by("section_dname","ASC");
		$query = $this->DDB->get();
		if( $query->num_rows() > 0 ){
			$results = $query->result_array();
			return $results;
		}else{
			return false;
		}	
	}
}// mean class assessment category	
