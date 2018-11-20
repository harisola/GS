<?php
class Req_sectionchange_model extends MY_Model{
	protected $_table_name = 'req_section';
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


	public function getSectionID($StudentID){
		$getStatusID = "";

		$query=$this->db->query("SELECT section_id FROM class_list WHERE id = " . $StudentID); 
		
		if ($query->num_rows() > 0) {
			$row = $query->row_array();
			$getStatusID = $row['section_id'];
		}

		return $getStatusID;
	}


	public function getAllSectionChangeData()
	{
		$cQuery = "select
			sr.gs_id, sr.gs_id, sr.abridged_name,
			gg.dname as grade_name, ss.dname as section_name,
			olds.dname as old_section_name, news.dname as new_section_name,
			reqs.id, reqs.student_id, reqs.req_date, reqs.wef_date, reqs.old_section, reqs.new_section, reqs.description, reqs.ip, reqs.created
			from req_section reqs
			left join student_registered sr on sr.id = reqs.student_id
			left join student_academic_record sar on sar.student_id = reqs.student_id
			left join _grade gg on gg.id = sar.grade_id
			left join _section ss on ss.id = sar.section_id
			left join _section olds on olds.id = reqs.old_section
			left join _section news on news.id = reqs.new_section
			where (sar.academic_session_id >= 3 or sar.academic_session_id <= 6)";
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();	
    				
   		return $row;
	}
}