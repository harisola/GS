<?php
class Req_student_statusai_model extends MY_Model{
	protected $_table_name = 'req_statusai';
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


	public function getStatusID($StudentID){
		$getStatusID = "";

		$query=$this->db->query("SELECT status_id FROM class_list WHERE id = " . $StudentID); 
		
		if ($query->num_rows() > 0) {
			$row = $query->row_array();
			$getStatusID = $row['status_id'];
		}

		return $getStatusID;
	}


	public function getAllStatusAIData()
	{
		$cQuery = "SELECT
			cl.gs_id, cl.gf_id, cl.abridged_name, cl.grade_name, cl.section_name,
			req_statusai.id, req_statusai.student_id, req_statusai.req_date, req_statusai.wef_date,
			oldss.dname as old_status_name, newss.dname as new_status_name,
			req_statusai.old_status, req_statusai.new_status, req_statusai.description, req_statusai.created as created, req_statusai.ip, req_statusai.posted , req_statusai.register_by FROM req_statusai
			left join class_list cl on cl.id = req_statusai.student_id
			left join _student_status oldss on oldss.id = req_statusai.old_status
			left join _student_status newss on newss.id = req_statusai.new_status
			where from_unixtime(req_statusai.created) >= '2016-06-01'";
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();	
    				
   		return $row;
	}



	public function getStatusAIData($ID)
	{
		/*$cQuery = "select
			sr.gs_id, sr.gf_id, acs.dname as academic_session_name,
			reqa.id, reqa.form_no, reqa.gr_no, reqa.student_id, reqa.student_name, reqa.abridged_name, 
			reqa.call_name, reqa.gender, reqa.dob, reqa.father_name, reqa.father_nic, reqa.grade_id, 
			reqa.doj, reqa.req_date, reqa.undertaking, reqa.file_created, reqa.created, reqa.register_entry,
			g.name as grade_name
			from req_admission reqa
			left join _grade g on g.id = reqa.grade_id
			left join student_registered sr on sr.id = reqa.student_id
			left join student_academic_record sar on sar.student_id = reqa.student_id
			left join _academic_session as acs on acs.id = sar.academic_session_id
			where reqa.id = " . $ID . " order by reqa.created desc";
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();	
    				
   		return $row;*/
	}
}