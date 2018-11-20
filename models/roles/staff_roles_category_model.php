<?php

class Staff_roles_category_model extends CI_Model{

	public function __construct(){
		parent::__construct();
		$this->role = $this->load->database('role_org',TRUE);
	}

	public function get_by($tablename,$where=null,$select_col=''){

		if($select_col == ''){
			$this->role->select();
		}
		else if ($select_col != ''){
			$this->role->select($select_col);
		}

		$this->role->from($tablename);

		if($where == null){

		}
		else if($where != null){
			$this->role->where($where);
		}

		$query = $this->role->get();
		$row = $query->result();

		if($row != null){
			return $row;
		}
		else if($row == null){
			return false;
		}

	}

	public function insert_data($tablename,$data){

		$this->role->insert($tablename,$data);
		$affected = $this->role->affected_rows();
		return $affected;
	}

	public function save($tablename,$data,$where){

		$this->role->where($where);
		$this->role->update($tablename,$data);
		$affected = $this->role->affected_rows();
		
	}

}


?>