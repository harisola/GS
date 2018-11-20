<?php
class Attendance_staff_previousday_model extends CI_Model{

	private $db_attendance_staff;

	function __construct()
	{
		parent::__construct();
		$this->db_attendance_staff = $this->load->database('attendance_staff',TRUE);
	}


	protected $_table_name = 'staff_atd_report_all_out';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';	
	protected $_order_by = 'gt_id asc';	
	protected $_timestamps = TRUE;	


	public function getStaffOutAttendance(){		
		$date = date('Y-m-d H:i:s');
		$prev_date = date('Y-m-d', strtotime($date .' -1 day'));
		//$next_date = date('Y-m-d', strtotime($date .' +1 day'));
		$weekday = date('l', strtotime($prev_date));
		if ($weekday == 'Sunday') {
			$query =
			'select * from staff_atd_report_all_out where date_out = curdate()-2';
		}else {
			$query =
			'select * from staff_atd_report_all_out where date_out = curdate()-1';
		}	

		$sql = $this->db_attendance_staff->query($query);
		return $sql->result();
	}

	public function get($id = NULL, $single = FALSE){
		if($id != NULL){
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db_attendance_staff->where($this->_primary_key, $id);			
			$method = 'row';
		}
		elseif($single == TRUE) {
			$method = 'row';
		}
		else{
			$method = 'result';
		}

		//$this->db_attendance_staff->where('record_deleted', 0);
//		if(!count($this->db_attendance_staff->ar_orderby)){
//			$this->db_attendance_staff->order_by($this->_order_by);
//		}
//		return $this->db_attendance_staff->get($this->_table_name)->$method();
	}

	public function get_by($where, $single = FALSE){
		$this->db_attendance_staff->where($where);
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
			$this->db_attendance_staff->set($data);
			$this->db_attendance_staff->insert($this->_table_name);
			$id = $this->db_attendance_staff->insert_id();
		}
		// Update a record
		else{
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db_attendance_staff->set($data);
			$this->db_attendance_staff->where($this->_primary_key, $id);
			$this->db_attendance_staff->update($this->_table_name);
		}

		return $id;
	}

	public function delete(){
		$filter = $this->_primary_filter;
		$id = $fileter($id);

		if(!$id){
			return FALSE;
		}

		$this->db_attendance_staff->where($this->_primary_key, $id);
		$this->db_attendance_staff->limit(1);
		$this->db_attendance_staff->delete($this->_table_name);
	}
}