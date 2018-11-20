<?php
class Req_duplicatecard_model extends MY_Model{
	protected $_table_name = 'req_student_card';
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



	public function getDuplicateCardNo($StudentID){
		$getDuplicateCardNo = 0;

		$query=$this->db->query("SELECT count(student_id) as num_of_cards FROM req_student_card WHERE (student_id = " . $StudentID . " and req_date >= '2014-08-01' and req_date <= '2015-06-30' and new_adm = 0)"); 
		
		if ($query->num_rows() > 0) {
			$row = $query->row_array();
			$getDuplicateCardNo = $row['num_of_cards'];
		}else{
			$getDuplicateCardNo = 1;
		}

		return $getDuplicateCardNo;
	}
	


	public function getAllDuplicateCardData()
	{
		$cQuery = "SELECT
				cl.gs_id, cl.gf_id, cl.abridged_name, cl.grade_name, cl.section_name,
				reqsc.id, reqsc.student_id, reqsc.req_date, reqsc.description, reqsc.ip, reqsc.created, reqsc.register_by
				FROM req_student_card reqsc
				left join class_list cl on cl.id = reqsc.student_id
				where from_unixtime(reqsc.created) >= '2016-08-01'  and reqsc.record_deleted = 0
                group by reqsc.created, cl.gs_id";
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();	
    				
   		return $row;
	}



	public function getDuplicateCardData($ID)
	{		
		$cQuery = "select
			cl.gs_id, cl.gf_id, cl.abridged_name, cl.gr_no, cl.gender, cl.grade_name, cl.section_name,
			sfr.name, sfr.parent_type,			
			reqsc.duplicate, reqsc.new_adm, reqsc.amount,
			reqsc.id, reqsc.student_id, reqsc.req_date, reqsc.description, reqsc.ip, reqsc.created
			FROM req_student_card reqsc
			left join class_list cl on cl.id = reqsc.student_id
			left join student_family_record sfr on sfr.gf_id = cl.gf_id
			where reqsc.id = " . $ID;
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();	
    				
   		return $row;
	}



	public function isAlreadyReqGenerated_Today($StudentID)
	{		
		$cQuery = "SELECT id, student_id, req_date, description, duplicate, new_adm, amount, ip,
				 from_unixtime(created) as created FROM `req_student_card`
				 WHERE from_unixtime(created) >= curdate()
				 and student_id = " . $StudentID . " ORDER BY `id` DESC";

   		$query=$this->db->query($cQuery); 
   		$row = $query->num_rows();
    				
   		return $row;
	}
}