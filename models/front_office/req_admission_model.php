<?php
class Req_admission_model extends MY_Model{
	protected $_table_name = 'req_admission';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';
	protected $_order_by = 'created desc';
	public $rules = array();
	protected $_timestamps = TRUE;

	public function __construct()
	{
		parent::__construct();
	}

	public function getAllAdmissionData()
	{
		$cQuery = "select
			sr.gs_id, sr.gf_id,
			reqa.id, reqa.form_no, reqa.gr_no, reqa.student_id, reqa.student_name, reqa.abridged_name, 
			reqa.call_name, reqa.gender, reqa.dob, reqa.father_name, reqa.father_nic, 
			reqa.grade_id, reqa.doj, reqa.req_date, reqa.undertaking, reqa.file_created, reqa.created, reqa.register_entry,
			g.name as grade_name
			from req_admission reqa
			left join _grade g on g.id = reqa.grade_id
			left join student_registered sr on sr.id = reqa.student_id
			where reqa.id > 610
			order by reqa.created desc";
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();	
    				
   		return $row;
	}



	public function getNewAdmissionData($ID)
	{
		$cQuery = "select
			sr.gs_id, sr.gf_id, acs.dname as academic_session_name,
			reqa.id, reqa.form_no, reqa.gr_no, reqa.student_id, reqa.student_name, reqa.abridged_name, 
			reqa.call_name, reqa.gender, reqa.dob, reqa.father_name, reqa.father_nic, reqa.grade_id, 
			reqa.doj, reqa.req_date, reqa.undertaking, reqa.file_created, reqa.created, reqa.admission_fee,
			reqa.security_deposit, reqa.computer_subscription, reqa.register_entry,
			g.name as grade_name
			from req_admission reqa
			left join _grade g on g.id = reqa.grade_id
			left join student_registered sr on sr.id = reqa.student_id
			left join student_academic_record sar on sar.student_id = reqa.student_id
			left join _academic_session as acs on acs.id = sar.academic_session_id
			where reqa.id = " . $ID . " order by reqa.created desc";
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();	
    				
   		return $row;
	}




	public function getSiblingsData($GFID)
	{
		$cQuery = "select * from students_current_classlist where gf_id = " . $GFID . " order by grade_id desc";
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();	
    				
   		return $row;
	}
}