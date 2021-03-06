<?php
class Std_atd_model extends CI_Model{

	private $db_student_attendance;

	function __construct()
	{
		parent::__construct();
		$this->db_student_attendance = $this->load->database('default',TRUE);
	}

	
	public function getAbsentStudentsData($Grade, $Section)
	{
		$cQuery = "SELECT * FROM `attendance_student_today` where grade_name = '" . $Grade . "' and section_name = '" . $Section . "' and std_status_category='Student' and (time is null or time = '00:00:00')";
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();

   		return $row;
	}
	public function getAbsentFenceStudentsData($Grade, $Section)
	{
		$cQuery = "SELECT * FROM `attendance_student_today` where grade_name = '" . $Grade . "' and section_name = '" . $Section . "' and std_status_category='Fence' and (time is null or time = '00:00:00')";
		$query=$this->db->query($cQuery); 
		$row = $query->result_array();
		return $row;
	}

	public function getStudentTPA($Grade, $Section)
	{
		$cQuery = "SELECT * FROM `attendance_student_tpa` where grade_name = '" . $Grade . "' and section_name = '" . $Section . "'";
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();

   		return $row;
	}

	

	protected $_table_name = 'attendance_student_today';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';	
	protected $_order_by = 'time desc';	
	protected $_timestamps = TRUE;
	

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