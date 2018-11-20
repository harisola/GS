<?php
class Req_housechange_model extends MY_Model{
	protected $_table_name = 'req_house';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';
	protected $_order_by = 'created desc';
	public $rules = array();
	protected $_timestamps = TRUE;

	public function __construct()
	{
		parent::__construct();
	}


	public function getStudentID($GSID){
		$getStudentID = "";

		$query=$this->db->query("SELECT id FROM student_registered WHERE gs_id = '" . $GSID . "'"); 
		
		if ($query->num_rows() > 0) {
			$row = $query->row_array();
			$getStudentID = $row['id'];
		}

		return $getStudentID;
	}


	public function getHouseID($StudentID){
		$getStatusID = "";

		$query=$this->db->query("SELECT house_id FROM class_list WHERE id = " . $StudentID); 
		
		if ($query->num_rows() > 0) {
			$row = $query->row_array();
			$getStatusID = $row['house_id'];
		}

		return $getStatusID;
	}


	public function getAllHouseChangeData()
	{
		$cQuery = "select
			sr.gs_id, sr.gs_id, sr.abridged_name,
			gg.dname as grade_name, ss.dname as section_name,
			oldh.dname as old_house_name, newh.dname as new_house_name,
			reqh.id, reqh.student_id, reqh.req_date, reqh.wef_date, reqh.old_house, reqh.new_house, reqh.description, reqh.ip, reqh.created
			from req_house reqh
			left join student_registered sr on sr.id = reqh.student_id
			left join student_academic_record sar on sar.student_id = reqh.student_id
			left join _grade gg on gg.id = sar.grade_id
			left join _section ss on ss.id = sar.section_id
			left join _house oldh on oldh.id = reqh.old_house
			left join _house newh on newh.id = reqh.new_house
			where (sar.academic_session_id >= 3 or sar.academic_session_id <= 6)";
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();	
    				
   		return $row;
	}
}