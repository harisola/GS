<?php

class Subject_group_model extends CI_Model{

	public function __construct()
	{
		parent::__construct();
		$this->subject = $this->load->database('subject',TRuE);
	}

	public function get_by($tablename,$select='',$where=NULL){
		if($select == ''){
			$this->subject->select();
		}
		else if($select != ''){
			$this->subject->select($select);
		}

		$this->subject->from($tablename);

		if($where == Null){

		}
		else{
			$this->subject->where($where);
		}

		$query = $this->subject->get();

		if($query->num_rows() > 0){
			return $query->result();
		}
		else{
			return false;
		}

		
	}

	public function save($tablename,$data)
	{
		$this->subject->insert($tablename,$data);
		return  $this->subject->insert_id();
	}

	public function get_updated_by($tablename,$where = NULL,$data)
	{

		if($where == Null)
		{

		}
		else if ($where != Null)
		{
			$this->subject->where($where);
		}

		$this->subject->update($tablename,$data);
		$rows = $this->subject->affected_rows();
		if($rows == '')
		{
			return false;
		}
		else
		{
			return $rows;
		}
	}

}