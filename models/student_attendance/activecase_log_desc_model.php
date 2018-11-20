<?php
class Activecase_log_desc_model extends CI_Model{

	private $db_student_attendance;

	function __construct()
	{
		parent::__construct();
		$this->db_student_attendance = $this->load->database('default',TRUE);
	}	
	
	public function getStudentActiveCaseLog($ActiveCaseID)
	{
		$result = "";
		$cQuery = "select * from activecase_log_desc where activecase_id = " . $ActiveCaseID . " and from_unixtime(created) >= '2017-08-01' order by created desc";
		
		$query=$this->db->query($cQuery);
		if($query->num_rows() > 0){
			$result = $query->result_array();
		}
		
   		return $result;
	}
}