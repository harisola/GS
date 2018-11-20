<?php
class Activecase_model extends CI_Model{

	private $db_student_attendance;

	function __construct()
	{
		parent::__construct();
		$this->db_student_attendance = $this->load->database('attendance_students',TRUE);
	}


	protected $_table_name = 'activecase_case';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';	
	protected $_order_by = 'created desc';	
	protected $_timestamps = TRUE;
	
	public function getActiveCase($GSID)
	{
		$cQuery = "SELECT
			ac.id, ac.gs_id, ac.category_id, acc.name as start_case_name, ac.close_date, ac.close_time, ac.close_by, ac.close_category_id, ac.created, ac.register_by, ac.modified, ac.modified_by, ac.record_deleted, accl.name as close_case_name
			FROM activecase_case ac
			left join activecase_category acc on
			acc.id = ac.category_id
			left join activecase_category accl on
			accl.id = ac.close_category_id
			where ac.gs_id = '" . $GSID . "' and ac.close_category_id = 0 and from_unixtime(ac.created) >= '2017-08-01' order by ac.created desc limit 1";
		
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