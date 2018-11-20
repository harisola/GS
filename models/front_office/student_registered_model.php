<?php
class Student_registered_model extends MY_Model{
	protected $_table_name = 'student_registered';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';
	protected $_order_by = 'created desc';
	public $rules = array();
	protected $_timestamps = TRUE;

	public function __construct()
	{
		parent::__construct();
	}



	public function generate_GSID($Year){
		$generate_GSID = "";
		$gsid_this = substr($Year, -2);

		$query=$this->db->query("SELECT max(gs_id) as gs_id FROM student_registered WHERE gs_id like '" . $gsid_this . "-%'");
		
		if ($query->num_rows() > 0) {
			$row = $query->row_array();
			$generate_GSID = $row['gs_id'];
			$generate_GSID = substr($generate_GSID, 3,3);
			$generate_GSID = $gsid_this . "-" . str_pad((intval($generate_GSID) + 1), 3, "0", STR_PAD_LEFT);			
		}else{
			$generate_GSID = $gsid_this . "-" .  "001";
		}


		return $generate_GSID;
	}





	public function isOldStudent($officialName, $DOB){
		$StudentID = 0;
		
		$query=$this->db->query("SELECT id FROM student_registered WHERE official_name = '".$officialName."' AND dob = '".$DOB."'");
		
		if ($query->num_rows() > 0) {
			$row = $query->row_array();
			$StudentID = $row['id'];
		}

		return $StudentID;
	}






	public function GRNo_Exists($GRNo){
		$result = false;
		

		$query=$this->db->query("SELECT gr_no FROM student_registered WHERE gr_no = " . $GRNo);
		
		if ($query->num_rows() > 0) {
			$result = true;
		}


		return $result;
	}













	public function getStudentID($GRNo){
		$StudentID = "7060";

		$query=$this->db->query("SELECT id FROM student_registered WHERE gr_no = " . $GRNo);
		
		if ($query->num_rows() > 0) {
			$row = $query->row_array();
			$StudentID = $row['id'];
		}


		return $StudentID;
	}
}