<?php
class Max_from_table extends CI_Model{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function get_max_value($tablename, $fieldname, $condition_field, $condition_value){
		
		$query=$this->db->query("SELECT max(" . $fieldname . ") as max_id FROM " . $tablename . " WHERE " . $condition_field . " = " . $condition_value); 
		$row = $query->row_array();
		$max_id = $row['max_id'];

		return $max_id;
	}
}