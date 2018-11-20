<?php
class Student_academic_record_model extends MY_Model{
	protected $_table_name = 'student_academic_record';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';
	protected $_order_by = 'created desc';
	public $rules = array();
	protected $_timestamps = TRUE;

	public function __construct()
	{
		parent::__construct();
	}


	
	public function getID($StudentID){
		$getID = "";

		$query=$this->db->query("SELECT id FROM student_academic_record WHERE student_id = " . $StudentID . " and academic_session_id >= " . $this->AcademicSessionFrom . " and academic_session_id <= " .$this->AcademicSessionTo . " order by id desc limit 1");
		
		if ($query->num_rows() > 0) {
			$row = $query->row_array();
			$getID = $row['id'];
		}

		return $getID;
	}

}