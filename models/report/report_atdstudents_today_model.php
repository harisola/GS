<?php
class Report_atdstudents_today_model extends CI_Model{

	private $db_attendance_students;

	function __construct()
	{
		parent::__construct();
		$this->db_attendance_students = $this->load->database('default',TRUE);
	}


	protected $_table_name = 'attendance_student_today';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';	
	protected $_order_by = 'gs_id asc';	
	protected $_timestamps = TRUE;	


	public function getStudentsAttendanceOfLocation($LocationID)
	{
		$query =
		"SELECT * FROM attendance_student_today where location_id = " . $LocationID;

		$sql = $this->db_attendance_students->query($query);
		return $sql->result();
	}

	
	public function getStudentsAttendance_IN(){
		$query =
		"SELECT * FROM attendance_student_today WHERE (grade_name = 'III' or grade_name = 'IV' or grade_name = 'V' or grade_name = 'VI' or grade_name = 'VII' or grade_name = 'VIII' or grade_name = 'IX' or grade_name = 'X' or grade_name = 'XI' or grade_name = 'A1' or grade_name = 'A2')";

		$sql = $this->db_attendance_students->query($query);
		return $sql->result();
	}

	public function getStudentsDayPass_Today(){
		$query =
		"SELECT * FROM attendance_student_daypass_today";

		$sql = $this->db_attendance_students->query($query);
		return $sql->result();
	}

	public function getStudentsAttendance_IN_North(){
		$query =
		"SELECT * FROM attendance_student_today WHERE (grade_name = 'PN' or grade_name = 'N' or grade_name = 'KG' or grade_name = 'I' or grade_name = 'II')";

		$sql = $this->db_attendance_students->query($query);
		return $sql->result();
	}

	public function get($id = NULL, $single = FALSE){
		if($id != NULL){
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db_attendance_students->where($this->_primary_key, $id);			
			$method = 'row';
		}
		elseif($single == TRUE) {
			$method = 'row';
		}
		else{
			$method = 'result';
		}

		//$this->db_attendance_students->where('record_deleted', 0);
//		if(!count($this->db_attendance_students->ar_orderby)){
//			$this->db_attendance_students->order_by($this->_order_by);
//		}
//		return $this->db_attendance_students->get($this->_table_name)->$method();
	}

	public function get_by($where, $single = FALSE){
		$this->db_attendance_students->where($where);
		return $this->get(NULL, $single);
	}

	public function save($data, $id = NULL){

		// Set timestamps
		if($this->_timestamps == TRUE){
			$now = date('Y-m-d H:i:s');
			$id || $data['created'] = human_to_unix($now);
			$data['modified'] = human_to_unix($now);
			$data['modified_by'] = (int)$this->session->userdata['user_id'];
		}

		// Insert a new record
		if ($id === NULL){
			!isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
			$this->db_attendance_students->set($data);
			$this->db_attendance_students->insert($this->_table_name);
			$id = $this->db_attendance_students->insert_id();
		}
		// Update a record
		else{
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db_attendance_students->set($data);
			$this->db_attendance_students->where($this->_primary_key, $id);
			$this->db_attendance_students->update($this->_table_name);
		}

		return $id;
	}

	public function delete(){
		$filter = $this->_primary_filter;
		$id = $fileter($id);

		if(!$id){
			return FALSE;
		}

		$this->db_attendance_students->where($this->_primary_key, $id);
		$this->db_attendance_students->limit(1);
		$this->db_attendance_students->delete($this->_table_name);
	}
}