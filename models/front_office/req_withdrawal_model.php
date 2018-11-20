<?php
class Req_withdrawal_model extends MY_Model{
	protected $_table_name = 'req_withdrawal';
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






	public function getAllWithdrawalData()
	{
		$cQuery = "select
			cl.gs_id, cl.gr_no, cl.abridged_name, cl.grade_name, cl.section_name, cl.student_status_dname as old_status_name,
			reqw.id, reqw.student_id, reqw.req_date, reqw.wef_date, reqw.old_status, reqw.description, reqw.ip, reqw.created
			from req_withdrawal reqw
			left join class_list cl on cl.id = reqw.student_id
			where reqw.record_deleted = 0 and req_date >= '2016-08-01'";
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();	
    				
   		return $row;
	}



	public function getWithdrawalData($ID)
	{
		$cQuery = 'select
			reqw.id, reqw.student_id, reqw.req_date, reqw.wef_date, reqw.old_status, reqw.description,
			cl.gs_id, cl.gr_no, cl.abridged_name, cl.official_name, cl.call_name, cl.gender, cl.mobile_phone as student_mobile_phone, cl.gf_id,
			cl.dob, cl.year_of_admission, cl.grade_of_admission, cl.grade_name, cl.section_name,
			sfr.name, sfr.parent_type, sfr.mobile_phone,
			sci.phone, sci.apartment_no, sci.building_name, sci.plot_no, sci.street_name, sci.sub_region, sci.region, sci.city,
			reqw.ip, reqw.posted, reqw.created, reqw.record_deleted
			from atif.req_withdrawal reqw
			left join class_list cl on cl.id = reqw.student_id
			left join student_contact_info sci on sci.gf_id = cl.gf_id
			left join student_family_record sfr on sfr.gf_id = cl.gf_id
			where reqw.record_deleted = 0 and reqw.id = ' . $ID;
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();	
    				
   		return $row;
	}
}