<?php
class Assesment_grade_model extends MY_Model{

	public function __construct()
	{
		parent::__construct();
		
	}

	protected $_table_name = '_grade';

	public function academic_grade()
	{
		$this->db->select();
		$this->db->from($this->_table_name);
		$query = $this->db->get();
		return $query->result_array();
	}
}