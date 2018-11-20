<?php
class Student_attendance_absent_solved_model extends CI_Model{

	private $db_student_attendance;

	function __construct()
	{
		parent::__construct();
		$this->db_student_attendance = $this->load->database('attendance_students',TRUE);
	}


	protected $_table_name = 'attendance_absent_solved';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';	
	protected $_order_by = 'date asc';	
	protected $_timestamps = TRUE;



	public function getAbsentData($GSID, $dateFrom, $dateTo)
	{
		$cQuery = "SELECT aas.gs_id,  aas.date, abc.name as absent_case, aar.name as absent_reason,
					aas.record_deleted
					FROM atif_attendance.attendance_absent_solved aas
					left join atif_attendance.attendance_absent_case abc on abc.id = aas.absent_case_id
					left join atif_attendance.attendance_absent_reasons aar on aar.id = aas.absent_reason_id 
					where aas.gs_id = '" . $GSID . "' and aas.date BETWEEN '" . $dateFrom . "' and '" . $dateTo . "'";

   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();

   		return $row;
	}	
	

	public function get($id = NULL, $single = FALSE){
		if($id != NULL){
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db_student_attendance->where($this->_primary_key, $id);			
			$method = 'row';
		}
		elseif($single == TRUE) {
			$method = 'row';
		}
		else{
			$method = 'result';
		}

		$this->db_student_attendance->where('record_deleted', 0);
		if(!count($this->db_student_attendance->ar_orderby)){
			$this->db_student_attendance->order_by($this->_order_by);
		}
		return $this->db_student_attendance->get($this->_table_name)->$method();
	}

	public function get_by($where, $single = FALSE){
		$this->db_student_attendance->where($where);
		return $this->get(NULL, $single);
	}

	public function save($data, $id = NULL){

		// Set timestamps
		if($this->_timestamps == TRUE){
			$now = date('Y-m-d H:i:s');
			$id || $data['created'] = human_to_unix($now);
			$id || $data['register_by'] = (int)$this->session->userdata['user_id'];
			$data['modified'] = human_to_unix($now);
			$data['modified_by'] = (int)$this->session->userdata['user_id'];			
		}

		// Insert a new record
		if ($id === NULL){
			!isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
			$this->db_student_attendance->set($data);
			$this->db_student_attendance->insert($this->_table_name);
			$id = $this->db_student_attendance->insert_id();
		}
		// Update a record
		else{
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db_student_attendance->set($data);
			$this->db_student_attendance->where($this->_primary_key, $id);
			$this->db_student_attendance->update($this->_table_name);
		}

		return $id;
	}

	public function delete(){
		$filter = $this->_primary_filter;
		$id = $fileter($id);

		if(!$id){
			return FALSE;
		}

		$this->db_student_attendance->where($this->_primary_key, $id);
		$this->db_student_attendance->limit(1);
		$this->db_student_attendance->delete($this->_table_name);
	}
}