<?php

class Assessment_category_grade_model extends CI_Controller{

	public function __construct(){

		parent::__construct();
		$this->load->database('atif_assessment',TRUE);
	}

	public function get($tablename,$select='',$where=null){

		$this->db->from($tablename);
		if($where == null){

		}
		else if ($where != null){
			$this->db->where($where);
		}
		if($select = '')
		{
			$this->db->select();
		}
		else if($select != '')
		{
			$this->db->select($select);
		}

		$query = $this->db->get();
		return  $query->result();



	}

	public function get_join(){
		$query = "SELECT acg.id,ag.name as grade_name ,ac.name as assessment_category,acg.grade_id,acg.assessment_category_id,acg.weightage,acg.is_fix FROM assessment_category_grade acg
				  inner join atif._grade  ag on ag.id  = acg.grade_id 				
				  inner join assessment_category ac on ac.id = acg.assessment_category_id";
		$row = $this->db->query($query);
		return $row->result();
	}

	public function insert_data($tablename,$data){
		$this->db->insert($tablename,$data);
		$row = $this->db->affected_rows();
		
		if($row == null){
			return false;
		}
		else if($row != null){
			return $row;
		}
	}

	public function update($tablename,$where,$data){
		
		$this->db->where($where);
		$this->db->update($tablename,$data);
		$row = $this->db->affected_rows();

		if($row == null){
			return false;
		}
		else if($row != null){
			return $row;
		}
	}


}