<?php 

class Program_grade_allocation_model extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->database('subject',True);
	}
	
	public function get_by($tablename,$select='',$where=null,$group=''){

		// Table Name

		

		// Selection

		$this->db->from($tablename);
		if($select == ''){
			$this->db->select();
		}
		else if($select != ''){
			$this->db->select($select);
		}

		// Where Condition

		if($where == null){

		}
		else if($where != null){
			$this->db->where($where);
		}



		//Group By

		if($group == ''){
		}
		else if($group != ''){
			$this->db->group_by($group);
		}

		// Get Query Result

		$query = $this->db->get();
		$row = $query->result();

		if($row == null){
			return false;
		}
		else if($row != null){
			return $row;
		}



	}


	// Insert Query For Data Insert
	public function insert_data($tablename,$data){

		$this->db->insert($tablename,$data);
		$affected = $this->db->affected_rows();
		return $affected;
	}

	//Update Query For Data Insert

	public function save($tablename,$data,$where){

		$this->db->where($where);
		$this->db->update($tablename,$data);
		$affected = $this->db->affected_rows();

		
	}



}